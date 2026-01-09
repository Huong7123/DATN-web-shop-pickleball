<div id="modal_infor" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 transition-opacity bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark min-h-screen flex items-center justify-center p-4 hidden">
    <div
        class="relative w-full max-w-[1000px] h-[700px] bg-surface-light dark:bg-surface-dark rounded-2xl shadow-2xl flex flex-col md:flex-row overflow-hidden border border-gray-100 dark:border-gray-800">
        <!-- Close Button (Top Right Absolute) -->
        <button
            class="btn-close-modal-infor absolute top-4 right-4 z-20 p-2 text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors rounded-full hover:bg-gray-100 dark:hover:bg-gray-800">
            <span class="material-symbols-outlined">close</span>
        </button>
        <!-- Sidebar (Left) -->
        <aside
            class="w-full md:w-[280px] bg-[#f8fcf9] dark:bg-[#15261b] border-r border-gray-100 dark:border-gray-800 flex flex-col shrink-0">
            <div class="p-6 pb-2">
                <h2 class="text-xl font-bold text-text-main dark:text-white tracking-tight">Cài đặt tài khoản</h2>
                <p class="text-sm text-text-muted mt-1">Quản lý thông tin và bảo mật</p>
            </div>
            <nav class="flex-1 px-4 py-4 flex flex-col gap-2">
                <button id="nav_personal"
                    class="nav-tab-btn flex items-center gap-3 px-4 py-3 rounded-xl transition-all group bg-primary/20 border border-primary/10 text-text-main dark:text-white">
                    <span class="material-symbols-outlined text-green-700 dark:text-primary">person</span>
                    <span class="text-sm font-semibold">Thông tin cá nhân</span>
                </button>

                <button id="nav_password"
                    class="nav-tab-btn flex items-center gap-3 px-4 py-3 rounded-xl transition-all group hover:bg-gray-100 dark:hover:bg-white/5 text-gray-600 dark:text-gray-400">
                    <span class="material-symbols-outlined">lock</span>
                    <span class="text-sm font-medium">Thay đổi mật khẩu</span>
                </button>
            </nav>
        </aside>
        <!-- Main Content (Right) -->
        <main class="flex-1 flex flex-col bg-surface-light dark:bg-surface-dark custom-scrollbar overflow-y-auto relative">
            <div id="section_personal" class="tab-section transition-all duration-200">
                <div class="px-8 pt-8 pb-4">
                    <h3 class="text-2xl font-bold text-text-main dark:text-white">Thông tin cá nhân</h3>
                    <p class="text-text-muted text-sm mt-1">Cập nhật ảnh đại diện và thông tin cá nhân của bạn.</p>
                </div>
                <div class="px-8 pb-8 flex flex-col gap-8">
                    <div class="flex items-center gap-6 p-4 bg-background-light dark:bg-background-dark rounded-xl border border-gray-100 dark:border-gray-800">
                        <div id="avatar_container" class="relative group cursor-pointer">
                            <div class="w-20 h-20 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden border-2 border-white dark:border-gray-600 shadow-md">
                                <img id="info_avatar" class="w-full h-full object-cover" src="" />
                            </div>
                            <div class="absolute inset-0 bg-black/40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="material-symbols-outlined text-white text-xl">edit</span>
                            </div>
                            <input type="file" id="input_avatar" class="hidden" accept="image/*">
                        </div>
                        <div class="flex flex-col gap-2">
                            <h4 class="text-text-main dark:text-white font-semibold">Ảnh đại diện</h4>
                            <button id="btn_trigger_avatar" class="w-fit text-xs font-medium bg-primary text-[#0d1b12] px-3 py-1.5 rounded-lg hover:bg-green-400 transition-colors">Tải ảnh lên</button>
                        </div>
                    </div>

                    <form class="flex flex-col gap-6 max-w-2xl">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-medium">Họ và tên</span>
                                <input id="info_name" class="w-full h-12 rounded-lg border-gray-200 dark:border-gray-700 bg-background-light dark:bg-background-dark px-4 focus:border-primary outline-none" type="text" />
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-medium">Số điện thoại</span>
                                <input id="info_phone" class="w-full h-12 rounded-lg border-gray-200 dark:border-gray-700 bg-background-light dark:bg-background-dark px-4 focus:border-primary outline-none" type="tel" />
                            </label>
                        </div>
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-medium text-text-muted">Email (Không thể chỉnh sửa)</span>
                            <input id="info_email" class="w-full h-12 rounded-lg bg-gray-100 dark:bg-white/5 text-gray-500 px-4 cursor-not-allowed" disabled type="email" />
                        </label>
                    </form>
                </div>
            </div>

            <div id="section_password" class="tab-section hidden transition-all duration-200">
                <div class="px-8 pt-8 pb-4">
                    <h3 class="text-2xl font-bold text-text-main dark:text-white">Thay đổi mật khẩu</h3>
                    <p class="text-text-muted text-sm mt-1">Đảm bảo mật khẩu mới có tính bảo mật cao.</p>
                </div>
                <div class="px-8 pb-8 flex flex-col gap-6 max-w-2xl">
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium">Mật khẩu hiện tại</span>
                        <input id="old_password" type="password" class="w-full h-12 rounded-lg border-gray-200 dark:border-gray-700 bg-background-light dark:bg-background-dark px-4 focus:border-primary outline-none" placeholder="••••••••" />
                    </label>
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium">Mật khẩu mới</span>
                        <input id="new_password" type="password" class="w-full h-12 rounded-lg border-gray-200 dark:border-gray-700 bg-background-light dark:bg-background-dark px-4 focus:border-primary outline-none" placeholder="Tối thiểu 8 ký tự" />
                    </label>
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium">Xác nhận mật khẩu mới</span>
                        <input id="confirm_password" type="password" class="w-full h-12 rounded-lg border-gray-200 dark:border-gray-700 bg-background-light dark:bg-background-dark px-4 focus:border-primary outline-none" placeholder="Nhập lại mật khẩu mới" />
                    </label>
                </div>
            </div>

            <div class="mt-auto sticky bottom-0 bg-surface-light/95 dark:bg-surface-dark/95 backdrop-blur-sm border-t border-gray-100 dark:border-gray-800 p-6 px-8 flex justify-end gap-3 z-10">
                <button class="btn-close-modal-infor px-6 py-2.5 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">Hủy</button>
                <button id="btn_save_all" class="px-8 py-2.5 rounded-lg text-sm font-bold bg-primary text-[#0d1b12] shadow-lg hover:-translate-y-0.5 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    <span id="btn_text">Lưu thay đổi</span>
                </button>
            </div>
        </main>
    </div>
