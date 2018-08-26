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
      <a href="javascript:void(0)">Add {{$header_data['menu']}}</a>
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
                                              <i class="fa fa-gift"></i> Add {{$header_data['menu']}} </div>
                                          <div class="tools">
                                          </div>
                                      </div>
                                      <div class="portlet-body form">
                                          <form id="boardForm" role="form" method="post" class="form-horizontal" action="{{route('resolution.store')}}" enctype="multipart/form-data">
                                            @csrf
                                              <div class="form-body">
                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Board</label>
                                                      <div class="col-md-8 @if($errors->has('board_id')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <select name="board_id" id="board_id" class="form-control">
                                                                <option value="">Select Board</option>
                                                                @foreach($boards as $boardVal)
                                                                  <option value="{{ $boardVal['id'] }}" {{ count($boards)==1?'selected':'' }}>{{ $boardVal['board_name'] }}</option>
                                                                @endforeach
                                                              </select>
                                                              <span class="help-block">{{$errors->first('board_id')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Department</label>
                                                      <div class="col-md-8 @if($errors->has('department_id')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <select name="department_id" id="department_id" class="form-control">
                                                                <option value="">Select Department</option>
                                                              </select>
                                                              <span class="help-block">{{$errors->first('department_id')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Resolution Type</label>
                                                      <div class="col-md-8 @if($errors->has('resolution_type_id')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <select name="resolution_type_id" id="resolution_type_id" class="form-control">
                                                                <option value="">Select Resolution Type</option>
                                                                @foreach($resolutionTypes as $resolutionTypeVal)
                                                                  <option value="{{ $resolutionTypeVal['id'] }}">{{ $resolutionTypeVal['name'] }}</option>
                                                                @endforeach
                                                              </select>
                                                              <span class="help-block">{{$errors->first('resolution_type_id')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Resolution Code</label>
                                                      <div class="col-md-8 @if($errors->has('resolution_code')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="text" name="resolution_code" id="resolution_code" class="form-control" value="{{old('resolution_code')}}">
                                                              <span class="help-block">{{$errors->first('resolution_code')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Title</label>
                                                      <div class="col-md-8 @if($errors->has('title')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
                                                              <span class="help-block">{{$errors->first('title')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Description</label>
                                                      <div class="col-md-8 @if($errors->has('description')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
                                                              <span class="help-block">{{$errors->first('description')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Attach File</label>
                                                      <div class="col-md-8 @if($errors->has('file')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="file" name="file" id="file" class="form-control">
                                                              <span class="help-block">{{$errors->first('file')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Language</label>
                                                      <div class="col-md-8 @if($errors->has('language')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="text" name="language" id="language" class="form-control" value="{{old('language')}}">
                                                              <span class="help-block">{{$errors->first('language')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Reference Link (if any)</label>
                                                      <div class="col-md-8 @if($errors->has('reference_link')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="text" name="reference_link" id="reference_link" class="form-control" value="{{old('reference_link')}}">
                                                              <span class="help-block">{{$errors->first('reference_link')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Published date</label>
                                                      <div class="col-md-8 @if($errors->has('published_date')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="text" name="published_date" id="published_date" class="form-control" value="{{old('published_date')}}">
                                                              <span class="help-block">{{$errors->first('published_date')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Revision Log Message</label>
                                                      <div class="col-md-8 @if($errors->has('revision_log_message')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <textarea name="revision_log_message" id="revision_log_message" class="form-control">{{old('revision_log_message')}}</textarea>
                                                              <span class="help-block">{{$errors->first('revision_log_message')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="form-actions">
                                                  <div class="row">
                                                      <div class="col-md-offset-4 col-md-8">
                                                          <a href="{{url('/resolution')}}" role="button" class="btn default">Cancel</a>
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
