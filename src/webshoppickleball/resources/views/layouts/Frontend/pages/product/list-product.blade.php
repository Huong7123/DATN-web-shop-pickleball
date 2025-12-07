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
            <select
                class="form-select rounded-lg border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark text-sm focus:border-primary focus:ring-primary">
                <option>Sắp xếp theo: Mới nhất</option>
                <option>Giá: Thấp đến Cao</option>
                <option>Giá: Cao đến Thấp</option>
                <option>Phổ biến nhất</option>
            </select>
        </div>
    </div>
    <div class="flex flex-col gap-8 lg:flex-row">
        <!-- Filter Sidebar -->
        <aside class="w-full lg:w-1/4 lg:pr-8">
            <div class="sticky top-24 space-y-6">
                <h3 class="text-lg font-bold">Bộ Lọc Sản Phẩm</h3>
                <!-- SearchBar in sidebar -->
                <div>
                    <label class="flex w-full flex-col">
                        <div class="relative flex h-11 w-full flex-1 items-stretch">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-light-secondary dark:text-text-dark-secondary">search</span>
                            <input
                                class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-border-light bg-card-light py-2 pl-10 pr-4 text-sm placeholder:text-text-light-secondary focus:border-primary focus:ring-primary dark:border-border-dark dark:bg-card-dark dark:placeholder:text-text-dark-secondary"
                                placeholder="Tìm kiếm trong danh mục..." value="" />
                        </div>
                    </label>
                </div>
                <!-- Category Filter -->
                <div class="space-y-3 border-t border-border-light dark:border-border-dark pt-4">
                    <h4 class="font-semibold">Danh mục</h4>
                    <ul class="space-y-2">
                        <li><a class="text-sm hover:text-primary transition-colors" href="#">Vợt</a></li>
                        <li><a class="text-sm hover:text-primary transition-colors" href="#">Bóng</a></li>
                        <li><a class="text-sm hover:text-primary transition-colors" href="#">Phụ kiện</a></li>
                        <li><a class="text-sm hover:text-primary transition-colors" href="#">Giày</a></li>
                        <li><a class="text-sm hover:text-primary transition-colors" href="#">Túi &amp; Balo</a>
                        </li>
                    </ul>
                </div>
                <!-- Price Range Filter -->
                <div class="space-y-4 border-t border-border-light dark:border-border-dark pt-4">
                    <h4 class="font-semibold">Khoảng giá</h4>
                    <div class="relative h-1 w-full rounded-full bg-primary/20">
                        <div class="absolute h-1 rounded-full bg-primary" style="left: 20%; right: 40%;"></div>
                        <div class="absolute -top-1.5 h-4 w-4 rounded-full bg-primary shadow cursor-pointer"
                            style="left: 20%;"></div>
                        <div class="absolute -top-1.5 h-4 w-4 rounded-full bg-primary shadow cursor-pointer"
                            style="right: 40%;"></div>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>1.000.000₫</span>
                        <span>6.000.000₫</span>
                    </div>
                </div>
                <button
                    class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 bg-primary text-background-dark gap-2 text-sm font-bold leading-normal tracking-wide hover:opacity-90 transition-opacity">Áp
                    dụng bộ lọc</button>
            </div>
        </aside>
        <!-- Product Grid -->
        <div class="w-full lg:w-3/4">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
                <!-- Product Card 1 -->
                <div
                    class="flex flex-col overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark group">
                    <div class="relative overflow-hidden">
                        <img class="aspect-square w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            data-alt="A green and black pickleball paddle leaning against a net."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDDe2M_rv2wOB59ZctTIP_cFIWsy3XuShk72fte4ePHIpRj9RswqBF_fV5obPG6uIZ73F0ay1u_BeOyi5IEXxY_IJi4Kx5VEbXeyFvaVAfS_lZMB37MCq1m6Up4qBrXNo6ffS5llmnOOEmHX0C6aYLKwfBhxn68At6G1WFJxFd0YQOnqMzmcqzv6mi1MF1JRjbcuYBSnZ7w5MfO0JtqrKiLz1hRpC_R2JzZ0JDa2mWLU-XYMKoiWyO6w9lmDHfVjsic32AEnMsap6Gy" />
                        <span
                            class="absolute top-3 right-3 bg-primary text-background-dark text-xs font-bold px-2 py-1 rounded-full">Mới</span>
                    </div>
                    <div class="flex flex-1 flex-col p-4">
                        <h3 class="text-base font-bold">Vợt Selkirk Vanguard Power Air</h3>
                        <p class="text-sm text-text-light-secondary dark:text-text-dark-secondary mb-2">Selkirk
                        </p>
                        <p class="text-lg font-extrabold text-primary mt-auto">4.500.000₫</p>
                        <button
                            class="mt-3 flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary/20 text-text-light-primary dark:text-text-dark-primary gap-2 text-sm font-bold leading-normal tracking-wide hover:bg-primary/30 dark:hover:bg-primary/30 transition-colors">
                            <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                            Thêm vào giỏ
                        </button>
                    </div>
                </div>
                <!-- Product Card 2 -->
                <div
                    class="flex flex-col overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark group">
                    <div class="relative overflow-hidden">
                        <img class="aspect-square w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            data-alt="A blue pickleball paddle with a honeycomb pattern."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDckBrzxPFDTLX5ciDBVgedeSXuw83NM9mmFD1hxUqXghGWvoq6PQ9bawdFA7DDsZhcZV3Z5vYSNOL1_FP9FFF57cevtw0pQKmRrDz4QWjW9rcoXWtoU6hE2cACxTrADeqfG-5tF8Ssy8fQ6Pzg2kOVmmd2NluUc8hyHGGSFo1rTFVpv39hE-NdY9I8S-ejrWyvLKD38bEFwL6QpXej5Xot27dc9_oNWFHhUGjbmbc0GAemfihfumndBhOBIE_JvWlo7iY3HEsW6Rcu" />
                    </div>
                    <div class="flex flex-1 flex-col p-4">
                        <h3 class="text-base font-bold">Vợt JOOLA Ben Johns Hyperion</h3>
                        <p class="text-sm text-text-light-secondary dark:text-text-dark-secondary mb-2">JOOLA
                        </p>
                        <p class="text-lg font-extrabold text-primary mt-auto">5.200.000₫</p>
                        <button
                            class="mt-3 flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary/20 text-text-light-primary dark:text-text-dark-primary gap-2 text-sm font-bold leading-normal tracking-wide hover:bg-primary/30 dark:hover:bg-primary/30 transition-colors">
                            <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                            Thêm vào giỏ
                        </button>
                    </div>
                </div>
                <!-- Product Card 3 -->
                <div
                    class="flex flex-col overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark group">
                    <div class="relative overflow-hidden">
                        <img class="aspect-square w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            data-alt="A set of yellow pickleballs on a blue court."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBOMFb91LZceRakp5tp9LNceovi3UYdLUFUgCcM8_EaH7B5jDAsqtrlpDVgQmbxJkaeD8FCkyB2XS9FB_w677oWGKfOD6LiRb27dtSDkseEJIwQfJ9emBSZaOfrcSTtRgG4d8_gyBbab1hC5rChnbwVRTX60D5KYCYq6BwWJSQkZDETsuZnPaioA8k7NLefHUTcBD0rzJPLCxR9vSvUzABQxHb3_XY3B8A0MBxZB6msECfmif117r99Zrvm9DteTrLDymTJMJraY84X" />
                    </div>
                    <div class="flex flex-1 flex-col p-4">
                        <h3 class="text-base font-bold">Bóng Onix Fuse G2 (Hộp 6)</h3>
                        <p class="text-sm text-text-light-secondary dark:text-text-dark-secondary mb-2">Onix</p>
                        <p class="text-lg font-extrabold text-primary mt-auto">450.000₫</p>
                        <button
                            class="mt-3 flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary/20 text-text-light-primary dark:text-text-dark-primary gap-2 text-sm font-bold leading-normal tracking-wide hover:bg-primary/30 dark:hover:bg-primary/30 transition-colors">
                            <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                            Thêm vào giỏ
                        </button>
                    </div>
                </div>
                <!-- Product Card 4 -->
                <div
                    class="flex flex-col overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark group">
                    <div class="relative overflow-hidden">
                        <img class="aspect-square w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            data-alt="A pair of modern white and green sports shoes."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCkGhB2GIDU9UNPLUHcBeet5Bpg1JQKB0mMqx6ihCA4Sxqc-EvM971U60udWzEURgDCliQVv_ZSmdYBw-kJ90r7n391hkXpAtOHujCoSxMEFW-pkbiXVmRvSZRagyUuz-s-9YVK4ns1F7COSU1sog7r9y6GUamX81d9Jt7rqqGk8gUkYdpbsTzL-VExcCXD0asPs54w0wgFaF98_Noo1G_kVJccjezoqfgek8cbACVK1qsG1793VrIAZSffx08cqlyXjQJ4rzJkTMm6" />
                    </div>
                    <div class="flex flex-1 flex-col p-4">
                        <h3 class="text-base font-bold">Giày Pickleball Chuyên Dụng</h3>
                        <p class="text-sm text-text-light-secondary dark:text-text-dark-secondary mb-2">BrandX
                        </p>
                        <p class="text-lg font-extrabold text-primary mt-auto">2.800.000₫</p>
                        <button
                            class="mt-3 flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary/20 text-text-light-primary dark:text-text-dark-primary gap-2 text-sm font-bold leading-normal tracking-wide hover:bg-primary/30 dark:hover:bg-primary/30 transition-colors">
                            <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                            Thêm vào giỏ
                        </button>
                    </div>
                </div>
                <!-- Product Card 5 -->
                <div
                    class="flex flex-col overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark group">
                    <div class="relative overflow-hidden">
                        <img class="aspect-square w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            data-alt="A black sports bag with green accents, designed for pickleball gear."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjBq8pD9O1gRwUBJiMZ63jtkGtaiwqOVOnKZPKUaG9yDIt5_8WxXfUiKam7_rM8Qiul3c5QWlJ67cDxW4Vjh4Aa3V5YJ0shlGRdwjEH3BI1nDW_kpVH8XletAD0TWPxP9sdZuOA5FG23O2u91aSOiwmJghewl4EEUnvKgkiPWknl4dOdMw475-IMBSxZuK_-FTXohx_zA7tROrmw5-YL1vE5s4H_Ay1LbER8jb87cyoAqzETVV7gIKZ9_8b40253BM5wsV1eG7oBcM" />
                    </div>
                    <div class="flex flex-1 flex-col p-4">
                        <h3 class="text-base font-bold">Balo Pickleball Selkirk Tour</h3>
                        <p class="text-sm text-text-light-secondary dark:text-text-dark-secondary mb-2">Selkirk
                        </p>
                        <p class="text-lg font-extrabold text-primary mt-auto">3.100.000₫</p>
                        <button
                            class="mt-3 flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary/20 text-text-light-primary dark:text-text-dark-primary gap-2 text-sm font-bold leading-normal tracking-wide hover:bg-primary/30 dark:hover:bg-primary/30 transition-colors">
                            <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                            Thêm vào giỏ
                        </button>
                    </div>
                </div>
                <!-- Product Card 6 -->
                <div
                    class="flex flex-col overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark group">
                    <div class="relative overflow-hidden">
                        <img class="aspect-square w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            data-alt="An assortment of pickleball accessories including grip tape and wristbands."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBTgT-Zpr-edSbdSZeE3E9yt6f_M-2OsatWMyt-NzcGDqmT2nsmz5hcSjcotKeRlcImMv_qdwx-7duKKa_Yprtw6s-Pp-dH8Ry2uSnbGLFq2EBfWqO232cPCCQS5PlCdLIQU-1ALSt1_0hzID_Tg0e5nTK3GdlA9t_QKHp3cTXDdOEMjGRB8SDPcIm3CJ4zPoSaP-iMKidpFpk6rgArja0FCZdTi8gzsK7Cur795KupkFVMqN9iaFokGNWT7rYvf6pMHiGDUO7ibWaB" />
                        <span
                            class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">-15%</span>
                    </div>
                    <div class="flex flex-1 flex-col p-4">
                        <h3 class="text-base font-bold">Bộ Phụ Kiện Cơ Bản</h3>
                        <p class="text-sm text-text-light-secondary dark:text-text-dark-secondary mb-2">Generic
                        </p>
                        <div class="mt-auto flex items-baseline gap-2">
                            <p class="text-lg font-extrabold text-primary">850.000₫</p>
                            <p
                                class="text-sm text-text-light-secondary dark:text-text-dark-secondary line-through">
                                1.000.000₫</p>
                        </div>
                        <button
                            class="mt-3 flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary/20 text-text-light-primary dark:text-text-dark-primary gap-2 text-sm font-bold leading-normal tracking-wide hover:bg-primary/30 dark:hover:bg-primary/30 transition-colors">
                            <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                            Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>
            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                <nav class="flex items-center gap-2">
                    <button
                        class="flex h-9 w-9 items-center justify-center rounded-lg hover:bg-primary/20 transition-colors text-text-light-secondary dark:text-text-dark-secondary"><span
                            class="material-symbols-outlined text-xl">chevron_left</span></button>
                    <button
                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary text-background-dark text-sm font-bold">1</button>
                    <button
                        class="flex h-9 w-9 items-center justify-center rounded-lg hover:bg-primary/20 transition-colors text-sm font-bold">2</button>
                    <button
                        class="flex h-9 w-9 items-center justify-center rounded-lg hover:bg-primary/20 transition-colors text-sm font-bold">3</button>
                    <span class="text-sm font-bold">...</span>
                    <button
                        class="flex h-9 w-9 items-center justify-center rounded-lg hover:bg-primary/20 transition-colors text-sm font-bold">8</button>
                    <button
                        class="flex h-9 w-9 items-center justify-center rounded-lg hover:bg-primary/20 transition-colors text-text-light-secondary dark:text-text-dark-secondary"><span
                            class="material-symbols-outlined text-xl">chevron_right</span></button>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection