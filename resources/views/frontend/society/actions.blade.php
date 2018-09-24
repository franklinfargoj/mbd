<a title="View Documents" href="{{ route('documents_uploaded') }}"><i class="icon-pencil"></i>View Documents</a>
@if($ol_applications->olApplicationStatus[0]->status_id == '3' || $ol_applications->olApplicationStatus[0]->status_id == '4')
<a title="View Documents" href="{{ route('documents_upload') }}"><i class="fa fa-pencil"></i></a>
@endif