@extends('layouts.Admin.master')
@section('title', $title)
@section('content')
<div class="w-full px-8 py-6 bg-background-light dark:bg-background-dark z-10">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 mb-4 items-center">
        <a class="text-text-secondary dark:text-gray-400 hover:text-primary font-medium flex items-center gap-1"
            href="/tong-quan">
            <span class="material-symbols-outlined text-[18px]">home</span>
            Tổng quan
        </a>
        <span class="text-text-secondary dark:text-gray-500">/</span>
        <span class="text-text-main dark:text-gray-200 text-sm font-medium">Đơn hàng</span>
    </div>
    <!-- Page Heading & Actions -->
    <div class="flex flex-wrap justify-between items-end gap-4">
        <div class="flex flex-col gap-1">
            <h1 class="text-text-main dark:text-white text-3xl font-black tracking-tight">Danh sách đơn hàng
            </h1>
        </div>
    </div>
    <!-- Filters & Search Toolbar -->
    <div
        class="mt-8 flex flex-wrap gap-4 items-center bg-surface-light dark:bg-surface-dark p-4 rounded-xl shadow-sm border border-[#e7f3eb] dark:border-gray-700">
        <!-- Search -->
        <label class="flex-1 min-w-[280px] relative group">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span
                    class="material-symbols-outlined text-text-secondary group-focus-within:text-primary transition-colors">search</span>
            </div>
            <input id="search_product"
                class="block w-full pl-10 pr-3 py-2.5 border border-[#cfe7d7] dark:border-gray-600 rounded-lg leading-5 bg-[#f8fcf9] dark:bg-gray-800 text-text-main dark:text-white focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm transition-all"
                placeholder="Tìm kiếm theo ID đơn hàng" type="search" />
        </label>
        <!-- Stock Status Filter -->
        <div class="relative min-w-[180px]">
            <select id="filter_status"
                class="w-full pl-4 pr-10 py-2.5 border border-[#cfe7d7] dark:border-gray-600 rounded-lg bg-[#f8fcf9] dark:bg-gray-800 text-text-main dark:text-white text-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary cursor-pointer">
                <option value="">Tất cả trạng thái</option>
                <option value="pending">Đơn đang xử lý</option>
                <option value="confirm">Đơn đã xác nhận</option>
                <option value="shipping">Đơn đang giao</option>
                <option value="complete">Đơn thành công</option>
                <option value="cancel">Đơn huỷ</option>
            </select>
        </div>
    </div>
