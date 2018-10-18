<a title="View Application" href="{{ url('view_architect_application/'. encrypt($architect_applications->id)) }}">View Application</a>

<a title="Evaluate Apllication" href="{{ url('evaluate_architect_application/'. encrypt($architect_applications->id)) }}">Evaluate Application</a>
@php
    $status=isset($architect_applications->ArchitectApplicationStatusForLoginListing[0])?$architect_applications->ArchitectApplicationStatusForLoginListing[0]->status_id:1;
    $config_array = array_flip(config('commanConfig.architect_applicationStatus'));
    $value = ucwords(str_replace('_', ' ', $config_array[$status]));
@endphp
@if($architect_applications->application_status=='Final' && config('commanConfig.selection_commitee')!=session()->get('role_name'))
    <a title="Generate Certificate" href="{{ url('generate_certificate/'. encrypt($architect_applications->id)) }}">Issue Certificate</a>
@endif
@if($status!==config('commanConfig.architect_applicationStatus')['forward'])
    @if(($architect_applications->application_status!='Final') || config('commanConfig.architect')!=session()->get('role_name'))
    <a title="Forward" href="{{ route('architect.forward_application',['id'=>encrypt($architect_applications->id)]) }}">Forward Application</a>
    @endif
@endif 