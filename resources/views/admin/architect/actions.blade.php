<a title="View Application" href="{{ url('view_architect_application/'. encrypt($architect_applications->id)) }}">View Application</a>
&nbsp; | &nbsp;
<a title="Evaluate Apllication" href="{{ url('evaluate_architect_application/'. encrypt($architect_applications->id)) }}">Evaluate Application</a>
&nbsp; | &nbsp;
@if($architect_applications->application_status==4)
<a title="Generate Certificate" href="{{ url('generate_certificate/'. encrypt($architect_applications->id)) }}">Generate Certificate</a>
@else
@php
$status=isset($architect_applications->ArchitectApplicationStatusForLoginListing[0])?$architect_applications->ArchitectApplicationStatusForLoginListing[0]->status_id:1;
$config_array = array_flip(config('commanConfig.architect_applicationStatus'));
$value = ucwords(str_replace('_', ' ', $config_array[$status]));
@endphp
@if($status!==config('commanConfig.architect_applicationStatus')['forward'])
<a title="Forward" href="{{ url('forward_application/'. encrypt($architect_applications->id)) }}">Forward Application</a>
@endif 
@endif