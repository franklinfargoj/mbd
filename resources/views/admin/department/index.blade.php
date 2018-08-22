{{--@extends('admin.layouts.app')
@section('content')--}}
<a href="{{route('department.create')}}">Add</a>
<table class="datatable mdl-data-table dataTable" cellspacing="0" width="100%" role="grid" style="width: 100%;">
<thead>
  <tr>
    <td>Department Name</td>
    <td>Status</td>
    <td>Action</td>
  </tr>
</thead>
<tbody>
  @foreach($departments as $row)
  <tr>
    <td>{{$row->department_name}}</td>
    <td>{{$row->status==1?'Active':'Inactive'}}</td>
    <td><a title="Edit" href="{{ route('department.edit', $row->id) }}"><i class="icon-pencil"></i>Edit</a></td>
  </tr>
  @endforeach
  </tbody>
</table>
{{--@endsection--}}
