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
    @if(Session::has('success'))
    <div class="note note-success">
      <p> {{ Session::get('success') }} </p>
    </div>
    @endif

    <div class="portlet box purple">
                                      <div class="portlet-title">
                                          <div class="caption">
                                              <i class="fa fa-gift"></i> Edit {{$header_data['menu']}} </div>
                                          <div class="tools">
                                          </div>
                                      </div>
                                      <div class="portlet-body form">
                                          <form id="boardForm" role="form" method="post" class="form-horizontal" action="{{url('board/'.$board->id)}}">
                                            @csrf
                                            @method('put')
                                              <div class="form-body">
                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Board Name</label>
                                                      <div class="col-md-8 @if($errors->has('board_name')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="text" name="board_name" id="board_name" class="form-control" value="{{old('board_name', $board->board_name)}}">
                                                              <span class="help-block">{{$errors->first('board_name')}}</span>
                                                            </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                    <label class="col-md-4 control-label">Status</label>
                                                    <div class="mt-radio-inline col-md-8">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="status" id="faqradios" value="1" @if(old('status',$board->status)==1) checked @endif> Active
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="status" id="faqradios" value="0" @if(old('status',$board->status)==0) checked @endif> Inactive
                                                            <span></span>
                                                        </label>
                                                        <span class="help-block">{{$errors->first('status')}}</span>
                                                    </div>
                                                </div>

                                              </div>
                                              <div class="form-actions">
                                                  <div class="row">
                                                      <div class="col-md-offset-4 col-md-8">
                                                          <a href="{{url('/board')}}" role="button" class="btn default">Cancel</a>
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
