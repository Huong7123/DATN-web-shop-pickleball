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


function loadDiscounts(filters = {}) {
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
        url: '/api/list-discount',
        method: 'GET',
        contentType: 'application/json',
        headers: {
            'Authorization': 'Bearer ' + getCookie('admin_token')
        },
        data: queryData,
        success: function(res) {
            Swal.close();

            if (!res.data.data || res.data.data.length === 0) {
                const tbody = $('#kt_datatable1_body');
                tbody.html(`
                    <tr>
                        <td colspan="9" class="text-center">Không có dữ liệu</td>
                    </tr>
                `);
                return;
            }
            const tbody = $('#kt_datatable1_body');
            tbody.empty();

            res.data.data.forEach(discount => {
                const createdAt = formatDate(discount.created_at);
                const updatedAt = formatDate(discount.updated_at);

                const lockBtn = discount.status == 1
                    ? `<button class="btn btn-danger btn-sm btn-lock" data-id="${discount.id}" data-status="0">
                            <i class="fa fa-lock p-0"></i>
                       </button>`
                    : `<button class="btn btn-success btn-sm btn-lock" data-id="${discount.id}" data-status="1">
                            <i class="fa fa-unlock p-0"></i>
                       </button>`;

                tbody.append(`
                    <tr>
                        <td>${discount.id}</td>
                        <td>
                            <img src="${discount.image ? '/storage/' + discount.image : '/img/user-default.png'}" style="width:80px;height:80px;border-radius:16px;">
                        </td>
                        <td>${discount.title}</td>
                        <td>${discount.description}</td>
                        <td>${discount.code}</td>
                        <td>${discount.percent_off}%</td>
                        <td>${formatDate(discount.start_date)}</td>
                        <td>${formatDate(discount.end_date)}</td>
                        <td>${discount.status == 1 ? '<span class="label label-success" style="width:100px;height:24px;border-radius:6px">Hoạt động</span>' : '<span class="label label-danger" style="width:100px;height:24px;border-radius:6px">Chưa kích hoạt</span>'}</td>
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
    if (currentPage > 1) loadDiscounts(currentFilters);
});

$('#next-page').click(function() {
    loadDiscounts(currentFilters);
});

$('#page-size-selector').change(function() {
    pageSize = parseInt($(this).val());
    currentPage = 1;
    loadDiscounts(currentFilters);
});

$(document).ready(function() {
    loadDiscounts();

    // $(document).on('click', '.btn-lock', function() {
    //     const userId = $(this).data('id');
    //     const status = $(this).data('status');
    //     const titleText = status == 0 ? 'Xác nhận khóa tài khoản?' : 'Xác nhận mở khóa tài khoản?';
        
    //     Swal.fire({
    //         title: titleText,
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Đồng ý',
    //         cancelButtonText: 'Hủy bỏ',
    //         reverseButtons: true
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             const data = {
    //                 status:  status,
    //                 role: 1
    //             };

    //             $.ajax({
    //                 url: '/api/update-user/' + userId,
    //                 type: 'POST',
    //                 headers: {
    //                     'Authorization': 'Bearer ' + getCookie('admin_token')
    //                 },
    //                 data: data,
    //                 success: function(res) {
    //                     const message =res.data.status == 1
    //                             ? 'Mở khóa tài khoản thành công!'
    //                             : 'Khóa tài khoản thành công!';
    //                     Swal.fire({
    //                         icon: 'success',
    //                         title: message,
    //                         showConfirmButton: false,
    //                         timer: 1500
    //                     });
    //                     loadUsers({role: 1});
    //                 },
    //                 error: function(err) {
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Lỗi!',
    //                         text: 'Không thể thay đổi trạng thái người dùng.',
    //                     });
    //                     console.error('Không thể khóa user:', err);
    //                 }
    //             });
    //         }
    //     });
    // });

    $(document).on('click', '#kt_search_4', function(e) {
        e.preventDefault();

        const searchName = $('#input_name').val().trim();

        loadDiscounts({
            name: searchName,
        });
    });

    $(document).on('click', '#kt_reset_4', function(e) {
        e.preventDefault();

        $('#input_name').val('');
        loadDiscounts();
    });

});


