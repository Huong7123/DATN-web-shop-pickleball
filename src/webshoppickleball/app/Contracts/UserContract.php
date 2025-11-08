<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserContract {

    //contract auth
    public function validateLogin(?User $user, string $password): void
    {
        if (!$user) {
            throw new Exception("Email không tồn tại");
        }

        if ($user->status === 0) {
            throw new Exception("Tài khoản chưa được kích hoạt");
        }

        if ($user->status === 2) {
            throw new Exception("Tài khoản bị khoá vui lòng liên hệ cho quản trị viên");
        }

        if (!Hash::check($password, $user->password)) {
            throw new Exception("Mật khẩu không đúng");
        }
    }

    public function validateForgot(?User $user): void
    {
        if (!$user) {
            throw new Exception("Email không tồn tại");
        }

        if ($user->status === 0) {
            throw new Exception("Tài khoản chưa được kích hoạt");
        }
    }

    //contract frontend
    public function validateChangePassword(?User $user, string $currentPassword, string $newPassword): void
    {
        if (!$user) {
            throw new \Exception("Người dùng không tồn tại");
        }
        if (!Hash::check($currentPassword, $user->password)) {
            throw new Exception("Mật khẩu hiện tại không đúng");
        }

        if ($currentPassword === $newPassword) {
            throw new Exception("Mật khẩu mới không được trùng mật khẩu hiện tại");
        }
    }

    
}