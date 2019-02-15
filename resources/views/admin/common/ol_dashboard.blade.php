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
    @php $chart = 0; $chart1 = 0; $chart2 = 0; $chart3 = 0; $chart4 = 0;
    @endphp

    <div class="container-fluid">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Dashboard</h3>
            </div>
        </div>

        <div class="d-flex flex-wrap db-wrapper">
            @if( !((session()->get('role_name') == config('commanConfig.junior_architect')) || (session()->get('role_name') == config('commanConfig.architect')) || (session()->get('role_name') == config('commanConfig.senior_architect'))))
                <div class="db__card">
                    <div class="db__card__img-wrap db-color-1">
                        <h3 class="db__card__count">{{$dashboardData['Total No of Applications'][0]}}</h3>
                    </div>
                    <p class="db__card__title">Offer Letter</p>
                </div>
                @if($dashboardData1)
                    <div class="db__card">
                        <div class="db__card__img-wrap db-color-2">
                            <h3 class="db__card__count">-</h3>
                        </div>
                        <p class="db__card__title">Offer Letter Subordinate Pendency</p>
                    </div>
                @endif
            @endif
            @if(in_array(session()->get('role_name'),$conveyanceRoles))
                @if($conveyanceDashboard)
                    <div class="db__card">
                        <div class="db__card__img-wrap db-color-3">
                            <h3 class="db__card__count">{{$conveyanceDashboard['0']['Total No of Applications'][0]}}</h3>
                        </div>
                        <p class="db__card__title">Society Conveyance</p>
                    </div>
                @endif
            @endif
                @if (in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'), config('commanConfig.vp_engineer'))))
                <div class="db__card">
                    <div class="db__card__img-wrap db-color-4">
                        <h3 class="db__card__count">{{$revalDashboardData['Total No of Applications'][0]}}</h3>
                    </div>
                    <p class="db__card__title">Offer Letter Revalidation</p>
                </div>
                @endif
                @if(in_array(session()->get('role_name'),$renewalRoles))
                    @if($renewalDashboard)
                        <div class="db__card">
                            <div class="db__card__img-wrap db-color-4">
                                <h3 class="db__card__count">{{$renewalDashboard[0]['Total No of Applications'][0]}}</h3>
                            </div>
                            <p class="db__card__title">Society Renewal</p>
                        </div>
                    @endif
                @endif

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
                    <div class="db__card">
                        <div class="db__card__img-wrap db-color-5">
                            <h3 class="db__card__count">
                                @if(in_array(session()->get('role_name'),array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head'))))
                                    {{$architect_data['total_no_of_appln_for_revision']}}
                                @elseif(in_array(session()->get('role_name'),array(config('commanConfig.vp_engineer'))))
                                    {{$architect_data['total_no_of_layout']}}
                                @elseif(in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'))))
                                    {{$architect_data['total_no_of_appln_for_approval']}}
                                @else
                                    -
                                @endif
                            </h3>
                        </div>
                        <p class="db__card__title">Revision in Layout</p>
                    </div>
                    <div class="db__card">
                        <div class="db__card__img-wrap db-color-5">
                            <h3 class="db__card__count">-</h3>
                        </div>
                        <p class="db__card__title">Layout Approval</p>
                    </div>
                @endif
        </div>

        {{--Dashboard for offer letter--}}
        @if( !((session()->get('role_name') == config('commanConfig.junior_architect')) || (session()->get('role_name') == config('commanConfig.architect')) || (session()->get('role_name') == config('commanConfig.senior_architect'))))
            {{--offer letter--}}
            <div>
                <div class="m-subheader px-0 m-subheader--top">
                    <div class="d-flex align-items-center">
                        <h3 class="m-subheader__title">Offer Letter</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-7">
                        <div class="m-portlet db-table">
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead>
                                    <th style="width: 10%;">Sr. No</th>
                                    <th style="width: 60%;" class="text-center">Stages</th>
                                    <th style="width: 15%;" class="text-left">Count</th>
                                    <th style="width: 15%;">Action</th>
                                    </thead>
                                    <tbody>
                                    @php
                                        $chart = 0;
                                        $i = 1;
                                    @endphp
                                    @foreach($dashboardData as $header => $value)
                                        <tr>
                                            <td class="text-center">{{$i}}.</td>
                                            <td>{{$header}}</td>
                                            <td class="text-center"><span class="count-circle">{{$value[0]}}</span></td>
                                            @php $chart += $value[0];@endphp
                                            <td>
                                                <a href="{{url(session()->get('redirect_to').$value[1])}}" class="btn btn-action">View</a>
                                            </td>
                                        </tr>
                                        @php $i++ @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($chart)
                        <div class="col-sm-5" id="chartdiv">
                        </div>
                    @endif
                </div>
            </div>

            @if($dashboardData1)
                {{--offer letter subordinate pendency--}}
                <div>
            <div class="m-subheader px-0 m-subheader--top">
                <div class="d-flex align-items-center">
                    <h3 class="m-subheader__title">Offer Letter Subordinate Pendency</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-7">
                    <div class="m-portlet db-table">
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                <th style="width: 10%;">Sr. No</th>
                                <th style="width: 60%;" class="text-center">Stages</th>
                                <th style="width: 15%;" class="text-left">Count</th>
                                </thead>
                                <tbody>
                                @php
                                    $chart1 = 0;
                                    $i = 1;
                                @endphp
                                @foreach($dashboardData1 as $header => $value)
                                    <tr>
                                        <td class="text-center">{{$i}}.</td>
                                        <td>{{$header}}</td>
                                        <td class="text-center"><span class="count-circle">{{$value}}</span></td>
                                        @php $chart1 += $value;@endphp
                                    </tr>
                                    @php $i++ @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if($chart1)
                    <div class="col-sm-5" id="chartdiv1">
                    </div>
                @endif
            </div>
        </div>
            @endif
        @endif
        {{--End Dashboard for offer letter--}}

        {{--Dashboard for Convayance Module--}}
        @if(in_array(session()->get('role_name'),$conveyanceRoles))
            @if($conveyanceDashboard)
                <div>
                    <div class="m-subheader px-0 m-subheader--top">
                        <div class="d-flex align-items-center">
                            <h3 class="m-subheader__title">Society Conveyance</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="m-portlet db-table">
                                <div class="table-responsive">
                                    <table class="table text-center">
                                        <thead>
                                        <th style="width: 10%;">Sr. No</th>
                                        <th style="width: 60%;" class="text-center">Stages</th>
                                        <th style="width: 15%;" class="text-left">Count</th>
                                        <th style="width: 15%;">Action</th>
                                        </thead>
                                        <tbody>
                                        @php
                                            $chart2 = 0;
                                            $i = 1;
                                        @endphp
                                        @foreach($conveyanceDashboard[0] as $header => $value)
                                            <tr>
                                                <td class="text-center">{{$i}}.</td>
                                                <td>{{$header}}</td>
                                                <td class="text-center"><span class="count-circle">{{$value[0]}}</span></td>

                                                @php $chart2 += $value[0];@endphp
                                                <td>
                                                    @if( $value[1] == 'pending')
                                                        <a href="{{url($value[1])}}"  class="btn btn-action" data-toggle="modal"
                                                           data-target="#pending">View</a>
                                                    @elseif( $value[1] == 'sendToSociety')
                                                        <a href="{{url($value[1])}}"  class="btn btn-action" data-toggle="modal"
                                                           data-target="#sendToSociety">View</a>
                                                    @else
                                                        <a href="{{url($value[1])}}"  class="btn btn-action">View</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if($chart2)
                            <div class="col-sm-5" id="conveyance_chart">
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endif
        {{--End Dashboard for offer letter--}}

        {{--Dashboard for Offer Letter Revalidation--}}
        @if (in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'), config('commanConfig.vp_engineer'))))
                <div>
                    <div class="m-subheader px-0 m-subheader--top">
                        <div class="d-flex align-items-center">
                            <h3 class="m-subheader__title">Offer Letter Revalidation</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="m-portlet db-table">
                                <div class="table-responsive">
                                    <table class="table text-center">
                                        <thead>
                                        <th style="width: 10%;">Sr. No</th>
                                        <th style="width: 60%;" class="text-center">Stages</th>
                                        <th style="width: 15%;" class="text-left">Count</th>
                                        <th style="width: 15%;">Action</th>
                                        </thead>
                                        <tbody>
                                        @php
                                            $chart4 = 0;
                                            $i = 1;
                                        @endphp
                                        @foreach($revalDashboardData as $header => $value)
                                            <tr>
                                                <td class="text-center">{{$i}}.</td>
                                                <td>{{$header}}</td>
                                                <td class="text-center"><span class="count-circle">{{$value[0]}}</span></td>

                                                @php $chart4 += $value[0];@endphp
                                                <td>
                                                    <a href="{{ (session()->get('role_name') == config('commanConfig.cap_engineer')) ? route('cap_applications.reval').$value[1] : route('vp_applications.reval').$value[1]}}" class="btn btn-action">View</a>
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if($chart4)
                            <div class="col-sm-5" id="reval_chart">
                            </div>
                        @endif
                    </div>
                </div>
        @endif
        {{--End Dashboard for Offer Letter Revalidation--}}

        {{--Dashboard for Renewal Module--}}
        @if(in_array(session()->get('role_name'),$renewalRoles))
            @if($renewalDashboard)
                <div>
                    <div class="m-subheader px-0 m-subheader--top">
                        <div class="d-flex align-items-center">
                            <h3 class="m-subheader__title">Applications for Society Renewal</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="m-portlet db-table">
                                <div class="table-responsive">
                                    <table class="table text-center">
                                        <thead>
                                        <th style="width: 10%;">Sr. No</th>
                                        <th style="width: 60%;" class="text-center">Stages</th>
                                        <th style="width: 15%;" class="text-left">Count</th>
                                        <th style="width: 15%;">Action</th>
                                        </thead>
                                        <tbody>
                                        @php
                                            $chart3 = 0;
                                            $i = 1;
                                        @endphp
                                        @foreach($conveyanceDashboard[0] as $header => $value)
                                            <tr>
                                                <td class="text-center">{{$i}}.</td>
                                                <td>{{$header}}</td>
                                                <td class="text-center"><span class="count-circle">{{$value[0]}}</span></td>

                                                @php $chart3 += $value[0];@endphp
                                                <td>
                                                    @if( $value[1] == 'pending')
                                                        <a href="{{url($value[1])}}"  class="btn btn-action" data-toggle="modal"
                                                           data-target="#pending_renewal">View</a>
                                                    @elseif( $value[1] == 'sendToSociety')
                                                        <a href="{{url($value[1])}}"  class="btn btn-action" data-toggle="modal"
                                                           data-target="#sendToSociety_renewal">View</a>
                                                    @else
                                                        <a href="{{url($value[1])}}"  class="btn btn-action">View</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if($chart3)
                            <div class="col-sm-5" id="renewal_chart">
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endif
        {{--End Dashboard for offer letter--}}

        @if((session()->get('role_name')==config('commanConfig.junior_architect'))||
   (session()->get('role_name')==config('commanConfig.senior_architect')) ||
   (session()->get('role_name')==config('commanConfig.architect')))
            @include('admin.dashboard.appointing_architect.dashboard',compact('appointing_architect_data'))
            @include('admin.dashboard.architect_layout.partials.architect_dashboard',compact('architect_data'))
        @endif
        @if(session()->get('role_name')==config('commanConfig.land_manager'))
            @include('admin.dashboard.architect_layout.partials.lm_dashboard',compact('architect_data'))
        @endif
        @if(session()->get('role_name')==config('commanConfig.estate_manager'))
            @include('admin.dashboard.architect_layout.partials.em_dashboard',compact('architect_data'))
        @endif
        @if (in_array(session()->get('role_name'),array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head'))))
            @include('admin.dashboard.architect_layout.partials.ee_dashboard',compact('architect_data'))
        @endif
        @if (in_array(session()->get('role_name'),array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head'))))
            @include('admin.dashboard.architect_layout.partials.ree_dashboard',compact('architect_data'))
        @endif
        @if(in_array(session()->get('role_name'),array(config('commanConfig.co_engineer'))))
            @include('admin.dashboard.architect_layout.partials.co_dashboard',compact('architect_data'))
        @endif
        @if(in_array(session()->get('role_name'),array(config('commanConfig.senior_architect_planner'))))
            @include('admin.dashboard.architect_layout.partials.sap_dashboard',compact('architect_data'))
        @endif
        @if(in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'))))
            @include('admin.dashboard.architect_layout.partials.cap_dashboard',compact('architect_data'))
        @endif
        @if(in_array(session()->get('role_name'),array(config('commanConfig.vp_engineer'))))
            @include('admin.dashboard.architect_layout.partials.vp_dashboard',compact('architect_data'))
        @endif

    </div>





            <!-- Modal for application pending bifergation -->
            <div class="modal fade" id="pending" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Pending Applications</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive m-portlet__body--table">
                                <table class="table text-center">
                                    <thead class="thead-default">
                                        <tr>
                                            <th>Header</th>
                                            <th>Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($conveyanceDashboard[1]) @foreach($conveyanceDashboard[1] as $header =>
                                        $value)
                                        <tr>
                                            <td> {{$header}} </td>
                                            <td> {{$value}} </td>
                                        </tr>
                                        @endforeach @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- <p>Some text in the modal.</p> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>

            </div>
             

            <!-- Model for send to society bifergation-->
            <div class="modal fade" id="sendToSociety" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Applications Sent to Society</h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead class="thead-default">
                                        <tr>
                                            <th>Header</th>
                                            <th>Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($conveyanceDashboard[2]) @foreach($conveyanceDashboard[2] as $header =>
                                        $value)
                                        <tr>
                                            <td> {{$header}} </td>
                                            <td> {{$value}} </td>
                                        </tr>
                                        @endforeach @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- <p>Some text in the modal.</p> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for renewal application pending bifergation -->
            <div class="modal fade" id="pending_renewal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Pending Applications</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive m-portlet__body--table">
                                <table class="table text-center">
                                    <thead class="thead-default">
                                        <tr>
                                            <th>Header</th>
                                            <th>Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($renewalDashboard[1]) @foreach($renewalDashboard[1] as $header => $value)
                                        <tr>
                                            <td> {{$header}} </td>
                                            <td> {{$value}} </td>
                                        </tr>
                                        @endforeach @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- <p>Some text in the modal.</p> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Model for renewal send to society bifergation-->
            <div class="modal fade" id="sendToSociety_renewal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Applications Sent to Society</h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table text-center">
                                    <thead class="thead-default">
                                        <tr>
                                            <th>Header</th>
                                            <th>Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($renewalDashboard[2]) @foreach($renewalDashboard[2] as $header => $value)
                                        <tr>
                                            <td> {{$header}} </td>
                                            <td> {{$value}} </td>
                                        </tr>
                                        @endforeach @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- <p>Some text in the modal.</p> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
@endsection

            @section('js')
            {{--<script>--}}
                {{--$(".ol-accordion").on("click", function () {--}}
                    {{--var data = $('.ol-accordion').children().children().attr('aria-expanded');--}}
                    {{--if (!(data)) {--}}
                        {{--$('.ol-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                    {{--} else {--}}
                        {{--if (data == 'undefine' || data == 'false') {--}}
                            {{--$('.ol-accordion-icon').css('background-image',--}}
                                {{--"url('../../../../img/minus-icon.svg')");--}}
                        {{--} else {--}}
                            {{--$('.ol-accordion-icon').css('background-image',--}}
                                {{--"url('../../../../img/plus-icon.svg')");--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}

                {{--$(".ol-reval-accordion").on("click", function () {--}}
                    {{--var data = $('.ol-reval-accordion').children().children().attr('aria-expanded');--}}
                    {{--if (!(data)) {--}}
                        {{--$('.ol-reval-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                    {{--}--}}
                    {{--else {--}}
                        {{--if (data == 'undefine' || data == 'false') {--}}
                            {{--$('.ol-reval-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                        {{--} else {--}}
                            {{--$('.ol-reval-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}

            {{--</script>--}}
            {{--<script>--}}
                {{--$(".conveyance-accordion").on("click", function () {--}}
                    {{--var data = $('.conveyance-accordion').children().children().attr('aria-expanded');--}}
                    {{--if (!(data)) {--}}
                        {{--$('.conveyance-accordion-icon').css('background-image',--}}
                            {{--"url('../../../../img/minus-icon.svg')");--}}
                    {{--} else {--}}
                        {{--if (data == 'undefine' || data == 'false') {--}}
                            {{--$('.conveyance-accordion-icon').css('background-image',--}}
                                {{--"url('../../../../img/minus-icon.svg')");--}}
                        {{--} else {--}}
                            {{--$('.conveyance-accordion-icon').css('background-image',--}}
                                {{--"url('../../../../img/plus-icon.svg')");--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}

            {{--</script>--}}
            {{--<script>--}}
                {{--$(".renewal-accordion").on("click", function () {--}}
                    {{--var data = $('.renewal-accordion').children().children().attr('aria-expanded');--}}
                    {{--if (!(data)) {--}}
                        {{--$('.renewal-accordion-icon').css('background-image',--}}
                            {{--"url('../../../../img/minus-icon.svg')");--}}
                    {{--} else {--}}
                        {{--if (data == 'undefine' || data == 'false') {--}}
                            {{--$('.renewal-accordion-icon').css('background-image',--}}
                                {{--"url('../../../../img/minus-icon.svg')");--}}
                        {{--} else {--}}
                            {{--$('.renewal-accordion-icon').css('background-image',--}}
                                {{--"url('../../../../img/plus-icon.svg')");--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}

            {{--</script>--}}
            {{--<script>--}}
                {{--$(".architect-accordion").on("click", function () {--}}
                    {{--var data = $('.architect-accordion').children().children().attr('aria-expanded');--}}
                    {{--if (!(data)) {--}}
                        {{--$('.architect-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                    {{--}--}}
                    {{--else {--}}
                        {{--if (data == 'undefine' || data == 'false') {--}}
                            {{--$('.architect-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                        {{--} else {--}}
                            {{--$('.architect-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}

                {{--$(".appointing-architect-accordion").on("click", function () {--}}
                    {{--var data = $('.appointing-architect-accordion').children().children().attr('aria-expanded');--}}
                    {{--if (!(data)) {--}}
                        {{--$('.appointing-architect-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                    {{--}--}}
                    {{--else {--}}
                        {{--if (data == 'undefine' || data == 'false') {--}}
                            {{--$('.appointing-architect-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                        {{--} else {--}}
                            {{--$('.appointing-architect-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}

                {{--$(".appointing-architect-pendencies-accordion").on("click", function () {--}}
                    {{--var data = $('.appointing-architect-pendencies-accordion').children().children().attr('aria-expanded');--}}
                    {{--if (!(data)) {--}}
                        {{--$('.appointing-architect-pendencies-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                    {{--}--}}
                    {{--else {--}}
                        {{--if (data == 'undefine' || data == 'false') {--}}
                            {{--$('.appointing-architect-pendencies-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                        {{--} else {--}}
                            {{--$('.appointing-architect-pendencies-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}

                {{--$(".architect-approval-layout-accordion").on("click", function () {--}}
                    {{--var data = $('.architect-approval-layout-accordion').children().children().attr('aria-expanded');--}}
                    {{--if (!(data)) {--}}
                        {{--$('.architect-approval-layout-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                    {{--}--}}
                    {{--else {--}}
                        {{--if (data == 'undefine' || data == 'false') {--}}
                            {{--$('.architect-approval-layout-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                        {{--} else {--}}
                            {{--$('.architect-approval-layout-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}
                {{--$(".architect-layout-pendencies-accordion").on("click", function () {--}}
                    {{--var data = $('.architect-layout-pendencies-accordion').children().children().attr('aria-expanded');--}}
                    {{--if (!(data)) {--}}
                        {{--$('.architect-layout-pendencies-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                    {{--}--}}
                    {{--else {--}}
                        {{--if (data == 'undefine' || data == 'false') {--}}
                            {{--$('.architect-layout-pendencies-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                        {{--} else {--}}
                            {{--$('.architect-layout-pendencies-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}
               {{----}}
                {{--$(".architect-layout-approval-ee-accordion").on("click", function () {--}}
                    {{--var data = $('.architect-layout-approval-ee-accordion').children().children().attr('aria-expanded');--}}
                    {{--if (!(data)) {--}}
                        {{--$('.architect-layout-approval-ee-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                    {{--}--}}
                    {{--else {--}}
                        {{--if (data == 'undefine' || data == 'false') {--}}
                            {{--$('.architect-layout-approval-ee-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                        {{--} else {--}}
                            {{--$('.architect-layout-approval-ee-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}
               {{----}}
                 {{--$(".vp-layout-approval-accordion").on("click", function () {--}}
                    {{--var data = $('.vp-layout-approval-accordion').children().children().attr('aria-expanded');--}}
                    {{--if (!(data)) {--}}
                        {{--$('.vp-layout-approval-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                    {{--}--}}
                    {{--else {--}}
                        {{--if (data == 'undefine' || data == 'false') {--}}
                            {{--$('.vp-layout-approval-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");--}}
                        {{--} else {--}}
                            {{--$('.vp-layout-approval-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}
            {{--</script>--}}

            <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>

            {{--offer letter chart--}}
            @if($chart)
            <script>
                var chart;
                var legend;


                var chartData = [

                    @foreach($dashboardData as $header => $value)
                    @if($header != 'Total No of Applications') {
                        "status": '{{$header}}',
                        "value": '{{$value[0]}}',
                    },
                    @endif
                    @endforeach

                ];

                AmCharts.ready(function () {
                    // PIE CHART
                    chart = new AmCharts.AmPieChart();
                    chart.dataProvider = chartData;
                    chart.theme = "light";
                    chart.labelRadius = -35;
                    chart.labelText = "[[percents]]%";
                    chart.titleField = "status";
                    chart.valueField = "value";
                    chart.outlineColor = "#FFFFFF";
                    chart.outlineAlpha = 0.8;
                    chart.outlineThickness = 2;
                    chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                    // this makes the chart 3D
                    chart.depth3D = 15;
                    chart.angle = 30;
                    chart.fontSize = 15;
//                chart.legend.useGraphSettings = true;

                    // WRITE
                    chart.write("chartdiv");
                });

            </script>
            @endif
            {{--end offer letter chart--}}

            {{--offer leter subordinate pendency chart--}}
            @if($chart1)
            <script>
                var chart1;
                var legend;

                @if($dashboardData1)
                var chartData1 = [
                    @foreach($dashboardData1 as $header => $value) {
                        "status": '{{$header}}',
                        "value": '{{$value}}',
                    },
                    @endforeach

                ];

                AmCharts.ready(function () {
                    // PIE CHART
                    chart1 = new AmCharts.AmPieChart();
                    chart1.dataProvider = chartData1;
                    chart1.theme = "light";
                    chart1.labelRadius = -35;
                    chart1.labelText = "[[percents]]%";
                    chart1.titleField = "status";
                    chart1.valueField = "value";
                    chart1.outlineColor = "#FFFFFF";
                    chart1.outlineAlpha = 0.8;
                    chart1.outlineThickness = 2;
                    chart1.balloonText =
                        "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                    // this makes the chart 3D
                    chart1.depth3D = 15;
                    chart1.angle = 30;
                    chart1.fontSize = 15;

                    // WRITE
                    chart1.write("chartdiv1");
                });
                @endif

            </script>
            @endif
            {{--end offer leter subordinate pendency chart--}}

            {{--Conveyance chart--}}
            @if($chart2)
                <script>
                var chart2;
                var legend;

                @if($conveyanceDashboard[0])
                var chartData2 = [
                    @foreach($conveyanceDashboard[0] as $header => $value) {
                        @if(!($header == 'Total No of Applications'))
                        "status": '{{$header}}',
                        "value": '{{$value[0]}}',
                        @endif
                    },
                    @endforeach

                ];

                AmCharts.ready(function () {
                    // PIE CHART
                    chart2 = new AmCharts.AmPieChart();
                    chart2.dataProvider = chartData2;
                    chart2.theme = "light";
                    chart2.labelRadius = -35;
                    chart2.labelText = "[[percents]]%";
                    chart2.titleField = "status";
                    chart2.valueField = "value";
                    chart2.outlineColor = "#FFFFFF";
                    chart2.outlineAlpha = 0.8;
                    chart2.outlineThickness = 2;
                    chart2.balloonText =
                        "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                    // this makes the chart 3D
                    chart2.depth3D = 15;
                    chart2.angle = 30;
                    chart2.fontSize = 15;

                    // WRITE
                    chart2.write("conveyance_chart");
                });
                @endif

            </script>
            @endif
            {{--end conveyance chart--}}

            {{--Renewal chart--}}
            @if($chart3)
            <script>
                var chart3;
                var legend;


                var chartData3 = [

                    @foreach($renewalDashboard[0] as $header => $value)
                    @if($header != 'Total No of Applications') {
                        "status": '{{$header}}',
                        "value": '{{$value[0]}}',
                    },
                    @endif
                    @endforeach

                ];

                AmCharts.ready(function () {
                    // PIE CHART
                    chart3 = new AmCharts.AmPieChart();
                    chart3.dataProvider = chartData3;
                    chart3.theme = "light";
                    chart3.labelRadius = -35;
                    chart3.labelText = "[[percents]]%";
                    chart3.titleField = "status";
                    chart3.valueField = "value";
                    chart3.outlineColor = "#FFFFFF";
                    chart3.outlineAlpha = 0.8;
                    chart3.outlineThickness = 2;
                    chart3.balloonText =
                        "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                    // this makes the chart 3D
                    chart3.depth3D = 15;
                    chart3.angle = 30;
                    chart3.fontSize = 15;

                    // WRITE
                    chart3.write("renewal_chart");
                });

            </script>
            @endif
            {{--end renewal chart--}}

            {{--offer letter revalidation chart--}}
            @if($chart4)
                <script>
                    var chart4;
                    var legend;


                    var chartData4 = [

                            @foreach($revalDashboardData as $header => $value)
                            @if($header != 'Total No of Applications'){
                            "status": '{{$header}}',
                            "value": '{{$value[0]}}',
                        },
                        @endif
                        @endforeach

                    ];

                    AmCharts.ready(function () {
                        // PIE CHART
                        chart4 = new AmCharts.AmPieChart();
                        chart4.dataProvider = chartData4;
                        chart4.theme = "light";
                        chart4.labelRadius = -35;
                        chart4.labelText = "[[percents]]%";
                        chart4.titleField = "status";
                        chart4.valueField = "value";
                        chart4.outlineColor = "#FFFFFF";
                        chart4.outlineAlpha = 0.8;
                        chart4.outlineThickness = 2;
                        chart4.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                        // this makes the chart 3D
                        chart4.depth3D = 15;
                        chart4.angle = 30;
                        chart4.fontSize = 15;

                        // WRITE
                        chart4.write("reval_chart");
                    });
                </script>
            @endif
            {{--end offer letter revalidation chart--}}

            @endsection
