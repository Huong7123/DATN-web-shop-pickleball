@extends('layouts.Admin.master')
@section('title', $title)
@section('content')
<div class="flex-1 overflow-y-auto px-8 py-8">
    <!-- Page Header -->
    <header class="flex flex-wrap justify-between items-end gap-4 mb-8">
        <div class="flex flex-col gap-1">
            <h2 class="text-[#0d1b12] dark:text-white text-3xl font-black tracking-tight">Quản trị Mã giảm giá</h2>
        </div>
        <button id="btn_modal_add"
            class="bg-primary hover:bg-primary/90 text-black px-6 py-2.5 rounded-lg font-bold flex items-center gap-2 transition-all shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Thêm mã mới
        </button>
    </header>
    <!-- Actions & Filters Bar -->
    <div
        class="mt-8 flex flex-wrap gap-4 items-center bg-surface-light dark:bg-surface-dark p-4 rounded-xl shadow-sm border border-[#e7f3eb] dark:border-gray-700">
        <!-- Search -->
        <label class="flex-1 min-w-[280px] relative group">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span
                    class="material-symbols-outlined text-text-secondary group-focus-within:text-primary transition-colors">search</span>
            </div>
            <input id="input_search"
                class="block w-full pl-10 pr-3 py-2.5 border border-[#cfe7d7] dark:border-gray-600 rounded-lg leading-5 bg-[#f8fcf9] dark:bg-gray-800 text-text-main dark:text-white focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm transition-all"
                placeholder="Tìm kiếm theo mã" type="search" />
        </label>
    </div>
    <!-- Data Table -->
    <div
        class="mt-6 bg-white dark:bg-[#152a1c] border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-gray-50/50 dark:bg-gray-800/50 border-bottom border-gray-200 dark:border-gray-800">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Mã / Loại
                        </th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Giá trị</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Tối đa</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Đơn tối thiểu
                        </th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Thời hạn</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">
                            Trạng thái</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">
                            Thao tác</th>
                    </tr>
                </thead>
                <tbody id="list_discount_body" class="divide-y divide-gray-100 dark:divide-gray-800">
                    
                </tbody>
            </table>
        </div>
    </div>
    <!-- Pagination -->
    @include('layouts.Admin.widget.__pagination')
