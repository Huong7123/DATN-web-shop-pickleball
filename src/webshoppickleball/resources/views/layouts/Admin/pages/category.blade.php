@extends('layouts.Admin.master')
@section('title', $title)
@section('content')
<div class="w-full px-8 py-6 bg-background-light dark:bg-background-dark z-10">
    <!-- Breadcrumbs -->
    <div class="flex items-center gap-2 mb-6 text-sm">
        <a class="text-text-secondary dark:text-gray-400 hover:text-primary font-medium flex items-center gap-1"
            href="#">
            <span class="material-symbols-outlined text-[18px]">home</span>
            Trang chủ
        </a>
        <span class="text-text-secondary dark:text-gray-500">/</span>
        <span class="text-text-main dark:text-white font-bold">Quản trị danh mục</span>
    </div>
    <!-- Page Heading & Actions -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl md:text-4xl font-black tracking-tight text-text-main dark:text-white">Quản trị danh
                mục</h1>
        </div>
        <button
            class="flex items-center gap-2 bg-primary hover:bg-primary-hover text-black px-5 py-3 rounded-lg font-bold shadow-sm shadow-primary/20 transition-all active:scale-95 group">
            <span class="material-symbols-outlined group-hover:rotate-90 transition-transform">add</span>
            <span>Thêm danh mục mới</span>
        </button>
    </div>
    <!-- Filters & Search Toolbar -->
    <div
        class="bg-surface-light dark:bg-surface-dark p-4 rounded-xl border border-border-color dark:border-white/10 shadow-sm mb-6 flex flex-col md:flex-row gap-4 justify-between items-center">
        <div class="flex-1 w-full md:max-w-md relative">
            <span
                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary">search</span>
            <input
                class="w-full pl-10 pr-4 py-2.5 bg-background-light dark:bg-black/20 border border-border-color dark:border-white/10 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 text-text-main dark:text-white"
                placeholder="Tìm kiếm danh mục theo tên..." type="text" />
        </div>
        <div class="flex items-center gap-3 w-full md:w-auto">
            <div class="relative w-full md:w-48">
                <select
                    class="w-full appearance-none bg-background-light dark:bg-black/20 border border-border-color dark:border-white/10 rounded-lg px-4 py-2.5 text-text-main dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 cursor-pointer">
                    <option value="">Tất cả trạng thái</option>
                    <option value="active">Đang hiển thị</option>
                    <option value="hidden">Đang ẩn</option>
                </select>
                <span
                    class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-text-secondary pointer-events-none text-sm">expand_more</span>
            </div>
            <div class="relative w-full md:w-48">
                <select
                    class="w-full appearance-none bg-background-light dark:bg-black/20 border border-border-color dark:border-white/10 rounded-lg px-4 py-2.5 text-text-main dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 cursor-pointer">
                    <option value="newest">Mới nhất</option>
                    <option value="name_asc">Tên (A-Z)</option>
                    <option value="products_desc">Nhiều sản phẩm nhất</option>
                </select>
                <span
                    class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-text-secondary pointer-events-none text-sm">sort</span>
            </div>
        </div>
    </div>
