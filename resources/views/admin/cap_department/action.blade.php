<a title="view_Application" href="">View Application</a>  
<a title="Society_EE_Documents" href="{{route('cap.society_EE_documents',$cap_application_data->id)}}">Society & EE Documents</a> 
<a title="EE_Scrutiny_Remark" href="{{route('cap.EE_scrutiny_remark',$cap_application_data->id)}}">EE Scrutiny & Remarks</a>  
<a title="DYCE_Scrutiny_Remark" href="{{route('cap.dyce_Scrutiny_Remark',$cap_application_data->id)}}">DyCE Scrutiny & Remarks</a> 
<a title="REE_calculation_sheet" href="">REE calculation sheet</a>
@if(!$request->update_status && $cap_application_data->olApplicationStatusForLoginListing[0]->status_id == config('commanConfig.applicationStatus.in_process'))
    <a title="Forward_application" href="{{route('cap.forward_application',$cap_application_data->id)}}">Forward Application</a>
@endif
<a title="CAP_notes" href="{{route('cap.cap_notes',$cap_application_data->id)}}">CAP Notes</a>

