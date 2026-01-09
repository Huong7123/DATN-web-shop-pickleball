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
        <span class="text-text-main dark:text-white font-bold">Quản trị viên</span>
    </div>
    <!-- Page Heading & Actions -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl md:text-4xl font-black tracking-tight text-text-main dark:text-white">Danh sách quản trị viên</h1>
        </div>
        <button id="btn_modal_add"
            class="group flex items-center justify-center gap-2 rounded-lg h-12 px-6 bg-primary hover:bg-primary-dark transition-all shadow-lg shadow-green-500/20 text-[#0d1b12] text-sm font-bold">
            <span class="material-symbols-outlined">add</span>
            <span>Thêm QTV mới</span>
        </button>
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
                placeholder="Tìm kiếm theo email quản trị viên" type="search" />
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
                            Quản trị viên</th>
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
                    
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.Admin.widget.__pagination')
</div>
<div id="modal_user" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 transition-opacity bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark min-h-screen flex items-center justify-center p-4 hidden">
    <div
        class="relative w-full max-w-md bg-surface-light dark:bg-surface-dark rounded-xl shadow-2xl z-50 flex flex-col max-h-[90vh] overflow-hidden border border-border-light dark:border-border-dark animate-in fade-in zoom-in-95 duration-200">
        
        <div class="flex items-center justify-between px-6 py-4 border-b border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark sticky top-0 z-10">
            <div>
                <h2 class="text-lg font-bold tracking-tight">Thêm quản trị viên</h2>
            </div>
            <button class="btn-close-modal p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 transition-colors text-gray-500 dark:text-gray-400">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <div class="overflow-y-auto custom-scrollbar flex-1 p-6 space-y-5">
            <section class="flex flex-col gap-5">
                <div>
                    <label class="block text-sm font-medium mb-1.5 text-text-light dark:text-text-dark">Tên QTV <span class="text-red-500">*</span></label>
                    <input id="name_input"
                        class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-shadow"
                        placeholder="Nhập họ tên" type="text" />
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1.5 text-text-light dark:text-text-dark">Số điện thoại <span class="text-red-500">*</span></label>
                    <input id="phone_input"
                        class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-shadow"
                        placeholder="09xx xxx xxx" type="text" />
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1.5 text-text-light dark:text-text-dark">Email <span class="text-red-500">*</span></label>
                    <input id="email_input"
                        class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-shadow"
                        placeholder="email@example.com" type="email" />
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1.5 text-text-light dark:text-text-dark">Mật khẩu <span class="text-red-500">*</span></label>
                    <input id="password_input"
                        class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-shadow"
                        placeholder="••••••••" type="password" />
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1.5 text-text-light dark:text-text-dark">Xác nhận mật khẩu <span class="text-red-500">*</span></label>
                    <input id="password_confirm_input"
                        class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-shadow"
                        placeholder="••••••••" type="password" />
                </div>
            </section>
        </div>

        <div class="px-6 py-4 border-t border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark flex justify-end gap-3 sticky bottom-0 z-10">
            <button class="btn-close-modal px-4 py-2 rounded-lg border border-border-light dark:border-border-dark text-text-light dark:text-text-dark font-semibold text-sm hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                Hủy
            </button>
            <button id="btn_save_user"
                class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-black font-bold text-sm shadow-lg shadow-primary/20 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">save</span>
                Lưu thông tin
            </button>
        </div>
    </div>
</div>

