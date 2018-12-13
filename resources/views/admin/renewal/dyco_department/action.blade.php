@php
$route="";
$route=\Request::route()->getName();
@endphp
 
<li class="m-menu__item" >
    <a href="{{route('renewal.index')}}" class="m-menu__link m-menu__toggle">
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

<li class="m-menu__item" data-toggle="collapse" data-target="#dyco-actions">
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

<li id="dyco-actions" class="collapse show">
    <ul class="list-unstyled">
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='renewal.view_application')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="View Application" href="{{ route('renewal.view_application',encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">View Applications </span>
            </a>
        </li>

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='renewal.view_documents')?'m-menu__item--active':''}}">
            <a class="m-menu__link" title="Society Documents" href="{{ route('renewal.view_documents',encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Society Documents</span>
            </a>
        </li>
        @if($data->application_status != config('commanConfig.renewal_status.in_process'))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='renewal.ee_scrutiny')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="EE Scrutiny" href="{{ route('renewal.ee_scrutiny',encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">EE Scrutiny</span>
            </a>
        </li>
 
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='renewal.architect_scrutiny')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Architect Scrutiny" href="{{ route('renewal.architect_scrutiny',encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Architect Scrutiny</span>
            </a>
        </li>         

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='em.renewal_scrutiny_remark')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="EM Scrutiny" href="{{ route('em.renewal_scrutiny_remark', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">EM Scrutiny</span>
            </a>
        </li>

        @endif   

        @if($data->application_status == config('commanConfig.renewal_status.Draft_Renewal_of_Lease_deed'))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='renewal.prepare_renewal_agreement')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Prepare Draft Renewal of Lease Agreement" href="{{ route('renewal.prepare_renewal_agreement', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Prepare Draft Renewal of Lease Agreement</span>
            </a> 
        </li> 
        @endif

        @if($data->application_status == config('commanConfig.renewal_status.Aproved_Renewal_of_Lease') || $data->application_status == config('commanConfig.renewal_status.Sent_society_to_pay_stamp_duety'))  
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='renewal.approve_renewal_agreement')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Approved Renewal of Lease Agreement" href="{{ route('renewal.approve_renewal_agreement', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Approved Renewal of Lease Agreement</span>
            </a> 
        </li>  
        @endif  

     @if($data->application_status == config('commanConfig.renewal_status.Stamp_Renewal_of_Lease_deed')) 

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='renewal.stamp_sign_renewal_agreement')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Stamp Renewal of Lease Agreement" href="{{ route('renewal.stamp_sign_renewal_agreement', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Stamp Renewal of Lease Agreement</span>
            </a> 
        </li> 
    @endif

    @if($data->application_status == config('commanConfig.renewal_status.Stamp_Sign_Renewal_of_Lease_deed') || $data->application_status == config('commanConfig.renewal_status.Send_society_for_registration_of_Lease_deed'))    
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='renewal.stamp_sign_renewal_agreement')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Stamp & Sign Renewal of Lease Agreement" href="{{ route('renewal.stamp_sign_renewal_agreement', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Stamp & Sign Renewal of Lease Agreement</span>
            </a> 
        </li> 
    @endif             
    
    @if($data->application_status == config('commanConfig.renewal_status.Registered_lease_deed'))    
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='renewal.registered_renewal_agreement')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Register Renewal of Lease Agreement" href="{{ route('renewal.registered_renewal_agreement', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Register Renewal of Lease Agreement</span>
            </a> 
        </li> 
    @endif     
                 

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='renewal.renewal_forward_application')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Forward Application" href="{{ route('renewal.renewal_forward_application', encrypt($data->id)) }}"">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Forward Application</span>
            </a>
        </li>

    </ul>
</li>
