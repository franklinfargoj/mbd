@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.ee_department.action',compact('ol_application'))
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
@php $floorOption = ['Ground','Parking']; @endphp

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

@php
$layoutName = $noticeDetails = $investDate = $officierName = '';
if ($ol_application->getLayout){
  $layoutName = $ol_application->getLayout->layout_name;  
}

if($latest){
    $noticeDetails = $latest->details_of_notice;
    $investDate = $latest->date_of_investigation;
    $officierName = $latest->investigation_officer_name;
}
@endphp

<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="d-flex hide-print">
            {{ Breadcrumbs::render('scrutiny-remark',$ol_application->id,$arrData['society_detail']->society_id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>

            </div>

        </div>
        <div id="tabbed-content" class="">
            <ul id="top-tabs" class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom tabs hide-print">
                <li class="nav-item m-tabs__item active ee_tabs v-tabs" data-target="#document-scrunity" id="section-1">
                    <a class="nav-link m-tabs__link">
                        <i class="la la-cog"></i> Document Scrutiny
                    </a>
                </li>
                <li class="nav-item m-tabs__item ee_tabs ch-tab" data-target="#checklist-scrunity" id="section-2">
                    <a class="nav-link m-tabs__link">
                        <i class="la la-cog"></i> Checklist Scrutiny
                    </a>
                </li>
                <li class="nav-item m-tabs__item ee_tabs v-tabs" data-target="#ee-note" id="section-3">
                    <a class="nav-link m-tabs__link">
                        <i class="la la-cog"></i> EE Note
                    </a>
                </li>
            </ul>
            <div id="print_one">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0" >
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no" >
                            <div class="m-subheader">
                                <div class="d-flex">
                                    <h3 class="section-title section-title--small">
                                        Society Details:
                                    </h3>
                                    <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto">
                                    <img src="{{asset('/img/print-icon.svg')}}" 
                                            style="max-width: 22px;display:none" class="printBtn hide-print"></a>
                                    @if(count($arrData['consent_verification_details_data']) > 0)
                                    <a href="{{route('ee_variation_report',$arrData['society_detail']->id)}}">       
                                    <i class="fa fa-file-text hide-print report" aria-hidden="true" title="generate variation report" style="margin-left: 15px;font-size: 24px;color: #af2222;cursor: pointer;" ></i></a>
                                    @endif       
                                </div>

                                <div class="row field-row" >
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Application Number:</span>
                                            <span class="field-value">{{
                                                $arrData['society_detail']->application_no ?
                                                $arrData['society_detail']->application_no : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Application Date:</span>
                                            <span class="field-value">{{
                                                $arrData['society_detail']->submitted_at ?
                                                date(config('commanConfig.dateFormat'),
                                                strtotime($arrData['society_detail']->submitted_at)) : ''}}</span>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Society Registration No:</span>
                                            <span class="field-value">{{
                                                $arrData['society_detail']->eeApplicationSociety->registration_no }}</span>
                                        </div>
                                    </div>                                    
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Society Name:</span>
                                            <span class="field-value">{{
                                                $arrData['society_detail']->eeApplicationSociety->name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Society Address:</span>
                                            <span class="field-value">{{
                                                $arrData['society_detail']->eeApplicationSociety->address }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Building Number:</span>
                                            <span class="field-value">{{
                                                $arrData['society_detail']->eeApplicationSociety->building_no
                                                }}</span>
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
                                            <span class="field-value">{{
                                                $arrData['society_detail']->eeApplicationSociety->name_of_architect
                                                }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Architect Mobile Number:</span>
                                            <span class="field-value">{{
                                                $arrData['society_detail']->eeApplicationSociety->architect_mobile_no
                                                }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Architect Address:</span>
                                            <span class="field-value">{{
                                                $arrData['society_detail']->eeApplicationSociety->architect_address
                                                }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 field-col">
                                        <div class="d-flex">
                                            <span class="field-name">Architect Telephone Number:</span>
                                            <span class="field-value">{{
                                                $arrData['society_detail']->eeApplicationSociety->architect_telephone_no
                                                }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">

                    @php
                    if(isset($arrData['get_last_status']) && ($arrData['get_last_status']->status_id ==
                    config('commanConfig.applicationStatus.forwarded')))
                    { $style = "display:none";
                    $disabled='disabled';
                    $readonly = 'readonly';
                    }elseif (session()->get('role_name') != config('commanConfig.ee_junior_engineer'))
                    { $style = "display:none";
                    $disabled='disabled';
                    $readonly = 'readonly';
                    }else
                    {
                    $style = "";
                    $disabled="";
                    $readonly = '';
                    }
                    @endphp
<div class="panel active section-1" id="document-scrunity">
    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            Document Scrutiny Sheet:
                        </h3>
                    </div>
                </div>
<div class="m-section__content mb-0 table-responsive">
    <table class="table mb-0">
        <thead class="thead-default">
            <th class="table-data--xs">#</th>
            <th>तपशील</th>
            <th class="table-data--xs">सोसायटी दस्तावेज</th>
            <th class="table-data--lg">टिप्पणी</th>
            <th class="table-data--xs">दस्तावेज</th>
        </thead>
        <tbody>
           @php
            $i = 1; 
            @endphp
            
            @if(count($societyDocument) > 0)
                @foreach($societyDocument as $value)
                    @foreach($value as $document)
                <tr>

                    <td>{{ isset($document->group) ? $document->group : $i }}.{{$document->sort_by}}</td>
                    <td>{{(isset($document->name) ? $document->name : '')}}</td>

                    <td class="text-center"> 
                    @if($document->is_multiple == 1)
                        <a href="{{ route('view_multiple_document',[encrypt($ol_application->id),encrypt($document->id)]) }}" class="app-card__details mb-0 btn-link" style="font-size: 14px">
                        view documents</a>
                    @else
                        @if(isset($document->documents_uploaded[0]) && $document->documents_uploaded[0]->society_document_path)

                            <a download href="{{config('commanConfig.storage_server').'/'.$document->documents_uploaded[0]->society_document_path }}" target="_blank"><img
                                    class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a></td>
                        @else    
                            <h2 class="m--font-danger">
                                <i class="fa fa-remove"></i>
                            </h2>
                        @endif 
                    @endif     
                    <td>
                        <p class="mb-2">{{ (isset($document->documents_uploaded[0]) && $document->documents_uploaded[0]->comment_by_EE) ? $document->documents_uploaded[0]->comment_by_EE : '' }}</p>
                        <div class="d-flex btn-list-inline-wrap">

                            @if(isset($document->documents_uploaded[0]) && $document->documents_uploaded[0]->comment_by_EE)
                            <button class="btn btn-link btn-list-inline editDocumentStatus"
                                style="cursor: pointer; {{$style}}" data-toggle="modal"
                                data-id="{{ $i }}" data-documentStatusId="{{ $document->id }}" data-target="#edit-remark-{{$i}}">Edit</button>

                            <button class="btn btn-link btn-list-inline deleteDocumentStatus"
                                style="cursor: pointer; {{$style}}" data-toggle="modal"
                                data-id="{{ $i }}" data-documentStatusId="{{ $document->id }}" data-target="#delete-remark-{{$i}}">Delete</button>
                            @else

                            <button class="btn btn-link btn-list-inline" style="cursor: pointer;{{$style}}"
                                data-toggle="modal" data-target="#add-remark-{{$i}}">Add</button>
                            @endif

                            <div class="modal fade show" id="add-remark-{{$i}}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add
                                                Remark</h5>
                                            <button style="cursor: pointer;" type="button"
                                                class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form class="" action="{{ route('ee-scrutiny-document') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="document_status_id"
                                                value="{{ $document->id }}">
                                            <input type="hidden" name="society_id"
                                                value="{{ isset($ol_application->id) ? $ol_application->society_id : '' }}">
                                            <input type="hidden" name="applicationId" value="{{ isset($ol_application->id) ? $ol_application->id : '' }}">    
                                            <div class="modal-body table--box-input">
                                                <div class="mb-4">
                                                    <label for="remark">Remark:</label>
                                                    <textarea class="form-control form-control--custom"
                                                        name="remark" id="remark_{{ $i }}"
                                                        cols="30" rows="5"></textarea>
                                                </div>
                                                <div class="custom-file">
                                                    <input class="custom-file-input" name="EE_document_path"
                                                        type="file" id="EE_document_path_{{ $i }}">
                                                    <label class="custom-file-label" for="EE_document_path_{{ $i }}">Choose
                                                        file...</label>
                                                </div>
                                                <span class="text-danger" id="file_error_{{ $i }}">
                                                </span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary submt_btn"
                                                    id="submitBtn_{{ $i }}">Save</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade show" id="edit-remark-{{$i}}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit
                                                Remark</h5>
                                            <button style="cursor: pointer;" type="button"
                                                class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form class="" action="{{ route('edit-ee-scrutiny-document', $document->id) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="applicationId" value="{{ isset($ol_application->id) ? $ol_application->id : '' }}">
                                            <input type="hidden" name="oldFileName" id="oldFileName_{{ $i }}">
                                            <div class="modal-body">
                                                <div class="mb-4">
                                                    <label for="remark">Remark:</label>
                                                    <textarea class="form-control form-control--custom"
                                                        name="comment_by_EE" id="ee-comment{{$i}}"
                                                        cols="30" rows="5"> {{ isset($document->documents_uploaded[0]) ? $document->documents_uploaded[0]->comment_by_EE : '' }}</textarea>
                                                </div>

                                                <div class="custom-file">
                                                    <input class="custom-file-input" name="EE_document"
                                                        type="file" id="EE_document_{{ $i }}">
                                                    <label class="custom-file-label" for="EE_document_{{ $i }}">Choose
                                                        file...</label>
                                                </div>

                                                <span class="text-danger" id="edit_file_error_{{ $i }}"></span>
                                                {{--<div class="mt-auto">
                                                    <button type="submit" class="btn btn-primary btn-custom"
                                                        id="uploadBtn">Upload</button>
                                                </div>--}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary edit_btn"
                                                    id="editBtn_{{ $i }}">Save</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade show" id="delete-remark-{{$i}}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel2">Delete
                                                Remark</h5>
                                            <button style="cursor: pointer;" type="button"
                                                class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form class="" action="{{ route('ee-document-scrutiny-delete', $document->id) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="applicationId" value="{{ isset($ol_application->id) ? $ol_application->id : '' }}">
                                            <input type="hidden" name="fileName" id="fileName_{{ $i }}">
                                            <div class="modal-body">
                                                <div class="mb-4">
                                                    <label for="remark">Remark:</label>
                                                    <textarea class="form-control form-control--custom"
                                                        name="remark" id="remark_by_ee_{{ $i }}"
                                                        cols="30" rows="5"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    @if(isset($document->documents_uploaded[0]) && $document->documents_uploaded[0]->EE_document_path)

                    <td class="text-center"><a download href="{{config('commanConfig.storage_server').'/'.$document->documents_uploaded[0]->EE_document_path}}" target="_blank"><img
                                class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a></td>
                    @else
                    <td></td>
                    @endif
                </tr>

                @php
                $i++;
                @endphp
                @endforeach
                @endforeach
            @endif
        </tbody>
    </table>
</div>
            </div>
        </div>
    </div>
</div>
                    <center><u><p style="font-size:18px;font-weight:500px;display:none;" class="show-print" id="selected_tab">Consent Verification</p></u></center>
                    <div class="panel section-2" id="checklist-scrunity">
                        <ul id="scrunity-tabs" class="nav nav-pills nav-justified hide-print" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show nested_t" data-toggle="pill" href="#verification" id="nested_tab_1" next_tab = "nested_tab_2" data-tab="Consent Verification">
                                    Consent Verification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nested_t" data-toggle="pill" href="#demarcation" id="nested_tab_2" next_tab = "nested_tab_3" data-tab="Demarcation">
                                    Demarcation</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nested_t" data-toggle="pill" href="#tit-bit" id="nested_tab_3" next_tab = "nested_tab_4" data-tab="Tit-Bit">
                                    Tit-Bit</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link nested_t" data-toggle="pill" href="#relocation" id="nested_tab_4" next_tab = "nested_tab_5" data-tab="R.G. Relocation">
                                    R.G. Relocation</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link nested_t" data-toggle="pill" href="#no_due_certificate" id="nested_tab_5" next_tab = "nested_tab_1" data-tab="no_due_certificate">
                                    No Due Certificate</a>
                            </li>
                        </ul>
                        <div class="m-portlet m-portlet--no-top-shadow">
                            <div class="tab-content">
                                <div class="tab-pane active nested_tab_1" id="verification">
                                    <form class="form--custom" action="{{ route('consent-verfication') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">संस्थेचे नाव:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" value="{{ $arrData['society_detail']->eeApplicationSociety->name }}"
                                                            class="form-control form-control--custom" disabled id="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">इमारत क्र:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control--custom"
                                                            disabled value="{{ $arrData['society_detail']->eeApplicationSociety->building_no }}"
                                                            id="building-no" placeholder="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">अभिन्यास (Layout):<span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control--custom"
                                                            name="layout" id="name" value="{{ isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->layout : $layoutName }}" {{ $readonly }} required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="notice_detail">नोटीस चा तपशील: <span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            value="{{ isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->details_of_notice : $noticeDetails }}"
                                                            name="details_of_notice" id="notice_detail" placeholder=""
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 margin_top">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="investigation_officer">तपासणी अधिकाऱ्यांचे नाव: <span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            value="{{ isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->investigation_officer_name : $officierName}}"
                                                            name="investigation_officer_name" id="investigation_officer"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="scrunity-check-date" class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="m_datepicker">तपासणी दिनांक: <span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom m_datepicker" value="{{isset($arrData['consent_verification_checkist_data']) ? date(config('commanConfig.dateFormat'), strtotime($arrData['consent_verification_checkist_data']->date_of_investigation)) : date(config('commanConfig.dateFormat'), strtotime($investDate)) }}"
                                                            name="date_of_investigation" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>     

                                        <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input" style="margin-top: 10px">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                                    <thead class="thead-default">
                                                        <th style="width:10%">Sr.no</th>
                                                        <th class="table-data--xl" style="width:50%">मुद्दा / तपशील</th>
                                                        <th style="width:5%">होय</th>
                                                        <th style="width:5%">नाही</th>
                                                        <th style="width:30%">शेरा</th>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $i = 1;
                                                        @endphp 

                                                        <input type="hidden" name="application_id" value="{{ $arrData['society_detail']->id }}">
                                                        @foreach($arrData['consent_verification_question'] as
                                                        $consent_question)

                                                        @php 
                                                        if ($consent_question->hide == 1){
                                                            $con_style = 'display:none;';
                                                        }else{
                                                            $con_style = '';
                                                        }
                                                        @endphp
                                                        <input type="hidden" name="question_id[{{$i}}]" value="{{ $consent_question->id }}">
                                                        <tr id="{{ $consent_question->class }}" 
                                                        style="{{$con_style}}" >
                                                            <td>{{ $consent_question->group }}. {{ $consent_question->sort_by }}
                                                            </td>

                                                            <td>{{ $consent_question->question }}</td>
                                                            <td>
                                                            @if($consent_question->is_option == 1)
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" name="answer[{{$i}}]"
                                                                        value="1" class="{{ $consent_question->class }}" required
                                                                        {{ (isset($arrData['consent_verification_details_data'][$consent_question->id]) && $arrData['consent_verification_details_data'][$consent_question->id]['answer'] == 1) ? 'checked' : '' }}>
                                                                    <span></span>
                                                                </label>
                                                            @endif    
                                                            </td>
                                                            @php
                                                            if(isset($arrData['consent_verification_details_data'][$consent_question->id]['answer'])
                                                            &&
                                                            $arrData['consent_verification_details_data'][$consent_question->id]['answer']
                                                            == 0)
                                                            {
                                                            $checked = 'checked';
                                                            }
                                                            else{
                                                            $checked = '';
                                                            }
                                                            @endphp
                                                            <td>
                                                            @if($consent_question->is_option == 1)
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" name="answer[{{$i}}]" class="{{ $consent_question->class }}"
                                                                        value="0" {{ $checked }}>
                                                                    <span></span>
                                                                </label>
                                                            @endif    
                                                            </td>
                                                            <td>
                                                                <textarea {{$readonly}} style="border-top: none;resize: none;" class="form-control form-control--custom form-control--textarea"
                                                                    name="remark[{{$i}}]" id="remark-one">{{ isset($arrData['consent_verification_details_data'][$consent_question->id]) ? $arrData['consent_verification_details_data'][$consent_question->id]['remark'] : '' }}</textarea>
                                                            </td>
                                                        </tr>
                                                        @php
                                                        $i++;
                                                        @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3" style="text-align: center;">
                                            <button type="submit" style="{{ $style }}" class="btn btn-primary saveBtn hide-print" next_tab = "nested_tab_2">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane nested_tab_2" id="demarcation">
                                    <form class="form--custom" action="{{ route('ee-demarcation') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">संस्थेचे नाव:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control--custom"
                                                            disabled value="{{ $arrData['society_detail']->eeApplicationSociety->name }}"
                                                            id="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">इमारत क्र:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control--custom"
                                                            disabled value="{{ $arrData['society_detail']->eeApplicationSociety->building_no }}"
                                                            id="building-no" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">अभिन्यास (Layout):<span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->layout : $layoutName}}"
                                                            name="layout" id="name" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">नोटीस चा तपशील: <span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->details_of_notice : $noticeDetails }}"
                                                            name="details_of_notice" id="building-no" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 margin_top">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">तपासणी अधिकाऱ्यांचे नाव: <span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->investigation_officer_name : $officierName}}"
                                                            name="investigation_officer_name" id="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="scrunity-check-date" class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">स्थळ पाहणी दिनांक:<span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom m_datepicker"
                                                            required value="{{isset($arrData['demarcation_checkist_data']) ? date(config('commanConfig.dateFormat'), strtotime($arrData['demarcation_checkist_data']->date_of_investigation)) : date(config('commanConfig.dateFormat'), strtotime($investDate)) }}"
                                                            name="date_of_investigation" id="demarcation_date" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                                 <thead class="thead-default">
                                                        <th style="width:10%">Sr.no</th>
                                                        <th style="width: 55%;">Area</th>
                                                        <th style="width:35%">Value (sq.mt)</th>
                                                    <tr>
                                                        <tr>
                                                        <td>1</td>
                                                        <td>एकूण भूखंडाचे क्षेत्रफळ</td>
                                                        <td><input {{$readonly}} type="text" class="form-control form-control--custom float" required="" value="{{ isset($landDetails->total_area) ? $landDetails->total_area : '' }}" name="land[total_area]" id="total_area" readonly placeholder="0.00"></td>
                                                        
                                                        </tr>
                                                        <td>1.a</td>

                                                        <td>भाडेपट्टा करारनामा नुसार क्षेत्रफळ <span class="star">*</span></td>
                                                        <td><input {{$readonly}} type="text" class="form-control form-control--custom total_area float" required="" value="{{ isset($landDetails->lease_agreement_area) ? $landDetails->lease_agreement_area : '' }}" name="land[lease_agreement_area]" id="lease_agreement_area" placeholder=""></td>
                                                    </tr> 
                                                                                   
                                                    <tr>
                                                         <td>1.b</td>    
                                                        <td>टिट बिट भूखंडाचे क्षेत्रफळ  <span class="star">*</span></td>
                                                        <td><input {{$readonly}} type="text" class="form-control form-control--custom total_area float" required="" value="{{ isset($landDetails->tit_bit_area) ? $landDetails->tit_bit_area : '' }}" name="land[tit_bit_area]" id="tit_bit_area" placeholder=""></td>
                                                    </tr>
                                                    <tr>
                                                         <td>1.c</td>    
                                                        <td>आर जी भूखंडाचे क्षेत्रफळ <span class="star">*</span></td>
                                                        <td><input {{$readonly}} type="text" class="form-control form-control--custom total_area float" required="" value="{{ ($landDetails != '' && isset($landDetails->rg_plot_area)) ? $landDetails->rg_plot_area : '' }}" name="land[rg_plot_area]" id="rg_plot_area" placeholder=""></td>
                                                    </tr>
                                                    <tr>
                                                         <td>1.d</td>    
                                                        <td>पि जि भूखंडाचे क्षेत्रफळ <span class="star">*</span></td>
                                                        <td><input {{$readonly}} type="text" class="form-control form-control--custom total_area float" required="" value="{{ ($landDetails != '' && isset($landDetails->pg_plot_area)) ? $landDetails->pg_plot_area : '' }}" name="land[pg_plot_area]" id="pg_plot_area" placeholder=""></td>
                                                    </tr>
                                                    <tr>
                                                         <td>1.e</td>    
                                                        <td>Road setback  area <span class="star">*</span></td>
                                                        <td><input {{$readonly}} type="text" class="form-control form-control--custom total_area float" required="" value="{{ isset($landDetails->road_setback_area) ? $landDetails->road_setback_area : '' }}" name="land[road_setback_area]" id="road_setback_area" placeholder=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td>1.f</td>    
                                                        <td>Encroachment area <span class="star">*</span></td>
                                                        <td><input {{$readonly}} type="text" class="form-control form-control--custom total_area float" required="" value="{{ isset($landDetails->encroachment_area) ? $landDetails->encroachment_area : '' }}" name="land[encroachment_area]" id="encroachment_area" placeholder=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td>1.g</td>    
                                                        <td>O.B Building area <span class="star">*</span></td>
                                                        <td><input {{$readonly}} type="text" class="form-control form-control--custom total_area float" required="" value="{{ isset($landDetails->ob_building_area) ? $landDetails->ob_building_area : '' }}" name="land[ob_building_area]" id="ob_building_area" placeholder=""></td>
                                                    </tr>
                                                    <tr>
                                                         <td>1.h</td>    
                                                        <td>इतर क्षेत्रफळ  <span class="star">*</span></td>
                                                        <td><input {{$readonly}} type="text" class="form-control form-control--custom total_area float" required="" value="{{ isset($landDetails->another_area) ? $landDetails->another_area : '' }}" name="land[another_area]" id="another_area" placeholder=""></td>

                                                    </tr>
                                                       <tr>
                                                        <td>2.</td>
                                                        <td>अभिन्यासातील भूखंडाचे क्षेत्रफळ <span class="star">*</span></td>
                                                        <td><input {{$readonly}} type="text" class="form-control form-control--custom float" required="" value="{{ isset($landDetails->stag_plot_area) ? $landDetails->stag_plot_area : '' }}" name="land[stag_plot_area]" 
                                                        id="stag_plot_area" placeholder=""></td>
                                                    </tr>  
                                                </table>
                                                
                                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                                    <thead class="thead-default">
                                                        <th style="width:10%">Sr.no</th>
                                                        <th class="table-data--xl" style="width:50%">मुद्दा / तपशील</th>
                                                        <th style="width:5%">होय</th>
                                                        <th style="width:5%">नाही</th>
                                                        <th style="width:30%">शेरा</th>
                                                        <!-- <th style="width:30%">शेरा</th> -->
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $i = 3;
                                                        @endphp

                                                        <input type="hidden" name="application_id" value="{{ $arrData['society_detail']->id }}">

                                                        @foreach($arrData['demarcation_question'] as
                                                        $demarcation_question)

                                                        @php if(isset($demarcation_question->is_compulsory) && $demarcation_question->is_compulsory == '1'){
                                                            $required = 'required';
                                                        }
                                                        else{
                                                            $required = '';
                                                        }
                                                        $display = '';
                                                        
                                                        if(isset($demarcation_question->hide) && $demarcation_question->hide == 1){
                                                            $dem_style = 'display:none;';
                                                        }else{
                                                            $dem_style = '';
                                                        }
                                                        @endphp
                                                        <input type="hidden" name="question_id[{{$i}}]" value="{{ $demarcation_question->id }}">
                                                        <tr id="{{$demarcation_question->class}}" style="{{$dem_style}}">
                                                            <td>{{ $demarcation_question->group }}.{{ $demarcation_question->sort_by }}</td>
                                                            <td>{{ $demarcation_question->question }}</td>
                                                            <td>
                                                            @if($demarcation_question->is_option == 1)
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" class="{{$demarcation_question->class}}" name="answer[{{ $i }}]" value="1" required
                                                                        {{ (isset($arrData['demarcation_details_data'][$demarcation_question->id]) && $arrData['demarcation_details_data'][$demarcation_question->id]['answer'] == 1) ? 'checked' : '' }}>
                                                                    <span></span>
                                                                </label>
                                                            @endif    
                                                            </td>
                                                            @php
                                                            if(isset($arrData['demarcation_details_data'][$demarcation_question->id]['answer'])
                                                            &&
                                                            $arrData['demarcation_details_data'][$demarcation_question->id]['answer']
                                                            == 0)
                                                            {
                                                            $checked_demarcation = 'checked';
                                                            }
                                                            else{
                                                            $checked_demarcation = '';
                                                            }
                                                            @endphp

                                                            <td>
                                                            @if($demarcation_question->is_option == 1)
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" class="{{$demarcation_question->class}}" name="answer[{{ $i }}]"
                                                                        value="0" {{ $checked_demarcation  }}>
                                                                    <span></span>
                                                                </label>
                                                            @endif    
                                                            </td>
                                                           
                                                            <td>
                                                            @if($demarcation_question->is_select == 1)
                                                            <div class="col-sm-12 form-group m-form__group row parent-data" id="select_dropdown">
                                                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" name="floor[{{ $i }}]" id="floor" {{$disabled}}>
                                                                @if(isset($floorOption))
                                                                    @foreach($floorOption as $value)
                                                                        @if(isset($arrData['demarcation_details_data'][$demarcation_question->id]) && $arrData['demarcation_details_data'][$demarcation_question->id]['floor'] == $value)
                                                                            <option value="{{ $value }}" selected> {{$value}} </option>
                                                                        @else
                                                                            <option value="{{ $value }}" > {{$value}} </option>
                                                                        @endif    
                                                                    @endforeach
                                                                @endif        
                                                            </select>
                                                            </div>
                                                           
                                                            <div class="col-sm-12 form-group m-form__group row parent-data" id="select_dropdown">
                                                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" name="select_number[{{ $i }}]" id="number" value="" {{$disabled}}>
                                                                @for($a=1;$a<=100;$a++)
                                                                    @if(isset($arrData['demarcation_details_data'][$demarcation_question->id]) && $arrData['demarcation_details_data'][$demarcation_question->id]['number'] == $a)
                                                                    <option value="{{$a}}" selected>{{$a}} </option>
                                                                    @else
                                                                    <option value="{{$a}}">{{$a}} </option>
                                                                    @endif 
                                                                @endfor     
                                                                </select>
                                                            </div>
                                                            @elseif($demarcation_question->is_table == 1)
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                  <tr>
                                                                    <th>Residential</th>
                                                                    <th>Non-Residential</th>
                                                                    <th>Encrochment</th>
                                                                  </tr>
                                                                </thead>
                                                                <tbody>
                                                                  <tr>
                                                                    <td><input type="text" class="form-control form-control--custom" name="residential[{{ $i }}]" id="residential" value="{{isset($arrData['demarcation_details_data'][$demarcation_question->id]) ? $arrData['demarcation_details_data'][$demarcation_question->id]['residential'] : '' }}" {{$disabled}}></td>
                                                                    <td><input type="text" class="form-control form-control--custom" name="non_residential[{{ $i }}]" id="non-residential" value="{{isset($arrData['demarcation_details_data'][$demarcation_question->id]) ? $arrData['demarcation_details_data'][$demarcation_question->id]['non_residential'] : '' }}" {{$disabled}}></td>
                                                                    <td><input type="text" class="form-control form-control--custom" name="encrochment[{{ $i }}]" id="encrochment" value="{{isset($arrData['demarcation_details_data'][$demarcation_question->id]) ? $arrData['demarcation_details_data'][$demarcation_question->id]['encrochment'] : '' }}" {{$disabled}}></td>
                                                                  </tr>
                                                                  </tbody>
                                                                </table>
                                                            @else
                                                                <textarea class="form-control form-control--custom form-control--textarea"
                                                                    name="remark[{{ $i }}]" style="border-top: none;resize: none;" {{$disabled}} id="remark-one" {{$required}}>{{ isset($arrData['demarcation_details_data'][$demarcation_question->id]) ? $arrData['demarcation_details_data'][$demarcation_question->id]['remark'] : '' }}</textarea>

                                                                @if($demarcation_question->is_textbox == 1)
                                                                <div class="col-sm-12 mt-3 crz_area" style="display: none">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-4 d-flex align-items-center">
                                                                            <label for="crz_area">
                                                                            CRZ Area:</label>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control form-control--custom"
                                                                                required value="{{ isset($arrData['demarcation_details_data'][$demarcation_question->id]) ? $arrData['demarcation_details_data'][$demarcation_question->id]['crz_area'] : '' }}"
                                                                                name="crz_area[{{ $i }}]" id="crz_area" placeholder="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif    
                                                            @endif        
                                                            </td>
                                                        </tr>

                                                        @php
                                                        $i++;
                                                        @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3" style="text-align: center;">
                                        <button type="submit" style="{{ $style }}" class="btn btn-primary saveBtn hide-print" next_tab = "nested_tab_3">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane nested_tab_3" id="tit-bit">
                                    <form class="form--custom" action="{{ route('ee-tit-bit') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">संस्थेचे नाव:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control--custom"
                                                            disabled value="{{ $arrData['society_detail']->eeApplicationSociety->name }}"
                                                            id="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">इमारत क्र: </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control--custom"
                                                            disabled value="{{ $arrData['society_detail']->eeApplicationSociety->building_no }}"
                                                            id="building-no" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">अभिन्यास (Layout):<span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->layout : $layoutName }}"
                                                            name="layout" id="name" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">नोटीस चा तपशील: <span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->details_of_notice : $noticeDetails }}"
                                                            name="details_of_notice" id="building-no" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 margin_top">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">तपासणी अधिकाऱ्यांचे नाव: <span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->investigation_officer_name : $officierName}}"
                                                            name="investigation_officer_name" id="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="scrunity-check-date" class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">स्थळ पाहणी दिनांक:<span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom m_datepicker"
                                                            required value="{{isset($arrData['tit_bit_checkist_data']) ? date(config('commanConfig.dateFormat'), strtotime($arrData['tit_bit_checkist_data']->date_of_investigation)) : date(config('commanConfig.dateFormat'), strtotime($investDate)) }}"
                                                            name="date_of_investigation" id="tit_bit_date" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                                    <thead class="thead-default">
                                                        <th style="width:10%">Sr.no</th>
                                                        <th class="table-data--xl" style="width:50%">
                                                        मुद्दा / तपशील</th>
                                                        <th style="width:5%">होय</th>
                                                        <th style="width:5%">नाही</th>
                                                        <th style="width:30%">शेरा</th>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $i = 1;
                                                        @endphp

                                                        <input type="hidden" name="application_id" value="{{ $arrData['society_detail']->id }}">

                                                        @foreach($arrData['tit_bit_question'] as $tit_bit)

                                                        @php if(isset($tit_bit->is_compulsory) && $tit_bit->is_compulsory == '1'){
                                                            $required = 'required';
                                                        }
                                                        else{
                                                            $required = '';
                                                        }

                                                        if ($tit_bit->hide == 1){
                                                            $tit_style = 'display:none;';
                                                        }else{
                                                            $tit_style = '';
                                                        }
                                                        @endphp                                                    

                                                        <input type="hidden" name="question_id[{{$i}}]" value="{{ $tit_bit->id }}">
                                                        <tr id="{{$tit_bit->class}}" style="{{$tit_style}}">
                                                            <td>{{ $tit_bit->group }}.{{ $tit_bit->sort_by }}</td>
                                                            <td>{{ $tit_bit->question }}</td>
                                                            <td>
                                                            @if($tit_bit->is_option == 1)
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" name="answer[{{ $i }}]" class="{{$tit_bit->class}}" value="1" required
                                                                        {{ (isset($arrData['tit_bit_details_data'][$tit_bit->id]) 
                                                                        && $arrData['tit_bit_details_data'][$tit_bit->id]['answer'] == 1) ? 'checked' : '' }}>
                                                                    <span></span>
                                                                </label>
                                                            @endif   
                                                            </td>
                                                            @php
                                                            if(isset($arrData['tit_bit_details_data'][$tit_bit->id]['answer'])
                                                            &&
                                                            $arrData['tit_bit_details_data'][$tit_bit->id]['answer']
                                                            == 0)
                                                            {
                                                            $checked_tit_bit = 'checked';
                                                            }
                                                            else{
                                                            $checked_tit_bit = '';
                                                            }
                                                            @endphp
                                                            <td>
                                                            @if($tit_bit->is_option == 1)
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" class="{{$tit_bit->class}}" name="answer[{{ $i }}]"
                                                                        value="0" {{ $checked_tit_bit }}>
                                                                    <span></span>
                                                                </label>
                                                                </td>
                                                            @endif    
                                                            <td>
                                                            @if($tit_bit->is_select == 1)
                                                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" name="" id="" {{$disabled}}>
                                                                @if(isset($floorOption))
                                                                    @foreach($floorOption as $value)
                                                                       <option value="{{ $value }}" > {{$value}} </option>
                                                                    @endforeach
                                                                @endif        
                                                            </select>
                                                            @elseif($tit_bit->question == 'फुटकळ भूखंडाचे एकूण क्षेत्रफळ किती ?')
                                                                <textarea {{$disabled}} class="form-control form-control--custom form-control--textarea"
                                                                    name="remark[{{ $i }}]" style="border-top: none;resize: none;" id="remark-one" {{ $required }}>{{ isset($arrData['tit_bit_details_data'][$tit_bit->id]) ? $arrData['tit_bit_details_data'][$tit_bit->id]['remark'] : ($landDetails!="" ? $landDetails->tit_bit_area : '') }}</textarea>
                                                            @else        
                                                            
                                                                <textarea {{$disabled}} class="form-control form-control--custom form-control--textarea"
                                                                    name="remark[{{ $i }}]" style="border-top: none;resize: none;" id="remark-one" {{ $required }}>{{ isset($arrData['tit_bit_details_data'][$tit_bit->id]) ? $arrData['tit_bit_details_data'][$tit_bit->id]['remark'] : '' }}</textarea>
                                                            @endif        
                                                            </td>
                                                        </tr>
                                                        @php
                                                        $i++;
                                                        @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3" style="text-align: center;">
                                            <button type="submit" style="{{ $style }}" class="btn btn-primary saveBtn hide-print" next_tab = "nested_tab_4">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane nested_tab_4" id="relocation">
                                    <form class="form--custom" action="{{ route('ee-rg-relocation') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">संस्थेचे नाव:</label>
                                                    </div> 
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            disabled value="{{ $arrData['society_detail']->eeApplicationSociety->name }}"
                                                            id="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">इमारत क्र: </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            disabled value="{{ $arrData['society_detail']->eeApplicationSociety->building_no }}"
                                                            id="building-no" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">अभिन्यास (Layout):<span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['rg_checkist_data']) ? $arrData['rg_checkist_data']->layout : $layoutName}}"
                                                            name="layout" id="name" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">नोटीस चा तपशील: <span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            name="details_of_notice" id="building-no" placeholder=""
                                                            required value="{{ isset($arrData['rg_checkist_data']) ? $arrData['rg_checkist_data']->details_of_notice : $noticeDetails }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;margin-top: 10px">
                                                    <thead class="thead-default">
                                                        <th style="width:10%">Sr.no</th>
                                                        <th class="table-data--xl" style="width:50%">मुद्दा / तपशील</th>
                                                        <!-- <th style="width:5%">होय</th> -->
                                                        <!-- <th style="width:5%">नाही</th> -->
                                                        <th style="width:30%">शेरा</th>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $i = 1;
                                                        @endphp

                                                        <input type="hidden" name="application_id" value="{{ $arrData['society_detail']->id }}">
                                                        @foreach($arrData['rg_question'] as $rg_question)

                                                        @php if(isset($rg_question->is_compulsory) && $rg_question->is_compulsory == '1'){
                                                            $required = 'required';
                                                        }
                                                        else{
                                                            $required = '';
                                                        }
                                                        $rg_check = $dp_check = '';
                                                        if (!empty($arrData['rg_details_data']) && ($arrData['rg_details_data'][$rg_question->id]['schema'] == 'Scheme R.G')){
                                                            $rg_check = 'checked';
                                                        }

                                                        if (!empty($arrData['rg_details_data']) && ($arrData['rg_details_data'][$rg_question->id]['schema'] == 'D.P.R.G')){
                                                            $dp_check = 'checked';
                                                        }
                                                        @endphp                                                     
                                                        <input type="hidden" name="question_id[{{$i}}]" value="{{ $rg_question->id }}">
                                                        <tr>
                                                            <td>{{ $i }}.</td>
                                                            <td>{{ $rg_question->question }}
                                                                
                                                            </td>
                                                            <!-- <td>
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" name="answer[{{ $i }}]" value="1" required
                                                                        {{ (isset($arrData['rg_details_data'][$rg_question->id]) && $arrData['rg_details_data'][$rg_question->id]['answer'] == 1) ? 'checked' : '' }}>
                                                                    <span></span>
                                                                </label>
                                                            </td> -->
                                                            @php
                                                            if(isset($arrData['rg_details_data'][$rg_question->id]['answer'])
                                                            &&
                                                            $arrData['rg_details_data'][$rg_question->id]['answer']
                                                            == 0)
                                                            {
                                                            $checked_rg_location = 'checked';
                                                            }
                                                            else{
                                                            $checked_rg_location = '';
                                                            }
                                                            @endphp
                                                            <!-- <td>
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" name="answer[{{ $i }}]"
                                                                        value="0" {{ $checked_rg_location }}>
                                                                    <span></span>
                                                                </label></td> -->
                                                            <td>
                                                            @if($rg_question->is_option == 1)

                                                                <label class="m-radio m-radio--primary">
                                                                Scheme R.G
                                                                    <input type="radio" name="schema[{{$i}}]"
                                                                        value="Scheme R.G" {{$rg_check}} {{$disabled}}>
                                                                    <span></span>
                                                                </label>

                                                                <label class="m-radio m-radio--primary">
                                                                D.P.R.G
                                                                    <input type="radio" name="schema[{{$i}}]"
                                                                        value="D.P.R.G" {{$dp_check}} {{$disabled}}>
                                                                    <span></span>
                                                                </label>
                                                            @elseif($rg_question->question == 'सिमांकन नकाशानुसार R.G चे एकूण क्षेत्रफळ किती आहे ?')
                                                                <textarea {{$readonly}} class="form-control form-control--custom form-control--textarea"
                                                                    name="remark[{{ $i }}]" style="border-top: none;resize: none;" id="remark-one" {{ $required }}>{{ isset($arrData['rg_details_data'][$rg_question->id]) ? $arrData['rg_details_data'][$rg_question->id]['remark'] : ($landDetails!="" ? $landDetails->rg_plot_area : '') }}</textarea>
                                                            @else
                                                                <textarea {{$readonly}} class="form-control form-control--custom form-control--textarea"
                                                                    name="remark[{{ $i }}]" style="border-top: none;resize: none;" id="remark-one" {{ $required }}>{{ isset($arrData['rg_details_data'][$rg_question->id]) ? $arrData['rg_details_data'][$rg_question->id]['remark'] : '' }}</textarea>
                                                            @endif        
                                                                    
                                                            </td>
                                                        </tr>
                                                        @php
                                                        $i++;
                                                        @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3" style="text-align: center;">
                                            <button type="submit" style="{{ $style }}" class="btn btn-primary saveBtn hide-print" next_tab = "nested_tab_5">Save</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- NO due certificate -->
                                <div class="tab-pane nested_tab_5" id="no_due_certificate">
                                    <form class="form--custom" action="{{ route('ee.save_no_due_cerificate_details') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">संस्थेचे नाव:</label>
                                                    </div> 
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            disabled value="{{ $arrData['society_detail']->eeApplicationSociety->name }}"
                                                            id="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">इमारत क्र: </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            disabled value="{{ $arrData['society_detail']->eeApplicationSociety->building_no }}"
                                                            id="building-no" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">अभिन्यास (Layout):<span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['rg_checkist_data']) ? $arrData['rg_checkist_data']->layout : $layoutName}}"
                                                            name="layout" id="name" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">नोटीस चा तपशील: <span class="star">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$readonly}} type="text" class="form-control form-control--custom"
                                                            name="details_of_notice" id="building-no" placeholder=""
                                                            required value="{{ isset($arrData['no_due']) ? $arrData['no_due']->details_of_notice : $noticeDetails }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;margin-top: 10px">
                                                    <thead class="thead-default">
                                                        <th style="width:10%">Sr.no</th>
                                                        <th class="table-data--xl" style="width:50%">मुद्दा / तपशील</th>
                                                        <th style="width:5%">होय</th>
                                                        <th style="width:5%">नाही</th>
                                                        <th style="width:30%">शेरा</th>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $i = 1;
                                                        @endphp

                                                        <input type="hidden" name="application_id" id="application_id" value="{{ $arrData['society_detail']->id }}">
                                                        @foreach($noDuesQuestions as $due_question)
                                                        @php if(isset($due_question->is_compulsory) && $due_question->is_compulsory == '1'){
                                                            $required = 'required';
                                                        }else{
                                                            $required = '';
                                                        }

                                                        $due_style = '';
                                                        if(isset($due_question->hide) && $due_question->hide == 1){
                                                            $due_style = 'display:none;';
                                                        }
                                                        @endphp                                                     
                                                        
                                                        <tr id="{{ $due_question->class }}" style="{{$due_style}}">
                                                            <td>{{ $i }}.</td>
                                                            <td>{{ $due_question->question }}
                                                               
                                                            </td>
                                                            <td>
                                                            @if($due_question->is_option == 1)
                                                            <input type="hidden" name="due[question_id]" value="{{ $due_question->id }}"> 
                                                            <input type="hidden" name="due[application_id]" value="{{ $arrData['society_detail']->id }}">
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" name="due[answer]" class="{{ $due_question->class }}" value="1" required {{isset($due_question->noDuesDetails) && $due_question->noDuesDetails->answer == 1 ? 'checked' : '' }}>
                                                                    <span></span>
                                                                </label>
                                                            @endif    
                                                            </td>
                                                            <td>
                                                            @if($due_question->is_option == 1)
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" class="{{ $due_question->class }}" name="due[answer]" value="0" required {{isset($due_question->noDuesDetails) && $due_question->noDuesDetails->answer == 0 ? 'checked' : '' }}>
                                                                    <span></span>
                                                                </label>
                                                            @endif    
                                                            </td>
                                                            <td>

                                                            @if($due_question->hide == 1)
                                                                @php 
                                                                $dow_style = '';
                                                                if(!isset($due_question->noDuesDetails) && !isset($due_question->noDuesDetails->no_due_certificate)){
                                                                    $dow_style = 'display: none';
                                                                }
                                                                @endphp

                                                                <div class="custom-file">
                                                                @if(isset($disabled) && $disabled != 'disabled')
                                                                     <input class="custom-file-input file-upload" name="no_due_cerificate" type="file"
                                                                        id="no_due_cerificate" data-index="{{$due_question->id}}">
                                                                     <label class="custom-file-label" for="no_due_cerificate">Choose
                                                                     file...</label>
                                                                     <span id="due_file_error" class="text-danger"></span>
                                                                @endif     
                                                                    @if(isset($due_question->noDuesDetails) && isset($due_question->noDuesDetails->no_due_certificate)) 
                                                                     <a target="_blank" class="btn-link" id="download_no_due" href="{{ config('commanConfig.storage_server').'/'.$due_question->noDuesDetails->no_due_certificate}}" 
                                                                     style="{{$dow_style}}">download</a>
                                                                    @endif 
                                                                </div>
                                                            @else    
                                                                  
                                                                <textarea {{$readonly}} class="form-control form-control--custom form-control--textarea"
                                                                    name="due[remark]" style="border-top: none;resize: none;" id="remark-one" {{ $required }}>{{isset($due_question->noDuesDetails) ? $due_question->noDuesDetails->remark : '' }}</textarea>
                                                                    
                                                            @endif    
                                                            </td>
                                                        </tr>
                                                        @php
                                                        $i++;
                                                        @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3" style="text-align: center;">
                                            <button type="submit" style="{{ $style }}" class="btn btn-primary saveBtn hide-print" next_tab = "nested_tab_1">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="tab-pane" id="three" aria-expanded="false">
                                        three
                                    </div> -->

                    @php
                    if(isset($arrData['get_last_status']) && ($arrData['get_last_status']->status_id ==
                    config('commanConfig.applicationStatus.forwarded')))
                    $display = "display:none";
                    elseif (session()->get('role_name') != config('commanConfig.ee_junior_engineer'))
                    $display = "display:none";
                    else
                    $display = "";
                    @endphp
                    <div class="panel section-3 d-print" id="ee-note">
                        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                            <div class="portlet-body">
                                <div class="m-portlet__body m-portlet__body--table">
                                    <div class="m-subheader" style="padding: 0;">
                                        <div class="d-flex">
                                            <h3 class="section-title">
                                                Note
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="{{ $display }}">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Upload Note</h5>
                                            <span class="hint-text">Click on 'Upload' to upload EE
                                                -
                                                Note</span>
                                            <form action="{{ route('ee.upload_ee_note') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="application_id" value="{{ $arrData['society_detail']->id }}">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" name="ee_note" type="file"
                                                        id="test-upload" required="">
                                                    <label class="custom-file-label" for="test-upload">Choose
                                                        file...</label>
                                                </div>
                                                <span class="text-danger" id="file_error"></span>
                                                <div class="mt-auto">
                                                    <button type="submit" style="{{ $style }}" class="btn btn-primary btn-custom upload_note"
                                                        id="uploadBtn">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>  

                                     @if(isset($arrData['eeNote']) && count($arrData['eeNote']) > 0)
                                    
                                    <div class="m-section__content mb-0 table-responsive" style="margin-top: 30px">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="d-flex flex-column h-100 two-cols">
                                                        <h5>Download EE Note</h5>
                                                           
                                                                <div class="table-responsive" >
                                                                <table class="mt-2 table" id="dtBasicExample">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Document Name</th>
                                                                        <th class="text-center">Download</th>
                                                                        <th class="text-center" style="{{$style}}">Delete</th>   
                                                                    </tr>
                                                                </thead> 
                                                                <tbody>
                                                                @foreach($arrData['eeNote'] as $note)  
                                                                    <tr>
                                                                        <td>                                                                    @php
                                                                    if($note->document_name){
                                                                        $fileName = explode(".",$note->document_name)[0]; 
                                                                    }elseif($note->document_path){
                                                                        $fileName = explode(".",explode('/',$note->document_path)[1])[0];
                                                                    }
                                                                    @endphp 

                                                                    {{ isset($fileName) ? $fileName : ''}} 
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a class="btn-link" download href="{{ config('commanConfig.storage_server').'/'.$note->document_path}} " target="_blank" download>
                                                                    Download </a> 
                                                                        </td>
                                                                        <td class="text-center" style="{{$style}}">
                                                                            <i class="fa fa-close icon2 d-icon hide-print" id="{{ isset($note->id) ? $note->id : '' }}" onclick="removeDocuments(this.id)"></i>
                                                                            <input type="hidden" name= "oldFile" id="oldFile_{{$note->id}}" value="{{ isset($note->document_path) ? $note->document_path : '' }}"> 
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>    
                                                                </table>

                                                            @elseif($arrData['get_last_status']->status_id == config('commanConfig.applicationStatus.forwarded'))
                                                            <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                                * Note : EE note not available. </span>
                                                            @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<!-- <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script> -->
<script>
    $(".editDocumentStatus, .deleteDocumentStatus").on("click", function () {
        var documentstatusid = $(this).attr('data-documentstatusid');
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "{{ route('get-ee-scrutiny-data') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "documentStatusId": documentstatusid,
            },
            cache: false,
            success: function (res) {
                $("#ee-comment" + id).val(res.comment_by_EE);
                $("#oldFileName_" + id).val(res.EE_document_path);

                $("#fileName_" + id).val(res.EE_document_path);
            }
        });
    });

    //        $("#demarcation_date, #tit_bit_date").datepicker();

    $(".submt_btn").click(function () {
        var id = this.id.substr(10, 2);
        console.log(id);
        myfile = $("#EE_document_path_" + id).val();
        var ext = myfile.split('.').pop();
        console.log(ext);
        if (myfile != '') {
            if (ext != "pdf") {
                $("#file_error_" + id).text("Invalid type of file uploaded (only pdf allowed).");
                return false;
            } else {
                $("#file_error_" + id).text("");
                return true;
            }
        } 
        // else {
        //     $("#file_error_" + id).text("This field required");
        //     return false;
        // }
    });

    $(".edit_btn").click(function () {
        var id = this.id.substr(8, 2);
        myfile = $("#EE_document_" + id).val();
        var ext = myfile.split('.').pop();

        if (myfile != '') {
            if (ext != "pdf") {
                $("#edit_file_error_" + id).text("Invalid type of file uploaded (only pdf allowed).");
                return false;
            } else {
                $("#edit_file_error_" + id).text("");
                return true;
            }
         } 
         // else {
        //     $("#edit_file_error_" + id).text("This field required");
        //     return false;
        // }
    });

    $(".upload_note").click(function () {
        myfile = $("#test-upload").val();
        var ext = myfile.split('.').pop();
        if (myfile != '') {

            if (ext != "pdf") {
                $("#file_error").text("Invalid type of file uploaded (only pdf allowed).");
                return false;
            } else {
                $("#file_error").text("");
                return true;
            }
        } else {
            $("#file_error").text("This field required");
            return false;
        }
    });

//function is to keep tabs selected after refreshing page


    $(document).ready(function () {

        // initialize datatable
        $('.dataTables_length').addClass('bs-select');
        $('#dtBasicExample_wrapper > .row:first-child').remove();
        // $('#dtBasicExample').dataTable({searching: false, ordering:false, info: false});

        // keep selected tab id in session
        var id = Cookies.get('sectionId');
        if (id != undefined && id != 'undefined') {
            $(".panel").removeClass('active');
            $(".m-tabs__item").removeClass('active');
            $("#" + id).addClass('active');
            $("." + id).addClass('active');
        }

        if (id == 'section-2'){
           $(".printBtn").css("display","block"); 
        }
        //nested tabs
        var nestedTab = Cookies.get('nestedTab');
        console.log(nestedTab);
        if (nestedTab != undefined && nestedTab != 'undefined') {
            $(".nested_t").removeClass('active');
            $("#" + nestedTab).addClass('active');
            $(".tab-pane").removeClass('active');
            $("." + nestedTab).addClass('active');
            var tab = $("#"+nestedTab).attr('data-tab');
            $("#selected_tab").html(tab);
             

            // Cookies.set('nestedTab', 'undefined');
        }

        // get show and hide select file in no due certificate
        var selectedVal = $("input:radio.deu_1:checked").val();
        if (selectedVal == 0){
            $("#deu_1_hide").show('slow');
        } 

        // display hide and show in demarcation table
        var selectedVal1 = $("input:radio.dem_3:checked").val();
        console.log(selectedVal1);
        if (selectedVal1 == 1){
            $("#dem_3_hide").show('slow');
        }
        var selectedVal2 = $("input:radio.dem_4:checked").val();
        if (selectedVal2 == 1){
            $("#dem_4_hide").show('slow');
        }

        // demarcation 5 pt 
        var selectedVal3 = $("input:radio.dem_5:checked").val();
        if (selectedVal3 == 1){
            $(".crz_area").show('slow');
        }

        // consent 3 pt 
        var selectedVal4 = $("input:radio.con_3:checked").val();
        if (selectedVal4 == 0){
            $("#con_3_hide").show('slow');
        }

        // tit bit 3 pt 
        var selectedVal5 = $("input:radio.tit_3:checked").val();
        if (selectedVal5 == 1){
            $("#tit_4").show('slow');
        }else if(selectedVal5 == 0){
            $("#tit_5").show('slow');
        }
    });

    $(".ee_tabs").on('click', function () {
        $(".nav-item").removeClass('active');
        Cookies.set('sectionId', this.id);
    });

    $(".nested_t").on('click', function () {

        var id = $(this).attr("next_tab");
        selectNextTab(id);
    });

    $(".saveBtn").on('click', function () {

        var id = $(this).attr("next_tab");
        selectNextTab(id);
       
    });    
    function selectNextTab(id){
        Cookies.set('nestedTab', id);        
    }
    
    //print function
    function test() {
        window.print();
        document.title ='';
    }

    $('.printBtn').on('click', test);

    $(".ch-tab").click(function(){
        $(".printBtn").css("display","block");
        $(".report").css("display","block");
    }); 

    $(".v-tabs").click(function(){
        $(".printBtn").css("display","none");
        $(".report").css("display","none");
    });

    $(".nested_t").click(function(){
        var selected_tab = $(this).attr('data-tab');
        $("#selected_tab").html(selected_tab);
    });

    function removeDocuments(id) {
     
        var oldFile = $("#oldFile_"+id).val();
        var form_data = new FormData();
        form_data.append('id', id);
        form_data.append('oldFile', oldFile);
        form_data.append('_token', document.getElementsByName("_token")[0].value);
        $(".loader").show();
   
            $.ajax({
                url: "/delete_ee_note",
                data: form_data,
                type: 'POST',
                contentType: false,
                cache: false, 
                processData: false,
                success: function(data) {
                    console.log(data);
                    $(".loader").hide();
                    if (data == 'success'){
                        location.reload();
                        // $(".upload_doc_"+id).css("display","none");
                    }
                }
            })        
    } 

     $(".float").keypress(function(event){

        // if ((event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) && this.value.split('.').length < 2){
        //     return true;
        // }else{
        //     return false;
        // }

        var key = window.event ? event.keyCode : event.which;
          if ((event.keyCode == 8 || event.keyCode == 46
              || event.keyCode == 37 || event.keyCode == 39) && this.value.split('.').length < 2) {
                 return true;
             }
          else if ( key < 48 || key > 57 ) {
             return false;
          }
          else return true;

     });

    $(".total_area").keyup(function(){
        var totalArea = $("#total_area").val();
        
        var sum = 0;
        $(".total_area").each(function (){
            var sumVal = this.value;
            if (sumVal != ''){
                sum += + parseFloat(sumVal);
            };
        });
        $("#total_area").attr('value',sum.toFixed(2));
    }); 

    // class will be assign to element by seeder

    // demarcation pt 3 show hide
    $(".dem_3").click(function(){
        var value = this.value;
        if (value == 1){
            $("#dem_3_hide").show('slow');
        }else{
            $("#dem_3_hide").hide('slow');
        }
    }); 

    // demarcation pt 4show hide
    $(".dem_4").click(function(){
        var value = this.value;
        if (value == 1){
            $("#dem_4_hide").show('slow');
        }else{
            $("#dem_4_hide").hide('slow');
        }
    });

    // no due pt 1 show hide
    $(".deu_1").click(function(){
        var value = this.value;
        if (value == 0){
            $("#deu_1_hide").show('slow');
        }else{
            $("#deu_1_hide").hide('slow');
        }
    });

    // consent pt 3show hide
    $(".con_3").click(function(){
        var value = this.value;
        if (value == 0){
            $("#con_3_hide").show('slow');
        }else{
            $("#con_3_hide").hide('slow');
        }
    }); 

    // demarcation 5pt textbox show hide
    $(".dem_5").click(function(){
        var value = this.value;
        if (value == 1){
            $(".crz_area").show('slow');
        }else{
            $(".crz_area").hide('slow');
        }
    }); 

    // tit bit 3 pt textbox show hide
    $(".tit_3").click(function(){
        var value = this.value;
        if (value == 1){
            $("#tit_4").show('slow');
            $("#tit_5").hide('slow');
        }else{
            $("#tit_5").show('slow');
            $("#tit_4").hide('slow');
        }
    });

    $(".file-upload").change(function(){
        var questionId = $(this).attr('data-index');
        var myfile = $("#no_due_cerificate").val();
        var ext = myfile.split('.').pop();

        if (ext == "pdf"){
            $("#due_file_error").text("");
            $(".loader").show();
            var fileData = $("#no_due_cerificate").prop('files')[0];
            var applicationId = $("#application_id").val();

            var form_data = new FormData();
            form_data.append('file', fileData);  
            form_data.append('doc_name', myfile);  
            form_data.append('application_id', applicationId);  
            form_data.append('question_id', questionId);  
            form_data.append('_token', document.getElementsByName("_token")[0].value);  
            
            // ajax call to save file    
            $.ajax({
                url: "/upload_ee_no_due_certificate", 
                data: form_data,
                type: 'POST',
                contentType: false, 
                cache: false, // To unable request pages to be cached
                processData: false,
                dataType:'json',
                success: function(data) {
                    $(".loader").hide();
                    console.log(data.status);
                    if(data.status == 'success'){
                        $("#due_file_error").css("display","none");
                        $("#download_no_due").css("display","block");
                        $("#download_no_due").attr('href',data.document);
                        $.notify(data.msg,'success');
                    }else{
                       $.notify(data.msg,'error'); 
                    }
                }
            });                     
            }else{
                $("#due_file_error").css("display","block");
                $("#due_file_error").text("Invalid type of file uploaded.");
                // $("#no_due_cerificate").closest(".custom-file").addClass("has-error");
            }
    });   
  
</script>
@endsection
