@extends('layouts.Admin.master')
@section('title', $title)
@section('content')
<div class="w-full px-8 py-6 bg-background-light dark:bg-background-dark z-10">
    <!-- Breadcrumbs -->
    <div class="flex items-center gap-2 mb-6 text-sm">
        <a class="text-text-secondary dark:text-gray-400 hover:text-primary font-medium flex items-center gap-1"
            href="/tong-quan">
            <span class="material-symbols-outlined text-[18px]">home</span>
            Tổng quan
        </a>
        <span class="text-text-secondary dark:text-gray-500">/</span>
        <span class="text-text-main dark:text-white font-bold">Khách hàng</span>
    </div>
    <!-- Page Heading & Actions -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl md:text-4xl font-black tracking-tight text-text-main dark:text-white">Danh sách khách hàng</h1>
        </div>
        <!-- <button id="btn_modal_add"
            class="group flex items-center justify-center gap-2 rounded-lg h-12 px-6 bg-primary hover:bg-primary-dark transition-all shadow-lg shadow-green-500/20 text-[#0d1b12] text-sm font-bold">
            <span class="material-symbols-outlined">add</span>
            <span>Thêm sản phẩm mới</span>
        </button> -->
    </div>
    <!-- Filters & Search Toolbar -->
    <div
        class="mt-8 flex flex-wrap gap-4 items-center bg-surface-light dark:bg-surface-dark p-4 rounded-xl shadow-sm border border-[#e7f3eb] dark:border-gray-700">
        <!-- Search -->
        <label class="flex-1 min-w-[280px] relative group">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span
                    class="material-symbols-outlined text-text-secondary group-focus-within:text-primary transition-colors">search</span>
            </div>
            <input id="input_search"
                class="block w-full pl-10 pr-3 py-2.5 border border-[#cfe7d7] dark:border-gray-600 rounded-lg leading-5 bg-[#f8fcf9] dark:bg-gray-800 text-text-main dark:text-white focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm transition-all"
                placeholder="Tìm kiếm theo tên khách hàng" type="search" />
        </label>
        <!-- Stock Status Filter -->
        <div class="relative min-w-[180px]">
            <select id="filter_status"
                class="w-full pl-4 pr-10 py-2.5 border border-[#cfe7d7] dark:border-gray-600 rounded-lg bg-[#f8fcf9] dark:bg-gray-800 text-text-main dark:text-white text-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary cursor-pointer">
                <option value="-1">Tất cả trạng thái</option>
                <option value="0">Hết hàng</option>
                <option value="1">Sắp hết hàng</option>
                <option value="2">Còn hàng</option>
            </select>
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
                            Khách hàng</th>
                        <th
                            class="px-6 py-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">
                            Email</th>
                        <th
                            class="px-6 py-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">
                            Số điện thoại</th>
                        <th
                            class="px-6 py-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">
                            Trạng thái</th>
                        <th
                            class="px-6 py-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">
                            </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-color dark:divide-white/10">
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
                        <td class="px-6 py-4">
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
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.Admin.widget.__pagination')
</div>
@endsection