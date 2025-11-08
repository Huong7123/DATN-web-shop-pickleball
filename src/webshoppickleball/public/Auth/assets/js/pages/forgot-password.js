function forgotPassword() {

    const data = {
        email: $('#email').val(),
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
        url: "/api/forgot-password",
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            Swal.close();
            Swal.fire({
                icon: "success",
                title: "Gửi OTP thành công!",
                text: "Chúng tôi đã gửi lại mã OTP về email của bạn.",
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
            }).then(() => {
                window.location.href = "/reset-password";
            });
        },
        error: function (xhr, status, error) {
            Swal.close();
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                $.each(errors, function (key, messages) {
                    $(`#${key}-error`).text(messages[0]);
                });
            }
        }
    });
}

$(document).on('click', '#forgot-btn', function (event) {
    event.preventDefault();
    $('.error').text('');
    forgotPassword();
});