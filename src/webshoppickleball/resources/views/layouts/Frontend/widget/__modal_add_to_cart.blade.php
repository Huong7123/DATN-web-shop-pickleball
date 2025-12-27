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
                        <!-- <div class="shrink-0 w-full sm:w-48">
                            <div
                                class="aspect-square w-full rounded-xl overflow-hidden border border-slate-100 dark:border-slate-800 relative bg-background-light dark:bg-surface-dark group">
                                <div class="absolute inset-0 bg-center bg-cover bg-no-repeat transition-transform duration-500 group-hover:scale-105"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC_96hhksEsXC1MMhR45hKnkNDzv84yrUswcJ4ReGfBWAxLJUqZVv-KEqD7iIQD0vIs65CaLUmuBk1hTILaclMhCh2btEfPj3wWYcZLCvc8bchRK3u8sVXTDZBLi1xQGTvHEf3FdCYvRphrY9t6qCAMDoutDWpc-4xeUQ2YaQd4enA5vO3h0q2CFgQPvFNwkh1anKOi0j9Xlvb3C37RcEdbCbz9Yn99FD3tozwnyN-nFCWldaXXMJgiwuvRmcHhwFIkGKNmlqMO9QaX");'>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 space-y-6">
                            <div>
                                <h3 class="text-xl font-bold text-[#0d1b12] dark:text-white leading-snug">Vợt Pickleball
                                    Joola Ben Johns Perseus</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <p class="text-xl font-bold text-primary">3.200.000₫</p>
                                </div>
                            </div>
                            <div class="h-px w-full bg-slate-100 dark:bg-slate-800"></div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Độ
                                    dày lõi</label>
                                <div class="flex flex-wrap gap-2">
                                    <button
                                        class="px-4 py-2 rounded-lg border-2 border-primary bg-primary/10 text-[#0d1b12] font-bold text-sm transition-all shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-background-dark">
                                        16mm
                                    </button>
                                    <button
                                        class="px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 font-medium text-sm hover:border-slate-300 dark:hover:border-slate-600 hover:bg-slate-50 dark:hover:bg-surface-dark transition-all focus:outline-none focus:ring-2 focus:ring-slate-400">
                                        14mm
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Số
                                    lượng</label>
                                <div class="flex items-center gap-4">
                                    <div
                                        class="flex items-center rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-transparent p-0.5 w-fit">
                                        <button
                                            class="w-9 h-9 flex items-center justify-center rounded hover:bg-slate-100 dark:hover:bg-surface-dark text-slate-500 dark:text-slate-400 transition-colors cursor-pointer">
                                            <span class="material-symbols-outlined text-[18px]">remove</span>
                                        </button>
                                        <input
                                            class="w-12 text-center bg-transparent text-sm font-bold text-[#0d1b12] dark:text-white border-none focus:ring-0 p-0 [&amp;::-webkit-inner-spin-button]:appearance-none"
                                            type="number" value="1" />
                                        <button
                                            class="w-9 h-9 flex items-center justify-center rounded hover:bg-slate-100 dark:hover:bg-surface-dark text-slate-500 dark:text-slate-400 transition-colors cursor-pointer">
                                            <span class="material-symbols-outlined text-[18px]">add</span>
                                        </button>
                                    </div>
                                    <div class="text-xs font-medium text-primary flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">inventory_2</span>
                                        Còn hàng
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div
                    class="p-6 pt-4 bg-white dark:bg-background-dark border-t border-slate-50 dark:border-slate-800/50 sticky bottom-0 z-10">
                    <button
                        class="w-full flex items-center justify-center h-12 rounded-xl bg-primary text-[#0d1b12] font-bold text-base tracking-wide hover:bg-[#10d652] transition-all shadow-lg shadow-primary/25 cursor-pointer group">
                        <span class="material-symbols-outlined text-[20px] mr-2">shopping_cart</span>
                        Thêm vào giỏ hàng
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>