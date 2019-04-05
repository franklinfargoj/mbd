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
    <div class="container-fluid mhada-dash-new">

        <div class="d-flex flex-wrap db-wrapper">
            <div class="m-subheader px-0 m-subheader--top col-sm-12 mb-3">
                <div class="d-flex align-items-center">
                    <h3 class="m-subheader__title">Redevelopment</h3>
                </div>
            </div>
            @if(in_array(session()->get('role_name'),$offerLetterRoles))
                <div class="db__card counts" data-module="Offer Letter">
                    <div class="db__card__img-wrap db-color-1">
                        <h3 class="db__card__count">{{$ol_count}}</h3>
                    </div>
                    <p class="db__card__title">Offer Letter</p>
                </div>

                @if(session()->get('role_name') == config('commanConfig.ree_branch_head'))
                    <div class="db__card pending_counts" data-module="Offer Letter Department Pendency">
                        <div class="db__card__img-wrap db-color-2">
                            <h3 class="db__card__count">{{$ol_pending_count}}</h3>
                        </div>
                        <p class="db__card__title">Offer Letter Department Pendency</p>
                    </div>
                @endif
            @endif

            @if(in_array(session()->get('role_name'), array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head'))))
                <div class="db__card consent_oc" data-module="Consent for OC">
                    <div class="db__card__img-wrap db-color-2">
                        <h3 class="db__card__count">{{$oc_count}}</h3>
                    </div>
                    <p class="db__card__title">Consent for OC</p>
                </div>
                @if(session()->get('role_name') == config('commanConfig.ree_branch_head'))
                    <div class="db__card consent_oc_pendency" data-module="Consent for OC Department Pendency">
                        <div class="db__card__img-wrap db-color-4">
                            <h3 class="db__card__count">{{$oc_pendency_count}}</h3>
                        </div>
                        <p class="db__card__title">Consent for OC Department Pendency</p>
                    </div>
                @endif
            @endif

            @php
                if(session()->get('role_name') == config('commanConfig.ree_branch_head')){
                    $class = 'no-margin-sm';
                }else{
                    $class = '';
                }

            @endphp

            <div class="db__card tripartite <?php echo $class; ?>" data-module="Tripartite Agreement">
                <div class="db__card__img-wrap db-color-3">
                    <h3 class="db__card__count">{{$tripartite_count}}</h3>
                </div>
                <p class="db__card__title">Tripartite Agreement</p>
            </div>
            @if(session()->get('role_name') == config('commanConfig.ree_branch_head'))
                <div class="db__card tripartite_pending no-margin-xl" data-module="Tripartite Agreement Department Pendency">
                    <div class="db__card__img-wrap db-color-4">
                        <h3 class="db__card__count">{{$tripartite_pending_count}}</h3>
                    </div>
                    <p class="db__card__title">Tripartite Agreement Department Pendency</p>
                </div>
            @endif


            <div class="db__card revalidation" data-module="Offer Letter Revalidation">
                <div class="db__card__img-wrap db-color-5">
                    <h3 class="db__card__count">{{$ol_reval_count}}</h3>
                </div>
                <p class="db__card__title">Offer Letter Revalidation</p>
            </div>
            @if(session()->get('role_name') == config('commanConfig.ree_branch_head'))
                <div class="db__card revalidation_pending" data-module="Offer Letter Revalidation Department Pendency">
                    <div class="db__card__img-wrap db-color-5">
                        <h3 class="db__card__count">{{$ol_reval_pending_count}}</h3>
                    </div>
                    <p class="db__card__title">Offer Letter Revalidation Department Pendency</p>
                </div>
            @endif

            <div class="db__card noc no-margin-sm" data-module="NOC">
                <div class="db__card__img-wrap db-color-5">
                    <h3 class="db__card__count">{{$noc_count}}</h3>
                </div>
                <p class="db__card__title">NOC</p>
            </div>
            @if(session()->get('role_name') == config('commanConfig.ree_branch_head'))
                <div class="db__card noc_pending" data-module="NOC Department Pendency">
                    <div class="db__card__img-wrap db-color-5">
                        <h3 class="db__card__count">{{$noc_pending_count}}</h3>
                    </div>
                    <p class="db__card__title">NOC Department Pendency</p>
                </div>
            @endif

            <div class="db__card noc no-margin-xl" data-module="NOC (CC)">
                <div class="db__card__img-wrap db-color-5">
                    <h3 class="db__card__count">{{$noc_cc_count}}</h3>
                </div>
                <p class="db__card__title">NOC (CC)</p>
            </div>
            @if(session()->get('role_name') == config('commanConfig.ree_branch_head'))
                <div class="db__card noc_pending" data-module="NOC (CC) Department Pendency">
                    <div class="db__card__img-wrap db-color-5">
                        <h3 class="db__card__count">{{$noc_cc_pending_count}}</h3>
                    </div>
                    <p class="db__card__title">NOC (CC) Department Pendency</p>
                </div>
            @endif
        </div>

        <div class="d-flex flex-wrap db-wrapper">
            <div class="m-subheader px-0 m-subheader--top col-sm-12 mb-3">
                <div class="d-flex align-items-center">
                    <h3 class="m-subheader__title">Architect</h3>
                </div>
            </div>
            <div class="db__card revision " data-module="Revision in Layout">
                <div class="db__card__img-wrap db-color-5">
                    <h3 class="db__card__count">{{$architect_layout_count}}</h3>
                </div>
                <p class="db__card__title">Revision in Layout</p>
            </div>
            <div class="db__card revision" data-module="Layout Approval">
                <div class="db__card__img-wrap db-color-5">
                    <h3 class="db__card__count">{{$architect_layout_count}}</h3>
                </div>
                <p class="db__card__title">Layout Approval</p>
            </div>
            @if (session()->get('role_name') == config('commanConfig.ree_branch_head'))
                <div class="db__card revision" data-module="Layout Approval Subordinate Pendency">
                    <div class="db__card__img-wrap db-color-5">
                        <h3 class="db__card__count">{{$architect_layout_count}}</h3>
                    </div>
                    <p class="db__card__title">Layout Approval Subordinate Pendency</p>
                </div>
            @endif
        </div>


    </div>

    <!-- Modal for count table and pie chart popup -->
    <div class="modal fade mhada-full-modal" id="getCodeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body" id="count_table">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Pending bifergation-->
    <div class="modal fade" id="pending" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Applications Pending</h4>
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

@endsection
@section('js')

    <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>

    {{--ajax call for Count Table and Pie chart(offer letter)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.ree')}}";
        $(".counts").on("click", function () {

            var redirect_to = "{{session()->get('redirect_to')}}";
//                        var module_name = ($('.counts').data("module"));
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
                            "                        <div class=\"m-portlet mhada-m-portlet db-table\">\n" +
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

                                html += "<a href=\"" + baseUrl + data[1] + "\" class=\"btn btn-action\" data-toggle=\"modal\"\n" +
                                    "             data-target=\"#pending\">View</a>";
                            }
                            else {
                                html += "<a href=\"" + baseUrl + redirect_to + data[1] + "\"class=\"btn btn-action\">View</a>\n";

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
    {{--end ajax call for Count Table and Pie chart(offer letter))--}}

    {{--ajax call for Pendency Count Table and Pie chart(offer letter)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.ree')}}";
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
                            "                        <div class=\"m-portlet mhada-m-portlet db-table\">\n" +
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
    {{--end ajax call Pendency Count Table and Pie chart(offer letter)--}}

    {{--ajax call for Count Table and Pie chart(revalidation)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.ree')}}";
        $(".revalidation").on("click", function () {

            var reval_application = "{{route('ree_applications.reval')}}";
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
                            "                        <div class=\"m-portlet mhada-m-portlet db-table\">\n" +
                            "                            <div class=\"table-responsive\">\n" +
                            "                                <table class=\"table text-center\">\n" +
                            "                                    <thead >\n" +
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

                                html += "<a href=\"" + reval_application + data[1] + "\"class=\"btn btn-action\" data-toggle=\"modal\"\n" +
                                    "             data-target=\"#pending\">View</a>";
                            }
                            else {
                                html += "<a href=\"" + reval_application + data[1] + "\"class=\"btn btn-action\">View</a>\n";

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

//                                    alert(chart_count);

                        if (data[1]) {
                            var html_pending = "";
                            html_pending +=
                                "                            <div class=\"table-responsive m-portlet__body--table\">\n" +
                                "                                <table class=\"table text-center\">\n" +
                                "                                    <thead>\n" +
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

    {{--ajax call for Pendency Count Table and Pie chart(revalidation)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.ree')}}";
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
                            "                        <div class=\"m-portlet mhada-m-portlet db-table\">\n" +
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
    {{--end ajax call for Pendency Count Table and Pie chart(revalidation)--}}

    {{--ajax call for Count Table and Pie chart(noc)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.ree')}}";
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
                            "                        <div class=\"m-portlet mhada-m-portlet db-table\">\n" +
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
                                "<a href=\"" + baseUrl + "/" + data[1] + "\"class=\"btn btn-action\">View</a>\n" +
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
    {{--end ajax call for Count Table and Pie chart(noc)--}}

    {{--ajax call for Count Table and Pie chart(noc)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.ree')}}";
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
                            "                        <div class=\"m-portlet mhada-m-portlet db-table\">\n" +
                            "                            <div class=\"table-responsive\">\n" +
                            "                                <table class=\"table text-center\">\n" +
                            "                                    <thead >\n" +
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
    {{--end ajax call for Count Table and Pie chart(noc)--}}

    {{--ajax call for Count Table and Pie chart(revision in layout,Layout Approval,Layout Approval Subordinate Pendency)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.ree')}}";
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
                            "                        <div class=\"m-portlet mhada-m-portlet db-table\">\n" +
                            "                            <div class=\"table-responsive\">\n" +
                            "                                <table class=\"table text-center\">\n" +
                            "                                    <thead >\n" +
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
    {{--end ajax call for Count Table and Pie chart(revision in layout,Layout Approval,Layout Approval Subordinate Pendency)--}}

    {{--ajax call for Count Table and Pie chart(tripartite)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.ree')}}";
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
                            "                        <div class=\"m-portlet mhada-m-portlet db-table\">\n" +
                            "                            <div class=\"table-responsive\">\n" +
                            "                                <table class=\"table text-center\">\n" +
                            "                                    <thead >\n" +
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

                                html += "<a href=\"" + tripartite_application + data[1] + "\"class=\"btn btn-action\" data-toggle=\"modal\"\n" +
                                    "             data-target=\"#pending\">View</a>";
                            }
                            else {
                                html += "<a href=\"" + tripartite_application + data[1] + "\"class=\"btn btn-action\">View</a>\n";

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

//                                   console.log(data);

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
    {{--end ajax call for Count Table and Pie chart(tripartite)--}}

    {{--ajax call for Pendency Count Table and Pie chart(tripartite)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.ree')}}";
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
                            "                        <div class=\"m-portlet mhada-m-portlet db-table\">\n" +
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
    {{--end ajax call for Pendency Count Table and Pie chart(tripartite)--}}

    {{--ajax call for Count Table and Pie chart(OC)--}}
    <script>
        var dashboard = "{{route('dashboard.ajax.ree')}}";
        $(".consent_oc").on("click", function () {

            var redirect_to = "{{route('ree_applications.consent_oc')}}";
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
                            "                        <div class=\"m-portlet mhada-m-portlet db-table\">\n" +
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
        var dashboard = "{{route('dashboard.ajax.ree')}}";
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
                            "                        <div class=\"m-portlet mhada-m-portlet db-table\">\n" +
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


