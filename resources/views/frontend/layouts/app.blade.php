<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
   <!-- begin::Head -->
   <head>
      <meta charset="utf-8" />
      <title>{{ config('app.name') }}</title>
      <meta name="description" content="Basic datatables examples">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
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
      <!--begin::Page Vendors Styles -->
      <link href="{{asset('assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
      <!--end::Page Vendors Styles -->
      <!--begin::Base Styles -->
      <link href="{{asset('/assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('/assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
      <!--end::Base Styles -->
      <link rel="shortcut icon" href="{{asset('/assets/demo/default/media/img/logo/favicon.ico')}}" />
   </head>
   <!-- end::Head -->
   <!-- begin::Body -->
   <body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
      <!-- begin:: Page -->
      <div class="m-grid m-grid--hor m-grid--root m-page">
         <!-- BEGIN: Header -->
         <header id="m_header" class="m-grid__item    m-header "  m-minimize-offset="200" m-minimize-mobile-offset="200" >
            <div class="m-container m-container--fluid m-container--full-height">
               <div class="m-stack m-stack--ver m-stack--desktop">
                  <!-- BEGIN: Brand -->
                  <div class="m-stack__item m-brand  m-brand--skin-dark ">
                     <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                           <a href="?page=index&demo=default" class="m-brand__logo-wrapper">
                           <img alt="" src="./assets/demo/default/media/img/logo/logo_default_dark.png"/>
                           </a>  
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">
                           <!-- BEGIN: Left Aside Minimize Toggle -->
                           <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                           <span></span>
                           </a>
                        </div>
                     </div>
                  </div>
                  <!-- END: Brand -->     
                  <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                     <!-- BEGIN: Horizontal Menu -->
                     <!-- END: Topbar -->      
                  </div>
               </div>
            </div>
         </header>
         <!-- END: Header -->    
         <!-- begin::Body -->
         <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            <!-- BEGIN: Left Aside -->
            <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
            <div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
               <!-- BEGIN: Aside Menu -->
               <div 
                  id="m_ver_menu" 
                  class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
                  m-menu-vertical="1"
                  m-menu-scrollable="1" m-menu-dropdown-timeout="500"  
                  style="position: relative;">
                  <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                     <li class="m-menu__item m-menu__item--active" aria-haspopup="true" >
                        <a href="#" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                        Resolution Listing 
                        </span>
                        </span>
                        </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>
                     </li>
                  </ul>
               </div>
               <!-- END: Aside Menu -->
            </div>
            <!-- END: Left Aside -->         
            <div class="col-md-12">     
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
               <!-- BEGIN: Subheader -->
               <div class="m-subheader ">
                  <div class="d-flex align-items-center">
                     <div class="mr-auto">
                        <h3 class="m-subheader__title m-subheader__title--separator">Resolution Listing </h3>
                     </div>
                     <div>
                     </div>
                  </div>
               </div>
               <!-- END: Subheader -->           
               <div class="m-content"></div>
               <div class="m-portlet m-portlet--mobile">
                  <div class="m-portlet__head">
                     <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                           <h3 class="m-portlet__head-text">
                              
                           </h3>
                        </div>
                     </div>
                     <a class="btn btn-danger" href="{{asset('new_theme/add')}}" style="float: right;margin-top: 3%">Add Form</a>
                  </div>
                  <div class="m-portlet__body">
                     <!--begin: Search Form -->
                     <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                           <div class="col-xl-8 order-2 order-xl-1">
                              <div class="form-group m-form__group row align-items-center">
                                 <div class="col-md-4">
                                    <label for="exampleSelect1">Search</label>
                                    <div class="m-input-icon m-input-icon--left">
                                       <input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="m_form_search">
                                       <span class="m-input-icon__icon m-input-icon__icon--left">
                                       <span>
                                       <i class="la la-search"></i>
                                       </span>
                                       </span>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                       <label>Resolution Type</label>
                                       <select class="form-control m-input m-input--square" id="exampleSelect1">
                                          <option>Mhada resolutions</option>
                                          <option>MBR Resolutions</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                       <label>From Date</label>
                                       <input type="date" class="form-control m-input m-input--solid" placeholder="From Date">
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                       <label>To Date</label>
                                       <input type="date" class="form-control m-input m-input--solid" placeholder="From Date">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--end: Search Form -->
                     <!--begin: Datatable -->
                     <table class="m-datatable" id="html_table" width="100%">
                        <thead>
                           <tr>
                              <th title="Field #1">
                                 Sr Number
                              </th>
                              <th title="Field #2">
                                 Board Name
                              </th>
                              <th title="Field #3">
                                 Department Name
                              </th>
                              <th title="Field #4">
                                 Resolution Type
                              </th>
                              <th title="Field #5">
                                 Title/Subject
                              </th>
                              <th title="Field #6">
                                 Resolution Code
                              </th>
                              <th title="Field #7">
                                 Published Date
                              </th>
                              <th title="Field #8">
                                 Actions
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>
                                 1
                              </td>
                              <td>
                                 Zandra Fisbburne
                              </td>
                              <td>
                                 (916) 6137523
                              </td>
                              <td>
                                 Pontiac
                              </td>
                              <td>
                                 Grand Am
                              </td>
                              <td>
                                 Puce
                              </td>
                              <td>
                                 $75343.80
                              </td>
                              <td>
                                 <a title="Edit" href="http://localhost:8000/resolution/1/edit"><i class="icon-pencil"></i>Edit</a>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 2
                              </td>
                              <td>
                                 Mela Ord
                              </td>
                              <td>
                                 (331) 6613809
                              </td>
                              <td>
                                 Lamborghini
                              </td>
                              <td>
                                 Gallardo
                              </td>
                              <td>
                                 Aquamarine
                              </td>
                              <td>
                                 $46031.10
                              </td>
                              <td>
                                 <a title="Edit" href="http://localhost:8000/resolution/1/edit"><i class="icon-pencil"></i>Edit</a>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 3
                              </td>
                              <td>
                                 Ayn Garvin
                              </td>
                              <td>
                                 (360) 5221311
                              </td>
                              <td>
                                 Toyota
                              </td>
                              <td>
                                 Prius
                              </td>
                              <td>
                                 Maroon
                              </td>
                              <td>
                                 $93920.58
                              </td>
                              <td>
                                <a title="Edit" href="http://localhost:8000/resolution/1/edit"><i class="icon-pencil"></i>Edit</a>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <!--end: Datatable -->
                  </div>
               </div>
               <!-- END EXAMPLE TABLE PORTLET-->           
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
      <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
         <i class="la la-arrow-up"></i>
      </div>
      <!-- end::Footer -->    
      </div>
      <!-- end:: Page -->
      <!-- begin::Quick Sidebar -->
      <!-- end::Quick Sidebar -->       
      <!-- begin::Scroll Top -->
      <div id="m_scroll_top" class="m-scroll-top">
         <i class="la la-arrow-up"></i>
      </div>
      <!-- end::Scroll Top -->        <!-- begin::Quick Nav -->
      <!-- begin::Quick Nav --> 
      <!--begin::Base Scripts -->        
      <script src="{{asset('/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
      <script src="{{asset('/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
      <!--end::Base Scripts -->   
      <!--begin::Page Vendors Scripts -->
      <script src="{{asset('/assets/demo/default/custom/components/datatables/base/html-table.js')}}" type="text/javascript"></script>
      <!--DatatableHtmlTableDemo.init()-->
      <script>
         var DatatableHtmlTableDemo =function()
            {
               var e=function(){var e=$(".m-datatable").mDatatable
               ({
                  columnDefs: [
                  {
                      // The `data` parameter refers to the data for the cell (defined by the
                      // `data` option, which defaults to the column being worked with, in
                      // this case `data: 0`.
                      "render": function ( data, type, row ) {
                          return null;
                      },
                      "targets": 7
                  },
                  ]
               }),
                  a=e.getDataSourceQuery();
                  $("#m_form_search").on("keyup",function(a){e.search($(this).val().toLowerCase())}).val(a.generalSearch)};
                  return{init:function(){e()}}
            }
               ();
               jQuery(document).ready(function(){DatatableHtmlTableDemo.init();});
      </script>
      <!--end::Page Vendors Scripts -->
      <!--begin::Page Resources -->
   </body>
   <!-- end::Body -->
</html>
