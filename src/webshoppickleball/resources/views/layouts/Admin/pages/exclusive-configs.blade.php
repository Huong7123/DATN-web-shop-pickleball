@extends('layouts.Admin.master')
@section('title', $title)
@section('content')
<div class="flex-1 overflow-y-auto p-8 max-w-[1200px] mx-auto w-full">
    <!-- Page Heading -->
    <div class="flex flex-wrap justify-between items-end gap-6 mb-8">
        <div class="flex flex-col gap-2">
            <h2
                class="text-[#0d1b12] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">
                Cấu hình Ưu đãi Độc quyền</h2>
        </div>
        <button id="btn_modal_add"
            class="flex items-center gap-2 px-6 h-12 bg-primary text-background-dark rounded-xl font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined">add</span>
            <span>Thêm mức mới</span>
        </button>
    </div>
    <!-- Tier Cards List -->
    <div id="list_exclusive_config" class="flex flex-col gap-4">
        <!-- Tier 1: Bronze -->
        <!-- <div
            class="group flex flex-col md:flex-row items-center gap-6 p-6 rounded-2xl bg-white dark:bg-[#152a1c] border border-[#cfe7d7] dark:border-[#2d4a35] transition-all hover:border-primary/50 hover:shadow-xl">
            <div
                class="flex h-16 w-16 items-center justify-center rounded-2xl bg-[#cd7f32]/20 text-[#cd7f32]">
                <span class="material-symbols-outlined text-4xl font-bold">workspace_premium</span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-3 mb-1">
                    <h4 class="text-xl font-extrabold truncate">Hạng Đồng (Bronze)</h4>
                    <span
                        class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#e7f3eb] text-[#4c9a66] uppercase">Mặc
                        định</span>
                </div>
                <p class="text-[#4c9a66] text-sm font-medium mb-3">Chi tiêu tối thiểu: <span
                        class="text-[#0d1b12] dark:text-white font-bold">0 VNĐ</span></p>
                <div class="flex flex-wrap gap-2">
                    <span
                        class="flex items-center gap-1 px-3 py-1 rounded-full bg-[#f0f9f3] dark:bg-[#1a3321] text-[#4c9a66] dark:text-primary text-xs font-semibold border border-primary/20">
                        <span class="material-symbols-outlined text-sm">local_shipping</span> Miễn phí ship
                        (Nội thành)
                    </span>
                    <span
                        class="flex items-center gap-1 px-3 py-1 rounded-full bg-[#f0f9f3] dark:bg-[#1a3321] text-[#4c9a66] dark:text-primary text-xs font-semibold border border-primary/20">
                        <span class="material-symbols-outlined text-sm">percent</span> Voucher 5%
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-4 ml-auto">
                <div class="flex flex-col items-end mr-4">
                    <span class="text-xs font-bold text-[#4c9a66] mb-1">TRẠNG THÁI</span>
                    <div class="relative inline-flex items-center cursor-pointer">
                        <div class="w-11 h-6 bg-primary rounded-full peer"></div>
                        <div
                            class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform translate-x-5">
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button
                        class="p-3 rounded-xl bg-[#e7f3eb] dark:bg-[#203a28] hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-[#0d1b12] dark:text-white">edit</span>
                    </button>
                    <button
                        class="p-3 rounded-xl bg-[#e7f3eb] dark:bg-[#203a28] hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
                        <span class="material-symbols-outlined text-red-500">delete</span>
                    </button>
                </div>
            </div>
        </div> -->
    </div>
</div>

