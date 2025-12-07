@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div
        class="mx-auto bg-surface-light dark:bg-surface-dark rounded-xl shadow-lg border border-border-light dark:border-border-dark p-8 text-center">
        <div class="flex justify-center mb-6">
            <div class="flex items-center justify-center size-20 rounded-full bg-primary/20">
                <span class="material-symbols-outlined text-primary !text-5xl">
                    check_circle
                </span>
            </div>
        </div>
        <h1
            class="text-text-light dark:text-text-dark tracking-tight text-[32px] font-bold leading-tight pb-3">
            Bạn đã đăng xuất tài khoản thành công!</h1>
        <p class="text-text-light dark:text-text-dark/80 text-base font-normal leading-normal pb-8">
            Cảm ơn bạn đã ghé thăm. Hẹn gặp lại bạn sớm!</p>
        <div class="flex justify-center">
            <div class="flex flex-col sm:flex-row flex-1 gap-3 w-full max-w-sm">
                <button id="back_home"
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-text-light text-base font-bold leading-normal tracking-[0.015em] grow">
                    <span class="truncate">Về Trang chủ</span>
                </button>
                <button id="back_login"
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary/20 text-text-light dark:text-text-dark text-base font-bold leading-normal tracking-[0.015em] grow">
                    <span class="truncate">Đăng nhập lại</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#back_home').on('click', function () {
        window.location.href = '/';
    });
    $('#back_login').on('click', function () {
        window.location.href = '/dang-nhap';
    });
</script>
@endsection