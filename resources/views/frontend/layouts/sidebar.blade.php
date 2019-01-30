<!-- BEGIN: Left Aside -->
@php
$route="";
$route=\Request::route()->getName();
@endphp
{{--@php dd(Session::get('sr_application_count') > 0); @endphp--}}
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    @php
    $land_permission = ['village_detail.index', 'village_detail.create', 'village_detail.edit',
    'village_detail.update', 'village_detail.destroy',
    'loadDeleteVillageUsingAjax', 'village_detail.store', 'society_detail.index', 'society_detail.create',
    'society_detail.store',
    'lease_detail.index', 'lease_detail.create', 'lease_detail.store', 'renew-lease.renew', 'renew-lease.update-lease'
    ];
    @endphp

    <div class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark" style="position: relative;">
        <div class="sidebar-wrapper">
            
            <ul class="m-menu__nav m-menu__nav--dropdown-submenu-arrow">
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



                @if(session()->get('permission') && (in_array('society_offer_letter.index',
                session()->get('permission'))))
                {{--<ul id="society_ol_sidebar">--}}
                    <li class="m-menu__item {{ ((Request::segment(2)=='application' && Request::segment(3) == '1_premium') || (Request::segment(2)=='application' && Request::segment(3) == '1_sharing') || (Request::segment(2)=='application' && Request::segment(3) == '12_premium') || (Request::segment(2)=='application' && Request::segment(3) == '12_sharing') || $route == 'society_offer_letter_dashboard' || $route == 'show_form_self' || $route == 'show_form_dev' || $route == 'show_tripatite_self' || $route == 'show_tripatite_dev' || $route == 'show_reval_self' || $route == 'show_reval_dev' || $route == 'show_oc_self' || $route == 'show_oc_dev' || $route == 'show_form_self_noc' || $route == 'show_form_dev_noc' || $route == 'show_form_self_noc_cc')? '':'collapsed' }}"
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
                    <li id="redevelopment" class="collapse {{ ((Request::segment(2)=='application' && Request::segment(3) == '1_premium') || (Request::segment(2)=='application' && Request::segment(3) == '1_sharing') || (Request::segment(2)=='application' && Request::segment(3) == '12_premium') || (Request::segment(2)=='application' && Request::segment(3) == '12_sharing') || $route == 'society_offer_letter_dashboard' || $route == 'show_form_self' || $route == 'show_form_dev' || $route == 'show_tripatite_self' || $route == 'show_tripatite_dev' || $route == 'show_reval_self' || $route == 'show_reval_dev' || $route == 'show_oc_self' || $route == 'show_oc_dev' || ($route == 'show_form_self_noc' && isset($self_type)) || $route == 'show_form_dev_noc' || $route == 'show_form_self_noc_cc')? 'show':'' }}">
                        <ul class="list-unstyled">
                            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ((Request::segment(2)=='application' && Request::segment(3) == '1_premium') || (Request::segment(2)=='application' && Request::segment(3) == '1_sharing') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_self') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_self') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_tripatite_self') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_reval_self') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_reval_self') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_oc_self') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_self_noc' && isset($self_type)) || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_self_noc_cc' && isset($self_type)) || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_oc_self') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_self_noc' && isset($self_type)) || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_self_noc_cc' && isset($self_type)))? '':'collapsed' }}"
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
                            <li id="self-redevelopment" class="collapse {{ ((Request::segment(2)=='application' && Request::segment(3) == '1_premium') || (Request::segment(2)=='application' && Request::segment(3) == '1_sharing') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_self') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_self') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_tripatite_self') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_reval_self') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_reval_self') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_oc_self') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_self_noc' && isset($self_type)) || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_self_noc_cc' && isset($self_type)) || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_oc_self') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_self_noc' && isset($self_type)) || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_self_noc_cc' && isset($self_type)))? 'show':'' }}">
                                <ul class="list-unstyled">
                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ((Request::segment(2)=='application' && Request::segment(3) == '1_premium') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_self') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_reval_self') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_oc_self') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_self_noc' && isset($self_type)) || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_self_noc_cc' && isset($self_type)))?'m-menu__item--active':''}}">
                                        <a href="{{ route('society_detail.application', Session::get('applications_tab')['self_pre_parent']) }}"
                                            class="m-menu__link m-menu__toggle">
                                            <span class="sidebar-icon sidebar-menu-icon--level-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#fff">
                                              <path d="M501.947 337.892c-14.905-24.751-47.034-32.892-71.9-18.349l-63.453 33.371c-6.391-21.978-26.713-38.09-50.728-38.09h-96.069c-13.273 0-23.615-4.132-37.928-9.852-16.747-6.69-36.858-14.719-66.701-17.395v-7.963H2.496V512h112.672v-23.761c3.083 2.022 6.308 4.124 9.65 6.287C150.005 510.824 163.959 512 183.959 512l104.912-.038c18.059 0 34.626-7.284 50.045-14.746 15.043-7.277 131.61-78.612 145.118-86.884 24.88-15.048 32.918-47.52 17.913-72.44zM72.916 469.748H44.748V321.865h28.168v147.883zm389.235-95.56l-.135.083c-49.445 30.282-131.584 80.113-141.502 84.911-11.008 5.327-22.52 10.528-31.651 10.528l-104.912.038c-13.898 0-19.651 0-36.179-10.695a1898.154 1898.154 0 0 1-32.602-21.588V330.03c21.596 2.42 36.502 8.374 51.025 14.177 15.832 6.327 32.203 12.867 53.605 12.867h96.069c5.825 0 10.563 4.738 10.563 10.563 0 3.852-1.989 6.377-3.174 7.541l.341.346-34.7 18.249 19.668 37.396 141.624-74.481 1.063-.6c4.991-3.006 11.497-1.39 14.5 3.6 3.001 4.992 1.387 11.494-3.603 14.5zM385.896 102.043l-97.047-14.102L245.445 0l-43.401 87.941-97.048 14.102 70.224 68.453-16.577 96.656 86.803-45.635 86.803 45.635-16.578-96.656 70.225-68.453zm-99.72 38.195l-15.907 15.505 3.755 21.894 2.106 12.276-11.025-5.796-19.661-10.338-19.661 10.338-11.025 5.796 2.106-12.276 3.755-21.894-15.906-15.505-8.919-8.694 12.329-1.79 21.982-3.196 9.829-19.919 5.513-11.169 5.513 11.169 9.829 19.919 21.982 3.196 12.326 1.79-8.921 8.694z"/>
                                            </svg>
                                            </span>
                                            <span class="m-menu__link-wrap">
                                                <span class="m-menu__link-text">
                                                    Premium
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{ ((Request::segment(2)=='application' && Request::segment(3) == '1_sharing') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_self') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_tripatite_self') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_reval_self') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_oc_self') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_self_noc' && isset($self_type)) || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_self_noc_cc' && isset($self_type)))?'m-menu__item--active':''}}">
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
                            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ((Request::segment(2)=='application' && Request::segment(3) == '12_premium') || (Request::segment(2)=='application' && Request::segment(3) == '12_sharing') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_dev') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_dev') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_tripatite_dev') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_reval_dev') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_reval_dev') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_oc_dev') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_oc_dev') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_self_noc' && isset($dev_type)) || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_self_noc' && isset($dev_type)) || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_self_noc_cc' && isset($dev_type)) || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_self_noc_cc' && isset($dev_type)))? '':'collapsed' }}" data-toggle="collapse"
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
                            <li id="dev-redevelopment" class="collapse {{ ((Request::segment(2)=='application' && Request::segment(3) == '12_premium') || (Request::segment(2)=='application' && Request::segment(3) == '12_sharing') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_dev') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_dev') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_tripatite_dev') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_reval_dev') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_reval_dev') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_oc_dev') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_oc_dev') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_self_noc' && isset($dev_type)) || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_self_noc' && isset($dev_type)) || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_self_noc_cc' && isset($dev_type)) || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_self_noc_cc' && isset($dev_type)))? 'show':'' }}">
                                <ul class="list-unstyled">
                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{ (Request::segment(2)=='application' && Request::segment(3) == '12_premium')? '':'collapsed' }} {{((Request::segment(2)=='application' && Request::segment(3) == '12_premium') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_dev') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_reval_dev') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_oc_dev') || (isset($ids) && $ids[1] == 'premium' && $route == 'show_form_self_noc_cc' && isset($dev_type)))?'m-menu__item--active':''}}">
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
                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{ (Request::segment(2)=='application' && Request::segment(3) == '12_sharing')? '':'collapsed' }} {{((Request::segment(2)=='application' && Request::segment(3) == '12_sharing') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_dev') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_tripatite_dev') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_reval_dev') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_oc_dev') || (isset($ids) && $ids[1] == 'sharing' && $route == 'show_form_self_noc_cc' && isset($dev_type)))?'m-menu__item--active':''}}">
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
{{--                            @if(Session::get('ol_application_count') == 1 || Session::get('oc_application_count') == 1 || Session::get('noc_application_count') == 1 || Session::get('noc_cc_application_count') == 1)--}}
                                <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route == 'society_offer_letter_dashboard')? 'm-menu__item--active': '' }}">
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
                            {{--@endif--}}
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
                                    <li id="estate_conveyance" class="collapse {{ ($route == 'society_conveyance.index' || $route == 'society_conveyance.create' || $route=='society_formation.index' || $route=='society_formation.list' || $route=='society_renewal.create' || $route=='society_renewal.index' || $route == 'society_formation.create')? 'show':'' }}">
                                        <ul class="list-unstyled">
                                            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route == 'society_conveyance.index' || $route == 'society_conveyance.create')? '':'collapsed' }}"
                                                data-toggle="collapse" data-target="#conveyance">
                                                <a href="{{ route('society_conveyance.index') }}" class="m-menu__link m-menu__toggle">
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

                                            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route == 'society_formation.list' || $route == 'society_formation.create')? '':'collapsed' }}"
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
                                            <li id="formation" class="collapse {{ ($route == 'society_formation.list' || $route == 'society_formation.index' || $route == 'society_formation.create')? 'show':'' }}">
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
                                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{ ($route == 'society_formation.index' || $route == 'society_formation.create') ? 'm-menu__item--active':''}}">
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
                                                    @if(Session::has('sr_application_count') && Session::get('sr_application_count') != 0)
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
                 {{--<li class="m-menuama--}}
{{--                     @php dd($route); @endphp--}}
                 <li class="m-menu__item @if($route == 'society.profile') m-menu__item--active @endif" aria-haspopup="true">
                     <a href="{{ route('society.profile') }}" class="m-menu__link">
                         <i class="m-menu__link-icon flaticon-user"></i>
                         <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Profile
                            </span>
                        </span>
                    </span>
                     </a>
                 </li>
            </ul>
        </div>
    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
@section('js')
@endsection
