@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
          <h3 class="m-subheader__title m-subheader__title--separator">View Applications</h3>
          {{ Breadcrumbs::render('view_applicant',$rti_applicant->id) }}
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            Applicant Details:
                        </h3>
                    </div>
                    <div class="row field-row">
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Username:</span>
                                <span class="field-value">{{ $rti_applicant->users->name }}</span>
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
                                <span class="field-name">Download Application Form:</span>
                                <span class="field-value"><a target="_blank" href="{{route('download_applicant_form',['id'=>$rti_applicant->id])}}" class="btn btn-primary">Download</a></span>
                            </div>
                        </div> 
                        @if($rti_applicant->poverty_line_proof!="")
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">applicant is below poverty line:</span>
                                <span class="field-value"><a target="_blank" href="{{asset('uploads/poverty_files/'.$rti_applicant->poverty_line_proof)}}">{{$rti_applicant->poverty_line_proof}}</a></span>
                            </div>
                        </div>    
                        @endif                   
                    </div>
                </div>
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            Contact Details:
                        </h3>
                    </div>
                    <div class="row field-row">
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Mobile Number:</span>
                                <span class="field-value">{{ $rti_applicant->users->mobile_no }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Query Status:</span>
                                <span class="field-value">{{$rti_applicant->master_rti_status!=""?$rti_applicant->master_rti_status->status_title->status_title:""}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Email Address:</span>
                                <span class="field-value">{{ $rti_applicant->users->email }}</span>
                            </div>
                        </div>                  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        {{ Breadcrumbs::render('view_applicant',$rti_applicant->id) }}
        <div class="col-md-12">
            <h3>View Applications</h3>
            <div class="col-md-9">
                <div class="col-md-6">
                    <p>User Name:&nbsp;&nbsp;{{ $rti_applicant->users->name }}</p>
                    <p>Date of Submission:&nbsp;&nbsp;{{ date('d-m-Y', strtotime($rti_applicant->created_at)) }}</p>
                </div>
                <div class="col-md-6">
                    <p>Download Application Form:&nbsp;&nbsp;{{ $rti_applicant->applicant_name }}</p>
                </div>
            </div>
            <div class="col-md-9">
                <h4>Contact Details: -</h4>
                <div class="col-md-6">
                    <p>Mobile Number:&nbsp;&nbsp;{{ $rti_applicant->users->name }}</p>
                    <p>Query Status:&nbsp;&nbsp;{{
                        $rti_applicant->master_rti_status!=""?$rti_applicant->master_rti_status->status_title->status_title:""
                        }}</p>
                </div>
                <div class="col-md-6">
                    <p>Email Address:&nbsp;&nbsp;{{ $rti_applicant->users->email }}</p>
                </div>
            </div>
        </div>
    </div> -->
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
