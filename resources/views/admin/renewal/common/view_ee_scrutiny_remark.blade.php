@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.renewal.'.$data->folder.'.action')
@endsection
@section('css')
<!-- <style> -->
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css" />

<style>
    .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('/img/loading-spinner-blue.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>
@endsection
@section('content')
<div class="loader" style="display:none;"></div>
@if(session()->has('success'))
    <div class="alert alert-success display_msg">
        {{ session()->get('success') }}
    </div>  
@endif

@if(session()->has('error'))
    <div class="alert alert-success display_msg">
        {{ session()->get('error') }}
    </div>  
@endif

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">EE Scrutiny & Remark</h3>
            {{ Breadcrumbs::render('renewal_ee_scrutiny',$data->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                <div class="m-subheader">
                    <div class="">
                        <h3 class="section-title section-title--small">
                            Society Details:
                        </h3>
                    </div>
                    <div class="row field-row">
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Application Number:</span>
                                <span class="field-value"> {{ isset($data->application_no) ? $data->application_no : ''}}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Application Date:</span>
                                <span class="field-value">{{ isset($data->created_at) ? $data->created_at : ''}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Society Name:</span>
                                <span class="field-value">{{ isset($data->societyApplication->name) ? $data->societyApplication->name : ''}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Society Address:</span>
                                <span class="field-value">{{ isset($data->societyApplication->address) ? $data->societyApplication->address : ''}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Building Number:</span>
                                <span class="field-value">{{ isset($data->societyApplication->building_no) ? $data->societyApplication->building_no : ''}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            Appointed Architect Details:
                        </h3>
                    </div>
                    <div class="row field-row">
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Name of Architect:</span>
                                <span class="field-value">{{ isset($data->societyApplication->name_of_architect) ? $data->societyApplication->name_of_architect : ''}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Mobile Number:</span>
                                <span class="field-value">{{ isset($data->societyApplication->architect_mobile_no) ? $data->societyApplication->architect_mobile_no : ''}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Address:</span>
                                <span class="field-value">{{ isset($data->societyApplication->architect_address) ? $data->societyApplication->architect_address : ''}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Telephone Number:</span>
                                <span class="field-value">{{ isset($data->societyApplication->architect_telephone_no) ? $data->societyApplication->architect_telephone_no : ''}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->

    <!-- Site Visit -->
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                    <div class="">
                        <h3 class="section-title section-title--small">
                           Scrutiny & Remark :
                        </h3>
                    </div>
                    <div class="">
                        <div class="row"> 
                            <div class="col-md-12 all_documents">  
                            @php $i = 1;
                                if (count($data->documents) > 0) 
                                 $id =  count($data->documents) + 1;
                                 else
                                 $id = '1';
                             @endphp
                            @foreach($data->documents as $document)                              
                                <div class="align-items-center upload_doc_{{$i}}">
                                    <div class="form-group m-form__group row mb-0">
                                        <div class="col-lg-2 form-group">
                                            <label class="site-visit-label">Uploaded a file:</label>
                                        </div>
                                        <div class="col-lg-5 form-group">                                            
                                            <div class="custom-file"> 
                                            <input type="hidden" name= "oldFile" id="oldFile_{{$i}}" value="{{ isset($document->document_path) ? $document->document_path : '' }}">
                                            <input type="hidden" id="key_{{$i}}" value="{{ isset($document->id) ? $document->id : '' }}">
                                            <a href="{{config('commanConfig.storage_server').'/'.$document->document_path}}">
                                            <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"> 
                                            </a>
                                            <span>{{ isset(explode('/',$document->document_path)[1]) ? explode('/',$document->document_path)[1] : '' }}</span>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                                @php $i++; @endphp
                            @endforeach    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <!-- end 

        <!-- Change In Use -->
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                    <div class="m-form__group form-group">
                        <div class="mt-3 table--box-input">
                            <label class="hint-text d-block t-remark">Change In Use:</label>
                            <textarea rows="5" cols="30" class="form-control form-control--custom" id="change_in_use" name="change_in_use" readonly>{{ isset($data->change_in_use) ? $data->change_in_use : '' }}</textarea>
                        </div>             
                    </div>
                </div>
            </div>
        </div>        <!-- end  -->
 
        <!-- Change In  Structure -->
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                    <div class="m-form__group form-group">
                        <div class="mt-3 table--box-input">
                            <label class="hint-text d-block t-remark">Change In  Structure:</label>
                            <textarea rows="5" cols="30" class="form-control form-control--custom" id="change_in_structure" name="change_in_structure" readonly> {{ isset($data->change_in_structure) ? $data->change_in_structure : '' }}</textarea>
                            <span class="error" id="encrochment_comments_error" style="display:none;color:#f4516c">This feild is required</span>
                        </div>              
                    </div>
                </div>
            </div>
        </div>

        <!-- Encrochment verification -->
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                    <div class="m-form__group form-group">
                        <div class="mt-3 table--box-input">
                            <label class="hint-text d-block t-remark">Encroachment:</label>
                            <textarea rows="5" cols="30" class="form-control form-control--custom" id="encroachment" name="encroachment" readonly> {{ isset($data->encroachment) ? $data->encroachment : '' }}</textarea>
                            <span class="error" id="encrochment_comments_error" style="display:none;color:#f4516c">This feild is required</span>
                        </div>             
                    </div>
                </div>
            </div>
        </div>        
</div>
@endsection
