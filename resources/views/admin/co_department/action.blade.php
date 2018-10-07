<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('co.view_application', $ol_application->id) }}"><img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">View Applications</span></a></li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true"><a class="m-menu__link" title="Society & EE Documents" href="{{route('co.society_EE_documents',$ol_application->id)}}">
<img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Society & EE Documents</span></a></li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
	<a class="m-menu__link m-menu__toggle" title="EE Scrutiny & Remarks" href="{{route('co.EE_Scrutiny_Remark',$ol_application->id)}}">
		<img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">EE Scrutiny & Remarks</span>
	</a>
</li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
	<a class="m-menu__link m-menu__toggle" title="DyCE Scrutiny & Remarks" href="{{route('co.scrutiny_remark',$ol_application->id)}}">
		<img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">DyCE Scrutiny & Remarks</span>
	</a>
</li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
	<a class="m-menu__link m-menu__toggle" title="REE Calculation Sheet" href="{{route('co.show_calculation_sheet',$ol_application->id)}}">
		<img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">REE Calculation Sheet</span>
	</a>
</li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
    <a class="m-menu__link m-menu__toggle" title="Forward Application" href="{{route('co.forward_application',$ol_application->id)}}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">Forward Application</span>
    </a>
</li>

@if(isset($ol_application->offer_letter_document_path))
<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
    <a class="m-menu__link m-menu__toggle" title="Forward Application" href="{{route('co.approve_offer_letter',$ol_application->id)}}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">Approve offer Letter</span>
    </a>
</li>
@endif

@if($ol_application->cap_notes!="")
<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
    <a class="m-menu__link m-menu__toggle" title="CAP Notes" href="{{route('co.download_cap_note',$ol_application->id)}}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">CAP Notes</span>
    </a>
</li>
@endif




