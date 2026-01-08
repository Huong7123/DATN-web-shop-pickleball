<aside
    class="w-64 flex-shrink-0 border-r border-[#e7f3eb] bg-surface-light dark:bg-surface-dark dark:border-gray-800 flex flex-col transition-all duration-300">
    <div class="p-6 flex items-center gap-3">
        <div class="bg-center bg-no-repeat bg-cover rounded-full size-10 shadow-sm"
            data-alt="Abstract pickleball paddle icon on green gradient"
            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBVwuqqXa-dUG7R5pVesnv1rg2DeHUFGgl02VAXeRc-l2bZpYjYdt6cprgyH3nCbrS5pW-FYCrGonTRNTHqmVAVDPi6ANba-sM7rZW7UIwcPJnM9EzlGPRMkyoGvSntp1e4vzaV7nCxgPzRyly0NR3vohecj45mKaW3qadoI898uCHbvF5KVxD2VOS8iDIwCsMpk_Uua-tQFb1XB0rZ31NpC3Zk6TddiW7IGKAIrLdyOk4CzTzIKfetnyIlgawVxVBY0bF9pDf8Prnf");'>
        </div>
        <h1 class="text-text-main dark:text-white text-lg font-bold leading-normal">PickleAdmin</h1>
    </div>
    <nav class="flex-1 flex flex-col gap-2 px-4 py-4 overflow-y-auto">
        <a class="flex items-center gap-3 px-3 py-3 rounded-lg text-text-main dark:text-gray-300 hover:bg-[#e7f3eb] dark:hover:bg-gray-800 transition-colors group"
            href="/tong-quan">
            <span
                class="material-symbols-outlined text-gray-500 group-hover:text-primary dark:text-gray-400">dashboard</span>
            <p class="text-sm font-medium">Tổng quan</p>
        </a>
        <a class="flex items-center gap-3 px-3 py-3 rounded-lg text-text-main dark:text-gray-300 hover:bg-[#e7f3eb] dark:hover:bg-gray-800 transition-colors group"
            href="/admin/quan-ly-danh-muc">
            <span
                class="material-symbols-outlined text-gray-500 group-hover:text-primary dark:text-gray-400">category</span>
            <p class="text-sm font-medium">Danh mục sản phẩm</p>
        </a>
        <a class="flex items-center gap-3 px-3 py-3 rounded-lg text-text-main dark:text-gray-300 hover:bg-[#e7f3eb] dark:hover:bg-gray-800 transition-colors group"
            href="/admin/quan-ly-thuoc-tinh">
            <span
                class="material-symbols-outlined text-gray-500 group-hover:text-primary dark:text-gray-400">tune</span>
            <p class="text-sm font-medium">Thuộc tính</p>
        </a>
        <a class="flex items-center gap-3 px-3 py-3 rounded-lg text-text-main dark:text-gray-300 hover:bg-[#e7f3eb] dark:hover:bg-gray-800 transition-colors group"
            href="/admin/quan-ly-san-pham">
            <span
                class="material-symbols-outlined text-gray-500 group-hover:text-primary dark:text-gray-400">inventory_2</span>
            <p class="text-sm font-medium">Sản phẩm</p>
        </a>
        <a class="flex items-center gap-3 px-3 py-3 rounded-lg text-text-main dark:text-gray-300 hover:bg-[#e7f3eb] dark:hover:bg-gray-800 transition-colors group"
            href="/admin/quan-ly-don-hang">
            <span
                class="material-symbols-outlined text-gray-500 group-hover:text-primary dark:text-gray-400">shopping_cart</span>
            <p class="text-sm font-medium">Đơn hàng</p>
        </a>
        <a class="flex items-center gap-3 px-3 py-3 rounded-lg text-text-main dark:text-gray-300 hover:bg-[#e7f3eb] dark:hover:bg-gray-800 transition-colors group"
            href="/admin/quan-ly-nguoi-dung">
            <span
                class="material-symbols-outlined text-gray-500 group-hover:text-primary dark:text-gray-400">group</span>
            <p class="text-sm font-medium">Khách hàng</p>
        </a>
        <a class="flex items-center gap-3 px-3 py-3 rounded-lg text-text-main dark:text-gray-300 hover:bg-[#e7f3eb] dark:hover:bg-gray-800 transition-colors group"
            href="/admin/quan-ly-QTV">
            <span class="material-symbols-outlined text-gray-500 group-hover:text-primary dark:text-gray-400">
                admin_panel_settings
            </span>
            <p class="text-sm font-medium">Quản trị viên</p>
        </a>
        <a class="flex items-center gap-3 px-3 py-3 rounded-lg text-text-main dark:text-gray-300 hover:bg-[#e7f3eb] dark:hover:bg-gray-800 transition-colors group"
            href="#">
            <span
                class="material-symbols-outlined text-gray-500 group-hover:text-primary dark:text-gray-400">monitoring</span>
            <p class="text-sm font-medium">Báo cáo</p>
        </a>
    </nav>
    <div class="p-4 border-t border-[#e7f3eb] dark:border-gray-800">
        <a id="btn_logout" class="flex items-center gap-3 px-3 py-3 rounded-lg text-text-main dark:text-gray-300 hover:bg-[#e7f3eb] dark:hover:bg-gray-800 transition-colors group"
            href="/dang-xuat">
                <span class="text-red-500 material-symbols-outlined"
                    style="font-size: 24px;">logout
                </span>
            <p class="text-red-500 text-sm font-medium">Đăng xuất</p>
        </a>
        <div class="mt-4 flex items-center gap-3 px-3">
            <div id="icon_avatar" class="size-8 rounded-full bg-gray-200 bg-center bg-cover"
                data-alt="User profile avatar placeholder">
            </div>
            <div class="flex flex-col">
                <span id="admin_name" class="text-sm font-bold text-text-main dark:text-white"></span>
                <span class="text-xs text-text-secondary">Quản lý cửa hàng</span>
            </div>
        </div>
    </div>
