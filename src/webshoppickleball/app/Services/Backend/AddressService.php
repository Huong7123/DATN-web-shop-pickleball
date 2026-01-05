<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\AddressRepositoryInterface;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class AddressService extends BaseService
{
    public function __construct(AddressRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();

        $addressData = [
            'user_id'      => $user->id,
            'user_name'    => $data['user_name'],
            'user_phone'   => $data['user_phone'],
            'address_line' => $data['address_line'],
            'ward'         => $data['ward'],
            'district'     => $data['district'],
            'province'     => $data['province'],
            'is_default'   => !empty($data['is_default']) ? 1 : 0,
        ];

        if ($addressData['is_default'] === 1) {
            /** @var AddressRepositoryInterface $this->repository */
            $this->repository->resetDefault($user->id);
        }

        $item = $this->repository->create($addressData);

        return new DataResult('Thêm mới thành công', 201, $item);
    }

    public function update($id, array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();

        $currentAddress = $this->repository->getById($id);
        if (!$currentAddress) {
            return new DataResult("Cập nhật thất bại, id $id không tồn tại", 404);
        }

        if ($currentAddress->user_id != $user->id) {
            return new DataResult("Bạn không có quyền sửa địa chỉ này", 403);
        }

        $updateData = [
            'user_name'    => $data['user_name']    ?? $currentAddress->user_name,
            'user_phone'   => $data['user_phone']   ?? $currentAddress->user_phone,
            'address_line' => $data['address_line'] ?? $currentAddress->address_line,
            'ward'         => $data['ward']         ?? $currentAddress->ward,
            'district'     => $data['district']     ?? $currentAddress->district,
            'province'     => $data['province']     ?? $currentAddress->province,
        ];

        if (isset($data['is_default'])) {
            $updateData['is_default'] = $data['is_default'] ? 1 : 0;

            if ($updateData['is_default'] === 1) {
                /** @var AddressRepositoryInterface $this->repository */
                $this->repository->resetDefault($user->id);
            }
        }

        $item = $this->repository->update($id, $updateData);

        return new DataResult('Cập nhật thành công', 200, $item);
    }


    
}