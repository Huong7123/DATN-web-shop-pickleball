<aside class="w-full md:w-1/4 lg:w-1/5">
    <div class="flex flex-col gap-6">
        <div class="flex items-center gap-4">
            <div id="icon_avatar_profile" class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-14"
                data-alt="User avatar image"
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAaTPEnhz8eFd2StKYpTaYrCGeL39mS4kBsVpxSNhqhX2LSNQ-ADFD5nZOMZNhmTuLPKVni_meoy0wZbgYyrqrRq11ieVDrn1wPrUfGxa6lkEyWQD1GxBC-a98Dc5U-4AUjV4nWHtxP6aszez1gWphw94OKxHoKQAsI_rkMHGHCXAFxVBbkmYMhIZGxn4KMTy4GI6F8hPFKZBP4WWFU31YxvOTlzqBn7rQ6BmR0tke1F8QwjQn0KjqzprKQwUiGdoQvg2GH6iiSmqFW");'>
            </div>
            <div class="flex flex-col">
                <h1 id="name_profile" class="text-gray-900 dark:text-white text-base font-bold"></h1>
                <p id="email_profile" class="text-gray-500 dark:text-gray-400 text-sm"></p>
            </div>
        </div>
        <nav class="flex flex-col gap-2">
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg" href="/thong-tin-ca-nhan">
                <span class="material-symbols-outlined fill text-gray-900 dark:text-white">person</span>
                <p class="text-sm">Thông tin cá nhân</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg" href="/lich-su-don-hang">
                <span class="material-symbols-outlined text-gray-700 dark:text-gray-300">receipt_long</span>
                <p class="text-sm">Lịch sử đơn hàng</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg" href="/dia-chi-giao-hang">
                <span class="material-symbols-outlined text-gray-700 dark:text-gray-300">location_on</span>
                <p class="text-sm">Địa chỉ giao hàng</p>
            </a>
            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/20 mt-4 transition-colors"
                href="/dang-xuat">
                <span class="material-symbols-outlined text-red-500">logout</span>
                <p class="text-sm text-red-500">Đăng xuất</p>
            </a>
        </nav>
    </div>
</aside>

<script>
    const avatarUrlProfile = sessionStorage.getItem('avatar') || 'https://lh3.googleusercontent.com/aida-public/AB6AXuBOPMRqzj2TK2odwqlKZtaoybrgxYwKm5dgUqik3SiXkliT1RQuIdHryMaJoOwXdq3O1HcpT-nXJsDZDx06QymUnO1UvS5nfMK_XtGlP6fR5fzcm27yQN7a1iY4XviSTvPiCZUAmTFZjXkx1WaPWTMkVAo3QDUG8Jth3LjiWMtaQJA_Dt6kjYxwIBkbSA0gSPdH6Iw3mFJEtXPrHkw2Hayq38R-SenjEPGjPxpgrzkZ7ug5HhJrde4Y43XkoTZauwI6ti0_4RD3Gdco';
    const avatarBtnProfile = document.getElementById('icon_avatar_profile');
    avatarBtnProfile.style.backgroundImage = `url("/storage/${avatarUrlProfile}")`;

    const emailProfile = sessionStorage.getItem('email') || '';
    const nameProfile = sessionStorage.getItem('name') || '';
    document.getElementById('email_profile').innerText = emailProfile;
    document.getElementById('name_profile').innerText = nameProfile;

    document.addEventListener("DOMContentLoaded", function () {
        // 1. Lấy đường dẫn hiện tại (ví dụ: /lich-su-don-hang)
        const currentPath = window.location.pathname;

        // 2. Chọn tất cả các thẻ <a> trong thẻ <nav>
        const navLinks = document.querySelectorAll('nav a');

        navLinks.forEach(link => {
            // Lấy giá trị href của thẻ a
            const linkPath = link.getAttribute('href');

            // Định nghĩa các nhóm class
            const activeClasses = ['bg-primary/20'];
            const inactiveClasses = ['hover:bg-primary/20'];
            const textActive = ['font-bold', 'text-gray-900', 'dark:text-white'];
            const textInactive = ['font-medium'];

            // 3. Kiểm tra nếu path khớp
            if (currentPath === linkPath) {
                // Thêm class active
                link.classList.add(...activeClasses);
                link.classList.remove(...inactiveClasses);
                
                // Chỉnh text bên trong nếu cần
                const text = link.querySelector('p');
                if(text) {
                    text.classList.add(...textActive);
                    text.classList.remove(...textInactive);
                }
            } else {
                // Đảm bảo các thẻ khác ở trạng thái inactive
                link.classList.remove(...activeClasses);
                link.classList.add(...inactiveClasses);

                const text = link.querySelector('p');
                if(text) {
                    text.classList.remove(...textActive);
                    text.classList.add(...textInactive);
                }
            }
        });
    });
</script>