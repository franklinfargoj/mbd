@extends('admin.layouts.app')
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/hearing')}}">{{$header_data['menu']}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Edit {{$header_data['menu']}}
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
                <div class="portlet-body form" style="display: block;">
                    <form id="editHearingForm" role="form" method="post" class="form-horizontal" action="{{route('hearing.update', $arrData['hearing']->id)}}">
                        @method('PUT')
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="preceding_officer_name">Name of Preceding Officer</label>
                                <div class="col-md-3">
                                    <input type="text" id="preceding_officer_name" name="preceding_officer_name" class="form-control"  value="{{ $arrData['hearing']->preceding_officer_name }}"  />
                                    <span class="help-block">{{$errors->first('preceding_officer_name')}}</span>
                                </div>
                                <label class="col-md-3  control-label" for="">Case Number</label>
                                <div class="col-md-3">
                                    <input type="text" id="" name="" class="form-control validate"  value=""  />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="case_year">Case Year</label>
                                <div class="col-md-3">
                                    <select class="form-control" id="case_year" name="case_year" >
                                        @php
                                            $start_year = date('Y', strtotime('-15 year'));
                                            $end_year = date('Y', strtotime('+15 year'));
                                        @endphp

                                        @for($start_year; $start_year <= $end_year; $start_year++)
                                            <option value="{{ $start_year }}" {{ ($start_year == $arrData['hearing']->case_year) ? "selected" : "" }}>{{ $start_year }}</option>
                                        @endfor
                                    </select>
                                    <span class="help-block">{{$errors->first('case_year')}}</span>
                                </div>
                                <label class="col-md-3 control-label" for="application_type_id">Application Type</label>
                                <div class="col-md-3">
                                    <select class="form-control" id="application_type_id" name="application_type_id">
                                        @foreach($arrData['application_type'] as $application_type)
                                            <option value="{{ $application_type->id  }}" {{ ($arrData['hearing']->application_type_id == $application_type->id) ? "selected" : "" }}>{{ $application_type->application_type }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">{{$errors->first('application_type_id')}}</span>
                                </div>
                            </div>

                            <hr/>

                            <div>
                                <h4> Applicant Details :- </h4>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="applicant_name">Name of Applicant</label>
                                    <div class="col-md-3">
                                        <input type="text" id="applicant_name" name="applicant_name" class="form-control"  value="{{ $arrData['hearing']->applicant_name }}"  />
                                        <span class="help-block">{{$errors->first('applicant_name')}}</span>
                                    </div>
                                    <label class="col-md-3  control-label" for="applicant_mobile_no">Mobile Number</label>
                                    <div class="col-md-3">
                                        <input type="text" id="applicant_mobile_no" name="applicant_mobile_no" class="form-control"  value="{{ $arrData['hearing']->applicant_mobile_no }}"  />
                                        <span class="help-block">{{$errors->first('applicant_mobile_no')}}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="applicant_address">Address</label>
                                    <div class="col-md-3">
                                        <textarea id="applicant_address" name="applicant_address" class="form-control">{{ $arrData['hearing']->applicant_address }}</textarea>
                                        <span class="help-block">{{$errors->first('applicant_address')}}</span>
                                    </div>
                                </div>
                            </div>


                            <div>
                                <hr>
                                <h4 class="">Respondent Details :-</h4>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="respondent_name">Name of Respondent</label>
                                    <div class="col-md-3">
                                        <input type="text" id="respondent_name" name="respondent_name" class="form-control"  value="{{ $arrData['hearing']->respondent_name }}"  />
                                        <span class="help-block">{{$errors->first('respondent_name')}}</span>
                                    </div>
                                    <label class="col-md-3  control-label" for="respondent_mobile_no">Mobile Number</label>
                                    <div class="col-md-3">
                                        <input type="text" id="respondent_mobile_no" name="respondent_mobile_no" class="form-control"  value="{{ $arrData['hearing']->respondent_mobile_no }}"  />
                                        <span class="help-block">{{$errors->first('respondent_mobile_no')}}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="respondent_address">Address</label>
                                    <div class="col-md-3">
                                        <textarea  id="respondent_address" name="respondent_address" class="form-control">{{ $arrData['hearing']->respondent_address }}</textarea>
                                        <span class="help-block">{{$errors->first('respondent_address')}}</span>
                                    </div>
                                </div>

                                <hr>

                                <h4 class="">Office Details</h4>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="case_type">Case Type</label>
                                    <div class="col-md-3">
                                        <input type="text" id="case_type" name="case_type" class="form-control"  value="{{ $arrData['hearing']->case_type }}"  />
                                        <span class="help-block">{{$errors->first('case_type')}}</span>
                                    </div>
                                    <label class="col-md-3  control-label" for="office_year">Year</label>
                                    <div class="col-md-3">
                                        <select class="form-control" id="office_year" name="office_year" >
                                            @php
                                                $start_year = date('Y', strtotime('-15 year'));
                                                $end_year = date('Y', strtotime('+15 year'));
                                            @endphp
                                            @for($start_year; $start_year <= $end_year; $start_year++)
                                                <option value="{{ $start_year }}" {{ ($start_year == $arrData['hearing']->office_year) ? "selected" : "" }}>{{ $start_year }}</option>
                                            @endfor
                                        </select>
                                        <span class="help-block">{{$errors->first('office_year')}}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="office_number">Number</label>
                                    <div class="col-md-3">
                                        <input type="text" id="office_number" name="office_number" class="form-control"  value="{{ $arrData['hearing']->office_number }}"  />
                                        <span class="help-block">{{$errors->first('office_number')}}</span>
                                    </div>
                                    <label class="col-md-3 control-label" for="office_date">Date</label>
                                    <div class="col-md-3">
                                        <input type="text" id="office_date" name="office_date" class="form-control"  value="{{ $arrData['hearing']->office_date }}"  />
                                        <span class="help-block">{{$errors->first('office_date')}}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="office_tehsil">Tehsil</label>
                                    <div class="col-md-3">
                                        <input type="text" id="office_tehsil" name="office_tehsil" class="form-control"  value="{{ $arrData['hearing']->office_tehsil }}"  />
                                        <span class="help-block">{{$errors->first('office_tehsil')}}</span>
                                    </div>
                                    <label class="col-md-3 control-label" for="office_village">Village</label>
                                    <div class="col-md-3">
                                        <input type="text" id="office_village" name="office_village" class="form-control"  value="{{ $arrData['hearing']->office_village }}"  />
                                        <span class="help-block">{{$errors->first('office_village')}}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="office_remark">Remarks</label>
                                    <div class="col-md-3">
                                        <textarea id="office_remark" name="office_remark" class="form-control">{{ $arrData['hearing']->office_remark }}</textarea>
                                        <span class="help-block">{{$errors->first('office_remark')}}</span>
                                    </div>
                                    <label class="col-md-3 control-label" for="department">Department</label>
                                    <div class="col-md-3">
                                        <select class="form-control" id="department" name="department">
                                            @foreach($arrData['department'] as $department_details)
                                                <option value="{{ $department_details->id  }}" {{ ($arrData['hearing']->department_id == $department_details->id) ? "selected" : "" }}>{{ $department_details->department_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">{{$errors->first('department')}}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="hearing_status_id">Status</label>
                                    <div class="col-md-3">
                                        <select class="form-control" id="hearing_status_id" name="hearing_status_id">
                                            @foreach($arrData['status'] as $hearing_status)
                                                <option value="{{ $hearing_status->id  }}" {{ ($arrData['hearing']->hearing_status_id == $hearing_status->id) ? "selected" : "" }}>{{ $hearing_status->status_title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <hr/>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-8">
                                    <a href="{{url('/resolution')}}" role="button" class="btn default">Cancel</a>
                                    <input type="submit" class="btn blue" value="Save"></input>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
