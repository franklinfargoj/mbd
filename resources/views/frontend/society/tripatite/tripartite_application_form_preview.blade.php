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
                                <span class="d-block font-weight-semi-bold">The Resident Executive Engineer, (R.E.E),</span>
                                <span class="d-block">MHADA, Mumbai Board,</span>
                                <span class="d-block">Kalanagar, Bandra - (E),</span>
                                <span class="d-block">Mumbai-400 051.</span>
                            </p>
                        </div>
                    </div>
                    <!-- END: Subheader -->
                    <div class="m-content letter-form-content">
                        <div class="letter-form-subject">
                            <p><span class="font-weight-semi-bold">Subject :- </span> Proposed redevelopment of the existing <input class="letter-form-input" type="text" id="" name="building_no" value="{{ $society_details->building_no }}" readonly> known as <input class="letter-form-input" type="text" id="" name="society_name" value="{{ $society_details->name }}" readonly> along with O.B. No.
                                and adjacent plot No. , bearing CTS No.(pt.) of Village - ___ at ____.</p>
                            <p class="font-weight-semi-bold">Dear Sir,</p>
                            <p>Herewith we are submitting draft copy of Tripartite Agreement to be executed as per the Offer Letter No <span><b>{{ $ol_applications->request_form->offer_letter_number }}</b></span>, Dated <b>{{ $ol_applications->request_form->offer_letter_date }}</b> and Revised Offer Letter No. <b>{{ $ol_applications->request_form->revised_offer_letter_number }}</b>, Dated <b>{{ $ol_applications->request_form->revised_offer_letter_date }}</b> and Revised NOC for IOD Purpose <b>{{ $ol_applications->request_form->noc_for_iod_purpose_number }}</b>, Dated <b>{{ $ol_applications->request_form->noc_for_iod_purpose_date }}</b>.</p>
                            <p>So please acknowledge the receipt of the same.</p>
                        </div>
                        <div class="letter-form-footer d-flex font-weight-semi-bold mt-5">
                            <div class="ml-auto text-right">
                                <p class="mb-5">Thanking You,</p>
                                <p>
                                <span class="d-flex">Best Regards
                                    {{--<input class="letter-form-input letter-form-input--xl"--}}
                                                                    {{--type="text" id="" name="" value="">--}}</span>
                                    {{--<span class="d-flex mt-3">सचिव <input class="letter-form-input letter-form-input--xl"--}}
                                                                          {{--type="text" id="" name="" value=""></span>--}}
                                </p>
                            </div>
                        </div>
{{--                        @if($sc_application->scApplicationLog->status_id == config('commanConfig.applicationStatus.pending'))--}}
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions px-0">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="btn-list">
                                                {{--<button type="submit" class="btn btn-primary">Submit & Next</button>--}}
                                                {{--<a href="" class="btn btn-secondary">Cancel</a>--}}
                                                {{--<a href="" class="btn btn-secondary">Cancel</a>--}}
                                            </div>
                                        </div>
                                    </div>
                                    @if((isset($applicationCount) && $applicationCount <= 0) && $ol_applications->olApplicationStatus[0]->status_id == config('commanConfig.applicationStatus.pending') && $ol_applications->current_status_id != config('commanConfig.applicationStatus.draft_tripartite_agreement'))
                                        <a href="{{ route('tripartite_application_form_edit', $ol_applications->id) }}" class="btn btn-primary">
                                            Back
                                        </a>
                                        <span style="float:right;margin-right: 20px">
                                        <a href="{{ route('display_tripartite_docs', encrypt($id)) }}" class="btn btn-primary">
                                            Next
                                        </a>
                                    @endif
                                </span>
                                </div>
                            </div>
                        {{--@endif--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection