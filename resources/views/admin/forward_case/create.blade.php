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
                <a href="{{url('/hearing')}}">{{$header_data['menu_url']}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                {{$header_data['menu']}}
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
                        <i class="fa fa-gift"></i>{{$header_data['menu']}} </div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body form" style="display: block;">
                    <form id="forwardCase" role="form" method="post" class="form-horizontal" action="{{route('forward_case.store')}}">
                        @csrf

                        <div class="form-body">
                            <input type="hidden" name="hearing_id" value="{{ $arrData['hearing']->id }}">
                            <div>
                                <h4 class="">Forward Case</h4>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="case_year">Case Year</label>
                                    <div class="col-md-3">
                                        <input type="text" id="case_year" name="case_year" class="form-control disabled_input"  value="{{ $arrData['hearing']->case_year }}"  readonly/>
                                        <span class="help-block">{{$errors->first('case_year')}}</span>
                                    </div>
                                    <label class="col-md-3  control-label" for="case_number">Case Number</label>
                                    <div class="col-md-3">
                                        <input type="text" id="case_number" name="case_number" class="form-control validate disabled_input"  value="{{ $arrData['hearing']->case_number }}"  readonly/>
                                        <span class="help-block">{{$errors->first('case_number')}}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="appellant_name">Appellant Name</label>
                                    <div class="col-md-3">
                                        <input type="text" id="appellant_name" name="appellant_name" class="form-control disabled_input"  value="{{ $arrData['hearing']->applicant_name }}"  readonly/>
                                        <span class="help-block">{{$errors->first('appellant_name')}}</span>
                                    </div>
                                    <label class="col-md-3  control-label" for="board_id">Board</label>
                                    <div class="col-md-3">
                                        <input type="text" id="" name="" class="form-control disabled_input"  value="{{ $arrData['hearing']->hearingBoard->board_name }}" readonly />
                                        <span class="help-block">{{$errors->first('board_id')}}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="respondent_name">Respondent Name</label>
                                    <div class="col-md-3">
                                        <input type="text" id="respondent_name" name="respondent_name" class="form-control disabled_input"  value="{{ $arrData['hearing']->respondent_name }}" readonly />
                                        <span class="help-block">{{$errors->first('respondent_name')}}</span>
                                    </div>
                                    <label class="col-md-3  control-label" for="department_id">Department</label>
                                    <div class="col-md-3">
                                        <input type="text" id="" name="" class="form-control disabled_input"  value="{{ $arrData['hearing']->hearingDepartment->department_name }}" readonly />
                                        <span class="help-block">{{$errors->first('department_id')}}</span>
                                    </div>
                                </div>

                                <hr/>
                            </div>

                            <div>
                                <h4 class="">Forward To</h4>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Board</label>
                                    <div class="col-md-3 @if($errors->has('board')) has-error @endif">
                                        <select name="board" id="board_id" class="form-control">
                                            <option value="">Select Board</option>
                                            @foreach($arrData['board'] as $boardVal)
                                                <option value="{{ $boardVal->id }}" {{ count($arrData['board'])==1?'selected':'' }}>{{ $boardVal->board_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block">{{$errors->first('board')}}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Department</label>
                                    <div class="col-md-3 @if($errors->has('department')) has-error @endif">
                                        <select name="department" id="department_id" class="form-control">
                                            <option value="">Select Department</option>
                                        </select>
                                        <span class="help-block">{{$errors->first('department')}}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Department</label>
                                    <div class="col-md-3 @if($errors->has('description')) has-error @endif">
                                        <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
                                        <span class="help-block">{{$errors->first('description')}}</span>
                                    </div>
                                </div>

                                <hr/>
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

