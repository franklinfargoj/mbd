@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Today's Hearing</h3>
        </div>
    </div>
    <div class="m-portlet m-portlet--compact form-accordion">
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100 collapsed" data-toggle="collapse"
                href="#todays-hearing"><span class="form-accordion-title">Today's Hearing</span><span class="accordion-icon"></span></a>
        </div>
    </div>
    
    <div class="m-portlet__body m-portlet__body--spaced collapse" id="todays-hearing" data-parent="#accordion">
        <div class="row hearing-row">
            <div class="col">
                <h2 class="app-heading">Case Year</h2>
                <div class="m-portlet app-card text-center">
                    <h2 class="app-no mb-0">240</h2>
                </div>
            </div>
            <div class="col">
                <h2 class="app-heading">Case NO</h2>
                <div class="m-portlet app-card text-center">
                    <h2 class="app-no mb-0">250</h2>
                </div>
            </div>
            <div class="col">
                <h2 class="app-heading">Hearing Time</h2>        
                <div class="m-portlet app-card text-center">
                    <h2 class="app-no mb-0">240</h2>
                </div>
            </div>
            <div class="col">
                <h2 class="app-heading">Applicant Name</h2>
                <div class="m-portlet app-card text-center">
                    <h2 class="app-no mb-0">10</h2>
                </div>
            </div>
            <div class="col">
                <h2 class="app-heading">Action</h2>
                <div class="m-portlet app-card text-center">
                    <h2 class="app-no app-no--view mb-0">View Details</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="m-subheader px-0 m-subheader--top mt-4">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Dashboard</h3>
            </div>
        </div>
        <div class="row hearing-row">
            <div class="col">
                <h2 class="app-heading">Total No of Cases</h2>
                <div class="m-portlet app-card text-center">
                    <h2 class="app-no mb-0">{{$totalHearing}}</h2>
                </div>
            </div>
            <div class="col">
                <h2 class="app-heading">Total No of Pending Cases</h2>
                <div class="m-portlet app-card text-center">
                    <h2 class="app-no mb-0">{{$totalPendingHearing}}</h2>
                </div>
            </div>
            <div class="col">
                <h2 class="app-heading">Total No of Closed Cases</h2>        
                <div class="m-portlet app-card text-center">
                    <h2 class="app-no mb-0">{{$totalClosedHearing}}</h2>
                </div>
            </div>
            <div class="col"></div>
            <div class="col"></div>
        </div>
</div>
@endsection
