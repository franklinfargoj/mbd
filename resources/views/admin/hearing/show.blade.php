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
                View {{$header_data['menu']}} Details
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
                        <i class="fa fa-gift"></i> View {{$header_data['menu']}} Details</div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Name of Preceding Officer</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['preceding_officer_name'] }} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Case Year</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['case_year'] }} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Case Number</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['id'] }} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Application Type</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['hearing_application_type']['application_type'] }} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Name of Applicant</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['case_year'] }} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Mobile Number</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['applicant_mobile_no'] }} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Address</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['applicant_address'] }} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Respondent Details</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['respondent_name'] }} </p>
                                    </div>
                                </div>
                            </div>

                            {{--<div class="col-md-12">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="control-label col-md-3">Office Details</label>--}}
                                    {{--<div class="col-md-9">--}}
                                        {{--<p> {{ $arrData['hearing']['case_year'] }} </p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Case Type</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['case_type'] }} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Year</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['office_year'] }} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Number</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['office_number'] }} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Date</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['office_date'] }} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Tehsil</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['office_tehsil'] }} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Village</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['office_village'] }} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Remarks</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['office_remark'] }} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Status</label>
                                    <div class="col-md-9">
                                        <p> {{ $arrData['hearing']['hearing_status']['status_title'] }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
