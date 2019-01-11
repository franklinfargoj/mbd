<div class="hearing-accordion-wrapper">
    <div class="m-portlet m-portlet--compact formation-accordion mb-0">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"
                data-toggle="collapse" href="#formation_dashboard">
                <span class="form-accordion-title">Applications for Society Formation</span>
                <span class="accordion-icon formation-accordion-icon"></span>
            </a>
        </div>
    </div>
    <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="formation_dashboard"
        data-parent="#accordion">
        <div class="row no-gutters hearing-row">
            <div class="col-12 no-shadow">
                <div class="app-card-section-title">Society Formation</div>
            </div>
            <div class="col-lg-3">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Total No of Application</h2>
                    <div class="app-card-footer">
                        <h2 class="app-no mb-0">{{$formation_data['total_no_application']}}</h2>

                        {{-- @if( $value[1] == 'pending')
                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#pending">View
                            Details</a>
                        @elseif( $value[1] == 'sendToSociety')
                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#sendToSociety">View
                            Details</a>
                        @else
                        <a href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>
                        @endif
                        @php $chart2 += $value[0]; @endphp --}}
                    </div>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
            <div class="col-lg-3">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Application Pending</h2>
                    <div class="app-card-footer">
                        <h2 class="app-no mb-0">{{$formation_data['application_pending_at_current_user']}}</h2>

                        {{-- @if( $value[1] == 'pending')
                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#pending">View
                            Details</a>
                        @elseif( $value[1] == 'sendToSociety')
                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#sendToSociety">View
                            Details</a>
                        @else
                        <a href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>
                        @endif
                        @php $chart2 += $value[0]; @endphp --}}
                    </div>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
            <div class="col-lg-3">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Sent to EM</h2>
                    <div class="app-card-footer">
                        <h2 class="app-no mb-0">{{$formation_data['sent_to_em']}}</h2>

                        {{-- @if( $value[1] == 'pending')
                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#pending">View
                            Details</a>
                        @elseif( $value[1] == 'sendToSociety')
                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#sendToSociety">View
                            Details</a>
                        @else
                        <a href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>
                        @endif
                        @php $chart2 += $value[0]; @endphp --}}
                    </div>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
            <div class="col-lg-3">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Send to DDR</h2>
                    <div class="app-card-footer">
                        <h2 class="app-no mb-0">{{$formation_data['send_to_ddr']}}</h2>

                        {{-- @if( $value[1] == 'pending')
                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#pending">View
                            Details</a>
                        @elseif( $value[1] == 'sendToSociety')
                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#sendToSociety">View
                            Details</a>
                        @else
                        <a href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>
                        @endif
                        @php $chart2 += $value[0]; @endphp --}}
                    </div>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
        </div>
        @if((session()->get('role_name')==config('commanConfig.dyco_engineer')) ||
    (session()->get('role_name')==config('commanConfig.dycdo_engineer')))
        <div class="row no-gutters hearing-row">
            <div class="col-lg-6">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Application pending at EM</h2>
                    <div class="app-card-footer">
                        <h2 class="app-no mb-0">{{$formation_data['sent_to_em']}}</h2>

                        {{-- @if( $value[1] == 'pending')
                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#pending">View
                            Details</a>
                        @elseif( $value[1] == 'sendToSociety')
                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#sendToSociety">View
                            Details</a>
                        @else
                        <a href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>
                        @endif
                        @php $chart2 += $value[0]; @endphp --}}
                    </div>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="m-portlet app-card text-center">
                    <h2 class="app-heading">Application pending at DyCO</h2>
                    <div class="app-card-footer">
                        <h2 class="app-no mb-0">{{$formation_data['pending_at_dyco']}}</h2>

                        {{-- @if( $value[1] == 'pending')
                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#pending">View
                            Details</a>
                        @elseif( $value[1] == 'sendToSociety')
                        <a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#sendToSociety">View
                            Details</a>
                        @else
                        <a href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>
                        @endif
                        @php $chart2 += $value[0]; @endphp --}}
                    </div>
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
