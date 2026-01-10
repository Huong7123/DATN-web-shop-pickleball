<div class="fixed bottom-1 right-6 z-50 flex items-end gap-4">
    <div id="chat_box"
        class="w-[380px] h-[500px] bg-white dark:bg-gray-950 rounded-2xl shadow-2xl flex flex-col overflow-hidden border border-gray-100 dark:border-gray-800 hidden">
        <div class="bg-primary px-5 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div
                        class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-primary shadow-sm overflow-hidden">
                        <span class="material-symbols-outlined text-2xl">smart_toy</span>
                    </div>
                    <div
                        class="absolute bottom-0 right-0 w-3 h-3 bg-white border-2 border-primary rounded-full flex items-center justify-center">
                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full"></div>
                    </div>
                </div>
                <div>
                    <h2 class="text-[#0d1b12] text-[15px] font-bold leading-tight">Tư vấn khách hàng</h2>
                </div>
            </div>
            <div class="flex items-center gap-1">
                <button id="btn_close_chat" class="p-1 hover:bg-black/5 rounded-lg transition-colors">
                    <span class="material-symbols-outlined text-black">close</span>
                </button>
            </div>
        </div>
        <div class="flex-1 overflow-y-auto chat-scroll p-4 space-y-4 bg-gray-50/50 dark:bg-gray-900/50">
            <div class="flex items-start gap-2.5">
                <div
                    class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center shrink-0 border border-primary/30">
                    <span class="material-symbols-outlined text-primary text-sm">smart_toy</span>
                </div>
                <div class="flex flex-col gap-1 max-w-[85%]">
                    <span class="text-[11px] text-gray-500 font-medium ml-1">AI BOT</span>
                    <div
                        class="bg-white dark:bg-gray-800 p-3 rounded-2xl rounded-tl-none shadow-sm text-sm text-gray-800 dark:text-gray-200 border border-gray-100 dark:border-gray-700">
                        Xin chào! Tôi là trợ lý AI chuyên về Pickleball. Rất vui được hỗ trợ bạn.
                        <br /><br />
                        Hãy chọn một trong các chủ đề dưới đây để tôi có thể tư vấn chính xác nhất cho bạn:
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-2 pl-10 pr-4">
                <button
                    class="text-left w-full bg-white dark:bg-gray-800 border border-primary/40 hover:border-primary hover:bg-primary/5 text-gray-800 dark:text-gray-200 p-3 rounded-xl text-sm font-medium transition-all shadow-sm flex items-center justify-between group">
                    <span>Tư vấn chọn vợt cho người mới</span>
                    <span
                        class="material-symbols-outlined text-primary text-lg opacity-0 group-hover:opacity-100 transition-opacity">arrow_forward_ios</span>
                </button>
                <button
                    class="text-left w-full bg-white dark:bg-gray-800 border border-primary/40 hover:border-primary hover:bg-primary/5 text-gray-800 dark:text-gray-200 p-3 rounded-xl text-sm font-medium transition-all shadow-sm flex items-center justify-between group">
                    <span>Tìm bóng chơi ngoài trời</span>
                    <span
                        class="material-symbols-outlined text-primary text-lg opacity-0 group-hover:opacity-100 transition-opacity">arrow_forward_ios</span>
                </button>
                <button
                    class="text-left w-full bg-white dark:bg-gray-800 border border-primary/40 hover:border-primary hover:bg-primary/5 text-gray-800 dark:text-gray-200 p-3 rounded-xl text-sm font-medium transition-all shadow-sm flex items-center justify-between group">
                    <span>Chính sách bảo hành</span>
                    <span
                        class="material-symbols-outlined text-primary text-lg opacity-0 group-hover:opacity-100 transition-opacity">arrow_forward_ios</span>
                </button>
            </div>
        </div>
    </div>
    <button
        class="btn-toggle-chat w-16 h-16 bg-primary rounded-full shadow-2xl flex items-center justify-center text-black hover:scale-110 active:scale-95 transition-transform group relative">
        <span class="material-symbols-outlined text-3xl font-bold group-hover:hidden">chat_bubble</span>
        <span class="material-symbols-outlined text-3xl font-bold hidden group-hover:block">expand_more</span>
        <div
            class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full border-2 border-white dark:border-gray-900 flex items-center justify-center">
            <span class="text-[10px] text-white font-bold">1</span>
        </div>
    </button>
</div>
<script>
    $(document).ready(function () {
    const $chatBox = $('#chat_box');
    const $toggleBtn = $('.btn-toggle-chat');
    const $notificationBadge = $toggleBtn.find('.bg-red-500'); // Chấm đỏ thông báo

    // 1. Click vào nút tròn để ẩn/hiện
    $toggleBtn.on('click', function () {
        const isHidden = $chatBox.hasClass('hidden');

        if (isHidden) {
            // Hiện khung chat
            $chatBox.removeClass('hidden').addClass('animate-in fade-in zoom-in duration-300');
            // Ẩn chấm đỏ thông báo khi đã xem
            $notificationBadge.addClass('hidden');
        } else {
            // Ẩn khung chat
            $chatBox.addClass('hidden');
        }
    });

    // 2. Nút Close (dấu x) bên trong khung chat
    $('#btn_close_chat, .btn-minimize-chat').on('click', function (e) {
        e.stopPropagation(); // Ngăn sự kiện nổi bọt
        $chatBox.addClass('hidden');
    });

    // 3. Tự động đóng khi nhấn phím Esc
    $(document).on('keydown', function(e) {
        if (e.key === "Escape") {
            $chatBox.addClass('hidden');
        }
    });
});
</script>