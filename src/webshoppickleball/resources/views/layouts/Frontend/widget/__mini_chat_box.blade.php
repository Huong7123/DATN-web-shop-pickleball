<div class="fixed bottom-1 right-6 z-50 flex items-end gap-4">
    <div id="chat_box" class="w-[380px] h-[500px] bg-white dark:bg-gray-950 rounded-2xl shadow-2xl flex flex-col overflow-hidden border border-gray-100 dark:border-gray-800 hidden">
        <div class="bg-primary px-5 py-4 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-primary shadow-sm overflow-hidden">
                    <span class="material-symbols-outlined text-2xl">smart_toy</span>
                </div>
                <h2 class="text-[#0d1b12] text-[15px] font-bold">Tư vấn khách hàng</h2>
            </div>
            <button id="btn_close_chat" class="p-1 hover:bg-black/5 rounded-lg">
                <span class="material-symbols-outlined text-black">close</span>
            </button>
        </div>

        <div id="welcome_screen" class="flex-1 flex flex-col items-center justify-center p-8 text-center bg-white dark:bg-gray-950">
            <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mb-4 animate-bounce">
                <span class="material-symbols-outlined text-primary text-4xl">chat</span>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Xin chào! 👋</h3>
            <p class="text-sm text-gray-500 mb-8">Tôi là trợ lý ảo chuyên về Pickleball. Rất vui được hỗ trợ bạn tìm kiếm sản phẩm ưng ý.</p>
            <button id="btn_start_chat" class="w-full bg-primary py-3 rounded-xl text-[#0d1b12] font-bold shadow-lg hover:scale-105 transition-transform flex items-center justify-center gap-2">
                Bắt đầu tư vấn <span class="material-symbols-outlined">arrow_forward</span>
            </button>
        </div>

        <div id="main_chat_screen" class="hidden flex-1 flex flex-col overflow-hidden">
            <div id="chat_messages" class="flex-1 overflow-y-auto chat-scroll p-4 space-y-4 bg-gray-50/50 dark:bg-gray-900/50">
                </div>

            <div class="p-4 bg-white dark:bg-gray-950 border-t border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-2 bg-gray-50 dark:bg-gray-900 rounded-xl p-2 border border-gray-100 dark:border-gray-800 focus-within:border-primary transition-all">
                    <textarea id="chat_input" class="flex-1 bg-transparent border-none focus:ring-0 text-sm text-gray-900 dark:text-white placeholder:text-gray-400 resize-none min-h-[40px] leading-tight pt-2.5" placeholder="Hỏi về vợt, bóng..."></textarea>
                    <button id="btn_send" class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-black shadow-lg shadow-primary/20 hover:scale-105 active:scale-95 transition-transform">
                        <span class="material-symbols-outlined font-bold">send</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <button
        class="btn-toggle-chat w-16 h-16 bg-primary rounded-full shadow-2xl flex items-center justify-center text-black hover:scale-110 active:scale-95 transition-transform group relative">
        <span class="material-symbols-outlined text-3xl font-bold group-hover:hidden">chat_bubble</span>
        <span class="material-symbols-outlined text-3xl font-bold hidden group-hover:block">expand_more</span>
        
    </button>
