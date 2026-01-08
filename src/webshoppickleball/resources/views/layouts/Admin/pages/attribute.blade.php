@extends('layouts.Admin.master')
@section('title', $title)
@section('content')
<div class="w-full px-8 py-6 bg-background-light dark:bg-background-dark z-10">
    <!-- Breadcrumbs -->
    <div class="flex items-center gap-2 mb-6 text-sm">
        <a class="text-text-secondary dark:text-gray-400 hover:text-primary font-medium flex items-center gap-1"
            href="/tong-quan">
            <span class="material-symbols-outlined text-[18px]">home</span>
            Tổng quan
        </a>
        <span class="text-text-secondary dark:text-gray-500">/</span>
        <span class="text-text-main dark:text-white font-bold">Thuộc tính</span>
    </div>
    <!-- Page Heading & Actions -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl md:text-4xl font-black tracking-tight text-text-main dark:text-white">Danh sách thuộc tính</h1>
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
            <input id="input_search"
                class="block w-full pl-10 pr-3 py-2.5 border border-[#cfe7d7] dark:border-gray-600 rounded-lg leading-5 bg-[#f8fcf9] dark:bg-gray-800 text-text-main dark:text-white focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm transition-all"
                placeholder="Tìm kiếm theo tên thuộc tính" type="search" />
        </label>
        <!-- Stock Status Filter -->
        <div class="relative min-w-[180px]">
            <select id="filter_status"
                class="w-full pl-4 pr-10 py-2.5 border border-[#cfe7d7] dark:border-gray-600 rounded-lg bg-[#f8fcf9] dark:bg-gray-800 text-text-main dark:text-white text-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary cursor-pointer">
                <option value="">Tất cả trạng thái</option>
                <option value="1">Hoạt động</option>
                <option value="0">Bị khoá</option>
            </select>
        </div>
    </div>
</div>
<div class="flex-1 overflow-y-auto px-8 pb-8">
    <!-- Data Table -->
    <div
        class="bg-surface-light dark:bg-surface-dark rounded-xl border border-border-color dark:border-white/10 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-background-light dark:bg-white/5 border-b border-border-color dark:border-white/10">
                        <th
                            class="px-6 py-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">
                            
                        </th>
                        <th
                            class="px-6 py-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">
                            Thuộc tính
                        </th>
                        <th
                            class="px-6 py-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">
                            Trạng thái</th>
                        <th class="px-6 py-4 text-right">
                            <button id="btn_add_fast_parent" class="w-8 h-8 bg-primary/10 text-primary rounded-full hover:bg-primary hover:text-white transition-all">
                                <span class="material-symbols-outlined text-sm">add</span>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody id="list_category_body" class="divide-y divide-border-color dark:divide-white/10">
                    
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.Admin.widget.__pagination')
</div>

