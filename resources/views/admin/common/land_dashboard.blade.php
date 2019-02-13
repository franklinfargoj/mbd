@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('/css/amcharts.css')}}">
    <!-- Fonts -->
    <!--<link rel="dns-prefetch" href="https://fonts.gstatic.com">-->
    <!-- Styles -->
    <link href="{{asset('/css/dashboard/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/css/dashboard/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    {{--    <link href="{{asset('/css/dashboard/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />--}}
    <link href="{{asset('/css/dashboard/custom.css')}}" rel="stylesheet" type="text/css"/>


@endsection
@section('content')

    <div class="container-fluid">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Dashboard</h3>
            </div>
        </div>

        <div class="d-flex flex-wrap db-wrapper">
            @php $chart = 0;@endphp
            <div class="db__card">
                <div class="db__card__img-wrap db-color-1">
                    <h3 class="db__card__count">{{$dashboardData['Total Number of Lands'][0]}}</h3>
                </div>
                <p class="db__card__title">Land Summary</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-2">
                    <h3 class="db__card__count">-</h3>
                </div>
                <p class="db__card__title">Revision in Layout</p>
            </div>
        </div>

        {{--land summary--}}
        <div>
            <div class="m-subheader px-0 m-subheader--top">
                <div class="d-flex align-items-center">
                    <h3 class="m-subheader__title">Land Summary</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="m-portlet db-table">
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                <th style="width: 10%;">Sr. No</th>
                                <th style="width: 60%;" class="text-center">Stages</th>
                                <th style="width: 15%;" class="text-left">Count</th>
                                <th style="width: 15%;">Action</th>
                                </thead>
                                <tbody>
                                @php
                                    $chart = 0;
                                    $i = 1;
                                @endphp
                                @foreach($dashboardData as $header => $value)
                                    <tr>
                                        <td class="text-center">{{$i}}.</td>
                                        <td>{{$header}}</td>
                                        <td class="text-center"><span class="count-circle">{{$value[0]}}</span></td>
                                        @php $chart += $value[0];@endphp
                                        <td>
                                            <a href="{{url($value[1])}}" class="btn btn-action">View</a>
                                        </td>
                                    </tr>
                                    @php $i++ @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if($chart)
                    <div class="col-sm-5" id="land_chart">
                    </div>
                @endif
            </div>
        </div>
    </div>


        {{--architect summary--}}
        @if((session()->get('role_name')==config('commanConfig.junior_architect'))||
        (session()->get('role_name')==config('commanConfig.senior_architect')) ||
        (session()->get('role_name')==config('commanConfig.architect')))
        @include('admin.dashboard.architect_layout.partials.architect_dashboard',compact('architect_data'))
        @endif
        @if(session()->get('role_name')==config('commanConfig.land_manager'))
        @include('admin.dashboard.architect_layout.partials.lm_dashboard',compact('architect_data'))
        @endif
        @if(session()->get('role_name')==config('commanConfig.estate_manager'))
        @include('admin.dashboard.architect_layout.partials.em_dashboard',compact('architect_data'))
        @endif
        @if (in_array(session()->get('role_name'),array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head'))))
        @include('admin.dashboard.architect_layout.partials.ee_dashboard',compact('architect_data'))
        @endif
        @if (in_array(session()->get('role_name'),array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head'))))
        @include('admin.dashboard.architect_layout.partials.ree_dashboard',compact('architect_data'))
        @endif
        @if(in_array(session()->get('role_name'),array(config('commanConfig.co_engineer'))))
        @include('admin.dashboard.architect_layout.partials.co_dashboard',compact('architect_data'))
        @endif
        @if(in_array(session()->get('role_name'),array(config('commanConfig.senior_architect_planner'))))
        @include('admin.dashboard.architect_layout.partials.sap_dashboard',compact('architect_data'))
        @endif
        @if(in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'))))
        @include('admin.dashboard.architect_layout.partials.cap_dashboard',compact('architect_data'))
        @endif
        @if(in_array(session()->get('role_name'),array(config('commanConfig.vp_engineer'))))
        @include('admin.dashboard.architect_layout.partials.vp_dashboard',compact('architect_data'))
        @endif

@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>

    <script>
        var chart;
        var legend;
        var chartData = [
                @foreach($dashboardData as $header => $value){
                "status": '{{$header}}',
                "value": '{{$value[0]}}',
            },
            @endforeach
        ];

        AmCharts.ready(function () {
            // PIE CHART
            chart = new AmCharts.AmPieChart();
            chart.dataProvider = chartData;
            chart.theme = "light";
            chart.labelRadius = -35;
            chart.titleField = "status";
            chart.labelText = "[[percents]]%";
            chart.valueField = "value";
            chart.outlineColor = "#FFFFFF";
            chart.outlineAlpha = 0.8;
            chart.outlineThickness = 2;
            chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            // this makes the chart 3D
            chart.depth3D = 15;
            chart.angle = 30;
            chart.fontSize = 15;
//                chart.legend.useGraphSettings = true;

            // WRITE
            chart.write("land_chart");
        });


        //code with legend
        //            var chart = AmCharts.makeChart("land_chart", {
        //                "type": "pie",
        //                "theme": "light",
        //                "dataProvider": chartData,
        //                "legend": {
        //                    "position": "right"
        //                },
        //                "labelRadius" : -25,
        //                "valueField": "value",
        //                "titleField": "status",
        //                "exportConfig":{
        //                    menuItems: [{
        //                        icon: '/lib/3/images/export.png',
        //                        format: 'png'
        //                    }]
        //                },
        //                "legend": {
        //                    "useGraphSettings": true,
        //                },
        //                "labelText" : "[[percents]]%",
        //
        //            });


        //            console.log(chartData);

    </script>
@endsection




{{--<div class="container-fluid">--}}
{{--<div class="m-subheader px-0 m-subheader--top">--}}
{{--<div class="d-flex align-items-center">--}}
{{--<h3 class="m-subheader__title">Dashboard</h3>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="hearing-accordion-wrapper">--}}
{{--<div class="m-portlet m-portlet--compact hearing-accordion mb-0">--}}
{{--<div class="d-flex justify-content-between align-items-center">--}}
{{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
{{--data-toggle="collapse" href="#land-summary">--}}
{{--<span class="form-accordion-title">Land Summary</span>--}}
{{--<span class="accordion-icon hearing-accordion"></span>--}}
{{--</a>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="land-summary"--}}
{{--data-parent="#accordion">--}}
{{--<div class="row no-gutters hearing-row">--}}
{{--<div class="col-12 no-shadow">--}}
{{--<div class="app-card-section-title">Land Details</div>--}}
{{--</div>--}}
{{--<div class="col-3 no-shadow"></div>--}}
{{--@php $chart = 0;@endphp--}}
{{--@foreach($dashboardData as $header => $value)--}}
{{--<div class="col-lg-3">--}}
{{--<div class="m-portlet app-card text-center">--}}
{{--<h2 class="app-heading">{{$header}}</h2>--}}
{{--<h2 class="app-no mb-0">{{$value[0]}}</h2>--}}
{{--@php $chart += $value[0];@endphp--}}
{{--<a href="{{$value[1]}}" class="app-card__details mb-0">View Details</a>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endforeach--}}
{{--</div>--}}
{{--@if($chart)--}}
{{--<div id="land_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}
{{--@if((session()->get('role_name')==config('commanConfig.junior_architect'))||--}}
{{--(session()->get('role_name')==config('commanConfig.senior_architect')) ||--}}
{{--(session()->get('role_name')==config('commanConfig.architect')))--}}
{{--@include('admin.dashboard.architect_layout.partials.architect_dashboard',compact('architect_data'))--}}
{{--@endif--}}
{{--@if(session()->get('role_name')==config('commanConfig.land_manager'))--}}
{{--@include('admin.dashboard.architect_layout.partials.lm_dashboard',compact('architect_data'))--}}
{{--@endif--}}
{{--@if(session()->get('role_name')==config('commanConfig.estate_manager'))--}}
{{--@include('admin.dashboard.architect_layout.partials.em_dashboard',compact('architect_data'))--}}
{{--@endif--}}
{{--@if (in_array(session()->get('role_name'),array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head'))))--}}
{{--@include('admin.dashboard.architect_layout.partials.ee_dashboard',compact('architect_data'))--}}
{{--@endif--}}
{{--@if (in_array(session()->get('role_name'),array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head'))))--}}
{{--@include('admin.dashboard.architect_layout.partials.ree_dashboard',compact('architect_data'))--}}
{{--@endif--}}
{{--@if(in_array(session()->get('role_name'),array(config('commanConfig.co_engineer'))))--}}
{{--@include('admin.dashboard.architect_layout.partials.co_dashboard',compact('architect_data'))--}}
{{--@endif--}}
{{--@if(in_array(session()->get('role_name'),array(config('commanConfig.senior_architect_planner'))))--}}
{{--@include('admin.dashboard.architect_layout.partials.sap_dashboard',compact('architect_data'))--}}
{{--@endif--}}
{{--@if(in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'))))--}}
{{--@include('admin.dashboard.architect_layout.partials.cap_dashboard',compact('architect_data'))--}}
{{--@endif--}}
{{--@if(in_array(session()->get('role_name'),array(config('commanConfig.vp_engineer'))))--}}
{{--@include('admin.dashboard.architect_layout.partials.vp_dashboard',compact('architect_data'))--}}
{{--@endif--}}
{{--</div>--}}

{{--@endsection--}}
{{--@section('js')--}}
{{--<script>--}}
{{--$(".hearing-accordion").on("click", function () {--}}
{{--var data = $('.hearing-accordion').children().children().attr('aria-expanded');--}}
{{--if (!(data)) {--}}
{{--$('.accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
{{--}--}}
{{--else {--}}
{{--if (data == 'undefine' || data == 'false') {--}}
{{--$('.accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
{{--} else {--}}
{{--$('.accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");--}}
{{--}--}}
{{--}--}}
{{--});--}}
{{--</script>--}}

{{--<script>--}}
{{--$(".architect-accordion").on("click", function () {--}}
{{--var data = $('.architect-accordion').children().children().attr('aria-expanded');--}}

{{--if (!(data)) {--}}
{{--$('.architect-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
{{--}--}}
{{--else {--}}
{{--if (data == 'undefine' || data == 'false') {--}}
{{--$('.architect-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
{{--} else {--}}
{{--$('.architect-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");--}}
{{--}--}}
{{--}--}}
{{--});--}}

{{--$(".architect-land-accordion").on("click", function () {--}}
{{--var data = $('.architect-land-accordion').children().children().attr('aria-expanded');--}}
{{--if (!(data)) {--}}
{{--$('.architect-land-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
{{--}--}}
{{--else {--}}
{{--if (data == 'undefine' || data == 'false') {--}}
{{--$('.architect-land-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
{{--} else {--}}
{{--$('.architect-land-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");--}}
{{--}--}}
{{--}--}}
{{--});--}}
{{--</script>--}}

{{--<script>--}}
{{--$(".hearing-accordion").on("click", function () {--}}
{{--var data = $('.hearing-accordion').children().children().attr('aria-expanded');--}}
{{--if(data == 'undefine' || data == 'false'){--}}
{{--$('.accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
{{--}else{--}}
{{--$('.accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");--}}
{{--}--}}
{{--});--}}
{{--</script>--}}
{{--<script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>--}}

{{--Dashboard--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>--}}
{{--<script>--}}
{{--WebFont.load({--}}
{{--google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},--}}
{{--active: function() {--}}
{{--sessionStorage.fonts = true;--}}
{{--}--}}
{{--});--}}
{{--</script>--}}

{{--<script>--}}
{{--var chart;--}}
{{--var legend;--}}
{{--var chartData = [--}}
{{--@foreach($dashboardData as $header => $value){--}}
{{--"status": '{{$header}}',--}}
{{--"value": '{{$value[0]}}',--}}
{{--},--}}
{{--@endforeach--}}
{{--];--}}

{{--console.log(chartData);--}}
{{--AmCharts.ready(function () {--}}
{{--// PIE CHART--}}
{{--chart = new AmCharts.AmPieChart();--}}
{{--chart.dataProvider = chartData;--}}
{{--chart.titleField = "status";--}}
{{--chart.valueField = "value";--}}
{{--chart.outlineColor = "#FFFFFF";--}}
{{--chart.outlineAlpha = 0.8;--}}
{{--chart.outlineThickness = 2;--}}
{{--chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";--}}
{{--// this makes the chart 3D--}}
{{--chart.depth3D = 15;--}}
{{--chart.angle = 30;--}}
{{--chart.colors = [ "#f0791b", "#ffc063", "#8bc34a", "#754DEB", "#DDDDDD", "#999999", "#333333", "#179252", "#57032A", "#CA9726", "#990000", "#4B0C25"]--}}
{{--chart.fontSize = 15;--}}
{{--// WRITE--}}
{{--chart.write("land_chart");--}}
{{--});--}}
{{--</script>--}}
{{--@endsection--}}


{{--@section('js')--}}
{{--<script>--}}
{{--$(".accordion-icon").on("click", function () {--}}
{{--var data = $('.hearing-accordion').children().children().attr('aria-expanded');--}}
{{--if(data == 'undefine' || data == 'false'){--}}
{{--alert('open');--}}
{{--}else{--}}
{{--alert('closed');--}}
{{--}--}}
{{--});--}}
{{--</script>--}}

{{--@endsection--}}
