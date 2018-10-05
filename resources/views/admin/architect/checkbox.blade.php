@if(session()->get('role_name') == config('commanConfig.junior_architect'))
    @if($architect_applications->application_status=='Final')
    @else
    <input type="checkbox" name="application_id[]" value="{{$architect_applications->id}}">
    @endif
@endif
@if(session()->get('role_name') == config('commanConfig.selection_commitee'))
    @if($architect_applications->application_status=='Final')
    @else
    <input type="checkbox" name="application_id[]" value="{{$architect_applications->id}}">
    @endif
@endif