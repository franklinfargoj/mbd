@extends('admin.layouts.app')
@section('content')
<form method="post" enctype="multipart/form-data" action="{{route('faq.store')}}">
  {{csrf_field()}}
  @if($errors->has('question')) error @endif
  <label>Question</label> <input type="text" name="question" value="{{old('question')}}">
  <span class="help-block">{{$errors->first('question')}}</span>
  @if($errors->has('answer')) error @endif
  <label>Answer</label> <textarea name="answer">{{old('answer')}}</textarea>
  <span class="help-block">{{$errors->first('answer')}}</span>
  @if($errors->has('status')) error @endif
  <label>Status</label>
  <input type="radio" name="status"  @if(old('status')==1) checked @endif value="1">Active
  <input type="radio" name="status"  @if(old('status')==0) checked @endif value="0"> Inactive
  <span class="help-block">{{$errors->first('status')}}</span>
  <input type="submit" value="Save">
</form>
@endsection
