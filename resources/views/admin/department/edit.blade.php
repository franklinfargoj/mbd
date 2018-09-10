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
                                          <form id="departmentForm" role="form" method="post" class="form-horizontal" action="{{url('department/'.$department->id)}}">
                                              @csrf
                                              @method('put')
                                              <div class="form-body">
                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Department Name</label>
                                                      <div class="col-md-8 @if($errors->has('department_name')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="text" name="department_name" id="department_name" class="form-control" value="{{old('department_name', $department->department_name)}}">
                                                              <span class="help-block">{{$errors->first('department_name')}}</span>
                                                            </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                    <label class="col-md-4 control-label">Select Boards</label>
                                                    <div class="mt-checkbox-inline col-md-8  @if($errors->has('board_id')) has-error @endif">
                                                        @foreach($boards as $val)
                                                          <label class="mt-checkbox">
                                                            <input type="checkbox" name="board_id[]" id="board{{ $val->id }}" value="{{ $val->id }}" {{ in_array($val->id,old('board_id',$assignedBoardIds))?'checked':'' }}> {{ $val->board_name }}
                                                            <span></span>
                                                          </label>
                                                        @endforeach
                                                        <span class="help-block">{{$errors->first('board_id')}}</span>
                                                    </div>
                                                </div>

                                                  <div class="form-group">
                                                    <label class="col-md-4 control-label">Status</label>
                                                    <div class="mt-radio-inline col-md-8  @if($errors->has('status')) has-error @endif">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="status" id="faqradios" value="1" @if(old('status', $department->status)==1) checked @endif> Active
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="status" id="faqradios" value="0" @if(old('status', $department->status)==0) checked @endif> Inactive
                                                            <span></span>
                                                        </label>
                                                        <span class="help-block">{{$errors->first('status')}}</span>
                                                    </div>
                                                </div>

                                              </div>
                                              <div class="form-actions">
                                                  <div class="row">
                                                      <div class="col-md-offset-4 col-md-8">
                                                          <a href="{{url('/department')}}" role="button" class="btn default">Cancel</a>
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

