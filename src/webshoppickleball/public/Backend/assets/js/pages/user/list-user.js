let currentPage = 1;
let pageSize = parseInt($('#page-size-selector').val());
let currentFilters = {};

function formatDate(isoString) {
    if (!isoString) return '';
    const date = new Date(isoString);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = String(date.getFullYear()).slice(-2);
    return `${day}/${month}/${year}`;
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';')[0];
    return null;
}


function loadUsers(filters = {}) {
    Swal.fire({
        title: 'Đang xử lý...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        onOpen: () => Swal.showLoading()
    });

    currentFilters = {...filters};

    const queryData = {...currentFilters, per_page: pageSize, page: currentPage};

    $.ajax({
        url: '/api/list-user',
        method: 'GET',
        contentType: 'application/json',
        headers: {
            'Authorization': 'Bearer ' + getCookie('admin_token')
        },
        data: queryData,
        success: function(res) {
            Swal.close();

            const tbody = $('#kt_datatable1_body');
            tbody.empty();

            res.data.data.forEach(user => {
                const createdAt = formatDate(user.created_at);
                const updatedAt = formatDate(user.updated_at);

                const lockBtn = user.is_active == 1
                    ? `<button class="btn btn-danger btn-sm btn-lock" data-id="${user.id}" data-status="1">
                            <i class="fa fa-lock p-0"></i>
                       </button>`
                    : `<button class="btn btn-success btn-sm btn-lock" data-id="${user.id}" data-status="0">
                            <i class="fa fa-unlock p-0"></i>
                       </button>`;

                tbody.append(`
                    <tr>
                        <td>${user.id}</td>
                        <td>
                            <img src="${user.avatar ? '/storage/' + user.avatar : '/img/user-default.png'}" style="width:80px;height:80px;border-radius:16px;">
                        </td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.phone}</td>
                        <td>${user.status == 1 ? '<span class="label label-success" style="width:100px;height:24px;border-radius:6px">Hoạt động</span>' : '<span class="label label-danger" style="width:100px;height:24px;border-radius:6px">Chưa kích hoạt</span>'}</td>
                        <td>${createdAt}</td>
                        <td>${updatedAt}</td>
                        <td style="text-align:center;">
                            ${lockBtn}
                        </td>
                    </tr>
                `);
            });

            // cập nhật phân trang
            $('#current-page').text(res.data.current_page);
            $('#total-pages').text(res.data.last_page);

            const start = res.data.from ?? 0;
            const end = res.data.to ?? 0;
            const total = res.data.total ?? 0;

            $('#pagination-text').text(`Hiển thị ${start}-${end} của ${total} bản ghi`);
            $('#prev-page').prop('disabled', res.data.prev_page_url === null);
            $('#next-page').prop('disabled', res.data.next_page_url === null);

            // Cập nhật currentPage
            currentPage = res.data.current_page;
        },
        error: function(err) {
            Swal.close();
            console.error('Không thể tải danh sách user:', err);
        }
    });
}

$('#prev-page').click(function() {
    if (currentPage > 1) loadUsers(currentFilters);
});

$('#next-page').click(function() {
    loadUsers(currentFilters);
});

$('#page-size-selector').change(function() {
    pageSize = parseInt($(this).val());
    currentPage = 1;
    loadUsers(currentFilters);
});

// function addUser() {
//     const data = {
//         username: $('#username').val(),
//         email: $('#email').val(),
//         password: $('#password').val(),
//         address_name: $('#address_name').val()
//     };
//     Swal.fire({
//         title: 'Đang xử lý...',
//         allowOutsideClick: false,
//         allowEscapeKey: false,
//         showConfirmButton: false,
//         onOpen: () => {
//             swal.showLoading();
//         }
//     });

//     $.ajax({
//         url: '/api/user/create',
//         type: 'POST',
//         data: data,
//         headers: {
//             'Authorization': sessionStorage.getItem('token')
//         },
//         success: function(res) {
//             Swal.close();
//             Swal.fire({
//                 icon: 'success',
//                 title: 'Thành công!',
//                 text: res.message,
//                 timer: 2000,
//                 showConfirmButton: false
//             });
//             $('#exampleModalCenter').modal('hide');
//             loadUsers();
//         },
//         error: function(err) {
//             Swal.close();
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Thất bại!',
//                 text: err.responseJSON?.message || 'Không thể thêm user. Vui lòng thử lại!',
//                 confirmButtonText: 'Đóng'
//             });
//             console.error('Không thể thêm user:', err);
//         }
//     });
// }

