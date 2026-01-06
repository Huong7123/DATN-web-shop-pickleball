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
                            @if($order->description != '')
                                <div class="flex justify-between items-start gap-4">
                                    <span class="text-zinc-500 dark:text-zinc-400 whitespace-nowrap">Ghi chú:</span>
                                    <span class="text-zinc-900 dark:text-zinc-50 font-medium text-right">{{ $order->description }}</span>
                                </div>
                            @endif
                            @if($order->status === 'pending')
                                <button id="edit_order_btn" class="w-full flex items-center justify-center rounded-lg h-12 bg-primary text-[#0d1b12] font-bold text-base tracking-wide hover:bg-[#10d652] transition-all shadow-lg shadow-primary/25 text-base font-bold transition-all">
                                    Thay đổi địa chỉ
                                </button>
                            @endif
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
                    @if($order->status === 'pending')
                        <button data-id="{{ $order->id }}" id="cancel_order_btn" class="w-full flex items-center justify-center rounded-lg h-12 bg-red-200 dark:bg-red-800 text-zinc-900 text-base font-bold hover:bg-red-300 transition-all">
                            Huỷ đơn hàng
                        </button>
                    @endif
                </div>
            </div>
        </div>
        <div id="modal_edit_address" class="bg-background-light dark:bg-background-dark font-display antialiased text-slate-900 dark:text-white hidden">
            <div class="relative min-h-screen w-full flex flex-col items-center pt-20 overflow-hidden">
                <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
                    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
                    <div
                        class="relative flex flex-col w-full max-w-[680px] max-h-[90vh] bg-white dark:bg-background-dark rounded-2xl shadow-2xl ring-1 ring-white/10 overflow-hidden animate-in zoom-in-95 duration-200 ease-out">
                        <div
                            class="flex items-center justify-between px-6 py-5 border-b border-border-light dark:border-border-dark">
                            <h3
                                class="text-xl font-bold leading-tight tracking-[-0.015em] text-text-main-light dark:text-text-main-dark">
                                Chỉnh sửa địa chỉ giao hàng
                            </h3>
                            <button class="btn-close-modal-edit-address group p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                                type="button">
                                <span
                                    class="material-symbols-outlined text-gray-500 dark:text-gray-400 group-hover:text-gray-800 dark:group-hover:text-white">close</span>
                            </button>
                        </div>
                        <div class="flex-1 overflow-y-auto p-6 space-y-5">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <div class="flex-1 flex flex-col gap-1.5">
                                    <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_name">
                                        Tên người nhận <span class="text-red-500">*</span>
                                    </label>
                                    <input id="user_name_edit" type="text" placeholder="Nhập tên" value="{{ $order->user_name }}"
                                        class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                                </div>
                                <div class="flex-1 flex flex-col gap-1.5">
                                    <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_phone">
                                        Số điện thoại <span class="text-red-500">*</span>
                                    </label>
                                    <input id="user_phone_edit" type="text" placeholder="Nhập SĐT" value="{{ $order->user_phone }}"
                                        class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_address">
                                    Địa chỉ: <span class="text-red-500">*</span>
                                </label>
                                <input id="user_address_edit" type="text" placeholder="Nhập số nhà, tên đường" value="{{ $order->address }}"
                                    class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_address">
                                    Ghi chú:
                                </label>
                                <input id="user_description_edit" type="text" placeholder="Ghi chú cho nhân viên giao hàng" value="{{ $order->description }}"
                                    class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                            </div>
                        </div>
                        <!-- Footer -->
                        <div
                            class="flex items-center justify-end gap-3 px-6 py-5 border-t border-border-light dark:border-border-dark bg-gray-50/50 dark:bg-black/20">
                            <button
                                class="btn-close-modal-edit-address rounded-lg px-5 py-2.5 text-sm font-bold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/10 hover:text-gray-800 dark:hover:text-white transition-all"
                                type="button">
                                Hủy bỏ
                            </button>
                            <button id="btn_update_address" data-id="{{$order->id}}"
                                class="flex items-center gap-2 rounded-lg bg-primary px-6 py-2.5 text-sm font-bold text-[#0d1b12] shadow-sm hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all"
                                type="button">
                                <span class="material-symbols-outlined text-[18px]">save</span>
                                Lưu địa chỉ
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function updateOrder(orderId, status, name, phone, address, description){
        const data = {
            ...(status  != null ? { status } : {}),
            ...(name    != null ? { user_name: name } : {}),
            ...(phone   != null ? { user_phone: phone } : {}),
            ...(address != null ? { address } : {}),
            ...(description != null ? { description } : {})
        };
        const doRequest = () => {
            $.ajax({
                url: '/api/order/' + orderId,
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + getCookie('user_token'),
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify(data),
                beforeSend: function() {
                    showLoader();
                },
                success: function () {
                    Swal.fire({
                        icon: 'success',
                        title: status != null 
                            ? 'Huỷ đơn hàng thành công' 
                            : 'Cập nhật đơn hàng thành công',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => location.href = '/lich-su-don-hang');
                },
                error: function (xhr) {
                    Swal.fire('Lỗi', xhr.responseJSON?.message ?? 'Không thể cập nhật đơn hàng!', 'error');
                },
                complete: function() {
                    hideLoader();
                }
            });
        };
        // CHỈ status mới confirm
        if (status != null) {
            Swal.fire({
                title: 'Xác nhận huỷ đơn?',
                text: 'Bạn có chắc chắn muốn huỷ đơn hàng này?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có, huỷ đơn',
                cancelButtonText: 'Không',
                reverseButtons: true
            }).then(res => {
                if (res.isConfirmed) doRequest();
            });
        } else {
            doRequest();
        }
    }

    $('#cancel_order_btn').on('click', function() {
        const orderId = $(this).data('id');
        const status = 'cancel';
        updateOrder(orderId,status);
    });

    $('#edit_order_btn').on('click', function() {
        $('#modal_edit_address').show();
    });

    $('.btn-close-modal-edit-address').on('click', function() {
        $('#modal_edit_address').hide();
        $('#modal_edit_address').hide();
    });

    $('#btn_update_address').on('click', function() {
        const orderId = $(this).data('id');
        const name = $('#user_name_edit').val();
        const phone = $('#user_phone_edit').val();
        const address = $('#user_address_edit').val();
        const description = $('#user_description_edit').val();
        if (!name || !phone || !address) {
            Swal.fire({
                icon: 'warning',
                title: 'Thiếu thông tin',
                text: 'Vui lòng nhập đầy đủ họ tên, số điện thoại và địa chỉ!'
            });
            return;
        }
        updateOrder(orderId, null, name, phone, address, description);
    });
</script>
@endsection