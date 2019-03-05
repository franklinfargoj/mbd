@extends('frontend.rti.login')
@section('body')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2"
    id="m_login" style="position: relative;">
<div class="container-fluid">
    <div class="row ">
    <div class="col-sm-6 overlay overlay--login h-100vh">
                <div class="d-flex justify-content-center align-items-center login-page-header">
                    <img class="login-logo" src="{{asset('/img/logo-short.png')}}">
                </div>
        </div>
        <div class="col-sm-6 min-height-100vh mhada-reset-form">
            <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                <div class="d-flex flex-wrap">
                    <div class="text-center w-100 m-login--left-box">
                            <h4 class="text-uppercase"></h4>
                        </div>

                    <!-- body starts here -->
                    <div class="m-login__container m-login--right-box">
                        <div class="m-login__signin m-login__signin--box">
                            <div class="m-login__head">
                                    <h1 class="m-login__title mb-0 display-4">
                                    {{ __('Reset Password') }}
                                    </h1>
                                    <p class="sub-title">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    </p>
                                </div>
                                @if(Session::has('error'))
                                <div class="alert alert-danger alert-block" style="margin-top: 14px;">
                                    <strong>{{Session::get('error')}}</strong>
                                </div>
                                @endif
                                <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group row">
                                    <label for="email" class="col-md-5 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-7">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-5 col-form-label text-md-left">{{ __('Password') }}</label>

                                    <div class="col-md-7">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-5 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-7">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primary">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- body ends here -->


                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
