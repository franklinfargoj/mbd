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
                                                                <span class="m-nav__link-text">
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