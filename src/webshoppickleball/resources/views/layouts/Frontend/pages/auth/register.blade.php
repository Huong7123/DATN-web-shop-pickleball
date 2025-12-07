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
                                    khoản Pickleball Pro</p>
                                <p class="text-[#4c9a66] dark:text-gray-300 text-base font-normal leading-normal">Tham gia cộng đồng và
                                    nhận những ưu đãi độc quyền cho dụng cụ pickleball.</p>
                            </div>
                        </div>
                        <form class="space-y-6">
                            <div>
                                <label class="flex flex-col">
                                    <p class="text-[#0d1b12] dark:text-gray-200 text-base font-medium leading-normal pb-2">Tên người dùng
                                    </p>
                                    <input
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d1b12] dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-[#cfe7d7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary/50 h-14 placeholder:text-[#4c9a66] dark:placeholder-gray-500 p-[15px] text-base font-normal leading-normal"
                                        placeholder="Nhập tên người dùng của bạn" value="" />
                                </label>
                            </div>
                            <div>
                                <label class="flex flex-col">
                                    <p class="text-[#0d1b12] dark:text-gray-200 text-base font-medium leading-normal pb-2">Email</p>
                                    <input
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d1b12] dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-[#cfe7d7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary/50 h-14 placeholder:text-[#4c9a66] dark:placeholder-gray-500 p-[15px] text-base font-normal leading-normal"
                                        placeholder="Nhập địa chỉ email của bạn" type="email" value="" />
                                </label>
                            </div>
                            <div>
                                <label class="flex flex-col">
                                    <p class="text-[#0d1b12] dark:text-gray-200 text-base font-medium leading-normal pb-2">Mật khẩu</p>
                                    <div class="flex w-full flex-1 items-stretch rounded-lg">
                                        <input
                                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-l-lg text-[#0d1b12] dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-[#cfe7d7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary/50 h-14 placeholder:text-[#4c9a66] dark:placeholder-gray-500 p-[15px] border-r-0 pr-2 text-base font-normal leading-normal"
                                            placeholder="Tạo mật khẩu" type="password" value="" />
                                        <button
                                            class="text-[#4c9a66] dark:text-gray-400 flex border border-[#cfe7d7] dark:border-gray-700 bg-background-light dark:bg-background-dark items-center justify-center px-4 rounded-r-lg border-l-0 hover:bg-primary/10 focus:outline-none focus:ring-2 focus:ring-primary/50"
                                            type="button">
                                            <span class="material-symbols-outlined" data-icon="Eye">visibility</span>
                                        </button>
                                    </div>
                                </label>
                            </div>
                            <div>
                                <label class="flex flex-col">
                                    <p class="text-[#0d1b12] dark:text-gray-200 text-base font-medium leading-normal pb-2">Xác nhận mật
                                        khẩu</p>
                                    <div class="flex w-full flex-1 items-stretch rounded-lg">
                                        <input
                                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-l-lg text-[#0d1b12] dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-primary/50 border border-[#cfe7d7] dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary/50 h-14 placeholder:text-[#4c9a66] dark:placeholder-gray-500 p-[15px] border-r-0 pr-2 text-base font-normal leading-normal"
                                            placeholder="Nhập lại mật khẩu" type="password" value="" />
                                        <button
                                            class="text-[#4c9a66] dark:text-gray-400 flex border border-[#cfe7d7] dark:border-gray-700 bg-background-light dark:bg-background-dark items-center justify-center px-4 rounded-r-lg border-l-0 hover:bg-primary/10 focus:outline-none focus:ring-2 focus:ring-primary/50"
                                            type="button">
                                            <span class="material-symbols-outlined" data-icon="Eye">visibility</span>
                                        </button>
                                    </div>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input
                                    class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary dark:bg-gray-800 dark:border-gray-600"
                                    id="terms" name="terms" type="checkbox" />
                                <label class="ml-2 block text-sm text-[#0d1b12] dark:text-gray-300" for="terms">Tôi đồng ý với <a
                                        class="font-medium text-primary hover:underline" href="#">Điều khoản Dịch vụ</a> &amp; <a
                                        class="font-medium text-primary hover:underline" href="#">Chính sách Bảo mật</a>.</label>
                            </div>
                            <div>
                                <button
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

@endsection