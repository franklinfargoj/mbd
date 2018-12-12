<!-- BEGIN: Left Aside -->
@php
$route="";
$route=\Request::route()->getName();
@endphp

{{--@php--}}`
    {{--dd((\Illuminate\Support\Facades\Request::is('lease_detail/*')--}}
                                            {{--&& (isset($count) && ($count==0)))--}}
                                            {{--|| \Illuminate\Support\Facades\Request::is('lease_detail/create/*')--}}
                                            {{--|| \Illuminate\Support\Facades\Request::is('lease_detail/view-lease/*')--}}
                                            {{--|| \Illuminate\Support\Facades\Request::is('lease_detail/edit-lease/*'));--}}
{{--@endphp--}}

<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    @php
    $land_permission = ['village_detail.index', 'village_detail.create', 'village_detail.edit',
    'village_detail.update', 'village_detail.destroy',
    'loadDeleteVillageUsingAjax', 'village_detail.store', 'society_detail.index', 'society_detail.create',
    'society_detail.store',
    'lease_detail.index', 'lease_detail.create', 'lease_detail.store', 'renew-lease.renew', 'renew-lease.update-lease'
    ];
    @endphp

    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " style="position: relative;">
        <div class="m-scrollable m-scroller ps ps--active-y" data-scrollbar-shown="true" data-scrollable="true"
            data-max-height="100vh">
            <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow">

                @if(session()->get('permission') && in_array('dashboard', session()->get('permission')) || (strpos($route,'dashboard') !== false) || (strpos($route,'detail') !== false))
                <li class="m-menu__item {{(strpos($route,'dashboard') !== false)?'m-menu__item--active':''}}">
                    <a href="{{ session()->get('dashboard') }}" class="m-menu__link m-menu__toggle">
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

                {{--@if(session()->get('permission') && in_array('architect_layout_dashboard', session()->get('permission')))--}}
                {{--<li class="m-menu__item {{($route=='architect_layout_dashboard')?'m-menu__item--active':''}}" aria-haspopup="true">--}}
                    {{--<a href="{{ url('architect_layout_dashboard') }}" class="m-menu__link ">--}}
                        {{--<i class="m-menu__link-icon flaticon-line-graph"></i>--}}
                        {{--<span class="m-menu__link-title">--}}
                        {{--<span class="m-menu__link-wrap">--}}
                            {{--<span class="m-menu__link-text">--}}
                                {{--Dashboard--}}
                            {{--</span>--}}
                        {{--</span>--}}
                    {{--</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--@endif--}}


                @if(session()->get('permission') && (in_array('architect_application', session()->get('permission')) ||
                in_array('view_architect_application',
                session()->get('permission')) || in_array('evaluate_architect_application',
                session()->get('permission'))
                ||
                in_array('shortlisted_architect_application', session()->get('permission')) ||
                in_array('final_architect_application',
                session()->get('permission')) || in_array('save_evaluate_marks', session()->get('permission')) ||
                in_array('generate_certificate', session()->get('permission')) ||
                in_array('forward_application', session()->get('permission')) ||
                in_array('finalCertificateGenerate', session()->get('permission')) ||
                in_array('tempCertificateGenerate', session()->get('permission')) ||
                in_array('postfinalCertificateGenerate', session()->get('permission')) ||
                in_array('architect.edit_certificate', session()->get('permission')) ||
                in_array('architect.update_certificate', session()->get('permission'))||
                in_array('architect.post_final_signed_certificate', session()->get('permission'))))


                <li class="m-menu__item {{($route=='architect_application')?'m-menu__item--active':''}}" aria-haspopup="true">
                    <a href="{{ url(session()->get('redirect_to')) }}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Appointing Architect
                                </span>
                            </span>
                        </span>
                    </a>
                </li>
                @endif

                @if(session()->get('permission') != "" && in_array('resolution.index', session()->get('permission')))
                <li class="m-menu__item {{ ($route == 'resolution.index' ? 'm-menu__item--active' : '') }}"
                    aria-haspopup="true">
                    <a href="{{ url('/resolution') }}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Resolution Listing
                                </span>
                            </span>
                        </span>
                    </a>
                </li>

                <li class="m-menu__item {{ ($route == 'resolution.create' ? 'm-menu__item--active' : '') }}"
                    aria-haspopup="true">
                    <a href="{{route('resolution.create')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Add Resolution
                                </span>
                            </span>
                        </span>
                    </a>
                </li>
                @endif

                @if(session()->get('permission') != "" && in_array('appointing_architect.index',
                session()->get('permission')))
                <li class="m-menu__item {{ ($route == 'appointing_architect.index' ? 'm-menu__item--active' : '') }}"
                    aria-haspopup="true">
                    <a href="{{ route('appointing_architect.index') }}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Applications
                                </span>
                            </span>
                        </span>
                    </a>
                </li>
                @endif

                @if(session()->get('permission') && in_array('rti_applicants', session()->get('permission')))
                <li class="m-menu__item">
                    <a href="{{url('/rti_applicants')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    RTI Applicants
                                </span>
                            </span>
                        </span>
                    </a>
                </li>
                @endif

                @php
                $hearing_permission = ['hearing.show', 'hearing.index', 'hearing.store', 'hearing.create',
                'hearing.destroy', 'hearing.update', 'hearing.edit', 'loadDeleteReasonOfHearingUsingAjax',
                'schedule_hearing.add', 'schedule_hearing.store',
                'fix_schedule.add', 'fix_schedule.store', 'fix_schedule.edit', 'fix_schedule.update',
                'upload_case_judgement.add', 'upload_case_judgement.store', 'upload_case_judgement.edit',
                'upload_case_judgement.update',
                'forward_case.create', 'forward_case.store', 'forward_case.edit', 'forward_case.update',
                'send_notice_to_appellant.create', 'send_notice_to_appellant.store', 'send_notice_to_appellant.edit',
                'send_notice_to_appellant.update',
                'hearing.dashboard',
                ];
                @endphp

                @if(session()->get('permission') && in_array('hearing.dashboard', session()->get('permission')))
                <li class="m-menu__item {{($route=='hearing.dashboard')?'m-menu__item--active':''}}">
                    <a href="{{ url('hearing-dashboard') }}" class="m-menu__link m-menu__toggle">
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


                {{-- @if(!empty(array_intersect($hearing_permission, session()->get('permission'))))--}}
                @if(session()->get('permission') && in_array('hearing.index', session()->get('permission')))
                <li class="m-menu__item {{($route=='hearing.index')?'m-menu__item--active':''}}">
                    <a href="{{ url('hearing') }}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    List of Hearings
                                </span>
                            </span>
                        </span>
                    </a>
                </li>
                @if(Auth::user()->name == 'Joint CO PA' || Auth::user()->name == 'CO PA')
                <li class="m-menu__item {{($route=='hearing.create')?'m-menu__item--active':''}}">
                    <a href="{{route('hearing.create')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Add Hearing
                                </span>
                            </span>
                        </span>
                    </a>
                </li>
                @endif
                @endif



                {{-- @if(!empty(array_intersect($land_permission, session()->get('permission'))))--}}
                @if(session()->get('permission') && in_array('village_detail.index', session()->get('permission')))
                <li class="m-menu__item m-menu__item--icon {{($route!='architect_layout.index' && $route!='architect_layouts_layout_details.index')?'':'collapsed'}}"
                    data-toggle="collapse" data-target="#land-module-actions">
                    <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    <img class="sidebar-icon" src="{{ asset('/img/sidebar/land-icon.svg')}}">Land
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </span>
                        </span>
                    </a>
                    {{-- <div class="m-menu__submenu" m-hidden-height="160" style=""><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">

                            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle"><img class="radio-icon"
                                        src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Land
                                        Detail
                                        {{$route}}</span></img></a>
                            </li>
                            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                <a href="{{route('society_detail.index')}}" class="m-menu__link m-menu__toggle"><img
                                        class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Society
                                        Detail</span></i></a>
                            </li>
                        </ul>
                    </div> --}}
                </li>
                <li id="land-module-actions" class="collapse {{($route!='architect_layout.index' && $route!='architect_layouts_layout_details.index')?'show':''}}">
                    <ul class="list-unstyled">
                        <li class="m-menu__item m-menu__item--level-2 {{($route=='village_detail.index' || $route=='village_detail.edit'|| $route=='village_detail.show' || $route=='village_detail.create')?  '' :'collapsed'}}"
                            data-toggle="collapse" data-target="#village-actions">
                            <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
                                {{--<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">--}}
                                    {{--<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        --}} {{--fill="#FFF" />--}} {{--</svg>--}} <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                Land Details
                                            </span>
                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                        </span>
                                        </span>
                            </a>
                            <!-- <div class="m-menu__submenu" m-hidden-height="160" style=""><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                            <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle"><img class="radio-icon"
                                    src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Land Detail
                                    {{$route}}</span></i></a>
                        </li>
                        <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                            <a href="{{route('society_detail.index')}}" class="m-menu__link m-menu__toggle"><img class="radio-icon"
                                    src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Society
                                    Detail</span></i></a>
                        </li>
                    </ul>
                </div> -->
                        </li>
                        <li id="village-actions" class="collapse m-menu__item--level-3 {{($route=='village_detail.index' || $route=='village_detail.edit'|| $route=='village_detail.show' || $route=='village_detail.create')?  'show' :''}}">
                            <ul class="list-unstyled">
                                <li class="m-menu__item m-menu__item--submenu {{($route=='village_detail.index' || $route=='village_detail.edit'|| $route=='village_detail.show')?'m-menu__item--active':''}}">
                                    <a class="m-menu__link m-menu__toggle" href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-text">List of Lands</span></a>
                                </li>
                                <li class="m-menu__item m-menu__item--submenu {{($route=='village_detail.create')?'m-menu__item--active':''}}">
                                    <a class="m-menu__link m-menu__toggle" href="{{route('village_detail.create')}}"
                                        class="m-menu__link m-menu__toggle">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-text">Add Land</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="m-menu__item m-menu__item--level-2 {{ ($route=='society_detail.index' || $route=='society_detail.show' || $route=='society_detail.edit' || $route=='society_detail.show_end_date_lease' || $route=='society_detail.create')? '':'collapsed' }}"
                            data-toggle="collapse" data-target="#society-actions">
                            <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            <img class="sidebar-icon" src="{{ asset('/img/sidebar/society-details-icon.svg')}}">Society Details
                                        </span>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </span>
                                </span>
                            </a>
                            <!-- <div class="m-menu__submenu" m-hidden-height="160" style=""><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">

                    <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle"><img class="radio-icon"
                                src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Land Detail
                                {{$route}}</span></i></a>
                    </li>
                    <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="{{route('society_detail.index')}}" class="m-menu__link m-menu__toggle"><img class="radio-icon"
                                src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Society
                                Detail</span></i></a>
                    </li>
                </ul>
            </div> -->
                        </li>
                        <li id="society-actions" class="collapse m-menu__item--level-3 {{ ($route=='society_detail.index' || $route=='society_detail.show' || $route=='society_detail.edit' || $route=='society_detail.show_end_date_lease' || $route=='society_detail.create')? 'show':'' }}">
                            <ul class="list-unstyled">
                                <li class="m-menu__item m-menu__item--submenu {{($route=='society_detail.index' || $route=='society_detail.show' || $route=='society_detail.edit' || $route=='society_detail.show_end_date_lease' )?'m-menu__item--active':''}}">
                                    <a class="m-menu__link m-menu__toggle" href="{{url('/society_detail')}}" class="m-menu__link m-menu__toggle">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-text">List of Societies</span></a>
                                </li>
                                <li class="m-menu__item m-menu__item--submenu {{($route=='society_detail.create')?'m-menu__item--active':''}}">
                                    <a class="m-menu__link m-menu__toggle" href="{{route('society_detail.create')}}"
                                        class="m-menu__link m-menu__toggle">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-text">Add Society</span></a>
                                </li>
                            </ul>
                        </li>

                        @if(\Illuminate\Support\Facades\Request::is('lease_detail/*') || (strpos($route,'village_detail') !== false) || (strpos($route,'renew-lease') !== false) || (strpos($route,'architect_layout') !== false) || (strpos($route,'society_detail') !== false) || $route =='land.dashboard')
                        <li class="m-menu__item m-menu__item--level-2 {{($route=='lease_detail.index' || $route=='view-lease.view' || $route=='edit-lease.edit' || $route=='lease_detail.create')? '' : 'collapsed'}}"
                            data-toggle="collapse" data-target="#lease-actions">
                            <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Lease Details
                                        </span>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </span>
                                </span>
                            </a>
                        </li>
                        @endif
                        <li id="lease-actions" class="collapse m-menu__item--level-3 {{($route=='lease_detail.index' || $route=='view-lease.view' || $route=='edit-lease.edit' || $route=='lease_detail.create' || strpos($route,'renew-lease') !== false)? 'show' : ''}}">
                            <ul class="list-unstyled">


                                {{--@if(\Illuminate\Support\Facades\Request::is('village_detail')--}}
                                 {{--|| \Illuminate\Support\Facades\Request::is('village_detail/*'))--}}
                                {{--@endif--}}

                                {{--@if(\Illuminate\Support\Facades\Request::is('society_detail')--}}
                                     {{--|| \Illuminate\Support\Facades\Request::is('society_detail/*'))--}}
                                {{--@endif--}}
                                    {{--@php dd($route); @endphp--}}
                                @if((strpos($route,'village_detail') !== false)
                                    || (strpos($route,'lease_detail') !== false)
                                    || (strpos($route,'society_detail') !== false)
                                    || (strpos($route,'architect_layout') !== false)
                                    || (strpos($route,'renew-lease') !== false)
                                    || (strpos($route,'view-lease') !== false)
                                    || (strpos($route,'edit-lease') !== false)
                                    || ($route == 'land.dashboard')
                                  )

                                        @php
                                            if((strpos($route,'village_detail') !== false) || (strpos($route,'society_detail') !== false) || (strpos($route,'architect_layouts') !== false)){

                                                $id = '0' ;
                                            }else{
                                                $id = collect(request()->segments())->last();
                                            }
                                        @endphp
                                        <li class="m-menu__item m-menu__item--submenu {{ ($route=='lease_detail.index' || (strpos($route,'view-lease') !== false) || $route=='edit-lease.edit')?'m-menu__item--active':''}}">
                                            <a class="m-menu__link m-menu__toggle"
                                               href="{{ route('lease_detail.index', $id)}}"
                                               class="m-menu__link m-menu__toggle">
                                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     viewBox="0 0 510 510">
                                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                          fill="#FFF" />
                                                </svg>
                                                <span class="m-menu__link-text">List of Lease</span></a>
                                        </li>

                                        @if((strpos($route,'lease_detail') !== false)|| (strpos($route,'renew-lease') !== false) || (strpos($route,'view-lease') !== false) || (strpos($route,'edit-lease') !== false))
                                            @if(isset($count) && ($count==0) && ($id != 0) || ($route=='lease_detail.create'))
                                                <li class="m-menu__item m-menu__item--submenu {{($route=='lease_detail.create')?'m-menu__item--active':''}}">
                                                    <a class="m-menu__link m-menu__toggle" href="{{route('lease_detail.create', $id)}}"
                                                       class="m-menu__link m-menu__toggle">
                                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             viewBox="0 0 510 510">
                                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                                  fill="#FFF" />
                                                        </svg>
                                                        <span class="m-menu__link-text">Add Lease</span></a>
                                                </li>
                                            @endif
                                            @if(isset($count) && ($count != 0) && ($id != 0))
                                                <li class="m-menu__item m-menu__item--submenu {{($route=='renew-lease.renew')?'m-menu__item--active':''}}">
                                                    <a class="m-menu__link m-menu__toggle" href="{{route('renew-lease.renew', $id)}}"
                                                       class="m-menu__link m-menu__toggle">
                                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             viewBox="0 0 510 510">
                                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                                  fill="#FFF" />
                                                        </svg>
                                                        <span class="m-menu__link-text">Renew Lease</span></a>
                                                </li>
                                            @endif
                                        @endif
                                    @endif


                            </ul>
                        </li>
                    </ul>
                </li>
                @endif

                    @if(session()->get('permission') && (in_array('architect_layout.index', session()->get('permission'))
                    ||
                    in_array('architect_layouts_layout_details.index',
                    session()->get('permission')) || in_array('architect_layout_details.view',
                    session()->get('permission'))
                    ||
                    in_array('forward_architect_layout', session()->get('permission')) ||
                    in_array('architect_layout_get_scrtiny',
                    session()->get('permission')) || in_array('architect_layout_add_scrutiny_report',
                    session()->get('permission')) ||
                    in_array('architect_layout_detail_view_cts_plan', session()->get('permission')) ||
                    in_array('architect_layout_detail_view_prc_detail', session()->get('permission')) ||
                    in_array('architect_detail_dp_crz_remark_view', session()->get('permission')) ||
                    in_array('view_court_case_or_dispute_on_land', session()->get('permission')) ||
                    in_array('architect_layout_add_scrutiny_report', session()->get('permission')) ))
                        
                        <li class="m-menu__item {{($route=='architect_layout.index' || $route=='architect_layouts_layout_details.index' || $route=='architect_layout.add')?'':'collapsed'}}"
                            data-toggle="collapse" data-target="#architect-layouts">
                            <a href="{{ route('architect_layout.index') }}" class="m-menu__link m-menu__toggle">
                                <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    <img class="sidebar-icon" src="{{ asset('/img/sidebar/architect-layouts-icon.svg')}}">Architect Layouts
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </span>
                        </span>
                            </a>
                        </li>

                        <li id="architect-layouts" class="collapse {{($route=='architect_layout.index'|| $route=='architect_layouts_layout_details.index' || $route=='architect_layout.add')?'show':''}}">
                            <ul class="list-unstyled">
                                @if(session()->get('role_name')=='junior_architect')
                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='architect_layout.add')?'m-menu__item--active':''}}"
                                        aria-haspopup="true">
                                        <a href="{{ route('architect_layout.add') }}" class="m-menu__link m-menu__toggle">
                                            <i class="m-menu__link-icon flaticon-line-graph"></i>
                                            <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Add Layout
                                        </span>
                                    </span>
                                </span>
                                        </a>
                                    </li>
                                @endif
                                <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='architect_layout.index' || $route=='architect_layouts_layout_details.index')?'m-menu__item--active':''}}"
                                    aria-haspopup="true">
                                    <a href="{{ route('architect_layout.index') }}" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                                        <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                           Layouts & Revision Requests
                                        </span>
                                    </span>
                                </span>
                                    </a>
                                </li>
                                {{-- <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='architect_layouts_layout_details.index')?'m-menu__item--active':''}}"
                                    aria-haspopup="true">
                                    <a href="{{ route('architect_layouts_layout_details.index') }}" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                                        <span class="m-menu__link-title">
                                            <span class="m-menu__link-wrap">
                                                <span class="m-menu__link-text">
                                                    Layout Details
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                    @endif
                                     

<!-- Tabs for Estate and Conveyance -->
 @if(session()->get('permission') && (( in_array('conveyance.index', session()->get('permission')) || in_array('renewal.index', session()->get('permission')) || in_array('get_sf_applications.index', session()->get('permission')) ) ))
    <li class="m-menu__item {{($route=='conveyance.index' || $route=='renewal.index' || $route=='get_sf_applications.index')?'':'collapsed'}}" data-toggle="collapse" data-target="#estate-actions">
        <a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
            <i class="m-menu__link-icon flaticon-line-graph"></i>
            <span class="m-menu__link-title">
                <span class="m-menu__link-wrap">
                    <span class="m-menu__link-text">
                        Estate & Conveyance
                    </span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </span>
            </span>
        </a>
    </li>

    <li id="estate-actions" class="collapse {{($route=='conveyance.index' || $route=='renewal.index' || $route=='get_sf_applications.index')? 'show' : ''}}"> 
        <ul class="list-unstyled">           
            @if(session()->get('permission') && (in_array('conveyance.index', session()->get('permission')) ))
                <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route=='conveyance.index') ? 'm-menu__item--active' : '' }}">
                    <a href="{{ route('conveyance.index') }}" class="m-menu__link m-menu__toggle">
                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z" fill="#FFF" />
                        </svg>
                        <span class="m-menu__link-text">
                            Society Conveyance Applications
                        </span>
                    </a>
                </li>
            @endif
  
            @if(session()->get('permission') && (in_array('renewal.index', session()->get('permission')) ))

            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route=='renewal.index') ? 'm-menu__item--active' : '' }}">
                <a href="{{ route('renewal.index') }}" class="m-menu__link m-menu__toggle">
                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z" fill="#FFF" />
                    </svg>
                    <span class="m-menu__link-text">
                        Society Renewal Applications
                    </span>
                </a>
            </li>                        
            @endif

            @if(in_array('get_sf_applications.index',session()->get('permission')))
            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route=='get_sf_applications.index') ? 'm-menu__item--active' : '' }}">
                <a href="{{ route('get_sf_applications.index') }}" class="m-menu__link m-menu__toggle">
                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z" fill="#FFF" />
                    </svg>
                    <span class="m-menu__link-text">
                        Society Formation Applications
                    </span>
                </a>
            </li>
            @endif 
        </ul> 
    </li> 
@endif        
<!-- end of Estate of Conveyance -->

                @if(session()->get('permission') && (in_array('vp.index', session()->get('permission')) ||
                in_array('ee.index',
                session()->get('permission')) || in_array('dyce.index', session()->get('permission')) ||
                in_array('ree_applications.index', session()->get('permission')) || in_array('co.index',
                session()->get('permission')) || in_array('cap.index', session()->get('permission')) ||
                in_array('society_offer_letter.index', session()->get('permission')) ||
                in_array('architect_layout.index', session()->get('permission')) || in_array('dyco.index', session()->get('permission')) || in_array('hearing.index', session()->get('permission')) ))

                @if (isset($route) && ($route == 'co.index' || $route=='ee.index' || $route=='dyce.index' || $route=='co_applications.reval' || $route=='co_applications.noc' || $route == 'ree_applications.noc_cc' || $route == 'co_applications.noc_cc' ||
                $route=='ree_applications.index' || $route=='ree_applications.reval' || $route == 'ree_applications.noc' || $route=='cap.index' || $route=='cap_applications.reval' || $route=='vp.index' ||
                $route=='society_offer_letter.index' || $route=='society_offer_letter_dashboard' ||
                $route=='documents_uploaded' || $route=='documents_upload'))

                <li class="m-menu__item" data-toggle="collapse" data-target="#society-actions">
                    <a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Applications
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </span>
                        </span>
                    </a>
                </li>
                @endif

                <li id="society-actions" class="collapse show">
                    <ul class="list-unstyled">
                        @if (isset($route) && ($route == 'co.index' || $route=='ee.index' || $route=='dyce.index' || $route=='co_applications.reval' || $route=='co_applications.noc' || $route=='vp_applications.reval' ||
                        $route=='ree_applications.index' || $route=='ree_applications.reval' || $route == 'ree_applications.noc' || $route == 'ree_applications.noc_cc' || $route == 'co_applications.noc_cc' || $route=='cap.index' || $route=='cap_applications.reval' ||$route=='vp.index' ||
                        $route=='society_offer_letter.index' || $route=='society_offer_letter_dashboard' ||
                        $route=='documents_uploaded' || $route=='documents_upload') || (strpos($route,'dashboard') !== false) && $route !='land.dashboard')

                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2  {{( $route=='ee.index' || $route=='dyce.index' || $route=='ree_applications.index' || $route=='co.index' || $route=='cap.index' || $route=='vp.index' || $route=='society_offer_letter.index' || $route=='society_offer_letter_dashboard' || $route=='documents_uploaded' || $route=='documents_upload')?'m-menu__item--active':''}}">
                            <a href="{{ url(session()->get('redirect_to')) }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">
                                    Offer Letter
                                </span>
                            </a>
                        </li>
                        @endif


                        @if (isset($route) && ($route == 'co.index' || $route=='society_detail.index' ||
                        $route=='village_detail.index' || $route=='ee.index' || $route=='dyce.index' || $route=='ree_applications.reval' || $route == 'ree_applications.noc' || $route=='vp_applications.reval' ||
                        $route=='ree_applications.index' || $route=='co_applications.reval' || $route=='co_applications.noc' || $route == 'ree_applications.noc_cc' || $route == 'co_applications.noc_cc' || $route=='cap.index' || $route=='cap_applications.reval' || $route=='vp.index' ||
                        $route=='society_offer_letter.index' || $route=='society_offer_letter_dashboard' ||
                        $route=='documents_uploaded' || $route=='documents_upload'))

                                @php
                                $reval_redirect_to = "";
                                if(Session::all()['role_name'] == 'REE Junior Engineer' || Session::all()['role_name'] ==  'REE deputy Engineer' || Session::all()['role_name'] == 'REE Assistant Engineer' || Session::all()['role_name'] == 'ree_engineer')
                                    $reval_redirect_to = "ree_applications.reval";
                                elseif(Session::all()['role_name'] == 'co_engineer' )
                                    $reval_redirect_to = "co_applications.reval";
                                elseif(Session::all()['role_name'] == 'cap_engineer' )
                                    $reval_redirect_to = "cap_applications.reval";
                                elseif(Session::all()['role_name'] == 'vp_engineer' )
                                    $reval_redirect_to = "vp_applications.reval";
                                @endphp
                        @if($reval_redirect_to != "")  

                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route==$reval_redirect_to)?'m-menu__item--active':'' }}">
                            <a href="{{ route($reval_redirect_to) }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">
                                    Revalidation Of Offer Letter
                                </span>
                            </a>
                        </li>
                        @endif
                        @endif
                        
                        @if (isset($route) && ($route == 'co.index' || $route=='ree_applications.reval' || $route == 'ree_applications.noc' || $route=='vp_applications.reval' ||
                        $route=='ree_applications.index' || $route=='co_applications.reval' || $route=='co_applications.noc' || $route == 'ree_applications.noc_cc' || $route == 'co_applications.noc_cc' ||
                        $route=='society_offer_letter.index' || $route=='society_offer_letter_dashboard' ||
                        $route=='documents_uploaded' || $route=='documents_upload'))

                        @php
                        $reval_redirect_to = "";

                        if(Session::all()['role_name'] == 'REE Junior Engineer' || Session::all()['role_name'] ==  'REE deputy Engineer' || Session::all()['role_name'] == 'REE Assistant Engineer' || Session::all()['role_name'] == 'ree_engineer')
                            $reval_redirect_to = "ree_applications.noc";
                        elseif(Session::all()['role_name'] == 'co_engineer' )
                            $reval_redirect_to = "co_applications.noc";
                        @endphp
                        @if($reval_redirect_to != "")         
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route==$reval_redirect_to)?'m-menu__item--active':'' }}">
                            <a href="{{ route($reval_redirect_to) }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">
                                    Noc
                                </span>
                            </a>
                        </li>
                        @endif
                        @endif

                        @if (isset($route) && ($route == 'co.index' || $route=='ree_applications.reval' || $route == 'ree_applications.noc' || $route=='vp_applications.reval' ||
                        $route=='ree_applications.index' || $route=='co_applications.reval' || $route=='co_applications.noc' || $route == 'ree_applications.noc_cc' || $route == 'co_applications.noc_cc' ||
                        $route=='society_offer_letter.index' || $route=='society_offer_letter_dashboard' ||
                        $route=='documents_uploaded' || $route=='documents_upload'))

                        @php
                        $noc_redirect_to = "";

                        if(Session::all()['role_name'] == 'REE Junior Engineer' || Session::all()['role_name'] ==  'REE deputy Engineer' || Session::all()['role_name'] == 'REE Assistant Engineer' || Session::all()['role_name'] == 'ree_engineer')
                            $noc_redirect_to = "ree_applications.noc_cc";
                        elseif(Session::all()['role_name'] == 'co_engineer' )
                            $noc_redirect_to = "co_applications.noc_cc";
                        @endphp
                        @if($noc_redirect_to != "")         
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route==$noc_redirect_to)?'m-menu__item--active':'' }}">
                            <a href="{{ route($noc_redirect_to) }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">
                                    Noc for CC
                                </span>
                            </a>
                        </li>
                        @endif
                        @endif

                        @if(Session::all()['role_name'] == 'ee_engineer')
                        {{-- <li class="m-menu__item {{($route=='society_detail.billing_level')?'m-menu__item--active':''}}">
                            <a href="#" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Service Tax Rates
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li> --}}
                        <li class="m-menu__item {{($route=='society.billing_level' || $route=='society.society_details' || $route == 'arrears_charges' || $route == 'arrears_charges.edit' || $route == 'arrears_charges.create' || $route == 'service_charges' || $route == 'service_charges.edit' || $route == 'service_charges.create')?'':'collapsed'}}"
                            data-toggle="collapse" data-target="#e_billing"> 
                            <a href="#" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-line-graph"></i> 
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap"> 
                                        <span class="m-menu__link-text"> E Billing </span>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i> 
                                    </span> 
                                </span> 
                            </a> 
                        </li>
                        <li id="e_billing" class="collapse {{($route=='society.billing_level'|| $route == 'society.society_details' || $route == 'arrears_charges' || $route == 'arrears_charges.edit' || $route == 'arrears_charges.create' || $route == 'service_charges' || $route == 'service_charges.edit' || $route == 'service_charges.create')?'show':''}}">
                            <ul class="list-unstyled">
                                <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='society.billing_level' || $route == 'society.society_details' || $route == 'arrears_charges' || $route == 'arrears_charges.create' || $route == 'arrears_charges.edit' || $route == 'service_charges' || $route == 'service_charges.edit' || $route == 'service_charges.create')?'m-menu__item--active':''}}">
                                    <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('society.billing_level') }}">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        {{-- <i class="m-menu__link-icon flaticon-line-graph"></i> 
                                        <span class="m-menu__link-title">
                                            <span class="m-menu__link-wrap"> --}}
                                                <span class="m-menu__link-text">
                                                    Society Master
                                                </span>
                                            {{-- </span>
                                        </span> --}}
                                    </a> 
                                </li>
                            </ul>
                        </li>
                       {{--  <li class="m-menu__item">
                            <a href="{{ route('society.billing_level') }}" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Society Master
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li> --}}
                        @endif

                        @if(Session::all()['role_name'] == 'society')
                    </ul> </li> <li class="m-menu__item {{($route=='society_conveyance.create' )?'m-menu__item--active':''}}">
                                                <a href="{{ route('society_conveyance.create') }}" class="m-menu__link m-menu__toggle">
                                                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                                                    <span class="m-menu__link-title">
                                                        <span class="m-menu__link-wrap">
                                                            <span class="m-menu__link-text">
                                                                Apply for Society Conveyance
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                        </li>
                        @if(Session::has('application_count'))
                        @if(Session::get('application_count') == 0)
                        <li class="m-menu__item {{($route=='society_detail.application' )?'m-menu__item--active':''}}">
                            <a href="{{route('society_detail.application')}}" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Apply for Offer Letter
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li>
                        @endif
                        @endif
                        @endif
                        @endif


                        @if(Session::all()['role_name'] == 'EM')
                        <li class="m-menu__item {{($route=='generate_tenant_bill' || $route=='get_societies' || $route == 'get_buildings' || $route == 'get_tenants' || $route == 'edit_tenant' || $route == 'add_tenant' || $route == 'edit_building' || $route == 'add_building' || $route == 'soc_bill_level' || $route == 'soc_ward_colony')?'':'collapsed'}}"
                            data-toggle="collapse" data-target="#e_billing"> 
                            <a href="#" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-line-graph"></i> 
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap"> 
                                        <span class="m-menu__link-text"> E Billing </span>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i> 
                                    </span> 
                                </span> 
                            </a> 
                        </li>
                        <li id="e_billing" class="collapse {{($route=='generate_tenant_bill' || $route=='get_societies' || $route == 'get_buildings' || $route == 'get_tenants' || $route == 'edit_tenant' || $route == 'add_tenant' || $route == 'edit_building' || $route == 'add_building' || $route == 'soc_bill_level' || $route == 'soc_ward_colony' || $route == 'billing_calculations' || $route == 'generateTenantBill' || $route == 'arrears_calculations' || $route == 'generateBuildingBill'|| $route == 'get_tenant_ajax')?'show':''}}">
                            <ul class="list-unstyled">
                                <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='get_societies' || $route == 'get_buildings' || $route == 'get_tenants' || $route == 'edit_tenant' || $route == 'add_tenant' || $route == 'edit_building' || $route == 'add_building' || $route == 'soc_bill_level' || $route == 'soc_ward_colony')?'m-menu__item--active':''}}">
                                    <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('get_societies') }}">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-text"> 
                                            Manage Societies
                                        </span>     
                                    </a> 
                                </li> 

                                <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2  {{($route=='generate_tenant_bill' || $route == 'billing_calculations' || $route == 'generateTenantBill' || $route == 'arrears_calculations' || $route == 'generateBuildingBill' || $route == 'get_tenant_ajax')?'m-menu__item--active':''}}" id="e_billing">
                                    <a href="{{ route('generate_tenant_bill') }}" class="m-menu__link m-menu__toggle">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-text"> 
                                            Generate Bill 
                                        </span>
                                    </a> 
                                </li>
                            </ul>
                        </li> 
                        @endif


                        @if(Session::all()['role_name'] == 'em_clerk')

                        <li class="m-menu__item m-menu__item--submenu {{($route=='em_clerk.index' || $route == 'tenant_payment_list' || $route == 'tenant_arrear_calculation') ?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('em_clerk.index') }}">
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Manage Societies
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li>

                        @endif

                        @if(Session::all()['role_name'] == 'Account')

                        <li class="m-menu__item m-menu__item--submenu m-menu__item--active">
                            <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('search_accounts') }}">
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            List Of Society/Search Accounts
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li>

                        @endif

                        @if(Session::all()['role_name'] == 'rc_collector')
                        <!--<li class="m-menu__item m-menu__item--submenu {{($route=='bill_collection_society')?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('bill_collection_society') }}">
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Collect Bill (Society)
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li>-->

                        <li class="m-menu__item m-menu__item--submenu {{($route=='bill_collection_tenant')?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('bill_collection_tenant') }}">

                                <i class="m-menu__link-icon flaticon-line-graph"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Collect Bill
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li>
                        @endif

                        @yield('actions')

                        <!-- <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                    <a href="{{ route('society_offer_letter_dashboard') }}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Offer Letter Dashboard
                                </span>
                            </span>
                        </span>
                    </a>
                </li> -->
                    </ul>
        </div>
    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
@section('js')

{{-- <script>
    function end_lease_notifications(count) {
        console.log(count);
        var end_lease_date_count = count;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ route('
            society_detail.index ') }}',
            method: 'get',
            data: {
                end_lease_date_count: count
            },
            success: function (res) {
                if (res.society_email != undefined) {
                    $('#society_email').text(res.society_email[0]);
                } else {
                    $('#society_email').text('');
                }
            }
        });
    }

</script> --}}

@endsection
