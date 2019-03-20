@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.reval_actions',compact('ol_applications'))
@endsection
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Application</h3>
            {{ Breadcrumbs::render('society_tripartite_view_application', $id) }} (Revalidation)
            <div class="ml-auto btn-list">
                <a href="{{ route('society_offer_letter_dashboard') }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>

    <div class="m-portlet">
    <form class="letter-form"  method="post" id="save_offer_letter_application_dev">
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
                    <p>{{ $ol_application->applicationMasterLayout[0]->layout_name }}</p>
                </h3>
            </div>
            <div class="letter-form-header-content">
                <p>
                    <span class="d-block font-weight-semi-bold">प्रति,</span>
                    <span class="d-block">कार्यकारी अभियंता, <input class="letter-form-input" type="text" id="" name="department_name" value="REE" required> विभाग,</span>
                    <span class="d-block">मुंबई गृहनिर्माण व क्षेत्रविकास मंडळ,</span>
                    <span class="d-block">गृहनिर्माण भवन, वांद्रे (पुर्व),</span>
                    <span class="d-block">मुंबई -४०००५१.</span>
                </p>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content letter-form-content">
            <div class="letter-form-subject">

                <p><span class="font-weight-semi-bold"> Subject - </span>Proposed redevelopment to the existing Building No. <input type="hidden" name="application_master_id" value="{{ $id }}" readonly><input class="letter-form-input" type="text" id="" name="building_no" value="{{ $society_details->building_no }}" readonly>(address )<input class="letter-form-input" type="text" id="" name="address" value="{{ $society_details->address }}" readonly> For (society name) <input class="letter-form-input" type="text" id="" name="name" value="{{ $society_details->name }}" readonly>

                <p class="font-weight-semi-bold">Ref: Society's request letter submitted on {{ date(config('commanConfig.dateFormat'), strtotime($old_ol_application->submitted_at )) }}</p>

                <p class="font-weight-semi-bold">Sir,</p>
                <p>
                    With reference to above subject, MHADA have issued offer letter vide no {{ $ol_application->request_form->ol_vide_no }} dated {{ date(config('commanConfig.dateFormat'), strtotime($ol_application->request_form->ol_issue_date)) }}. for additional biltup area. We request you to consider our request for extension of the offer letter period for further six months as per policy of MHADA.
                </p>

                <p>
                    <textarea readonly style="width: 100%" name="revalidation_reason" id="revalidation_reason" placeholder="Type reason for not able to make offer letter payment within 6 months of time">{{ $ol_application->request_form->reason_for_revalidation }}</textarea>
                </p>
                <p>
                    It is also understood that, MHADA has passed a Resolution No. <input class="letter-form-input" type="text" id="" name="resolution_no" value="{{ $ol_application->request_form->resolution_no }}" readonly> dated  <input class="letter-form-input" type="text" name="date_of_meeting" value="{{ date(config('commanConfig.dateFormat'), strtotime($ol_application->request_form->date_of_meeting)) }}" readonly> for allowing Co-operative Housing Societies to pay the amount of premium for additional Build-up area in three equal installments over a period of two years. We are ready to pay interest as per policy of MHADA.
                </p>

                <p>
                    Kindly, consider our sufferings & hardships and support our redevelopment by providing us received offer letter on the broad terms as requested above.

                    Thinking you in kind anticipation.
                </p>

            </div>
        </div>
         @if((isset($applicationCount) && $applicationCount <= 0) && ($ol_application->olApplicationStatus[0]->status_id == '3' || $ol_application->olApplicationStatus[0]->status_id == '4'))
   
            <div class="m-login__form-action mt-4 mb-4">
                    <a href="{{ route('society_reval_offer_letter_edit',encrypt($ol_application->id)) }}" class="btn btn-primary">
                        Back
                    </a>
                    <span style="float:right;margin-right: 20px">
                        <a href="{{ route('reval_documents_upload',encrypt($ol_application->id)) }}" class="btn btn-primary">
                            Next
                        </a>
                    </span>
            </div>
        @endif
    </form>
</div>    
@endsection