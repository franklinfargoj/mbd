<a  href="{{ route('hearing.show', $hearing_data->id) }}"></i>View Hearing</a> |
<a href="{{ route('hearing.edit', $hearing_data->id) }}"></i>Edit Details</a> |

@if($hearing_data->hearingSchedule)
    <a href="#" style="pointer-events: none;cursor: default;"></i>Schedule Hearing</a> |
@else
    <a href="{{ route('schedule_hearing.add', $hearing_data->id) }}"></i>Schedule Hearing</a> |
    <a href="#" style="pointer-events: none;cursor: default;"></i>Prepone/ Postpone Hearing</a> |
@endif

@if($hearing_data->hearingSchedule && $hearing_data->hearingSchedule->prePostSchedule)
    <a href="{{ route('fix_schedule.edit', $hearing_data->id) }}"></i>Prepone/ Postpone Hearing</a> |
@else
    <a href="{{ route('fix_schedule.add', $hearing_data->id) }}"></i>Prepone/ Postpone Hearing</a> |
@endif

<a href=""></i>Update Status</a> |
<a href=""></i>Case Judgement</a> |
<a href=""></i>Forward Case</a> |
<a href=""></i>Send Notice To Applicant</a>