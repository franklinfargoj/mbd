{{--@extends('admin.layouts.app')
@section('content')--}}

<form method="post" enctype="multipart/form-data" action="{{url('department/'.$department->id)}}">
  @csrf
  @method('put')
  @if($errors->has('department_name')) error @endif
  <label>Department Name</label>
  <input type="text" name="department_name" id="department_name" value="{{old('department_name', $department->department_name)}}">
  <span class="help-block">{{$errors->first('department_name')}}</span>
  
  @if($errors->has('status')) error @endif
  <label>Status</label>
  <input type="radio" name="status"  @if(old('status', $department->status)==1) checked @endif value="1">Active
  <input type="radio" name="status"  @if(old('status', $department->status)==0) checked @endif value="0"> Inactive
  <span class="help-block">{{$errors->first('status')}}</span>
  <input type="submit" value="Save">
</form>
{{--@endsection--}}
