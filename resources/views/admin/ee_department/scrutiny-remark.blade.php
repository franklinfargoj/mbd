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
                    }elseif (session()->get('role_name') != config('commanConfig.ee_junior_engineer'))
                    { $style = "display:none";
                    $disabled='disabled';
                    }else
                    {
                    $style = "";
                    $disabled="";
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
                                                @foreach($societyEEdocument[0]->societyDocuments as $document)
                                                
                                                <tr>
                                                    <td>{{ $i }}.</td>
                                                    <td>{{ $document->documents_Name[0]->name }}</td>

                                                    <td class="text-center"> 
                                                    <a download href="{{config('commanConfig.storage_server').'/'.$document->society_document_path }}" target="_blank"><img
                                                                class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a></td>
                                                    <td>

                                                        <p class="mb-2">{{ $document->comment_by_EE }}</p>
                                                        <div class="d-flex btn-list-inline-wrap">
                                                            @if($document->comment_by_EE)

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
                                                                                {{--<div class="mt-auto">
                                                                                    <button type="submit" id="btn_{{ $i }}"
                                                                                        class="btn btn-primary btn-custom"
                                                                                        id="uploadBtn">Upload</button>
                                                                                </div>--}}
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
                                                                            <input type="hidden" name="oldFileName" id="oldFileName_{{ $i }}">
                                                                            <div class="modal-body">
                                                                                <div class="mb-4">
                                                                                    <label for="remark">Remark:</label>
                                                                                    <textarea class="form-control form-control--custom"
                                                                                        name="comment_by_EE" id="comment_by_EE_{{ $i }}"
                                                                                        cols="30" rows="5"></textarea>
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
                                                                            <input type="hidden" name="fileName" id="fileName_{{ $i }}">
                                                                            <div class="modal-body">
                                                                                <div class="mb-4">
                                                                                    <label for="remark">Remark:</label>
                                                                                    <textarea class="form-control form-control--custom"
                                                                                        name="remark" id="remark_by_ee_{{ $i }}"
                                                                                        cols="30" rows="5"></textarea>
                                                                                </div>
                                                                                {{--<div class="mt-auto">
                                                                                    <button type="submit" class="btn btn-primary btn-custom"
                                                                                        id="uploadBtn2">Upload</button>
                                                                                </div>--}}
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

                                                    @if(!empty($document->EE_document_path))

                                                    <td class="text-center"><a download href="{{config('commanConfig.storage_server').'/'.$document->EE_document_path}}" target="_blank"><img
                                                                class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a></td>
                                                    @else
                                                    <td></td>
                                                    @endif
                                                </tr>

                                                @php
                                                $i++;
                                                @endphp
                                                @endforeach
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
                                <a class="nav-link nested_t" data-toggle="pill" href="#relocation" id="nested_tab_4" next_tab = "nested_tab_1" data-tab="R.G. Relocation">
                                    R.G. Relocation</a>
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
                                                        <label for="name">अभिन्यास (Layout):</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" {{$disabled}} class="form-control form-control--custom"
                                                            name="layout" id="name" value="{{ isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->layout : ''}}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="notice_detail">नोटीस चा तपशील:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                            value="{{ isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->details_of_notice : '' }}"
                                                            name="details_of_notice" id="notice_detail" placeholder=""
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 margin_top">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="investigation_officer">तपासणी अधिकाऱ्यांचे नाव:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                            value="{{ isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->investigation_officer_name : ''}}"
                                                            name="investigation_officer_name" id="investigation_officer"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="scrunity-check-date" class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="m_datepicker">तपासणी दिनांक:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom m_datepicker"
                                                            value="{{isset($arrData['consent_verification_checkist_data']) ? $arrData['consent_verification_checkist_data']->date_of_investigation : '' }}"
                                                            name="date_of_investigation" required placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    @if(count($arrData['consent_verification_details_data']) > 0)
                                        <a class="btn btn-primary hide-print" id="{{ $arrData['society_detail']->id }}" href="{{ route('ee_variation_report',$arrData['society_detail']->id)}}"> Generate Variation Report</a>
                                    @endif    

                                        <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input" style="margin-top: 10px">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                                    <thead class="thead-default">
                                                        <th style="width:10%">#</th>
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
                                                        <input type="hidden" name="question_id[{{$i}}]" value="{{ $consent_question->id }}">
                                                        <tr>
                                                            <td>{{ $i }}.</td>
                                                            <td>{{ $consent_question->question }}</td>
                                                            <td>
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" name="answer[{{$i}}]"
                                                                        value="1" required
                                                                        {{ (isset($arrData['consent_verification_details_data'][$consent_question->id]) && $arrData['consent_verification_details_data'][$consent_question->id]['answer'] == 1) ? 'checked' : '' }}>
                                                                    <span></span>
                                                                </label>
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
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" name="answer[{{$i}}]"
                                                                        value="0" {{ $checked }}>
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <textarea {{$disabled}} style="border-top: none;resize: none;" class="form-control form-control--custom form-control--textarea"
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
                                        <button type="submit" style="{{ $style }}" class="btn btn-primary saveBtn hide-print" next_tab = "nested_tab_2">Save</button>
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
                                                        <label for="name">अभिन्यास (Layout):</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->layout : ''}}"
                                                            name="layout" id="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">नोटीस चा तपशील:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->details_of_notice : '' }}"
                                                            name="details_of_notice" id="building-no" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 margin_top">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">तपासणी अधिकाऱ्यांचे नाव:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->investigation_officer_name : ''}}"
                                                            name="investigation_officer_name" id="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="scrunity-check-date" class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">स्थळ पाहणी दिनांक:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom m_datepicker"
                                                            required value="{{isset($arrData['demarcation_checkist_data']) ? $arrData['demarcation_checkist_data']->date_of_investigation : '' }}"
                                                            name="date_of_investigation" id="demarcation_date" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                                    <thead class="thead-default">
                                                        <th style="width:10%">#</th>
                                                        <th class="table-data--xl" style="width:50%">मुद्दा / तपशील</th>
                                                        <th style="width:5%">होय</th>
                                                        <th style="width:5%">नाही</th>
                                                        <th style="width:30%">शेरा</th>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $i = 2;
                                                        @endphp

                                                        <input type="hidden" name="application_id" value="{{ $arrData['society_detail']->id }}">
                                                        <tr>
                                                        <td>1</td>
                                                        <td colspan="4">
                                                            <span>एकूण भूखंडाचे क्षेत्रफळ </span>
                                                            <table style="width: 100%;margin-top: 10px">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th style="width: 55%;">Area</th>
                                                                    <th style="width: 45%;">Value</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>a)</td>
                                                                    <td>भाडेपट्टा करारनामा नुसार क्षेत्रफळ</td>
                                                                    <td><input {{$disabled}} type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->lease_agreement_area) ? $landDetails->lease_agreement_area : '' }}" name="land[lease_agreement_area]" id="lease_agreement_area" placeholder=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>b)</td>
                                                                    <td>अभिन्यासातील भूखंडाचे क्षेत्रफळ </td>
                                                                    <td><input {{$disabled}} type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->stag_plot_area) ? $landDetails->stag_plot_area : '' }}" name="land[stag_plot_area]" 
                                                                    id="stag_plot_area" placeholder=""></td>
                                                                </tr>                                    
                                                                <tr>
                                                                     <td>c)</td>    
                                                                    <td>टिट बिट भूखंडाचे क्षेत्रफळ </td>
                                                                    <td><input {{$disabled}} type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->tit_bit_area) ? $landDetails->tit_bit_area : '' }}" name="land[tit_bit_area]" id="tit_bit_area" placeholder=""></td>
                                                                </tr>
                                                                <tr>
                                                                     <td>d)</td>    
                                                                    <td>आर जी भूखंडाचे क्षेत्रफळ</td>
                                                                    <td><input {{$disabled}} type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->rg_plot_area) ? $landDetails->rg_plot_area : '' }}" name="land[rg_plot_area]" id="rg_plot_area" placeholder=""></td>
                                                                </tr>
                                                                <tr>
                                                                     <td>e)</td>    
                                                                    <td>पि जि भूखंडाचे क्षेत्रफळ </td>
                                                                    <td><input {{$disabled}} type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->pg_plot_area) ? $landDetails->pg_plot_area : '' }}" name="land[pg_plot_area]" id="pg_plot_area" placeholder=""></td>
                                                                </tr>
                                                                <tr>
                                                                     <td>f)</td>    
                                                                    <td>Road setback  area</td>
                                                                    <td><input {{$disabled}} type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->road_setback_area) ? $landDetails->road_setback_area : '' }}" name="land[road_setback_area]" id="road_setback_area" placeholder=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>g)</td>    
                                                                    <td>Encroachment area</td>
                                                                    <td><input {{$disabled}} type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->encroachment_area) ? $landDetails->encroachment_area : '' }}" name="land[encroachment_area]" id="encroachment_area" placeholder=""></td>
                                                                </tr>
                                                                <tr>
                                                                     <td>h)</td>    
                                                                    <td>इतर क्षेत्रफळ </td>
                                                                    <td><input {{$disabled}} type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->another_area) ? $landDetails->another_area : '' }}" name="land[another_area]" id="another_area" placeholder=""></td>

                                                                </tr>
                                                            </table>
                                                        </td>
                                                        </tr>
                                                        @foreach($arrData['demarcation_question'] as
                                                        $demarcation_question)

                                                        @php if(isset($demarcation_question->is_compulsory) && $demarcation_question->is_compulsory == '1'){
                                                            $required = 'required';
                                                        }
                                                        else{
                                                            $required = '';
                                                        }
                                                        @endphp

                                                        <input type="hidden" name="question_id[{{$i}}]" value="{{ $demarcation_question->id }}">
                                                        <tr>
                                                            <td>{{ $i }}.</td>
                                                            <td>{{ $demarcation_question->question }}</td>
                                                            <td>
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" name="answer[{{ $i }}]" value="1" required
                                                                        {{ (isset($arrData['demarcation_details_data'][$demarcation_question->id]) && $arrData['demarcation_details_data'][$demarcation_question->id]['answer'] == 1) ? 'checked' : '' }}>
                                                                    <span></span>
                                                                </label>
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
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" name="answer[{{ $i }}]"
                                                                        value="0" {{ $checked_demarcation  }}>
                                                                    <span></span>
                                                                </label></td>
                                                            <td>
                                                                <textarea class="form-control form-control--custom form-control--textarea"
                                                                    name="remark[{{ $i }}]" style="border-top: none;resize: none;" {{$disabled}} id="remark-one" {{$required}}>{{ isset($arrData['demarcation_details_data'][$demarcation_question->id]) ? $arrData['demarcation_details_data'][$demarcation_question->id]['remark'] : '' }}</textarea>
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
                                        <button type="submit" style="{{ $style }}" class="btn btn-primary saveBtn hide-print" next_tab = "nested_tab_3">Save</button>
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
                                                        <label for="name">अभिन्यास (Layout):</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->layout : ''}}"
                                                            name="layout" id="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">नोटीस चा तपशील:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->details_of_notice : '' }}"
                                                            name="details_of_notice" id="building-no" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 margin_top">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">तपासणी अधिकाऱ्यांचे नाव:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->investigation_officer_name : ''}}"
                                                            name="investigation_officer_name" id="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="scrunity-check-date" class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">स्थळ पाहणी दिनांक:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom m_datepicker"
                                                            required value="{{isset($arrData['tit_bit_checkist_data']) ? $arrData['tit_bit_checkist_data']->date_of_investigation : '' }}"
                                                            name="date_of_investigation" id="tit_bit_date" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                                    <thead class="thead-default">
                                                        <th style="width:10%">#</th>
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
                                                        @endphp                                                    

                                                        <input type="hidden" name="question_id[{{$i}}]" value="{{ $tit_bit->id }}">
                                                        <tr>
                                                            <td>{{ $i }}.</td>
                                                            <td>{{ $tit_bit->question }}</td>
                                                            <td>
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" name="answer[{{ $i }}]" value="1" required
                                                                        {{ (isset($arrData['tit_bit_details_data'][$tit_bit->id]) && $arrData['tit_bit_details_data'][$tit_bit->id]['answer'] == 1) ? 'checked' : '' }}>
                                                                    <span></span>
                                                                </label>
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
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" name="answer[{{ $i }}]"
                                                                        value="0" {{ $checked_tit_bit }}>
                                                                    <span></span>
                                                                </label></td>
                                                            <td>
                                                                <textarea {{$disabled}} class="form-control form-control--custom form-control--textarea"
                                                                    name="remark[{{ $i }}]" style="border-top: none;resize: none;" id="remark-one" {{ $required }}>{{ isset($arrData['tit_bit_details_data'][$tit_bit->id]) ? $arrData['tit_bit_details_data'][$tit_bit->id]['remark'] : '' }}</textarea>
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
                                        <button type="submit" style="{{ $style }}" class="btn btn-primary saveBtn hide-print" next_tab = "nested_tab_4">Save</button>
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
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom"
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
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                            disabled value="{{ $arrData['society_detail']->eeApplicationSociety->building_no }}"
                                                            id="building-no" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">अभिन्यास (Layout):</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                            required value="{{ isset($arrData['rg_checkist_data']) ? $arrData['rg_checkist_data']->layout : ''}}"
                                                            name="layout" id="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="building-no">नोटीस चा तपशील:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input {{$disabled}} type="text" class="form-control form-control--custom"
                                                            name="details_of_notice" id="building-no" placeholder=""
                                                            required value="{{ isset($arrData['rg_checkist_data']) ? $arrData['rg_checkist_data']->details_of_notice : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;margin-top: 10px">
                                                    <thead class="thead-default">
                                                        <th style="width:10%">#</th>
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
                                                        @foreach($arrData['rg_question'] as $rg_question)

                                                        @php if(isset($rg_question->is_compulsory) && $rg_question->is_compulsory == '1'){
                                                            $required = 'required';
                                                        }
                                                        else{
                                                            $required = '';
                                                        }
                                                        @endphp                                                     
                                                        <input type="hidden" name="question_id[{{$i}}]" value="{{ $rg_question->id }}">
                                                        <tr>
                                                            <td>{{ $i }}.</td>
                                                            <td>{{ $rg_question->question }}</td>
                                                            <td>
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" name="answer[{{ $i }}]" value="1" required
                                                                        {{ (isset($arrData['rg_details_data'][$rg_question->id]) && $arrData['rg_details_data'][$rg_question->id]['answer'] == 1) ? 'checked' : '' }}>
                                                                    <span></span>
                                                                </label>
                                                            </td>
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
                                                            <td>
                                                                <label class="m-radio m-radio--primary">
                                                                    <input {{$disabled}} type="radio" name="answer[{{ $i }}]"
                                                                        value="0" {{ $checked_rg_location }}>
                                                                    <span></span>
                                                                </label></td>
                                                            <td>
                                                                <textarea {{$disabled}} class="form-control form-control--custom form-control--textarea"
                                                                    name="remark[{{ $i }}]" style="border-top: none;resize: none;" id="remark-one" {{ $required }}>{{ isset($arrData['rg_details_data'][$rg_question->id]) ? $arrData['rg_details_data'][$rg_question->id]['remark'] : '' }}</textarea>
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
                                        <button type="submit" style="{{ $style }}" class="btn btn-primary saveBtn hide-print" next_tab = "nested_tab_1">Save</button>
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
                                        <div class="d-flex align-items-center justify-content-center">
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
                                    <div class="m-section__content mb-0 table-responsive" style="margin-top: 30px">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="d-flex flex-column h-100 two-cols">
                                                        <h5>Download EE Note</h5>
                                                            @if(isset($arrData['eeNote']))
                                                                <div class="table-responsive">
                                                                <table class="mt-2 table"> 
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

                                                                    {{ isset($fileName) ? $fileName : ''}} : 
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a class="btn-link" download href="{{ config('commanConfig.storage_server').'/'.$note->document_path}} " target="_blank" download>
                                                                    Download </a> 
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <i class="fa fa-close icon2 d-icon hide-print" id="{{ isset($note->id) ? $note->id : '' }}" onclick="removeDocuments(this.id)"></i>
                                                                            <input type="hidden" name= "oldFile" id="oldFile_{{$note->id}}" value="{{ isset($note->document_path) ? $note->document_path : '' }}"> 
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>    
                                                                </table>

                                                            @else
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
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
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
                $("#comment_by_EE_" + id).val(res.comment_by_EE);
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

        if (nestedTab != undefined && nestedTab != 'undefined') {
            $(".nested_t").removeClass('active');
            $("#" + nestedTab).addClass('active');
            $(".tab-pane").removeClass('active');
            $("." + nestedTab).addClass('active');
            var tab = $("#"+nestedTab).attr('data-tab');
            $("#selected_tab").html(tab);
             

            // Cookies.set('nestedTab', 'undefined');
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
    }); 

    $(".v-tabs").click(function(){
        $(".printBtn").css("display","none");
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
 
</script>
@endsection
