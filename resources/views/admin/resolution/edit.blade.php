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
                                          <form id="edit_resolutionForm" role="form" method="post" class="form-horizontal" action="{{route('resolution.update', $resolution->id)}}">
                                            @csrf
                                            @method('put')
                                              <div class="form-body">
                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Board</label>
                                                      <div class="col-md-8 @if($errors->has('board_id')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <select name="board_id" id="board_id" class="form-control">
                                                                <option value="">Select Board</option>
                                                                @foreach($boards as $boardVal)
                                                                  <option value="{{ $boardVal['id'] }}" {{ old('board_id',$resolution->board_id)==$boardVal['id']?'selected':'' }}>{{ $boardVal['board_name'] }}</option>
                                                                @endforeach
                                                              </select>
                                                              <span class="help-block">{{$errors->first('board_id')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Department</label>
                                                      <div class="col-md-8 @if($errors->has('department')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <select name="department" id="department_id" class="form-control">
                                                                <option value="">Select Department</option>
                                                              </select>
                                                              <span class="help-block">{{$errors->first('department')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Resolution Type</label>
                                                      <div class="col-md-8 @if($errors->has('resolution_type')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <select name="resolution_type" id="resolution_type_id" class="form-control">
                                                                <option value="">Select Resolution Type</option>
                                                                @foreach($resolutionTypes as $resolutionTypeVal)
                                                                  <option value="{{ $resolutionTypeVal['id'] }}" {{ old('resolution_type_id',$resolution->resolution_type_id)==$resolutionTypeVal['id']?'selected':'' }}>{{ $resolutionTypeVal['name'] }}</option>
                                                                @endforeach
                                                              </select>
                                                              <span class="help-block">{{$errors->first('resolution_type')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Resolution Code</label>
                                                      <div class="col-md-8 @if($errors->has('resolution_code')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="text" name="resolution_code" id="resolution_code" class="form-control" value="{{old('resolution_code',$resolution->resolution_code)}}">
                                                              <span class="help-block">{{$errors->first('resolution_code')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Title</label>
                                                      <div class="col-md-8 @if($errors->has('title')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="text" name="title" id="title" class="form-control" value="{{old('title',$resolution->title)}}">
                                                              <span class="help-block">{{$errors->first('title')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Description</label>
                                                      <div class="col-md-8 @if($errors->has('description')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <textarea name="description" id="description" class="form-control">{{old('description',$resolution->description)}}</textarea>
                                                              <span class="help-block">{{$errors->first('description')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  {{--<div class="form-group">
                                                      <label class="col-md-4 control-label">File</label>
                                                      <div class="col-md-8 @if($errors->has('board_name')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="text" name="board_name" id="board_name" class="form-control" value="{{old('board_name',$resolution->board_name)}}">
                                                              <span class="help-block">{{$errors->first('board_name')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>--}}

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Language</label>
                                                      <div class="col-md-8 @if($errors->has('language')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="text" name="language" id="language" class="form-control" value="{{old('language',$resolution->language)}}">
                                                              <span class="help-block">{{$errors->first('language')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Reference Link</label>
                                                      <div class="col-md-8 @if($errors->has('reference_link')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="text" name="reference_link" id="reference_link" class="form-control" value="{{old('reference_link',$resolution->reference_link)}}">
                                                              <span class="help-block">{{$errors->first('reference_link')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Published date</label>
                                                      <div class="col-md-8 @if($errors->has('published_date')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <input type="text" name="published_date" id="published_date" class="form-control" value="{{old('published_date',$resolution->published_date)}}">
                                                              <span class="help-block">{{$errors->first('published_date')}}</span>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label">Revision Log Message</label>
                                                      <div class="col-md-8 @if($errors->has('revision_log_message')) has-error @endif">
                                                          <div class="input-icon right">
                                                              <textarea name="revision_log_message" id="revision_log_message" class="form-control">{{old('revision_log_message',$resolution->revision_log_message)}}</textarea>
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