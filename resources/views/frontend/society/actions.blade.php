<a title="View Documents" href="{{ route('documents_uploaded') }}"><i class="icon-pencil"></i>View Documents</a>
<a title="Donwload Offer Letter Application" href="{{ route('society_offer_letter_application_download') }}" target="_blank" rel="noopener"><i class="icon-pencil"></i>Donwload Offer Letter Application</a>
@if($ol_applications->olApplicationStatus[0]->status_id == '3' || $ol_applications->olApplicationStatus[0]->status_id == '4')
<a title="Edit Documents" href="{{ route('documents_upload') }}"><i class="fa fa-pencil"></i></a>
@endif