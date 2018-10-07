<!-- BEGIN: Left Aside -->
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

    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1"
        m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            @if(in_array('resolution.index', session()->get('permission')))
            <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
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
            @endif



            @if(in_array('rti_applicants', session()->get('permission')))
            <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                <a href="{{url('/rti_applicants')}}" class="m-menu__link ">
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
            @if(in_array('hearing.index', session()->get('permission')))
            <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                <a href="{{ url('hearing') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Hearing
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            @endif



            {{-- @if(!empty(array_intersect($land_permission, session()->get('permission'))))--}}
            @if(in_array('village_detail.index', session()->get('permission')))
            <li class="m-menu__item m-menu__item--active m-menu__item--submenu" id="sub-menu" aria-haspopup="true"
                m-menu-submenu-toggle="hover">
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
                <div class="m-menu__submenu" m-hidden-height="160" style=""><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                            <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle"><img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Village Detail</span></i></a>
                        </li>
                        <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                            <a href="{{route('society_detail.index')}}" class="m-menu__link m-menu__toggle"><img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Society Detail</span></i></a>
                        </li>
                    </ul>
                </div>
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

            @if(in_array('vp.index', session()->get('permission')) || in_array('ee.index',
            session()->get('permission')) || in_array('dyce.index', session()->get('permission')) ||
            in_array('ree_applications.index', session()->get('permission')) || in_array('co.index',
            session()->get('permission')) || in_array('cap.index', session()->get('permission')) ||
            in_array('society_offer_letter.index', session()->get('permission')))
            <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                <a href="{{ url(session()->get('redirect_to')) }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Offer Letter
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            @endif


            @if(in_array('architect_application', session()->get('permission')) ||
            in_array('view_architect_application',
            session()->get('permission')) || in_array('evaluate_architect_application', session()->get('permission'))
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
            in_array('architect.post_final_signed_certificate', session()->get('permission')))
            <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                <a href="{{ url(session()->get('redirect_to')) }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Architect Applications
                            </span>
                        </span>
                    </span>
                </a>
            </li>
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
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
@section('js')
@endsection
