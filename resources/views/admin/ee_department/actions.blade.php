<<<<<<< HEAD
<a title="view_Application" href="{{ route('society_offer_download', $ee_application_data->id) }}">View Application</a>
<a href="{{ route('document-submitted', $ee_application_data->id) }}">Society Documents</a>

<a href="{{ route('society_offer_download', $ee_application_data->id) }}">View Application</a>
<!-- <a href="{{ route('document-submitted', $ee_application_data->society_id) }}">Society Documents</a> -->

<a href="{{ route('scrutiny-remark', [$ee_application_data->id, $ee_application_data->society_id]) }}">Scrutiny & Remarks</a>

@if($ee_application_data->olApplicationStatusForLoginListing[0]->status_id == config('commanConfig.applicationStatus.in_process'))

    <a href="{{ route('get-forward-application', $ee_application_data->id) }}">Forward Application</a>
@endif