$(document).ready(function() {
    loadUsers({});

    // $('.btn-add-user').on('click', function() {
    //     const htmlAdd = `
    //         <div class="modal-header">
    //             <h5 class="modal-title">Thêm người dùng</h5>
    //             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    //                 <i aria-hidden="true" class="ki ki-close"></i>
    //             </button>
    //         </div>
    //         <div class="modal-body">
    //             <form id="userForm">
    //                 <div class="form-group">
    //                     <label>Username:</label>
    //                     <input id="username" type="text" name="username" class="form-control" placeholder="Nhập username" required>
    //                 </div>
    //                 <div class="form-group">
    //                     <label>Email:</label>
    //                     <input id="email" type="email" name="email" class="form-control" placeholder="Nhập email" required>
    //                 </div>
    //                 <div class="form-group">
    //                     <label>Password:</label>
    //                     <input id="password" type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
    //                 </div>
    //                 <div class="form-group">
    //                     <label>Địa chỉ:</label>
    //                     <input id="address_name" type="text" name="address_name" class="form-control" placeholder="Nhập địa chỉ">
    //                 </div>
    //             </form>
    //         </div>
    //         <div class="modal-footer">
    //             <button type="button" class="btn btn-light-primary" data-dismiss="modal">Huỷ</button>
    //             <button id="btn_save_add" type="button" class="btn btn-primary btn-save-add">Thêm</button>
    //         </div>
    //     `;
    //     $('#modalContent').html(htmlAdd);
    //     $('#exampleModalCenter').modal('show');
    // });

    // $(document).on('click', '.btn-edit-user', function() {
    //     const userId = $(this).data('id');
    //     $.ajax({
    //         url: '/api/user/detail/' + userId,
    //         type: 'GET',
    //         headers: {
    //             'Authorization': sessionStorage.getItem('token')
    //         },
    //         success: function(res) {
    //             const htmlEdit = `
    //                 <div class="modal-header">
    //                     <h5 class="modal-title">Chỉnh sửa thông tin người dùng</h5>
    //                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    //                         <i aria-hidden="true" class="ki ki-close"></i>
    //                     </button>
    //                 </div>
    //                 <div class="modal-body">
    //                     <form id="userForm">
    //                         <div class="form-group text-center">
    //                             <label>Ảnh đại diện:</label>
    //                             <div class="mb-3">
    //                                 ${
    //                                     res.data.avatar
    //                                         ? `<img style="width:120px;height:120px;object-fit:cover;" src="${res.data.avatar}" alt="">`
    //                                         : `<img style="width:120px;height:120px;object-fit:cover;" src="/img/user-default.png" alt="">`
    //                                 }
    //                             </div>
    //                             <div class="d-flex justify-content-center">
    //                                 <input id="avatar_edit" type="file" name="avatar" accept="image/*" class="form-control-file">
    //                             </div>
    //                         </div>
    //                         <div class="form-group">
    //                             <label>Username:</label>
    //                             <input value="${res.data.username}" id="username_edit" type="text" name="username" class="form-control" placeholder="Nhập username" required>
    //                         </div>
    //                         <div class="form-group">
    //                             <label>Email:</label>
    //                             <input value="${res.data.email}" id="email_edit" type="email" name="email" class="form-control" placeholder="Nhập email" required readonly>
    //                         </div>
    //                         <div class="form-group">
    //                             <label>Địa chỉ:</label>
    //                             <input value="${res.data.address_name}" id="address_name_edit" type="text" name="address_name" class="form-control" placeholder="Nhập địa chỉ">
    //                         </div>
    //                         <div class="form-group">
    //                             <label>Trạng thái:</label>
    //                             <select id="status_edit" name="status" class="form-control">
    //                                 <option value="1" ${res.data.is_active == 1 ? 'selected' : ''}>Hoạt động</option>
    //                                 <option value="0" ${res.data.is_active == 0 ? 'selected' : ''}>Đã khoá</option>
    //                             </select>
    //                         </div>
    //                     </form>
    //                 </div>
    //                 <div class="modal-footer">
    //                     <button type="button" class="btn btn-light-primary" data-dismiss="modal">Huỷ</button>
    //                     <button id="btn_save_edit" type="button" class="btn btn-primary btn-save-add">Lưu</button>
    //                 </div>
    //             `;
    //             $('#modalContent').html(htmlEdit);
    //             $('#exampleModalCenter').modal('show');

    //             $('#avatar_edit').on('change', function(e) {
    //                 const file = e.target.files[0];
    //                 if (file) {
    //                     const reader = new FileReader();
    //                     reader.onload = function(e) {
    //                         $('#preview_image').attr('src', e.target.result);
    //                     };
    //                     reader.readAsDataURL(file);
    //                 }
    //             });

    //             $(document).off('click', '#btn_save_edit').on('click', '#btn_save_edit', async  function() {
    //                 let avatarUrl = res.data.avatar;
    //                 const file = $('#avatar_edit')[0].files[0];
    //                 try {
    //                     Swal.fire({
    //                         title: 'Đang xử lý...',
    //                         allowOutsideClick: false,
    //                         allowEscapeKey: false,
    //                         showConfirmButton: false,
    //                         onOpen: () => {
    //                             swal.showLoading();
    //                         }
    //                     });
    //                     // Nếu có ảnh mới thì upload trước
    //                     if (file) {
    //                         const formData = new FormData();
    //                         formData.append('avatar', file);

    //                         const uploadRes = await $.ajax({
    //                             url: '/api/user/upload-avatar/' + userId,
    //                             type: 'PUT',
    //                             data: formData,
    //                             headers: {
    //                                 'Authorization': sessionStorage.getItem('token')
    //                             },
    //                             processData: false,
    //                             contentType: false
    //                         });

    //                         avatarUrl = uploadRes.data?.avatar_url || avatarUrl;
    //                     }

    //                     // Sau khi có link ảnh thì gọi update thông tin
    //                     const dataEdit = {
    //                         userId: userId,
    //                         username: $('#username_edit').val(),
    //                         email: $('#email_edit').val(),
    //                         address: $('#address_name_edit').val(),
    //                         isActive: $('#status_edit').val(),
    //                         avatar_url: avatarUrl
    //                     };

    //                     const updateRes = await $.ajax({
    //                         url: '/api/user/update-user',
    //                         type: 'PUT',
    //                         data: dataEdit,
    //                         headers: {
    //                             'Authorization': sessionStorage.getItem('token')
    //                         }
    //                     });
    //                     Swal.close();
    //                     Swal.fire({
    //                         icon: 'success',
    //                         title: updateRes.message || 'Cập nhật thành công!',
    //                         showConfirmButton: false,
    //                         timer: 2000
    //                     });

    //                     $('#exampleModalCenter').modal('hide');
    //                     loadUsers(currentPage, pageSize, searchText);

    //                 } catch (err) {
    //                     Swal.close();
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Lỗi!',
    //                         text: err.responseJSON?.message || 'Không thể cập nhật user.',
    //                         confirmButtonText: 'Đóng'
    //                     });
    //                     console.error('Lỗi khi cập nhật user:', err);
    //                 }
    //             });
    //         },
    //         error: function(err) {
    //             console.error('Không thể thêm user:', err);
    //         }
    //     });
    // });

    // $(document).on('click', '.btn-lock', function() {
    //     const userId = $(this).data('id');
    //     const status = $(this).data('status');
    //     const titleText = status == 1 ? 'Xác nhận khóa tài khoản?' : 'Xác nhận mở khóa tài khoản?';
    //     Swal.fire({
    //         title: titleText,
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Đồng ý',
    //         cancelButtonText: 'Hủy bỏ',
    //         reverseButtons: true
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: '/api/user/detail/' + userId,
    //                 type: 'GET',
    //                 headers: {
    //                     'Authorization': sessionStorage.getItem('token')
    //                 },
    //                 success: function(res) {
    //                     const data = {
    //                         userId: userId,
    //                         username: res.data.username,
    //                         isActive: res.data.is_active === 0 ? 1 : 0
    //                     };

    //                     $.ajax({
    //                         url: '/api/user/update-user',
    //                         type: 'PUT',
    //                         headers: {
    //                             'Authorization': sessionStorage.getItem('token')
    //                         },
    //                         data: data,
    //                         success: function(res) {
    //                             const message =res.data.is_active == 1
    //                                     ? 'Mở khóa tài khoản thành công!'
    //                                     : 'Khóa tài khoản thành công!';
    //                             Swal.fire({
    //                                 icon: 'success',
    //                                 title: message,
    //                                 showConfirmButton: false,
    //                                 timer: 1500
    //                             });
    //                             loadUsers(currentPage, pageSize, searchText);
    //                         },
    //                         error: function(err) {
    //                             Swal.fire({
    //                                 icon: 'error',
    //                                 title: 'Lỗi!',
    //                                 text: 'Không thể thay đổi trạng thái người dùng.',
    //                             });
    //                             console.error('Không thể khóa user:', err);
    //                         }
    //                     });
    //                 },
    //                 error: function(err) {
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Lỗi!',
    //                         text: 'Không thể lấy thông tin người dùng.',
    //                     });
    //                     console.error('Không thể lấy thông tin user:', err);
    //                 }
    //             });
    //         }
    //     });
    // });

    // $(document).on('click', '#btn_save_add', function() {
    //     addUser();
    // });

    // $(document).on('click', '#kt_search_4', function(e) {
    //     e.preventDefault();

    //     const searchText = $('#input_search').val().trim();
    //     currentPage = 1;

    //     loadUsers({
    //         search: searchText
    //     });
    // });

    // $(document).on('click', '#kt_reset_4', function(e) {
    //     e.preventDefault();

    //     $('#input_search').val('');
    //     currentPage = 1; // reset về trang 1

    //     // Gọi loadUsers với filter rỗng để reset
    //     loadUsers({});
    // });

});


