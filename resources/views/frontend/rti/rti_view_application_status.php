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
                       <p>Update Status {{ $user_details->rti_status_id }}</p>
                       <p>RTI Subject {{ $user_details->unique_id }}</p>
                     </div>
                     <div class="col-md-6">
                       <p>Applicant Name {{ $user_details->unique_id }}</p>
                       <p>Department {{ $user_details->unique_id }}</p>
                       <p>Download Application Form {{ $user_details->unique_id }}</p>                       
                     </div>
                     <p>Application Response {{ $user_details->unique_id }}</p>
                     <p>Meeting Date {{ $user_details->unique_id }}</p>
                     <p>Meeting Time {{ $user_details->unique_id }}</p>
                     <p>Concerned Person Name {{ $user_details->unique_id }}</p>
                     <p>Meeting Venue {{ $user_details->unique_id }}</p>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection