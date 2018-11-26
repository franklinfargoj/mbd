@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.formation.actions',compact('sf_application'))
@endsection
@section('content')
@php 
    $disabled=isset($disabled)?$disabled:0;
@endphp
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Documents submitted by Society</h3>
                {{ Breadcrumbs::render('sf_documents',$sf_application->id) }}
                <div class="ml-auto btn-list">
                    <a href="{{ route('society_conveyance.index') }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                    <a href="#" target="_blank" id="download_application_form" class="btn print-icon" rel="noopener"
                       onclick="printContent('printdiv')"><img src="{{asset('/img/print-icon.svg')}}" title="print"></a>
                </div>
            </div>
        </div>
        <div class="m-portlet">
            <div id="printdiv">
                <form class="letter-form m-form" action="{{ route('sf_submit_application') }}" method="post" id="society-conveyance-application" enctype="multipart/form-data">
                @csrf
                <!-- BEGIN: Subheader -->
                   
                    <!-- END: Subheader -->
                    <div class="m-content letter-form-content">
                       
                        <div>
                            <div class="loader" style="display:none;"></div>
                            {{-- <p>सोबत :- </p> --}}
                            @include('frontend.society.society_formation._application_attachments',compact('sf_documents','sf_application','disabled'))
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
                                <a href="{{ route('society_conveyance.edit', base64_encode($sf_application->id)) }}" class="btn btn-primary">
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