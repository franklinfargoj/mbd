<a  href="{{ route('hearing.show', $hearing_data->id) }}"></i>View Hearing</a>

@if($hearing_data->hearingStatusLog[0]->hearing_status_id == config('commanConfig.hearingStatus.forwarded') || $hearing_data->hearingStatusLog[0]->hearing_status_id == config('commanConfig.hearingStatus.case_close'))
    @php
        $style = 'pointer-events: none;
   cursor: default;';
    @endphp
@else
    @php
        $style = '';
    @endphp
@endif

@if(in_array('hearing.edit', session()->get('permission')))
    <a style="{{ $style }}" href="{{ route('hearing.edit', $hearing_data->id) }}"></i>Edit Details</a>

    @if($hearing_data->hearingSchedule)
        <a style="{{ $style }}" href="#" style="pointer-events: none;cursor: default;"></i>Schedule Hearing</a>
    @else
        <a style="{{ $style }}" href="{{ route('schedule_hearing.add', $hearing_data->id) }}"></i>Schedule Hearing</a>
        <a href="#" style="pointer-events: none;cursor: default;"></i>Prepone/ Postpone Hearing</a>
    @endif

    @if($hearing_data->hearingSchedule)
        @if(count($hearing_data->hearingSchedule->prePostSchedule))
            <a style="{{ $style }}" href="{{ route('fix_schedule.edit', $hearing_data->id) }}"></i>Prepone/ Postpone Hearing</a>
        @else
            <a style="{{ $style }}" href="{{ route('fix_schedule.add', $hearing_data->id) }}"></i>Prepone/ Postpone Hearing</a>
        @endif
    @endif

    {{--<a href=""></i>Update Status</a> |--}}
    @if(count($hearing_data->hearingUploadCaseJudgement) > 0)
        <a style="{{ $style }}" href="{{ route('upload_case_judgement.edit', $hearing_data->id) }}"></i>Case Judgement</a>
    @else
        <a style="{{ $style }}" href="{{ route('upload_case_judgement.add', $hearing_data->id) }}"></i>Case Judgement</a>
    @endif
@endif

{{--@if(count($hearing_data->hearingForwardCase))--}}
    {{--<a style="{{ $style }}" href="{{ route('forward_case.edit', $hearing_data->id) }}"></i>Forward Case</a>--}}
{{--@else--}}
    <a style="{{ $style }}" href="{{ route('forward_case.create', $hearing_data->id) }}"></i>Forward Case</a>
{{--@endif--}}

@if(in_array('send_notice_to_appellant.edit', session()->get('permission')))
    @if($hearing_data->hearingSchedule)
        @if(count($hearing_data->hearingSendNoticeToAppellant))
            <a style="{{ $style }}" href="{{ route('send_notice_to_appellant.edit', $hearing_data->id) }}"></i>Send Notice To Applicant</a>
        @else
            <a href="{{ route('send_notice_to_appellant.create', $hearing_data->id) }}"></i>Send Notice To Applicant</a>
        @endif
    @else
        <a href="#" style="pointer-events: none;cursor: default;"></i>Send Notice To Applicant</a>
    @endif

    <a style="cursor: pointer; {{$style}}" class="delete-hearing" data-id="{{ $hearing_data->id }}" {{--onclick="deleteHearing({{$hearing_data->id}});"--}}></i>Delete</a>
@endif