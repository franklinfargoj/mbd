@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.tripartite.actions',compact('sf_application'))
@endsection
@section('content')
@php 
    $disabled=isset($disabled)?$disabled:0;
@endphp
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">View Application</h3>
                {{ Breadcrumbs::render('tripartite_view_application',$ol_application->id) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                    <a href="?print=1" target="_blank" class="btn print-icon" rel="noopener"
                       ><img src="{{asset('/img/print-icon.svg')}}" title="print"></a>
                </div>
            </div>
        </div>
        <div class="m-portlet">
            <div id="printdiv">
                {{-- <form class="letter-form m-form" action="{{ route('society_conveyance.store') }}" method="post" id="society-conveyance-application" enctype="multipart/form-data"> --}}
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
                            <p style="margin-top: 0; margin-bottom: 60px;">Thanking You,</p>
                            <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Best Regards</p>
                            {{--<p style="display: block; margin-top: 5px; margin-bottom: 5px;">------- स.गृ.नि. संस्था मर्या.</p>--}}
                        </div>
                        </div>
                        <!-- <div class="letter-form-footer d-flex font-weight-semi-bold mt-5">
                            <div class="ml-auto text-right">
                                <p class="mb-5">Thanking You,</p>
                                <p>
                                <span class="d-flex">अध्यक्ष <input class="letter-form-input letter-form-input--xl"
                                                                    type="text" id="" name="" value="" readonly></span>
                                    <span class="d-flex mt-3">सचिव <input class="letter-form-input letter-form-input--xl"
                                                                          type="text" id="" name="" value="" readonly></span>
                                </p>
                            </div>
                        </div> -->
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
                                </span>
                                </div>
                            </div>
                        {{--@endif--}}
                    </div>
                {{-- </form> --}}
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
    background: url('/img/loading-spinner-blue.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>
@endsection
@section('js')
<script>
function upload_attachment(id,number)
{
    $(".loader").show();
     var master_document_id=document.getElementById('master_document_id_'+number).value;
     var document_status_id=document.getElementById('document_status_id_'+number).value;
     var sf_application_id=document.getElementById('sf_application_id').value;

     
         document.getElementById('sf_doc_error_'+number).value = "";
         var file_data = $('#'+id).prop('files')[0];
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
            success: function(data) {
                $(".loader").hide();
                console.log(data)
                if(data.status==true)
                {
                    $("#uploaded_file_"+number).prop("href", data.file_path)
                    $("#uploaded_file_"+number).css("display", "block");
                    document.getElementById('document_status_id_'+number).value=data.doc_id
                    document.getElementById('sf_doc_error_'+number).innerHTML = "";
                }else
                {
                    document.getElementById(id).value = null;
                    document.getElementById('sf_doc_error_'+number).innerHTML = data.message;
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