</aside>

<script>
    const avatarUrl = sessionStorage.getItem('admin_avatar');
    const avatarBtn = document.getElementById('icon_avatar');

    const defaultAvatar = 'https://lh3.googleusercontent.com/aida-public/AB6AXuBOPMRqzj2TK2odwqlKZtaoybrgxYwKm5dgUqik3SiXkliT1RQuIdHryMaJoOwXdq3O1HcpT-nXJsDZDx06QymUnO1UvS5nfMK_XtGlP6fR5fzcm27yQN7a1iY4XviSTvPiCZUAmTFZjXkx1WaPWTMkVAo3QDUG8Jth3LjiWMtaQJA_Dt6kjYxwIBkbSA0gSPdH6Iw3mFJEtXPrHkw2Hayq38R-SenjEPGjPxpgrzkZ7ug5HhJrde4Y43XkoTZauwI6ti0_4RD3Gdco';

    const finalAvatar = avatarUrl 
        ? `/storage/${avatarUrl}` 
        : defaultAvatar;

    avatarBtn.style.backgroundImage = `url("${finalAvatar}")`;

    $('#admin_name').text(sessionStorage.getItem('admin_name'));

    document.addEventListener("DOMContentLoaded", function () {

        const currentPath = window.location.pathname.replace(/\/+$/, ''); // bỏ dấu / cuối
        const navLinks = document.querySelectorAll('aside nav a');

        navLinks.forEach(link => {
            let linkPath = link.getAttribute('href').replace(/\/+$/, '');

            // nếu là #
            if (!linkPath || linkPath === '#') return;

            // ACTIVE khi currentPath bắt đầu bằng linkPath (match subpage)
            if (currentPath === linkPath || currentPath.startsWith(linkPath + '/')) {

                // reset tất cả
                navLinks.forEach(l => {
                    l.classList.remove('bg-[#e7f3eb]', 'dark:bg-gray-800');
                    l.querySelector('span')?.classList.remove('text-primary');
                    l.querySelector('p')?.classList.remove('font-bold','text-text-main','dark:text-white');
                });

                // active current
                link.classList.add('bg-[#e7f3eb]', 'dark:bg-gray-800');
                link.querySelector('span')?.classList.add('text-primary');
                link.querySelector('p')?.classList.add('font-bold','text-text-main','dark:text-white');
            }
        });

    });

    function clearClientAuth() {
        // Xoá toàn bộ cookie
        document.cookie.split(";").forEach(cookie => {
            const name = cookie.split("=")[0].trim();
            document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/';
            document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;domain=' + location.hostname;
        });

        // Xoá storage
        sessionStorage.clear();
        localStorage.clear();

        // Chuyển về login
        window.location.href = '/dang-xuat';
    }

    function logout() {
        Swal.fire({
            title: 'Bạn chắc chắn muốn đăng xuất?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#10b981', // Màu primary của bạn
            cancelButtonColor: '#6b7280', // Màu xám
            confirmButtonText: 'Đăng xuất!',
            cancelButtonText: 'Hủy',
            reverseButtons: true // Đưa nút Hủy sang bên trái cho thuận tay
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/logout',
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + getCookie('user_token'),
                        'Accept': 'application/json'
                    },
                    success() {
                        clearClientAuth();
                    },
                    error() {
                        // Dù lỗi vẫn clear client để tránh kẹt token
                        clearClientAuth();
                    }
                });
            }
        });
    }

    $('#btn_logout').on('click', function (e) {
        e.preventDefault();
        logout();
    });
</script>