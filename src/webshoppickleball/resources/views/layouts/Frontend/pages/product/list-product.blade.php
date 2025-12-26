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
        <div class="flex items-center gap-2">
            <span class="text-sm text-text-light-secondary dark:text-text-dark-secondary">Hiển thị 12 trên 48
                sản phẩm</span>
            <!-- <select
                class="form-select rounded-lg border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark text-sm focus:border-primary focus:ring-primary">
                <option>Sắp xếp theo: Mới nhất</option>
                <option>Giá: Thấp đến Cao</option>
                <option>Giá: Cao đến Thấp</option>
                <option>Phổ biến nhất</option>
            </select> -->
        </div>
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
                        <span id="min_price">1.000.000₫</span>
                        <span id="max_price">6.000.000₫</span>
                    </div>
                </div>

                <button
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
</div>

<script>
    const slider = document.getElementById('price_slider');
    const handleMin = document.getElementById('handle_min');
    const handleMax = document.getElementById('handle_max');
    const rangeFill = document.getElementById('range_fill');
    const minPriceDisplay = document.getElementById('min_price');
    const maxPriceDisplay = document.getElementById('max_price');

    const minValue = 1000000; // 1.000.000
    const maxValue = 6000000; // 6.000.000

    let minPercent = 20;
    let maxPercent = 60;

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
                    <button data-id="${item.id}"
                        class="mt-3 flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary/20 text-text-light-primary dark:text-text-dark-primary gap-2 text-sm font-bold leading-normal tracking-wide hover:bg-primary/30 dark:hover:bg-primary/30 transition-colors">
                        <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                        Thêm vào giỏ
                    </button>
                </div>
            </div>
        </a>
        `
    }
    function renderCategory(item){
        return `
            <li>
                <label class="flex items-center gap-2 text-sm cursor-pointer hover:text-primary transition-colors">
                    <input type="checkbox" name="category[]" value="Vợt" 
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
        const keyword = $('#search_product').val();
        const status = $('#filter_status').val();

        getAllProduct(page, keyword, status);
    });

    $('#btn_prev').on('click', function () {
        const keyword = $('#search_product').val();
        const status = $('#filter_status').val();
        getAllProduct(currentPage - 1, keyword, status);
    });

    $('#btn_next').on('click', function () {
        const keyword = $('#search_product').val();
        const status = $('#filter_status').val();
        getAllProduct(currentPage + 1, keyword, status);
    });

    function getAllProduct(page = 1, perPage = 6, keyword = '', status = -1) {
        Swal.fire({
            title: 'Đang xử lý...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            onOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: '/api/product',
            method: 'GET',
            data: {
                page: page,
                per_page: perPage,
                keyword: keyword,
                status: status
            },
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                Swal.close();
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
            }
        });
    }

    $(document).ready(function () {
        getAllCategory();
        getAllProduct();
    });
</script>
@endsection