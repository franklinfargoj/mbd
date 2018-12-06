@php
$route="";
$route=\Request::route()->getName();
@endphp

<li class="m-menu__item" >
    <a href="{{route('conveyance.index')}}" class="m-menu__link m-menu__toggle">
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
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='conveyance.view_application')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="View Application" href="{{ route('conveyance.view_application', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">View Applications </span>
            </a>
        </li>
  
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='conveyance.view_documents')?'m-menu__item--active':''}}">
            <a class="m-menu__link" title="Society Documents" href="{{ route('conveyance.view_documents',encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Society Documents</span>
            </a>
        </li>

    @if(isset($data->ConveyanceSalePriceCalculation))    
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='conveyance.view_ee_documents')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="EE Documents" href="{{ route('conveyance.view_ee_documents', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">EE Documents</span>
            </a>
        </li>
    @endif   

    @if($data->em_document)   
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='em.scrutiny_remark')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="EM Documents" href="{{ route('em.scrutiny_remark', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">EM Documents</span>
            </a>
        </li> 
    @endif
                
    @if($data->conveyance_map)
    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='conveyance.architect_scrutiny_remark')?'m-menu__item--active':''}}">
        <a class="m-menu__link m-menu__toggle" title="Architect Scrutiny Remark" href="{{ route('conveyance.architect_scrutiny_remark', encrypt($data->id)) }}">
            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                    fill="#FFF" />
            </svg>
            <span class="m-menu__link-text">Architect Scrutiny Remark</span>
        </a>
    </li> 
    @endif  

    @if(isset($data->application_status) && $data->application_status == config('commanConfig.conveyance_status.Draft_sale_&_lease_deed'))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='conveyance.sale_lease_agreement')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Prepare Draft Sale & Lease Deed" href="{{ route('conveyance.sale_lease_agreement', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Prepare Draft Sale & Lease Deed</span>
            </a> 
        </li>
    @endif

    @if(isset($data->application_status) && ($data->application_status == config('commanConfig.conveyance_status.Aproved_sale_&_lease_deed') || $data->application_status == config('commanConfig.conveyance_status.Send_society_to_pay_stamp_duety')) )    
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='conveyance.approved_sale_lease_agreement')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Approved Sale & Lease Deed" href="{{ route('conveyance.approved_sale_lease_agreement', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Approved Sale & Lease Deed</span>
            </a> 
        </li>
    @endif  
        
    @if(isset($data->application_status) && $data->application_status == config('commanConfig.conveyance_status.Stamped_sale_&_lease_deed'))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='conveyance.stamp_duty_agreement')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Stamp Duty Agreement" href="{{ route('conveyance.stamp_duty_agreement', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Stamp Duty Agreement</span>
            </a> 
        </li>              
    @endif

    @if(isset($data->application_status) && ($data->application_status == config('commanConfig.conveyance_status.Stamped_signed_sale_&_lease_deed') || $data->application_status == config('commanConfig.conveyance_status.Send_society_for_registration_of_sale_&_lease')) )       
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='conveyance.stamp_signed_duty_agreement')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Stamped and Signed Sale & Lease Deed" href="{{ route('conveyance.stamp_signed_duty_agreement', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Stamped and Signed Sale & Lease Deed</span>
            </a> 
        </li>   
    @endif
    
    @if(isset($data->application_status) && ($data->application_status == config('commanConfig.conveyance_status.Registered_sale_&_lease_deed') || (session()->get('role_name') == config('commanConfig.dycdo_engineer') && $data->application_status == config('commanConfig.conveyance_status.NOC_Issued')) ))    
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='conveyance.register_sale_lease_agreement')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Registered Sale & Lease Deed" href="{{ route('conveyance.register_sale_lease_agreement', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Registered Sale & Lease Deed</span>
            </a> 
        </li> 
    @endif            

    @if(session()->get('role_name') == config('commanConfig.dyco_engineer') && isset($data->application_status) && $data->application_status == config('commanConfig.conveyance_status.NOC_Issued'))    
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='dyco.conveyance_noc')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="NOC for Conveyance" href="{{ route('dyco.conveyance_noc', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">NOC for Conveyance</span>
            </a>
        </li>
    @endif    

    @if(isset($data->application_status) && $data->application_status != config('commanConfig.conveyance_status.in_process'))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='conveyance.checklist')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Checklist & Office Note" href="{{ route('conveyance.checklist', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Checklist & Office Note</span>
            </a>
        </li>   
    @endif          

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='conveyance.forward_application_sc')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Forward Application" href="{{ route('conveyance.forward_application_sc', encrypt($data->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Forward Application</span>
            </a>
        </li>

    </ul>
</li>
