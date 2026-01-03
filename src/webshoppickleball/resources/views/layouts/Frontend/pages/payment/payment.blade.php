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
                                placeholder="Số nhà, tên đường" type="text" />
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
                <div class="flex items-end gap-3">
                    <div class="flex-grow">
                        <label class="mb-2 block text-sm font-medium">Mã giảm giá</label>
                        <input
                            class="form-input block h-12 w-full rounded-lg border border-border-light bg-background-light px-3 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark/50"
                            placeholder="Nhập mã" />
                    </div>
                    <button
                        class="h-12 shrink-0 rounded-lg bg-primary/20 px-5 font-bold text-text-light dark:text-text-dark">Áp
                        dụng</button>
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

<script>
    let shippingFee = 0;

    function getShippingFee() {
        return parseInt(
            $('input[name="shipping"]:checked')
                .closest('.shipping-option')
                .data('fee')
        ) || 0;
    }

    function formatVnd(n) {
        return n.toLocaleString('vi-VN') + 'đ';
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
                    <p class="font-semibold">${formatVnd(rowTotal)}</p>
                </div>
            `);
        });
    }

    function renderCheckoutSummary() {
        let subTotal = 0;

        checkoutItems.forEach(i => {
            subTotal += i.price * i.quantity;
        });

        const discount = 0;
        const grandTotal = Math.max(0, subTotal + shippingFee - discount);

        $('#checkout_summary').html(`
            <div class="flex justify-between">
                <span>Tạm tính</span>
                <span>${formatVnd(subTotal)}</span>
            </div>

            <div class="flex justify-between">
                <span>Phí vận chuyển</span>
                <span>${formatVnd(shippingFee)}</span>
            </div>

            <div id="discount" data-discount="${discount}" class="flex justify-between font-medium text-primary">
                <span>Giảm giá</span>
                <span>- ${formatVnd(discount)}</span>
            </div>

            <div class="flex justify-between text-lg font-bold">
                <span>Tổng cộng</span>
                <span>${formatVnd(grandTotal)}</span>
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
            discount: discount,
            items: checkoutItems.map(i => ({
                parent_id: i.parent_id,
                attribute_value_ids: i.attribute_value_ids,
                quantity: i.quantity
            }))
        };

        // Bật loading để tránh user nhấn nhiều lần
        Swal.showLoading();

        $.ajax({
            url: '/api/order',
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            data: JSON.stringify(data),
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
                        text: 'Đơn hàng của bạn đã được ghi nhận (COD)',
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
            }
        });
    });


</script>
@endsection