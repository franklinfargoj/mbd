<a href="#">View Application</a> |
<a href="{{ route('document-submitted', $ee_application_data->society_id) }}">Society Documents</a> |
<a href="{{ route('scrutiny-remark', [$ee_application_data->id, $ee_application_data->society_id]) }}">Scrutiny & Remarks</a>

@if(!$request->update_status)
    |
    <a href="{{ route('get-forward-application', $ee_application_data->id) }}">Forward Application</a>
@endif
