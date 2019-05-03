@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.REE_department.action',compact('ol_application'))
@endsection
@section('content')

@if($societyData->drafted_offer_letter)
<?php $style = "display:block"; 
        $style1 = "display:none"; ?>
@else
<?php $style = "display:none"; 
  $style1 = "display:block"; ?>
@endif

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
if(isset($societyData->offer_letter_document_path))
    $document=$societyData->offer_letter_document_path;
else if(isset($societyData->drafted_offer_letter))
    $document = $societyData->drafted_offer_letter;

@endphp       

<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="d-flex">
            {{ Breadcrumbs::render('generate_offer_letter',$ol_application->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#generate-offer-letter" role="tab"
                    aria-selected="false">
                    <i class="la la-cog"></i> Generate Offer Letter
                </a>
            </li>
        </ul>
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
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
                                    <span class="field-value">{{(isset($societyData->application_no) ?
                                        $societyData->application_no : '')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Application Date:</span>
                                    <span class="field-value">{{ ($societyData->submitted_at ?
                                        date(config('commanConfig.dateFormat'), strtotime($societyData->submitted_at))
                                        : '')}}
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Society Registration No:</span>
                                    <span class="field-value">{{(isset($societyData->eeApplicationSociety->registration_no) ?
                                        $societyData->eeApplicationSociety->registration_no : '')}}</span>
                                </div>
                            </div>    
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Society Name:</span>
                                    <span class="field-value">{{(isset($societyData->eeApplicationSociety->name) ?
                                        $societyData->eeApplicationSociety->name : '')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Society Address:</span>
                                    <span class="field-value">{{(isset($societyData->eeApplicationSociety->address) ?
                                        $societyData->eeApplicationSociety->address : '')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Building Number:</span>
                                    <span class="field-value">{{(isset($societyData->eeApplicationSociety->building_no)
                                        ? $societyData->eeApplicationSociety->building_no : '')}}</span>
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
                                    <span class="field-value">{{(isset($societyData->eeApplicationSociety->name_of_architect)
                                        ? $societyData->eeApplicationSociety->name_of_architect : '')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Architect Mobile Number:</span>
                                    <span class="field-value">{{(isset($societyData->eeApplicationSociety->architect_mobile_no)
                                        ? $societyData->eeApplicationSociety->architect_mobile_no : '')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Architect Address:</span>
                                    <span class="field-value">{{(isset($societyData->eeApplicationSociety->architect_address)
                                        ? $societyData->eeApplicationSociety->architect_address : '')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Architect Telephone Number:</span>
                                    <span class="field-value">{{(isset($societyData->eeApplicationSociety->architect_telephone_no)
                                        ? $societyData->eeApplicationSociety->architect_telephone_no : '')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <!-- <div class="tab-pane active show" id="generate-offer-letter" role="tabpanel" style="{{$style1}}">
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="m-portlet__body">
                        <h3 class="section-title section-title--small mb-0">Remark on Offer Letter:</h3>
                        <span class="hint-text my-3">To generate draft offer letter click on 'Generate'
                            button</span>
                        <button class="btn btn-primary" id="generate-letter-button">Generate Draft Offer
                            Letter</button>
                    </div>
                </div>
            </div> -->
        </div>

        <div id="show-offer-letter">

            <div class="m-portlet m-portlet--mobile m_panel">
                <div class="m-portlet__body" style="padding-right: 0;">

                    <!-- <h3 class="section-title section-title--small mb-0">Offer Letter:</h3> -->
                            <div class=" row-list">
                                <div class="row">
                                    @if($societyData->ree_Jr_id && $applicationLog->status_id != config('commanConfig.applicationStatus.forwarded'))
                                        <div class="col-sm-6">
                                            <p class="font-weight-semi-bold">Offer letter</p>
                                            <p>Click to generate draft offer letter</p>
                                            <a href="{{route('ree.edit_offer_letter',encrypt($societyData->id))}}" class="btn btn-primary btn-w115">
                                            @if($societyData->drafted_offer_letter)
                                                Edit
                                            @else
                                                Generate
                                            @endif</a>
                                        </div>
                                    @endif
                                    <div class="col-sm-6 {{ $applicationLog->status_id == config('commanConfig.applicationStatus.forwarded') || $applicationLog->status_id == config('commanConfig.applicationStatus.offer_letter_generation') ? '' : 'border-left' }}">
                                        <p class="font-weight-semi-bold">Download Draft offer letter</p>
                                        <p>Click to view generated offer letter in PDF format</p>
                                        @if(isset($societyData->drafted_offer_letter))
                                            <a href="{{config('commanConfig.storage_server').'/'.$societyData->drafted_offer_letter}}" class="btn btn-primary" target="_blank">Download</a>
                                            @else
                                            <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                * Note : Offer Letter is not generated. </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    <div class="w-100">
                        <div class="">
                            <div class="row">
                             @if($societyData->ree_branch_head && ($applicationLog->status_id == config('commanConfig.applicationStatus.offer_letter_generation') || $applicationLog->status_id == config('commanConfig.applicationStatus.draft_offer_letter_generated')) && isset($societyData->drafted_offer_letter))
                                <div class="col-sm-6 row-list">
                                    <div class="d-flex flex-column h-100">
                                        <p class="font-weight-semi-bold">Upload Offer Letter</p>
                                        <span class="hint-text">Click on 'Upload' to upload offer letter</span>
                                        <form action="{{route('ree.upload_offer_letter',$societyData->id)}}" method="post"
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
                                </div>
                                @endif
                            @if(isset($societyData->offer_letter_document_path))
                                <div class="col-sm-6 border-left">
                                    <div class="d-flex flex-column h-100">
                                        <p class="font-weight-semi-bold">Download Signed uploaded Offer Letter</p>
                                        <p>Click to download uploaded signed offer letter in PDF format</p>
                                        <div class="mt-auto">
                                            <a href="{{config('commanConfig.storage_server').'/'.$societyData->offer_letter_document_path}}" class="btn btn-primary" target="_blank">Download</a>
                                        </div>
                                    </div>
                                </div>
                                @endif

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($societyData->ree_branch_head && ($applicationLog->status_id == config('commanConfig.applicationStatus.offer_letter_generation') || $applicationLog->status_id == config('commanConfig.applicationStatus.draft_offer_letter_generated')) && (isset($societyData->drafted_offer_letter) && isset($societyData->offer_letter_document_path)))
            <form role="form" id="sendForApproval" style="margin-top: 30px;" name="sendForApproval" class="form-horizontal"
                method="post" action="{{ route('ree.send_for_approval')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="applicationId" value="{{(isset($societyData->id) ? $societyData->id : '')}}">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body table--box-input">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                            <div class="">
                                <h3 class="section-title section-title--small">Send to CO:</h3>
                            </div>
                            <div class="remarks-suggestions">
                                <div class="mt-3">
                                    <label for="demarkation_comments">Remarks:</label>
                                    <textarea id="demarkation_comments" rows="5" cols="30" class="form-control form-control--custom"
                                        name="remark"></textarea>
                                </div>
                                <div class="mt-3 btn-list">
                                    <button class="btn btn-primary" type="submit">Send For Approval</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('#generate-letter-button').on('click', function () {
        $('#show-offer-letter').css("display", "block");
        $(this).closest("#generate-offer-letter").remove();
    });

    $("#uploadBtn").click(function (e) {

        myfile = $("#test-upload").val();
        var ext = myfile.split('.').pop();
        if (myfile != "") {
            if (ext != "pdf") {
                $("#file_error").text("Invalid File format(pdf file only).");
                return false;
            } else {
                $("#file_error").text("");
            }
        } else {
            $("#file_error").text("This field required.");
            return false;
        }

    });

    $(document).ready(function () {
        $(".display_msg").delay(5000).slideUp(300);
    });

</script>
@endsection