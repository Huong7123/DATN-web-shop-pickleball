@extends('layouts.Frontend.master')
@section('title', $title)
@section('content')
<div class="@container px-4 sm:px-6 lg:px-10 py-8">
    <div class="mb-8">
        <div class="flex flex-wrap items-center gap-2 text-sm">
            <a class="text-subtle-light dark:text-subtle-dark font-medium" href="#">Trang chủ</a>
            <span class="text-subtle-light dark:text-subtle-dark">/</span>
            <a class="text-subtle-light dark:text-subtle-dark font-medium" href="#">Giỏ hàng</a>
            <span class="text-subtle-light dark:text-subtle-dark">/</span>
            <span class="font-medium">Thanh toán</span>
        </div>
    </div>
    <div class="flex flex-col-reverse gap-12 lg:flex-row">
        <!-- Left Column: Checkout Process -->
        <div class="w-full lg:w-3/5">
            <div class="mb-8">
                <p class="text-4xl font-black tracking-tighter">Thanh toán</p>
                <p class="text-subtle-light dark:text-subtle-dark mt-2">Vui lòng hoàn tất các thông tin dưới đây để đặt
                    hàng.</p>
            </div>
            <div class="space-y-10">
                <!-- Shipping Information -->
                <section>
                    <h2 class="text-2xl font-bold tracking-tight">1. Thông tin giao hàng</h2>
                    <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-medium">Họ và tên</label>
                            <input
                                class="form-input block h-14 w-full rounded-lg border border-border-light bg-background-light p-4 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark dark:placeholder:text-subtle-dark"
                                placeholder="Nguyễn Văn A" type="text" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium">Số điện thoại</label>
                            <input
                                class="form-input block h-14 w-full rounded-lg border border-border-light bg-background-light p-4 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark dark:placeholder:text-subtle-dark"
                                placeholder="090 xxx xxxx" type="tel" />
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-2 block text-sm font-medium">Email</label>
                            <input
                                class="form-input block h-14 w-full rounded-lg border border-border-light bg-background-light p-4 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark dark:placeholder:text-subtle-dark"
                                placeholder="your.email@example.com" type="email" />
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-2 block text-sm font-medium">Địa chỉ</label>
                            <input
                                class="form-input block h-14 w-full rounded-lg border border-border-light bg-background-light p-4 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark dark:placeholder:text-subtle-dark"
                                placeholder="Số nhà, tên đường" type="text" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium">Tỉnh/Thành phố</label>
                            <input
                                class="form-input block h-14 w-full rounded-lg border border-border-light bg-background-light p-4 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark dark:placeholder:text-subtle-dark"
                                placeholder="e.g. TP. Hồ Chí Minh" type="text" />
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium">Quận/Huyện</label>
                            <input
                                class="form-input block h-14 w-full rounded-lg border border-border-light bg-background-light p-4 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark dark:placeholder:text-subtle-dark"
                                placeholder="e.g. Quận 1" type="text" />
                        </div>
                    </div>
                    <div class="mt-6 flex items-center">
                        <input
                            class="form-checkbox h-4 w-4 rounded border-border-light text-primary focus:ring-primary/50 dark:border-border-dark dark:bg-background-dark"
                            id="save-info" type="checkbox" />
                        <label class="ml-2 text-sm" for="save-info">Lưu thông tin cho lần mua hàng sau</label>
                    </div>
                </section>
                <!-- Shipping Method -->
                <section>
                    <h2 class="text-2xl font-bold tracking-tight">2. Phương thức vận chuyển</h2>
                    <div class="mt-6 space-y-4">
                        <label
                            class="flex cursor-pointer items-center rounded-lg border border-border-light p-4 has-[:checked]:border-primary has-[:checked]:bg-primary/10 dark:border-border-dark dark:has-[:checked]:border-primary">
                            <input checked="" class="form-radio h-5 w-5 text-primary" name="shipping" type="radio" />
                            <div class="ml-4 flex flex-grow items-center justify-between">
                                <div>
                                    <p class="font-medium">Giao hàng nhanh</p>
                                    <p class="text-sm text-subtle-light dark:text-subtle-dark">Dự kiến 1-2 ngày</p>
                                </div>
                                <p class="font-semibold">30.000đ</p>
                            </div>
                        </label>
                        <label
                            class="flex cursor-pointer items-center rounded-lg border border-border-light p-4 has-[:checked]:border-primary has-[:checked]:bg-primary/10 dark:border-border-dark dark:has-[:checked]:border-primary">
                            <input class="form-radio h-5 w-5 text-primary" name="shipping" type="radio" />
                            <div class="ml-4 flex flex-grow items-center justify-between">
                                <div>
                                    <p class="font-medium">Giao hàng tiêu chuẩn</p>
                                    <p class="text-sm text-subtle-light dark:text-subtle-dark">Dự kiến 3-5 ngày</p>
                                </div>
                                <p class="font-semibold">15.000đ</p>
                            </div>
                        </label>
                    </div>
                </section>
                <!-- Payment Method -->
                <section>
                    <h2 class="text-2xl font-bold tracking-tight">3. Phương thức thanh toán</h2>
                    <div class="mt-6 space-y-4">
                        <div class="rounded-lg border border-border-light dark:border-border-dark">
                            <label class="flex cursor-pointer items-center p-4">
                                <input checked="" class="form-radio h-5 w-5 text-primary" name="payment" type="radio" />
                                <span class="ml-4 font-medium">Thẻ tín dụng / Ghi nợ</span>
                            </label>
                            <div
                                class="border-t border-border-light bg-background-light p-4 dark:border-border-dark dark:bg-background-dark/50">
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm">Số thẻ</label>
                                        <input
                                            class="form-input block h-12 w-full rounded-lg border border-border-light bg-background-light p-3 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark"
                                            placeholder="•••• •••• •••• ••••" />
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm">Họ tên trên thẻ</label>
                                        <input
                                            class="form-input block h-12 w-full rounded-lg border border-border-light bg-background-light p-3 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark"
                                            placeholder="NGUYEN VAN A" />
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm">Ngày hết hạn (MM/YY)</label>
                                        <input
                                            class="form-input block h-12 w-full rounded-lg border border-border-light bg-background-light p-3 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark"
                                            placeholder="MM/YY" />
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm">Mã bảo mật (CVV)</label>
                                        <input
                                            class="form-input block h-12 w-full rounded-lg border border-border-light bg-background-light p-3 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark"
                                            placeholder="•••" />
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center justify-end gap-2">
                                    <img alt="Visa" class="h-6"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCFPKUTQ40K1cFjcTfG--z6pyOWhi9CNHlHwkrH3hWzm0s8VdSDOLwV0vemFbQ2QM73DF-n4VdgNv-E8tNZmkkMbakLZlyGki6xSzWA4Lz4kgUl3IzL8flPKVsQRiLyPmWJeJc3hyOqmT6RAtHJ8pNAm1yaAwWTin3-V3S_Ygl84PrQv2TNLa_Q4eQI4ZIkHz2Or0gDNtL_l88M9W5i3Gj8f4bNwLitLFDgEhu-7gEGMRKOGHAUXgvhKXXbsaqDYU8dRtB7ZF23ilOi" />
                                    <img alt="Mastercard" class="h-6"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuD5EcCET8W_tJjXROt9Tfr1kjXJPNL1fUrtG9CWIf0UOu3WU7g1MfV5RB4u85K1kAmIUq7vTLBZDjlD5IBDbXaErSSn2hylznfqokAcjApE8wezwQoBaUp6liqteB4LF8Lw8gLSak3TCJJlSH2lJM4xS1agGLm6inYRMNcf9fDjEPmyc1xfPlxb-5WiILhJcpuCrnvvYxVpl8bKknf0sNWF3qm2nMDfrmK67-lC9LQREVq2oSM7qRjJxXzkh99h0VsICzclTUw98HQX" />
                                    <img alt="JCB" class="h-6"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDiPY0w3EiveqWTd1gXIyd-Hvr1bpMK8VVlwI_bi7RdFMeHujf6GmyvUKLiYZrjHFezapL4FZ-3YjYNpJ44hwsVevLKNUtmG263tssUVt3DdkwuCfbY816AC5S3yHbejna_73pT3YW9n5tYW99y3TfxZWyQP8JlMgOCid71trd2rO4sHtm7Wc0UbCr1HyWXLmSKDzaSxGdGz6Sg6TSCdZL9E4czrBeNoqr8epIOT7gFUqsjRJ7tntWXWjYZbawaT7IF7S0jJoPUe8he" />
                                </div>
                            </div>
                        </div>
                        <label
                            class="flex cursor-pointer items-center rounded-lg border border-border-light p-4 has-[:checked]:border-primary has-[:checked]:bg-primary/10 dark:border-border-dark dark:has-[:checked]:border-primary">
                            <input class="form-radio h-5 w-5 text-primary" name="payment" type="radio" />
                            <span class="ml-4 font-medium">Ví điện tử (Momo, ZaloPay)</span>
                        </label>
                        <label
                            class="flex cursor-pointer items-center rounded-lg border border-border-light p-4 has-[:checked]:border-primary has-[:checked]:bg-primary/10 dark:border-border-dark dark:has-[:checked]:border-primary">
                            <input class="form-radio h-5 w-5 text-primary" name="payment" type="radio" />
                            <span class="ml-4 font-medium">Chuyển khoản ngân hàng</span>
                        </label>
                    </div>
                </section>
            </div>
        </div>
        <!-- Right Column: Order Summary -->
        <div class="w-full lg:w-2/5">
            <div
                class="sticky top-24 rounded-lg border border-border-light bg-white p-6 shadow-sm dark:border-border-dark dark:bg-background-dark">
                <h2 class="text-2xl font-bold tracking-tight">Đơn hàng của bạn</h2>
                <div class="mt-6 space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="relative h-20 w-20 flex-shrink-0">
                            <img class="h-full w-full rounded-lg object-cover"
                                data-alt="A yellow pickleball paddle against a green background."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCNjo9cGfFMeoemnAvfsda-aOFqtu2TY9Krs3CpmkTdsrntQxAcFS67-ccgAC0Nr1A3jATo52AiMKpRqvEEYg_BexgkEjGhn0dZkA5-2ib5Mq0Jfz6hNkUrX9BmEHewJ2EFAF5r4lvr1xU_XkMPbUkn3GGvzfVobXcQEl4xNAyjKt0HQl4I5-wY2OIPR0RAzAUx-1xij08BJOiSlxTZUU2rxnDdv_eRXjin_fpY3J9vUr517KgFH4WjQPu8uJ6hKXyPly4VZCdzeQtf" />
                            <span
                                class="absolute -right-2 -top-2 flex h-6 w-6 items-center justify-center rounded-full bg-primary text-xs font-bold text-background-dark">2</span>
                        </div>
                        <div class="flex-grow">
                            <p class="font-medium">Vợt Pickleball Pro-X</p>
                            <p class="text-sm text-subtle-light dark:text-subtle-dark">Màu: Xanh lá</p>
                        </div>
                        <p class="font-semibold">2.400.000đ</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="relative h-20 w-20 flex-shrink-0">
                            <img class="h-full w-full rounded-lg object-cover" data-alt="A close-up of a bright green pickleball."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBXoP81sIxWSp21GyCcFYetGMtWf65jc1gguVbUNWHbWIgDnwmdGFVflSxiMLbgDtVKFGaCvxhhddhnx-3qHgGjP_4SnaWXiTkeBm_XXUH8N6pZEfSDDaOpUqGqeoZJfucAUpmTiQrmfjbmrYmbrELZKGMJfykkzCcf815vKdGwI6wN47iHZ0j9uxxG2b_DYjwq-ft45jSlp3JBeYsSMjcFS92nhdBiqD8OBG-ru-roXe4iriOaSLbS0WUfyC3-jqQJN_fDfpzzNbRv" />
                            <span
                                class="absolute -right-2 -top-2 flex h-6 w-6 items-center justify-center rounded-full bg-primary text-xs font-bold text-background-dark">1</span>
                        </div>
                        <div class="flex-grow">
                            <p class="font-medium">Bộ 3 Bóng PicklePro</p>
                        </div>
                        <p class="font-semibold">150.000đ</p>
                    </div>
                </div>
                <div class="my-6 border-t border-border-light dark:border-border-dark"></div>
                <div class="flex items-end gap-3">
                    <div class="flex-grow">
                        <label class="mb-2 block text-sm font-medium">Mã giảm giá</label>
                        <input
                            class="form-input block h-12 w-full rounded-lg border border-border-light bg-background-light px-3 placeholder:text-subtle-light dark:border-border-dark dark:bg-background-dark/50"
                            placeholder="Nhập mã" />
                    </div>
                    <button
                        class="h-12 shrink-0 rounded-lg bg-primary/20 px-5 font-bold text-text-light dark:text-text-dark">Áp
                        dụng</button>
                </div>
                <div class="my-6 border-t border-border-light dark:border-border-dark"></div>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-subtle-light dark:text-subtle-dark">Tạm tính</span>
                        <span>2.550.000đ</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-subtle-light dark:text-subtle-dark">Phí vận chuyển</span>
                        <span>30.000đ</span>
                    </div>
                    <div class="flex justify-between font-medium text-primary">
                        <span class="text-primary">Giảm giá</span>
                        <span>-50.000đ</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold">
                        <span>Tổng cộng</span>
                        <span>2.530.000đ</span>
                    </div>
                </div>
                <button
                    class="mt-8 h-14 w-full rounded-lg bg-primary text-lg font-bold text-background-dark shadow-lg shadow-primary/20">
                    Hoàn tất đơn hàng
                </button>
            </div>
        </div>
    </div>
</div>
@endsection