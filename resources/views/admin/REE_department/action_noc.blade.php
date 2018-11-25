@php
$route="";
$route=\Request::route()->getName();
@endphp

<li class="m-menu__item" >
    <a href="{{route('ree_applications.noc')}}" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon flaticon-line-graph"></i>
        <span class="m-menu__link-title">
            <span class="m-menu__link-wrap">
                <span class="m-menu__link-text">
                    Back to Applications
                </span>
            </span>
        </span>
    </a>   
</li>

<li class="m-menu__item" data-toggle="collapse" data-target="#ree-actions">
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

<li id="ree-actions" class="collapse show">
    <ul class="list-unstyled">

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='ree.view_application_noc')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="View Application" href="{{ route('ree.view_application_noc', $noc_application->id) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">View Application</span>
            </a>
        </li>

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='ree.society_noc_documents')?'m-menu__item--active':''}}"
            aria-haspopup="true">
            <a class="m-menu__link m-menu__toggle" title="Society Documents" href="{{route('ree.society_noc_documents',$noc_application->id)}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Society Documents</span>
            </a>
        </li>

        @if((session()->get('role_name') == config('commanConfig.ree_junior') && $noc_application->noc_generation_status == 0) || $noc_application->noc_generation_status == config('commanConfig.applicationStatus.NOC_Generation'))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='ree.generate_noc')?'m-menu__item--active':''}}"
            aria-haspopup="true">
            <a class="m-menu__link m-menu__toggle" title="NOC" href="{{route('ree.generate_noc',$noc_application->id)}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">NOC</span></a>
        </li>
        @endif

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='ree.scrutiny-remark-noc')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="REE Scrutiny" href="{{route('ree.scrutiny-remark-noc',$noc_application->id)}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">REE Scrutiny</span>
            </a>
        </li>

        @if($noc_application->noc_generation_status ==
        config('commanConfig.applicationStatus.NOC_Issued') || $noc_application->noc_generation_status ==
        config('commanConfig.applicationStatus.sent_to_society'))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='ree.approved_noc_letter')?'m-menu__item--active':''}}"
            aria-haspopup="true">
            <a class="m-menu__link m-menu__toggle" title="Offer Letter" href="{{route('ree.approved_noc_letter',$noc_application->id)}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Approved Noc</span></a>
        </li>
        @endif

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='ree.forward_application_noc')?'m-menu__item--active':''}}"
            aria-haspopup="true">
            <a class="m-menu__link m-menu__toggle " title="Forward Application" href="{{route('ree.forward_application_noc',$noc_application->id)}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Forward Application</span>
            </a>
        </li>


    </ul>
</li>
