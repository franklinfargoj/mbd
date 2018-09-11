<a  href="{{ route('hearing.show', $hearing_data->id) }}"></i>View Hearing</a> |
<a href="{{ route('hearing.edit', $hearing_data->id) }}"></i>Edit Details</a> |

@if($hearing_data->hearingSchedule)
    <a href="#" style="pointer-events: none;cursor: default;"></i>Schedule Hearing</a> |
@else
    <a href="{{ route('schedule_hearing.add', $hearing_data->id) }}"></i>Schedule Hearing</a> |
    <a href="#" style="pointer-events: none;cursor: default;"></i>Prepone/ Postpone Hearing</a> |
@endif

@if($hearing_data->hearingSchedule)
    @if(count($hearing_data->hearingSchedule->prePostSchedule))
        <a href="{{ route('fix_schedule.edit', $hearing_data->id) }}"></i>Prepone/ Postpone Hearing</a> |
    @else
        <a href="{{ route('fix_schedule.add', $hearing_data->id) }}"></i>Prepone/ Postpone Hearing</a> |
    @endif
@endif

{{--<a href=""></i>Update Status</a> |--}}
@if(count($hearing_data->hearingUploadCaseJudgement) > 0)
    <a href="{{ route('upload_case_judgement.edit', $hearing_data->id) }}"></i>Case Judgement</a> |
@else
    <a href="{{ route('upload_case_judgement.add', $hearing_data->id) }}"></i>Case Judgement</a> |
@endif

@if(count($hearing_data->hearingForwardCase))
    <a href="{{ route('forward_case.edit', $hearing_data->id) }}"></i>Forward Case</a> |
@else
    <a href="{{ route('forward_case.create', $hearing_data->id) }}"></i>Forward Case</a> |
@endif

@if($hearing_data->hearingSchedule)
    @if(count($hearing_data->hearingSendNoticeToAppellant))
        <a href="{{ route('send_notice_to_appellant.edit', $hearing_data->id) }}"></i>Send Notice To Applicant</a> |
    @else
        <a href="{{ route('send_notice_to_appellant.create', $hearing_data->id) }}"></i>Send Notice To Applicant</a> |
    @endif
@else
    <a href="#" style="pointer-events: none;cursor: default;"></i>Send Notice To Applicant</a> |
@endif

<a href="JavaScript:void(0)" onclick="deleteHearing({{$hearing_data->id}});"></i>Delete</a>