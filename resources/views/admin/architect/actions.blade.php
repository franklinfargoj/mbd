<a title="View Application" href="{{ url('view_architect_application/'. encrypt($architect_applications->id)) }}">View Application</a>

<a title="Evaluate Apllication" href="{{ url('evaluate_architect_application/'. encrypt($architect_applications->id)) }}">Evaluate Application</a>
@php $status=getLastStatusIdArchitectApplication($architect_applications->id); @endphp

@if($architect_applications->application_status=='Final' && config('commanConfig.selection_commitee')!=session()->get('role_name'))
    <a title="Generate Certificate" href="{{ route('generate_certificate',['id'=>encrypt($architect_applications->id)]) }}">Issue Certificate</a>
@endif
@if($status)
  @if($status['status_id']!=config('commanConfig.architect_applicationStatus.forward'))
    @if(($architect_applications->application_status!='Final') || config('commanConfig.architect')!=session()->get('role_name'))
    <a title="Forward" href="{{ route('architect.forward_application',['id'=>encrypt($architect_applications->id)]) }}">Forward Application</a>
    @endif
  @endif
@endif
