@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.actions_noc_cc',compact('noc_applications'))
@endsection
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">View Application</h3>
                {{ Breadcrumbs::render('society_noc_cc_application_view', $id) }}(Sharing)
                <div class="ml-auto btn-list">
                    <a href="{{ route('society_offer_letter_dashboard') }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                    {{--<a href="#" target="_blank" id="download_application_form" class="btn print-icon" rel="noopener"--}}
                    {{--onclick="printContent('printdiv')"><img src="{{asset('/img/print-icon.svg')}}" title="print"></a>--}}
                </div>
            </div>
        </div>

        <div class="m-portlet">
            <div id="printdiv" style="text-align:justify;">
                <form class="letter-form" action="{{ route('save_offer_letter_application_dev') }}" method="post" id="save_offer_letter_application_dev">
                    @csrf
                    <!-- BEGIN: Subheader -->
                    <div class="m-subheader letter-form-header">
                        <div class="d-flex align-items-center justify-content-center">
                            <h3 class="m-subheader__title ">
                                अर्जाचा नमुना
                            </h3>
                        </div>
                        <div class="text-center">
                            <h3 class="m-subheader__title ">
                                <label for="layouts">Layouts</label>
                                <p>{{ $noc_application->applicationMasterLayout[0]->layout_name }}</p>
                            </h3>
                        </div>
                        <div class="letter-form-header-content">
                            <p>
                                <span class="d-block font-weight-semi-bold">To,</span>
                                <span class="d-block">The Resident Executive Engineer, </span>
                                <span class="d-block">MHADA,</span>
                                <span class="d-block">Gruh Nirman Bhuvan,</span>
                                <span class="d-block">Bandra (East),Mumbai - 400051</span>
                            </p>
                        </div>
                    </div>
                    <!-- END: Subheader -->
                    <div class="m-content letter-form-content" style="text-align: justify">
                        <div class="letter-form-subject">
                            <p><span class="font-weight-semi-bold">Subject :- </span> Proposed Redevelopment of Residential building of<input class="letter-form-input" type="text" id="" name="name" value="{{ $society_details->name }}" readonly>, on plot number<input class="letter-form-input" type="text" id="" name="building_no" value="{{ $society_details->building_no }}" readonly>, <input class="letter-form-input" type="text" id="" name="address" value="{{ $society_details->address }}" readonly>.Issue of NOC & CC.</p>
                            <p><span class="font-weight-semi-bold">Ref :- </span>1. Offer Letter No. <input class="letter-form-input" type="text" id="" name="offer_letter_number" value="{{ $noc_application->request_form->offer_letter_number }}" readonly> Dated <input class="letter-form-input" type="text" id="" name="offer_letter_date" value="{{date('j F Y',strtotime($noc_application->request_form->offer_letter_date))}}" readonly></p>
                            <span style="margin-left: 36px"></span>2. IOD Bearing No. <input class="letter-form-input" type="text" id="" name="noc_no" value="{{ $noc_application->request_form->noc_no }}" readonly> Dated <input class="letter-form-input" type="text" id="" name="noc_date" value="{{date('j F Y',strtotime($noc_application->request_form->noc_date))}}" readonly></p>
                            <span style="margin-left: 36px"></span>3. MCGM IOD No. <input class="letter-form-input" type="text" id="" name="mcgm_iod_number" value="{{ $noc_application->request_form->mcgm_iod_number }}" readonly> Dated <input class="letter-form-input" type="text" id="" name="mcgm_iod_date" value="{{date('j F Y',strtotime($noc_application->request_form->mcgm_iod_date))}}" readonly></p>
                            <span style="margin-left: 36px"></span>4. Tripartite Agreement Dated <input class="letter-form-input" type="text" id="" name="tripartite_agreement_date" value="{{date('j F Y',strtotime($noc_application->request_form->tripartite_agreement_date))}}" readonly></p>

                            <p class="font-weight-semi-bold">Dear Sir,</p>
                            <p>
                                Enclosing herewith the TRI-PARTY Agreement between MHADA first part,   <input class="letter-form-input" type="text" id="" name="name" value="{{ $society_details->name }}" readonly> second part, <input class="letter-form-input" type="text" id="" name="developer_name" value="{{$noc_application->request_form->developer_name}}" readonly> third part, being registered on payment of all necessary charges.
                            </p>
                            <p>We now request your goodselves to proceed further for the issue NOC & CC at the earliest and oblige. </p>
                            <p>Kindly do the needful. </p>
                            <p>Thanking You,</p>
                            <p>Yours faithfully,</p>
                        </div>
                        <div>
                            <div class="ml-auto">
                                <p>
                                    <span class="d-block font-weight-semi-bold">For {{ $society_details->name }}</span>
                                    <span class="d-block">Chairman /Secretary / Treasurer</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    @if($noc_application->nocApplicationStatus[0]->status_id == '3' || $noc_application->nocApplicationStatus[0]->status_id == '4')
                        <div class="m-login__form-action mt-4 mb-4">
                            <a href="{{ route('society_noc_cc_edit') }}" class="btn btn-primary">
                                Back
                            </a>
                            <span style="float:right;margin-right: 20px">
                        <a href="{{ route('documents_upload_noc_cc') }}" class="btn btn-primary">
                            Next
                        </a>
                    </span>
                        </div>
                    @endif
                </form>


            </div>
        </div>


    </div>




@endsection