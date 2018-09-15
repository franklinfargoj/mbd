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
            {{--@endif--}}



            {{-- @if(!empty(array_intersect($land_permission, session()->get('permission'))))--}}
            <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                <a href="{{url('/village_detail')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Land
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            {{--@endif--}}


            <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
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
            </li>

            <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
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
            </li>

            <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
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
            </li>

            <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
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
            </li>
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
