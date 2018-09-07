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
                           <!-- <p class="sub-title"></p> -->
                        </div>
                        <form class="m-login__form m-form" id="sign_in_form">
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Email Address</label> -->
                           <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Password</label> -->
                           <input class="form-control m-input" type="password" placeholder="Password" name="password" autocomplete="off">
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
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Last Name</label> -->
                           <textarea class="form-control m-input" placeholder="Society Address" name="society_address"></textarea>
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Email Address</label> -->
                           <input class="form-control m-input" type="text" placeholder="Society Building No" name="society_building_no">
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Mobile No</label> -->
                           <input class="form-control m-input" type="text" placeholder="Society Registration No" name="society_registration_no">
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Pan Number</label> -->
                           <input class="form-control m-input" type="text" placeholder="User Name" name="society_username">
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                           <input class="form-control m-input" type="email" placeholder="Email Address" name="society_email">
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                           <input class="form-control m-input" type="text" placeholder="Contact No" name="society_contact_no">
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Password</label> -->
                           <input class="form-control m-input" type="password" placeholder="Password" name="society_password">
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
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                           <input class="form-control m-input" type="text" placeholder="Architect Mobile Number" name="society_architect_mobile_no">
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Password</label> -->
                           <textarea class="form-control m-input" placeholder="Architect Address" name="society_architect_address"></textarea>
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Password</label> -->
                           <input class="form-control m-input" type="text" placeholder="Architect Telephone Number" name="society_architect_telephone_no">
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
                        <form class = 'm-login__form m-form' id = 'forgot_password_form'>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Enter your email to reset your password :</label> -->
                           <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
                        </div>
                        <div class="m-login__form-action">
                           <button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primaryr">
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