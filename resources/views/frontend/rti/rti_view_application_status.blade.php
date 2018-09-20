@extends('frontend.rti.login')
@section('body')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2"
    id="m_login" style="position: relative;">
    <!-- <div class="m-login__logo text-center">
          <a href="{{ url('/') }}"></a>
          <img src="{{asset('assets/app/media/img/logos/mhada-logo.png')}}" width="550">
          </a>
    </div> -->
    <div class="m-login m-login--2 min-height-100vh d-flex align-items-center justify-content-center light-bg">
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
            <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                <div class="m-grid__item m-grid__item--fluid">
                    <div class="m-login__container m-login__container--sign-in">
                        <div class="m-login__signin">
                            <div class="m-login__head">
                                <h3 class="section-title text-center">
                                    RTI Application Response
                                </h3>
                                <div class="col-md-12">
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
                                                    $user_details->master_rti_status!=""?$user_details->master_rti_status->status_title->status_title:'
                                                    - ' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 field-col">
                                            <div class="d-flex">
                                                <span class="field-name">Download Application Form:</span>
                                                <span class="field-value btn btn-link">Download</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 field-col">
                                            <div class="d-flex">
                                                <span class="field-name">RTI Subject:</span>
                                                <span class="field-value">{{ $user_details->info_subject }}</span>
                                            </div>
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
</div>
@endsection