<div id="modal_config" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 transition-opacity bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark min-h-screen flex items-center justify-center p-4 hidden">
    <!-- Modal Container -->
    <div
        class="bg-background-light dark:bg-background-dark w-full max-w-2xl rounded-xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <!-- Modal Header -->
        <div
            class="px-6 py-4 border-b border-gray-200 dark:border-gray-800 flex justify-between items-center bg-white dark:bg-background-dark">
            <div>
                <h2 class="text-[#0d1b12] dark:text-white text-xl font-bold leading-tight">Cấu hình Mốc Ưu đãi</h2>
            </div>
            <button class="btn-close-modal text-gray-400 hover:text-gray-600 dark:hover:text-white transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto custom-scrollbar p-6 space-y-6">
            <!-- Basic Config Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tên mốc ưu đãi (Dropdown-like Textfield) -->
                <div class="flex flex-col gap-2">
                    <label class="flex flex-col gap-2">
                        <p class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold">Tiêu đề</p>
                        <div class="relative flex items-center">
                            <input id="tier_name"
                                class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                                placeholder="VD: Người dùng mới" value="" />
                        </div>
                    </label>
                </div>
                <!-- Mức chi tiêu tích lũy -->
                <div class="flex flex-col gap-2">
                    <label class="flex flex-col gap-2">
                        <p class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold">Chi tiêu tích lũy tối thiểu (VNĐ)</p>
                        <div class="relative flex items-center">
                            <input id="min_spending"
                                class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                                placeholder="5,000,000" type="text" />
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-[#4c9a66]">VNĐ</span>
                        </div>
                    </label>
                </div>
            </div>
            <!-- Voucher Selection Section -->
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <h3 class="text-[#0d1b12] dark:text-white text-base font-bold leading-tight">Gắn Voucher độc quyền
                    </h3>
                    <button class="btn-open-voucher-kho text-primary text-xs font-bold flex items-center gap-1 hover:underline">
                        <span class="material-symbols-outlined text-sm">add_circle</span> Thêm từ kho Voucher
                    </button>
                </div>
                <div id="selected_voucher_chips"
                    class="flex flex-wrap gap-2 p-4 border border-dashed border-[#cfe7d7] dark:border-gray-700 rounded-xl bg-[#f8fcf9] dark:bg-gray-800/50">
                        <p class="text-gray-400 text-xs italic py-2">Chưa có voucher nào được gắn</p>
                </div>
            </div>
        </div>
        <!-- Modal Footer -->
        <div
            class="px-6 py-4 border-t border-gray-200 dark:border-gray-800 flex justify-end items-center gap-3 bg-white dark:bg-background-dark">
            <button 
                class="btn-close-modal px-6 py-2.5 rounded-lg text-gray-600 dark:text-gray-300 font-bold text-sm hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                Hủy bỏ
            </button>
            <button id="btn_save_config"
                class="px-8 py-2.5 bg-primary hover:brightness-95 active:scale-95 text-[#0d1b12] font-extrabold text-sm rounded-lg shadow-lg shadow-primary/20 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">save</span>
                Lưu cấu hình
            </button>
        </div>
    </div>
    <!-- Background Illustration Elements -->
    <div class="fixed top-0 left-0 w-full h-full -z-10 overflow-hidden pointer-events-none opacity-20 dark:opacity-10">
        <div class="absolute top-[-10%] left-[-5%] w-96 h-96 bg-primary rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-96 h-96 bg-primary rounded-full blur-[120px]"></div>
    </div>
</div>

<div id="modal_voucher_picker" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[50] flex items-center justify-center p-4 hidden">
    <div class="bg-white dark:bg-[#152a1c] w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[80vh] border border-[#cfe7d7] dark:border-[#2d4a35]">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-800 flex justify-between items-center">
            <h3 class="font-bold text-lg text-primary">Kho Voucher</h3>
            <button type="button" onclick="$('#modal_voucher_picker').addClass('hidden')" class="text-gray-400 hover:text-gray-600">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        <div id="voucher_list_container" class="flex-1 overflow-y-auto p-4 space-y-3 custom-scrollbar">
            <div class="flex justify-center py-10"><span class="animate-spin material-symbols-outlined text-primary">progress_activity</span></div>
        </div>

        <div class="p-4 border-t border-gray-200 dark:border-gray-800 flex justify-end gap-3 bg-gray-50 dark:bg-black/20">
            <button type="button" onclick="$('#modal_voucher_picker').addClass('hidden')" class="px-4 py-2 text-sm font-bold text-gray-500">Hủy</button>
            <button type="button" id="btn_confirm_vouchers" class="px-6 py-2 bg-primary text-[#0d1b12] rounded-lg font-bold text-sm shadow-lg">Gắn Voucher đã chọn</button>
        </div>
    </div>
</div>

<script>
    $('#btn_modal_add').on('click', function() {
        $('#modal_config').removeAttr('data-edit-id');
        $('#modal_config h2').text('Thêm mã giảm giá mới');
        selectedFile = null;
        $('#modal_config').removeClass('hidden');
    });

    function closeModal() {
        const modal = $('#modal_config');
        modal.addClass('hidden');
    }

    $(document).on('click', '.btn-close-modal', function() {
        closeModal();
    });

    $('#modal_config').on('click', function(e) {
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

    function formatPrice(price) {
        if (!price) return '0';

        // Ép về string → bỏ phần thập phân
        const integerPart = price.toString().split('.')[0];

        // Format dấu phẩy
        return integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }
    function getexclusive() {
        $.ajax({
            url: '/api/exclusive-config',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            beforeSend: function () {
                showLoader(); // HIỆN LOADER
            },
            success: function(res) {
                const pagination = res.data;

                $('#list_exclusive_config').html('');
                pagination.forEach(item => {
                    $('#list_exclusive_config').append(renderItems(item));
                });

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

    function renderItems(item) {
        // 1. Xử lý hiển thị danh sách Discounts (Vouchers)
        const discountsHtml = item.discounts && item.discounts.length > 0 
            ? item.discounts.map(d => {
                // Định dạng hiển thị giá trị giảm
                const displayValue = d.discount_type === 'percentage' 
                    ? `${parseFloat(d.discount_value)}%` 
                    : `${new Intl.NumberFormat('vi-VN').format(d.discount_value)}đ`;
                
                return `
                    <span class="flex items-center gap-1 px-3 py-1 rounded-full bg-[#f0f9f3] dark:bg-[#1a3321] text-[#4c9a66] dark:text-primary text-xs font-semibold border border-primary/20">
                        <span class="material-symbols-outlined text-sm">confirmation_number</span> 
                        Mã: ${d.code} (Giảm ${displayValue})
                    </span>`;
            }).join('')
            : `<span class="text-gray-400 text-xs italic">Chưa gắn mã ưu đãi</span>`;

        // 2. Định dạng tiền tệ cho Chi tiêu tối thiểu
        const formattedSpending = new Intl.NumberFormat('vi-VN').format(item.min_spending);

        return `
        <div class="group flex flex-col md:flex-row items-center gap-6 p-6 rounded-2xl bg-white dark:bg-[#152a1c] border border-[#cfe7d7] dark:border-[#2d4a35] transition-all hover:border-primary/50 hover:shadow-xl">
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-3 mb-1">
                    <h4 class="text-xl font-extrabold truncate">${item.tier_name}</h4>
                </div>
                <p class="text-[#4c9a66] text-sm font-medium mb-3">
                    Chi tiêu tối thiểu: 
                    <span class="text-[#0d1b12] dark:text-white font-bold">${formattedSpending} VNĐ</span>
                </p>
                
                <div class="flex flex-wrap gap-2">
                    ${discountsHtml}
                </div>
            </div>

            <div class="flex items-center gap-4 ml-auto">
                <div class="flex flex-col items-end mr-4">
                    <span class="text-xs font-bold text-[#4c9a66] mb-1">TRẠNG THÁI</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer toggle-status" data-id="${item.id}" ${item.status == 1 ? 'checked' : ''}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                    </label>
                </div>
                <div class="flex gap-2">
                    <button data-id="${item.id}" class="btn-edit p-3 rounded-xl bg-[#e7f3eb] dark:bg-[#203a28] hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-[#0d1b12] dark:text-white">edit</span>
                    </button>
                    <button data-id="${item.id}" class="btn-delete p-3 rounded-xl bg-[#e7f3eb] dark:bg-[#203a28] hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
                        <span class="material-symbols-outlined text-red-500">delete</span>
                    </button>
                </div>
            </div>
        </div>
        `;
    }

    $(document).ready(function () {
        getexclusive();
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
            url: `/api/exclusive-config/${id}`, // Sử dụng luôn API update của bạn
            method: 'POST',
            data: JSON.stringify({ status: newStatus }), // Chỉ gửi trường status
            contentType: 'application/json',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                showToast('Cập nhật trạng thái thành công!', 'success');
                getexclusive();
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

    let tempSelectedVouchers = []; // Lưu trữ {id, code, title}

    // 1. Khi nhấn "Thêm từ kho Voucher"
    $(document).on('click', '.btn-open-voucher-kho', function(e) {
        e.preventDefault();
        $('#modal_voucher_picker').removeClass('hidden');
        loadVouchersFromAPI();
    });

    // 2. Hàm gọi API lấy danh sách Voucher
    function loadVouchersFromAPI() {
        const container = $('#voucher_list_container');
        
        $.ajax({
            url: '/api/discount',
            data: { per_page: 20, page: 1, status: 1 }, // Chỉ lấy mã đang bật
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                let html = '';
                res.data.data.forEach(v => {
                    // Kiểm tra xem voucher này đã được chọn trước đó chưa
                    const isChecked = tempSelectedVouchers.some(item => item.id == v.id) ? 'checked' : '';
                    
                    html += `
                    <label class="flex items-center gap-4 p-3 rounded-xl border border-gray-100 dark:border-gray-800 hover:bg-primary/5 cursor-pointer transition-colors">
                        <input type="checkbox" class="voucher-checkbox w-5 h-5 accent-primary" 
                            data-id="${v.id}" data-code="${v.code}" data-title="${v.title}" ${isChecked}>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-[#0d1b12] dark:text-white">${v.code}</p>
                            <p class="text-xs text-gray-500">
                                ${v.title || 'Không có tiêu đề'} - 
                                Giảm ${formatPrice(v.discount_value || '0')}${v.discount_type === 'percentage' ? '%' : 'đ'} 
                                ${parseFloat(v.max_discount_value) > 0 ? `(Tối đa ${formatPrice(v.max_discount_value)})` : ''} 
                                cho đơn hàng từ ${v.min_order_value ? formatPrice(v.min_order_value) : '0'}đ
                            </p>
                        </div>
                    </label>`;
                });
                container.html(html || '<p class="text-center py-10 text-gray-400">Kho voucher trống</p>');
            }
        });
    }

    // 3. Khi nhấn "Gắn Voucher đã chọn"
    $('#btn_confirm_vouchers').on('click', function() {
        tempSelectedVouchers = []; // Reset để lấy mới từ các checkbox đang checked
        
        $('.voucher-checkbox:checked').each(function() {
            tempSelectedVouchers.push({
                id: $(this).data('id'),
                code: $(this).data('code'),
                title: $(this).data('title')
            });
        });

        renderVoucherChips();
        $('#modal_voucher_picker').addClass('hidden');
    });

    // 4. Hàm render các "Chips" ra Modal chính
    function renderVoucherChips() {
        const chipContainer = $('#selected_voucher_chips'); // Bạn hãy thêm ID này vào div chứa chips ở modal chính
        let html = '';
        
        tempSelectedVouchers.forEach(v => {
            html += `
            <div class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-full bg-primary/20 border border-primary/30 px-4 group">
                <p class="text-[#0d1b12] dark:text-white text-xs font-semibold">${v.code}</p>
                <button type="button" class="btn-remove-chip text-gray-500 hover:text-red-500" data-id="${v.id}">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>`;
        });
        
        chipContainer.html(html || '<p class="text-gray-400 text-xs italic py-2">Chưa có voucher nào được gắn</p>');
    }

    // 5. Xóa nhanh 1 chip ngay trên modal chính
    $(document).on('click', '.btn-remove-chip', function() {
        const id = $(this).data('id');
        tempSelectedVouchers = tempSelectedVouchers.filter(v => v.id != id);
        renderVoucherChips();
    });

    function saveExclusiveConfig() {
        // 1. Kiểm tra trạng thái: Đang sửa hay thêm mới
        const modal = $('#modal_config');
        const editId = modal.attr('data-edit-id'); // Lấy ID nếu đang ở chế độ sửa
        const isEdit = !!editId; 

        // 2. Thu thập mảng ID từ các chips
        const discount_ids = [];
        $('#selected_voucher_chips .btn-remove-chip').each(function() {
            discount_ids.push($(this).data('id'));
        });

        // 3. Thu thập dữ liệu từ các input
        const tier_name = $('#tier_name').val();
        const rawMinSpending = $('#min_spending').val().toString().replace(/,/g, '');
        const min_spending = parseFloat(rawMinSpending) || 0;
        const status = 1; // Có thể lấy từ checkbox nếu có

        // 4. Validation cơ bản
        if (!tier_name) {
            Swal.fire('Thông báo', 'Vui lòng nhập tên hạng ưu đãi', 'warning');
            return;
        }
        if (discount_ids.length === 0) {
            Swal.fire('Thông báo', 'Vui lòng gắn ít nhất một voucher cho hạng này', 'warning');
            return;
        }

        // 5. Cấu hình API động
        const apiUrl = isEdit ? `/api/exclusive-config/${editId}` : '/api/exclusive-config';

        // 6. Gọi AJAX
        $.ajax({
            url: apiUrl,
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token'),
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({
                tier_name: tier_name,
                min_spending: min_spending,
                discount_ids: discount_ids,
                status: status
            }),
            beforeSend: function() { 
                showLoader(); 
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: isEdit ? 'Cập nhật thành công!' : 'Thêm mới thành công!',
                    timer: 1200,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    modal.addClass('hidden');
                    getexclusive();
                }, 1300);
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
            complete: function() { 
                hideLoader(); 
            }
        });
    }

    // Gán sự kiện click
    $('#btn_save_config').on('click', function() {
        saveExclusiveConfig();
    });

    $(document).on('click', '.btn-edit', function() {
        const id = $(this).data('id');
        $('#modal_config').attr('data-edit-id', id);
        $('#modal_config h2').text('Cập nhật mốc ưu đãi');

        // Gọi API lấy chi tiết hoặc dùng data có sẵn từ row (nếu danh sách có đủ)
        $.ajax({
            url: `/api/exclusive-config/${id}`,
            method: 'GET',
            headers: { 'Authorization': 'Bearer ' + getCookie('admin_token') },
            success: function(res) {
                const data = res.data;
                $('#tier_name').val(data.tier_name);
                const minSpendingRaw = Math.floor(data.min_spending || 0);
                $('#min_spending').val(minSpendingRaw);
                
                // Đổ lại danh sách voucher đã chọn vào biến tạm và render chips
                tempSelectedVouchers = data.discounts.map(d => ({
                    id: d.id,
                    code: d.code,
                    title: d.title
                }));
                renderVoucherChips();
                
                $('#modal_config').removeClass('hidden');
            }
        });
    });

    $(document).on('click', '.btn-delete', function() {
        const id = $(this).data('id');
        
        Swal.fire({
            title: 'Bạn chắc chắn muốn xoá cấu hình này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#10b981', // Màu primary của bạn
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/api/exclusive-config/${id}`,
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + getCookie('admin_token'),
                        'Content-Type': 'application/json'
                    },
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Xoá cấu hình thành công!',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        
                        // Tải lại danh sách sau khi xóa
                        getexclusive(); 
                    },
                    error: function(xhr) {
                        let msg = xhr.responseJSON?.message || 'Không thể xóa mốc ưu đãi này!';
                        Swal.fire('Lỗi!', msg, 'error');
                    },
                    complete: function() {
                        hideLoader();
                    }
                });
            }
        });
    });
</script>
@endsection