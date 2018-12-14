@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="../../../../public/css/amcharts.css">
@endsection
@section('content')
    @php
        $chart = 0;
        $chart1 = 0;
    @endphp
    <div class="container-fluid">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Dashboard</h3>
            </div>
        </div>

        <div class="hearing-accordion-wrapper">
            <div class="m-portlet m-portlet--compact ol-accordion mb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                       data-toggle="collapse" href="#ree-ol-summary">
                        <span class="form-accordion-title">REE Offer Letter Summary</span>
                        <span class="accordion-icon ol-accordion-icon"></span>
                    </a>
                </div>
            </div>
            <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="ree-ol-summary"
                 data-parent="#accordion">
                <div class="row hearing-row">
                    @foreach($dashboardData[0] as $header => $value)
                        <div class="col">
                            <div class="m-portlet app-card text-center">
                                <h2 class="app-heading">{{$header}}</h2>
                                <div class="app-card-footer">
                                    <h2 class="app-no mb-0">{{$value[0]}}</h2>
                                    @php $chart += $value[0];@endphp
                                    @if( $value[1] == 'pending')
                                        <a href="{{url(session()->get('redirect_to').$value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#reePendingModal">View Details</a>
                                    @else
                                        <a href="{{url(session()->get('redirect_to').$value[1])}}" class="app-card__details mb-0">View Details</a>
                                    @endif
                                    {{--<a href="{{url(session()->get('redirect_to').$value[1])}}" class="app-card__details mb-0">View Details</a>--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($chart)
                    <div id="chartdiv" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                @endif

                @if($dashboardData1)
                    <div class="row hearing-row">
                        @foreach($dashboardData1 as $header => $value)
                            <div class="col">
                                <div class="m-portlet app-card text-center">
                                    <h2 class="app-heading">{{$header}}</h2>
                                    <div class="app-card-footer">
                                        <h2 class="app-no mb-0">{{$value}}</h2>
                                        @php $chart1 += $value;@endphp
                                    </div>
                                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($chart1)
                        <div id="chartdiv1" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                    @endif
                @endif
            </div>
        </div>

        {{--@if($dashboardData1)--}}
        {{--<div class="hearing-accordion-wrapper">--}}
            {{--<div class="m-portlet m-portlet--compact hearing-accordion mb-0">--}}
                {{--<div class="d-flex justify-content-between align-items-center">--}}
                    {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
                       {{--data-toggle="collapse" href="#ree-ol-pending-summary">--}}
                        {{--<span class="form-accordion-title">REE Offer Letter Pending Applications Summary</span>--}}
                        {{--<span class="accordion-icon"></span>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="ree-ol-pending-summary"--}}
                 {{--data-parent="#accordion">--}}
                {{--<div class="row hearing-row">--}}
                    {{--@foreach($dashboardData1 as $header => $value)--}}
                        {{--<div class="col">--}}
                            {{--<div class="m-portlet app-card text-center">--}}
                                {{--<h2 class="app-heading">{{$header}}</h2>--}}
                                {{--<h2 class="app-no mb-0">{{$value}}</h2>--}}
                                {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--@endif--}}

        @if($nocApplication)
        <div class="hearing-accordion-wrapper">
            <div class="m-portlet m-portlet--compact noc_accordian mb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                       data-toggle="collapse" href="#co-noc-summary">
                        <span class="form-accordion-title">Application for NOC</span>
                        <span class="accordion-icon noc-accordion-icon"></span>
                    </a>
                </div>
            </div>
                <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="co-noc-summary"
                     data-parent="#accordion">
                    <div class="row hearing-row">
                        @php $noc_chart = 0;@endphp
                        @foreach($nocApplication['app_data'] as $header => $value)
                            <div class="col">
                                <div class="m-portlet app-card text-center">
                                    <h2 class="app-heading">{{$header}}</h2>
                                    <div class="app-card-footer">
                                        <h2 class="app-no mb-0">{{$value[0]}}</h2>
                                        @php $noc_chart += $value[0];@endphp
                                        <a target="_blank" href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($noc_chart)
                        <div id="noc_chart_div" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                    @endif
                    @if($nocApplication['pending_data'])
                    <div class="row hearing-row">
                        @foreach($nocApplication['pending_data'] as $pending_label => $pending_count)
                            <div class="col">
                                <div class="m-portlet app-card text-center">
                                    <h2 class="app-heading">{{$pending_label}}</h2>
                                    <div class="app-card-footer">
                                        <h2 class="app-no mb-0">{{$pending_count}}</h2>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
        </div>
        @endif
        @if($nocforCCApplication)
        <div class="hearing-accordion-wrapper">
            <div class="m-portlet m-portlet--compact noc_cc_accordian mb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                       data-toggle="collapse" href="#co-noc_cc-summary">
                        <span class="form-accordion-title">Application for NOC (CC)</span>
                        <span class="accordion-icon noc_cc-accordion-icon"></span>
                    </a>
                </div>
            </div>
                <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="co-noc_cc-summary"
                     data-parent="#accordion">
                    <div class="row hearing-row">
                        @php $noc_cc_chart = 0;@endphp
                        @foreach($nocforCCApplication['app_data'] as $header => $value)
                            <div class="col">
                                <div class="m-portlet app-card text-center">
                                    <h2 class="app-heading">{{$header}}</h2>
                                    <div class="app-card-footer">
                                        <h2 class="app-no mb-0">{{$value[0]}}</h2>
                                        @php $noc_cc_chart += $value[0];@endphp
                                        <a target="_blank" href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($noc_cc_chart)
                        <div id="noc_cc_chart_div" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                    @endif
                    @if($nocforCCApplication['pending_data'])
                    <div class="row hearing-row">
                        @foreach($nocforCCApplication['pending_data'] as $pending_label => $pending_count)
                            <div class="col">
                                <div class="m-portlet app-card text-center">
                                    <h2 class="app-heading">{{$pending_label}}</h2>
                                    <div class="app-card-footer">
                                        <h2 class="app-no mb-0">{{$pending_count}}</h2>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
        </div>
        @endif

    </div>
    <!-- Model for send to society bifergation-->
    <div class="modal fade" id="reePendingModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Applications Pending</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="thead-default">
                            <tr>
                                <th>Header</th>
                                <th>Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($dashboardData[1] )
                                @foreach($dashboardData[1]  as $header => $value)
                                    <tr>
                                        <td> {{$header}} </td>
                                        <td> {{$value}} </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- <p>Some text in the modal.</p> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script>
        $(".ol-accordion").on("click", function () {
            var data = $('.ol-accordion').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.ol-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.ol-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.ol-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });

        $('.noc-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");

        $(".noc_accordian").on("click", function () {
            var data = $('.noc_accordian').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.noc-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.noc-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.noc-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });

        $('.noc_cc-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");

        $(".noc_cc_accordian").on("click", function () {
            var data = $('.noc_cc_accordian').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.noc_cc-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.noc_cc-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.noc_cc-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });
    </script>
    <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>
    @if($chart)
    <script>
        var chart;
        var legend;


        var chartData = [

                @foreach($dashboardData[0] as $header => $value)
                @if($header != 'Total No of Applications'){
                "status": '{{$header}}',
                "value": '{{$value[0]}}',
            },
            @endif
            @endforeach

        ];

        AmCharts.ready(function () {
            // PIE CHART
            chart = new AmCharts.AmPieChart();
            chart.dataProvider = chartData;
            chart.titleField = "status";
            chart.valueField = "value";
            chart.outlineColor = "#FFFFFF";
            chart.outlineAlpha = 0.8;
            chart.outlineThickness = 2;
            chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            // this makes the chart 3D
            chart.depth3D = 15;
            chart.angle = 30;
            chart.colors = [ "#f0791b", "#ffc063", "#2A0CD0", "#8bc34a", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"]
//
            // WRITE
            chart.write("chartdiv");
        });
    </script>
    @endif
    @if($chart1)
    <script>
        var chart1;
        var legend;

        @if($dashboardData1)
        var chartData1 = [
            @foreach($dashboardData1 as $header => $value)
                @if($header != 'Total Number of Applications Pending'){
                    "status": '{{$header}}',
                    "value": '{{$value}}',
                },
                @endif
            @endforeach
        ];

        AmCharts.ready(function () {
            // PIE CHART
            chart1 = new AmCharts.AmPieChart();
            chart1.dataProvider = chartData1;
            chart1.titleField = "status";
            chart1.valueField = "value";
            chart1.outlineColor = "#FFFFFF";
            chart1.outlineAlpha = 0.8;
            chart1.outlineThickness = 2;
            chart1.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            // this makes the chart 3D
            chart1.depth3D = 15;
            chart1.angle = 30;
            chart1.colors = [ "#f0791b", "#ffc063", "#2A0CD0", "#8bc34a", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"]
//
            // WRITE
            chart1.write("chartdiv1");
        });
        @endif

    </script>
    @endif
    <script>
        var noc_chart;
        var legend;

        @if($nocApplication['app_data'])
        var nocChartdata = [
                        @foreach($nocApplication['app_data'] as $header => $value)
                        @if($header != 'Total Number of Application'){
                            "status": '{{$header}}',
                            "value": '{{$value[0]}}',
                        },
                        @endif
                        @endforeach
            ];

        AmCharts.ready(function () {
// PIE CHART
            noc_chart = new AmCharts.AmPieChart();
            noc_chart.dataProvider = nocChartdata;
            noc_chart.titleField = "status";
            noc_chart.valueField = "value";
            noc_chart.outlineColor = "#FFFFFF";
            noc_chart.outlineAlpha = 0.4;
            noc_chart.outlineThickness = 2;
            noc_chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            noc_chart.depth3D = 15;
            noc_chart.angle = 30;
            noc_chart.colors = [ "#f0791b", "#ffc063", "#2A0CD0", "#8bc34a", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"]
            noc_chart.write("noc_chart_div");
        });
        @endif

    </script>
    <script>
        var noc_cc_chart;
        var legend;

        @if($nocforCCApplication['app_data'])
        var nocCCChartdata = [
                        @foreach($nocforCCApplication['app_data'] as $header => $value)
                        @if($header != 'Total Number of Application'){
                            "status": '{{$header}}',
                            "value": '{{$value[0]}}',
                        },
                        @endif
                        @endforeach
            ];

        AmCharts.ready(function () {
// PIE CHART
            noc_cc_chart = new AmCharts.AmPieChart();
            noc_cc_chart.dataProvider = nocCCChartdata;
            noc_cc_chart.titleField = "status";
            noc_cc_chart.valueField = "value";
            noc_cc_chart.outlineColor = "#FFFFFF";
            noc_cc_chart.outlineAlpha = 0.4;
            noc_cc_chart.outlineThickness = 2;
            noc_cc_chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            noc_cc_chart.depth3D = 15;
            noc_cc_chart.angle = 30;
            noc_cc_chart.colors = [ "#f0791b", "#ffc063", "#2A0CD0", "#8bc34a", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"]
            noc_cc_chart.write("noc_cc_chart_div");
        });
        @endif

    </script>
@endsection



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