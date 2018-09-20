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
        		<h3>Update Status</h3>
        		<div class="col-md-9">
        			<div class="col-md-6">
        				<p>Application No:&nbsp;&nbsp;{{ $rti_applicant->unique_id }}</p>
        				<p>Date of Submission:&nbsp;&nbsp;{{ date('d-m-Y', strtotime($rti_applicant->created_at)) }}</p>
        			</div>
        			<div class="col-md-6">
        				<p>Applicant Name:&nbsp;&nbsp;{{ $rti_applicant->applicant_name }}</p>
        			</div>
        		</div>
            <div class="col-md-6">
          		<form id="rti_update_status" role="form" method="post" class="form-horizontal" action="{{ url('/rti_update_status/'.$rti_applicant->id) }}">
          			@csrf
                    <div class="form-body">
                  		<div class="col-md-9">
                  			<div class="form-group">
  	                          <label class="col-md-4 control-label">Update Status</label>
  	                          <div class="col-md-8 @if($errors->has('status')) has-error @endif">
  	                              <div class="input-icon right">
                                    <input type="hidden" name="application_no" value="{{ $rti_applicant->unique_id }}">
                                    <select name="status" class="form-control">
                                      @foreach($rti_statuses as $rti_status)
                                        <option value="{{ $rti_status['id'] }}" {{ ($rti_status['id'] == ($rti_applicant->master_rti_status!=""?$rti_applicant->master_rti_status->status_id:'') ?'selected':'' )}}>{{ $rti_status['status_title'] }}</option>
                                      @endforeach
                                    </select>
                                    <span class="help-block">{{$errors->first('status')}}</span>
                                  </div>
  	                          </div>
  	                  		</div>
                  		</div>
                    </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-8">
                                    <button type="submit" class="btn blue">Update</button>
                                    <a href="{{url('rti_applicants')}}" role="button" class="btn default">Cancel</a>
                                </div>
                            </div>
                        </div>
          		</form>
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