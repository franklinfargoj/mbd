@extends('frontend.layouts.app')
@section('body')
	<div class="m-grid__item m-grid__item--fluid  m-grid__item--order-tablet-and-mobile-1  m-login__wrapper">
      <!--begin::Head-->
      <div class="m-login__head">
        <span>Don't have an account?</span>
        <a href="#" class="m-link m--font-danger">Sign Up</a>
      </div>
      <!--end::Head-->

      <!--begin::Body-->
      <div class="m-login__body">

        <!--begin::Signin-->
        <div class="m-login__signin">
          <div class="m-login__title">
            <h3>Check Application Status</h3>
          </div>

          <!--begin::Form-->
          <form class="m-login__form m-form" action="">
            <div class="form-group m-form__group">
              <input class="form-control m-input" type="text" placeholder="Application Number" name="username" autocomplete="off">
            </div>
            <div class="form-group m-form__group">
              <input class="form-control m-input m-login__form-input--last" type="email" placeholder="Email Address" name="email">
            </div>
          </form>
          <!--end::Form-->

          <!--begin::Action-->
          <div class="m-login__action">
            <a href="{{ route('rti_frontend.create') }}" class="m-link">
              <button id="m_login_signin_submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Register</button>
            </a>
            <a href="#">
              <button id="m_login_signin_submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Check Status</button>
            </a>
          </div>
          <!--end::Action-->

          <!--begin::Divider-->
          <div class="m-login__form-divider">
            <div class="m-divider">
              <span></span>
              <span>OR</span>
              <span></span>
            </div>
          </div>
          <!--end::Divider-->

          <!--begin::Options-->
          <div class="m-login__options">
            <a href="#" class="btn btn-primary m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
              <span>
                <i class="fab fa-facebook-f"></i>
                <span>Facebook</span>
              </span>
            </a>

            <a href="#" class="btn btn-info m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
              <span>
                <i class="fab fa-twitter"></i>
                <span>Twitter</span>
              </span>
            </a>

            <a href="#" class="btn btn-danger m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
              <span>
                <i class="fab fa-google"></i>
                <span>Google</span>
              </span>
            </a>
          </div>
          <!--end::Options-->
        </div>
        <!--end::Signin-->
      </div>
      <!--end::Body-->
    </div>
    <div class="m-grid__item m-grid__item--fluid  m-grid__item--order-tablet-and-mobile-1  m-login__wrapper">
    <!--begin::Head-->
    <div class="m-login__head">
      <span>Don't have an account?</span>
      <a href="#" class="m-link m--font-danger">Sign Up</a>
    </div>
    <!--end::Head-->

    <!--begin::Body-->
    <div class="m-login__body">

      <!--begin::Signin-->
      <div class="m-login__signin">
        <div class="m-login__title">
          <h3>Login</h3>
        </div>

        <!--begin::Form-->
        <form class="m-login__form m-form" action="">
          <div class="form-group m-form__group">
            <input class="form-control m-input" type="text" placeholder="Username" name="username" autocomplete="off">
          </div>
          <div class="form-group m-form__group">
            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
          </div>
        </form>
        <!--end::Form-->

        <!--begin::Action-->
        <div class="m-login__action">
          <a href="#" class="m-link">
            <span>Forgot Password ?</span>
          </a>
          <a href="#">
            <button id="m_login_signin_submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Sign In</button>
          </a>
        </div>
        <!--end::Action-->

        <!--begin::Divider-->
        <div class="m-login__form-divider">
          <div class="m-divider">
            <span></span>
            <span>OR</span>
            <span></span>
          </div>
        </div>
        <!--end::Divider-->

        <!--begin::Options-->
        <div class="m-login__options">
          <a href="#" class="btn btn-primary m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
            <span>
              <i class="fab fa-facebook-f"></i>
              <span>Facebook</span>
            </span>
          </a>

          <a href="#" class="btn btn-info m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
            <span>
              <i class="fab fa-twitter"></i>
              <span>Twitter</span>
            </span>
          </a>

          <a href="#" class="btn btn-danger m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
            <span>
              <i class="fab fa-google"></i>
              <span>Google</span>
            </span>
          </a>
        </div>
        <!--end::Options-->
      </div>
      <!--end::Signin-->
    </div>
    <!--end::Body-->
  </div>
@endsection