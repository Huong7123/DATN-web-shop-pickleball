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
        @include('layouts.Frontend.widget.__menu_profile')
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