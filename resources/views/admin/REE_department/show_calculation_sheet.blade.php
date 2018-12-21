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
{{ Breadcrumbs::render('calculation_sheet',$ol_application->id) }}
<div class="custom-wrapper" id="offer_letter_options">
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                                Select Calculation Sheet
                        </h3>
                    </div>
                        <div class="col-md-12 d-flex align-items-center">
                            <div class="col-md-6"> 
                                <a href="{{ route('ol_calculation_sheet.show', encrypt($ol_application->id)) }}" class="btn btn-primary btn-next" id="with_formula" >
                                Calculation Sheet with Formula's(3 FSI)</a>
                            </div>                    
                            <div class="col-md-6"> 
                                <a href="{{ route('ree.fsi_calculation_application', encrypt($ol_application->id)) }}" class="btn btn-primary btn-next" id="with_formula">
                                Calculation Sheet with Formula's(2.5 FSI)</a>
                            </div>
                        </div>
                        <div class="col-md-12"> 
                         <a href="{{ route('ree_applications.custom_calculation_sheet', encrypt($ol_application->id)) }}" class="btn btn-primary btn-next">
                         Custom Calculation Sheet</a>
                        </div>   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection