@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div class="mb-8">
        <div class="flex flex-wrap items-center gap-2 text-sm">
            <a class="text-primary text-sm font-medium leading-normal hover:underline" href="/">Trang chủ</a>
            <span class="text-subtle-light dark:text-subtle-dark">/</span>
            <a class="text-primary text-sm font-medium leading-normal hover:underline" href="/gio-hang">Giỏ hàng</a>
            <span class="text-subtle-light dark:text-subtle-dark">/</span>
            <span class="font-medium">Thanh toán</span>
        </div>
    </div>
    <div class="flex flex-col-reverse gap-12 lg:flex-row">
        <!-- Left Column: Checkout Process -->
        <div class="w-full lg:w-3/5">
            <div class="mb-8">
                <p class="text-4xl font-black tracking-tighter">Thanh toán</p>
            </div>
            <div class="space-y-10">
                <!-- Shipping Information -->
                <section>
                    <h2 class="text-2xl font-bold tracking-tight">1. Thông tin giao hàng</h2>
                    <div id="list_address" class="mt-6">
                        <label class="mb-2 block text-sm font-medium">Sổ địa chỉ</label>
                        <div class="relative">
                            <details class="group relative" id="address_details">
                                <summary class="flex cursor-pointer list-none items-center justify-between rounded-lg border border-border-light bg-background-light p-4 shadow-sm outline-none hover:border-primary dark:border-border-dark dark:bg-background-dark">
                                    <div class="flex flex-col gap-1 text-left" id="address_summary_content">
                                        <span class="text-sm text-gray-400">Đang tải địa chỉ...</span>
                                    </div>
                                    <span class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                                </summary>
                                
                                <div class="absolute left-0 top-full z-20 mt-2 w-full overflow-hidden rounded-lg border border-border-light bg-white shadow-xl dark:border-border-dark dark:bg-background-dark">
                                    <div class="max-h-64 overflow-y-auto p-2" id="address_options_list">
                                    </div>
                                </div>
                            </details>
                        </div>
                    </div>
                    <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-medium">Họ và tên</label>
                            <input id="user_name"
                                class="form-input block h-14 w-full rounded-lg border border-border-light bg-background-light p-4 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark dark:placeholder:text-subtle-dark"
                                placeholder="Nguyễn Văn A" type="text" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium">Số điện thoại</label>
                            <input id="user_phone"
                                class="form-input block h-14 w-full rounded-lg border border-border-light bg-background-light p-4 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark dark:placeholder:text-subtle-dark"
                                placeholder="090 xxx xxxx" type="tel" />
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-2 block text-sm font-medium">Địa chỉ</label>
                            <input id="address"
                                class="form-input block h-14 w-full rounded-lg border border-border-light bg-background-light p-4 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark dark:placeholder:text-subtle-dark"
                                placeholder="Số nhà, tên đường, phường xã, quận huyện, tỉnh thành phố" type="text" />
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-2 block text-sm font-medium">Ghi chú</label>
                            <input id="description"
                                class="form-input block h-14 w-full rounded-lg border border-border-light bg-background-light p-4 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark dark:placeholder:text-subtle-dark"
                                placeholder="Ghi chú đơn hàng" type="text" />
                        </div>
                    </div>
                    
                </section>
                <!-- Shipping Method -->
                <section>
                    <h2 class="text-2xl font-bold tracking-tight">2. Phương thức vận chuyển</h2>
                    <div class="mt-6 space-y-4">
                        <label data-fee="0" class="shipping-option flex cursor-pointer items-center rounded-lg border border-border-light p-4 has-[:checked]:border-primary has-[:checked]:bg-primary/10">
                            <input checked name="shipping" type="radio"
                                class="form-radio h-5 w-5 text-primary focus:outline-none focus:ring-0 focus:ring-offset-0">
                            <div class="ml-4 flex flex-grow items-center justify-between">
                                <div>
                                    <p class="font-medium">Giao hàng tiêu chuẩn</p>
                                    <p class="text-sm text-subtle-light">Dự kiến 3-5 ngày</p>
                                </div>
                                <p class="font-semibold">0đ</p>
                            </div>
                        </label>

                        <label data-fee="30000" class="shipping-option flex cursor-pointer items-center rounded-lg border border-border-light p-4 has-[:checked]:border-primary has-[:checked]:bg-primary/10">
                            <input name="shipping" type="radio"
                                class="form-radio h-5 w-5 text-primary focus:outline-none focus:ring-0 focus:ring-offset-0">
                            <div class="ml-4 flex flex-grow items-center justify-between">
                                <div>
                                    <p class="font-medium">Giao hàng nhanh</p>
                                    <p class="text-sm text-subtle-light">Dự kiến 1-2 ngày</p>
                                </div>
                                <p class="font-semibold">30.000đ</p>
                            </div>
                        </label>

                    </div>
                </section>
                <!-- Payment Method -->
                <section>
                    <h2 class="text-2xl font-bold tracking-tight">3. Phương thức thanh toán</h2>
                    <div class="mt-6 space-y-4">
                        <label
                            class="flex cursor-pointer items-center rounded-lg border border-border-light p-4 has-[:checked]:border-primary has-[:checked]:bg-primary/10 dark:border-border-dark dark:has-[:checked]:border-primary">
                            <input checked class="form-radio h-5 w-5 text-primary focus:outline-none focus:ring-0 focus:ring-offset-0" name="payment" type="radio" />
                            <span class="ml-4 font-medium">Thanh toán khi nhận hàng</span>
                        </label>
                        <label
                            class="flex cursor-pointer items-center rounded-lg border border-border-light p-4 has-[:checked]:border-primary has-[:checked]:bg-primary/10 dark:border-border-dark dark:has-[:checked]:border-primary">
                            <input class="form-radio h-5 w-5 text-primary focus:outline-none focus:ring-0 focus:ring-offset-0" name="payment" type="radio" />
                            <span class="ml-4 font-medium">VNPay</span>
                        </label>
                    </div>
                </section>
            </div>
        </div>
        <!-- Right Column: Order Summary -->
        <div class="w-full lg:w-2/5">
            <div
                class="sticky top-24 rounded-lg border border-border-light bg-white p-6 shadow-sm dark:border-border-dark dark:bg-background-dark">
                <h2 class="text-2xl font-bold tracking-tight">Đơn hàng của bạn</h2>
                <div id="checkout_products" class="mt-6 space-y-4">
                    
                </div>
                <div class="my-6 border-t border-border-light dark:border-border-dark"></div>
                <div class="flex items-end gap-3 cursor-pointer" onclick="openVoucherModal()">
                    <div class="flex-grow">
                        <label class="mb-2 block text-sm font-medium">Mã giảm giá</label>
                        <div id="selected_voucher_display" 
                            class="flex h-12 w-full items-center justify-between rounded-lg border border-dashed border-primary bg-primary/5 px-4">
                            <span class="text-sm text-subtle-light dark:text-gray-400" id="voucher_placeholder">Chưa có mã giảm giá nào được áp dụng</span>
                            <i class="fa-solid fa-chevron-right text-primary text-xs"></i>
                        </div>
                    </div>
                </div>
                <div class="my-6 border-t border-border-light dark:border-border-dark"></div>
                <div id="checkout_summary" class="space-y-3">

                </div>
                <button id="btn_place_order"
                    class="mt-8 h-14 w-full rounded-lg bg-primary text-lg font-bold text-background-dark shadow-lg shadow-primary/20">
                    Hoàn tất đơn hàng
                </button>
            </div>
        </div>
    </div>
