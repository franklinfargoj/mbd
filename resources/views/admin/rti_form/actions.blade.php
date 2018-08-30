<a title="Edit" href="{{ route('hearing.show', $rti_applicants->id) }}"></i>View Applications</a> |
<a title="Schedule Meeting" href="{{ url('/schedule_meeting/'.$rti_applicants->id) }}"></i>Schedule Meeting</a> |
<a title="Edit" href=""></i>Update Status</a> |
<a title="Edit" href=""></i>Send Information To Applicant</a> |
<a title="Edit" href=""></i>Forward Application</a>
{{--<a title="Delete" href="{{ route('resolution.delete', $rti_applicants->id) }}">Delete</a>--}}
{{--<a title="Delete" href="javascript::void(0)" onclick="deleteResolution({{$rti_applicants->id}});">Delete</a>--}}