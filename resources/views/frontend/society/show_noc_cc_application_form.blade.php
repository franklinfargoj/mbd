@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.actions_noc_cc',compact('noc_applications'))
@endsection
@section('content')
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
                    <span class="d-block">Chief Officer,M.H. & A.D Board</span>
                    <span class="d-block">Grihaniman Bhavan,Kalanagar,</span>
                    <span class="d-block">Bandra (East),Mumbai - 400051</span>
                </p>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content letter-form-content">
            <div class="letter-form-subject">
                <p><span class="font-weight-semi-bold">Subject :- </span>Proposed Redevelopment of existing building number. <input type="hidden" name="application_master_id" value="{{ $id }}" readonly><input class="letter-form-input" type="text" id="" name="building_no" value="{{ $society_details->building_no }}" readonly>, known as <input class="letter-form-input" type="text" id="" name="name" value="{{ $society_details->name }}" readonly> situated at <input class="letter-form-input" type="text" id="" name="address" value="{{ $society_details->address }}" readonly> under DCR 33(5)</p>
                <p><span class="font-weight-semi-bold">Ref :- </span>Offer Letter No. <input class="letter-form-input" type="text" id="" name="offer_letter_number" value="{{ $noc_application->request_form->offer_letter_number }}" readonly> dated <input class="letter-form-input" type="text" id="" name="offer_letter_date" value="{{date('j F Y',strtotime($noc_application->request_form->offer_letter_date))}}" readonly></p>
                <hr>
                <p class="font-weight-semi-bold">Dear Sir,</p>
                <p>
                    Reference is requested to the subject mentioned above vide Reference MHADA issued us the offer letter for additional FSI. No Dues certificate number is as   <input class="letter-form-input" type="text" id="" name="no_dues_certificate_number" value="{{ $noc_application->request_form->no_dues_certificate_number}}" readonly> in favour of Chief accounts officer,Mumbai board,MHADA bearing No. Dtd <input class="letter-form-input" type="text" id="" name="no_dues_certificate_date" value="{{date('j F Y',strtotime($noc_application->request_form->no_dues_certificate_date))}}" readonly>.NOC issued with number is as <input class="letter-form-input" type="text" id="" name="noc_no" value="{{$noc_application->request_form->noc_no}}" readonly> dated <input class="letter-form-input" type="text" id="" name="noc_date" value="{{date('j F Y',strtotime($noc_application->request_form->noc_date))}}" readonly>.Tripartiate agreement was issued with number <input class="letter-form-input" type="text" id="" name="tripartite_agreement_number" value="{{$noc_application->request_form->tripartite_agreement_number}}" readonly> dated
                    <input class="letter-form-input" type="text" id="" name="tripartite_agreement_date" value="{{date('j F Y',strtotime($noc_application->request_form->tripartite_agreement_date))}}" readonly> 
                </p>
                <p>Hence we request you to grant us the No Objection Certificate at the earliest.</p>
                <p>Thanking you,</p>
                <p>Yours Truly</p>
            </div>
            <div>
                <div class="ml-auto">
                    <p>
                        <span class="d-block font-weight-semi-bold">For {{ $society_details->name }}</span>
                        <span class="d-block">Chairman /Secretary / Treasurer</span>
                        <span class="d-block">Encl:- Payment receipt, Undertakings & Indemnity bonds ,No dues certificate</span>
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
@endsection