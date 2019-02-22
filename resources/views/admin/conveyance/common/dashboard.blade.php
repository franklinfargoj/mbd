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

            @if(session()->get('role_name') == config('commanConfig.dyco_engineer'))
                @if($pendingApplications)
                    <div class="db__card conveyance_pending" data-module = "Society Conveyance Subordinate Pendency">
                        <div class="db__card__img-wrap db-color-6">
                            <h3 class="db__card__count">{{$pendingApplications['Total Number of Applications']}}</h3>
                        </div>
                        <p class="db__card__title">Society Conveyance Subordinate Pendency</p>
                    </div>
                @endif
            @endif


            @if(session()->get('role_name') == config('commanConfig.la_engineer'))
                @if($tripartite_data['dashboardData'])
                    <div class="db__card tripartite" data-module="Tripartite Agreement">
                        <div class="db__card__img-wrap db-color-2">
                            <h3 class="db__card__count">{{$tripartite_data['dashboardData'][0]['Total Number of Applications'][0]}}</h3>
                        </div>
                        <p class="db__card__title">Tripartite Agreement</p>
                    </div>
                @endif
            @endif
                @endif

                @if(in_array(session()->get('role_name'),$renewalRoles))
                    @if($renewalDashboard)
                        <div class="db__card renewal" data-module = "Society Renewal">
                            <div class="db__card__img-wrap db-color-4">
                                <h3 class="db__card__count">{{$renewalDashboard[0]['Total No of Applications'][0]}}</h3>
                            </div>
                            <p class="db__card__title">Society Renewal</p>
                        </div>
                    @endif


                        @if(session()->get('role_name') == config('commanConfig.dyco_engineer'))

                        @if($renewalPendingApplications)
                            <div class="db__card renewal_pending" data-module = "Society Renewal Subordinate Pendency">
                                <div class="db__card__img-wrap db-color-5">
                                    <h3 class="db__card__count">{{$renewalPendingApplications['Total Number of Applications']}}</h3>
                                </div>
                                <p class="db__card__title">Society Renewal Subordinate Pendency</p>
                            </div>
                        @endif
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
    @if(session()->get('role_name')==config('commanConfig.estate_manager'))
    @include('admin.dashboard.architect_layout.partials.em_dashboard',compact('data'))
    @endif
    @if(in_array(session()->get('role_name'),array(config('commanConfig.senior_architect_planner'))))
    @include('admin.dashboard.architect_layout.partials.sap_dashboard',compact('data'))
    @endif

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

    <!-- Model for conveyance send to society bifergation-->
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

    @if(session()->get('role_name') == 'la_engineer')
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
    @endif

@endsection
@section('js')

    <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>

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

    {{--ajax call for Pendency Count Table and Pie chart(conveyance)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.conveyance')}}";
        $(".conveyance_pending").on("click", function () {

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
                            "                                    </thead>\n" +
                            "                                    </tbody>\n" ;

                        var chart_count = 0 ;
                        var i = 1 ;
                        $.each(data, function (index, data) {

                            html += "<tr>\n" +
                                "<td class=\"text-center\">"+i+"</td>" +
                                "<td>"+index+"</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">"+data+"</span></td>\n" +
                                "</tr>";

                            chart_count += data;
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
                            $.each((data), function (index, data) {
                                obj = {};
                                if (index != 'Total Number of Applications') {
                                    obj['status'] = index;
                                    obj['value'] = data;
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
    {{--end ajax call for Pendency Count Table and Pie chart(conveyance)--}}

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

    {{--ajax call for Count Table and Pie chart(renewal)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.conveyance')}}";
        $(".renewal").on("click", function () {

            var redirect_to = "{{session()->get('redirect_to')}}";
//                        var module_name = ($('.counts').data("module"));
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

//                                        console.log(data);

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

//                                    alert(chart_count);
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
                    }
                    else {
                        alert('errror');
                    }
                },
            });

        });

    </script>
    {{--end ajax call for Count Table and Pie chart(renewal)--}}

    {{--ajax call for Pendency Count Table and Pie chart(renewal)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.conveyance')}}";
        $(".renewal_pending").on("click", function () {

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
                            "                                    </thead>\n" +
                            "                                    </tbody>\n" ;

                        var chart_count = 0 ;
                        var i = 1 ;
                        $.each(data, function (index, data) {

                            html += "<tr>\n" +
                                "<td class=\"text-center\">"+i+"</td>" +
                                "<td>"+index+"</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">"+data+"</span></td>\n" +
                                "</tr>";

                            chart_count += data;
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
                            $.each((data), function (index, data) {
                                obj = {};
                                if (index != 'Total Number of Applications') {
                                    obj['status'] = index;
                                    obj['value'] = data;
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
    {{--end ajax call for Pendency Count Table and Pie chart(renewal)--}}


@endsection
