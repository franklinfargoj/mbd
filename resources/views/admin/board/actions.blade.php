<a title="Edit" href="{{ route('board.edit', $boards->id) }}"><i class="icon-pencil"></i>Edit</a>
{{--<a title="Delete" href="{{ route('board.delete', $boards->id) }}">Delete</a>--}}
<a title="Delete" href="javascript::void(0)" onclick="deleteResolution({{$boards->id}});">Delete</a>