<div class="row no-gutters hearing-row">
    <div class="col-12 no-shadow">
        <div class="app-card-section-title"> Tripartite Agreement</div>
    </div>
    {{--@php dd($tripartite_data['dashboardData']); @endphp--}}
    @foreach($tripartite_data['dashboardData'][0] as $header => $value)
        <div class="col-lg-3">
            <div class="m-portlet app-card text-center">
                <h2 class="app-heading">{{$header}}</h2>
                <div class="app-card-footer">
                    <h2 class="app-no mb-0">{{  $value[0] }}</h2>
                    @php $chart += $value[0];@endphp
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