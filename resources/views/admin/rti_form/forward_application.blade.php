@extends('admin.layouts.app')
@section('content')
	<div class="row">
        <div class="col-md-12">
        		<h3>Forward Application</h3>
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
              <h4>Forward To</h4>
          		<form id="rti_forward_application" role="form" method="post" class="form-horizontal" action="{{ url('/rti_forwarded_application/'.$rti_applicant->id) }}" enctype="multipart/form-data">
          			@csrf
                    <div class="form-body">
                  		<div class="col-md-12">
                  			<div class="form-group">
  	                          <label class="col-md-4 control-label">Board</label>
  	                          <div class="col-md-8 @if($errors->has('board')) has-error @endif">
  	                              <div class="input-icon right">
                                    <input type="hidden" name="application_no" value="{{ $rti_applicant->unique_id }}">
                                    <select name="board" class="form-control">
                                      @foreach($boards as $board)
                                        <option value="{{ $board['id'] }}" {{ ($board['id'] == $rti_applicant->rti_forward_application->board_id ?'selected':'' )}}>{{ $board['board_name'] }}</option>
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
                                        <option value="{{ $department['id'] }}" {{ ($department['id'] == $rti_applicant->rti_forward_application->department_id ?'selected':'' )}}>{{ $department['department_name'] }}</option>
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
                                <textarea name="rti_remarks" id="rti_remarks" class="form-control">{{ old('rti_remarks', $rti_applicant->rti_forward_application->remarks ) }}</textarea>
                                <span class="help-block">{{$errors->first('rti_remarks')}}</span>
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
    </div>
@endsection
@section('js')
  <script>
    $( function() {
        $( "#meeting_scheduled_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
  </script>
@endsection