</div>
<script>
    $(document).ready(function () {
        // --- 1. QUẢN LÝ HIỂN THỊ UI (Tên & Ảnh trên Header) ---
        function updateHeaderUI(name, avatar) {
            if (name) $('#admin_name').text(name);
            
            const avatarBtn = document.getElementById('icon_avatar');
            if (avatarBtn) {
                const finalAvatar = avatar 
                    ? `/storage/${avatar}` 
                    : 'https://lh3.googleusercontent.com/aida-public/AB6AXuBOPMRqzj2TK2odwqlKZtaoybrgxYwKm5dgUqik3SiXkliT1RQuIdHryMaJoOwXdq3O1HcpT-nXJsDZDx06QymUnO1UvS5nfMK_XtGlP6fR5fzcm27yQN7a1iY4XviSTvPiCZUAmTFZjXkx1WaPWTMkVAo3QDUG8Jth3LjiWMtaQJA_Dt6kjYxwIBkbSA0gSPdH6Iw3mFJEtXPrHkw2Hayq38R-SenjEPGjPxpgrzkZ7ug5HhJrde4Y43XkoTZauwI6ti0_4RD3Gdco';
                avatarBtn.style.backgroundImage = `url("${finalAvatar}")`;
            }
        }

        // --- 2. LOGIC CHUYỂN TAB TRONG MODAL ---
        $('.nav-tab-btn').on('click', function () {
            const tabId = $(this).attr('id');

            // Cập nhật trạng thái nút Sidebar
            $('.nav-tab-btn').removeClass('bg-primary/20 border-primary/10 text-text-main dark:text-white')
                            .addClass('text-gray-600 dark:text-gray-400');
            $(this).addClass('bg-primary/20 border-primary/10 text-text-main dark:text-white')
                .removeClass('text-gray-600 dark:text-gray-400');

            // Chuyển đổi nội dung hiển thị (Dùng CSS hidden)
            if (tabId === 'nav_personal') {
                $('#section_personal').removeClass('hidden');
                $('#section_password').addClass('hidden');
                $('#btn_save_all span:last-child').text('Lưu thay đổi');
            } else {
                $('#section_personal').addClass('hidden');
                $('#section_password').removeClass('hidden');
                $('#btn_save_all span:last-child').text('Cập nhật mật khẩu');
            }
        });

        // --- 3. XỬ LÝ ẢNH ĐẠI DIỆN (PREVIEW) ---
        $('#avatar_container, #btn_trigger_avatar').on('click', function (e) {
            if (e.target !== $('#input_avatar')[0]) {
                $('#input_avatar').trigger('click');
            }
        });

        $('#input_avatar').on('change', function () {
            const file = this.files[0];
            if (file && file.type.match('image.*')) {
                const reader = new FileReader();
                reader.onload = (e) => $('#info_avatar').attr('src', e.target.result);
                reader.readAsDataURL(file);
            }
        });

        // --- 4. LẤY THÔNG TIN NGƯỜI DÙNG (KHI MỞ MODAL) ---
        function getUserData() {
            const id = sessionStorage.getItem('admin_id');
            const token = getCookie('admin_token');
            if (!id || !token) return;

            $.ajax({
                url: `/api/user/${id}`,
                type: 'GET',
                headers: { Authorization: `Bearer ${token}` },
                success: function (response) {
                    const user = response.data;
                    $('#info_name').val(user.name);
                    $('#info_email').val(user.email);
                    $('#info_phone').val(user.phone);
                    
                    const avatarSrc = user.avatar 
                        ? `/storage/${user.avatar}` 
                        : `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=random`;
                    $('#info_avatar').attr('src', avatarSrc);
                },
                error: handleAjaxError
            });
        }

        // --- 5. LOGIC LƯU DỮ LIỆU (PHÂN TÁCH THEO TAB) ---
        $('#btn_save_all').on('click', function (e) {
            e.preventDefault();
            const isPasswordTab = !$('#section_password').hasClass('hidden');

            if (isPasswordTab) {
                handleSavePassword();
            } else {
                handleSaveProfile();
            }
        });

        // Hàm lưu thông tin cá nhân
        function handleSaveProfile() {
            const id = sessionStorage.getItem('admin_id');
            const token = getCookie('admin_token');
            let formData = new FormData();
            
            formData.append('name', $('#info_name').val());
            formData.append('phone', $('#info_phone').val());
            const avatarFile = $('#input_avatar')[0].files[0];
            if (avatarFile) formData.append('avatar', avatarFile);

            $.ajax({
                url: `/api/user/${id}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: { Authorization: `Bearer ${token}` },
                beforeSend: () => toggleLoading(true),
                success: function (response) {
                    const { name, avatar } = response.data;
                    // Cập nhật Session
                    sessionStorage.setItem('admin_name', name);
                    sessionStorage.setItem('admin_avatar', avatar);
                    
                    // Cập nhật UI ngay lập tức
                    updateHeaderUI(name, avatar);
                    
                    Swal.fire({ icon: 'success', title: 'Đã lưu thông tin', timer: 1500, showConfirmButton: false });
                    setTimeout(closeModalInfor, 1500);
                },
                error: handleAjaxError,
                complete: () => toggleLoading(false)
            });
        }

        // Hàm lưu mật khẩu
        function handleSavePassword() {
            const id = sessionStorage.getItem('admin_id');
            const token = getCookie('admin_token');
            
            const data = {
                current_password: $('#old_password').val(),
                new_password: $('#new_password').val(),
                confirm_password: $('#confirm_password').val()
            };

            $.ajax({
                url: `/api/user/update-pass/${id}`,
                type: 'POST',
                headers: { Authorization: `Bearer ${token}` },
                data: data,
                success: function () {
                    Swal.fire({ icon: 'success', title: 'Đổi mật khẩu thành công', timer: 1500, showConfirmButton: false });
                    $('#section_password input').val('');
                    setTimeout(closeModalInfor, 1500);
                },
                error: handleAjaxError,
            });
        }

        // --- 6. CÁC HÀM BỔ TRỢ ---
        function toggleLoading(isLoading) {
            const btn = $('#btn_save_all');
            if (isLoading) {
                btn.prop('disabled', true).addClass('opacity-50').find('span:last-child').text('Đang xử lý...');
            } else {
                const isPass = !$('#section_password').hasClass('hidden');
                btn.prop('disabled', false).removeClass('opacity-50').find('span:last-child').text(isPass ? 'Cập nhật mật khẩu' : 'Lưu thay đổi');
            }
        }

        function handleAjaxError(xhr) {
            const msg = xhr.responseJSON?.message || 'Có lỗi xảy ra!';
            Swal.fire({ icon: 'error', title: 'Lỗi', text: msg });
            if (xhr.status === 401) window.location.href = '/login';
        }

        function closeModalInfor() {
            $('#modal_infor').addClass('hidden');
            $('#input_avatar').val(''); // Reset file input
        }

        // Mở modal
        $('#btn_show_infor').on('click', function() {
            getUserData();
            $('#nav_personal').click(); // Luôn mặc định mở tab cá nhân
            $('#modal_infor').removeClass('hidden');
        });

        // Đóng modal events
        $('.btn-close-modal-infor').on('click', closeModalInfor);
        
        // Khởi tạo UI lần đầu khi load trang
        updateHeaderUI(sessionStorage.getItem('admin_name'), sessionStorage.getItem('admin_avatar'));
    });

    // Hàm lấy cookie ngoài scope
    function getCookie(name) {
        let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]*)'));
        return match ? decodeURIComponent(match[2]) : null;
    }
</script>
