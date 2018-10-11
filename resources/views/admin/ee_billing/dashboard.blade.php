@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Application for Society Conveyance</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="m-portlet app-card">
                <h2 class="app-no">240</h2>
                <p class="app-title">Total Number of Application</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="m-portlet app-card">
                <h2 class="app-no">250</h2>
                <p class="app-title">Application Pending</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="m-portlet app-card">
                <h2 class="app-no">240</h2>
                <p class="app-title">Draft Sale & Lease Deed sent for Approval</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="m-portlet app-card">
                <h2 class="app-no">10</h2>
                <p class="app-title">Sale & Lease Deed sent to society</p>
            </div>
        </div>
    </div>
    <div class="m-subheader m-subheader--top m-subheader--spaced">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Application for Renewal of Lease Deed</h3>
            <span class="m-subheader__title--hint">(Renewal of Lease deed)</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="m-portlet app-card">
                <h2 class="app-no">240</h2>
                <p class="app-title">Total Number of Application</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="m-portlet app-card">
                <h2 class="app-no">240</h2>
                <p class="app-title">Application Pending</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="m-portlet app-card">
                <h2 class="app-no">240</h2>
                <p class="app-title">Process completed & Forwarded to EM</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="m-portlet app-card">
                <h2 class="app-no">240</h2>
                <p class="app-title">Forwarded to EM for queries</p>
            </div>
        </div>
    </div>
</div>
@endsection
