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
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/20 transition-colors" href="/thong-tin-ca-nhan">
                        <span class="material-symbols-outlined fill text-gray-900 dark:text-white">person</span>
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Thông tin cá nhân</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/20 transition-colors" href="/lich-su-don-hang">
                        <span class="material-symbols-outlined text-gray-700 dark:text-gray-300">receipt_long</span>
                        <p class="text-sm font-medium">Lịch sử đơn hàng</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/20 transition-colors" href="/dia-chi-giao-hang">
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
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="full-name">Họ và
                                tên</label>
                            <input
                                class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary focus:ring-primary"
                                id="full-name" name="full-name" type="text" value="Nguyễn Văn A" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                for="email">Email</label>
                            <input
                                class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary focus:ring-primary"
                                id="email" name="email" type="email" value="nva@email.com" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="phone-number">Số
                                điện thoại</label>
                            <input
                                class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary focus:ring-primary"
                                id="phone-number" name="phone-number" type="tel" value="0987654321" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="birth-date">Ngày
                                sinh</label>
                            <input
                                class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary focus:ring-primary"
                                id="birth-date" name="birth-date" type="date" value="1990-01-01" />
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-800 flex items-center justify-end gap-4">
                        <button
                            class="px-5 py-2.5 text-sm font-semibold rounded-lg text-gray-800 dark:text-gray-200 bg-gray-200/50 dark:bg-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors"
                            type="button">Hủy</button>
                        <button
                            class="px-5 py-2.5 text-sm font-semibold rounded-lg text-black bg-primary hover:bg-opacity-90 transition-colors"
                            type="submit">Lưu thay đổi</button>
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
                                id="current-password" name="current-password" type="password" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="new-password">Mật
                                khẩu mới</label>
                            <input
                                class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary focus:ring-primary"
                                id="new-password" name="new-password" type="password" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                for="confirm-password">Xác nhận mật khẩu mới</label>
                            <input
                                class="form-input block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-background-light dark:bg-background-dark focus:border-primary focus:ring-primary"
                                id="confirm-password" name="confirm-password" type="password" />
                        </div>
                        <div class="pt-2 flex items-center justify-end">
                            <button
                                class="px-5 py-2.5 text-sm font-semibold rounded-lg text-black bg-primary hover:bg-opacity-90 transition-colors"
                                type="submit">Cập nhật mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection