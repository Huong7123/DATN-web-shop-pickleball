<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\CartItemRepositoryInterface;
use App\Interfaces\CartRepositoryInterface;
use App\Interfaces\ProductVariantRepositoryInterface;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class CartService extends BaseService
{
    protected CartItemRepositoryInterface $cartItemRepository;
    protected ProductVariantRepositoryInterface $productVariantRepository;

    public function __construct(
        CartRepositoryInterface $repository,
        CartItemRepositoryInterface $cartItemRepository,
        ProductVariantRepositoryInterface $productVariantRepository
    ){
        parent::__construct($repository);
        $this->cartItemRepository = $cartItemRepository;
        $this->productVariantRepository = $productVariantRepository;
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
                    return new DataResult('Thêm giỏ hàng thất bại', 500);
                }
            }

            // 2. Thêm/ cập nhật cart items
            foreach ($data['items'] as $itemData) {
                $variant = $this->productVariantRepository->getById($itemData['variant_id']);

                if (!$variant || $variant->status != 1) {
                    return new DataResult("Biến thể {$itemData['variant_id']} đang ngừng bán", 400);
                }

                $quantity = $itemData['quantity'];
                $price    = $variant->price;

                $existingItem = $this->cartItemRepository
                    ->getByCartAndVariant($cart->id, $variant->id);

                if ($existingItem) {
                    $this->cartItemRepository->update($existingItem->id, [
                        'quantity' => $existingItem->quantity + $quantity,
                    ]);
                } else {
                    $this->cartItemRepository->create([
                        'cart_id'            => $cart->id,
                        'product_variant_id' => $variant->id,
                        'quantity'           => $quantity,
                        'price'              => $price,
                    ]);
                }
            }

            return new DataResult('Thêm giỏ hàng thành công', 201, $cart);

        } catch (\Exception $e) {
            if (!empty($cart->id ?? null)) {
                $this->repository->delete($cart->id);
            }
            return new DataResult('Thêm giỏ hàng thất bại: ' . $e->getMessage(), 500);
        }
    }

    public function update(int $cartId, array $data): DataResult
    {
        try {
            // 1. Lấy giỏ hàng
            $cart = $this->repository->getById($cartId);
            if (!$cart) {
                return new DataResult('Giỏ hàng không tồn tại', 404);
            }

            // 2. Cập nhật số lượng cho từng item
            if (!empty($data['items']) && is_array($data['items'])) {
                foreach ($data['items'] as $itemData) {
                    $cartItem = $this->cartItemRepository
                        ->getByCartAndVariant($cartId, $itemData['variant_id']);

                    if ($cartItem) {
                        // Cập nhật quantity
                        $this->cartItemRepository->update($cartItem->id, [
                            'quantity' => $itemData['quantity'],
                        ]);
                    }
                }
            }

            // Load lại items để trả về
            $cart->load('items');

            return new DataResult('Cập nhật giỏ hàng thành công', 200, $cart);

        } catch (\Exception $e) {
            return new DataResult('Cập nhật giỏ hàng thất bại: ' . $e->getMessage(), 500);
        }
    }

    public function deleteItems(array $variantIds): DataResult
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            /** @var CartRepositoryInterface $cartRepo */
            $cartRepo = $this->repository;

            // Lấy giỏ hàng của user
            $cart = $cartRepo->getByUserId($user->id);
            if (!$cart) {
                return new DataResult('Giỏ hàng không tồn tại', 404);
            }

            if (empty($variantIds)) {
                return new DataResult('Không có sản phẩm để xóa', 400);
            }

            foreach ($variantIds as $variantId) {
                $cartItem = $this->cartItemRepository->getByCartAndVariant($cart->id, $variantId);
                if ($cartItem) {
                    $this->cartItemRepository->delete($cartItem->id);
                }
            }

            // Load lại items để trả về
            $cart->load('items');

            return new DataResult('Xóa sản phẩm thành công', 200, $cart);

        } catch (\Exception $e) {
            return new DataResult('Xóa sản phẩm thất bại: ' . $e->getMessage(), 500);
        }
    }

}