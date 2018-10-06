<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('society_offer_download', $ee_application_data->id) }}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">View Applications</span>
    </a>
</li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a class="m-menu__link m-menu__toggle" href="{{ route('document-submitted', $ee_application_data->id) }}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">Society Documents</span>
    </a>
</li>

<!-- <a href="{{ route('society_offer_download', $ee_application_data->id) }}">View Application</a> -->
<!-- <a href="{{ route('document-submitted', $ee_application_data->society_id) }}">Society Documents</a> -->

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a class="m-menu__link m-menu__toggle" href="{{ route('scrutiny-remark', [$ee_application_data->id, $ee_application_data->society_id]) }}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">Scrutiny & Remarks</span>
    </a>
</li>

@if($ee_application_data->olApplicationStatusForLoginListing[0]->status_id ==
config('commanConfig.applicationStatus.in_process'))

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a class="m-menu__link m-menu__toggle" href="{{ route('get-forward-application', $ee_application_data->id) }}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">Forward Application</span>
    </a>
</li>
@endif
