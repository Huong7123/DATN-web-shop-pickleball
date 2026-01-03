@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')

@php 
    $transaction = session('transaction');
@endphp
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
            <!-- <p class="text-slate-700 dark:text-slate-300 text-base font-normal leading-normal pt-6 pb-2">Một email xác
                nhận chi tiết đã được gửi đến địa chỉ <strong>customer@email.com</strong>.</p> -->
            <div
                class="text-center bg-primary/20 text-primary-darker dark:text-primary rounded-lg px-4 py-2 mt-4 text-lg font-bold tracking-wider">
                Mã đơn hàng: <span class="text-slate-900 dark:text-white">#{{ $transaction->order->id }}</span>
            </div>
        </div>
        <div class="border-t border-slate-200 dark:border-slate-800 my-8 md:my-10"></div>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <button id="back_to_shop"
                class="w-full sm:w-auto flex min-w-[180px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-slate-900 text-base font-bold leading-normal tracking-[0.015em] hover:bg-opacity-90 transition-opacity">
                <span class="truncate">Tiếp tục mua sắm</span>
            </button>
            <button id="view_order_history"
                class="w-full sm:w-auto flex min-w-[180px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary/20 text-slate-900 dark:text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/30 transition-colors">
                <span class="truncate">Xem lịch sử đơn hàng</span>
            </button>
        </div>
    </div>
</div>
<script>
    $('#back_to_shop').on('click', function() {
        window.location.href = "http://qhuong.webshoppickleball/san-pham";
    });
    $('#view_order_history').on('click', function() {
        window.location.href = "http://qhuong.webshoppickleball/lich-su-don-hang";
    });
</script>
@endsection