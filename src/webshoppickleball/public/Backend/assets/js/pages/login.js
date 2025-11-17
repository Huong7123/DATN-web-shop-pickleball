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
        onOpen: () => {
            swal.showLoading();
        }
    });
    $.ajax({
        url: "/api/login",
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        xhrFields: { withCredentials: true },
        success: function (response) {
            console.log(response.data.user.role);
            
            if(response.data.user.role === "1"){
                Swal.close();
                Swal.fire({
                    icon: 'warning',
                    title: 'Không có quyền',
                    text: 'Bạn không được phép truy cập trang này!',
                    showConfirmButton: false,
                    timer: 2000 
                })
            } else{
                Swal.close();
                setTimeout(() => {
                    window.location.href = "/admin/user";
                }, 200);
            }
            
        },
        error: function (xhr, status, error) {
            Swal.close();
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                $.each(errors, function (key, messages) {
                    $(`#${key}-error`).text(messages[0]);
                });
            }
            if (xhr.status === 400) {
                
                alert(xhr.responseJSON.message);
            }
        }
    });
}

$(document).on('click', '#btn_login', function (event) {
    event.preventDefault();
    $('.error').text('');
    login();
});