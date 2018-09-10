<a title="Edit" href="{{ route('email_templates.edit', $email_templates->id) }}"><i class="icon-pencil"></i>Edit</a>
{{--<a title="Delete" href="{{ route('email_templates.delete', $email_templates->id) }}">Delete</a>--}}
<a title="Delete" href="javascript::void(0)" onclick="deleteEmailTemplate({{$email_templates->id}});">Delete</a>