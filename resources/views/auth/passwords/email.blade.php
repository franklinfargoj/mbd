@extends('frontend.rti.login')
@section('body')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2"
    id="m_login" style="position: relative;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 overlay overlay--login h-100vh">
                <div class="d-flex justify-content-center align-items-center login-page-header">
                    <img class="login-logo" src="{{asset('/img/logo-short.png')}}">
                </div>
            </div>
            <div class="col-sm-6 min-height-100vh">
                <div class="m-grid__item m-grid__item--fluid m-login__wrapper d-flex flex-wrap justify-content-center">
                    <div class="d-flex flex-wrap">
                        <div class="text-center w-100 m-login--left-box">
                            <h4 class="text-uppercase">Mumbai Housing and Area Development Board</h4>
                        </div>
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
                                <form method="POST"  action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <div class="col-sm-12 form-group m-form__group">
                                        <!-- <label for="" class="col-form-label">Email Address</label> -->
                                        <input class="form-control form-control--custom m-input" type="email" placeholder="Email" name="email"
                                            value="{{ old('email') }}" autocomplete="off" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="text-center">

                                    <button type="submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
