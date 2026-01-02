<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\CartItemRepositoryInterface;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class OrderService extends BaseService
{
    protected OrderItemRepositoryInterface $orderItemRepository;
    protected ProductRepositoryInterface $productRepository;
    protected CartItemRepositoryInterface $cartItemRepository;

    public function __construct(
        OrderRepositoryInterface $repository,
        OrderItemRepositoryInterface $orderItemRepository,
        ProductRepositoryInterface $productRepository,
        CartItemRepositoryInterface $cartItemRepository,
    ){
        parent::__construct($repository);
        $this->orderItemRepository = $orderItemRepository;
        $this->productRepository = $productRepository;
        $this->cartItemRepository = $cartItemRepository;
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
                if (!$ok) {
                    $this->rollbackOrder($order->id);
                    throw new \Exception("Sản phẩm {$variant->id} không đủ tồn kho");
                }

                $this->orderItemRepository->create([
                    'order_id'   => $order->id,
                    'product_id' => $variant->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $variant->price,
                ]);

                $productTotal += $variant->price * $item['quantity'];
                $productIds[] = $variant->id;
            }

            // 3. Cập nhật tổng tiền
            $grandTotal = max(0, $productTotal + $shippingFee - $discount);
            $this->repository->update($order->id, ['total' => $grandTotal]);
            $order->total = $grandTotal;

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

                $this->repository->update($orderId, [
                    'status' => $data['status']
                ]);

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
                }

                $updateData['status'] = 'cancel';
            }

            $updated = $this->repository->update($orderId, $updateData);

            return new DataResult('Cập nhật đơn hàng thành công', 200, $updated);

        } catch (\Exception $e) {
            return new DataResult('Cập nhật đơn hàng thất bại: ' . $e->getMessage(), 500);
        }
    }

    
}