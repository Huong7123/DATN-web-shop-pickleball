@extends('layouts.Auth.master')
@section('content')
<div class="login-container d-flex flex-center flex-row flex-row-fluid order-2 order-lg-1 flex-row-fluid bg-white py-lg-0 pb-lg-0 pt-15 pb-12">
    <!--begin::Container-->
    <div class="login-content login-content-signup d-flex flex-column">
        <!--begin::Aside Top-->
        <div class="d-flex flex-column-auto flex-column px-10">
            <!--begin::Aside header-->
            <a href="#" class="login-logo pb-lg-4 pb-10">
                <img src="/auth/assets/media/logos/logo-4.png" class="max-h-70px" alt="" />
            </a>
            <!--end::Aside header-->
            <!--begin: Wizard Nav-->
            <div class="wizard-nav pt-5 pt-lg-15 pb-10">
                <!--begin::Wizard Steps-->
                <div class="wizard-steps d-flex flex-column flex-sm-row">
                    <!--begin::Wizard Step 1 Nav-->
                    <div class="wizard-step flex-grow-1 flex-basis-0" data-wizard-type="step"
                        data-wizard-state="current">
                        <div class="wizard-wrapper pr-7">
                            <div id="focus-step1" class="wizard-icon">
                                <i class="wizard-check ki ki-check"></i>
                                <span id="focus-step1-span" class="wizard-number">1</span>
                            </div>
                            <div class="wizard-label">
                                <h3 class="wizard-title">Đăng ký</h3>
                                <div class="wizard-desc">Điền thông tin</div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Step 1 Nav-->
                    <!--begin::Wizard Step 2 Nav-->
                    <div class="wizard-step flex-grow-1 flex-basis-0" data-wizard-type="step">
                        <div class="wizard-wrapper pr-7">
                            <div id="focus-step2" class="wizard-icon">
                                <span id="focus-step2-span" class="wizard-number">2</span>
                            </div>
                            <div class="wizard-label">
                                <h3 class="wizard-title">Kích hoạt</h3>
                                <div class="wizard-desc">Kiểm tra email</div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Step 2 Nav-->

                </div>
                <!--end::Wizard Steps-->
            </div>
            <!--end: Wizard Nav-->
        </div>
        <!--end::Aside Top-->
        <!--begin::Signin-->
        <div class="login-form">
            <!--begin::Form-->
            <form class="form px-10" novalidate="novalidate" id="kt_login_signup_form">
                <!--begin: Wizard Step 1-->
                <div id="step-content-1" class="" data-wizard-type="step-content" data-wizard-state="current">
                    <!--begin::Title-->
                    <div class="pb-10 pb-lg-12">
                        <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Đăng ký tài
                            khoản</h3>
                        <div class="text-muted font-weight-bold font-size-h4">Bạn đã có tài khoản ?
                            <a href="/login"
                                class="text-primary font-weight-bolder">Đăng nhập</a>
                        </div>
                    </div>
                    <!--begin::Title-->
                    <!--begin::Form Group-->
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark">Họ và tên</label> <label
                            style="color: red;">*</label>
                        <input id="name" type="text"
                            class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" placeholder="Họ và tên" value="" />
                        <div class="error" id="name-error"></div>
                    </div>
                    <!--end::Form Group-->
                    <!--begin::Form Group-->
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark">Số điện thoại</label>
                        <label style="color: red;">*</label>
                        <input id="phone" type="text"
                            class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" placeholder="Số điện thoại" value="" />
                        <div class="error" id="phone-error"></div>
                    </div>
                    <!--end::Form Group-->
                    <!--begin::Form Group-->
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark">Email</label> <label
                            style="color: red;">*</label>
                        <input id="email" type="email"
                            class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" placeholder="Email" value="" />
                        <div class="error" id="email-error"></div>
                    </div>
                    <!--end::Form Group-->
                    <!--begin::Form Group-->
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark">Mật khẩu</label> <label
                            style="color: red;">*</label>
                        <input id="password" type="password"
                            class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" placeholder="Mật khẩu" value="" />
                        <div class="error" id="password-error"></div>
                    </div>
                    <!--end::Form Group-->
                    <!--begin::Form Group-->
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark">Xác nhận mật khẩu</label>
                        <label style="color: red;">*</label>
                        <input id="confirmPassword" type="password"
                            class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" placeholder="Xác nhận mật khẩu" value="" />
                        <div class="error" id="password_confirmation-error"></div>
                    </div>
                    <style>
                        .error {
                            color: red;
                            font-size: 0.9em;
                            margin-top: 3px;
                        }
                    </style>
                    <!--end::Form Group-->
                </div>
                <!--end: Wizard Step 1-->
                <!--begin: Wizard Step 2-->
                <!--end: Wizard Step 2-->
                <!--begin: Wizard Actions-->
                <div style="display: flex; padding-top: 22.75px;">
                    <button id="register-btn" type="button"
                        style="color: #FFFFFF;
                                background-color: #187DE4;
                                font-size: 1.175rem;
                                font-weight: 600;
                                border: none;
                                padding: 13px 26px;
                                border-radius: 0.42rem;">
                        Đăng ký
                    </button>
                </div>

                <!--end: Wizard Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Signin-->
    </div>
    <!--end::Container-->
</div>

@endsection