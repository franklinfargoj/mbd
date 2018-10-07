<li class="m-menu__item m-menu__item--active m-menu__item--submenu" id="sub-menu" aria-haspopup="true"
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

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('ee.view_application', $ol_application->id) }}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">View Applications</span>
    </a>
</li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a class="m-menu__link m-menu__toggle" href="{{ route('document-submitted', $ol_application->id) }}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">Society Documents</span>
    </a>
</li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a class="m-menu__link m-menu__toggle" href="{{ route('scrutiny-remark', [$ol_application->id, $ol_application->society_id]) }}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">Scrutiny & Remarks</span>
    </a>
</li>
@if($ol_application->status->status_id ==
config('commanConfig.applicationStatus.in_process'))
<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a class="m-menu__link m-menu__toggle" href="{{ route('get-forward-application', $ol_application->id) }}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">Forward Application</span>
    </a>
</li>
@endif
    
        </ul>
    </div>
</li>

