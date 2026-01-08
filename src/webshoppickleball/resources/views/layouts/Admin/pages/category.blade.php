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
        <span class="text-text-main dark:text-white font-bold">Danh mục sản phẩm</span>
    </div>
    <!-- Page Heading & Actions -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl md:text-4xl font-black tracking-tight text-text-main dark:text-white">Danh sách danh mục</h1>
        </div>
        <button id="btn_modal_add"
            class="group flex items-center justify-center gap-2 rounded-lg h-12 px-6 bg-primary hover:bg-primary-dark transition-all shadow-lg shadow-green-500/20 text-[#0d1b12] text-sm font-bold">
            <span class="material-symbols-outlined">add</span>
            <span>Thêm sản phẩm mới</span>
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
                <option value="0">Bị khoá</option>
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
                            Danh mục</th>
                        <th
                            class="px-6 py-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">
                            Trạng thái</th>
                        <th
                            class="px-6 py-4 text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">
                            </th>
                    </tr>
                </thead>
                <tbody id="list_category_body" class="divide-y divide-border-color dark:divide-white/10">
                    
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.Admin.widget.__pagination')
</div>
<div id="modal_category" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 transition-opacity bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark min-h-screen flex items-center justify-center p-4 hidden">
    <div
        class="relative w-full max-w-4xl bg-surface-light dark:bg-surface-dark rounded-xl shadow-2xl z-50 flex flex-col max-h-[90vh] overflow-hidden border border-border-light dark:border-border-dark animate-in fade-in zoom-in-95 duration-200">
        <!-- Header -->
        <div
            class="flex items-center justify-between px-6 py-4 border-b border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark sticky top-0 z-10">
            <div>
                <h2 class="text-xl font-bold tracking-tight">Thêm danh mục Mới</h2>
            </div>
            <button
                class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 transition-colors text-gray-500 dark:text-gray-400">
                <span class="btn-close-modal material-symbols-outlined">close</span>
            </button>
        </div>
        <!-- Scrollable Body -->
        <div class="overflow-y-auto custom-scrollbar flex-1 p-6 space-y-8" style="overflow-anchor: none;">
            <!-- Image Upload Section -->
            <section>
                <h3 class="text-base font-semibold mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">image</span>
                    Hình ảnh danh mục
                </h3>
                <!-- Input file (ẩn) -->
                <input
                    type="file"
                    id="image_input"
                    multiple
                    accept="image/png,image/jpeg,image/webp"
                    class="hidden"
                />
                <!-- Upload box -->
                <div
                    id="upload_box"
                    class="flex flex-col items-center justify-center gap-4 rounded-xl
                        border-2 border-dashed border-primary/30 dark:border-primary/20
                        bg-background-light dark:bg-background-dark/50
                        px-6 py-10 hover:border-primary
                        transition-colors cursor-pointer group">
                    <div
                        class="flex h-16 w-16 items-center justify-center
                            rounded-full bg-primary/10
                            group-hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-primary text-3xl">
                            cloud_upload
                        </span>
                    </div>
                    <div class="text-center">
                        <p class="text-base font-bold">Tải ảnh lên</p>
                        <p class="text-xs text-gray-400 mt-1">
                            PNG, JPG, WEBP tối đa 5MB
                        </p>
                    </div>
                </div>
                <!-- Preview -->
                <div
                    id="image_preview"
                    class="flex gap-4 mt-4 overflow-x-auto pb-2">
                </div>
            </section>

            <!-- General Info Section -->
            <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-base font-semibold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">edit_document</span>
                        Thông tin chung
                    </h3>
                </div>
                <!-- Product Name -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium mb-2 text-text-light dark:text-text-dark">Tên danh mục <span
                            class="text-red-500">*</span></label>
                    <input id="name_input"
                        class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                        placeholder="Ví dụ: Vợt Pickleball" type="text" />
                </div>
            </section>
        </div>
        <!-- Sticky Footer -->
        <div
            class="px-6 py-4 border-t border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark flex justify-end gap-3 sticky bottom-0 z-10">
            <button
                class="btn-close-modal px-6 py-2.5 rounded-lg border border-border-light dark:border-border-dark text-text-light dark:text-text-dark font-semibold text-sm hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                Hủy bỏ
            </button>
            <button id="btn_save_category"
                class="px-6 py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-black font-bold text-sm shadow-lg shadow-primary/20 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">save</span>
                Lưu danh mục
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
    function getAllCategory(page = 1, perPage = 20) {
        const name = $('#input_search').val();
        const status = $('#filter_status').val()
        $.ajax({
            url: '/api/category',
            method: 'GET',
            data: {
                page: page,
                name: name,
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

                $('#list_category_body').html('');
                pagination.data.forEach(item => {
                    $('#list_category_body').append(renderItems(item));
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
                            item.image
                                ? '/storage/' + item.image
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
            <td class="px-6 py-4">
                <div class="flex items-center gap-4 min-w-[150px]">
                    <div class="shrink-0">
                        ${item.status == 1
                            ? `<div style="width: 96px;" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-green-100 text-green-800 border border-green-200 shadow-sm">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                </span>
                                Hoạt động
                            </div>`
                            : `<div style="width: 96px;" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-red-50 text-red-700 border border-red-100 shadow-sm">
                                <span class="size-2 rounded-full bg-red-500"></span>
                                Đã khoá
                            </div>`
                        }
                    </div>
                    <div class="flex items-center">
                        <label class="relative inline-flex items-center cursor-pointer group">
                            <input type="checkbox" 
                                class="sr-only peer toggle-status" 
                                data-id="${item.id}" 
                                ${item.status == 1 ? 'checked' : ''}>
                            <div class="w-10 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 
                                        peer-checked:after:translate-x-full peer-checked:after:border-white 
                                        after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                                        after:bg-white after:border-gray-300 after:border after:rounded-full 
                                        after:h-4 after:w-4 after:transition-all dark:border-gray-600 
                                            peer-checked:bg-primary group-hover:ring-4 group-hover:ring-primary/10">
                            </div>
                        </label>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 text-right">
                <div class="flex items-center justify-end gap-2">
                    <button data-id="${item.id}"
                        data-image="${item.image}"
                        data-name="${item.name}"
                        class="btn-edit p-1.5 rounded text-gray-400 hover:text-primary hover:bg-green-50 dark:hover:bg-gray-700 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">edit</span>
                    </button>
                    <button data-id="${item.id}"
                        class="btn-delete p-1.5 rounded text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-gray-700 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">delete</span>
                    </button>
                </div>
            </td>
        </tr>`;
    }

    $(document).ready(function () {
        getAllCategory();
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

        getAllCategory(page);
    });

    $('#btn_prev').on('click', function () {
        getAllUser(currentPage - 1);
    });

    $('#btn_next').on('click', function () {
        getAllUser(currentPage + 1);
    });

    $(document).on('change', '.toggle-status', function() {
        const $checkbox = $(this);
        const categoryId = $checkbox.data('id');
        const isChecked = $checkbox.is(':checked');
        const newStatus = isChecked ? 1 : 0;

        // Vô hiệu hóa tạm thời để tránh người dùng bấm liên tục khi đang xử lý
        $checkbox.prop('disabled', true);

        $.ajax({
            url: `/api/category/${categoryId}`,
            method: 'POST',
            data: {
                status: newStatus,
            },
            headers: {
                'Authorization': 'Bearer ' + getCookie('admin_token')
            },
            success: function(res) {
                // Hiển thị thông báo nhỏ (Toast)
                showToast('Cập nhật trạng thái thành công!', 'success');
                
                getAllCategory(currentPage); 
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
            getAllCategory(1);
        }, 400);
    });

    $('#filter_status').on('change', function () {
        $('#input_search').val("");
        getAllCategory(1);
    });

    function closeModal() {
        const modal = $('#modal_category');
        modal.addClass('hidden');
    }

    $(document).on('click', '.btn-close-modal', function() {
        closeModal();
    });

    $('#modal_category').on('click', function(e) {
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
        let selectedFile = null;
        let currentPage = 1;

        $('#upload_box').on('click', function () {
            $('#image_input').click();
        });

        $('#image_input').on('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                if (!file.type.startsWith('image/')) {
                    Swal.fire('Lỗi', 'Vui lòng chọn định dạng ảnh!', 'error');
                    return;
                }
                if (file.size > 5 * 1024 * 1024) {
                    Swal.fire('Lỗi', 'Ảnh không được quá 5MB!', 'error');
                    return;
                }

                selectedFile = file;
                const url = URL.createObjectURL(file);

                $('#image_preview').html(`
                    <div class="relative w-24 h-24 rounded-lg overflow-hidden border-2 border-primary shrink-0 group cursor-pointer" 
                        onclick="$('#image_input').click()">
                        <img src="${url}" class="w-full h-full object-cover"/>
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="material-symbols-outlined text-white text-sm">cached</span>
                        </div>
                    </div>
                `);
            }
            this.value = ''; 
        });

        $('#btn_modal_add').on('click', function() {
            $('#modal_category').removeAttr('data-edit-id');
            $('#modal_category h2').text('Thêm danh mục mới');
            $('#name_input').val('');
            $('#image_preview').empty();
            selectedFile = null;
            $('#modal_category').removeClass('hidden');
        });

        $(document).on('click', '.btn-edit', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const image = $(this).data('image');

            $('#modal_category').attr('data-edit-id', id);
            $('#modal_category h2').text('Chỉnh sửa danh mục');
            $('#name_input').val(name);
            selectedFile = null;

            if (image) {
                const imageUrl = '/storage/' + image;
                $('#image_preview').html(`
                    <div class="relative w-24 h-24 rounded-lg overflow-hidden border border-border-color shrink-0 group cursor-pointer"
                        onclick="$('#image_input').click()">
                        <img src="${imageUrl}" class="w-full h-full object-cover"/>
                        <div class="absolute inset-0 bg-black/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="material-symbols-outlined text-white text-sm">edit</span>
                        </div>
                    </div>
                `);
            } else {
                $('#image_preview').empty();
            }

            $('#modal_category').removeClass('hidden');
        });

        $('#btn_save_category').on('click', function () {
            const name = $('#name_input').val().trim();
            const editId = $('#modal_category').attr('data-edit-id');

            if (!name) {
                Swal.fire('Thông báo', 'Vui lòng nhập tên danh mục!', 'warning');
                return;
            }

            const formData = new FormData();
            formData.append('name', name);
            if (selectedFile) {
                formData.append('image', selectedFile);
            }

            let url = '/api/category';
            if (editId) {
                url = `/api/category/${editId}`;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'Authorization': 'Bearer ' + getCookie('admin_token'),
                    'Accept': 'application/json'
                },
                beforeSend: function () { showLoader(); },
                success: function (res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: editId ? 'Cập nhật thành công!' : 'Thêm mới thành công!',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    $('#modal_category').addClass('hidden');
                    getAllCategory(currentPage);
                },
                error: function (err) {
                    let msg = err.responseJSON?.message || 'Có lỗi xảy ra!';
                    Swal.fire('Lỗi!', msg, 'error');
                },
                complete: function () { hideLoader(); }
            });
        });

        //delete
        $(document).on('click', '.btn-delete', function() {
            const id = $(this).data('id'); 
            const categoryName = $(this).data('name') || "danh mục này";

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
                        url: `/api/category/${id}`,
                        type: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + getCookie('admin_token'),
                            'Accept': 'application/json'
                        },
                        beforeSend: function () { 
                            showLoader(); 
                        },
                        success: function (res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Xoá danh mục thành công!',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            
                            getAllCategory(currentPage);
                        },
                        error: function (err) {
                            let msg = err.responseJSON?.message || 'Không thể xóa danh mục này!';
                            Swal.fire('Thất bại!', msg, 'error');
                        },
                        complete: function () { 
                            hideLoader(); 
                        }
                    });
                }
            });
        });
    });
</script>
@endsection