@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div class="flex flex-wrap items-center gap-2 pb-4">
        <a class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium hover:text-primary"
            href="#">Trang chủ</a>
        <span class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium">/</span>
        <span class="text-text-light-primary dark:text-text-dark-primary text-sm font-medium">Sản phẩm</span>
    </div>
    <!-- PageHeading -->
    <div class="flex flex-wrap items-center justify-between gap-4 pb-6">
        <h1 class="text-4xl font-black tracking-tighter">Sản Phẩm Pickleball</h1>
        
    </div>
    <div class="flex flex-col gap-8 lg:flex-row">
        <!-- Filter Sidebar -->
        <aside class="w-full lg:w-1/4 lg:pr-8">
            <div class="sticky top-24 space-y-6">
                <!-- Category Filter -->
                <div class="space-y-3 border-t border-border-light dark:border-border-dark pt-4">
                    <h4 class="font-semibold">Danh mục</h4>
                    <ul id="category_list" class="space-y-2">
                        
                    </ul>

                </div>
                <!-- Price Range Filter -->
                <div class="space-y-4 border-t border-border-light dark:border-border-dark pt-4">
                    <h4 class="font-semibold">Khoảng giá</h4>

                    <!-- Slider track -->
                    <div id="price_slider" class="relative h-1 w-full rounded-full bg-primary/20">
                        <!-- Selected range -->
                        <div id="range_fill" class="absolute h-1 rounded-full bg-primary" style="left: 20%; right: 40%;"></div>

                        <!-- Handles -->
                        <div id="handle_min" class="absolute -top-1.5 h-4 w-4 rounded-full bg-primary shadow cursor-pointer" style="left: 20%;"></div>
                        <div id="handle_max" class="absolute -top-1.5 h-4 w-4 rounded-full bg-primary shadow cursor-pointer" style="right: 40%;"></div>
                    </div>

                    <!-- Giá hiển thị -->
                    <div class="flex justify-between text-sm">
                        <span id="min_price"></span>
                        <span id="max_price"></span>
                    </div>
                </div>

                <button id="btn_apply_filter"
                    class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 bg-primary text-background-dark gap-2 text-sm font-bold leading-normal tracking-wide hover:opacity-90 transition-opacity">Áp
                    dụng bộ lọc</button>
            </div>
        </aside>
        <!-- Product Grid -->
        <div class="w-full lg:w-3/4">
            <div id="wrap_product_body" class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
                
            </div>
            <!-- Pagination -->
            @include('layouts.Admin.widget.__pagination')
        </div>
    </div>

    @include('layouts.Frontend.widget.__modal_add_to_cart')
</div>