</div>
<!-- Content Scroll Area -->
<div class="flex-1 overflow-y-auto px-8 pb-8">
    <!-- Data Table Container -->
    <div
        class="bg-surface-light dark:bg-surface-dark rounded-xl border border-[#e7f3eb] dark:border-gray-700 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-background-light dark:bg-white/5 border-b border-border-color dark:border-white/10">
                    <th class="p-4 w-12"></th> <!-- Expand toggle column -->
                    <th class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider">ID</th>
                    <th class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Khách hàng</th>
                    <th class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider">SĐT</th>
                    <th class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Địa chỉ</th>
                    <th
                        class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider">
                        Tổng tiền
                    </th>
                    <th
                        class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider">
                        Thanh toán
                    </th>
                    <th
                        class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider">
                        Trạng thái
                    </th>
                    <th
                        class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider">
                    </th>
                </tr>
            </thead>
            <tbody id="list_order_body" class="divide-y divide-border-color dark:divide-white/10">
                
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    @include('layouts.Admin.widget.__pagination')
</div>
<div id="exampleModalCenter" class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-x-hidden hidden overflow-y-auto bg-black/50 transition-opacity">
    <div class="relative w-full max-w-2xl bg-white dark:bg-gray-900 rounded-xl shadow-2xl flex flex-col transform transition-all">
        <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-800">
            <div class="flex items-center gap-4">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white">Thông tin vận chuyển</h5>
                <div id="order_status_badge">
                </div>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors" data-dismiss="modal">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-6 overflow-y-auto max-h-[70vh]">
            <form id="orderForm">
                <div class="mb-8">
                    <div class="flex items-center gap-2 mb-4">
                        <h6 class="text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400">Thông tin người bán</h6>
                    </div>
                    <div class="relative overflow-hidden rounded-2xl border border-blue-100 bg-gradient-to-br from-blue-50/50 to-white p-5 dark:border-blue-900/30 dark:from-blue-900/10 dark:to-gray-900 shadow-sm">
                        <div class="absolute -top-6 -right-6 h-16 w-16 bg-blue-500/5 rounded-full"></div>
                        <div class="flex flex-col md:flex-row md:items-center gap-6">
                            <div class="flex-shrink-0 flex items-center justify-center size-14 rounded-xl bg-blue-500 text-white shadow-lg shadow-blue-500/20">
                                <span class="material-symbols-outlined font-light" style="font-size: 32px;">storefront</span>
                            </div>
                            <div class="flex-grow grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                <div class="flex flex-col">
                                    <span class="text-[10px] uppercase font-bold text-blue-500/60 tracking-wider mb-0.5">Tên cửa hàng</span>
                                    <div id="shop_name" class="text-base font-bold text-gray-800 dark:text-gray-100 italic leading-tight">
                                        Pickleball Pro Store
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[10px] uppercase font-bold text-blue-500/60 tracking-wider mb-0.5">Liên hệ</span>
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm text-blue-500">call</span>
                                        <span id="shop_phone" class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            0396131469
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col md:col-span-2 border-t border-blue-100/50 dark:border-blue-800/50 pt-3">
                                    <span class="text-[10px] uppercase font-bold text-blue-500/60 tracking-wider mb-1 text-left">Địa chỉ kho lấy hàng</span>
                                    <div class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-sm text-blue-500 mt-0.5">location_on</span>
                                        <span id="shop_address" class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed text-left">
                                            Canh Nậu, Thạch Thất, Hà Nội  
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-8">
                    <div class="flex items-center gap-2 mb-4">
                        <h6 class="text-xs font-black uppercase tracking-widest text-green-600 dark:text-green-400">Thông tin người nhận</h6>
                    </div>
                    <div class="relative overflow-hidden rounded-2xl border border-green-100 bg-gradient-to-br from-green-50/50 to-white p-5 dark:border-green-900/30 dark:from-green-900/10 dark:to-gray-900 shadow-sm">
                        <div class="absolute -top-6 -right-6 h-16 w-16 bg-green-500/5 rounded-full"></div>
                        <div class="flex flex-col md:flex-row md:items-center gap-6">
                            <div class="flex-shrink-0 flex items-center justify-center size-14 rounded-xl bg-green-500 text-white shadow-lg shadow-green-500/20">
                                <span class="material-symbols-outlined font-light" style="font-size: 32px;">person_pin_circle</span>
                            </div>
                            <div class="flex-grow grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                <div class="flex flex-col">
                                    <span class="text-[10px] uppercase font-bold text-green-600/60 tracking-wider mb-0.5">Họ và tên</span>
                                    <div id="customer_name" class="text-base font-bold text-gray-800 dark:text-gray-100 leading-tight">
                                        </div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[10px] uppercase font-bold text-green-600/60 tracking-wider mb-0.5">Số điện thoại</span>
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm text-green-500">smartphone</span>
                                        <span id="customer_phone" class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            </span>
                                    </div>
                                </div>
                                <div class="flex flex-col md:col-span-2 border-t border-green-100/50 dark:border-green-800/50 pt-3 text-left">
                                    <span class="text-[10px] uppercase font-bold text-green-600/60 tracking-wider mb-1">Địa chỉ giao hàng</span>
                                    <div class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-sm text-green-500 mt-0.5">local_shipping</span>
                                        <span id="customer_address" class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="description" class="mb-6">
                    <div class="flex items-center gap-2 mb-4">
                        <h6 class="text-xs font-black uppercase tracking-widest text-amber-600 dark:text-amber-400">Lưu ý từ khách hàng</h6>
                    </div>
                    
                    <div class="relative overflow-hidden rounded-2xl border border-amber-200 bg-gradient-to-br from-amber-50 to-white p-5 dark:border-amber-900/30 dark:from-amber-900/10 dark:to-gray-900 shadow-sm">
                        <span class="absolute -top-2 -right-2 material-symbols-outlined text-amber-500/10" style="font-size: 80px;">format_quote</span>
                        
                        <div class="relative flex items-start gap-4">
                            <div class="flex-shrink-0 flex items-center justify-center size-10 rounded-lg bg-amber-500 text-white">
                                <span class="material-symbols-outlined text-xl">priority_high</span>
                            </div>

                            <div class="flex flex-col">
                                <span class="text-[10px] uppercase font-bold text-amber-600/70 tracking-wider mb-1 text-left">Lời nhắn:</span>
                                <p id="required_note" class="text-sm font-medium italic text-amber-900 dark:text-amber-200 leading-relaxed text-left">
                                    </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 dark:border-gray-800">
            <button type="button" class="px-5 py-2 text-sm font-bold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors" data-dismiss="modal">
                Hủy
            </button>
            <button id="btn_save_edit" data-next="DELIVERING" class="btn-update-status flex items-center gap-2 px-6 py-2 text-sm font-bold text-white bg-green-500 rounded-lg hover:bg-green-600 shadow-lg shadow-green-500/30 transition-all active:scale-95">
                Đang giao hàng 
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </button>
        </div>
    </div>
