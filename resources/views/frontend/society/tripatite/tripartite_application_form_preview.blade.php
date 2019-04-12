<!-- .@extends('frontend.layouts.sidebarAction') -->
@section('actions')
    @include('frontend.society.tripatite.actions',compact('ol_applications'))
@endsection
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Application</h3>
                {{ Breadcrumbs::render('society_tripartite_view_application', $id) }}(Tripartite)
                <div class="ml-auto btn-list">
                    <a href="{{ route('society_offer_letter_dashboard') }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                    {{--<a href="#" target="_blank" id="download_application_form" class="btn print-icon" rel="noopener"--}}
                    {{--onclick="printContent('printdiv')"><img src="{{asset('/img/print-icon.svg')}}" title="print"></a>--}}
                </div>
            </div>
        </div>
        <div class="m-portlet">
            <div id="printdiv">
                <form class="letter-form m-form" action="{{ route('society_conveyance.store') }}" method="post" id="society-conveyance-application" enctype="multipart/form-data">
                    @csrf
                    <!-- BEGIN: Subheader -->
                    <div class="m-subheader letter-form-header">
                        <div class="d-flex align-items-center justify-content-center">
                            {{--<h3 class="m-subheader__title ">अर्जाचा नमुना</h3>--}}
                        </div>
                        <div class="d-flex align-items-center justify-content-end mt-2">
                            <h6 class="font-weight-semibold">Date: {{ date('d-m-Y', strtotime($ol_applications->created_at)) }}</h6>
                        </div>
                        <div class="letter-form-header-content">
                            <p>
                                <span class="d-block font-weight-semi-bold">To,</span>
                                <span class="d-block font-weight-semi-bold">The Executive Engineer,</span>
                                <span class="d-block">MHADA,</span>
                                <span class="d-block">Gruha Nirman Bhuvan,</span>
                                <span class="d-block">Bandra East,</span>
                                <span class="d-block">Mumbai-400 051.</span>
                            </p>
                        </div>
                    </div>
                    <!-- END: Subheader -->

                    <div class="m-content letter-form-content">
                        <div class="letter-form-subject">
                            <p style="float: left;width: 10%;"><span class="font-weight-semi-bold">Subject :- </span></p>
                            <p style="margin-top: 0;float: left;width: 90%;">Proposed Redevelopment of Residential building of<input class="letter-form-input" type="text" id="" name="name" value="{{ $society_details->name }}" readonly>, on plot number<input class="letter-form-input" type="text" id="" name="building_no" value="{{ $society_details->building_no }}" readonly>, <input class="letter-form-input" type="text" id="" name="address" value="{{ $society_details->address }}" readonly>.</p>

                            <p style="float: left;width: 10%;margin: 0;"><span class="font-weight-semi-bold">Ref :- </p>
                            <div style="margin-top: 0;float: left;width: 90%;">
                                <p>1. Offer Letter No. <input class="letter-form-input" type="text" id="" name="offer_letter_number" value="{{ $ol_applications->request_form->offer_letter_number }}" readonly> dated <input class="letter-form-input" type="text" id="" name="offer_letter_date" value="{{date('j F Y',strtotime($ol_applications->request_form->offer_letter_date))}}" readonly></p>
                                <p></span>2. NOC for IOD purpose bearing No. <input class="letter-form-input" type="text" id="" name="noc_no" value="{{ $ol_applications->request_form->noc_for_iod_purpose_number }}" readonly> dated <input class="letter-form-input" type="text" id="" name="noc_date" value="{{date('j F Y',strtotime($ol_applications->request_form->noc_for_iod_purpose_date))}}" readonly>
                            </p>
                            </div>
                        
                            <hr>
                            <p class="font-weight-semi-bold">Dear Sir/ Madam,</p>
                            <p>
                                We enclose herewith the TRI-PARTY Agreement between MHADA of the first part,   <input class="letter-form-input" type="text" id="" name="name" value="{{ $society_details->name }}" readonly> second part, <input class="letter-form-input" type="text" id="" name="developer_name" value="{{$ol_applications->request_form->developer_name}}" readonly> third part for grant of No Objection Certificate for the purpose of redevelopment.
                            </p>
                            <p>We request your goodselves to please arrange to excute the Tri-Party Agreement and issue us the NOC and CC to proceed further.</p>
                            <p>Please do the needful at the earliest and oblige.</p>
                            <p>Thanking You,</p>
                            <p>Yours faithfully,</p>
                        </div>
                        <div>
                            <div class="ml-auto">
                                <p>
                                    <span class="d-block font-weight-semi-bold">For {{ $society_details->name }}</span><br/><br/>
                                    <span class="d-block">Chairman /Secretary / Treasurer</span>
                                </p>
                            </div>
                        </div>

                        @if((isset($applicationCount) && $applicationCount <= 0) && $ol_applications->olApplicationStatus[0]->status_id == config('commanConfig.applicationStatus.pending') && $ol_applications->current_status_id != config('commanConfig.applicationStatus.draft_tripartite_agreement'))
                            <a href="{{ route('tripartite_application_form_edit', encrypt($ol_applications->id)) }}" class="btn btn-primary">
                                Back
                            </a>
                            <span style="float:right;margin-right: 20px">
                                        <a href="{{ route('display_tripartite_docs', encrypt($id)) }}" class="btn btn-primary">
                                            Next
                                        </a>
                            </span>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection