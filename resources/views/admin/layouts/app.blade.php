<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
 <!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        var baseUrl = "{{url('/')}}";
    </script>
</head>
<body class="page-header-fixed">
        <div class="header navbar navbar-inverse navbar-fixed-top">
            <!-- BEGIN TOP NAVIGATION BAR -->
            <div class="navbar-inner">
                <div class="container-fluid">
                    <!-- BEGIN LOGO -->
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <!-- <a class="brand-name">Human Venture</a> -->
                    <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                        <img src="{{asset('assets/img/menu-toggler.png')}}" alt=""/>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->

                    <!-- END TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- END TOP NAVIGATION BAR -->
        </div>

        <div class="page-container">

            <!-- BEGIN PAGE -->
            <div class="page-content">
                <!-- BEGIN PAGE CONTAINER-->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- END PAGE CONTAINER-->
            </div>
            <!-- END PAGE -->

        </div>

    <div class="copyright">
        {{date('Y')}} &copy; {{config('app.name')}}.
    </div>
        <script type="text/javascript" src="{{ asset('assets/scripts/custom.js') }}"></script>
</body>
</html>
