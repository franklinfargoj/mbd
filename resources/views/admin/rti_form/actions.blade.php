<a title="Edit" href="{{ url('/view_applicant/'.$rti_applicants->id) }}"></i>View Applications</a>
<a title="Schedule Meeting" href="{{ url('/schedule_meeting/'.$rti_applicants->id) }}"></i>Schedule Meeting</a> 
<a title="Edit" href="{{ url('/update_status/'.$rti_applicants->id) }}"></i>Update Status</a>
<a title="Edit" href="{{ url('/rti_send_info/'.$rti_applicants->id) }}"></i>Send Information To Applicant</a>
<a title="Edit" href="{{ url('/rti_forward_application/'.$rti_applicants->id) }}"></i>Forward Application</a>
{{--<a title="Delete" href="{{ route('resolution.delete', $rti_applicants->id) }}">Delete</a>--}}
{{--<a title="Delete" href="javascript::void(0)" onclick="deleteResolution({{$rti_applicants->id}});">Delete</a>--}}