// Hàm giải mã JWT (không verify, chỉ decode payload)
function parseJwt(token) {
    try {
        const base64Url = token.split('.')[1];
        const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        const jsonPayload = decodeURIComponent(atob(base64).split('').map(c => {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
        return JSON.parse(jsonPayload);
    } catch (e) {
        return null;
    }
}

// Lấy cookie
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';')[0];
    return null;
}

// Lưu cookie
function setCookie(name, value, expiresInSeconds) {
    const d = new Date();
    d.setTime(d.getTime() + (expiresInSeconds * 1000));
    document.cookie = `${name}=${value};expires=${d.toUTCString()};path=/`;
}

// Refresh token
function refreshToken() {
    const token = getCookie('admin_token');
    if (!token) return;

    $.ajax({
        url: '/refresh',
        type: 'POST',
        headers: { 'Authorization': 'Bearer ' + token },
        success: function(res) {
            if (res.data && res.data.token) {
                // Lưu token mới và setup refresh tiếp theo
                const newToken = res.data.token;
                setCookie('admin_token', newToken, 3600); // ví dụ 1 giờ
                scheduleRefresh(newToken);
            }
        },
        error: function(err) {
            console.error('Không thể refresh token:', err);
        }
    });
}

// Lên lịch refresh token trước X phút
function scheduleRefresh(token, minutesBefore = 5) {
    const payload = parseJwt(token);
    if (!payload || !payload.exp) return;

    const now = Math.floor(Date.now() / 1000);
    const expireAt = payload.exp;
    const refreshAt = expireAt - (minutesBefore * 60); // refresh trước X phút
    const delay = Math.max((refreshAt - now) * 1000, 0); // ms

    setTimeout(() => {
        refreshToken();
    }, delay);
}

// Khi load page
$(document).ready(function() {
    const token = getCookie('admin_token');
    if (token) {
        scheduleRefresh(token, 5); // refresh trước 5 phút
    }
});
