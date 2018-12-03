@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
  <!-- BEGIN: Subheader -->
  <div class="m-subheader px-0 m-subheader--top">
      <div class="d-flex align-items-center">
        <h3 class="m-subheader__title m-subheader__title--separator">Applications for Redevelopment</h3>
{{--        {{ Breadcrumbs::render('society_application') }}--}}
      </div>
  </div>
  <!-- END: Subheader -->           
  <div class="m-portlet m-portlet--bordered-semi mb-0 m-portlet--shadow">
    <div class="portlet-body">
      <div class="m-portlet__body m-portlet__body--table">
        {{--<div class="m-subheader" style="padding: 0;">--}}
            {{--<div class="d-flex align-items-center justify-content-center">--}}
                {{--<h3 class="section-title">--}}
                  {{--Type of Applications for Redevelopment--}}
                {{--</h3>--}}
            {{--</div>--}}
        {{--</div>--}}
          {{--<div class="container-fluid">--}}
            {{--<div class="row"> --}}
              {{--<div class="col-md-6">--}}
                {{--<button type="button" class="btn btn-block btn-primary" id="selfBtn">--}}
                  {{--Self Redevelopment</button>--}}
                  {{--<div class="d-flex justify-content-center mt-4">                    --}}
                    {{--<button type="button" class="btn btn-metal self flex-grow-1" id="selfPremBtn">Premium</button>--}}
                    {{--<button type="button" class="btn btn-metal m_btn self flex-grow-1" id="selfSharingBtn">Sharing</button>--}}
                  {{--</div>--}}
              {{--</div>--}}
              {{--<div class="col-md-6 border-left">--}}
                {{--<button type="button" class="btn btn-block btn-primary" id="redvlpBtn">Redevelopment Through Developer</button>--}}
                {{--<div class="d-flex justify-content-center mt-4">                    --}}
                  {{--<button type="button" class="btn btn-metal m_btn re_dev flex-grow-1" id="devPremBtn">Premium</button>--}}
                  {{--<button type="button" class="btn btn-metal m_btn re_dev flex-grow-1" id="devSharingBtn">Sharing</button>              --}}
                {{--</div>--}}
              {{--</div>--}}
            {{--</div> --}}
          {{--</div>--}}
        {{--@if($id == '2' || $id == '13')--}}
          {{--<div class="col-xs-12 self_premium" id="">--}}
            {{--<span class="App_head"> List of Applications for Redevelopment - @if($id == '2') Self Redevelopment @endif @if($id == '6') Redevelopment Through Developer @endif</span>--}}

            {{--<div class="options">--}}
              {{--<p> @if(Session::all()['ol_application_count'] == 1) New - Offer Letter @else <a href="@if($id == '2') {{  route('show_form_self', $id) }}@endif @if($id == '13') {{  route('show_form_dev', $id) }}@endif"> New - Offer Letter </a> @endif</p>--}}
              {{--<p> @if($self_reval_premium) <a href="{{  route('show_reval_self', $self_reval_premium) }}">Revalidation of offer Letter</a>  @elseif($self_reval_sharing)  <a href="{{  route('show_reval_dev', $self_reval_sharing) }}">Revalidation of offer Letter</a> @endif </p>--}}

              {{--<p> @if(Session::all()['noc_application_count'] == 1) Application for NOC @else <a href="@if($id == '2') {{  route('show_form_self_noc', $id) }}@endif @if($id == '13') {{  route('show_form_self_noc', $id) }}@endif"> Application for NOC </a> @endif</p>--}}
              {{--<p> Consent for OC </p>--}}
            {{--</div>--}}
          {{--</div>--}}
        {{--@endif--}}

        {{--@if($id == '6' || $id == '17')--}}
          {{--<div class="col-xs-12 self_premium" id="">--}}
            {{--<span class="App_head"> List of Applications for Redevelopment - @if($id == '6') Self Redevelopment @endif @if($id == '17') Redevelopment Through Developer @endif</span>--}}
            {{--<div class="options">--}}
              {{--<p> @if(Session::all()['ol_application_count'] == 1) New - Offer Letter @else <a href="@if($id == '6') {{  route('show_form_self', $id) }}@endif @if($id == '17') {{  route('show_form_dev', $id) }}@endif"> New - Offer Letter </a> @endif</p>--}}
              {{--<p> @if($dev_reval_premium) <a href="{{  route('show_reval_self', $dev_reval_premium) }}">Revalidation of offer Letter</a>  @elseif($dev_reval_sharing)  <a href="{{  route('show_reval_dev', $dev_reval_sharing) }}">Revalidation of offer Letter</a> @endif </p>--}}

              {{--<p> @if(Session::all()['noc_application_count'] == 1) Application for NOC - IOD @else <a href="@if($id == '6') {{  route('show_form_self_noc', $id) }}@endif @if($id == '17') {{  route('show_form_self_noc', $id) }}@endif"> Application for NOC - IOD </a> @endif</p>--}}
              {{--<p> Tripartite Agreement </p>--}}
              {{--<p> Application for CC </p>--}}
              {{--<p> Consent for OC </p>--}}
            {{--</div>--}}
          {{--</div>--}}
        {{--@endif--}}
        <div class="col-xs-12" id="">
            <span class="App_head"> List of Applications for Redevelopment - {{ $data[0]->ol_application_type[0]->title }}</span>
            <div class="options">
                @foreach($data as $application)
                    @if(in_array($application->id,Config('commanConfig.new_offer_letter_master_ids')))
                        <p><a @if(count($application->ol_application_id) == 0) href="{{ route($application->route_name, $application->id) }}" @endif>{{ $application->title }}</a></p>
                    @else
                        <p><a href="{{ route($application->route_name, $application->id) }}">{{ $application->title }}</a></p>
                    @endif

                @endforeach
            </div>
        </div>

        {{--<div class="col-xs-12 self_premium" id="">--}}
          {{--<span class="App_head"> List of Applications for Redevelopment - @if($id == $self_premium || $id == $self_sharing || $id == $self_reval_premium || $id == $self_reval_sharing) Self Redevelopment @endif @if($id == $dev_premium || $id == $dev_sharing || $id == $dev_reval_premium || $id == $dev_reval_sharing) Redevelopment Through Developer @endif</span>--}}
          {{--<div class="options">--}}
            {{--<p> @if(Session::all()['ol_application_count'] == 1) New - Offer Letter @else <a href="@if($id == $self_premium || $id == $self_sharing) {{  route('show_form_self', $id) }}@endif @if($id == $dev_premium || $id == $dev_sharing) {{  route('show_form_dev', $id) }}@endif"> New - Offer Letter </a> @endif</p>--}}
            {{--<p> @if($id == $self_reval_premium || $id == $self_reval_sharing) <a href="{{  route('show_reval_self', $id) }}">Revalidation of offer Letter</a>  @elseif($id == $dev_reval_premium || $id == $dev_reval_sharing)  <a href="{{  route('show_reval_dev', $id) }}">Revalidation of offer Letter</a> @endif </p>--}}
            {{--<p> @if(Session::all()['noc_application_count'] == 1) Application for NOC - IOD @else <a href="@if($id == '6') {{  route('show_form_self_noc', $id) }}@endif @if($id == '17') {{  route('show_form_self_noc', $id) }}@endif"> Application for NOC - IOD </a> @endif</p>--}}
            {{--@if($id == $dev_premium || $id == $dev_sharing)--}}
              {{--<p> Tripartite Agreement </p>--}}
              {{--<p> Application for CC </p>--}}
            {{--@endif--}}
            {{--<p> Consent for OC </p>--}}
          {{--</div>--}}
        {{--</div>--}}
      </div>
    </div>
  </div>
