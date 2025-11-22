<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserService extends BaseService
{
    public function __construct(UserRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role != "2") {
            return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
        }

        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role' => $data['role'] ?? '2',
            'password' => Hash::make($data['password']),
            'status' => '1',
        ];

        $item = $this->repository->create($userData);

        return new DataResult('Tạo người dùng thành công', 201, $item);
    }

    public function update($id, array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role != "2") {
            return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
        }

        $avatarOld = $this->repository->getById($id);

        $userData = [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'password' => isset($data['password']) ? Hash::make($data['password']) : null,
            'role' => '2',
            'status' => $data['status'] ?? 1,
        ];

        if (!empty($data['avatar'])) {
            $userData['avatar'] = $data['avatar'];
        }

        $item = $this->repository->update($id, $userData);

        if (!$item) {
            return new DataResult("Cập nhật thất bại, id $id không tồn tại", 404);
        }

        return new DataResult('Cập nhật thành công', 200, $item);
    }

    
}