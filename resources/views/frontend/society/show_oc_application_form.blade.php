@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.oc_actions',compact('oc_applications'))
@endsection
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Application</h3>
                        {{ Breadcrumbs::render('society_tripartite_view_application', encrypt($oc_applications->id)) }} (OC)
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
                        <p>{{ $oc_application->applicationMasterLayout[0]->layout_name }}</p>
                    </h3>
                </div>
                <div class="letter-form-header-content">
                    <p>
                        <span class="d-block font-weight-semi-bold">प्रति,</span>
                        <span class="d-block">कार्यकारी अभियंता, <input class="letter-form-input" type="text" id="" name="department_name" value="Executive Engineer/ Estate Manager" required> विभाग,</span>
                        <span class="d-block">मुंबई गृहनिर्माण व क्षेत्रविकास मंडळ,</span>
                        <span class="d-block">गृहनिर्माण भवन, वांद्रे (पुर्व),</span>
                        <span class="d-block">मुंबई -४०००५१.</span>
                    </p>
                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content letter-form-content">
                <div class="letter-form-subject">

                    <p><span class="font-weight-semi-bold"> Subject - </span>Application for @if($oc_application->request_form->is_full_oc==1) Full OC @else Part OC @endif  for rehab portion and sale component of the Proposed redevelopment of the existing Building No. <input type="hidden" name="application_master_id" value="{{ $id }}" readonly><input class="letter-form-input" type="text" id="" name="building_no" value="{{ $society_details->building_no }}" readonly>(address )<input class="letter-form-input" type="text" id="" name="address" value="{{ $society_details->address }}" readonly> For (society name) <input class="letter-form-input" type="text" id="" name="name" value="{{ $society_details->name }}" readonly>

                   
                    <p class="font-weight-semi-bold">Dear sir,</p>
                    <p>
                        With reference to the subject mentioned above, as per permissible B.U.A. allotted by MHADA we have completed the construction work.
                    </p>

                    <p>
                        <textarea readonly style="width: 100%" name="construction_details" id="construction_details" >{{ $oc_application->request_form->construction_details }}</textarea>
                    </p>

                    <p>
                        As the work is completed we have to obtain  @if($oc_application->request_form->is_full_oc==1) full @else part @endif occupation permission from MCGM to reaccomodate the existing members. As per the condition of the offer letter and NOC issued by MHADA, MHADA shall issue NOC for OC.
                         </p>

                    <p>
          We therefore request you to kindly grant us the NOC for  @if($oc_application->request_form->is_full_oc==1) Full OC @else Part OC @endif for rehab unit and sale component as mentioned above at the earliest.
                    </p>

                    <p>
                        Thanking you,
                    </p>
                    <p>
                        Yours faithfully,
                    </p>
                </div>

            </div>

            @if((isset($applicationCount) && $applicationCount <= 0) && ($oc_application->ocApplicationStatus[0]->status_id == '3' || $oc_application->ocApplicationStatus[0]->status_id == '4'))

                <div class="m-login__form-action mt-4 mb-4">
                        <a href="{{ route('society_oc_edit',encrypt($oc_application->id)) }}" class="btn btn-primary">
                            Back
                        </a>
                        <span style="float:right;margin-right: 20px">
                            <a href="{{ route('oc_documents_upload',encrypt($oc_application->id)) }}" class="btn btn-primary">
                                Next
                            </a>
                        </span>
                </div>
            @endif
        </form>
    </div>
</div>            
@endsection