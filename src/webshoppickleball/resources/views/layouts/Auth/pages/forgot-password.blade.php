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
        <div id="content-forgot" class="login-form">
            <form class="form" id="kt_login_forgot_form" action="">
                <!--begin::Title-->
                <div class="pb-5 pb-lg-15">
                    <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Bạn quên mật khẩu ?</h3>
                    <p class="text-muted font-weight-bold font-size-h4">Vui lòng điền email của bạn !</p>
                </div>
                <!--end::Title-->
                <!--begin::Form group-->
                <div class="form-group">
                    <label class="font-size-h6 font-weight-bolder text-dark">Email</label> <label style="color: red;">*</label>
                    <input id="email" type="email"
                        class="form-control form-control-solid h-auto py-7 px-6 border-0 rounded-lg font-size-h6" placeholder="Email" value="" />
                    <div class="error" id="email-error"></div>
                </div>

                <!--end::Form group-->
                <!--begin::Form group-->
                <div style="display: flex; padding-top: 22.75px;">
                    <button id="forgot-btn" type="button"
                        style="color: #FFFFFF;
                            background-color: #187DE4;
                            font-size: 1.175rem;
                            font-weight: 600;
                            border: none;
                            padding: 13px 26px;
                            border-radius: 0.42rem;">
                        Tiếp tục
                    </button>
                </div>
                <!--end::Form group-->
            </form>
        </div>

        <style>
            .error {
                color: red;
                font-size: 0.9em;
                margin-top: 3px;
            }
        </style>
        <!--end::Signin-->
    </div>
    <!--end::Wrapper-->
</div>
@endsection