<script>
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';')[0];
        return null;
    }
    function getAllAdmin(page = 1, role = 2, perPage = 20) {
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

    function renderItems(item) {
        const isChecked = item.status == 1 ? 'checked' : '';
        const adminEmail = sessionStorage.getItem('admin_email');
        
        const isSelf = item.email === adminEmail;
        return `
        <tr class="group hover:bg-primary/5 transition-colors">
            <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                    <div>
                        <p class="font-bold text-text-main dark:text-white text-sm">${item.name}</p>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 max-w-xs hidden sm:table-cell">
                <p class="text-sm text-text-main dark:text-gray-300 truncate">${item.email}</p>
            </td>
            <td class="px-6 py-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-gray-200">
                    ${item.phone || 'N/A'}
                </span>
            </td>
            <td class="px-6 py-4">
                ${item.status == 1
                    ? `<div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                        <span class="size-1.5 rounded-full bg-green-500"></span>Hoạt động</div>`
                    : `<div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                        <span class="size-1.5 rounded-full bg-red-500"></span>Chưa kích hoạt</div>`
                }
            </td>
            <td class="px-6 py-4 text-right col-actions">
                <div class="flex items-center justify-end gap-4">
                    ${isSelf 
                        ? `<span class="text-xs italic text-text-secondary dark:text-gray-500">Đang đăng nhập</span>` 
                        : `
                        <label class="relative inline-flex items-center cursor-pointer group">
                            <input type="checkbox" 
                                class="sr-only peer toggle-status" 
                                data-id="${item.id}" 
                                ${isChecked}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer 
                                        dark:bg-gray-700 peer-checked:after:translate-x-[20px] 
                                        peer-checked:after:border-white after:content-[''] 
                                        after:absolute after:top-[2px] after:left-[2px] 
                                        after:bg-white after:border-gray-300 after:border 
                                        after:rounded-full after:h-5 after:w-5 after:transition-all 
                                        dark:border-gray-600 peer-checked:bg-primary">
                            </div>
                        </label>

                        <div class="flex items-center border-l border-gray-200 dark:border-gray-700 ml-2 pl-2 gap-1">
                            <button data-id="${item.id}"
                                class="btn-delete p-1.5 text-gray-400 hover:text-red-500 transition-colors rounded-lg"
                                title="Xóa">
                                <span class="material-symbols-outlined text-[20px]">delete</span>
                            </button>
                        </div>
                        `
                    }
                </div>
            </td>
        </tr>`;
    }

    $(document).ready(function () {
        getAllAdmin();
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

        getAllAdmin(page);
    });

    $('#btn_prev').on('click', function () {
        getAllAdmin(currentPage - 1);
    });

    $('#btn_next').on('click', function () {
        getAllAdmin(currentPage + 1);
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
                
                getAllAdmin(currentPage); 
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
            getAllAdmin(1);
        }, 400);
    });

    $('#filter_status').on('change', function () {
        
        $('#input_search').val("");
        getAllAdmin(1);
    });

    function closeModal() {
        const modal = $('#modal_user');
        modal.addClass('hidden');
    }

    $(document).on('click', '.btn-close-modal', function() {
        closeModal();
    });

    $('#modal_user').on('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // 3. Nhấn phím Escape (ESC) để đóng
    $(document).on('keydown', function(e) {
        if (e.key === "Escape") {
            closeModal();
        }
    });

    $(document).ready(function () {
        // Mở modal thêm mới
        $('#btn_modal_add').on('click', function() {
            $('#modal_user h2').text('Thêm QTV mới');
            // Reset tất cả input
            $('#modal_user input').val(''); 
            $('#modal_user').removeClass('hidden');
        });

        // Lưu dữ liệu (Thêm/Sửa)
        $('#btn_save_user').on('click', function () {
            // Thu thập dữ liệu
            const data = {
                name: $('#name_input').val().trim(),
                email: $('#email_input').val().trim(),
                phone: $('#phone_input').val().trim(),
                password: $('#password_input').val(),
                password_confirmation: $('#password_confirm_input').val()
            };

            // Validate cơ bản
            if (!data.name || !data.email || !data.phone) {
                Swal.fire('Thông báo', 'Vui lòng điền đầy đủ các trường bắt buộc (*)!', 'warning');
                return;
            }

            // Validate mật khẩu khi thêm mới hoặc khi người dùng có nhập mật khẩu mới
            if (data.password) {
                if (data.password !== data.password_confirmation) {
                    Swal.fire('Lỗi!', 'Mật khẩu xác nhận không khớp!', 'error');
                    return;
                }
                if (data.password.length < 6) {
                    Swal.fire('Lỗi!', 'Mật khẩu phải từ 6 ký tự trở lên!', 'error');
                    return;
                }
            }

            $.ajax({
                url: '/api/user',
                method: 'POST',
                dataType: 'json',
                contentType: 'application/json', // Chỉ định gửi JSON
                data: JSON.stringify(data),      // Chuyển object sang chuỗi JSON
                headers: {
                    'Authorization': 'Bearer ' + getCookie('admin_token'),
                    'Accept': 'application/json'
                },
                beforeSend: function () { showLoader(); },
                success: function (res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thêm mới QTV thành công!',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    $('#modal_user').addClass('hidden');
                    getAllAdmin(currentPage);
                },
                error: function (err) {
                    let msg = err.responseJSON?.message || 'Có lỗi xảy ra!';
                    // Nếu có lỗi validation chi tiết từ Laravel (422)
                    if(err.status === 422 && err.responseJSON.errors) {
                        msg = Object.values(err.responseJSON.errors)[0][0];
                    }
                    Swal.fire('Lỗi!', msg, 'error');
                },
                complete: function () { hideLoader(); }
            });
        });

        // Xóa QTV
        $(document).on('click', '.btn-delete', function() {
            const id = $(this).data('id'); 

            Swal.fire({
                title: 'Bạn chắc chắn muốn xóa?',
                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6e7881',
                confirmButtonText: 'Đồng ý xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/api/user/${id}`,
                        type: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + getCookie('admin_token'),
                            'Accept': 'application/json'
                        },
                        beforeSend: function () { showLoader(); },
                        success: function (res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Xoá QTV thành công',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            getAllAdmin(currentPage);
                        },
                        error: function (err) {
                            let msg = err.responseJSON?.message || 'Không thể xóa người dùng này!';
                            Swal.fire('Thất bại!', msg, 'error');
                        },
                        complete: function () { hideLoader(); }
                    });
                }
            });
        });
    });
</script>
@endsection