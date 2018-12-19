@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.tripartite.actions',compact('ol_application'))
@endsection
@section('content')
@php
$disabled=isset($disabled)?$disabled:0;
@endphp
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Tripartite Agreement</h3>
            {{ Breadcrumbs::render('tripartite_agreement',$ol_application->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                {{-- <a href="?print=1" target="_blank" class="btn print-icon" rel="noopener"><img src="{{asset('/img/print-icon.svg')}}"
                        title="print"></a> --}}
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            Society Details:
                        </h3>
                    </div>
                    <div class="row field-row">
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Application Number:</span>
                                <span class="field-value">{{ $ol_application->application_no }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Application Date:</span>
                                <span class="field-value">{{ date(config('commanConfig.dateFormat'),
                                    strtotime($ol_application->submitted_at)) }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Society Name:</span>
                                <span class="field-value">{{
                                    $ol_application->eeApplicationSociety->name }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Society Address:</span>
                                <span class="field-value">{{
                                    $ol_application->eeApplicationSociety->address }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Building Number:</span>
                                <span class="field-value">{{
                                    $ol_application->eeApplicationSociety->building_no }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            Appointed Architect Details:
                        </h3>
                    </div>
                    <div class="row field-row">
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Name of Architect:</span>
                                <span class="field-value">{{
                                    $ol_application->eeApplicationSociety->name_of_architect }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Mobile Number:</span>
                                <span class="field-value">{{
                                    $ol_application->eeApplicationSociety->architect_mobile_no }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Address:</span>
                                <span class="field-value">{{
                                    $ol_application->eeApplicationSociety->architect_address }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Telephone Number:</span>
                                <span class="field-value">{{
                                    $ol_application->eeApplicationSociety->architect_telephone_no }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body" style="padding-right: 0;">
            @if($societyData['ree_Jr_id'] && $applicationLog->status_id
            !=config('commanConfig.applicationStatus.forwarded') && ($stamped_by_society!=1 && $approved_by_co!=1))
            <h3 class="section-title section-title--small mb-0">Tripartite Agreement:</h3>
            <div class=" row-list">
                <div class="row">
                    <div class="col-md-12">
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Edit Agrrement</a>
                        <!-- <button type="submit">Edit offer Letter </button> -->
                    </div>
                </div>
            </div>
            @endif
            <div class="w-100 row-list">
                <div class="">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="d-flex flex-column h-100">
                                <h5>Download Tripartite Agreement</h5>
                                <div class="mt-auto">

                                    @if($tripartite_agrement['drafted_tripartite_agreement'])
                                    <a target="_blank" href="{{config('commanConfig.storage_server').'/'.$tripartite_agrement['drafted_tripartite_agreement']->society_document_path}}"
                                        class="btn btn-primary">Download</a>
                                    @else
                                    <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                        * Note : Offer Letter not available. </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(($societyData['ree_Jr_id'] && $applicationLog->status_id
                        !=config('commanConfig.applicationStatus.forwarded') || $stamped_and_signed!=1 && $approved_by_co!=1) || (($stamped_by_society==1 || $approved_by_co==1) && session()->get('role_name')==config('commanConfig.co_engineer') && $applicationLog->status_id
                        !=config('commanConfig.applicationStatus.forwarded')) )
                        <div class="col-sm-6 border-left">
                            <div class="d-flex flex-column h-100">
                                <h5>Upload Signed & scanned Tripartite Agreement</h5>
                                <form action="{{route('upload_signed_tripartite_agreement')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="applicationId" name="applicationId" value="{{ $ol_application->id }}">
                                    <div class="custom-file">
                                        <input class="custom-file-input pdfcheck" name="signed_agreement" type="file"
                                            id="test-upload" required="required">
                                        <label class="custom-file-label" for="test-upload">Choose
                                            file...</label>
                                        <span class="text-danger" id="file_error"></span>
                                    </div>
                                    <div class="mt-auto">
                                        <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($tripatiet_remark_history)>0)
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body">
            <h3 class="section-title section-title--small">Remarks on Tripartite Agreement </h3>
            <div class="remark-body">
                <div class="remarks-section">
                    @foreach($tripatiet_remark_history as $history)
                    {{-- <div class="card">
                        <div class="card-header">
                            {{config('commanConfig.la_engineer')==$history->Roles->name?'Riders By':'Remark By'}} 
                            {{ isset($history->Roles->display_name) ? $history->Roles->display_name : '' }}
                        </div>
                        <div class="card-body">
                          <p class="card-text">{{ isset($history->remark)? $history->remark : '' }}</p>
                        </div>
                    </div> --}}
                    <div class="m-scrollable m-scroller ps ps--active-y remarks-section-container" data-scrollbar-shown="true"
                        data-scrollable="true" data-max-height="150">
                        <div class="remarks-section__data">
                        <p class="remarks-section__data__row"><span>{{config('commanConfig.la_engineer')==$history->Roles->name?'Riders By':'Remark By'}} {{
                                    isset($history->Roles->display_name) ? $history->Roles->display_name : '' }}
                        </p>
                        <p class="">
                       
                        <span>{{ isset($history->remark)? $history->remark : '' }}</span>
                        </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    @if((session()->get('role_name')==config('commanConfig.ree_junior') || session()->get('role_name')==config('commanConfig.co_engineer') || session()->get('role_name')==config('commanConfig.la_engineer')) && $applicationLog->status_id
    !=config('commanConfig.applicationStatus.forwarded'))
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body">
            @if(session()->get('role_name')==config('commanConfig.la_engineer'))
            <h3 class="section-title section-title--small">Riders</h3>
            @else
            <h3 class="section-title section-title--small">Remark</h3>
            @endif
            <div class="col-xs-12 row">
                <div class="col-md-12">
                    <form action="{{route('tripartite.setTripartiteRemark')}}" method="POST">
                        @csrf
                        <input type="hidden" id="applicationId" name="applicationId" value="{{ $ol_application->id }}">
                        <textarea rows="4" cols="63" name="remark"></textarea>
                        <button type="submit" class="btn btn-primary mt-3" style="display:block">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- <div class="m-portlet">
        <div id="printdiv">
            <form class="letter-form m-form" action="" method="post" id="society-conveyance-application" enctype="multipart/form-data">
                @csrf

            </form>
        </div>
    </div> --}}
</div>


<div class="modal modal-large fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agreement</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="" action="{{route('saveTripartiteagreement')}}" method="POST">
                    @csrf
                    <input type="hidden" id="applicationId" name="applicationId" value="{{ $ol_application->id }}">
                    {{-- <input type="hidden" id="document_id" name="text_document_id" value="{{ $no_dues_certificate_docs['text_no_dues_certificate']->id }}">
                    <input type="hidden" id="document_id" name="pdf_document_id" value="{{ $no_dues_certificate_docs['drafted_no_dues_certificate']->id }}">
                    --}}
                    <textarea id="ckeditorText" name="ckeditorText" style="display: none;">
                            @if(!empty($content))
                                @php echo $content; @endphp
                            @else
                                <div style="" id="">
                                    <h3>Agreement</h3>
                                </div>
                            @endif
                                </textarea>
                    <input type="submit" value="save" style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
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
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.replace('ckeditorText', {
        height: 700,
        allowedContent: true
    });

</script>
<script>
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
