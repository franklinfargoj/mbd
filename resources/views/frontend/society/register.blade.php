@extends('frontend.rti.login')
@section('body')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2 m-login__container--rounded-fields sign-up-bg" id="m_login" style="position: relative;">
    <!-- <div class="m-login__logo text-center">
                  <a href="{{ url('/') }}"></a>
                  <img src="{{asset('assets/app/media/img/logos/mhada-logo.png')}}" width="550">
                  </a>
            </div> -->
            <!-- {{ $errors }} -->
        <div class="m-grid__item m-grid__item--fluid m-login__wrapper d-flex align-items-center h-100">
            <div class="m-login__container m-login__container--sign-in sign-up-box">
                <div class="m-grid__item m-grid__item--fluid">
                    <div class="m-login__signup d-block">
                        <div class="m-login__head">
                            <h1 class="m-login__title mb-0 display-4 text-white mb-4">
                                MUMBAI HOUSING AND AREA DEVELOPMENT BOARD
                            </h1>
                        </div>
                        <form class='m-login__form m-form' id='sign_up_form_society_offer_letter' action="{{ route('society_offer_letter.store') }}"
                            method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                <div class="form-group m-form__group @if($errors->has('society_name')) has-error @endif">
                                    <!-- <label for="" class="col-form-label">First Name</label> -->
                                    <input class="form-control m-input" type="text" placeholder="Society Name" name="society_name" value="{{ old('society_name') }}">
                                    <span class="help-block">{{$errors->first('society_name')}}</span>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group m-form__group @if($errors->has('society_address')) has-error @endif">
                                    <!-- <label for="" class="col-form-label">Last Name</label> -->
                                    <textarea class="form-control m-input" placeholder="Society Address" name="society_address" value="{{ old('society_address') }}"></textarea>
                                    <span class="help-block">{{$errors->first('society_address')}}</span>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group m-form__group @if($errors->has('society_contact_no')) has-error @endif">
                                    <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                                    <input class="form-control m-input" type="text" placeholder="Society Contact No" name="society_contact_no" value="{{ old('society_contact_no') }}">
                                    <span class="help-block">{{$errors->first('society_contact_no')}}</span>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group m-form__group @if($errors->has('society_building_no')) has-error @endif">
                                    <!-- <label for="" class="col-form-label">Email Address</label> -->
                                    <input class="form-control m-input" type="text" placeholder="Society Building No" name="society_building_no" value="{{ old('society_building_no') }}">
                                    <span class="help-block">{{$errors->first('society_building_no')}}</span>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group m-form__group @if($errors->has('society_registration_no')) has-error @endif">
                                    <!-- <label for="" class="col-form-label">Mobile No</label> -->
                                    <input class="form-control m-input" type="text" placeholder="Society Registration No" name="society_registration_no" value="{{ old('society_registration_no') }}">
                                    <span class="help-block">{{$errors->first('society_registration_no')}}</span>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group m-form__group @if($errors->has('society_architect_name')) has-error @endif">
                                    <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                                    <input class="form-control m-input" type="text" placeholder="Architect Name" name="society_architect_name" value="{{ old('society_architect_name') }}">
                                    <span class="help-block">{{$errors->first('society_architect_name')}}</span>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group m-form__group @if($errors->has('society_email')) has-error @endif">
                                    <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                                    <input class="form-control m-input" type="email" placeholder="Email Address" name="society_email" value="{{ old('society_email') }}">
                                    <span class="help-block">{{$errors->first('society_email')}}</span>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group m-form__group @if($errors->has('society_architect_mobile_no')) has-error @endif">
                                    <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                                    <input class="form-control m-input" type="text" placeholder="Architect Mobile Number" name="society_architect_mobile_no" value="{{ old('society_architect_mobile_no') }}">
                                    <span class="help-block">{{$errors->first('society_architect_mobile_no')}}</span>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group m-form__group @if($errors->has('society_architect_address')) has-error @endif">
                                    <!-- <label for="" class="col-form-label">Password</label> -->
                                    <textarea class="form-control m-input" placeholder="Architect Address" name="society_architect_address" value="{{ old('society_architect_address') }}"></textarea>
                                    <span class="help-block">{{$errors->first('society_architect_address')}}</span>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group m-form__group @if($errors->has('society_password')) has-error @endif">
                                    <!-- <label for="" class="col-form-label">Password</label> -->
                                    <input class="form-control m-input" type="password" placeholder="Password" name="society_password" id="password" value="{{ old('society_password') }}">
                                    <span class="help-block">{{$errors->first('society_password')}}</span>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group m-form__group @if($errors->has('society_password')) has-error @endif">
                                    <!-- <label for="" class="col-form-label">Password</label> -->
                                    <input class="form-control m-input" type="password" placeholder="Confirm Password" name="conf_society_password" value="{{ old('conf_society_password') }}">
                                    <span class="help-block">{{$errors->first('society_password')}}</span>
                                </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group m-form__group @if($errors->has('society_email')) has-error @endif">
                                    <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                                    <input class="form-control m-input" type="email" placeholder="Optional Email Address" name="optional_society_email" value="{{ old('society_email') }}">
                                    <span class="help-block">{{$errors->first('society_email')}}</span>
                                </div>
                                </div>
                            </div>
                            <div class="m-login__form-action">
                                <button id="m_login_signup_submit_society_offer_letter" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-login__btn">
                                    Sign Up
                                </button>
                                &nbsp;&nbsp;
                                <a href="{{ route('society_offer_letter.index') }}" id="" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-login__btn">
                                    <!-- <i class="la la-close"></i> -->Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection