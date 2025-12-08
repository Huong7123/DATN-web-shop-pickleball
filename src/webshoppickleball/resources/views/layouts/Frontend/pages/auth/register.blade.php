@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8" style="display: flex;justify-content: center;">
    <div class="relative flex min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="flex-grow">
            <div class="flex flex-wrap lg:flex-nowrap min-h-screen">
                <div
                    class="w-full lg:w-1/2 flex flex-col items-center justify-center p-6 sm:p-8 md:p-12 bg-background-light dark:bg-background-dark">
                    <div class="w-full max-w-md space-y-8">
                        <div>
                            <div class="flex min-w-72 flex-col gap-3 mb-8">
                                <p class="text-[#0d1b12] dark:text-gray-100 text-4xl font-black leading-tight tracking-tight">Tạo tài
                                    khoản</p>
                            </div>
                        </div>
                        <form class="space-y-6">
                            <div>
                                <label class="flex flex-col">
                                    <p class="text-[#0d1b12] dark:text-gray-200 text-base font-medium leading-normal pb-2">Họ và tên
                                        <label style="color: red;">*</label>
                                    </p>
                                    <input id="name"
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d1b12] dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-[#cfe7d7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary/50 h-14 placeholder:text-gray-400 dark:placeholder-gray-500 p-[15px] text-base font-normal leading-normal"
                                        placeholder="Họ và tên" value="" />
                                    <div class="error" id="name-error"></div>
                                </label>
                            </div>
                            <div>
                                <label class="flex flex-col">
                                    <p class="text-[#0d1b12] dark:text-gray-200 text-base font-medium leading-normal pb-2">Số điện thoại
                                        <label style="color: red;">*</label>    
                                    </p>
                                    <input id="phone"
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d1b12] dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-[#cfe7d7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary/50 h-14 placeholder:text-gray-400 dark:placeholder-gray-500 p-[15px] text-base font-normal leading-normal"
                                        placeholder="Số điện thoại" value="" />
                                    <div class="error" id="phone-error"></div>
                                </label>
                            </div>
                            <div>
                                <label class="flex flex-col">
                                    <p class="text-[#0d1b12] dark:text-gray-200 text-base font-medium leading-normal pb-2">Email
                                        <label style="color: red;">*</label>
                                    </p>
                                    <input id="email"
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d1b12] dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-[#cfe7d7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary/50 h-14 placeholder:text-gray-400 dark:placeholder-gray-500 p-[15px] text-base font-normal leading-normal"
                                        placeholder="Email" type="email" value="" />
                                    <div class="error" id="email-error"></div>
                                </label>
                            </div>
                            <div>
                                <label class="flex flex-col">
                                    <p class="text-[#0d1b12] dark:text-gray-200 text-base font-medium leading-normal pb-2">Mật khẩu
                                        <label style="color: red;">*</label>
                                    </p>
                                    <div class="flex w-full flex-1 items-stretch rounded-lg">
                                        <input id="password"
                                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-l-lg text-[#0d1b12] dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-[#cfe7d7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary/50 h-14 placeholder:text-gray-400 dark:placeholder-gray-500 p-[15px] border-r-0 pr-2 text-base font-normal leading-normal"
                                            placeholder="Mật khẩu" type="password" value="" />
                                        <button id="togglePassword"
                                            class="text-[#4c9a66] dark:text-gray-400 flex border border-[#cfe7d7] dark:border-gray-700 bg-background-light dark:bg-background-dark items-center justify-center px-4 rounded-r-lg border-l-0 hover:bg-primary/10 focus:outline-none focus:ring-2 focus:ring-primary/50"
                                            type="button">
                                            <span class="material-symbols-outlined" data-icon="Eye">visibility</span>
                                        </button>
                                    </div>
                                    <div class="error" id="password-error"></div>
                                </label>
                            </div>
                            <div>
                                <label class="flex flex-col">
                                    <p class="text-[#0d1b12] dark:text-gray-200 text-base font-medium leading-normal pb-2">Xác nhận mật khẩu
                                        <label style="color: red;">*</label>
                                    </p>
                                    <div class="flex w-full flex-1 items-stretch rounded-lg">
                                        <input id="confirmPassword"
                                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-l-lg text-[#0d1b12] dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-[#cfe7d7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary/50 h-14 placeholder:text-gray-400 dark:placeholder-gray-500 p-[15px] border-r-0 pr-2 text-base font-normal leading-normal"
                                            placeholder="Nhập lại mật khẩu" type="password" value="" />
                                        <button id="toggleConfirmPassword"
                                            class="text-[#4c9a66] dark:text-gray-400 flex border border-[#cfe7d7] dark:border-gray-700 bg-background-light dark:bg-background-dark items-center justify-center px-4 rounded-r-lg border-l-0 hover:bg-primary/10 focus:outline-none focus:ring-2 focus:ring-primary/50"
                                            type="button">
                                            <span class="material-symbols-outlined" data-icon="Eye">visibility</span>
                                        </button>
                                    </div>
                                    <div class="error" id="password_confirmation-error"></div>
                                </label>
                            </div>
                            <div>
                                <button id="register_btn"
                                    class="flex w-full justify-center rounded-lg bg-primary px-4 py-4 text-base font-bold leading-6 text-black shadow-sm hover:bg-primary/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors duration-200"
                                    type="submit">
                                    Đăng Ký Ngay
                                </button>
                            </div>
                        </form>
                        <div class="border-t border-[#cfe7d7] dark:border-gray-700 pt-6">
                            <p class="text-center text-sm text-[#0d1b12] dark:text-gray-300">
                                Đã có tài khoản?
                                <a class="font-semibold leading-6 text-primary hover:text-primary/90" href="/dang-nhap">Đăng nhập</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:flex w-1/2 items-center justify-center p-6 relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-200 to-emerald-400 dark:from-green-900 dark:to-emerald-800 opacity-20">
                    </div>
                    <img class="relative w-full h-full max-h-[90vh] object-cover rounded-xl shadow-2xl"
                        data-alt="A person in sportswear hitting a pickleball with a paddle on a court, captured in a dynamic action shot that conveys the energy of the sport."
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAZqcXmP6Htb2RR_wPkPuI06eLI_bXIHYiao5WWdzbOpsGcVzIhidS4QN00c-DHT54h5E6bB09tvYYsjg-MgIIQPb-dILAjIdKyW6tS4_132UOuEsHEOafoQHLqBYxJXtfViF4c2hezY9AZQ6F46GCzE3yj4D4Gypifynm4mAWvQrg_tVluatxi7H40HmZ7_nxJTQPpabfZr5_J1LthKamxsfdtqn6aNh4WdrmZILtGirRxh8E6shZfnAqymU74p25IE7KkPVCVnAOx" />
                </div>
            </div>
        </div>
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
    $("#toggleConfirmPassword").on("click", function () {
        const input = $("#confirmPassword");
        const icon = $(this).find("span");

        if (input.attr("type") === "password") {
            input.attr("type", "text");
            icon.text("visibility_off");
        } else {
            input.attr("type", "password");
            icon.text("visibility");
        }
    });

    function register() {
        const data = {
            name: $('#name').val(),
            phone: $('#phone').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            password_confirmation: $('#confirmPassword').val(),
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
            url: "/api/register",
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (response) {
                sessionStorage.setItem('email', email.value);
                Swal.close();
                Swal.fire({
                    icon: "success",
                    title: "Đăng ký thành công!",
                    text: "Vui lòng kiểm tra email để xác minh tài khoản.",
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true,
                }).then(() => {
                    window.location.href = "/xac-minh-otp";
                });
            },
            error: function (xhr, status, error) {
                Swal.close();
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, messages) {
                        if (key === "password" && messages[0].includes("Mật khẩu xác nhận không khớp")) {
                            $("#password_confirmation-error").text(messages[0]);
                        } else {
                            $(`#${key}-error`).text(messages[0]);
                        }
                    });
                }
            }
        });
    }

    $(document).on('click', '#register_btn', function (event) {
        event.preventDefault();
        $('.error').text('');
        register();
    });
</script>
@endsection