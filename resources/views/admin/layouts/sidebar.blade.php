<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->

            <li class="nav-item start ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start ">
                        <a href="index.html" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">Dashboard 1</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="dashboard_2.html" class="nav-link ">
                            <i class="icon-bulb"></i>
                            <span class="title">Dashboard 2</span>
                            <span class="badge badge-success">1</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="dashboard_3.html" class="nav-link ">
                            <i class="icon-graph"></i>
                            <span class="title">Dashboard 3</span>
                            <span class="badge badge-danger">5</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{(str_contains(Request::path(), 'faq') === true)?' active':''}} ">
                <a href="{{url('/faq')}}" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">FAQ</span>
                    {!! (str_contains(Request::path(), 'faq') === true)?'<span class="selected"></span>':'' !!}

                </a>
            </li>

            <li class="nav-item {{(str_contains(Request::path(), 'board') === true)?' active':''}} ">
                <a href="{{url('/board')}}" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Boards</span>
                    {!! (str_contains(Request::path(), 'board') === true)?'<span class="selected"></span>':'' !!}

                </a>
            </li>

            <li class="nav-item {{(str_contains(Request::path(), 'department') === true)?' active':''}} ">
                <a href="{{url('/department')}}" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Departments</span>
                    {!! (str_contains(Request::path(), 'department') === true)?'<span class="selected"></span>':'' !!}
                </a>
            </li>
            <li class="nav-item {{(str_contains(Request::path(), '_form') === true)?' active':''}} ">
                <a href="{{url('/rti_form')}}" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">RTI Forms</span>
                    {!! (str_contains(Request::path(), '_form') === true)?'<span class="selected"></span>':'' !!}
                </a>
            </li>

            <li class="nav-item {{(str_contains(Request::path(), 'resolution') === true)?' active':''}} ">
                <a href="{{url('/resolution')}}" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Resolutions</span>
                    {!! (str_contains(Request::path(), 'resolution') === true)?'<span class="selected"></span>':'' !!}

                </a>
            </li>

            @php
                if (Request::is('hearing') || Request::is('hearing/*') || Request::is('schedule_hearing/*')  || Request::is('fix_schedule/*'))
                {
                    $class = "open";
                    $style = "display:block";
                }
                else
                {
                    $class = "";
                    $style = "display:none";
                }

            @endphp

            <li class="nav-item {{ $class }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Hearing</span>
                    <span class="arrow {{ $class }}"></span>
                </a>
                <ul class="sub-menu" style ="{{ $style }}">
                    <li class="nav-item {{ Request::is('hearing/create') ? 'active' : '' }}">
                        <a href="{{ url('/hearing/create') }}" class="nav-link ">
                            <i class="icon-diamond"></i>
                            <span class="title">Add Hearing</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ Request::is('hearing') ? 'active' : '' }}">
                        <a href="{{ url('hearing') }}" class="nav-link ">
                            <i class="icon-diamond"></i>
                            <span class="title">List Hearing</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{(str_contains(Request::path(), 'village_detail') === true)?' active':''}} ">
                <a href="{{url('/village_detail')}}" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Land</span>
                    {!! (str_contains(Request::path(), 'village_detail') === true)?'<span class="selected"></span>':'' !!}

                </a>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
