<a title="view_Application" href="">View Application</a>  
<a title="Society_EE_Documents" href="{{route('ree.society_EE_documents',$ree_application_data->id)}}">Society & EE Documents</a>  
<a title="EE_Scrutiny_Remark" href="{{route('ree.EE_Scrutiny_Remark',$ree_application_data->id)}}">EE Scrutiny & Remarks</a>  
<a title="DYCE_Scrutiny_Remark" href="{{route('ree.dyce_scrutiny_remark',$ree_application_data->id)}}">DyCE Scrutiny & Remarks</a>  
<a title="Prepare Calculation sheet" href="">Prepare Calculation sheet</a>  
<a title="Offer Letter" href="">Offer Letter</a>
@if(!$request->update_status && $ree_application_data->olApplicationStatusForLoginListing[0]->status_id == config('commanConfig.applicationStatus.in_process'))
    <a title="Forward Application" href="{{route('ree.forward_application',$ree_application_data->id)}}">Forward Application</a>
@endif
<a title="CAP Notes" href="{{route('ree.download_cap_note',$ree_application_data->id)}}">CAP Notes</a>



