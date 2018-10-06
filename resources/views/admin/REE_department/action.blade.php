<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('ree.view_application', $ol_application->id) }}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">View Applications</span>
    </a>
</li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
    <a class="m-menu__link" title="Society & EE Documents" href="{{route('ree.society_EE_documents',$ol_application->id)}}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">Society & EE Documents</span>
    </a>
</li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a class="m-menu__link m-menu__toggle" title="EE Scrutiny & Remarks" href="{{route('ree.EE_Scrutiny_Remark',$ol_application->id)}}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">EE Scrutiny & Remarks</span>
    </a>
</li>

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
    <a class="m-menu__link m-menu__toggle" title="DyCE Scrutiny & Remarks" href="{{route('ree.dyce_scrutiny_remark',$ol_application->id)}}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">DyCE Scrutiny & Remarks</span>
    </a>
</li>

@if($ol_application->model->ol_application_master->model == 'Premium')
<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
    <a class="m-menu__link m-menu__toggle" title="Prepare Calculation sheet" href="{{url('ol_calculation_sheet',$ol_application->id)}}">
    <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
    <span class="m-menu__link-text">Prepare Calculation sheet</span></a>
</li>    
@elseif($ol_application->model->ol_application_master->model == 'Sharing')
<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
    <a class="m-menu__link m-menu__toggle" title="Prepare Calculation sheet" href="{{url('ol_sharing_calculation_sheet',$ol_application->id)}}">
    <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
    <span class="m-menu__link-text">Prepare Calculation sheet</span></a>
</li>
@endif


@if($ol_application->status_offer_letter == config('commanConfig.applicationStatus.offer_letter_generation'))
	<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
		<a class="m-menu__link m-menu__toggle" title="Offer Letter" href="{{route('ree.generate_offer_letter',$ol_application->id)}}">
		<img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
		<span class="m-menu__link-text">Offer Letter</span></a>
	</li>

@elseif($ol_application->status_offer_letter == config('commanConfig.applicationStatus.offer_letter_approved'))
	<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
		<a class="m-menu__link m-menu__toggle" title="Offer Letter" href="{{route('ree.approved_offer_letter',$ol_application->id)}}">
		<img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
		<span class="m-menu__link-text">Approved Offer Letter</span></a>
	</li>
@endif

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
    <a class="m-menu__link m-menu__toggle" title="Forward Application" href="{{route('ree.forward_application',$ol_application->id)}}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">Forward Application</span>
    </a>
</li>    

@if($ol_application->cap_notes!="")

<li class="m-menu__item m-menu__item--submenu" aria-haspopup="true">
    <a class="m-menu__link m-menu__toggle" title="CAP Notes" href="{{route('ree.download_cap_note',$ol_application->id)}}">
        <img class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}">
        <span class="m-menu__link-text">CAP Notes</span>
    </a>
</li>
@endif


