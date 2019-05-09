@php
$route="";
$route=\Request::route()->getName();
@endphp

<li class="m-menu__item" >
   <a href="{{route('co_applications.noc_cc')}}" class="m-menu__link m-menu__toggle">
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
<li class="m-menu__item" data-toggle="collapse" data-target="#co-actions">
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
<li id="co-actions" class="collapse show">
   <ul class="list-unstyled">
      <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='co.view_noc_cc_application')?'m-menu__item--active':''}}">
         <a class="m-menu__link m-menu__toggle" title="View Application"
            href="{{ route('co.view_noc_cc_application', $noc_application->id) }}">
            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
               <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                  fill="#FFF" />
            </svg>
            <span class="m-menu__link-text">View Applications</span>
         </a>
      </li>
      <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='co.society_noc_cc_documents')?'m-menu__item--active':''}}">
         <a class="m-menu__link" title="Society  Documents" href="{{route('co.society_noc_cc_documents',$noc_application->id)}}">
            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
               <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                  fill="#FFF" />
            </svg>
            <span class="m-menu__link-text">Society Documents</span>
         </a>
      </li>
      <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='co.noc_cc_scrutiny_remarks')?'m-menu__item--active':''}}">
         <a class="m-menu__link m-menu__toggle" title="REE Note" href="{{route('co.noc_cc_scrutiny_remarks',$noc_application->id)}}">
            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
               <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                  fill="#FFF" />
            </svg>
            <span class="m-menu__link-text">REE Note</span>
         </a>
      </li>
      @if(isset($noc_application->final_draft_noc_path) && !empty($noc_application->final_draft_noc_path) && $noc_application->noc_generation_status == config('commanConfig.applicationStatus.NOC_Generation'))
      <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='co.approve_noc_cc')?'m-menu__item--active':''}}">
         <a class="m-menu__link m-menu__toggle" title="Approve Noc" href="{{route('co.approve_noc_cc',$noc_application->id)}}">
            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
               <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                  fill="#FFF" />
            </svg>
            <span class="m-menu__link-text">Approve NOC</span>
         </a>
      </li>
      @endif
       @if($noc_application->noc_generation_status ==
        config('commanConfig.applicationStatus.NOC_Issued') || $noc_application->noc_generation_status ==
        config('commanConfig.applicationStatus.sent_to_society'))
           <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='ree.approved_noc_cc_letter')?'m-menu__item--active':''}}"
               aria-haspopup="true">
               <a class="m-menu__link m-menu__toggle" title="Offer Letter" href="{{route('ree.approved_noc_cc_letter',$noc_application->id)}}">
                <span class="sidebar-icon sidebar-menu-icon--level-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#fff">
                      <path d="M448.004 93c5.523 0 10-4.477 10-10V30c0-16.542-13.458-30-30-30h-398c-16.542 0-30 13.458-30 30v452c0 16.542 13.458 30 30 30h398c16.542 0 30-13.458 30-30v-28c0-5.523-4.477-10-10-10s-10 4.477-10 10v28c0 5.514-4.486 10-10 10h-398c-5.514 0-10-4.486-10-10V30c0-5.514 4.486-10 10-10h398c5.514 0 10 4.486 10 10v53c0 5.523 4.477 10 10 10z"/>
                      <path d="M400.01 48H57.998c-5.523 0-10 4.477-10 10v209c0 5.523 4.477 10 10 10s10-4.477 10-10V68H390.01v16c0 5.523 4.478 10 10 10 5.523 0 10-4.477 10-10V58c0-5.523-4.477-10-10-10zM65.064 296.93a10.058 10.058 0 0 0-7.07-2.93c-2.63 0-5.21 1.07-7.07 2.93s-2.93 4.44-2.93 7.07 1.07 5.21 2.93 7.07c1.86 1.86 4.44 2.93 7.07 2.93 2.64 0 5.21-1.07 7.07-2.93 1.87-1.86 2.93-4.44 2.93-7.07s-1.06-5.21-2.93-7.07zM400.01 422c-5.523 0-10 4.477-10 10v12H67.998V342.5c0-5.523-4.477-10-10-10s-10 4.477-10 10V454c0 5.523 4.477 10 10 10H400.01c5.523 0 10-4.477 10-10v-22c0-5.523-4.477-10-10-10z"/>
                      <path d="M309.908 353.336c-3.905-3.906-10.236-3.906-14.142-.001L276.002 373.1l-12.285-12.286c-7.757-7.756-20.376-7.756-28.133 0l-7.994 7.994c-3.905 3.905-3.905 10.237 0 14.143 3.905 3.905 10.237 3.905 14.143 0l7.918-7.918 12.285 12.286c3.878 3.878 8.972 5.817 14.066 5.817s10.188-1.939 14.066-5.817l19.84-19.84c3.905-3.905 3.905-10.237 0-14.143z"/>
                      <path d="M507.4 209.782a29.155 29.155 0 0 0 3.609-23.231 29.152 29.152 0 0 0-14.741-18.313 9.115 9.115 0 0 1-4.907-8.499 29.157 29.157 0 0 0-8.489-21.923 29.133 29.133 0 0 0-21.923-8.489 9.087 9.087 0 0 1-8.499-4.907 29.155 29.155 0 0 0-18.313-14.741 29.146 29.146 0 0 0-23.23 3.609 9.113 9.113 0 0 1-9.813 0 29.148 29.148 0 0 0-23.23-3.609 29.155 29.155 0 0 0-18.313 14.741 9.132 9.132 0 0 1-8.499 4.907 29.142 29.142 0 0 0-21.922 8.489 29.154 29.154 0 0 0-8.49 21.922 9.117 9.117 0 0 1-4.907 8.5 29.153 29.153 0 0 0-14.741 18.313 29.05 29.05 0 0 0-.711 11.449h-174.5c-5.523 0-10 4.477-10 10s4.477 10 10 10H305.39a9.006 9.006 0 0 1-.79 1.596 29.155 29.155 0 0 0-3.609 23.231c.29 1.083.647 2.141 1.057 3.173h-176.27c-5.523 0-10 4.477-10 10s4.477 10 10 10h194.265a9.035 9.035 0 0 1 .594 3.639 29.154 29.154 0 0 0 8.49 21.923 29.127 29.127 0 0 0 21.922 8.489c3.533-.173 6.873 1.761 8.499 4.907a29.023 29.023 0 0 0 4.451 6.344v93.393a10 10 0 0 0 17.053 7.089l24.947-24.817 24.947 24.817a9.997 9.997 0 0 0 10.892 2.144 10 10 0 0 0 6.161-9.234v-93.393a28.999 28.999 0 0 0 4.451-6.344 9.126 9.126 0 0 1 8.499-4.907 29.112 29.112 0 0 0 21.922-8.489 29.154 29.154 0 0 0 8.49-21.923 9.116 9.116 0 0 1 4.907-8.499 29.153 29.153 0 0 0 14.741-18.313 29.157 29.157 0 0 0-3.609-23.232 9.11 9.11 0 0 1 0-9.812zm-79.401 170.86l-14.948-14.87c-3.901-3.881-10.204-3.881-14.105 0l-14.947 14.87V320.65a29.166 29.166 0 0 0 17.094-4.56 9.113 9.113 0 0 1 9.813 0 29.147 29.147 0 0 0 15.72 4.597c.458 0 .915-.023 1.373-.045v60zm63.691-142.991a8.991 8.991 0 0 1-4.607 5.723c-10.064 5.203-16.228 15.877-15.701 27.195a8.991 8.991 0 0 1-2.653 6.852 8.998 8.998 0 0 1-6.851 2.653c-11.324-.524-21.992 5.636-27.195 15.701a8.987 8.987 0 0 1-5.724 4.607c-2.5.669-5.08.27-7.259-1.128a29.075 29.075 0 0 0-15.702-4.586 29.082 29.082 0 0 0-15.701 4.586 8.998 8.998 0 0 1-7.26 1.128 8.993 8.993 0 0 1-5.724-4.607c-5.203-10.064-15.869-16.23-27.195-15.701a9.003 9.003 0 0 1-6.851-2.653 8.988 8.988 0 0 1-2.653-6.853c.371-7.988-2.602-15.646-7.915-21.295a9.882 9.882 0 0 0-.483-.499 28.922 28.922 0 0 0-7.303-5.4c-2.3-1.189-3.936-3.221-4.606-5.723s-.27-5.081 1.128-7.26c6.115-9.538 6.115-21.864 0-31.402a8.996 8.996 0 0 1-1.128-7.261 8.991 8.991 0 0 1 4.607-5.723c10.064-5.203 16.227-15.877 15.701-27.195a8.991 8.991 0 0 1 2.653-6.852 8.998 8.998 0 0 1 6.851-2.653c11.325.525 21.993-5.636 27.195-15.701a8.987 8.987 0 0 1 5.724-4.607 8.991 8.991 0 0 1 7.259 1.128c9.539 6.116 21.866 6.116 31.402 0a8.99 8.99 0 0 1 7.26-1.128 8.993 8.993 0 0 1 5.724 4.607c5.203 10.064 15.876 16.229 27.195 15.701a8.993 8.993 0 0 1 6.851 2.653 8.987 8.987 0 0 1 2.653 6.852c-.526 11.317 5.636 21.992 15.702 27.195a8.987 8.987 0 0 1 4.606 5.723 8.99 8.99 0 0 1-1.128 7.26c-6.115 9.538-6.115 21.864 0 31.402a8.988 8.988 0 0 1 1.128 7.261z"/>
                      <path d="M453.556 187.486c-3.905-3.905-10.237-3.905-14.142 0l-33.191 33.192-13.213-13.213c-3.905-3.905-10.237-3.905-14.143 0-3.905 3.905-3.905 10.237 0 14.143l20.284 20.284c1.953 1.953 4.512 2.929 7.071 2.929s5.119-.976 7.071-2.929l40.263-40.263c3.905-3.905 3.905-10.237 0-14.143zM122.074 120.93a10.076 10.076 0 0 0-7.07-2.93c-2.63 0-5.21 1.07-7.07 2.93-1.86 1.86-2.93 4.44-2.93 7.07s1.07 5.21 2.93 7.07c1.86 1.86 4.44 2.93 7.07 2.93s5.21-1.07 7.07-2.93c1.86-1.86 2.93-4.44 2.93-7.07s-1.07-5.21-2.93-7.07zM200.997 118H152.33c-5.523 0-10 4.477-10 10s4.477 10 10 10h48.667c5.523 0 10-4.477 10-10s-4.477-10-10-10zM302.838 294H188.516c-5.523 0-10 4.477-10 10s4.477 10 10 10h114.321c5.523 0 10-4.477 10-10s-4.476-10-9.999-10z"/>
                    </svg>
                    </span>
                   <span class="m-menu__link-text">Approved Noc</span></a>
           </li>
       @endif

      <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='co.forward_noc_cc_application')?'m-menu__item--active':''}}">
         <a class="m-menu__link m-menu__toggle" title="Forward Application" href="{{route('co.forward_noc_cc_application',$noc_application->id)}}">
            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
               <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                  fill="#FFF" />
            </svg>
            <span class="m-menu__link-text">Forward Application</span>
         </a>
      </li>
   </ul>
</li>