@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.hearing.actions',compact('hearing_data'))
@endsection
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">View hearing</h3>
            {{ Breadcrumbs::render('View Hearing', $arrData['hearing']['id']) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="preceding_officer_name">Name of Presiding Officer:</label>
                        <input type="text" id="preceding_officer_name" name="preceding_officer_name" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->preceding_officer_name }}" disabled>
                        <span class="help-block">{{$errors->first('preceding_officer_name')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                        <input disabled type="text" id="case_number" name="case_number" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->id }}">
                        <span class="help-block">{{$errors->first('case_number')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <input type="text" id="case_number" name="case_year" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->case_year }}" disabled>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="application_type_id">Application Type:</label>
                        @foreach($arrData['application_type'] as $application_type)
                            @if($arrData['hearing']->application_type_id == $application_type->id)
                                @php $application_name = $application_type->application_type; @endphp
                            @endif
                        @endforeach
                        <input type="text" id="application_type_id" name="application_type_id" class="form-control form-control--custom m-input"
                               value="{{ $application_name }}" disabled>
                        <span class="help-block">{{$errors->first('application_type_id')}}</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">

                    <div class="col-sm-4 offset-sm-0 form-group">
                        <label class="col-form-label" for="hearing_user_id">Hearing User:</label>
                        @if($arrData['hearing']->hearing_user_id != null)
                            @foreach($users as $user)
                                @if($user->id == $arrData['hearing']->hearing_user_id)
                                    @php
                                        $user_name = $user->name;
                                        $role_name = $user->roleDetails->name;
                                    @endphp
                                @endif
                            @endforeach
                        <input type="text" id="hearing_user_id" name="hearing_user_id" class="form-control form-control--custom m-input"
                               value="{{ $user_name." (".$role_name.")" }}" disabled>
                        @else
                            <span class="star">This hearing is not assigned to any admin user</span>
                        @endif
                        <span class="help-block">{{$errors->first('case_year')}}</span>
                    </div>

                    @if($arrData['hearing']->hearing_user_id != null)
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="hearing_user_id">Hearing Letter by {{$user_name}}:</label>
                        <div class="custom-file">
                        @if($arrData['hearing']->uploaded_hearing_letter)
                            <div class="d-flex" style="padding-top: 10px;">
                                <div class="text-truncate text-primary">hearing-letter</div>
                                <a href="{{ config('commanConfig.storage_server').'/'.$hearing_data->hearing_letter[0]->document_path }}"><img style="cursor:pointer;" download class="download-icon-pdf" src="{{ asset('/img/down-arrow.svg') }}"></a>
                            </div>
                                @else
                                <span class="star">No Hearing Letter Uploaded by {{$user_name}}. </span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

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
                        <input type="text" id="applicant_name" name="applicant_name" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->applicant_name }}" disabled>
                        <span class="help-block">{{$errors->first('applicant_name')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="applicant_mobile_no">Mobile Number:</label>
                        <input type="text" id="applicant_mobile_no" name="applicant_mobile_no" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->applicant_mobile_no }}" disabled>
                        <span class="help-block">{{$errors->first('applicant_mobile_no')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="applicant_address">Address:</label>
                        <textarea id="applicant_address" name="applicant_address" class="form-control form-control--custom form-control--fixed-height m-input" disabled>{{ $arrData['hearing']->applicant_address }}</textarea>
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
                        <input type="text" id="respondent_name" name="respondent_name" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->respondent_name }}" disabled>
                        <span class="help-block">{{$errors->first('respondent_name')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="respondent_mobile_no">Mobile Number:</label>
                        <input type="text" id="respondent_mobile_no" name="respondent_mobile_no" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->respondent_mobile_no }}" disabled>
                        <span class="help-block">{{$errors->first('respondent_mobile_no')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="respondent_address">Address:</label>
                        <textarea id="respondent_address" name="respondent_address" class="form-control form-control--custom form-control--fixed-height" disabled>{{ $arrData['hearing']->respondent_address }}</textarea>
                        <span class="help-block">{{$errors->first('respondent_address')}}</span>
                    </div>
                </div>

                <div class="m-portlet__head px-0 m-portlet__head--top">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Office Details :-
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="case_type">Case Type:</label>
                        <input type="text" id="case_type" name="case_type" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->case_type }}" disabled>
                        <span class="help-block">{{$errors->first('case_type')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="office_year">Year:</label>
                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="office_year"
                                name="office_year" disabled>
                            @php
                                $start_year = date('Y', strtotime('-15 year'));
                                $end_year = date('Y', strtotime('+15 year'));
                            @endphp
                            @for($start_year; $start_year <= $end_year; $start_year++) <option value="{{ $start_year }}"
                                    {{ ($start_year == $arrData['hearing']->office_year) ? "selected" : "" }}>{{
                                $start_year }}</option>
                            @endfor
                        </select>
                        <span class="help-block">{{$errors->first('office_year')}}</span>
                    </div>

                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="office_number">Number:</label>
                        <input type="text" id="office_number" name="office_number" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->office_number }}" disabled>
                        <span class="help-block">{{$errors->first('office_number')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="office_date">Date:</label>
                        <input type="text" id="office_date" name="office_date" class="form-control form-control--custom m_datepicker"
                               disabled value="{{ date(config('commanConfig.dateFormat'), strtotime($arrData['hearing']->office_date))}}" >
                        <span class="help-block">{{$errors->first('office_date')}}</span>

                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="office_tehsil">Tehsil:</label>
                        <input type="text" id="office_tehsil" name="office_tehsil" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->office_tehsil }}" disabled>
                        <span class="help-block">{{$errors->first('office_tehsil')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="office_village">Village:</label>
                        <input type="text" id="office_village" name="office_village" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->office_village }}" disabled>
                        <span class="help-block">{{$errors->first('office_village')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="office_remark">Remarks:</label>
                        <textarea id="office_remark" name="office_remark" class="form-control form-control--custom form-control--fixed-height m-input" disabled>{{ $arrData['hearing']->office_remark }}</textarea>
                        <span class="help-block">{{$errors->first('office_remark')}}</span>
                    </div>

                    {{--<div class="col-sm-4 offset-sm-1 form-group">--}}
                    {{--<label class="col-form-label" for="hearing_status_id">Status:</label>--}}
                    {{--<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="hearing_status_id"--}}
                    {{--name="hearing_status_id">--}}
                    {{--@foreach($arrData['status'] as $hearing_status)--}}
                    {{--<option value="{{ $hearing_status->id  }}"--}}
                    {{--{{ ($arrData['hearing']->hearing_status_id == $hearing_status->id) ? "selected" : "" }}>{{--}}
                    {{--$hearing_status->status_title}}</option>--}}
                    {{--@endforeach--}}
                    {{--</select>--}}
                    {{--<span class="help-block">{{$errors->first('hearing_status_id')}}</span>--}}
                    {{--</div>--}}
                    <div class="col-sm-4 offset-sm-1 form-group">
                        {{--<label class="col-form-label" for="status">Heaing Status:</label>--}}
                        {{--<select disabled class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"--}}
                                {{--id="status"--}}
                                {{--name="status">--}}
                            {{--@foreach($arrData['status'] as $hearing_status)--}}
                                {{--<option value="{{ $hearing_status->id  }}"--}}
                                        {{--{{ ($hearing_status->id == $hearing_data['hearingStatusLog']['0']['hearing_status_id']) ? "selected" : "" }}>{{--}}
                        {{--$hearing_status->status_title}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                        {{--<span class="help-block">{{$errors->first('status')}}</span>--}}
                        @php
                        $status= $hearing_data['hearingStatusLog']['0']['hearing_status_id'];
                        $config_array = array_flip(config('commanConfig.hearingStatus'));
                        $hearing_status = ucwords(str_replace('_', ' ', $config_array[$status]));

                        if($hearing_status == 'Scheduled Meeting' && count($hearing_data['hearingSchedule']['prePostSchedule']) > 0) {
                            if ($hearing_data['hearingSchedule']['prePostSchedule'][0]['pre_post_status'] == 1) {
                                $hearing_status = $hearing_status . ' Preponed';
                            }else{
                                $hearing_status = $hearing_status . ' Postponed';
                            }
                        }

                        @endphp
                        <label class="col-form-label" for="status">Hearing Status:</label>
                        <input type="text" id="status" name="status" class="form-control form-control--custom m-input"
                               value="{{$hearing_status}}" disabled>
                        <span class="help-block">{{$errors->first('status')}}</span>

                    </div>
                </div>

                {{--<div class="form-group m-form__group row">--}}
                {{--<div class="col-sm-4 form-group">--}}
                {{--<label class="col-form-label" for="board_id">Board:</label>--}}
                {{--<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="board_id"--}}
                {{--name="board_id">--}}
                {{--@foreach($arrData['board'] as $board_details)--}}
                {{--<option value="{{ $board_details->id  }}"--}}
                {{--{{ ($arrData['hearing']->board_id == $board_details->id) ? "selected" : "" }}>{{--}}
                {{--$board_details->board_name }}</option>--}}
                {{--@endforeach--}}
                {{--</select>--}}
                {{--<span class="help-block">{{$errors->first('board_id')}}</span>--}}
                {{--</div>--}}

                {{--<div class="col-sm-4 offset-sm-1 form-group">--}}
                {{--<label class="col-form-label" for="department">Department:</label>--}}
                {{--<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="department"--}}
                {{--name="department">--}}
                {{--@foreach($arrData['department'] as $department_details)--}}
                {{--<option value="{{ $department_details->id  }}"--}}
                {{--{{ ($arrData['hearing']->department_id == $department_details->id) ? "selected" : "" }}>{{--}}
                {{--$department_details->department_name }}</option>--}}
                {{--@endforeach--}}
                {{--</select>--}}
                {{--<span class="help-block">{{$errors->first('board_id')}}</span>--}}
                {{--</div>--}}
                {{--</div>--}}
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
</div>
@include('admin.hearing.delete_hearing')
@endsection