<script>
    let currentFilter = {
        keyword: '',
        status: -1,
        categories: '',
        min_price: null,
        max_price: null,
        per_page: 9
    };

    const slider = document.getElementById('price_slider');
    const handleMin = document.getElementById('handle_min');
    const handleMax = document.getElementById('handle_max');
    const rangeFill = document.getElementById('range_fill');
    const minPriceDisplay = document.getElementById('min_price');
    const maxPriceDisplay = document.getElementById('max_price');

    const minValue = 0; // 0
    const maxValue = 5000000; // 5.000.000

    let minPercent = 0;
    let maxPercent = 100;

    function updateRange() {
        // cập nhật vị trí range fill
        rangeFill.style.left = minPercent + '%';
        rangeFill.style.width = (maxPercent - minPercent) + '%';

        // cập nhật handle
        handleMin.style.left = minPercent + '%';
        handleMax.style.left = maxPercent + '%';

        // cập nhật giá
        const minPrice = Math.round(minValue + (maxValue - minValue) * (minPercent / 100));
        const maxPrice = Math.round(minValue + (maxValue - minValue) * (maxPercent / 100));

        minPriceDisplay.textContent = minPrice.toLocaleString('vi-VN') + '₫';
        maxPriceDisplay.textContent = maxPrice.toLocaleString('vi-VN') + '₫';
    }


    function dragHandle(handle, isMin) {
        function onMouseMove(e) {
            const rect = slider.getBoundingClientRect();
            let percent = ((e.clientX - rect.left) / rect.width) * 100;
            percent = Math.max(0, Math.min(100, percent));

            if (isMin) {
                minPercent = Math.min(percent, maxPercent); // không vượt quá max
            } else {
                maxPercent = Math.max(percent, minPercent); // không nhỏ hơn min
            }
            updateRange();
        }

        function onMouseUp() {
            document.removeEventListener('mousemove', onMouseMove);
            document.removeEventListener('mouseup', onMouseUp);
        }

        document.addEventListener('mousemove', onMouseMove);
        document.addEventListener('mouseup', onMouseUp);
    }

    handleMin.addEventListener('mousedown', e => dragHandle(handleMin, true));
    handleMax.addEventListener('mousedown', e => dragHandle(handleMax, false));

    updateRange(); // render lần đầu

    function formatPrice(price) {
        if (!price) return '0';

        // Ép về string → bỏ phần thập phân
        const integerPart = price.toString().split('.')[0];

        // Format dấu phẩy
        return integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }
    function renderCardProduct(item){
        const createdAt = new Date(item.created_at);
        const now = new Date();
        const diffTime = now - createdAt; // ms
        const diffDays = diffTime / (1000 * 60 * 60 * 24); // ra ngày

        const badgeHTML = diffDays < 7
        ? `<span class="absolute top-3 right-3 bg-primary text-background-dark text-xs font-bold px-2 py-1 rounded-full">Mới</span>`
        : '';
        return `
        <a href="/san-pham/${item.slug}">
            <div
                class="flex flex-col overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark group" style="cursor: pointer;">
                <div class="relative overflow-hidden">
                    <img class="aspect-square w-full object-cover transition-transform duration-300 group-hover:scale-105"
                        data-alt="A green and black pickleball paddle leaning against a net."
                        src="${
                                item.image
                                    ? '/storage/' + JSON.parse(item.image)[0]
                                    : '/images/no-image.png'
                            }"/>
                    ${badgeHTML}
                </div>
                <div class="flex flex-1 flex-col p-4">
                    <h3 class="text-base font-bold">${item.name}</h3>
                    <p class="text-sm text-text-light-secondary dark:text-text-dark-secondary mb-2">${item.category.name}
                    </p>
                    <p class="text-lg font-extrabold text-primary mt-auto">${formatPrice(item.price)}</p>
                    <div class="flex gap-2 mt-3">
                        <button data-id="${item.id}" 
                            class="flex-1 flex items-center gap-2 justify-center h-10 rounded-lg bg-primary text-[#0d1b12] font-bold text-base tracking-wide hover:bg-[#10d652] transition-all shadow-lg shadow-primary/25 cursor-pointer group">
                            <span class="material-symbols-outlined text-base">shopping_bag</span>
                            Mua ngay
                        </button>
                        <button data-id="${item.id}" 
                            class="btn-add-to-cart flex items-center justify-center w-10 h-10 rounded-lg bg-primary/20 text-primary hover:bg-primary/30 transition-colors">
                            <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>
        </a>
        `
    }
    function renderCategory(item){
        return `
            <li>
                <label class="flex items-center gap-2 text-sm cursor-pointer hover:text-primary transition-colors">
                    <input type="checkbox" name="category[]" value="${item.id}" 
                        class="h-4 w-4 text-primary accent-primary border-0 focus:ring-0">
                    ${item.name}
                </label>
            </li>
        `
    }
    function getAllCategory(){
        $.ajax({
            url: '/api/category?per_page=20&page=1',
            method: 'GET',
            contentType: 'application/json',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                const pagination = res.data;
                $('#category_list').html('');
                pagination.data.forEach(category => {
                    $('#category_list').append(renderCategory(category));
                });
            },
            error: function(err) {
                console.error('Không thể tải danh sách sản phẩm:', err);
            }
        });
    }

    function updatePaginationUI(pagination) {
        $('#pagination_info').html(`
            Hiển thị <b>${pagination.from || 0}-${pagination.to || 0}</b>
            trong tổng số <b>${pagination.total}</b> sản phẩm
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

    // click số trang
    $(document).on('click', '.page-btn', function () {
        getAllProduct($(this).data('page'));
    });

    $('#btn_prev').on('click', function () {
        if (currentPage > 1) getAllProduct(currentPage - 1);
    });


    $('#btn_next').on('click', function () {
        if (currentPage < lastPage) getAllProduct(currentPage + 1);
    });

    function getAllProduct(page = 1) {
        $.ajax({
            url: '/api/product',
            method: 'GET',
            data: {
                page: page,
                per_page: currentFilter.per_page,
                keyword: currentFilter.keyword,
                status: currentFilter.status,
                category_id: currentFilter.categories,
                min_price: currentFilter.min_price,
                max_price: currentFilter.max_price
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

                $('#wrap_product_body').html('');
                pagination.data.forEach(product => {
                    $('#wrap_product_body').append(renderCardProduct(product));
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

    $(document).ready(function () {
        getAllCategory();
        getAllProduct();
    });

    function formatPrice(price) {
        if (!price) return '0';

        // Ép về string → bỏ phần thập phân
        const integerPart = price.toString().split('.')[0];

        // Format dấu phẩy
        return integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function fillProductAddCartModal(item) {
        const firstImage = item.image ? `/storage/${JSON.parse(item.image)[0]}` : '/images/no-image.png';
        const price = formatPrice(item.price);

        // HTML cho các thuộc tính
        let attributesHTML = '';
        item.attributes.forEach(attr => {
            const values = item.attribute_values.filter(v => v.attribute_id === attr.id);

            let valuesHTML = '';
            values.forEach(v => {
                valuesHTML += `
                    <label class="cursor-pointer relative">
                        <input type="radio" name="attribute_${attr.id}" value="${v.id}" class="variant-radio peer absolute opacity-0 pointer-events-none">
                        <span class="px-4 py-2 rounded-lg border-2 border-border-light
                            bg-background-light text-sm font-medium
                            peer-checked:bg-primary/20
                            peer-checked:border-primary transition-colors">
                            ${v.name}
                        </span>
                    </label>
                `;
            });

            attributesHTML += `
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">${attr.name}</label>
                    <div class="flex flex-wrap gap-2">
                        ${valuesHTML}
                    </div>
                </div>
            `;
        });

        // Full modal HTML
        return `
            <div class="shrink-0 w-full sm:w-48">
                <div class="aspect-square w-full rounded-xl overflow-hidden border border-slate-100 dark:border-slate-800 relative bg-background-light dark:bg-surface-dark group">
                    <div class="absolute inset-0 bg-center bg-cover bg-no-repeat transition-transform duration-500 group-hover:scale-105"
                        style='background-image: url("${firstImage}");'>
                    </div>
                </div>
            </div>
            <div class="flex-1 space-y-6">
                <div>
                    <h3 class="text-xl font-bold text-[#0d1b12] dark:text-white leading-snug">${item.name}</h3>
                    <div class="flex items-center gap-2 mt-1">
                        <p class="text-xl font-bold text-primary modal-price">${price}</p>
                    </div>
                </div>
                <div class="h-px w-full bg-slate-100 dark:bg-slate-800"></div>
                ${attributesHTML}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Số lượng</label>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-transparent p-0.5 w-fit modal-qty-wrapper">
                            <button class="w-9 h-9 flex items-center justify-center rounded
                                hover:bg-slate-100 dark:hover:bg-surface-dark
                                text-slate-500 dark:text-slate-400 transition-colors modal-decrease cursor-pointer">
                                <span class="material-symbols-outlined text-[18px]">remove</span>
                            </button>

                            <input class="w-12 text-center bg-transparent text-sm font-bold text-[#0d1b12] dark:text-white
                                border-none focus:ring-0 p-0 [&::-webkit-inner-spin-button]:appearance-none modal-qty"
                                type="number" value="1" min="1" readonly />

                            <button class="w-9 h-9 flex items-center justify-center rounded
                                hover:bg-slate-100 dark:hover:bg-surface-dark
                                text-slate-500 dark:text-slate-400 transition-colors modal-increase cursor-pointer">
                                <span class="material-symbols-outlined text-[18px]">add</span>
                            </button>
                        </div>
                        <div class="text-xs font-medium flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">inventory_2</span>
                            <p class="modal-stock m-0 ${item.quantity > 0 ? 'text-primary' : 'text-red-500'}">
                                ${item.quantity > 0 ? `Còn ${item.quantity} sản phẩm` : 'Hết hàng'}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Mở modal
    $(document).on('click', '.btn-add-to-cart', function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        $.ajax({
            url: '/api/product/' + id,
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                const product = res.data;
                $('#modal_add_to_cart_content').html(fillProductAddCartModal(product));
                $('#modal_add_to_cart_content').data('product-id', product.id);
                $('#modal_add_cart').removeClass('hidden');
            }
        });
    });

    // Khi chọn thuộc tính
    $(document).on('change', '.variant-radio', function() {
        const modal = $('#modal_add_to_cart_content');
        const productId = modal.data('product-id');

        const selectedValues = [];
        modal.find('.variant-radio:checked').each(function() {
            selectedValues.push(Number($(this).val()));
        });

        // Chỉ gọi API nếu đã chọn đủ attributes
        const totalAttrs = modal.find('.flex.flex-wrap.gap-2').length;
        if (selectedValues.length === totalAttrs) {
            $.ajax({
                url: `/api/product-variant/${productId}`,
                method: 'POST',
                data: { attribute_value_ids: selectedValues },
                headers: { 'Authorization': 'Bearer ' + getCookie('admin_token') },
                success: function(res) {
                    const variant = res.data;
                    if (!variant) return;

                    // Cập nhật giá
                    modal.find('.modal-price').text(formatPrice(variant.price));

                    // Cập nhật quantity và trạng thái nút
                    const stockText = modal.find('.modal-stock');
                    if (variant.quantity > 0) {
                        stockText.text(`Còn ${variant.quantity} sản phẩm`)
                                .removeClass('text-red-500')
                                .addClass('text-primary');
                    } else {
                        stockText.text('Hết hàng')
                                .removeClass('text-primary')
                                .addClass('text-red-500');
                    }

                    modal.find('.modal-qty').val(1);
                }
            });
        }
    });

    // Khi click nút giảm
    $(document).on('click', '.modal-increase', function() {
        const input = $(this).closest('.modal-qty-wrapper').find('.modal-qty');
        input.val((parseInt(input.val()) || 1) + 1);
    });

    $(document).on('click', '.modal-decrease', function() {
        const input = $(this).closest('.modal-qty-wrapper').find('.modal-qty');
        let val = parseInt(input.val()) || 1;
        if (val > 1) input.val(val - 1);
    });

    $('#btn_close_modal').on('click', function () {
        $('#modal_add_cart').addClass('hidden');
    });

    $(document).on('click', '#btn_add_cart_confirm', function () {
        const modal = $('#modal_add_to_cart_content');
        const parentId = modal.data('product-id');

        // Lấy attribute_value_ids đã chọn
        const attributeValueIds = [];
        modal.find('.variant-radio:checked').each(function () {
            attributeValueIds.push(Number($(this).val()));
        });

        const totalAttrs = modal.find('.flex.flex-wrap.gap-2').length;
        if (attributeValueIds.length !== totalAttrs) {
            Swal.fire('Thiếu thuộc tính', 'Vui lòng chọn đầy đủ thuộc tính!', 'warning');
            return;
        }

        const qty = parseInt(modal.find('.modal-qty').val()) || 1;

        $.ajax({
            url: '/api/cart',
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + getCookie('user_token'),
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({
                items: [
                    {
                        parent_id: parentId,
                        attribute_value_ids: attributeValueIds,
                        quantity: qty
                    }
                ]
            }),
            success(res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Đã thêm vào giỏ hàng',
                    timer: 1500,
                    showConfirmButton: false
                });

                $('#modal_add_cart').addClass('hidden');
                loadCartBadge();
            },
            error(xhr) {
                Swal.fire('Lỗi', xhr.responseJSON?.message || 'Không thể thêm vào giỏ', 'error');
            }
        });
    });

    function getSelectedCategories() {
        return $('input[name="category[]"]:checked')
            .map(function () { return this.value; })
            .get()
            .join(','); // "3,5,8"
    }
    function getPriceRange() {
        return {
            min: parseInt($('#min_price').text().replace(/\D/g, '')) || null,
            max: parseInt($('#max_price').text().replace(/\D/g, '')) || null
        };
    }

    $('#btn_apply_filter').on('click', function () {

        const price = getPriceRange();

        currentFilter.categories = getSelectedCategories();
        currentFilter.min_price  = price.min;
        currentFilter.max_price  = price.max;

        getAllProduct(1); // reset về trang 1
    });


</script>
@endsection