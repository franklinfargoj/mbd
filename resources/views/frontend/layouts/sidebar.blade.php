<!-- BEGIN: Left Aside -->
@php
$route="";
$route=\Request::route()->getName();
@endphp
{{--@php dd(Session::all()); @endphp--}}
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

    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark" style="position: relative;">
        <div class="m-scrollable m-scroller ps ps--active-y" data-scrollbar-shown="true" data-scrollable="true"
            data-max-height="100vh">
            <ul class="m-menu__nav m-menu__nav--dropdown-submenu-arrow">

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
                ];
                @endphp
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
                <li class="m-menu__item" data-toggle="collapse" data-target="#village-actions">
                    <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Land
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

                <li id="village-actions" class="collapse show">
                    <ul class="list-unstyled">

                        <li class="m-menu__item m-menu__item--submenu {{($route=='village_detail.index' || $route=='village_detail.edit'|| $route=='village_detail.show')?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">Land Detail</span></i></a>
                        </li>
                        <li class="m-menu__item m-menu__item--submenu {{($route=='society_detail.index' || $route=='society_detail.show' || $route=='society_detail.edit')?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" href="{{route('society_detail.index')}}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">Society Detail</span></i></a>
                        </li>
                        @if(\Illuminate\Support\Facades\Request::is('village_detail') ||
                        \Illuminate\Support\Facades\Request::is('village_detail/*'))
                        <li class="m-menu__item m-menu__item--submenu {{$route=='village_detail.create'?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" href="{{route('village_detail.create')}}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">Add Land</span></i></a>
                        </li>
                        @endif
                        @if(\Illuminate\Support\Facades\Request::is('society_detail') ||
                        \Illuminate\Support\Facades\Request::is('society_detail/*'))
                        <li class="m-menu__item m-menu__item--submenu {{$route=='society_detail.create'?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" href="{{route('society_detail.create')}}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">Add Society</span></i></a>
                        </li>
                        @endif
                        @if((\Illuminate\Support\Facades\Request::is('society_detail/*') ||
                        \Illuminate\Support\Facades\Request::is('lease_detail/*') ||
                        \Illuminate\Support\Facades\Request::is('lease_detail/create/*')) &&
                        (\Illuminate\Support\Facades\Request::is('lease_detail/create') ||
                        \Illuminate\Support\Facades\Request::is('lease_detail/*')))
                        @if((\Illuminate\Support\Facades\Request::is('lease_detail/*') && (isset($count) && ($count ==
                        0)))
                        || \Illuminate\Support\Facades\Request::is('lease_detail/create/*') ||
                        \Illuminate\Support\Facades\Request::is('lease_detail/view-lease/*') ||
                        \Illuminate\Support\Facades\Request::is('lease_detail/edit-lease/*'))
                        @php $id = collect(request()->segments())->last(); @endphp
                        <li class="m-menu__item m-menu__item--submenu {{($route=='lease_detail.index' || $route=='view-lease.view' || $route=='edit-lease.edit')?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" href="{{route('lease_detail.index', $id)}}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">Lease Details</span></i></a>
                        </li>

                        <li class="m-menu__item m-menu__item--submenu {{$route=='lease_detail.create'?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" href="{{route('lease_detail.create', $id)}}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">Add Lease</span></i></a>
                        </li>
                        @else
                        @php $id = collect(request()->segments())->last(); @endphp
                        <li class="m-menu__item m-menu__item--submenu {{$route=='lease_detail.index'?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" href="{{route('lease_detail.index', $id)}}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">Lease Details</span></i></a>
                        </li>
                        <li class="m-menu__item m-menu__item--submenu {{$route=='renew-lease.renew'?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" href="{{route('renew-lease.renew', $id)}}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">Renew Lease</span></i></a>
                        </li>
                        @endif
                        @endif

                    </ul>
                </li>
                @endif
                <!-- <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                <a href="" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Dashboard
                            </span>
                        </span>
                    </span>
                </a>
            </li> -->

                {{--<li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                    <a href="{{url('/application')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Application
                                </span>
                            </span>
                        </span>
                    </a>
                </li>--}}

                {{--<li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                    <a href="" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Profile
                                </span>
                            </span>
                        </span>
                    </a>
                </li>--}}

                @if(session()->get('permission') && (in_array('society_offer_letter.index',
                session()->get('permission'))))
                {{--<ul id="society_ol_sidebar">--}}
                    <li class="m-menu__item {{ ((Request::segment(2)=='application' && Request::segment(3) == '1_premium') || (Request::segment(2)=='application' && Request::segment(3) == '1_sharing') || (Request::segment(2)=='application' && Request::segment(3) == '12_premium') || (Request::segment(2)=='application' && Request::segment(3) == '12_sharing'))? '':'collapsed' }}"
                        data-toggle="collapse" id="society_ol_sidebar" data-target="#redevelopment">
                        <a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
                            <i class="m-menu__link-icon flaticon-line-graph"></i>
                            <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">
                                        Redevelopment
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                                </span>
                            </span>
                        </a>
                    </li>
                    <li id="redevelopment" class="collapse {{ ((Request::segment(2)=='application' && Request::segment(3) == '1_premium') || (Request::segment(2)=='application' && Request::segment(3) == '1_sharing') || (Request::segment(2)=='application' && Request::segment(3) == '12_premium') || (Request::segment(2)=='application' && Request::segment(3) == '12_sharing'))? 'show':'' }}">
                        <ul class="list-unstyled">
                            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ((Request::segment(2)=='application' && Request::segment(3) == '1_premium') || (Request::segment(2)=='application' && Request::segment(3) == '1_sharing'))? '':'collapsed' }}"
                                data-toggle="collapse" data-target="#self-redevelopment">
                                <a href="{{ url(session()->get('redirect_to')) }}" class="m-menu__link m-menu__toggle">
                                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 510 510">
                                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                            fill="#FFF" />
                                    </svg>
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Self Redevelopment
                                        </span>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </span>
                                </a>
                            </li>
                            <li id="self-redevelopment" class="collapse {{ ((Request::segment(2)=='application' && Request::segment(3) == '1_premium') || (Request::segment(2)=='application' && Request::segment(3) == '1_sharing'))? 'show':'' }}">
                                <ul class="list-unstyled">
                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{ (Request::segment(2)=='application' && Request::segment(3) == '1_premium')?'m-menu__item--active':''}}">
                                        <a href="{{ route('society_detail.application', Session::get('applications_tab')['self_pre_parent']) }}"
                                            class="m-menu__link m-menu__toggle">
                                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" viewBox="0 0 510 510">
                                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                    fill="#FFF" />
                                            </svg>
                                            <span class="m-menu__link-wrap">
                                                <span class="m-menu__link-text">
                                                    Premium
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{ (Request::segment(2)=='application' && Request::segment(3) == '1_sharing')?'m-menu__item--active':''}}">
                                        <a href="{{ route('society_detail.application', Session::get('applications_tab')['self_share_parent']) }}"
                                            class="m-menu__link m-menu__toggle">
                                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" viewBox="0 0 510 510">
                                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                    fill="#FFF" />
                                            </svg>
                                            <span class="m-menu__link-wrap">
                                                <span class="m-menu__link-text">
                                                    Sharing
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 collapsed" data-toggle="collapse"
                                data-target="#dev-redevelopment">
                                <a href="{{ url(session()->get('redirect_to')) }}" class="m-menu__link m-menu__toggle">
                                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 510 510">
                                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                            fill="#FFF" />
                                    </svg>
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Redevelopment Through Developer
                                        </span>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </span>
                                </a>
                            </li>
                            <li id="dev-redevelopment" class="collapse {{ ((Request::segment(2)=='application' && Request::segment(3) == '12_premium') || (Request::segment(2)=='application' && Request::segment(3) == '12_sharing'))? 'show':'' }}">
                                <ul class="list-unstyled">
                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{ (Request::segment(2)=='application' && Request::segment(3) == '12_premium')? '':'collapsed' }} {{(Request::segment(2)=='application' && Request::segment(3) == '12_premium')?'m-menu__item--active':''}}">
                                        <a href="{{ route('society_detail.application', Session::get('applications_tab')['dev_pre_parent']) }}"
                                            class="m-menu__link m-menu__toggle">
                                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" viewBox="0 0 510 510">
                                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                    fill="#FFF" />
                                            </svg>
                                            <span class="m-menu__link-wrap">
                                                <span class="m-menu__link-text">
                                                    Premium
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{ (Request::segment(2)=='application' && Request::segment(3) == '12_sharing')? '':'collapsed' }} {{(Request::segment(2)=='application' && Request::segment(3) == '12_sharing')?'m-menu__item--active':''}}">
                                        <a href="{{ route('society_detail.application', Session::get('applications_tab')['dev_share_parent']) }}"
                                            class="m-menu__link m-menu__toggle">
                                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" viewBox="0 0 510 510">
                                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                    fill="#FFF" />
                                            </svg>
                                            <span class="m-menu__link-wrap">
                                                <span class="m-menu__link-text">
                                                    Sharing
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @if(Session::get('ol_application_count') == 1 || Session::get('sc_application_count') == 1 || Session::get('sr_application_count') == 1 || Session::get('oc_application_count') == 1 || Session::get('noc_application_count') == 1 || Session::get('noc_cc_application_count') == 1)
                                <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route == 'society_offer_letter_dashboard')? '':'collapsed' }} {{ ($route == 'society_offer_letter_dashboard')? 'm-menu__item--active': '' }}">
                                    <a href="{{ route('society_offer_letter_dashboard') }}" class="m-menu__link m-menu__toggle">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                  fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                List of Applications
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            @endif
                            {{--<li id="dev-redevelopment" class="collapse">--}}
                                {{--<ul class="list-unstyled">--}}
                                    {{--<li class="m-menu__item m-menu__item--submenu collapsed" data-toggle="collapse"
                                        --}} {{--data-target="#dev-premium">--}}
                                        {{--<a href="{{ url(session()->get('redirect_to')) }}" class=" m-menu__link
                                        m-menu__toggle">--}}
                                        {{--<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" --}}
                                            {{--height="16" viewBox="0 0 510 510">--}}
                                            {{--<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"--}}
                                            {{--fill="#FFF" />--}} {{--</svg>--}}
                                            {{--<span class="m-menu__link-wrap">--}}
                                            {{--<span class="m-menu__link-text">--}} {{--Premium--}} {{--</span>--}}
                                            {{--<i class="m-menu__ver-arrow la la-angle-right"></i>--}} {{--</span>--}}
                                            {{--</a>--}} {{--</li>--}} {{--<li id="dev-premium" class="collapse">--}}
                                            {{--<ul class="list-unstyled">--}}
                                            {{--<li class="m-menu__item m-menu__item--submenu collapsed">--}}
                                            {{--<a href="{{ route('show_form_self', Session::get('applications_tab')['dev_premiummium']) }}"--}}
                                                    {{--class="m-menu__link m-menu__toggle">--}}
                                                    {{--<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16"--}}
                                                        {{--height="16" viewBox="0 0 510 510">--}}
                                                        {{--<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"--}}
                                                            {{--fill="#FFF" />--}}
                                                    {{--</svg>--}}
                                                    {{--<span class="m-menu__link-wrap">--}}
                                                        {{--<span class="m-menu__link-text">--}}
                                                            {{--New - Offer Letter--}}
                                                        {{--</span>--}}
                                                    {{--</span>--}}
                                                {{--</a>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}
                                    {{--<li class="m-menu__item m-menu__item--submenu collapsed" data-toggle="collapse"--}}
                                        {{--data-target="#dev-sharing">--}}
                                        {{--<a href="{{ url(session()->get('redirect_to')) }}"
                                            class="m-menu__link m-menu__toggle">--}}
                                            {{--<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                --}} {{--height="16" viewBox="0 0 510 510">--}}
                                                {{--<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"--}}
                                                {{--fill="#FFF" />--}} {{--</svg>--}}
                                                {{--<span class="m-menu__link-wrap">--}}
                                                {{--<span class="m-menu__link-text">--}} {{--Sharing--}}
                                                {{--</span>--}}
                                                {{--<i class="m-menu__ver-arrow la la-angle-right"></i>--}}
                                                {{--</span>--}} {{--</a>--}} {{--</li>--}}
                                                {{--<li id="dev-sharing" class="collapse">--}}
                                                {{--<ul class="list-unstyled">--}}
                                                {{--<li class="m-menu__item m-menu__item--submenu collapsed">--}}
                                                {{--<a href="{{ route('show_form_self', Session::get('applications_tab')['dev_sharing']) }}"--}}
                                                    {{--class="m-menu__link m-menu__toggle">--}}
                                                    {{--<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16"--}}
                                                        {{--height="16" viewBox="0 0 510 510">--}}
                                                        {{--<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"--}}
                                                            {{--fill="#FFF" />--}}
                                                    {{--</svg>--}}
                                                    {{--<span class="m-menu__link-wrap">--}}
                                                        {{--<span class="m-menu__link-text">--}}
                                                            {{--New - Offer Letter--}}
                                                        {{--</span>--}}
                                                    {{--</span>--}}
                                                {{--</a>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        </ul>
                    </li>

                    <li class="m-menu__item {{ ($route == 'society_conveyance.index' || $route == 'society_conveyance.create')? '':'collapsed' }}"  id="estate_conveyances" data-toggle="collapse" data-target="#estate_conveyance">
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
                                    <li id="estate_conveyance" class="collapse {{ ($route == 'society_conveyance.index' || $route == 'society_conveyance.create' || $route=='society_formation.index' || $route=='society_formation.list' || $route=='society_renewal.create' || $route=='society_renewal.index')? 'show':'' }}">
                                        <ul class="list-unstyled">
                                            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route == 'society_conveyance.index' || $route == 'society_conveyance.create')? '':'collapsed' }}"
                                                data-toggle="collapse" data-target="#conveyance">
                                                <a href="{{ url(session()->get('redirect_to')) }}" class="m-menu__link m-menu__toggle">
                                                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" viewBox="0 0 510 510">
                                                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                            fill="#FFF" />
                                                    </svg>
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Conveyance
                                                        </span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li id="conveyance" class="collapse {{ ($route == 'society_conveyance.index' || $route == 'society_conveyance.create')? 'show':'' }}">
                                                <ul class="list-unstyled">
                                                    @if(Session::get('sc_application_count') != 0)
                                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{ ($route == 'society_conveyance.index')?'m-menu__item--active':''}}">
                                                        <a href="{{ route('society_conveyance.index') }}" class="m-menu__link m-menu__toggle">
                                                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg"
                                                                width="16" height="16" viewBox="0 0 510 510">
                                                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                                    fill="#FFF" />
                                                            </svg>
                                                            <span class="m-menu__link-wrap">
                                                                <span class="m-menu__link-text">
                                                                    List of Applications
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    @else
                                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{ ($route == 'society_conveyance.create')?'m-menu__item--active':''}}">
                                                        <a href="{{ route('society_conveyance.create') }}" class="m-menu__link m-menu__toggle">
                                                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg"
                                                                width="16" height="16" viewBox="0 0 510 510">
                                                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                                    fill="#FFF" />
                                                            </svg>
                                                            <span class="m-menu__link-wrap">
                                                                <span class="m-menu__link-text">
                                                                    Apply for Society Conveyance
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </li>
                                            @if(session()->get('role_name') == 'society')
                                            {{-- <li class="m-menu__item m-menu__item--submenu {{($route=='society_formation.list' || $route=='society_formation.index')?'m-menu__item--active':''}}"
                                                id="society_formation">
                                                <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('society_formation.list') }}">
                                                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                                                    <span class="m-menu__link-title">
                                                        <span class="m-menu__link-wrap">
                                                            <span class="m-menu__link-text">
                                                                Society Formation
                                                            </span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li> --}}

                                            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route == 'society_formation.list')? '':'collapsed' }}"
                                                data-toggle="collapse" data-target="#formation">
                                                <a href="{{ route('society_formation.list') }}" class="m-menu__link m-menu__toggle">
                                                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" viewBox="0 0 510 510">
                                                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                            fill="#FFF" />
                                                    </svg>
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Society Formation
                                                        </span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li id="formation" class="collapse {{ ($route == 'society_formation.list' || $route == 'society_formation.index')? 'show':'' }}">
                                                <ul class="list-unstyled">
                                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{ ($route == 'society_formation.list') ? 'm-menu__item--active':''}}">
                                                        <a href="{{ route('society_formation.list') }}" class="m-menu__link m-menu__toggle">
                                                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg"
                                                                width="16" height="16" viewBox="0 0 510 510">
                                                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                                    fill="#FFF" />
                                                            </svg>
                                                            <span class="m-menu__link-wrap">
                                                                <span class="m-menu__link-text">
                                                                    List of Applications
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{ ($route == 'society_formation.index') ? 'm-menu__item--active':''}}">
                                                        <a href="{{ route('society_formation.index') }}" class="m-menu__link m-menu__toggle">
                                                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg"
                                                                width="16" height="16" viewBox="0 0 510 510">
                                                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                                    fill="#FFF" />
                                                            </svg>
                                                            <span class="m-menu__link-wrap">
                                                                <span class="m-menu__link-text">
                                                                    Apply for Formation of Society
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @endif
                                            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route == 'society_renewal.index' || $route == 'society_renewal.create')? '':'collapsed' }}"
                                                data-toggle="collapse" data-target="#renewal">
                                                <a href="{{ url(session()->get('redirect_to')) }}" class="m-menu__link m-menu__toggle">
                                                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" viewBox="0 0 510 510">
                                                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                            fill="#FFF" />
                                                    </svg>
                                                    <span class="m-menu__link-wrap">
                                                        <span class="m-menu__link-text">
                                                            Renewal of Lease
                                                        </span>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li id="renewal" class="collapse {{ ($route == 'society_renewal.index' || $route == 'society_renewal.create')? 'show':'' }}">
                                                <ul class="list-unstyled">
                                                    @if(Session::has('sr_application_count') && Session::get('sr_application_count') > 0)
                                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{ ($route == 'society_renewal.index') ? 'm-menu__item--active':''}}">
                                                        <a href="{{ route('society_renewal.index') }}" class="m-menu__link m-menu__toggle">
                                                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg"
                                                                width="16" height="16" viewBox="0 0 510 510">
                                                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                                    fill="#FFF" />
                                                            </svg>
                                                            <span class="m-menu__link-wrap">
                                                                <span class="m-menu__link-text">
                                                                    List of Applications
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    @else
                                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{ ($route == 'society_renewal.create') ? 'm-menu__item--active':''}}">
                                                        <a href="{{ route('society_renewal.create') }}" class="m-menu__link m-menu__toggle">
                                                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg"
                                                                width="16" height="16" viewBox="0 0 510 510">
                                                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                                    fill="#FFF" />
                                                            </svg>
                                                            <span class="m-menu__link-wrap">
                                                                <span class="m-menu__link-text">
                                                                    Apply for Renewal of Lease
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    {{--<li class="m-menu__item" data-toggle="collapse" data-target="#redevelopment">--}}
                                        {{--<a href="{{ url(session()->get('redirect_to')) }}" class="m-menu__link m-menu__toggle">--}}
                                            {{--<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" --}} {{--viewBox="0 0 510 510">--}}
                                                {{--<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"--}}
                                                {{--fill="#FFF" />--}} {{--</svg>--}}
                                                {{--<i class="m-menu__link-icon flaticon-line-graph"></i>--}}
                                                {{--<span class="m-menu__link-wrap">--}}
                                                {{--<span class="m-menu__link-text">--}} {{--Redevelopment--}}
                                                {{--</span>--}}
                                                {{--<i class="m-menu__ver-arrow la la-angle-right"></i>--}}
                                                {{--</span>--}} {{--</a>--}} {{--</li>--}} <li id="revalidation" class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='ree_applications.reval')?'m-menu__item--active':'' }}">
                                                <!--  <a href="{{ route('ree_applications.reval') }}" class="m-menu__link m-menu__toggle">
                                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 510 510">
                                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                            fill="#FFF" />
                                    </svg>
                                    <span class="m-menu__link-text">
                                        Revalidation Of Offer Letter
                                    </span>
                                </a> -->
                                    </li>
                                    {{--@if(isset($ol_application_count))--}}
                                    {{--@if($ol_application_count == 0)--}}
                                    {{--<li class="m-menu__item m-menu__item--submenu">--}}
                                        {{--<a href="{{route('society_detail.application')}}" class="m-menu__link m-menu__toggle">--}}
                                            {{--<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" viewBox="0 0 510 510">--}}
                                                {{--<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                    --}} {{--fill="#FFF" />--}} {{--</svg>--}}
                                                    {{--<span class="m-menu__link-text">--}}
                                                    {{--Apply for Offer Letter--}} {{--</span>--}} {{--</a>--}}
                                                    {{--</li>--}} {{--@endif--}} {{--@endif--}}
                                                    {{--<li class="m-menu__item m-menu__item--submenu {{($route=='society_conveyance.index' )?'m-menu__item--active':''}}">--}}
                        {{--<a href="{{ route('society_conveyance.index') }}"
                                                    class="m-menu__link m-menu__toggle">--}}
                                                    {{--<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg"
                                                        width="16" --}} {{--height="16" viewBox="0 0 510 510">--}}
                                                        {{--<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"--}}
                                                        {{--fill="#FFF" />--}} {{--</svg>--}}
                                                        {{--<span class="m-menu__link-text">--}}
                                                        {{--Society Conveyance--}} {{--</span>--}} {{--</a>--}}
                                                        {{--</li>--}} {{--
                </ul>--}}
                                                        @if(Session::has('application_count'))
                                                        @if(Session::get('application_count')==0)
                                                        {{--<li class="m-menu__item {{($route=='society_detail.application' )?'m-menu__item--active':''}}">--}}
                    {{--<a href="{{route('society_detail.application')}}"
                                                        class="m-menu__link m-menu__toggle">--}}
                                                        {{--<i class="m-menu__link-icon flaticon-line-graph"></i>--}}
                                                        {{--<span class="m-menu__link-title">--}}
                                                            {{--<span class="m-menu__link-wrap">--}}
                                                                {{--<span class="m-menu__link-text">--}}
                                                                    {{--Apply for Offer Letter--}}
                                                                    {{--</span>--}}
                                                                {{--</span>--}}
                                                            {{--</span>--}}
                                                        {{--</a>--}}
                                        {{--</li>--}}
                                    @endif
                                    @endif
                                    @endif

                                    <!-- <li class="m-menu__item m-menu__item--active m-menu__item--submenu" id="sub-menu" aria-haspopup="true"
                m-menu-submenu-toggle="hover">
                <a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Actions
                            </span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </span>
                    </span>
                </a>
                <div class="m-menu__submenu" m-hidden-height="160" style=""><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        @yield('actions')
                </ul>
            </div>
        </li> -->

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
@endsection
