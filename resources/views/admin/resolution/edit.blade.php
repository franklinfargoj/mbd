@extends('admin.layouts.app')
@section('content')
<!-- BEGIN: Subheader -->
  <div class="m-subheader ">
     <div class="d-flex align-items-center">
        <div class="mr-auto">
           <h3 class="m-subheader__title m-subheader__title--separator">Edit Resolution </h3>
        </div>
        <div>
        </div>
     </div>
  </div>
  <!-- END: Subheader -->           
  <div class="m-content"></div>
  {{ Breadcrumbs::render('resolution_edit',$resolution->id) }}
  <div class="m-portlet m-portlet--mobile">
     <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
           <div class="m-portlet__head-title">
              <h3 class="m-portlet__head-text">
                 
              </h3>
           </div>
        </div>
     </div>
     <form id="edit_resolutionForm" role="form" method="post" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" action="{{route('resolution.update', $resolution->id)}}" enctype="multipart/form-data">
      @csrf
      @method('put')
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-4 control-label">Board</label>
                <div class="col-md-8 @if($errors->has('board')) has-error @endif">
                    <div class="input-icon right">
                        <select name="board_id" id="board_id" class="form-control">
                          <option value="">Select Board</option>
                          @foreach($boards as $boardVal)
                             <option value="{{ $boardVal['id'] }}" {{ old('board_id',$resolution->board_id)==$boardVal['id']?'selected':'' }}>{{ $boardVal['board_name'] }}</option>
                          @endforeach
                        </select>
                        <span class="help-block">{{$errors->first('board')}}</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Department</label>
                <div class="col-md-8 @if($errors->has('department')) has-error @endif">
                    <div class="input-icon right">
                        <select name="department" id="department_id" class="form-control">
                          <option value="{{$resolution->department_id}}" selected>{{old('department',$resolution->department_name)}}</option>
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

            <div class="form-group">
                <label class="col-md-4 control-label">File</label>
                <div class="col-md-8 @if($errors->has('file')) has-error @endif">
                    <div class="input-icon right">
                        <input type="file" name="file" id="uploadedFile" class="form-control">
                        <span style="padding: .65rem 1.25rem;" id="File_name"> {{old('description',$resolution->filename)}} </span>
                        <span class="help-block">{{$errors->first('file')}}</span>
                    </div>
                </div>
            </div>

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
                <label class="col-md-4 control-label">Reference Link (if any)</label>
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
                        <input type="text" name="published_date" id="published_date" class="form-control form-control--custom m-input m_datepicker" value="{{old('published_date',$resolution->published_date)}}">
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
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
           <div class="m-form__actions m-form__actions--solid">
              <div class="row">
                 <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{url('/resolution')}}" class="btn btn-secondary">Cancel</a>
                 </div>
              </div>
           </div>
        </div>
    </form>
  </div>
  <!-- END EXAMPLE TABLE PORTLET--> 
@endsection
@section('add_resolution_js')
<script>
$('input[type=file]').change(function () {
    $('#File_name').css("display","none");
});  
</script>
@endsection
