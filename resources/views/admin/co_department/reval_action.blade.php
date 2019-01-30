@php
    $route="";
    $route=\Request::route()->getName();
@endphp

<li class="m-menu__item" >
    <a href="{{route('co_applications.reval')}}" class="m-menu__link m-menu__toggle">
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

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='co.view_reval_application')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="View Application" href="{{ route('co.view_reval_application', $ol_application->id) }}">
               <span class="sidebar-icon sidebar-menu-icon--level-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 437.073 437.073">
                    <path fill="#fff" d="M387.178 166.631a5.929 5.929 0 0 0-.31-1.545c-.066-.191-.113-.37-.197-.555-.292-.632-.656-1.235-1.169-1.748L224.462 1.742c-.513-.513-1.11-.877-1.742-1.164-.185-.09-.376-.137-.573-.203a5.657 5.657 0 0 0-1.51-.298C220.5.066 220.38 0 220.249 0H55.79a5.969 5.969 0 0 0-5.967 5.967v425.139c0 3.3 2.673 5.967 5.967 5.967h325.493c3.3 0 5.967-2.667 5.967-5.967V167.001c0-.132-.066-.245-.072-.37zm-202.002 99.372l-79.491 39.847v.406l79.491 39.853v14.028L90.84 311.542v-10.979l94.336-48.594v14.034zm164.304 45.742l-94.336 48.385v-14.028l80.105-39.853v-.406l-80.105-39.847v-14.034l94.336 48.385v11.398zM226.21 161.034V20.365l70.337 70.331 70.337 70.331H226.21v.007z"/>
                </svg>
            </span> 
                <span class="m-menu__link-text">View Application</span>
            </a>
        </li>

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='co.society_reval_documents')?'m-menu__item--active':''}}"
            aria-haspopup="true">
            <a class="m-menu__link m-menu__toggle" title="Society Documents" href="{{route('co.society_reval_documents',$ol_application->id)}}">
                 <span class="sidebar-icon sidebar-menu-icon--level-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 470 470">
                    <path fill="#fff" d="M327.081 0H90.234C74.331 0 61.381 12.959 61.381 28.859v412.863c0 15.924 12.95 28.863 28.853 28.863H380.35c15.917 0 28.855-12.939 28.855-28.863V89.234L327.081 0zm6.81 43.184l35.996 39.121h-35.996V43.184zm51.081 398.539c0 2.542-2.081 4.629-4.635 4.629H90.234c-2.55 0-4.619-2.087-4.619-4.629V28.859a4.616 4.616 0 0 1 4.619-4.613h219.411v70.181c0 6.682 5.443 12.099 12.129 12.099h63.198v335.197zM128.364 128.89H334.15a9.08 9.08 0 0 1 9.079 9.079 9.08 9.08 0 0 1-9.079 9.079H128.364c-5.012 0-9.079-4.066-9.079-9.079 0-5.012 4.067-9.079 9.079-9.079zm214.865 70.09c0 5.012-4.066 9.079-9.079 9.079H128.364c-5.012 0-9.079-4.066-9.079-9.079s4.067-9.079 9.079-9.079H334.15c5.013 0 9.079 4.067 9.079 9.079zm0 59.013a9.08 9.08 0 0 1-9.079 9.079H128.364c-5.012 0-9.079-4.066-9.079-9.079s4.067-9.079 9.079-9.079H334.15a9.08 9.08 0 0 1 9.079 9.079zm0 60.018a9.08 9.08 0 0 1-9.079 9.079H128.364c-5.012 0-9.079-4.066-9.079-9.079s4.067-9.079 9.079-9.079H334.15a9.08 9.08 0 0 1 9.079 9.079z"/>
                </svg>
            </span>
                <span class="m-menu__link-text">Society Documents</span>
            </a>
        </li>

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='co.show_reval_calculation_sheet')?'m-menu__item--active':''}}"
            aria-haspopup="true">
            <a class="m-menu__link m-menu__toggle" title="View Calculation Sheet" href="{{url('reval_calculation_sheet_co',$ol_application->id)}}">
                 <span class="sidebar-icon sidebar-menu-icon--level-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="#fff" d="M81 0v469.702L121.607 512h268.786L431 469.702V0H81zm320 457.632L377.607 482H134.393L111 457.632V192.334h290v265.298zM180.503 162.334V95.875h150.994v66.459H180.503zm220.497 0h-39.503V65.875H150.503v96.459H111V30h290v132.334z"/>
                        <path fill="#fff" d="M151.33 287.78h30v30h-30zM211.11 228h30v30h-30zM211.11 287.78h30v30h-30zM270.89 228h30v30h-30zM270.89 287.78h30v30h-30zM330.67 228h30v30h-30zM151.33 228h30v30h-30zM151.33 347.56h30v30h-30zM151.33 407.33h30v30h-30zM330.67 287.78h30v30h-30zM211.11 347.56h30v30h-30zM270.89 347.56h30v30h-30zM211.11 407.33h30v30h-30zM270.89 407.33h30v30h-30zM330.67 347.56h30v89.78h-30z"/>
                    </svg>
                </span>
                <span class="m-menu__link-text">View Calculation Sheet</span></a>
        </li>


        @if(isset($ol_application->offer_letter_document_path))
            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='co.approve_reval_offer_letter')?'m-menu__item--active':''}}">
                <a class="m-menu__link m-menu__toggle" title="Forward Application" href="{{route('co.approve_reval_offer_letter',$ol_application->id)}}">
                    <span class="sidebar-icon sidebar-menu-icon--level-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#fff">
                      <path d="M494.2 488V187c0-3.1-3.9-7-7.7-9.9L407.8 120V56.9c0-6.2-5.2-10.4-10.4-10.4h-89.7L262 13.2c-3.1-2.1-8.3-2.1-11.5 0l-45.7 33.3h-89.7c-6.2 0-10.4 5.2-10.4 10.4v62.4L25 177.2c-4.7 2.9-7.7 6.7-7.7 9.9v303c0 5.9 4.7 10 9.6 10.4h456.8c6.7-.1 10.5-5.3 10.5-12.5zm-19.8-282.3v263.6L302.3 331.5l172.1-125.8zm-7.7-18.3l-58.9 42.9v-86.2l58.9 43.3zM255.8 32.9l18.3 13.5h-36.7l18.4-13.5zM387 67.3v178.2l-131.2 95.6-131.2-95.6V67.3H387zM37.2 205.7l172.1 125.8L37.2 470.1V205.7zm67.6 25.4l-60.4-44 60.4-43.9v87.9zM55.9 480.6L226 343.7l23.5 17.2c4.5 3.4 7.9 3.4 12.5 0l23.5-17.2 171.1 136.9H55.9z"/>
                      <path d="M186.1 118.3h140.5v19.8H186.1zM186.1 181.8h140.5v19.8H186.1zM186.1 245.3h140.5v19.8H186.1z"/>
                    </svg>
                </span>
                    <span class="m-menu__link-text">Approve offer Letter</span>
                </a>
            </li>
        @endif

     <!--   @if($ol_application->cap_notes!="")

            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='ree.download_cap_note')?'m-menu__item--active':''}}"
                aria-haspopup="true">
                <a class="m-menu__link m-menu__toggle " title="CAP Notes" href="{{route('ree.download_cap_note',$ol_application->id)}}">
                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                              fill="#FFF" />
                    </svg>
                    <span class="m-menu__link-text">CAP Notes</span>
                </a>
            </li>
        @endif -->

        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='co.forward_reval_application')?'m-menu__item--active':''}}"
            aria-haspopup="true">
            <a class="m-menu__link m-menu__toggle " title="Forward Application" href="{{route('co.forward_reval_application',$ol_application->id)}}">
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
