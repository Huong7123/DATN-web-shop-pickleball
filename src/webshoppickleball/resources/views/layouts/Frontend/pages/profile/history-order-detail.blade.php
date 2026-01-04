@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="flex-1 px-4 sm:px-10 lg:px-20 py-8">
    <div class="layout-content-container flex flex-col max-w-6xl mx-auto flex-1 gap-6">
        <div class="flex flex-wrap gap-2 text-sm">
            <a class="text-primary text-sm font-medium leading-normal hover:underline" href="/">Trang chủ</a>
            <span class="text-zinc-400 dark:text-zinc-500">/</span>
            <a class="text-primary text-sm font-medium leading-normal hover:underline" href="/lich-su-don-hang">Lịch sử đơn hàng</a>
            <span class="text-zinc-400 dark:text-zinc-500">/</span>
            <span class="text-zinc-900 dark:text-zinc-50 font-medium">Chi tiết đơn hàng</span>
        </div>
        <div class="flex flex-wrap justify-between items-end gap-4 border-b border-primary/20 pb-6">
            <div class="flex flex-col gap-1">
                <div class="flex items-center gap-3">
                    <h1
                        class="text-zinc-900 dark:text-zinc-50 text-3xl font-black leading-tight tracking-[-0.033em]">
                        Đơn hàng #{{ $order->id }}</h1>
                    <span class="inline-flex items-center justify-center rounded-full h-7 px-3 text-xs font-semibold 
                        @switch($order->status)
                            @case('pending') bg-yellow-200 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-100 @break
                            @case('delivering') bg-blue-200 dark:bg-blue-800 text-blue-800 dark:text-blue-100 @break
                            @case('complete') bg-green-200 dark:bg-green-800 text-green-800 dark:text-green-100 @break
                            @case('cancel') bg-red-200 dark:bg-red-800 text-red-800 dark:text-red-100 @break
                            @default bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-100
                        @endswitch">
                        
                        @switch($order->status)
                            @case('pending') Chờ xử lý @break
                            @case('delivering') Đang giao @break
                            @case('complete') Đã giao @break
                            @case('cancel') Đã hủy @break
                            @default {{ $order->status }}
                        @endswitch
                    </span>
                </div>
                <div class="flex items-center gap-2 text-zinc-500 dark:text-zinc-400 text-sm">
                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                    <span>Ngày đặt hàng: {{ $order->created_at->format('d/m/Y H:i:s') }}</span>
                </div>
            </div>
            <!-- <div class="flex gap-3">
                <button
                    class="flex items-center gap-2 px-4 py-2 text-sm font-bold text-zinc-700 dark:text-zinc-300 bg-transparent border border-zinc-300 dark:border-zinc-700 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800">
                    <span class="material-symbols-outlined text-[18px]">print</span>
                    In hóa đơn
                </button>
                <button
                    class="flex items-center gap-2 px-4 py-2 text-sm font-bold text-zinc-900 bg-primary rounded-lg hover:bg-primary/90">
                    <span class="material-symbols-outlined text-[18px]">refresh</span>
                    Mua lại
                </button>
            </div> -->
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 flex flex-col gap-6">
                <div
                    class="rounded-xl border border-primary/20 bg-white dark:bg-zinc-900/40 overflow-hidden">
                    <div class="bg-primary/10 px-6 py-4 border-b border-primary/20">
                        <h3 class="text-zinc-900 dark:text-zinc-50 font-bold text-lg">Danh sách sản phẩm
                        </h3>
                    </div>
                    <div class="p-0">
                        <table class="w-full text-left border-collapse">
                            <thead class="hidden sm:table-header-group">
                                <tr
                                    class="text-zinc-500 dark:text-zinc-400 text-sm border-b border-primary/20">
                                    <th class="px-6 py-3 font-medium">Sản phẩm</th>
                                    <th class="px-6 py-3 font-medium text-right">Giá</th>
                                    <th class="px-6 py-3 font-medium text-center">SL</th>
                                    <th class="px-6 py-3 font-medium text-right">Tạm tính</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-primary/20">
                                @foreach($order->items as $item)
                                    @php
                                        $product = $item->product;
                                        $images = json_decode($product->image, true);
                                        $mainImage = !empty($images) ? $images[0] : null;
                                    @endphp
                                    <tr class="group hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div class="w-16 h-16 rounded-lg bg-zinc-200 dark:bg-zinc-800 flex items-center justify-center overflow-hidden">
                                                    @if($mainImage)
                                                        <img src="{{ asset('storage/' . $mainImage) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                                    @else
                                                        <span class="material-symbols-outlined text-zinc-400">sports_tennis</span>
                                                    @endif
                                                </div>
                                                
                                                <div>
                                                    <p class="text-zinc-900 dark:text-zinc-50 font-bold text-sm">
                                                        {{ $product->name }}
                                                    </p>
                                                    <p class="text-zinc-500 dark:text-zinc-400 text-xs">
                                                        @if($product->attributeValues->isNotEmpty())
                                                            {{ $product->attributeValues->pluck('name')->implode(' - ') }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4 text-right">
                                            <span class="sm:hidden text-xs text-zinc-500 mr-1">Giá:</span>
                                            <span class="text-zinc-900 dark:text-zinc-50 font-medium text-sm">
                                                {{ number_format($item->price, 0, '.', ',') }}đ
                                            </span>
                                        </td>
                                        
                                        <td class="px-6 py-4 text-center">
                                            <span class="sm:hidden text-xs text-zinc-500 mr-1">SL:</span>
                                            <span class="text-zinc-900 dark:text-zinc-50 text-sm">
                                                {{ $item->quantity }}
                                            </span>
                                        </td>
                                        
                                        <td class="px-6 py-4 text-right">
                                            <span class="sm:hidden text-xs text-zinc-500 mr-1">Tổng:</span>
                                            <span class="text-primary font-bold text-sm">
                                                {{ number_format($item->price * $item->quantity, 0, '.', ',') }}đ
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div
                        class="rounded-xl border border-primary/20 bg-white dark:bg-zinc-900/40 p-6 flex flex-col gap-4">
                        <div class="flex items-center gap-3 border-b border-primary/20 pb-3">
                            <div
                                class="size-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">local_shipping</span>
                            </div>
                            <h3 class="text-zinc-900 dark:text-zinc-50 font-bold text-lg">Thông tin giao
                                hàng</h3>
                        </div>
                        <div class="flex flex-col gap-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-zinc-500 dark:text-zinc-400">Người nhận:</span>
                                <span class="text-zinc-900 dark:text-zinc-50 font-medium text-right">{{ $order->user_name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-zinc-500 dark:text-zinc-400">Số điện thoại:</span>
                                <span class="text-zinc-900 dark:text-zinc-50 font-medium text-right">{{ $order->user_phone }}</span>
                            </div>
                            <div class="flex justify-between items-start gap-4">
                                <span class="text-zinc-500 dark:text-zinc-400 whitespace-nowrap">Địa
                                    chỉ:</span>
                                <span class="text-zinc-900 dark:text-zinc-50 font-medium text-right">{{ $order->address }}</span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="rounded-xl border border-primary/20 bg-white dark:bg-zinc-900/40 p-6 flex flex-col gap-4">
                        <div class="flex items-center gap-3 border-b border-primary/20 pb-3">
                            <div
                                class="size-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">payments</span>
                            </div>
                            <h3 class="text-zinc-900 dark:text-zinc-50 font-bold text-lg">Thanh toán</h3>
                        </div>
                        <div class="flex flex-col gap-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-zinc-500 dark:text-zinc-400">Phương thức:</span>
                                <span class="text-zinc-900 dark:text-zinc-50 font-medium text-right">
                                    @if($order->payment_method === 'cod')
                                        Thanh toán khi nhận hàng
                                    @elseif($order->payment_method === 'vnpay')
                                        Ví điện tử (VNPay)
                                    @else
                                        {{ $order->payment_method }}
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-zinc-500 dark:text-zinc-400">Trạng thái:</span>
                                <span class="text-right font-bold {{ $order->payment_status === 'paid' ? 'text-green-600' : 'text-red-600' }}">
                                    @if($order->payment_status === 'paid')
                                        Đã thanh toán
                                    @else
                                        Chưa thanh toán
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-6">
                <div class="rounded-xl border border-primary/20 bg-white dark:bg-zinc-900/40 p-6 sticky top-24">
                    <h3 class="text-zinc-900 dark:text-zinc-50 font-bold text-lg mb-6">Tổng giá trị đơn hàng</h3>
                    
                    <div class="flex flex-col gap-4 text-sm border-b border-primary/20 pb-6 mb-6">
                        <div class="flex justify-between">
                            <span class="text-zinc-500 dark:text-zinc-400">Tạm tính ({{ $order->items->sum('quantity') }} sản phẩm)</span>
                            <span class="text-zinc-900 dark:text-zinc-50 font-medium">
                                {{ number_format($order->items->sum(fn($item) => $item->price * $item->quantity), 0, '.', ',') }}đ
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-zinc-500 dark:text-zinc-400">Phí vận chuyển</span>
                            <span class="text-zinc-900 dark:text-zinc-50 font-medium">
                                {{ $order->shipping_fee > 0 ? number_format($order->shipping_fee, 0, '.', ',') . 'đ' : 'Miễn phí' }}
                            </span>
                        </div>

                        @if($order->discount > 0)
                        <div class="flex justify-between">
                            <span class="text-zinc-500 dark:text-zinc-400">Giảm giá</span>
                            <span class="text-primary font-medium">-{{ number_format($order->discount, 0, '.', ',') }}đ</span>
                        </div>
                        @endif
                    </div>

                    <div class="flex justify-between items-end mb-2">
                        <span class="text-zinc-900 dark:text-zinc-50 font-bold text-base">Tổng cộng</span>
                        <span class="text-primary font-black text-2xl">
                            {{ number_format($order->total, 0, '.', ',') }}đ
                        </span>
                    </div>
                    <!-- <button class="w-full flex items-center justify-center rounded-lg h-12 bg-primary text-zinc-900 text-base font-bold hover:bg-primary/90 transition-colors">
                        Liên hệ hỗ trợ
                    </button> -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection