@extends('layouts.Frontend.master')
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div
        class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat rounded-xl items-start justify-end px-4 pb-10 @[480px]:px-10"
        data-alt="A pickleball player in mid-action, hitting the ball with a powerful swing."
        style='background-image: linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.5) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuBtQEXhpk3hJVF737RbbpO6PsIlxwGiV6szTsiQqCHAC52rzCSLpAM0uZllq8_PQdF_tWu7oxDop0syFCRqbJp76RkJlCm52tcpXC-qVgMT1Eyt7VA-nZlxHG8VK-SdGxGSGXCCMvq-n1nKZ2htAWy935FfH5MSQRNDkJEOAZn7ElMOl3kl_Sts8o96nezZ05Av4NbaWmZQ6aYgXJDRtGQ2Z3uyIqwAFeBIeoir8tj5C7DNuOnu1e2e1d9NPPMhAWluhKk7HXfwMsfC");'>
        <div class="flex flex-col gap-2 text-left max-w-xl">
            <h1
                class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em]">
                Nâng Tầm Trận Đấu Của Bạn
            </h1>
            <h2
                class="text-white text-sm font-normal leading-normal @[480px]:text-base @[480px]:font-normal @[480px]:leading-normal">
                Khám phá bộ sưu tập vợt và phụ kiện pickleball mới nhất để chinh phục mọi trận đấu.
            </h2>
        </div>
        <button id="btn_buy"
            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-primary text-gray-900 text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base @[480px]:font-bold @[480px]:leading-normal @[480px]:tracking-[0.015em] hover:bg-opacity-90 transition-colors">
            <span class="truncate">Mua Ngay</span>
        </button>
    </div>
</div>
<section class="py-8">
    <h2
        class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 sm:px-6 lg:px-10 pb-3 pt-5">
        Sản Phẩm Nổi Bật</h2>
    <div class="pb-3 px-4 sm:px-6 lg:px-10">
        <div class="flex border-b border-primary/20 dark:border-primary/10 gap-8">
            <a class="flex flex-col items-center justify-center border-b-[3px] border-b-primary text-gray-900 dark:text-white pb-[13px] pt-4"
                href="#">
                <p class="text-sm font-bold leading-normal tracking-[0.015em]">Bán chạy nhất</p>
            </a>
            <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-gray-500 dark:text-gray-400 pb-[13px] pt-4 hover:text-gray-800 dark:hover:text-gray-200 transition-colors"
                href="#">
                <p class="text-sm font-bold leading-normal tracking-[0.015em]">Sản phẩm mới</p>
            </a>
        </div>
    </div>
    <div class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-6 p-4 sm:p-6 lg:p-10">
        <div class="flex flex-col gap-3 pb-3 group">
            <div
                class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-lg overflow-hidden transition-transform duration-300 group-hover:scale-105"
                data-alt="A professional carbon fiber pickleball paddle."
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCAdi5v09GHXDbIJhtZI955czkXkuxk8bMIZ-ZPHvJLuZ5CQKiBZaj5t8W3e08zCsGDI3YxGOy2WHWaHo0jt4cr37dGxzTzzhxNwjYvkKsGnT_qehKRJP2jSwpySjRiICAWwF1qgAjIiuUX2CfMxe9Pds6pIv44iCJnJJe0qsJv8F3L1quDU9LECBR17iBH-SMpFyV5JEK1w2msE3ps9QnJs7fh1qkXTZQ493MKIrNJCrKHq4GwNEnE7iqDxooA-bYoNkxIx9jL1cU1");'>
            </div>
            <div>
                <p class="text-gray-900 dark:text-white text-base font-medium leading-normal">Vợt Carbon Fiber Pro
                </p>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-normal leading-normal">₫2,500,000</p>
            </div>
        </div>
        <div class="flex flex-col gap-3 pb-3 group">
            <div
                class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-lg overflow-hidden transition-transform duration-300 group-hover:scale-105"
                data-alt="A set of yellow X-40 pickleballs."
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBzdn8G63ayVjltUDYGFIq_2Xf23Q34jfUom6DtrK0Gk7AujCiim0hB9tGA_Spn1tyq5CRiQcKpk3AhnHmzyKgBTPhxi4mOmBiCxGmQYrnDP4ciEjz0ZlE21q7lNlyVSrwygaEj8Wj5D7pEbSHk6W9TcNS-2GSI1Wx9TNBYYVb668tydhM5ujIN7yjPIctt4GKAV2LZO_XiOfOM0SnfEDrdpGR5fO3UNny5ttcTdnqGjz546SMZDAvksoDOMbIxaIhKlJlLvEv31VqW");'>
            </div>
            <div>
                <p class="text-gray-900 dark:text-white text-base font-medium leading-normal">Bóng Pickleball X-40
                </p>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-normal leading-normal">₫350,000</p>
            </div>
        </div>
        <div class="flex flex-col gap-3 pb-3 group">
            <div
                class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-lg overflow-hidden transition-transform duration-300 group-hover:scale-105"
                data-alt="A pair of stylish Court Supreme pickleball shoes."
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBfmxqwvpFilWzUiB0YS3A-xHyPjSKKaR6ube0lfgA12fF0cxPLZuTmHQusNox0pfz2SzC2fvjRyLZVxAucoS9gUnJY5HBLfOnz7YkCEecC2U963NIssnjyDOtgLocf91s0-6tgZwMPx_qifWCgLgEYlXUxSoTzaWLCAjGNGkrAtbYpDqDn3VJmIukqMOGee7KeFrwMu-QMXCSLzEkdkaW3yoBGkrnSdCLh-nXUcOYV33V2FWyNIEXkPv8LkjgBXOVXd-e1TFB38CRJ");'>
            </div>
            <div>
                <p class="text-gray-900 dark:text-white text-base font-medium leading-normal">Giày Court Supreme</p>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-normal leading-normal">₫1,800,000</p>
            </div>
        </div>
        <div class="flex flex-col gap-3 pb-3 group">
            <div
                class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-lg overflow-hidden transition-transform duration-300 group-hover:scale-105"
                data-alt="A Pro Gear pickleball paddle bag."
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDGL1k73soIyFBDropY4A8xCd_3LMLTw_GyVslvEEK1GjR1TI5Du_yk1ppsp9rWws3DTVAyWNdfobs3mMSqgzqzLmvYjghLleYn6zmHi8zlOCLnWceomiZvAbbQ4p9RwiJAKjtugceXKIVh25HoQK9RxuaCTEgdZlD2bTTqfBGwdvd1TIoARQmylBIKazwkt2mX7bHZgStE2g0DylB7TiMpfNFkYFTJrr1vS1PK2Y8nJlWnhuWEi8-VRS5V2fYBlwYvHAW2bXecGkUw");'>
            </div>
            <div>
                <p class="text-gray-900 dark:text-white text-base font-medium leading-normal">Túi Đựng Vợt Pro Gear
                </p>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-normal leading-normal">₫1,200,000</p>
            </div>
        </div>
    </div>
