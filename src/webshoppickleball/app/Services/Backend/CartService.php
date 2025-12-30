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

            // 1. Lấy hoặc tạo cart
            $cart = $cartRepo->getByUserId($user->id);
            $isNewCart = false;

            if (!$cart) {
                $cart = $cartRepo->create(['user_id' => $user->id]);
                $isNewCart = true;
            }

            // 2. Thêm từng item
            foreach ($data['items'] as $item) {

                $parentId = $item['parent_id'];
                $selectedValueIds = $item['attribute_value_ids'];
                $quantity = $item['quantity'];
                // 3. Map đúng variant
                $variant = $this->cartItemRepository->findVariant($parentId, $selectedValueIds);
                if (!$variant || $variant->status != 1) {
                    if ($isNewCart) $this->repository->delete($cart->id);
                    return new DataResult('Biến thể không tồn tại hoặc đã ngưng bán', 400);
                }

                // 4. Đã có trong cart chưa
                $existingItem = $this->cartItemRepository
                    ->getByCartAndProduct($cart->id, $variant->id);

                if ($existingItem) {
                    $this->cartItemRepository->update($existingItem->id, [
                        'quantity' => $existingItem->quantity + $quantity,
                    ]);
                } else {
                    $this->cartItemRepository->create([
                        'cart_id'    => $cart->id,
                        'product_id' => $variant->id,
                        'quantity'   => $quantity,
                        'price'      => $variant->price,
                    ]);
                }
            }

            $cart->load('items.product.attributeValues');

            return new DataResult('Thêm vào giỏ hàng thành công', 201, $cart);

        } catch (\Exception $e) {

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

                foreach ($data['items'] as $item) {

                    $parentId = $item['parent_id'];
                    $selectedValueIds = $item['attribute_value_ids'];
                    $quantity = $item['quantity'];

                    // 1. Map đúng variant giống create()
                    $variant = $this->cartItemRepository->findVariant($parentId, $selectedValueIds);

                    if (!$variant || $variant->status != 1) {
                        return new DataResult('Biến thể không tồn tại hoặc đã ngưng bán', 400);
                    }

                    // 2. Tìm item trong cart theo variant
                    $cartItem = $this->cartItemRepository
                        ->getByCartAndProduct($cartId, $variant->id);

                    if (!$cartItem) {
                        return new DataResult('Không tìm thấy sản phẩm trong giỏ', 404);
                    }

                    // 3. Update quantity
                    if ($quantity <= 0) {
                        $this->cartItemRepository->delete($cartItem->id); // xoá nếu = 0
                    } else {
                        $this->cartItemRepository->update($cartItem->id, [
                            'quantity' => $quantity,
                        ]);
                    }
                }
            }

            $cart->load('items.product.attributeValues');

            return new DataResult('Cập nhật giỏ hàng thành công', 200, $cart);

        } catch (\Exception $e) {
            return new DataResult('Cập nhật thất bại: ' . $e->getMessage(), 500);
        }
    }

    public function deleteItems(int $id): DataResult
    {
        $deleted = $this->cartItemRepository->deleteItems($id);
        if (!$deleted) {
            return new DataResult("Xóa thất bại, id $id không tồn tại", 404);
        }
        return new DataResult('Xóa thành công', 200, null);
    }

    public function getCartItems(int $userId): DataResult
    {
        /** @var CartRepositoryInterface $cartRepo */
        $cartRepo = $this->repository;
        $data = $cartRepo->getCartItems($userId);

        return new DataResult('Lấy danh sách thành công',200,$data);
    }

}
