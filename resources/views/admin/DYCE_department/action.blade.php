<a title="view_Application" href="">View Application</a>

<a title="Society_EE_Documents" href="{{ route('dyce.society_EE_documents', $dyce_application_data->id) }}">Society & EE Documents</a>

<a title="EE_Scrutiny_Remark" href="{{ route('dyce.EE_Scrutiny_Remark', $dyce_application_data->id) }}">EE Scrutiny</a>

<a title="scrutiny_remark" href="{{ route('dyce.scrutiny_remark',$dyce_application_data->id) }}">Scrutiny & Remarks</a>

{{--@if($dyce_application_data->olApplicationStatusForLoginListing[0]->status_id == config('commanConfig.applicationStatus.in_process'))--}}
    <a title="Society_EE_Documents" href="{{ route('dyce.forward_application', $dyce_application_data->id) }}">Forward Application</a>
{{--@endif--}}

