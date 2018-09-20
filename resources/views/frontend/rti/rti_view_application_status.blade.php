@extends('frontend.rti.login')
@section('body')
  <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login" style="position: relative;">
    <div class="m-login__logo text-center">
          <a href="{{ url('/') }}"></a>
          <img src="{{asset('assets/app/media/img/logos/mhada-logo.png')}}" width="550">
          </a>
    </div>
    <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
       <div class="m-grid__item m-grid__item--fluid">
          <div class="m-login__container">
             <div class="m-login__signin">
                <div class="m-login__head">
                   <h1 class="m-login__title mb-0 display-4">
                      RTI Application Response
                   </h1>
                   <p class="sub-title"></p>
                   <div class="col-md-12">
                     <div class="col-md-6">
                       <p>Application No {{ $user_details->unique_id }}</p>
                       <p>Date of Submission {{ $user_details->created_at }}</p>
                       <p>Update Status {{ $user_details->master_rti_status!=""?$user_details->master_rti_status->status_title->status_title:' - ' }}</p>
                       <p>RTI Subject {{ $user_details->info_subject }}</p>
                     </div>
                     <div class="col-md-6">
                       <p>Applicant Name {{ $user_details->applicant_name }}</p>
                       <p>Department {{ $user_details->department->department_name }}</p>
                       <p>Download Application Form {{ $user_details->unique_id }}</p>                       
                     </div>
                     <p>Application Response {{ $user_details->rti_send_info!=""?$user_details->rti_send_info->comment:" - " }}</p>
                     <p>Meeting Date {{ $user_details->rti_schedule_meetings!=""?$user_details->rti_schedule_meetings->meeting_scheduled_date:" - " }}</p>
                     <p>Meeting Time {{ $user_details->rti_schedule_meetings!=""?$user_details->rti_schedule_meetings->meeting_time:" - " }}</p>
                     <p>Concerned Person Name {{ $user_details->rti_schedule_meetings!=""?$user_details->rti_schedule_meetings->contact_person_name:" - " }}</p>
                     <p>Meeting Venue {{ $user_details->rti_schedule_meetings!=""?$user_details->rti_schedule_meetings->meeting_venue:" - " }}</p>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection