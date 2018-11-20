<!-- BEGIN: Left Aside -->
@php
    $route="";
    $route=\Request::route()->getName();
@endphp
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->

    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " style="position: relative;">
        <div class="m-scrollable m-scroller ps ps--active-y" data-scrollbar-shown="true" data-scrollable="true"
             data-max-height="100vh">
            <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow">
            @php
            $superadmin_dashboard = ['roles.index','superadmin.dashboard'];
            @endphp

                @if(session()->get('permission') && in_array('superadmin.dashboard', $superadmin_dashboard) )
                    <li class="m-menu__item {{($route=='superadmin.dashboard')?'m-menu__item--active':''}}">
                        <a href="{{ route('superadmin.dashboard') }}" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-icon flaticon-line-graph"></i>
                            <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Dashboard
                                </span>
                            </span>
                        </span>
                        </a>
                    </li>
                @endif
                {{--Role--}}
                    <li class="m-menu__item collapsed" data-toggle="collapse" data-target="#role-actions">
                        <a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-icon flaticon-line-graph"></i>
                            <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Roles
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </span>
                        </span>
                        </a>
                    </li>
                    <li id="role-actions" class="collapse">
                        <ul class="list-unstyled">
                            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='roles.index')?'m-menu__item--active':''}}">
                                <a class="m-menu__link m-menu__toggle" title="Listing Role" href="{{ route('roles.index')}}">
                                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                              fill="#FFF" />
                                    </svg>
                                    <span class="m-menu__link-text">Role Listing</span>
                                </a>
                            </li>
                            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='roles.create')?'m-menu__item--active':''}}">
                                <a class="m-menu__link m-menu__toggle" title="Create Role" href="{{ route('roles.create')}}">
                                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                              fill="#FFF" />
                                    </svg>
                                    <span class="m-menu__link-text">Add Role</span>
                                </a>
                            </li>
                            {{--if radio button comes in picture--}}
                            {{--@include('admin.crud_admin.role.actions')--}}

                        </ul>
                    </li>

                {{--Application Status--}}
                <li class="m-menu__item collapsed" data-toggle="collapse" data-target="#applicationstatus-actions">
                    <a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Application status
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </span>
                        </span>
                    </a>
                </li>
                <li id="applicationstatus-actions" class="collapse show">
                    <ul class="list-unstyled">
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='application_status.index')?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" title="Listing Application Status" href="{{ route('application_status.index')}}">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                          fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">Status Listing</span>
                            </a>
                        </li>
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='application_status.create')?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" title="Create Application Status" href="{{ route('application_status.create')}}">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                          fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">Add Status</span>
                            </a>
                        </li>
                        {{--if radio button comes in picture--}}
                        {{--@include('admin.crud_admin.apllication_status.actions')--}}

                    </ul>
                </li>

            </ul>
        </div>
    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
@section('js')
    {{--<script>--}}
        {{--$(document).on("click", ".collapsed", function () {--}}
            {{--var id = $(this).attr('data-target');--}}

            {{--$('id').addClass('show');--}}

        {{--});--}}

{{--//        $(document).ready(function () {--}}
{{--//--}}
{{--//            alert($('.collapsed').attr('data-target'));--}}
{{--//        });--}}

    {{--</script>--}}
@endsection
