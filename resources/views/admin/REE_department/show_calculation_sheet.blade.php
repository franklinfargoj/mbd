@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.REE_department.action',compact('ol_application'))
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

<!-- offer letter options for custom and offer letter with formula -->
<div class="custom-wrapper" id="offer_letter_options">
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                                Select Offer Letter
                        </h3>
                    </div>
                    <div class="d-flex align-items-center">
                    <div class="col-md-3"> 
                        <a href="{{ route('ree_applications.custom_calculation_sheet', $ol_application->id) }}" class="btn btn-primary btn-next">Custom Offer Letter</a>
                    </div>
                        <a href="{{ route('ree_applications.custom_calculation_sheet', $ol_application->id) }}" class="btn btn-primary btn-next" id="with_formula" >Offer Letter with Formula's</a>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection