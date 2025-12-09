<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\CartItemRepositoryInterface;
use App\Interfaces\CartRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class CartService extends BaseService
{
    protected CartItemRepositoryInterface $cartItemRepository;
    protected ProductRepositoryInterface $productRepository;

    public function __construct(
        CartRepositoryInterface $repository,
        CartItemRepositoryInterface $cartItemRepository,
        ProductRepositoryInterface $productRepository
    ){
        parent::__construct($repository);
        $this->cartItemRepository = $cartItemRepository;
        $this->productRepository = $productRepository;
    }

    public function create(array $data): DataResult
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            /** @var CartRepositoryInterface $cartRepo */
            $cartRepo = $this->repository;

            // 1. Lấy giỏ hàng hiện tại hoặc tạo mới
            $cart = $cartRepo->getByUserId($user->id);
            if (!$cart) {
                $cart = $cartRepo->create(['user_id' => $user->id]);

                if (!$cart) {
                    return new DataResult('Tạo giỏ hàng thất bại', 500);
                }
            }

            // 2. Thêm / cập nhật sản phẩm vào giỏ
            foreach ($data['items'] as $itemData) {

                $product = $this->productRepository->getById($itemData['product_id']);

                if (!$product || $product->status != 1) {
                    return new DataResult(
                        "Sản phẩm {$itemData['product_id']} không khả dụng",
                        400
                    );
                }

                $quantity = $itemData['quantity'];
                $price    = $product->price; // giá tại thời điểm thêm giỏ

                // Kiểm tra xem đã tồn tại trong giỏ chưa
                $existingItem = $this->cartItemRepository
                    ->getByCartAndProduct($cart->id, $product->id);

                if ($existingItem) {
                    // Cộng dồn số lượng
                    $this->cartItemRepository->update($existingItem->id, [
                        'quantity' => $existingItem->quantity + $quantity,
                    ]);
                } else {
                    // Tạo mới cart item
                    $this->cartItemRepository->create([
                        'cart_id'    => $cart->id,
                        'product_id' => $product->id,
                        'quantity'   => $quantity,
                        'price'      => $price,
                    ]);
                }
            }

            // Load items trả về đầy đủ
            $cart->load('items.product');

            return new DataResult('Thêm giỏ hàng thành công', 201, $cart);

        } catch (\Exception $e) {

            // rollback: nếu giỏ hàng mới tạo bị lỗi thì xoá
            if (!empty($cart->id ?? null)) {
                $this->repository->delete($cart->id);
            }

            return new DataResult('Lỗi: ' . $e->getMessage(), 500);
        }
    }


    public function update(int $cartId, array $data): DataResult
    {
        try {
            $cart = $this->repository->getById($cartId);
            if (!$cart) {
                return new DataResult('Giỏ hàng không tồn tại', 404);
            }

            if (!empty($data['items'])) {
                foreach ($data['items'] as $itemData) {

                    $cartItem = $this->cartItemRepository
                        ->getByCartAndProduct($cartId, $itemData['product_id']);

                    if ($cartItem) {
                        $this->cartItemRepository->update($cartItem->id, [
                            'quantity' => $itemData['quantity'],
                        ]);
                    }
                }
            }

            $cart->load('items.product');

            return new DataResult('Cập nhật giỏ hàng thành công', 200, $cart);

        } catch (\Exception $e) {
            return new DataResult('Cập nhật thất bại: ' . $e->getMessage(), 500);
        }
    }


    public function deleteItems(array $productIds): DataResult
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            /** @var CartRepositoryInterface $cartRepo */
            $cartRepo = $this->repository;

            $cart = $cartRepo->getByUserId($user->id);

            if (!$cart) {
                return new DataResult('Giỏ hàng không tồn tại', 404);
            }

            if (empty($productIds)) {
                return new DataResult('Không có sản phẩm để xóa', 400);
            }

            foreach ($productIds as $productId) {
                $cartItem = $this->cartItemRepository
                    ->getByCartAndProduct($cart->id, $productId);

                if ($cartItem) {
                    $this->cartItemRepository->delete($cartItem->id);
                }
            }

            $cart->load('items.product');

            return new DataResult('Xóa sản phẩm thành công', 200, $cart);

        } catch (\Exception $e) {
            return new DataResult('Xóa sản phẩm thất bại: ' . $e->getMessage(), 500);
        }
    }
}
