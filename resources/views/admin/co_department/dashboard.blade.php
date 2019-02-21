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
        $chart4 = 0;
        $chart5 = 0;
        $chart6 = 0;
    @endphp


    <div class="container-fluid">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Dashboard</h3>
            </div>
        </div>

        {{--Todays Hearing--}}
        <div class="hearing-accordion-wrapper">

            <div class="m-portlet m-portlet--compact hearing-accordion mb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100 collapsed"
                       data-toggle="collapse" href="#todays-hearing">
                        <span class="form-accordion-title">Today's Hearing ({{$todays_hearing_count}})</span>
                        @if($todaysHearing)
                            <span class="hearing-accordion-icon"></span>
                        @endif
                    </a>
                </div>
            </div>

            @if($todays_hearing_count)
            <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="todays-hearing"
                 data-parent="#accordion">
                @foreach($todaysHearing as $hearing)
                    <div class="row no-gutters hearing-row">
                        <div class="col-12 no-shadow">
                            <div class="app-card-section-title">Today's Hearing</div>
                        </div>
                        <div class="col-lg-3">
                            <div class="m-portlet app-card text-center">
                                <h2 class="app-heading">Case Year</h2>
                                <h2 class="app-no mb-0">{{$hearing['case_year']}}</h2>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="m-portlet app-card text-center">
                                <h2 class="app-heading">Case NO</h2>
                                <h2 class="app-no mb-0">{{$hearing['id']}}</h2>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="m-portlet app-card text-center">
                                <h2 class="app-heading">Hearing Time</h2>
                                <h2 class="app-no mb-0">{{$hearing['hearing_schedule']['preceding_time']}}</h2>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="m-portlet app-card text-center">
                                <h2 class="app-heading">Applicant Name</h2>
                                <h2 class="app-no mb-0">{{$hearing['applicant_name']}}</h2>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="m-portlet app-card text-center">
                                <a href="{{route('hearing.show',encrypt($hearing['id']))}}" class="app-no app-no--view mb-0">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
        {{--End Todays Hearing--}}

        <div class="d-flex flex-wrap db-wrapper">
            <div class="db__card hearing_summary" data-module="Hearing Summary">
                <div class="db__card__img-wrap db-color-1">
                    <h3 class="db__card__count">{{$hearingDashboardData['Total Number of Cases'][0]}}</h3>
                </div>
                <p class="db__card__title">Hearing Summary</p>
            </div>
            <div class="db__card offer_letter" data-module="Offer Letter">
                <div class="db__card__img-wrap db-color-2">
                    <h3 class="db__card__count">{{$dashboardData['Total Number of Applications'][0]}}</h3>
                </div>
                <p class="db__card__title">Offer Letter</p>
            </div>
            <div class="db__card pending_counts" data-module="Offer Letter Subordinate Pendency">
                <div class="db__card__img-wrap db-color-3">
                    <h3 class="db__card__count">{{$dashboardData1['Total Number of Applications']}}</h3>
                </div>
                <p class="db__card__title">Offer Letter Subordinate Pendency</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-4">
                    <h3 class="db__card__count">48</h3>
                </div>
                <p class="db__card__title">Tripartite Agreement</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-5">
                    <h3 class="db__card__count">48</h3>
                </div>
                <p class="db__card__title">Tripartite Agreement Subordinate Pendency</p>
            </div>
            <div class="db__card revalidation" data-module="Offer Letter Revalidation">
                <div class="db__card__img-wrap db-color-6">
                    <h3 class="db__card__count">{{$revalDashboardData['Total Number of Applications'][0]}}</h3>
                </div>
                <p class="db__card__title">Offer Letter Revalidation</p>
            </div>
            <div class="db__card revalidation_pending" data-module="Offer Letter Revalidation Subordinate Pendency">
                <div class="db__card__img-wrap db-color-7">
                    <h3 class="db__card__count">{{$revalDashboardData1['Total Number of Applications']}}</h3>
                </div>
                <p class="db__card__title">Offer Letter Revalidation Subordinate Pendency</p>
            </div>
            <div class="db__card conveyance" data-module="Society Conveyance">
                <div class="db__card__img-wrap db-color-8">
                    <h3 class="db__card__count">{{$conveyanceDashboard[0]['Total No of Applications'][0]}}</h3>
                </div>
                <p class="db__card__title">Society Conveyance</p>
            </div>
            <div class="db__card conveyance_pending" data-module="Society Conveyance Subordinate Pendency">
                <div class="db__card__img-wrap db-color-9">
                    <h3 class="db__card__count">{{$pendingApplications['Total Number of Applications']}}</h3>
                </div>
                <p class="db__card__title">Society Conveyance Subordinate Pendency</p>
            </div>
            <div class="db__card noc" data-module="NOC">
                <div class="db__card__img-wrap db-color-10" >
                    <h3 class="db__card__count">{{$nocApplication['app_data']['Total Number of Applications'][0]}}</h3>
                </div>
                <p class="db__card__title">NOC</p>
            </div>
            <div class="db__card noc_pending" data-module="NOC Subordinate Pendency">
                <div class="db__card__img-wrap db-color-11">
                    <h3 class="db__card__count">{{$nocApplication['pending_data']['Total Number of Applications']}}</h3>
                </div>
                <p class="db__card__title">NOC Subordinate Pendency</p>
            </div>
            <div class="db__card noc" data-module="NOC (CC)">
                <div class="db__card__img-wrap db-color-12">
                    <h3 class="db__card__count">{{$nocforCCApplication['app_data']['Total Number of Applications'][0]}}</h3>
                </div>
                <p class="db__card__title">NOC (CC)</p>
            </div>
            <div class="db__card noc_pending" data-module="NOC (CC) Subordinate Pendency">
                <div class="db__card__img-wrap db-color-13">
                    <h3 class="db__card__count">{{$nocforCCApplication['pending_data']['Total Number of Applications']}}</h3>
                </div>
                <p class="db__card__title">NOC (CC) Subordinate Pendency</p>
            </div>
            <div class="db__card revision" data-module="Revision in Layout">
                <div class="db__card__img-wrap db-color-14">
                    <h3 class="db__card__count">
                        {{$architect_data['total_no_of_layout']}}
                    </h3>
                </div>
                <p class="db__card__title">Revision in Layout</p>
            </div>
            <div class="db__card revision" data-module="Layout Approval">
                <div class="db__card__img-wrap db-color-15">
                    <h3 class="db__card__count">-</h3>
                </div>
                <p class="db__card__title">Layout Approval</p>
            </div>
            <div class="db__card revision" data-module="Layout Approval Pendency">
                <div class="db__card__img-wrap db-color-16">
                    <h3 class="db__card__count">-</h3>
                </div>
                <p class="db__card__title">Layout Approval Pendency</p>
            </div>
        </div>

        {{--Dashboard for Hearing Summary--}}
        <div id="count_table">
            <div class="m-subheader px-0 m-subheader--top">
                <div class="d-flex align-items-center">
                    <h3 class="m-subheader__title">Hearing Summary</h3>
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
                                @php $chart4 = 0; $i=1; @endphp
                                @foreach($hearingDashboardData as $header => $value)
                                    <tr>
                                        <td class="text-center">{{$i}}.</td>
                                        <td>{{$header}}</td>
                                        <td class="text-center"><span class="count-circle">{{$value[0]}}</span></td>
                                        <td>
                                            <a href='{{url('/hearing'.$value[1])}}' class="btn btn-action">View</a>

                                        </td>
                                    </tr>
                                    @php $chart4 += $value[0]; $i++;@endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if($chart4)
                    <div id="ajaxchartdiv" class="col-sm-5"></div>
                @endif
            </div>
        </div>
        {{--End Dashboard for Hearing Summary--}}


    </div>

    </div>

    <!-- Modal for application pending bifergation -->
    <div class="modal fade" id="pending" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pending Applications</h4>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <th>Header</th>
                            <th>Count</th>
                        </tr>
                        @if($conveyanceDashboard[1])
                            @foreach($conveyanceDashboard[1] as $header => $value)
                                <tr>
                                    <td> {{$header}} </td>
                                    <td> {{$value}} </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                    <!-- <p>Some text in the modal.</p> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                    <table>
                        <tr>
                            <th>Header</th>
                            <th>Count</th>
                        </tr>
                        @if($conveyanceDashboard[2])
                            @foreach($conveyanceDashboard[2] as $header => $value)
                                <tr>
                                    <td> {{$header}} </td>
                                    <td> {{$value}} </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                    <!-- <p>Some text in the modal.</p> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(".hearing-accordion").on("click", function () {
            var data = $('.hearing-accordion').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.hearing-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.hearing-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.hearing-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });
    </script>

    <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>


    {{--Hearing summary chart--}}
    @if($chart4)
        <script>
            var chart4;
            var legend;

            var chartData4 = [
                    @foreach($hearingDashboardData as $header => $value)
                    @if(!($header == 'Total Number of Cases'))
                {
                    "status": "{{$header}}",
                    "value": "{{$value[0]}}",
                },
                @endif
                @endforeach
            ];
            AmCharts.ready(function () {
                // PIE CHART
                chart4 = new AmCharts.AmPieChart();
                chart4.dataProvider = chartData4;
                chart4.theme = "light";
                chart4.labelRadius = -35;
                chart4.labelText = "[[percents]]%";
                chart4.titleField = "status";
                chart4.valueField = "value";
                chart4.outlineColor = "#FFFFFF";
                chart4.outlineAlpha = 0.8;
                chart4.outlineThickness = 2;
                chart4.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                // this makes the chart 3D
                chart4.depth3D = 15;
                chart4.angle = 30;
                chart4.fontSize = 15;

                // WRITE
                chart4.write("ajaxchartdiv");
            });
        </script>
    @endif
    {{--Hearing summary chart--}}


    {{--ajax call for Count Table and Pie chart(hearing summary)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.co')}}";
        $(".hearing_summary").on("click", function () {

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
                                "<a href=\""+baseUrl+"/hearing"+data[1]+"\"class=\"btn btn-action\">View</a>\n" +
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
                                if (index != 'Total Number of Cases') {
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
    {{--end ajax call for Count Table and Pie chart(hearing summary)--}}

    {{--ajax call for Count Table and Pie chart(offer letter)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.co')}}";
        $(".offer_letter").on("click", function () {

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
                                "<td class=\"text-center\">"+
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
        var dashboard = "{{route('dashboard.ajax.co')}}";
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
    {{--end ajax call Pendency Count Table and Pie chart(offer letter)--}}

    {{--ajax call for Count Table and Pie chart(revalidation)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.co')}}";
        $(".revalidation").on("click", function () {

            var reval_application = "{{route('co_applications.reval')}}";
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
                        $.each(data, function (index, data) {

//                                        console.log(data);

                            html += "<tr>\n" +
                                "<td class=\"text-center\">"+i+"</td>" +
                                "<td>"+index+"</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">"+data[0]+"</span></td>\n" +
                                "<td class=\"text-center\">";

                            if(data[1] == "pending"){

                                html += "<a href=\""+reval_application+"/"+data[1]+"\"class=\"btn btn-action\" data-toggle=\"modal\"\n" +
                                    "             data-target=\"#reeRevalPendingModal\">View</a>";
                            }
                            else{
                                html+= "<a href=\""+reval_application+data[1]+"\"class=\"btn btn-action\">View</a>\n";

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
                    }
                    else {
                        alert('errror');
                    }
                },
            });

        });

    </script>
    {{--end ajax call for Count Table and Pie chart(revalidation)--}}

    {{--ajax call for Pendency Count Table and Pie chart(revalidation)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.co')}}";
        $(".revalidation_pending").on("click", function () {

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
    {{--end ajax call for Pendency Count Table and Pie chart(revalidation)--}}

    {{--ajax call for Count Table and Pie chart(noc,noc-cc)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.co')}}";
        $(".noc").on("click", function () {

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
                                "<a href=\""+baseUrl+"/"+data[1]+"\"class=\"btn btn-action\">View</a>\n" +
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
    {{--end ajax call for Count Table and Pie chart(noc,noc-cc)--}}

    {{--ajax call for Count Table and Pie chart(noc,noc-cc)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.co')}}";
        $(".noc_pending").on("click", function () {

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
    {{--end ajax call for Count Table and Pie chart(noc,noc-cc)--}}

    {{--ajax call for Count Table and Pie chart(conveyance)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.co')}}";
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
        var dashboard = "{{route('dashboard.ajax.co')}}";
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

    {{--ajax call for Count Table and Pie chart(revision in layout,Layout Approval,Layout Approval Subordinate Pendency)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.co')}}";
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
    {{--end ajax call for Count Table and Pie chart(revision in layout,Layout Approval,Layout Approval Subordinate Pendency)--}}
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