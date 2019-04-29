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
                    {{--<a href="?print=1" target="_blank" class="btn print-icon" rel="noopener"--}}
                       {{--><img src="{{asset('/img/print-icon.svg')}}" title="print"></a>--}}
                </div>
            </div>
        </div>
        @if($ol_applications->application_path)
            <iframe src="{{ config('commanConfig.storage_server').'/'.$ol_applications->application_path }}" width="1000" height="600"></iframe>
        @endif
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