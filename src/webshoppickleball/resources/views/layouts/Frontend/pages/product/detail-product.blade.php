@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    @php
        $image = json_decode($data->image, true) ?? [];
        $urlImage = '/storage/' . ($image[0] ?? 'images/no-image.png');
    @endphp
    <div class="layout-content-container flex flex-col w-full" id="product_detail" 
            data-product-id="{{ $data->id }}"
            data-parent-id="{{ $data->id }}"
            data-name="{{ $data->name }}"
            data-price="{{ $data->price }}"
            data-image="{{ $urlImage ?? '' }}"
            data-attrs="">
        <!-- Breadcrumbs -->
        <div class="flex flex-wrap gap-2 px-0 py-4">
            <a class="text-primary text-sm font-medium leading-normal hover:underline" href="#">Trang chủ</a>
            <span class="text-primary/60 dark:text-primary/80 text-sm font-medium leading-normal">/</span>
            <a class="text-primary text-sm font-medium leading-normal hover:underline" href="/san-pham">Sản phẩm</a>
            <span class="text-primary/60 dark:text-primary/80 text-sm font-medium leading-normal">/</span>
            <span class="text-sm font-medium leading-normal">Chi tiết sản phẩm</span>
        </div>
        <!-- Product Details Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">
            <!-- Product Image Gallery -->
            <div class="flex flex-col gap-4">
                @php $images = json_decode($data->image, true) ?? []; @endphp

                <div id="mainImage"
                    class="w-full aspect-square rounded-xl bg-center bg-cover bg-no-repeat
                            bg-gray-200 dark:bg-gray-700"
                    style="background-image:url('/storage/{{ $images[0] }}')">
                </div>

                <div class="relative">
                    <div id="thumbWrapper"
                        class="flex gap-3 overflow-x-auto pb-2">

                        @foreach($images as $i => $img)
                            <div
                                class="thumb shrink-0 w-28 aspect-square rounded-lg bg-center bg-cover cursor-pointer
                                    border-2 {{ $i==0 ? 'border-primary' : 'border-gray-300 dark:border-gray-600' }}"
                                data-img="/storage/{{ $img }}"
                                style="background-image:url('/storage/{{ $img }}')">
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>


            <!-- Product Information Panel -->
            <div class="flex flex-col gap-6">
                <!-- PageHeading -->
                <div class="flex flex-col gap-2">
                    <p class="text-4xl font-black leading-tight tracking-[-0.033em]">{{ $data->name }}</p>
                </div>
                <!-- Rating -->
                <div class="flex items-center gap-3">
                    <div class="flex gap-0.5">
                        <span class="material-symbols-outlined text-yellow-400"
                            style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined text-yellow-400"
                            style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined text-yellow-400"
                            style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined text-yellow-400"
                            style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined text-yellow-400">star_half</span>
                    </div>
                    <a class="text-sm font-normal leading-normal text-primary/80 dark:text-primary/90 hover:underline"
                        href="#reviews">(125 đánh giá)</a>
                </div>
                <!-- Price -->
                <div class="flex items-baseline gap-4">
                    <p class="text-4xl font-bold leading-tight text-primary" id="product_price">{{ number_format((float)$data->price, 0, '.', ',') }}₫</p>
                    <!-- <p class="text-xl font-normal leading-normal text-gray-400 dark:text-gray-500 line-through">3.200.000₫</p>
                    <span class="bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded-full">-22%</span> -->
                </div>
                <!-- Options -->
                <div class="flex flex-col gap-4">
                    @php
                        $grouped = $data->attributeValues->groupBy('attribute_id');
                    @endphp

                    @foreach($data->attributes as $attribute)
                        @php $values = $grouped[$attribute->id] ?? collect(); @endphp
                        @if($values->count())

                        <div>
                            <p class="text-base font-bold mb-2">{{ $attribute->name }}</p>

                            <div class="flex flex-wrap gap-2">
                                @foreach($values as $variant)
                                    <label class="cursor-pointer relative">
                                        <input
                                            type="radio"
                                            name="attribute_{{ $attribute->id }}"
                                            value="{{ $variant->id }}"
                                            class="hidden peer peer absolute opacity-0 pointer-events-none">

                                        <div
                                            class="px-4 py-2 rounded-lg border-2 border-border-light
                                                    bg-background-light text-sm font-medium
                                                    peer-checked:bg-primary/20
                                                    peer-checked:border-primary transition-colors">
                                            {{ $variant->name }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                <!-- Action Area -->
                <div class="flex flex-col gap-4 pt-4 border-t border-primary/10">
                    <div class="flex items-center gap-4">
                        <p class="text-base font-bold">Số lượng</p>
                        <div class="flex items-center rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-transparent p-0.5 w-fit modal-qty-wrapper">
                            <button
                                id="qty-minus"
                                class="w-9 h-9 flex items-center justify-center rounded
                                    hover:bg-slate-100 dark:hover:bg-surface-dark
                                    text-slate-500 dark:text-slate-400 transition-colors
                                    modal-decrease cursor-pointer">
                                <span class="material-symbols-outlined text-[18px]">remove</span>
                            </button>

                            <input
                                id="qty-input"
                                type="number"
                                min="1"
                                value="1"
                                readonly
                                class="w-12 text-center bg-transparent text-sm font-bold text-[#0d1b12] dark:text-white
                                    border-none focus:ring-0 p-0
                                    [&::-webkit-inner-spin-button]:appearance-none modal-qty">
                            <button
                                id="qty-plus"
                                class="w-9 h-9 flex items-center justify-center rounded
                                    hover:bg-slate-100 dark:hover:bg-surface-dark
                                    text-slate-500 dark:text-slate-400 transition-colors
                                    modal-increase cursor-pointer">
                                <span class="material-symbols-outlined text-[18px]">add</span>
                            </button>
                        </div>
                        <div class="text-xs font-medium flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">inventory_2</span>
                            <p id="product_stock" class="modal-stock m-0 {{ $data->quantity > 0 ? 'text-primary' : 'text-red-500' }}">
                                @if($data->quantity > 0)
                                    Còn {{ $data->quantity }} sản phẩm
                                @else
                                    Hết hàng
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button id="btn_buy_now"
                            class="flex w-full cursor-pointer items-center justify-center gap-3 overflow-hidden rounded-lg h-12 bg-primary text-[#0d1b12] text-base font-bold leading-normal tracking-[0.015em] hover:bg-opacity-90 transition-all">
                            Mua ngay
                        </button>
                        <button id="btn_add_cart"
                            class="flex w-full cursor-pointer items-center justify-center gap-3 overflow-hidden rounded-lg h-12 bg-primary/20 dark:bg-primary/30 text-[#0d1b12] dark:text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/30 dark:hover:bg-primary/40 transition-all">
                            <span class="material-symbols-outlined">add_shopping_cart</span> Thêm vào giỏ hàng
                        </button>
                    </div>
                </div>
                <!-- Trust Signals -->
                <div class="flex flex-col gap-3 p-4 rounded-lg bg-primary/5 dark:bg-primary/10 mt-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">local_shipping</span>
                        <p class="text-sm font-medium">Giao hàng miễn phí toàn quốc</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">autorenew</span>
                        <p class="text-sm font-medium">Đổi trả trong 30 ngày</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">verified</span>
                        <p class="text-sm font-medium">Cam kết 100% chính hãng</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Detailed Info Tabs -->
        <div class="w-full mt-16">
            <div class="border-b border-gray-200 dark:border-gray-700">
                <nav aria-label="Tabs" class="flex -mb-px space-x-8">
                    <a aria-current="page"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-bold text-base text-primary border-primary"
                        href="#">Mô tả sản phẩm</a>
                    <!-- <a class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-base text-gray-500 hover:text-primary hover:border-primary dark:text-gray-400 dark:hover:text-primary dark:hover:border-primary"
                        href="#" id="reviews">Đánh giá của khách hàng (125)</a> -->
                </nav>
            </div>
            <div class="py-8">
                <h3 class="text-xl font-bold mb-4">Mô tả sản phẩm</h3>
                <p class="text-base leading-relaxed text-gray-700 dark:text-gray-300">Vợt Pickleball Carbon Pro X5 được
                    thiết kế cho những người chơi chuyên nghiệp tìm kiếm sự kết hợp hoàn hảo giữa sức mạnh, khả năng kiểm
                    soát và độ bền. Với bề mặt bằng sợi carbon T700 cao cấp và lõi tổ ong polymer, Pro X5 mang lại cảm giác
                    bóng vượt trội và điểm ngọt (sweet spot) lớn. Thiết kế khí động học giúp tăng tốc độ vung vợt, trong khi
                    tay cầm có đệm mang lại sự thoải mái và chắc chắn trong suốt trận đấu.</p>
                <ul class="list-disc list-inside mt-4 space-y-2 text-base text-gray-700 dark:text-gray-300">
                    <li>Bề mặt carbon T700 cho độ xoáy và kiểm soát tối đa.</li>
                    <li>Lõi tổ ong polymer 16mm giúp giảm rung và tăng sức mạnh.</li>
                    <li>Công nghệ Edge Shield bảo vệ cạnh vợt khỏi va đập.</li>
                    <li>Trọng lượng cân bằng, phù hợp với nhiều lối chơi khác nhau.</li>
                </ul>
            </div>
        </div>
        <!-- Customer Reviews -->
        <div class="w-full mt-8">
            <h3 class="text-2xl font-bold mb-6">Đánh giá từ khách hàng</h3>
            <!-- RatingSummary -->
            <div class="flex flex-wrap gap-x-8 gap-y-6 p-6 rounded-lg bg-primary/5 dark:bg-primary/10">
                <div class="flex flex-col gap-2">
                    <p class="text-4xl font-black leading-tight tracking-[-0.033em]">4.8</p>
                    <div class="flex gap-0.5">
                        <span class="material-symbols-outlined text-yellow-400 text-lg"
                            style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined text-yellow-400 text-lg"
                            style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined text-yellow-400 text-lg"
                            style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined text-yellow-400 text-lg"
                            style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined text-yellow-400 text-lg">star_half</span>
                    </div>
                    <p class="text-base font-normal leading-normal">Dựa trên 125 đánh giá</p>
                </div>
                <div class="grid min-w-[200px] max-w-[400px] flex-1 grid-cols-[20px_1fr_40px] items-center gap-y-3">
                    <p class="text-sm font-normal leading-normal">5</p>
                    <div class="flex h-2 flex-1 overflow-hidden rounded-full bg-primary/20">
                        <div class="rounded-full bg-primary" style="width: 85%;"></div>
                    </div>
                    <p class="text-primary/80 text-sm font-normal leading-normal text-right">85%</p>
                    <p class="text-sm font-normal leading-normal">4</p>
                    <div class="flex h-2 flex-1 overflow-hidden rounded-full bg-primary/20">
                        <div class="rounded-full bg-primary" style="width: 10%;"></div>
                    </div>
                    <p class="text-primary/80 text-sm font-normal leading-normal text-right">10%</p>
                    <p class="text-sm font-normal leading-normal">3</p>
                    <div class="flex h-2 flex-1 overflow-hidden rounded-full bg-primary/20">
                        <div class="rounded-full bg-primary" style="width: 3%;"></div>
                    </div>
                    <p class="text-primary/80 text-sm font-normal leading-normal text-right">3%</p>
                    <p class="text-sm font-normal leading-normal">2</p>
                    <div class="flex h-2 flex-1 overflow-hidden rounded-full bg-primary/20">
                        <div class="rounded-full bg-primary" style="width: 2%;"></div>
                    </div>
                    <p class="text-primary/80 text-sm font-normal leading-normal text-right">2%</p>
                    <p class="text-sm font-normal leading-normal">1</p>
                    <div class="flex h-2 flex-1 overflow-hidden rounded-full bg-primary/20">
                        <div class="rounded-full bg-primary" style="width: 0%;"></div>
                    </div>
                    <p class="text-primary/80 text-sm font-normal leading-normal text-right">0%</p>
                </div>
            </div>
        </div>
        <!-- Related Products Section -->
        <div class="w-full mt-16">
            <h3 class="text-2xl font-bold mb-6">Sản phẩm liên quan</h3>
            <div data-category="{{ $data->category->id }}" data-product="{{ $data->id }}" id="product_recommend" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                
            </div>
        </div>
    </div>
</div>
<script>
    const qtyInput = document.getElementById('qty-input');
    const btnMinus = document.getElementById('qty-minus');
    const btnPlus  = document.getElementById('qty-plus');

    btnPlus.addEventListener('click', () => {
        qtyInput.value = parseInt(qtyInput.value) + 1;
    });

    btnMinus.addEventListener('click', () => {
        let val = parseInt(qtyInput.value);
        if (val > 1) qtyInput.value = val - 1;
    });

    // Set ảnh đầu mặc định
    $('#mainImage').css('background-image', `url('${$('.thumb').first().data('img')}')`);

    $(document).on('click', '.thumb', function () {
        $('.thumb')
            .removeClass('border-primary')
            .addClass('border-gray-300 dark:border-gray-600');

        $(this)
            .removeClass('border-gray-300 dark:border-gray-600')
            .addClass('border-primary');

        $('#mainImage').css('background-image', `url('${$(this).data('img')}')`);
    });

    function renderProductRecommend(item){
        return `
        <a href="/san-pham/${item.slug}">
            <div class="flex flex-col gap-2 group">
                <div
                    class="w-full bg-center bg-no-repeat bg-cover flex flex-col justify-end overflow-hidden rounded-lg aspect-[4/5] bg-gray-200 dark:bg-gray-700"
                    data-alt="Pickleball Paddle Edge Guard"
                    style='background-image: url("${
                                item.image
                                    ? '/storage/' + JSON.parse(item.image)[0]
                                    : '/images/no-image.png'
                            }");'>
                </div>
                <p class="text-base font-bold leading-normal group-hover:text-primary transition-colors">${item.name}</p>
                <p class="text-base font-bold leading-normal text-primary">${formatPrice(item.price)}₫</p>
            </div>
        </a>
        `
    }

    function getProductRecommend(){
        categoryId = $('#product_recommend').data('category');
        productId = $('#product_recommend').data('product');

        $.ajax({
            url: '/api/products/related/' + categoryId + '/' + productId,
            method: 'GET',
            contentType: 'application/json',
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                const prd = res.data;
                $('#product_recommend').html('');
                prd.forEach(category => {
                    $('#product_recommend').append(renderProductRecommend(category));
                });
            },
            error: function(err) {
                console.error('Không thể tải danh sách sản phẩm:', err);
            }
        });
    }

    $(document).ready(function() {
        getProductRecommend();
    });

    function formatPrice(price) {
        if (!price) return '0';

        // Ép về string → bỏ phần thập phân
        const integerPart = price.toString().split('.')[0];

        // Format dấu phẩy
        return integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    $(document).on('change', 'input[type=radio][name^="attribute_"]', function () {

        const productId = $('#product_detail').data('product-id');

        // Lấy tất cả attribute đã chọn
        const selected = [];
        $('input[type=radio][name^="attribute_"]:checked').each(function () {
            selected.push(Number($(this).val()));
        });

        // Tổng số nhóm thuộc tính
        const totalAttrs = $('.options > div').length || $('input[type=radio][name^="attribute_"]').map(function () {
            return $(this).attr('name');
        }).get().filter((v, i, a) => a.indexOf(v) === i).length;

        if (selected.length !== totalAttrs) return;

        $.ajax({
            url: '/api/product-variant/' + productId,
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + getCookie('user_token'),
                'Accept': 'application/json'
            },
            data: { attribute_value_ids: selected },
            success(res) {
                const variant = res.data;
                if (!variant) return;

                // Update giá
                $('#product_price').text(
                    formatPrice(variant.price) + '₫'
                );

                // Update tồn kho
                if (variant.quantity > 0) {
                    $('#product_stock')
                        .text(`Còn ${variant.quantity} sản phẩm`)
                        .removeClass('text-red-500')
                        .addClass('text-primary');
                } else {
                    $('#product_stock')
                        .text('Hết hàng')
                        .removeClass('text-primary')
                        .addClass('text-red-500');
                }
            }
        });
    });

    $(document).on('click', '#btn_add_cart', function () {
        const wrapper = $('#product_detail');
        const parentId = wrapper.data('product-id');

        // Lấy các attribute_value_id đã chọn
        const attributeValueIds = [];
        wrapper.find('input[type=radio][name^="attribute_"]:checked').each(function () {
            attributeValueIds.push(Number($(this).val()));
        });

        // Tổng số nhóm thuộc tính
        const totalAttrs = new Set(
            wrapper.find('input[type=radio][name^="attribute_"]').map(function () {
                return $(this).attr('name');
            }).get()
        ).size;

        if (attributeValueIds.length !== totalAttrs) {
            Swal.fire('Thiếu thuộc tính', 'Vui lòng chọn đầy đủ thuộc tính!', 'warning');
            return;
        }

        const qty = parseInt($('#qty-input').val()) || 1;

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
                loadCartBadge();
            },
            error(xhr) {
                if (xhr.status === 401) {
                    // Xử lý riêng cho lỗi chưa đăng nhập
                    Swal.fire({
                        title: 'Bạn cần đăng nhập để thực hiện chức năng này!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Đăng nhập ngay',
                        cancelButtonText: 'Để sau'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Điều hướng người dùng đến trang đăng nhập
                            window.location.href = '/dang-nhap'; // Thay đổi đường dẫn theo route của bạn
                        }
                    });
                } else {
                    Swal.fire('Lỗi', xhr.responseJSON?.message || 'Không thể thêm vào giỏ', 'error');
                }
            }
        });
    });

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';')[0];
        return null;
    }

    $('#btn_buy_now').click(function() {
        const userToken = getCookie('user_token');
        if (!userToken) {
            Swal.fire({
                title: 'Bạn cần đăng nhập để thực hiện chức năng mua hàng!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đăng nhập ngay',
                cancelButtonText: 'Để sau'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Điều hướng đến trang đăng nhập
                    window.location.href = '/dang-nhap'; 
                }
            });
            return; // Dừng hàm, không chạy các logic bên dưới
        }
        const wrapper = $('#product_detail');

        const attributeGroups = new Set();
        wrapper.find('input[type=radio][name^="attribute_"]').each(function() {
            attributeGroups.add($(this).attr('name'));
        });

        // 2. Lấy danh sách các thuộc tính đã check
        const checkedAttributes = wrapper.find('input[type=radio][name^="attribute_"]:checked');

        // 3. So sánh: Nếu số lượng đã chọn < số lượng nhóm hiện có => Chưa chọn đủ
        if (checkedAttributes.length < attributeGroups.size) {
            Swal.fire({
                icon: 'warning',
                title: 'Thiếu thuộc tính',
                text: 'Vui lòng chọn đầy đủ thuộc tính',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#3085d6'
            });
            return; // Dừng thực hiện các bước tiếp theo
        }

        const parentId = wrapper.data('parent-id');
        const name      = wrapper.data('name');
        const image     = wrapper.data('image');
        const price     = parseInt(wrapper.data('price')) || 0;

        const attributeValueIds = [];
        let attrs = [];

        // Lấy các attribute đã chọn
        wrapper.find('input[type=radio][name^="attribute_"]:checked').each(function () {
            attributeValueIds.push(Number($(this).val()));
            attrs.push($(this).next().text().trim()); // push text vào mảng
        });

        const attrsText = attrs.join(' - '); // nối bằng dấu " - "

        const qty = parseInt($('#qty-input').val()) || 1;

        const item = {
            parent_id: parentId,
            name: `${name} - ${attrsText}`,
            image: image,
            price: price,
            attrs: attrsText,
            attribute_value_ids: attributeValueIds,
            quantity: qty
        };

        // Xoá session cũ
        sessionStorage.removeItem('checkout_items');

        // Tạo session mới chỉ với sản phẩm này
        const checkoutItems = [item];
        sessionStorage.setItem('checkout_items', JSON.stringify(checkoutItems));
        // Chuyển đến trang thanh toán
        window.location.href = '/thanh-toan';
    });


</script>
@endsection