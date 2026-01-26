@extends('layouts.Admin.master')
@section('title', $title)
@section('content')
<div class="flex-1 overflow-y-auto p-8 max-w-[1200px] mx-auto w-full">
    <!-- Page Heading -->
    <div class="flex flex-wrap justify-between items-end gap-6 mb-8">
        <div class="flex flex-col gap-2">
            <h2
                class="text-[#0d1b12] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">
                Cấu hình Ưu đãi Độc quyền</h2>
        </div>
        <button id="btn_modal_add"
            class="flex items-center gap-2 px-6 h-12 bg-primary text-background-dark rounded-xl font-bold transition-transform hover:scale-105 active:scale-95 shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined">add</span>
            <span>Thêm mức mới</span>
        </button>
    </div>
    <!-- Tier Cards List -->
    <div class="flex flex-col gap-4">
        <!-- Tier 1: Bronze -->
        <div
            class="group flex flex-col md:flex-row items-center gap-6 p-6 rounded-2xl bg-white dark:bg-[#152a1c] border border-[#cfe7d7] dark:border-[#2d4a35] transition-all hover:border-primary/50 hover:shadow-xl">
            <div
                class="flex h-16 w-16 items-center justify-center rounded-2xl bg-[#cd7f32]/20 text-[#cd7f32]">
                <span class="material-symbols-outlined text-4xl font-bold">workspace_premium</span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-3 mb-1">
                    <h4 class="text-xl font-extrabold truncate">Hạng Đồng (Bronze)</h4>
                    <span
                        class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#e7f3eb] text-[#4c9a66] uppercase">Mặc
                        định</span>
                </div>
                <p class="text-[#4c9a66] text-sm font-medium mb-3">Chi tiêu tối thiểu: <span
                        class="text-[#0d1b12] dark:text-white font-bold">0 VNĐ</span></p>
                <div class="flex flex-wrap gap-2">
                    <span
                        class="flex items-center gap-1 px-3 py-1 rounded-full bg-[#f0f9f3] dark:bg-[#1a3321] text-[#4c9a66] dark:text-primary text-xs font-semibold border border-primary/20">
                        <span class="material-symbols-outlined text-sm">local_shipping</span> Miễn phí ship
                        (Nội thành)
                    </span>
                    <span
                        class="flex items-center gap-1 px-3 py-1 rounded-full bg-[#f0f9f3] dark:bg-[#1a3321] text-[#4c9a66] dark:text-primary text-xs font-semibold border border-primary/20">
                        <span class="material-symbols-outlined text-sm">percent</span> Voucher 5%
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-4 ml-auto">
                <div class="flex flex-col items-end mr-4">
                    <span class="text-xs font-bold text-[#4c9a66] mb-1">TRẠNG THÁI</span>
                    <div class="relative inline-flex items-center cursor-pointer">
                        <div class="w-11 h-6 bg-primary rounded-full peer"></div>
                        <div
                            class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform translate-x-5">
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button
                        class="p-3 rounded-xl bg-[#e7f3eb] dark:bg-[#203a28] hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-[#0d1b12] dark:text-white">edit</span>
                    </button>
                    <button
                        class="p-3 rounded-xl bg-[#e7f3eb] dark:bg-[#203a28] hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
                        <span class="material-symbols-outlined text-red-500">delete</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal_config" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 transition-opacity bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark min-h-screen flex items-center justify-center p-4 hidden">
    <!-- Modal Container -->
    <div
        class="bg-background-light dark:bg-background-dark w-full max-w-2xl rounded-xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <!-- Modal Header -->
        <div
            class="px-6 py-4 border-b border-gray-200 dark:border-gray-800 flex justify-between items-center bg-white dark:bg-background-dark">
            <div>
                <h2 class="text-[#0d1b12] dark:text-white text-xl font-bold leading-tight">Cấu hình Mốc Ưu đãi</h2>
            </div>
            <button class="btn-close-modal text-gray-400 hover:text-gray-600 dark:hover:text-white transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto custom-scrollbar p-6 space-y-6">
            <!-- Basic Config Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tên mốc ưu đãi (Dropdown-like Textfield) -->
                <div class="flex flex-col gap-2">
                    <label class="flex flex-col gap-2">
                        <p class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold">Tiêu đề</p>
                        <div class="relative flex items-center">
                            <input id="discount_title"
                                class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                                placeholder="VD: Ưu đãi mới" value="Ưu đãi mới" />
                        </div>
                    </label>
                </div>
                <!-- Mức chi tiêu tích lũy -->
                <div class="flex flex-col gap-2">
                    <label class="flex flex-col gap-2">
                        <p class="text-[#0d1b12] dark:text-white/90 text-sm font-semibold">Chi tiêu tích lũy tối thiểu (VNĐ)</p>
                        <div class="relative flex items-center">
                            <input id="discount_title"
                                class="w-full rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-shadow"
                                placeholder="5,000,000" type="text" />
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-[#4c9a66]">VNĐ</span>
                        </div>
                    </label>
                </div>
            </div>
            <!-- Voucher Selection Section -->
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <h3 class="text-[#0d1b12] dark:text-white text-base font-bold leading-tight">Gắn Voucher độc quyền
                    </h3>
                    <button class="text-primary text-xs font-bold flex items-center gap-1 hover:underline">
                        <span class="material-symbols-outlined text-sm">add_circle</span> Thêm từ kho Voucher
                    </button>
                </div>
                <div
                    class="flex flex-wrap gap-2 p-4 border border-dashed border-[#cfe7d7] dark:border-gray-700 rounded-xl bg-[#f8fcf9] dark:bg-gray-800/50">
                    <!-- Voucher Chips -->
                    <div
                        class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-full bg-primary/20 border border-primary/30 px-4 group">
                        <p class="text-[#0d1b12] dark:text-white text-xs font-semibold">Giảm 10% vợt Pickleball</p>
                        <button class="text-gray-500 hover:text-red-500">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                    <div
                        class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-full bg-primary/20 border border-primary/30 px-4">
                        <p class="text-[#0d1b12] dark:text-white text-xs font-semibold">Freeship toàn quốc</p>
                        <button class="text-gray-500 hover:text-red-500">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Footer -->
        <div
            class="px-6 py-4 border-t border-gray-200 dark:border-gray-800 flex justify-end items-center gap-3 bg-white dark:bg-background-dark">
            <button 
                class="btn-close-modal px-6 py-2.5 rounded-lg text-gray-600 dark:text-gray-300 font-bold text-sm hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                Hủy bỏ
            </button>
            <button
                class="px-8 py-2.5 bg-primary hover:brightness-95 active:scale-95 text-[#0d1b12] font-extrabold text-sm rounded-lg shadow-lg shadow-primary/20 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">save</span>
                Lưu cấu hình
            </button>
        </div>
    </div>
    <!-- Background Illustration Elements -->
    <div class="fixed top-0 left-0 w-full h-full -z-10 overflow-hidden pointer-events-none opacity-20 dark:opacity-10">
        <div class="absolute top-[-10%] left-[-5%] w-96 h-96 bg-primary rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-96 h-96 bg-primary rounded-full blur-[120px]"></div>
    </div>
</div>

<script>
    $('#btn_modal_add').on('click', function() {
        $('#modal_config').removeAttr('data-edit-id');
        $('#modal_config h2').text('Thêm mã giảm giá mới');
        selectedFile = null;
        $('#modal_config').removeClass('hidden');
        toggleMaxDiscount();
    });

    function closeModal() {
        const modal = $('#modal_config');
        modal.addClass('hidden');
    }

    $(document).on('click', '.btn-close-modal', function() {
        closeModal();
    });

    $('#modal_config').on('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // 3. Nhấn phím Escape (ESC) để đóng
    $(document).on('keydown', function(e) {
        if (e.key === "Escape") {
            closeModal();
        }
    });

</script>
@endsection