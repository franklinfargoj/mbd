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
         @section('body')
         @show
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
      <script src="{{asset('/frontend/js/custom.js')}}" type="text/javascript"></script>
      <!--end::Page Snippets -->
   </body>
   <!-- end::Body -->
</html> 
