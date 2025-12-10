@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div class="flex flex-col items-center gap-4 text-center">
        <div class="flex items-center justify-center size-16 bg-red-100 rounded-full mb-6">
            <span class="material-symbols-outlined text-red-500 text-4xl">close</span>
        </div>
        <div class="flex flex-col items-center gap-2">
            <p
                class="text-2xl sm:text-3xl font-bold leading-tight tracking-[-0.015em] text-slate-900 dark:text-white">
                Thanh toán không thành công</p>
            <p class="text-base font-normal leading-normal text-slate-600 dark:text-slate-300 max-w-md">Đừng lo, chúng
                tôi đã lưu lại giỏ hàng của bạn. Vui lòng kiểm tra lại thông tin thanh toán hoặc thử một phương thức
                khác.</p>
        </div>
    </div>
    <div class="my-8 h-px w-full bg-slate-200 dark:bg-slate-700"></div>
    <div class="flex flex-col items-center gap-6">
        <p class="text-base font-normal leading-normal text-slate-600 dark:text-slate-300 text-center">Mã đơn hàng:
            #PB123456 <br class="sm:hidden" /> <span class="hidden sm:inline-block">|</span> Lý do: Thẻ của bạn đã bị
            từ chối.</p>
        <div class="flex w-full flex-col sm:flex-row gap-3 max-w-md">
            <button
                class="flex flex-1 min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-slate-900 dark:bg-slate-50 text-white dark:text-slate-900 text-base font-bold leading-normal tracking-[0.015em]">
                <span class="truncate">Thử lại thanh toán</span>
            </button>
            <button
                class="flex flex-1 min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary/20 dark:bg-primary/30 text-slate-900 dark:text-white text-base font-bold leading-normal tracking-[0.015em]">
                <span class="truncate">Liên hệ Hỗ trợ</span>
            </button>
        </div>
        <div
            class="w-full max-w-md rounded-xl border border-slate-200 bg-white p-5 dark:border-slate-700 dark:bg-background-dark mt-4">
            <h2 class="text-lg font-bold leading-tight tracking-[-0.015em] text-slate-900 dark:text-white mb-4">Tóm
                tắt đơn hàng</h2>
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <div class="aspect-square w-16 rounded-lg bg-cover bg-center"
                        data-alt="A vibrant green pickleball paddle."
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDNNwNdAwasubWC0gXycu4OKQpsmg8SoLRV73h2icMql9R3iqZrL5-mC87AgNPYPdcKVz6MFXxdGe2RWp84Cn5Vx4qmTUdqfY_UF46A0fPR0fb7Ey9pOzllT-I4s4P476qdw_nIuGbEZxOCHeLd5dc-zKcYwkVRhuYcdrOcZ7NqsgFDnqhvvp511tAgAVJgRgojP-AuQf82c_jr9snKHf6Izb7r_QVLwmKPV6NuXA55nven91okUGcD9ZOsGPQEp6KjtoGvtKrwPj4Y')">
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-slate-800 dark:text-slate-100">Vợt Pickleball Pro</p>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Số lượng: 1</p>
                    </div>
                    <p class="font-semibold text-slate-800 dark:text-slate-100">1.500.000₫</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="aspect-square w-16 rounded-lg bg-cover bg-center"
                        data-alt="A set of three yellow pickleballs."
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDJlk4NLT1o_ZjUAHcToKNjQCD7Dr0GwAbYkc2vuKtudjy5hdK6PIfnKKTTSwd-u1wjVmptRMXUcx5HNR8W87cfe7t2jOIeLirXftgkGHHvhVWNM5d0ClOHkaevLcXVG6ZivNK3zFrYKtE7SPOSTmMRHtxj7ZG8jJX3fQojerFK74jucRFCH0MIkEJSzP1nI55YRuV3dXeH7GO8wGUcZFvej_6xAg_0rhQk30-xOu_V08kbNGikwW8aBYNNRigjVAwEtZXifttXCah0')">
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-slate-800 dark:text-slate-100">Bóng Pickleball (Set 3)</p>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Số lượng: 2</p>
                    </div>
                    <p class="font-semibold text-slate-800 dark:text-slate-100">400.000₫</p>
                </div>
            </div>
            <div class="my-4 h-px w-full bg-slate-200 dark:bg-slate-700"></div>
            <div class="flex justify-between text-base font-bold text-slate-900 dark:text-white">
                <span>Tổng cộng</span>
                <span>1.900.000₫</span>
            </div>
        </div>
    </div>
</div>
@endsection