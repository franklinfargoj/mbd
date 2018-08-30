<a  href="{{ route('hearing.show', $hearing_data->id) }}"></i>View Hearing</a> |
<a href="{{ route('hearing.edit', $hearing_data->id) }}"></i>Edit Details</a> |

@if($hearing_data->hearingSchedule)
    <a href="#" style="pointer-events: none;cursor: default;"></i>Schedule Hearing</a> |
@else
    <a href="{{ route('schedule_hearing.add', $hearing_data->id) }}"></i>Schedule Hearing</a> |
@endif
<a href=""></i>Prepone/ Postpone Hearing</a> |
<a href=""></i>Update Status</a> |
<a href=""></i>Case Judgement</a> |
<a href=""></i>Forward Case</a> |
<a href=""></i>Send Notice To Applicant</a> |
{{--<a title="Delete" href="{{ route('resolution.delete', $resolutions->id) }}">Delete</a>--}}
{{--<a title="Delete" href="javascript::void(0)" onclick="deleteResolution({{$resolutions->id}});">Delete</a>--}}