@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.common.hearing.hearing_actions',compact('hearing_data'))
@endsection
@section('content')


    <div class="col-md-12">
        @if(Session::has('success'))
            <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:20px">×</span>
                </button> {{ Session::get('success') }}
            </div>
        @endif
            @if(session()->has('error'))
                <div class="alert alert-danger display_msg">
                    {{ session()->get('error') }}
                </div>
            @endif
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Hearing</h3>
                {{ Breadcrumbs::render('view_hearing_letter', $hearing_data->id) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left"
                                                                              style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body">
                {{--<div class="m-portlet m-portlet--mobile m-portlet--forms-view">--}}
                {{--<div class="m-portlet__body m-portlet__body--spaced">--}}
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="preceding_officer_name">Name of Presiding Officer:</label>
                        <input type="text" id="preceding_officer_name" name="preceding_officer_name"
                               class="form-control form-control--custom m-input"
                               value="{{ $hearing_data->preceding_officer_name }}" disabled>
                        <span class="help-block">{{$errors->first('preceding_officer_name')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                        <input disabled type="text" id="case_number" name="case_number"
                               class="form-control form-control--custom m-input"
                               value="{{ $hearing_data->id }}">
                        <span class="help-block">{{$errors->first('case_number')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <input type="text" id="case_number" name="case_year"
                               class="form-control form-control--custom m-input"
                               value="{{ $hearing_data->case_year }}" disabled>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="case_year">Application Type:</label>
                        <input type="text" id="application_type_id" name="application_type_id"
                               class="form-control form-control--custom m-input"
                               value="{{ $hearing_data->hearingApplicationType->application_type}}" disabled>
                        <span class="help-block">{{$errors->first('application_type_id')}}</span>
                    </div>
                </div>
                {{--<div class="form-group m-form__group row">--}}

                {{--<div class="col-sm-4 offset-sm-0 form-group">--}}
                {{--<label class="col-form-label" for="hearing_user_id">Hearing User:</label>--}}
                {{--@foreach($users as $user)--}}
                {{--@if($user->id == $hearing_data->hearing_user_id)--}}
                {{--@php--}}
                {{--$user_name = $user->name;--}}
                {{--$role_name = $user->roleDetails->name;--}}
                {{--@endphp--}}
                {{--@endif--}}
                {{--@endforeach--}}
                {{--<input type="text" id="hearing_user_id" name="hearing_user_id" class="form-control form-control--custom m-input"--}}
                {{--value="{{ $user_name." (".$role_name.")" }}" disabled>--}}
                {{--<span class="help-block">{{$errors->first('case_year')}}</span>--}}
                {{--</div>--}}
                {{--</div>--}}

                <div class="m-portlet__head px-0 m-portlet__head--top">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Applicant Details :-
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="applicant_name">Name of Applicant:</label>
                        <input type="text" id="applicant_name" name="applicant_name"
                               class="form-control form-control--custom m-input"
                               value="{{ $hearing_data->applicant_name }}" disabled>
                        <span class="help-block">{{$errors->first('applicant_name')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="applicant_mobile_no">Mobile Number:</label>
                        <input type="text" id="applicant_mobile_no" name="applicant_mobile_no"
                               class="form-control form-control--custom m-input"
                               value="{{ $hearing_data->applicant_mobile_no }}" disabled>
                        <span class="help-block">{{$errors->first('applicant_mobile_no')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="applicant_address">Address:</label>
                        <textarea id="applicant_address" name="applicant_address"
                                  class="form-control form-control--custom form-control--fixed-height m-input"
                                  disabled>{{ $hearing_data->applicant_address }}</textarea>
                        <span class="help-block">{{$errors->first('applicant_address')}}</span>
                    </div>
                </div>

                <div class="m-portlet__head px-0 m-portlet__head--top">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Respondent Details :-
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="respondent_name">Name of Respondent:</label>
                        <input type="text" id="respondent_name" name="respondent_name"
                               class="form-control form-control--custom m-input"
                               value="{{ $hearing_data->respondent_name }}" disabled>
                        <span class="help-block">{{$errors->first('respondent_name')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="respondent_mobile_no">Mobile Number:</label>
                        <input type="text" id="respondent_mobile_no" name="respondent_mobile_no"
                               class="form-control form-control--custom m-input"
                               value="{{ $hearing_data->respondent_mobile_no }}" disabled>
                        <span class="help-block">{{$errors->first('respondent_mobile_no')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="respondent_address">Address:</label>
                        <textarea id="respondent_address" name="respondent_address"
                                  class="form-control form-control--custom form-control--fixed-height"
                                  disabled>{{ $hearing_data->respondent_address }}</textarea>
                        <span class="help-block">{{$errors->first('respondent_address')}}</span>
                    </div>
                </div>

                {{--<div class="m-portlet__head px-0 m-portlet__head--top">--}}
                {{--<div class="m-portlet__head-caption">--}}
                {{--<div class="m-portlet__head-title">--}}
                {{--<span class="m-portlet__head-icon m--hide">--}}
                {{--<i class="la la-gear"></i>--}}
                {{--</span>--}}
                {{--<h3 class="m-portlet__head-text">--}}
                {{--Office Details :---}}
                {{--</h3>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group m-form__group row">--}}
                {{--<div class="col-sm-4 form-group">--}}
                {{--<label class="col-form-label" for="case_type">Case Type:</label>--}}
                {{--<input type="text" id="case_type" name="case_type" class="form-control form-control--custom m-input"--}}
                {{--value="{{ $hearing_data->case_type }}" disabled>--}}
                {{--<span class="help-block">{{$errors->first('case_type')}}</span>--}}
                {{--</div>--}}

                {{--<div class="col-sm-4 offset-sm-1 form-group">--}}
                {{--<label class="col-form-label" for="office_year">Year:</label>--}}
                {{--<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="office_year"--}}
                {{--name="office_year" disabled>--}}
                {{--@php--}}
                {{--$start_year = date('Y', strtotime('-15 year'));--}}
                {{--$end_year = date('Y', strtotime('+15 year'));--}}
                {{--@endphp--}}
                {{--@for($start_year; $start_year <= $end_year; $start_year++) <option value="{{ $start_year }}"--}}
                {{--{{ ($start_year == $hearing_data->office_year) ? "selected" : "" }}>{{--}}
                {{--$start_year }}</option>--}}
                {{--@endfor--}}
                {{--</select>--}}
                {{--<span class="help-block">{{$errors->first('office_year')}}</span>--}}
                {{--</div>--}}

                {{--</div>--}}

                {{--<div class="form-group m-form__group row">--}}
                {{--<div class="col-sm-4 form-group">--}}
                {{--<label class="col-form-label" for="office_number">Number:</label>--}}
                {{--<input type="text" id="office_number" name="office_number" class="form-control form-control--custom m-input"--}}
                {{--value="{{ $hearing_data->office_number }}" disabled>--}}
                {{--<span class="help-block">{{$errors->first('office_number')}}</span>--}}
                {{--</div>--}}

                {{--<div class="col-sm-4 offset-sm-1 form-group">--}}
                {{--<label class="col-form-label" for="office_date">Date:</label>--}}
                {{--<input type="text" id="office_date" name="office_date" class="form-control form-control--custom m_datepicker"--}}
                {{--disabled value="{{ date(config('commanConfig.dateFormat'), strtotime($hearing_data->office_date))}}" >--}}
                {{--<span class="help-block">{{$errors->first('office_date')}}</span>--}}

                {{--</div>--}}
                {{--</div>--}}

                {{--<div class="form-group m-form__group row">--}}
                {{--<div class="col-sm-4 form-group">--}}
                {{--<label class="col-form-label" for="office_tehsil">Tehsil:</label>--}}
                {{--<input type="text" id="office_tehsil" name="office_tehsil" class="form-control form-control--custom m-input"--}}
                {{--value="{{ $hearing_data->office_tehsil }}" disabled>--}}
                {{--<span class="help-block">{{$errors->first('office_tehsil')}}</span>--}}
                {{--</div>--}}

                {{--<div class="col-sm-4 offset-sm-1 form-group">--}}
                {{--<label class="col-form-label" for="office_village">Village:</label>--}}
                {{--<input type="text" id="office_village" name="office_village" class="form-control form-control--custom m-input"--}}
                {{--value="{{ $hearing_data->office_village }}" disabled>--}}
                {{--<span class="help-block">{{$errors->first('office_village')}}</span>--}}
                {{--</div>--}}
                {{--</div>--}}

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="office_remark">Remarks:</label>
                        <textarea id="office_remark" name="office_remark"
                                  class="form-control form-control--custom form-control--fixed-height m-input"
                                  disabled>{{ $hearing_data->office_remark }}</textarea>
                        <span class="help-block">{{$errors->first('office_remark')}}</span>
                    </div>

                </div>

            </div>
        </div>


        {{--hearing letter--}}
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body">

                @if($hearing_data->uploaded_hearing_letter == 0)
                <h3 class="section-title section-title--small mb-0">Letter of Hearing:</h3>
                <div class=" row-list">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="" class="btn btn-primary" data-toggle="modal"
                               data-target="#hearingLetterModal">
                                Generate/ Edit Letter of Hearing</a>
                            <!-- <button type="submit">Edit offer Letter </button> -->
                        </div>
                    </div>
                </div>
                @else
                    <h3 class="section-title section-title--small mb-0">Draft of  Generated Hearing Letter:</h3>
                    <div class=" row-list">
                        <div class="row">
                            <div class="col-md-12">
                                <a target="_blank"
                                   href="{{config('commanConfig.storage_server').'/'.$draft_hearing_letter}}"
                                   class="btn btn-primary">Download</a>
                                <!-- <button type="submit">Edit offer Letter </button> -->
                            </div>
                        </div>
                    </div>
                @endif

                <div class="w-100 row-list">
                    <div class="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="d-flex flex-column h-100">
                                    <h5>Download Hearing Letter</h5>
                                    <br/>
                                    <div class="mt-auto">

                                        @if(count($hearing_data->hearing_letter) > 0)
                                            <a target="_blank"
                                               href="{{config('commanConfig.storage_server').'/'.$hearing_data->hearing_letter[0]->document_path}}"
                                               class="btn btn-primary">Download</a>
                                        @else
                                            <span class="error"
                                                  style="display: block;color: #ce2323;margin-bottom: 17px;">
                                        * Note : Hearing Letter not available. </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if(count($hearing_data->hearing_letter) > 0)
                            <div class="col-sm-6 border-left">
                                <div class="d-flex flex-column h-100">
                                    <h5>Upload Hearing Letter</h5>
                                    <form action="{{route('upload_hearing_letter')}}"
                                          method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="hearing_id" name="hearing_id"
                                               value="{{ $hearing_data->id }}">
                                        <div class="custom-file">
                                            <input class="custom-file-input pdfcheck"
                                                   name="hearing_letter"
                                                   type="file"
                                                   id="hearing-letter-upload" required="required">
                                            <label class="custom-file-label" for="hearing-letter-upload">Choose
                                                file...</label>
                                            <span class="text-danger" id="file_error">{{session()->get('error') ?? ''}}</span>
                                        </div>
                                        <div class="mt-auto" style="float:right">
                                            <button type="submit" onclick="return confirm('Are you sure you want to upload this document?');" class="btn btn-primary btn-custom"
                                                    id="uploadBtn">
                                                Upload
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--hearing letter end--}}

        {{--hearing letter modal--}}
        <div class="modal modal-large fade" id="hearingLetterModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hearing Letter</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                        <form id="hearing_letter" action="{{route('saveHearingLetter')}}" method="POST">
                            @csrf
                            <input type="hidden" id="hearing_id" name="hearing_id"
                                   value="{{ $hearing_data->id }}">

                            <textarea id="ckeditorTextHearingletter" name="ckeditorTextHearingletter"
                                      style="display: none;">
                                @if($content_hearing_letter != null)
                                    {{ $content_hearing_letter}}
                                @else
                                    <div style="text-align:justify;" id="">
                                        <span>Hearing Letter</span>
                                    </div>
                                @endif

                                </textarea>
                            <input type="submit" value="save"
                                   style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--hearing letter modal end--}}


        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions px-0">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="btn-list">
                            <a href="{{url('/hearing_users')}}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--</div>--}}
    {{--</div>--}}
@endsection
@section('js')
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.replace('ckeditorTextHearingletter', {
            height: 700,
            allowedContent: true
        });

    </script>

@endsection
