 <html lang="en" >
    <!-- begin::Head -->
    <head>
        <meta charset="utf-8" />
        
        <title>Metronic | Login Page - 6</title>
        <meta name="description" content="Latest updates and statistic charts"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
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
				<link href="{{asset('/frontend/css/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
				<link href="{{asset('/frontend/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		        <!--end::Base Styles -->

        <link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico" />
</head>
    <!-- end::Head -->
<!-- begin::Body -->
    <body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >

        
        
      <!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
  <div class="m-grid__item m-grid__item--fluid m-grid m-grid--desktop m-grid--ver-desktop m-grid--hor-tablet-and-mobile m-login m-login--6" id="m_login">
    @section('body')
        @show
</div>

                  
    

</div>
        <script src="{{asset('/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
        <!-- <script src="{{asset('/frontend/js/login6.js')}}" type="text/javascript"></script> -->
        <script src="{{asset('/assets/snippets/pages/user/login.js')}}" type="text/javascript"></script>
    </body>
    <!-- end::Body -->
</html>
