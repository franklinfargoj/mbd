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
                    <span class="form-accordion-title">Today's Hearing ({{count($data['todays_rti_meetings'])}})</span>
                    @if(count($data['todays_rti_meetings'])>0)
                    <span class="accordion-icon"></span>
                    @endif
                </a>
            </div>
        </div>

        <div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="todays-hearing"
            data-parent="#accordion">
            @foreach($data['todays_rti_meetings'] as $meeting)
            <div class="row no-gutters hearing-row">
                <div class="col-12 no-shadow">
                    <div class="app-card-section-title">Today's RTI Meetings</div>
                </div>
                <div class="col-lg-3">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Application No</h2>
                    <h2 class="app-no mb-0">{{$meeting->unique_id}}</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Applicant Name</h2>
                        <h2 class="app-no mb-0">{{$meeting->applicant_name}}</h2>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Date of Submission</h2>
                        <h2 class="app-no mb-0">{{date('d-m-Y',strtotime($meeting->created_at))}}</h2>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Meeting Time</h2>
                        <h2 class="app-no mb-0">{{$meeting->rti_schedule_meetings->meeting_time}}</h2>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="m-portlet app-card text-center">
                    <a href="{{route('schedule_meeting',['id'=>$meeting->id])}}" class="app-no app-no--view mb-0">View
                            Details</a>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="row no-gutters hearing-row">
                <div class="col-12 no-shadow">
                    <div class="app-card-section-title">Dashboard</div>
                </div>
                <div class="col-lg-4">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Total No of RTI Applications</h2>
                    <h2 class="app-no mb-0">{{$data['total_no_of_applications']}}</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Total No of Pending RTI</h2>
                        <h2 class="app-no mb-0">{{$data['pending_rti_count']}}</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="m-portlet app-card text-center">
                        <h2 class="app-heading">Total Number of Closed RTI</h2>
                        <h2 class="app-no mb-0">{{$data['number_of_rti_cases_closed']}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection