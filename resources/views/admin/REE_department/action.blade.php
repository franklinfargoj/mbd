<a title="view_Application" href="{{ route('society_offer_download', $ree_application_data->id) }}">View Application</a>
<a title="Society_EE_Documents" href="{{route('ree.society_EE_documents',$ree_application_data->id)}}">Society & EE Documents</a>  
<a title="EE_Scrutiny_Remark" href="{{route('ree.EE_Scrutiny_Remark',$ree_application_data->id)}}">EE Scrutiny & Remarks</a>
<a title="DYCE_Scrutiny_Remark" href="{{route('ree.dyce_scrutiny_remark',$ree_application_data->id)}}">DyCE Scrutiny & Remarks</a>
@if($ree_application_data->ol_application_master->model == 'Premium')
    <a title="Prepare Calculation sheet" href="{{url('ol_calculation_sheet',$ree_application_data->id)}}">Prepare Calculation sheet</a>
@elseif($ree_application_data->ol_application_master->model == 'Sharing')
    <a title="Prepare Calculation sheet" href="{{url('ol_sharing_calculation_sheet',$ree_application_data->id)}}">Prepare Calculation sheet</a>
@endif


<a title="Offer Letter" href="{{route('ree.generate_offer_letter',$ree_application_data->id)}}">Offer Letter</a>
{{--@if($ree_application_data->olApplicationStatusForLoginListing[0]->status_id == config('commanConfig.applicationStatus.in_process'))--}}
    <a title="Forward Application" href="{{route('ree.forward_application',$ree_application_data->id)}}">Forward Application</a>
{{--@endif--}}
@if($ree_application_data->cap_notes!="")
<a title="CAP Notes" href="{{route('ree.download_cap_note',$ree_application_data->id)}}">CAP Notes</a>
@endif