</div>
<div id="modal_discount" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 transition-opacity bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark min-h-screen flex items-center justify-center p-4 hidden">
    <!-- Modal Container -->
    <div
        class="bg-background-light dark:bg-background-dark w-full max-w-2xl rounded-xl shadow-2xl flex flex-col overflow-hidden">
        <!-- Header Section -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-[#cfe7d7] dark:border-white/10">
            <div class="flex flex-col">
                <h2 class="text-[#0d1b12] dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em]">
                    Thêm/Sửa Mã giảm giá</h2>
            </div>
            <button class="btn-close-modal text-[#4c9a66] hover:bg-primary/10 p-2 rounded-full transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto max-h-[80vh] custom-scrollbar p-6 space-y-6">
            <!-- Section: Thông tin cơ bản -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 text-primary">
                    <span class="material-symbols-outlined text-[20px]">info</span>
                    <h3 class="font-bold text-[#0d1b12] dark:text-white">Thông tin cơ bản</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="flex flex-col gap-2">
                        <p class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold">Tiêu đề</p>
                        <div class="relative flex items-center">
                            <input id="discount_title"
                                class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                                placeholder="VD: Ưu đãi mới" value="Ưu đãi mới" />
                        </div>
                    </label>
                    <!-- Mã giảm giá -->
                    <label class="flex flex-col gap-2">
                        <p class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold">Tên mã</p>
                        <div class="relative flex items-center">
                            <input id="discount_code"
                                class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                                placeholder="VD: PICKLE2024" value="" />
                            <button id="btn_random_code"
                                class="absolute right-2 p-1.5 text-primary hover:bg-primary/10 rounded-md flex items-center gap-1"
                                title="Tạo mã ngẫu nhiên">
                                <span class="material-symbols-outlined text-[18px]">cached</span>
                                <span class="text-xs font-bold uppercase">Random</span>
                            </button>
                        </div>
                    </label>
                    <!-- Loại ưu đãi -->
                    <label class="flex flex-col gap-2">
                        <p class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold">Loại ưu đãi</p>
                        <div class="relative">
                            <select id="discount_type"
                                class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-shadow pr-10">
                                <option value="percentage">Phần trăm (%)</option>
                                <option value="fixed">Số tiền cố định (VNĐ)</option>
                                <!-- <option value="shipping">Miễn phí vận chuyển</option> -->
                            </select>
                        </div>
                    </label>
                </div>
                <!-- Mô tả -->
                <label class="flex flex-col gap-2">
                    <p class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold">Mô tả mã giảm giá</p>
                    <textarea id="discount_description"
                        class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 min-h-[140px] resize-y transition-shadow"
                        placeholder="Nhập mô tả hiển thị cho khách hàng..." rows="2"></textarea>
                </label>
            </div>
            <!-- Section: Cấu hình ưu đãi -->
            <div class="space-y-4 pt-4 border-t border-[#cfe7d7] dark:border-white/10">
                <div class="flex items-center gap-2 text-primary">
                    <span class="material-symbols-outlined text-[20px]">payments</span>
                    <h3 class="font-bold text-[#0d1b12] dark:text-white">Giá trị &amp; Điều kiện</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="flex flex-col gap-2">
                        <p class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold">Giá trị ưu đãi</p>
                        <div class="relative">
                            <input id="discount_value"
                                class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                                placeholder="" type="number" value="" />
                        </div>
                    </label>
                    <label class="flex flex-col gap-2">
                        <p class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold">Giá trị đơn hàng tối thiểu</p>
                        <div class="relative">
                            <input id="min_order_value"
                                class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                                placeholder="" type="text" value="" />
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[#4c9a66] font-bold">VNĐ</span>
                        </div>
                    </label>
                    <label id="container_max_discount" class="flex flex-col gap-2">
                        <p class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold">Giảm tối đa</p>
                        <div class="relative">
                            <input id="max_discount_amount"
                                class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                                placeholder="" type="text" value="" />
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[#4c9a66] font-bold">VNĐ</span>
                        </div>
                    </label>
                    
                </div>
            </div>
            <!-- Section: Thời gian hiệu lực -->
            <div class="space-y-4 pt-4 border-t border-[#cfe7d7] dark:border-white/10">
                <div class="flex items-center gap-2 text-primary">
                    <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                    <h3 class="font-bold text-[#0d1b12] dark:text-white">Thời gian hiệu lực</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="flex flex-col gap-2">
                        <p class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold">Từ ngày</p>
                        <div class="relative">
                            <input id="start_date"
                                class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                                type="date" value="" />
                            <span
                                class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[#4c9a66]">event</span>
                        </div>
                    </label>
                    <label class="flex flex-col gap-2">
                        <p class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold">Đến ngày</p>
                        <div class="relative">
                            <input id="end_date"
                                class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                                type="date" value="" />
                            <span
                                class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[#4c9a66]">event</span>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <!-- Footer Actions -->
        <div
            class="px-6 py-4 bg-white dark:bg-white/5 border-t border-[#cfe7d7] dark:border-white/10 flex items-center justify-end gap-3">
            <button
                class="btn-close-modal px-6 h-12 rounded-lg text-[#0d1b12] dark:text-white font-bold hover:bg-[#cfe7d7] dark:hover:bg-white/10 transition-colors">
                Hủy bỏ
            </button>
            <button id="btn_save_discount"
                class="px-8 h-12 rounded-lg bg-primary text-[#0d1b12] font-extrabold hover:brightness-95 shadow-lg shadow-primary/20 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">save</span>
                Lưu mã giảm giá
            </button>
        </div>
    </div>
</div>

<script>
    function formatPrice(price) {
        if (!price) return '0';

        // Ép về string → bỏ phần thập phân
        const integerPart = price.toString().split('.')[0];

        // Format dấu phẩy
        return integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }
    function getDiscount(page = 1, perPage = 20, code = null) {
        $.ajax({
            url: '/api/discount',
            method: 'GET',
            data: {
                page: page,
                code: code,
                per_page: perPage
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

                $('#list_discount_body').html('');
                pagination.data.forEach(item => {
                    $('#list_discount_body').append(renderItems(item));
                });

                updatePaginationUI(pagination);

            },
            error: function(err) {
                Swal.close();
                console.error('Không thể tải danh sách:', err);
            },
            complete: function () {
                hideLoader(); // TẮT LOADER
            }
        });
    }

    function renderItems(item){
        // 1. Tính toán logic ngày tháng
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Đưa về 0h để so sánh chính xác theo ngày
        
        const endDate = new Date(item.end_date);
        endDate.setHours(0, 0, 0, 0);

        // Tính khoảng cách (miliseconds) và chuyển sang ngày
        const diffTime = endDate - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        // 2. Xác định màu sắc cho dòng Kết thúc
        let statusColorClass = "text-gray-700 dark:text-gray-300"; // Mặc định (> 3 ngày)
        let statusText = `Kết thúc: ${item.end_date}`;

        if (diffDays < 0) {
            statusColorClass = "text-red-500 font-bold"; // Đã hết hạn
            statusText = `Hết hạn: ${item.end_date}`;
        } else if (diffDays <= 3) {
            statusColorClass = "text-yellow-400 font-bold"; // Sắp hết hạn (<= 3 ngày)
            statusText = `Sắp hết hạn: ${item.end_date}`;
        }
        return `
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
            <td class="px-6 py-4">
                <div class="flex flex-col">
                    <span
                        class="text-sm font-extrabold text-[#0d1b12] dark:text-white">${item.code}</span>
                    <span class="text-xs text-gray-400">${item.discount_type === 'percentage' ? 'Giảm theo %' : 'Giảm theo số tiền'}</span>
                </div>
            </td>
            <td class="px-6 py-4">
                <span class="text-sm font-bold text-primary">${formatPrice(item.discount_value)} ${item.discount_type === 'percentage' ? '%' : '₫'}</span>
            </td>
            <td class="px-6 py-4">
                <span class="text-sm font-bold text-primary">${formatPrice(item.max_discount_amount)}</span>
            </td>
            <td class="px-6 py-4">
                <span class="text-sm font-medium">${formatPrice(item.min_order_value)}₫</span>
            </td>
            <td class="px-6 py-4">
                <div class="flex flex-col">
                    <span class="text-[11px] text-gray-400 uppercase font-bold">Bắt đầu: ${item.start_date}</span>
                    <span class="text-sm font-medium ${statusColorClass}">
                        ${statusText}
                    </span>
                </div>
            </td>
            <td class="px-6 py-4 text-center">
                ${item.status === 1 ? `
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-primary/20 text-primary border border-primary/20">
                        <span class="size-1.5 rounded-full bg-primary mr-1.5"></span>
                        Hoạt động
                    </span>` : `
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-800 border border-gray-200">
                        <span class="size-1.5 rounded-full bg-gray-400 mr-1.5"></span>  
                        Tạm dừng
                    </span>`
                }
            </td>
            <td class="px-6 py-4 text-right">
                <div class="flex justify-end items-center">
                    <label class="relative inline-flex items-center cursor-pointer group">
                        <input type="checkbox" 
                            class="sr-only peer toggle-status" 
                            data-id="${item.id}" 
                            ${item.status == 1 ? 'checked' : ''}>
                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 
                                    peer-checked:after:translate-x-[16px] peer-checked:after:border-white 
                                    after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                                    after:bg-white after:border-gray-300 after:border after:rounded-full 
                                    after:h-4 after:w-4 after:transition-all dark:border-gray-600 
                                    peer-checked:bg-primary group-hover:ring-4 group-hover:ring-primary/10">
                        </div>
                    </label>

                    <button data-id="${item.id}" class="btn-edit p-2 text-gray-400 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[20px]">edit</span>
                    </button>
                </div>
            </td>
        </tr>`;
    }

    $(document).ready(function () {
        const today = new Date();
        const nextWeek = new Date();
        nextWeek.setDate(today.getDate() + 7);

        // Gán giá trị vào input
        const startDateFormatted = today.toISOString().split('T')[0];
        const endDateFormatted = nextWeek.toISOString().split('T')[0];

        $('#start_date').val(startDateFormatted);
        $('#end_date').val(endDateFormatted);
        getDiscount();
    });

    function updatePaginationUI(pagination) {
        $('#pagination_info').html(`
            Hiển thị <b>${pagination.from || 0}-${pagination.to || 0}</b>
            trong tổng số <b>${pagination.total}</b> bản ghi
        `);

        const $numbersContainer = $('#pagination_numbers');
        $numbersContainer.empty();

        for (let i = 1; i <= pagination.last_page; i++) {
            const isActive = i === pagination.current_page;
            const activeClass = isActive 
                ? 'bg-primary text-[#0d1b12] font-bold' 
                : 'border text-text-main dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800';

            $numbersContainer.append(`
                <button class="page-btn w-8 h-8 rounded-lg text-sm transition-all ${activeClass}" 
                        data-page="${i}">
                    ${i}
                </button>
            `);
        }

        $('#btn_prev').prop('disabled', pagination.current_page <= 1);
        $('#btn_next').prop('disabled', pagination.current_page >= pagination.last_page);
    }

    let currentPage = 1;
    let lastPage = 1;

    $(document).on('click', '.page-btn', function () {
        const page = $(this).data('page');

        getDiscount(page);
    });

    $('#btn_prev').on('click', function () {
        getDiscount(currentPage - 1);
    });

    $('#btn_next').on('click', function () {
        getDiscount(currentPage + 1);
    });

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';')[0];
        return null;
    }

    // Hàm xử lý ẩn hiện trường "Giảm tối đa"
    function toggleMaxDiscount() {
        const type = $('#discount_type').val();
        if (type === 'percentage') {
            $('#container_max_discount').show();
        } else {
            $('#container_max_discount').hide();
            // Reset giá trị về rỗng khi ẩn để tránh nhầm lẫn
            $('#max_discount_amount').val(''); 
        }
    }

    // Lắng nghe sự kiện thay đổi loại ưu đãi
    $('#discount_type').on('change', function() {
        toggleMaxDiscount();
    });

    $('#btn_modal_add').on('click', function() {
        $('#modal_discount').removeAttr('data-edit-id');
        $('#modal_discount h2').text('Thêm mã giảm giá mới');
        selectedFile = null;
        $('#discount_title').val('Ưu đãi mới');
        $('#discount_code').val('');
        $('#discount_description').val('');
        $('#discount_type').val('percentage');
        $('#discount_value').val('');
        $('#max_discount_amount').val('');
        $('#min_order_value').val('');
        $('#modal_discount').removeClass('hidden');
        toggleMaxDiscount();
    });

    function closeModal() {
        const modal = $('#modal_discount');
        modal.addClass('hidden');
    }

    $(document).on('click', '.btn-close-modal', function() {
        closeModal();
    });

    $('#modal_discount').on('click', function(e) {
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

    $(document).ready(function() {
        const $modal = $('#modal_discount');

        // 1. Hàm tạo mã ngẫu nhiên
        $('#btn_random_code').click(function(e) {
            e.preventDefault();
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = 'PICKLE-';
            for (let i = 0; i < 6; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            $('#discount_code').val(result);
        });

        $('#btn_save_discount').click(function() {
            const editId = $('#modal_discount').attr('data-edit-id'); // Lấy ID nếu có
            const isEdit = !!editId; // true nếu là sửa, false nếu là thêm mới

            const discountType = $('#discount_type').val();
            const discountValue = parseFloat($('#discount_value').val()) || 0;
            
            let maxDiscount = null;
            if (discountType === 'fixed') {
                maxDiscount = discountValue;
            } else if (discountType === 'percentage') {
                maxDiscount = parseFloat($('#max_discount_amount').val().toString().replace(/[\.,]/g, '')) || null;
            }

            const formData = {
                title: $('#discount_title').val(),
                code: $('#discount_code').val(),
                description: $('#discount_description').val(),
                discount_type: discountType,
                discount_value: discountValue,
                min_order_value: parseFloat($('#min_order_value').val().toString().replace(/[\.,]/g, '')) || 0,
                max_discount_amount: maxDiscount,
                start_date: $('#start_date').val(),
                end_date: $('#end_date').val(),
                status: 1
            };

            // --- Cấu hình API động ---
            const apiUrl = isEdit ? `/api/discount/${editId}` : '/api/discount';

            $.ajax({
                url: apiUrl,
                method: 'POST',
                data: JSON.stringify(formData),
                contentType: 'application/json',
                headers: {
                    'Authorization': 'Bearer ' + getCookie('admin_token'),
                    'Accept': 'application/json'
                },
                beforeSend: function() { showLoader(); },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: isEdit ? 'Cập nhật thành công!' : 'Thêm mới thành công!',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    $('#modal_discount').addClass('hidden');
                    getDiscount(currentPage);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorList = Object.values(errors).flat().join('<br>');
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi dữ liệu',
                            html: `<div class="text-left text-sm">${errorList}</div>`,
                            confirmButtonColor: '#d33'
                        });
                    } else {
                        let msg = xhr.responseJSON?.message || 'Có lỗi xảy ra!';
                        Swal.fire('Lỗi!', msg, 'error');
                    }
                },
                complete: function() { hideLoader(); }
            });
        });

        // Hàm lấy cookie
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }
    });

    $(document).on('click', '.btn-edit', function() {
        const id = $(this).data('id');
        
        // Đánh dấu modal đang ở chế độ Edit bằng thuộc tính data
        $('#modal_discount').attr('data-edit-id', id);
        $('#modal_discount h2').text('Cập nhật mã giảm giá');

        // Gọi API lấy chi tiết (Hoặc nếu bạn muốn nhanh có thể tìm trong list hiện tại)
        $.ajax({
            url: `/api/discount/${id}`,
            method: 'GET',
            headers: { 'Authorization': 'Bearer ' + getCookie('admin_token') },
            success: function(res) {
                const item = res.data;

                const toInt = (val) => val ? val.toString().split('.')[0] : '';
                // Đổ dữ liệu vào form
                $('#discount_title').val(item.title);
                $('#discount_code').val(item.code);
                $('#discount_description').val(item.description);
                $('#discount_type').val(item.discount_type);
                $('#discount_value').val(toInt(item.discount_value));
                $('#min_order_value').val(toInt(item.min_order_value));
                $('#max_discount_amount').val(toInt(item.max_discount_amount));
                $('#start_date').val(item.start_date);
                $('#end_date').val(item.end_date);

                // Cập nhật giao diện phụ (ẩn/hiện Max Discount)
                toggleMaxDiscount();
                
                // Hiện modal
                $('#modal_discount').removeClass('hidden');
            }
        });
    });

    let typingTimer = null;
    $('#input_search').on('keyup', function () {
        clearTimeout(typingTimer);
        const code = $(this).val();
        typingTimer = setTimeout(function () {
            getDiscount(currentPage, 20, code);
        }, 400);
    });


    function showToast(message, type = 'success') {
        const color = type === 'success' ? '#10b981' : '#f59e0b';
        Swal.fire({
            text: message,
            icon: type,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        });
    }

    $(document).on('change', '.toggle-status', function() {
        const id = $(this).data('id');
        const isChecked = $(this).is(':checked');
        const newStatus = isChecked ? 1 : 0;

        $.ajax({
            url: `/api/discount/${id}`, // Sử dụng luôn API update của bạn
            method: 'POST',
            data: JSON.stringify({ status: newStatus }), // Chỉ gửi trường status
            contentType: 'application/json',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                showToast('Cập nhật trạng thái thành công!', 'success');
                getDiscount(currentPage);
            },
            error: function() {
                $checkbox.prop('checked', !isChecked);
                
                let errorMsg = 'Không thể cập nhật trạng thái';
                if(err.responseJSON && err.responseJSON.message) {
                    errorMsg = err.responseJSON.message;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: errorMsg,
                    confirmButtonColor: '#10b981'
                });
            }
        });
    });
</script>
@endsection