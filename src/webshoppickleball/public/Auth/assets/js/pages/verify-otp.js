
function active() {

    const data = {
        email: sessionStorage.getItem('email'),
        otp_code: $('#otp').val(),
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
        url: "/api/active",
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            Swal.close();
            Swal.fire({
                icon: "success",
                title: "Xác thực tài khoản thành công!",
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
            }).then(() => {
                window.location.href = "/login";
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

$(document).on('click', '#confirm-btn', function (event) {
    event.preventDefault();
    $('.error').text('');
    active();
});
