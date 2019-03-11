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
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Dashboard</h3>
            </div>
        </div>

        <div class="d-flex flex-wrap db-wrapper">
            @if(session()->get('role_name')==config('commanConfig.selection_commitee'))
                <div class="db__card appointing_architect" data-module="Appointing Architect">
                    <div class="db__card__img-wrap db-color-1">
                        <h3 class="db__card__count">{{$appointing_count}}</h3>
                    </div>
                    <p class="db__card__title">Appointing Architect</p>
                </div>
                <div class="db__card appointing_architect" data-module="Appointing Architect Subordinate Pendency">
                    <div class="db__card__img-wrap db-color-2">
                        <h3 class="db__card__count">{{$appointing_count}}</h3>
                    </div>
                    <p class="db__card__title">Appointing Architect Subordinate Pendency</p>
                </div>
                    @endif
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
    </div>


{{--<div class="container-fluid">--}}
    {{--<div class="m-subheader px-0 m-subheader--top">--}}
        {{--<div class="d-flex align-items-center">--}}
            {{--<h3 class="m-subheader__title">Dashboard</h3>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<!-- end -->--}}
    {{--@if(session()->get('role_name')==config('commanConfig.selection_commitee'))--}}
    {{--@include('admin.dashboard.appointing_architect.dashboard',compact('appointing_architect_data'))--}}
    {{--@endif--}}
{{--</div>--}}

@endsection

@section('js')
    {{--ajax call for Count Table and Pie chart(appointing_architect)--}}
    <script>
        var dashboard = "{{route('appointing_architect_dashboard.ajax')}}";
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

                            $.each((data[0]), function (index, data) {
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
@endsection
