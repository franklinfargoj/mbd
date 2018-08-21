@extends('admin.layouts.app')
@section('content')
<a href="{{route('faq.create')}}">Add</a>
<table class="datatable mdl-data-table dataTable" cellspacing="0" width="100%" role="grid" style="width: 100%;">
<thead>
  <tr>
    <td>Question</td>
    <td>Answer</td>
    <td>Status</td>
  </tr>
</thead>
<tbody>
  @foreach($faqs as $row)
  <tr>
    <td>{{$row->question}}</td>
    <td>{{$row->answer}}</td>
    <td><a title="Edit" href="{{ route('faq.edit', $row->id) }}"><i class="icon-pencil"></i>Edit</a></td>
  </tr>
  @endforeach
  </tbody>
</table>
@endsection
