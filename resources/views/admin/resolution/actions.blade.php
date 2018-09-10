<a title="Edit" href="{{ route('resolution.edit', $resolutions->id) }}"><i class="icon-pencil"></i>Edit</a>
{{--<a title="Delete" href="{{ route('resolution.delete', $resolutions->id) }}">Delete</a>--}}
<a title="Delete" href="javascript::void(0)" onclick="deleteResolution({{$resolutions->id}});">Delete</a>