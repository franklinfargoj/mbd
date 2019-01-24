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
      <link href="{{asset('/assets/demo/default/base/custom.css')}}" rel="stylesheet" type="text/css" />
      <!--end::Base Styles -->
      <link rel="shortcut icon" href="{{ asset('/img/fav-icon-new.png')}}" />
      
   </head>
   <!-- end::Head -->
   <!-- end::Body -->
   <body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-footer--push" >
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
      <script type="text/javascript" src="{{ asset('/js/bootstrap-select.js') }}"></script>
      <script type="text/javascript" src="{{ asset('/assets/demo/default/custom/components/forms/validation/form-widgets.js') }}"></script>
      <script src="{{asset('/frontend/js/custom.js')}}" type="text/javascript"></script>
      <script src="{{asset('/js/custom.js')}}" type="text/javascript"></script>
      <!--end::Page Snippets -->
      @yield('js')
   </body>
   <!-- end::Body -->
</html> 
