{{--@extends('admin.layouts.app')
@section('content')--}}
<form method="post" enctype="multipart/form-data" action="{{route('department.store')}}">
  {{csrf_field()}}
  @if($errors->has('department_name')) error @endif
  <label>Department Name</label>
  <input type="text" name="department_name" id="department_name" value="{{old('department_name')}}">
  <span class="help-block">{{$errors->first('department_name')}}</span>

  @if($errors->has('board_id')) error @endif
    <label>Select Boards</label>
    @foreach($boards as $val)
      <input type="checkbox" name="board_id[]" id="board{{ $val->id }}" value="{{ $val->id }}"><label for="board{{ $val->id }}">{{ $val->board_name }}</label>
    @endforeach
  <span class="help-block">{{$errors->first('board_id')}}</span>
  
  @if($errors->has('status')) error @endif
  <label>Status</label>
  <input type="radio" name="status"  @if(old('status')==1) checked @endif value="1">Active
  <input type="radio" name="status"  @if(old('status')==0) checked @endif value="0"> Inactive
  <span class="help-block">{{$errors->first('status')}}</span>
  
  <input type="submit" value="Save">
</form>
{{--@endsection--}}