</div>
<div id="voucher_modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 p-4">
    <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl dark:bg-background-dark border dark:border-white/10">
        <div class="mb-4 flex items-center justify-between">
            <h3 class="text-lg font-bold">Chọn Voucher</h3>
            <button onclick="closeVoucherModal()" class="text-gray-500 hover:text-red-500">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <div id="voucher_list_modal" class="max-h-[400px] overflow-y-auto flex flex-col gap-3">
            
        </div>
    </div>
</div>

<script>
    let selectedVoucher = null;
    let discountAmount = 0;
    window.voucherList = [];

    function getSubTotal() {
        let subTotal = 0;
        checkoutItems.forEach(i => {
            subTotal += i.price * i.quantity;
        });
        return subTotal;
    }

    function formatPricePercent(price) {
        if (!price) return '0';

        // Ép về string → bỏ phần thập phân
        const integerPart = price.toString().split('.')[0];

        // Format dấu phẩy
        return integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }
    function getAllVoucher() {
        const userId = sessionStorage.getItem('id');
        const subTotal = getSubTotal(); 
        $.ajax({
            url: '/api/offer',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getCookie('user_token')
            },
            success: function (response) {
                let html = '';
                window.voucherList = [];
                const data = response.data; // Đây là mảng các Offer

                // 1. Kiểm tra xem data có phần tử nào không
                if (!data || data.length === 0) {
                    html = `<p class="text-center text-gray-400">Bạn chưa có voucher nào</p>`;
                } else {
                    // 2. Lặp qua từng Offer (thường mỗi user chỉ có 1 bản ghi offer như bạn muốn)
                    data.forEach(item => {
                        // 3. Lặp qua mảng offer_details bên trong
                        if (item.offer_details && item.offer_details.length > 0) {
                            item.offer_details.forEach(detail => {
                                const discount = detail.discount;// Debug thông tin chi tiết giảm giá
                                window.voucherList.push(discount);
                                const minOrder = parseFloat(discount.min_order_value || 0);
                                const isEligible = subTotal >= minOrder;

                                html += `
                                <label 
                                    class="voucher-item flex items-start gap-4 p-3 rounded-xl border
                                        ${isEligible ? 'border-gray-100 hover:bg-primary/5 cursor-pointer' : 'border-gray-200 opacity-50'}
                                    "
                                    data-code="${discount.code}"
                                >
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-[#0d1b12] dark:text-white">
                                            ${discount.code}
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ${discount.title || 'Ưu đãi'} -
                                            ${
                                                discount.discount_type === 'percentage'
                                                ? `Giảm ${formatPricePercent(discount.discount_value)}%
                                                    ${
                                                        parseFloat(discount.max_discount_amount) > 0
                                                        ? `tối đa ${formatPrice(discount.max_discount_amount)}`
                                                        : ''
                                                    }`
                                                : `Giảm ${formatPrice(discount.discount_value)}`
                                            }
                                            cho đơn từ ${formatPrice(minOrder)}
                                        </p>

                                        ${
                                            !isEligible
                                            ? `<p class="mt-1 text-xs text-red-500 font-medium">
                                                Chưa đủ điều kiện (đơn hiện tại: ${formatPrice(subTotal)})
                                            </p>`
                                            : ''
                                        }
                                    </div>
                                </label>
                                `;
                            });
                        }
                    });
                }

                // Nếu lặp xong mà vẫn không có html (trường hợp data có nhưng offer_details rỗng)
                if (html === '') {
                    html = `<p class="text-center text-gray-400">Bạn chưa có voucher nào khả dụng</p>`;
                }

                $('#voucher_list_modal').html(html);
            },
            error: function(error) {
                Swal.fire('Lỗi', 'Không thể tải danh sách voucher', 'error');
            }
        });
    }

    // Mở Modal và load dữ liệu
    function openVoucherModal() {
        $('#voucher_modal').removeClass('hidden').addClass('flex');
        
    }

    // Đóng Modal
    function closeVoucherModal() {
        $('#voucher_modal').addClass('hidden').removeClass('flex');
    }

    $(document).on('click', '.voucher-item', function () {
        if ($(this).hasClass('cursor-not-allowed')) return;

        const code = $(this).data('code');
        selectVoucher(code);
    });


    // Hàm chọn Voucher từ danh sách
    function selectVoucher(code) {
        const voucher = window.voucherList.find(v => v.code === code);
        if (!voucher) return;

        selectedVoucher = voucher;

        $('#voucher_placeholder').html(`
            <div class="flex items-center gap-2">
                <span class="bg-primary text-black px-2 py-0.5 rounded text-xs font-bold">
                    ${voucher.code}
                </span>
                <span class="text-black dark:text-white font-medium truncate">
                    ${
                        voucher.discount_type === 'percentage'
                        ? `Giảm ${formatPricePercent(voucher.discount_value)}%
                            ${
                                parseFloat(voucher.max_discount_amount) > 0
                                ? `tối đa ${formatPrice(voucher.max_discount_amount)}`
                                : ''
                            }`
                        : `Giảm ${formatPrice(voucher.discount_value)}`
                    }
                </span>
            </div>
        `);

        calculateDiscount();
        renderCheckoutSummary();
        closeVoucherModal();
    }


    function findVoucherByCode(code) {
        return window.voucherList.find(v => v.code === code);
    }

    function calculateDiscount() {
        discountAmount = 0;

        if (!selectedVoucher) return 0;

        const subTotal = getSubTotal();
        const discountValue = parseFloat(selectedVoucher.discount_value);
        const maxDiscount = parseFloat(selectedVoucher.max_discount_amount || 0);

        // CHỈ xử lý percentage trước (đúng yêu cầu bạn nói)
        if (selectedVoucher.discount_type === 'percentage') {
            let calculated = subTotal * discountValue / 100;

            if (maxDiscount > 0 && calculated > maxDiscount) {
                discountAmount = maxDiscount;
            } else {
                discountAmount = calculated;
            }
        } else{
            discountAmount = discountValue;
        }

        return discountAmount;
    }



    // Đóng modal khi click ra ngoài vùng trắng
    $(window).on('click', function(e) {
        if ($(e.target).is('#voucher_modal')) {
            closeVoucherModal();
        }
    });

    let shippingFee = 0;

    function getShippingFee() {
        return parseInt(
            $('input[name="shipping"]:checked')
                .closest('.shipping-option')
                .data('fee')
        ) || 0;
    }

    function formatPrice(price) {
        if (!price) return '0';

        // Ép về string → bỏ phần thập phân
        const integerPart = price.toString().split('.')[0];

        // Format dấu phẩy
        return integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '₫';
    }

    const checkoutItems = JSON.parse(sessionStorage.getItem('checkout_items') || '[]');

    function renderCheckoutProducts() {
        $('#checkout_products').html('');

        checkoutItems.forEach(item => {
            const rowTotal = item.price * item.quantity;

            $('#checkout_products').append(`
                <div class="flex items-center gap-4">
                    <div class="relative h-20 w-20 flex-shrink-0">
                        <img src="${item.image}" class="h-full w-full rounded-lg object-cover">
                        <span class="absolute -right-2 -top-2 flex h-6 w-6 items-center justify-center rounded-full bg-primary text-xs font-bold text-background-dark">
                            ${item.quantity}
                        </span>
                    </div>
                    <div class="flex-grow">
                        <p class="font-medium">${item.name}</p>
                        ${item.attrs ? `<p class="text-sm text-subtle-light">${item.attrs}</p>` : ''}
                    </div>
                    <p class="font-semibold">${formatPrice(rowTotal)}</p>
                </div>
            `);
        });
    }

    function renderCheckoutSummary() {
        const subTotal = getSubTotal();
        calculateDiscount();

        const grandTotal = Math.max(
            0,
            subTotal + shippingFee - discountAmount
        );

        $('#checkout_summary').html(`
            <div class="flex justify-between">
                <span>Tạm tính</span>
                <span>${formatPrice(subTotal)}</span>
            </div>

            ${
                discountAmount > 0
                ? `<div class="flex justify-between text-green-600">
                    <span>Giảm giá</span>
                    <span id="discount" data-discount="${discountAmount}">- ${formatPrice(discountAmount)}</span>
                </div>`
                : ''
            }

            <div class="flex justify-between">
                <span>Phí vận chuyển</span>
                <span>${formatPrice(shippingFee)}</span>
            </div>

            <div class="flex justify-between text-lg font-bold">
                <span>Tổng cộng</span>
                <span>${formatPrice(grandTotal)}</span>
            </div>
        `);
    }


    $(document).on('change', 'input[name="shipping"]', function () {
        shippingFee = getShippingFee();
        renderCheckoutSummary();
    });

    $(document).ready(function () {
        shippingFee = getShippingFee();
        renderCheckoutProducts();
        renderCheckoutSummary();
        getAllAddress();
        getAllVoucher();
    });

    $('#btn_place_order').click(function () {
        const token = getCookie('user_token');

        if (!checkoutItems.length) {
            Swal.fire('Lỗi', 'Không có sản phẩm để thanh toán', 'error');
            return;
        }

        const discount = parseInt($('#discount').data('discount')) || 0;
        const shippingMethod = $('input[name="shipping"]:checked').closest('.shipping-option').data('fee') == 30000 ? 1 : 0;
        
        // Lấy phương thức thanh toán
        const paymentMethod = $('input[name="payment"]:checked').next().text().includes('VNPay') ? 'vnpay' : 'cod';

        const data = {
            user_name: $('#user_name').val(),
            user_phone: $('#user_phone').val(),
            address: $('#address').val(),
            description: $('#description').val(),
            payment_method: paymentMethod,
            shipping_method: shippingMethod,
            discount_id: selectedVoucher ? selectedVoucher.id : null,
            discount: discount,
            items: checkoutItems.map(i => ({
                parent_id: i.parent_id,
                attribute_value_ids: i.attribute_value_ids,
                quantity: i.quantity
            }))
        };

        $.ajax({
            url: '/api/order',
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            data: JSON.stringify(data),
            beforeSend: function () {
                showLoader(); // HIỆN LOADER
            },
            success(res) {
                // res thường chứa thông tin đơn hàng vừa tạo, ví dụ: res.data.id hoặc res.order_id
                const orderId = res.data.id; 
                const totalAmount = res.data.total;

                if (paymentMethod === 'vnpay') {
                    // GỌI API THỨ 2: Tạo link VNPay
                    $.ajax({
                        url: '/api/vnpay/create',
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        data: JSON.stringify({
                            order_id: orderId,
                            amount: totalAmount
                        }),
                        success(vnpayRes) {
                            // vnpayRes.data.payment_url là link nhận được từ VnpayService
                            if (vnpayRes.data && vnpayRes.data.payment_url) {
                                Swal.close();
                                sessionStorage.removeItem('checkout_items');
                                window.location.href = vnpayRes.data.payment_url;
                            } else {
                                Swal.fire('Lỗi', 'Không thể tạo link thanh toán VNPay', 'error');
                            }
                        },
                        error(err) {
                            Swal.close();
                            Swal.fire('Lỗi', 'Lỗi kết nối VNPay, vui lòng thử lại trong lịch sử đơn hàng', 'error');
                        }
                    });
                } else {
                    Swal.close();
                    // NẾU LÀ COD: Chỉ thông báo thành công và chuyển trang
                    Swal.fire({
                        icon: 'success',
                        title: 'Đặt hàng thành công',
                        timer: 1500,
                        showConfirmButton: false,
                        willClose: () => {
                            sessionStorage.removeItem('checkout_items');
                            window.location.href = '/lich-su-don-hang';
                        }
                    });
                }
            },
            error(err) {
                Swal.hideLoading();
                if (err.status === 422 && err.responseJSON?.errors) {
                    const firstField = Object.keys(err.responseJSON.errors)[0];
                    const firstMessage = err.responseJSON.errors[firstField][0];
                    Swal.fire({ icon: 'error', title: 'Lỗi xác thực', text: firstMessage });
                } else {
                    Swal.fire('Lỗi', err.responseJSON?.message || 'Đặt hàng thất bại', 'error');
                }
            },
            complete: function () {
                hideLoader(); // TẮT LOADER
            }
        });
    });

    function getAllAddress() {
        const userId = sessionStorage.getItem('id');
        
        $.ajax({
            url: '/api/address/',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getCookie('user_token')
            },
            data: { user_id: userId, per_page: 1000 },
            beforeSend: function () {
                // showLoader(); // Bỏ comment nếu bạn có hàm loader
            },
            success: function (response) {
                let addresses = response.data.data;
                let optionsHtml = '';

                if (addresses && addresses.length > 0) {
                    // 1. Tìm địa chỉ mặc định (is_default = 1), nếu không có thì lấy cái đầu tiên
                    let defaultAddr = addresses.find(a => a.is_default == 1) || addresses[0];

                    // 2. Duyệt mảng để tạo danh sách radio options
                    addresses.forEach(addr => {
                        const isSelected = addr.id === defaultAddr.id;
                        optionsHtml += `
                            <label class="flex cursor-pointer items-start gap-3 rounded-lg p-3 transition-colors hover:bg-primary/5 ${isSelected ? 'bg-primary/10' : ''}">
                                <input type="radio" name="saved_address" 
                                    class="mt-1 h-4 w-4 text-primary focus:ring-primary" 
                                    ${isSelected ? 'checked' : ''} 
                                    onchange='selectAddress(${JSON.stringify(addr)})'>
                                <div class="flex-grow">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="font-bold text-text-light dark:text-text-dark">${addr.user_name}</span>
                                        <span class="text-sm text-subtle-light dark:text-subtle-dark">| ${addr.user_phone}</span>
                                        ${addr.is_default == 1 ? '<span class="inline-flex items-center rounded-full bg-primary/20 px-2 py-0.5 text-xs font-bold text-primary">Mặc định</span>' : ''}
                                    </div>
                                    <p class="mt-1 text-sm text-subtle-light dark:text-subtle-dark">
                                        ${addr.address_line}, ${addr.ward}, ${addr.district}, ${addr.province}
                                    </p>
                                </div>
                            </label>
                        `;
                    });

                    // 3. Thêm tùy chọn "Giao đến địa chỉ khác" vào cuối danh sách
                    optionsHtml += `
                        <div class="border-t border-border-light p-2 dark:border-border-dark mt-2">
                            <label class="flex cursor-pointer items-center gap-3 rounded-lg p-3 transition-colors hover:bg-background-light dark:hover:bg-background-dark/50">
                                <input type="radio" name="saved_address" class="h-4 w-4 text-primary" onchange="resetShippingInfo()">
                                <span class="font-medium text-primary">+ Giao đến địa chỉ khác</span>
                            </label>
                        </div>`;

                    // 4. Đổ dữ liệu vào danh sách dropdown
                    $('#address_options_list').html(optionsHtml);

                    // 5. Tự động fill địa chỉ mặc định vào Summary và Form bên dưới
                    selectAddress(defaultAddr);

                } else {
                    $('#list_address').addClass('hidden')
                    // $('#address_summary_content').html('<span class="text-red-500 text-sm">Chưa có địa chỉ. Vui lòng nhập thông tin bên dưới.</span>');
                    // $('#address_options_list').empty();
                    resetShippingInfo();
                }
            },
            error: function() {
                Swal.fire('Lỗi', 'Không thể tải sổ địa chỉ', 'error');
            },
            complete: function () {
                // hideLoader();
            }
        });
    }

    function selectAddress(addr) {
        // 1. Hiển thị thông tin lên ô Summary (thanh tiêu đề dropdown)
        const summaryHtml = `
            <div class="flex flex-wrap items-center gap-2 text-left">
                <span class="font-bold text-text-light dark:text-text-dark">${addr.user_name}</span>
                <span class="text-sm text-subtle-light dark:text-subtle-dark">| ${addr.user_phone}</span>
                ${addr.is_default == 1 ? '<span class="inline-flex items-center rounded-full bg-primary/20 px-2 py-0.5 text-xs font-bold text-primary">Mặc định</span>' : ''}
            </div>
            <span class="text-sm text-subtle-light dark:text-subtle-dark truncate block w-full text-left">
                ${addr.address_line}, ${addr.ward}, ${addr.district}, ${addr.province}
            </span>
        `;
        $('#address_summary_content').html(summaryHtml);

        // 2. Điền dữ liệu vào các ô Input thanh toán
        $('#user_name').val(addr.user_name);
        $('#user_phone').val(addr.user_phone);
        
        const fullAddrString = `${addr.address_line}, ${addr.ward}, ${addr.district}, ${addr.province}`;
        $('#address').val(fullAddrString);

        // 3. Đóng dropdown và lưu ID (nếu cần)
        $('#address_details').removeAttr('open');
        window.selectedAddressId = addr.id; 
    }

    function resetShippingInfo() {
        // 1. Cập nhật Summary về trạng thái trống
        $('#address_summary_content').html(`
            <div class="text-left">
                <span class="font-bold text-primary">Giao đến địa chỉ khác</span>
                <p class="text-xs text-subtle-light">Vui lòng nhập thông tin bên dưới</p>
            </div>
        `);

        // 2. Xóa sạch các ô input
        $('#user_name').val('');
        $('#user_phone').val('');
        $('#address').val('');
        $('#description').val('');

        // 3. Xóa ID đã chọn và đóng dropdown
        window.selectedAddressId = null;
        $('#address_details').removeAttr('open');
    }
</script>
@endsection