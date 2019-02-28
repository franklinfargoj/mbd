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

        <div class="d-flex flex-wrap db-wrapper">
            <div class="db__card hearing_summary" data-module="Hearing Summary">
                <div class="db__card__img-wrap db-color-1">
                    <h3 class="db__card__count">{{$hearing_count}}</h3>
                </div>
                <p class="db__card__title">Hearing Summary</p>
            </div>
            <div class="db__card offer_letter" data-module="Offer Letter">
                <div class="db__card__img-wrap db-color-2">
                    <h3 class="db__card__count">{{$ol_count}}</h3>
                </div>
                <p class="db__card__title">Offer Letter</p>
            </div>
            <div class="db__card pending_counts" data-module="Offer Letter Department Pendency">
                <div class="db__card__img-wrap db-color-3">
                    <h3 class="db__card__count">{{$ol_pending_count}}</h3>
                </div>
                <p class="db__card__title">Offer Letter Department Pendency</p>
            </div>
            @if($tripartite_data['dashboardData'])
                <div class="db__card tripartite" data-module="Tripartite Agreement">
                    <div class="db__card__img-wrap db-color-3">
                        <h3 class="db__card__count">{{$tripartite_count}}</h3>
                    </div>
                    <p class="db__card__title">Tripartite Agreement</p>
                </div>
            @endif
            @if($tripartite_data['dashboardData_head'])
                <div class="db__card tripartite_pending" data-module="Tripartite Agreement Department Pendency">
                    <div class="db__card__img-wrap db-color-4">
                        <h3 class="db__card__count">{{$tripartite_pending_count}}</h3>
                    </div>
                    <p class="db__card__title">Tripartite Agreement Department Pendency</p>
                </div>
            @endif
            <div class="db__card revalidation" data-module="Offer Letter Revalidation">
                <div class="db__card__img-wrap db-color-6">
                    <h3 class="db__card__count">{{$ol_reval_count}}</h3>
                </div>
                <p class="db__card__title">Offer Letter Revalidation</p>
            </div>
            <div class="db__card revalidation_pending" data-module="Offer Letter Revalidation Department Pendency">
                <div class="db__card__img-wrap db-color-7">
                    <h3 class="db__card__count">{{$ol_reval_pending_count}}</h3>
                </div>
                <p class="db__card__title">Offer Letter Revalidation Department Pendency</p>
            </div>
            <div class="db__card conveyance" data-module="Society Conveyance">
                <div class="db__card__img-wrap db-color-8">
                    <h3 class="db__card__count">{{$conveyance_count}}</h3>
                </div>
                <p class="db__card__title">Society Conveyance</p>
            </div>
            <div class="db__card conveyance_pending" data-module="Society Conveyance Department Pendency">
                <div class="db__card__img-wrap db-color-9">
                    <h3 class="db__card__count">{{$conveyance_pending_count}}</h3>
                </div>
                <p class="db__card__title">Society Conveyance Department Pendency</p>
            </div>
            <div class="db__card noc" data-module="NOC">
                <div class="db__card__img-wrap db-color-10" >
                    <h3 class="db__card__count">{{$noc_count}}</h3>
                </div>
                <p class="db__card__title">NOC</p>
            </div>
            <div class="db__card noc_pending" data-module="NOC Department Pendency">
                <div class="db__card__img-wrap db-color-11">
                    <h3 class="db__card__count">{{$noc_pending_count}}</h3>
                </div>
                <p class="db__card__title">NOC Department Pendency</p>
            </div>
            <div class="db__card noc" data-module="NOC (CC)">
                <div class="db__card__img-wrap db-color-12">
                    <h3 class="db__card__count">{{$noc_cc_count}}</h3>
                </div>
                <p class="db__card__title">NOC (CC)</p>
            </div>
            <div class="db__card noc_pending" data-module="NOC (CC) Department Pendency">
                <div class="db__card__img-wrap db-color-13">
                    <h3 class="db__card__count">{{$noc_cc_pending_count}}</h3>
                </div>
                <p class="db__card__title">NOC (CC) Department Pendency</p>
            </div>
            <div class="db__card revision" data-module="Revision in Layout">
                <div class="db__card__img-wrap db-color-14">
                    <h3 class="db__card__count">-</h3>
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
    </div>


    <!-- Modal for count table and pie chart popup -->
    <div class="modal fade mhada-full-modal" id="getCodeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
                <div class="modal-body" id="count_table" >

                </div>
            </div>
        </div>
    </div>

    <!-- Modal for application pending bifurcation -->
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Model for send to society bifurcation-->
    <div class="modal fade" id="sendToSociety" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Applications Sent to Society</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="sent_to_society">
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
                        $("#getCodeModal").modal('show');

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
                        $("#getCodeModal").modal('show');

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
                        $("#getCodeModal").modal('show');

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
                        $("#getCodeModal").modal('show');

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
                        $("#getCodeModal").modal('show');

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
                        $("#getCodeModal").modal('show');

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
                        $("#getCodeModal").modal('show');

                    }
                    else {
                        alert('errror');
                    }
                },
            });

        });

    </script>
    {{--end ajax call for Count Table and Pie chart(revision in layout,Layout Approval,Layout Approval Subordinate Pendency)--}}

    {{--ajax call for Count Table and Pie chart(tripartite)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.co')}}";
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
                        $.each(data[0], function (index, data) {

//                                        console.log(data);

                            html += "<tr>\n" +
                                "<td class=\"text-center\">"+i+"</td>" +
                                "<td>"+index+"</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">"+data[0]+"</span></td>\n" +
                                "<td class=\"text-center\">";

                            if(data[1] == "pending"){

                                html += "<a href=\""+tripartite_application+data[1]+"\"class=\"btn btn-action\" data-toggle=\"modal\"\n" +
                                    "             data-target=\"#pending\">View</a>";
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

//                                    console.log(data[1]);

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
                        $('#count_table').html(html);


                        if(chart_count){

                            var chartData = [];
                            $.each((data[0]), function (index, data) {
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

    {{--ajax call for Pendency Count Table and Pie chart(tripartite)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.co')}}";
        $(".tripartite_pending").on("click", function () {

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
                            "                                    <thead class=\"thead-default\">\n" +
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
    {{--end ajax call for Pendency Count Table and Pie chart(tripartite)--}}

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