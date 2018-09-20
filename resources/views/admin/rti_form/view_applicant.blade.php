@extends('admin.layouts.app')
@section('content')
	<div class="row">
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
                <p>Query Status:&nbsp;&nbsp;{{ $rti_applicant->master_rti_status!=""?$rti_applicant->master_rti_status->status_title->status_title:"" }}</p>
              </div>
              <div class="col-md-6">
                <p>Email Address:&nbsp;&nbsp;{{ $rti_applicant->users->email }}</p>
              </div>
            </div>        		
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('/js/mdtimepicker.min.js')}}" type="text/javascript"></script>
  <script>
    $( function() {
        $( "#meeting_scheduled_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
        $('#meeting_time').mdtimepicker();
    });
  </script>
@endsection