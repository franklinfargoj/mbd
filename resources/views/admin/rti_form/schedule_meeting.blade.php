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
	<div class="row">
        <div class="col-md-12">
        		<h3>Schedule Meeting</h3>
        		<div class="col-md-9">
        			<div class="col-md-6">
        				<p>Application No:&nbsp;&nbsp;{{ $rti_applicant->unique_id }}</p>
        				<p>Date of Submission:&nbsp;&nbsp;{{ date('d-m-Y', strtotime($rti_applicant->created_at)) }}</p>
        			</div>
        			<div class="col-md-6">
        				<p>Applicant Name:&nbsp;&nbsp;{{ $rti_applicant->applicant_name }}</p>
        			</div>
        		</div>
        		<form id="rti_schedule_meeting" role="form" method="post" class="form-horizontal" action="{{ url('/rti_schedule_meeting/'.$rti_applicant->id) }}">
        			@csrf
                      <div class="form-body">
                		<div class="col-md-6">
                			<div class="form-group">
	                          <label class="col-md-4 control-label">Meeting Scheduled Date</label>
	                          <div class="col-md-8 @if($errors->has('meeting_scheduled_date')) has-error @endif">
	                              <div class="input-icon right">
                      					<input type="hidden" name="application_no" id="application_no" class="form-control" value="{{ $rti_applicant->unique_id }}">
                            			<input type="text" name="meeting_scheduled_date" id="meeting_scheduled_date" class="form-control" value="{{ (!empty($rti_meetings_scheduled->meeting_scheduled_date) ? $rti_meetings_scheduled->meeting_scheduled_date : '' ) }}">  
	                                  <span class="help-block">{{$errors->first('meeting_scheduled_date')}}</span>
	                                </div>
	                          </div>
	                  		</div>
							<div class="form-group">
	                          <label class="col-md-4 control-label">Meeting Time</label>
	                          <div class="col-md-8 @if($errors->has('meeting_time')) has-error @endif">
	                              <div class="input-icon right">
	                                  <input type="text" name="meeting_time" id="meeting_time" class="form-control" value="{{ (!empty($rti_meetings_scheduled->meeting_time) ? $rti_meetings_scheduled->meeting_time : '' ) }}">
	                                  <span class="help-block">{{$errors->first('meeting_time')}}</span>
	                                </div>
	                          </div>
	                      	</div>
                		</div>
                		<div class="col-md-6">
                			<div class="form-group">
	                          <label class="col-md-4 control-label">Meeting Venue</label>
	                          <div class="col-md-8 @if($errors->has('meeting_venue')) has-error @endif">
	                              <div class="input-icon right">
	                                  <input type="text" name="meeting_venue" id="meeting_venue" class="form-control" value="{{ (!empty($rti_meetings_scheduled->meeting_venue) ? $rti_meetings_scheduled->meeting_venue : '') }}">
	                                  <span class="help-block">{{$errors->first('meeting_venue')}}</span>
	                                </div>
	                          </div>
	                      	</div>
	                      	<div class="form-group">
	                          <label class="col-md-4 control-label">Concern Person Name</label>
	                          <div class="col-md-8 @if($errors->has('contact_person_name')) has-error @endif">
	                              <div class="input-icon right">
	                                  <input type="text" name="contact_person_name" id="contact_person_name" class="form-control" value="{{ (!empty($rti_meetings_scheduled->contact_person_name) ? $rti_meetings_scheduled->contact_person_name : '' ) }}">
	                                  <span class="help-block">{{$errors->first('contact_person_name')}}</span>
	                                </div>
	                          </div>
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