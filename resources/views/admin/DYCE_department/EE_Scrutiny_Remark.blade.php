@extends('admin.layouts.app')
@section('content')
<div class="custom-wrapper">
    <div class="col-md-12">
        <div id="tabbed-content" class="">
            <div class="m-portlet__head">
                <div class="m-portlet__head-tools">
                    <ul id="top-tabs" class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom tabs">
                        <li class="nav-item m-tabs__item active" data-target="#document-scrunity">
                            <a class="nav-link m-tabs__link">
                                <i class="la la-cog"></i> Document Scrutiny
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item" data-target="#checklist-scrunity">
                            <a class="nav-link m-tabs__link">
                                <i class="la la-cog"></i> Checklist Scrutiny
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item" data-target="#ee-note">
                            <a class="nav-link m-tabs__link">
                                <i class="la la-cog"></i> EE Note
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                <div class="row">
                    <div class="col-md-12">
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
                                                    <span class="field-value">
                                                        {{(isset($eeScrutinyData->application_no) ?
                                                        $eeScrutinyData->application_no : '')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 field-col">
                                                <div class="d-flex">
                                                    <span class="field-name">Application Date:</span>
                                                    <span class="field-value">{{(isset($eeScrutinyData->submitted_at) ? date(config('commanConfig.dateFormat'),strtotime($eeScrutinyData->submitted_at)) : '')}}</span>

                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-6 field-col">
                                                <div class="d-flex">
                                                    <span class="field-name">Society Name:</span>
                                                    <span class="field-value">{{(isset($eeScrutinyData->eeApplicationSociety->name)
                                                        ? $eeScrutinyData->eeApplicationSociety->name : '')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 field-col">
                                                <div class="d-flex">
                                                    <span class="field-name">Society Address:</span>
                                                    <span class="field-value">{{(isset($eeScrutinyData->eeApplicationSociety->address)
                                                        ? $eeScrutinyData->eeApplicationSociety->address : '')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 field-col">
                                                <div class="d-flex">
                                                    <span class="field-name">Building Number:</span>
                                                    <span class="field-value">{{(isset($eeScrutinyData->eeApplicationSociety->building_no)
                                                        ? $eeScrutinyData->eeApplicationSociety->building_no : '')}}</span>
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
                                                    <span class="field-value">{{(isset($eeScrutinyData->eeApplicationSociety->name_of_architect)
                                                        ? $eeScrutinyData->eeApplicationSociety->name_of_architect :
                                                        '')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 field-col">
                                                <div class="d-flex">
                                                    <span class="field-name">Architect Mobile Number:</span>
                                                    <span class="field-value">{{(isset($eeScrutinyData->eeApplicationSociety->architect_mobile_no)
                                                        ? $eeScrutinyData->eeApplicationSociety->architect_mobile_no :
                                                        '')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 field-col">
                                                <div class="d-flex">
                                                    <span class="field-name">Architect Address:</span>
                                                    <span class="field-value">{{(isset($eeScrutinyData->eeApplicationSociety->architect_address)
                                                        ? $eeScrutinyData->eeApplicationSociety->architect_address :
                                                        '')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 field-col">
                                                <div class="d-flex">
                                                    <span class="field-name">Architect Telephone Number:</span>
                                                    <span class="field-value">{{(isset($eeScrutinyData->eeApplicationSociety->architect_telephone_no)
                                                        ? $eeScrutinyData->eeApplicationSociety->architect_telephone_no
                                                        : '')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">

                            <div class="panel active" id="document-scrunity">
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
                                                        <th class="table-data--xs">अ क्र.</th>
                                                        <th>तपशील</th>
                                                        <th class="table-data--xs">सोसायटी दस्तावेज</th>
                                                        <th class="table-data--lg">टिप्पणी</th>
                                                        <th class="table-data--xs">दस्तावेज</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i=0; ?>
                                                        @foreach($eeScrutinyData->eeApplicationSociety->societyDocuments
                                                        as $data)
                                                        <tr>
                                                            <td>{{$i+1}}</td>
                                                            <td>{{($data->documents_Name[0]->name)}}</td>
                                                            <td class="text-center">
                                                                @if(isset($data->society_document_path))
                                                                <a href="{{ asset($data->society_document_path) }}">
                                                                    <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <p class="mb-2">{{$data->comment_by_EE}}</p>
                                                            </td>
                                                            <td class="text-center">
                                                                @if(isset($data->EE_document_path))
                                                                <a href="{{ asset($data->EE_document_path) }}"><img
                                                                        class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}">
                                                                </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="modal fade show" id="add-remark" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Add
                                                                    Remark</h5>
                                                                <button style="cursor: pointer;" type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <form class="" action="" method="post">
                                                                <div class="modal-body">
                                                                    <div class="mb-4">
                                                                        <label for="remark">Remark:</label>
                                                                        <textarea class="form-control form-control--custom"
                                                                            name="remark" id="remark" cols="30" rows="5"></textarea>
                                                                    </div>
                                                                    <div class="custom-file">
                                                                        <input class="custom-file-input" name="" type="file"
                                                                            id="test-upload" required="">
                                                                        <label class="custom-file-label" for="test-upload">Choose
                                                                            file...</label>
                                                                    </div>
                                                                    <div class="mt-auto">
                                                                        <button type="submit" class="btn btn-primary btn-custom"
                                                                            id="uploadBtn">Upload</button>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary">Save</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade show" id="delete-remark" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel2">Delete
                                                                    Remark</h5>
                                                                <button style="cursor: pointer;" type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <form class="" action="" method="post">
                                                                <div class="modal-body">
                                                                    <div class="mb-4">
                                                                        <label for="remark">Remark:</label>
                                                                        <textarea class="form-control form-control--custom"
                                                                            name="remark" id="remark2" cols="30" rows="5"></textarea>
                                                                    </div>
                                                                    <div class="custom-file">
                                                                        <input class="custom-file-input" name="" type="file"
                                                                            id="test-upload2" required="">
                                                                        <label class="custom-file-label" for="test-upload2">Choose
                                                                            file...</label>
                                                                    </div>
                                                                    <div class="mt-auto">
                                                                        <button type="submit" class="btn btn-primary btn-custom"
                                                                            id="uploadBtn2">Upload</button>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary">Save</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel" id="checklist-scrunity">
                                <div class="m-portlet">
                                    <div class="tab-pane--nested-tabs__inner">
                                        <div>
                                            <ul id="scrunity-tabs" class="nav nav-pills nav-justified" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active show" data-toggle="pill" href="#verification">
                                                        Consent Verification</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#demarcation">
                                                        Demarcation</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tit-bit">
                                                        Tit-Bit</a>
                                                </li>
                                                <li class="nav-item ">
                                                    <a class="nav-link" data-toggle="pill" href="#relocation">
                                                        R.G. Relocation</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <form class="form--custom" action="" method="post">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 d-flex align-items-center">
                                                            <label for="name">संस्थेचे नाव:</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control form-control--custom"
                                                                id="name" value="{{(isset($eeScrutinyData->eeApplicationSociety->name) ? $eeScrutinyData->eeApplicationSociety->name : '')}}"
                                                                readonly>
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
                                                                id="building-no" placeholder="" value="{{(isset($eeScrutinyData->eeApplicationSociety->building_no) ? $eeScrutinyData->eeApplicationSociety->building_no : '')}}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 d-flex align-items-center">
                                                            <label for="name">अभिन्यास (Layout):</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control form-control--custom"
                                                                id="name" value="{{(isset($eeScrutinyData->Consent_checklist->layout) ? $eeScrutinyData->Consent_checklist->layout : '')}}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 d-flex align-items-center">
                                                            <label for="building-no">नोटीस चा तपशील:</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control form-control--custom"
                                                                id="building-no" placeholder="" value="{{(isset($eeScrutinyData->Consent_checklist->details_of_notice) ? $eeScrutinyData->Consent_checklist->details_of_notice : '')}}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 d-flex align-items-center">
                                                            <label for="name">तपासणी अधिकाऱ्यांचे नाव:</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control form-control--custom"
                                                                id="name" value="{{(isset($eeScrutinyData->Consent_checklist->investigation_officer_name) ? $eeScrutinyData->Consent_checklist->investigation_officer_name : '')}}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="scrunity-check-date" class="col-sm-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 d-flex align-items-center">
                                                            <label for="building-no">तपासणी दिनांक:</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control form-control--custom"
                                                                id="building-no" placeholder="" value="{{(isset($eeScrutinyData->Consent_checklist->date_of_investigation) ? $eeScrutinyData->Consent_checklist->date_of_investigation : '')}}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-content">

                                                <!-- Consent Verification -->
                                                <div class="tab-pane active" id="verification">

                                                    <div class="table-checklist m-portlet__body m-portlet__body--table">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead class="thead-default">
                                                                    <th>#</th>
                                                                    <th class="table-data--xl">मुद्दा / तपशील</th>
                                                                    <th>होय</th>
                                                                    <th>नाही</th>
                                                                    <th>शेरा</th>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i = 1; ?>
                                                                    @foreach($eeScrutinyData->consentQuetions as $data)

                                                                    <tr>
                                                                        <td>{{$i}}</td>
                                                                        <td>{{$data->question}}</td>
                                                                        <td>
                                                                            <label class="m-radio m-radio--primary">

                                                                                <input type="radio" class="radioBtn"
                                                                                    name="con_radio_{{$i}}" disabled
                                                                                    {{ (isset($data->consentDetails->answer) && $data->consentDetails->answer == '1') ? 'checked' : ''}}>
                                                                                <span></span>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="m-radio m-radio--primary">

                                                                                <input type="radio" class="radioBtn"
                                                                                    name="con_radio_{{$i}}" disabled
                                                                                    {{(isset($data->consentDetails->answer) && $data->consentDetails->answer == '0') ? 'checked' : ''}}>
                                                                                <span></span>
                                                                            </label></td>
                                                                        <td>
                                                                            <textarea class="form-control form-control--custom form-control--textarea"
                                                                                disabled name="remark-one" id="remark-one">{{ (isset($data->consentDetails)) ? $data->consentDetails->remark : ""}}</textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Demarkation Verification -->
                                                <div class="tab-pane" id="demarcation">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="name">अभिन्यास (Layout):</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom"
                                                                        id="name" value="{{(isset($eeScrutinyData->Demark_checklist->layout) ? $eeScrutinyData->Demark_checklist->layout : '')}}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="building-no">नोटीस चा तपशील:</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom"
                                                                        id="building-no" placeholder="" value="{{(isset($eeScrutinyData->Demark_checklist->details_of_notice) ? $eeScrutinyData->Demark_checklist->details_of_notice : '')}}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="name">तपासणी अधिकाऱ्यांचे नाव:</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom"
                                                                        id="name" value="{{(isset($eeScrutinyData->Demark_checklist->investigation_officer_name) ? $eeScrutinyData->Demark_checklist->investigation_officer_name : '')}}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="scrunity-check-date" class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="building-no">स्थळ पाहणी दिनांक:</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom"
                                                                        id="building-no" placeholder="" value="{{(isset($eeScrutinyData->Demark_checklist->date_of_investigation) ? $eeScrutinyData->Demark_checklist->date_of_investigation : '')}}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-checklist m-portlet__body m-portlet__body--table">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead class="thead-default">
                                                                    <th>#</th>
                                                                    <th class="table-data--xl">मुद्दा / तपशील</th>
                                                                    <th>होय</th>
                                                                    <th>नाही</th>
                                                                    <th>शेरा</th>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i = 1; ?>

                                                                    @foreach($eeScrutinyData->DemarkQuetions as $data)
                                                                    <tr>
                                                                        <td>{{$i}}</td>
                                                                        <td>{{$data->question}}</td>
                                                                        <td>
                                                                            <label class="m-radio m-radio--primary">
                                                                                <input type="radio" class="radioBtn"
                                                                                    name="dem_radio_{{$i}}" disabled
                                                                                    {{(isset($data->demarkDetails) && $data->demarkDetails->answer == '1') ? 'checked' : ''}}>
                                                                                <span></span>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="m-radio m-radio--primary">
                                                                                <input type="radio" class="radioBtn"
                                                                                    name="dem_radio_{{$i}}" disabled
                                                                                    {{(isset($data->demarkDetails) && $data->demarkDetails->answer == '0') ? 'checked' : ''}}>
                                                                                <span></span>
                                                                            </label></td>
                                                                        <td>
                                                                            <textarea class="form-control form-control--custom form-control--textarea"
                                                                                disabled name="remark-one" id="remark-one">{{ isset($data->demarkDetails) ? $data->demarkDetails->remark : ""}}</textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- TitBit Verification -->
                                                <div class="tab-pane" id="tit-bit">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="name">अभिन्यास (Layout):</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom"
                                                                        id="name" value="{{(isset($eeScrutinyData->TitBit_checklist->layout) ? $eeScrutinyData->TitBit_checklist->layout : '')}}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="building-no">नोटीस चा तपशील:</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom"
                                                                        id="building-no" placeholder="" value="{{(isset($eeScrutinyData->TitBit_checklist->details_of_notice) ? $eeScrutinyData->TitBit_checklist->details_of_notice : '')}}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="name">तपासणी अधिकाऱ्यांचे नाव:</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom"
                                                                        id="name" value="{{(isset($eeScrutinyData->TitBit_checklist->investigation_officer_name) ? $eeScrutinyData->TitBit_checklist->investigation_officer_name : '')}}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="scrunity-check-date" class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="building-no">स्थळ पाहणी दिनांक:</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom"
                                                                        id="building-no" placeholder="" value="{{(isset($eeScrutinyData->TitBit_checklist->date_of_investigation) ? $eeScrutinyData->TitBit_checklist->date_of_investigation : '')}}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-checklist m-portlet__body m-portlet__body--table">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead class="thead-default">
                                                                    <th>#</th>
                                                                    <th class="table-data--xl">मुद्दा / तपशील</th>
                                                                    <th>होय</th>
                                                                    <th>नाही</th>
                                                                    <th>शेरा</th>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i = 1; ?>
                                                                    @foreach($eeScrutinyData->TitBitQuetions as $data)
                                                                    <tr>
                                                                        <td>{{$i}}</td>
                                                                        <td>{{$data->question}}</td>
                                                                        <td>
                                                                            <label class="m-radio m-radio--primary">
                                                                                <input type="radio" name="tit_radio_{{$i}}"
                                                                                    disabled
                                                                                    {{(isset($data->titBitDetails) && $data->titBitDetails->answer == '1' ? 'checked' : '')}}>
                                                                                <span></span>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="m-radio m-radio--primary">
                                                                                <input type="radio" name="tit_radio_{{$i}}"
                                                                                    disabled
                                                                                    {{(isset($data->titBitDetails) && $data->titBitDetails->answer =='0' ? 'checked' : '')}}>
                                                                                <span></span>
                                                                            </label></td>
                                                                        <td>
                                                                            <textarea class="form-control form-control--custom form-control--textarea"
                                                                                disabled name="remark-one" id="remark-one">{{(isset($data->titBitDetails)) ? $data->titBitDetails->remark : ""}}</textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Relocation Verification -->
                                                <div class="tab-pane" id="relocation">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="name">अभिन्यास (Layout):</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom"
                                                                        id="name" value="{{(isset($eeScrutinyData->Relocation_checklist->layout) ? $eeScrutinyData->Relocation_checklist->layout : '')}}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 d-flex align-items-center">
                                                                    <label for="building-no">नोटीस चा तपशील:</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control form-control--custom"
                                                                        id="building-no" placeholder="" value="{{(isset($eeScrutinyData->Relocation_checklist->details_of_notice) ? $eeScrutinyData->Relocation_checklist->details_of_notice : '')}}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-checklist m-portlet__body m-portlet__body--table">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead class="thead-default">
                                                                    <th>#</th>
                                                                    <th class="table-data--xl">मुद्दा / तपशील</th>
                                                                    <th>होय</th>
                                                                    <th>नाही</th>
                                                                    <th>शेरा</th>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i = 1; ?>
                                                                    @foreach($eeScrutinyData->relocationQuetions as
                                                                    $data)

                                                                    <tr>
                                                                        <td>{{$i}}</td>
                                                                        <td>{{($data->question)}}</td>
                                                                        <td>
                                                                            <label class="m-radio m-radio--primary">
                                                                                <input type="radio" name="rg_radio_{{$i}}"
                                                                                    disabled
                                                                                    {{(isset($data->relocationDetails) && $data->relocationDetails->answer == '1') ? 'checked' : ''}}>
                                                                                <span></span>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="m-radio m-radio--primary">
                                                                                <input type="radio" name="rg_radio_{{$i}}"
                                                                                    disabled
                                                                                    {{(isset($data->relocationDetails) && $data->relocationDetails->answer == '0') ? 'checked' : ''}}>
                                                                                <span></span>
                                                                            </label></td>
                                                                        <td>
                                                                            <textarea class="form-control form-control--custom form-control--textarea"
                                                                                disabled name="remark-one" id="remark-one">{{ isset($data->relocationDetails) ? $data->relocationDetails->remark : ''}}</textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                                <!-- <div class="tab-pane" id="three" aria-expanded="false">
                                three
                            </div> -->



                            </div>
                        </div>
                        <div class="panel" id="ee-note">
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
                                        <div class="m-section__content mb-0 table-responsive">
                                            <div class="d-flex flex-column h-100">
                                                <h5>Download Note</h5>
                                                <span class="hint-text">Download EE Note uploaded
                                                    by EE</span>
                                                <div class="mt-3">
                                                    @if(isset($eeScrutinyData->eeNote->document_path))
                                                    <a href="{{ config('commanConfig.storage_server').'/'.$eeScrutinyData->eeNote->document_path }}">

                                                        <button class="btn btn-primary">Download
                                                            offer Letter Application</button>
                                                    </a>
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

    @endsection
