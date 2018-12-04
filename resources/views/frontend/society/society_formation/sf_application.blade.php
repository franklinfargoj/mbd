@extends('admin.layouts.app')
@section('content')
@php
$disabled=isset($disabled)?$disabled:0;
@endphp
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Application</h3>
            <div class="ml-auto btn-list">
                @if($disabled==0)
                <a href="{{ route('society_formation.create') }}" class="btn btn-link"><i class="fa fa-long-arrow-left"
                        style="padding-right: 8px;"></i>Back</a>
                @endif
                <a href="#" target="_blank" id="download_application_form" class="btn print-icon" rel="noopener"
                    onclick="PrintElem('printdiv');"><img src="{{asset('/img/print-icon.svg')}}" title="print"></a>
            </div>
        </div>
    </div>
    <div class="m-portlet">
        <div id="printdiv">
            <form class="letter-form m-form" action="{{ route('sf_submit_application') }}" method="post" id="society-conveyance-application"
                enctype="multipart/form-data">
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
                            <span class="d-block">उपनिबंधक,</span>
                            <span class="d-block">सहकारी संस्था, सहकार कक्ष</span>
                            <span class="d-block">गृहनिर्माण भवन, बांद्रा (पूर्व), मुंबई - ५१.</span>
                        </p>
                    </div>
                </div>
                <!-- END: Subheader -->
                <div class="m-content letter-form-content">
                    <div class="letter-form-subject">
                        <p><span class="font-weight-semi-bold">विषय :- </span> <input class="letter-form-input" type="text"
                                id="" name="layout_name" value="{{ $sf_application->applicationLayout[0]->layout_name }}"
                                readonly> येथील <input class="letter-form-input" type="text" id="" name="society_name"
                                value="{{ $sf_application->societyApplication->name }}" readonly> सहकारी गृहनिर्माण
                            संस्था चे पंजीकरण करणेबाबत.</p>
                        <p class="font-weight-semi-bold">महोदय,</p>
                        <p>मुंबई मंडळाच्या <input class="letter-form-input" type="text" id="" name="layout_name" value="{{ $sf_application->applicationLayout[0]->layout_name }}"
                                readonly> या वसाहतीतील इमारत कर्‍मांक <input readonly class="letter-form-input" type="text"
                                id="" name="society_no" value="{{ $sf_application->societyApplication->building_no }}"
                                readonly> येथील गाळेधारकांना संस्थेचे नाव आरक्षण करण्यासाठी सादर केलेल्या
                            पर्‍स्थावानुसार आपले <input class="letter-form-input" type="text" id="" name="society_no"
                                value="{{ $sf_application->proposed_society_name }}" readonly> सहकारी गृहनिर्माण संस्था
                            असे मिळाले आहे. सादर सोसाटीचा संस्था पंजीकरणा पर्‍स्थाव योग्य त्या कागतपञासह पुढील
                            कार्यवाहीसाठी आपल्याकडे पाठवित आहोत. </p>

                    </div>
                    <div>
                        <div class="loader" style="display:none;"></div>
                        <p>सोबत :- </p>
                        @include('frontend.society.society_formation._application_attachments',compact('sf_documents','sf_application','disabled'))
                    </div>
                    <div class="letter-form-footer d-flex font-weight-semi-bold mt-5">
                        <div class="ml-auto text-right">
                            <p class="mb-5">
                                <span class="d-flex">
                                    आपला विश्वासू,
                                </span>
                            </p>
                            <p>
                                <span class="d-flex">
                                    मिळकत व्यवस्थापक - ४
                                </span>
                                <span class="d-flex">
                                    मुंबई मंडळ, मुंबई
                                </span>
                                {{-- <span class="d-flex">अध्यक्ष <input class="letter-form-input letter-form-input--xl"
                                        type="text" id="" name="" value=""></span>
                                <span class="d-flex mt-3">सचिव <input class="letter-form-input letter-form-input--xl"
                                        type="text" id="" name="" value=""></span> --}}
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
                            @if($disabled==0)
                            <a href="{{ route('society_formation.create') }}" class="btn btn-primary">
                                Back
                            </a>
                            <span style="float:right;margin-right: 20px">
                                <button type="submit" class="btn btn-primary">
                                    Submit Application
                                </button>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('css')
<style>
    .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('/img/loading-spinner-blue.gif') 50% 50% no-repeat rgb(249, 249, 249);
        opacity: .8;
    }

</style>
@endsection
@section('js')
<script>
    function PrintElem(elem) {
        $('.btn-link').css('display', 'none')
        $('.custom-file-label').css('display', 'none')
        $('input[type="file"]').css('display', 'none')
        var printable = document.getElementById(elem).innerHTML;

        var mywindow = window.open('', 'PRINT', 'height=400,width=600');

        mywindow.document.write('<html><head><title>Maharashtra Housing and development authority</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(printable);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus();

        mywindow.print();
        mywindow.close();
        $('.btn-link').css('display', 'block')
        $('.custom-file-label').css('display', 'block')
        $('input[type="file"]').css('display', 'block')
        return true;
    }

    function upload_attachment(id, number) {
        $(".loader").show();
        var master_document_id = document.getElementById('master_document_id_' + number).value;
        var document_status_id = document.getElementById('document_status_id_' + number).value;
        var sf_application_id = document.getElementById('sf_application_id').value;


        document.getElementById('sf_doc_error_' + number).value = "";
        var file_data = $('#' + id).prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('master_document_id', master_document_id);
        form_data.append('document_status_id', document_status_id);
        form_data.append('sf_application_id', sf_application_id);
        //console.log(form_data)
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        $.ajax({
            url: "{{url('upload_sf_application_attachment')}}", // point to server-side PHP script
            data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function (data) {
                $(".loader").hide();
                console.log(data)
                if (data.status == true) {
                    $("#uploaded_file_" + number).prop("href", data.file_path)
                    $("#uploaded_file_" + number).css("display", "block");
                    document.getElementById('document_status_id_' + number).value = data.doc_id
                    document.getElementById('sf_doc_error_' + number).innerHTML = "";
                } else {
                    document.getElementById(id).value = null;
                    document.getElementById('sf_doc_error_' + number).innerHTML = data.message;
                }
            }
        });
        showUploadedFileName();
    }

    function showUploadedFileName() {
        $('.custom-file-input').change(function (e) {
            $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
        });
    }

</script>
@endsection
