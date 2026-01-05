<div id="modal_add_cart" class="bg-background-light dark:bg-background-dark font-display antialiased text-slate-900 dark:text-white hidden">
    <div class="relative min-h-screen w-full flex flex-col items-center pt-20 overflow-hidden">
        <div aria-hidden="true" class="w-full max-w-[1200px] px-6 opacity-20 pointer-events-none filter blur-[2px]">
            <div class="h-10 w-48 bg-slate-200 dark:bg-slate-800 rounded mb-8"></div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="aspect-[4/3] bg-slate-200 dark:bg-slate-800 rounded-xl"></div>
                <div class="space-y-6">
                    <div class="h-8 w-3/4 bg-slate-200 dark:bg-slate-800 rounded"></div>
                    <div class="h-6 w-1/4 bg-slate-200 dark:bg-slate-800 rounded"></div>
                    <div class="h-32 w-full bg-slate-200 dark:bg-slate-800 rounded"></div>
                </div>
            </div>
        </div>
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
            <div
                class="relative flex flex-col w-full max-w-[680px] max-h-[90vh] bg-white dark:bg-background-dark rounded-2xl shadow-2xl ring-1 ring-white/10 overflow-hidden animate-in zoom-in-95 duration-200 ease-out">
                <div
                    class="flex items-center justify-between px-6 py-4 border-b border-slate-100 dark:border-slate-800/50 bg-white dark:bg-background-dark sticky top-0 z-10">
                    <h2 class="text-lg font-bold text-[#0d1b12] dark:text-white tracking-tight">Thêm vào giỏ hàng</h2>
                    <button id="btn_close_modal"
                        class="group flex items-center justify-center w-8 h-8 rounded-full text-slate-400 hover:bg-slate-100 hover:text-slate-600 dark:hover:bg-surface-dark dark:hover:text-slate-200 transition-all cursor-pointer">
                        <span class="material-symbols-outlined text-[24px]">close</span>
                    </button>
                </div>
                <div class="flex-1 overflow-y-auto p-6 bg-white dark:bg-background-dark">
                    <div id="modal_add_to_cart_content" class="flex flex-col sm:flex-row gap-6">
                       
                    </div>
                </div>
                <div
                    class="p-6 pt-4 bg-white dark:bg-background-dark border-t border-slate-50 dark:border-slate-800/50 sticky bottom-0 z-10">
                    <button id="btn_add_cart_confirm"
                        class="w-full flex items-center justify-center h-12 rounded-xl bg-primary text-[#0d1b12] font-bold text-base tracking-wide hover:bg-[#10d652] transition-all shadow-lg shadow-primary/25 cursor-pointer group">
                        <span class="material-symbols-outlined text-[20px] mr-2">shopping_cart</span>
                        Thêm vào giỏ hàng
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
