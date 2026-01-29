@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div class="flex flex-col gap-6 py-10 px-4">
        <!-- PageHeading Start -->
        <div class="flex flex-wrap justify-between gap-3">
            <div class="flex min-w-72 flex-col gap-2">
                <p class="text-black dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Kho Voucher
                    Độc quyền của bạn</p>
                <p class="text-black/60 dark:text-white/60 text-base font-normal leading-normal">Sử dụng các ưu đãi này
                    để mua sắm dụng cụ pickleball với giá tốt nhất.</p>
            </div>
        </div>
        <!-- PageHeading End -->
        <!-- Voucher Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Card 1 -->
            <div
                class="flex items-stretch justify-between gap-4 rounded-xl bg-background-light dark:bg-background-dark p-4 shadow-sm border border-black/10 dark:border-white/10">
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
                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg flex-1"
                    data-alt="Image of a pickleball paddle."
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD4orZi7OXQxY9gXx-VhSHZWoEy-3J1T_Z3FvisYoYSWwmfPGNIUYkapt_CJQbaFnU4P8HkIG_qMKomaiQj78x1PhplJTWQIUUOpSACmEkebLCxmkDx8wDtwgS4MhPWBTHosP7Fgw6VLO7TMa82PTVWAMoGyaWB2SftN2hzQuW6KsIrUmH_XLKpl0GyCK09gbd3gub2DbW3lvCvmgE_vwmCJTv4F3KHW-ueXxYN1hjJwUTH7Bjk6ydCvm9RBBi3Ah9biV_hRAOQguEk');">
                </div>
            </div>
            <!-- Card 2 -->
            <div
                class="flex items-stretch justify-between gap-4 rounded-xl bg-background-light dark:bg-background-dark p-4 shadow-sm border border-black/10 dark:border-white/10">
                <div class="flex flex-[2_2_0px] flex-col justify-between gap-4">
                    <div class="flex flex-col gap-1">
                        <p class="text-black/60 dark:text-white/60 text-sm font-normal leading-normal">HSD: 30/11/2024</p>
                        <p class="text-black dark:text-white text-lg font-bold leading-tight">Miễn phí vận chuyển</p>
                        <p class="text-black/60 dark:text-white/60 text-sm font-normal leading-normal">Miễn phí vận chuyển
                            toàn quốc</p>
                    </div>
                    <button
                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-primary text-black text-sm font-bold leading-normal w-fit">
                        <span class="truncate">Dùng ngay</span>
                    </button>
                </div>
                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg flex-1"
                    data-alt="Image of pickleballs on a court."
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuA_PGNbidwAAT7w_O3mp-CVa_7af6fMNLa37R-x9y373ZoMUDGivP22dSebljmBO-bIjnj5DrYxIt-1QQPMKGBCEO7eF7o2QIOEXsyExXDetFzYzPAsRFZqlu9OAIKErI6dPMJd8jp-0fm_s83j_SZlT2ItUqXt3sfOhumX9mNIVoyMk6UkMHHCv0t-B35XolVSrXgMOfy0o29InGIM1mZBtDOyKFWC_yAesIuRMuehqnCECY_L6rnyrdwagIkmhf-iEY8HYb9z8Z4t');">
                </div>
            </div>
            <!-- Card 3 - Expiring Soon -->
            <div
                class="flex items-stretch justify-between gap-4 rounded-xl bg-background-light dark:bg-background-dark p-4 shadow-sm border border-black/10 dark:border-white/10">
                <div class="flex flex-[2_2_0px] flex-col justify-between gap-4">
                    <div class="flex flex-col gap-1">
                        <p class="text-orange-600 dark:text-orange-400 text-sm font-bold leading-normal">Sắp hết hạn:
                            25/08/2024</p>
                        <p class="text-black dark:text-white text-lg font-bold leading-tight">Giảm 100.000đ</p>
                        <p class="text-black/60 dark:text-white/60 text-sm font-normal leading-normal">Cho đơn hàng vợt từ
                            1.000.000đ</p>
                    </div>
                    <button
                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-primary text-black text-sm font-bold leading-normal w-fit">
                        <span class="truncate">Dùng ngay</span>
                    </button>
                </div>
                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg flex-1"
                    data-alt="Image of pickleball accessories."
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDxRLHXMSPppIsscgGMX9AlHupRqhab4dGEbvjKahGfH1LUXJwZ0TvF0I9hLusueX56eGgw5btnMLGu_vQV2VAPLwEYrOCZ8FaMyFgl3QI5PL3B4TJP1shL4y8FBQBNbZzPrSDwdxV1XY_ffvGpP_0FD5J_tQ-HUhl1ve0sVo9-MHU19L29gQrjibc8Zr7ZjuH_T6hsJh6x2dkYykoPEjz8hNl267ZwNZqotbzbFupXgRhvqcsVOGnX6euglM85O5AzME6v9ukDKq6h');">
                </div>
            </div>
            <!-- Card 4 - Used -->
            <div
                class="relative flex items-stretch justify-between gap-4 rounded-xl bg-background-light dark:bg-background-dark p-4 shadow-sm border border-black/10 dark:border-white/10 opacity-50">
                <div class="absolute inset-0 bg-black/10 dark:bg-white/10 rounded-xl"></div>
                <div class="flex flex-[2_2_0px] flex-col justify-between gap-4 z-10">
                    <div class="flex flex-col gap-1">
                        <p class="text-black/60 dark:text-white/60 text-sm font-normal leading-normal">Đã sử dụng</p>
                        <p class="text-black dark:text-white text-lg font-bold leading-tight">Giảm 50%</p>
                        <p class="text-black/60 dark:text-white/60 text-sm font-normal leading-normal">Tối đa 50.000đ cho
                            phụ kiện</p>
                    </div>
                    <button
                        class="flex min-w-[84px] max-w-[480px] cursor-not-allowed items-center justify-center overflow-hidden rounded-lg h-9 px-4 bg-black/20 dark:bg-white/20 text-black/50 dark:text-white/50 text-sm font-bold leading-normal w-fit"
                        disabled="">
                        <span class="truncate">Đã dùng</span>
                    </button>
                </div>
                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg flex-1 z-10"
                    data-alt="Image of a pickleball net."
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDVNLvjt_1f9gIl-ZkQGUOJIqV63N3Kxrpq5lWBYul1yFtkc0SIC7JDsP1ztwMqi-syTUkO7Qh2CJfbhqkxi4ZYOJa5u1amBRxEB6HQDlADSZXnZcP5xgv0Ez1eU8PcOk0jzuZ1w68-gqXUqqKhOBObL2-F3D30yHUD9ssgJsZmC9Shl4wlT7k9vHd34GTWM92dj4HLrzhhdGWlpN5aCOo6jmJ5paf5SWUCjyDPkuT1qrECybkI6t3XkhUkuD4UzBNWh7FauyVFn6l6');">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection