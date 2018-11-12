@php
$route="";
$route=\Request::route()->getName();
@endphp
<li class="m-menu__item m-menu__item--level-1" >
    <a href="{{ route('architect_layout.index') }}" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon flaticon-line-graph"></i>
        <span class="m-menu__link-title">
            <span class="m-menu__link-wrap">
                <span class="m-menu__link-text">
                    Back to Layouts
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
        
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='architect_layout_details.view')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="View Application" href="{{ route('architect_layout_details.view', encrypt($ArchitectLayout->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">View Layout Details</span>
            </a>
        </li>
        @php $CommonController=new \App\Http\Controllers\Common\CommonController;
        $check_layout_details_complete_status =
        count($CommonController->check_layout_details_complete_status($ArchitectLayout->id));
        @endphp
        @if($check_layout_details_complete_status==0 &&
        (session()->get('role_name')==config('commanConfig.junior_architect')))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{( $route=='architect_layout_detail.edit')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="View Application" href="{{ route('architect_layout_detail.add', encrypt($ArchitectLayout->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Add Detail</span>
            </a>
        </li>
        @endif
        @php $status=getLastStatusIdArchitectLayout($ArchitectLayout->id); @endphp
        @if($status!="")
        @if($status->status_id!=config('commanConfig.architect_layout_status.forward') &&
        ($status->status_id!=config('commanConfig.architect_layout_status.approved')))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='forward_architect_layout')?'m-menu__item--active':''}}">
            <a class="m-menu__link" title="Society & EE Documents" href="{{route('forward_architect_layout',encrypt($ArchitectLayout->id))}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Forward Application</span>
            </a>
        </li>
        @endif
        @endif
        @if(in_array('architect_layout_get_scrtiny',session()->get('permission')))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3  {{($route=='architect_layout_get_scrtiny')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Scrutiny & Remarks" href="{{route('architect_layout_get_scrtiny',encrypt($ArchitectLayout->id))}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Scrutiny & Remarks</span>
            </a>
        </li>
        @endif
        @if(session()->get('role_name')==config('commanConfig.junior_architect') ||
        session()->get('role_name')==config('commanConfig.land_manager') ||
        session()->get('role_name')==config('commanConfig.estate_manager') ||
        session()->get('role_name')==config('commanConfig.ee_junior_engineer') ||
        session()->get('role_name')==config('commanConfig.ree_junior') ||
        session()->get('role_name')==config('commanConfig.ree_assistant_engineer') ||
        session()->get('role_name')==config('commanConfig.ree_deputy_engineer') ||
        session()->get('role_name')==config('commanConfig.ree_branch_head') ||
        session()->get('role_name')==config('commanConfig.senior_architect') ||
        session()->get('role_name')==config('commanConfig.architect') ||
        session()->get('role_name')==config('commanConfig.co_engineer') ||
        session()->get('role_name')==config('commanConfig.senior_architect_planner') ||
        session()->get('role_name')==config('commanConfig.cap_engineer') ||
        session()->get('role_name')==config('commanConfig.legal_advisor') ||
        session()->get('role_name')==config('commanConfig.vp_engineer'))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='architect_Layout_scrutiny_of_ee_em_lm_ree')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Scrutiny & Remarks" href="{{route('architect_Layout_scrutiny_of_ee_em_lm_ree',encrypt($ArchitectLayout->id))}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Scrutiny of EE EM LM REE </span>
            </a>
        </li>

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='architect_layout_prepare_layout_excel')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Scrutiny & Remarks" href="{{route('architect_layout_prepare_layout_excel',encrypt($ArchitectLayout->id))}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Layout & Excel</span>
            </a>
        </li>

        @endif


        {{-- <li class="m-menu__item m-menu__item--submenu {{($route=='cap.dyce_Scrutiny_Remark')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="DyCE Scrutiny & Remarks" href="{{route('cap.dyce_Scrutiny_Remark',$ol_application->id)}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">DyCE Scrutiny & Remarks</span>
            </a>
        </li>

        <li class="m-menu__item m-menu__item--submenu {{($route=='cap.show_calculation_sheet')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="REE Calculation Sheet" href="{{route('cap.show_calculation_sheet',$ol_application->id)}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">REE Calculation Sheet</span>
            </a>
        </li>

        <li class="m-menu__item m-menu__item--submenu {{($route=='cap.forward_application')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Forward Application" href="{{route('cap.forward_application',$ol_application->id)}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Forward Application</span>
            </a>
        </li>

        <li class="m-menu__item m-menu__item--submenu {{($route=='cap.cap_notes')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="CAP Notes" href="{{route('cap.cap_notes',$ol_application->id)}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">CAP Notes</span>
            </a>
        </li> --}}
    </ul>
</li>
