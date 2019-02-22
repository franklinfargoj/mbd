@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="../../../../public/css/amcharts.css">
    <!-- Fonts -->
    <!--<link rel="dns-prefetch" href="https://fonts.gstatic.com">-->
    <!-- Styles -->
    <link href="{{asset('/css/dashboard/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/css/dashboard/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    {{--    <link href="{{asset('/css/dashboard/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />--}}
    <link href="{{asset('/css/dashboard/custom.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @php
        $chart = 0;
        $chart1 = 0;
        $chart2 = 0;
        $chart3 = 0;
        $chart_tripartite = 0;
    @endphp
    <div class="container-fluid">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Dashboard</h3>
            </div>
        </div>

        <div class="d-flex flex-wrap db-wrapper">
            @if(in_array(session()->get('role_name'),$conveyanceRoles))
            @if($conveyanceDashboard)
                    <div class="db__card conveyance" data-module = "Society Conveyance">
                        <div class="db__card__img-wrap db-color-1">
                            <h3 class="db__card__count">{{$conveyanceDashboard['0']['Total No of Applications'][0]}}</h3>
                        </div>
                        <p class="db__card__title">Society Conveyance</p>
                    </div>
                @endif
                @if($tripartite_data['dashboardData'])
                    <div class="db__card tripartite" data-module="Tripartite Agreement">
                        <div class="db__card__img-wrap db-color-2">
                            <h3 class="db__card__count">{{$tripartite_data['dashboardData'][0]['Total Number of Applications'][0]}}</h3>
                        </div>
                        <p class="db__card__title">Tripartite Agreement</p>
                    </div>
                @endif
                @endif
        </div>
        <div id="count_table">
        </div>

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
            <div class="row no-gutters hearing-row">
                <div class="col-12 no-shadow">
                    <div class="app-card-section-title">Renewal</div>
                </div>
                @php $chart = 0; @endphp
            @foreach($renewalDashboard[0] as $header => $value)
                <div class="col-lg-3">
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
                    <div class="row no-gutters hearing-row">
                        <div class="col-12 no-shadow">
                            <div class="app-card-section-title">Renewal Subordinate Pendency</div>
                        </div>
                        @foreach($renewalPendingApplications as $header => $value)
                            <div class="col-lg-3">
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

    @if((session()->get('role_name')==config('commanConfig.estate_manager'))||
    (session()->get('role_name')==config('commanConfig.dyco_engineer')) ||
    (session()->get('role_name')==config('commanConfig.dycdo_engineer')))
    @include('admin.dashboard.society_formation.main',compact('formation_data'))
    @endif
    <!-- end -->
     @if((session()->get('role_name')==config('commanConfig.junior_architect'))||
    (session()->get('role_name')==config('commanConfig.senior_architect')) ||
    (session()->get('role_name')==config('commanConfig.architect')))
    @include('admin.dashboard.architect_layout.partials.architect_dashboard',compact('data'))
    @endif
    {{--@if(session()->get('role_name')==config('commanConfig.land_manager'))--}}
    {{--@include('admin.dashboard.architect_layout.partials.lm_dashboard',compact('data'))--}}
    {{--@endif--}}
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

    <!-- Modal for tripartite send to society bifergation-->
    <div class="modal fade" id="tripartitereePendingModal" role="dialog">
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
                            @if($tripartite_data['dashboardData'][1])
                                @foreach($tripartite_data['dashboardData'][1]  as $header => $value)
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

    @if($chart_tripartite)
        <script>
            var chart_tripartite;
            var legend;

                    @if($tripartite_data['dashboardData'][0])
            var chartDatatripartite = [
                            @foreach($tripartite_data['dashboardData'][0] as $header => $value)     {
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
                chart_tripartite = new AmCharts.AmPieChart();
                chart_tripartite.dataProvider = chartDatatripartite;
                chart_tripartite.titleField = "status";
                chart_tripartite.valueField = "value";
                chart_tripartite.outlineColor = "#FFFFFF";
                chart_tripartite.outlineAlpha = 0.8;
                chart_tripartite.outlineThickness = 2;
                chart_tripartite.balloonText =
                    "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                // this makes the chart 3D
                chart_tripartite.depth3D = 15;
                chart_tripartite.angle = 30;
                chart_tripartite.colors = ["#f0791b", "#ffc063", "#2A0CD0", "#8bc34a", "#CD0D74", "#754DEB", "#DDDDDD", "#999999",
                    "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"
                ]
                //
                // WRITE
                chart_tripartite.write("tripartite_chart");
            });
            @endif
        </script>
    @endif

    {{--ajax call for Count Table and Pie chart(conveyance)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.conveyance')}}";
        $(".conveyance").on("click", function () {

            var module_name = ($(this).attr("data-module"));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: dashboard,
                data: {module_name:module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {

                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">"+module_name+"</h3>\n" +
                            "                    </div>\n" +
                            "                </div>\n" +
                            "                <div class=\"row\">\n" +
                            "                    <div class=\"col-sm-7\" >" +
                            "                        <div class=\"m-portlet db-table\">\n" +
                            "                            <div class=\"table-responsive\">\n" +
                            "                                <table class=\"table text-center\">\n" +
                            "                                    <thead>\n" +
                            "                                    <th style=\"width: 10%;\">Sr. No</th>\n" +
                            "                                    <th style=\"width: 60%;\" class=\"text-center\">Stages</th>\n" +
                            "                                    <th style=\"width: 15%;\" class=\"text-left\">Count</th>\n" +
                            "                                    <th style=\"width: 15%;\">Action</th>\n" +
                            "                                    </thead>\n" +
                            "                                    </tbody>\n" ;

                        var chart_count = 0 ;
                        var i = 1 ;
                        $.each(data[0], function (index, data) {

                            html += "<tr>\n" +
                                "<td class=\"text-center\">"+i+"</td>" +
                                "<td>"+index+"</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">"+data[0]+"</span></td>\n" +
                                "<td class=\"text-center\">";

                            if(data[1] == "pending"){

                                html += "<a href=\""+baseUrl+"/"+data[1]+"\"class=\"btn btn-action\" data-toggle=\"modal\"\n" +
                                    "             data-target=\"#pending\">View</a>";
                            }
                            else if(data[1] == "sendToSociety"){
                                html += "<a href=\""+baseUrl+"/"+data[1]+"\"class=\"btn btn-action\" data-toggle=\"modal\"\n" +
                                    "             data-target=\"#sendToSociety\">View</a>";
                            }
                            else{
                                html+= "<a href=\""+baseUrl+"/"+data[1]+"\"class=\"btn btn-action\">View</a>\n";

                            }
                            html += "</td>\n" +
                                "</tr>";

                            chart_count += data[0];
                            i++;
                        });

                        html +="</tbody>\n" +
                            "                                </table>\n" +
                            "                        </div>\n" +
                            "                    </div>" +
                            "                   </div>\n" +
                            "                        <div class=\"col-sm-5\" id=\"ajaxchartdiv\">\n" +
                            "                        </div>\n" +
                            "                </div>\n" +
                            "            </div>";

                        $('#count_table').html(html);


                        if(chart_count){

                            var chartData = [];
                            $.each((data[0]), function (index, data) {
                                obj = {};
                                if (index != 'Total No of Applications') {
                                    obj['status'] = index;
                                    obj['value'] = data[0];
                                    chartData.push(obj);
                                }

                            });

                            var chart = AmCharts.makeChart( "ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider":chartData ,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor":"#FFFFFF",
                                "outlineThickness" : 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize" : 15,
                            } );
                        }
                    }
                    else {
                        alert('errror');
                    }
                },
            });

        });

    </script>
    {{--end ajax call for Count Table and Pie chart(conveyance)--}}

    {{--ajax call for Count Table and Pie chart(tripartite)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.conveyance')}}";
        $(".tripartite").on("click", function () {

            var tripartite_application = "{{route('tripartite.index')}}";
            var redirect_to = "{{session()->get('redirect_to')}}";
            var module_name = ($(this).attr("data-module"));

//                        alert(module_name);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: dashboard,
                data: {module_name:module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {


                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">"+module_name+"</h3>\n" +
                            "                    </div>\n" +
                            "                </div>\n" +
                            "                <div class=\"row\">\n" +
                            "                    <div class=\"col-sm-7\" >" +
                            "                        <div class=\"m-portlet db-table\">\n" +
                            "                            <div class=\"table-responsive\">\n" +
                            "                                <table class=\"table text-center\">\n" +
                            "                                    <thead class=\"thead-default\">\n" +
                            "                                    <th style=\"width: 10%;\">Sr. No</th>\n" +
                            "                                    <th style=\"width: 60%;\" class=\"text-center\">Stages</th>\n" +
                            "                                    <th style=\"width: 15%;\" class=\"text-left\">Count</th>\n" +
                            "                                    <th style=\"width: 15%;\">Action</th>\n" +
                            "                                    </thead>\n" +
                            "                                    </tbody>\n" ;

                        var chart_count = 0 ;
                        var i = 1 ;
                        $.each(data, function (index, data) {

//                                        console.log(data);

                            html += "<tr>\n" +
                                "<td class=\"text-center\">"+i+"</td>" +
                                "<td>"+index+"</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">"+data[0]+"</span></td>\n" +
                                "<td class=\"text-center\">";

                            if(data[1] == "pending"){

                                html += "<a href=\"#tripartitereePendingModal\" data-dismiss=\"modal\"class=\"btn btn-action\" data-toggle=\"modal\"\n" +
                                    "             data-target=\"#tripartitereePendingModal\">View</a>";
                            }
                            else{
                                html+= "<a href=\""+tripartite_application+data[1]+"\"class=\"btn btn-action\">View</a>\n";

                            }
                            html += "</td>\n" +
                                "</tr>";

                            chart_count += data[0];
                            i++;
                        });

                        html +="</tbody>\n" +
                            "                                </table>\n" +
                            "                        </div>\n" +
                            "                    </div>" +
                            "                   </div>\n" +
                            "                        <div class=\"col-sm-5\" id=\"ajaxchartdiv\">\n" +
                            "                        </div>\n" +
                            "                </div>\n" +
                            "            </div>";

//                                    alert(chart_count);
                        $('#count_table').html(html);


                        if(chart_count){

                            var chartData = [];
                            $.each((data), function (index, data) {
                                obj = {};
                                if (index != 'Total Number of Applications') {
                                    obj['status'] = index;
                                    obj['value'] = data[0];
                                    chartData.push(obj);
                                }

                            });
//                                        console.log(chartData);

                            var chart = AmCharts.makeChart( "ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider":chartData ,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor":"#FFFFFF",
                                "outlineThickness" : 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize" : 15,
                            } );
                        }
                        $("#getCodeModal").modal('show');

                    }
                    else {
                        alert('errror');
                    }
                },
            });

        });

    </script>
    {{--end ajax call for Count Table and Pie chart(tripartite)--}}




@endsection
