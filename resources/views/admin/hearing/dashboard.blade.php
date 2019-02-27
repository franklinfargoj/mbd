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

    <div class="container-fluid">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Dashboard</h3>
            </div>
        </div>

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

        </div>

        <div class="d-flex flex-wrap db-wrapper">
            <div class="db__card hearing_summary" data-module="Hearing Summary">
                <div class="db__card__img-wrap db-color-1">
                    <h3 class="db__card__count">{{$hearing_count}}</h3>
                </div>
                <p class="db__card__title">Hearing Summary</p>
            </div>

            @if(in_array(session()->get('role_name'),$conveyanceRoles))
                    <div class="db__card conveyance" data-module = "Society Conveyance">
                        <div class="db__card__img-wrap db-color-3">
                            <h3 class="db__card__count">{{$conveyance_count}}</h3>
                        </div>
                        <p class="db__card__title">Society Conveyance</p>
                    </div>

                        <div class="db__card conveyance_pending" data-module = "Society Conveyance Subordinate Pendency">
                            <div class="db__card__img-wrap db-color-6">
                                <h3 class="db__card__count">{{$conveyance_pending_count}}</h3>
                            </div>
                            <p class="db__card__title">Society Conveyance Subordinate Pendency</p>
                        </div>
            @endif
            @if(in_array(session()->get('role_name'),$renewalRoles))
                    <div class="db__card renewal" data-module = "Society Renewal">
                        <div class="db__card__img-wrap db-color-4">
                            <h3 class="db__card__count">{{$renewal_count}}</h3>
                        </div>
                        <p class="db__card__title">Society Renewal</p>
                    </div>
                        <div class="db__card renewal_pending" data-module = "Society Renewal Subordinate Pendency">
                            <div class="db__card__img-wrap db-color-5">
                                <h3 class="db__card__count">{{$renewal_pending_count}}</h3>
                            </div>
                            <p class="db__card__title">Society Renewal Subordinate Pendency</p>
                        </div>
            @endif

        </div>


    <!-- Modal for count table and pie chart popup -->
        <div class="modal fade" id="getCodeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style=" width: 150%;
  height: 160%;
  margin: 5% 10% 0 10%;
  padding: 0;">
                <div class="modal-content" style=" width: 250%;
  height: 50%;
  margin: 0;
  padding: 0;">
                    <div style="float:left">
                        <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body" id="count_table" >

                    </div>
                </div>
            </div>
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
                    <div class="modal-body" id="pending_applications">

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
                    <div class="modal-body" id="sent_to_society">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
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
        } else {
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

    {{--ajax call for Count Table and Pie chart(hearing summary)--}}
    <script>
        var dashboard = "{{route('hearing.dashboard.ajax')}}";
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
                        $("#getCodeModal").modal('show');

                    }
                    else {
                        alert('errror');
                    }
                },
            });

        });

    </script>
    {{--end ajax call for Count Table and Pie chart(hearing summary)--}}

    {{--ajax call for Count Table and Pie chart(conveyance)--}}
    <script>
        var dashboard = "{{route('hearing.dashboard.ajax')}}";
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

                        if (data[1]) {
                            var html_pending = "";
                            html_pending +=
                                "                            <div class=\"table-responsive m-portlet__body--table\">\n" +
                                "                                <table class=\"table text-center\">\n" +
                                "                                    <thead class=\"thead-default\">\n" +
                                "                                        <tr>\n" +
                                "                                            <th>Header</th>\n" +
                                "                                            <th>Count</th>\n" +
                                "                                        </tr>\n" +
                                "                                    </thead>\n" +
                                "                                    <tbody id=\"pending_applications\">\n";

                            $.each(data[1], function (index, data) {
                                html_pending += " <tr>\n" +
                                    "                                            <td>" + index + " </td>\n" +
                                    "                                            <td>" + data + "</td>\n" +
                                    "                                        </tr>";
                            });

                            html_pending += "                                    </tbody>\n" +
                                "                                </table>\n" +
                                "                            </div>\n";

                            $('#pending_applications').html(html_pending);
                        }
                        if (data[2]) {
                            var html_sent_to_society = "";
                            html_sent_to_society +=
                                "                            <div class=\"table-responsive m-portlet__body--table\">\n" +
                                "                                <table class=\"table text-center\">\n" +
                                "                                    <thead class=\"thead-default\">\n" +
                                "                                        <tr>\n" +
                                "                                            <th>Header</th>\n" +
                                "                                            <th>Count</th>\n" +
                                "                                        </tr>\n" +
                                "                                    </thead>\n" +
                                "                                    <tbody id=\"pending_applications\">\n";

                            $.each(data[2], function (index, data) {
                                html_sent_to_society += " <tr>\n" +
                                    "                                            <td>" + index + " </td>\n" +
                                    "                                            <td>" + data + "</td>\n" +
                                    "                                        </tr>";
                            });

                            html_sent_to_society += "                                    </tbody>\n" +
                                "                                </table>\n" +
                                "                            </div>\n";

                            $('#sent_to_society').html(html_sent_to_society);

                        }

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
                        $("#getCodeModal").modal('show');

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
        var dashboard = "{{route('hearing.dashboard.ajax')}}";
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
                        $("#getCodeModal").modal('show');

                    }
                    else {
                        alert('errror');
                    }
                },
            });

        });

    </script>
    {{--end ajax call for Pendency Count Table and Pie chart(conveyance)--}}

    {{--ajax call for Count Table and Pie chart(renewal)--}}
    <script>
        var dashboard = "{{route('hearing.dashboard.ajax')}}";
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

                        if (data[1]) {
                            var html_pending = "";
                            html_pending +=
                                "                            <div class=\"table-responsive m-portlet__body--table\">\n" +
                                "                                <table class=\"table text-center\">\n" +
                                "                                    <thead class=\"thead-default\">\n" +
                                "                                        <tr>\n" +
                                "                                            <th>Header</th>\n" +
                                "                                            <th>Count</th>\n" +
                                "                                        </tr>\n" +
                                "                                    </thead>\n" +
                                "                                    <tbody id=\"pending_applications\">\n";

                            $.each(data[1], function (index, data) {
                                html_pending += " <tr>\n" +
                                    "                                            <td>" + index + " </td>\n" +
                                    "                                            <td>" + data + "</td>\n" +
                                    "                                        </tr>";
                            });

                            html_pending += "                                    </tbody>\n" +
                                "                                </table>\n" +
                                "                            </div>\n";

                            $('#pending_applications').html(html_pending);
                        }
                        if (data[2]) {
                            var html_sent_to_society = "";
                            html_sent_to_society +=
                                "                            <div class=\"table-responsive m-portlet__body--table\">\n" +
                                "                                <table class=\"table text-center\">\n" +
                                "                                    <thead class=\"thead-default\">\n" +
                                "                                        <tr>\n" +
                                "                                            <th>Header</th>\n" +
                                "                                            <th>Count</th>\n" +
                                "                                        </tr>\n" +
                                "                                    </thead>\n" +
                                "                                    <tbody id=\"pending_applications\">\n";

                            $.each(data[2], function (index, data) {
                                html_sent_to_society += " <tr>\n" +
                                    "                                            <td>" + index + " </td>\n" +
                                    "                                            <td>" + data + "</td>\n" +
                                    "                                        </tr>";
                            });

                            html_sent_to_society += "                                    </tbody>\n" +
                                "                                </table>\n" +
                                "                            </div>\n";

                            $('#sent_to_society').html(html_sent_to_society);

                        }
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
                        $("#getCodeModal").modal('show');

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
        var dashboard = "{{route('hearing.dashboard.ajax')}}";
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
                        $("#getCodeModal").modal('show');

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
