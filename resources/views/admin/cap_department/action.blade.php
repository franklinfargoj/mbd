<li class="m-menu__item m-menu__item--active" aria-haspopup="true"><a class="m-menu__link" title="view_Application" href="{{ route('cap.view_application', $ol_application->id) }}"><i class="m-menu__link-icon flaticon-line-graph"></i><span class="m-menu__link-title"><span class="m-menu__link-wrap"><span class="m-menu__link-text">View Application</span></span></span></a></li>
<li class="m-menu__item m-menu__item--active" aria-haspopup="true"><a class="m-menu__link" title="Society_EE_Documents" href="{{route('cap.society_EE_documents',$ol_application->id)}}">
<i class="m-menu__link-icon flaticon-line-graph"></i><span class="m-menu__link-title"><span class="m-menu__link-wrap"><span class="m-menu__link-text">Society & EE Documents</span></span></span></a> </li>

<li class="m-menu__item m-menu__item--active" aria-haspopup="true">
	<a class="m-menu__link" title="EE_Scrutiny_Remark" href="{{route('cap.EE_scrutiny_remark',$ol_application->id)}}">
		<i class="m-menu__link-icon flaticon-line-graph"></i>
		<span class="m-menu__link-title">
			<span class="m-menu__link-wrap"><span class="m-menu__link-text">EE Scrutiny & Remarks</span>
			</span>
		</span>
	</a>
</li>

<li class="m-menu__item m-menu__item--active" aria-haspopup="true">
	<a class="m-menu__link" title="DYCE_Scrutiny_Remark" href="{{route('cap.dyce_Scrutiny_Remark',$ol_application->id)}}">
		<i class="m-menu__link-icon flaticon-line-graph"></i> 
		<span class="m-menu__link-title">
			<span class="m-menu__link-wrap"><span class="m-menu__link-text">DyCE Scrutiny & Remarks</span> 
			</span>
		</span>
	</a>
</li>

<li class="m-menu__item m-menu__item--active" aria-haspopup="true">
	<a class="m-menu__link" title="REE_calculation_sheet" href="{{route('show_calculation_sheet',$ol_application->id)}}">
		<i class="m-menu__link-icon flaticon-line-graph"></i>
		<span class="m-menu__link-title">
		<span class="m-menu__link-wrap"><span class="m-menu__link-text">REE calculation sheet</span>
		</span></span>
	</a>
</li>

<li class="m-menu__item m-menu__item--active" aria-haspopup="true">
	<a class="m-menu__link" title="Forward_application" href="{{route('cap.forward_application',$ol_application->id)}}">
		<i class="m-menu__link-icon flaticon-line-graph"></i>
		<span class="m-menu__link-title">
		<span class="m-menu__link-wrap"><span class="m-menu__link-text">Forward Application</span>
		</span></span>
	</a>
</li>

<li class="m-menu__item m-menu__item--active" aria-haspopup="true">
	<a class="m-menu__link" title="CAP_notes" href="{{route('cap.cap_notes',$ol_application->id)}}">
		<i class="m-menu__link-icon flaticon-line-graph"></i>
		<span class="m-menu__link-title">
		<span class="m-menu__link-wrap"><span class="m-menu__link-text">CAP Notes</span>
		</span></span>
	</a>
</li>
 