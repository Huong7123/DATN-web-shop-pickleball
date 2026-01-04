@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8" style="display: flex;justify-content: center;">
    <div class="w-full max-w-md space-y-8">
        <!-- PageHeading -->
        <div class="flex flex-col gap-3 text-center">
            <p class="text-text-light dark:text-text-dark text-4xl font-black leading-tight tracking-[-0.033em]">Đặt lại mật khẩu</p>
        </div>
        <div class="flex flex-col gap-6">
            <!-- TextField with Icon -->
            <div class="flex flex-col">
                <label class="text-text-light dark:text-text-dark text-base font-medium leading-normal pb-2" for="email">Mật khẩu mới</label>
                <div class="relative">
                    <span
                        class="material-symbols-outlined pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-text-muted-light dark:text-text-muted-dark">password</span>
                    <input
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-light dark:text-text-dark focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/40 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark/50 h-14 placeholder:text-text-muted-light dark:placeholder:text-text-muted-dark p-4 pl-12 text-base font-normal leading-normal transition-shadow"
                        id="password" placeholder="Nhập mật khẩu mới" />
                    <div class="error" id="password-error"></div>
                </div>
            </div>
            <div class="flex flex-col">
                <label class="text-text-light dark:text-text-dark text-base font-medium leading-normal pb-2" for="email">Xác nhận mật khẩu</label>
                <div class="relative">
                    <span
                        class="material-symbols-outlined pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-text-muted-light dark:text-text-muted-dark">password</span>
                    <input
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-light dark:text-text-dark focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/40 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark/50 h-14 placeholder:text-text-muted-light dark:placeholder:text-text-muted-dark p-4 pl-12 text-base font-normal leading-normal transition-shadow"
                        id="confirmPassword" placeholder="Nhập lại mật khẩu" />
                    <div class="error" id="password_confirmation-error"></div>
                </div>
            </div>
            <!-- SingleButton -->
            <div class="flex">
                <button id="forgot_btn"
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 flex-1 bg-primary text-text-light text-base font-bold leading-normal tracking-[0.015em] hover:bg-opacity-90 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-background-light dark:focus-visible:ring-offset-background-dark">
                    <span class="truncate">Cập nhật</span>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    function resetPassword() {
        const data = {
            email: sessionStorage.getItem('email'),
            password: $('#password').val(),
            password_confirmation: $('#confirmPassword').val(),
        };
        $.ajax({
            url: "/api/reset-password",
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            beforeSend: function () {
                showLoader(); // HIỆN LOADER
            },
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: "Đặt lại mật khẩu thành công!",
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true,
                    willClose: () => {
                        window.location.href = "/dang-nhap";
                    }
                });
            },
            error: function (xhr, status, error) {
                Swal.close();
                if (xhr.status === 422) {
                    console.log(xhr.responseJSON);
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, messages) {
                        $(`#${key}-error`).text(messages[0]);
                    });
                }
                console.log(xhr.responseText);
            },
            complete: function () {
                hideLoader(); // TẮT LOADER
            }
        });
    }

    $(document).on('click', '#reset_btn', function (event) {
        event.preventDefault();
        $('.error').text('');
        resetPassword();
    });
</script>
@endsection