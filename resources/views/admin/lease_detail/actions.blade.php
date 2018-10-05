<div class="d-flex btn-icon-list">
    @if($lease_data->lease_status == 1)
    <a class="d-flex flex-column align-items-center" title="Edit" href="{{ route('edit-lease.edit', [$lease_data->id, $lease_data->society_id]) }}"><span
            class="btn-icon btn-icon--edit"><img src="{{ asset('/img/edit-icon.svg')}}"></span>Edit</a>
    @endif
    <a class="d-flex flex-column align-items-center" title="View" href="{{ route('view-lease.view', [$lease_data->id, $lease_data->society_id]) }}"><span
            class="btn-icon btn-icon--view"><img src="{{ asset('/img/view-icon.svg')}}"></span>View</a>
    <a class="d-flex flex-column align-items-center" title="View" href="#"><i class="icon-pencil"></i>Payments</a>
</div>
