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
        $chart4 = 0;
        $chart5 = 0;
        $chart6 = 0;
    @endphp


    <div class="container-fluid">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Dashboard</h3>
            </div>
        </div>

        {{--Todays Hearing--}}
        <div class="hearing-accordion-wrapper">

            <div class="m-portlet m-portlet--compact hearing-accordion mb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100 collapsed"
                       data-toggle="collapse" href="#todays-hearing">
                        <span class="form-accordion-title">Today's Hearing ({{$todays_hearing_count}})</span>
                        @if($todaysHearing)
                            <span class="accordion-icon"></span>
                        @endif
                    </a>
                </div>
            </div>

            <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="todays-hearing"
                 data-parent="#accordion">
                @foreach($todaysHearing as $hearing)
                    <div class="row no-gutters hearing-row">
                        <div class="col-12 no-shadow">
                            <div class="app-card-section-title">Today's Hearing</div>
                        </div>
                        <div class="col-lg-3">
                            <div class="m-portlet app-card text-center">
                                <h2 class="app-heading">Case Year</h2>
                                <h2 class="app-no mb-0">{{$hearing['case_year']}}</h2>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="m-portlet app-card text-center">
                                <h2 class="app-heading">Case NO</h2>
                                <h2 class="app-no mb-0">{{$hearing['id']}}</h2>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="m-portlet app-card text-center">
                                <h2 class="app-heading">Hearing Time</h2>
                                <h2 class="app-no mb-0">{{$hearing['hearing_schedule']['preceding_time']}}</h2>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="m-portlet app-card text-center">
                                <h2 class="app-heading">Applicant Name</h2>
                                <h2 class="app-no mb-0">{{$hearing['applicant_name']}}</h2>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="m-portlet app-card text-center">
                                <a href="{{route('hearing.show',encrypt($hearing['id']))}}" class="app-no app-no--view mb-0">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        {{--End Todays Hearing--}}

        <div class="d-flex flex-wrap db-wrapper">
            <div class="db__card">
                <div class="db__card__img-wrap db-color-1">
                    <h3 class="db__card__count">{{$hearingDashboardData['Total Number of Cases'][0]}}</h3>
                </div>
                <p class="db__card__title">Hearing Summary</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-2">
                    <h3 class="db__card__count">{{$dashboardData['Total No of Applications'][0]}}</h3>
                </div>
                <p class="db__card__title">Offer Letter</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-3">
                    <h3 class="db__card__count">{{$dashboardData1['Total Number of Applications']}}</h3>
                </div>
                <p class="db__card__title">Offer Letter Subordinate Pendency</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-4">
                    <h3 class="db__card__count">48</h3>
                </div>
                <p class="db__card__title">Tripartite Agreement</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-5">
                    <h3 class="db__card__count">48</h3>
                </div>
                <p class="db__card__title">Tripartite Agreement Subordinate Pendency</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-6">
                    <h3 class="db__card__count">{{$revalDashboardData['Total No of Applications'][0]}}</h3>
                </div>
                <p class="db__card__title">Offer Letter Revalidation</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-7">
                    <h3 class="db__card__count">{{$revalDashboardData1['Total Number of Applications']}}</h3>
                </div>
                <p class="db__card__title">Offer Letter Revalidation Subordinate Pendency</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-8">
                    <h3 class="db__card__count">{{$conveyanceDashboard[0]['Total No of Applications'][0]}}</h3>
                </div>
                <p class="db__card__title">Society Conveyance</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-9">
                    <h3 class="db__card__count">-</h3>
                </div>
                <p class="db__card__title">Society Conveyance Subordinate Pendency</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-10">
                    <h3 class="db__card__count">{{$nocApplication['app_data']['Total Number of Applications'][0]}}</h3>
                </div>
                <p class="db__card__title">NOC</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-11">
                    <h3 class="db__card__count">{{$nocApplication['pending_data']['Total Number of Applications']}}</h3>
                </div>
                <p class="db__card__title">NOC Subordinate Pendency</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-12">
                    <h3 class="db__card__count">{{$nocforCCApplication['app_data']['Total Number of Applications'][0]}}</h3>
                </div>
                <p class="db__card__title">NOC (CC)</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-13">
                    <h3 class="db__card__count">{{$nocforCCApplication['pending_data']['Total Number of Applications']}}</h3>
                </div>
                <p class="db__card__title">NOC (CC) Subordinate Pendency</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-14">
                    <h3 class="db__card__count">
                        {{$architect_data['total_no_of_layout']}}
                    </h3>
                </div>
                <p class="db__card__title">Layout Revision & Approval</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-15">
                    <h3 class="db__card__count">-</h3>
                </div>
                <p class="db__card__title">Layout Approval</p>
            </div>
            <div class="db__card">
                <div class="db__card__img-wrap db-color-16">
                    <h3 class="db__card__count">-</h3>
                </div>
                <p class="db__card__title">Layout Forwarded for Approval</p>
            </div>
        </div>

        {{--Dashboard for Hearing Summary--}}
        <div>
            <div class="m-subheader px-0 m-subheader--top">
                <div class="d-flex align-items-center">
                    <h3 class="m-subheader__title">Hearing Summary</h3>
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
                                @php $chart4 = 0; $i=1; @endphp
                                @foreach($hearingDashboardData as $header => $value)
                                    <tr>
                                        <td class="text-center">{{$i}}.</td>
                                        <td>{{$header}}</td>
                                        <td class="text-center"><span class="count-circle">{{$value[0]}}</span></td>
                                        <td>
                                            <a href='{{url('/hearing'.$value[1])}}' class="btn btn-action">View</a>

                                        </td>
                                    </tr>
                                    @php $chart4 += $value[0]; $i++;@endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if($chart4)
                    <div id="hearing_chart" class="col-sm-5"></div>
                @endif
            </div>
        </div>
        {{--End Dashboard for Hearing Summary--}}

        {{--Dashboard for offer letter--}}
        @if($dashboardData)
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
                                        $i = 1;
                                    @endphp

                                    @foreach($dashboardData as $header => $value)
                                        <tr>
                                            <td class="text-center">{{$i}}.</td>
                                            <td>{{$header}}</td>
                                            <td class="text-center"><span class="count-circle">{{$value[0]}}</span></td>
                                            <td>
                                                <a href="{{url(session()->get('redirect_to').$value[1])}}" class="btn btn-action">View</a>
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
                        <div id="chartdiv" class="col-sm-5"></div>
                    @endif
                </div>
            </div>
        @endif
        {{--End Dashboard for offer letter--}}

        {{--Dashboard for offer letter subordinate pendency--}}
        @if($dashboardData1)
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
                                        $i = 1;
                                    @endphp

                                    @foreach($dashboardData1 as $header => $value)
                                        <tr>
                                            <td class="text-center">{{$i}}.</td>
                                            <td>{{$header}}</td>
                                            <td class="text-center"><span class="count-circle">{{$value}}</span></td>
                                            @php $chart1 += $value; $i++; @endphp
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($chart1)
                        <div id="chartdiv1" class="col-sm-5"></div>
                    @endif
                </div>
            </div>
        @endif
        {{--End Dashboard for offer letter subordinate pendency--}}

        {{--Dashboard for offer letter revalidation--}}
        @if($revalDashboardData)
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

                                    @foreach($revalDashboardData as $header => $value)
                                        <tr>
                                            <td class="text-center">{{$i}}.</td>
                                            <td>{{$header}}</td>
                                            <td class="text-center"><span class="count-circle">{{$value[0]}}</span></td>
                                            <td>
                                                @if( $value[1] == 'pending')
                                                    <a href="{{route('co_applications.reval').$value[1]}}" class="btn btn-action" data-toggle="modal" data-target="#reeRevalPendingModal">View</a>
                                                @else
                                                    <a href="{{route('co_applications.reval').$value[1]}}" class="btn btn-action">View</a>
                                                @endif
                                            </td>
                                            @php $chart5 += $value[0]; $i++; @endphp
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($chart5)
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
                                            @php $chart6 += $value; $i++; @endphp
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($chart6)
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

        {{--Dashboard for society Conveyance--}}
        @if($conveyanceDashboard[0])
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
                                        $i = 1;
                                    @endphp

                                    @foreach($conveyanceDashboard[0] as $header => $value)
                                        <tr>
                                            <td class="text-center">{{$i}}.</td>
                                            <td>{{$header}}</td>
                                            <td class="text-center"><span class="count-circle">{{$value[0]}}</span></td>
                                            <td>
                                                @if( $value[1] == 'pending')
                                                    <a href="{{url($value[1])}}" class="btn btn-action" data-toggle="modal" data-target="#pending">View</a>
                                                @elseif( $value[1] == 'sendToSociety')
                                                    <a href="{{url($value[1])}}" class="btn btn-action" data-toggle="modal" data-target="#sendToSociety">View</a>
                                                @else
                                                    <a href="{{url($value[1])}}" class="btn btn-action">View</a>
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
                        <div id="conveyance_chart" class="col-sm-5"></div>
                    @endif
                </div>
            </div>
        @endif
        {{--End Dashboard for society Conveyance--}}

        {{--Dashboard for society Conveyance subordinate pendency--}}
        @if($pendingApplications)
            <div>
                <div class="m-subheader px-0 m-subheader--top">
                    <div class="d-flex align-items-center">
                        <h3 class="m-subheader__title">Society Conveyance Subordinate Pendency</h3>
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

                                    @foreach($pendingApplications as $header => $value)
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
                        <div id="pending_conveyance_chart" class="col-sm-5"></div>
                    @endif
                </div>
            </div>
        @endif
        {{--End Dashboard for society Conveyance subordinate pendency--}}

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

    </div>








    {{--<div class="container-fluid">--}}
        {{--<div class="m-subheader px-0 m-subheader--top">--}}
            {{--<div class="d-flex align-items-center">--}}
                {{--<h3 class="m-subheader__title">Dashboard</h3>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="hearing-accordion-wrapper">--}}

            {{--<div class="m-portlet m-portlet--compact hearing-accordion mb-0">--}}
                {{--<div class="d-flex justify-content-between align-items-center">--}}
                    {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100 collapsed"--}}
                       {{--data-toggle="collapse" href="#todays-hearing">--}}
                        {{--<span class="form-accordion-title">Today's Hearing ({{$todays_hearing_count}})</span>--}}
                        {{--@if($todaysHearing)--}}
                            {{--<span class="accordion-icon"></span>--}}
                        {{--@endif--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="todays-hearing"--}}
                 {{--data-parent="#accordion">--}}
                {{--@foreach($todaysHearing as $hearing)--}}
                    {{--<div class="row no-gutters hearing-row">--}}
                        {{--<div class="col-12 no-shadow">--}}
                            {{--<div class="app-card-section-title">Today's Hearing</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-3">--}}
                            {{--<div class="m-portlet app-card text-center">--}}
                                {{--<h2 class="app-heading">Case Year</h2>--}}
                                {{--<h2 class="app-no mb-0">{{$hearing['case_year']}}</h2>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-3">--}}
                            {{--<div class="m-portlet app-card text-center">--}}
                                {{--<h2 class="app-heading">Case NO</h2>--}}
                                {{--<h2 class="app-no mb-0">{{$hearing['id']}}</h2>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-3">--}}
                            {{--<div class="m-portlet app-card text-center">--}}
                                {{--<h2 class="app-heading">Hearing Time</h2>--}}
                                {{--<h2 class="app-no mb-0">{{$hearing['hearing_schedule']['preceding_time']}}</h2>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-3">--}}
                            {{--<div class="m-portlet app-card text-center">--}}
                                {{--<h2 class="app-heading">Applicant Name</h2>--}}
                                {{--<h2 class="app-no mb-0">{{$hearing['applicant_name']}}</h2>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-3">--}}
                            {{--<div class="m-portlet app-card text-center">--}}
                                {{--<a href="{{route('hearing.show',encrypt($hearing['id']))}}" class="app-no app-no--view mb-0">View--}}
                                    {{--Details</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}

        {{--</div>--}}
        {{--<div class="hearing-accordion-wrapper">--}}
            {{--<div class="m-portlet m-portlet--compact hearing-accordion1 mb-0">--}}
                {{--<div class="d-flex justify-content-between align-items-center">--}}
                    {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
                       {{--data-toggle="collapse" href="#hearing-summary">--}}
                        {{--<span class="form-accordion-title">Hearing Summary</span>--}}
                        {{--<span class="accordion-icon hearing-accordion-icon"></span>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="hearing-summary"--}}
                 {{--data-parent="#accordion">--}}
                {{--<div class="row no-gutters hearing-row">--}}
                    {{--<div class="col-12 no-shadow">--}}
                        {{--<div class="app-card-section-title">Hearing</div>--}}
                    {{--</div>--}}
                    {{--@foreach($hearingDashboardData as $header => $value)--}}
                        {{--<div class="col-lg-3">--}}
                            {{--<div class="m-portlet app-card text-center">--}}
                                {{--<h2 class="app-heading">{{$header}}</h2>--}}
                                {{--<div class="app-card-footer">--}}
                                    {{--<h2 class="app-no mb-0">{{$value[0]}}</h2>--}}
                                    {{--@php $chart4 += $value[0];@endphp--}}
                                    {{--<a href='{{url('/hearing'.$value[1])}}' class="app-card__details mb-0">View Details</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
                {{--@if($chart4)--}}
                    {{--<div id="hearing_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}


        {{--<div class="hearing-accordion-wrapper">--}}
            {{--<div class="m-portlet m-portlet--compact ol-accordion mb-0">--}}
                {{--<div class="d-flex justify-content-between align-items-center">--}}
                    {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
                       {{--data-toggle="collapse" href="#co-ol-summary">--}}
                        {{--<span class="form-accordion-title">Application for Redevelopment</span>--}}
                        {{--<span class="accordion-icon ol-accordion-icon"></span>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="co-ol-summary"--}}
                 {{--data-parent="#accordion">--}}
                {{--<div class="row no-gutters hearing-row">--}}
                    {{--<div class="col-12 no-shadow">--}}
                        {{--<div class="app-card-section-title">Offer Letter</div>--}}
                    {{--</div>--}}
                    {{--@foreach($dashboardData as $header => $value)--}}
                        {{--<div class="col-lg-3">--}}
                            {{--<div class="m-portlet app-card text-center">--}}
                                {{--<h2 class="app-heading">{{$header}}</h2>--}}
                                {{--<div class="app-card-footer">--}}
                                    {{--<h2 class="app-no mb-0">{{$value[0]}}</h2>--}}
                                    {{--@php $chart += $value[0];@endphp--}}
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
                                {{--<!-- <a href="{{url(session()->get('redirect_to').$value[1])}}" class="app-card__details mb-0">View Details</a> -->--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                    {{--@if($chart1)--}}
                        {{--<div id="chartdiv1" style="width: 100%; height: 350px; margin-top: 2px;"></div>--}}
                    {{--@endif--}}
                {{--@endif--}}

                {{--@include('admin.tripartite.partial.co_dashboard')--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<!-- Dashboard for renewal Module -->--}}
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
                    {{--@foreach($revalDashboardData as $header => $value)--}}
                        {{--<div class="col-lg-3">--}}
                            {{--<div class="m-portlet app-card text-center">--}}
                                {{--<h2 class="app-heading">{{$header}}</h2>--}}
                                {{--<div class="app-card-footer">--}}
                                    {{--<h2 class="app-no mb-0">{{$value[0]}}</h2>--}}
                                    {{--@php $chart5 += $value[0];@endphp--}}
                                    {{--@if( $value[1] == 'pending')--}}
                                        {{--<a href="{{route('co_applications.reval').$value[1]}}" class="app-card__details mb-0" data-toggle="modal" data-target="#reeRevalPendingModal">View Details</a>--}}
                                    {{--@else--}}
                                        {{--<a href="{{route('co_applications.reval').$value[1]}}" class="app-card__details mb-0">View Details</a>--}}
                                    {{--@endif--}}
                                    {{--<a href="{{url(session()->get('redirect_to').$value[1])}}" class="app-card__details mb-0">View Details</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
                {{--@if($chart5)--}}
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
                                        {{--@php $chart6 += $value;@endphp--}}
                                    {{--</div>--}}
                                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                    {{--@if($chart6)--}}
                        {{--<div id="revalchartdiv1" style="width: 100%; height: 350px; margin-top: 2px;"></div>--}}
                    {{--@endif--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}


        {{--<!-- Dashboard for Convayance Module -->--}}
        {{--@if($conveyanceDashboard)--}}
            {{--<div class="hearing-accordion-wrapper">--}}
                {{--<div class="m-portlet m-portlet--compact conveyance-accordion mb-0">--}}
                    {{--<div class="d-flex justify-content-between align-items-center">--}}
                        {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
                           {{--data-toggle="collapse" href="#conveyance_dashboard">--}}
                            {{--<span class="form-accordion-title">Application for Society Conveyance</span>--}}
                            {{--<span class="accordion-icon conveyance-accordion-icon"></span>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="conveyance_dashboard"--}}
                     {{--data-parent="#accordion">--}}
                    {{--<div class="row no-gutters hearing-row">--}}
                        {{--<div class="col-12 no-shadow">--}}
                            {{--<div class="app-card-section-title">Society Conveyance</div>--}}
                        {{--</div>--}}
                        {{--@foreach($conveyanceDashboard[0] as $header => $value)--}}
                            {{--<div class="col-lg-3">--}}
                                {{--<div class="m-portlet app-card text-center">--}}
                                    {{--<h2 class="app-heading">{{$header}}</h2>--}}
                                    {{--<div class="app-card-footer">--}}
                                        {{--<h2 class="app-no mb-0">{{$value[0]}}</h2>--}}
                                        {{--@if( $value[1] == 'pending')--}}
                                            {{--<a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#pending">View Details</a>--}}
                                        {{--@elseif( $value[1] == 'sendToSociety')--}}
                                            {{--<a href="{{url($value[1])}}" class="app-card__details mb-0" data-toggle="modal" data-target="#sendToSociety">View Details</a>--}}
                                        {{--@else--}}
                                            {{--<a href="{{url($value[1])}}" class="app-card__details mb-0">View Details</a>--}}
                                        {{--@endif--}}
                                        {{--@php $chart2 += $value[0]; @endphp--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                    {{--@if($chart2)--}}
                        {{--<div id="conveyance_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>--}}
                    {{--@endif--}}
                    {{--@if($pendingApplications)--}}
                        {{--<div class="row no-gutters hearing-row">--}}
                            {{--<div class="col-12 no-shadow">--}}
                                {{--<div class="app-card-section-title">Society Conveyance Subordinate Pendency</div>--}}
                            {{--</div>--}}
                            {{--@foreach($pendingApplications as $header => $value)--}}
                                {{--<div class="col-lg-3">--}}
                                    {{--<div class="m-portlet app-card text-center">--}}
                                        {{--<h2 class="app-heading">{{$header}}</h2>--}}
                                        {{--<div class="app-card-footer">--}}
                                            {{--<h2 class="app-no mb-0">{{$value}}</h2>--}}
                                            {{--@php $chart3 += $value; @endphp--}}
                                        {{--</div>--}}
                                        {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                        {{--@if($chart3)--}}
                            {{--<div id="pending_conveyance_chart" style="width: 100%; height: 350px; margin-top: 2px;"></div>--}}
                        {{--@endif--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endif--}}
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

    <!-- Modal for application pending bifergation -->
    <div class="modal fade" id="pending" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pending Applications</h4>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <th>Header</th>
                            <th>Count</th>
                        </tr>
                        @if($conveyanceDashboard[1])
                            @foreach($conveyanceDashboard[1] as $header => $value)
                                <tr>
                                    <td> {{$header}} </td>
                                    <td> {{$value}} </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                    <!-- <p>Some text in the modal.</p> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                    <table>
                        <tr>
                            <th>Header</th>
                            <th>Count</th>
                        </tr>
                        @if($conveyanceDashboard[2])
                            @foreach($conveyanceDashboard[2] as $header => $value)
                                <tr>
                                    <td> {{$header}} </td>
                                    <td> {{$value}} </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                    <!-- <p>Some text in the modal.</p> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(".hearing-accordion1").on("click", function () {
            var data = $('.hearing-accordion1').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.hearing-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.hearing-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.hearing-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });
    </script>
    <script>
        $(".ol-accordion").on("click", function () {
            var data = $('.ol-accordion').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.ol-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.ol-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.ol-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });

//        $('.noc-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");

        $(".noc_accordian").on("click", function () {
            var data = $('.noc_accordian').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.noc-accordion-icon').css('background-image', "url('../../../../img/minuss-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.noc-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.noc-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });

        $(".ol-reval-accordion").on("click", function () {
            var data = $('.ol-reval-accordion').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.ol-reval-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.ol-reval-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.ol-reval-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });
//        $('.noc_cc-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");

        $(".noc_cc_accordian").on("click", function () {
            var data = $('.noc_cc_accordian').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.noc_cc-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.noc_cc-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.noc_cc-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });
    </script>
    <script>
        $(".architect-accordion").on("click", function () {
            var data = $('.architect-accordion').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.architect-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.architect-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.architect-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });
    </script>
    <script>
        $(".conveyance-accordion").on("click", function () {
            var data = $('.conveyance-accordion').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.conveyance-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.conveyance-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.conveyance-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });
        $(".architect-layout-approval-co-accordion").on("click", function () {
            var data = $('.architect-layout-approval-co-accordion').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.architect-layout-approval-co-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.architect-layout-approval-co-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.architect-layout-approval-co-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });
        $(".architect-layout-revision-co-accordion").on("click", function () {
            var data = $('.architect-layout-revision-co-accordion').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.architect-layout-revision-co-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.architect-layout-revision-co-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.architect-layout-revision-co-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });
        $(".vp-layout-approval-accordion-icon").on("click", function () {
            var data = $('.vp-layout-approval-accordion-icon').children().children().attr('aria-expanded');
            if (!(data)) {
                $('.vp-layout-approval-accordion-icon-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
            }
            else {
                if (data == 'undefine' || data == 'false') {
                    $('.vp-layout-approval-accordion-icon-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                } else {
                    $('.vp-layout-approval-accordion-icon-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                }
            }
        });
    </script>
    <script type="text/javascript" src="{{ asset('/js/amcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/pie.js') }}"></script>

    {{--Offer letter chart--}}
    @if($chart)
        <script>
            var chart;
            var legend;
            var chartData = [

                    @foreach($dashboardData as $header => $value)
                    @if($header != 'Total No of Applications'){
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
                chart.write("chartdiv");
            });
        </script>
    @endif
    {{--Offer letter chart--}}


    {{--Offer letter subordinate pedency chart--}}
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
    {{--Offer letter subordinate pedency chart--}}


    {{--society Conveyance chart--}}
    @if($chart2)
        <script>
            var chart2;
            var legend;
                    @if($conveyanceDashboard)
            var chartData2 = [

                            @foreach($conveyanceDashboard[0] as $header => $value)
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
                chart2.write("conveyance_chart");
            });
            @endif
        </script>
    @endif
    {{--society Conveyance chart--}}

    {{--society Conveyance subordinate pedency chart--}}
    @if($chart3)
        <script>
            var chart3;
            var legend;

                    @if($pendingApplications)
            var chartData3 = [
                            @foreach($pendingApplications as $header => $value)
                            @if($header != 'Total Number of Applications Pending')
                    {"status": '{{$header}}',
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
                chart3.colors = [ "#f0791b", "#ffc063", "#8bc34a", "#754DEB", "#DDDDDD", "#999999", "#333333", "#179252", "#57032A", "#CA9726", "#990000", "#4B0C25"]
                chart3.fontSize = 15;

// WRITE
                chart3.write("pending_conveyance_chart");
            });
            @endif

        </script>
    @endif
    {{--end society Conveyance subordinate pedency chart--}}


    {{--Hearing summary chart--}}
    @if($chart4)
        <script>
            var chart4;
            var legend;

            var chartData4 = [
                    @foreach($hearingDashboardData as $header => $value)
                    @if(!($header == 'Total Number of Cases'))
                {
                    "status": "{{$header}}",
                    "value": "{{$value[0]}}",
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
                chart4.write("hearing_chart");
            });
        </script>
    @endif
    {{--Hearing summary chart--}}


    {{--Offer letter revalidation chart--}}
    @if($chart5)
        <script>
            var chart5;
            var legend;


            var chartData5 = [

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
                chart5 = new AmCharts.AmPieChart();
                chart5.dataProvider = chartData5;
                chart5.theme = "light";
                chart5.labelRadius = -35;
                chart5.labelText = "[[percents]]%";
                chart5.titleField = "status";
                chart5.valueField = "value";
                chart5.outlineColor = "#FFFFFF";
                chart5.outlineAlpha = 0.8;
                chart5.outlineThickness = 2;
                chart5.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                // this makes the chart 3D
                chart5.depth3D = 15;
                chart5.angle = 30;
                chart5.fontSize = 15;

                // WRITE
                chart5.write("reval_chart");
            });
        </script>
    @endif
    {{--end Offer letter revalidation chart--}}


    {{--Offer letter revalidation subordinate pendency chart--}}
    @if($chart6)
        <script>
            var chart6;
            var legend;

            var chartData6 = [
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
                chart6 = new AmCharts.AmPieChart();
                chart6.dataProvider = chartData6;
                chart6.theme = "light";
                chart6.labelRadius = -35;
                chart6.labelText = "[[percents]]%";
                chart6.titleField = "status";
                chart6.valueField = "value";
                chart6.outlineColor = "#FFFFFF";
                chart6.outlineAlpha = 0.8;
                chart6.outlineThickness = 2;
                chart6.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                // this makes the chart 3D
                chart6.depth3D = 15;
                chart6.angle = 30;
                chart6.fontSize = 15;

                // WRITE
                chart6.write("revalchartdiv1");
            });
        </script>
    @endif
    {{--end Offer letter subordinate pendency revalidation chart--}}


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