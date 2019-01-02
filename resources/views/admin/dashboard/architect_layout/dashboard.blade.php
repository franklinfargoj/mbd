@extends('admin.layouts.app')
@section('css')
<link rel="stylesheet" href="../../../../public/css/amcharts.css">
@endsection
@section('content')
<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Dashboard</h3>
        </div>
    </div>
@if((session()->get('role_name')==config('commanConfig.junior_architect'))||
    (session()->get('role_name')==config('commanConfig.senior_architect')) ||
    (session()->get('role_name')==config('commanConfig.architect')))
    @include('admin.dashboard.architect_layout.partials.architect_dashboard',compact('data'))
    @endif
@if(session()->get('role_name')==config('commanConfig.land_manager'))
    @include('admin.dashboard.architect_layout.partials.lm_dashboard',compact('data'))
    @endif
@if(session()->get('role_name')==config('commanConfig.estate_manager'))
    @include('admin.dashboard.architect_layout.partials.em_dashboard',compact('data'))
    @endif
@if (in_array(session()->get('role_name'),array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head'))))
    @include('admin.dashboard.architect_layout.partials.ee_dashboard',compact('data'))
    @endif
@if (in_array(session()->get('role_name'),array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head'))))
    @include('admin.dashboard.architect_layout.partials.ree_dashboard',compact('data'))
    @endif
@if(in_array(session()->get('role_name'),array(config('commanConfig.co_engineer'))))
    @include('admin.dashboard.architect_layout.partials.co_dashboard',compact('data'))
    @endif
@if(in_array(session()->get('role_name'),array(config('commanConfig.senior_architect_planner'))))
    @include('admin.dashboard.architect_layout.partials.sap_dashboard',compact('data'))
    @endif
@if(in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'))))
    @include('admin.dashboard.architect_layout.partials.cap_dashboard',compact('data'))
    @endif
@if(in_array(session()->get('role_name'),array(config('commanConfig.vp_engineer'))))
    @include('admin.dashboard.architect_layout.partials.vp_dashboard',compact('data'))
    @endif
    {{--@if($dashboardData1)--}}
    {{--<div class="hearing-accordion-wrapper">--}}
    {{--<div class="m-portlet m-portlet--compact hearing-accordion mb-0">--}}
    {{--<div class="d-flex justify-content-between align-items-center">--}}
    {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
        --}} {{--data-toggle="collapse" href="#ree-ol-pending-summary">--}}
    {{--<span class="form-accordion-title">REE Offer Letter Pending Applications Summary</span>--}}
    {{--<span class="accordion-icon"></span>--}} {{--</a>--}} {{--</div>--}} {{--</div>--}}
    {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="ree-ol-pending-summary"--}}
    {{--data-parent="#accordion">--}} {{--<div class="row hearing-row">--}}
    {{--@foreach($dashboardData1 as $header => $value)--}} {{--<div class="col">--}}
    {{--<div class="m-portlet app-card text-center">--}} {{--<h2 class="app-heading">{{$header}} </h2>--}}
    {{--<h2 class="app-no mb-0">{{$value}} </h2>--}}
    {{--<a href="" class="app-card__details mb-0">View Details</a>--}} {{--</div>--}} {{--</div>--}}
    {{--@endforeach--}} {{--</div>--}} {{--</div>--}} {{--</div>--}} {{--@endif--}} </div> @endsection
{{--@section('js')--}} {{--<script>--}} {{--$(".accordion-icon").on("click", function () {--}}
{{--var data = $('.hearing-accordion').children().children().attr('aria-expanded');--}}
{{--if(data == 'undefine' || data == 'false'){--}} {{--alert('open');--}} {{--}else{--}}
{{--alert('closed');--}} {{--}--}} {{--});--}} {{--</script>--}} {{--@endsection--}}
@section('js')
    <script>
        $(".architect-accordion").on("click", function () {
            var data = $('.architect-accordion').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.architect-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.architect-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.architect-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });
    </script>
@endsection