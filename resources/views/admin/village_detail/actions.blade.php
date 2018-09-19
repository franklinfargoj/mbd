<a href="{{ route('village_detail.show', $village_data->id) }}">View</a>
<a href="{{ route('village_detail.edit', $village_data->id) }}">Edit</a>
<a title="Delete" href="Javascript:void(0);" onclick="deleteVillage({{$village_data->id}});">Delete</a>