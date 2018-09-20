@extends('frontend.layouts.app')
@section('body')
<div class="m-grid__item m-grid__item--fluid  m-grid__item--order-tablet-and-mobile-1  m-login__wrapper">
    <!--begin::Head-->
    <div class="m-login__head">
        <!-- <span>Don't have an account?</span>
        <a href="#" class="m-link m--font-danger">Sign Up</a> -->
    </div>
    <!--end::Head-->

    <!-- <div class="m-login__logo text-center">
        <a href="{{ url('/') }}">
            <img src="{{asset('assets/app/media/img/logos/mhada-logo.png')}}" width="550">
        </a>
    </div> -->

    <!--begin::Body-->
    <div class="m-login__body min-height-100vh light-bg">
        <!--begin::Signin-->
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
          <div class="m-login__container m-login__container--sign-in">
            <div class="">
                <div class="m-login__title">
                    <h3>Check Application Status</h3>
                </div>

                <!--begin::Form-->
                <form class="m-login__form m-form" action="{{ route('rti_frontend_application_status') }}" id="rti_frontend_application_status_check"
                    method="post">
                    @csrf
                    <div class="form-group m-form__group">
                        <input class="form-control form-control--custom m-input" type="text" placeholder="Application Number"
                            name="application_no">
                    </div>
                    <div class="form-group m-form__group">
                        <input class="form-control form-control--custom m-input m-login__form-input--last" type="email"
                            placeholder="Email Address" name="email">
                    </div>
                    <div class="m-login__action">
                        <a href="{{ route('rti_frontend.create') }}" class="m-link btn btn-primary m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primary">Register</a>
                        <a id="rti_application_status_check" href="#" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primary">Check
                            Status</a>
                    </div>
                </form>
                <!--end::Form-->

                <!--begin::Action-->
                <!-- <div class="m-login__action">
                    <a href="{{ route('rti_frontend.create') }}" class="m-link">
                    <button id="m_login_signin_submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Register</button>
                  </a>
                    <a href="#">
                    <button id="m_login_signin_submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Check Status</button>
                  </a>
                </div> -->
                <!--end::Action-->
            </div>
          </div>
        </div>
        <!-- <div class="col-sm-1"></div> -->
        <!-- <div class="m-login__signin">
          <div class="m-login__title">
            <h3>Login</h3>
          </div>
          <form class="m-login__form m-form" action="">
            <div class="form-group m-form__group">
              <input class="form-control m-input" type="text" placeholder="Username" name="username" autocomplete="off">
            </div>
            <div class="form-group m-form__group">
              <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
            </div>
            <div class="m-login__action">
            <a href="#" class="m-link">
              <span>Forgot Password ?</span>
            </a>
            <a href="#">
              <button id="m_login_signin_submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Sign In</button>
            </a>
          </div>
          </form>
        </div> -->
    </div>
</div>
<!-- <div class="m-grid__item m-grid__item--fluid  m-grid__item--order-tablet-and-mobile-1  m-login__wrapper">
  <div class="m-login__head">
  </div>
  <div class="m-login__logo text-center">
    <a href="{{ url('/') }}">
    <img src="{{asset('assets/app/media/img/logos/mhada-logo.png')}}" width="550">
    </a>
  </div>
  <div class="m-login__body">
    <div class="m-login__signin">
      <div class="m-login__title">
        <h3>Login</h3>
      </div>
      <form class="m-login__form m-form" action="">
        <div class="form-group m-form__group">
          <input class="form-control m-input" type="text" placeholder="Username" name="username" autocomplete="off">
        </div>
        <div class="form-group m-form__group">
          <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
        </div>
      </form>
      <div class="m-login__action">
        <a href="#" class="m-link">
          <span>Forgot Password ?</span>
        </a>
        <a href="#">
          <button id="m_login_signin_submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Sign In</button>
        </a>
      </div>
    </div>
  </div>
</div> -->
@endsection
