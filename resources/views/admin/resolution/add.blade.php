@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Add Resolution </h3>
            {{ Breadcrumbs::render('resolution_create') }}
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        <form id="add_resolutionForm" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="{{route('resolution.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('board')) has-error @endif">
                            <label class="col-form-label">Board:</label>
                            <span class="star">*</span>
                            <select name="board" id="board_id" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input">
                                <option value="">Select Board</option>
                                @foreach($boards as $boardVal)
                                <option value="{{ $boardVal['id'] }}" {{ count($boards)==1?'selected':'' }}>{{
                                    $boardVal['board_name'] }}</option>
                                @endforeach
                            </select>
                            <span class="help-block text-danger">{{$errors->first('board')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('department')) has-error @endif">
                            <label class="col-form-label">Department:</label><span class="star">*</span>
                            <select name="department" id="department_id" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input">
                                <option value="">Select Department</option>
                            </select>
                            <span class="help-block text-danger">{{$errors->first('department')}}</span>
                        </div>
                    </div>

                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('resolution_type')) has-error @endif">
                            <label class="col-form-label">Resolution Type:</label><span class="star">*</span>
                            <select name="resolution_type" id="resolution_type_id" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input">
                                <option value="">Select Resolution Type</option>
                                @foreach($resolutionTypes as $resolutionTypeVal)
                                <option value="{{ $resolutionTypeVal['id'] }}">{{ $resolutionTypeVal['name'] }}</option>
                                @endforeach
                            </select>
                            <span class="help-block text-danger">{{$errors->first('resolution_type')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('resolution_code')) has-error @endif">
                            <label class="col-form-label">Resolution Code:</label><span class="star">*</span>
                            <input type="text" name="resolution_code" id="resolution_code" class="form-control form-control--custom m-input"
                                value="{{old('resolution_code')}}">
                            <span class="help-block text-danger">{{$errors->first('resolution_code')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label">Title:</label><span class="star">*</span>
                        <div class="@if($errors->has('title')) has-error @endif">
                            <input type="text" name="title" id="title" class="form-control form-control--custom m-input"
                                value="{{old('title')}}">
                            <span class="help-block text-danger">{{$errors->first('title')}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('revision_log_message')) has-error @endif">
                            <label class="col-form-label">Keyword:</label>
                            <textarea name="keyword" id="keyword" class="form-control form-control--custom form-control--fixed-height m-input"></textarea>
                            <span class="help-block text-danger">{{$errors->first('keyword')}}</span>
                        </div>
                    </div>  
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                       <label class="col-form-label">Description:</label> <span class="star">*</span>
                        <div class="@if($errors->has('description')) has-error @endif">
                            <textarea name="description" id="description" class="form-control form-control--custom form-control--fixed-height m-input">{{old('description')}}</textarea>
                            <span class="help-block text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label">Attach File:</label><span class="star">*</span>
                        <div class="@if($errors->has('file')) has-error @endif">
                            <div class="custom-file">
                                <input type="file" name="file" id="file" class="custom-file-input">
                                <label class="custom-file-label" for="file">Choose file...</label>
                                <span class="help-block text-danger">{{$errors->first('file')}}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label">Language:</label><span class="star">*</span>
                        <div class="@if($errors->has('language')) has-error @endif">
                            <input type="text" name="language" id="language" class="form-control form-control--custom m-input"
                                value="{{old('language')}}">
                            <span class="help-block text-danger">{{$errors->first('language')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('reference_link')) has-error @endif">
                            <label class="col-form-label">Reference Link (if any):</label><span class="star">*</span>
                            <input type="text" name="reference_link" id="reference_link" class="form-control form-control--custom m-input"
                                value="{{old('reference_link')}}">
                            <span class="help-block text-danger">{{$errors->first('reference_link')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('published_date')) has-error @endif">
                            <label class="col-form-label">Published Date:</label><span class="star">*</span>
                            <input type="text" name="published_date" id="published_date" class="form-control form-control--custom m-input m_datepicker"
                                readonly value="{{old('published_date')}}">
                            <span class="help-block text-danger">{{$errors->first('published_date')}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <div class="@if($errors->has('revision_log_message')) has-error @endif">
                           <label class="col-form-label">Revision Log Message:</label> <span class="star">*</span>
                            <textarea name="revision_log_message" id="revision_log_message" class="form-control form-control--custom form-control--fixed-height m-input">{{old('revision_log_message')}}</textarea>
                            <span class="help-block text-danger">{{$errors->first('revision_log_message')}}</span>
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
</div>
@endsection
@section('add_resolution_js')
<script>
    
    loadDepartmentsOfBoard();

    $('#board_id').change(function () {
        loadDepartmentsOfBoard();
        $('.m_selectpicker').selectpicker('refresh');
    });

    function loadDepartmentsOfBoard() {
        var board_id = $('#board_id').val();
        // if (board_id != "") {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    board_id: board_id
                },
                url: "{{ route('loadDepartmentsOfBoardUsingAjax') }}",
                success: function (res) {
                    $('#department_id').html(res);
                    $('.m_selectpicker').selectpicker('refresh');
                }
            });
        // }
    }

</script>
@endsection
