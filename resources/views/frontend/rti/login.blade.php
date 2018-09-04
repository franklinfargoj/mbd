<!DOCTYPE html>
<html lang="en" >
   <!-- begin::Head -->
   <head>
      <meta charset="utf-8" />
      <title>
         MHADA
      </title>
      <meta name="description" content="MHADA">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
      <!--begin::Web font -->
      <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
      <script>
         WebFont.load({
         	google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
         	active: function() {
         		sessionStorage.fonts = true;
         	}
         });
      </script>
      <!--end::Web font -->
      <!--begin::Base Styles -->
      <link href="{{asset('/assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('/assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
      <!--end::Base Styles -->
      <link rel="shortcut icon" href="{{asset('/assets/demo/default/media/img/logo/favicon.ico')}}" />
      <style>
         .error{
         color:#f4a1a1;
         }
         .login-form{
         /*width:30%;*/
         padding:0;
         /*height: 100vh;
         background: #ffffff;*/
         display: flex;
         position:relative;
         }
         /*.m-login__logo{
         position: absolute;
         right: 50px;
         top: 5%;
         }*/
         .m-login-slogan{
         position: absolute;
         left:35%;
         bottom: 5%;
         }
         .login-form .m-form .m-form__group{
         padding-top:0px;
         }
         /*.btn-focus{
         background-color:#028541;
         border-color:#028541;
         border-radius:.25rem !important;
         width:100%;
         }*/
         .sign-in-button{position: absolute; top: 140px;right: 30px;}
         .btn-focus:hover{
         background-color: #027439;
         border-color: #027439;
         }
         .login-form .m-login__account a{
         color:#f0791b !important;
         text-transform:uppercase;
         font-weight:bold;
         }
         .login-form .m-login__container{
         width:97%;
         padding: 4em;
         }
         .login-form .sub-title{
         font-size:1.8em;
         }
         .login-form .m-login__title{
         color:#333333 !important;
         }
         #m_login_signup_cancel, 
         #m_login_forget_password_cancel{
         color:#333333;
         background:transparent;
         border:none;
         padding:0;
         position:absolute;
         right:5%;
         top: 2%;
         }
         #m_login_signup_cancel i,
         #m_login_forget_password_cancel i{
         font-size:30px;
         }
         .m-login__logo{
            background-color: #eaeaea;
            padding: 20px;
            box-shadow: 0px 3px 18px -3px rgba(163,163,163,0.9);
         }
         .m-login.m-login--2 .m-login__wrapper .m-login__container {
             width: 430px;
             margin: -65px auto 0;
          }
      </style>
   </head>
   <!-- end::Head -->
   <!-- end::Body -->
   <body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default" >
      <!-- begin:: Page -->
      <div class="m-grid m-grid--hor m-grid--root m-page">
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
                        <form class = 'm-login__form m-form' id = 'sign_up_form' method="post" action="{{ route('rti_frontend.store') }}">
                        @csrf
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">First Name</label> -->
                           <input class="form-control m-input" type="text" placeholder="Name of User" name="firstname" >
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Mobile No</label> -->
                           <input class="form-control m-input" type="text" placeholder="Mobile No" name="mob" autocomplete="off" data-container="body" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="Mobile number must contain exactly 10 numbers.(+91) is by default considered.." data-skin="dark">
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Email Address</label> -->
                           <input class="form-control m-input" id="email_val" type="text" placeholder="Email" name="email" autocomplete="off" data-container="body" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="This field must contain a valid email address.." data-skin="dark">
                           <div class="error" id="email_error" style="display: none;">This Email-id is already used.</div>
                        </div>
                        <div class="form-group m-form__group">
                           <!-- <label for="" class="col-form-label">Pan Number</label> -->
                           <textarea class="form-control m-input" name="address" placeholder="Enter Address"></textarea>
                           <!-- <input class="form-control m-input" type="text" placeholder="Pan number" name="pan_number" autocomplete="off"data-container="body" data-toggle="m-tooltip" data-placement="right" data-original-title="Pan Number must be 10 alphanumeric charecters and a valid pan format." data-skin="dark"> -->
                        </div>
                        <!-- <div class="form-group m-form__group">
                           <label for="" class="col-form-label">Password</label>
                           <input class="form-control m-input" type="password" placeholder="Password" id="password" name="password" autocomplete="off" data-container="body" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="Password must be between 8 to 10 charecters and must contain atleast 1 capital alphabet,1 small alphabet,1 special charecter & 1 number." data-skin="dark">
                        </div>
                        <div class="form-group m-form__group">
                           <label for="" class="col-form-label">Confirm Password</label>
                           <input class="form-control m-input" type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password" autocomplete="off" data-container="body" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="Confirm password field value must match the value entered in password field." data-skin="dark">
                        </div> -->
                        <div class="m-login__form-action">
                           <button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-login__btn">
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
      </div>
      <script>
         var BASE_URL = "{{ url('/') }}";
      </script>
      <!-- end:: Page -->
      <!--begin::Base Scripts -->
      <script src="{{asset('/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
      <script src="{{asset('/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
      <!--end::Base Scripts -->
      <!--begin::Page Snippets -->
      <script src="{{asset('/assets/snippets/pages/user/login.js')}}" type="text/javascript"></script>
      <!--end::Page Snippets -->
   </body>
   <!-- end::Body -->
</html> 
