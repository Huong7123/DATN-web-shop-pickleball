@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div class="layout-content-container flex flex-col w-full">
        <!-- Breadcrumbs -->
        <div class="flex flex-wrap gap-2 px-0 py-4">
            <a class="text-primary text-sm font-medium leading-normal hover:underline" href="#">Trang chủ</a>
            <span class="text-primary/60 dark:text-primary/80 text-sm font-medium leading-normal">/</span>
            <a class="text-primary text-sm font-medium leading-normal hover:underline" href="#">Vợt Pickleball</a>
            <span class="text-primary/60 dark:text-primary/80 text-sm font-medium leading-normal">/</span>
            <span class="text-sm font-medium leading-normal">Vợt Carbon Pro X5</span>
        </div>
        <!-- Product Details Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">
            <!-- Product Image Gallery -->
            <div class="flex flex-col gap-4">
                <div
                    class="w-full bg-center bg-no-repeat bg-cover flex flex-col justify-end overflow-hidden rounded-xl aspect-square bg-gray-200 dark:bg-gray-700"
                    data-alt="Main image of Pickleball Carbon Pro X5 paddle"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAUNMGO04GmfHDgOeWIzFOIa3gqabeZNPy2SA2rGnI8dKoXGbhaA4L0L4qPnEqfdLLriLh0PY28fr0SsQUPstoaga7qR_85La6nJQ0Qo5oe0_kKHNbzl8Osjrs4tvHjdOc4DZJs9owO-TeNi4Dx0w8Le1iUFsV2whFBtuSBAF5DbGE0XiOxwBN3UBAnZmU7bXp6itnpm96tTi2LTp3YGQUWExpYftTRHSWvpgunlC25zABDaSG_Tgevsm1k01iFpoUjkO8Lax7By5N5");'>
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <div
                        class="w-full bg-center bg-no-repeat bg-cover flex flex-col justify-end overflow-hidden rounded-lg aspect-square bg-gray-200 dark:bg-gray-700 cursor-pointer border-2 border-primary"
                        data-alt="Thumbnail 1 of Pickleball Carbon Pro X5 paddle"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAjzMFaGY7hle0lc2pqLVLHM5xqNyiKuWvYedzN8fV1PbVhu8-V936HMq6ZU1syQB5RmF9kLh2Zi_xNxcvMFK9EcDJP5qN8-jE-biUSu7U0YkCfhG_jHCXR4B4khPpaKXOJlcWC4C5vhBcIM5XbehCQq7HpUQ_icmZyavxk67k4BSIUbSAz-o2NGGzdxyzkzqs0PO23iZUMwGT2RH5I9PAJ2xPHiMNMUnQO4Nj9GZzRrTr-5LtSO91jhbLwnw6fEheMRKEbArmHZBNf");'>
                    </div>
                    <div
                        class="w-full bg-center bg-no-repeat bg-cover flex flex-col justify-end overflow-hidden rounded-lg aspect-square bg-gray-200 dark:bg-gray-700 cursor-pointer opacity-70 hover:opacity-100 transition-opacity"
                        data-alt="Thumbnail 2 of Pickleball Carbon Pro X5 paddle"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCVjSVc79dRQD_pS-zKRXeeBZUk67NQsO7oqcRLwWyB0JVrO6p-QpdDF5H1LS7bYGaXmgXNog8UiV3yHoPSskEKxXkCyd4fhlAr2Reb5k6WwzAutiLAtdHI_iCEV4_gsN7S-e0Ds9xHabyhSqNeXudaHZEgN7vMTZ3T8bLsKP0xQ_ql_yEfFSH4-aKKE8sLH1y1YUKksKVNvyQ8r28JMvhqNj-V7nSinYNIRpi9_J2sOZtefzaowjZv5sr897oUD5VgmsAOyhPch7DH");'>
                    </div>
                    <div
                        class="w-full bg-center bg-no-repeat bg-cover flex flex-col justify-end overflow-hidden rounded-lg aspect-square bg-gray-200 dark:bg-gray-700 cursor-pointer opacity-70 hover:opacity-100 transition-opacity"
                        data-alt="Thumbnail 3 of Pickleball Carbon Pro X5 paddle"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDWZw1Z3AxvGSMHRdfxNSC7nhJ-0WY65wXxaXpDuLjof-93-ClrtvpTfE9ywuy7eS3VQ8FaIXwUilhqc280OmlY1YPV_fn2VaceTInIwgLmfDMCm5KVEX8DPZwo0TfjfcbYkF5bAhglHL62hjHTcPhnmJv6D1bKn3hLleuCsDFxl5b_w7hyTp6J0GAaVyQFTZcFHY4BCvmpZekv53DFf_jy5PX6hbZI6jmYNFzru4Z8ookcXKq6apbdSgQMXcNCUXAUJ_1Tjp8AuPoj");'>
                    </div>
                    <div
                        class="w-full bg-center bg-no-repeat bg-cover flex flex-col justify-end overflow-hidden rounded-lg aspect-square bg-gray-200 dark:bg-gray-700 cursor-pointer opacity-70 hover:opacity-100 transition-opacity"
                        data-alt="Thumbnail 4 of Pickleball Carbon Pro X5 paddle"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC87kiUwj_DFIxYG4WW7UcHtEFGxgBGTdcEPjtzvASIwXSHea4wEW-hQUFUIGXKe9unafJ2W2UeJQcBhm_LKcUT-i3eGN1nSoOI0uqRSAIRNLKdHNBkxTxTSA220Ut65gnGI3KzkYbyPbgGGmNLGqizYWm1kT2kepaXNSvk6RPgDwQexJDtyPkJCxu4BFL7cCpOGA0AqGQi4Gh04Ur_oukSbOm1yz36eoa8eC0XeLDt_SsfLVodM3DsjQmpSxCdLsq7X4liBaA2MKYK");'>
                    </div>
                </div>
            </div>
            <!-- Product Information Panel -->
            <div class="flex flex-col gap-6">
                <!-- PageHeading -->
                <div class="flex flex-col gap-2">
                    <p class="text-primary/80 dark:text-primary/90 text-sm font-medium leading-normal">Thương hiệu:
                        ProPickle | SKU: PB-CPX5-BLK</p>
                    <p class="text-4xl font-black leading-tight tracking-[-0.033em]">Vợt Pickleball Carbon Pro X5</p>
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
                    <p class="text-4xl font-bold leading-tight text-primary">2.490.000₫</p>
                    <p class="text-xl font-normal leading-normal text-gray-400 dark:text-gray-500 line-through">3.200.000₫
                    </p>
                    <span class="bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded-full">-22%</span>
                </div>
                <!-- Options -->
                <div class="flex flex-col gap-4">
                    <div>
                        <p class="text-base font-bold mb-2">Màu sắc: Đen</p>
                        <div class="flex gap-2">
                            <button class="size-8 rounded-full bg-black border-2 border-primary"></button>
                            <button
                                class="size-8 rounded-full bg-blue-600 border-2 border-transparent hover:border-primary/50"></button>
                            <button
                                class="size-8 rounded-full bg-red-600 border-2 border-transparent hover:border-primary/50"></button>
                        </div>
                    </div>
                    <div>
                        <p class="text-base font-bold mb-2">Trọng lượng</p>
                        <div class="flex gap-2">
                            <button
                                class="px-4 py-2 rounded-lg bg-primary/10 dark:bg-primary/20 border border-primary text-sm font-semibold">7.5
                                oz</button>
                            <button
                                class="px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-sm font-medium hover:border-primary/50 dark:hover:border-primary/50">7.8
                                oz</button>
                            <button
                                class="px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-sm font-medium hover:border-primary/50 dark:hover:border-primary/50">8.1
                                oz</button>
                        </div>
                    </div>
                </div>
                <!-- Action Area -->
                <div class="flex flex-col gap-4 pt-4 border-t border-primary/10">
                    <div class="flex items-center gap-4">
                        <p class="text-base font-bold">Số lượng</p>
                        <div class="flex items-center rounded-lg border border-gray-300 dark:border-gray-600">
                            <button class="px-3 py-2 text-lg font-bold hover:bg-primary/10 rounded-l-md">-</button>
                            <input
                                class="w-12 text-center border-x border-gray-300 dark:border-gray-600 bg-transparent focus:outline-none"
                                type="text" value="1" />
                            <button class="px-3 py-2 text-lg font-bold hover:bg-primary/10 rounded-r-md">+</button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button
                            class="flex w-full cursor-pointer items-center justify-center gap-3 overflow-hidden rounded-lg h-12 bg-primary text-[#0d1b12] text-base font-bold leading-normal tracking-[0.015em] hover:bg-opacity-90 transition-all">
                            <span class="material-symbols-outlined">add_shopping_cart</span> Thêm vào giỏ hàng
                        </button>
                        <button
                            class="flex w-full cursor-pointer items-center justify-center gap-3 overflow-hidden rounded-lg h-12 bg-primary/20 dark:bg-primary/30 text-[#0d1b12] dark:text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/30 dark:hover:bg-primary/40 transition-all">
                            Mua ngay
                        </button>
                    </div>
                    <button class="flex items-center justify-center gap-2 text-sm font-medium text-primary hover:underline">
                        <span class="material-symbols-outlined">favorite_border</span> Thêm vào danh sách yêu thích
                    </button>
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
                    <a class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-base text-gray-500 hover:text-primary hover:border-primary dark:text-gray-400 dark:hover:text-primary dark:hover:border-primary"
                        href="#">Thông số kỹ thuật</a>
                    <a class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-base text-gray-500 hover:text-primary hover:border-primary dark:text-gray-400 dark:hover:text-primary dark:hover:border-primary"
                        href="#" id="reviews">Đánh giá của khách hàng (125)</a>
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
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Product Card 1 -->
                <div class="flex flex-col gap-2 group">
                    <div
                        class="w-full bg-center bg-no-repeat bg-cover flex flex-col justify-end overflow-hidden rounded-lg aspect-[4/5] bg-gray-200 dark:bg-gray-700"
                        data-alt="Pickleball Balls 3-pack"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAtls-dZYn-2CPIOPc7rbRM62Q-DCDhOCs-G6QV-dmwQ0YgMzNM85PqRnSJeVyCBI3o3w96vHTeX7nrD8RGg4q6wPd20pvC8CMJ78H9apoj7K_KnOjVXkNR6_DUQn8ONzjWS69dL68Duj6mmRgDt9XDthp4AcueTvURfkNaqGV3820wN5fZw4_dVZV4vKPCzXNhN_g5m4CwKFTYCDBn4CY8sESezkJqcULUiQSt1XuwNKNizNBMZC0xSLVShrZH4_0ftipeaEiZkq6-");'>
                    </div>
                    <a class="text-base font-bold leading-normal group-hover:text-primary transition-colors" href="#">Bóng
                        Pickleball Pro-Flight (Bộ 3)</a>
                    <p class="text-base font-bold leading-normal text-primary">250.000₫</p>
                </div>
                <!-- Product Card 2 -->
                <div class="flex flex-col gap-2 group">
                    <div
                        class="w-full bg-center bg-no-repeat bg-cover flex flex-col justify-end overflow-hidden rounded-lg aspect-[4/5] bg-gray-200 dark:bg-gray-700"
                        data-alt="Pickleball Shoes"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAyNnv741Fw5yx2vad0NAld62bxH-qHf4lGZAAkgLzl52FhkntiSV8R1-q7TJ3-iimOnTTi1PZcOjAHWvTf2MyXrX8S-vAypB9U3K_nSkmXcGhzuNzqRWHsyvIMJCeYSBfuuL1jyvD2znmu5igvzipOiiIYMPhCB60tZMff4HW74t_5x8GiBjeYeBE1JtBIApnD3e4ZBM31snYxNW6NeMgdDE3dxWQz99vgl3-QSxz0ctab9A0Y2u_EopTaEE9v1w6y3qvzgv5U1sxL");'>
                    </div>
                    <a class="text-base font-bold leading-normal group-hover:text-primary transition-colors" href="#">Giày
                        Pickleball Court Master</a>
                    <p class="text-base font-bold leading-normal text-primary">1.800.000₫</p>
                </div>
                <!-- Product Card 3 -->
                <div class="flex flex-col gap-2 group">
                    <div
                        class="w-full bg-center bg-no-repeat bg-cover flex flex-col justify-end overflow-hidden rounded-lg aspect-[4/5] bg-gray-200 dark:bg-gray-700"
                        data-alt="Pickleball Bag"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCgiudl3FyLkq0OiWOnWR6yZmA14fN1Fm9QcmFja7561GxgMQdOUxBmfxCdZ6tUlIRUFJPA9cV83Uia81o6Kp-ZMHKjX5q3DMWmX4VJWJ8A2-wIqTy72gnE4maBjYVbP2WV5zwc33leGBF-y-NUhL3JGMq6N-QcATj8-rNwTgXmwZluEQquF12CqQdgNAPPzY7aGbkNHL1TRDWA8kmeHSDt6Tn-VnYARzdI0hvTtfrHCzwMvTka-n1CsbpusReo9M87U3oAeRGDpa7j");'>
                    </div>
                    <a class="text-base font-bold leading-normal group-hover:text-primary transition-colors" href="#">Túi
                        đựng đồ Pickleball Tour</a>
                    <p class="text-base font-bold leading-normal text-primary">1.250.000₫</p>
                </div>
                <!-- Product Card 4 -->
                <div class="flex flex-col gap-2 group">
                    <div
                        class="w-full bg-center bg-no-repeat bg-cover flex flex-col justify-end overflow-hidden rounded-lg aspect-[4/5] bg-gray-200 dark:bg-gray-700"
                        data-alt="Pickleball Paddle Edge Guard"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDHWg0rsk8S4nFIkbm2dokYMcUVwuzGrih6M2MTB5RlrPwxTmuFZQYGCdd-UEl1huG7gv0l6_XTtJ2CaocH9t0b9dknrJa4g_73nC8CFmRD9vJpLlQFfsFZnLIju2WIYscT2Mn9Y4LAnWgxrRWW1EoA2eCLVOHQOGMkpAkax0-MF9le6kgrmXQBvlFC2O4mYS8x1A7VmAozh1-YVC_gmctJ7Vdt2BpMyBcuRxRzKmQ135nlQrx2iQVmIrxv7Z8MlTypQQHEm3g_HeGG");'>
                    </div>
                    <a class="text-base font-bold leading-normal group-hover:text-primary transition-colors" href="#">Vợt
                        Graphite Elite G7</a>
                    <p class="text-base font-bold leading-normal text-primary">2.150.000₫</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection