function login() {
    const data = {
        email: $('#username').val(),
        password: $('#password').val(),
    };

    Swal.fire({
        title: 'Đang xử lý...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => Swal.showLoading()
    });

    $.ajax({
        url: "/api/login",
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        xhrFields: { withCredentials: true }, // bắt buộc để cookie httpOnly được gửi

        success: function (response) {
            console.log(response);
            
            Swal.close();

            if (!response.data || !response.data.user) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Không nhận được dữ liệu người dùng!',
                });
                return;
            }

            const userRole = response.data.user.role;
            console.log(userRole);
            

            if (userRole == 2) {
                document.cookie = `admin_token=${response.data.access_token}; path=/; max-age=3600;`;
                setTimeout(() => {
                    window.location.href = "/admin/user";
                }, 50);
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Không có quyền',
                    text: 'Bạn không được phép truy cập trang này!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        },

        error: function (xhr) {
            Swal.close();

            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                $.each(errors, function (key, messages) {
                    $(`#${key}-error`).text(messages[0]);
                });
            } else if (xhr.status === 400 || xhr.status === 401) {
                alert(xhr.responseJSON.message || 'Đăng nhập thất bại!');
            } else {
                alert('Có lỗi xảy ra. Vui lòng thử lại.');
            }
        }
    });
}

$(document).on('click', '#btn_login', function (event) {
    event.preventDefault();
    $('.error').text('');
    login();
});
