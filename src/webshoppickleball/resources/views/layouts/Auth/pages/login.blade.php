@extends('layouts.Auth.master')
@section('content')
<div class="login-container order-2 order-lg-1 d-flex flex-center flex-row-fluid px-7 pt-lg-0 pb-lg-0 pt-4 pb-6 bg-white">
    <!--begin::Wrapper-->
    <div class="login-content d-flex flex-column pt-lg-0 pt-12">
        <!--begin::Logo-->
        <a href="#" class="login-logo pb-xl-20 pb-15">
            <img src="/auth/assets/media/logos/logo-4.png" class="max-h-70px" alt="" />
        </a>
        <!--end::Logo-->
        <!--begin::Signin-->
        <div class="login-form">
            <!--begin::Form-->
            <form class="form" id="kt_login_singin_form" action="">
                <!--begin::Form group-->
                <div id="block_login-modal" class="verify_modal" style="display:none">
                    <div class="verify_content">
                        <h2 id="block_login-text">Thông tin đăng nhập không chính xác</h2>
                        <div class="countdown-box" id="countdownBox">
                            ⏳ Vui lòng chờ: <span id="countdown">1:00</span>
                        </div>
                    </div>
                </div>
                <div id="content-login_form">
                    <!--begin::Title-->
                    <div class="pb-5 pb-lg-15">
                        <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Đăng nhập</h3>
                        <div class="text-muted font-weight-bold font-size-h4">Bạn chưa có tài khoản ?
                            <a href="/register" class="text-primary font-weight-bolder">Đăng ký</a>
                        </div>
                    </div>
                    <!--begin::Title-->
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark">Email <label
                                style="color: red;">*</label></label>
                        <input type="email" id="email" class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" placeholder="Email" value="" />
                        <div class="error" id="email-error"></div>
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div class="mt-n5" style="display: flex;justify-content: space-between;">
                            <label class="font-size-h6 font-weight-bolder text-dark pt-5">Mật khẩu <label
                                    style="color: red;">*</label></label>
                            <a href="/forgot-password" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">Quên mật khẩu ?</a>
                        </div>
                        <input type="password" id="password" class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" placeholder="Mật khẩu" value="" />
                        <div class="error" id="password-error"></div>
                    </div>
                    <!--end::Form group-->
                    <!--begin::Action-->
                    <div class="pb-lg-0 pb-5" style="display: flex;justify-content: space-between;">
                        <div style="display: flex; padding-top: 22.75px;">
                            <button id="login-btn" type="button"
                                style="color: #FFFFFF;
													background-color: #187DE4;
													font-size: 1.175rem;
													font-weight: 600;
													border: none;
													padding: 13px 26px;
													border-radius: 0.42rem;">
                                Đăng nhập
                            </button>
                        </div>
                    </div>
                    <style>
                        .error {
                            color: red;
                            font-size: 0.9em;
                            margin-top: 3px;
                        }
                    </style>
                </div>
                <div id="resendModalLogin" class="verify_modal" style="display: none;">
                    <div class="verify_content">
                        <h2>⏰ Tài khoản chưa kích hoạt</h2>
                        <p>Vui lòng kích hoạt tài khoản.</p>
                        <button id="activateBtn">Kích hoạt</button>
                    </div>
                </div>

                <div id="activationModal" class="verify_modal" style="display:none;">
                    <div class="modal-content">
                        <h2 id="resendText">📩 Xác minh email</h2>
                        <p>Chúng tôi đã gửi email xác minh đến <span style="color: #187DE4;" id="userEmail"></span></p>
                        <p>Vui lòng kiểm tra email để kích hoạt tài khoản.</p>
                        <div class="countdown-box" id="countdownBox">
                            ⏳ Gửi lại sau: <span id="countdown">5:00</span>
                        </div>
                        <button id="resendBtn" style="display: none;">Gửi lại</button>
                    </div>
                </div>
                <!--end::Action-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Signin-->
    </div>
    <!--end::Wrapper-->
</div>


@endsection