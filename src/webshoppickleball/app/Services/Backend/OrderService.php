<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class OrderService extends BaseService
{
    protected OrderItemRepositoryInterface $orderItemRepository;
    protected ProductRepositoryInterface $productRepository;

    public function __construct(
        OrderRepositoryInterface $repository,
        OrderItemRepositoryInterface $orderItemRepository,
        ProductRepositoryInterface $productRepository
    ){
        parent::__construct($repository);
        $this->orderItemRepository = $orderItemRepository;
        $this->productRepository = $productRepository;
    }

    public function create(array $data): DataResult
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            // 1. Tạo order
            $orderData = [
                'user_id'     => $user->id,
                'user_name'   => $data['user_name'],
                'user_phone'  => $data['user_phone'],
                'address'     => $data['address'],
                'description' => $data['description'] ?? null,
                'total'       => 0,
                'status'      => 'pending',
            ];

            $order = $this->repository->create($orderData);
            if (!$order) {
                return new DataResult('Tạo đơn hàng thất bại', 500);
            }

            $total = 0;

            // 2. Tạo order items
            foreach ($data['items'] as $itemData) {
                $product = $this->productRepository->getById($itemData['product_id']);

                // kiểm tra mặt hàng còn bán hay không
                if (!$product || $product->status != 1) {
                    $this->orderItemRepository->deleteByOrderId($order->id);
                    $this->repository->delete($order->id);
                    return new DataResult("Biến thể {$itemData['product_id']} đang ngừng bán", 400);
                }

                // kiểm tra tồn kho
                if ($product->quantity <= 0) {
                    $this->orderItemRepository->deleteByOrderId($order->id);
                    $this->repository->delete($order->id);
                    return new DataResult("Mặt hàng {$itemData['product_id']} đã hết hàng", 400);
                }

                // kiểm tra số lượng muốn mua có lớn hơn tồn kho không
                if ($itemData['quantity'] > $product->quantity) {
                    $this->orderItemRepository->deleteByOrderId($order->id);
                    $this->repository->delete($order->id);
                    return new DataResult("Số lượng biến thể {$itemData['product_id']} vượt quá số lượng trong kho", 400);
                }

                $quantityToBuy = $itemData['quantity'];
                $price = $product->price;

                // tạo order item
                $this->orderItemRepository->create([
                    'order_id'           => $order->id,
                    'product_id' => $product->id,
                    'quantity'           => $quantityToBuy,
                    'price'              => $price,
                ]);

                // trừ quantity biến thể bằng update của base repo
                $newQuantity = $product->quantity - $quantityToBuy;
                if ($newQuantity < 0) $newQuantity = 0;
                $this->productRepository->update($product->id, ['quantity' => $newQuantity]);

                // cộng tổng tiền
                $total += $price * $quantityToBuy;
            }

            // 3. Cập nhật tổng tiền đơn hàng
            $this->repository->update($order->id, ['total' => $total]);

            $order->total = $total;

            return new DataResult('Thêm mới đơn hàng thành công', 201, $order);

        } catch (\Exception $e) {
            if (!empty($order->id ?? null)) {
                $this->orderItemRepository->deleteByOrderId($order->id);
                $this->repository->delete($order->id);
            }

            return new DataResult('Tạo đơn hàng thất bại: ' . $e->getMessage(), 500);
        }
    }


    public function update(int $orderId, array $data): DataResult
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            // Lấy đơn hàng
            $order = $this->repository->getById($orderId);
            if (!$order) {
                return new DataResult('Đơn hàng không tồn tại', 404);
            }

            // Chỉ cho phép cập nhật nếu status = pending
            if ($order->status !== 'pending') {
                return new DataResult('Không thể cập nhật đơn hàng', 400);
            }

            $isAdmin = ($user->role == 2);

            $updateData = [
                'user_name'   => $data['user_name'] ?? $order->user_name,
                'user_phone'  => $data['user_phone'] ?? $order->user_phone,
                'address'     => $data['address'] ?? $order->address,
                'description' => $data['description'] ?? $order->description,
            ];

            if (isset($data['status'])) {
                if ($isAdmin) {
                    $updateData['status'] = $data['status'];
                }

                if (!$isAdmin) {
                    if ($data['status'] !== 'cancel') {
                        return new DataResult(
                            'Bạn chỉ được phép hủy đơn hàng (status = cancel)',
                            403
                        );
                    }

                    $updateData['status'] = 'cancel';
                }
            }

            $updatedOrder = $this->repository->update($orderId, $updateData);

            return new DataResult('Cập nhật đơn hàng thành công', 200, $updatedOrder);

        } catch (\Exception $e) {
            return new DataResult('Cập nhật đơn hàng thất bại: ' . $e->getMessage(), 500);
        }
    }
    
}