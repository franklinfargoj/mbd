<a title="view_Application" href="{{ route('society_offer_download', $vp_application_data->id) }}">View Application</a>
<a title="Society_EE_Documents" href="{{route('vp.society_EE_documents',$vp_application_data->id)}}">Society & EE Documents</a> 
<a title="EE_Scrutiny_Remark" href="{{route('vp.EE_scrutiny_remark',$vp_application_data->id)}}">EE Scrutiny & Remarks</a>  
<a title="DYCE_Scrutiny_Remark" href="{{route('vp.dyce_Scrutiny_Remark',$vp_application_data->id)}}">DyCE Scrutiny & Remarks</a> 

<a title="REE_calculation_sheet" href="{{route('show_calculation_sheet',$vp_application_data->id)}}">REE calculation sheet</a>

{{-- @if($vp_application_data->olApplicationStatusForLoginListing[0]->status_id == config('commanConfig.applicationStatus.in_process')) --}}
    <a title="Forward_application" href="{{route('vp.forward_application',$vp_application_data->id)}}">Forward Application</a>
{{-- @endif --}}
<a title="CAP_notes" href="{{route('vp.cap_notes',$vp_application_data->id)}}">CAP Notes</a>

