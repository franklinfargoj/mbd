@php
    $route="";
    $route= \Request::route()->getName();
@endphp
<li class="m-menu__item m-menu__item--level-1">
    <a href="{{ route('rti_applicants') }}" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon flaticon-line-graph"></i>
        <span class="m-menu__link-title">
            <span class="m-menu__link-wrap">
                <span class="m-menu__link-text">
                    Back to RTI Applicants
                </span>
            </span>
        </span>
    </a>
</li>
<li class="m-menu__item m-menu__item--level-1" data-toggle="collapse" data-target="#cap-actions">
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
</li>

<li id="cap-actions" class="collapse show">
    <ul class="list-unstyled">
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{( $route == 'view_applicant') ? 'm-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="View" href="{{ url('/view_applicant/'.$rti_applicant->id) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                          fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">View Applications</span>
            </a>
        </li>
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{( $route == 'schedule_meeting')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle " title="Schedule Meeting" href="{{ url('/schedule_meeting/'.$rti_applicant->id) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                          fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Schedule Meeting</span>
            </a>
        </li>
        {{-- <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{( $route == 'update_status')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle " title="Edit" href="{{ url('/update_status/'.$rti_applicant->id) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                          fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Update Status</span>
            </a>
        </li> --}}
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{( $route == 'rti_send_info')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle " title="Edit" href="{{ url('/rti_send_info/'.$rti_applicant->id) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                          fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Send Information To Applicant</span>
            </a>
        </li>
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{( $route == 'rti_forward_application')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle " title="Edit" href="{{ url('/rti_forward_application/'.$rti_applicant->id) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                          fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Forward Application</span>
            </a>
        </li>
        {{--<a title="Delete" href="{{ route('resolution.delete', $rti_applicant->id) }}">Delete</a>--}}
        {{--<a title="Delete" href="javascript::void(0)" onclick="deleteResolution({{$rti_applicant->id}});">Delete</a>--}}


    </ul>
</li>
