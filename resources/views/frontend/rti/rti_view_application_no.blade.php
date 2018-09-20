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
                <div class="m-login__head mt-5">
                   <h3 class="section-title text-center">
                      Your RTI Application Number : 
                      <span class="d-block font-weight-normal mt-3">{{ $id }}</span>
                   </h3>
                   <p class="sub-title font-weight-normal"></p>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection