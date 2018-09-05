@extends('admin.layouts.app')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Add Hearing </h3>
            </div>
            <div>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content"></div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">

                    </h3>
                </div>
            </div>
        </div>

        <form id="addHearingForm" role="form" method="post" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" action="{{route('hearing.store')}}">
            @csrf
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="preceding_officer_name">Name of Preceding Officer:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="preceding_officer_name" name="preceding_officer_name" class="form-control m-input" value="{{ old('preceding_officer_name') }}">
                            <span class="help-block">{{$errors->first('preceding_officer_name')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="case_number" name="case_number" class="form-control m-input" value="{{ old('case_number') }}">
                            <span class="help-block">{{$errors->first('case_number')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-input" id="case_year" name="case_year">
                                @php
                                    $start_year = date('Y', strtotime('-15 year'));
                                    $end_year = date('Y', strtotime('+15 year'));
                                @endphp

                                @for($start_year; $start_year <= $end_year; $start_year++)
                                    <option value="{{ $start_year }}" {{ ($start_year == date('Y')) ? "selected" : "" }}>{{ $start_year }}</option>
                                @endfor
                            </select>
                            <span class="help-block">{{$errors->first('case_year')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="application_type_id">Application Type:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-input" id="application_type_id" name="application_type_id">
                                @foreach($arrData['application_type'] as $application_type)
                                    <option value="{{ $application_type->id  }}">{{ $application_type->application_type }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('application_type_id')}}</span>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__head">
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
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="applicant_name">Name of Applicant:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="applicant_name" name="applicant_name" class="form-control m-input"  value="{{ old('applicant_name') }}">
                            <span class="help-block">{{$errors->first('applicant_name')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="applicant_mobile_no">Mobile Number:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="applicant_mobile_no" name="applicant_mobile_no" class="form-control m-input"  value="{{ old('applicant_mobile_no') }}">
                            <span class="help-block">{{$errors->first('applicant_mobile_no')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="applicant_address">Address:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <textarea id="applicant_address" name="applicant_address" class="form-control" class="form-control m-input">{{ old('applicant_address') }}</textarea>
                            <span class="help-block">{{$errors->first('applicant_address')}}</span>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__head">
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
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="respondent_name">Name of Respondent:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="respondent_name" name="respondent_name" class="form-control" class="form-control m-input"  value="{{ old('respondent_name') }}">
                            <span class="help-block">{{$errors->first('respondent_name')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="respondent_mobile_no">Mobile Number:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="respondent_mobile_no" name="respondent_mobile_no" class="form-control" class="form-control m-input"  value="{{ old('respondent_mobile_no') }}">
                            <span class="help-block">{{$errors->first('respondent_mobile_no')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="respondent_address">Address:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <textarea id="respondent_address" name="respondent_address" class="form-control" class="form-control m-input">{{ old('respondent_address') }}</textarea>
                            <span class="help-block">{{$errors->first('respondent_address')}}</span>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__head">
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
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_type">Case Type:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="case_type" name="case_type" class="form-control" class="form-control m-input"  value="{{ old('case_type') }}">
                            <span class="help-block">{{$errors->first('case_type')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="office_year">Year:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-input" id="office_year" name="office_year">
                                @php
                                    $start_year = date('Y', strtotime('-15 year'));
                                    $end_year = date('Y', strtotime('+15 year'));
                                @endphp
                                @for($start_year; $start_year <= $end_year; $start_year++)
                                    <option value="{{ $start_year }}" {{ ($start_year == date('Y')) ? "selected" : "" }}>{{ $start_year }}</option>
                                @endfor
                            </select>
                            <span class="help-block">{{$errors->first('office_year')}}</span>
                        </div>
                    </div>

                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="office_number">Number:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="office_number" name="office_number" class="form-control" class="form-control m-input"  value="{{ old('office_number') }}">
                            <span class="help-block">{{$errors->first('office_number')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="office_date">Date:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="date" id="office_date" name="office_date" class="form-control" class="form-control m-input"  value="{{ old('office_date') }}">
                            <span class="help-block">{{$errors->first('office_date')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="office_tehsil">Tehsil:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="office_tehsil" name="office_tehsil" class="form-control" class="form-control m-input"  value="{{ old('office_tehsil') }}">
                            <span class="help-block">{{$errors->first('office_tehsil')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="office_village">Village:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="office_village" name="office_village" class="form-control" class="form-control m-input"  value="{{ old('office_village') }}">
                            <span class="help-block">{{$errors->first('office_village')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="office_remark">Remarks:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <textarea id="office_remark" name="office_remark" class="form-control" class="form-control m-input">{{ old('office_remark') }}</textarea>
                            <span class="help-block">{{$errors->first('office_remark')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="hearing_status_id">Status:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-input" id="hearing_status_id" name="hearing_status_id">
                                @foreach($arrData['status'] as $hearing_status)
                                    <option value="{{ $hearing_status->id  }}">{{ $hearing_status->status_title}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('hearing_status_id')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="board_id">Board:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-input" id="board_id" name="board_id">
                                @foreach($arrData['board'] as $board_details)
                                    <option value="{{ $board_details->id  }}">{{ $board_details->board_name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('board_id')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="department">Department:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-input" id="department" name="department">
                                @foreach($arrData['department'] as $department_details)
                                    <option value="{{ $department_details->id  }}">{{ $department_details->department_name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('board_id')}}</span>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit"  class="btn btn-primary">Save</button>
                                <a href="{{url('/hearing')}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection