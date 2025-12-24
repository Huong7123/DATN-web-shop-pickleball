
@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8" style="display: flex;justify-content: center;">
    <div class="relative z-10 flex w-full max-w-md flex-col items-center">
        <!-- Login Card -->
        <div
            class="w-full rounded-xl border border-border-light bg-foreground-light p-8 shadow-lg dark:border-border-dark dark:bg-foreground-dark">
            <div class="text-center">
                <h1 class="text-3xl font-bold tracking-tight text-text-light dark:text-text-dark">Đăng nhập</h1>
            </div>
            <form class="mt-8 space-y-6">
                <!-- Email Input -->
                <div>
                    <label class="flex flex-col">
                        <p class="pb-2 text-sm font-medium text-text-light dark:text-text-dark">Email</p>
                        <input id="email"
                            class="form-input h-12 w-full resize-none rounded-lg border border-border-light bg-transparent p-3 text-base text-text-light placeholder:text-placeholder-light focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/40 dark:border-border-dark dark:text-text-dark dark:placeholder:text-placeholder-dark dark:focus:border-primary"
                            placeholder="Nhập email hoặc tên đăng nhập" type="email" value="" />
                        <div class="error" id="email_error"></div>
                    </label>
                </div>
                <!-- Password Input -->
                <div>
                    <label class="flex flex-col">
                        <div class="flex items-center justify-between pb-2">
                            <p class="text-sm font-medium text-text-light dark:text-text-dark">Mật khẩu</p>
                            <a class="text-sm font-medium text-primary hover:underline" href="/quen-mat-khau">Quên mật khẩu?</a>
                        </div>
                        <div class="relative flex w-full items-center">
                            <input id="password"
                                class="form-input h-12 w-full resize-none rounded-lg border border-border-light bg-transparent p-3 pr-10 text-base text-text-light placeholder:text-placeholder-light focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/40 dark:border-border-dark dark:text-text-dark dark:placeholder:text-placeholder-dark dark:focus:border-primary"
                                placeholder="Nhập mật khẩu của bạn" type="password" value="" />
                            <div class="error" id="password_error"></div>
                            <button id="togglePassword"
                                class="absolute right-3 text-text-light/60 hover:text-text-light dark:text-text-dark/60 dark:hover:text-text-dark"
                                type="button" style="display: flex;">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                        </div>
                    </label>
                </div>
                <!-- Login Button -->
                <button id="login_btn"
                    class="flex h-12 w-full cursor-pointer items-center justify-center rounded-lg bg-primary px-4 text-base font-bold text-background-dark transition-opacity hover:opacity-90">
                    <span class="truncate">Đăng nhập</span>
                </button>
            </form>
        </div>
        <!-- Sign Up Link -->
        <p class="mt-8 text-center text-sm text-text-light dark:text-text-dark">
            Chưa có tài khoản?
            <a class="font-bold text-primary hover:underline" href="/dang-ky">Đăng ký ngay</a>
        </p>
    </div>
</div>
<script>
    $("#togglePassword").on("click", function () {
        const input = $("#password");
        const icon = $(this).find("span");

        if (input.attr("type") === "password") {
            input.attr("type", "text");
            icon.text("visibility_off");
        } else {
            input.attr("type", "password");
            icon.text("visibility");
        }
    });
    function login() {
        const data = {
            email: $('#email').val(),
            password: $('#password').val(),
        };
        Swal.fire({
            title: 'Đang xử lý...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            onOpen: () => {
                swal.showLoading();
            }
        });
        $.ajax({
            url: "/api/login",
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (response) {
                sessionStorage.setItem('email', response.data.user.email);
                sessionStorage.setItem('name', response.data.user.name);
                sessionStorage.setItem('avatar', response.data.user.avatar);
                sessionStorage.setItem('id', response.data.user.id);
                if(response.data.user.role == 1){
                    document.cookie = `user_token=${response.data.access_token}; path=/; max-age=10800;`;
                    Swal.close();
                    setTimeout(() => {
                        window.location.href = "/";
                    }, 200);
                } else{
                    document.cookie = `admin_token=${response.data.access_token}; path=/; max-age=10800;`;
                    Swal.close();
                    setTimeout(() => {
                        window.location.href = "/admin/quan-ly-san-pham";
                    }, 200);
                }  
            },
            error: function (xhr, status, error) {
                Swal.close();
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, messages) {
                        $(`#${key}_error`).text(messages[0]);
                    });
                }
                if (xhr.status === 400) {
                    Swal.fire({
                        icon: "error",
                        title: "Đăng nhập thất bại!",
                        text: xhr.responseJSON.message,
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                    })
                }
            }
        });
    }

    $(document).on('click', '#login_btn', function (event) {
        event.preventDefault();
        $('.error').text('');
        login();
    });
</script>
@endsection