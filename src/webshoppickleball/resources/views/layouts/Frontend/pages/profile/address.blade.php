@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div class="flex flex-wrap gap-2 mb-8">
        <a class="text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary text-sm font-medium"
            href="/">Trang chủ</a>
        <span class="text-gray-500 dark:text-gray-400 text-sm font-medium">/</span>
        <span class="text-gray-900 dark:text-white text-sm font-medium">Sổ dịa chỉ</span>
    </div>
    <div class="flex flex-col md:flex-row gap-8 lg:gap-12">
        <!-- SideNavBar -->
        <aside class="w-full md:w-1/4 lg:w-1/5">
            <div class="flex flex-col gap-6">
                <div class="flex items-center gap-4">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-14"
                        data-alt="User avatar image"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAaTPEnhz8eFd2StKYpTaYrCGeL39mS4kBsVpxSNhqhX2LSNQ-ADFD5nZOMZNhmTuLPKVni_meoy0wZbgYyrqrRq11ieVDrn1wPrUfGxa6lkEyWQD1GxBC-a98Dc5U-4AUjV4nWHtxP6aszez1gWphw94OKxHoKQAsI_rkMHGHCXAFxVBbkmYMhIZGxn4KMTy4GI6F8hPFKZBP4WWFU31YxvOTlzqBn7rQ6BmR0tke1F8QwjQn0KjqzprKQwUiGdoQvg2GH6iiSmqFW");'>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-gray-900 dark:text-white text-base font-bold">Nguyễn Văn A</h1>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">nva@email.com</p>
                    </div>
                </div>
                <nav class="flex flex-col gap-2">
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/20 transition-colors" href="/thong-tin-ca-nhan">
                        <span class="material-symbols-outlined fill text-gray-900 dark:text-white">person</span>
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Thông tin cá nhân</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/20 transition-colors" href="/lich-su-don-hang">
                        <span class="material-symbols-outlined text-gray-700 dark:text-gray-300">receipt_long</span>
                        <p class="text-sm font-medium">Lịch sử đơn hàng</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/20 transition-colors" href="/dia-chi-giao-hang">
                        <span class="material-symbols-outlined text-gray-700 dark:text-gray-300">location_on</span>
                        <p class="text-sm font-medium">Địa chỉ giao hàng</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/20 mt-4 transition-colors"
                        href="/dang-xuat">
                        <span class="material-symbols-outlined text-red-500">logout</span>
                        <p class="text-sm font-medium text-red-500">Đăng xuất</p>
                    </a>
                </nav>
            </div>
        </aside>
        <!-- Main Content Area -->
        <div class="flex-1">
            <div class="layout-content-container flex flex-col w-full max-w-7xl flex-1 px-4 gap-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="flex min-w-72 flex-col">
                        <p class="text-[#0d1b12] dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">
                            Quản lý địa chỉ giao hàng</p>
                    </div>
                    <button
                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-5 bg-primary text-[#0d1b12] dark:text-background-dark gap-2 text-sm font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined">add</span>
                        <span class="truncate">Thêm địa chỉ mới</span>
                    </button>
                </div>
                <div class="grid grid-cols-1 gap-6 mt-4">
                    <div class="@container">
                        <div
                            class="flex flex-col items-stretch justify-start rounded-xl border border-primary/20 dark:border-primary/10 bg-background-light dark:bg-background-dark shadow-sm">
                            <div class="flex w-full grow flex-col items-stretch justify-center gap-2 p-6">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-[#0d1b12] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">Nguyễn
                                        Văn A - 0987654321</p>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-flex items-center rounded-full bg-primary/20 dark:bg-primary/10 px-3 py-1 text-xs font-semibold text-[#0d1b12] dark:text-primary">Mặc
                                            định</span>
                                    </div>
                                </div>
                                <p class="text-[#4c9a66] dark:text-gray-400 text-base font-normal leading-normal">Số 123, Đường ABC,
                                    Phường XYZ, Quận 1, Thành phố Hồ Chí Minh</p>
                                <div class="flex items-center gap-4 mt-3">
                                    <button
                                        class="flex cursor-pointer items-center justify-center gap-2 text-[#0d1b12] dark:text-gray-300 hover:text-primary dark:hover:text-primary text-sm font-medium leading-normal">
                                        <span class="material-symbols-outlined text-base">edit</span>
                                        <span class="truncate">Chỉnh sửa</span>
                                    </button>
                                    <button
                                        class="flex cursor-pointer items-center justify-center gap-2 text-[#4c9a66] dark:text-gray-400 hover:text-red-500 dark:hover:text-red-500 text-sm font-medium leading-normal">
                                        <span class="material-symbols-outlined text-base">delete</span>
                                        <span class="truncate">Xóa</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="@container">
                        <div
                            class="flex flex-col items-stretch justify-start rounded-xl border border-primary/10 dark:border-primary/10 bg-background-light dark:bg-background-dark shadow-sm">
                            <div class="flex w-full grow flex-col items-stretch justify-center gap-2 p-6">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-[#0d1b12] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">Trần
                                        Thị B - 0123456789</p>
                                </div>
                                <p class="text-[#4c9a66] dark:text-gray-400 text-base font-normal leading-normal">Số 456, Đường DEF,
                                    Phường GHI, Quận Ba Đình, Hà Nội</p>
                                <div class="flex items-center gap-4 mt-3">
                                    <button
                                        class="flex cursor-pointer items-center justify-center gap-2 text-[#0d1b12] dark:text-gray-300 hover:text-primary dark:hover:text-primary text-sm font-medium leading-normal">
                                        <span class="material-symbols-outlined text-base">edit</span>
                                        <span class="truncate">Chỉnh sửa</span>
                                    </button>
                                    <button
                                        class="flex cursor-pointer items-center justify-center gap-2 text-[#4c9a66] dark:text-gray-400 hover:text-red-500 dark:hover:text-red-500 text-sm font-medium leading-normal">
                                        <span class="material-symbols-outlined text-base">delete</span>
                                        <span class="truncate">Xóa</span>
                                    </button>
                                    <div class="flex-grow"></div>
                                    <button
                                        class="flex cursor-pointer items-center justify-center gap-2 text-primary dark:text-primary/90 hover:opacity-80 text-sm font-medium leading-normal">
                                        <span class="truncate">Đặt làm mặc định</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection