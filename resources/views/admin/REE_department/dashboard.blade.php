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
    @php
        $chart = 0;
        $chart1 = 0;
        $chart2 = 0;
        $chart3 = 0;
    @endphp

    <div class="container-fluid">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Dashboard</h3>
            </div>
        </div>

        <div class="d-flex flex-wrap db-wrapper">
            @if($dashboardData[0])
                <div class="db__card counts"  data-module = "Offer Letter">
                    <div class="db__card__img-wrap db-color-1">
                        <h3 class="db__card__count">{{$dashboardData[0]['Total Number of Applications'][0]}}</h3>
                    </div>
                    <p class="db__card__title">Offer Letter</p>
                </div>
            @endif
            @if($dashboardData1)
                <div class="db__card pending_counts" data-module="Offer Letter Subordinate Pendency">
                    <div class="db__card__img-wrap db-color-2">
                        <h3 class="db__card__count">{{$dashboardData1['Total Number of Applications']}}</h3>
                    </div>
                    <p class="db__card__title">Offer Letter Subordinate Pendency</p>
                </div>
            @endif

            <div class="db__card">
                <div class="db__card__img-wrap db-color-3">
                    <h3 class="db__card__count">48</h3>
                </div>
                <p class="db__card__title">Tripartite Agreement</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-4">
                    <h3 class="db__card__count">48</h3>
                </div>
                <p class="db__card__title">Tripartite Agreement Subordinate Pendency</p>
            </div>

            @if($revalDashboardData[0])
            <div class="db__card revalidation" data-module="Offer Letter Revalidation">
                <div class="db__card__img-wrap db-color-5">
                    <h3 class="db__card__count">{{$revalDashboardData[0]['Total Number of Applications'][0]}}</h3>
                </div>
                <p class="db__card__title">Offer Letter Revalidation</p>
            </div>
            @endif
            @if($revalDashboardData1)
                <div class="db__card revalidation_pending" data-module="Offer Letter Revalidation Subordinate Pendency">
                    <div class="db__card__img-wrap db-color-5">
                        <h3 class="db__card__count">{{$revalDashboardData1['Total Number of Applications']}}</h3>
                    </div>
                    <p class="db__card__title">Offer Letter Revalidation Subordinate Pendency</p>
                </div>
            @endif
            @if($nocApplication)
                <div class="db__card">
                    <div class="db__card__img-wrap db-color-5">
                        <h3 class="db__card__count">{{$nocApplication['app_data']['Total Number of Application'][0]}}</h3>
                    </div>
                    <p class="db__card__title">NOC</p>
                </div>
            @endif
            @if($nocApplication['pending_data'])
                <div class="db__card">
                    <div class="db__card__img-wrap db-color-5">
                        <h3 class="db__card__count">{{$nocApplication['pending_data']['Total number of Application Pending']}}</h3>
                    </div>
                    <p class="db__card__title">NOC Subordinate Pendency</p>
                </div>
            @endif
            @if($nocforCCApplication)
                <div class="db__card">
                    <div class="db__card__img-wrap db-color-5">
                        <h3 class="db__card__count">{{$nocforCCApplication['app_data']['Total Number of Application'][0]}}</h3>
                    </div>
                    <p class="db__card__title">NOC (CC)</p>
                </div>
            @endif
            @if($nocforCCApplication['pending_data'])
                <div class="db__card">
                    <div class="db__card__img-wrap db-color-5">
                        <h3 class="db__card__count">{{$nocforCCApplication['pending_data']['Total number of Application Pending']}}</h3>
                    </div>
                    <p class="db__card__title">NOC (CC) Subordinate Pendency</p>
                </div>
            @endif


            <div class="db__card">
                <div class="db__card__img-wrap db-color-5">
                    <h3 class="db__card__count">{{$architect_data['total_no_of_appln_for_revision']}}</h3>
                </div>
                <p class="db__card__title">Revision in Layout</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-5">
                    <h3 class="db__card__count">-</h3>
                </div>
                <p class="db__card__title">Layout Sent for Approval</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-5">
                    <h3 class="db__card__count">-</h3>
                </div>
                <p class="db__card__title">Layout Approval</p>
            </div>
        </div>

        {{--Dashboard for offer letter--}}
        @if($dashboardData[0])
            <div id="count_table">
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
                                    $i = 1;
                                @endphp

                                @foreach($dashboardData[0] as $header => $value)
                                    <tr>
                                        <td class="text-center">{{$i}}.</td>
                                        <td>{{$header}}</td>
                                        <td class="text-center"><span class="count-circle">{{$value[0]}}</span></td>
                                        <td>
                                            @if( $value[1] == 'pending')
                                                <a href="{{url(session()->get('redirect_to').$value[1])}}" class="btn btn-action" data-toggle="modal" data-target="#reePendingModal">View</a>
                                            @else
                                                <a href="{{url(session()->get('redirect_to').$value[1])}}" class="btn btn-action">View</a>
                                            @endif
                                        </td>
                                        @php $chart += $value[0]; $i++; @endphp
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if($chart)
                    <div id="ajaxchartdiv" class="col-sm-5"></div>
                @endif
            </div>
        </div>
        @endif
        {{--End Dashboard for offer letter--}}

        {{--Dashboard for offer letter revalidation--}}
        @if($revalDashboardData[0])
            <div>
            <div class="m-subheader px-0 m-subheader--top">
                <div class="d-flex align-items-center">
                    <h3 class="m-subheader__title">Revalidation of Offer Letter</h3>
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
                                    $i = 1;
                                @endphp

                                @foreach($revalDashboardData[0] as $header => $value)
                                    <tr>
                                        <td class="text-center">{{$i}}.</td>
                                        <td>{{$header}}</td>
                                        <td class="text-center"><span class="count-circle">{{$value[0]}}</span></td>
                                        <td>
                                            @if( $value[1] == 'pending')
                                                <a href="{{route('ree_applications.reval').$value[1]}}" class="btn btn-action" data-toggle="modal" data-target="#reeRevalPendingModal">View</a>
                                            @else
                                                <a href="{{route('ree_applications.reval').$value[1]}}" class="btn btn-action">View</a>
                                            @endif
                                        </td>
                                        @php $chart2 += $value[0]; $i++; @endphp
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if($chart2)
                    <div id="reval_chart" class="col-sm-5"></div>
                @endif
            </div>
        </div>
        @endif
        {{--End Dashboard for offer letter revalidation--}}

        {{--Dashboard for offer letter revalidation subordinate pendency--}}
        @if($revalDashboardData1)
                <div>
                    <div class="m-subheader px-0 m-subheader--top">
                        <div class="d-flex align-items-center">
                            <h3 class="m-subheader__title">Offer Letter Revalidation Subordinate Pendency</h3>
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
                                            $i = 1;
                                        @endphp

                                        @foreach($revalDashboardData1 as $header => $value)
                                            <tr>
                                                <td class="text-center">{{$i}}.</td>
                                                <td>{{$header}}</td>
                                                <td class="text-center"><span class="count-circle">{{$value}}</span></td>
                                                @php $chart3 += $value; $i++; @endphp
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if($chart3)
                            <div id="revalchartdiv1" class="col-sm-5"></div>
                        @endif
                    </div>
                </div>
            @endif
        {{--End Dashboard for offer letter revalidation subordinate pendency--}}


        {{--Dashboard for NOC --}}
        @if($nocApplication['app_data'])
        <div>
            <div class="m-subheader px-0 m-subheader--top">
                <div class="d-flex align-items-center">
                    <h3 class="m-subheader__title">Applications for NOC</h3>
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
                                    $noc_chart = 0;
                                    $i = 1;
                                @endphp

                                @foreach($nocApplication['app_data'] as $header => $value)
                                    <tr>
                                        <td class="text-center">{{$i}}.</td>
                                        <td>{{$header}}</td>
                                        <td class="text-center"><span class="count-circle">{{$value[0]}}</span></td>
                                        <td>
                                            <a target="_blank" href="{{url($value[1])}}" class="btn btn-action">View</a>
                                        </td>
                                        @php $noc_chart += $value[0]; $i++;@endphp
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if($noc_chart)
                    <div id="noc_chart_div" class="col-sm-5"></div>
                @endif
            </div>
        </div>
        @endif
        {{--End Dashboard for NOC--}}

        {{--Dashboard for NOC Subordinate Pendency--}}
        @if($nocApplication['pending_data'])
            <div>
                <div class="m-subheader px-0 m-subheader--top">
                    <div class="d-flex align-items-center">
                        <h3 class="m-subheader__title">NOC Subordinate Pendency</h3>
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
                                        $noc_chart_pending = 0;
                                        $i = 1;
                                    @endphp

                                    @foreach($nocApplication['pending_data'] as $pending_label => $pending_count)
                                        <tr>
                                            <td class="text-center">{{$i}}.</td>
                                            <td>{{$pending_label}}</td>
                                            <td class="text-center"><span class="count-circle">{{$pending_count}}</span></td>
                                            @php $noc_chart_pending += $pending_count; $i++;@endphp
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($noc_chart_pending)
                        <div id="noc_chart_pending" class="col-sm-5"></div>
                    @endif
                </div>
            </div>
        @endif
        {{--Dashboard for NOC Subordinate Pendency--}}

        {{--Dashboard for NOC(CC) --}}
        @if($nocforCCApplication['app_data'])
            <div>
                <div class="m-subheader px-0 m-subheader--top">
                    <div class="d-flex align-items-center">
                        <h3 class="m-subheader__title">Application for NOC (CC)</h3>
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
                                        $noc_cc_chart = 0;
                                        $i = 1;
                                    @endphp

                                    @foreach($nocforCCApplication['app_data'] as $header => $value)
                                        <tr>
                                            <td class="text-center">{{$i}}.</td>
                                            <td>{{$header}}</td>
                                            <td class="text-center"><span class="count-circle">{{$value[0]}}</span></td>
                                            <td>
                                                <a target="_blank" href="{{url($value[1])}}" class="btn btn-action">View</a>
                                            </td>
                                            @php $noc_cc_chart += $value[0]; $i++;@endphp
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($noc_cc_chart)
                        <div id="noc_cc_chart_div" class="col-sm-5"></div>
                    @endif
                </div>
            </div>
        @endif
        {{--End Dashboard for NOC(CC)--}}


        {{--Dashboard for NOC(CC) Subordinate Pendency--}}
        @if($nocforCCApplication['pending_data'])
            <div>
                <div class="m-subheader px-0 m-subheader--top">
                    <div class="d-flex align-items-center">
                        <h3 class="m-subheader__title">NOC (CC) Subordinate Pendency</h3>
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
                                        $noc_cc_chart_pending = 0;
                                        $i = 1;
                                    @endphp

                                    @foreach($nocforCCApplication['pending_data'] as $pending_label => $pending_count)
                                        <tr>
                                            <td class="text-center">{{$i}}.</td>
                                            <td>{{$pending_label}}</td>
                                            <td class="text-center"><span class="count-circle">{{$pending_count}}</span></td>
                                            @php $noc_cc_chart_pending += $pending_count; $i++;@endphp
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($noc_cc_chart_pending)
                        <div id="noc_cc_chart_pending" class="col-sm-5"></div>
                    @endif
                </div>
            </div>
        @endif
        {{--Dashboard for NOC(CC) Subordinate Pendency--}}

        @if((session()->get('role_name')==config('commanConfig.junior_architect'))||
    (session()->get('role_name')==config('commanConfig.senior_architect')) ||
    (session()->get('role_name')==config('commanConfig.architect')))
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




    {{--<div class="container-fluid">--}}
        {{--<div class="hearing-accordion-wrapper">--}}
            {{--<div class="m-portlet m-portlet--compact ol-accordion mb-0">--}}
                {{--<div class="d-flex justify-content-between align-items-center">--}}
                    {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
                       {{--data-toggle="collapse" href="#ree-ol-summary">--}}
                        {{--<span class="form-accordion-title">Application for Redevelopment</span>--}}
                        {{--<span class="accordion-icon ol-accordion-icon"></span>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="ree-ol-summary"--}}
                 {{--data-parent="#accordion">--}}
                {{--<div class="row no-gutters hearing-row">--}}
                    {{--<div class="col-12 no-shadow">--}}
                        {{--<div class="app-card-section-title">Offer Letter</div>--}}
                    {{--</div>--}}
                    {{--@foreach($dashboardData[0] as $header => $value)--}}
                        {{--<div class="col-lg-3">--}}
                            {{--<div class="m-portlet app-card text-center">--}}
                                {{--<h2 class="app-heading">{{$header}}</h2>--}}
                                {{--<div class="app-card-footer">--}}
                                    {{--<h2 class="app-no mb-0">{{$value[0]}}</h2>--}}
                                    {{--@php $chart += $value[0];@endphp--}}
                                    {{--@if( $value[1] == 'pending')--}}
                                        {{--<a href="{{url(session()->get('redirect_to').$value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#reePendingModal">View Details</a>--}}
                                    {{--@else--}}
                                        {{--<a href="{{url(session()->get('redirect_to').$value[1])}}" class="app-card__details mb-0">View Details</a>--}}
                                    {{--@endif--}}
                                    {{--<a href="{{url(session()->get('redirect_to').$value[1])}}" class="app-card__details mb-0">View Details</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
                {{--@if($chart)--}}
                    {{--<div id="chartdiv" style="width: 100%; height: 350px; margin-top: 2px;"></div>--}}
                {{--@endif--}}

                {{--@if($dashboardData1)--}}
                    {{--<div class="row no-gutters hearing-row">--}}
                        {{--<div class="col-12 no-shadow">--}}
                            {{--<div class="app-card-section-title">Offer Letter Subordinate Pendency</div>--}}
                        {{--</div>--}}
                        {{--@foreach($dashboardData1 as $header => $value)--}}
                            {{--<div class="col-lg-3">--}}
                                {{--<div class="m-portlet app-card text-center">--}}
                                    {{--<h2 class="app-heading">{{$header}}</h2>--}}
                                    {{--<div class="app-card-footer">--}}
                                        {{--<h2 class="app-no mb-0">{{$value}}</h2>--}}
                                        {{--@php $chart1 += $value;@endphp--}}
                                    {{--</div>--}}
                                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                    {{--@if($chart1)--}}
                        {{--<div id="chartdiv1" style="width: 100%; height: 350px; margin-top: 2px;"></div>--}}
                    {{--@endif--}}
                {{--@endif--}}
                {{--@include('admin.tripartite.partial.ree_dashboard')--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="hearing-accordion-wrapper">--}}
            {{--<div class="m-portlet m-portlet--compact ol-reval-accordion mb-0">--}}
                {{--<div class="d-flex justify-content-between align-items-center">--}}
                    {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
                       {{--data-toggle="collapse" href="#ree-ol-reval-summary">--}}
                        {{--<span class="form-accordion-title">Application for Revalidation of Offer Letter </span>--}}
                        {{--<span class="accordion-icon ol-reval-accordion-icon"></span>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="ree-ol-reval-summary"--}}
                 {{--data-parent="#accordion">--}}
                {{--<div class="row no-gutters hearing-row">--}}
                    {{--<div class="col-12 no-shadow">--}}
                        {{--<div class="app-card-section-title">Offer Letter Revalidation</div>--}}
                    {{--</div>--}}
                    {{--@foreach($revalDashboardData[0] as $header => $value)--}}
                        {{--<div class="col-lg-3">--}}
                            {{--<div class="m-portlet app-card text-center">--}}
                                {{--<h2 class="app-heading">{{$header}}</h2>--}}
                                {{--<div class="app-card-footer">--}}
                                    {{--<h2 class="app-no mb-0">{{$value[0]}}</h2>--}}
                                    {{--@php $chart2 += $value[0];@endphp--}}
                                    {{--@if( $value[1] == 'pending')--}}
                                        {{--<a href="{{route('ree_applications.reval').$value[1]}}" class="app-card__details mb-0" data-toggle="modal" data-target="#reeRevalPendingModal">View Details</a>--}}
                                    {{--@else--}}
                                        {{--<a href="{{route('ree_applications.reval').$value[1]}}" class="app-card__details mb-0">View Details</a>--}}
                                    {{--@endif--}}
                                    {{--<a href="{{url(session()->get('redirect_to').$value[1])}}" class="app-card__details mb-0">View Details</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
                {{--@if($chart2)--}}
                    {{--<div id="reval_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>--}}
                {{--@endif--}}

                {{--@if($revalDashboardData1)--}}
                    {{--<div class="row no-gutters hearing-row">--}}
                        {{--<div class="col-12 no-shadow">--}}
                            {{--<div class="app-card-section-title">Offer Letter Revalidation Subordinate Pendency</div>--}}
                        {{--</div>--}}
                        {{--@foreach($revalDashboardData1 as $header => $value)--}}
                            {{--<div class="col-lg-3">--}}
                                {{--<div class="m-portlet app-card text-center">--}}
                                    {{--<h2 class="app-heading">{{$header}}</h2>--}}
                                    {{--<div class="app-card-footer">--}}
                                        {{--<h2 class="app-no mb-0">{{$value}}</h2>--}}
                                        {{--@php $chart3 += $value;@endphp--}}
                                    {{--</div>--}}
                                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                    {{--@if($chart3)--}}
                        {{--<div id="revalchartdiv1" style="width: 100%; height: 350px; margin-top: 2px;"></div>--}}
                    {{--@endif--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--@if($nocApplication)--}}
        {{--<div class="hearing-accordion-wrapper">--}}
            {{--<div class="m-portlet m-portlet--compact noc_accordian mb-0">--}}
                {{--<div class="d-flex justify-content-between align-items-center">--}}
                    {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
                       {{--data-toggle="collapse" href="#co-noc-summary">--}}
                        {{--<span class="form-accordion-title">Application for NOC</span>--}}
                        {{--<span class="accordion-icon noc-accordion-icon"></span>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
                {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="co-noc-summary"--}}
                     {{--data-parent="#accordion">--}}
                    {{--<div class="row no-gutters hearing-row">--}}
                        {{--<div class="col-12 no-shadow">--}}
                            {{--<div class="app-card-section-title">NOC</div>--}}
                        {{--</div>--}}
                        {{--@php $noc_chart = 0;@endphp--}}
                        {{--@foreach($nocApplication['app_data'] as $header => $value)--}}
                            {{--<div class="col-lg-3">--}}
                                {{--<div class="m-portlet app-card text-center">--}}
                                    {{--<h2 class="app-heading">{{$header}}</h2>--}}
                                    {{--<div class="app-card-footer">--}}
                                        {{--<h2 class="app-no mb-0">{{$value[0]}}</h2>--}}
                                        {{--@php $noc_chart += $value[0];@endphp--}}
                                        {{--<a target="_blank" href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                    {{--@if($noc_chart)--}}
                        {{--<div id="noc_chart_div" style="width: 100%; height: 350px; margin-top: 2px;"></div>--}}
                    {{--@endif--}}
                    {{--@if($nocApplication['pending_data'])--}}
                    {{--<div class="row no-gutters hearing-row">--}}
                        {{--<div class="col-12 no-shadow">--}}
                            {{--<div class="app-card-section-title">NOC Subordinate Pendency</div>--}}
                        {{--</div>--}}
                        {{--@foreach($nocApplication['pending_data'] as $pending_label => $pending_count)--}}
                            {{--<div class="col-lg-3">--}}
                                {{--<div class="m-portlet app-card text-center">--}}
                                    {{--<h2 class="app-heading">{{$pending_label}}</h2>--}}
                                    {{--<div class="app-card-footer">--}}
                                        {{--<h2 class="app-no mb-0">{{$pending_count}}</h2>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                    {{--@endif--}}
                {{--</div>--}}
        {{--</div>--}}
        {{--@endif--}}
        {{--@if($nocforCCApplication)--}}
        {{--<div class="hearing-accordion-wrapper">--}}
            {{--<div class="m-portlet m-portlet--compact noc_cc_accordian mb-0">--}}
                {{--<div class="d-flex justify-content-between align-items-center">--}}
                    {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
                       {{--data-toggle="collapse" href="#co-noc_cc-summary">--}}
                        {{--<span class="form-accordion-title">Application for NOC (CC)</span>--}}
                        {{--<span class="accordion-icon noc_cc-accordion-icon"></span>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
                {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="co-noc_cc-summary"--}}
                     {{--data-parent="#accordion">--}}
                    {{--<div class="row no-gutters hearing-row">--}}
                        {{--<div class="col-12 no-shadow">--}}
                            {{--<div class="app-card-section-title">NOC (CC)</div>--}}
                        {{--</div>--}}
                        {{--@php $noc_cc_chart = 0;@endphp--}}
                        {{--@foreach($nocforCCApplication['app_data'] as $header => $value)--}}
                            {{--<div class="col-lg-3">--}}
                                {{--<div class="m-portlet app-card text-center">--}}
                                    {{--<h2 class="app-heading">{{$header}}</h2>--}}
                                    {{--<div class="app-card-footer">--}}
                                        {{--<h2 class="app-no mb-0">{{$value[0]}}</h2>--}}
                                        {{--@php $noc_cc_chart += $value[0];@endphp--}}
                                        {{--<a target="_blank" href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                    {{--@if($noc_cc_chart)--}}
                        {{--<div id="noc_cc_chart_div" style="width: 100%; height: 350px; margin-top: 2px;"></div>--}}
                    {{--@endif--}}
                    {{--@if($nocforCCApplication['pending_data'])--}}
                    {{--<div class="row no-gutters hearing-row">--}}
                        {{--<div class="col-12 no-shadow">--}}
                            {{--<div class="app-card-section-title">NOC (CC) Subordinate Pendency</div>--}}
                        {{--</div>--}}
                        {{--@foreach($nocforCCApplication['pending_data'] as $pending_label => $pending_count)--}}
                            {{--<div class="col-lg-3">--}}
                                {{--<div class="m-portlet app-card text-center">--}}
                                    {{--<h2 class="app-heading">{{$pending_label}}</h2>--}}
                                    {{--<div class="app-card-footer">--}}
                                        {{--<h2 class="app-no mb-0">{{$pending_count}}</h2>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                    {{--@endif--}}
                {{--</div>--}}
        {{--</div>--}}
        {{--@endif--}}
        {{--@if((session()->get('role_name')==config('commanConfig.junior_architect'))||--}}
    {{--(session()->get('role_name')==config('commanConfig.senior_architect')) ||--}}
    {{--(session()->get('role_name')==config('commanConfig.architect')))--}}
    {{--@include('admin.dashboard.architect_layout.partials.architect_dashboard',compact('architect_data'))--}}
    {{--@endif--}}
    {{--@if(session()->get('role_name')==config('commanConfig.land_manager'))--}}
    {{--@include('admin.dashboard.architect_layout.partials.lm_dashboard',compact('architect_data'))--}}
    {{--@endif--}}
    {{--@if(session()->get('role_name')==config('commanConfig.estate_manager'))--}}
    {{--@include('admin.dashboard.architect_layout.partials.em_dashboard',compact('architect_data'))--}}
    {{--@endif--}}
    {{--@if (in_array(session()->get('role_name'),array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head'))))--}}
    {{--@include('admin.dashboard.architect_layout.partials.ee_dashboard',compact('architect_data'))--}}
    {{--@endif--}}
    {{--@if (in_array(session()->get('role_name'),array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head'))))--}}
    {{--@include('admin.dashboard.architect_layout.partials.ree_dashboard',compact('architect_data'))--}}
    {{--@endif--}}
    {{--@if(in_array(session()->get('role_name'),array(config('commanConfig.co_engineer'))))--}}
    {{--@include('admin.dashboard.architect_layout.partials.co_dashboard',compact('architect_data'))--}}
    {{--@endif--}}
    {{--@if(in_array(session()->get('role_name'),array(config('commanConfig.senior_architect_planner'))))--}}
    {{--@include('admin.dashboard.architect_layout.partials.sap_dashboard',compact('architect_data'))--}}
    {{--@endif--}}
    {{--@if(in_array(session()->get('role_name'),array(config('commanConfig.cap_engineer'))))--}}
    {{--@include('admin.dashboard.architect_layout.partials.cap_dashboard',compact('architect_data'))--}}
    {{--@endif--}}
    {{--@if(in_array(session()->get('role_name'),array(config('commanConfig.vp_engineer'))))--}}
    {{--@include('admin.dashboard.architect_layout.partials.vp_dashboard',compact('architect_data'))--}}
    {{--@endif--}}
    {{--</div>--}}

    <!-- Modal for send to society bifergation-->
    <div class="modal fade" id="reePendingModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Applications Pending</h4>
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
                            @if($dashboardData[1] )
                                @foreach($dashboardData[1]  as $header => $value)
                                    <tr>
                                        <td> {{$header}} </td>
                                        <td> {{$value}} </td>
                                    </tr>
                                @endforeach
                            @endif
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

    <!-- Modal for Reval Pending Bifurcation-->
    <div class="modal fade" id="reeRevalPendingModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Applications Pending</h4>
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
                            @if($revalDashboardData[1] )
                                @foreach($revalDashboardData[1]  as $header => $value)
                                    <tr>
                                        <td> {{$header}} </td>
                                        <td> {{$value}} </td>
                                    </tr>
                                @endforeach
                            @endif
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

    <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>

    {{--offer letter chart--}}
    @if($chart)
    <script>
        var chart;
        var legend;


        var chartData = [

                @foreach($dashboardData[0] as $header => $value)
                @if($header != 'Total Number of Applications'){
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

            // WRITE
            chart.write("ajaxchartdiv");
        });
    </script>
    @endif
    {{--offer letter chart--}}

    {{--offer letter subordinate pendency chart--}}
    @if($chart1)
    <script>
        var chart1;
        var legend;

        @if($dashboardData1)
        var chartData1 = [
            @foreach($dashboardData1 as $header => $value)
                @if($header != 'Total Number of Applications Pending'){
                    "status": '{{$header}}',
                    "value": '{{$value}}',
                },
                @endif
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
            chart1.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
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
    {{--end offer letter subordinate pendency chart--}}

    {{--offer letter revalidation chart--}}
    @if($chart2)
        <script>
            var chart2;
            var legend;


            var chartData2 = [

                    @foreach($revalDashboardData[0] as $header => $value)
                    @if($header != 'Total No of Applications'){
                    "status": '{{$header}}',
                    "value": '{{$value[0]}}',
                },
                @endif
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
                chart2.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                // this makes the chart 3D
                chart2.depth3D = 15;
                chart2.angle = 30;
                chart2.fontSize = 15;

                // WRITE
                chart2.write("reval_chart");
            });
        </script>
    @endif
    {{--end offer letter revalidation chart--}}

    {{--offer letter revalidation subordinate pendency chart--}}
    @if($chart3)
        <script>
            var chart3;
            var legend;

            var chartData3 = [
                            @foreach($revalDashboardData1 as $header => $value)
                            @if($header != 'Total Number of Applications Pending'){
                        "status": '{{$header}}',
                        "value": '{{$value}}',
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
                chart3.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                // this makes the chart 3D
                chart3.depth3D = 15;
                chart3.angle = 30;
                chart3.fontSize = 15;

                // WRITE
                chart3.write("revalchartdiv1");
            });
        </script>
    @endif
    {{--end offer letter revalidation subordinate pendency chart--}}

    {{--NOC chart--}}
    @if($noc_chart_pending)
        <script>
            var noc_chart_pending
            var legend;

            var noc_chart_pending_data = [
                    @foreach($nocApplication['pending_data'] as $pending_label => $pending_count)
                    @if($pending_label != 'Total number of Application Pending'){
                    "status": '{{$pending_label}}',
                    "value": '{{$pending_count}}',
                },
                @endif
                @endforeach
            ];

            AmCharts.ready(function () {
                // PIE CHART
                noc_chart_pending= new AmCharts.AmPieChart();
                noc_chart_pending.dataProvider = noc_chart_pending_data;
                noc_chart_pending.theme = "light";
                noc_chart_pending.labelRadius = -35;
                noc_chart_pending.labelText = "[[percents]]%";
                noc_chart_pending.titleField = "status";
                noc_chart_pending.valueField = "value";
                noc_chart_pending.outlineColor = "#FFFFFF";
                noc_chart_pending.outlineAlpha = 0.8;
                noc_chart_pending.outlineThickness = 2;
                noc_chart_pending.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                // this makes the chart 3D
                noc_chart_pending.depth3D = 15;
                noc_chart_pending.angle = 30;
                noc_chart_pending.fontSize = 15;

                // WRITE
                noc_chart_pending.write("noc_chart_pending");
            });
        </script>
    @endif
    {{--end NOC chart--}}

    {{--NOC subordinate pendency chart--}}
    @if($nocApplication['app_data'])
        <script>
            var noc_chart;
            var legend;

            var nocChartdata = [
                    @foreach($nocApplication['app_data'] as $header => $value)
                    @if($header != 'Total Number of Application'){
                    "status": '{{$header}}',
                    "value": '{{$value[0]}}',
                },
                @endif
                @endforeach
            ];

            AmCharts.ready(function () {
// PIE CHART
                noc_chart = new AmCharts.AmPieChart();
                noc_chart.dataProvider = nocChartdata;
                noc_chart.theme = "light";
                noc_chart.labelRadius = -35;
                noc_chart.labelText = "[[percents]]%";
                noc_chart.titleField = "status";
                noc_chart.valueField = "value";
                noc_chart.outlineColor = "#FFFFFF";
                noc_chart.outlineAlpha = 0.4;
                noc_chart.outlineThickness = 2;
                noc_chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                noc_chart.depth3D = 15;
                noc_chart.angle = 30;
                noc_chart.fontSize = 15;

                noc_chart.write("noc_chart_div");
            });
        </script>
    @endif
    {{--end NOC subordinate pendency chart--}}

    {{--NOC(CC) chart--}}
    @if($noc_cc_chart_pending)
        <script>
            var noc_cc_chart_pending
            var legend;

            var noc_cc_chart_pending_data = [
                    @foreach($nocforCCApplication['pending_data'] as $pending_label => $pending_count)
                    @if($pending_label != 'Total number of Application Pending'){
                    "status": '{{$pending_label}}',
                    "value": '{{$pending_count}}',
                },
                @endif
                @endforeach
            ];

            AmCharts.ready(function () {
                // PIE CHART
                noc_cc_chart_pending= new AmCharts.AmPieChart();
                noc_cc_chart_pending.dataProvider = noc_cc_chart_pending_data;
                noc_cc_chart_pending.theme = "light";
                noc_cc_chart_pending.labelRadius = -35;
                noc_cc_chart_pending.labelText = "[[percents]]%";
                noc_cc_chart_pending.titleField = "status";
                noc_cc_chart_pending.valueField = "value";
                noc_cc_chart_pending.outlineColor = "#FFFFFF";
                noc_cc_chart_pending.outlineAlpha = 0.8;
                noc_cc_chart_pending.outlineThickness = 2;
                noc_cc_chart_pending.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                // this makes the chart 3D
                noc_cc_chart_pending.depth3D = 15;
                noc_cc_chart_pending.angle = 30;
                noc_cc_chart_pending.fontSize = 15;

                // WRITE
                noc_cc_chart_pending.write("noc_cc_chart_pending");
            });
        </script>
        @endif
    {{--NOC(CC) chart--}}

    {{--NOC(CC) subordinate pendency chart--}}
    @if($nocforCCApplication['app_data'])
        <script>
        var noc_cc_chart;
        var legend;

        var nocCCChartdata = [
                        @foreach($nocforCCApplication['app_data'] as $header => $value)
                        @if($header != 'Total Number of Application'){
                            "status": '{{$header}}',
                            "value": '{{$value[0]}}',
                        },
                        @endif
                        @endforeach
            ];

        AmCharts.ready(function () {
// PIE CHART
            noc_cc_chart = new AmCharts.AmPieChart();
            noc_cc_chart.dataProvider = nocCCChartdata;
            noc_cc_chart.theme = "light";
            noc_cc_chart.labelRadius = -35;
            noc_cc_chart.labelText = "[[percents]]%";
            noc_cc_chart.titleField = "status";
            noc_cc_chart.valueField = "value";
            noc_cc_chart.outlineColor = "#FFFFFF";
            noc_cc_chart.outlineAlpha = 0.4;
            noc_cc_chart.outlineThickness = 2;
            noc_cc_chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
            noc_cc_chart.depth3D = 15;
            noc_cc_chart.angle = 30;
            noc_cc_chart.fontSize = 15;

            noc_cc_chart.write("noc_cc_chart_div");
        });

        </script>
    @endif
    {{--end NOC(CC) subordinate pendency chart--}}


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
                data: {module_name:module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {

                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">"+module_name+"</h3>\n" +
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
                            "                                    </tbody>\n" ;

                        var chart_count = 0 ;
                        var i = 1 ;
                        $.each(data[0], function (index, data) {

//                                        console.log(data);

                            html += "<tr>\n" +
                                "<td class=\"text-center\">"+i+"</td>" +
                                "<td>"+index+"</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">"+data[0]+"</span></td>\n" +
                                "<td class=\"text-center\">";

                            if(data[1] == "pending"){

                                html += "<a href=\""+redirect_to+"/"+data[1]+"\"class=\"btn btn-action\" data-toggle=\"modal\"\n" +
                                    "             data-target=\"#reePendingModal\">View</a>";
                            }
                            else{
                                html+= "<a href=\""+baseUrl+redirect_to+data[1]+"\"class=\"btn btn-action\">View</a>\n";

                            }
                            html += "</td>\n" +
                                "</tr>";

                            chart_count += data[0];
                            i++;
                        });

                        html +="</tbody>\n" +
                            "                                </table>\n" +
                            "                        </div>\n" +
                            "                    </div>" +
                            "                   </div>\n" +
                            "                        <div class=\"col-sm-5\" id=\"ajaxchartdiv\">\n" +
                            "                        </div>\n" +
                            "                </div>\n" +
                            "            </div>";

//                                    alert(chart_count);
                        $('#count_table').html(html);


                        if(chart_count){

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

                            var chart = AmCharts.makeChart( "ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider":chartData ,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor":"#FFFFFF",
                                "outlineThickness" : 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize" : 15,
                            } );
                        }
                    }
                    else {
                        alert('errror');
                    }
                },
            });

        });

    </script>
    {{--end ajax call for Count Table and Pie chart(renewal)--}}

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
                data: {module_name:module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {

                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">"+module_name+"</h3>\n" +
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
                            "                                    </tbody>\n" ;

                        var chart_count = 0 ;
                        var i = 1 ;
                        $.each(data, function (index, data) {

                            html += "<tr>\n" +
                                "<td class=\"text-center\">"+i+"</td>" +
                                "<td>"+index+"</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">"+data+"</span></td>\n" +
                                "</tr>";
                            chart_count += data;
                            i++;
                        });

                        html +="</tbody>\n" +
                            "                                </table>\n" +
                            "                        </div>\n" +
                            "                    </div>" +
                            "                   </div>\n" +
                            "                        <div class=\"col-sm-5\" id=\"ajaxchartdiv\">\n" +
                            "                        </div>\n" +
                            "                </div>\n" +
                            "            </div>";

                        $('#count_table').html(html);


                        if(chart_count){

                            var chartData = [];

                            $.each((data), function (index, data) {
                                obj = {};
                                if (index != 'Total Number of Applications') {
                                    obj['status'] = index;
                                    obj['value'] = data;
                                    chartData.push(obj);
                                }

                            });

                            var chart = AmCharts.makeChart( "ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider":chartData ,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor":"#FFFFFF",
                                "outlineThickness" : 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize" : 15,
                            } );
                        }
                    }
                    else {
                        alert('errror');
                    }
                },
            });

        });

    </script>
    {{--end ajax call for Count Table and Pie chart(offer letter)--}}

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
                data: {module_name:module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {


                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">"+module_name+"</h3>\n" +
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
                            "                                    </tbody>\n" ;

                        var chart_count = 0 ;
                        var i = 1 ;
                        $.each(data[0], function (index, data) {

//                                        console.log(data);

                            html += "<tr>\n" +
                                "<td class=\"text-center\">"+i+"</td>" +
                                "<td>"+index+"</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">"+data[0]+"</span></td>\n" +
                                "<td class=\"text-center\">";

                            if(data[1] == "pending"){

                                html += "<a href=\""+reval_application+"/"+data[1]+"\"class=\"btn btn-action\" data-toggle=\"modal\"\n" +
                                    "             data-target=\"#reeRevalPendingModal\">View</a>";
                            }
                            else{
                                html+= "<a href=\""+reval_application+data[1]+"\"class=\"btn btn-action\">View</a>\n";

                            }
                            html += "</td>\n" +
                                "</tr>";

                            chart_count += data[0];
                            i++;
                        });

                        html +="</tbody>\n" +
                            "                                </table>\n" +
                            "                        </div>\n" +
                            "                    </div>" +
                            "                   </div>\n" +
                            "                        <div class=\"col-sm-5\" id=\"ajaxchartdiv\">\n" +
                            "                        </div>\n" +
                            "                </div>\n" +
                            "            </div>";

//                                    alert(chart_count);
                        $('#count_table').html(html);


                        if(chart_count){

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

                            var chart = AmCharts.makeChart( "ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider":chartData ,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor":"#FFFFFF",
                                "outlineThickness" : 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize" : 15,
                            } );
                        }
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
                data: {module_name:module_name},
                dataType: 'json',
                success: function (data) {
                    if (data !== "false") {

                        var html = "";

                        html += "<div id=\"count_table\">\n" +
                            "                <div class=\"m-subheader px-0 m-subheader--top\">\n" +
                            "                    <div class=\"d-flex align-items-center\">\n" +
                            "                        <h3 class=\"m-subheader__title\">"+module_name+"</h3>\n" +
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
                            "                                    </tbody>\n" ;

                        var chart_count = 0 ;
                        var i = 1 ;
                        $.each(data, function (index, data) {

                            html += "<tr>\n" +
                                "<td class=\"text-center\">"+i+"</td>" +
                                "<td>"+index+"</td>\n" +
                                "<td class=\"text-center\"><span class=\"count-circle\">"+data+"</span></td>\n" +
                                "</tr>";
                            chart_count += data;
                            i++;
                        });

                        html +="</tbody>\n" +
                            "                                </table>\n" +
                            "                        </div>\n" +
                            "                    </div>" +
                            "                   </div>\n" +
                            "                        <div class=\"col-sm-5\" id=\"ajaxchartdiv\">\n" +
                            "                        </div>\n" +
                            "                </div>\n" +
                            "            </div>";

                        $('#count_table').html(html);


                        if(chart_count){

                            var chartData = [];

                            $.each((data), function (index, data) {
                                obj = {};
                                if (index != 'Total Number of Applications') {
                                    obj['status'] = index;
                                    obj['value'] = data;
                                    chartData.push(obj);
                                }

                            });

                            var chart = AmCharts.makeChart( "ajaxchartdiv", {
                                "type": "pie",
                                "theme": "light",
                                "dataProvider":chartData ,
                                "valueField": "value",
                                "titleField": "status",
                                "outlineAlpha": 0.8,
                                "outlineColor":"#FFFFFF",
                                "outlineThickness" : 2,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                                "angle": 30,
                                "labelText": "[[percents]]%",
                                "labelRadius": -35,
                                "fontSize" : 15,
                            } );
                        }
                    }
                    else {
                        alert('errror');
                    }
                },
            });

        });

    </script>
    {{--end ajax call for Pendency Count Table and Pie chart(revalidation)--}}



@endsection

