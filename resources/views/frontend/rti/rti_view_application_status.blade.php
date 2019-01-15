@extends('frontend.rti.login')
@section('body')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2 light-bg"
    id="m_login" style="position: relative;">
    <div class="m-login__logo m-login__logo--header transparent-bg no-shadow text-center">
        <a href="{{ url('/') }}"></a>
        <img src="{{asset('assets/app/media/img/logos/mhada-logo.png')}}" width="550">
        </a>
    </div>
    <div class="m-login m-login--2 d-flex justify-content-center">
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
            <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                <div class="m-grid__item m-grid__item--fluid">
                    <div class="m-login__container m-login__container--sign-in">
                        <div class="m-login__signin">
                            <div class="m-login__head mb-5">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="section-title mb-0 text-center">
                                        RTI Application Response
                                    </h3>
                                    <a href="{{route('rti_frontend.index')}}" class="btn btn-link"><i class="fa fa-long-arrow-left"
                                            style="padding-right: 8px;"></i>Back</a>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="row field-row">
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Application Number:</span>
                                            <span class="field-value">{{ $user_details->unique_id }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Applicant Name:</span>
                                            <span class="field-value">{{ $user_details->applicant_name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Date of Submission:</span>
                                            <span class="field-value">{{ $user_details->created_at }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Department:</span>
                                            <span class="field-value">{{ $user_details->department->department_name
                                                }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Update Status:</span>
                                            <span class="field-value">{{
                                                ($user_details->current_status!="") ?
                                                $user_details->current_status->status_title: '
                                                - ' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Download Application Form:</span>
                                            @if($user_details->rti_send_info!="")
                                            <a target="_blank" href="{{config('commanConfig.storage_server').'/'.$user_details->rti_send_info->filepath.$user_details->rti_send_info->filename}}"
                                                class="field-value btn btn-link px-0">Download</a>
                                            @else
                                            -
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">RTI Subject:</span>
                                            <span class="field-value">{{ $user_details->info_subject }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        @if ($user_details->appeal_by_applicant==0 && $user_details->status==config('commanConfig.rti_status.closed'))
                                        <form method="post" action="{{route('rti_frontend.appelle')}}">
                                            @csrf
                                        <input type="hidden" name="application_id" value="{{$user_details->id}}">
                                        <div class="d-flex">
                                            <span class="field-name">
                                                <select title="please select department" required class="form-control m-input" name="department_id">
                                                    <option value="">Select Department</option>
                                                    @foreach($departments as $department)
                                                    <option value="{{ $department->id }}">{{$department->department_name}}</option>
                                                    @endforeach
                                                </select>
                                            </span>
                                            <span class="field-value">
                                                <input class="btn btn-primary" type="submit" name="appelle" value="Appeal">
                                            </span>
                                        </div>
                                        </form>
                                        @else
                                            @if ($user_details->appeal_by_applicant==1)
                                            <span class="text-success">Appealed</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-sm-12 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Application Response:</span>
                                            <span class="field-value">{{
                                                $user_details->rti_send_info!=""?$user_details->rti_send_info->comment:"
                                                - " }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Meeting Date:</span>
                                            <span class="field-value">{{
                                                $user_details->rti_schedule_meetings!=""?$user_details->rti_schedule_meetings->meeting_scheduled_date:"
                                                - " }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Meeting Time:</span>
                                            <span class="field-value">{{
                                                $user_details->rti_schedule_meetings!=""?$user_details->rti_schedule_meetings->meeting_time:"
                                                - " }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Concerned Person Name:</span>
                                            <span class="field-value">{{
                                                $user_details->rti_schedule_meetings!=""?$user_details->rti_schedule_meetings->contact_person_name:"
                                                - " }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Meeting Venue:</span>
                                            <span class="field-value">{{
                                                $user_details->rti_schedule_meetings!=""?$user_details->rti_schedule_meetings->meeting_venue:"
                                                - " }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                      <p>Application No {{ $user_details->unique_id }}</p>
                                      <p>Date of Submission {{ $user_details->created_at }}</p>
                                      <p>Update Status {{
                                          $user_details->master_rti_status!=""?$user_details->master_rti_status->status_title->status_title:'
                                          - ' }}</p>
                                      <p>RTI Subject {{ $user_details->info_subject }}</p>
                                  </div>
                                  <div class="col-md-6">
                                      <p>Applicant Name {{ $user_details->applicant_name }}</p>
                                      <p>Department {{ $user_details->department->department_name }}</p>
                                      <p>Download Application Form {{ $user_details->unique_id }}</p>
                                  </div>
                                  <p>Application Response {{
                                      $user_details->rti_send_info!=""?$user_details->rti_send_info->comment:" - " }}</p>
                                  <p>Meeting Date {{
                                      $user_details->rti_schedule_meetings!=""?$user_details->rti_schedule_meetings->meeting_scheduled_date:"
                                      - " }}</p>
                                  <p>Meeting Time {{
                                      $user_details->rti_schedule_meetings!=""?$user_details->rti_schedule_meetings->meeting_time:"
                                      - " }}</p>
                                  <p>Concerned Person Name {{
                                      $user_details->rti_schedule_meetings!=""?$user_details->rti_schedule_meetings->contact_person_name:"
                                      - " }}</p>
                                  <p>Meeting Venue {{
                                      $user_details->rti_schedule_meetings!=""?$user_details->rti_schedule_meetings->meeting_venue:"
                                      - " }}</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
