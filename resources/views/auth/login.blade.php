@extends('frontend.rti.login')
@section('body')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2"
    id="m_login" style="position: relative;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 overlay overlay--login h-100vh">
                <div class="d-flex justify-content-center align-items-center login-page-header">
                    <img class="login-logo" src="{{asset('assets/app/media/img/logos/mhada-logo.png')}}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                    <div class="d-flex justify-content-center align-items-center login-page-header login-page-header--text text-uppercase">
                        <h3>Mumbai Board</h3>
                    </div>
                    <div class="d-flex h-100 justify-content-center align-items-center">
                        <div class="m-login__container">
                            <div class="m-login__signin">
                                <div class="m-login__head">
                                    <h1 class="m-login__title mb-0 display-4">
                                        Sign In
                                    </h1>
                                    <p class="sub-title">
                                        @if (session('registered'))
                                        <div class="alert alert-success">
                                            <center>{{ session('registered') }}</center>
                                        </div>
                                        @endif
                                    </p>
                                </div>
                                @if(Session::has('error'))
                                <div class="alert alert-danger alert-block" style="margin-top: 14px;">
                                    <strong>{{Session::get('error')}}</strong>
                                </div>
                                @endif
                                <form class="m-login__form m-form" id="mhadaUser" name="sign_in_form" method="post"
                                    action="{{route('loginUser')}}">
                                    @csrf
                                    <div class="form-group m-form__group">
                                        <!-- <label for="" class="col-form-label">Email Address</label> -->
                                        <input class="form-control m-input" type="email" placeholder="Email" name="email"
                                            value="{{ old('email') }}" autocomplete="off">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <!-- <label for="" class="col-form-label">Password</label> -->
                                        <input class="form-control m-input" type="password" placeholder="Password"
                                            name="password" autocomplete="off">
                                    </div>
                                    <div class="form-group m-form__group" style="margin-top: 16px;">
                                        <span style="padding: 19px;"> <img id="captcha_img" src="{{URL::to('captcha')}}"></span>
                                        <div class="d-inline-table align-middle line-height-1">
                                            <i class="fa fa-refresh" onclick="document.getElementById('captcha_img').src='{{ URL::to('captcha') }}'; return false"
                                                title="Recapture" aria-hidden="true" style="font-size: 24px;cursor: pointer;"></i>
                                        </div>
                                        <input type="text" id="captcha" class="form-control" name="captcha"
                                            placeholder="Enter Captcha">
                                        @if($errors->has('captcha'))
                                        <span class="help-block" style="padding: 16px;color: red;">Invalid Captcha
                                        </span>
                                        @endif
                                    </div>
                                    {{--<div class="row m-login__form-sub">
                                        <div class="col m--align-right m-login__form-right">
                                            <a href="javascript:;" id="m_login_forget_password" class="m-link">
                                                Forget Password ?
                                            </a>
                                        </div>
                                    </div>--}}
                                    <div class="m-login__form-action">
                                        <button id="mhada-user" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primary">
                                            Sign In
                                        </button>
                                    </div>
                                </form>
                            </div>

                            {{--<div class="m-login__forget-password">
                                <div class="m-login__head">
                                    <h1 class="m-login__title mb-0 display-4">
                                        Forgotten Password ?
                                    </h1>
                                </div>
                                <form class='m-login__form m-form' id='society_forgot_password_form' method="post"
                                    action="{{ route('society_offer_letter_forgot_password') }}">
                                    @csrf
                                    <div class="form-group m-form__group">
                                        <!-- <label for="" class="col-form-label">Enter your email to reset your password :</label> -->
                                        <input class="form-control m-input" type="email" placeholder="Email Address"
                                            name="society_email">
                                    </div>
                                    <div class="m-login__form-action">
                                        <button id="m_login_forget_password_submit_society_offer_letter" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primaryr">
                                            Request
                                        </button>
                                        &nbsp;&nbsp;
                                        <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">
                                            <i class="la la-close"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
