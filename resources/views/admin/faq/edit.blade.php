@extends('admin.layouts.app')
@section('content')

<form method="post" enctype="multipart/form-data" action="{{url('faq/'.$faq->id)}}">
  @csrf
  @method('put')
  @if($errors->has('question')) error @endif
  <label>Question</label> <input type="text" name="question" value="{{old('question',$faq->question)}}">
  <span class="help-block">{{$errors->first('question')}}</span>
  @if($errors->has('answer')) error @endif
  <label>Answer</label> <textarea name="answer">{{old('answer',$faq->answer)}}</textarea>
  <span class="help-block">{{$errors->first('answer')}}</span>
  @if($errors->has('status')) error @endif
  <label>Status</label> <input type="radio" name="status" @if(old('status',$faq->status)==1) checked @endif value="1">Active
  <input type="radio" name="status" @if(old('status',$faq->status)==0) checked @endif value="0"> Inactive
  <span class="help-block">{{$errors->first('status')}}</span>
  <input type="submit" value="Save">
</form>
@endsection
