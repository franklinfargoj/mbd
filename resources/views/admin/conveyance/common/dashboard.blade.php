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
                @php $chart = 0; @endphp
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
                            @php $chart += $value[0]; @endphp
                        </div>
                        {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                    </div>
                </div>
                @endforeach
                    @if($chart)
                        <div id="conveyance_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                    @endif
            </div>
            @if($pendingApplications && session()->get('role_name') == config('commanConfig.dyco_engineer'))
                <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse " id="pending_at_dept"
                     data-parent="#accordion">
                    @php $chart = 0; @endphp
                    <div class="row hearing-row">
                        @foreach($pendingApplications as $header => $value)
                            <div class="col">
                                <div class="m-portlet app-card text-center">
                                    <h2 class="app-heading">{{$header}}</h2>
                                    <div class="app-card-footer">
                                        <h2 class="app-no mb-0">{{$value}}</h2>
                                        @php $chart += $value; @endphp
                                        {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($chart)
                        <div id="pending_conveyance_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                    @endif
                </div>
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
        <div class="m-portlet m-portlet--compact conveyance-accordion mb-0">
            <div class="d-flex justify-content-between align-items-center">
                <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                    data-toggle="collapse" href="#renewal_dashboard">
                    <span class="form-accordion-title">Applications for Society Renewal</span>
                    <span class="accordion-icon conveyance-accordion-icon"></span>
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
                        <div id="conveyance_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                    @endif
            </div>
            @if($renewalPendingApplications && session()->get('role_name') == config('commanConfig.dyco_engineer'))
                <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse " id="pending_at_dept"
                     data-parent="#accordion">
                    @php $chart = 0; @endphp
                    <div class="row hearing-row">
                        @foreach($renewalPendingApplications as $header => $value)
                            <div class="col">
                                <div class="m-portlet app-card text-center">
                                    <h2 class="app-heading">{{$header}}</h2>
                                    <div class="app-card-footer">
                                        <h2 class="app-no mb-0">{{$value}}</h2>
                                        @php $chart += $value; @endphp
                                        {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($chart)
                        <div id="pending_conveyance_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                    @endif
                </div>
            @endif
        </div>
    </div>
    @endif
    @endif
    <!-- end -->    
</div>

<!-- Modal for conveyance application pending bifergation -->
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
    $(".ol-accordion").on("click", function () {
        var data = $('.ol-accordion').children().children().attr('aria-expanded');
        if (!(data)) {
            $('.ol-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
        } else {
            if (data == 'undefine' || data == 'false') {
                $('.ol-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            } else {
                $('.ol-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
            }
        }
    });
</script>
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
<script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>

<script>
    var chart1;
    var legend;

            @if($conveyanceDashboard[0])
    var chartData1 = [
            @foreach($conveyanceDashboard[0] as $header => $value)     {
                "status": '{{$header}}',
                "value": '{{$value[0]}}',
            },
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
        chart1.write("conveyance_chart");
    });
    @endif

</script>
<script>
    var chart1;
    var legend;

            @if($conveyanceDashboard[1])
    var chartData1 = [
                    @foreach($conveyanceDashboard[1] as $header => $value)     {
                "status": '{{$header}}',
                "value": '{{$value[0]}}',
            },
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
        chart1.write("pending_conveyance_chart");
    });
@endif


@endsection
