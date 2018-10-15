@extends('admin.layouts.app')
@section('actions')
    @include('admin.hearing.actions',compact('hearing_data'))
@endsection
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Hearing Scheduled</h3>
                {{ Breadcrumbs::render('Schedule Hearing', $arrData['hearing']->id) }}
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
                <input type="hidden" name="hearing_id" value="{{ $arrData['hearing']->id }}">
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="preceding_officer_name">Name of Preceding Officer:</label>
                            <input type="text" id="preceding_officer_name" name="preceding_officer_name" class="form-control form-control--custom m-input"
                                   value="{{ $arrData['hearing']->preceding_officer_name }}" readonly>
                            <span class="help-block">{{$errors->first('preceding_officer_name')}}</span>
                        </div>

                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="case_year">Case Year:</label>
                            <input type="text" id="case_year" name="case_year" class="form-control form-control--custom m-input"
                                   value="{{ $arrData['hearing']->case_year }}" readonly>
                            <span class="help-block">{{$errors->first('case_year')}}</span>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="case_number">Case Number:</label>
                            <input type="text" id="case_number" name="case_number" class="form-control form-control--custom m-input"
                                   value="{{ $arrData['hearing']->id }}" readonly>
                            <span class="help-block">{{$errors->first('case_number')}}</span>
                        </div>

                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="preceding_number">Preceding Number:</label>
                            <input type="text" id="preceding_number" name="preceding_number" class="form-control form-control--custom m-input"
                                   value="{{ $hearing_data->hearingSchedule->preceding_number }}" readonly>
                            <span class="help-block">{{$errors->first('preceding_number')}}</span>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="applicant_name">Apellent Name:</label>
                            <input type="text" id="applicant_name" name="applicant_name" class="form-control form-control--custom m-input"
                                   value="{{ $arrData['hearing']->applicant_name }}" readonly>
                            <span class="help-block">{{$errors->first('applicant_name')}}</span>
                        </div>

                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="respondent_name">Respondent Name:</label>
                            <input type="text" id="respondent_name" name="respondent_name" class="form-control form-control--custom m-input"
                                   value="{{ $arrData['hearing']->respondent_name }}" readonly>
                            <span class="help-block">{{$errors->first('respondent_name')}}</span>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="preceding_date">Preceding Date:</label>
                            <input type="text" id="preceding_date" name="preceding_date" class="form-control form-control--custom m_datepicker"
                                   class="form-control m-input" value="{{ $hearing_data->hearingSchedule->preceding_date }}">
                            <span class="help-block">{{$errors->first('preceding_date')}}</span>
                        </div>

                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="preceding_time">Preceding Time:</label>
                            <input type="text" id="preceding_time" name="preceding_time" class="form-control form-control--custom m-input"
                                   value="{{ $hearing_data->hearingSchedule->preceding_time }}">
                            <span class="help-block">{{$errors->first('preceding_time')}}</span>
                        </div>
                    </div>


                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="case_template">Case Template:</label>
                            <div class="custom-file">
                                <span><a href="{{ $hearing_data->hearingSchedule->case_template }}}" target="_blank" rel="noopener">Download</a></span>
                                <span id="file_case_template_error" class="text-danger">@if (session('error')){{ session('error') }}@endif</span>
                            </div>
                        </div>

                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="description">Description:</label>
                            <textarea id="description" name="description" class="form-control form-control--custom form-control--fixed-height m-input" readonly>{{ $hearing_data->hearingSchedule->description }}</textarea>
                            <span class="help-block">{{$errors->first('description')}}</span>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        {{--<div class="col-sm-4 form-group">--}}
                        {{--<label class="col-form-label" for="update_status">Update Status:</label>--}}
                        {{--<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="update_status"--}}
                        {{--name="update_status">--}}
                        {{--@foreach($arrData['status'] as $hearing_status)--}}
                        {{--<option value="{{ $hearing_status->id  }}"--}}
                        {{--{{ ($hearing_status->id == $arrData['hearing']->hearing_status_id) ? "selected" : "" }}>{{--}}
                        {{--$hearing_status->status_title}}</option>--}}
                        {{--@endforeach--}}
                        {{--</select>--}}
                        {{--<span class="help-block">{{$errors->first('update_status')}}</span>--}}
                        {{--</div>--}}

                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="update_supporting_documents">Supporting Documents:</label>
                            <div class="custom-file">
                                <span><a href="{{ $hearing_data->hearingSchedule->update_supporting_documents }}" target="_blank" rel="noopener">Download</a></span>
                                <span id="file_update_supporting_documents_error" class="text-danger">@if (session('error')){{ session('error') }}@endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="btn-list">
                                    <a href="{{url('/hearing')}}" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
