@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div class="flex flex-col gap-4">
        <div class="flex flex-wrap gap-2">
            <a class="text-gray-500 dark:text-gray-400 text-sm font-medium leading-normal" href="#">Trang chủ</a>
            <span class="text-gray-500 dark:text-gray-400 text-sm font-medium leading-normal">/</span>
            <span class="text-[#0d1b12] dark:text-white text-sm font-medium leading-normal">Liên hệ</span>
        </div>
        <div class="flex flex-wrap justify-between gap-3">
            <div class="flex min-w-72 flex-col gap-3">
                <p class="text-[#0d1b12] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Liên
                    Hệ Với Chúng Tôi</p>
                <p class="text-gray-600 dark:text-gray-300 text-base font-normal leading-normal">Chúng tôi luôn sẵn
                    sàng lắng nghe! Vui lòng liên hệ nếu bạn có bất kỳ câu hỏi hoặc góp ý nào.</p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">
        <div class="lg:col-span-2 flex flex-col gap-8">
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-4 bg-transparent min-h-[72px] justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="text-[#0d1b12] dark:text-white flex items-center justify-center rounded-lg bg-primary/20 dark:bg-primary/30 shrink-0 size-12">
                            <span class="material-symbols-outlined text-2xl">location_on</span>
                        </div>
                        <div class="flex flex-col justify-center">
                            <p class="text-[#0d1b12] dark:text-white text-base font-medium leading-normal line-clamp-1">Địa
                                chỉ cửa hàng</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-normal leading-normal line-clamp-2">123
                                Đường Pickleball, Quận 1, TP. Hồ Chí Minh</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4 bg-transparent min-h-14 justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="text-[#0d1b12] dark:text-white flex items-center justify-center rounded-lg bg-primary/20 dark:bg-primary/30 shrink-0 size-12">
                            <span class="material-symbols-outlined text-2xl">mail</span>
                        </div>
                        <div class="flex flex-col justify-center">
                            <p class="text-[#0d1b12] dark:text-white text-base font-medium leading-normal line-clamp-1">
                                Email</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-normal leading-normal line-clamp-2">
                                support@pickleballstore.vn</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4 bg-transparent min-h-14 justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="text-[#0d1b12] dark:text-white flex items-center justify-center rounded-lg bg-primary/20 dark:bg-primary/30 shrink-0 size-12">
                            <span class="material-symbols-outlined text-2xl">call</span>
                        </div>
                        <div class="flex flex-col justify-center">
                            <p class="text-[#0d1b12] dark:text-white text-base font-medium leading-normal line-clamp-1">Điện
                                thoại</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-normal leading-normal line-clamp-2">
                                (+84) 987 654 321</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aspect-video w-full overflow-hidden rounded-xl">
                <div class="h-full w-full bg-cover bg-center"
                    data-alt="A stylized map showing streets and locations within a city."
                    data-location="Ho Chi Minh City"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCnkyeSczEDdS68SsN4_ulUSJpxED6OaBCqPAMGKlteX-hIJpfUV4ZNpa9ZBUnTovkIcc5-1vK461_8at_ot0R2O5I3yAMX08Cq_ennW4eJhC8r4snpnoVbjMps6iN9W8FXKdEjd-xW7hK52ppuZaqjCwDTgmeIh_bPwEr7_PaECP-KnHcCmVB1hfO64AVqqUrRdIcKVlAruWvWNX1gKV-8oS0vMsV1N7rrnIKUxSxWqn-umsgo4A5iXhPmS0Gr_HxbNla58i9spKN7');">
                </div>
            </div>
        </div>
        <div
            class="lg:col-span-3 bg-white dark:bg-background-dark dark:border dark:border-primary/20 p-8 rounded-xl shadow-sm">
            <form class="flex flex-col gap-6">
                <p class="text-2xl font-bold text-[#0d1b12] dark:text-white">Gửi Tin Nhắn Cho Chúng Tôi</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300" for="name">Họ và Tên</label>
                        <input
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 px-4 py-2.5 text-[#0d1b12] dark:text-white placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary focus:ring-primary"
                            id="name" placeholder="Nhập họ và tên của bạn" type="text" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300" for="email">Email</label>
                        <input
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 px-4 py-2.5 text-[#0d1b12] dark:text-white placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary focus:ring-primary"
                            id="email" placeholder="Nhập địa chỉ email của bạn" type="email" />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300" for="subject">Tiêu đề</label>
                    <input
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 px-4 py-2.5 text-[#0d1b12] dark:text-white placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary focus:ring-primary"
                        id="subject" placeholder="Tiêu đề tin nhắn" type="text" />
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300" for="message">Nội dung tin
                        nhắn</label>
                    <textarea
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 px-4 py-2.5 text-[#0d1b12] dark:text-white placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary focus:ring-primary"
                        id="message" placeholder="Nội dung bạn muốn gửi đến chúng tôi..." rows="5"></textarea>
                </div>
                <button
                    class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-[#0d1b12] text-base font-bold leading-normal tracking-[0.015em] hover:bg-opacity-90 transition-colors"
                    type="submit">
                    <span class="truncate">Gửi Tin Nhắn</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection