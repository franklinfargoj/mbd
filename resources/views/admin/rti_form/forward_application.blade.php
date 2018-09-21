@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Forward Application</h3>
            {{ Breadcrumbs::render('rti_forwarded_application',$rti_applicant->id) }}
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            Application Details:
                        </h3>
                    </div>
                    <div class="row field-row">
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Application Number:</span>
                                <span class="field-value">{{ $rti_applicant->unique_id }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Date of Submission:</span>
                                <span class="field-value">{{ date('d-m-Y', strtotime($rti_applicant->created_at)) }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Applicant Name:</span>
                                <span class="field-value">{{ $rti_applicant->applicant_name }}</span>
                            </div>
                        </div>
                        <div class="col-sm-12 field-col">
                            <form id="rti_forward_application" role="form" method="post" class="form-horizontal" action="{{ url('/rti_forwarded_application/'.$rti_applicant->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Board</label>
                                    <div class="col-md-8 @if($errors->has('board')) has-error @endif">
                                        <div class="input-icon right">
                                            <input type="hidden" name="application_no" value="{{ $rti_applicant->unique_id }}">
                                            <select name="board" class="form-control">
                                                @foreach($boards as $board)
                                                <option value="{{ $board['id'] }}"
                                                    {{ ($board['id'] == ($rti_applicant->rti_forward_application!=""?$rti_applicant->rti_forward_application->board_id:'') ?'selected':'' )}}>{{
                                                    $board['board_name'] }}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block">{{$errors->first('board')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Department</label>
                                    <div class="col-md-8 @if($errors->has('department')) has-error @endif">
                                        <div class="input-icon right">
                                            <select name="department" class="form-control">
                                                @foreach($departments as $department)
                                                <option value="{{ $department['id'] }}"
                                                    {{ ($department['id'] == ($rti_applicant->rti_forward_application!=""?$rti_applicant->rti_forward_application->department_id:"") ?'selected':'' )}}>{{
                                                    $department['department_name'] }}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block">{{$errors->first('department')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Remarks</label>
                                    <div class="col-md-8 @if($errors->has('rti_remarks')) has-error @endif">
                                        <div class="input-icon right">
                                            <textarea name="rti_remarks" id="rti_remarks" class="form-control">{{ old('rti_remarks', ($rti_applicant->rti_forward_application!=""?$rti_applicant->rti_forward_application->remarks:"") ) }}</textarea>
                                            <span class="help-block">{{$errors->first('rti_remarks')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-4 col-md-8">
                                            <button type="submit" class="btn blue">Submit</button>
                                            <a href="{{url('rti_applicants')}}" role="button" class="btn default">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-6">
        <h4>Forward To</h4>

    </div>
</div>
@endsection
@section('js')
<script>
    $(function () {
        $("#meeting_scheduled_date").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });

</script>
@endsection
