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
    <div class="container-fluid mhada-dash-new">

        @if($ol_count != null  ||
        $ol_pending_count != null ||
        $oc_count != null ||
        $oc_pending_count != null ||
        $reval_count != null)
            <div class="d-flex flex-wrap db-wrapper">
                {{--@php dd($ol_count || ($dashboardData1 != null) || $oc_count || $oc_pending_count || $reval_count ); @endphp--}}
                <div class="m-subheader px-0 m-subheader--top col-sm-12 mb-3">
                    <div class="d-flex align-items-center">
                        <h3 class="m-subheader__title">Redevelopment</h3>
                    </div>
                </div>
                @if(in_array(session()->get('role_name'),$offerLetterRoles))
                    {{--                @if( !((session()->get('role_name') == config('commanConfig.junior_architect')) || (session()->get('role_name') == config('commanConfig.architect')) || (session()->get('role_name') == config('commanConfig.senior_architect'))))--}}
                    <div class="db__card counts" data-module="Offer Letter">
                        <div class="db__card__img-wrap db-color-1">
                            <h3 class="db__card__count">{{$ol_count}}</h3>
                        </div>
                        <p class="db__card__title">Offer Letter</p>
                    </div>
                    @if($dashboardData1)
                        <div class="db__card pending_counts" data-module="Offer Letter Subordinate Pendency">
                            <div class="db__card__img-wrap db-color-2">
                                <h3 class="db__card__count">{{$ol_pending_count}}</h3>
                            </div>
                            <p class="db__card__title">Offer Letter Subordinate Pendency</p>
                        </div>
                    @endif
                    {{--@endif--}}
                @endif
                @if(in_array(session()->get('role_name'),array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head'))))
                    <div class="db__card consent_oc" data-module="Consent for OC">
                        <div class="db__card__img-wrap db-color-2">
                            <h3 class="db__card__count">{{$oc_count}}</h3>
                        </div>
                        <p class="db__card__title">Consent for OC</p>
                    </div>
                    @if(session()->get('role_name') == config('commanConfig.ee_branch_head'))
                        <div class="db__card consent_oc_pendency" data-module="Consent for OC Subordinate Pendency">
                            <div class="db__card__img-wrap db-color-4">
                                <h3 class="db__card__count">{{$oc_pending_count}}</h3>
                            </div>
                            <p class="db__card__title">Consent for OC Subordinate Pendency</p>
                        </div>
                    @endif
                @endif
                @if (in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'), config('commanConfig.vp_engineer'))))
                    <div class="db__card revalidation" data-module="Offer Letter Revalidation">
                        <div class="db__card__img-wrap db-color-4">
                            <h3 class="db__card__count">{{$reval_count}}</h3>
                        </div>
                        <p class="db__card__title">Offer Letter Revalidation</p>
                    </div>
                @endif
            </div>
        @endif

        @if($conveyance_count != null ||
        $conveyance_pending_count != null ||
        $renewal_count != null ||
        $renewal_pending_count != null )
            <div class="d-flex flex-wrap db-wrapper">
                <div class="m-subheader px-0 m-subheader--top col-sm-12 mb-3">
                    <div class="d-flex align-items-center">
                        <h3 class="m-subheader__title">Estate & Conveyance</h3>
                    </div>
                </div>
                @if(in_array(session()->get('role_name'),$conveyanceRoles))
                    <div class="db__card conveyance" data-module="Society Conveyance">
                        <div class="db__card__img-wrap db-color-3">
                            <h3 class="db__card__count">{{$conveyance_count}}</h3>
                        </div>
                        <p class="db__card__title">Society Conveyance</p>
                    </div>
                @endif

                @if(in_array(session()->get('role_name'),$renewalRoles))
                    <div class="db__card counts0" data-module="Society Renewal">
                        <div class="db__card__img-wrap db-color-4">
                            <h3 class="db__card__count">{{$renewal_count}}</h3>
                        </div>
                        <p class="db__card__title">Society Renewal</p>
                    </div>
                @endif
            </div>
        @endif

        @if($appointing_count != null ||
        $architect_layout_counts != null)
            <div class="d-flex flex-wrap db-wrapper">
                <div class="m-subheader px-0 m-subheader--top col-sm-12 mb-3">
                    <div class="d-flex align-items-center">
                        <h3 class="m-subheader__title">Architect</h3>
                    </div>
                </div>
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

                    @if(!((session()->get('role_name')==config('commanConfig.cap_engineer'))
                    || (session()->get('role_name')==config('commanConfig.junior_architect'))
                    || (session()->get('role_name')==config('commanConfig.senior_architect'))
                    || (session()->get('role_name')==config('commanConfig.architect')))
                    || (session()->get('role_name')==config('commanConfig.estate_manager'))
                    )
                        <div class="db__card revision" data-module="Revision in Layout">
                            <div class="db__card__img-wrap db-color-5">
                                <h3 class="db__card__count">{{$architect_layout_counts}}
                                </h3>
                            </div>
                            <p class="db__card__title">Revision in Layout</p>
                        </div>
                    @endif
                    @if(!((session()->get('role_name')==config('commanConfig.ee_junior_engineer')) || (session()->get('role_name')==config('commanConfig.ee_deputy_engineer'))))
                        <div class="db__card revision" data-module="Layout Approval">
                            <div class="db__card__img-wrap db-color-5">
                                <h3 class="db__card__count">{{$architect_layout_counts}}</h3>
                            </div>
                            <p class="db__card__title">Layout Approval</p>
                        </div>
                    @endif

                    @if(session()->get('role_name')==config('commanConfig.junior_architect') ||
                    session()->get('role_name')==config('commanConfig.senior_architect') ||
                    session()->get('role_name')==config('commanConfig.architect')
                    )
                        <div class="db__card appointing_architect" data-module="Appointing Architect">
                            <div class="db__card__img-wrap db-color-5">
                                <h3 class="db__card__count">{{$appointing_count}}</h3>
                            </div>
                            <p class="db__card__title">Appointing Architect</p>
                        </div>

                        @if(session()->get('role_name')==config('commanConfig.architect'))
                            <div class="db__card revision" data-module="Layout Approval Department Pendency">
                                <div class="db__card__img-wrap db-color-16">
                                    <h3 class="db__card__count">{{$architect_layout_counts}}</h3>
                                </div>
                                <p class="db__card__title">Layout Approval Department Pendency</p>
                            </div>
                            <div class="db__card revision" data-module="Layout Approval Subordinate Pendencies">
                                <div class="db__card__img-wrap db-color-16">
                                    <h3 class="db__card__count">{{$architect_layout_counts}}</h3>
                                </div>
                                <p class="db__card__title">Layout Approval Subordinate Pendencies</p>
                            </div>

                            <div class="db__card appointing_architect no-margin-sm"
                                 data-module="Appointing Architect Subordinate Pendency">
                                <div class="db__card__img-wrap db-color-5">
                                    <h3 class="db__card__count">{{$appointing_count}}</h3>
                                </div>
                                <p class="db__card__title">Appointing Architect Subordinate Pendency</p>
                            </div>
                        @endif
                    @endif
                @endif
            </div>
        @endif

    </div>
@endsection

@section('js')

    <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>


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
                data: {module_name: module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {

                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">" + module_name + "</h3>\n" +
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
                            "                                    </tbody>\n";

                        var chart_count = 0;
                        var i = 1;
                        $.each(data, function (index, data) {

                            html += "<tr>\n" +
                                "<td class=\"text-center\">" + i + "</td>" +
                                "<td>" + index + "</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">" + data[0] + "</span></td>\n" +
                                "<td>\n" +
                                "<a href=\"" + baseUrl + redirect_to + data[1] + "\"class=\"btn btn-action\">View</a>\n" +
                                "</td>\n" +
                                "</tr>";
                            chart_count += data[0];
                            i++;
                        });

                        html += "</tbody>\n" +
                            "                                </table>\n" +
                            "                        </div>\n" +
                            "                    </div>" +
                            "                   </div>\n" +
                            "                        <div class=\"col-sm-5\" id=\"ajaxchartdiv\">\n" +
                            "                        </div>\n" +
                            "                </div>\n" +
                            "            </div>";

                        $('#count_table').html(html);

                        if (chart_count) {

                            var chartData = [];

                            $.each((data), function (index, data) {
                                obj = {};
                                if (index != 'Total Number of Applications') {
                                    obj['status'] = index;
                                    obj['value'] = data[0];
                                    chartData.push(obj);
                                }

                            });

                            var chart = AmCharts.makeChart("ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider": chartData,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor": "#FFFFFF",
                                "outlineThickness": 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize": 15,
                            });
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
                data: {module_name: module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {

                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">" + module_name + "</h3>\n" +
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
                            "                                    </tbody>\n";

                        var chart_count = 0;
                        var i = 1;
                        $.each(data, function (index, data) {

//                                        console.log(index);

                            html += "<tr>\n" +
                                "<td class=\"text-center\">" + i + "</td>" +
                                "<td>" + index + "</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">" + data + "</span></td>\n" +
                                "</tr>";
                            chart_count += data;
                            i++;
                        });

                        html += "</tbody>\n" +
                            "                                </table>\n" +
                            "                        </div>\n" +
                            "                    </div>" +
                            "                   </div>\n" +
                            "                        <div class=\"col-sm-5\" id=\"ajaxchartdiv\">\n" +
                            "                        </div>\n" +
                            "                </div>\n" +
                            "            </div>";

                        $('#count_table').html(html);


                        if (chart_count) {

                            var chartData = [];

                            $.each((data), function (index, data) {
                                obj = {};
                                if (index != 'Total Number of Applications') {
                                    obj['status'] = index;
                                    obj['value'] = data;
                                    chartData.push(obj);
                                }

                            });

                            var chart = AmCharts.makeChart("ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider": chartData,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor": "#FFFFFF",
                                "outlineThickness": 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize": 15,
                            });
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
    {{--end ajax call for Pendency Count Table and Pie chart(offer letter)--}}

    {{--ajax call for Count Table and Pie chart(conveyance)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax')}}";
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
                data: {module_name: module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {

                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">" + module_name + "</h3>\n" +
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
                            "                                    </tbody>\n";

                        var chart_count = 0;
                        var i = 1;
                        $.each(data[0], function (index, data) {

                            html += "<tr>\n" +
                                "<td class=\"text-center\">" + i + "</td>" +
                                "<td>" + index + "</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">" + data[0] + "</span></td>\n" +
                                "<td class=\"text-center\">";

                            if (data[1] == "pending") {

                                html += "<a href=\"" + baseUrl + "/" + data[1] + "\"class=\"btn btn-action\" data-toggle=\"modal\"\n" +
                                    "             data-target=\"#pending\">View</a>";
                            }
                            else if (data[1] == "sendToSociety") {
                                html += "<a href=\"" + baseUrl + "/" + data[1] + "\"class=\"btn btn-action\" data-toggle=\"modal\"\n" +
                                    "             data-target=\"#sendToSociety\">View</a>";
                            }
                            else {
                                html += "<a href=\"" + baseUrl + "/" + data[1] + "\"class=\"btn btn-action\">View</a>\n";

                            }
                            html += "</td>\n" +
                                "</tr>";

                            chart_count += data[0];
                            i++;
                        });

                        html += "</tbody>\n" +
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

                        if (chart_count) {

                            var chartData = [];
                            $.each((data[0]), function (index, data) {
                                obj = {};
                                if (index != 'Total No of Applications') {
                                    obj['status'] = index;
                                    obj['value'] = data[0];
                                    chartData.push(obj);
                                }

                            });

                            var chart = AmCharts.makeChart("ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider": chartData,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor": "#FFFFFF",
                                "outlineThickness": 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize": 15,
                            });
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
                data: {module_name: module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {


                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">" + module_name + "</h3>\n" +
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
                            "                                    </tbody>\n";

                        var chart_count = 0;
                        var i = 1;
                        $.each(data[0], function (index, data) {

//                                        console.log(data);

                            html += "<tr>\n" +
                                "<td class=\"text-center\">" + i + "</td>" +
                                "<td>" + index + "</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">" + data[0] + "</span></td>\n" +
                                "<td class=\"text-center\">";

                            if (data[1] == "pending") {

                                html += "<a href=\"" + baseUrl + "/" + data[1] + "\"class=\"btn btn-action\" data-toggle=\"modal\"\n" +
                                    "             data-target=\"#pending\">View</a>";
                            }
                            else if (data[1] == "sendToSociety") {
                                html += "<a href=\"" + baseUrl + "/" + data[1] + "\"class=\"btn btn-action\" data-toggle=\"modal\"\n" +
                                    "             data-target=\"#sendToSociety\">View</a>";
                            }
                            else {
                                html += "<a href=\"" + baseUrl + "/" + data[1] + "\"class=\"btn btn-action\">View</a>\n";

                            }
                            html += "</td>\n" +
                                "</tr>";

                            chart_count += data[0];
                            i++;
                        });

                        html += "</tbody>\n" +
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


//                                    alert(chart_count);
                        $('#count_table').html(html);


                        if (chart_count) {

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

                            var chart = AmCharts.makeChart("ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider": chartData,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor": "#FFFFFF",
                                "outlineThickness": 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize": 15,
                            });
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
                data: {module_name: module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {

                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">" + module_name + "</h3>\n" +
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
                            "                                    </tbody>\n";

                        var chart_count = 0;
                        var i = 1;
                        $.each(data, function (index, data) {

                            html += "<tr>\n" +
                                "<td class=\"text-center\">" + i + "</td>" +
                                "<td>" + index + "</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">" + data[0] + "</span></td>\n" +
                                "<td>\n" +
                                "<a href=\"" + role_applications + data[1] + "\"class=\"btn btn-action\">View</a>\n" +
                                "</td>\n" +
                                "</tr>";
                            chart_count += data[0];
                            i++;
                        });

                        html += "</tbody>\n" +
                            "                                </table>\n" +
                            "                        </div>\n" +
                            "                    </div>" +
                            "                   </div>\n" +
                            "                        <div class=\"col-sm-5\" id=\"ajaxchartdiv\">\n" +
                            "                        </div>\n" +
                            "                </div>\n" +
                            "            </div>";

                        $('#count_table').html(html);


                        if (chart_count) {
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

                            var chart = AmCharts.makeChart("ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider": chartData,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor": "#FFFFFF",
                                "outlineThickness": 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize": 15,
                            });
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
                data: {module_name: module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {
                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">" + module_name + "</h3>\n" +
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
                            "                                    </tbody>\n";

                        var chart_count = 0;
                        var i = 1;
                        $.each(data, function (index, data) {

                            html += "<tr>\n" +
                                "<td class=\"text-center\">" + i + "</td>" +
                                "<td>" + index + "</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">" + data + "</span></td>\n" +
                                "<td>\n" +
                                "</td>\n" +
                                "</tr>";
                            chart_count += data;
                            i++;
                        });

                        html += "</tbody>\n" +
                            "                                </table>\n" +
                            "                        </div>\n" +
                            "                    </div>" +
                            "                   </div>\n" +
                            "                        <div class=\"col-sm-5\" id=\"ajaxchartdiv\">\n" +
                            "                        </div>\n" +
                            "                </div>\n" +
                            "            </div>";

                        $('#count_table').html(html);

                        if (chart_count) {

                            var chartData = [];

                            $.each((data), function (index, data) {
                                obj = {};
                                if (index != 'Total Number of Applications') {
                                    obj['status'] = index;
                                    obj['value'] = data;
                                    chartData.push(obj);
                                }

                            });

                            var chart = AmCharts.makeChart("ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider": chartData,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor": "#FFFFFF",
                                "outlineThickness": 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize": 15,
                            });
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
    {{--end ajax call for Count Table and Pie chart(revision in layout,Layout Approval)--}}


    {{--ajax call for Count Table and Pie chart(appointing_architect)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax')}}";
        $(".appointing_architect").on("click", function () {

            var module_name = ($(this).attr("data-module"));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: dashboard,
                data: {module_name: module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {

                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">" + module_name + "</h3>\n" +
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
                            "                                    </tbody>\n";

                        var chart_count = 0;
                        var i = 1;
                        $.each(data, function (index, data) {

                            html += "<tr>\n" +
                                "<td class=\"text-center\">" + i + "</td>" +
                                "<td>" + index + "</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">" + data + "</span></td>\n" +
                                "</tr>";
                            chart_count += data;
                            i++;
                        });

                        html += "</tbody>\n" +
                            "                                </table>\n" +
                            "                        </div>\n" +
                            "                    </div>" +
                            "                   </div>\n" +
                            "                        <div class=\"col-sm-5\" id=\"ajaxchartdiv\">\n" +
                            "                        </div>\n" +
                            "                </div>\n" +
                            "            </div>";

                        $('#count_table').html(html);


                        if (chart_count) {
                            var abcd;
                            var legend;

                            var chartData = [];

                            $.each((data), function (index, data) {
                                obj = {};
                                if (index != 'Total Number of Applications') {
                                    obj['status'] = index;
                                    obj['value'] = data;
                                    chartData.push(obj);
                                }

                            });
//                                        console.log(chartData);

                            var chart = AmCharts.makeChart("ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider": chartData,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor": "#FFFFFF",
                                "outlineThickness": 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize": 15,
                            });
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
    {{--end ajax call for Count Table and Pie chart(appointing_architect)--}}

    {{--ajax call for Count Table and Pie chart(OC)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax')}}";
        $(".consent_oc").on("click", function () {

            var redirect_to = "{{route('ee.consent_for_oc')}}";
            var module_name = ($(this).attr("data-module"));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: dashboard,
                data: {module_name: module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {

                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">" + module_name + "</h3>\n" +
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
                            "                                    </tbody>\n";

                        var chart_count = 0;
                        var i = 1;
                        $.each(data[0], function (index, data) {

                            html += "<tr>\n" +
                                "<td class=\"text-center\">" + i + "</td>" +
                                "<td>" + index + "</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">" + data[0] + "</span></td>\n" +
                                "<td>\n" +
                                "<a href=\""+redirect_to+data[1]+"\"class=\"btn btn-action\">View</a>\n"+
                                "</td>\n" +
                                "</tr>";
                            chart_count += data[0];
                            i++;
                        });

                        html += "</tbody>\n" +
                            "                                </table>\n" +
                            "                        </div>\n" +
                            "                    </div>" +
                            "                   </div>\n" +
                            "                        <div class=\"col-sm-5\" id=\"ajaxchartdiv\">\n" +
                            "                        </div>\n" +
                            "                </div>\n" +
                            "            </div>";

                        $('#count_table').html(html);

                        if (chart_count) {

                            var chartData = [];

                            $.each((data[0]), function (index, data) {
                                obj = {};
                                if (index != 'Total Number of Applications') {
                                    obj['status'] = index;
                                    obj['value'] = data[0];
                                    chartData.push(obj);
                                }

                            });

                            var chart = AmCharts.makeChart("ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider": chartData,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor": "#FFFFFF",
                                "outlineThickness": 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize": 15,
                            });
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
    {{--end ajax call for Count Table and Pie chart(OC)--}}

    {{--ajax call for pendency Count Table and Pie chart(OC)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax')}}";
        $(".consent_oc_pendency").on("click", function () {

            var module_name = ($(this).attr("data-module"));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: dashboard,
                data: {module_name: module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {

                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">" + module_name + "</h3>\n" +
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
                            "                                    </tbody>\n";

                        var chart_count = 0;
                        var i = 1;
                        $.each(data, function (index, data) {

                            html += "<tr>\n" +
                                "<td class=\"text-center\">" + i + "</td>" +
                                "<td>" + index + "</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">" + data + "</span></td>\n" +
                                "</tr>";
                            chart_count += data;
                            i++;
                        });

                        html += "</tbody>\n" +
                            "                                </table>\n" +
                            "                        </div>\n" +
                            "                    </div>" +
                            "                   </div>\n" +
                            "                        <div class=\"col-sm-5\" id=\"ajaxchartdiv\">\n" +
                            "                        </div>\n" +
                            "                </div>\n" +
                            "            </div>";

                        $('#count_table').html(html);

                        if (chart_count) {

                            var chartData = [];

                            $.each((data), function (index, data) {
                                obj = {};
                                if (index != 'Total Number of Applications') {
                                    obj['status'] = index;
                                    obj['value'] = data;
                                    chartData.push(obj);
                                }

                            });

                            var chart = AmCharts.makeChart("ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider": chartData,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor": "#FFFFFF",
                                "outlineThickness": 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize": 15,
                            });
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
    {{--end ajax call for pendency Count Table and Pie chart(OC)--}}
@endsection
