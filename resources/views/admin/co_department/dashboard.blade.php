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
                       data-toggle="collapse" href="#co-ol-summary">
                        <span class="form-accordion-title">CO Offer Letter Summary</span>
                        <span class="accordion-icon"></span>
                    </a>
                </div>
            </div>
            <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="co-ol-summary"
                 data-parent="#accordion">
                <div class="row hearing-row">
                    @foreach($dashboardData as $header => $value)
                        <div class="col">
                            <div class="m-portlet app-card text-center">
                                <h2 class="app-heading">{{$header}}</h2>
                                <h2 class="app-no mb-0">{{$value}}</h2>
                                <a href="{{session()->get('redirect_to')}}" class="app-card__details mb-0">View Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div> 

        @if($dashboardData1)
            <div class="hearing-accordion-wrapper">
                <div class="m-portlet m-portlet--compact hearing-accordion mb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                           data-toggle="collapse" href="#co-ol-pending-summary">
                            <span class="form-accordion-title">REE Offer Letter Pending Applications Summary</span>
                            <span class="accordion-icon"></span>
                        </a>
                    </div>
                </div>
                <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="ree-ol-pending-summary"
                     data-parent="#accordion">
                    <div class="row hearing-row">
                        @foreach($dashboardData1 as $header => $value)
                            <div class="col">
                                <div class="m-portlet app-card text-center">
                                    <h2 class="app-heading">{{$header}}</h2>
                                    <h2 class="app-no mb-0">{{$value}}</h2>
                                    <a href="" class="app-card__details mb-0">View Details</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

<!-- Dashboard for Convayance Module  --> 
        @if($conveyanceDashboard)
            <div class="hearing-accordion-wrapper">
                <div class="m-portlet m-portlet--compact hearing-accordion mb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                           data-toggle="collapse" href="#conveyance_dashboard">
                            <span class="form-accordion-title">Application for Society Conveyance</span>
                            <span class="accordion-icon"></span>
                        </a>
                    </div>
                </div>
                <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse show" id="conveyance_dashboard"
                     data-parent="#accordion">
                    <div class="row hearing-row">
                        @foreach($conveyanceDashboard as $header => $value)
                            <div class="col">
                                <div class="m-portlet app-card text-center">
                                    <h2 class="app-heading">{{$header}}</h2>
                                    <h2 class="app-no mb-0">{{$value}}</h2>
                                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif        
    </div>

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
