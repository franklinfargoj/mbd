<a title="Edit" href="{{ route('department.edit', $departments->id) }}"><i class="icon-pencil"></i>Edit</a>
{{--<a title="Delete" href="{{ route('department.delete', $departments->id) }}">Delete</a>--}}
<a title="Delete" href="javascript::void(0)" onclick="deleteResolution({{$departments->id}});">Delete</a>