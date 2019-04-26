@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.tripartite.actions',compact('ol_application'))
@endsection
@section('content')
    @php
        $disabled=isset($disabled)?$disabled:0;
    @endphp
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Tripartite Agreement</h3>
                {{ Breadcrumbs::render('tripartite_agreement',$ol_application->id) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left"
                                                                              style="padding-right: 8px;"></i>Back</a>
                    {{-- <a href="?print=1" target="_blank" class="btn print-icon" rel="noopener"><img src="{{asset('/img/print-icon.svg')}}"
                            title="print"></a> --}}
                </div>
            </div>
        </div>
        @if(Session::has('error'))
            <p class="alert alert-danger mt-2">{{ Session::get('error') }}</p>
        @endif
        @if(Session::has('success'))
            <p class="alert alert-success mt-2">{{ Session::get('success') }}</p>
        @endif
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
                                    <span class="field-value">{{ $ol_application->application_no }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Application Date:</span>
                                    <span class="field-value">{{ date(config('commanConfig.dateFormat'),
                                    strtotime($ol_application->submitted_at)) }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Society Registration No:</span>
                                    <span class="field-value">{{(isset($ol_application->eeApplicationSociety)
                                    ? $ol_application->eeApplicationSociety->registration_no : '')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Society Name:</span>
                                    <span class="field-value">{{
                                    $ol_application->eeApplicationSociety->name }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Society Address:</span>
                                    <span class="field-value">{{
                                    $ol_application->eeApplicationSociety->address }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Building Number:</span>
                                    <span class="field-value">{{
                                    $ol_application->eeApplicationSociety->building_no }}</span>
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
                                    $ol_application->eeApplicationSociety->name_of_architect }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Architect Mobile Number:</span>
                                    <span class="field-value">{{
                                    $ol_application->eeApplicationSociety->architect_mobile_no }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Architect Address:</span>
                                    <span class="field-value">{{
                                    $ol_application->eeApplicationSociety->architect_address }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 field-col">
                                <div class="d-flex">
                                    <span class="field-name">Architect Telephone Number:</span>
                                    <span class="field-value">{{
                                    $ol_application->eeApplicationSociety->architect_telephone_no }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body" style="padding-right: 0;">
                @if($societyData['ree_Jr_id'] && $applicationLog->status_id
                !=config('commanConfig.applicationStatus.forwarded') && ($stamped_by_society!=1 && $approved_by_co!=1))
                    <h3 class="section-title section-title--small mb-0">Tripartite Agreement:</h3>
                    <div class=" row-list">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Edit Agreement</a>
                                <!-- <button type="submit">Edit offer Letter </button> -->
                            </div>
                        </div>
                    </div>
                @endif
                <div class="w-100 row-list">
                    <div class="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="d-flex flex-column h-100">
                                    <h5>Download Tripartite Agreement</h5>
                                    <div class="mt-auto">

                                        @if($tripartite_agrement['drafted_tripartite_agreement'])
                                            <a target="_blank"
                                               href="{{config('commanConfig.storage_server').'/'.$tripartite_agrement['drafted_tripartite_agreement']->society_document_path}}"
                                               class="btn btn-primary">Download</a>
                                        @else
                                            <span class="error"
                                                  style="display: block;color: #ce2323;margin-bottom: 17px;">
                                        * Note : Offer Letter not available. </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(((session()->get('role_name')==config('commanConfig.ree_branch_head') && $applicationLog->status_id
                            !=config('commanConfig.applicationStatus.forwarded') && ($stamped_by_society==1 || $stamped_and_signed==1) && $approved_by_co!=1) ||
                            (session()->get('role_name')==config('commanConfig.co_engineer') && $applicationLog->status_id
                            !=config('commanConfig.applicationStatus.forwarded') && ($approved_by_co==1 || $stamped_by_society==1 || $stamped_and_signed==1))) ||
                            ((session()->get('role_name')==config('commanConfig.ree_junior') && $applicationLog->status_id
                            !=config('commanConfig.applicationStatus.forwarded') && $stamped_by_society!=1 && $stamped_and_signed!=1 && $approved_by_co!=1)))
                                @if($applicationLog->status_id !=config('commanConfig.applicationStatus.sent_for_stamp_duty_registration'))
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100">
                                            <h5>Upload Signed & scanned Tripartite Agreement</h5>
                                            <form action="{{route('upload_signed_tripartite_agreement')}}" method="post"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" id="applicationId" name="applicationId"
                                                       value="{{ $ol_application->id }}">
                                                <div class="custom-file">
                                                    <input class="custom-file-input pdfcheck" name="signed_agreement"
                                                           type="file"
                                                           id="test-upload" required="required">
                                                    <label class="custom-file-label" for="test-upload">Choose
                                                        file...</label>
                                                    <span class="text-danger" id="file_error"></span>
                                                </div>
                                                <div class="mt-auto" style="float:right">
                                                    <button type="submit" class="btn btn-primary btn-custom"
                                                            id="uploadBtn">Upload
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--letter 1--}}
        @if(($ol_application->current_phase > 1) || $generated_letter1 != null || $stamped_signed_letter1 != null)
            <div class="m-portlet m-portlet--mobile m_panel">
                <div class="m-portlet__body" style="padding-right: 0;">

                    @if(session()->get('role_name')==config('commanConfig.ree_junior'))
                        @if(($ol_application->current_phase == 2) && ($applicationLog->status_id == config('commanConfig.applicationStatus.in_process')))

                            <h3 class="section-title section-title--small mb-0">Letter For Stamp Duty:</h3>
                            <div class=" row-list">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="" class="btn btn-primary" data-toggle="modal"
                                           data-target="#myletter1Modal">
                                            Generate/ Edit Letter For Stamp Duty</a>
                                        <!-- <button type="submit">Edit offer Letter </button> -->
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif


                    <div class="w-100 row-list">
                        <div class="">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="d-flex flex-column h-100">
                                        <h5>Download Letter For Stamp Duty</h5>
                                        <br/>
                                        <div class="mt-auto">

                                            @if($tripartite_agrement['drafted_tripartite_letter1'] || $generated_letter1 != null || $stamped_signed_letter1 != null)
                                                <a target="_blank"
                                                   href="{{config('commanConfig.storage_server').'/'.$tripartite_agrement['drafted_tripartite_letter1']->society_document_path}}"
                                                   class="btn btn-primary">Download</a>
                                            @else
                                                <span class="error"
                                                      style="display: block;color: #ce2323;margin-bottom: 17px;">
    * Note : Letter For Stamp Duty not available. </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if(session()->get('role_name')==config('commanConfig.ree_branch_head'))
                                    @if($ol_application->current_phase == 2)
                                        <div class="col-sm-6 border-left">
                                            <div class="d-flex flex-column h-100">
                                                <h5>Upload Signed & Scanned Letter For Stamp Duty</h5>
                                                <form action="{{route('upload_signed_tripartite_letter1')}}"
                                                      method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" id="applicationId" name="applicationId"
                                                           value="{{ $ol_application->id }}">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input pdfcheck"
                                                               name="signed_tripartite_letter_1"
                                                               type="file"
                                                               id="test1-upload" required="required">
                                                        <label class="custom-file-label" for="test1-upload">Choose
                                                            file...</label>
                                                        <span class="text-danger" id="file_error"></span>
                                                    </div>
                                                    <div class="mt-auto" style="float:right">
                                                        <button type="submit" class="btn btn-primary btn-custom"
                                                                id="uploadBtn">
                                                            Upload
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{--letter 1 end--}}

        {{--letter 2--}}
        @if(($ol_application->current_phase > 2) && (($applicationLog->status_id == config('commanConfig.applicationStatus.in_process')) || $generated_letter2 != null || $stamped_signed_letter2 != null))
            <div class="m-portlet m-portlet--mobile m_panel">
                <div class="m-portlet__body" style="padding-right: 0;">
                    @if($ol_application->current_phase == 4)
                        @if(session()->get('role_name')==config('commanConfig.ree_junior'))
                            <h3 class="section-title section-title--small mb-0">Letter for Execution and Registartion of
                                Agreement:</h3>
                            <div class=" row-list">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="" class="btn btn-primary" data-toggle="modal"
                                           data-target="#myletter2Modal">
                                            Generate/ Edit Letter for Execution and Registartion of Agreement</a>
                                        <!-- <button type="submit">Edit offer Letter </button> -->
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    <div class="w-100 row-list">
                        <div class="">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="d-flex flex-column h-100">
                                        <h5>Download Letter for Execution and Registartion of Agreement</h5>
                                        <br/>
                                        <div class="mt-auto">

                                            @if($tripartite_agrement['drafted_tripartite_letter2'])
                                                <a target="_blank"
                                                   href="{{config('commanConfig.storage_server').'/'.$tripartite_agrement['drafted_tripartite_letter2']->society_document_path}}"
                                                   class="btn btn-primary">Download</a>
                                            @else
                                                <span class="error"
                                                      style="display: block;color: #ce2323;margin-bottom: 17px;">
    * Note : Letter for Execution and Registartion of Agreement not available. </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if($ol_application->current_phase > 2 && $ol_application->current_phase <= 4)

                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100">
                                            <h5>Upload Signed & Scanned Letter For Execution and Registartion</h5>
                                            <form action="{{route('upload_signed_tripartite_letter2')}}" method="post"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" id="applicationId" name="applicationId"
                                                       value="{{ $ol_application->id }}">
                                                <div class="custom-file">
                                                    <input class="custom-file-input pdfcheck"
                                                           name="signed_tripartite_letter_2"
                                                           type="file"
                                                           id="test2-upload" required="required">
                                                    <label class="custom-file-label" for="test2-upload">Choose
                                                        file...</label>
                                                    <span class="text-danger" id="file_error"></span>
                                                </div>
                                                <div class="mt-auto" style="float:right">
                                                    <button type="submit" class="btn btn-primary btn-custom"
                                                            id="uploadBtn">
                                                        Upload
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{--letter 2--}}


        @if(count($tripatiet_remark_history)>0)
            <div class="m-portlet m-portlet--mobile m_panel">
                <div class="m-portlet__body">
                    <h3 class="section-title section-title--small">Remarks on Tripartite Agreement </h3>
                    <div class="remark-body">
                        <div class="remarks-section">
                            @foreach($tripatiet_remark_history as $history)
                                {{-- <div class="card">
                                    <div class="card-header">
                                        {{config('commanConfig.la_engineer')==$history->Roles->name?'Riders By':'Remark By'}}
                                        {{ isset($history->Roles->display_name) ? $history->Roles->display_name : '' }}
                                    </div>
                                    <div class="card-body">
                                      <p class="card-text">{{ isset($history->remark)? $history->remark : '' }}</p>
                                    </div>
                                </div> --}}
                                <div class="m-scrollable m-scroller ps ps--active-y remarks-section-container"
                                     data-scrollbar-shown="true"
                                     data-scrollable="true" >
                                    <div class="remarks-section__data" style="padding: 5px!important">
                                        <p class="remarks-section__data__row">
                                            <span>{{config('commanConfig.la_engineer')==$history->Roles->name?'Riders By':'Remark By'}} {{
                                    isset($history->Roles->display_name) ? $history->Roles->display_name : '' }}
                                        </p>
                                        <p class="">

                                            <span>{{ isset($history->remark)? $history->remark : '' }}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if((session()->get('role_name')==config('commanConfig.ree_junior') || session()->get('role_name')==config('commanConfig.co_engineer') || session()->get('role_name')==config('commanConfig.la_engineer')) && $applicationLog->status_id
        !=config('commanConfig.applicationStatus.forwarded'))
            <div class="m-portlet m-portlet--mobile m_panel">
                <div class="m-portlet__body">
                    @if(session()->get('role_name')==config('commanConfig.la_engineer'))
                        <h3 class="section-title section-title--small">Riders</h3>
                    @else
                        <h3 class="section-title section-title--small">Remark</h3>
                    @endif
                    <div class="col-xs-12 row">
                        <div class="col-md-12">
                            <form action="{{route('tripartite.setTripartiteRemark')}}" method="POST">
                                @csrf
                                <input type="hidden" id="applicationId" name="applicationId"
                                       value="{{ $ol_application->id }}">
                                <textarea rows="4" cols="63" name="remark"></textarea>
                                <button type="submit" class="btn btn-primary mt-3" style="display:block">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- <div class="m-portlet">
            <div id="printdiv">
                <form class="letter-form m-form" action="" method="post" id="society-conveyance-application" enctype="multipart/form-data">
                    @csrf

                </form>
            </div>
        </div> --}}
    </div>

    <div class="modal modal-large fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agreement</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="" action="{{route('saveTripartiteagreement')}}" method="POST">
                        @csrf
                        <input type="hidden" id="applicationId" name="applicationId" value="{{ $ol_application->id }}">
                        {{-- <input type="hidden" id="document_id" name="text_document_id" value="{{ $no_dues_certificate_docs['text_no_dues_certificate']->id }}">
                        <input type="hidden" id="document_id" name="pdf_document_id" value="{{ $no_dues_certificate_docs['drafted_no_dues_certificate']->id }}">
                        --}}

                        <textarea id="ckeditorText" name="ckeditorText" style="display: none;">
                        @if($content)
                                {{ $content}}
                            @else
                                <div style="" id=""> 
                                    <h3 style="text-decoration: underline; text-align: center; margin-bottom: 30px;font-size:17px"><b>Agreement</b></h3>
                                    <p> This Agreement dated this  __________  day of ________________________________ 2012 between the MAHARASHTRA HOUSING AND AREA DEVELOPMENT AUTHORITY a Statutory Corporation duly constituted under the Maharashtra Housing and Area Development Act 1976 (Mah XXVIII of  1977) having its office at Griha Nirman Bhavan, Kala Nagar, Bandra(E), Mumbai 400 051 the Party of the <b>First Part </b> (hereinafter referred to as 'the Authority' which expression shall unless to context requires otherwise include its successors and assigns) through the Mumbai Board a regional unit of the Authority of the <b>First Part</b>.</p>
                                    <p> And ____________________________ having its office at __________________________ the Party of the Second Part (Society) (hereinafter referred to as the Party of the Second Part and Third part Developer which expression shall unless to the context requires otherwise include its successors and                         of the Second Part.  as well as third party.
                                    </p>
                                    <p>WHEREAS the Party of the Second Part & Third Part has applied for grant of No Objection Certificate (hereinafter referred to as the NOC) to the Mumbai Board a regional unit of the Authority for the purpose of redevelopment of Bldg.No.<b> {{ isset($ol_application->eeApplicationSociety->building_no) ? $ol_application->eeApplicationSociety->building_no : '' }}</b> Society Name  <b> {{ isset($ol_application->eeApplicationSociety->name) ? $ol_application->eeApplicationSociety->name : '' }}</b> bearing CTS  No. ______________  situated at <b> {{ isset($ol_application->eeApplicationSociety) ? $ol_application->eeApplicationSociety->address : '' }} 
                                    </b>Mumbai. </p>
                                    <p> (hereinafter referred to as "the said property") in accordance with the provisions of DCR Nos.33(5) of the Development Control Regulations for Greater Mumbai,1991 (hereinafter referred to as "the DCR"); </p>
                                    <p>  WHEREAS the proposal of the Party of the Second & Third Part for the purpose of redevelopment of the said property has been duly scrutinized by the Mumbai Board and placed before the meeting of the Mumbai Board held on           ;</p>
                                    <p>  WHEREAS the Mumbai Board in its meeting held on          approved the proposal of the Party of the Second Part for grant of NOC for redevelopment of the said property vide Resolution No.<b> {{ isset($ol_application->request_form) ? $ol_application->request_form->noc_for_iod_purpose_number : '' }} </b> dated <b> {{ isset($ol_application->request_form) ? $ol_application->request_form->noc_for_iod_purpose_date : '' }} </b> and it is proposed to grant NOC for redevelopment to the Party of the Second Part; </p>
                                    <p>  WHEREAS after redevelopment, taking into consideration the provisions of revised DCR No.33(5), sharing area is to be surrendered to the Authority by the Party of the Second Part & Third Part which works out to  built up area ______________ sq.mtr. + fungible area ______________ sq.mtr. total built up area _____ sq.mtr. having tenements _________ of ____ sq.mt. unit carpet area. </p>
                                    <p>WHEREAS it is necessary to execute the Agreement in order to ensure to get the above area to the Authority within prescribed time limit so as to utilize the same in accordance with the provisions of DCR 33(5) 2C (i) MHAD Act,1976 and the Rules, Regulations made under the said Act;</p>
                                    <p>WHEREAS the Party of the Second Part has agreed to abide  by and be bound by all the terms and conditions prescribed for the NOC  issued for the purpose of redevelopment;</p>
                                    <p> AND WHEREAS it is expedient and necessary to execute this Agreement in pursuance of the NOC sanctioned for the purpose of redevelopment of the said property on the terms and conditions and covenants hereinafter appearing.</p>
                                    <p><b>NOW THIS AGREEMENT WITNESSETH as follows:-</b></p>
                                    <p>1. The Authority through its regional Board i.e. Mumbai Board will issue NOC in favor of Party of the Second describing the terms and conditions. It is agreed that all the terms and conditions mentioned in the NOC as well as recitals  shall form part of the Agreement.</p>
                                    <p> 2. The Party of the Second Part shall prepare plans of the proposed building indicating therein the sharing area to be handed over to the Authority and submits for the approval of the Authority/Mumbai Board within a period of One months from the date of issue of Offer Letter.</p>
                                    <p> 3. The Party of the Second Part shall after approval granted by the Authority/Mumbai Board  prepare the plans and submit the same for approval of MCGM within a period of Three months from the date offer letter of /Mumbai Board after evaluating agreement.</p>
                                    <p> 4. If the Party of the Second Part fails to submit the plans to the MCGM within a period of Three months from its approval by the Authority, the NOC is liable to be cancelled and in such a case this Agreement shall stand automatically terminated.</p>
                                    <p>5. The Party of the Second Part shall as per direction of the Authority make provision for the residential tenements of 27.88 for EWS / 45 m2 for LIG carpet area (each) minimum in the plans of the proposed building for the purpose of handing over MHADA share. the same to the Authority by way of surplus BUA  area.</p>
                                    <p>6. The Party of the Second Part shall after issuance of IOD and approval to the Plans by MCGM, show on the plans of the proposed/s and the tenements to be handed over to the Authority / Mumbai Board and certified copies of the Plans shall be submitted to the Authority//Mumbai Board.</p>
                                    <p> 7. The Party of the Second Part shall commence and construct tenements to be handed over by way of sharing BUA built up area to the Authority <b>within 24 months of date of issue of NOC or within extended time period that may be granted in case of genuine hardship faced which are beyond the control of the Party of the Second Part.</b></p>
                                    <p>8. The Executive Engineer of the /Mumbai Board / Bandra / Ghatkopar Div in charge of this project shall supervise the construction work of tenements to be handed over by way of sharing built up area to the Authority.  from time to time, at least once in a month, he will visit the site and issue appropriate instructions regarding the work to the Party of the Second Part  and Party of the Second Part shall abide  by and be bound by the same and for carrying out the work accordingly as per the instructions of the Ex. Engineer.</p>
                                    <p>9. The Party of the Second Part shall complete the construction of tenements in all the respets to be surrendered to MHADA by way of 2/3 sharing area on or before <b>(24 months from the date of NOC) </b>"TIME BEING ESSENCE OF CONTRACT". In case of the work is not completed as per the time limit as above, the Party of the Second Part will be entitled for extension of time limit only on the ground of reasons beyond control of the Party of the Second Part.</p>
                                    <p>10. The Party of the Second Part shall furnish all the necessary documents such as copy of approved plans along with copies of IOD and CC from MCGM, In addition to that the Party of the Second Part along with its Architect shall furnish certificate to the Authority to the effect that newly constructed building has been built in accordance with the plans approved by MCGM and the tenements constructed by way of surplus built up area as well as constructed for own sale component. </p>
                                    <p>11. The Party of the Second Part shall take necessary trial pits/trial bores in the said property to ascertain the bearing capacity of the soil and foundation shall be designed accordingly. R.C.C. design of the new proposed building shall be prepared taking into account the aspect of Mumbai Seismic Zone and same should be got approved from R.C.C. Consultant/Structural Engineer, registered with MCGM.</p>
                                    <p>12. The Party of the Second Part shall as far as possible construct separate building for rehabilitation of existing tenants and for the purpose of free sale, taking into account the plot area of the said property. The NOC holder has to form the independent Co. op. Hsg. Society for rehab building of tenants as well as for free sale component after giving possession to the existing tenants and prospective buyers. <b>The developer shall make provision of surplus tenements in rehab building only when separate buildings are constructed and as far as possible in rehab part of composite building in form of tenements having carpet area of 27.88 m2  EWS / 45 m2 For LIG .</b></p>
                                    <p>13. <b>The NOC holder shall hand over BUA area at the time of demanding occupation permission. The permission to obtain Occupation Certificate for free sale building / Portion of Bldg shall not be given by Mumbai Board unless the BUA share tenements are dully handed Over to Mumbai Board.</b> It is agreed that in case inspite of the notices in writing given from time to time, without any proper reasons, the NOC holder fails to hand over built up area to the Authority, the Ex.Engineer in charge shall enter into the premises & sharing  BUA area and complete the balance work at the risk and costs of the Party of the Second Part and recover the costs thereof from them.</p>
                                    <p>14. In case of any dispute vis-à-vis surrendering the sharing built up area to the Authority, the same shall be referred to the VP&CEO/A whose decision shall be final and binding on both the parties.</p>
                                    <p>15. <b>The Authority is exempted from payment of Stamp Duty as per the Government Notification No.STP-1356/N dated 15.02.1957 issued by the Revenue and Forest Department, Government of Maharashtra read with Law and Judiciary Department's Order dated 13.09.1994. A copy of said order is annexed herewith.</b></p>
                                    <h3 style="text-decoration: underline; text-align: center; margin-bottom: 30px;font-size:17px"><b>SCHEDULE</b></h3>
                                    <p><b>The schedule above referred to</b>__________________________ IN WITNESS WHEREOF the signature of Shri <b> {{(isset($coName) ? $coName : '' )}} </b> Chief Officer for and on behalf of the Maharashtra Housing and Area Development Authority has been set hereunder and the seal of the Authority is also affixed and the signature of __________________________ has been affixed hereunto on the day and the year first hereinabove written.</p>
                                    <p style="text-align:right">Signed, Sealed and Delivered by</p>
                                    <p style="text-align:right">Shri <b> {{(isset($coName) ? $coName : '' )}} </b></p>
                                    <p style="text-align:right">Chief Officer </p>
                                    <p>Presence of Shri <b> {{(isset($coName) ? $coName : '' )}} </b> Mumbai Board.Chief Officer Mumbai Board The Common Seal of the Maharashtra Housing and Area Development Authority is affixed hereunto in the Signed and Delivered by Shri __________________________ who has hereunto set his signature in the presence of Shri __________________________ (Shri                                  )who has signed in token thereof</p>
                                    <p>_____________ DATED THIS  ________ DAY OF  __________________________      2016 AHARASHTRA HOUSING AND AREA DEVELOPMENT AUTHORITY. AND AGREEMENT</p>
                                    <p style="text-align:right;">SHRI <b> {{(isset($LAName) ? $LAName : '' )}} </b> LEGAL ADVISER/MHADA.</p>
                                </div>
                            @endif
                           
                                </textarea>
                        <input type="submit" value="save"
                               style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>

    {{--letter 1 modal--}}
    <div class="modal modal-large fade" id="myletter1Modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agreement</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="" action="{{route('saveTripartiteLetterForStampDuty')}}" method="POST">
                        @csrf
                        <input type="hidden" id="letterapplicationId" name="letterapplicationId"
                               value="{{ $ol_application->id }}">
                        {{-- <input type="hidden" id="document_id" name="text_document_id" value="{{ $no_dues_certificate_docs['text_no_dues_certificate']->id }}">
                        <input type="hidden" id="document_id" name="pdf_document_id" value="{{ $no_dues_certificate_docs['drafted_no_dues_certificate']->id }}">
                        --}}

                        <textarea id="ckeditorTextletter1" name="ckeditorTextletter1" style="display: none;">
                        @if($content_letter_1)
                                {{ $content_letter_1}}
                            @else
                                <div style="max-width: 100%;overflow: hidden; width: 100%;" id="">
                                    <p style=" text-align:right;font-size: 16px; line-height: 1.5;margin-bottom: 0;margin-left: 72%;">जा.क्र्./नि.का.अ./मुं.मं./&nbsp;&nbsp;&nbsp;/१८<br>
                                        <span style="font-size: 16px;line-height: 1.5;">दिनांक:-<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span><br>
                                    </p>
                                    <div style="clear: both;"></div>
                                    <p style="font-size: 16px; line-height: 1.5;margin-top: 0;">प्रति,<br>
                                        अध्यक्ष/सचिव, <br>
                                        <span>{{$society_details->name}},</span><br/>
                                        <span>{{$society_details->address}}.</span>
                                    </p>

                                    <div style="font-size: 16px; line-height: 1.5;margin-left: 80px;">
                                        <p style="vertical-align: top;margin: 0%;width: 9%;float: left;">विषय:-</p> 
                                        <p style="margin: 0%;float: left;width: 90%;">{{$society_details->name}},{{$society_details->address}} या इमारतीचा पुनर्विकासाकरिता सुधारित वि.नि.नि. ३३(५) नुसार त्रिपक्षीय करारनामा करणे संदर्भात मुद्रांक शुल्क भरणेबाबत.</p>
                                    </div>
                                    <div style="clear: both;"></div>
                                    
                                    {{--<p style="margin-left: 80px;">संदर्भ:- मा.विधी सल्लागार / प्रा. यांची  मंजुरी क्र्.&nbsp;&nbsp;&nbsp;दि.</p>--}}
                                    <p style="font-size: 16px; line-height: 1.5;">महोदय,</p>
                                    <p style="font-size: 16px; line-height: 1.5;text-indent: 80px;width: 95%;">उपरोक्त विषयास अनुसरून मा.विधी सल्लागार / प्रा. यांनी इमारतीचा त्रिपक्षीय करारनामा करणे संदर्भात मसुद्यास मान्यता दिलेली असून सदर मसुदा मान्य असल्याबाबत नमूद करून त्याची प्रत, तसेच त्रिपक्षीय करारनामा हिरव्या लीगल पेपरवर टंकलिखित करून व मुद्रांक शुल्क भरणा करून पुढील कार्यवाहीसाठी कार्यालयात सादर करण्यात यावा.</p><br/><br/>

                                    <p style="font-size: 16px; line-height: 1.5;margin-left: 75%"><span>आपला विश्वासू, </span><br/><br/>
                                    <span>निवासी कार्यकारी अभियंता,</span><br/>
                                            <span>मुंबई मंडळ </span></p>
                                </div>
                            @endif

                                </textarea>
                        <input type="submit" value="save"
                               style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    {{--letter 1 modal end--}}

    {{--letter 2 modal--}}
    <div class="modal modal-large fade" id="myletter2Modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agreement</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="" action="{{route('saveTripartiteLetterForExecutionRegistraion')}}" method="POST">
                        @csrf
                        <input type="hidden" id="letter2applicationId" name="letter2applicationId"
                               value="{{ $ol_application->id }}">
                        {{-- <input type="hidden" id="document_id" name="text_document_id" value="{{ $no_dues_certificate_docs['text_no_dues_certificate']->id }}">
                        <input type="hidden" id="document_id" name="pdf_document_id" value="{{ $no_dues_certificate_docs['drafted_no_dues_certificate']->id }}">
                        --}}

                       @php
                           if(isset($approved_proposal_date_by_co)){
                                $approved_proposal_date_by_co = $approved_proposal_date_by_co;
                           }else{
                                $approved_proposal_date_by_co = '';
                           }

                       @endphp


                        <textarea id="ckeditorTextletter2" name="ckeditorTextletter2" style="display: none;">
                        @if($content_letter_2)
                                {{ $content_letter_2}}
                            @else
                                <div style="" id="">
                                    <p style="font-size: 16px; line-height: 1.5;margin-left: 65%; margin-bottom: 0;"><span>NO.CO/MB/REE/F-682/&nbsp;&nbsp;&nbsp;/2018</span><br/>
                                        <span>Date:</span>
                                    </p>
                                    <div style="clear: both;height: 0;"></div>
                                    <p style="font-size: 16px; line-height: 1.5;margin-top: 0;">
                                        
                                        <span>To,</span><br>
                                        <span>The Joint Sub Registrar,</span><br>
                                        <span>Andheri,Mumbai</span>
                                    </p>
                                    <p style="font-size: 16px; line-height: 1.5;margin-left: 80px;">Sub: Execution of agreenment for redevelopment of property at existing
                                    <span>{{$society_details->name}},{{$society_details->address}}.</span></p>
                                    
                                    <p style="font-size: 16px; line-height: 1.5;display: block; font-weight: bold; float: left;width: 5%;margin-left: 80px;margin-top: 0;">Ref :- </p>
                                        <div style="font-size: 16px; line-height: 1.5;width: 80%;float: left;margin-top: 0px;margin-left: 0;">
                                            1. NOC FOR IOD Purpose NO. <span style="width: 200px; border-bottom: 1px solid #000;">{{$ol_application->request_form->noc_for_iod_purpose_number}}</span> Dated <span style="width: 200px; border-bottom: 1px solid #000;">{{$ol_application->request_form->noc_for_iod_purpose_date}}</span>
                                            <p> 2. Society's Developer letter for agreement dated:</p>
                                        </div>
                                        <div style="clear: both;height: 0;"></div>
                                    <p style="font-size: 16px; line-height: 1.5;">Sir,</p>
                                    <div style="font-size: 16px; line-height: 1.5;margin-left: 40px;">
                                        <p>
                                            With reference to the subject matter, Hon. VP/A has approved the above mentioned proposal on <span>{{$approved_proposal_date_by_co}}</span>.As per conditions of the NOC
                                        issued vide ref. no. 1 BUA share of MHADA has to be handed over by the {{$society_details->name,$society_details->address}}.
                                        In this regard MHADA & {{$society_details->name}} have to enter into agreement. First part MHADA,second part {{$society_details->name}}, third part is
                                        {{$ol_application->request_form->developer_name}}.
                                    </p>
                                    <p>
                                        The agreement has been signed on behalf of first part by <span>{{$users['co']['name']}}</span>, Chief Officer, Mumbai Board on
                                        behalf of MHADA. Hence the same is forwarded to your office for execution and registration.
                                    </p>
                                    <p>
                                        However it is to inform you that <span>{{$users['co']['name']}}</span>, Chief Officer Mumbai Board is exempted to appear
                                        at Sub Registrar's Office as per the provisions of Sec.88 of Indian Registration Act. 1908. Accordingly you may execute
                                        and register the document without insisting the peresence of the party of first part.
                                    </p>
                                    <p>
                                        This is for your favour of information and necessary action.
                                    </p>
                                        <p style="font-size: 16px; line-height: 1.5;display: block; margin-top: 5px; margin-bottom: 5px;">Asst. Engr.(<span>{{$users['ree_junior']['name']}}</span>) /Deputy Eng.(<span>{{$users['ree_deputy']['name']}}</span>) / Ass.Arch.(<span>{{$users['ree_ass']['name']}}</span>)/ Res. Exe. Eng.(<span>{{$users['ree_head']['name']}}</span>)</p>
                                    </div>
                                    
                                    <div style="font-size: 16px; line-height: 1.5;margin-top: 30px;">
                                        
                                        <p style="font-size: 16px; line-height: 1.5;margin-left: 40px;">
                                            (<span>{{$users['co']['name']}}</span>)<br/>
                                            Chief Officer, Mumbai Board.
                                        </p>
                                    </div>
                                </div>
                            @endif

                                </textarea>
                        <input type="submit" value="save"
                               style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    {{--letter 2 modal end--}}



@endsection
@section('css')
    <style>
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('/img/loading-spinner-blue.gif') 50% 50% no-repeat rgb(249, 249, 249);
            opacity: .8;
        }

    </style>
@endsection
@section('js')
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.replace('ckeditorText', {
            height: 700,
            allowedContent: true
        });

    </script>
    <script>
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.replace('ckeditorTextletter1', {
            height: 700,
            allowedContent: true
        });

    </script>
    <script>
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.replace('ckeditorTextletter2', {
            height: 700,
            allowedContent: true
        });

    </script>

    <script>
        function upload_attachment(id, number) {
            $(".loader").show();
            var master_document_id = document.getElementById('master_document_id_' + number).value;
            var document_status_id = document.getElementById('document_status_id_' + number).value;
            var sf_application_id = document.getElementById('sf_application_id').value;


            document.getElementById('sf_doc_error_' + number).value = "";
            var file_data = $('#' + id).prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('master_document_id', master_document_id);
            form_data.append('document_status_id', document_status_id);
            form_data.append('sf_application_id', sf_application_id);
            //console.log(form_data)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                }
            });
            $.ajax({
                url: "{{url('upload_sf_application_attachment')}}", // point to server-side PHP script
                data: form_data,
                type: 'POST',
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                success: function (data) {
                    $(".loader").hide();
                    console.log(data)
                    if (data.status == true) {
                        $("#uploaded_file_" + number).prop("href", data.file_path)
                        $("#uploaded_file_" + number).css("display", "block");
                        document.getElementById('document_status_id_' + number).value = data.doc_id
                        document.getElementById('sf_doc_error_' + number).innerHTML = "";
                    } else {
                        document.getElementById(id).value = null;
                        document.getElementById('sf_doc_error_' + number).innerHTML = data.message;
                    }
                }
            });
            showUploadedFileName();
        }

        function showUploadedFileName() {
            $('.custom-file-input').change(function (e) {
                $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
            });
        }

    </script>
@endsection
