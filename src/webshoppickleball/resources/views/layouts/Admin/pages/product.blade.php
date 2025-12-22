@extends('layouts.Admin.master')
@section('title', $title)
@section('content')
<!-- Header Area -->
<div class="w-full px-8 py-6 bg-background-light dark:bg-background-dark z-10">
    <!-- Breadcrumbs -->
    <div class="flex items-center gap-2 mb-6 text-sm">
        <a class="text-text-secondary dark:text-gray-400 hover:text-primary font-medium flex items-center gap-1"
            href="#">
            <span class="material-symbols-outlined text-[18px]">home</span>
            Trang chủ
        </a>
        <span class="text-text-secondary dark:text-gray-500">/</span>
        <span class="text-text-main dark:text-white font-bold">Quản trị sản phẩm</span>
    </div>
    <!-- Page Heading & Actions -->
    <div class="flex flex-wrap justify-between items-end gap-4">
        <div class="flex flex-col gap-1">
            <h1 class="text-text-main dark:text-white text-3xl font-black tracking-tight">Quản trị sản phẩm
            </h1>
        </div>
        <button
            class="group flex items-center justify-center gap-2 rounded-lg h-12 px-6 bg-primary hover:bg-primary-dark transition-all shadow-lg shadow-green-500/20 text-[#0d1b12] text-sm font-bold">
            <span class="material-symbols-outlined">add</span>
            <span>Thêm sản phẩm mới</span>
        </button>
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
            <input
                class="block w-full pl-10 pr-3 py-2.5 border border-[#cfe7d7] dark:border-gray-600 rounded-lg leading-5 bg-[#f8fcf9] dark:bg-gray-800 text-text-main dark:text-white focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm transition-all"
                placeholder="Tìm kiếm theo tên sản phẩm, SKU..." type="search" />
        </label>
        <!-- Stock Status Filter -->
        <div class="relative min-w-[180px]">
            <select
                class="appearance-none w-full pl-4 pr-10 py-2.5 border border-[#cfe7d7] dark:border-gray-600 rounded-lg bg-[#f8fcf9] dark:bg-gray-800 text-text-main dark:text-white text-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary cursor-pointer">
                <option value="">Tất cả trạng thái</option>
                <option value="in-stock">Còn hàng</option>
                <option value="low-stock">Sắp hết hàng</option>
                <option value="out-of-stock">Hết hàng</option>
            </select>
            <div
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-text-secondary">
                <span class="material-symbols-outlined">expand_more</span>
            </div>
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
                <tr class="bg-[#f8fcf9] dark:bg-gray-800 border-b border-[#e7f3eb] dark:border-gray-700">
                    <th class="p-4 w-12 text-center">
                        <input
                            class="rounded border-gray-300 text-primary focus:ring-primary bg-white dark:bg-gray-700"
                            type="checkbox" />
                    </th>
                    <th class="p-4 w-12"></th> <!-- Expand toggle column -->
                    <th class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Sản phẩm
                    </th>
                    <th class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider">SKU</th>
                    <th class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Danh mục
                    </th>
                    <th
                        class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider text-right">
                        Giá</th>
                    <th
                        class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider text-center">
                        Kho</th>
                    <th
                        class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider text-center">
                        Trạng thái</th>
                    <th
                        class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider text-right">
                        Hành động</th>
                </tr>
            </thead>
            <tbody id="parent_product_body" class="divide-y divide-[#e7f3eb] dark:divide-gray-700">
                
            </tbody>
        </table>
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

    function renderParentProduct(item){
        return `
            <tr
                class="group hover:bg-[#f0f9f4] dark:hover:bg-gray-700/50 transition-colors cursor-pointer bg-[#f0f9f4] dark:bg-gray-800/30">
                <td class="p-4 text-center">
                    <input
                        class="rounded border-gray-300 text-primary focus:ring-primary bg-white dark:bg-gray-700"
                        type="checkbox" />
                </td>
                <td class="p-4 text-center">
                    <button data-id="${item.id}"
                        class="extension-btn p-1 rounded-full hover:bg-white dark:hover:bg-gray-600 text-primary 
                            transition-transform duration-300">
                        <span class="material-symbols-outlined text-xl transition-transform duration-300">
                            expand_more
                        </span>
                    </button>
                </td>
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-lg bg-gray-100 dark:bg-gray-700 flex-shrink-0 bg-cover bg-center border border-gray-200 dark:border-gray-600"
                            style="background-image: url('${
                                item.image
                                    ? '/storage/' + JSON.parse(item.image)[0]
                                    : '/images/no-image.png'
                            }');">
                        </div>
                        <div>
                            <p class="text-sm font-bold text-text-main dark:text-white">${item.name}</p>
                        </div>
                    </div>
                </td>
                <td class="p-4 text-sm text-text-main dark:text-gray-300 font-mono">${item.slug}</td>
                <td class="p-4 text-sm text-text-main dark:text-gray-300">${item.category.name}</td>
                <td class="p-4 text-sm text-text-main dark:text-gray-300 text-right font-bold">${item.price}</td>
                <td class="p-4 text-center">
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                        ${item.quantity}
                    </span>
                </td>
                <td class="p-4 text-center">
                    ${
                        item.status === 1
                            ? `<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#e7f3eb] text-[#0d1b12] dark:bg-primary/20 dark:text-primary">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                                    Hoạt động
                            </span>`
                            : `<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Ngừng bán
                            </span>`
                    }
                </td>
                <td class="p-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <button
                            class="p-1.5 rounded text-gray-400 hover:text-primary hover:bg-green-50 dark:hover:bg-gray-700 transition-colors">
                            <span class="material-symbols-outlined text-[20px]">edit</span>
                        </button>
                        <button
                            class="p-1.5 rounded text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-gray-700 transition-colors">
                            <span class="material-symbols-outlined text-[20px]">delete</span>
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
                                        Biến thể
                                    </th>
                                    <th
                                        class="pl-4 py-2 text-[11px] font-semibold text-text-secondary uppercase text-right w-[15%]">
                                        Giá Riêng
                                    </th>
                                    <th
                                        class="pl-4 py-2 text-[11px] font-semibold text-text-secondary uppercase text-center w-[15%]">
                                        Tồn kho
                                    </th>
                                    <th
                                        class="p-4 text-xs font-bold text-text-secondary uppercase tracking-wider text-center">
                                        Trạng thái
                                    </th>
                                    <th
                                        class="pl-4 py-2 text-[11px] font-semibold text-text-secondary uppercase text-right w-[30%]">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="variant_wraper_body"></tbody>
                        </table>
                    </div>
                </td>
            </tr>
        `
    }

    function renderStockStatus(quantity) {
        if (quantity === 0) {
            return `
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium 
                    bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                    Hết hàng
                </span>
            `;
        }

        if (quantity <= 5) {
            return `
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium 
                    bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                    Sắp hết
                </span>
            `;
        }

        return `
            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium 
                bg-[#e7f3eb] text-[#0d1b12] dark:bg-primary/20 dark:text-primary">
                <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                Còn hàng
            </span>
        `;
    }

    function renderVariant(item){
        return `
            <tr class="hover:bg-white dark:hover:bg-gray-700">
                <td class="pl-4 py-3">
                    <div class="flex items-center gap-2">
                        <div class="size-8 rounded border border-gray-200 bg-red-500"
                            title="Màu Đỏ"></div>
                        <span
                            class="text-sm font-medium text-text-main dark:text-gray-300">${item.name}</span>
                    </div>
                </td>
                <td class="pl-4 py-3 text-sm text-right text-gray-500">
                    <input value="${item.price}" style="float:right; width:100px;padding-left:12px !important" class="block w-full pl-10 pr-3 py-2.5 border border-[#cfe7d7] dark:border-gray-600 rounded-lg leading-5 bg-[#f8fcf9] dark:bg-gray-800 text-text-main dark:text-white focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm transition-all" type="text">
                </td>
                <td class="pl-4 py-3 text-center text-sm text-text-main dark:text-gray-300">
                    <input value="${item.quantity}" style="float:right; width:100px;padding-left:12px !important" class="block w-full pl-10 pr-3 py-2.5 border border-[#cfe7d7] dark:border-gray-600 rounded-lg leading-5 bg-[#f8fcf9] dark:bg-gray-800 text-text-main dark:text-white focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm transition-all" type="number">
                </td>
                <td class="p-4 text-center">
                    ${renderStockStatus(item.quantity)}
                </td>
                <td class="pl-4 py-3 text-right pr-8">
                    <button
                        class="group flex items-center justify-center gap-2 rounded-lg h-12 px-6 bg-primary hover:bg-primary-dark transition-all shadow-lg shadow-green-500/20 text-[#0d1b12] text-sm font-bold" style="float:right;height:20px;width:40px">Lưu
                    </button>
                </td>
            </tr>
        `
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

    // click số trang
    $(document).on('click', '.page-btn', function () {
        const page = $(this).data('page');
        if (page !== currentPage) {
            getAllParentProduct(page);
        }
    });

    // prev
    $('#btn_prev').on('click', function () {
        if (currentPage > 1) {
            getAllParentProduct(currentPage - 1);
        }
    });

    // next
    $('#btn_next').on('click', function () {
        if (currentPage < lastPage) {
            getAllParentProduct(currentPage + 1);
        }
    });

    let currentPage = 1;
    let lastPage = 1;
    function getAllParentProduct(page = 1){
        Swal.fire({
            title: 'Đang xử lý...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            onOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: '/api/product?page=' + page,
            method: 'GET',
            contentType: 'application/json',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                Swal.close();
                const pagination = res.data;
                currentPage = pagination.current_page;
                lastPage = pagination.last_page;

                $('#parent_product_body').html('');
                pagination.data.forEach(product => {
                    $('#parent_product_body').append(renderParentProduct(product));
                });

                updatePaginationUI(pagination);

            },
            error: function(err) {
                Swal.close();
                console.error('Không thể tải danh sách sản phẩm:', err);
            }
        });
    }

    function getAllChildProduct(parentId, container, variantRow){

        $.ajax({
            url: '/api/product-child?parent_id=' + parentId,
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                container.html('');
                res.data.forEach(product => {
                    container.append(renderVariant(product));
                });

                variantRow.data('loaded', true);
            }
        });
    }

    $(document).ready(function () {
        getAllParentProduct();
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

        getAllChildProduct(parentId, variantBody, variantRow);
    });

</script>
@endsection