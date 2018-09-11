@extends('admin.layouts.app')
@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
  <div class="d-flex align-items-center">
     <div class="mr-auto">
        <h3 class="m-subheader__title m-subheader__title--separator title">
        Applications for Redevelopment </h3>
     </div>
  </div>
</div>
 <!-- END: Subheader -->           
<div class="m-content"></div>
 <div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__body">
        <div class="col-xs-12 div_panel">
          <div class="col-xs-12 t_main">
            <span class="t_head">Type of Applications for Redevelopment</span>
          </div>
          <div class="col-md-12 row"> 
            <div class="col-md-6 d_left" style="">
              <button type="button" class="btn border5 border555" id="selfBtn">
                Self Redevelopment</button>
                <button type="button" class="btn premium_btn self" id="selfPremBtn">
                Premium </button>
                <button type="button" class="btn premium_btn m_btn self" id="selfSharingBtn">Sharing </button>
            </div>

            <div class="col-md-6 d_right">
              <button type="button" class="btn border5 border555 btn2" id="redvlpBtn">Redevelopment Thorugh Developer</button>
                <button type="button" class="btn premium_btn m_btn re_dev" id="devPremBtn">
                Premium </button>
                <button type="button" class="btn premium_btn m_btn re_dev" id="devSharingBtn">Sharing </button>              
            </div>
          </div> 
        </div>  

        <div class="col-xs-12 self_premium" id="self_premium">
          <span class="App_head"> List of Applications for Redevelopment - Self Redevelopment </span>
          <div class="options">
            <p> <a href=""> New - Offer Letter </a></p>
            <p> Revalidation of offer Letter </p>
            <p> Application for NOC </p>
            <p> Consent for OC </p>
          </div>
        </div>        

        <div class="col-xs-12 self_premium" id="self_sharing">
          <span class="App_head"> List of Applications for Redevelopment - Self Redevelopment</span>
          <div class="options">
            <p> <a href=""> New - Offer Letter </a></p>
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
            <p> <a href=""> New - Offer Letter </a></p>
            <p> Revalidation of offer Letter </p>
            <p> Application for NOC </p>
            <p> Consent for OC </p>
          </div>
        </div>  

        <div class="col-xs-12 self_premium" id="dev_sharing">
          <span class="App_head"> List of Applications for Redevelopment - Redevelopment Thorugh Developer</span>
          <div class="options">
            <p> <a href=""> New - Offer Letter </a></p>
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
@endsection
@section('Application_redevelopment')
<script>
$("#selfBtn").click(function(){
  $(".re_dev").css("display","none");
  $(".self").css("display","inline-block");
});

$("#redvlpBtn").click(function(){
  $(".self").css("display","none");
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


