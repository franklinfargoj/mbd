@extends('admin.layouts.app')
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="{{url('/')}}">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <a href="{{url('/faq')}}">{{$header_data['menu']}}</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <a href="javascript:void(0)">Edit {{$header_data['menu']}}</a>
    </li>
  </ul>
  <div class="page-toolbar">
  </div>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="row">
  <div class="col-md-12">

    <div class="portlet box purple">
                                      <div class="portlet-title">
                                          <div class="caption">
                                              <i class="fa fa-gift"></i> Edit {{$header_data['menu']}} </div>
                                          <div class="tools">
                                          </div>
                                      </div>
                                      <div class="portlet-body form">
                                          <form role="form" method="post" class="form-horizontal" action="{{url('faq/'.$faq->id)}}">
                                            @csrf
                                            @method('put')
                                              <div class="form-body">
                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Question</label>
                                                      <div class="col-md-8 @if($errors->has('question')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="text" name="question" class="form-control" value="{{old('question',$faq->question)}}">
                                                              <span class="help-block">{{$errors->first('question')}}</span>
                                                            </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Answer</label>
                                                      <div class="col-md-8 @if($errors->has('answer')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <textarea name="answer" class="form-control">{{old('answer',$faq->answer)}}</textarea>
                                                              <span class="help-block">{{$errors->first('answer')}}</span>
                                                            </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                    <label class="col-md-4 control-label">Status</label>
                                                    <div class="mt-radio-inline col-md-8">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="status" id="faqradios" value="1" @if(old('status',$faq->status)==1) checked @endif> Active
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="status" id="faqradios" value="0" @if(old('status',$faq->status)==0) checked @endif> Inactive
                                                            <span></span>
                                                        </label>
                                                        <span class="help-block">{{$errors->first('status')}}</span>
                                                    </div>
                                                </div>

                                              </div>
                                              <div class="form-actions">
                                                  <div class="row">
                                                      <div class="col-md-offset-4 col-md-8">
                                                          <a href="{{url('/faq')}}" role="button" class="btn default">Cancel</a>
                                                          <button type="submit" class="btn blue">Submit</button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
  </div>
</div>
@endsection
