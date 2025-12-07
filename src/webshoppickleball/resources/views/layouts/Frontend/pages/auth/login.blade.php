
@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8" style="display: flex;justify-content: center;">
    <div class="relative z-10 flex w-full max-w-md flex-col items-center">
        <!-- Login Card -->
        <div
            class="w-full rounded-xl border border-border-light bg-foreground-light p-8 shadow-lg dark:border-border-dark dark:bg-foreground-dark">
            <div class="text-center">
                <h1 class="text-3xl font-bold tracking-tight text-text-light dark:text-text-dark">Đăng nhập</h1>
            </div>
            <form class="mt-8 space-y-6">
                <!-- Email Input -->
                <div>
                    <label class="flex flex-col">
                        <p class="pb-2 text-sm font-medium text-text-light dark:text-text-dark">Email / Tên đăng nhập</p>
                        <input
                            class="form-input h-12 w-full resize-none rounded-lg border border-border-light bg-transparent p-3 text-base text-text-light placeholder:text-placeholder-light focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/40 dark:border-border-dark dark:text-text-dark dark:placeholder:text-placeholder-dark dark:focus:border-primary"
                            placeholder="Nhập email hoặc tên đăng nhập" type="email" value="" />
                    </label>
                </div>
                <!-- Password Input -->
                <div>
                    <label class="flex flex-col">
                        <div class="flex items-center justify-between pb-2">
                            <p class="text-sm font-medium text-text-light dark:text-text-dark">Mật khẩu</p>
                            <a class="text-sm font-medium text-primary hover:underline" href="/quen-mat-khau">Quên mật khẩu?</a>
                        </div>
                        <div class="relative flex w-full items-center">
                            <input
                                class="form-input h-12 w-full resize-none rounded-lg border border-border-light bg-transparent p-3 pr-10 text-base text-text-light placeholder:text-placeholder-light focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/40 dark:border-border-dark dark:text-text-dark dark:placeholder:text-placeholder-dark dark:focus:border-primary"
                                placeholder="Nhập mật khẩu của bạn" type="password" value="" />
                            <button
                                class="absolute right-3 text-text-light/60 hover:text-text-light dark:text-text-dark/60 dark:hover:text-text-dark"
                                type="button">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                        </div>
                    </label>
                </div>
                <!-- Login Button -->
                <button
                    class="flex h-12 w-full cursor-pointer items-center justify-center rounded-lg bg-primary px-4 text-base font-bold text-background-dark transition-opacity hover:opacity-90">
                    <span class="truncate">Đăng nhập</span>
                </button>
            </form>
        </div>
        <!-- Sign Up Link -->
        <p class="mt-8 text-center text-sm text-text-light dark:text-text-dark">
            Chưa có tài khoản?
            <a class="font-bold text-primary hover:underline" href="/dang-ky">Đăng ký ngay</a>
        </p>
    </div>
</div>

@endsection