<a title="view_Application" href="">View Application</a>  
<a title="Society_EE_Documents" href="{{route('co.society_EE_documents',$co_application_data->id)}}">Society & EE Documents</a>  
<a title="EE_Scrutiny_Remark" href="{{route('co.EE_Scrutiny_Remark',$co_application_data->id)}}">EE Scrutiny & Remarks</a>  
<a title="EE_Scrutiny_Remark" href="{{route('co.scrutiny_remark',$co_application_data->id)}}">DyCE Scrutiny & Remarks</a> 
<a title="EE_Scrutiny_Remark" href="">REE calculation sheet</a>  
<a title="scrutiny_remark" href="">Approve offer Letter</a>
{{--@if($co_application_data->olApplicationStatusForLoginListing[0]->status_id == config('commanConfig.applicationStatus.in_process'))--}}
    <a title="Society_EE_Documents" href="{{route('co.forward_application', $co_application_data->id)}}">Forward Application</a>
{{--@endif--}}
<a title="Cap_Note" href="{{route('co.download_cap_note', $co_application_data->id)}}">CAP Notes</a>



