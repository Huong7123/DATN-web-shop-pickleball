@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8" style="display: flex;justify-content: center;">
    <div class="w-full max-w-lg space-y-8">
        <div class="text-center">
            <h1 class="text-[#0d1b12] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Đặt Lại Mật
                Khẩu</h1>
            <p class="mt-3 text-base font-normal leading-normal text-gray-500 dark:text-gray-400">Vui lòng nhập mật khẩu
                mới và mã xác thực đã được gửi đến email của bạn.</p>
        </div>
        <form action="#" class="mt-8 space-y-6" method="POST">
            <div
                class="space-y-6 rounded-lg bg-white dark:bg-background-dark/50 p-6 md:p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                <label class="flex flex-col flex-1">
                    <p class="text-[#0d1b12] dark:text-gray-200 text-base font-medium leading-normal pb-2">Mật khẩu mới</p>
                    <div class="relative flex w-full flex-1 items-stretch">
                        <input
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d1b12] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-gray-800 h-12 placeholder:text-gray-400 p-3 text-base font-normal leading-normal"
                            placeholder="Nhập mật khẩu mới của bạn" type="password" value="" />
                        <button
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200"
                            type="button">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Mật khẩu bao gồm 8 ký tự trở lên, chữ hoa, chữ thường, số &amp; ký hiệu đặc biệt.</p>
                </label>
                <label class="flex flex-col flex-1">
                    <p class="text-[#0d1b12] dark:text-gray-200 text-base font-medium leading-normal pb-2">Xác nhận mật khẩu
                        mới</p>
                    <div class="relative flex w-full flex-1 items-stretch">
                        <input
                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#0d1b12] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-gray-800 h-12 placeholder:text-gray-400 p-3 text-base font-normal leading-normal"
                            placeholder="Nhập lại mật khẩu mới của bạn" type="password" value="" />
                        <button
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200"
                            type="button">
                            <span class="material-symbols-outlined">visibility_off</span>
                        </button>
                    </div>
                </label>
                <div>
                    <p class="text-[#0d1b12] dark:text-gray-200 text-base font-medium leading-normal text-center pb-2">Mã xác
                        thực (OTP)</p>
                    <fieldset class="relative flex justify-center gap-2 sm:gap-4">
                        <input
                            class="flex h-14 w-12 text-center text-lg font-bold [appearance:textfield] focus:outline-0 focus:ring-2 focus:ring-primary/50 [&amp;::-webkit-inner-spin-button]:appearance-none [&amp;::-webkit-outer-spin-button]:appearance-none rounded-lg border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-gray-800"
                            max="9" maxlength="1" min="0"
                            onkeydown="javascript:(event.key=='Backspace'&amp;&amp;this.value===''&amp;&amp;this.previousSibling&amp;&amp;((this.previousSibling.value=''),this.previousSibling.focus()))||(event.key==='ArrowLeft'&amp;&amp;this.previousSibling&amp;&amp;this.previousSibling.focus())||(event.key==='ArrowRight'&amp;&amp;this.nextSibling&amp;&amp;this.nextSibling.focus());"
                            onkeyup="javascript:event.key.match(/^\d$/)&amp;&amp;((this.value.length&gt;1&amp;&amp;((this.nextSibling&amp;&amp;(this.nextSibling.value=this.value.slice(1))),(this.value=this.value[0]))),(this.nextSibling&amp;&amp;this.nextSibling.focus()));"
                            type="number" value="" />
                        <input
                            class="flex h-14 w-12 text-center text-lg font-bold [appearance:textfield] focus:outline-0 focus:ring-2 focus:ring-primary/50 [&amp;::-webkit-inner-spin-button]:appearance-none [&amp;::-webkit-outer-spin-button]:appearance-none rounded-lg border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-gray-800"
                            max="9" maxlength="1" min="0"
                            onkeydown="javascript:(event.key=='Backspace'&amp;&amp;this.value===''&amp;&amp;this.previousSibling&amp;&amp;((this.previousSibling.value=''),this.previousSibling.focus()))||(event.key==='ArrowLeft'&amp;&amp;this.previousSibling&amp;&amp;this.previousSibling.focus())||(event.key==='ArrowRight'&amp;&amp;this.nextSibling&amp;&amp;this.nextSibling.focus());"
                            onkeyup="javascript:event.key.match(/^\d$/)&amp;&amp;((this.value.length&gt;1&amp;&amp;((this.nextSibling&amp;&amp;(this.nextSibling.value=this.value.slice(1))),(this.value=this.value[0]))),(this.nextSibling&amp;&amp;this.nextSibling.focus()));"
                            type="number" value="" />
                        <input
                            class="flex h-14 w-12 text-center text-lg font-bold [appearance:textfield] focus:outline-0 focus:ring-2 focus:ring-primary/50 [&amp;::-webkit-inner-spin-button]:appearance-none [&amp;::-webkit-outer-spin-button]:appearance-none rounded-lg border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-gray-800"
                            max="9" maxlength="1" min="0"
                            onkeydown="javascript:(event.key=='Backspace'&amp;&amp;this.value===''&amp;&amp;this.previousSibling&amp;&amp;((this.previousSibling.value=''),this.previousSibling.focus()))||(event.key==='ArrowLeft'&amp;&amp;this.previousSibling&amp;&amp;this.previousSibling.focus())||(event.key==='ArrowRight'&amp;&amp;this.nextSibling&amp;&amp;this.nextSibling.focus());"
                            onkeyup="javascript:event.key.match(/^\d$/)&amp;&amp;((this.value.length&gt;1&amp;&amp;((this.nextSibling&amp;&amp;(this.nextSibling.value=this.value.slice(1))),(this.value=this.value[0]))),(this.nextSibling&amp;&amp;this.nextSibling.focus()));"
                            type="number" value="" />
                        <input
                            class="flex h-14 w-12 text-center text-lg font-bold [appearance:textfield] focus:outline-0 focus:ring-2 focus:ring-primary/50 [&amp;::-webkit-inner-spin-button]:appearance-none [&amp;::-webkit-outer-spin-button]:appearance-none rounded-lg border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-gray-800"
                            max="9" maxlength="1" min="0"
                            onkeydown="javascript:(event.key=='Backspace'&amp;&amp;this.value===''&amp;&amp;this.previousSibling&amp;&amp;((this.previousSibling.value=''),this.previousSibling.focus()))||(event.key==='ArrowLeft'&amp;&amp;this.previousSibling&amp;&amp;this.previousSibling.focus())||(event.key==='ArrowRight'&amp;&amp;this.nextSibling&amp;&amp;this.nextSibling.focus());"
                            onkeyup="javascript:event.key.match(/^\d$/)&amp;&amp;((this.value.length&gt;1&amp;&amp;((this.nextSibling&amp;&amp;(this.nextSibling.value=this.value.slice(1))),(this.value=this.value[0]))),(this.nextSibling&amp;&amp;this.nextSibling.focus()));"
                            type="number" value="" />
                        <input
                            class="flex h-14 w-12 text-center text-lg font-bold [appearance:textfield] focus:outline-0 focus:ring-2 focus:ring-primary/50 [&amp;::-webkit-inner-spin-button]:appearance-none [&amp;::-webkit-outer-spin-button]:appearance-none rounded-lg border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-gray-800"
                            max="9" maxlength="1" min="0"
                            onkeydown="javascript:(event.key=='Backspace'&amp;&amp;this.value===''&amp;&amp;this.previousSibling&amp;&amp;((this.previousSibling.value=''),this.previousSibling.focus()))||(event.key==='ArrowLeft'&amp;&amp;this.previousSibling&amp;&amp;this.previousSibling.focus())||(event.key==='ArrowRight'&amp;&amp;this.nextSibling&amp;&amp;this.nextSibling.focus());"
                            onkeyup="javascript:event.key.match(/^\d$/)&amp;&amp;((this.value.length&gt;1&amp;&amp;((this.nextSibling&amp;&amp;(this.nextSibling.value=this.value.slice(1))),(this.value=this.value[0]))),(this.nextSibling&amp;&amp;this.nextSibling.focus()));"
                            type="number" value="" />
                        <input
                            class="flex h-14 w-12 text-center text-lg font-bold [appearance:textfield] focus:outline-0 focus:ring-2 focus:ring-primary/50 [&amp;::-webkit-inner-spin-button]:appearance-none [&amp;::-webkit-outer-spin-button]:appearance-none rounded-lg border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-gray-800"
                            max="9" maxlength="1" min="0"
                            onkeydown="javascript:(event.key=='Backspace'&amp;&amp;this.value===''&amp;&amp;this.previousSibling&amp;&amp;((this.previousSibling.value=''),this.previousSibling.focus()))||(event.key==='ArrowLeft'&amp;&amp;this.previousSibling&amp;&amp;this.previousSibling.focus())||(event.key==='ArrowRight'&amp;&amp;this.nextSibling&amp;&amp;this.nextSibling.focus());"
                            onkeyup="javascript:event.key.match(/^\d$/)&amp;&amp;((this.value.length&gt;1&amp;&amp;((this.nextSibling&amp;&amp;(this.nextSibling.value=this.value.slice(1))),(this.value=this.value[0]))),(this.nextSibling&amp;&amp;this.nextSibling.focus()));"
                            type="number" value="" />
                    </fieldset>
                </div>
            </div>
            <div class="text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400">Không nhận được mã? <a
                        class="font-medium text-primary/80 hover:text-primary" href="#">Gửi lại mã</a></p>
            </div>
            <div>
                <button
                    class="group relative flex w-full justify-center rounded-lg bg-primary py-3 px-4 text-base font-bold text-[#0d1b12] hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-background-dark"
                    type="submit">
                    Cập Nhật Mật Khẩu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection