<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\CartItemRepositoryInterface;
use App\Interfaces\OfferRepositoryInterface;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class OrderService extends BaseService
{
    protected OrderItemRepositoryInterface $orderItemRepository;
    protected ProductRepositoryInterface $productRepository;
    protected CartItemRepositoryInterface $cartItemRepository;
    protected UserRepositoryInterface $userRepository;
    protected OfferRepositoryInterface $offerRepository;

    public function __construct(
        OrderRepositoryInterface $repository,
        OrderItemRepositoryInterface $orderItemRepository,
        ProductRepositoryInterface $productRepository,
        CartItemRepositoryInterface $cartItemRepository,
        UserRepositoryInterface $userRepository,
        OfferRepositoryInterface $offerRepository
    ){
        parent::__construct($repository);
        $this->orderItemRepository = $orderItemRepository;
        $this->productRepository = $productRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->userRepository = $userRepository;
        $this->offerRepository = $offerRepository;
    }
    public function getAllOrderAdmin($perPage, $status, $orderId): DataResult
    {
        /** @var OrderRepositoryInterface $repo */
        $repo = $this->repository;
        $data = $repo->getAllOrderAdmin($perPage, $status, $orderId);
        return new DataResult('Lấy danh sách thành công',200,$data);
    }

    public function getAllOrder(array $filters): DataResult
    {
        /** @var OrderRepositoryInterface $repo */
        $repo = $this->repository;
        $data = $repo->getAllOrder($filters);
        return new DataResult('Lấy danh sách thành công',200,$data);
    }

    public function getOrderDetail(int $id): DataResult
    {
        /** @var OrderRepositoryInterface $repo */
        $repo = $this->repository;
        $item = $repo->getOrderDetail($id);
        if (!$item) {
            return new DataResult("Bản ghi với id $id không tồn tại", 404);
        }
        return new DataResult('Lấy dữ liệu thành công', 200, $item);
    }

    public function create(array $data): DataResult
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            $shippingFee = $data['shipping_method'] == 1 ? 30000 : 0;
            $discount    = max(0, (int)($data['discount'] ?? 0));

            // 1. Tạo order
            $order = $this->repository->create([
                'user_id'         => $user->id,
                'user_name'       => $data['user_name'],
                'user_phone'      => $data['user_phone'],
                'address'         => $data['address'],
                'description'     => $data['description'] ?? null,
                'payment_method'  => $data['payment_method'],
                'payment_status'  => 'unpaid',
                'shipping_method' => $data['shipping_method'],
                'shipping_fee'    => $shippingFee,
                'discount'        => $discount,
                'total'           => 0,
                'status'          => 'pending',
            ]);

            if (!$order) return new DataResult('Tạo đơn hàng thất bại', 500);

            $productTotal = 0;
            $productIds = []; // lưu product_id vừa đặt

            // 2. Trừ kho và tạo order items
            foreach ($data['items'] as $item) {
                $variant = $this->productRepository->findVariant(
                    $item['parent_id'],
                    $item['attribute_value_ids']
                );

                if (!$variant || $variant->status != 1) {
                    $this->rollbackOrder($order->id);
                    return new DataResult('Sản phẩm không tồn tại hoặc đã ngưng bán', 400);
                }

                $ok = $this->productRepository->decrementStock($variant->id, $item['quantity']);
                $okParent = $this->productRepository->decrementParentStock($item['parent_id'], $item['quantity']);

                if (!$ok || !$okParent) {
                    $this->rollbackOrder($order->id);
                    throw new \Exception("Sản phẩm {$variant->id} không đủ tồn kho");
                }

                $this->orderItemRepository->create([
                    'order_id'   => $order->id,
                    'product_id' => $variant->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $variant->price,
                ]);

                $this->productRepository->incrementSold($item['parent_id'], $item['quantity']);
                $this->productRepository->incrementSold($variant->id, $item['quantity']);

                $productTotal += $variant->price * $item['quantity'];
                $productIds[] = $variant->id;
            }

            // 3. Cập nhật tổng tiền
            $grandTotal = max(0, $productTotal + $shippingFee - $discount);
            $this->repository->update($order->id, ['total' => $grandTotal]);
            $order->total = $grandTotal;

            //Cập nhật 
            if (!empty($data['discount_id'])) {
                $this->offerRepository->updateStatusUsed($user->id, (int)$data['discount_id']);
            }

            // Cập nhật chi tiêu cho User
            $newTotalSpending = $user->total_spending + $grandTotal;
            // Sử dụng repo của user để update
            $this->userRepository->update($user->id, [
                'total_spending' => $newTotalSpending
            ]);

            // 4. Xoá sản phẩm khỏi giỏ hàng qua repository
            if (!empty($productIds)) {
                $this->cartItemRepository->deleteCartItemsByUserAndProduct($user->id, $productIds);
            }

            return new DataResult('Đặt hàng thành công', 201, $order);

        } catch (\Exception $e) {
            if (!empty($order->id ?? null)) {
                $this->rollbackOrder($order->id);
            }
            return new DataResult('Tạo đơn hàng thất bại: ' . $e->getMessage(), 500);
        }
    }


    private function rollbackOrder($orderId)
    {
        $this->orderItemRepository->deleteByOrderId($orderId);
        $this->repository->delete($orderId);
    }


    public function update(int $orderId, array $data): DataResult
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            $order = $this->repository->getById($orderId);
            if (!$order) return new DataResult('Đơn hàng không tồn tại', 404);

            $isAdmin = ($user->role == 2);

            // ================= ADMIN =================
            if ($isAdmin) {

                if (!isset($data['status'])) {
                    return new DataResult('Admin chỉ được cập nhật trạng thái đơn hàng', 400);
                }

                $updateData = ['status' => $data['status']];

                // Admin hoàn tất đơn → auto paid
                if ($data['status'] === 'complete') {
                    $updateData['payment_status'] = 'paid';
                }

                $this->repository->update($orderId, $updateData);

                return new DataResult('Cập nhật trạng thái thành công', 200);
            }


            // ================= USER =================
            if ($order->status !== 'pending') {
                return new DataResult('Đơn hàng đã được xử lý, không thể chỉnh sửa', 403);
            }

            // USER chỉ được sửa thông tin giao hàng
            $updateData = [
                'user_name'   => $data['user_name']   ?? $order->user_name,
                'user_phone'  => $data['user_phone']  ?? $order->user_phone,
                'address'     => $data['address']     ?? $order->address,
                'description' => $data['description'] ?? $order->description,
            ];

            // USER huỷ đơn
            if (isset($data['status']) && $data['status'] === 'cancel') {

                // ===== HOÀN KHO =====
                $orderItems = $this->orderItemRepository->getByOrder($orderId);

                foreach ($orderItems as $item) {
                    $this->productRepository->increment(
                        $item->product_id,
                        'quantity',
                        $item->quantity
                    );

                    $this->productRepository->incrementParentStock(
                        $item->product_id,
                        'quantity',
                        $item->quantity
                    );
                    $this->productRepository->decrementSoldChildProduct($item->product_id, $item->quantity);
                    $this->productRepository->decrementSoldParentProduct($item->product_id, $item->quantity);
                }

                // Trừ lại tiền chi tiêu khi hủy đơn 
                $newTotalSpending = max(0, $user->total_spending - $order->total);
                $this->userRepository->update($user->id, [
                    'total_spending' => $newTotalSpending
                ]);

                $updateData['status'] = 'cancel';

            }

            $updated = $this->repository->update($orderId, $updateData);

            return new DataResult('Cập nhật đơn hàng thành công', 200, $updated);

        } catch (\Exception $e) {
            return new DataResult('Cập nhật đơn hàng thất bại: ' . $e->getMessage(), 500);
        }
    }

    
}