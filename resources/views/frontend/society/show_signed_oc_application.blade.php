@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.oc_actions',compact('oc_applications'))
@endsection
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Application</h3>
                        {{ Breadcrumbs::render('society_tripartite_view_application', encrypt($oc_applications->id)) }} (OC)
            <div class="ml-auto btn-list">
                <a href="{{ route('society_offer_letter_dashboard') }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
        <div class="col-md-12">
            <iframe src="{{ config('commanConfig.storage_server').'/'.isset($oc_applications->application_path) ? $oc_applications->application_path : '' }}" width="1000" height="600"></iframe>
        </div>  
</div>            
@endsection