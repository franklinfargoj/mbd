<div class="d-flex btn-icon-list">
    <a class="d-flex flex-column align-items-center" href="{{ route('hearing_status.show',$status_data->id) }}"><span
                class="btn-icon btn-icon--view"><img src="{{ asset('/img/view-icon.svg')}}"></span>View</a>
    <a class="d-flex flex-column align-items-center" href="{{ route('hearing_status.edit', $status_data->id) }}"><span
                class="btn-icon btn-icon--edit"><img src="{{ asset('/img/edit-icon.svg')}}"></span>Edit</a>
    <a class="d-flex flex-column align-items-center delete-hearing-status" title="Delete" href="Javascript:void(0);" data-id="{{$status_data->id}}">
        <span class="btn-icon btn-icon--delete"><img src="{{ asset('/img/delete-icon.svg')}}"></span>Delete</a>
</div>
