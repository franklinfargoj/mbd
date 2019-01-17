<div class="row no-gutters hearing-row">
    <div class="col-12 no-shadow">
        <div class="app-card-section-title"> Tripartite Agreement</div>
    </div>
    @php $chart_tripartite = 0; @endphp
    @foreach($tripartite_data['dashboardData'][0] as $header => $value)
        <div class="col-lg-3">
            <div class="m-portlet app-card text-center">
                <h2 class="app-heading">{{$header}}</h2>
                <div class="app-card-footer">
                    <h2 class="app-no mb-0">{{  $value[0] }}</h2>
                    @php $chart_tripartite += $value[0];@endphp
                    @if( $value[1] == 'pending')
                        <a href="{{url(session()->get('redirect_to').$value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#reePendingModal">View Details</a>
                    @else
                        <a href="{{ route('tripartite.index').$value[1] }}" class="app-card__details mb-0">View Details</a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@if($chart_tripartite)
    <div id="tripartite_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>
@endif
<script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>
@if($chart_tripartite)
    <script>
        var chart_tripartite;
        var legend;

                @if($tripartite_data['dashboardData'][0])
        var chartDatatripartite = [
                        @foreach($tripartite_data['dashboardData'][0] as $header => $value)     {
                        @if(!($header == 'Total No of Applications'))
                        "status": '{{$header}}',
                    "value": '{{$value[0]}}',
                        @endif
                },
                    @endforeach

            ];
        //    console.log(chartData1);

        AmCharts.ready(function () {
            // PIE CHART
            chart_tripartite = new AmCharts.AmPieChart();
            chart_tripartite.dataProvider = chartDatatripartite;
            chart_tripartite.titleField = "status";
            chart_tripartite.valueField = "value";
            chart_tripartite.outlineColor = "#FFFFFF";
            chart_tripartite.outlineAlpha = 0.8;
            chart_tripartite.outlineThickness = 2;
            chart_tripartite.balloonText =
                "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            // this makes the chart 3D
            chart_tripartite.depth3D = 15;
            chart_tripartite.angle = 30;
            chart_tripartite.colors = ["#f0791b", "#ffc063", "#2A0CD0", "#8bc34a", "#754DEB", "#DDDDDD", "#999999",
                "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"
            ]
            //
            // WRITE
            chart_tripartite.write("tripartite_chart");
        });
        @endif
    </script>
@endif