@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.conveyance.'.$data->folder.'.action')
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
            <h3 class="m-subheader__title m-subheader__title--separator">Application</h3>
           {{ Breadcrumbs::render('conveyance_view_application',$data->id) }}
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div>

    {{--<div class="m-subheader px-0 m-subheader--top">--}}
        {{--<div class="d-flex align-items-center">--}}
            {{--<h3 class="m-subheader__title m-subheader__title--separator">Application</h3>--}}
            {{--<div class="ml-auto btn-list">--}}
                {{--<a href="{{ session()->get('redirect_to') }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>--}}
                {{--<a href="#" target="_blank" id="download_application_form" class="btn print-icon"--}}
                    {{--rel="noopener" onclick="printContent('printdiv')"><img src="{{asset('/img/print-icon.svg')}}" title="print"></a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="m-portlet">--}}
        {{--<div id="printdiv">--}}
            {{--<form class="letter-form" action="{{ route('save_offer_letter_application_dev') }}" method="post" id="save_offer_letter_application_dev">--}}
                {{--@csrf--}}
                {{--<!-- BEGIN: Subheader -->--}}
                {{--<div class="m-subheader letter-form-header">--}}
                    {{--<!-- <center><a href="#" target="_blank" class="btn btn-info" rel="noopener">Download Offer Letter Application</a></center> -->--}}
                    {{--<center>--}}
                        {{--<h3 class="m-subheader__title ">--}}
                            {{--<label for="layouts">Layouts</label>--}}
                        {{--</h3>--}}
                        {{--<p><b></b></p>--}}
                    {{--</center>--}}
                    {{--<div class="d-flex align-items-center justify-content-center">--}}
                        {{--<h3 class="m-subheader__title ">--}}
                            {{--अर्जाचा नमुना--}}
                        {{--</h3>--}}
                    {{--</div>--}}
                    {{--<div class="letter-form-header-content">--}}
                        {{--<p>--}}
                            {{--<span class="d-block font-weight-semi-bold">प्रति,</span>--}}
                            {{--<span class="d-block">कार्यकारी अभियंता, <input class="letter-form-input letter-form-input--md"--}}
                                    {{--type="text" id="" name="department_name" value="EE" readonly> विभाग,</span>--}}
                            {{--<span class="d-block">मुंबई गृहनिर्माण व क्षेत्रविकास मंडळ,</span>--}}
                            {{--<span class="d-block">गृहनिर्माण भवन, वांद्रे (पुर्व),</span>--}}
                            {{--<span class="d-block">मुंबई -४०००५१.</span>--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- END: Subheader -->--}}
                {{--<div class="m-content letter-form-content">--}}
                    {{--<div class="letter-form-subject">--}}
                        {{--<p><span class="font-weight-semi-bold">विषय :- </span>इमारत क्र. <input class="letter-form-input letter-form-input--xs"--}}
                                {{--type="text" id="" name="building_no" value=""--}}
                                {{--readonly>, <input class="letter-form-input letter-form-input--xl" type="text" id=""--}}
                                {{--name="name" value="" readonly> सहकारी--}}
                            {{--गृहनिर्माण--}}
                            {{--संस्थेच्या स्वयंपुनर्विकासाच्या प्रस्तावास मंजूरी मिळण्याबाबतचा अर्ज.</p>--}}
                        {{--<p class="font-weight-semi-bold">महोदय,</p>--}}
                        {{--<p>आम्ही <input class="letter-form-input letter-form-input--lg" type="text" id="" name="name"--}}
                                {{--value="" readonly> सहकारी गृहनिर्माण--}}
                            {{--संस्थेचे पदाधिकारी ( इमारत क्र. <input class="letter-form-input letter-form-input--xs" type="text"--}}
                                {{--id="" name="building_no" value="{"--}}
                                {{--readonly> पत्ता - <input class="letter-form-input letter-form-input--xl" type="text" id=""--}}
                                {{--name="address" value="" readonly>)--}}
                            {{--आपणांस विनंती करतो की,--}}
                            {{--आम्ही रहात असलेल्या सदरहू इमारतीचा स्वयंपुनर्विकास विकास नियंत्रण नियमावली ३३ (५) अंतर्गत--}}
                            {{--अधिमुल्य--}}
                            {{--आधारित तत्वावर करु इच्छितो. आमच्या गृहनिर्माण संस्थेने दिनांक <input class="letter-form-input letter-form-input--md"--}}
                                {{--type="text" id="m_datepicker" name="date_of_meeting" value=""--}}
                                {{--readonly disabled> रोजी स्वयंपुनर्विकासासंदर्भात सर्वसाधारण सभेचा ठराव क्र. <input--}}
                                {{--class="letter-form-input letter-form-input--md" type="text" id="" name="resolution_no"--}}
                                {{--value="" readonly> अन्वये निर्णय--}}
                            {{--घेतला आहे.</p>--}}
                        {{--<p>आम्ही सहकारी गृहनिर्माण संस्थेच्या स्वयंपुनर्विकासाच्या कामांसाठी वि.नि.नि ३३ (५) मधील--}}
                            {{--तरतूदींच्या--}}
                            {{--अधिन राहून याबाबतचे सविस्तर आराखडे / नकाशे व पुनर्विकासाच्या कामावर देखरेख करण्यासाठी--}}
                            {{--<input class="letter-form-input letter-form-input--md" type="text" id="" name="architect_name"--}}
                                {{--value="" readonly> या--}}
                            {{--वास्तुशास्त्रज्ञाची नियुक्ती केली--}}
                            {{--आहे.@if(!empty($ol_application->request_form->developer_name))आमच्या संस्थेच्या इमारतीच्या--}}
                            {{--पुनर्विकासाचे काम करणेकरीता <input class="letter-form-input letter-form-input--md" type="text"--}}
                                {{--id="" name="developer_name" value=""--}}
                                {{--readonly> या--}}
                            {{--विकासकाची निवड केली आहे.@endif</p>--}}
                        {{--<p>यानुसार आपणांस विनंती करण्यात येते की, अभिन्यासातील अनुज्ञेय प्रोराटा क्षेत्रफळाचे वितरण--}}
                            {{--संस्थेस--}}
                            {{--करावे व संस्थेस वितरण करण्यात येणाÅया अतिरिक्त बांधकाम क्षेत्रफळाकरीता भरणा करावे लागणारे--}}
                            {{--अधिमुल्य--}}
                            {{--म्हाडाच्या धोरणानुसार ४ समान हप्त्यात देण्यात यावे.</p>--}}
                        {{--<p>सदर प्रस्तावावर उचित कार्यवाही करुन देकारपत्र जारी करण्याची कार्यवाही करण्यात यावी, ही--}}
                            {{--विनंती.</p>--}}
                    {{--</div>--}}
                    {{--<div class="letter-form-footer d-flex font-weight-semi-bold mt-5">--}}
                        {{--<div class="ml-auto text-center">--}}
                            {{--<p class="mb-5">आपला विश्वासू</p>--}}
                            {{--<p>--}}
                                {{--<span class="d-block">अध्यक्ष / सचिव / खजिनदार</span>--}}
                                {{--<span class="d-block">------- स.गृ.नि. संस्था मर्या.</span>--}}
                            {{--</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
    {{--</div>--}}
    <iframe src="{{ config('commanConfig.storage_server').'/'.$document->document_path}}" width="1000" height="482"></iframe>
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

</script>
@endsection
