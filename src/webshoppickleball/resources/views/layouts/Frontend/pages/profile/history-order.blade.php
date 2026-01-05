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
        @include('layouts.Frontend.widget.__menu_profile')
        <!-- Main Content Area -->
        <div class="flex-1">
            <div class="layout-content-container flex flex-col max-w-5xl mx-auto flex-1 gap-6">
                <div class="flex flex-wrap justify-between items-baseline gap-4">
                    <p class="text-zinc-900 dark:text-zinc-50 text-4xl font-black leading-tight tracking-[-0.033em]">Lịch sử đơn
                        hàng</p>
                </div>
                <div class="pb-3">
                    <div class="flex border-b border-primary/20 gap-4 sm:gap-8 overflow-x-auto">
                        <a id="btn_all_orders" class="flex flex-col items-center justify-center border-b-[3px] border-b-primary text-zinc-900 dark:text-zinc-50 pb-[13px] pt-4 whitespace-nowrap px-2"
                            href="#">
                            <p class="text-sm font-bold leading-normal tracking-[0.015em]">Tất cả</p>
                        </a>
                        <a id="btn_all_orders_pendding" class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-zinc-500 dark:text-zinc-400 hover:text-primary pb-[13px] pt-4 whitespace-nowrap px-2"
                            href="#">
                            <p class="text-sm font-bold leading-normal tracking-[0.015em]">Chờ xử lý</p>
                        </a>
                        <a id="btn_all_orders_delivering" class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-zinc-500 dark:text-zinc-400 hover:text-primary pb-[13px] pt-4 whitespace-nowrap px-2"
                            href="#">
                            <p class="text-sm font-bold leading-normal tracking-[0.015em]">Đang giao</p>
                        </a>
                        <a id="btn_all_orders_complete" class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-zinc-500 dark:text-zinc-400 hover:text-primary pb-[13px] pt-4 whitespace-nowrap px-2"
                            href="#">
                            <p class="text-sm font-bold leading-normal tracking-[0.015em]">Đã giao</p>
                        </a>
                        <a id="btn_all_orders_cancel" class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-zinc-500 dark:text-zinc-400 hover:text-primary pb-[13px] pt-4 whitespace-nowrap px-2"
                            href="#">
                            <p class="text-sm font-bold leading-normal tracking-[0.015em]">Đã hủy</p>
                        </a>
                    </div>
                </div>
                <div class="@container">
                    <div id="order_table_container"
                        class="flex overflow-hidden rounded-xl border border-primary/20 bg-background-light dark:bg-background-dark">
                        <table class="w-full">
                            <thead class="hidden lg:table-header-group">
                                <tr class="bg-primary/10">
                                    <th class="px-6 py-3 text-left text-zinc-900 dark:text-zinc-50 text-sm font-medium leading-normal">
                                        Mã đơn hàng
                                    </th>
                                    <th class="px-6 py-3 text-left text-zinc-900 dark:text-zinc-50 text-sm font-medium leading-normal">
                                        Ngày đặt
                                    </th>
                                    <th class="px-6 py-3 text-left text-zinc-900 dark:text-zinc-50 text-sm font-medium leading-normal">
                                        Tổng tiền
                                    </th>
                                    <th class="px-6 py-3 text-left text-zinc-900 dark:text-zinc-50 text-sm font-medium leading-normal">
                                        Trạng thái
                                    </th>
                                    <th class="px-6 py-3 text-right text-zinc-900 dark:text-zinc-50 text-sm font-medium leading-normal">
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="order_table_body" class="divide-y divide-primary/20 grid lg:table-row-group gap-4 p-4 lg:p-0">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function formatPrice(price) {
        if (!price) return '0';
        const integerPart = price.toString().split('.')[0];
        return integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function getAllOrders(status) {
        const userId = sessionStorage.getItem('id');
        status = status ?? '';
        $.ajax({
            url: '/api/order/user',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getCookie('user_token')
            },
            data: { user_id: userId, status: status },
            beforeSend: function () {
                showLoader();
            },
            success: function(response) {
                Swal.close();
                
                // Div bao quanh bảng
                const container = $('#order_table_container');

                // 1. Kiểm tra nếu không có dữ liệu
                if (!response.data || response.data.length === 0) {
                    container.removeClass('border bg-background-light dark:bg-background-dark'); // Xóa viền/nền bảng cũ nếu muốn
                    container.html(`
                        <div class="flex flex-col items-center justify-center text-center gap-6 py-16 px-6 rounded-xl bg-primary/10 dark:bg-primary/20 w-full">
                            <div class="text-primary text-5xl">
                                <span class="material-symbols-outlined !text-5xl">shopping_bag</span>
                            </div>
                            <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-50">Bạn chưa có đơn hàng nào.</h3>
                            <p class="text-zinc-600 dark:text-zinc-400 max-w-sm">Có vẻ như bạn chưa đặt bất kỳ sản phẩm nào. Hãy bắt đầu khám phá bộ sưu tập đồ pickleball tuyệt vời của chúng tôi!</p>
                            <a href="/shop" class="flex items-center justify-center rounded-lg h-12 px-8 bg-primary text-zinc-900 text-base font-bold leading-normal">
                                Bắt đầu mua sắm
                            </a>
                        </div>
                    `);
                    return;
                }

                // 2. Nếu có dữ liệu, render cấu trúc bảng
                container.addClass('border bg-background-light dark:bg-background-dark'); // Đảm bảo có style bảng
                container.html(`
                    <table class="w-full">
                        <thead class="hidden lg:table-header-group">
                            <tr class="bg-primary/10">
                                <th class="px-6 py-3 text-left text-zinc-900 dark:text-zinc-50 text-sm font-medium">Mã đơn hàng</th>
                                <th class="px-6 py-3 text-left text-zinc-900 dark:text-zinc-50 text-sm font-medium">Ngày đặt</th>
                                <th class="px-6 py-3 text-left text-zinc-900 dark:text-zinc-50 text-sm font-medium">Tổng tiền</th>
                                <th class="px-6 py-3 text-left text-zinc-900 dark:text-zinc-50 text-sm font-medium">Trạng thái</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody id="order_table_body" class="divide-y divide-primary/20 grid lg:table-row-group gap-4 p-4 lg:p-0">
                        </tbody>
                    </table>
                `);

                // 3. Render từng dòng đơn hàng vào tbody vừa tạo
                const tableBody = $('#order_table_body');
                response.data.forEach(order => {
                    tableBody.append(`
                        <tr class="grid grid-cols-2 lg:table-row gap-x-4 gap-y-2 p-4 lg:p-0 rounded-lg lg:rounded-none bg-primary/5 dark:bg-primary/10 lg:bg-transparent lg:dark:bg-transparent">
                            <td class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-900 dark:text-zinc-50 text-sm font-medium">#${order.id}</td>
                            <td class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-600 dark:text-zinc-300 text-sm font-normal">
                                ${new Date(order.created_at).toLocaleDateString('en-GB')}
                            </td>
                            <td class="text-right lg:text-left lg:px-6 lg:py-4 text-zinc-600 dark:text-zinc-300 text-sm font-normal">
                                ${formatPrice(order.total)}đ
                            </td>
                            <td class="text-right lg:text-left lg:px-6 lg:py-4 text-sm font-normal">
                                ${renderStatusBadge(order.status)}
                            </td>
                            <td class="col-span-2 lg:col-span-1 lg:px-6 lg:py-4 text-right">
                                <a class="text-primary font-bold text-sm hover:underline" href="/chi-tiet-don-hang/${order.id}">Xem chi tiết</a>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function(error) {
                Swal.close();
                Swal.fire('Lỗi', 'Không thể tải danh sách đơn hàng', 'error');
            },
            complete: function () {
                hideLoader();
            }
        });
    }

    function renderStatusBadge(status) {
        let statusText = '';
        let statusClass = '';
        switch (status) {
            case 'pending':
                statusText = 'Chờ xử lý';
                statusClass = 'bg-yellow-200 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-100';
                break;
            case 'delivering':
                statusText = 'Đang giao';
                statusClass = 'bg-blue-200 dark:bg-blue-800 text-blue-800 dark:text-blue-100';
                break;
            case 'complete':
                statusText = 'Đã giao';
                statusClass = 'bg-green-200 dark:bg-green-800 text-green-800 dark:text-green-100';
                break;
            case 'cancel':
                statusText = 'Đã hủy';
                statusClass = 'bg-red-200 dark:bg-red-800 text-red-800 dark:text-red-100';
                break;
            default:
                statusText = status;
                statusClass = 'bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-100';
        }
        return `<span class="inline-flex items-center justify-center rounded-full h-7 px-3 text-xs font-semibold ${statusClass}">${statusText}</span>`;
    }

    // --- Tab Switching Logic (Thêm active class cho đẹp) ---
    $('.flex.border-b a').click(function(e) {
        e.preventDefault();
        // Reset all tabs
        $('.flex.border-b a').removeClass('border-b-primary text-zinc-900 dark:text-zinc-50').addClass('border-b-transparent text-zinc-500 dark:text-zinc-400');
        // Set active tab
        $(this).addClass('border-b-primary text-zinc-900 dark:text-zinc-50').removeClass('border-b-transparent text-zinc-500 dark:text-zinc-400');
    });

    $(document).ready(function() {
        getAllOrders();
    });

    $('#btn_all_orders').click(function(){ getAllOrders(''); });
    $('#btn_all_orders_pendding').click(function(){ getAllOrders('pending'); });
    $('#btn_all_orders_delivering').click(function(){ getAllOrders('delivering'); });
    $('#btn_all_orders_complete').click(function(){ getAllOrders('complete'); });
    $('#btn_all_orders_cancel').click(function(){ getAllOrders('cancel'); });
</script>
@endsection