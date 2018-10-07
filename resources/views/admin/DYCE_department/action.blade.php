<li class="m-menu__item m-menu__item--active m-menu__item--submenu" id="sub-menu" aria-haspopup="true"
    m-menu-submenu-toggle="hover">
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
    <div class="m-menu__submenu" m-hidden-height="160" style=""><span class="m-menu__arrow"></span>
        <ul class="m-menu__subnav">


<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('dyce.view_application', $ol_application->id) }}"><img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">View Applications</span></a></li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true"><a class="m-menu__link" title="Society & EE Documents" href="{{route('dyce.society_EE_documents',$ol_application->id)}}">
<img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Society & EE Documents</span></a></li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
	<a class="m-menu__link m-menu__toggle" title="EE Scrutiny & Remarks" href="{{route('dyce.EE_Scrutiny_Remark',$ol_application->id)}}">
		<img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">EE Scrutiny & Remarks</span>
	</a>
</li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
	<a class="m-menu__link m-menu__toggle" title="DyCE Scrutiny & Remarks" href="{{route('dyce.scrutiny_remark',$ol_application->id)}}">
		<img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text"> Scrutiny & Remarks</span>
	</a>
</li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
	<a class="m-menu__link m-menu__toggle" title="Forward Application" href="{{route('dyce.forward_application',$ol_application->id)}}">
		<img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Forward Application </span>
	</a>
</li>   
        </ul>
    </div>
</li>




