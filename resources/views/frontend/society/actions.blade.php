<div class="d-flex btn-icon-list">
	<a class="d-flex flex-column align-items-center" title="View Documents" href="{{ route('documents_uploaded') }}"><span
    class="btn-icon btn-icon--view"><img src="{{ asset('/img/view-icon.svg')}}"></span>View</a>
	<a class="d-flex flex-column align-items-center" title="Application Download" href="{{ route('society_offer_letter_application_download') }}"
    target="_blank" rel="noopener"><span class="btn-icon btn-icon--delete"><img src="{{ asset('/img/download-icon.svg')}}"></span>Application Download</a>
    @if($ol_applications->olApplicationStatus[0]->status_id == '3' ||
    $ol_applications->olApplicationStatus[0]->status_id == '4')
		<a class="d-flex flex-column align-items-center" title="Edit Documents" href="{{ route('documents_upload') }}"><span
        class="btn-icon btn-icon--edit"><img src="{{ asset('/img/view-icon.svg')}}"></span>Edit</a>
    @endif
    @if($ol_applications->olApplicationStatus[0]->status_id == '7')
	    <a class="d-flex flex-column align-items-center" title="Offer Letter Download" href="{{ config('commanConfig.storage_server').'/'.$ol_applications->offer_letter_document_path }}"
	    target="_blank" rel="noopener"><span class="btn-icon btn-icon--delete"><img src="{{ asset('/img/download-icon.svg')}}"></span>Offer Letter Download</a>
    @endif
</div>