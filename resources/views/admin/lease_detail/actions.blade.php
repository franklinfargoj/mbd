@if($lease_data->lease_status == 1)
<a title="Edit" href="{{ route('edit-lease.edit', [$lease_data->id, $lease_data->society_id]) }}"><i class="icon-pencil"></i>Edit</a>
@endif
<a title="View" href="{{ route('view-lease.view', [$lease_data->id, $lease_data->society_id]) }}"><i class="icon-pencil"></i>View</a>