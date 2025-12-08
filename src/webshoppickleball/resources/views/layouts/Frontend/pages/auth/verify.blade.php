
@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8" style="display: flex;justify-content: center;">
    <div class="relative z-10 flex w-full max-w-md flex-col items-center">
        <!-- Login Card -->
        <div
            class="w-full rounded-xl border border-border-light bg-foreground-light p-8 shadow-lg dark:border-border-dark dark:bg-foreground-dark">
            <div class="text-center">
                <h1 class="text-3xl font-bold tracking-tight text-text-light dark:text-text-dark">Xác minh OTP</h1>
            </div>
            <form class="mt-8 space-y-6">
                <div>
                    <label class="flex flex-col">
                        <p class="text-[#0d1b12] dark:text-gray-200 text-base font-medium leading-normal pb-2">Mã OTP
                            <label style="color: red;">*</label>
                        </p>
                        <input id="otp"
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d1b12] dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-[#cfe7d7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary/50 h-14 placeholder:text-[#4c9a66] dark:placeholder-gray-500 p-[15px] text-base font-normal leading-normal"
                            placeholder="Nhập mã OTP" value="" />
                    </label>
                </div>
                <button id="confirm_btn"
                    class="flex h-12 w-full cursor-pointer items-center justify-center rounded-lg bg-primary px-4 text-base font-bold text-background-dark transition-opacity hover:opacity-90">
                    <span class="truncate">Xác minh</span>
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
    function active() {
        const data = {
            email: sessionStorage.getItem('email'),
            otp_code: $('#otp').val(),
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
            url: "/api/active",
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (response) {
                Swal.close();
                Swal.fire({
                    icon: "success",
                    title: "Xác thực tài khoản thành công!",
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true,
                }).then(() => {
                    window.location.href = "/dang-nhap";
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
            }
        });
    }

    $(document).on('click', '#confirm_btn', function (event) {
        event.preventDefault();
        $('.error').text('');
        active();
    });

</script>
@endsection