@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div class="flex flex-wrap gap-2 mb-8">
        <a class="text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary text-sm font-medium"
            href="/">Trang chủ</a>
        <span class="text-gray-500 dark:text-gray-400 text-sm font-medium">/</span>
        <span class="text-gray-900 dark:text-white text-sm font-medium">Sổ dịa chỉ</span>
    </div>
    <div class="flex flex-col md:flex-row gap-8 lg:gap-12">
        <!-- SideNavBar -->
        @include('layouts.Frontend.widget.__menu_profile')
        <!-- Main Content Area -->
        <div class="flex-1">
            <div class="layout-content-container flex flex-col w-full max-w-7xl flex-1 px-4 gap-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="flex min-w-72 flex-col">
                        <p class="text-[#0d1b12] dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">
                            Quản lý địa chỉ giao hàng</p>
                    </div>
                    <button id="btn_add_address"
                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-5 bg-primary text-[#0d1b12] dark:text-background-dark gap-2 text-sm font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined">add</span>
                        <span class="truncate">Thêm địa chỉ mới</span>
                    </button>
                </div>
                <div id="address_list" class="grid grid-cols-1 gap-6 mt-4">
                    <!-- <div class="@container">
                        <div
                            class="flex flex-col items-stretch justify-start rounded-xl border border-primary/20 dark:border-primary/10 bg-background-light dark:bg-background-dark shadow-sm">
                            <div class="flex w-full grow flex-col items-stretch justify-center gap-2 p-6">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-[#0d1b12] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">Nguyễn
                                        Văn A - 0987654321</p>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-flex items-center rounded-full bg-primary/20 dark:bg-primary/10 px-3 py-1 text-xs font-semibold text-[#0d1b12] dark:text-primary">Mặc
                                            định</span>
                                    </div>
                                </div>
                                <p class="text-[#4c9a66] dark:text-gray-400 text-base font-normal leading-normal">Số 123, Đường ABC,
                                    Phường XYZ, Quận 1, Thành phố Hồ Chí Minh</p>
                                <div class="flex items-center gap-4 mt-3">
                                    <button
                                        class="flex cursor-pointer items-center justify-center gap-2 text-[#0d1b12] dark:text-gray-300 hover:text-primary dark:hover:text-primary text-sm font-medium leading-normal">
                                        <span class="material-symbols-outlined text-base">edit</span>
                                        <span class="truncate">Chỉnh sửa</span>
                                    </button>
                                    <button
                                        class="flex cursor-pointer items-center justify-center gap-2 text-[#4c9a66] dark:text-gray-400 hover:text-red-500 dark:hover:text-red-500 text-sm font-medium leading-normal">
                                        <span class="material-symbols-outlined text-base">delete</span>
                                        <span class="truncate">Xóa</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="@container">
                        <div
                            class="flex flex-col items-stretch justify-start rounded-xl border border-primary/10 dark:border-primary/10 bg-background-light dark:bg-background-dark shadow-sm">
                            <div class="flex w-full grow flex-col items-stretch justify-center gap-2 p-6">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-[#0d1b12] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">Trần
                                        Thị B - 0123456789</p>
                                </div>
                                <p class="text-[#4c9a66] dark:text-gray-400 text-base font-normal leading-normal">Số 456, Đường DEF,
                                    Phường GHI, Quận Ba Đình, Hà Nội</p>
                                <div class="flex items-center gap-4 mt-3">
                                    <button
                                        class="flex cursor-pointer items-center justify-center gap-2 text-[#0d1b12] dark:text-gray-300 hover:text-primary dark:hover:text-primary text-sm font-medium leading-normal">
                                        <span class="material-symbols-outlined text-base">edit</span>
                                        <span class="truncate">Chỉnh sửa</span>
                                    </button>
                                    <button
                                        class="flex cursor-pointer items-center justify-center gap-2 text-[#4c9a66] dark:text-gray-400 hover:text-red-500 dark:hover:text-red-500 text-sm font-medium leading-normal">
                                        <span class="material-symbols-outlined text-base">delete</span>
                                        <span class="truncate">Xóa</span>
                                    </button>
                                    <div class="flex-grow"></div>
                                    <button
                                        class="flex cursor-pointer items-center justify-center gap-2 text-primary dark:text-primary/90 hover:opacity-80 text-sm font-medium leading-normal">
                                        <span class="truncate">Đặt làm mặc định</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <div id="modal_add_address" class="bg-background-light dark:bg-background-dark font-display antialiased text-slate-900 dark:text-white hidden">
        <div class="relative min-h-screen w-full flex flex-col items-center pt-20 overflow-hidden">
            <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
                <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
                <div
                    class="relative flex flex-col w-full max-w-[680px] max-h-[90vh] bg-white dark:bg-background-dark rounded-2xl shadow-2xl ring-1 ring-white/10 overflow-hidden animate-in zoom-in-95 duration-200 ease-out">
                    <div
                        class="flex items-center justify-between px-6 py-5 border-b border-border-light dark:border-border-dark">
                        <h3
                            class="text-xl font-bold leading-tight tracking-[-0.015em] text-text-main-light dark:text-text-main-dark">
                            Thêm địa chỉ giao hàng mới
                        </h3>
                        <button class="btn_close_modal_add_address group p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                            type="button">
                            <span
                                class="material-symbols-outlined text-gray-500 dark:text-gray-400 group-hover:text-gray-800 dark:group-hover:text-white">close</span>
                        </button>
                    </div>
                    <div class="flex-1 overflow-y-auto p-6 space-y-5">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1 flex flex-col gap-1.5">
                                <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_name">
                                    Tên người nhận <span class="text-red-500">*</span>
                                </label>
                                <input id="user_name" type="text" placeholder="Nhập tên"
                                    class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                            </div>
                            <div class="flex-1 flex flex-col gap-1.5">
                                <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_phone">
                                    Số điện thoại <span class="text-red-500">*</span>
                                </label>
                                <input id="user_phone" type="text" placeholder="Nhập SĐT"
                                    class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1 flex flex-col gap-1.5">
                                <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_province">
                                    Tỉnh/Thành phố <span class="text-red-500">*</span>
                                </label>
                                <input id="user_province" type="text" placeholder="Tỉnh/TP"
                                    class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                            </div>
                            <div class="flex-1 flex flex-col gap-1.5">
                                <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_district">
                                    Quận/Huyện <span class="text-red-500">*</span>
                                </label>
                                <input id="user_district" type="text" placeholder="Quận/Huyện"
                                    class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_ward">
                                Phường/Xã <span class="text-red-500">*</span>
                            </label>
                            <input id="user_ward" type="text" placeholder="Nhập tên phường/xã"
                                class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_address">
                                Số nhà/Đường <span class="text-red-500">*</span>
                            </label>
                            <input id="user_address" type="text" placeholder="Nhập số nhà, tên đường"
                                class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg border border-border-light dark:border-border-dark bg-gray-50/50 dark:bg-black/10">
                            <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">Đặt làm mặc định</span>
                            <label class="relative inline-flex cursor-pointer items-center">
                                <input id="is_default" type="checkbox" checked class="peer sr-only" />
                                <div class="peer h-6 w-11 rounded-full bg-gray-200 dark:bg-gray-600 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:bg-white after:transition-all peer-checked:bg-primary peer-checked:after:translate-x-[20px]"></div>
                            </label>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div
                        class="flex items-center justify-end gap-3 px-6 py-5 border-t border-border-light dark:border-border-dark bg-gray-50/50 dark:bg-black/20">
                        <button
                            class="btn_close_modal_add_address rounded-lg px-5 py-2.5 text-sm font-bold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/10 hover:text-gray-800 dark:hover:text-white transition-all"
                            type="button">
                            Hủy bỏ
                        </button>
                        <button id="btn_save_address"
                            class="flex items-center gap-2 rounded-lg bg-primary px-6 py-2.5 text-sm font-bold text-[#0d1b12] shadow-sm hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all"
                            type="button">
                            <span class="material-symbols-outlined text-[18px]">save</span>
                            Lưu địa chỉ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_edit_address" class="bg-background-light dark:bg-background-dark font-display antialiased text-slate-900 dark:text-white hidden">
        <div class="relative min-h-screen w-full flex flex-col items-center pt-20 overflow-hidden">
            <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
                <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
                <div
                    class="relative flex flex-col w-full max-w-[680px] max-h-[90vh] bg-white dark:bg-background-dark rounded-2xl shadow-2xl ring-1 ring-white/10 overflow-hidden animate-in zoom-in-95 duration-200 ease-out">
                    <div
                        class="flex items-center justify-between px-6 py-5 border-b border-border-light dark:border-border-dark">
                        <h3
                            class="text-xl font-bold leading-tight tracking-[-0.015em] text-text-main-light dark:text-text-main-dark">
                            Chỉnh sửa địa chỉ giao hàng
                        </h3>
                        <button class="btn_close_modal_add_address group p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                            type="button">
                            <span
                                class="material-symbols-outlined text-gray-500 dark:text-gray-400 group-hover:text-gray-800 dark:group-hover:text-white">close</span>
                        </button>
                    </div>
                    <div class="flex-1 overflow-y-auto p-6 space-y-5">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1 flex flex-col gap-1.5">
                                <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_name">
                                    Tên người nhận <span class="text-red-500">*</span>
                                </label>
                                <input id="user_name_edit" type="text" placeholder="Nhập tên"
                                    class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                            </div>
                            <div class="flex-1 flex flex-col gap-1.5">
                                <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_phone">
                                    Số điện thoại <span class="text-red-500">*</span>
                                </label>
                                <input id="user_phone_edit" type="text" placeholder="Nhập SĐT"
                                    class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1 flex flex-col gap-1.5">
                                <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_province">
                                    Tỉnh/Thành phố <span class="text-red-500">*</span>
                                </label>
                                <input id="user_province_edit" type="text" placeholder="Tỉnh/TP"
                                    class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                            </div>
                            <div class="flex-1 flex flex-col gap-1.5">
                                <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_district">
                                    Quận/Huyện <span class="text-red-500">*</span>
                                </label>
                                <input id="user_district_edit" type="text" placeholder="Quận/Huyện"
                                    class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_ward">
                                Phường/Xã <span class="text-red-500">*</span>
                            </label>
                            <input id="user_ward_edit" type="text" placeholder="Nhập tên phường/xã"
                                class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-text-main-light dark:text-text-main-dark" for="user_address">
                                Số nhà/Đường <span class="text-red-500">*</span>
                            </label>
                            <input id="user_address_edit" type="text" placeholder="Nhập số nhà, tên đường"
                                class="form-input w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-black/20 px-4 h-11 text-sm focus:border-primary focus:outline-none transition-all" />
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg border border-border-light dark:border-border-dark bg-gray-50/50 dark:bg-black/10">
                            <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">Đặt làm mặc định</span>
                            <label class="relative inline-flex cursor-pointer items-center">
                                <input id="is_default_edit" type="checkbox" checked class="peer sr-only" />
                                <div class="peer h-6 w-11 rounded-full bg-gray-200 dark:bg-gray-600 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:bg-white after:transition-all peer-checked:bg-primary peer-checked:after:translate-x-[20px]"></div>
                            </label>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div
                        class="flex items-center justify-end gap-3 px-6 py-5 border-t border-border-light dark:border-border-dark bg-gray-50/50 dark:bg-black/20">
                        <button
                            class="btn_close_modal_add_address rounded-lg px-5 py-2.5 text-sm font-bold text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/10 hover:text-gray-800 dark:hover:text-white transition-all"
                            type="button">
                            Hủy bỏ
                        </button>
                        <button id="btn_update_address"
                            class="flex items-center gap-2 rounded-lg bg-primary px-6 py-2.5 text-sm font-bold text-[#0d1b12] shadow-sm hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all"
                            type="button">
                            <span class="material-symbols-outlined text-[18px]">save</span>
                            Lưu địa chỉ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn_add_address').on('click', function() {
        $('#modal_add_address').show();
    });

    $('.btn_close_modal_add_address').on('click', function() {
        $('#modal_add_address').hide();
        $('#modal_edit_address').hide();
    });

    function getAllAddress() {
        const userId = sessionStorage.getItem('id');
        $.ajax({
            url: '/api/address/',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getCookie('user_token')
            },
            data: { user_id: userId, per_page: 1000 },
            beforeSend: function () {
                showLoader();
            },
            success: function (response) {
                let html = '';
                let addresses = response.data.data;

                if (addresses.length === 0) {
                    html = `
                        <p class="text-center text-gray-400">Bạn chưa có địa chỉ nào</p>
                    `;
                } else {
                    addresses.forEach(addr => {
                        html += `
                        <div class="@container">
                            <div class="flex flex-col rounded-xl border ${addr.is_default == 1 ? 'border-primary/20' : 'border-primary/10'} 
                                        bg-background-light dark:bg-background-dark shadow-sm">
                                <div class="flex flex-col gap-2 p-6">
                                    <div class="flex items-center justify-between">
                                        <p class="text-lg font-bold dark:text-white">
                                            ${addr.user_name} - ${addr.user_phone}
                                        </p>

                                        ${addr.is_default == 1 ? `
                                            <span class="inline-flex items-center rounded-full bg-primary/20 px-3 py-1 text-xs font-semibold">
                                                Mặc định
                                            </span>` : ''}
                                    </div>

                                    <p class="text-[#4c9a66] dark:text-gray-400 text-base font-normal leading-normal">
                                        ${addr.address_line}, ${addr.ward}, ${addr.district}, ${addr.province}
                                    </p>

                                    <div class="flex items-center gap-4 mt-3">
                                        <button data-id="${addr.id}"
                                            class="btn-edit-address flex items-center gap-2 hover:text-primary text-sm font-medium">
                                            <span class="material-symbols-outlined">edit</span>
                                            Chỉnh sửa
                                        </button>

                                        <button data-id="${addr.id}"
                                            class="btn-delete-address flex items-center gap-2 hover:text-red-500 text-sm font-medium">
                                            <span class="material-symbols-outlined">delete</span>
                                            Xóa
                                        </button>

                                        ${addr.is_default == 0 
                                            ? `
                                                <div class="flex-grow"></div>
                                                <button onclick="setDefaultAddress(${addr.id})"
                                                    class="text-primary hover:opacity-80 text-sm font-medium">
                                                    Đặt làm mặc định
                                                </button>` 
                                            : ''
                                        }
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                    });
                }

                $('#address_list').html(html);
            },
            error: function(error) {
                Swal.fire('Lỗi', 'Không thể tải danh sách đơn hàng', 'error');
            },
            complete: function () {
                hideLoader();
            }
        });
    }

    $(document).ready(function() {
        getAllAddress();
    });

    $('#btn_save_address').on('click', function() {
        const data = {
            user_name: $('#user_name').val().trim(),
            user_phone: $('#user_phone').val().trim(),
            province: $('#user_province').val().trim(),
            district: $('#user_district').val().trim(),
            ward: $('#user_ward').val().trim(),
            address_line: $('#user_address').val().trim(),
            is_default: $('#is_default').is(':checked') ? 1 : 0,
        };

        $.ajax({
            url: '/api/address',
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + getCookie('user_token'),
                'Content-Type': 'application/json'
            },
            data: JSON.stringify(data),
            beforeSend: function() {
                showLoader();
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Thêm địa chỉ mới thành công',
                    timer: 1500,
                    showConfirmButton: false
                });

                $('#modal_add_address').hide();
                resetAddressForm(); 
                
                getAllAddress();
            },
            error: function(xhr) {
                const errorMsg = xhr.responseJSON?.message || 'Không thể thêm địa chỉ. Vui lòng thử lại!';
                Swal.fire('Lỗi', errorMsg, 'error');
            },
            complete: function() {
                hideLoader();
            }
        });
    });

    function resetAddressForm() {
        $('#user_name, #user_phone, #user_province, #user_district, #user_ward, #user_address').val('');
        $('#is_default').prop('checked', false);
        $('#user_name_edit, #user_phone_edit, #user_province_edit, #user_district_edit, #user_ward_edit, #user_address_edit').val('');
        $('#is_default_edit').prop('checked', false);
    }

    $(document).on('click', '.btn-edit-address', function() {
        const addressId = $(this).data('id');
        $.ajax({
            url: '/api/address/' + addressId,
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getCookie('user_token')
            },
            success: function (response) {
                let addresses = response.data;
                $('#user_name_edit').val(addresses.user_name);
                $('#user_phone_edit').val(addresses.user_phone);
                $('#user_province_edit').val(addresses.province);
                $('#user_district_edit').val(addresses.district);
                $('#user_ward_edit').val(addresses.ward);
                $('#user_address_edit').val(addresses.address_line);
                $('#is_default_edit').prop('checked', addresses.is_default == 1);
                $('#modal_edit_address').show();
                $('#btn_update_address').on('click', function() {
                    updateAddress(addressId);
                });
            },
            error: function(error) {
                Swal.fire('Lỗi', 'Không thể tải danh sách đơn hàng', 'error');
            },
        });
    });

    function updateAddress(addressId) {
        const data = {
            user_name: $('#user_name_edit').val().trim(),
            user_phone: $('#user_phone_edit').val().trim(),
            province: $('#user_province_edit').val().trim(),
            district: $('#user_district_edit').val().trim(),
            ward: $('#user_ward_edit').val().trim(),
            address_line: $('#user_address_edit').val().trim(),
            is_default: $('#is_default_edit').is(':checked') ? 1 : 0,
        };

        $.ajax({
            url: '/api/address/' + addressId,
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + getCookie('user_token'),
                'Content-Type': 'application/json'
            },
            data: JSON.stringify(data),
            beforeSend: function() {
                showLoader();
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Cập nhật địa chỉ thành công',
                    timer: 1500,
                    showConfirmButton: false
                });

                $('#modal_edit_address').hide();
                resetAddressForm(); 
                
                getAllAddress();
            },
            error: function(xhr) {
                const errorMsg = xhr.responseJSON?.message || 'Không thể thêm địa chỉ. Vui lòng thử lại!';
                Swal.fire('Lỗi', errorMsg, 'error');
            },
            complete: function() {
                hideLoader();
            }
        });
    };

    $(document).on('click', '.btn-delete-address', function() {
        const addressId = $(this).data('id');

        Swal.fire({
            title: 'Bạn chắc chắn muốn xóa địa chỉ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/address/' + addressId,
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + getCookie('user_token')
                    },
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Xóa địa chỉ thành công',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        getAllAddress();
                    },
                    error: function(xhr) {
                        const errorMsg = xhr.responseJSON?.message || 'Không thể xóa địa chỉ. Vui lòng thử lại!';
                        Swal.fire('Lỗi', errorMsg, 'error');
                    },
                    complete: function() {
                        hideLoader();
                    }
                });
            }
        });
    });
</script>
@endsection