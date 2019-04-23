@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.REE_department.action',compact('ol_application'))
@endsection
@section('css')
<!-- <style> -->
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

@php 
if (isset($applicationData->drafted_offer_letter))
    $document = $applicationData->drafted_offer_letter;
else if(isset($applicationData->offer_letter_document_path)) 
    $document = $applicationData->offer_letter_document_path; 
@endphp

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Approved Offer Letter </h3>
                 {{ Breadcrumbs::render('approved_offer_letter',$ol_application->id) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            Society Details:
                        </h3>
                    </div>
                    <div class="row field-row">
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Application Number:</span>
                                <span class="field-value">{{(isset($applicationData->application_no) ?
                                    $applicationData->application_no : '')}}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Application Date:</span>
                                <span class="field-value">{{(isset($applicationData->submitted_at) ?
                                    date(config('commanConfig.dateFormat'),strtotime($applicationData->submitted_at)) :
                                    '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Society Registration No:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->registration_no) ?
                                    $applicationData->eeApplicationSociety->registration_no : '')}}</span>
                            </div>
                        </div>                        
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Society Name:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->name) ?
                                    $applicationData->eeApplicationSociety->name : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Society Address:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->address) ?
                                    $applicationData->eeApplicationSociety->address : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Building Number:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->building_no)
                                    ? $applicationData->eeApplicationSociety->building_no : '')}}</span>
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
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->name_of_architect)
                                    ? $applicationData->eeApplicationSociety->name_of_architect : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Mobile Number:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_mobile_no)
                                    ? $applicationData->eeApplicationSociety->architect_mobile_no : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Address:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_address)
                                    ? $applicationData->eeApplicationSociety->architect_address : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Telephone Number:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_telephone_no)
                                    ? $applicationData->eeApplicationSociety->architect_telephone_no : '')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->

    <!-- Site Visit -->
    

        @csrf
        <input type="hidden" name="applicationId" value="{{$applicationData->id}}">
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body" style="padding-right: 0;">
                @if($status->status_id != config('commanConfig.applicationStatus.forwarded') && session()->get('role_name') == config('commanConfig.ree_junior'))
                    <div class=" row-list">
                        <div class="row">
                            <div class="col-md-6 row-list">
                                @if($applicationData->offer_letter_document_path)   
                                    <p class="font-weight-semi-bold">Offer letter</p>
                                    <p>Click to edit generated offer letter in PDF format</p>
                                    <a href="{{route('ree.edit_offer_letter',encrypt($applicationData->id))}}" class="btn btn-primary btn-w115" target="_blank" rel="noopener"> 
                                    Edit</a>   
                                @endif
                            </div>
                            <div class="col-sm-6 border-left">
                                <p class="font-weight-semi-bold">Download Draft offer letter</p>
                                <p>Click to view generated offer letter in PDF format</p>
                                @if(isset($applicationData->drafted_offer_letter))
                                    <a href="{{config('commanConfig.storage_server').'/'.$applicationData->drafted_offer_letter}}" class="btn btn-primary" target="_blank">Download</a>
                                    @else
                                    <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                        * Note : Offer Letter is not generated. </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="w-100 row-list">
                    <div class="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="d-flex flex-column h-100">
                                    <p class="font-weight-semi-bold">Download Signed uploaded Offer Letter</p>
                                    <p>Click to download uploaded signed offer letter in PDF format</p>
                                    <div class="mt-auto">
                                        @if(isset($applicationData->offer_letter_document_path))
                                        <a href="{{config('commanConfig.storage_server').'/'.$applicationData->offer_letter_document_path}}" class="btn btn-primary btn-w115" target="_blank">Download</a>
                                        @else
                                        <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                            * Note : Offer Letter is not uploaded. </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($status->status_id != config('commanConfig.applicationStatus.forwarded') && $status->status_id != config('commanConfig.applicationStatus.sent_to_society') && $status->status_id != config('commanConfig.applicationStatus.reverted') && (session()->get('role_name') == config('commanConfig.ree_junior') || session()->get('role_name') == config('commanConfig.ree_branch_head')))
                                <div class="col-sm-6 border-left">
                                    <div class="d-flex flex-column h-100">
                                        <p class="font-weight-semi-bold">Upload Offer Letter</p>
                                        <span class="hint-text">Click on 'Upload' to upload offer letter</span>
                                        <form action="{{route('ree.upload_offer_letter',$applicationData->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="custom-file">
                                                <input class="custom-file-input pdfcheck" name="offer_letter" type="file"
                                                    id="test-upload" required="required">
                                                <label class="custom-file-label" for="test-upload">Choose
                                                    file...</label>
                                                <span class="text-danger" id="file_error"></span>
                                            </div>
                                            <div class="mt-auto">
                                                <button type="submit" class="btn btn-primary btn-w115" id="uploadBtn">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                   <!--  @if(isset($document))
                    <div class="col-md-6 row-list">
                        <p class="font-weight-semi-bold">Download Offer letter</p>
                        <p>Click on below button to download offer letter.</p>

                        @if(isset($document))   
                            <a href=" {{config('commanConfig.storage_server').'/'.$document}}" class="btn btn-primary" download target="_blank"> Download</a>
                        @endif    
                    </div>
                    @endif -->
                    <!-- <div class="col-sm-6 border-left">
                        <div class="d-flex flex-column h-100">
                            <p class="font-weight-semi-bold">Upload Offer Letter</p>
                            <span class="hint-text">Click on 'Upload' to upload offer letter</span>
                            <form action="{{route('ree.upload_offer_letter',$applicationData->id)}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="custom-file">
                                    <input class="custom-file-input pdfcheck" name="offer_letter" type="file"
                                        id="test-upload" required="required">
                                    <label class="custom-file-label" for="test-upload">Choose
                                        file...</label>
                                    <span class="text-danger" id="file_error"></span>
                                </div>
                                <div class="mt-auto">
                                    <button type="submit" class="btn btn-primary btn-w115" id="uploadBtn">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div> -->

                <!-- </div> -->
            </div>
        </div>
        <!-- end  -->

        <!-- Demarkation verification -->
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body table--box-input">
                <h3 class="section-title section-title--small mb-0">Remark on Offer Letter:</h3>
                <p class="heading"> </p>
                <div class="col-xs-12 row row-list">
                    <div class="col-md-12">
                        <p class="font-weight-semi-bold">Remark by REE</p>
                        <textarea rows="4" cols="63" name="demarkation_comments" class="form-control form-control--custom" readonly>{{ isset($applicationData->ReeLog->remark) ? $applicationData->ReeLog->remark : '' }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 row row-list border-0">
                    <div class="col-md-12">
                        <p class="font-weight-semi-bold">Remark by CO</p>
                        <textarea rows="4" cols="63" name="demarkation_comments" class="form-control form-control--custom" readonly>{{(isset($applicationData->coLog) ? $applicationData->coLog->remark : '')}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- end  -->
        <!-- Encrochment verification -->
    @if($ree_head && $status->status_id != config('commanConfig.applicationStatus.sent_to_society') && $status->status_id != config('commanConfig.applicationStatus.Rejected') && $status->status_id != config('commanConfig.applicationStatus.reverted'))
        <form role="form" id="approved_letter" name="approved_letter" class="form-horizontal" method="post" action="{{route('ree.send_letter_society')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="applicationId" value="{{$applicationData->id}}">
        <input type="hidden" name="societyId" value="{{$applicationData->society_id}}">
            <div class="m-portlet m-portlet--mobile m_panel">
                <div class="m-portlet__body table--box-input">
                    <h3 class="section-title section-title--small">Send to Society:</h3>
                    <div class="col-xs-12 row">
                        <div class="col-md-12">
                            <p class="font-weight-semi-bold">Remark</p>
                            <textarea rows="4" cols="63" name="remark" class="form-control form-control--custom"></textarea>
                            <button type="submit" class="btn btn-primary mt-3">Send offer Letter </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
</div>
@endsection
