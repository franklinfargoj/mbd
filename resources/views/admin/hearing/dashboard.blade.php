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

    <div class="hearing-accordion-wrapper">

        <div class="m-portlet m-portlet--compact hearing-accordion mb-0">
            <div class="d-flex justify-content-between align-items-center">
                <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100 collapsed"
                    data-toggle="collapse" href="#todays-hearing">
                    <span class="form-accordion-title">Today's Hearing</span>
                    <span class="accordion-icon"></span>
                </a>
            </div>
        </div>

        <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="todays-hearing"
            data-parent="#accordion">
            <div class="row hearing-row">
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Case Year</h2>
                        <h2 class="app-no mb-0">240</h2>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Case NO</h2>
                        <h2 class="app-no mb-0">250</h2>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Hearing Time</h2>
                        <h2 class="app-no mb-0">240</h2>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Applicant Name</h2>
                        <h2 class="app-no mb-0">10</h2>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <a href="javascript:void(0);" class="app-no app-no--view mb-0">View Details</a>
                    </div>
                </div>
            </div>
            <div class="row hearing-row">
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Case Year</h2>
                        <h2 class="app-no mb-0">240</h2>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Case NO</h2>
                        <h2 class="app-no mb-0">250</h2>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Hearing Time</h2>
                        <h2 class="app-no mb-0">240</h2>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Applicant Name</h2>
                        <h2 class="app-no mb-0">10</h2>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <a href="javascript:void(0);" class="app-no app-no--view mb-0">View Details</a>
                    </div>
                </div>
            </div>
            <div class="row hearing-row">
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Case Year</h2>
                        <h2 class="app-no mb-0">240</h2>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Case NO</h2>
                        <h2 class="app-no mb-0">250</h2>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Hearing Time</h2>
                        <h2 class="app-no mb-0">240</h2>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Applicant Name</h2>
                        <h2 class="app-no mb-0">10</h2>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <a href="javascript:void(0);" class="app-no app-no--view mb-0">View Details</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="hearing-accordion-wrapper">
        <div class="m-portlet m-portlet--compact hearing-accordion mb-0">
            <div class="d-flex justify-content-between align-items-center">
                <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                    data-toggle="collapse" href="#hearing-summary">
                    <span class="form-accordion-title">Hearing Summary</span>
                    <span class="accordion-icon"></span>
                </a>
            </div>
        </div>
        <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="hearing-summary"
            data-parent="#accordion">
            <div class="row hearing-row">
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Total No of Cases</h2>
                        <h2 class="app-no mb-0">240</h2>
                        <a href="javascript:void(0);" class="app-card__details mb-0">View Details</a>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Total No of Pending Cases</h2>
                        <h2 class="app-no mb-0">250</h2>
                        <a href="javascript:void(0);" class="app-card__details mb-0">View Details</a>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Total No of Closed Cases</h2>
                        <h2 class="app-no mb-0">240</h2>
                        <a href="javascript:void(0);" class="app-card__details mb-0">View Details</a>
                    </div>
                </div>
                <div class="col">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Case Under Hearing</h2>
                        <h2 class="app-no mb-0">10</h2>
                        <a href="javascript:void(0);" class="app-card__details mb-0">View Details</a>
                    </div>
                </div>
            </div>
            <div id="chartdiv" style="width: 100%; height: 350px; margin-top: 2px;"></div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>

    <script>
        var chart;
        var legend;

        var chartData = [
            {
                "country": "Lithuania",
                "value": 260
            },
            {
                "country": "Ireland",
                "value": 201
            },
            {
                "country": "Germany",
                "value": 65
            },
            {
                "country": "Australia",
                "value": 39
            },
            {
                "country": "UK",
                "value": 19
            },
            {
                "country": "Latvia",
                "value": 10
            }
        ];

        AmCharts.ready(function () {
            // PIE CHART
            chart = new AmCharts.AmPieChart();
            chart.dataProvider = chartData;
            chart.titleField = "country";
            chart.valueField = "value";
            chart.outlineColor = "#FFFFFF";
            chart.outlineAlpha = 0.8;
            chart.outlineThickness = 2;
            chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            // this makes the chart 3D
            chart.depth3D = 15;
            chart.angle = 30;

            // WRITE
            chart.write("chartdiv");
        });
    </script>
@endsection