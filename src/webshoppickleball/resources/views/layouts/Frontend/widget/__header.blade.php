<div class="container mx-auto px-4">
    <div class="flex items-center justify-between whitespace-nowrap px-2 sm:px-6 lg:px-8 py-3">
        <div class="flex items-center gap-8">
            <div id="logo" class="flex items-center gap-2 text-[#0d1b12] dark:text-white" style="cursor: pointer;">
                <span class="material-symbols-outlined text-primary text-3xl">sports_tennis</span>
                <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">Pickleball Pro</h2>
            </div>
            <div class="hidden md:flex items-center gap-9">
                <a class="text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary transition-colors" href="/san-pham">Sản phẩm</a>
                <a id="voucher_link" class="text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary transition-colors hidden" href="/kho-voucher">Kho voucher</a>
                <!-- <a class="text-sm font-medium leading-normal hover:text-primary dark:hover:text-primary transition-colors" href="/lien-he">Liên hệ</a> -->

            </div>
        </div>
        <div class="flex flex-1 justify-end gap-2 md:gap-4">
            <label class="hidden sm:flex flex-col min-w-40 !h-10 max-w-64">
                <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                    <div class="text-primary/70 dark:text-primary/70 flex bg-primary/10 dark:bg-primary/20 items-center justify-center pl-4 rounded-l-lg border-r-0">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <input style="--tw-ring-shadow: none;" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d1b12] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-none bg-primary/10 dark:bg-primary/20 h-full placeholder:text-primary/70 dark:placeholder:text-primary/70 px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal" placeholder="Tìm kiếm sản phẩm..." value="" />
                </div>
            </label>
            <!-- <button class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary/10 dark:bg-primary/20 text-[#0d1b12] dark:text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5 hover:bg-primary/20 dark:hover:bg-primary/30 transition-colors">
                <span class="material-symbols-outlined">favorite</span>
            </button> -->
            <div class="relative">
                <button id="icon_cart"
                    class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10
                    bg-primary/10 dark:bg-primary/20 text-[#0d1b12] dark:text-white gap-2 text-sm font-bold leading-normal
                    tracking-[0.015em] min-w-0 px-2.5 hover:bg-primary/20 dark:hover:bg-primary/30 transition-colors">
    
                    <span class="material-symbols-outlined">shopping_cart</span>
    
                    <!-- Badge -->
                </button>
                <span id="cart_badge"
                    class="hidden absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1
                    bg-red-500 text-white text-[11px] font-bold rounded-full
                    flex items-center justify-center">
                    0
                </span>

            </div>
            <div class="relative group">
                <button id="icon_avatar" class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 ring-2 ring-offset-2 ring-offset-background-light dark:ring-offset-background-dark ring-transparent group-hover:ring-primary transition-all"
                    data-alt="User avatar of a smiling man"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBOPMRqzj2TK2odwqlKZtaoybrgxYwKm5dgUqik3SiXkliT1RQuIdHryMaJoOwXdq3O1HcpT-nXJsDZDx06QymUnO1UvS5nfMK_XtGlP6fR5fzcm27yQN7a1iY4XviSTvPiCZUAmTFZjXkx1WaPWTMkVAo3QDUG8Jth3LjiWMtaQJA_Dt6kjYxwIBkbSA0gSPdH6Iw3mFJEtXPrHkw2Hayq38R-SenjEPGjPxpgrzkZ7ug5HhJrde4Y43XkoTZauwI6ti0_4RD3Gdco");'></button>
                <!-- Dropdown Menu -->
                <div id="dropdown_menu_avatar" class="hidden absolute top-full right-0 mt-4 w-64 origin-top-right rounded-xl bg-background-light dark:bg-background-dark shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-10 opacity-100 transform scale-100 transition-all duration-200 ease-out">
                    <div id="menu_logged_in" style="display:none;" class="flex flex-col p-2">
                        <div class="flex flex-col gap-1">
                            <a class="flex items-center gap-4 hover:bg-primary/20 px-4 min-h-14 justify-between rounded-lg transition-colors"
                                href="/thong-tin-ca-nhan">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="text-text-light dark:text-text-dark flex items-center justify-center shrink-0 size-10">
                                        <span class="material-symbols-outlined"
                                            style="font-size: 24px;">person</span>
                                    </div>
                                    <p
                                        class="text-text-light dark:text-text-dark text-base font-normal leading-normal flex-1 truncate">
                                        Thông tin cá nhân</p>
                                </div>
                            </a>
                            <a class="flex items-center gap-4 hover:bg-primary/20 px-4 min-h-14 justify-between rounded-lg transition-colors"
                                href="/lich-su-don-hang">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="text-text-light dark:text-text-dark flex items-center justify-center shrink-0 size-10">
                                        <span class="material-symbols-outlined"
                                            style="font-size: 24px;">receipt_long</span>
                                    </div>
                                    <p
                                        class="text-text-light dark:text-text-dark text-base font-normal leading-normal flex-1 truncate">
                                        Lịch sử đơn hàng</p>
                                </div>
                            </a>
                            <a class="flex items-center gap-4 hover:bg-primary/20 px-4 min-h-14 justify-between rounded-lg transition-colors"
                                href="/dia-chi-giao-hang">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="text-text-light dark:text-text-dark flex items-center justify-center shrink-0 size-10">
                                        <span class="material-symbols-outlined"
                                            style="font-size: 24px;">pin_drop</span>
                                    </div>
                                    <p
                                        class="text-text-light dark:text-text-dark text-base font-normal leading-normal flex-1 truncate">
                                        Sổ địa chỉ</p>
                                </div>
                            </a>
                        </div>
                        <div class="h-px bg-border-light dark:bg-border-dark my-2" style="background-color: rgb(19 236 91 / var(--tw-text-opacity, 1));"></div>
                        <a id="btn_logout" class="flex items-center gap-4 hover:bg-red-500/10 px-4 min-h-14 justify-between rounded-lg transition-colors group/logout"
                            href="/dang-xuat">
                            <div class="flex items-center gap-4">
                                <div
                                    class="text-red-500 flex items-center justify-center shrink-0 size-10">
                                    <span class="material-symbols-outlined"
                                        style="font-size: 24px;">logout</span>
                                </div>
                                <p
                                    class="text-red-500 text-base font-normal leading-normal flex-1 truncate">
                                    Đăng xuất</p>
                            </div>
                        </a>
                    </div>
                    <div id="menu_not_logged_in" style="display:none;" class="flex flex-col p-2">
                        <div class="flex flex-col gap-1">
                            <a class="flex items-center gap-4 hover:bg-primary/20 px-4 min-h-14 justify-between rounded-lg transition-colors"
                                href="/dang-ky">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="text-text-light dark:text-text-dark flex items-center justify-center shrink-0 size-10">
                                        <span class="material-symbols-outlined"
                                            style="font-size: 24px;">person_add</span>
                                    </div>
                                    <p
                                        class="text-text-light dark:text-text-dark text-base font-normal leading-normal flex-1 truncate">
                                        Đăng ký</p>
                                </div>
                            </a>
                            <a class="flex items-center gap-4 hover:bg-primary/20 px-4 min-h-14 justify-between rounded-lg transition-colors"
                                href="/dang-nhap">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="text-text-light dark:text-text-dark flex items-center justify-center shrink-0 size-10">
                                        <span class="material-symbols-outlined"
                                            style="font-size: 24px;">login</span>
                                    </div>
                                    <p
                                        class="text-text-light dark:text-text-dark text-base font-normal leading-normal flex-1 truncate">
                                        Đăng nhập</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#icon_cart').on('click', function () {
        window.location.href = '/gio-hang';
    });
    $('#logo').on('click', function () {
        window.location.href = '/';
    });
    $('#icon_avatar').on('click', function (e) {
        e.stopPropagation();
        $('#dropdown_menu_avatar').toggleClass('hidden');
    });
    $(document).on('click', function () {
        $('#dropdown_menu_avatar').addClass('hidden');
    });
    $('#dropdown_menu_avatar').on('click', function (e) {
        e.stopPropagation();
    });

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    $(document).ready(function () {
        const tokenUser = getCookie("user_token");

        if (!tokenUser) {
            $("#voucher_link").addClass("hidden");
            $("#menu_not_logged_in").show();
            $("#menu_logged_in").hide();
        } else {
            $("#voucher_link").removeClass("hidden");
            $("#menu_not_logged_in").hide();
            $("#menu_logged_in").show();
        }
        loadCartBadge();
    });

    const avatarUrl = sessionStorage.getItem('avatar');
    const avatarBtn = document.getElementById('icon_avatar');

    const defaultAvatar = 'https://lh3.googleusercontent.com/aida-public/AB6AXuBOPMRqzj2TK2odwqlKZtaoybrgxYwKm5dgUqik3SiXkliT1RQuIdHryMaJoOwXdq3O1HcpT-nXJsDZDx06QymUnO1UvS5nfMK_XtGlP6fR5fzcm27yQN7a1iY4XviSTvPiCZUAmTFZjXkx1WaPWTMkVAo3QDUG8Jth3LjiWMtaQJA_Dt6kjYxwIBkbSA0gSPdH6Iw3mFJEtXPrHkw2Hayq38R-SenjEPGjPxpgrzkZ7ug5HhJrde4Y43XkoTZauwI6ti0_4RD3Gdco';

    const finalAvatar = avatarUrl 
        ? `/storage/${avatarUrl}` 
        : defaultAvatar;

    avatarBtn.style.backgroundImage = `url("${finalAvatar}")`;


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

    function loadCartBadge() {
        const token = getCookie('user_token');
        const userId = sessionStorage.getItem('id');

        if (!token || !userId) {
            $('#cart_badge').addClass('hidden');
            return;
        }

        $.ajax({
            url: '/api/cart/' + userId,
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json'
            },
            success(res) {
                // res.data là mảng sản phẩm trong giỏ
                const total = res.data.length;

                if (total > 0) {
                    $('#cart_badge').removeClass('hidden').text(total);
                } else {
                    $('#cart_badge').addClass('hidden');
                }
            },
            error() {
                $('#cart_badge').addClass('hidden');
            }
        });
    }


</script>