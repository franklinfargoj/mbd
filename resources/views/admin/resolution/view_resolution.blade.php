@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.resolution.actions',compact('resolution'))
@endsection
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">View Resolution </h3>
            {{ Breadcrumbs::render('resolution_view',$resolution->id) }}
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        <form id="edit_resolutionForm" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="{{route('resolution.update', $resolution->id)}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="m-portlet__body m-portlet__body--spaced">

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('board')) has-error @endif">
                            <label class="col-form-label">Board:</label>
                            <select name="board_id" id="board_id" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" disabled>
                                <option value="">Select Board</option>
                                @foreach($boards as $boardVal)
                                <option value="{{ $boardVal['id'] }}"
                                    {{ old('board_id',$resolution->board_id)==$boardVal['id']?'selected':'' }}>{{
                                    $boardVal['board_name'] }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('board')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('department')) has-error @endif">
                            <label class="col-form-label">Department:</label>
                            <select name="department" id="department_id" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input">
                                <option value="{{$resolution->department_id}}" disabled selected >{{old('department',$resolution->department_name)}}</option>
                            </select>
                            <span class="help-block">{{$errors->first('department')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('resolution_type')) has-error @endif">
                            <label class="col-form-label">Resolution Type:</label>
                            <select name="resolution_type" id="resolution_type_id" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" disabled>
                                <option value="">Select Resolution Type</option>
                                @foreach($resolutionTypes as $resolutionTypeVal)
                                <option value="{{ $resolutionTypeVal['id'] }}"
                                    {{ old('resolution_type_id',$resolution->resolution_type_id)==$resolutionTypeVal['id']?'selected':'' }}>{{
                                    $resolutionTypeVal['name'] }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('resolution_type')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('resolution_code')) has-error @endif">
                            <label class="col-form-label">Resolution Code:</label>
                            <input type="text" name="resolution_code" id="resolution_code" class="form-control form-control--custom m-input"
                                value="{{old('resolution_code',$resolution->resolution_code)}}" readonly>
                            <span class="help-block">{{$errors->first('resolution_code')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('title')) has-error @endif">
                            <label class="col-form-label">Title:</label>
                            <input type="text" name="title" id="title" class="form-control form-control--custom m-input"
                                value="{{old('title',$resolution->title)}}" readonly>
                            <span class="help-block">{{$errors->first('title')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('description')) has-error @endif">
                            <label class="col-form-label">Description:</label>
                            <textarea name="description" id="description" class="form-control form-control--custom form-control--fixed-height m-input" readonly>{{old('description',$resolution->description)}}</textarea>
                            <span class="help-block">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('file')) has-error @endif">
                            <label class="col-form-label">File:</label>
                            <div class="custom-file">
                                <input type="file" name="file" id="uploadedFile" class="custom-file-input" readonly disabled>
                                <label class="custom-file-label" for="uploadedFile">{{old('description',$resolution->filename)}}</label>
                                <a href="{{ config('commanConfig.storage_server').$resolution->filepath.$resolution->filename }}"">{{old('description',$resolution->filename)}}</a>
                                <span class="help-block">{{$errors->first('file')}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('language')) has-error @endif">
                            <label class="col-form-label">Language:</label>
                            <input type="text" name="language" id="language" class="form-control form-control--custom m-input"
                                value="{{old('language',$resolution->language)}}" readonly>
                            <span class="help-block">{{$errors->first('language')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('reference_link')) has-error @endif">
                            <label class="col-form-label">Reference Link (if any):</label>
                            <input type="text" name="reference_link" id="reference_link" class="form-control form-control--custom m-input"
                                value="{{old('reference_link',$resolution->reference_link)}}" readonly>
                            <span class="help-block">{{$errors->first('reference_link')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('published_date')) has-error @endif">
                            <label class="col-form-label">Published Date:</label>
                            <input type="text" name="published_date" id="published_date" class="form-control form-control--custom m-input m_datepicker"
                                value="{{old('published_date',$resolution->published_date)}}" readonly disabled>
                            <span class="help-block">{{$errors->first('published_date')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label">Revision Log Message:</label>
                        <div class="@if($errors->has('revision_log_message')) has-error @endif">
                            <textarea name="revision_log_message" id="revision_log_message" class="form-control form-control--custom form-control--fixed-height m-input" readonly>{{old('revision_log_message',$resolution->revision_log_message)}}</textarea>
                            <span class="help-block">{{$errors->first('revision_log_message')}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('revision_log_message')) has-error @endif">
                            <label class="col-form-label">Keyword:</label>
                            <textarea name="keyword" id="keyword" class="form-control form-control--custom form-control--fixed-height m-input" readonly>{{old('keyword',$resolution->keyword)}}</textarea>
                            <span class="help-block text-danger">{{$errors->first('keyword')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="btn-list">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{url('/resolution')}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

 
    <!-- END EXAMPLE TABLE PORTLET-->
@include('admin.resolution.delete_resolution')
</div>
@endsection
@section('add_resolution_js')
<script>
    $('input[type=file]').change(function () {
        $('#File_name').css("display", "none");
    });

</script>
@endsection
