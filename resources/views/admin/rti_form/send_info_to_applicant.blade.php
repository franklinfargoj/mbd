@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.rti_form.actions',compact('rti_applicant'))
@endsection
@section('css')
<!-- <link href="{{asset('/css/mdtimepicker.min.css')}}" rel="stylesheet" type="text/css" /> -->
<!-- <style>
        .disabled_input{
            border: none;
            background-color: transparent !important;
            padding: 0;
        }
    </style> -->
@endsection
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Send Information to Applicant</h3>
            {{ Breadcrumbs::render('rti_send_info',$rti_applicant->id) }}
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            Information:
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
                            <form id="rti_schedule_meeting" role="form" method="post" class="form-horizontal" action="{{ url('/rti_sent_info/'.$rti_applicant->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group m-form__group row">
                                    {{-- <div class="col-sm-6">
                                        <div class="d-flex align-items-center @if($errors->has('status')) has-error @endif">
                                            <label class="col-form-label field-name">Update Status:</label>
                                            <input type="hidden" name="application_no" value="{{ $rti_applicant->unique_id }}">
                                            <select name="status" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input">
                                                @foreach($rti_statuses as $rti_status)
                                                <option value="{{ $rti_status['id'] }}"
                                                    {{ ($rti_status['id'] == ($rti_applicant->master_rti_status!=""?$rti_applicant->master_rti_status->status_id:'') ?'selected':'' )}}>{{
                                                    $rti_status['status_title'] }}</option>
                                                @endforeach
                                            </select>
                                            <span class="help-block">{{$errors->first('status')}}</span>
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center @if($errors->has('rti_info_file')) has-error @endif">
                                            <label class="col-form-label field-name">Upload Information:</label>
                                            <div class="custom-file">
                                                <input type="hidden" name="uploaded_file" value="{{$rti_applicant->rti_send_info!=""?$rti_applicant->rti_send_info->filename:''}}">
                                                <input type="hidden" name="uploaded_file_path" value="{{$rti_applicant->rti_send_info!=""?$rti_applicant->rti_send_info->filepath:''}}">
                                                <input type="file" name="rti_info_file" id="rti_info_file" class="custom-file-input"
                                                    value="{{ old('rti_info_file', $rti_applicant->rti_send_info!=""?$rti_applicant->rti_send_info->filename:'' ) }}">
                                                <label class="custom-file-label" for="rti_info_file">Choose file...</label>
                                                <span class="text-danger">{{$errors->first('rti_info_file')}}</span>
                                                <a target="_blank" class="d-block btn btn-link custom-file-download" href="{{$rti_applicant->rti_send_info!=""?$rti_applicant->rti_send_info->filepath.$rti_applicant->rti_send_info->filename:''}}">{{$rti_applicant->rti_send_info!=""?$rti_applicant->rti_send_info->filename:''}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center @if($errors->has('rti_comment')) has-error @endif">
                                            <label class="col-form-label field-name">Comment</label>
                                            <textarea name="rti_comment" id="rti_comment" class="form-control form-control--custom form-control--fixed-height m-input">{{ old('rti_comment', $rti_applicant->rti_send_info!=""?$rti_applicant->rti_send_info->comment:'' ) }}</textarea>
                                            <span class="text-danger">{{$errors->first('rti_comment')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                    <div class="m-form__actions px-0">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="btn-list">
                                                    <button type="submit" class="btn btn-primary">Send</button>
                                                    <a href="{{url('rti_applicants')}}" role="button" class="btn btn-secondary">Cancel</a>
                                                </div>
                                            </div>
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
@endsection
@section('js')
<script src="{{asset('/js/mdtimepicker.min.js')}}" type="text/javascript"></script>
<script>
    $(function () {
        $("#meeting_scheduled_date").datepicker({
            dateFormat: "yy-mm-dd"
        });
        $('#meeting_time').mdtimepicker();
    });

</script>
@endsection
