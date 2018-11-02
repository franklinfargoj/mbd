@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Today's Hearing</h3>
        </div>
    </div>
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
    <div class="m-subheader px-0 m-subheader--top mt-4">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Dashboard</h3>
            </div>
        </div>
        <div class="row hearing-row">
            <div class="col">
                <h2 class="app-heading">Total No of Cases</h2>
                <div class="m-portlet app-card text-center">
                    <h2 class="app-no mb-0">240</h2>
                </div>
            </div>
            <div class="col">
                <h2 class="app-heading">Total No of Pending Cases</h2>
                <div class="m-portlet app-card text-center">
                    <h2 class="app-no mb-0">250</h2>
                </div>
            </div>
            <div class="col">
                <h2 class="app-heading">Total No of Closed Cases</h2>        
                <div class="m-portlet app-card text-center">
                    <h2 class="app-no mb-0">240</h2>
                </div>
            </div>
            <div class="col"></div>
            <div class="col"></div>
        </div>
</div>
@endsection
