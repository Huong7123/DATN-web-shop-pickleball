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
                        <table class="w-full text-left">
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
                                <tr class="">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-4">
                                            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg w-16 h-16"
                                                data-alt="Vợt Pickleball màu xanh"
                                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBQ6zpExrVq3ye4RmbuQKGJeDcUQ0FIpZRDCKapcCceux364FdS7pc5vfZOeFrWLCsN8jHxF09Qz2XqQ3uxVQ2AL-zopYfw8wZVG0gz06h-0HQ-BguwrWHMCd5-q3FB16B0TOMcCPjzlXx-OcpkIEheqltYgWo3GHJNqup7FiTX8ApOB230Q189kFhbZE37s9EDTiH87iyZ97XOKKU1aI3OxeF_wOYIR1Obv70oOvE27u4CqIjbsCk1zqWStAZjpkn4AHwqAPoFXjfr");'>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900 dark:text-white">Vợt Pickleball Pro Carbon
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Màu: Xanh Navy</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium">₫2,500,000</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center border border-gray-300 dark:border-gray-700 rounded-md w-28">
                                            <button
                                                class="px-2 py-1 text-lg font-medium text-gray-600 dark:text-gray-400 hover:text-primary">-</button>
                                            <input class="w-full text-center border-0 bg-transparent focus:ring-0 text-sm" type="text"
                                                value="1" />
                                            <button
                                                class="px-2 py-1 text-lg font-medium text-gray-600 dark:text-gray-400 hover:text-primary">+</button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white">₫2,500,000</td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-gray-500 hover:text-red-500 transition-colors">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-4">
                                            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg w-16 h-16"
                                                data-alt="Bóng Pickleball màu vàng"
                                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCDfM9FtRde8T3NStQBr9SJHHw8jicFTSp5fR4Q6oGC4gDIeqeFPvJu-Id25nKeg3AAqYELpeQoJ7lE86HpeP8-aFjxl2cK2zOJDFJ6xPAc_TLWcymOsi-BQD31Em75yjJ5iTW91SS12W6o3CZwP-IVHXiTFSOM2HO2o_6RsGAZGwPYHjy74sER7XViLtyV2c_yUMp8qn7u0XU4e1GJ-NyfB3SuAelX0ev6aSWCtpirbwp9ZrCyv-lNEqkehbYb3iUqo0nspRxEJLLO");'>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900 dark:text-white">Bóng Outdoor (Bộ 6 quả)</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Màu: Vàng chanh</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium">₫150,000</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center border border-gray-300 dark:border-gray-700 rounded-md w-28">
                                            <button
                                                class="px-2 py-1 text-lg font-medium text-gray-600 dark:text-gray-400 hover:text-primary">-</button>
                                            <input class="w-full text-center border-0 bg-transparent focus:ring-0 text-sm" type="text"
                                                value="2" />
                                            <button
                                                class="px-2 py-1 text-lg font-medium text-gray-600 dark:text-gray-400 hover:text-primary">+</button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white">₫300,000</td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-gray-500 hover:text-red-500 transition-colors">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
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
</script>
@endsection