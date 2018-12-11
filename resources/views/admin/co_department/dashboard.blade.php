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

        <div class="hearing-accordion-wrapper">
            <div class="m-portlet m-portlet--compact hearing-accordion mb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                       data-toggle="collapse" href="#co-ol-summary">
                        <span class="form-accordion-title">CO Offer Letter Summary</span>
                        <span class="accordion-icon"></span>
                    </a>
                </div>
            </div>
            <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="co-ol-summary"
                 data-parent="#accordion">
                <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="ree-ol-summary"
                     data-parent="#accordion">
                    <div class="row hearing-row">
                        @php $chart = 0;@endphp
                        @foreach($dashboardData as $header => $value)
                            <div class="col">
                                <div class="m-portlet app-card text-center">
                                    <h2 class="app-heading">{{$header}}</h2>
                                    <h2 class="app-no mb-0">{{$value[0]}}</h2>
                                    @php $chart += $value[0];@endphp
                                    <a href="{{url(session()->get('redirect_to').$value[1])}}" class="app-card__details mb-0">View Details</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($chart)
                        <div id="chartdiv" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                    @endif

                    @if($dashboardData1)
                        <div class="row hearing-row">
                            @php $chart = 0;@endphp
                            @foreach($dashboardData1 as $header => $value)
                                <div class="col">
                                    <div class="m-portlet app-card text-center">
                                        <h2 class="app-heading">{{$header}}</h2>
                                        <h2 class="app-no mb-0">{{$value[0]}}</h2>
                                    @php $chart += $value;@endphp
                                    <!-- <a href="{{url(session()->get('redirect_to').$value[1])}}" class="app-card__details mb-0">View Details</a> -->
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($chart)
                            <div id="chartdiv1" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <!-- Dashboard for Convayance Module -->
        @if($conveyanceDashboard)
            <div class="hearing-accordion-wrapper">
                <div class="m-portlet m-portlet--compact hearing-accordion mb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                           data-toggle="collapse" href="#conveyance_dashboard">
                            <span class="form-accordion-title">Application for Society Conveyance</span>
                            <span class="accordion-icon"></span>
                        </a>
                    </div>
                </div>
                <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="conveyance_dashboard"
                     data-parent="#accordion">
                    <div class="row hearing-row">
                        @foreach($conveyanceDashboard as $header => $value)
                            <div class="col">
                                <div class="m-portlet app-card text-center">
                                    <h2 class="app-heading">{{$header}}</h2>
                                    <h2 class="app-no mb-0">{{$value}}</h2>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if($pendingApplications)
            <div class="hearing-accordion-wrapper">
                <div class="m-portlet m-portlet--compact hearing-accordion mb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                           data-toggle="collapse" href="#pending_at_dept">
                            <span class="form-accordion-title">Pending Applications</span>
                            <span class="accordion-icon"></span>
                        </a>
                    </div>
                </div>
                <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="pending_at_dept"
                     data-parent="#accordion">
                    <div class="row hearing-row">
                        @foreach($pendingApplications as $header => $value)
                            <div class="col">
                                <div class="m-portlet app-card text-center">
                                    <h2 class="app-heading">{{$header}}</h2>
                                    <h2 class="app-no mb-0">{{$value}}</h2>
                                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
@section('js')
    <script>
        $(".accordion-icon").on("click", function () {
            var data = $('.hearing-accordion').children().children().attr('aria-expanded');
            if(data == 'undefine' || data == 'false'){
                $('.accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            }else{
                $('.accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
            }
        });
    </script>
    <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>

    <script>
        var chart;
        var legend;


        var chartData = [

                @foreach($dashboardData as $header => $value)
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