@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div class="flex flex-col gap-6 py-10 px-4">
        <!-- PageHeading Start -->
        <div class="flex flex-wrap justify-between gap-3">
            <div class="flex min-w-72 flex-col gap-2">
                <p class="text-black dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Kho Voucher
                    độc quyền của bạn</p>
            </div>
        </div>
        <!-- PageHeading End -->
        <!-- Voucher Cards Grid -->
        <div id="voucher_list" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Card 1 -->
            <!-- <div
                class="flex items-stretch justify-between gap-4 rounded-xl bg-background-light dark:bg-background-dark p-4 shadow-sm border border-black/10 dark:border-white/10">
                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg flex-1"
                    data-alt="Image of a pickleball paddle."
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD4orZi7OXQxY9gXx-VhSHZWoEy-3J1T_Z3FvisYoYSWwmfPGNIUYkapt_CJQbaFnU4P8HkIG_qMKomaiQj78x1PhplJTWQIUUOpSACmEkebLCxmkDx8wDtwgS4MhPWBTHosP7Fgw6VLO7TMa82PTVWAMoGyaWB2SftN2hzQuW6KsIrUmH_XLKpl0GyCK09gbd3gub2DbW3lvCvmgE_vwmCJTv4F3KHW-ueXxYN1hjJwUTH7Bjk6ydCvm9RBBi3Ah9biV_hRAOQguEk');">
                </div>
                <div class="flex flex-[2_2_0px] flex-col justify-between gap-4">
                    <div class="flex flex-col gap-1">
                        <p class="text-black/60 dark:text-white/60 text-sm font-normal leading-normal">HSD: 31/12/2024</p>
                        <p class="text-black dark:text-white text-lg font-bold leading-tight">Giảm 20%</p>
                        <p class="text-black/60 dark:text-white/60 text-sm font-normal leading-normal">Cho đơn hàng từ
                            500.000đ</p>
                    </div>
                    <button
                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-primary text-black text-sm font-bold leading-normal w-fit">
                        <span class="truncate">Dùng ngay</span>
                    </button>
                </div>
                
            </div> -->
        </div>
    </div>
</div>
<script>
    function getAllVoucher() {
        const userId = sessionStorage.getItem('id');
        $.ajax({
            url: '/api/offer',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getCookie('user_token')
            },
            beforeSend: function () {
                showLoader();
            },
            success: function (response) {
                let html = '';
                const data = response.data; // Đây là mảng các Offer

                // 1. Kiểm tra xem data có phần tử nào không
                if (!data || data.length === 0) {
                    html = `
                        <div class="col-span-full flex flex-col items-center justify-center py-8 px-4 text-center">
                            <h3 class="mb-2 text-xl font-bold text-black dark:text-white">Kho voucher đang trống</h3>
                            <p class="mb-8 max-w-xs text-sm text-black/60 dark:text-white/60">
                                Hiện tại bạn chưa có mã giảm giá nào. Hãy tiếp tục mua sắm để nhận thêm nhiều ưu đãi hấp dẫn nhé!
                            </p>
                            <a href="/san-pham" class="flex h-11 items-center justify-center rounded-lg bg-primary px-6 text-sm font-bold text-black transition-transform hover:scale-105 active:scale-95">
                                Khám phá sản phẩm ngay
                            </a>
                        </div>
                    `;
                } else {
                    // 2. Lặp qua từng Offer (thường mỗi user chỉ có 1 bản ghi offer như bạn muốn)
                    data.forEach(item => {
                        // 3. Lặp qua mảng offer_details bên trong
                        if (item.offer_details && item.offer_details.length > 0) {
                            item.offer_details.forEach(detail => {
                                const discount = detail.discount;

                                const expiryDateObj = new Date(discount.end_date);
                                const today = new Date();

                                // Tính số mili giây chênh lệch và chuyển sang số ngày
                                const diffTime = expiryDateObj - today;
                                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

                                // Xác định class màu sắc: nếu <0 ngày thì dùng text-red-500, ngược lại dùng màu mặc định
                                const dateColorClass = diffDays < 0 ? "text-red-600 dark:text-red-400 font-bold" : "text-black/60 dark:text-white/60";
                                
                                // Format dữ liệu
                                const displayValue = discount.discount_type === 'percentage' 
                                    ? `Giảm ${parseFloat(discount.discount_value)}%` 
                                    : `Giảm ${new Intl.NumberFormat('vi-VN').format(discount.discount_value)}đ`;
                                
                                const minOrder = new Intl.NumberFormat('vi-VN').format(discount.min_order_value);
                                const expiryDate = new Date(discount.end_date).toLocaleDateString('vi-VN');

                                html += `
                                <div class="flex items-stretch justify-between gap-4 rounded-xl bg-background-light dark:bg-background-dark p-4 shadow-sm border border-black/10 dark:border-white/10 mb-4">
                                    <div class="w-24 h-24 bg-center bg-no-repeat bg-cover rounded-lg shrink-0"
                                        style="background-image: url('https://meta.vn/Data/image/2022/10/04/LDP-voucher-1236x700.png');">
                                    </div>
                                    <div class="flex flex-1 flex-col justify-between gap-2">
                                        <div class="flex flex-col gap-1">
                                            <p class="${dateColorClass} text-black/60 dark:text-white/60 text-xs font-normal">HSD: ${expiryDate}</p>  
                                            <p class="text-black dark:text-white text-base font-bold leading-tight">${displayValue} tối đa ${new Intl.NumberFormat('vi-VN').format(discount.max_discount_amount)}</p>
                                            <p class="text-black/60 dark:text-white/60 text-xs font-normal">Áp dụng cho: Đơn từ ${minOrder}đ</p>
                                        </div>
                                        <button id="use_voucher" class="flex cursor-pointer items-center justify-center rounded-lg h-8 px-4 bg-primary text-black text-xs font-bold w-fit">
                                            <span>Dùng ngay</span>
                                        </button>
                                    </div>
                                </div>`;
                            });
                        }
                    });
                }

                // Nếu lặp xong mà vẫn không có html (trường hợp data có nhưng offer_details rỗng)
                if (html === '') {
                    html = `<p class="text-center text-gray-400">Bạn chưa có voucher nào khả dụng</p>`;
                }

                $('#voucher_list').html(html);
            },
            error: function(error) {
                Swal.fire('Lỗi', 'Không thể tải danh sách đơn hàng', 'error');
            },
            complete: function () {
                hideLoader();
            }
        });
    }

    $(document).ready(function() {
        getAllVoucher();
    });

    $(document).on('click', '#use_voucher', function() {
        window.location.href = '/san-pham';
    });
</script>
@endsection