@extends('admin.layouts.app')
@section('css')
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
            <h3 class="m-subheader__title m-subheader__title--separator">Update Status</h3>
            {{ Breadcrumbs::render('update_status',$rti_applicant->id) }}
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            Check Status:
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
                            <form id="rti_update_status" role="form" method="post" class="form-horizontal" action="{{ url('/rti_update_status/'.$rti_applicant->id) }}">
                                @csrf
                                <div class="form-group m-form__group row">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center @if($errors->has('status')) has-error @endif">
                                            <label class="col-form-label field-name">Update Status</label>
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
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                    <div class="m-form__actions px-0">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="btn-list">
                                                    <button type="submit" class="btn btn-primary">Update</button>
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
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">

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