</section>
<section class="px-4 sm:px-6 lg:px-10 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div
            class="flex flex-col justify-center items-start bg-primary/20 dark:bg-primary/10 p-8 sm:p-12 rounded-xl text-center md:text-left">
            <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-3">Giảm giá 20%</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-6">Cho đơn hàng đầu tiên của bạn! Đừng bỏ lỡ cơ hội sở
                hữu những sản phẩm chất lượng với giá ưu đãi.</p>
            <button
                class="w-full md:w-auto flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-gray-900 text-base font-bold leading-normal tracking-[0.015em] hover:bg-opacity-90 transition-colors">
                <span class="truncate">Săn Sale Ngay</span>
            </button>
        </div>
        <div
            class="flex flex-col justify-center items-start bg-gray-800 dark:bg-gray-900 p-8 sm:p-12 rounded-xl text-center md:text-left">
            <h3 class="text-2xl sm:text-3xl font-bold text-white mb-3">Mua Vợt Tặng Bóng</h3>
            <p class="text-gray-300 mb-6">Nhận ngay một bộ bóng thi đấu tiêu chuẩn khi mua bất kỳ vợt nào từ bộ
                sưu tập mới của chúng tôi.</p>
            <button
                class="w-full md:w-auto flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-white text-gray-900 text-base font-bold leading-normal tracking-[0.015em] hover:bg-opacity-90 transition-colors">
                <span class="truncate">Xem Vợt Mới</span>
            </button>
        </div>
    </div>
</section>
<section class="px-4 sm:px-6 lg:px-10 py-16">
    <div
        class="flex flex-col md:flex-row items-center gap-12 bg-white dark:bg-gray-900/50 p-8 sm:p-12 rounded-xl">
        <div class="w-full md:w-1/2">
            <div class="aspect-w-4 aspect-h-3">
                <div class="w-full h-full bg-center bg-no-repeat bg-cover rounded-lg"
                    data-alt="A group of people playing pickleball happily at an outdoor court."
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA4sK1hMRONQN3ti-PaX0tZMjiTaGyVyLKyMc8qTk2lw57J3s2CD1H92BweNmBBSjbXSTDwL1i8Vjmop9YmorxPl7OuOYWAmRY-giKH6jg_Fk2cYip37CQpzLYQOK_IHdq0gVHglTZAqhHgoT6oVszrmXCHjPmfAJf1UlH9J8w6q5hX8mxmUC5UR23TBR-q36d8Wv8NupD_159kzdu4m1cdqmNK7itRUdWBNs9XE2-onCe4Z43vOYyBuGMtwzcri_T267ZD_-hjD5ip");'>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 flex flex-col items-start">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Về Pickleball Store</h2>
            <p class="text-gray-600 dark:text-gray-300 mb-6">Chúng tôi cam kết cung cấp dụng cụ pickleball chất
                lượng hàng đầu để giúp mọi người chơi, từ người mới bắt đầu đến chuyên nghiệp, đạt được hiệu suất
                tốt nhất và tận hưởng trọn vẹn niềm vui trên sân đấu.</p>
            <button
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary/20 dark:bg-primary/10 text-gray-900 dark:text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/30 dark:hover:bg-primary/20 transition-colors">
                <span class="truncate">Tìm Hiểu Thêm</span>
            </button>
        </div>
    </div>
</section>

<script>
    $('#btn_buy').on('click', function () {
        window.location.href = '/san-pham';
    });
</script>
@endsection