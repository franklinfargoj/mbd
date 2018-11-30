@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.'.$noc_application->folder.'.action_noc',compact('noc_application'))
@endsection
@section('content')
<style type="text/css" media="print">
    #printdiv {
        size: auto;
        margin: 0mm;
    }
 
</style>
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Applications</h3>
            @php
            $route_name=\Request::route()->getName();
            @endphp
            @if($route_name=='ree.view_application_noc')
            {{ Breadcrumbs::render('view_noc_application_ree',$noc_application->id) }}
            @elseif($route_name=='ree.view_reval_application')
                {{ Breadcrumbs::render('view_reval_application_ree',$noc_application->id) }}
            @elseif($route_name=='co.view_application_noc')
            {{ Breadcrumbs::render('view_application_co',$noc_application->id) }}
            @else
            @endif
            <div class="ml-auto btn-list">
                <a  onclick="goBack()" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                <a href="#" target="_blank" id="download_application_form" class="btn print-icon"
                    rel="noopener" onclick="printContent('printdiv')"><img src="{{asset('/img/print-icon.svg')}}" title="print"></a>
            </div>
        </div>
    </div>
    <div class="m-portlet">
        <div id="printdiv">
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
                        <p><span class="font-weight-semi-bold">Subject :- </span>Proposed Redevelopment of existing building number.<input class="letter-form-input" type="text" id="" name="building_no" value="{{ $noc_application->eeApplicationSociety->building_no }}" readonly>, known as <input class="letter-form-input" type="text" id="" name="name" value="{{ $noc_application->eeApplicationSociety->name }}" readonly> situated at <input class="letter-form-input" type="text" id="" name="address" value="{{ $noc_application->eeApplicationSociety->address }}" readonly> under DCR 33(5)</p>
                        <p><span class="font-weight-semi-bold">Ref :- </span>Offer Letter No. <input class="letter-form-input" type="text" id="" name="offer_letter_number" value="{{ $noc_application->request_form->offer_letter_number }}" readonly> dated <input class="letter-form-input" type="text" id="" name="offer_letter_date" value="{{date('j F Y',strtotime($noc_application->request_form->offer_letter_date))}}" readonly></p>
                        <hr>
                        <p class="font-weight-semi-bold">Dear Sir,</p>
                        <p>
                            Reference is requested to the subject mentioned above vide Reference MHADA issued us the offer letter for additional FSI. Accordingly we have made payment to the Chief Accounts officer vide Demand draft / Pay order of Rs  <input class="letter-form-input" type="text" id="" name="demand_draft_amount" value="{{ $noc_application->request_form->demand_draft_amount}}" readonly> in favour of Chief accounts officer,Mumbai board,MHADA bearing No. <input class="letter-form-input" type="text" id="" name="demand_draft_number" value="{{$noc_application->request_form->demand_draft_number}}" readonly> Dtd <input class="letter-form-input" type="text" id="" name="demand_draft_date" value="{{date('j F Y',strtotime($noc_application->request_form->demand_draft_date))}}" readonly> drawn on <input class="letter-form-input" type="text" id="" name="demand_draft_bank" value="{{$noc_application->request_form->demand_draft_bank}}" readonly> towards first installment payment of allotment of said FSI. A copy of the receipt is enclosed herewith for your reference. Also we are submitting various Undertakings & Indemnity Bonds and No Dues Certificate as mentioned in the Offer Letter.
                        </p>
                        <p>Hence we request you to grant us the No Objection Certificate at the earliest.</p>
                        <p>Thanking you,</p>
                        <p>Yours Truly</p>
                    </div>
                    <div>
                        <div class="ml-auto">
                            <p>
                                <span class="d-block font-weight-semi-bold">For {{ $noc_application->eeApplicationSociety->name }}</span>
                                <span class="d-block">Chairman /Secretary / Treasurer</span>
                                <span class="d-block">Encl:- Payment receipt, Undertakings & Indemnity bonds ,No dues certificate</span>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('download_application_form_js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#download_application_form').click(function () {
            $(this).hide();
        });
    });

    function printContent(element) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(element).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
    function goBack() {
        window.history.back();
    }
</script>
@endsection