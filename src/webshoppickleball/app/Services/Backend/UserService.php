<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\UserRepositoryInterface;
use Dotenv\Validator;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

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
            'role' => '2',
            'password' => Hash::make($data['password']),
            'status' => '1',
        ];

        $item = $this->repository->create($userData);

        return new DataResult('Tạo người dùng thành công', 201, $item);
    }

    public function update($id, array $data): DataResult
    {

        $currentUser = $this->repository->getById($id);
        if (!$currentUser) {
            return new DataResult("Cập nhật thất bại, id $id không tồn tại", 404);
        }

        if (!empty($data['avatar']) && $data['avatar'] instanceof \Illuminate\Http\UploadedFile) {
           
            if ($currentUser->avatar && Storage::disk('public')->exists($currentUser->avatar)) {
                Storage::disk('public')->delete($currentUser->avatar);
            }

            $data['avatar'] = $data['avatar']->store('images', 'public');
        }

        $updateData = [
            'name'     => $data['name'] ?? $currentUser->name,
            'phone'    => $data['phone'] ?? $currentUser->phone,
            'password' => isset($data['password']) ? Hash::make($data['password']) : $currentUser->password,
            'role'     => $data['role'] ?? $currentUser->role,
            'status'   => $data['status'] ?? $currentUser->status,
        ];

        if (!empty($data['avatar'])) {
            $updateData['avatar'] = $data['avatar'];
        }

        $item = $this->repository->update($id, $updateData);

        return new DataResult('Cập nhật thành công', 200, $item);
    }


    public function updatePassword($id, array $data): DataResult
    {
        $currentUser = $this->repository->getById($id);
        if (!$currentUser) {
            return new DataResult("Cập nhật thất bại, id $id không tồn tại", 404);
        }

        if (!Hash::check($data['current_password'], $currentUser->password)) {
            return new DataResult('Mật khẩu hiện tại không đúng', 400);
        }

        if (Hash::check($data['new_password'], $currentUser->password)) {
            return new DataResult('Mật khẩu mới phải khác mật khẩu cũ', 400);
        }

        $updateData = [
            'password' => Hash::make($data['new_password']),
        ];

        $item = $this->repository->update($id, $updateData);

        return new DataResult('Cập nhật thành công', 200, $item);
    }
    
}