</div>
@endsection
@section('Application_redevelopment')
{{--<script>--}}
{{--$("#selfBtn").click(function(){--}}
  {{--$(".re_dev").css("display","none");--}}
  {{--$("#self_sharing,#self_premium,#dev_premium,#dev_sharing").css("display","none");--}}
  {{--$(".self").css("display","inline-block");--}}
{{--});--}}

{{--$("#redvlpBtn").click(function(){--}}
  {{--$(".self").css("display","none");--}}
  {{--$("#self_sharing,#self_premium,#dev_premium,#dev_sharing").css("display","none");--}}
  {{--$(".re_dev").css("display","inline-block");--}}
{{--});--}}

{{--$("#selfPremBtn").click(function(){--}}
  {{--$("#self_premium").css("display","block");--}}
  {{--$("#self_sharing,#dev_premium,#dev_sharing").css("display","none");--}}
{{--});--}}

{{--$("#selfSharingBtn").click(function(){--}}
  {{--$("#self_sharing").css("display","block");--}}
  {{--$("#self_premium,#dev_premium,#dev_sharing").css("display","none");--}}
{{--});--}}

{{--$("#devPremBtn").click(function(){--}}
  {{--$("#dev_premium").css("display","block");--}}
  {{--$("#self_premium,#self_sharing,#dev_sharing").css("display","none");--}}
{{--});--}}

{{--$("#devSharingBtn").click(function(){--}}
  {{--$("#dev_sharing").css("display","block");--}}
  {{--$("#self_premium,#self_sharing,#dev_premium").css("display","none");--}}
{{--});--}}

{{--</script>--}}
@endsection


