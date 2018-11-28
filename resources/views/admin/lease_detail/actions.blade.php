<div class="d-flex btn-icon-list">
    <a class="d-flex flex-column align-items-center" title="View" href="{{ route('view-lease.view', [$lease_data->id, $lease_data->society_id]) }}"><span
            class="btn-icon btn-icon--view"><img src="{{ asset('/img/view-icon.svg')}}"></span>View</a>
    @if($lease_data->lease_status == 1)
        @if($id)
            <a class="d-flex flex-column align-items-center" title="Edit" href="{{ route('edit-lease.edit', [$lease_data->id, $lease_data->society_id]) }}"><span
                        class="btn-icon btn-icon--edit"><img src="{{ asset('/img/edit-icon.svg')}}"></span>Edit</a>
        @endif
    @endif
    <a class="d-flex flex-column align-items-center" title="Payments" href="javascript:void(0);"><span
            class="btn-icon btn-icon--delete"><img src="{{ asset('/img/payment-icon.svg')}}"></span>Payment Details</a>
</div>
