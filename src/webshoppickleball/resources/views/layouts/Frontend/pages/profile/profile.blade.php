@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div class="flex flex-wrap gap-2 mb-8">
        <a class="text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary text-sm font-medium"
            href="/">Trang chủ</a>
        <span class="text-gray-500 dark:text-gray-400 text-sm font-medium">/</span>
        <span class="text-gray-900 dark:text-white text-sm font-medium">Thông tin cá nhân</span>
    </div>
    <div class="flex flex-col md:flex-row gap-8 lg:gap-12">
        <!-- SideNavBar -->
        @include('layouts.Frontend.widget.__menu_profile')
        <!-- Main Content Area -->
        <div class="flex-1">
            <div class="bg-white dark:bg-gray-900/50 p-6 sm:p-8 rounded-xl shadow-sm">
                <!-- PageHeading -->
                <div class="border-b border-gray-200 dark:border-gray-800 pb-6 mb-6">
                    <h2 class="text-gray-900 dark:text-white text-2xl font-bold tracking-tight">Thông tin cá nhân</h2>
                    <!-- BodyText -->
                    <p class="text-gray-500 dark:text-gray-400 text-base font-normal mt-2">Quản lý thông tin hồ sơ để bảo mật
                        tài khoản.</p>
                </div>
                <form action="#" class="space-y-6" method="POST">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2 flex items-center gap-6" style="justify-content: center;">
                            <label for="avatar" class="relative cursor-pointer group">
                            <img
                                id="avatarPreview"
                                src="https://i.pravatar.cc/150?img=3"
                                alt="Avatar"
                                class="w-24 h-24 rounded-full object-cover
                                    border border-gray-300 dark:border-gray-700"
                            />
                            <div
                                class="absolute inset-0 rounded-full
                                    bg-black/50 flex items-center justify-center
                                    text-white text-sm font-medium
                                    opacity-0 group-hover:opacity-100
                                    transition"
                            >
                                Đổi ảnh
                            </div>
                        </label>
                        <input
                            type="file"
                            id="avatar"
                            accept="image/*"
                            class="hidden"
                            onchange="previewAvatar(event)"
                        />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="full-name">Họ và
                                tên</label>
                            <input
                                class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary focus:ring-primary"
                                id="full_name" name="full-name" type="text" value="" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                for="email">Email</label>
                            <input
                                class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary focus:ring-primary"
                                id="email" name="email" type="email" value="" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="phone-number">Số
                                điện thoại</label>
                            <input
                                class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary focus:ring-primary"
                                id="phone_number" name="phone-number" type="tel" value="" />
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-800 flex items-center justify-end gap-4">
                        <button
                            class="px-5 py-2.5 text-sm font-semibold rounded-lg text-gray-800 dark:text-gray-200 bg-gray-200/50 dark:bg-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors"
                            type="button">Hủy</button>
                        <button id="cf_update_infor"
                            class="px-5 py-2.5 text-sm font-semibold rounded-lg text-black bg-primary hover:bg-opacity-90 transition-colors"
                            type="button">Lưu thay đổi</button>
                    </div>
                </form>
                <div class="mt-10 pt-6 border-t border-gray-200 dark:border-gray-800">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Đổi mật khẩu</h3>
                    <form action="#" class="space-y-4 mt-4" method="POST">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                for="current-password">Mật khẩu hiện tại</label>
                            <input
                                class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary focus:ring-primary"
                                id="current_password" name="current_password" type="password" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="new-password">Mật
                                khẩu mới</label>
                            <input
                                class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary focus:ring-primary"
                                id="new_password" name="new_password" type="password" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                for="confirm-password">Xác nhận mật khẩu mới</label>
                            <input
                                class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary focus:ring-primary"
                                id="confirm_password" name="confirm_password" type="password" />
                        </div>
                        <div class="pt-2 flex items-center justify-end">
                            <button id="cf_update_password"
                                class="px-5 py-2.5 text-sm font-semibold rounded-lg text-black bg-primary hover:bg-opacity-90 transition-colors"
                                type="button">Cập nhật mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewAvatar(event) {
        const input = event.target;

        if (!input.files || !input.files[0]) return;

        const file = input.files[0];

        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('avatarPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
    
    function getUser(){
        const id = sessionStorage.getItem('id');
        const token = getCookie('user_token');
        $.ajax({
            url: "/api/user/" + id,
            type: 'GET',
            contentType: 'application/json',
            headers: {
                Authorization: "Bearer " + token
            },
            success: function (response) {
                $('#full_name').val(response.data.name);
                $('#email').val(response.data.email);
                $('#phone_number').val(response.data.phone);

                if (response.data.avatar) {
                    $('#avatarPreview').attr(
                        'src',
                        '/storage/' + response.data.avatar
                    );
                } else {
                    $('#avatarPreview').attr(
                        'src',
                        'https://i.pravatar.cc/150?img=3'
                    );
                }
            },
            error: function (xhr) {
                if (xhr.status === 401) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Phiên đăng nhập hết hạn',
                        text: 'Vui lòng đăng nhập lại',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Xoá session & cookie
                    sessionStorage.clear();
                    document.cookie = 'user_token=; path=/; max-age=0';

                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 1500);
                }

                if (xhr.status === 404) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Không tìm thấy người dùng'
                    });
                }

                if (xhr.status === 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi hệ thống',
                        text: 'Vui lòng thử lại sau'
                    });
                }
            }
        });
    }

    function updateUser(){
        const id = sessionStorage.getItem('id');
        const token = getCookie('user_token');
        const formData = new FormData();
            formData.append('email', $('#email').val());
            formData.append('name', $('#full_name').val());
            formData.append('phone', $('#phone_number').val());

            const avatarFile = $('#avatar')[0].files[0];
            if (avatarFile) {
                formData.append('avatar', avatarFile);
            }
        $.ajax({
            url: "/api/user/" + id,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                Authorization: "Bearer " + token
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Cập nhật thành công',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                });

                setTimeout(() => {
                    getUser();
                }, 1500);
            },
            error: function (xhr) {
                if (xhr.status === 401) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Phiên đăng nhập hết hạn',
                        text: 'Vui lòng đăng nhập lại',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Xoá session & cookie
                    sessionStorage.clear();
                    document.cookie = 'user_token=; path=/; max-age=0';

                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 1500);
                }

                if (xhr.status === 404) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Không tìm thấy người dùng'
                    });
                }

                if (xhr.status === 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi hệ thống',
                        text: 'Vui lòng thử lại sau'
                    });
                }
            }
        });
    }

    function updatePassword(){
        const id = sessionStorage.getItem('id');
        const token = getCookie('user_token');
        const data = {
            current_password: $('#current_password').val(),
            new_password: $('#new_password').val(),
            confirm_password: $('#confirm_password').val(),
        };
        $.ajax({
            url: "/api/user/update-pass/" + id,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            headers: {
                Authorization: "Bearer " + token
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Cập nhật thành công',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                });

                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            },
            error: function (xhr) {
                if (xhr.status === 401) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Phiên đăng nhập hết hạn',
                        text: 'Vui lòng đăng nhập lại',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Xoá session & cookie
                    sessionStorage.clear();
                    document.cookie = 'user_token=; path=/; max-age=0';

                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 1500);
                }

                if (xhr.status === 404) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Không tìm thấy người dùng'
                    });
                }

                if (xhr.status === 400) {
                    Swal.fire({
                        icon: 'error',
                        title: xhr.responseJSON.message
                    });
                }

                if (xhr.status === 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi hệ thống',
                        text: 'Vui lòng thử lại sau'
                    });
                }
            }
        });
    }

    $('#cf_update_infor').on('click', function(e){
        e.preventDefault();
        updateUser();
    })

    $('#cf_update_password').on('click', function(e){
        e.preventDefault();
        updatePassword();
    })

    $(document).ready(function () {
        getUser();
    });
</script>
@endsection