</div>

<script>
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';')[0];
        return null;
    }

    function formatPrice(price) {
        if (!price) return '0';

        // Ép về string → bỏ phần thập phân
        const integerPart = price.toString().split('.')[0];

        // Format dấu phẩy
        return integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    $(document).on('click', '.extension-btn', function () {
        const parentId = $(this).data('id');
        const parentRow = $(this).closest('tr');
        const variantRow = parentRow.next('.variant_wraper');
        const variantBody = variantRow.find('.variant_wraper_body');

        // toggle UI
        variantRow.toggleClass('hidden');
        $(this).find('.material-symbols-outlined').toggleClass('rotate-180');

        // chỉ load 1 lần
        if (variantRow.data('loaded')) return;

        //getAllChildProduct(parentId, variantBody, variantRow);
    });

    function getAllOrder(page = 1, orderId = null, status = null) {
        $.ajax({
            url: '/api/order',
            method: 'GET',
            data: {
                page: page,
                order_id: orderId,
                status: status
            },
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            beforeSend: function () {
                showLoader(); // HIỆN LOADER
            },
            success: function(res) {
                const pagination = res.data;
                currentPage = pagination.current_page;
                lastPage = pagination.last_page;

                $('#list_order_body').html('');
                pagination.data.forEach(order => {
                    $('#list_order_body').append(renderItems(order));
                });

                updatePaginationUI(pagination);

            },
            error: function(err) {
                Swal.close();
                console.error('Không thể tải danh sách sản phẩm:', err);
            },
            complete: function () {
                hideLoader(); // TẮT LOADER
            }
        });
    }

    function renderItems(order){
        return `
        <tr class="group hover:bg-primary/5 transition-colors">
            <td class="p-4 text-center">
                <button
                    class="extension-btn p-1 rounded-full hover:bg-white dark:hover:bg-gray-600 text-primary 
                        transition-transform duration-300">
                    <span class="material-symbols-outlined text-xl transition-transform duration-300">
                        expand_more
                    </span>
                </button>
            </td>
            <td class="p-4 font-mono">${order.id}</td>
            <td class="p-4">${order.user_name}</td>
            <td class="p-4">${order.user_phone}</td>
            <td class="p-4">${order.address}</td>
            <td class="p-4 font-bold">${formatPrice(order.total)}₫</td>
            <td class="p-4 uppercase">${order.payment_method}</td>
            <td class="p-4">
                ${renderOrderStatus(order.status)}
            </td>
            <td class="p-4">
                <div class="flex items-center justify-end gap-2">
                    <button data-id="${order.id}" 
                        data-status="${order.status}"
                        data-name="${order.user_name}"
                        data-phone="${order.user_phone}"
                        data-address="${order.address}"
                        data-description="${order.description}"
                        class="btn-edit p-1.5 rounded text-gray-400 hover:text-primary hover:bg-green-50 dark:hover:bg-gray-700 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">edit</span>
                    </button>
                </div>
            </td>
        </tr>
        <tr class="variant_wraper hidden bg-[#f8fcf9]">
            <td colspan="9" class="p-0">
                <div class="ml-[60px] my-2 border-l-4 border-primary">
                    <table class="w-full">
                        <thead class="bg-gray-50/50 dark:bg-gray-900/50">
                            <tr>
                                <th
                                    class="pl-4 py-2 text-[11px] font-semibold text-text-secondary uppercase text-left w-[25%]">
                                    Sản phẩm
                                </th>
                                <th
                                    class="pl-4 py-2 text-[11px] font-semibold text-text-secondary uppercase text-left w-[15%]">
                                    Giá
                                </th>
                                <th
                                    class="pl-4 py-2 text-[11px] font-semibold text-text-secondary uppercase text-left w-[15%]">
                                    Số lượng
                                </th>
                                <th
                                    class="pl-4 py-2 text-[11px] font-semibold text-text-secondary uppercase text-left w-[30%]">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="variant_wraper_body">${renderOrderItems(order.items)}</tbody>
                    </table>
                </div>
            </td>
        </tr>`;
    }

    function renderOrderStatus(status) {
        const map = {
            pending: {
                text: 'Chờ xử lý',
                cls: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-400',
                dot: 'bg-yellow-500'
            },
            confirm: {
                text: 'Đã xác nhận',
                cls: 'bg-blue-100 text-blue-800 dark:bg-blue-500/20 dark:text-blue-400',
                dot: 'bg-blue-500'
            },
            shipping: {
                text: 'Đang giao',
                cls: 'bg-indigo-100 text-indigo-800 dark:bg-indigo-500/20 dark:text-indigo-400',
                dot: 'bg-indigo-500'
            },
            complete: {
                text: 'Hoàn tất',
                cls: 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400',
                dot: 'bg-green-500'
            },
            cancel: {
                text: 'Đã huỷ',
                cls: 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400',
                dot: 'bg-red-500'
            }
        };

        const s = map[status] || {
            text: status,
            cls: 'bg-gray-100 text-gray-700',
            dot: 'bg-gray-400'
        };

        return `
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white ${s.cls}">
                ${s.text}
            </span>
        `;
    }


    function renderOrderItems(items){
        let html = '';
        items.forEach(it => {
            html += `
                <tr class="group hover:bg-primary/5 transition-colors">
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-lg bg-gray-100 bg-cover bg-center"
                                style="background-image:url('${it.product.image && JSON.parse(it.product.image).length
                                    ? '/storage/' + JSON.parse(it.product.image)[0]
                                    : '/images/no-image.png'}')">
                            </div>
                            <p class="text-sm font-bold">${it.product.name}</p>
                        </div>
                    </td>
                    <td class="pl-4 py-3 text-sm font-bold">${formatPrice(it.price)}</td>
                    <td class="pl-4 py-3 text-sm">${it.quantity}</td>
                    <td class="pl-4 py-3 text-sm"></td>
                </tr>
            `;
        });
        return html;
    }

    function updatePaginationUI(pagination) {
        // text info
        $('#pagination_info').html(`
            Hiển thị <b>${pagination.from}-${pagination.to}</b>
            trong số <b>${pagination.total}</b> sản phẩm
        `);

        // active page
        $('.page-btn').each(function () {
            const page = $(this).data('page');

            if (page === pagination.current_page) {
                $(this)
                    .addClass('bg-primary text-[#0d1b12]')
                    .removeClass('border');
            } else {
                $(this)
                    .removeClass('bg-primary text-[#0d1b12]')
                    .addClass('border');
            }

            // Ẩn page > last_page
            $(this).toggle(page <= pagination.last_page);
        });

        // prev / next
        $('#btn_prev').prop('disabled', !pagination.prev_page_url);
        $('#btn_next').prop('disabled', !pagination.next_page_url);
    }

    $(document).ready(function () {
        getAllOrder();
    });

    let currentPage = 1;
    let lastPage = 1;

    $(document).on('click', '.page-btn', function () {
        const page = $(this).data('page');
        const orderId = $('#search_product').val();
        const status = $('#filter_status').val();

        getAllOrder(page, orderId, status);
    });

    $('#btn_prev').on('click', function () {
        const orderId = $('#search_product').val();
        const status = $('#filter_status').val();
        getAllOrder(currentPage - 1, orderId, status);
    });

    $('#btn_next').on('click', function () {
        const orderId = $('#search_product').val();
        const status = $('#filter_status').val();
        getAllOrder(currentPage + 1, orderId, status);
    });

    let typingTimer = null;
    $('#search_product').on('keyup', function () {
        clearTimeout(typingTimer);

        const orderId = $(this).val();

        typingTimer = setTimeout(function () {
            $('#filter_status').val("");
            getAllOrder(1, orderId);
        }, 400);
    });

    $('#filter_status').on('change', function () {
        const status = $(this).val();
        
        $('#search_product').val("");
        getAllOrder(1, null, status);
    });

    $(document).ready(function() {
        // Hàm đóng modal
        function closeModal() {
            const modal = $('#exampleModalCenter');
            
            // Cách 1: Sử dụng class 'hidden' của Tailwind (Khuyên dùng)
            // Lưu ý: Phải xóa class 'flex' vì flex luôn ưu tiên hiển thị
            modal.addClass('hidden').removeClass('flex');
            
            // Cách 2: Nếu bạn muốn hiệu ứng mờ dần (Fade Out)
            // modal.fadeOut(200);
        }

        // 1. Click vào các nút có thuộc tính data-dismiss="modal" (Nút X và nút Hủy)
        $(document).on('click', '[data-dismiss="modal"]', function() {
            closeModal();
        });

        // 2. Click ra ngoài vùng Modal (vùng nền đen mờ)
        $('#exampleModalCenter').on('click', function(e) {
            // Nếu click chính xác vào vùng overlay (chứ không phải nội dung bên trong)
            if (e.target === this) {
                closeModal();
            }
        });

        // 3. Nhấn phím Escape (ESC) để đóng
        $(document).on('keydown', function(e) {
            if (e.key === "Escape") {
                closeModal();
            }
        });

        const ORDER_WORKFLOW = {
            'pending': {
                nextStatus: 'confirm',
                nextText: 'Xác nhận đơn hàng',
                btnClass: 'bg-blue-500 hover:bg-blue-600 shadow-blue-500/30'
            },
            'confirm': {
                nextStatus: 'shipping',
                nextText: 'Bắt đầu giao hàng',
                btnClass: 'bg-indigo-500 hover:bg-indigo-600 shadow-indigo-500/30'
            },
            'shipping': {
                nextStatus: 'complete',
                nextText: 'Hoàn tất đơn hàng',
                btnClass: 'bg-green-500 hover:bg-green-600 shadow-green-500/30'
            }
        };

        $(document).on('click', '.btn-edit', function() {
            // 1. Lấy ra giá trị status từ thuộc tính data-status của nút được click
            const status = $(this).data('status'); 
            const userName = $(this).data('name'); 
            const userPhone = $(this).data('phone'); 
            const userAddress = $(this).data('address'); 
            const description = $(this).data('description'); 
            const $btnSave = $('#btn_save_edit');

            const orderId = $(this).data('id');

            // 2. Cập nhật Badge hiển thị trạng thái vào trong Modal
            // Hàm renderOrderStatus đã có sẵn trong code của bạn ở trên
            $('#order_status_badge').html(renderOrderStatus(status));

            // 3. Kiểm tra nếu status là 'complete' hoặc 'cancel' thì ẩn nút Save
            const step = ORDER_WORKFLOW[status];

            if (step) {
                // Nếu còn bước tiếp theo (pending, confirm, shipping)
                $btnSave.removeClass('hidden')
                        .data('next-status', step.nextStatus)
                        .data('order-id', orderId)
                        .contents().filter(function() {
                            return this.nodeType === 3; 
                        }).first().replaceWith(step.nextText + " ");
                
                $btnSave.removeClass('bg-blue-500 bg-indigo-500 bg-green-500 hover:bg-blue-600 hover:bg-indigo-600 hover:bg-green-600')
                        .addClass(step.btnClass);
            } else {
                $btnSave.addClass('hidden');
            }

            $('#customer_name').text(userName); 
            $('#customer_phone').text(userPhone);
            $('#customer_address').text(userAddress);

            if (description) {
                $('#description').removeClass('hidden');
                $('#required_note').text(description);
            } else {
                $('#description').addClass('hidden');
            }
            // 4. Mở Modal
            $('#exampleModalCenter').removeClass('hidden').addClass('flex');
        });

        $('#btn_save_edit').on('click', function() {
            const orderId = $(this).data('order-id');
            const nextStatus = $(this).data('next-status');

            Swal.fire({
                title: 'Xác nhận cập nhật?',
                text: `Đơn hàng sẽ chuyển sang trạng thái mới.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/api/order/${orderId}`,
                        method: 'POST',
                        data: {
                            status: nextStatus,
                        },
                        headers: {
                            'Authorization': 'Bearer ' + getCookie('admin_token')
                        },
                        beforeSend: function () {
                            showLoader();
                        },
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Cập nhật trạng thái thành công',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            $('#exampleModalCenter').addClass('hidden').removeClass('flex');
                            getAllOrder();
                        },
                        error: function(err) {
                            Swal.fire('Lỗi!', 'Không thể cập nhật trạng thái.', 'error');
                        },
                        complete: function () {
                            hideLoader();
                        }
                    });
                }
            });
        });
    });
</script>
@endsection