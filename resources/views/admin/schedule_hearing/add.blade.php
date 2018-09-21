@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex">
            <h3 class="m-subheader__title">Schedule Hearing</h3>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">

        <form id="createHearingSchedule" role="form" method="post" files="true" class="m-form m-form--rows m-form--label-align-right"
            action="{{route('schedule_hearing.store')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="hearing_id" value="{{ $arrData['hearing']->id }}">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="preceding_officer_name">Name of Preceding Officer:</label>
                        <input type="text" id="preceding_officer_name" name="preceding_officer_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->preceding_officer_name }}" readonly>
                        <span class="help-block">{{$errors->first('preceding_officer_name')}}</span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <input type="text" id="case_year" name="case_year" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->case_year }}" readonly>
                        <span class="help-block">{{$errors->first('case_year')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                        <input type="text" id="case_number" name="case_number" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->case_number }}" readonly>
                        <span class="help-block">{{$errors->first('case_number')}}</span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="preceding_number">Preceding Number:</label>
                        <input type="text" id="preceding_number" name="preceding_number" class="form-control form-control--custom m-input"
                            value="{{ old('preceding_number') }}">
                        <span class="help-block">{{$errors->first('preceding_number')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="applicant_name">Apellent Name:</label>
                        <input type="text" id="applicant_name" name="applicant_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->applicant_name }}" readonly>
                        <span class="help-block">{{$errors->first('applicant_name')}}</span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="respondent_name">Respondent Name:</label>
                        <input type="text" id="respondent_name" name="respondent_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->respondent_name }}">
                        <span class="help-block">{{$errors->first('respondent_name')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="preceding_date">Preceding Date:</label>
                        <input type="text" id="preceding_date" name="preceding_date" class="form-control form-control--custom m_datepicker"
                            class="form-control m-input" value="{{ old('preceding_date') }}">
                        <span class="help-block">{{$errors->first('preceding_date')}}</span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="preceding_time">Preceding Time:</label>
                        <input type="text" id="preceding_time" name="preceding_time" class="form-control form-control--custom m-input"
                            value="{{ old('preceding_time') }}">
                        <span class="help-block">{{$errors->first('preceding_time')}}</span>
                    </div>
                </div>


                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_template">Case Template:</label>
                        <div class="custom-file">
                            <input type="file" id="case_template" name="file[case_template]" class="custom-file-input">
                            <label class="custom-file-label" for="case_template">Choose file...</label>
                            <span class="help-block">{{$errors->first('file.case_template')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control form-control--custom form-control--fixed-height m-input">{{ old('description') }}</textarea>
                        <span class="help-block">{{$errors->first('description')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="update_status">Update Status:</label>
                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="update_status"
                            name="update_status">
                            @foreach($arrData['status'] as $hearing_status)
                            <option value="{{ $hearing_status->id  }}"
                                {{ ($hearing_status->id == $arrData['hearing']->hearing_status_id) ? "selected" : "" }}>{{
                                $hearing_status->status_title}}</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{$errors->first('update_status')}}</span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="update_supporting_documents">Update Supporting Documents:</label>
                        <div class="custom-file">
                            <input type="file" id="update_supporting_documents" name="file[update_supporting_documents]"
                                class="custom-file-input">
                            <label class="custom-file-label" for="update_supporting_documents">Choose file...</label>
                            <span class="help-block">{{$errors->first('file.update_supporting_documents')}}</span>
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
                                <a href="{{url('/hearing')}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('/js/mdtimepicker.min.js')}}" type="text/javascript"></script>

<script>
    $(function () {
        $('#preceding_time').timepicker();
    });

    $("#createHearingSchedule").on("submit", function () {
        $(".file-upload").each(function () {
            $(this).rules("add", {
                required: true,
                extension: "pdf",
                messages: {
                    extension: "Only pdf allowed"
                }
            });
        });

        $("#update_status").attr("disabled", false);
    })

</script>
@endsection
