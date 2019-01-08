@extends('admin.layouts.app')
@section('css')
<link rel="stylesheet" href="../../../../public/css/amcharts.css">
@endsection

@section('content') @php $chart = 0; $chart1 = 0; $chart2 = 0; $chart3 = 0; $chart4 = 0;
@endphp
<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Dashboard</h3>
        </div>
    </div>
    @if( !((session()->get('role_name') == config('commanConfig.junior_architect')) || (session()->get('role_name') == config('commanConfig.architect')) || (session()->get('role_name') == config('commanConfig.senior_architect'))))
    <div class="hearing-accordion-wrapper">
        <div class="m-portlet m-portlet--compact ol-accordion mb-0">
            <div class="d-flex justify-content-between align-items-center">
                <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                    data-toggle="collapse" href="#ree-offer-letter-summary">
                    <span class="form-accordion-title">Application for Redevelopment</span>
                    <span class="accordion-icon ol-accordion-icon"></span>
                </a>
            </div>
        </div>
        <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="ree-offer-letter-summary"
            data-parent="#accordion">
            <div class="row no-gutters">
                <div class="{{ (session()->get('role_name') == config('commanConfig.ee_junior_engineer') || session()->get('role_name') == config('commanConfig.dyce_jr_user')) ? 'col-9' : 'col-12' }} no-shadow">
                    <div class="app-card-section-title">Offer Letter Subordinate Pendency</div>
                </div>
            </div>
            <div class="row no-gutters hearing-row">
                @foreach($dashboardData as $header => $value)
                <div class="col-lg-3">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">{{$header}}</h2>
                        <div class="app-card-footer">
                            <h2 class="app-no mb-0">{{$value[0]}}</h2>
                            @php $chart += $value[0]
                            @endphp
                            <a href="{{url(session()->get('redirect_to').$value[1])}}" class="app-card__details mb-0">View
                                Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if($chart)
            <div id="chartdiv" style="width: 100%; height: 350px; margin-top: 2px;"></div>
            @endif @if($dashboardData1)
            <div class="row no-gutters"> 
                <div class="col-12 no-shadow">
                    <div class="app-card-section-title">Offer Letter Subordinate Pendency</div>
                </div>
            </div>
            <div class="row no-gutters hearing-row">
                @foreach($dashboardData1 as $header => $value)
                <div class="col-lg-3">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">{{$header}}</h2>
                        <h2 class="app-no mb-0">{{$value}}</h2>
                        @php $chart1 += $value;
                        @endphp {{--
                        <a href="" class="app-card__details mb-0">View Details</a>--}}
                    </div>
                </div>
                @endforeach
            </div>
            @if($chart1)
            <div id="chartdiv1" style="width: 100%; height: 350px; margin-top: 2px;"></div>
            @endif @endif {{--@if($dashboardData1)--}} {{--
            <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="ree-ol-pending-summary"
                --}} {{--data-parent="#accordion">--}} {{----}} {{--
            </div>--}} {{--@endif--}} </div> </div>
    @endif

                <!-- Dashboard for Convayance Module -->
                @if(in_array(session()->get('role_name'),$conveyanceRoles)) @if($conveyanceDashboard)
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
                        <div class="row no-gutters hearing-row">
                            <div class="col-12 no-shadow">
                                <div class="app-card-section-title">Society Conveyance</div>
                            </div>
                            @foreach($conveyanceDashboard[0] as $header => $value)
                            <div class="col-lg-3">
                                <div class="m-portlet app-card text-center no-shadow">
                                    <h2 class="app-heading">{{$header}}</h2>
                                    <div class="app-card-footer">
                                        <h2 class="app-no mb-0">{{$value[0]}}</h2>

                                        @if( $value[1] == 'pending')
                                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal"
                                            data-target="#pending">View
                                            Details</a> @elseif( $value[1] == 'sendToSociety')
                                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal"
                                            data-target="#sendToSociety">View
                                            Details</a> @else
                                        <a href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>
                                        @endif @php $chart2
                                        += $value[0];
                                        @endphp
                                    </div>
                                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if($chart2)
                        <div id="conveyance_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                        @endif
                    </div>
                </div>
                @endif @endif
                <!-- end -->

    @if (in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'), config('commanConfig.vp_engineer'))))
                <div class="hearing-accordion-wrapper">
                    <div class="m-portlet m-portlet--compact ol-reval-accordion mb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                               data-toggle="collapse" href="#ree-ol-reval-summary">
                                <span class="form-accordion-title">Application for Revalidation of Offer Letter </span>
                                <span class="accordion-icon ol-reval-accordion-icon"></span>
                            </a>
                        </div>
                    </div>
                    <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="ree-ol-reval-summary"
                         data-parent="#accordion">
                         <div class="row no-gutters">
                             <div class="col-12 no-shadow">
                                <div class="app-card-section-title">Offer Letter Revalidation</div>
                            </div>
                         </div>
                        <div class="row no-gutters hearing-row">
                            @foreach($revalDashboardData as $header => $value)
                                <div class="col-lg-3">
                                    <div class="m-portlet app-card text-center">
                                        <h2 class="app-heading">{{$header}}</h2>
                                        <div class="app-card-footer">
                                            <h2 class="app-no mb-0">{{$value[0]}}</h2>
                                            @php $chart4 += $value[0];@endphp
                                            <a href="{{ (session()->get('role_name') == config('commanConfig.cap_engineer')) ? route('cap_applications.reval').$value[1] : route('vp_applications.reval').$value[1]}}" class="app-card__details mb-0">View
                                                Details</a>

                                            {{--<a href="{{url(session()->get('redirect_to').$value[1])}}" class="app-card__details mb-0">View Details</a>--}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($chart4)
                            <div id="reval_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                        @endif
                    </div>
                </div>
    @endif




                <!-- Dashboard for Renewal Module  -->
                @if(in_array(session()->get('role_name'),$renewalRoles)) @if($renewalDashboard)
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
                                <div class="app-card-section-title">Society Renewal</div>
                            </div>
                            @foreach($renewalDashboard[0] as $header => $value)
                            <div class="col-lg-3">
                                <div class="m-portlet app-card text-center">
                                    <h2 class="app-heading">{{$header}}</h2>
                                    <div class="app-card-footer">
                                        <h2 class="app-no mb-0">{{$value[0]}}</h2>

                                        @if( $value[1] == 'pending')
                                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal"
                                            data-target="#pending_renewal">View Details</a> @elseif( $value[1] ==
                                        'sendToSociety')
                                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal"
                                            data-target="#sendToSociety_renewal">View Details</a> @else
                                        <a href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>
                                        @endif @php $chart3
                                        += $value[0];
                                        @endphp
                                    </div>
                                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                                </div>
                            </div>
                            @endforeach @if($chart3)
                            <div id="renewal_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif @endif
                <!-- end -->
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
                                        @if($conveyanceDashboard[1]) @foreach($conveyanceDashboard[1] as $header =>
                                        $value)
                                        <tr>
                                            <td> {{$header}} </td>
                                            <td> {{$value}} </td>
                                        </tr>
                                        @endforeach @endif
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
                                        @if($conveyanceDashboard[2]) @foreach($conveyanceDashboard[2] as $header =>
                                        $value)
                                        <tr>
                                            <td> {{$header}} </td>
                                            <td> {{$value}} </td>
                                        </tr>
                                        @endforeach @endif
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
                                        @if($renewalDashboard[1]) @foreach($renewalDashboard[1] as $header => $value)
                                        <tr>
                                            <td> {{$header}} </td>
                                            <td> {{$value}} </td>
                                        </tr>
                                        @endforeach @endif
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
                                        @if($renewalDashboard[2]) @foreach($renewalDashboard[2] as $header => $value)
                                        <tr>
                                            <td> {{$header}} </td>
                                            <td> {{$value}} </td>
                                        </tr>
                                        @endforeach @endif
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
                    } else {
                        if (data == 'undefine' || data == 'false') {
                            $('.ol-accordion-icon').css('background-image',
                                "url('../../../../img/minus-icon.svg')");
                        } else {
                            $('.ol-accordion-icon').css('background-image',
                                "url('../../../../img/plus-icon.svg')");
                        }
                    }
                });

                $(".ol-reval-accordion").on("click", function () {
                    var data = $('.ol-reval-accordion').children().children().attr('aria-expanded');
                    if (!(data)) {
                        $('.ol-reval-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                    }
                    else {
                        if (data == 'undefine' || data == 'false') {
                            $('.ol-reval-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                        } else {
                            $('.ol-reval-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                        }
                    }
                });

            </script>
            <script>
                $(".conveyance-accordion").on("click", function () {
                    var data = $('.conveyance-accordion').children().children().attr('aria-expanded');
                    if (!(data)) {
                        $('.conveyance-accordion-icon').css('background-image',
                            "url('../../../../img/minus-icon.svg')");
                    } else {
                        if (data == 'undefine' || data == 'false') {
                            $('.conveyance-accordion-icon').css('background-image',
                                "url('../../../../img/minus-icon.svg')");
                        } else {
                            $('.conveyance-accordion-icon').css('background-image',
                                "url('../../../../img/plus-icon.svg')");
                        }
                    }
                });

            </script>
            <script>
                $(".renewal-accordion").on("click", function () {
                    var data = $('.renewal-accordion').children().children().attr('aria-expanded');
                    if (!(data)) {
                        $('.renewal-accordion-icon').css('background-image',
                            "url('../../../../img/minus-icon.svg')");
                    } else {
                        if (data == 'undefine' || data == 'false') {
                            $('.renewal-accordion-icon').css('background-image',
                                "url('../../../../img/minus-icon.svg')");
                        } else {
                            $('.renewal-accordion-icon').css('background-image',
                                "url('../../../../img/plus-icon.svg')");
                        }
                    }
                });

            </script>
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

            <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>
            @if($chart)
            <script>
                var chart;
                var legend;


                var chartData = [

                    @foreach($dashboardData as $header => $value)
                    @if($header != 'Total No of Applications') {
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
                    chart.balloonText =
                        "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                    // this makes the chart 3D
                    chart.depth3D = 15;
                    chart.angle = 30;
                    chart.colors = ["#f0791b", "#ffc063", "#8bc34a", "#754DEB", "#DDDDDD", "#999999", "#333333",
                        "#179252", "#57032A", "#CA9726", "#990000", "#4B0C25"
                    ]
                    chart.fontSize = 15;

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
                    @foreach($dashboardData1 as $header => $value) {
                        "status": '{{$header}}',
                        "value": '{{$value}}',
                    },
                    @endforeach

                ];

                console.log(chartData1);
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
                    chart1.colors = ["#f0791b", "#ffc063", "#8bc34a", "#754DEB", "#DDDDDD", "#999999",
                        "#333333", "#179252", "#57032A", "#CA9726", "#990000", "#4B0C25"
                    ]
                    chart1.fontSize = 15;

                    //
                    // WRITE
                    chart1.write("chartdiv1");
                });
                @endif

            </script>
            @endif @if($chart2)
            <script>
                var chart2;
                var legend;

                @if($conveyanceDashboard[0])
                var chartData2 = [
                    @foreach($conveyanceDashboard[0] as $header => $value) {
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
                    chart2.colors = ["#f0791b", "#ffc063", "#8bc34a", "#754DEB", "#DDDDDD", "#999999",
                        "#333333", "#179252", "#57032A", "#CA9726", "#990000", "#4B0C25"
                    ]
                    chart2.fontSize = 15;

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


                var chartData3 = [

                    @foreach($renewalDashboard[0] as $header => $value)
                    @if($header != 'Total No of Applications') {
                        "status": '{{$header}}',
                        "value": '{{$value[0]}}',
                    },
                    @endif
                    @endforeach

                ];

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
                    chart3.colors = ["#f0791b", "#ffc063", "#8bc34a", "#754DEB", "#DDDDDD", "#999999",
                        "#333333", "#179252", "#57032A", "#CA9726", "#990000", "#4B0C25"
                    ]
                    chart3.fontSize = 15;

                    // WRITE
                    chart3.write("renewal_chart");
                });

            </script>
            @endif
            @if($chart4)
                <script>
                    var chart4;
                    var legend;


                    var chartData4 = [

                            @foreach($revalDashboardData as $header => $value)
                            @if($header != 'Total No of Applications'){
                            "status": '{{$header}}',
                            "value": '{{$value[0]}}',
                        },
                        @endif
                        @endforeach

                    ];

                    AmCharts.ready(function () {
                        // PIE CHART
                        chart4 = new AmCharts.AmPieChart();
                        chart4.dataProvider = chartData4;
                        chart4.titleField = "status";
                        chart4.valueField = "value";
                        chart4.outlineColor = "#FFFFFF";
                        chart4.outlineAlpha = 0.8;
                        chart4.outlineThickness = 2;
                        chart4.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                        // this makes the chart 3D
                        chart4.depth3D = 15;
                        chart4.angle = 30;
                        chart4.colors =[ "#f0791b", "#ffc063", "#8bc34a", "#754DEB", "#DDDDDD", "#999999", "#333333", "#179252", "#57032A", "#CA9726", "#990000", "#4B0C25"]
                        chart4.fontSize = 15;

                        // WRITE
                        chart4.write("reval_chart");
                    });
                </script>
            @endif

            @endsection