</div>
<script>
    $(document).ready(function () {
        const $chatBox = $('#chat_box');
        const $toggleBtn = $('.btn-toggle-chat');
        const $welcomeScreen = $('#welcome_screen');
        const $mainChatScreen = $('#main_chat_screen');
        const $btnStartChat = $('#btn_start_chat');
        const $chatMessages = $('#chat_messages');
        const $chatInput = $('#chat_input');
        const $btnSend = $('#btn_send');

        // 1. Mở/Đóng khung chat
        $toggleBtn.on('click', function () {
            $chatBox.toggleClass('hidden');
        });

        // 2. Click nút Bắt đầu
        $btnStartChat.on('click', function() {
            $welcomeScreen.addClass('hidden');
            $mainChatScreen.removeClass('hidden');
            if ($chatMessages.children().length === 0) {
                appendMessage('ai', 'Chào bạn! Tôi là trợ lý ảo chuyên về Pickleball. Bạn cần tôi tư vấn gì hôm nay?');
            }
        });

        // 3. Xử lý gửi tin nhắn
        function handleSendMessage() {
            const message = $chatInput.val().trim();
            if (message === "") return;

            // Hiển thị tin nhắn của người dùng
            appendMessage('user', message);
            $chatInput.val(''); // Xóa ô nhập

            // Hiển thị hiệu ứng đang soạn tin (Typing)
            showTypingIndicator();

            // Gọi API
            $.ajax({
                url: '/api/chatbot',
                method: 'POST',
                data: {
                    message: message,
                },
                success: function(response) {
                    removeTypingIndicator();
                    const productsObj = response.products;
                    
                    if (productsObj && productsObj.message) {
                        // Truyền thêm mảng data sản phẩm vào hàm append
                        appendMessage('ai', productsObj.message, productsObj.data);
                    }
                },
                error: function(xhr) {
                    removeTypingIndicator();
                    appendMessage('ai', 'Xin lỗi, tôi gặp chút trục trặc. Bạn thử lại sau nhé!');
                    console.error(xhr.responseText);
                }
            });
        }

        $btnSend.on('click', handleSendMessage);

        // Gửi bằng phím Enter (nhưng cho phép Shift+Enter để xuống dòng)
        $chatInput.on('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                handleSendMessage();
            }
        });

        // Khởi tạo mảng lịch sử từ sessionStorage hoặc mảng rỗng nếu chưa có
        let chatHistory = JSON.parse(sessionStorage.getItem('pickleball_chat_history')) || [];

        function appendMessage(type, text, productData = [], isRestoring = false) {
            let html = '';
            const content = (text || "").toString();

            // 1. Lưu vào history nếu không phải đang trong quá trình khôi phục (isRestoring)
            if (!isRestoring) {
                chatHistory.push({ type, text, productData });
                sessionStorage.setItem('pickleball_chat_history', JSON.stringify(chatHistory));
            }

            if (type === 'ai') {
                let productsHtml = '';
                if (productData && productData.length > 0) {
                    productsHtml = `<div class="flex flex-col gap-2 mt-3 pt-3 border-t border-gray-100 dark:border-gray-700">`;
                    productData.forEach(product => {
                        let imageUrl = '/images/default.jpg';
                        try {
                            if (product.image) {
                                const imgArray = typeof product.image === 'string' ? JSON.parse(product.image) : product.image;
                                if (imgArray.length > 0) imageUrl = `/storage/${imgArray[0]}`;
                            }
                        } catch (e) {}

                        const priceFormatted = new Intl.NumberFormat('vi-VN', {
                            style: 'currency', currency: 'VND', maximumFractionDigits: 0
                        }).format(product.price);

                        productsHtml += `
                            <a href="/san-pham/${product.slug}" target="_blank" class="flex items-center gap-2 bg-gray-50 dark:bg-gray-900/50 p-2 rounded-xl hover:bg-primary/10 transition-colors group">
                                <img src="${imageUrl}" class="w-10 h-10 object-cover rounded-lg shrink-0" alt="${product.name}">
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-[12px] font-bold text-gray-800 dark:text-gray-100 leading-tight truncate-2-lines">${product.name}</h4>
                                    <span class="text-[11px] font-semibold text-primary">${priceFormatted}</span>
                                </div>
                                <span class="material-symbols-outlined text-gray-400 text-xs">arrow_forward_ios</span>
                            </a>`;
                    });
                    productsHtml += `</div>`;
                }

                html = `
                    <div class="flex items-start gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center shrink-0 border border-primary/30">
                            <span class="material-symbols-outlined text-primary text-sm">smart_toy</span>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-3 rounded-2xl rounded-tl-none shadow-sm text-sm text-gray-800 dark:text-gray-200 border border-gray-100 dark:border-gray-700 max-w-[85%]">
                            <div>${content.replace(/\n/g, '<br>')}</div>
                            ${productsHtml}
                        </div>
                    </div>`;
            } else {
                html = `
                    <div class="flex items-start gap-2.5 justify-end">
                        <div class="bg-primary p-3 rounded-2xl rounded-tr-none shadow-sm text-sm text-[#0d1b12] font-medium">
                            ${content}
                        </div>
                    </div>`;
            }

            $chatMessages.append(html);
            $chatMessages.scrollTop($chatMessages[0].scrollHeight);
        }

        function showTypingIndicator() {
            const typingHtml = `
                <div id="typing_indicator" class="flex items-start gap-2.5 opacity-60">
                    <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center shrink-0 border border-primary/30">
                        <span class="material-symbols-outlined text-primary text-sm animate-pulse">smart_toy</span>
                    </div>
                    <div class="bg-white dark:bg-gray-800 px-4 py-2 rounded-2xl rounded-tl-none shadow-sm">
                        <div class="flex gap-1">
                            <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce [animation-delay:-0.15s]"></div>
                            <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce [animation-delay:-0.3s]"></div>
                        </div>
                    </div>
                </div>`;
            $chatMessages.append(typingHtml);
            $chatMessages.scrollTop($chatMessages[0].scrollHeight);
        }

        function removeTypingIndicator() {
            $('#typing_indicator').remove();
        }

        $('#btn_close_chat').on('click', function() { $chatBox.addClass('hidden'); });

        // Kiểm tra nếu có lịch sử chat thì hiển thị màn hình chat luôn, bỏ qua màn hình chào
        if (chatHistory.length > 0) {
            $welcomeScreen.addClass('hidden');
            $mainChatScreen.removeClass('hidden');
            
            // Vẽ lại từng tin nhắn từ history
            chatHistory.forEach(item => {
                appendMessage(item.type, item.text, item.productData, true); // true để không lưu chồng lên nhau
            });
        }
    });
</script>