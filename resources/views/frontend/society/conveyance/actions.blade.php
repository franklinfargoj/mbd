@php
$route="";
$route=\Request::route()->getName();
$status = $sc_application->scApplicationLog->status_id;
@endphp
<li class="m-menu__item">
    <a class="m-menu__link m-menu__toggle" title="List of Applications" href="{{ route('society_offer_letter_dashboard') }}">
        <i class="m-menu__link-icon flaticon-line-graph"></i>
        <span class="m-menu__link-text">List of Applications</span>
    </a>
</li>
<li class="m-menu__item" data-toggle="collapse" onload="action_dropmenu()" data-target="#ree-actions">
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
        @if($status == config('commanConfig.conveyance_status.pending') || $status == config('commanConfig.conveyance_status.reverted'))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='society_conveyance.show')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="View Application" href="{{ route('society_conveyance.show', encrypt($sc_application->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                          fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">View Application</span>
            </a>
        </li>
        @endif

            @if($status == config('commanConfig.conveyance_status.pending') || $status == config('commanConfig.conveyance_status.reverted'))
            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='society_conveyance.edit')?'m-menu__item--active':''}}">
                <a class="m-menu__link m-menu__toggle" title="Edit Application" href="{{ route('society_conveyance.edit', encrypt($sc_application->id)) }}">
                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                              fill="#FFF" />
                    </svg>
                    <span class="m-menu__link-text">Edit Application</span>
                </a>
            </li>
            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='sc_upload_docs' || $route== 'upload_sc_other_documents')?'m-menu__item--active':''}}">
                <a class="m-menu__link m-menu__toggle" title="Upload Documents" href="{{ route('sc_upload_docs') }}">
                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                              fill="#FFF" />
                    </svg>
                    <span class="m-menu__link-text">Upload Documents</span>
                </a>
            </li>

            @if($documents_count <= $documents_uploaded_count)
                <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='sc_form_upload_show' || $route== 'upload_sc_other_documents')?'m-menu__item--active':''}}">
                    <a class="m-menu__link m-menu__toggle" title="Upload Signed Application for Conveyance" href="{{ route('sc_form_upload_show') }}">
                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                  fill="#FFF" />
                        </svg>
                        <span class="m-menu__link-text">Upload Signed Application for Conveyance</span>
                    </a>
                </li>
            @endif
        @endif
        @if($status == config('commanConfig.conveyance_status.forwarded') || $sc_application->application_status == config('commanConfig.conveyance_status.Send_society_to_pay_stamp_duty') || $sc_application->application_status == config('commanConfig.conveyance_status.Send_society_for_registration_of_sale_&_lease') || $sc_application->application_status == config('commanConfig.conveyance_status.Stamped_sale_&_lease_deed') || $sc_application->application_status == config('commanConfig.conveyance_status.Stamped_signed_sale_&_lease_deed') || $sc_application->application_status == config('commanConfig.conveyance_status.Registered_sale_&_lease_deed') || $sc_application->application_status == config('commanConfig.conveyance_status.Conveyance_Issued') || $status == config('commanConfig.conveyance_status.Verify_sale_&_lease_deed'))

            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='society_conveyance.show')?'m-menu__item--active':''}}">
                <a class="m-menu__link m-menu__toggle" title="View Application" href="{{ route('society_conveyance.show', encrypt($sc_application->id)) }}">
                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                              fill="#FFF" />
                    </svg>
                    <span class="m-menu__link-text">View Application</span>
                </a>
            </li>
            
            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='sc_upload_docs' || $route== 'upload_sc_other_documents')?'m-menu__item--active':''}}">
                <a class="m-menu__link m-menu__toggle" title="View Documents" href="{{ route('sc_upload_docs') }}">
                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                              fill="#FFF" />
                    </svg>
                    <span class="m-menu__link-text">View Documents</span>
                </a>
            </li>
            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='sc_form_download')?'m-menu__item--active':''}}">
                <a class="m-menu__link m-menu__toggle" title="Signed Application for Offer Letter" href="{{ config('commanConfig.storage_server'). '/' .$uploaded_stamped_application }}" target="_blank" rel="noopener">
                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                              fill="#FFF" />
                    </svg>
                    <span class="m-menu__link-text">Signed Application for Conveyance</span>
                </a>
            </li>

            <!-- verify sale and lease deed by society -->
            @if($status == config('commanConfig.conveyance_status.Verify_sale_&_lease_deed') || $sc_application->application_status == config('commanConfig.conveyance_status.Draft_sale_&_lease_deed') || $sc_application->application_status == config('commanConfig.conveyance_status.Send_society_to_pay_stamp_duty') || $sc_application->application_status == config('commanConfig.conveyance_status.Send_society_for_registration_of_sale_&_lease') || $sc_application->application_status == config('commanConfig.conveyance_status.Stamped_sale_&_lease_deed') || $sc_application->application_status == config('commanConfig.conveyance_status.Stamped_signed_sale_&_lease_deed') || $sc_application->application_status == config('commanConfig.conveyance_status.Registered_sale_&_lease_deed') || $sc_application->application_status == config('commanConfig.conveyance_status.Conveyance_Issued'))
            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='verify_sale_lease')?'m-menu__item--active':''}}">
                <a class="m-menu__link m-menu__toggle" title="Verify Sale & Lease deed Agreement" href="{{ route('verify_sale_lease', encrypt($sc_application->id)) }}">
                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                              fill="#FFF" />
                    </svg>
                    <span class="m-menu__link-text">Verify Sale & Lease deed Agreement</span>
                </a>
            </li>
            @endif
        
            @if($sc_application->application_status == config('commanConfig.conveyance_status.Send_society_to_pay_stamp_duty') || $sc_application->application_status == config('commanConfig.conveyance_status.Send_society_for_registration_of_sale_&_lease') || $sc_application->application_status == config('commanConfig.conveyance_status.Stamped_sale_&_lease_deed') || $sc_application->application_status == config('commanConfig.conveyance_status.Stamped_signed_sale_&_lease_deed') || $sc_application->application_status == config('commanConfig.conveyance_status.Registered_sale_&_lease_deed') || $sc_application->application_status == config('commanConfig.conveyance_status.Conveyance_Issued'))
                <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='show_sale_lease')?'m-menu__item--active':''}}">
                    <a class="m-menu__link m-menu__toggle" title="Sale & Lease deed Agreement" href="{{ route('show_sale_lease', encrypt($sc_application->id)) }}">
                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                  fill="#FFF" />
                        </svg>
                        <span class="m-menu__link-text">Sale & Lease deed Agreement</span>
                    </a>
                </li>
            @endif
            @if($sc_application->application_status == config('commanConfig.conveyance_status.Send_society_for_registration_of_sale_&_lease') || $sc_application->application_status == config('commanConfig.conveyance_status.Registered_sale_&_lease_deed') || $sc_application->application_status == config('commanConfig.conveyance_status.Conveyance_Issued'))
                <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='show_signed_sale_lease')?'m-menu__item--active':''}}">
                    <a class="m-menu__link m-menu__toggle" title="Signed Sale & Lease deed Agreement" href="{{ route('show_signed_sale_lease', encrypt($sc_application->id)) }}">
                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                  fill="#FFF" />
                        </svg>
                        <span class="m-menu__link-text">Signed Sale & Lease deed Agreement</span>
                    </a>
                </li>
            @endif
        @endif

        

        @if($sc_application->application_status == config('commanConfig.conveyance_status.Conveyance_Issued') && isset($issued_noc->document_path))
            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='')?'m-menu__item--active':''}}">
                <a class="m-menu__link m-menu__toggle" title="Signed Sale & Lease deed Agreement" href="{{ config('commanConfig.storage_server') .'/'. $issued_noc->document_path }}" target="_blank" rel="noopener">
                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                              fill="#FFF" />
                    </svg>
                    <span class="m-menu__link-text">Final Letter of Conveyance Issued</span>
                </a>
            </li>
        @endif
    </ul>
</li>

@section('js')
    <script>
        $(document).ready(function(){
            $('#society_ol_sidebar').hide();
            $('#conveyance').hide();
            $('#renewal').hide();
            $('#architect').hide();
            $('#revalidation').hide();
            $('#apply_sc').hide();
            $('#estate_conveyances').hide();
            $('#society_formation').hide();
        });
    </script>
@endsection