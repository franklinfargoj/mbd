@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.renewal.actions',compact('sc_applications'))
@endsection
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Application</h3>
                <div class="ml-auto btn-list">
                    <a href="{{ route('society_conveyance.index') }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                    <a href="#" target="_blank" id="download_application_form" class="btn print-icon" rel="noopener"
                       onclick="printContent('printdiv')"><img src="{{asset('/img/print-icon.svg')}}" title="print"></a>
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
                            <h3 class="m-subheader__title ">अर्जाचा नमुना</h3>
                        </div>
                        <div class="d-flex align-items-center justify-content-end mt-2">
                            <h6 class="font-weight-semibold">सह गृह संस्थेच्या लेटरहेडवर</h6>
                        </div>
                        <div class="letter-form-header-content">
                            <p>
                                <span class="d-block font-weight-semi-bold">प्रति,</span>
                                <span class="d-block">उपमुख्य अधिकारी/ पूर्व / पश्चिम,</span>
                                <span class="d-block">मुंबई गृहनिर्माण व क्षेत्रविकास मंडळ,</span>
                                <span class="d-block">गृहनिर्माण भवन, बांद्रा (पूर्व), मुंबई - ५१.</span>
                            </p>
                        </div>
                    </div>
                    <!-- END: Subheader -->
                    <div class="m-content letter-form-content">
                        <div class="letter-form-subject">
                            <p><span class="font-weight-semi-bold">विषय :- </span> <input class="letter-form-input" type="text" id="" name="layout_name" value="{{ $sc_application->applicationLayout[0]->layout_name }}"> येथील <input class="letter-form-input" type="text" id="" name="society_name" value="{{ $sc_application->societyApplication->name }}"> इमारतीचे अभिहस्तांतरण करणेबाबत गृहनिर्माण
                                संस्थेच्या स्वयंपुनर्विकासाच्या प्रस्तावास मंजूरी मिळण्याबाबतचा अर्ज.</p>
                            <p class="font-weight-semi-bold">महोदय,</p>
                            <p>उपुक्त विषयांकित इमारतीचे अभिहस्तांतरण करणेसाठी खालील माहिती व कागदपत्रे सादर करण्यात येत
                                आहे.</p>
                            <div class="application-fields-wrapper">
                                <div class="form-group m-form__group row align-items-start">
                                    <div class="col-sm-4 application-fields">
                                        <label class="application-form-label" for="">१. वसाहितीचे नाव:</label>
                                        <input type="text" id="" name="society_name" class="letter-form-input letter-form-input--100" value="{{ $sc_application->societyApplication->name }}">
                                    </div>
                                    <div class="col-sm-4 application-fields">
                                        <label class="application-form-label" for="">२. इमारत क्र:</label>
                                        <input class="letter-form-input letter-form-input--100" type="text" id="" name="society_no"
                                               value="{{ $sc_application->societyApplication->building_no }}" readonly>
                                    </div>
                                    <div class="col-sm-4 application-fields">
                                        <label class="application-form-label" for="">३. योजनेचे नाव:</label>
                                        <input class="letter-form-input letter-form-input--100" type="text" id="" name="scheme_name"
                                               value="{{ $sc_application->sr_form_request->sr_scheme_name->name }}" readonly>
                                    </div>
                                    <div class="col-sm-4 application-fields">
                                        <label class="application-form-label" for="">४. प्रथम सदनिका वितरणाचा दिनांक:</label>
                                        <input class="letter-form-input letter-form-input--100 m_datepicker" type="text" id="" name="first_flat_issue_date"
                                               value="{{ date(config('commanConfig.dateFormat'), strtotime($sc_application->sr_form_request->first_flat_issue_date)) }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row align-items-start">
                                    <label class="col-12 mb-4">६. एकूण सदनिका</label>
                                    <div class="col-sm-4 application-fields">
                                        <label class="d-block" for="">A. निवासी:</label>
                                        <input class="letter-form-input letter-form-input--100" type="text" id="" name="residential_flat"
                                               value="{{ $sc_application->sr_form_request->residential_flat }}" readonly>
                                    </div>
                                    <div class="col-sm-4 application-fields">
                                        <label class="d-block" for="">B. अनिवासी:</label>
                                        <input class="letter-form-input letter-form-input--100" type="text" id="" name="non_residential_flat"
                                               value="{{ $sc_application->sr_form_request->non_residential_flat }}" readonly>
                                    </div>
                                    <div class="col-sm-4 application-fields">
                                        <label class="d-block" for="">C. एकूण:</label>
                                        <input class="letter-form-input letter-form-input--100" type="text" id="" name="total_flat"
                                               value="{{ $sc_application->sr_form_request->total_flat }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-12 mb-4">७. </label>
                                    <div class="col-sm-4 application-fields">
                                        <label class="application-form-label" for="">A. संस्था नोंदणी क्र:</label>
                                        <input class="letter-form-input letter-form-input--100" type="text" id=""
                                               name="society_registration_no" value="{{ $sc_application->societyApplication->registration_no }}" readonly>
                                    </div>
                                    <div class="col-sm-4 application-fields">
                                        <label class="application-form-label" for="">B. संस्था नोंदणी दिनांक:</label>
                                        <input class="letter-form-input letter-form-input--100 m_datepicker" type="text" id=""
                                               name="society_registration_date" value="{{ date(config('commanConfig.dateFormat'), strtotime($sc_application->sr_form_request->society_registration_date)) }}" readonly>
                                    </div>
                                </div>
                                {{--<div class="form-group m-form__group row">--}}
                                {{--<div class="col-sm-6 application-fields">--}}
                                {{--<label class="application-form-label" for="">८. अधिकृत सभासदांची यादी (पती व पत्नी संयुक्त नावे):</label>--}}
                                {{--<p><a href="{{ route('sc_download') }}" class="btn btn-primary" target="_blank" rel="noopener">Download Template</a> </p>--}}
                                {{----}}
                                {{--<input class="letter-form-input letter-form-input--100 m_datepicker" type="text" id=""--}}
                                {{--name="" value="">--}}
                                {{--</div>--}}
                                {{--<div class="col-sm-6 application-fields">--}}
                                {{-- <label class="application-form-label" for="">Upload File:</label> --}}
                                {{--<p>--}}
                                {{--<input class="custom-file-input" name="template" type="file"--}}
                                {{--id="test-upload" required>--}}
                                {{--<label class="custom-file-label" for="test-upload">Choose--}}
                                {{--file ...</label>--}}
                                {{--</p>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                <div class="form-group m-form__group row">
                                    <label class="col-12 mb-4">९. सेवा हस्तांकरण झाल्याचा दिनांक:</label>
                                    <div class="col-sm-4 application-fields">
                                        <label class="d-block" for="">१. मालमत्ता कर:</label>
                                        <input class="letter-form-input letter-form-input--100" type="text" id="" name="property_tax"
                                               value="{{ $sc_application->sr_form_request->property_tax }}" readonly>
                                    </div>
                                    <div class="col-sm-4 application-fields">
                                        <label class="d-block" for="">२. पाणी बिल:</label>
                                        <input class="letter-form-input letter-form-input--100" type="text" id="" name="water_bill"
                                               value="{{ $sc_application->sr_form_request->water_bill }}" readonly>
                                    </div>
                                    <div class="col-sm-4 application-fields">
                                        <label class="d-block" for="">३. अकृषिक कर:</label>
                                        <input class="letter-form-input letter-form-input--100" type="text" id="" name="non_agricultural_tax"
                                               value="{{ $sc_application->sr_form_request->non_agricultural_tax }}" readonly>
                                    </div>
                                </div>
                                {{--<div class="form-group m-form__group row">--}}
                                {{--<div class="col-sm-4 application-fields">--}}
                                {{--<label class="application-form-label" for="">१०. कार्यकारणी यादी</label>--}}
                                {{--<input class="letter-form-input letter-form-input--100 m_datepicker" type="text" id=""--}}
                                {{--name="society_address" value="{{ $sc_application->societyApplication->address }}">--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                <div class="form-group m-form__group row">
                                    <div class="col-sm-12 application-fields">
                                        <label class="application-form-label" for="">११. संस्थेचा अधिकृत पत्ता</label>
                                        <input class="letter-form-input letter-form-input--100" type="text" id="" name="society_address"
                                               value="{{ $sc_application->societyApplication->address }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="letter-form-footer d-flex font-weight-semi-bold mt-5">
                            <div class="ml-auto text-right">
                                <p class="mb-5">आपला विश्वासू,</p>
                                <p>
                                <span class="d-flex">अध्यक्ष <input class="letter-form-input letter-form-input--xl"
                                                                    type="text" id="" name="" value=""></span>
                                    <span class="d-flex mt-3">सचिव <input class="letter-form-input letter-form-input--xl"
                                                                          type="text" id="" name="" value=""></span>
                                </p>
                            </div>
                        </div>
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
                                <a href="@if($sc_application->application_master_id) {{ route('society_renewal.edit', encrypt($sc_application->id)) }} @endif" class="btn btn-primary">
                                    Back
                                </a>
                                <span style="float:right;margin-right: 20px">
                                    <a href="{{ route('sr_upload_docs') }}" class="btn btn-primary">
                                        Next
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection