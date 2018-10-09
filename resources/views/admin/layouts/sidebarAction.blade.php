<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<!-- begin::Head -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="Basic datatables examples">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
    <script>
        WebFont.load({
           google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
           active: function() {
               sessionStorage.fonts = true;
           }
         });
      </script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
          var baseUrl = "{{url('/')}}";
      </script>
    <!--end::Web font -->
    <!--begin::Page Vendors Styles -->
    <!-- <link href="{{asset('assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" /> -->
    <link href="{{asset('/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles -->
    <!--begin::Base Styles -->
    <link href="{{asset('/assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/css/mdtimepicker.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('/assets/demo/default/base/custom.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->
    <link rel="shortcut icon" href="{{asset('/assets/demo/default/media/img/logo/favicon.ico')}}" />
    @yield('css')
</head>
<!-- end::Head -->
<!-- begin::Body -->

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <!-- BEGIN: Header -->
        <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
            <div class="m-container m-container--fluid m-container--full-height">
                <div class="m-stack m-stack--ver m-stack--desktop">
                    <!-- BEGIN: Brand -->
                    <!-- <div class="m-stack__item m-brand  m-brand--skin-dark ">
                        <div class="m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                <a href="?page=index&demo=default" class="m-brand__logo-wrapper">Mhada</a>
                            </div>
                            <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    </div> -->
                    <!-- END: Brand -->
                    <div class="m-stack__item m-stack__item--fluid m-header-head header--custom" id="m_header_nav">
                        <div class="d-flex justify-content-between">
                            <div class="logo-wrapper-inner">
                                <img class="login-logo" src="{{asset('assets/app/media/img/logos/mhada-logo.png')}}">
                            </div>
                            <!-- BEGIN: Horizontal Menu -->
                            <!-- END: Topbar -->
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
                                    data-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="#" class="m-portlet__nav-link m-dropdown__toggle">
                                        <!-- <i class="la la-plus m--hide"></i>
                                    <i class="la la-ellipsis-h"></i> -->
                                        <i class="m-nav__link-icon fa fa-user" style="padding-right: 5px;"></i>
                                        My Account
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('logout') }}" class="m-nav__link" onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                                <!-- <i class="m-nav__link-icon flaticon-share"></i> -->
                                                                <span class="signout-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" viewBox="0 0 450 450">
                                                                        <path fill="#6f727d" d="M182.725 379.151c-.572-1.522-.769-2.816-.575-3.863.193-1.04-.472-1.902-1.997-2.566-1.525-.664-2.286-1.191-2.286-1.567 0-.38-1.093-.667-3.284-.855-2.19-.191-3.283-.288-3.283-.288H82.224c-12.562 0-23.317-4.469-32.264-13.421-8.945-8.946-13.417-19.698-13.417-32.258V123.335c0-12.562 4.471-23.313 13.417-32.259 8.947-8.947 19.702-13.422 32.264-13.422h91.361c2.475 0 4.421-.614 5.852-1.854 1.425-1.237 2.375-3.094 2.853-5.568.476-2.474.763-4.708.859-6.707.094-1.997.048-4.521-.144-7.566-.189-3.044-.284-4.947-.284-5.712 0-2.474-.905-4.611-2.712-6.423-1.809-1.804-3.949-2.709-6.423-2.709H82.224c-22.648 0-42.016 8.042-58.101 24.125C8.042 81.323 0 100.688 0 123.338v200.994c0 22.648 8.042 42.018 24.123 58.095 16.085 16.091 35.453 24.133 58.101 24.133h91.365c2.475 0 4.422-.622 5.852-1.854 1.425-1.239 2.375-3.094 2.853-5.571.476-2.471.763-4.716.859-6.707.094-1.999.048-4.518-.144-7.563-.191-3.048-.284-4.95-.284-5.714z" />
                                                                        <path fill="#6f727d" d="M442.249 210.989L286.935 55.67c-3.614-3.612-7.898-5.424-12.847-5.424s-9.233 1.812-12.851 5.424c-3.617 3.617-5.424 7.904-5.424 12.85v82.226H127.907c-4.952 0-9.233 1.812-12.85 5.424-3.617 3.617-5.424 7.901-5.424 12.85v109.636c0 4.948 1.807 9.232 5.424 12.847 3.621 3.61 7.901 5.427 12.85 5.427h127.907v82.225c0 4.945 1.807 9.233 5.424 12.847 3.617 3.617 7.901 5.428 12.851 5.428 4.948 0 9.232-1.811 12.847-5.428L442.249 236.69c3.617-3.62 5.425-7.898 5.425-12.848 0-4.948-1.808-9.236-5.425-12.853z" />
                                                                    </svg>
                                                                </span>
                                                                <span class="m-nav__link-text signout-text">
                                                                    Sign Out
                                                                </span>
                                                            </a>
                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                                style="display: none;">
                                                                {{ csrf_field() }}
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END: Header -->
        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            @include('admin.layouts.sidebar')
            <div class="col-md-12">
                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    @section('content')
                    @show
                </div>
            </div>
        </div>
        <!-- end:: Body -->
        <!-- begin::Footer -->
        <footer class="m-grid__item   m-footer ">
            <div class="m-container m-container--fluid m-container--full-height m-page__container">
                <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                    <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                        <span class="m-footer__copyright">
                            Digitization
                            <a href="https://www.web-werks.com/" class="m-link">
                                Web Enabled by Web Werks
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end::Footer -->
    </div>
    <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500"
        data-scroll-speed="300">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Footer -->
    </div>
    <!-- end:: Page -->
    <!-- begin::Quick Sidebar -->
    <!-- end::Quick Sidebar -->
    <!-- begin::Scroll Top -->
    <div id="m_scroll_top" class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Scroll Top -->
    <!-- begin::Quick Nav -->
    <!-- begin::Quick Nav -->
    <!--begin::Base Scripts -->
    <script src="{{asset('/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
    <!--end::Base Scripts -->
    <!--begin::Page Vendors Scripts -->
    <script src="{{asset('/plugins/datatables/datatables.all.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/assets/snippets/pages/user/login.js')}}" type="text/javascript"></script>
    <!--DatatableHtmlTableDemo.init()-->
    <script>
        // var DatatableHtmlTableDemo =function()
        //    {
        //       var e=function(){var e=$(".m-datatable").mDatatable
        //       ({
        //          columnDefs: [
        //          {
        //              // The `data` parameter refers to the data for the cell (defined by the
        //              // `data` option, which defaults to the column being worked with, in
        //              // this case `data: 0`.
        //              "render": function ( data, type, row ) {
        //                  return null;
        //              },
        //              "targets": 7
        //          },
        //          ]
        //       }),
        //          a=e.getDataSourceQuery();
        //          $("#m_form_search").on("keyup",function(a){e.search($(this).val().toLowerCase())}).val(a.generalSearch)};
        //          return{init:function(){e()}}
        //    }
        //       ();
        //       jQuery(document).ready(function(){DatatableHtmlTableDemo.init();});

    </script>
    <script>
        $(document).ready(function () {
            $('#clickmewow').click(function () {
                $('#radio1003').attr('checked', 'checked');
            });
        })

    </script>
    <script type="text/javascript" src="{{ asset('/js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap-select.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/demo/default/custom/components/forms/validation/form-widgets.js') }}"></script>
    @yield('add_resolution_js');
    @yield('download_application_form_js');
    @yield('add_email_templates_js');
    @yield('Application_redevelopment');
    @yield('calculation_sheet_js')
    <!--end::Page Vendors Scripts -->
    <!--begin::Page Resources -->
    @yield('datatablejs');
    @yield('js');
</body>
<!-- end::Body -->

</html>
