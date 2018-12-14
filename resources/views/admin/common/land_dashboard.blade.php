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
                    <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                       data-toggle="collapse" href="#land-summary">
                        <span class="form-accordion-title">Land Summary</span>
                        <span class="accordion-icon hearing-accordion"></span>
                    </a>
                </div>
            </div>
            <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="land-summary"
                 data-parent="#accordion">
                <div class="row hearing-row">
                    @php $chart = 0;@endphp
                    @foreach($dashboardData as $header => $value)
                        <div class="col">
                            <div class="m-portlet app-card text-center">
                                <h2 class="app-heading">{{$header}}</h2>
                                <h2 class="app-no mb-0">{{$value[0]}}</h2>
                                @php $chart += $value[0];@endphp
                                <a href="{{$value[1]}}" class="app-card__details mb-0">View Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($chart)
                    <div id="land_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>
                @endif
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(".hearing-accordion").on("click", function () {
            var data = $('.hearing-accordion').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });
    </script>

    {{--<script>--}}
        {{--$(".hearing-accordion").on("click", function () {--}}
            {{--var data = $('.hearing-accordion').children().children().attr('aria-expanded');--}}
            {{--if(data == 'undefine' || data == 'false'){--}}
                {{--$('.accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
            {{--}else{--}}
                {{--$('.accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");--}}
            {{--}--}}
        {{--});--}}
    {{--</script>--}}
    <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>

    <script>
        var chart;
        var legend;
        var chartData = [
                @foreach($dashboardData as $header => $value){
                "status": '{{$header}}',
                "value": '{{$value[0]}}',
            },
            @endforeach
        ];

        console.log(chartData);
        AmCharts.ready(function () {
            // PIE CHART
            chart = new AmCharts.AmPieChart();
            chart.dataProvider = chartData;
            chart.titleField = "status";
            chart.valueField = "value";
            chart.outlineColor = "#FFFFFF";
            chart.outlineAlpha = 0.8;
            chart.outlineThickness = 2;
            chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            // this makes the chart 3D
            chart.depth3D = 15;
            chart.angle = 30;
            chart.colors = [ "#f0791b", "#ffc063", "#2A0CD0", "#8bc34a", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"]
//
            // WRITE
            chart.write("land_chart");
        });
    </script>
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