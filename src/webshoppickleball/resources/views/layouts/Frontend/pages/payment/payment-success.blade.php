@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div
        class="max-w-4xl mx-auto bg-white dark:bg-slate-900/50 rounded-xl shadow-lg border border-slate-200 dark:border-slate-800 p-6 md:p-10">
        <div class="flex flex-col items-center text-center">
            <div class="flex items-center justify-center size-16 bg-primary rounded-full mb-6">
                <span class="material-symbols-outlined text-slate-900 text-4xl">check</span>
            </div>
            <div class="flex flex-col gap-3">
                <p class="text-slate-900 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Thanh toán
                    thành công!</p>
                <p class="text-slate-600 dark:text-slate-400 text-base font-normal leading-normal max-w-md">Cảm ơn bạn đã
                    mua hàng! Đơn hàng của bạn đang được xử lý và sẽ sớm được giao đến bạn.</p>
            </div>
            <p class="text-slate-700 dark:text-slate-300 text-base font-normal leading-normal pt-6 pb-2">Một email xác
                nhận chi tiết đã được gửi đến địa chỉ <strong>customer@email.com</strong>.</p>
            <div
                class="text-center bg-primary/20 text-primary-darker dark:text-primary rounded-lg px-4 py-2 mt-4 text-lg font-bold tracking-wider">
                Mã đơn hàng: <span class="text-slate-900 dark:text-white">#PKL10816</span>
            </div>
        </div>
        <div class="border-t border-slate-200 dark:border-slate-800 my-8 md:my-10"></div>
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <h2 class="text-slate-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-4">
                    Tóm tắt đơn hàng</h2>
                <div class="space-y-4">
                    <div class="flex items-center gap-4 py-2 justify-between">
                        <div class="flex items-center gap-4">
                            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-16"
                                data-alt="Carbon fiber pickleball paddle"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBdJNUlTNneyDM8LHlffYbmAsf3whmiUzkyRcqur3_Rgyplqln2YDzooMN9E0v_t4q2m-xSxXYuNtvErXOWwDo3wcQFAJCfxBjmKiiziOOn92KkfSjdFOLXHcn0edXnHrZRDl2z6he4SCkotobNhvvbsCr5X7bH9kpaC5eL94YObbSWPvqp1nxDePzji8FjBjnWn0xx2rJ6mKT7OL7Aj4E3Osmr7bdG9EHD6_hJq7V8j0mCVgjOHj_2K7h2RigI7k9dO09MJczHogJO");'>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">Vợt
                                    Pickleball Pro Carbon</p>
                                <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">Số
                                    lượng: 1</p>
                            </div>
                        </div>
                        <div class="shrink-0">
                            <p class="text-slate-900 dark:text-white text-base font-normal leading-normal">1.200.000₫</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 py-2 justify-between">
                        <div class="flex items-center gap-4">
                            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-16"
                                data-alt="Set of three yellow pickleballs"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDFzpjIpTWJzalVAkJg199yqLmeuVQYOi9TZle8jCvDx41paLpqQcL3sLwMCsd1dd5tfup4lQcyZlB1D6qK7IOwY9OEAzXYze0yEKqyb6Qjg2hH-iwuWgzs2O929xQIITYVtpWsM2fyFAzXQPB2YC-8HjY5vXOpnzt7aV14BSfTqe6CrxN_Vz3v5G-9y-99elOFgb1N2AZ2Xq2RYO0KJm0-Aj9IyoXiNfDKWQjmJgTkiRcTSIwUW9wvrHWognp_YQPZ67jRa87mM70B");'>
                            </div>
                            <div class="flex flex-col justify-center">
                                <p class="text-slate-900 dark:text-white text-base font-medium leading-normal line-clamp-1">Bóng
                                    Pickleball Pro-S4</p>
                                <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal line-clamp-2">Số
                                    lượng: 2</p>
                            </div>
                        </div>
                        <div class="shrink-0">
                            <p class="text-slate-900 dark:text-white text-base font-normal leading-normal">180.000₫</p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-slate-200 dark:border-slate-800 my-4"></div>
                <div class="space-y-2 text-sm text-slate-700 dark:text-slate-300">
                    <div class="flex justify-between"><span>Tạm tính</span><span>1.380.000₫</span></div>
                    <div class="flex justify-between"><span>Phí vận chuyển</span><span>30.000₫</span></div>
                    <div class="flex justify-between text-base font-bold text-slate-900 dark:text-white"><span>Tổng
                            cộng</span><span>1.410.000₫</span></div>
                </div>
            </div>
            <div>
                <h2 class="text-slate-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-4">
                    Thông tin giao hàng</h2>
                <div class="space-y-4 text-slate-700 dark:text-slate-300">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-xl text-primary mt-0.5">person</span>
                        <div>
                            <p class="font-semibold text-slate-800 dark:text-slate-200">Nguyễn Văn An</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-xl text-primary mt-0.5">home</span>
                        <div>
                            <p class="font-semibold text-slate-800 dark:text-slate-200">Địa chỉ giao hàng</p>
                            <p>123 Đường ABC, Phường X, Quận Y, TP. Hồ Chí Minh</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-xl text-primary mt-0.5">local_shipping</span>
                        <div>
                            <p class="font-semibold text-slate-800 dark:text-slate-200">Dự kiến giao hàng</p>
                            <p>Thứ Sáu, 24 tháng 5, 2024</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-slate-200 dark:border-slate-800 my-8 md:my-10"></div>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <button
                class="w-full sm:w-auto flex min-w-[180px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-slate-900 text-base font-bold leading-normal tracking-[0.015em] hover:bg-opacity-90 transition-opacity">
                <span class="truncate">Tiếp tục mua sắm</span>
            </button>
            <button
                class="w-full sm:w-auto flex min-w-[180px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary/20 text-slate-900 dark:text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/30 transition-colors">
                <span class="truncate">Xem lịch sử đơn hàng</span>
            </button>
        </div>
    </div>
</div>
@endsection