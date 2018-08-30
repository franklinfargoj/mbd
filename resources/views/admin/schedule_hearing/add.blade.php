@extends('admin.layouts.app')

@section('css')
    <link href="{{asset('/css/mdtimepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .disabled_input{
            border: none;
            background-color: transparent !important;
            padding: 0;
        }
    </style>
@endsection
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
                {{$header_data['hearing_menu']}}/Case Preceding Entry
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

            @if(Session::has('error'))
                <div class="note note-danger">
                    <p> {{ Session::get('error') }} </p>
                </div>
            @endif

            <div class="portlet box purple">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>{{$header_data['hearing_menu']}}</div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body form">
                    <form id="createHearingSchedule"  role="form" method="post" files="true" class="form-horizontal" action="{{route('schedule_hearing.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <input type="hidden" name="hearing_id" value="{{ $arrData['hearing']->id }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="preceding_officer_name">Name of Preceding Officer</label>
                                        <div class="col-md-3">
                                            <input type="text" id="preceding_officer_name" name="preceding_officer_name" class="form-control disabled_input"  value="{{ $arrData['hearing']->preceding_officer_name }}"  readonly/>
                                            <span class="help-block">{{$errors->first('preceding_officer_name')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Case Year</label>
                                        <div class="col-md-3">
                                            <input type="text" id="case_year" name="case_year" class="form-control disabled_input"  value="{{ $arrData['hearing']->case_year }}" readonly />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Case Number</label>
                                        <div class="col-md-3">
                                            <input type="text" id="case_number" name="case_number" class="form-control disabled_input"  value="{{ $arrData['hearing']->case_number }}" readonly  />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Preceding Number</label>
                                        <div class="col-md-3">
                                            <input type="text" id="preceding_number" name="preceding_number" class="form-control"  value=""   />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Apellent Name</label>
                                        <div class="col-md-3">
                                            <input type="text" id="applicant_name" name="applicant_name" class="form-control disabled_input"  value="{{ $arrData['hearing']->applicant_name }}" readonly  />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Respondent Name</label>
                                        <div class="col-md-3">
                                            <input type="text" id="respondent_name" name="respondent_name" class="form-control disabled_input"  value="{{ $arrData['hearing']->respondent_name }}" readonly  />
                                            <span class="help-block">{{$errors->first('respondent_name')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Preceding Date</label>
                                        <div class="col-md-3">
                                            <input type="text" id="preceding_date" name="preceding_date" class="form-control" value="{{ old('preceding_date') }}"/>
                                            <span class="help-block">{{$errors->first('preceding_date')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Preceding Time</label>
                                        <div class="col-md-3">
                                            <input type="text" id="preceding_time" name="preceding_time" class="form-control"value="{{ old('preceding_time') }}" />
                                            <span class="help-block">{{$errors->first('preceding_time')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="description">Description</label>
                                        <div class="col-md-3">
                                            <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                                            <span class="help-block">{{$errors->first('description')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="case_template">Case Template</label>
                                        <div class="col-md-3">
                                            <input type="file" id="case_template" name="file[case_template]" class="form-control file-upload">
                                            <span class="help-block">{{$errors->first('file.case_template')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="update_status">Update Status</label>
                                        <div class="col-md-3">
                                            <select class="form-control" id="update_status" name="update_status" disabled>
                                                @foreach($arrData['status'] as $hearing_status)
                                                    <option value="{{ $hearing_status->id  }}" {{ ($hearing_status->id == $arrData['hearing']->hearing_status_id) ? "selected" : "" }}>{{ $hearing_status->status_title}}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block">{{$errors->first('update_status')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="update_supporting_documents">Update Supporting Documents</label>
                                        <div class="col-md-3">
                                            <input type="file" id="update_supporting_documents" name="file[update_supporting_documents]" class="form-control file-upload">
                                            <span class="help-block">{{$errors->first('file.update_supporting_documents')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-8">
                                    <a href="{{url('/hearing')}}" role="button" class="btn default">Cancel</a>
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
@section('js')
    <script src="{{asset('/js/mdtimepicker.min.js')}}" type="text/javascript"></script>

    <script>
        $( function() {
            $( "#preceding_date" ).datepicker({
                dateFormat: "yy-mm-dd"
            });

            $('#preceding_time').mdtimepicker();
        } );

        $("#createHearingSchedule").on("submit", function(){
            $(".file-upload").each(function(){
                $(this).rules("add", {
                    required:true,
                });
            });
        })
    </script>
@endsection