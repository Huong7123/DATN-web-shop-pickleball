function resetPassword() {

    const data = {
        email: sessionStorage.getItem('email'),
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
        url: "/api/reset-password",
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            Swal.close();
            Swal.fire({
                icon: "success",
                title: "Đặt lại mật khẩu thành công!",
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                willClose: () => {
                    window.location.href = "/login";
                }
            });
        },
        error: function (xhr, status, error) {
            Swal.close();
            if (xhr.status === 422) {
                console.log(xhr.responseJSON);
                const errors = xhr.responseJSON.errors;
                $.each(errors, function (key, messages) {
                    $(`#${key}-error`).text(messages[0]);
                });
            }
            console.log(xhr.responseText);
        }
    });
}

$(document).on('click', '#reset-btn', function (event) {
    event.preventDefault();
    $('.error').text('');
    resetPassword();
});