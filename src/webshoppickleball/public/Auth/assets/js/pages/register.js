function register() {

    const data = {
        name: $('#name').val(),
        phone: $('#phone').val(),
        email: $('#email').val(),
        password: $('#password').val(),
        password_confirmation: $('#confirmPassword').val(),
    };

    Swal.fire({
        title: 'Đang xử lý...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        onOpen: () => {
            swal.showLoading();
        }
    });

    $.ajax({
        url: "/api/register",
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            sessionStorage.setItem('email', email.value);
            Swal.close();
            Swal.fire({
                icon: "success",
                title: "Đăng ký thành công!",
                text: "Vui lòng kiểm tra email để xác minh tài khoản.",
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
            }).then(() => {
                window.location.href = "/verify-otp";
            });
        },
        error: function (xhr, status, error) {
            Swal.close();
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                $.each(errors, function (key, messages) {
                    if (key === "password" && messages[0].includes("Mật khẩu xác nhận không khớp")) {
                        $("#password_confirmation-error").text(messages[0]);
                    } else {
                        $(`#${key}-error`).text(messages[0]);
                    }
                });
            }
        }
    });
}

$(document).on('click', '#register-btn', function (event) {
    event.preventDefault();
    $('.error').text('');
    register();
});