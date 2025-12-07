@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8" style="display: flex;justify-content: center;">
    <div class="w-full max-w-md space-y-8">
        <!-- PageHeading -->
        <div class="flex flex-col gap-3 text-center">
            <p class="text-text-light dark:text-text-dark text-4xl font-black leading-tight tracking-[-0.033em]">Bạn quên mật khẩu?</p>
            <p class="text-text-muted-light dark:text-text-muted-dark text-base font-normal leading-normal">Vui lòng nhập
                email của bạn. Chúng tôi sẽ gửi mã OTP để đặt lại mật khẩu.</p>
        </div>
        <div class="flex flex-col gap-6">
            <!-- TextField with Icon -->
            <div class="flex flex-col">
                <label class="text-text-light dark:text-text-dark text-base font-medium leading-normal pb-2" for="email">Địa
                    chỉ Email</label>
                <div class="relative">
                    <span
                        class="material-symbols-outlined pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-text-muted-light dark:text-text-muted-dark">mail</span>
                    <input
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-background-light dark:focus:ring-offset-background-dark border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark/50 h-14 placeholder:text-text-muted-light dark:placeholder:text-text-muted-dark p-4 pl-12 text-base font-normal leading-normal transition-shadow"
                        id="email" placeholder="example@email.com" type="email" />
                </div>
            </div>
            <!-- SingleButton -->
            <div class="flex">
                <button
                    class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 flex-1 bg-primary text-text-light text-base font-bold leading-normal tracking-[0.015em] hover:bg-opacity-90 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 focus-visible:ring-offset-background-light dark:focus-visible:ring-offset-background-dark">
                    <span class="truncate">Xác minh</span>
                </button>
            </div>
            <!-- MetaText -->
            <p class="text-text-muted-light dark:text-text-muted-dark text-sm font-normal leading-normal text-center">
                Nhớ mật khẩu? <a class="font-medium text-primary/80 hover:text-primary underline" href="#">Quay lại đăng
                    nhập</a>
            </p>
        </div>
    </div>
</div>

@endsection