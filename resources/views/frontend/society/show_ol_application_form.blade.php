@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.actions',compact('ol_applications'))
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
                    <p>{{ $ol_application->applicationMasterLayout[0]->layout_name }}</p>
                </h3>
            </div>
            <div class="letter-form-header-content">
                <p>
                    <span class="d-block font-weight-semi-bold">प्रति,</span>
                    <span class="d-block">कार्यकारी अभियंता, <input class="letter-form-input" type="text" id="" name="department_name" value="EE" required> विभाग,</span>
                    <span class="d-block">मुंबई गृहनिर्माण व क्षेत्रविकास मंडळ,</span>
                    <span class="d-block">गृहनिर्माण भवन, वांद्रे (पुर्व),</span>
                    <span class="d-block">मुंबई -४०००५१.</span>
                </p>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content letter-form-content">
            <div class="letter-form-subject">
                <p><span class="font-weight-semi-bold">विषय :- </span>इमारत क्र. <input type="hidden" name="application_master_id" value="{{ $id }}" readonly><input class="letter-form-input letter-form-input--xs" type="text" id="" name="building_no" value="{{ $society_details->building_no }}" readonly>, <input class="letter-form-input letter-form-input--xl" type="text" id="" name="name" value="{{ $society_details->name }}" readonly> सहकारी गृहनिर्माण संस्थेच्या @if($id == '2' || $id == '6')स्वयंपुनर्विकासाच्या@endif @if($id == '13' || $id == '17')पुनर्विकासाच्या@endif प्रस्तावास मंजूरी मिळण्याबाबतचा अर्ज.</p>
                <p class="font-weight-semi-bold">महोदय,</p>
                <p>आम्ही <input class="letter-form-input letter-form-input--lg" type="text" id="" name="name" value="{{ $society_details->name }}" readonly> सहकारी गृहनिर्माण संस्थेचे पदाधिकारी ( इमारत क्र. <input class="letter-form-input letter-form-input--xs" type="text" id="" name="building_no" value="{{ $society_details->building_no }}" readonly> पत्ता - <input class="letter-form-input letter-form-input--xl" type="text" id="" name="address" value="{{ $society_details->address }}" readonly>) आपणांस विनंती करतो की, आम्ही रहात असलेल्या सदरहू इमारतीचा पुनर्विकास विकास नियंत्रण नियमावली ३३ (५) अंतर्गत @if($id == '13') गृहसत्ता हिस्सेदारी @else अधिमुल्य आधारित @endif तत्वावर करु इच्छितो. आमच्या गृहनिर्माण संस्थेने दिनांक <input class="letter-form-input letter-form-input--md" type="text" name="date_of_meeting" value="{{ date(config('commanConfig.dateFormat'), strtotime($ol_application->request_form->date_of_meeting)) }}" readonly> रोजी @if($id == '2' || $id == '6')स्वयंपुनर्विकास@endif @if($id == '13' || $id == '17')पुनर्विकास@endifसंदर्भात सर्वसाधारण सभेचा ठराव क्र. <input class="letter-form-input letter-form-input--md" type="text" id="" name="resolution_no" value="{{ $ol_application->request_form->resolution_no }}" readonly> अन्वये निर्णय घेतला आहे.</p>
                <p>आम्ही सहकारी गृहनिर्माण संस्थेच्या @if($id == '2' || $id == '6')स्वयंपुनर्विकासाच्या@endif @if($id == '13' || $id == '17')पुनर्विकासाच्या@endif कामांसाठी वि.नि.नि ३३ (५) मधील तरतूदींच्या अधिन राहून याबाबतचे सविस्तर आराखडे / नकाशे व @if($id == '2' || $id == '6')स्वयंपुनर्विकासाच्या@endif @if($id == '13' || $id == '17')पुनर्विकासाच्या@endif कामावर देखरेख करण्यासाठी  <input class="letter-form-input letter-form-input--md" type="text" id="" name="architect_name" value="{{ $ol_application->request_form->architect_name }}" readonly> या वास्तुशास्त्रज्ञाची नियुक्ती केली आहे. @if($id == '13' || $id == '17') आमच्या संस्थेच्या इमारतीच्या पुनर्विकासाचे काम करणेकरीता <input class="letter-form-input letter-form-input--md" type="text" id="" name="developer_name" value="{{ $ol_application->request_form->developer_name }}" readonly> या विकासकाची निवड केली आहे. @endif</p>
                <p>यानुसार आपणांस विनंती करण्यात येते की, अभिन्यासातील अनुज्ञेय प्रोराटा क्षेत्रफळाचे वितरण संस्थेस करावे व संस्थेस वितरण करण्यात येणाऱ्या अतिरिक्त बांधकाम क्षेत्रफळाकरीता भरणा करावे लागणारे अधिमुल्य म्हाडाच्या धोरणानुसार ४ समान हप्त्यात देण्यात यावे.</p>
                <p>सदर प्रस्तावावर उचित कार्यवाही करुन देकारपत्र जारी करण्याची कार्यवाही करण्यात यावी, ही विनंती.</p>
            </div>
            <div class="letter-form-footer d-flex font-weight-semi-bold mt-5">
                <div class="ml-auto text-center">
                    <p class="mb-5">आपला विश्वासू</p>
                    <p>
                        <span class="d-block">अध्यक्ष / सचिव / खजिनदार</span>
                        <span class="d-block">------- स.गृ.नि. संस्था मर्या.</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="m-login__form-action mt-4 mb-4">
                <a href="{{ route('society_offer_letter_dashboard') }}" class="btn btn-primary">
                    Back
                </a>
                <span style="float:right;margin-right: 20px">
                    <a href="{{ route('documents_upload') }}" class="btn btn-primary">
                        Next
                    </a>
                </span>
        </div>
    </form>
@endsection