<script>
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';')[0];
        return null;
    }
    function getAllAttribute(page = 1, perPage = 20) {
        const name = $('#input_search').val();
        const status = $('#filter_status').val()
        $.ajax({
            url: '/api/attribute',
            method: 'GET',
            data: {
                page: page,
                name: name,
                status: status,
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

                $('#list_category_body').html('');
                pagination.data.forEach(item => {
                    $('#list_category_body').append(renderItems(item));
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

    function renderItems(item) {
        return `
        <tr class="group hover:bg-primary/5 transition-colors">
            <td class="p-4 text-center">
                <button data-id="${item.id}"
                    class="extension-btn p-1 rounded-full hover:bg-white dark:hover:bg-gray-600 text-primary transition-transform duration-300">
                    <span class="material-symbols-outlined text-xl transition-transform duration-300">expand_more</span>
                </button>
            </td>
            <td class="px-6 py-4 col-name">
                <p class="font-bold text-text-main dark:text-white text-sm">${item.name}</p>
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center gap-4 min-w-[150px]">
                    <div class="shrink-0">
                        ${item.status == 1
                            ? `<div style="width: 96px;" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-green-100 text-green-800 border border-green-200 shadow-sm">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                </span>
                                Hoạt động
                            </div>`
                            : `<div style="width: 96px;" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-red-50 text-red-700 border border-red-100 shadow-sm">
                                <span class="size-2 rounded-full bg-red-500"></span>
                                Đã khoá
                            </div>`
                        }
                    </div>
                    <div class="flex items-center">
                        <label class="relative inline-flex items-center cursor-pointer group">
                            <input type="checkbox" 
                                class="sr-only peer toggle-status" 
                                data-id="${item.id}" 
                                ${item.status == 1 ? 'checked' : ''}>
                            <div class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 
                                        peer-checked:after:translate-x-[20px] peer-checked:after:border-white 
                                        after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                                        after:bg-white after:border-gray-300 after:border after:rounded-full 
                                        after:h-4 after:w-4 after:transition-all dark:border-gray-600 
                                            peer-checked:bg-primary group-hover:ring-4 group-hover:ring-primary/10">
                            </div>
                        </label>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 text-right col-actions">
                <div class="flex justify-end gap-2">
                    <button data-id="${item.id}" data-name="${item.name}" class="btn-edit p-1.5 text-gray-400 hover:text-primary"><span class="material-symbols-outlined">edit</span></button>
                    <button data-id="${item.id}" class="btn-delete p-1.5 text-gray-400 hover:text-red-500"><span class="material-symbols-outlined">delete</span></button>
                </div>
            </td>
        </tr>
        <tr class="variant_wraper hidden bg-[#f8fcf9] dark:bg-gray-900/20">
            <td colspan="4" class="p-0">
                <div class="ml-[60px] my-2 border-l-4 border-primary bg-white dark:bg-gray-800 shadow-inner">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="pl-4 py-2 text-[11px] uppercase text-left">Giá trị thuộc tính</th>
                                <th class="pl-4 py-2 text-[11px] uppercase text-left">Trạng thái</th>
                                <th class="px-6 py-4 text-right">
                                    <button data-parent-id="${item.id}" class="btn_add_fast_child w-8 h-8 bg-primary/10 text-primary rounded-full hover:bg-primary hover:text-white transition-all">
                                        <span class="material-symbols-outlined text-sm">add</span>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="variant_wraper_body">
                            ${renderAttributeValue(item.attribute_values || [])}
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>`;
    }

    function renderAttributeValue(items){
        let html = '';
        items.forEach(it => {
            html += `
                <tr class="group hover:bg-primary/5 transition-colors">
                    <td class="px-6 py-4 col-name">
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="font-bold text-text-main dark:text-white text-sm">${it.name}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4 min-w-[150px]">
                            <div class="shrink-0">
                                ${it.status == 1
                                    ? `<div style="width: 96px;" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-green-100 text-green-800 border border-green-200 shadow-sm">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                        </span>
                                        Hoạt động
                                    </div>`
                                    : `<div style="width: 96px;" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-red-50 text-red-700 border border-red-100 shadow-sm">
                                        <span class="size-2 rounded-full bg-red-500"></span>
                                        Đã khoá
                                    </div>`
                                }
                            </div>
                            <div class="flex items-center">
                                <label class="relative inline-flex items-center cursor-pointer group">
                                    <input type="checkbox" 
                                        class="sr-only peer toggle-child-status" 
                                        data-id="${it.id}" 
                                        ${it.status == 1 ? 'checked' : ''}>
                                    <div class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 
                                                peer-checked:after:translate-x-[20px] peer-checked:after:border-white 
                                                after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                                                after:bg-white after:border-gray-300 after:border after:rounded-full 
                                                after:h-4 after:w-4 after:transition-all dark:border-gray-600 
                                                    peer-checked:bg-primary group-hover:ring-4 group-hover:ring-primary/10">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right col-actions">
                        <div class="flex items-center justify-end gap-2">
                            <button data-id="${it.id}"
                                data-image="${it.image}"
                                data-name="${it.name}"
                                class="btn-edit p-1.5 rounded text-gray-400 hover:text-primary hover:bg-green-50 dark:hover:bg-gray-700 transition-colors">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </button>
                            <button data-id="${it.id}"
                                class="btn-delete p-1.5 rounded text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-gray-700 transition-colors">
                                <span class="material-symbols-outlined text-[20px]">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
        return html;
    }

    $(document).ready(function () {
        getAllAttribute();
    });

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

        getAllAttribute(page);
    });

    $('#btn_prev').on('click', function () {
        getAllUser(currentPage - 1);
    });

    $('#btn_next').on('click', function () {
        getAllUser(currentPage + 1);
    });

    $(document).on('change', '.toggle-status', function() {
        const $checkbox = $(this);
        const categoryId = $checkbox.data('id');
        const isChecked = $checkbox.is(':checked');
        const newStatus = isChecked ? 1 : 0;

        // Vô hiệu hóa tạm thời để tránh người dùng bấm liên tục khi đang xử lý
        $checkbox.prop('disabled', true);

        $.ajax({
            url: `/api/attribute/${categoryId}`,
            method: 'POST',
            data: {
                status: newStatus,
            },
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                // Hiển thị thông báo nhỏ (Toast)
                showToast('Cập nhật trạng thái thành công!', 'success');
                
                getAllAttribute(currentPage); 
            },
            error: function(err) {
                // Nếu lỗi, gạt nút quay trở lại trạng thái ban đầu
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
            },
            complete: function() {
                // Mở khóa lại checkbox sau khi xong
                $checkbox.prop('disabled', false);
            }
        });
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

    let typingTimer = null;
    $('#input_search').on('keyup', function () {
        clearTimeout(typingTimer);

        typingTimer = setTimeout(function () {
            $('#filter_status').val("");
            getAllAttribute(1);
        }, 400);
    });

    $('#filter_status').on('change', function () {
        $('#input_search').val("");
        getAllAttribute(1);
    });

    /* --- THÊM NHANH THUỘC TÍNH CHA --- */
    $('#btn_add_fast_parent').on('click', function() {
        if ($('#row_fast_add_parent').length > 0) return; // Chỉ cho hiện 1 dòng

        const html = `
            <tr id="row_fast_add_parent" class="bg-primary/5 border-b border-primary/20">
                <td></td>
                <td class="px-6 py-3">
                    <input type="text" id="fast_name_parent" class="w-full px-3 py-1.5 border border-primary rounded-lg text-sm focus:outline-none" placeholder="Nhập tên thuộc tính...">
                </td>
                <td class="px-6 py-3">
                    <label class="relative inline-flex items-center cursor-pointer group">
                        <input type="checkbox" id="fast_status_parent" class="sr-only peer" checked>
                        <div class="w-10 h-5 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-[20px] after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </td>
                <td class="px-6 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <button class="btn_save_fast_parent flex items-center p-1.5 bg-primary text-white rounded hover:bg-primary-dark shadow-sm">
                            <span class="material-symbols-outlined text-[20px]">check</span>
                        </button>
                        <button onclick="$('#row_fast_add_parent').remove()" class="flex items-center p-1.5 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">
                            <span class="material-symbols-outlined text-[20px]">close</span>
                        </button>
                    </div>
                </td>
            </tr>
        `;
        $('#list_category_body').prepend(html);
        $('#fast_name_parent').focus();
    });

    // Lưu thuộc tính cha
    $(document).on('click', '.btn_save_fast_parent', function() {
        const name = $('#fast_name_parent').val().trim();

        if(!name) return Swal.fire('Lỗi', 'Vui lòng nhập tên!', 'error');

        $.ajax({
            url: '/api/attribute',
            method: 'POST',
            data: { name: name },
            headers: { 'Authorization': 'Bearer ' + getCookie('admin_token') },
            success: function() {
                showToast('Thêm thành công!');
                getAllAttribute(1);
            }
        });
    });

    /* --- THÊM NHANH GIÁ TRỊ CON --- */
    $(document).on('click', '.btn_add_fast_child', function() {
        const parentId = $(this).data('parent-id');
        const container = $(this).closest('table').find('.variant_wraper_body');

        if (container.find('.row_fast_add_child').length > 0) return;

        const html = `
            <tr class="row_fast_add_child bg-gray-50 border-b">
                <td class="px-6 py-3">
                    <input type="text" class="fast_name_child w-full px-3 py-1 border border-primary rounded-md text-sm focus:outline-none" placeholder="Giá trị...">
                </td>
                <td class="px-6 py-3">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="fast_status_child sr-only peer" checked>
                        <div class="w-8 h-4 bg-gray-200 rounded-full peer peer-checked:after:translate-x-[16px] after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </td>
                <td class="px-6 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <button class="btn_save_fast_child flex items-center p-1 bg-primary text-white rounded shadow-sm" data-parent-id="${parentId}">
                            <span class="material-symbols-outlined text-[18px]">check</span>
                        </button>
                        <button onclick="$(this).closest('tr').remove()" class="flex items-center p-1 bg-gray-200 text-gray-600 rounded">
                            <span class="material-symbols-outlined text-[18px]">close</span>
                        </button>
                    </div>
                </td>
            </tr>
        `;
        container.prepend(html);
    });

    // Lưu thuộc tính con
    $(document).on('click', '.btn_save_fast_child', function() {
        const row = $(this).closest('tr');
        const parentId = $(this).data('parent-id');
        const name = row.find('.fast_name_child').val().trim();

        if(!name) return Swal.fire('Lỗi', 'Vui lòng nhập giá trị!', 'error');

        $.ajax({
            url: `/api/attribute-value`, // Thay URL đúng của bạn vào đây
            method: 'POST',
            data: { attribute_id: parentId, name: name },
            headers: { 'Authorization': 'Bearer ' + getCookie('admin_token') },
            success: function() {
                showToast('Giá trị đã được thêm!');
                getAllAttribute(currentPage);
            }
        });
    });

    $(document).on('change', '.toggle-child-status', function() {
        const $checkbox = $(this);
        const attributeId = $checkbox.data('id');
        const isChecked = $checkbox.is(':checked');
        const newStatus = isChecked ? 1 : 0;

        // Vô hiệu hóa tạm thời để tránh người dùng bấm liên tục khi đang xử lý
        $checkbox.prop('disabled', true);

        $.ajax({
            url: `/api/attribute-value/${attributeId}`,
            method: 'POST',
            data: {
                status: newStatus,
            },
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                // Hiển thị thông báo nhỏ (Toast)
                showToast('Cập nhật trạng thái thành công!', 'success');
                
                getAllAttribute(currentPage); 
            },
            error: function(err) {
                // Nếu lỗi, gạt nút quay trở lại trạng thái ban đầu
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
            },
            complete: function() {
                // Mở khóa lại checkbox sau khi xong
                $checkbox.prop('disabled', false);
            }
        });
    });

    $(document).on('click', '.btn-edit', function() {
        const $btn = $(this);
        const $row = $btn.closest('tr');
        
        if ($row.hasClass('is-editing')) return;
        $row.addClass('is-editing');

        const id = $btn.data('id');
        const name = $btn.data('name');
        const isChild = $row.closest('.variant_wraper_body').length > 0;

        // 1. Tìm đúng cột Tên bằng class
        const $nameCell = $row.find('.col-name');
        $nameCell.data('old-html', $nameCell.html());
        
        // Giữ cấu trúc div bên trong nếu là con để không bị lệch layout
        $nameCell.html(`
            <div class="flex items-center gap-3">
                <input type="text" class="edit-name-input w-full px-3 py-1.5 border border-primary rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" 
                    value="${name}">
            </div>
        `);

        // 2. Tìm đúng cột Hành động bằng class
        const $actionCell = $row.find('.col-actions');
        $actionCell.data('old-html', $actionCell.html());
        $actionCell.html(`
            <div class="flex items-center justify-end gap-2">
                <button data-id="${id}" data-type="${isChild ? 'child' : 'parent'}"
                    class="btn-save-inline flex items-center p-1.5 bg-green-600 text-white rounded hover:bg-green-700 shadow-sm transition-colors">
                    <span class="material-symbols-outlined text-[20px]">check</span>
                </button>
                <button class="btn-cancel-inline flex items-center p-1.5 bg-gray-200 text-gray-600 rounded hover:bg-gray-300 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
        `);

        $row.find('.edit-name-input').focus().select();
    });

    $(document).on('click', '.btn-cancel-inline', function() {
        const $row = $(this).closest('tr');
        $row.removeClass('is-editing');

        // Trả lại HTML cũ cho các cột
        $row.find('td').each(function() {
            const oldHtml = $(this).data('old-html');
            if (oldHtml) {
                $(this).html(oldHtml);
            }
        });
    });

    $(document).on('click', '.btn-save-inline', function() {
        const $btn = $(this);
        const $row = $btn.closest('tr');
        const id = $btn.data('id');
        const type = $btn.data('type');
        const newName = $row.find('.edit-name-input').val().trim();

        if (!newName) {
            showToast('Tên không được để trống', 'error');
            return;
        }

        // Xác định URL tùy theo loại thuộc tính
        const url = (type === 'parent') ? `/api/attribute/${id}` : `/api/attribute-value/${id}`;

        $.ajax({
            url: url,
            method: 'POST', // Hoặc PUT tùy API của bạn
            data: {
                name: newName,
            },
            headers: { 'Authorization': 'Bearer ' + getCookie('admin_token') },
            beforeSend: function() { showLoader(); },
            success: function(res) {
                showToast('Cập nhật thành công!');
                getAllAttribute(currentPage); // Tải lại danh sách để cập nhật toàn bộ UI
            },
            error: function(err) {
                showToast('Có lỗi xảy ra', 'error');
            },
            complete: function() { hideLoader(); }
        });
    });

    $(document).on('click', '.btn-delete', function() {
        const $btn = $(this);
        const id = $btn.data('id');
        const $row = $btn.closest('tr');
        
        const isChild = $row.closest('.variant_wraper_body').length > 0;
        const typeLabel = isChild ? "giá trị thuộc tính" : "thuộc tính";
        const url = isChild ? `/api/attribute-value/${id}` : `/api/attribute/${id}`;

        // Sử dụng SweetAlert2 để xác nhận
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33', // Màu đỏ cho nút xóa
            cancelButtonColor: '#6e7881',
            confirmButtonText: 'Đồng ý xóa',
            cancelButtonText: 'Hủy bỏ',
            reverseButtons: true // Đưa nút Hủy sang trái, Xóa sang phải
        }).then((result) => {
            if (result.isConfirmed) {
                // Nếu người dùng đồng ý, tiến hành gọi AJAX
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + getCookie('admin_token'),
                        'Accept': 'application/json'
                    },
                    success: function(res) {
                        // Thông báo thành công bằng Swal
                        Swal.fire({
                            title: 'Xoá thuộc tính thành công!',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        getAllAttribute(currentPage);
                    },
                    error: function(err) {
                        const errorMsg = err.responseJSON?.message || 'Không thể xóa mục này';
                        Swal.fire('Lỗi!', errorMsg, 'error');
                    },
                });
            }
        });
    });
</script>
@endsection