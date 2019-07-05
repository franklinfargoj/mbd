@php
$route="";
$route=\Request::route()->getName();
@endphp

 
<li class="m-menu__item" >
    <a href="{{route('ree_applications.consent_oc')}}" class="m-menu__link m-menu__toggle">
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

<li class="m-menu__item" data-toggle="collapse" data-target="#ee-actions">
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
<li id="ee-actions" class="collapse show">
    <ul class="list-unstyled">
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='ree.view_application_consent_oc')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('ree.view_application_consent_oc', encrypt($oc_application->id)) }}">
                <span class="sidebar-icon sidebar-menu-icon--level-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 437.073 437.073">
                    <path fill="#fff" d="M387.178 166.631a5.929 5.929 0 0 0-.31-1.545c-.066-.191-.113-.37-.197-.555-.292-.632-.656-1.235-1.169-1.748L224.462 1.742c-.513-.513-1.11-.877-1.742-1.164-.185-.09-.376-.137-.573-.203a5.657 5.657 0 0 0-1.51-.298C220.5.066 220.38 0 220.249 0H55.79a5.969 5.969 0 0 0-5.967 5.967v425.139c0 3.3 2.673 5.967 5.967 5.967h325.493c3.3 0 5.967-2.667 5.967-5.967V167.001c0-.132-.066-.245-.072-.37zm-202.002 99.372l-79.491 39.847v.406l79.491 39.853v14.028L90.84 311.542v-10.979l94.336-48.594v14.034zm164.304 45.742l-94.336 48.385v-14.028l80.105-39.853v-.406l-80.105-39.847v-14.034l94.336 48.385v11.398zM226.21 161.034V20.365l70.337 70.331 70.337 70.331H226.21v.007z"/>
                </svg>
            </span>
                <span class="m-menu__link-text">View Applications</span>
            </a>
        </li>

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='ree.society_oc_documents')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" href="{{ route('ree.society_oc_documents', encrypt($oc_application->id)) }}">
                <span class="sidebar-icon sidebar-menu-icon--level-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 470 470">
                    <path fill="#fff" d="M327.081 0H90.234C74.331 0 61.381 12.959 61.381 28.859v412.863c0 15.924 12.95 28.863 28.853 28.863H380.35c15.917 0 28.855-12.939 28.855-28.863V89.234L327.081 0zm6.81 43.184l35.996 39.121h-35.996V43.184zm51.081 398.539c0 2.542-2.081 4.629-4.635 4.629H90.234c-2.55 0-4.619-2.087-4.619-4.629V28.859a4.616 4.616 0 0 1 4.619-4.613h219.411v70.181c0 6.682 5.443 12.099 12.129 12.099h63.198v335.197zM128.364 128.89H334.15a9.08 9.08 0 0 1 9.079 9.079 9.08 9.08 0 0 1-9.079 9.079H128.364c-5.012 0-9.079-4.066-9.079-9.079 0-5.012 4.067-9.079 9.079-9.079zm214.865 70.09c0 5.012-4.066 9.079-9.079 9.079H128.364c-5.012 0-9.079-4.066-9.079-9.079s4.067-9.079 9.079-9.079H334.15c5.013 0 9.079 4.067 9.079 9.079zm0 59.013a9.08 9.08 0 0 1-9.079 9.079H128.364c-5.012 0-9.079-4.066-9.079-9.079s4.067-9.079 9.079-9.079H334.15a9.08 9.08 0 0 1 9.079 9.079zm0 60.018a9.08 9.08 0 0 1-9.079 9.079H128.364c-5.012 0-9.079-4.066-9.079-9.079s4.067-9.079 9.079-9.079H334.15a9.08 9.08 0 0 1 9.079 9.079z"/>
                </svg>
            </span>
                <span class="m-menu__link-text">Society Documents</span>
            </a>
        </li>

       <!--  <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='ree.em_scrutiny_oc_ree')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" href="{{ route('ree.em_scrutiny_oc_ree', $oc_application->id) }}">
                <span class="sidebar-icon sidebar-menu-icon--level-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 510 510">
                        <path fill="#fff" d="M0 387.6v96.9h96.9l280.5-283.05-96.9-96.9L0 387.6zm451.35-260.1c10.2-10.2 10.2-25.5 0-35.7L392.7 33.149c-10.2-10.2-25.5-10.2-35.7 0l-45.9 45.9 96.9 96.9 43.35-48.449zm-221.85 306l-51 51H510v-51H229.5z"/>
                    </svg>
                </span>
                <span class="m-menu__link-text">EM No Due</span>
            </a>
        </li> -->
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='ree.ee_scrutiny_oc_ree')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" href="{{ route('ree.ee_scrutiny_oc_ree', encrypt($oc_application->id)) }}">
               <span class="sidebar-icon sidebar-menu-icon--level-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 510 510">
                        <path fill="#fff" d="M0 387.6v96.9h96.9l280.5-283.05-96.9-96.9L0 387.6zm451.35-260.1c10.2-10.2 10.2-25.5 0-35.7L392.7 33.149c-10.2-10.2-25.5-10.2-35.7 0l-45.9 45.9 96.9 96.9 43.35-48.449zm-221.85 306l-51 51H510v-51H229.5z"/>
                    </svg>
                </span>
                <span class="m-menu__link-text">EE Scrutiny</span>
            </a>
        </li>
        @if((session()->get('role_name') == config('commanConfig.ree_junior') && $oc_application->OC_Generation_status == 0) || $oc_application->OC_Generation_status == config('commanConfig.applicationStatus.OC_Generation'))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='ree.generate_oc_certificate')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" href="{{ route('ree.generate_oc_certificate', encrypt($oc_application->id)) }}">
                <span class="sidebar-icon sidebar-menu-icon--level-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                      <path fill="#fff" d="M465.229 215.91L256.044 352.199 46.859 215.91.088 240.255l255.956 166.116L512 240.255z"/>
                      <path fill="#fff" d="M465.229 305.863l-209.185 136.29-209.185-136.29L.088 330.209l255.956 166.116L512 330.209zM155.163 68.298l-46.579 24.776 71.88 46.509 45.305-27.576zM179.975 174.983l-72.946 44.402 50.365 32.816 70.958-45.916zM254.36 129.706l-45.941 27.964 47.533 30.757 45.6-29.507zM329.762 176.385l-46.21 29.9 70.964 45.916 47.611-31.021zM355.945 67.872l-72.854 44.345 46.322 28.676 73.907-47.822z"/>
                      <path fill="#fff" d="M255.952 224.143l-71.053 45.977 71.057 46.298 71.055-46.297zM78.291 109.189L0 150.302l79.174 50.935 72.847-44.341zM255.956 15.675l-70.147 36.32 68.69 42.523 70.671-43.019zM433.614 109.185l-75.991 49.171 72.264 44.737 82.025-52.791z"/>
                    </svg>
                </span>
                <span class="m-menu__link-text">Consent for OC</span>
            </a>
        </li>
        @endif
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='ree.ree-note-consentoc')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" href="{{ route('ree.ree-note-consentoc', encrypt($oc_application->id)) }}">
                <span class="sidebar-icon sidebar-menu-icon--level-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="#fff" d="M352.459 220c0-11.046-8.954-20-20-20h-206c-11.046 0-20 8.954-20 20s8.954 20 20 20h206c11.046 0 20-8.954 20-20zM126.459 280c-11.046 0-20 8.954-20 20s8.954 20 20 20H251.57c11.046 0 20-8.954 20-20s-8.954-20-20-20H126.459z"/>
                    <path fill="#fff" d="M173.459 472H106.57c-22.056 0-40-17.944-40-40V80c0-22.056 17.944-40 40-40h245.889c22.056 0 40 17.944 40 40v123c0 11.046 8.954 20 20 20s20-8.954 20-20V80c0-44.112-35.888-80-80-80H106.57c-44.112 0-80 35.888-80 80v352c0 44.112 35.888 80 80 80h66.889c11.046 0 20-8.954 20-20s-8.954-20-20-20z"/>
                    <path fill="#fff" d="M467.884 289.572c-23.394-23.394-61.458-23.395-84.837-.016l-109.803 109.56a20.005 20.005 0 0 0-5.01 8.345l-23.913 78.725a20 20 0 0 0 24.476 25.087l80.725-22.361a19.993 19.993 0 0 0 8.79-5.119l109.573-109.367c23.394-23.394 23.394-61.458-.001-84.854zM333.776 451.768l-40.612 11.25 11.885-39.129 74.089-73.925 28.29 28.29-73.652 73.514zM439.615 346.13l-3.875 3.867-28.285-28.285 3.862-3.854c7.798-7.798 20.486-7.798 28.284 0 7.798 7.798 7.798 20.486.014 28.272zM332.459 120h-206c-11.046 0-20 8.954-20 20s8.954 20 20 20h206c11.046 0 20-8.954 20-20s-8.954-20-20-20z"/>
                    </svg>
                </span>
                <span class="m-menu__link-text">REE Note</span>
            </a>
        </li>
        @if($oc_application->OC_Generation_status ==
        config('commanConfig.applicationStatus.OC_Approved') || $oc_application->OC_Generation_status ==
        config('commanConfig.applicationStatus.sent_to_society'))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='ree.approved_consent_oc_letter')?'m-menu__item--active':''}}"
            aria-haspopup="true">
            <a class="m-menu__link m-menu__toggle" title="Offer Letter" href="{{route('ree.approved_consent_oc_letter',encrypt($oc_application->id))}}">
                <span class="sidebar-icon sidebar-menu-icon--level-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                      <path fill="#fff" d="M465.229 215.91L256.044 352.199 46.859 215.91.088 240.255l255.956 166.116L512 240.255z"/>
                      <path fill="#fff" d="M465.229 305.863l-209.185 136.29-209.185-136.29L.088 330.209l255.956 166.116L512 330.209zM155.163 68.298l-46.579 24.776 71.88 46.509 45.305-27.576zM179.975 174.983l-72.946 44.402 50.365 32.816 70.958-45.916zM254.36 129.706l-45.941 27.964 47.533 30.757 45.6-29.507zM329.762 176.385l-46.21 29.9 70.964 45.916 47.611-31.021zM355.945 67.872l-72.854 44.345 46.322 28.676 73.907-47.822z"/>
                      <path fill="#fff" d="M255.952 224.143l-71.053 45.977 71.057 46.298 71.055-46.297zM78.291 109.189L0 150.302l79.174 50.935 72.847-44.341zM255.956 15.675l-70.147 36.32 68.69 42.523 70.671-43.019zM433.614 109.185l-75.991 49.171 72.264 44.737 82.025-52.791z"/>
                    </svg>
                </span>
                <span class="m-menu__link-text">Approved Consent for Oc</span></a>
        </li>
        @endif
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='ree-forward-application-oc')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" href="{{ route('ree-forward-application-oc', encrypt($oc_application->id)) }}">
                 <span class="sidebar-icon sidebar-menu-icon--level-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58.424 58.424">
                        <path fill="#fff" d="M57.417 14.489L43.007 0v8.652c-3.874.031-6.7.909-8.556 1.771H1.007v48h48V22.945l8.41-8.456zm-14.195-3.838c.247 0 .498.004.755.012l1.03.03V4.848l9.59 9.642-5.59 5.619-.948.953-3.052 3.069V18.528l-.765-.185c-.036-.009-.756-.179-1.928-.237-3.221-.161-9.887.532-15.393 7.803.128-2.78 1.007-7.121 4.672-10.93a18.057 18.057 0 0 1 1.592-1.477l.011-.009.114-.087.067-.051c.036-.027.081-.058.124-.088a6.696 6.696 0 0 1 .257-.175 10.8 10.8 0 0 1 .252-.16l.074-.045c1.448-.873 4.455-2.236 9.138-2.236z"/>
                    </svg>
                </span>
                <span class="m-menu__link-text">Forward Application</span>
            </a>
        </li>
    </ul>
</li>