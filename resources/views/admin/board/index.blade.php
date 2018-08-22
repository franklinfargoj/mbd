{{--@extends('admin.layouts.app')
@section('content')--}}
@if(Session::has('success'))
  {{ Session::get('success') }}
@endif
<a href="{{route('board.create')}}">Add</a>
<table class="datatable mdl-data-table dataTable" cellspacing="0" width="100%" role="grid" style="width: 100%;">
<thead>
  <tr>
    <td>Board Name</td>
    <td>Status</td>
    <td>Action</td>
  </tr>
</thead>
<tbody>
  @foreach($boards as $row)
  <tr>
    <td>{{$row->board_name}}</td>
    <td>{{$row->status==1?'Active':'Inactive'}}</td>
    <td><a title="Edit" href="{{ route('board.edit', $row->id) }}"><i class="icon-pencil"></i>Edit</a></td>
  </tr>
  @endforeach
  </tbody>
</table>
{{--@endsection--}}
