{{--@extends('admin.layouts.app')
@section('content')--}}
<form method="post" enctype="multipart/form-data" action="{{route('board.store')}}">
  {{csrf_field()}}
  @if($errors->has('board_name')) error @endif
  <label>Board Name</label>
  <input type="text" name="board_name" id="board_name" value="{{old('board_name')}}">
  <span class="help-block">{{$errors->first('board_name')}}</span>
  
  @if($errors->has('status')) error @endif
  <label>Status</label>
  <input type="radio" name="status"  @if(old('status')==1) checked @endif value="1">Active
  <input type="radio" name="status"  @if(old('status')==0) checked @endif value="0"> Inactive
  <span class="help-block">{{$errors->first('status')}}</span>
  
  <input type="submit" value="Save">
</form>
{{--@endsection--}}
