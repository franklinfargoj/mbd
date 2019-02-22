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
    @php $chart = 0; $chart1 = 0; $chart2 = 0; $chart3 = 0; $chart4 = 0;
    @endphp
    <div class="container-fluid">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Dashboard</h3>
            </div>
        </div>

        <div class="d-flex flex-wrap db-wrapper">
            @if( !((session()->get('role_name') == config('commanConfig.junior_architect')) || (session()->get('role_name') == config('commanConfig.architect')) || (session()->get('role_name') == config('commanConfig.senior_architect'))))
                <div class="db__card counts"  data-module = "Offer Letter">
                    <div class="db__card__img-wrap db-color-1">
                        <h3 class="db__card__count">{{$dashboardData['Total Number of Applications'][0]}}</h3>
                    </div>
                    <p class="db__card__title">Offer Letter</p>
                </div>
                @if($dashboardData1)
                    <div class="db__card pending_counts" data-module = "Offer Letter Subordinate Pendency">
                        <div class="db__card__img-wrap db-color-2">
                            <h3 class="db__card__count">{{$dashboardData1['Total Number of Applications']}}</h3>
                        </div>
                        <p class="db__card__title">Offer Letter Subordinate Pendency</p>
                    </div>
                @endif
            @endif
            @if(in_array(session()->get('role_name'),$conveyanceRoles))
                @if($conveyanceDashboard)
                    <div class="db__card counts0" data-module = "Society Conveyance">
                        <div class="db__card__img-wrap db-color-3">
                            <h3 class="db__card__count">{{$conveyanceDashboard['0']['Total No of Applications'][0]}}</h3>
                        </div>
                        <p class="db__card__title">Society Conveyance</p>
                    </div>
                @endif
            @endif
                @if (in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'), config('commanConfig.vp_engineer'))))
                <div class="db__card revalidation" data-module="Offer Letter Revalidation">
                    <div class="db__card__img-wrap db-color-4">
                        <h3 class="db__card__count">{{$revalDashboardData['Total Number of Applications'][0]}}</h3>
                    </div>
                    <p class="db__card__title">Offer Letter Revalidation</p>
                </div>
                @endif
                @if(in_array(session()->get('role_name'),$renewalRoles))
                    @if($renewalDashboard)
                        <div class="db__card counts0" data-module = "Society Renewal">
                            <div class="db__card__img-wrap db-color-4">
                                <h3 class="db__card__count">{{$renewalDashboard[0]['Total No of Applications'][0]}}</h3>
                            </div>
                            <p class="db__card__title">Society Renewal</p>
                        </div>
                    @endif
                @endif

                @if((session()->get('role_name')==config('commanConfig.junior_architect'))||
                    (session()->get('role_name')==config('commanConfig.senior_architect')) ||
                    (session()->get('role_name')==config('commanConfig.architect')) ||
                    session()->get('role_name')==config('commanConfig.land_manager') ||
                    session()->get('role_name')==config('commanConfig.estate_manager') ||
                    in_array(session()->get('role_name'),array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head'))) ||
                    in_array(session()->get('role_name'),array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head'))) ||
                    in_array(session()->get('role_name'),array(config('commanConfig.co_engineer'))) ||
                    in_array(session()->get('role_name'),array(config('commanConfig.senior_architect_planner'))) ||
                    in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'))) ||
                    in_array(session()->get('role_name'),array(config('commanConfig.vp_engineer'))))

                    @if(!(session()->get('role_name')==config('commanConfig.cap_engineer')) || !(session()->get('role_name')==config('commanConfig.junior_architect')))
                    <div class="db__card revision" data-module="Revision in Layout">
                        <div class="db__card__img-wrap db-color-5">
                            <h3 class="db__card__count">
                                @if(in_array(session()->get('role_name'),array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head'))))
                                    {{$architect_data['total_no_of_appln_for_revision']}}
                                @elseif(in_array(session()->get('role_name'),array(config('commanConfig.vp_engineer'))))
                                    {{$architect_data['total_no_of_layout']}}
                                @elseif(in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'))))
                                    {{$architect_data['total_no_of_appln_for_approval']}}
                                @else
                                    -
                                @endif
                            </h3>
                        </div>
                        <p class="db__card__title">Revision in Layout</p>
                    </div>
                    @endif
                    @if(!(session()->get('role_name')==config('commanConfig.ee_junior_engineer')) || !(session()->get('role_name')==config('commanConfig.ee_deputy_engineer')))
                    <div class="db__card revision"  data-module="Layout Approval">
                        <div class="db__card__img-wrap db-color-5">
                            <h3 class="db__card__count">-</h3>
                        </div>
                        <p class="db__card__title">Layout Approval</p>
                    </div>
                    @endif

                        @if(session()->get('role_name')==config('commanConfig.junior_architect') ||
                                session()->get('role_name')==config('commanConfig.senior_architect') ||
                                session()->get('role_name')==config('commanConfig.architect')
                            )
                            <div class="db__card revision" data-module="Layout Approval Pendency">
                                <div class="db__card__img-wrap db-color-16">
                                    <h3 class="db__card__count">-</h3>
                                </div>
                                <p class="db__card__title">Layout Approval Pendency</p>
                            </div>

                            <div class="db__card revision" data-module="Appointing Architect">
                                <div class="db__card__img-wrap db-color-5">
                                    <h3 class="db__card__count">-</h3>
                                </div>
                                <p class="db__card__title">Appointing Architect</p>
                            </div>
                            <div class="db__card revision" data-module="Appointing Architect Subordinate Pendencies">
                                <div class="db__card__img-wrap db-color-5">
                                    <h3 class="db__card__count">-</h3>
                                </div>
                                <p class="db__card__title">Appointing Architect Subordinate Pendencies</p>
                            </div>
                        @endif
                @endif
        </div>

        {{--Dashboard for offer letter--}}
        @if( !((session()->get('role_name') == config('commanConfig.junior_architect')) || (session()->get('role_name') == config('commanConfig.architect')) || (session()->get('role_name') == config('commanConfig.senior_architect'))))
            {{--offer letter--}}
            <div id="count_table">
                <div class="m-subheader px-0 m-subheader--top">
                    <div class="d-flex align-items-center">
                        <h3 class="m-subheader__title">Offer Letter</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-7" >
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
                                                <a href="{{url(session()->get('redirect_to').$value[1])}}" class="btn btn-action">View</a>
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
                        <div class="col-sm-5" id="ajaxchartdiv">
                        </div>
                    @endif
                </div>
            </div>
        @endif
        {{--End Dashboard for offer letter--}}


        @if((session()->get('role_name')==config('commanConfig.junior_architect'))||
   (session()->get('role_name')==config('commanConfig.senior_architect')) ||
   (session()->get('role_name')==config('commanConfig.architect')))
            @include('admin.dashboard.appointing_architect.dashboard',compact('appointing_architect_data'))
            @include('admin.dashboard.architect_layout.partials.architect_dashboard',compact('architect_data'))
        @endif
        @if(session()->get('role_name')==config('commanConfig.estate_manager'))
            @include('admin.dashboard.architect_layout.partials.em_dashboard',compact('architect_data'))
        @endif
        @if(in_array(session()->get('role_name'),array(config('commanConfig.senior_architect_planner'))))
            @include('admin.dashboard.architect_layout.partials.sap_dashboard',compact('architect_data'))
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

            <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>

            {{--offer letter chart--}}
            @if($chart)
                <script>
                    var chart;
                    var chartData = [

                            @foreach($dashboardData as $header => $value)
                            @if($header != 'Total Number of Applications') {
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
                        chart.theme = "light";
                        chart.labelRadius = -35;
                        chart.labelText = "[[percents]]%";
                        chart.titleField = "status";
                        chart.valueField = "value";
                        chart.outlineColor = "#FFFFFF";
                        chart.outlineAlpha = 0.8;
                        chart.outlineThickness = 2;
                        chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                        // this makes the chart 3D
                        chart.depth3D = 15;
                        chart.angle = 30;
                        chart.fontSize = 15;

                        // WRITE
                        chart.write("ajaxchartdiv");
                    });

                </script>
            @endif
            {{--end offer letter chart--}}


            {{--ajax call for Count Table and Pie chart(offer letter)--}}
            <script>
                 var dashboard = "{{route('dashboard.ajax')}}";
                    $(".counts").on("click", function () {

                        var redirect_to = "{{session()->get('redirect_to')}}";
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
                                    $.each(data, function (index, data) {

                                        html += "<tr>\n" +
                                            "<td class=\"text-center\">"+i+"</td>" +
                                            "<td>"+index+"</td>\n" +
                                            "<td class=\"text-center\"><span class=\"count-circle\">"+data[0]+"</span></td>\n" +
                                            "<td>\n" +
                                            "<a href=\""+baseUrl+redirect_to+data[1]+"\"class=\"btn btn-action\">View</a>\n" +
                                            "</td>\n" +
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

                                        $.each((data), function (index, data) {
                                            obj = {};
                                            if (index != 'Total Number of Applications') {
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
            {{--end ajax call for Count Table and Pie chart(offer letter)--}}

            {{--ajax call for Pendency Count Table and Pie chart(offer letter)--}}
            <script>
                var dashboard = "{{route('dashboard.ajax')}}";
                $(".pending_counts").on("click", function () {

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

//                                        console.log(index);

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
            {{--end ajax call for Pendency Count Table and Pie chart(offer letter)--}}

            {{--ajax call for Count Table and Pie chart(conveyance)--}}
            <script>
                var dashboard = "{{route('dashboard.ajax')}}";
                $(".counts0").on("click", function () {

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

            {{--ajax call for Count Table and Pie chart(renewal)--}}
            <script>
                var dashboard = "{{route('dashboard.ajax')}}";
                $(".counts0").on("click", function () {

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


            {{--ajax call for Count Table and Pie chart(revalidation)--}}
            <script>
                var dashboard = "{{route('dashboard.ajax')}}";
                $(".revalidation").on("click", function () {

                    var role_applications = "{{(session()->get('role_name') == config('commanConfig.cap_engineer'))
                        ? route('cap_applications.reval')
                        : route('vp_applications.reval')}}";

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
                                $.each(data, function (index, data) {

                                    html += "<tr>\n" +
                                        "<td class=\"text-center\">"+i+"</td>" +
                                        "<td>"+index+"</td>\n" +
                                        "<td class=\"text-center\"><span class=\"count-circle\">"+data[0]+"</span></td>\n" +
                                        "<td>\n" +
                                        "<a href=\""+role_applications+data[1]+"\"class=\"btn btn-action\">View</a>\n" +
                                        "</td>\n" +
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
                                    var abcd;
                                    var legend;

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
                            }
                            else {
                                alert('errror');
                            }
                        },
                    });

                });

            </script>
            {{--end ajax call for Count Table and Pie chart(revalidation)--}}


            {{--ajax call for Count Table and Pie chart(revision in layout,Layout Approval)--}}
            <script>
                var dashboard = "{{route('dashboard.ajax')}}";
                $(".revision").on("click", function () {

                    var redirect_to = "{{session()->get('redirect_to')}}";
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
                                        "<td>\n" +
                                        "</td>\n" +
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
            {{--end ajax call for Count Table and Pie chart(revision in layout,Layout Approval)--}}

            @endsection
