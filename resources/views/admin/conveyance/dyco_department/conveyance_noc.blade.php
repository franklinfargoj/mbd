@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.conveyance.dyco_department.action',compact('data'))
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <!-- <h3 class="m-subheader__title m-subheader__title--separator">
            Approved Sale & Lease Deed Agreement
            </h3> -->
            {{-- {{ Breadcrumbs::render('calculation_sheet',$ol_application->id) }} --}}
            <div class="ml-auto btn-list">
                <a href="javascript:void(0);" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
<form class="nav-tabs-form" id ="agreementFRM" role="form" method="POST" action="{{ route('dyco.send_to_society')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">

    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body">
            <h3 class="section-title section-title--small">NOC for Conveyance</h3>
            <!-- <div class="col-xs-12 row"> -->
               
                <div class="col-md-12">
                    <span class="hint-text d-block t-remark section-title"></h5>Please Download copy of NOC for Conveyance from here.</span>
                    <div class="col-md-6" style="display: inline;">
                        <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                        Download  </Button>
                    </div>
                    @if($data->is_view && $data->status->status_id == config('commanConfig.applicationStatus.in_process'))
                        <div class="col-md-6" style="display: inline;">
                            <Button type="submit" class="s_btn btn btn-primary" id="submitBtn">
                            send to society </Button>
                        </div> 
                    @endif   
                </div>
            <!-- </div> -->
        </div>
    </div>
 </form>   
</div>

@endsection
