@extends('frontend.rti.login')
@section('body')
   <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login" style="position: relative;">
            <div class="m-login__logo text-center">
                  <a href="{{ url('/') }}"></a>
                  <img src="{{asset('assets/app/media/img/logos/mhada-logo.png')}}" width="550">
                  </a>
            </div>
            <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
               <div class="m-grid__item m-grid__item--fluid">
                  <div class="m-login__container">
                     <div class="m-login__signin">
                        <div class="m-login__head">
                           <h1 class="m-login__title mb-0 display-4">
                              MHADA Digitization
                           </h1>
                           <p class="sub-title">
                             @if (session('registered'))
                                  <div class="alert alert-success">
                                    <center>{{ session('registered') }}</center>
                                  </div>
                              @endif
                           </p>
                        </div>
                        @if($errors->any() && !$errors->has('capture_text'))
                           <div class="alert alert-danger alert-block" style="margin-top: 14px;">
                              <strong>{{$errors->first()}}</strong>
                           </div>
                        @endif
                        <form class="m-login__form m-form" id="sign_in_form" name="sign_in_form" method="post" action="{{route('society_detail.UserAuthentication')}}">
                        @csrf
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Email Address</label> -->
                           <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Password</label> -->
                           <input class="form-control m-input" type="password" placeholder="Password" name="password" autocomplete="off">
                        </div>
                        <div class="form-group m-form__group" style="margin-top: 16px;">
                           {{--<span class="captcha_img" style="padding: 19px;"> {!! captcha_img() !!}</span>--}}
                           <span style="padding: 19px;"> <img id="captcha_img" src="{{URL::to('captcha')}}"></span>
                           {{--<i class="fa fa-refresh btn_refresh" title="Recapture" aria-hidden="true" style="font-size: 24px;cursor: pointer;"></i>--}}
                           <i class="fa fa-refresh" onclick="document.getElementById('captcha_img').src='{{ URL::to('captcha') }}'; return false" title="Recapture" aria-hidden="true" style="font-size: 24px;cursor: pointer;"></i>

                           <input type="text" id="capture_text" class="form-control" name="capture_text" placeholder="Enter Capture">
                           @if($errors->has('capture_text'))
                              <span class="help-block" style="padding: 16px;color: red;">Invalid capture </span>
                           @endif   
                        </div>
                        <div class="row m-login__form-sub">
                           <div class="col m--align-right m-login__form-right">
                              <a href="javascript:;" id="m_login_forget_password" class="m-link">
                              Forget Password ?
                              </a>
                           </div>
                        </div>
                        <div class="m-login__form-action mt-4 mb-4">
                           <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primary">
                           Sign In
                           </button>
                        </div>
                        </form>
                     </div>
                     <div class="m-login__signup">
                        <div class="m-login__head">
                           <h1 class="m-login__title mb-0 display-4">
                              MHADA Digitization 
                           </h1>
                        </div>
                        <form class = 'm-login__form m-form' id = 'sign_up_form_society_offer_letter' action="{{ route('society_offer_letter.store') }}" method="post">
                        @csrf
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">First Name</label> -->
                           <input class="form-control m-input" type="text" placeholder="Society Name" name="society_name">
                           <span class="help-block">{{$errors->first('society_name')}}</span>
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Last Name</label> -->
                           <textarea class="form-control m-input" placeholder="Society Address" name="society_address"></textarea>
                           <span class="help-block">{{$errors->first('society_address')}}</span>
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Email Address</label> -->
                           <input class="form-control m-input" type="text" placeholder="Society Building No" name="society_building_no">
                           <span class="help-block">{{$errors->first('society_building_no')}}</span>
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Mobile No</label> -->
                           <input class="form-control m-input" type="text" placeholder="Society Registration No" name="society_registration_no">
                           <span class="help-block">{{$errors->first('society_registration_no')}}</span>
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Pan Number</label> -->
                           <input class="form-control m-input" type="text" placeholder="User Name" name="society_username">
                           <span class="help-block">{{$errors->first('society_username')}}</span>
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                           <input class="form-control m-input" type="email" placeholder="Email Address" name="society_email">
                           <span class="help-block">{{$errors->first('society_email')}}</span>
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                           <input class="form-control m-input" type="text" placeholder="Contact No" name="society_contact_no">
                           <span class="help-block">{{$errors->first('society_contact_no')}}</span>
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Password</label> -->
                           <input class="form-control m-input" type="password" placeholder="Password" name="society_password">
                           <span class="help-block">{{$errors->first('society_password')}}</span>
                        </div>
                        <div class="m-login__form-divider">
                          <div class="m-divider">
                            <span><br/></span>
                            <span><b>Architect Details:</b></span>
                          </div>
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                           <input class="form-control m-input" type="text" placeholder="Architect Name" name="society_architect_name">
                           <span class="help-block">{{$errors->first('society_architect_name')}}</span>
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                           <input class="form-control m-input" type="text" placeholder="Architect Mobile Number" name="society_architect_mobile_no">
                           <span class="help-block">{{$errors->first('society_architect_mobile_no')}}</span>
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Password</label> -->
                           <textarea class="form-control m-input" placeholder="Architect Address" name="society_architect_address"></textarea>
                           <span class="help-block">{{$errors->first('society_architect_address')}}</span>
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Password</label> -->
                           <input class="form-control m-input" type="text" placeholder="Architect Telephone Number" name="society_architect_telephone_no">
                           <span class="help-block">{{$errors->first('society_architect_telephone_no')}}</span>
                        </div>
                        <div class="m-login__form-action">
                           <button id="m_login_signup_submit_society_offer_letter" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-login__btn">
                           Sign Up
                           </button>
                           &nbsp;&nbsp;
                           <button id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">
                           <i class="la la-close"></i>
                           </button>
                        </div>
                        </form>
                     </div>
                     <div class="m-login__forget-password">
                        <div class="m-login__head">
                           <h1 class="m-login__title mb-0 display-4">
                              Forgotten Password ?
                           </h1>
                        </div>
                        <form class = 'm-login__form m-form' id = 'society_forgot_password_form' method="post" action="{{ route('society_offer_letter_forgot_password') }}">
                          @csrf
                          <div class="form-group m-form__group">
                             <!-- <label for="" class="col-form-label">Enter your email to reset your password :</label> -->
                             <input class="form-control m-input" type="email" placeholder="Email Address" name="society_email">
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
                     </div>
                     <div class="m-login__account text-center">
                        <span class="m-login__account-msg">
                        Don't have an account yet ?
                        </span>
                        <a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">
                        Sign Up
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
@endsection

