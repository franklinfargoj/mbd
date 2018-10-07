@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
  <!-- BEGIN: Subheader -->
  <div class="m-subheader px-0 m-subheader--top">
      <div class="d-flex">
          <h3 class="m-subheader__title">Applications for Redevelopment</h3>
      </div>
  </div>
  <!-- END: Subheader -->           
  <div class="m-portlet m-portlet--bordered-semi mb-0 m-portlet--shadow">
    <div class="portlet-body">
      <div class="m-portlet__body m-portlet__body--table">
        <div class="m-subheader" style="padding: 0;">
            <div class="d-flex align-items-center justify-content-center">
                <h3 class="section-title">
                  Type of Applications for Redevelopment
                </h3>
            </div>
        </div>
          <div class="container-fluid">
            <div class="row"> 
              <div class="col-md-6">
                <button type="button" class="btn btn-block btn-primary" id="selfBtn">
                  Self Redevelopment</button>
                  <div class="d-flex justify-content-center mt-4">                    
                    <button type="button" class="btn btn-metal self flex-grow-1" id="selfPremBtn">Premium</button>
                    <button type="button" class="btn btn-metal m_btn self flex-grow-1" id="selfSharingBtn">Sharing</button>
                  </div>
              </div>
              <div class="col-md-6 border-left">
                <button type="button" class="btn btn-block btn-primary" id="redvlpBtn">Redevelopment Thorugh Developer</button>
                <div class="d-flex justify-content-center mt-4">                    
                  <button type="button" class="btn btn-metal m_btn re_dev flex-grow-1" id="devPremBtn">Premium</button>
                  <button type="button" class="btn btn-metal m_btn re_dev flex-grow-1" id="devSharingBtn">Sharing</button>              
                </div>
              </div>
            </div> 
          </div>

          <div class="col-xs-12 self_premium" id="self_premium">
            <span class="App_head"> List of Applications for Redevelopment - Self Redevelopment </span>
            <div class="options">
              <p> <a href="{{ url('/offer_letter_application_form_self/'. $self_premium) }}"> New - Offer Letter </a></p>
              <p> Revalidation of offer Letter </p>
              <p> Application for NOC </p>
              <p> Consent for OC </p>
            </div>
          </div>        

          <div class="col-xs-12 self_premium" id="self_sharing">
            <span class="App_head"> List of Applications for Redevelopment - Self Redevelopment</span>
            <div class="options">
              <p> <a href="{{ url('/offer_letter_application_form_self/'. $self_sharing) }}"> New - Offer Letter </a></p>
              <p> Revalidation of offer Letter </p>
              <p> Application for NOC - IOD </p>
              <p> Tripartite Agreement </p>
              <p> Application for CC </p>
              <p> Consent for OC </p>
            </div>
          </div>

          <div class="col-xs-12 self_premium" id="dev_premium">
            <span class="App_head"> List of Applications for Redevelopment - Redevelopment Thorugh Developer</span>
            <div class="options">
              <p> <a href="{{ url('/offer_letter_application_form_dev/'. $dev_premium) }}"> New - Offer Letter </a></p>
              <p> Revalidation of offer Letter </p>
              <p> Application for NOC </p>
              <p> Consent for OC </p>
            </div>
          </div>  

          <div class="col-xs-12 self_premium" id="dev_sharing">
            <span class="App_head"> List of Applications for Redevelopment - Redevelopment Thorugh Developer</span>
            <div class="options">
              <p> <a href="{{ url('/offer_letter_application_form_dev/'. $dev_sharing) }}"> New - Offer Letter </a></p>
              <p> Revalidation of offer Letter </p>
              <p> Application for NOC - IOD </p>
              <p> Tripartite Agreement </p>
              <p> Application for CC </p>
              <p> Consent for OC </p>
            </div>
          </div>                
      </div>
    </div>
  </div>
</div>
@endsection
@section('Application_redevelopment')
<script>
$("#selfBtn").click(function(){
  $(".re_dev").css("display","none");
  $("#self_sharing,#self_premium,#dev_premium,#dev_sharing").css("display","none");
  $(".self").css("display","inline-block");
});

$("#redvlpBtn").click(function(){
  $(".self").css("display","none");
  $("#self_sharing,#self_premium,#dev_premium,#dev_sharing").css("display","none");
  $(".re_dev").css("display","inline-block");
});

$("#selfPremBtn").click(function(){
  $("#self_premium").css("display","block");
  $("#self_sharing,#dev_premium,#dev_sharing").css("display","none");
});

$("#selfSharingBtn").click(function(){
  $("#self_sharing").css("display","block");
  $("#self_premium,#dev_premium,#dev_sharing").css("display","none");
});

$("#devPremBtn").click(function(){
  $("#dev_premium").css("display","block");
  $("#self_premium,#self_sharing,#dev_sharing").css("display","none");
});

$("#devSharingBtn").click(function(){
  $("#dev_sharing").css("display","block");
  $("#self_premium,#self_sharing,#dev_premium").css("display","none");
});

</script>
@endsection


