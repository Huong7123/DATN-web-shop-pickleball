@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div class="flex flex-wrap gap-2 mb-8">
        <a class="text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary text-sm font-medium"
            href="/">Trang chủ</a>
        <span class="text-gray-500 dark:text-gray-400 text-sm font-medium">/</span>
        <span class="text-gray-900 dark:text-white text-sm font-medium">Lịch sử đơn hàng</span>
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
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/20 transition-colors" href="/lich-su-don-hang">
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
            <div class="layout-content-container flex flex-col max-w-5xl mx-auto flex-1 gap-6">
                <div class="flex flex-wrap justify-between items-baseline gap-4">
                    <p class="text-zinc-900 dark:text-zinc-50 text-4xl font-black leading-tight tracking-[-0.033em]">Lịch sử đơn
                        hàng</p>
                </div>
                <div class="pb-3">
                    <div class="flex border-b border-primary/20 gap-4 sm:gap-8 overflow-x-auto">
                        <a class="flex flex-col items-center justify-center border-b-[3px] border-b-primary text-zinc-900 dark:text-zinc-50 pb-[13px] pt-4 whitespace-nowrap px-2"
                            href="#">
                            <p class="text-sm font-bold leading-normal tracking-[0.015em]">Tất cả</p>
                        </a>
                        <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-zinc-500 dark:text-zinc-400 hover:text-primary pb-[13px] pt-4 whitespace-nowrap px-2"
                            href="#">
                            <p class="text-sm font-bold leading-normal tracking-[0.015em]">Chờ xử lý</p>
                        </a>
                        <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-zinc-500 dark:text-zinc-400 hover:text-primary pb-[13px] pt-4 whitespace-nowrap px-2"
                            href="#">
                            <p class="text-sm font-bold leading-normal tracking-[0.015em]">Đang giao</p>
                        </a>
                        <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-zinc-500 dark:text-zinc-400 hover:text-primary pb-[13px] pt-4 whitespace-nowrap px-2"
                            href="#">
                            <p class="text-sm font-bold leading-normal tracking-[0.015em]">Đã giao</p>
                        </a>
                        <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-zinc-500 dark:text-zinc-400 hover:text-primary pb-[13px] pt-4 whitespace-nowrap px-2"
                            href="#">
                            <p class="text-sm font-bold leading-normal tracking-[0.015em]">Đã hủy</p>
                        </a>
                    </div>
                </div>
                <div class="@container">
                    <div
                        class="flex overflow-hidden rounded-xl border border-primary/20 bg-background-light dark:bg-background-dark">
                        <table class="w-full">
                            <thead class="hidden lg:table-header-group">
                                <tr class="bg-primary/10">
                                    <th class="px-6 py-3 text-left text-zinc-900 dark:text-zinc-50 text-sm font-medium leading-normal">
                                        Mã đơn hàng</th>
                                    <th class="px-6 py-3 text-left text-zinc-900 dark:text-zinc-50 text-sm font-medium leading-normal">
                                        Ngày đặt</th>
                                    <th class="px-6 py-3 text-left text-zinc-900 dark:text-zinc-50 text-sm font-medium leading-normal">
                                        Tổng tiền</th>
                                    <th class="px-6 py-3 text-left text-zinc-900 dark:text-zinc-50 text-sm font-medium leading-normal">
                                        Trạng thái</th>
                                    <th class="px-6 py-3 text-right text-zinc-900 dark:text-zinc-50 text-sm font-medium leading-normal">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-primary/20 grid lg:table-row-group gap-4 p-4 lg:p-0">
                                <tr
                                    class="grid grid-cols-2 lg:table-row gap-x-4 gap-y-2 p-4 lg:p-0 rounded-lg lg:rounded-none bg-primary/5 dark:bg-primary/10 lg:bg-transparent lg:dark:bg-transparent">
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Mã đơn hàng</td>
                                    <td
                                        class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-900 dark:text-zinc-50 text-sm font-medium leading-normal">
                                        #PB-10385</td>
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Ngày đặt</td>
                                    <td
                                        class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-600 dark:text-zinc-300 text-sm font-normal leading-normal">
                                        05/07/2024</td>
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Tổng tiền</td>
                                    <td
                                        class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-600 dark:text-zinc-300 text-sm font-normal leading-normal">
                                        4,500,000đ</td>
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Trạng thái</td>
                                    <td class="text-right lg:text-left lg:px-6 lg:py-4 text-sm font-normal leading-normal">
                                        <span
                                            class="inline-flex items-center justify-center rounded-full h-7 px-3 bg-green-200 dark:bg-green-800 text-green-800 dark:text-green-100 text-xs font-semibold">Đã
                                            giao</span>
                                    </td>
                                    <td class="col-span-2 lg:col-span-1 lg:px-6 lg:py-4 text-right">
                                        <a class="text-primary font-bold text-sm tracking-[0.015em] hover:underline" href="#">Xem chi
                                            tiết</a>
                                    </td>
                                </tr>
                                <tr
                                    class="grid grid-cols-2 lg:table-row gap-x-4 gap-y-2 p-4 lg:p-0 rounded-lg lg:rounded-none bg-primary/5 dark:bg-primary/10 lg:bg-transparent lg:dark:bg-transparent">
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Mã đơn hàng</td>
                                    <td
                                        class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-900 dark:text-zinc-50 text-sm font-medium leading-normal">
                                        #PB-10384</td>
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Ngày đặt</td>
                                    <td
                                        class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-600 dark:text-zinc-300 text-sm font-normal leading-normal">
                                        03/07/2024</td>
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Tổng tiền</td>
                                    <td
                                        class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-600 dark:text-zinc-300 text-sm font-normal leading-normal">
                                        1,250,000đ</td>
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Trạng thái</td>
                                    <td class="text-right lg:text-left lg:px-6 lg:py-4 text-sm font-normal leading-normal">
                                        <span
                                            class="inline-flex items-center justify-center rounded-full h-7 px-3 bg-blue-200 dark:bg-blue-800 text-blue-800 dark:text-blue-100 text-xs font-semibold">Đang
                                            giao</span>
                                    </td>
                                    <td class="col-span-2 lg:col-span-1 lg:px-6 lg:py-4 text-right">
                                        <a class="text-primary font-bold text-sm tracking-[0.015em] hover:underline" href="#">Xem chi
                                            tiết</a>
                                    </td>
                                </tr>
                                <tr
                                    class="grid grid-cols-2 lg:table-row gap-x-4 gap-y-2 p-4 lg:p-0 rounded-lg lg:rounded-none bg-primary/5 dark:bg-primary/10 lg:bg-transparent lg:dark:bg-transparent">
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Mã đơn hàng</td>
                                    <td
                                        class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-900 dark:text-zinc-50 text-sm font-medium leading-normal">
                                        #PB-10382</td>
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Ngày đặt</td>
                                    <td
                                        class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-600 dark:text-zinc-300 text-sm font-normal leading-normal">
                                        01/07/2024</td>
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Tổng tiền</td>
                                    <td
                                        class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-600 dark:text-zinc-300 text-sm font-normal leading-normal">
                                        3,750,000đ</td>
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Trạng thái</td>
                                    <td class="text-right lg:text-left lg:px-6 lg:py-4 text-sm font-normal leading-normal">
                                        <span
                                            class="inline-flex items-center justify-center rounded-full h-7 px-3 bg-yellow-200 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-100 text-xs font-semibold">Chờ
                                            xử lý</span>
                                    </td>
                                    <td class="col-span-2 lg:col-span-1 lg:px-6 lg:py-4 text-right">
                                        <a class="text-primary font-bold text-sm tracking-[0.015em] hover:underline" href="#">Xem chi
                                            tiết</a>
                                    </td>
                                </tr>
                                <tr
                                    class="grid grid-cols-2 lg:table-row gap-x-4 gap-y-2 p-4 lg:p-0 rounded-lg lg:rounded-none bg-primary/5 dark:bg-primary/10 lg:bg-transparent lg:dark:bg-transparent">
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Mã đơn hàng</td>
                                    <td
                                        class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-900 dark:text-zinc-50 text-sm font-medium leading-normal">
                                        #PB-10381</td>
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Ngày đặt</td>
                                    <td
                                        class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-600 dark:text-zinc-300 text-sm font-normal leading-normal">
                                        28/06/2024</td>
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Tổng tiền</td>
                                    <td
                                        class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-600 dark:text-zinc-300 text-sm font-normal leading-normal">
                                        890,000đ</td>
                                    <td class="lg:hidden text-zinc-500 dark:text-zinc-400 text-sm font-medium">Trạng thái</td>
                                    <td class="text-right lg:text-left lg:px-6 lg:py-4 text-sm font-normal leading-normal">
                                        <span
                                            class="inline-flex items-center justify-center rounded-full h-7 px-3 bg-red-200 dark:bg-red-800 text-red-800 dark:text-red-100 text-xs font-semibold">Đã
                                            hủy</span>
                                    </td>
                                    <td class="col-span-2 lg:col-span-1 lg:px-6 lg:py-4 text-right">
                                        <a class="text-primary font-bold text-sm tracking-[0.015em] hover:underline" href="#">Xem chi
                                            tiết</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div
                    class="flex flex-col items-center justify-center text-center gap-6 py-16 px-6 rounded-xl bg-primary/10 dark:bg-primary/20">
                    <div class="text-primary text-5xl">
                        <span class="material-symbols-outlined !text-5xl">shopping_bag</span>
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-50">Bạn chưa có đơn hàng nào.</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 max-w-sm">Có vẻ như bạn chưa đặt bất kỳ sản phẩm nào. Hãy bắt đầu
                        khám phá bộ sưu tập đồ pickleball tuyệt vời của chúng tôi!</p>
                    <button
                        class="flex items-center justify-center rounded-lg h-12 px-8 bg-primary text-zinc-900 text-base font-bold leading-normal">
                        Bắt đầu mua sắm
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection