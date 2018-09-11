@extends('frontend.layouts.app')
@section('body')
    <div class="m-grid__item m-grid__item--fluid  m-grid__item--order-tablet-and-mobile-1  m-login__wrapper">
        <!--begin::Head-->
        <div class="m-login__head">
            <!-- <span>Don't have an account?</span>
            <a href="#" class="m-link m--font-danger">Sign Up</a> -->
        </div>
        <!--end::Head-->

        <div class="m-login__logo text-center">
            <a href="#">
                <img src="{{asset('assets/app/media/img/logos/mhada-logo.png')}}" width="550">
            </a>
        </div>

        <!--begin::Body-->
        <div class="m-login__body">
            <div class="m-login__signin">
                <!--begin::Signin-->
                <div class="m-login__signin">
                    <div class="m-login__title">
                        <h3>Login</h3>
                    </div>

                    <form method="POST" id="mhadaUser" action="{{ route('loginUser') }}" aria-label="{{ __('Login') }}" class = 'm-login__form m-form'>
                        @csrf

                        @if (Session::has('error'))
                            @php $display = "display:block"; @endphp
                            <span class="invalid-feedback" style="{{ $display }}" role="alert">
                                <strong>{{ Session::get('error') }}</strong>
                            </span>
                        @endif
                        <div class="form-group m-form__group">
                            <!-- <label for="" class="col-form-label">Email Address</label> -->
                            <input class="form-control m-input{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" type="email" value="{{ old('email') }}"  autofocus placeholder="Email" name="email">
                        </div>
                        <div class="form-group m-form__group">
                            <!-- <label for="" class="col-form-label">Email Address</label> -->
                            <input class="form-control m-input{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" type="password"  autofocus placeholder="Password" name="password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif

                        </div>
                        <div class="form-group m-form__group"  style="margin-top: 16px;">
                            <span class="captcha_img" style="padding: 19px;"> {!! captcha_img() !!}</span>
                            <i class="fa fa-refresh btn_refresh" title="Recapture" aria-hidden="true" style="font-size: 24px;cursor: pointer;"></i>

                            <input type="text" id="captcha" class="form-control" name="captcha" placeholder="Enter Captcha">
                            @if($errors->has('captcha'))
                                <span class="help-block" style="padding: 16px;color: red;">Invalid Captcha </span>
                            @endif
                        </div>



                        <!--begin::Action-->
                        <div class="m-login__action">
                            <a href="#">
                                <button type="submit" id="mhada-user" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">{{ __('Login') }}</button>
                            </a>
                            {{--<a href="{{ route('password.request') }}" class="btn btn-link">
                                {{ __('Forgot Your Password?') }}
                            </a>--}}
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
@endsection