</div>
<div class="flex-1 overflow-y-auto px-8 pb-8">
    <!-- Data Table -->
    <div
        class="bg-surface-light dark:bg-surface-dark rounded-xl border border-border-color dark:border-white/10 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-background-light dark:bg-white/5 border-b border-border-color dark:border-white/10">
                        <th
                            class="px-6 py-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">
                            Tên danh mục</th>
                        <th
                            class="px-6 py-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider hidden sm:table-cell">
                            Mô tả</th>
                        <th
                            class="px-6 py-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider text-center">
                            Số lượng SP</th>
                        <th
                            class="px-6 py-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">
                            Trạng thái</th>
                        <th
                            class="px-6 py-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider text-right">
                            Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-color dark:divide-white/10">
                    <!-- Row 1 -->
                    <tr class="group hover:bg-primary/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="size-12 rounded-lg bg-gray-100 dark:bg-white/10 bg-cover bg-center shrink-0 border border-border-color dark:border-white/10"
                                    data-alt="Hình ảnh minh họa danh mục Vợt Pickleball"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCP-Zdtd1bLHi4mZi3N55EudMUD1O4xb7q1X2kv3F3ptN4v9q_N8dX4o7lfWJuwUH9htYclLad9lgbfXr8Y-Fn96bMnaMRkjE5zapFK9KDFOopBmdDP9999oZt8TjczQQhX6JNJLoy5RPRt9C-a4WofHMZASeAhd1_xCZLfHb9z_tX3WHmf_Q0UNRbXMTpGMfwKMIGlGz-7gLUN0smyO5_QPl1-DnyELv3u8lhmLjO_eQgQwAL1RibuNnnYhjyodvEfUyYlyqnNVxJ4");'>
                                </div>
                                <div>
                                    <p class="font-bold text-text-main dark:text-white text-sm">Vợt Pickleball</p>
                                    <p class="text-xs text-text-secondary dark:text-gray-500 sm:hidden">Vợt thi đấu
                                        chuyên nghiệp</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 max-w-xs hidden sm:table-cell">
                            <p class="text-sm text-text-main dark:text-gray-300 truncate">Các dòng vợt Carbon,
                                Composite chuyên nghiệp và tập luyện</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-gray-200">
                                124
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                <span class="size-1.5 rounded-full bg-green-500"></span>
                                Hiển thị
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button
                                    class="p-2 text-text-secondary hover:text-primary hover:bg-green-50 rounded-lg transition-colors"
                                    title="Chỉnh sửa">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button
                                    class="p-2 text-text-secondary hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                    title="Xóa">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="group hover:bg-primary/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="size-12 rounded-lg bg-gray-100 dark:bg-white/10 bg-cover bg-center shrink-0 border border-border-color dark:border-white/10"
                                    data-alt="Hình ảnh minh họa danh mục Bóng thi đấu"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCVLlFP_oP7eITKoBwMGZvnzFa54O8JAWxUUqFOKCPGjtI60C_DU8y6d4BoOe0tzY9FAwT9aiuQqCUnNZizOkSpNtYcCcDruvixElWdE53xbzbFm0CJ8KTSL8046ScfCY6xWw9L-pmPWZFGlQR9Y6AGORonL8EY4hBUVJx9Ycs3FnSJOlyqLMLa1Pny8pK8KMNTIRCYRb92Mi2SXl24wqLsZlENjtzKsF3LuguBQuie5JZELj-GoSY_UzyJteDOBBv_pv79ZdTVFG1p");'>
                                </div>
                                <div>
                                    <p class="font-bold text-text-main dark:text-white text-sm">Bóng Pickleball</p>
                                    <p class="text-xs text-text-secondary dark:text-gray-500 sm:hidden">Bóng trong
                                        nhà &amp; ngoài trời</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 max-w-xs hidden sm:table-cell">
                            <p class="text-sm text-text-main dark:text-gray-300 truncate">Bóng tiêu chuẩn thi đấu,
                                độ bền cao, nhiều màu sắc</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-gray-200">
                                45
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                <span class="size-1.5 rounded-full bg-green-500"></span>
                                Hiển thị
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button
                                    class="p-2 text-text-secondary hover:text-primary hover:bg-green-50 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button
                                    class="p-2 text-text-secondary hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="group hover:bg-primary/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="size-12 rounded-lg bg-gray-100 dark:bg-white/10 bg-cover bg-center shrink-0 border border-border-color dark:border-white/10"
                                    data-alt="Hình ảnh minh họa danh mục Trang phục"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD7NT_UVlsD5JSM6sWtK3c2sP6VhXIJcJQr1jfzt4yWtOHuB_c3M8EhIKo_7AigdQJvcAWUNwSIFovFz3rVgmma4RAC9qlw_Pzh_V2GXHVJPh_7gK8GtWFWVr_TKdrCvN9pMATrtbFOKyf2h1QzR9fi02QqkWEUuG0qcRHzTHYLMreyZZn8UqLB1dbWf9AWpo0R_-iWK2O6tK27FpO8yDTtBgoST21HbATyHDBwSkg5FO1HXgwZ2wyPivu0IVBwte2H3uCKMCTt5o-y");'>
                                </div>
                                <div>
                                    <p class="font-bold text-text-main dark:text-white text-sm">Trang phục thi đấu
                                    </p>
                                    <p class="text-xs text-text-secondary dark:text-gray-500 sm:hidden">Quần áo nam
                                        nữ</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 max-w-xs hidden sm:table-cell">
                            <p class="text-sm text-text-main dark:text-gray-300 truncate">Áo thun, quần short, váy
                                thể thao thoáng khí</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-gray-200">
                                210
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200 dark:bg-white/10 dark:text-gray-400 dark:border-white/10">
                                <span class="size-1.5 rounded-full bg-gray-400"></span>
                                Đang ẩn
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button
                                    class="p-2 text-text-secondary hover:text-primary hover:bg-green-50 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button
                                    class="p-2 text-text-secondary hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 4 -->
                    <tr class="group hover:bg-primary/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="size-12 rounded-lg bg-gray-100 dark:bg-white/10 bg-cover bg-center shrink-0 border border-border-color dark:border-white/10"
                                    data-alt="Hình ảnh minh họa danh mục Phụ kiện"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAEa0IpWLZRNggESzo2MfMtHNJJiM4FS4dP5o9VkNcBt0YmjsKj-bzyZS2WawHdCDWMpUZhUhVyYZzLAAzBLiHeQzGacgUGD1JRa2Hos5AgItCyuVlb4g0-Abiq0nPePTTkAQsuwqMvfgjz4kjA290uVK0rpcrtxvBNCbBGZYbm5UhZLZ747OafXB0Qn5p4DzLvC-i56_fDwsyx6kDQqb0vH7czS2ta5AZONZGmkN5Ks0_A1okCbVqbA8GHmzRdRqHuRHFpmUURN2aJ");'>
                                </div>
                                <div>
                                    <p class="font-bold text-text-main dark:text-white text-sm">Phụ kiện &amp; Balo
                                    </p>
                                    <p class="text-xs text-text-secondary dark:text-gray-500 sm:hidden">Túi, nón,
                                        băng tay</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 max-w-xs hidden sm:table-cell">
                            <p class="text-sm text-text-main dark:text-gray-300 truncate">Balo đựng vợt, túi xách,
                                băng đô, tất thể thao</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-gray-200">
                                67
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                <span class="size-1.5 rounded-full bg-green-500"></span>
                                Hiển thị
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button
                                    class="p-2 text-text-secondary hover:text-primary hover:bg-green-50 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button
                                    class="p-2 text-text-secondary hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 5 -->
                    <tr class="group hover:bg-primary/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="size-12 rounded-lg bg-gray-100 dark:bg-white/10 bg-cover bg-center shrink-0 border border-border-color dark:border-white/10"
                                    data-alt="Hình ảnh minh họa danh mục Giày"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCeADhC9wY-IW8ZdGpWOZJunyF5ozo4A_9zXamdgMhx4Tj8YL3gBKmSYF0frtx9vqluyEBeSsdTENhKDbF3oZylldp133LLyOG_LwIdhIAu1dewU4oVBhVuzR-kwy062g5IU7qHI5K6BLeBAxF3mddnrEvkMWrVOcDLpvPiNxoSFBHDkjzTgWmzrn2DaHiQHCwD0UdCBtAhGmD8PyknLyCfI_ClYCJPs-CNSBn8GRBMldTihU-syROsE9TvoouHc6Evr77ofNKs1p9d");'>
                                </div>
                                <div>
                                    <p class="font-bold text-text-main dark:text-white text-sm">Giày Pickleball</p>
                                    <p class="text-xs text-text-secondary dark:text-gray-500 sm:hidden">Giày chuyên
                                        dụng sân cứng</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 max-w-xs hidden sm:table-cell">
                            <p class="text-sm text-text-main dark:text-gray-300 truncate">Giày có đế bám tốt, hỗ trợ
                                di chuyển ngang, đệm êm</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-gray-200">
                                89
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                <span class="size-1.5 rounded-full bg-green-500"></span>
                                Hiển thị
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button
                                    class="p-2 text-text-secondary hover:text-primary hover:bg-green-50 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button
                                    class="p-2 text-text-secondary hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        @include('layouts.Admin.widget.__pagination')
    </div>
</div>
@endsection