@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="../../../../public/css/amcharts.css">
@endsection
@section('content')
    @php
        $chart = 0;
        $chart1 = 0;
        $chart2 = 0;
        $chart3 = 0;
    @endphp
    <div class="container-fluid">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Dashboard</h3>
            </div>
        </div>

        <!-- Dashboard for Convayance Module  -->
        @if(in_array(session()->get('role_name'),$conveyanceRoles))
            @if($conveyanceDashboard)
                <div class="hearing-accordion-wrapper">
                    <div class="m-portlet m-portlet--compact conveyance-accordion mb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                               data-toggle="collapse" href="#conveyance_dashboard">
                                <span class="form-accordion-title">Applications for Society Conveyance</span>
                                <span class="accordion-icon conveyance-accordion-icon"></span>
                            </a>
                        </div>
                    </div>
                    <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="conveyance_dashboard"
                         data-parent="#accordion">
                        <div class="row hearing-row">
                            @foreach($conveyanceDashboard[0] as $header => $value)
                                <div class="col">
                                    <div class="m-portlet app-card text-center">
                                        <h2 class="app-heading">{{$header}}</h2>
                                        <div class="app-card-footer">
                                            <h2 class="app-no mb-0">{{$value[0]}}</h2>

                                            @if( $value[1] == 'pending')
                                                <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#pending">View
                                                    Details</a>
                                            @elseif( $value[1] == 'sendToSociety')
                                                <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#sendToSociety">View
                                                    Details</a>
                                            @else
                                                <a href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>
                                            @endif
                                            @php $chart2 += $value[0]; @endphp
                                        </div>
                                        {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($chart2)
                            <div id="conveyance_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                        @endif
                        @if($pendingApplications && session()->get('role_name') == config('commanConfig.dyco_engineer'))
                            <div class="row hearing-row">
                                @foreach($pendingApplications as $header => $value)
                                    <div class="col">
                                        <div class="m-portlet app-card text-center">
                                            <h2 class="app-heading">{{$header}}</h2>
                                            <div class="app-card-footer">
                                                <h2 class="app-no mb-0">{{$value}}</h2>
                                                @php $chart3 += $value; @endphp
                                                {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if($chart3)
                                <div id="pending_conveyance_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                            @endif 
                        @endif                         
                    </div>
                </div>
        @endif
    @endif
    <!-- end -->

        <!-- Dashboard for Renewal Module  --> 
    @if(in_array(session()->get('role_name'),$renewalRoles))
    @if($renewalDashboard)
    <div class="hearing-accordion-wrapper">
        <div class="m-portlet m-portlet--compact renewal-accordion mb-0">
            <div class="d-flex justify-content-between align-items-center">
                <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                    data-toggle="collapse" href="#renewal_dashboard">
                    <span class="form-accordion-title">Applications for Society Renewal</span>
                    <span class="accordion-icon renewal-accordion-icon"></span>
                </a>
            </div>
        </div>
        <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="renewal_dashboard"
            data-parent="#accordion">
            <div class="row hearing-row">
                @php $chart = 0; @endphp
            @foreach($renewalDashboard[0] as $header => $value)
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">{{$header}}</h2>
                        <div class="app-card-footer">
                            <h2 class="app-no mb-0">{{$value[0]}}</h2>

                            @if( $value[1] == 'pending')
                            <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#pending_renewal">View Details</a>
                            @elseif( $value[1] == 'sendToSociety')
                            <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#sendToSociety_renewal">View Details</a>
                            @else
                            <a href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>
                            @endif
                            @php $chart += $value[0]; @endphp
                        </div>
                        {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                    </div>
                </div>
                @endforeach
                    @if($chart)
                        <div id="renewal_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                    @endif

                @if($renewalPendingApplications && session()->get('role_name') == config('commanConfig.dyco_engineer'))
                    <div class="row hearing-row">
                        @foreach($renewalPendingApplications as $header => $value)
                            <div class="col">
                                <div class="m-portlet app-card text-center">
                                    <h2 class="app-heading">{{$header}}</h2>
                                    <div class="app-card-footer">
                                        <h2 class="app-no mb-0">{{$value}}</h2>
                                        @php $chart1 += $value; @endphp
                                        {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($chart1)
                        <div id="pending_renewal_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                    @endif
                @endif    
            </div>
        </div>
    </div>
    @endif
    @endif
    <!-- end -->      

    </div>

    <!-- Modal for application pending bifergation -->
    <div class="modal fade" id="pending" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pending Applications</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive m-portlet__body--table">
                        <table class="table text-center">
                            <thead class="thead-default">
                            <tr>
                                <th>Header</th>
                                <th>Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($conveyanceDashboard[1])
                                @foreach($conveyanceDashboard[1] as $header => $value)
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

    <!-- Model for send to society bifergation-->
    <div class="modal fade" id="sendToSociety" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Applications Sent to Society</h4>
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
                            @if($conveyanceDashboard[2])
                                @foreach($conveyanceDashboard[2] as $header => $value)
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

    <!-- Modal for renewal application pending bifergation -->
    <div class="modal fade" id="pending_renewal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pending Applications</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive m-portlet__body--table">
                        <table class="table text-center">
                            <thead class="thead-default">
                                <tr>
                                    <th>Header</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($renewalDashboard[1])
                                @foreach($renewalDashboard[1] as $header => $value)
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
    
    <!-- Model for renewal send to society bifergation-->
    <div class="modal fade" id="sendToSociety_renewal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Applications Sent to Society</h4>
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
                                @if($renewalDashboard[2])
                                    @foreach($renewalDashboard[2] as $header => $value)
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
        $(".conveyance-accordion").on("click", function () {
            var data = $('.conveyance-accordion').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.conveyance-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            } else {
                if (data == 'undefine' || data == 'false') {
                    $('.conveyance-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.conveyance-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });
    </script>

    <script>
        $(".renewal-accordion").on("click", function () {
            var data = $('.renewal-accordion').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.renewal-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            } else {
                if (data == 'undefine' || data == 'false') {
                    $('.renewal-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.renewal-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });
    </script>    
    <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>
    @if($chart2)
    <script>
        var chart2;
        var legend;

                @if($conveyanceDashboard[0])
        var chartData2 = [
                        @foreach($conveyanceDashboard[0] as $header => $value)     {
                        @if(!($header == 'Total No of Applications'))
                        "status": '{{$header}}',
                    "value": '{{$value[0]}}',
                        @endif
                },
                    @endforeach

            ];
        //    console.log(chartData1);

        AmCharts.ready(function () {
            // PIE CHART
            chart2 = new AmCharts.AmPieChart();
            chart2.dataProvider = chartData2;
            chart2.titleField = "status";
            chart2.valueField = "value";
            chart2.outlineColor = "#FFFFFF";
            chart2.outlineAlpha = 0.8;
            chart2.outlineThickness = 2;
            chart2.balloonText =
                "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            // this makes the chart 3D
            chart2.depth3D = 15;
            chart2.angle = 30;
            chart2.colors = ["#f0791b", "#ffc063", "#2A0CD0", "#8bc34a", "#CD0D74", "#754DEB", "#DDDDDD", "#999999",
                "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"
            ]
            //
            // WRITE
            chart2.write("conveyance_chart");
        });
        @endif
    </script>
    @endif

    @if($chart3)
    <script>
        var chart3;
        var legend;

                @if($pendingApplications)
        var chartData3 = [
                        @foreach($pendingApplications as $header => $value)     {
                        "status": '{{$header}}',
                        "value" : '{{$value}}',
                },
                    @endforeach

            ];
        //    console.log(chartData1);

        AmCharts.ready(function () {
            // PIE CHART
            chart3 = new AmCharts.AmPieChart();
            chart3.dataProvider = chartData3;
            chart3.titleField = "status";
            chart3.valueField = "value";
            chart3.outlineColor = "#FFFFFF";
            chart3.outlineAlpha = 0.8;
            chart3.outlineThickness = 2;
            chart3.balloonText =
                "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            // this makes the chart 3D
            chart3.depth3D = 15;
            chart3.angle = 30;
            chart3.colors = ["#f0791b", "#ffc063", "#2A0CD0", "#8bc34a", "#CD0D74", "#754DEB", "#DDDDDD", "#999999",
                "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"
            ]
            //
            // WRITE
            chart3.write("pending_conveyance_chart");
        });
        @endif
    </script>
    @endif 

    @if($chart)
    <script>
        var chart;
        var legend;

                @if($renewalDashboard[0])
        var chartData = [
                        @foreach($renewalDashboard[0] as $header => $value)     {
                        @if(!($header == 'Total No of Applications'))
                        "status": '{{$header}}',
                    "value": '{{$value[0]}}',
                        @endif
                },
                    @endforeach

            ];
        //    console.log(chartData1);

        AmCharts.ready(function () {
            // PIE CHART
            chart = new AmCharts.AmPieChart();
            chart.dataProvider = chartData;
            chart.titleField = "status";
            chart.valueField = "value";
            chart.outlineColor = "#FFFFFF";
            chart.outlineAlpha = 0.8;
            chart.outlineThickness = 2;
            chart.balloonText =
                "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            // this makes the chart 3D
            chart.depth3D = 15;
            chart.angle = 30;
            chart.colors = ["#f0791b", "#ffc063", "#2A0CD0", "#8bc34a", "#CD0D74", "#754DEB", "#DDDDDD", "#999999",
                "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"
            ]
            //
            // WRITE
            chart.write("renewal_chart");
        });
        @endif
    </script>
    @endif 

    @if($chart1)
    <script>
        var chart1;
        var legend;

                @if($renewalPendingApplications)
        var chartData1 = [
                        @foreach($renewalPendingApplications as $header => $value)     {
                        "status": '{{$header}}',
                        "value" : '{{$value}}',
                },
                    @endforeach

            ];
        //    console.log(chartData1);

        AmCharts.ready(function () {
            // PIE CHART
            chart1 = new AmCharts.AmPieChart();
            chart1.dataProvider = chartData1;
            chart1.titleField = "status";
            chart1.valueField = "value";
            chart1.outlineColor = "#FFFFFF";
            chart1.outlineAlpha = 0.8;
            chart1.outlineThickness = 2;
            chart1.balloonText =
                "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            // this makes the chart 3D
            chart1.depth3D = 15;
            chart1.angle = 30;
            chart1.colors = ["#f0791b", "#ffc063", "#2A0CD0", "#8bc34a", "#CD0D74", "#754DEB", "#DDDDDD", "#999999",
                "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"
            ]
            //
            // WRITE
            chart1.write("pending_renewal_chart");
        });
        @endif
    </script>
    @endif           


@endsection