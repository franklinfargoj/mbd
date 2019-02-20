@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.'.$folder.'.action',compact('ol_application'))
@endsection
@section('content') 

<div class="custom-wrapper"> 
    <div class="col-md-12">
        <div class="d-flex hide-print">
        @if (session()->get('role_name') == config('commanConfig.dyce_jr_user') || session()->get('role_name') == config('commanConfig.dyce_branch_head') || session()->get('role_name') == config('commanConfig.dyce_deputy_engineer'))
            {{ Breadcrumbs::render('EE_Scrutiny_Remark-dyce',$ol_application->id) }}

        @elseif (session()->get('role_name') == config('commanConfig.ree_junior') || session()->get('role_name') == config('commanConfig.ree_deputy_engineer') || session()->get('role_name') == config('commanConfig.ree_assistant_engineer') || session()->get('role_name') == config('commanConfig.ree_branch_head'))  
        
            {{ Breadcrumbs::render('EE_scrutiny_ree',$ol_application->id) }}  

        @elseif(session()->get('role_name') == config('commanConfig.co_engineer'))
            {{ Breadcrumbs::render('EE_scrutiny_co',$ol_application->id) }}  

         @elseif(session()->get('role_name') == config('commanConfig.cap_engineer'))
            {{ Breadcrumbs::render('EE_scrutiny_cap',$ol_application->id) }}
         
         @elseif(session()->get('role_name') == config('commanConfig.vp_engineer')) 
            {{ Breadcrumbs::render('EE_scrutiny_vp',$ol_application->id) }}      
        @endif    
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div> 
        <div id="tabbed-content" class="">
            <div class="m-portlet__head">
                <div class="m-portlet__head-tools">
                    <ul id="top-tabs" class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom tabs hide-print">
                        <li class="nav-item m-tabs__item active v-tabs" data-target="#document-scrunity">
                            <a class="nav-link m-tabs__link">
                                <i class="la la-cog"></i> Document Scrutiny
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item" id="checklist_scrunity" data-target="#checklist-scrunity">
                            <a class="nav-link m-tabs__link">
                                <i class="la la-cog"></i> Checklist Scrutiny
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item v-tabs" data-target="#ee-note">
                            <a class="nav-link m-tabs__link">
                                <i class="la la-cog"></i> EE Note
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                        <div class="m-subheader">
                            <div class="d-flex">
                                <h3 class="section-title section-title--small">
                                    Society Details:
                                </h3>
                                <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto">
                                    <img src="{{asset('/img/print-icon.svg')}}" 
                                            style="max-width: 22px;display:none" class="printBtn hide-print"></a>
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
                                        <span class="field-value">{{(isset($eeScrutinyData->submitted_at) ?
                                            date(config('commanConfig.dateFormat'),strtotime($eeScrutinyData->submitted_at))
                                            : '')}}</span>


                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Society Registration No:</span>
                                        <span class="field-value">{{(isset($eeScrutinyData->eeApplicationSociety->registration_no)
                                            ? $eeScrutinyData->eeApplicationSociety->registration_no : '')}}</span>
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
                                            <?php $i=1; ?>
                                            @if(count($societyDocument) > 0)
                                                @foreach($societyDocument as $value)
                                                    @foreach($value as $document)
                                                        <tr> 
                                                            <td>{{ isset($document->group) ? $document->group : $i }}.{{$document->sort_by}}</td>
                                                            <td>{{(isset($document->name) ? $document->name : '')}}</td>
                                                            <td class="text-center">
                                                            @if($document->is_multiple == 1)
                                                                <a href="{{ route('view_multiple_document',[encrypt($ol_application->id),encrypt($document->id)]) }}" class="app-card__details mb-0">
                                                                view documents</a>
                                                            @else
                                                                @if(isset($document->documents_uploaded[0]) && $document->documents_uploaded[0]->society_document_path)
                                                                    <a href="{{config('commanConfig.storage_server').'/'.$document->documents_uploaded[0]->society_document_path }}" target="_blank">
                                                                        <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>
                                                                @else 
                                                                <h2 class="m--font-danger">
                                                                        <i class="fa fa-remove"></i>
                                                                    </h2>       
                                                                @endif
                                                            @endif        
                                                            </td>
                                                            <td>
                                                                <p class="mb-2">{{(isset($document->documents_uploaded[0]) && $document->documents_uploaded[0]->comment_by_EE) ? $document->documents_uploaded[0]->comment_by_EE : '' }}</p>
                                                            </td>
                                                            <td class="text-center">
                                                                @if(isset($document->documents_uploaded[0]) && $document->documents_uploaded[0]->EE_document_path)
                                                                <a href="{{ config('commanConfig.storage_server').'/'.$document->documents_uploaded[0]->EE_document_path }}" target="_blank">

                                                                    <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}">
                                                                </a>
                                                                @else
                                                                    <h2 class="m--font-danger">
                                                                        <i class="fa fa-remove"></i>
                                                                    </h2>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    <?php $i++; ?>
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
                <div class="panel" id="checklist-scrunity">
                    <ul id="scrunity-tabs" class="nav nav-pills nav-justified hide-print" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show nested_t" data-toggle="pill" href="#verification" data-tab="Consent Verification">
                                Consent Verification</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nested_t" data-toggle="pill" href="#demarcation" data-tab="Demarcation">
                                Demarcation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nested_t" data-toggle="pill" href="#tit-bit" data-tab="Tit-Bit">
                                Tit-Bit</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link nested_t" data-toggle="pill" href="#relocation" data-tab="R.G. Relocation">
                                R.G. Relocation</a>
                        </li>
                    </ul>

                    <div class="m-portlet m-portlet--no-top-shadow">
                        <div class="tab-pane--nested-tabs__inner">
                            <form class="form--custom" action="" method="post">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <div class="col-sm-4 d-flex align-items-center">
                                                <label for="name">संस्थेचे नाव:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control--custom" id="name"
                                                    value="{{(isset($eeScrutinyData->eeApplicationSociety->name) ? $eeScrutinyData->eeApplicationSociety->name : '')}}"
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
                                                <input type="text" class="form-control form-control--custom" id="building-no"
                                                    placeholder="" value="{{(isset($eeScrutinyData->eeApplicationSociety->building_no) ? $eeScrutinyData->eeApplicationSociety->building_no : '')}}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content">

                                    <!-- Consent Verification -->
                                    <div class="tab-pane active" id="verification">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">अभिन्यास (Layout):</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control--custom" id="name"
                                                            value="{{(isset($eeScrutinyData->Consent_checklist->layout) ? $eeScrutinyData->Consent_checklist->layout : '')}}"
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
                                                        <input type="text" class="form-control form-control--custom" id="building-no"
                                                            placeholder="" value="{{(isset($eeScrutinyData->Consent_checklist->details_of_notice) ? $eeScrutinyData->Consent_checklist->details_of_notice : '')}}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 margin_top">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">तपासणी अधिकाऱ्यांचे नाव:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control--custom" id="name"
                                                            value="{{(isset($eeScrutinyData->Consent_checklist->investigation_officer_name) ? $eeScrutinyData->Consent_checklist->investigation_officer_name : '')}}"
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
                                                        <input type="text" class="form-control form-control--custom" id="building-no"
                                                            placeholder="" value="{{(isset($eeScrutinyData->Consent_checklist->date_of_investigation) ? $eeScrutinyData->Consent_checklist->date_of_investigation : '')}}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    @if($consentCount > 0)
                                        <a class="btn btn-primary hide-print" href="{{ route('ee_variation_report',$ol_application->id)}}"> Generate Variation Report</a>
                                    @endif  
                                        <div class="table-checklist m-portlet__body m-portlet__body--table" style="margin-top: 10px">
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
                                                        <?php $i = 1; ?>
                                                        @foreach($eeScrutinyData->consentQuetions as $data)

                                                        <tr>
                                                            <td>{{$i}}</td>
                                                            <td>{{$data->question}}</td>
                                                            <td>
                                                                <label class="m-radio m-radio--primary">

                                                                    <input type="radio" class="radioBtn" name="con_radio_{{$i}}"
                                                                        disabled
                                                                        {{ (isset($data->consentDetails->answer) && $data->consentDetails->answer == '1') ? 'checked' : ''}}>
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="m-radio m-radio--primary">

                                                                    <input type="radio" class="radioBtn" name="con_radio_{{$i}}"
                                                                        disabled
                                                                        {{(isset($data->consentDetails->answer) && $data->consentDetails->answer == '0') ? 'checked' : ''}}>
                                                                    <span></span>
                                                                </label></td>
                                                            <td>
                                                                <textarea class="form-control form-control--custom form-control--textarea" style="border-top: none;resize: none;" disabled name="remark-one" id="remark-one">{{ (isset($data->consentDetails)) ? $data->consentDetails->remark : ""}}</textarea>
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
                                                        <input type="text" class="form-control form-control--custom" id="name"
                                                            value="{{(isset($eeScrutinyData->Demark_checklist->layout) ? $eeScrutinyData->Demark_checklist->layout : '')}}"
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
                                                        <input type="text" class="form-control form-control--custom" id="building-no"
                                                            placeholder="" value="{{(isset($eeScrutinyData->Demark_checklist->details_of_notice) ? $eeScrutinyData->Demark_checklist->details_of_notice : '')}}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 margin_top">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">तपासणी अधिकाऱ्यांचे नाव:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control--custom" id="name"
                                                            value="{{(isset($eeScrutinyData->Demark_checklist->investigation_officer_name) ? $eeScrutinyData->Demark_checklist->investigation_officer_name : '')}}"
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
                                                        <input type="text" class="form-control form-control--custom" id="building-no"
                                                            placeholder="" value="{{(isset($eeScrutinyData->Demark_checklist->date_of_investigation) ? $eeScrutinyData->Demark_checklist->date_of_investigation : '')}}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-checklist m-portlet__body m-portlet__body--table">
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
                                                        <?php $i = 2; ?>
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
                                                                    <td><input type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->lease_agreement_area) ? $landDetails->lease_agreement_area : '' }}" name="land[lease_agreement_area]" id="lease_agreement_area" placeholder="" readonly></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>b)</td>
                                                                    <td>अभिन्यासातील भूखंडाचे क्षेत्रफळ </td>
                                                                    <td><input type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->stag_plot_area) ? $landDetails->stag_plot_area : '' }}" name="land[stag_plot_area]" 
                                                                    id="stag_plot_area" placeholder="" readonly></td>
                                                                </tr>                                    
                                                                <tr>
                                                                     <td>c)</td>    
                                                                    <td>टिट बिट भूखंडाचे क्षेत्रफळ </td>
                                                                    <td><input type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->tit_bit_area) ? $landDetails->tit_bit_area : '' }}" name="land[tit_bit_area]" id="tit_bit_area" placeholder="" readonly></td>
                                                                </tr>
                                                                <tr>
                                                                     <td>d)</td>    
                                                                    <td>आर जी भूखंडाचे क्षेत्रफळ</td>
                                                                    <td><input type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->rg_plot_area) ? $landDetails->rg_plot_area : '' }}" name="land[rg_plot_area]" id="rg_plot_area" placeholder="" readonly></td>
                                                                </tr>
                                                                <tr>
                                                                     <td>e)</td>    
                                                                    <td>पि जि भूखंडाचे क्षेत्रफळ </td>
                                                                    <td><input type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->pg_plot_area) ? $landDetails->pg_plot_area : '' }}" name="land[pg_plot_area]" id="pg_plot_area" placeholder="" readonly></td>
                                                                </tr>
                                                                <tr>
                                                                     <td>f)</td>    
                                                                    <td>Road setback  area</td>
                                                                    <td><input type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->road_setback_area) ? $landDetails->road_setback_area : '' }}" name="land[road_setback_area]" id="road_setback_area" placeholder="" readonly></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>g)</td>    
                                                                    <td>Encroachment area</td>
                                                                    <td><input type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->encroachment_area) ? $landDetails->encroachment_area : '' }}" name="land[encroachment_area]" id="encroachment_area" placeholder="" readonly></td>
                                                                </tr>
                                                                <tr>
                                                                     <td>h)</td>    
                                                                    <td>इतर क्षेत्रफळ </td>
                                                                    <td><input type="text" class="form-control form-control--custom" required="" value="{{ isset($landDetails->another_area) ? $landDetails->another_area : '' }}" name="land[another_area]" id="another_area" placeholder="" readonly></td>

                                                                </tr>
                                                            </table>
                                                        </td>
                                                        </tr>
                                                        @foreach($eeScrutinyData->DemarkQuetions as $data)
                                                        <tr>
                                                            <td>{{$i}}</td>
                                                            <td>{{$data->question}}</td>
                                                            <td>
                                                                <label class="m-radio m-radio--primary">
                                                                    <input type="radio" class="radioBtn" name="dem_radio_{{$i}}"
                                                                        disabled
                                                                        {{(isset($data->demarkDetails) && $data->demarkDetails->answer == '1') ? 'checked' : ''}}>
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="m-radio m-radio--primary">
                                                                    <input type="radio" class="radioBtn" name="dem_radio_{{$i}}"
                                                                        disabled
                                                                        {{(isset($data->demarkDetails) && $data->demarkDetails->answer == '0') ? 'checked' : ''}}>
                                                                    <span></span>
                                                                </label></td>
                                                            <td>
                                                                <textarea class="form-control form-control--custom form-control--textarea" style="border-top: none;resize: none;" disabled name="remark-one" id="remark-one">{{ isset($data->demarkDetails) ? $data->demarkDetails->remark : ""}}</textarea>
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
                                                        <input type="text" class="form-control form-control--custom" id="name"
                                                            value="{{(isset($eeScrutinyData->TitBit_checklist->layout) ? $eeScrutinyData->TitBit_checklist->layout : '')}}"
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
                                                        <input type="text" class="form-control form-control--custom" id="building-no"
                                                            placeholder="" value="{{(isset($eeScrutinyData->TitBit_checklist->details_of_notice) ? $eeScrutinyData->TitBit_checklist->details_of_notice : '')}}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 margin_top">
                                                <div class="form-group row">
                                                    <div class="col-sm-4 d-flex align-items-center">
                                                        <label for="name">तपासणी अधिकाऱ्यांचे नाव:</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control form-control--custom" id="name"
                                                            value="{{(isset($eeScrutinyData->TitBit_checklist->investigation_officer_name) ? $eeScrutinyData->TitBit_checklist->investigation_officer_name : '')}}"
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
                                                        <input type="text" class="form-control form-control--custom" id="building-no"
                                                            placeholder="" value="{{(isset($eeScrutinyData->TitBit_checklist->date_of_investigation) ? $eeScrutinyData->TitBit_checklist->date_of_investigation : '')}}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-checklist m-portlet__body m-portlet__body--table">
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
                                                                <textarea class="form-control form-control--custom form-control--textarea" style="border-top: none;resize: none;" disabled name="remark-one" id="remark-one">{{(isset($data->titBitDetails)) ? $data->titBitDetails->remark : ""}}</textarea>
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
                                                        <input type="text" class="form-control form-control--custom" id="name"
                                                            value="{{(isset($eeScrutinyData->Relocation_checklist->layout) ? $eeScrutinyData->Relocation_checklist->layout : '')}}"
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
                                                        <input type="text" class="form-control form-control--custom" id="building-no"
                                                            placeholder="" value="{{(isset($eeScrutinyData->Relocation_checklist->details_of_notice) ? $eeScrutinyData->Relocation_checklist->details_of_notice : '')}}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-checklist m-portlet__body m-portlet__body--table">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;margin-top: 30px">
                                                    <thead class="thead-default">
                                                        <th style="width:10%">#</th>
                                                        <th class="table-data--xl" style="width:50%">मुद्दा / तपशील</th>
                                                        <th style="width:5%">होय</th>
                                                        <th style="width:5%">नाही</th>
                                                        <th style="width:30%">शेरा</th>
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
                                                                    <input type="radio" name="rg_radio_{{$i}}" disabled
                                                                        {{(isset($data->relocationDetails) && $data->relocationDetails->answer == '1') ? 'checked' : ''}}>
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="m-radio m-radio--primary">
                                                                    <input type="radio" name="rg_radio_{{$i}}" disabled
                                                                        {{(isset($data->relocationDetails) && $data->relocationDetails->answer == '0') ? 'checked' : ''}}>
                                                                    <span></span>
                                                                </label></td>
                                                            <td>
                                                                <textarea class="form-control form-control--custom form-control--textarea" style="border-top: none;resize: none;" disabled name="remark-one" id="remark-one">{{ isset($data->relocationDetails) ? $data->relocationDetails->remark : ''}}</textarea>
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

                            <div class="m-section__content mb-0 table-responsive">
                            <div class="col-sm-8">
                                    <div class="d-flex flex-column h-100">
                                        <h5>Download EE Note</h5>
                                        <div class="mt-3">
                                            @if(isset($eeScrutinyData->eeNote))
                                                <div class="table-responsive">
                                                <table class="mt-2 table"> 
                                                <tbody>                                        
                                                @foreach($eeScrutinyData->eeNote as $note)
                                                <tr>
                                                    <td> 
                                                <!-- <div class="mt-auto">  -->
                                                <!-- <span>  -->
                                                @php
                                                if($note->document_name){
                                                    $fileName = explode(".",$note->document_name)[0]; 
                                                }elseif($note->document_path){
                                                    $fileName = explode(".",explode('/',$note->document_path)[1])[0];
                                                }
                                                @endphp 

                                                {{ isset($fileName) ? $fileName : ''}} : 
                                                </td>
                                                <td class="text-center">
                                                    <a download class="btn-link" href="{{ config('commanConfig.storage_server').'/'.$note->document_path}} " target="_blank" download>
                                                                        Download </a>
                
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

    @endsection

@section('js')
<script>
    function test() {
        window.print();
        document.title ='';
    }

    $('.printBtn').on('click', test);

    $("#checklist_scrunity").click(function(){
        $(".printBtn").css("display","block");
    });    

    $(".v-tabs").click(function(){
        $(".printBtn").css("display","none");
    });

    $(".nested_t").click(function(){
        var selected_tab = $(this).attr('data-tab');
        $("#selected_tab").html(selected_tab);
    });
    
</script>
@endsection    
