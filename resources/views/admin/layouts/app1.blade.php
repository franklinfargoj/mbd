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
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{asset('/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{asset('/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{asset('/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{asset('/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        var baseUrl = "{{url('/')}}";
    </script>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
  <div class="page-wrapper">
      <!-- BEGIN HEADER -->
      <div class="page-header navbar navbar-fixed-top">
          <!-- BEGIN HEADER INNER -->
          <div class="page-header-inner ">
              <!-- BEGIN LOGO -->
              <div class="page-logo">
                  <a href="index.html">
                      <img src="../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
                  <div class="menu-toggler sidebar-toggler">
                      <span></span>
                  </div>
              </div>
              <!-- END LOGO -->
              <!-- BEGIN RESPONSIVE MENU TOGGLER -->
              <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                  <span></span>
              </a>
              <!-- END RESPONSIVE MENU TOGGLER -->
              <!-- BEGIN TOP NAVIGATION MENU -->
              <div class="top-menu">
                  <ul class="nav navbar-nav pull-right">
                      <!-- BEGIN NOTIFICATION DROPDOWN -->
                      <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                      <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                      <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                      <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                              <i class="icon-bell"></i>
                              <span class="badge badge-default"> 7 </span>
                          </a>
                          <ul class="dropdown-menu">
                              <li class="external">
                                  <h3>
                                      <span class="bold">12 pending</span> notifications</h3>
                                  <a href="page_user_profile_1.html">view all</a>
                              </li>
                              <li>
                                  <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                      <li>
                                          <a href="javascript:;">
                                              <span class="time">just now</span>
                                              <span class="details">
                                                  <span class="label label-sm label-icon label-success">
                                                      <i class="fa fa-plus"></i>
                                                  </span> New user registered. </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:;">
                                              <span class="time">3 mins</span>
                                              <span class="details">
                                                  <span class="label label-sm label-icon label-danger">
                                                      <i class="fa fa-bolt"></i>
                                                  </span> Server #12 overloaded. </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:;">
                                              <span class="time">10 mins</span>
                                              <span class="details">
                                                  <span class="label label-sm label-icon label-warning">
                                                      <i class="fa fa-bell-o"></i>
                                                  </span> Server #2 not responding. </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:;">
                                              <span class="time">14 hrs</span>
                                              <span class="details">
                                                  <span class="label label-sm label-icon label-info">
                                                      <i class="fa fa-bullhorn"></i>
                                                  </span> Application error. </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:;">
                                              <span class="time">2 days</span>
                                              <span class="details">
                                                  <span class="label label-sm label-icon label-danger">
                                                      <i class="fa fa-bolt"></i>
                                                  </span> Database overloaded 68%. </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:;">
                                              <span class="time">3 days</span>
                                              <span class="details">
                                                  <span class="label label-sm label-icon label-danger">
                                                      <i class="fa fa-bolt"></i>
                                                  </span> A user IP blocked. </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:;">
                                              <span class="time">4 days</span>
                                              <span class="details">
                                                  <span class="label label-sm label-icon label-warning">
                                                      <i class="fa fa-bell-o"></i>
                                                  </span> Storage Server #4 not responding dfdfdfd. </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:;">
                                              <span class="time">5 days</span>
                                              <span class="details">
                                                  <span class="label label-sm label-icon label-info">
                                                      <i class="fa fa-bullhorn"></i>
                                                  </span> System Error. </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:;">
                                              <span class="time">9 days</span>
                                              <span class="details">
                                                  <span class="label label-sm label-icon label-danger">
                                                      <i class="fa fa-bolt"></i>
                                                  </span> Storage server failed. </span>
                                          </a>
                                      </li>
                                  </ul>
                              </li>
                          </ul>
                      </li>
                      <!-- END NOTIFICATION DROPDOWN -->
                      <!-- BEGIN INBOX DROPDOWN -->
                      <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                      <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                              <i class="icon-envelope-open"></i>
                              <span class="badge badge-default"> 4 </span>
                          </a>
                          <ul class="dropdown-menu">
                              <li class="external">
                                  <h3>You have
                                      <span class="bold">7 New</span> Messages</h3>
                                  <a href="app_inbox.html">view all</a>
                              </li>
                              <li>
                                  <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                      <li>
                                          <a href="#">
                                              <span class="photo">
                                                  <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                              <span class="subject">
                                                  <span class="from"> Lisa Wong </span>
                                                  <span class="time">Just Now </span>
                                              </span>
                                              <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="#">
                                              <span class="photo">
                                                  <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                              <span class="subject">
                                                  <span class="from"> Richard Doe </span>
                                                  <span class="time">16 mins </span>
                                              </span>
                                              <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="#">
                                              <span class="photo">
                                                  <img src="../assets/layouts/layout3/img/avatar1.jpg" class="img-circle" alt=""> </span>
                                              <span class="subject">
                                                  <span class="from"> Bob Nilson </span>
                                                  <span class="time">2 hrs </span>
                                              </span>
                                              <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="#">
                                              <span class="photo">
                                                  <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                              <span class="subject">
                                                  <span class="from"> Lisa Wong </span>
                                                  <span class="time">40 mins </span>
                                              </span>
                                              <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="#">
                                              <span class="photo">
                                                  <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                              <span class="subject">
                                                  <span class="from"> Richard Doe </span>
                                                  <span class="time">46 mins </span>
                                              </span>
                                              <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                          </a>
                                      </li>
                                  </ul>
                              </li>
                          </ul>
                      </li>
                      <!-- END INBOX DROPDOWN -->
                      <!-- BEGIN TODO DROPDOWN -->
                      <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                      <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                              <i class="icon-calendar"></i>
                              <span class="badge badge-default"> 3 </span>
                          </a>
                          <ul class="dropdown-menu extended tasks">
                              <li class="external">
                                  <h3>You have
                                      <span class="bold">12 pending</span> tasks</h3>
                                  <a href="app_todo.html">view all</a>
                              </li>
                              <li>
                                  <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                      <li>
                                          <a href="javascript:;">
                                              <span class="task">
                                                  <span class="desc">New release v1.2 </span>
                                                  <span class="percent">30%</span>
                                              </span>
                                              <span class="progress">
                                                  <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                      <span class="sr-only">40% Complete</span>
                                                  </span>
                                              </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:;">
                                              <span class="task">
                                                  <span class="desc">Application deployment</span>
                                                  <span class="percent">65%</span>
                                              </span>
                                              <span class="progress">
                                                  <span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                      <span class="sr-only">65% Complete</span>
                                                  </span>
                                              </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:;">
                                              <span class="task">
                                                  <span class="desc">Mobile app release</span>
                                                  <span class="percent">98%</span>
                                              </span>
                                              <span class="progress">
                                                  <span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
                                                      <span class="sr-only">98% Complete</span>
                                                  </span>
                                              </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:;">
                                              <span class="task">
                                                  <span class="desc">Database migration</span>
                                                  <span class="percent">10%</span>
                                              </span>
                                              <span class="progress">
                                                  <span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                      <span class="sr-only">10% Complete</span>
                                                  </span>
                                              </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:;">
                                              <span class="task">
                                                  <span class="desc">Web server upgrade</span>
                                                  <span class="percent">58%</span>
                                              </span>
                                              <span class="progress">
                                                  <span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                                                      <span class="sr-only">58% Complete</span>
                                                  </span>
                                              </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:;">
                                              <span class="task">
                                                  <span class="desc">Mobile development</span>
                                                  <span class="percent">85%</span>
                                              </span>
                                              <span class="progress">
                                                  <span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                      <span class="sr-only">85% Complete</span>
                                                  </span>
                                              </span>
                                          </a>
                                      </li>
                                      <li>
                                          <a href="javascript:;">
                                              <span class="task">
                                                  <span class="desc">New UI release</span>
                                                  <span class="percent">38%</span>
                                              </span>
                                              <span class="progress progress-striped">
                                                  <span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
                                                      <span class="sr-only">38% Complete</span>
                                                  </span>
                                              </span>
                                          </a>
                                      </li>
                                  </ul>
                              </li>
                          </ul>
                      </li>
                      <!-- END TODO DROPDOWN -->
                      <!-- BEGIN USER LOGIN DROPDOWN -->
                      <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                      <li class="dropdown dropdown-user">
                          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                              <img alt="" class="img-circle" src="../assets/layouts/layout/img/avatar3_small.jpg" />
                              <span class="username username-hide-on-mobile"> Nick </span>
                              <i class="fa fa-angle-down"></i>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-default">
                              <li>
                                  <a href="page_user_profile_1.html">
                                      <i class="icon-user"></i> My Profile </a>
                              </li>
                              <li>
                                  <a href="app_calendar.html">
                                      <i class="icon-calendar"></i> My Calendar </a>
                              </li>
                              <li>
                                  <a href="app_inbox.html">
                                      <i class="icon-envelope-open"></i> My Inbox
                                      <span class="badge badge-danger"> 3 </span>
                                  </a>
                              </li>
                              <li>
                                  <a href="app_todo.html">
                                      <i class="icon-rocket"></i> My Tasks
                                      <span class="badge badge-success"> 7 </span>
                                  </a>
                              </li>
                              <li class="divider"> </li>
                              <li>
                                  <a href="page_user_lock_1.html">
                                      <i class="icon-lock"></i> Lock Screen </a>
                              </li>
                              <li>
                                  <a href="page_user_login_1.html">
                                      <i class="icon-key"></i> Log Out </a>
                              </li>
                          </ul>
                      </li>
                      <!-- END USER LOGIN DROPDOWN -->
                      <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                      <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                      <li class="dropdown dropdown-quick-sidebar-toggler">
                          <a href="javascript:;" class="dropdown-toggle">
                              <i class="icon-logout"></i>
                          </a>
                      </li>
                      <!-- END QUICK SIDEBAR TOGGLER -->
                  </ul>
              </div>
              <!-- END TOP NAVIGATION MENU -->
          </div>
          <!-- END HEADER INNER -->
      </div>
      <!-- END HEADER -->
      <!-- BEGIN HEADER & CONTENT DIVIDER -->
      <div class="clearfix"> </div>
      <!-- END HEADER & CONTENT DIVIDER -->
      <!-- BEGIN CONTAINER -->
      <div class="page-container">
           @include('admin.layouts.sidebar')
          <!-- BEGIN CONTENT -->
          <div class="page-content-wrapper">
              <!-- BEGIN CONTENT BODY -->
              <div class="page-content">
                  <!-- BEGIN PAGE HEADER-->
                  @yield('content')
                  <!-- BEGIN PAGE BAR -->
                  <!-- END PAGE TITLE-->
                  <!-- END PAGE HEADER-->
              </div>
              <!-- END CONTENT BODY -->
          </div>
          <!-- END CONTENT -->

      </div>
      <!-- END CONTAINER -->
      <!-- BEGIN FOOTER -->
      <div class="page-footer">
          <div class="page-footer-inner"> {{date('Y')}} &copy; {{env('APP_NAME')}}
          </div>
          <div class="scroll-to-top">
              <i class="icon-arrow-up"></i>
          </div>
      </div>
      <!-- END FOOTER -->
  </div>
  <!-- BEGIN QUICK NAV -->
  </div>
    <script src="{{asset('/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('/plugins/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/horizontal-timeline/horizontal-timeline.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/datatables/datatables.all.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{asset('/scripts/app.min.js')}}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->

    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{asset('/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
    <script>
        $(document).ready(function()
        {
            $('#clickmewow').click(function()
            {
                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script>
    <script type="text/javascript" src="{{ asset('/js/custom.js') }}"></script>
    @yield('js')
    <script>
      loadDepartmentsOfBoard();

      $('#board_id').change(function(){
        loadDepartmentsOfBoard();
      });

      function loadDepartmentsOfBoard()
      {
        var board_id = $('#board_id').val();
        if(board_id != "")
        {
          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            data:{
              board_id:board_id
            },
            url:"{{ route('loadDepartmentsOfBoardUsingAjax') }}",
            success:function(res){
              $('#department_id').html(res);
            }
          });
        }
      }
    </script>
</body>
</html>