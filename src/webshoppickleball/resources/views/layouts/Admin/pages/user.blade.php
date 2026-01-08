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
                placeholder="Tìm kiếm theo email khách hàng" type="search" />
        </label>
        <!-- Stock Status Filter -->
        <div class="relative min-w-[180px]">
            <select id="filter_status"
                class="w-full pl-4 pr-10 py-2.5 border border-[#cfe7d7] dark:border-gray-600 rounded-lg bg-[#f8fcf9] dark:bg-gray-800 text-text-main dark:text-white text-sm focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary cursor-pointer">
                <option value="">Tất cả trạng thái</option>
                <option value="1">Hoạt động</option>
                <option value="0">Chưa kích hoạt</option>
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
                <tbody id="list_user_body" class="divide-y divide-border-color dark:divide-white/10">
                    <!-- <tr class="group hover:bg-primary/5 transition-colors">
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
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.Admin.widget.__pagination')
</div>
<script>
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';')[0];
        return null;
    }
    function getAllUser(page = 1, role = 1, perPage = 20) {
        const email = $('#input_search').val();
        const status = $('#filter_status').val()
        $.ajax({
            url: '/api/user',
            method: 'GET',
            data: {
                page: page,
                role: role,
                email: email,
                status: status,
                per_page: perPage
            },
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            beforeSend: function () {
                showLoader(); // HIỆN LOADER
            },
            success: function(res) {
                const pagination = res.data;
                currentPage = pagination.current_page;
                lastPage = pagination.last_page;

                $('#list_user_body').html('');
                pagination.data.forEach(item => {
                    $('#list_user_body').append(renderItems(item));
                });

                updatePaginationUI(pagination);

            },
            error: function(err) {
                Swal.close();
                console.error('Không thể tải danh sách sản phẩm:', err);
            },
            complete: function () {
                hideLoader(); // TẮT LOADER
            }
        });
    }

    function renderItems(item){
        const isChecked = item.status == 1 ? 'checked' : '';
        return `
        <tr class="group hover:bg-primary/5 transition-colors">
            <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="size-12 rounded-lg bg-gray-100 dark:bg-white/10 bg-cover bg-center shrink-0 border border-border-color dark:border-white/10"
                        data-alt="Hình ảnh minh họa danh mục Vợt Pickleball"
                        style="background-image: url('${
                            item.avatar
                                ? '/storage/' + item.avatar
                                : '/images/no-image.png'
                        }');">
                    </div>
                    <div>
                        <p class="font-bold text-text-main dark:text-white text-sm">${item.name}</p>
                        <p class="text-xs text-text-secondary dark:text-gray-500 sm:hidden">Vợt thi đấu
                            chuyên nghiệp</p>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 max-w-xs hidden sm:table-cell">
                <p class="text-sm text-text-main dark:text-gray-300 truncate">${item.email}</p>
            </td>
            <td class="px-6 py-4">
                <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-gray-200">
                    ${item.phone}
                </span>
            </td>
            <td class="px-6 py-4">
                ${item.status == 1
                    ? `<div
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                        <span class="size-1.5 rounded-full bg-green-500"></span>
                        Hoạt động
                    </div>`
                    : `<div
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                        <span class="size-1.5 rounded-full bg-red-500"></span>
                        Chưa kích hoạt
                    </div>`
                }
            </td>
            <td class="px-6 py-4 text-right">
                <div class="flex items-center justify-end">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                            class="sr-only peer toggle-status" 
                            data-id="${item.id}" 
                            ${isChecked}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 
                                    peer-checked:after:translate-x-[20px] peer-checked:after:border-white 
                                    after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                                    after:bg-white after:border-gray-300 after:border after:rounded-full 
                                    after:h-5 after:w-5 after:transition-all dark:border-gray-600 
                                    peer-checked:bg-primary">
                        </div>
                    </label>
                </div>
            </td>
        </tr>`;
    }

    $(document).ready(function () {
        getAllUser();
    });

    function updatePaginationUI(pagination) {
        $('#pagination_info').html(`
            Hiển thị <b>${pagination.from || 0}-${pagination.to || 0}</b>
            trong tổng số <b>${pagination.total}</b> bản ghi
        `);

        const $numbersContainer = $('#pagination_numbers');
        $numbersContainer.empty();

        for (let i = 1; i <= pagination.last_page; i++) {
            const isActive = i === pagination.current_page;
            const activeClass = isActive 
                ? 'bg-primary text-[#0d1b12] font-bold' 
                : 'border text-text-main dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800';

            $numbersContainer.append(`
                <button class="page-btn w-8 h-8 rounded-lg text-sm transition-all ${activeClass}" 
                        data-page="${i}">
                    ${i}
                </button>
            `);
        }

        $('#btn_prev').prop('disabled', pagination.current_page <= 1);
        $('#btn_next').prop('disabled', pagination.current_page >= pagination.last_page);
    }

    let currentPage = 1;
    let lastPage = 1;

    $(document).on('click', '.page-btn', function () {
        const page = $(this).data('page');

        getAllUser(page);
    });

    $('#btn_prev').on('click', function () {
        getAllUser(currentPage - 1);
    });

    $('#btn_next').on('click', function () {
        getAllUser(currentPage + 1);
    });

    $(document).on('change', '.toggle-status', function() {
        const $checkbox = $(this);
        const userId = $checkbox.data('id');
        const isChecked = $checkbox.is(':checked');
        const newStatus = isChecked ? 1 : 0;

        // Vô hiệu hóa tạm thời để tránh người dùng bấm liên tục khi đang xử lý
        $checkbox.prop('disabled', true);

        $.ajax({
            url: `/api/user/${userId}`,
            method: 'POST',
            data: {
                status: newStatus,
            },
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                // Hiển thị thông báo nhỏ (Toast)
                if (newStatus === 1) {
                    showToast('Đã kích hoạt tài khoản', 'success');
                } else {
                    showToast('Đã khóa tài khoản', 'success');
                }
                
                getAllUser(currentPage); 
            },
            error: function(err) {
                // Nếu lỗi, gạt nút quay trở lại trạng thái ban đầu
                $checkbox.prop('checked', !isChecked);
                
                let errorMsg = 'Không thể cập nhật trạng thái';
                if(err.responseJSON && err.responseJSON.message) {
                    errorMsg = err.responseJSON.message;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: errorMsg,
                    confirmButtonColor: '#10b981'
                });
            },
            complete: function() {
                // Mở khóa lại checkbox sau khi xong
                $checkbox.prop('disabled', false);
            }
        });
    });

    function showToast(message, type = 'success') {
        const color = type === 'success' ? '#10b981' : '#f59e0b';
        Swal.fire({
            text: message,
            icon: type,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        });
    }

    let typingTimer = null;
    $('#input_search').on('keyup', function () {
        clearTimeout(typingTimer);

        typingTimer = setTimeout(function () {
            $('#filter_status').val("");
            getAllUser(1);
        }, 400);
    });

    $('#filter_status').on('change', function () {
        
        $('#input_search').val("");
        getAllUser(1);
    });
</script>
@endsection