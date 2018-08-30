@extends('admin.layouts.app')

@section('css')
    <style>
        .disabled_input{
            border: none;
            background-color: transparent !important;
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
                {{$header_data['upload']}}
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
                        <i class="fa fa-gift"></i>{{$header_data['upload']}} </div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body form" style="display: block;">
                    <form id="uploadCaseJudgement" role="form" method="post" class="form-horizontal" action="{{route('upload_case_judgement.store')}}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="hearing_id" value="{{ $arrData['hearing_data']->id }}">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="case_year">Case Year</label>
                                <div class="col-md-3">
                                    <input type="text" id="case_year" name="case_year" class="form-control disabled_input"  value="{{ $arrData['hearing_data']->case_year }}"  />
                                    <span class="help-block">{{$errors->first('case_year')}}</span>
                                </div>
                                <label class="col-md-3  control-label" for="case_number">Case Number</label>
                                <div class="col-md-3">
                                    <input type="text" id="case_number" name="case_number" class="form-control disabled_input validate"  value="{{ $arrData['hearing_data']->case_number }}"  />
                                    <span class="help-block">{{$errors->first('case_number')}}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="upload_judgement_case">Case Template</label>
                                        <div class="col-md-3">
                                            <input type="file" id="upload_judgement_case" name="upload_judgement_case" class="form-control file-upload">
                                            <span class="help-block">{{$errors->first('upload_judgement_case')}}</span>
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
