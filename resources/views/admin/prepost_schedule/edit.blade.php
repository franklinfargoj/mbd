@extends('admin.layouts.app')

@section('css')
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
                {{$header_data['schedule']}}
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
                        <i class="fa fa-gift"></i>{{$header_data['schedule']}}</div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body form">
                    <form role="form" id="prePostSchedule" method="post" files="true" class="form-horizontal" action="{{route('fix_schedule.update', $arrData['schedule_prepost_data']->prePostSchedule->id)}}">
                        @csrf
                        @method("PUT")
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-2">
                                            <div class="radio-list">
                                                <label class="radio-inline">
                                                    <input type="radio" name="pre_post_status" value="1" {{ ($arrData['schedule_prepost_data']->prePostSchedule->pre_post_status == 1) ? "checked" : "" }}>Prepone</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="pre_post_status" value="0" {{ ($arrData['schedule_prepost_data']->prePostSchedule->pre_post_status == 0) ? "checked" : "" }}>Postpone</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Case Year</label>
                                        <div class="col-md-3">
                                            <input type="text" id="case_year" name="case_year" class="form-control disabled_input"  value="{{ $arrData['schedule_prepost_data']->case_year }}" readonly />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Case Number</label>
                                        <div class="col-md-3">
                                            <input type="text" id="case_number" name="case_number" class="form-control disabled_input"  value="{{ $arrData['schedule_prepost_data']->case_number }}" readonly  />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Apellent Name</label>
                                        <div class="col-md-3">
                                            <input type="text" id="appellant_name" name="appellant_name" class="form-control disabled_input"  value="{{ $arrData['schedule_prepost_data']->applicant_name }}" readonly  />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Respondent Name</label>
                                        <div class="col-md-3">
                                            <input type="text" id="respondent_name" name="respondent_name" class="form-control disabled_input"  value="{{ $arrData['schedule_prepost_data']->respondent_name }}" readonly  />
                                            <span class="help-block">{{$errors->first('respondent_name')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">First Hearing Date</label>
                                        <div class="col-md-3">
                                            <input type="text" id="first_hearing_date" name="first_hearing_date" class="form-control disabled_input" value="{{ $arrData['schedule_prepost_data']->hearingSchedule->preceding_date }}"/>
                                            <span class="help-block">{{$errors->first('first_hearing_date')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="preceding_officer_name">Preceding Officer Name</label>
                                        <div class="col-md-3">
                                            <input type="text" id="preceding_officer_name" name="preceding_officer_name" class="form-control disabled_input"  value="{{ $arrData['schedule_prepost_data']->preceding_officer_name }}"  />
                                            <span class="help-block">{{$errors->first('preceding_officer_name')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Select Date</label>
                                        <div class="col-md-3">
                                            <input type="text" id="date" name="date" class="form-control" value="{{ $arrData['schedule_prepost_data']->prePostSchedule->date }}"/>
                                            <span class="help-block">{{$errors->first('date')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="description">Description</label>
                                        <div class="col-md-3">
                                            <textarea id="description" name="description" class="form-control">{{ $arrData['schedule_prepost_data']->prePostSchedule->description }}</textarea>
                                            <span class="help-block">{{$errors->first('description')}}</span>
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
            $( "#date" ).datepicker({
                dateFormat: "yy-mm-dd"
            });
        } );
    </script>
@endsection