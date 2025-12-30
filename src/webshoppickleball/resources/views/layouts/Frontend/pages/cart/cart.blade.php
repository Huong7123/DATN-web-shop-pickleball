@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div class="layout-content-container flex flex-col w-full">
        <!-- Breadcrumbs Component -->
        <div class="flex flex-wrap gap-2 pb-6">
            <a class="text-gray-600 dark:text-gray-400 hover:text-primary text-sm font-medium leading-normal"
                href="#">Trang chủ</a>
            <span class="text-gray-400 dark:text-gray-500 text-sm font-medium leading-normal">/</span>
            <span class="text-gray-900 dark:text-white text-sm font-medium leading-normal">Giỏ hàng</span>
        </div>
        <!-- PageHeading Component -->
        <div class="flex flex-wrap justify-between gap-3 pb-8">
            <h1 class="text-gray-900 dark:text-white text-4xl font-black leading-tight tracking-[-0.033em] min-w-72">Giỏ
                Hàng Của Bạn</h1>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 xl:gap-12">
            <div class="lg:col-span-2">
                <!-- Table Component -->
                <div class="w-full @container">
                    <div
                        class="flex overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800 bg-background-light dark:bg-background-dark">
                        <div id="cart_empty"
                            class="hidden w-full min-h-[300px] flex flex-col items-center justify-center gap-3 text-center">
                            <span class="material-symbols-outlined text-5xl text-gray-300">shopping_cart</span>
                            <p class="text-gray-500">Giỏ hàng của bạn đang trống</p>
                            <a href="/san-pham" class="text-primary hover:underline text-sm">
                                Tiếp tục mua sắm
                            </a>
                        </div>
                        <table id="cart_table" class="w-full text-left">
                            
                        </table>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-1">
                <div class="sticky top-28">
                    <!-- SectionHeader Component -->
                    <h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] pb-4">
                        Tóm Tắt Đơn Hàng</h2>
                    <div class="bg-gray-100/50 dark:bg-gray-900/50 rounded-xl p-6 space-y-4">
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Tạm tính</p>
                            <p class="text-sm font-medium">₫2,800,000</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Phí vận chuyển</p>
                            <p class="text-sm font-medium">Miễn phí</p>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-800 my-4"></div>
                        <div class="flex justify-between items-center">
                            <p class="text-base font-bold text-gray-900 dark:text-white">Tổng cộng</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-white">₫2,800,000</p>
                        </div>
                        <button id="btn_buy_order"
                            class="w-full mt-4 flex items-center justify-center rounded-lg h-12 bg-primary text-black text-base font-bold leading-normal tracking-[0.015em] hover:bg-opacity-90 transition-all">
                            Tiến Hành Thanh Toán
                        </button>
                        <div class="pt-4 text-center">
                            <p class="text-xs text-gray-500">Các phương thức thanh toán được chấp nhận:</p>
                            <div class="flex justify-center items-center gap-3 mt-2">
                                <img class="h-6 opacity-60" data-alt="Visa logo"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAMyzS248MtOGaVA3Rsjq_X2u2huATGbzjvwNifUWzPsX9Ch68Gmtt0sehPA1Op_ixUWfogPSprCK8VCfQNf7LFMpye0ChKhM0_mWkImBa0cFM2nPIDYks7Y3oCk-FviI2krZAhoC_ow7VLmdlq_Yrjjh-llFqK7JMpGOGXxFWk2_mDvgPnYdJ-qs70NbN3EnCf_QKlJNHthUsY80yZKnG7nxq_14h7AEG4Ns9R2WkBvAbKChGobYwzq1gc347p4NuNy7WtOFOdaPFj" />
                                <img class="h-6 opacity-60" data-alt="Mastercard logo"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQFsqXFGXThDvnxbfvvV2LV-R2DPPiVZ48mySjtRSL85QjADzJdkgfxLNh3HGPd5sRFJNcvlCQddz1PdDRiX_DPMruyrbjDHw0z3zbrFCzL_JFv5ALt1xQBbJQPOV0cSLATtvWa0TIGcdy7ifMIChy_LkHSp8tfmXSnxeDMyCzY-9TRMYPqiBCezOzKnhqL7N1ftph1rG9vzvUoi_r78ZNuCOXaahsrh06srieJ6e6EmvQZTRLIDm0AbJbPH9mr3ozSbAi9z3T4I95" />
                                <img class="h-6 opacity-60" data-alt="Momo logo"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDMM6KsOKCxP3dNGVJ48IvE8ZjOkvan8aw-I_Y3FXFtIzFADftoCaoLGHmphdHu8ERLuef_xztr8mm9GgtD8AV4GIfaSOTMc9NGOgejIbbZyl2OTH5ewbUjkVMw_LzN5lFidXLcKYx4XTYSTjLcJ7Q4wOBJGNAaNRhf_oNajaqFBAfevUnk0Lj0yCcOT0nBs0Bnr-bkjkfECKMjHFo7KoTLhQ8P2jEgNofDunl2zz_ExsBeacLBb6eRtYiQoP8VGUuBqjixhxfECTWl" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn_buy_order').on('click', function () {
        window.location.href = '/thanh-toan';
    });

    function formatPrice(price) {
        if (!price) return '0';

        // Ép về string → bỏ phần thập phân
        const integerPart = price.toString().split('.')[0];

        // Format dấu phẩy
        return integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function loadCart() {
        const token = getCookie('user_token');
        const userId = sessionStorage.getItem('id');
        if (!token || !userId) return;

        $.ajax({
            url: '/api/cart/' + userId,
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json'
            },
            success(res) {
                const table = $('#cart_table');
                const emptyBox = $('#cart_empty');

                table.html('');

                // ===== GIỎ RỖNG =====
                if (!res.data || res.data.length === 0) {
                    table.hide();
                    emptyBox.removeClass('hidden');
                    $('#cart_total').text('₫0');
                    return;
                }

                // ===== CÓ SẢN PHẨM =====
                table.show();
                emptyBox.addClass('hidden');

                let totalCart = 0;

                res.data.forEach(item => {
                    const product = item.product;
                    const qty = item.quantity;
                    const price = item.price;
                    const subTotal = qty * price;
                    totalCart += subTotal;

                    const attrs = product.attribute_values.map(a => a.name).join(' - ');

                    const image = product.image 
                        ? '/storage/' + JSON.parse(product.image)[0] 
                        : '/images/no-image.png';

                    table.append(`
                        <thead class="bg-gray-100/50 dark:bg-gray-900/50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-gray-600 dark:text-gray-400 text-xs font-medium uppercase tracking-wider">
                                    Sản phẩm</th>
                                <th
                                    class="px-6 py-4 text-left text-gray-600 dark:text-gray-400 text-xs font-medium uppercase tracking-wider">
                                    Giá</th>
                                <th
                                    class="px-6 py-4 text-left text-gray-600 dark:text-gray-400 text-xs font-medium uppercase tracking-wider">
                                    Số lượng</th>
                                <th
                                    class="px-6 py-4 text-left text-gray-600 dark:text-gray-400 text-xs font-medium uppercase tracking-wider">
                                    Tạm tính</th>
                                <th class="px-6 py-4 text-right"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                            <tr data-id="${item.id}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="bg-cover rounded-lg w-16 h-16"
                                            style="background-image:url('${image}')"></div>
                                        <div>
                                            <p class="font-semibold">${product.name}</p>
                                            <p class="text-xs text-gray-500">${attrs}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    ₫${formatPrice(price)}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center border rounded-md w-28">
                                        <button class="w-9 h-9 flex items-center justify-center hover:bg-slate-100 cart-decrease"
                                            data-id="${item.id}">
                                            <span class="material-symbols-outlined text-[18px]">remove</span>
                                        </button>
                                        <input type="number" readonly value="${qty}"
                                            class="cart-qty w-12 text-center bg-transparent text-sm font-bold text-[#0d1b12] dark:text-white
                                    border-none focus:ring-0 p-0 [&::-webkit-inner-spin-button]:appearance-none">
                                        <button class="w-9 h-9 flex items-center justify-center hover:bg-slate-100 cart-increase"
                                            data-id="${item.id}">
                                            <span class="material-symbols-outlined text-[18px]">add</span>
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-primary cart-subtotal" data-price="${price}">
                                    ₫${formatPrice(subTotal)}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="btn-remove text-gray-500 hover:text-red-500"
                                        data-id="${item.id}">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    `);
                });

                $('#cart_total').text('₫' + totalCart.toLocaleString());
            }
        });
    }

    $(document).on('click', '.cart-increase', function () {
        const row = $(this).closest('tr');
        const input = row.find('.cart-qty');
        const subtotalCell = row.find('.cart-subtotal');
        const price = parseInt(subtotalCell.data('price'));
        const id = row.data('id');

        let qty = parseInt(input.val()) + 1;
        input.val(qty);

        // Update subtotal dòng
        subtotalCell.text('₫' + formatPrice(price * qty));

        recalcCartTotal();

        updateCartQty(id, qty);
    });

    $(document).on('click', '.cart-decrease', function () {
        const row = $(this).closest('tr');
        const input = row.find('.cart-qty');
        const subtotalCell = row.find('.cart-subtotal');
        const price = parseInt(subtotalCell.data('price'));
        const id = row.data('id');

        let qty = parseInt(input.val());
        if (qty <= 1) return;

        qty--;
        input.val(qty);

        subtotalCell.text('₫' + formatPrice(price * qty));

        recalcCartTotal();

        updateCartQty(id, qty);
    });

    function recalcCartTotal() {
        let total = 0;
        $('.cart-subtotal').each(function () {
            total += parseInt($(this).text().replace(/[^\d]/g, ''));
        });
        $('#cart_total').text('₫' + formatPrice(total));
    }

    $(document).ready(function () {
        loadCart();
    });

</script>
@endsection