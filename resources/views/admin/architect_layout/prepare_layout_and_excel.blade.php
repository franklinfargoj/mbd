@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.architect_layout.actions',compact('ArchitectLayout'))
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
    $(document).ready(function(){
    //layout upload ind pdf
    $("#layout_in_pdf_format").change(function() {
        $(".loader").show();
        var file_data = $('#layout_in_pdf_format').prop('files')[0];
        var form_data = new FormData();
        var field_name=$('#layout_in_pdf_field_name').val();
        var architect_layout_id=$('#architect_layout_id').val();
        form_data.append('file', file_data);
        form_data.append('architect_layout_id', architect_layout_id);
        form_data.append('field_name', field_name);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        $.ajax({
            url: "{{url('uploadLayoutandExcelAjax')}}", // point to server-side PHP script
            data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                //console.log(data)
                $(".loader").hide();
                if(data.status==true)
                {
                    $("#upload_layout_in_pdf_format_file").prop("href", data.file_path)
                    $("#upload_layout_in_pdf_format_file").css("display", "block");
                    $("#upload_layout_in_pdf_format_error").html('');
                    $('.custom-file-label').html('Choose file...');
                }else
                {
                    $("#upload_layout_in_pdf_format_error").html(data.message);
                    $('.custom-file-label').html('Choose file...');
                    //console.log(data.status+" "+data.message)
                }
            }
        });
    });

    //layout upload ind excel
    $("#layout_in_excel_format").change(function() {
        $(".loader").show();
        var file_data = $('#layout_in_excel_format').prop('files')[0];
        var form_data = new FormData();
        var field_name=$('#layout_in_excel_field_name').val();
        var architect_layout_id=$('#architect_layout_id').val();
        form_data.append('file', file_data);
        form_data.append('architect_layout_id', architect_layout_id);
        form_data.append('field_name', field_name);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        $.ajax({
            url: "{{url('uploadLayoutandExcelAjax')}}", // point to server-side PHP script
            data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                //console.log(data)
                $(".loader").hide();
                if(data.status==true)
                {
                    $("#upload_layout_in_excel_format_file").prop("href", data.file_path)
                    $("#upload_layout_in_excel_format_file").css("display", "block");
                    $("#upload_layout_in_excel_format_file_display").css("display", "block");
                    $("#upload_layout_in_excel_format_error").html('');
                    $('.custom-file-label').html('Choose file...');
                }else
                {
                    $('.custom-file-label').html('Choose file...');
                    $("#upload_layout_in_excel_format_error").html(data.message);
                    //console.log(data.status+" "+data.message)
                }
            }
        });
    });

    //upload architect note
    $("#upload_architect_note").change(function() {
        $(".loader").show();
        var file_data = $('#upload_architect_note').prop('files')[0];
        var form_data = new FormData();
        var field_name=$('#architect_note_field_name').val();
        var architect_layout_id=$('#architect_layout_id').val();
        form_data.append('file', file_data);
        form_data.append('architect_layout_id', architect_layout_id);
        form_data.append('field_name', field_name);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        $.ajax({
            url: "{{url('uploadLayoutandExcelAjax')}}", // point to server-side PHP script
            data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                //console.log(data)
                $(".loader").hide();
                if(data.status==true)
                {
                    $("#upload_architect_note_file").prop("href", data.file_path)
                    $("#upload_architect_note_file").css("display", "block");
                    $("#upload_architect_note_display").css("display", "block");
                    $("#upload_architect_note_error").html('');
                    $('.custom-file-label').html('Choose file...');
                }else
                {
                    $("#upload_architect_note_error").html(data.message);
                    $('.custom-file-label').html('Choose file...');
                    //console.log(data.status+" "+data.message)
                }
            }
        });
    });
});
</script>
@endsection
@section('content')
<div class="loader" style="display:none;"></div>
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Prepare Layout & Excel -
                {{$ArchitectLayout->layout_name}}</h3>
                {{ Breadcrumbs::render('architect_layout_prepare_layout_excel',$ArchitectLayout->id) }}
        </div>
    </div>
    <form>
            @php $status=getLastStatusIdArchitectLayout($ArchitectLayout->id); @endphp
        <input type="hidden" id="architect_layout_id" name="architect_layout_id" value="{{$ArchitectLayout->id}}">
        @csrf
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                    <div class="m-subheader">
                        {{-- <div class="d-flex align-items-center">
                            <h3 class="section-title section-title--small">
                                Layout
                            </h3>
                        </div> --}}
                        <h4 class="section-title section-title--small">
                            @if($ArchitectLayout->upload_layout_in_pdf_format!='')
                            Download Layout in PDF format
                            @else
                            Upload Layout in PDF format
                            @endif
                        </h4>
                        <div class="row">
                            @if(session()->get('role_name')==config('commanConfig.junior_architect') && ($status->status_id!=config('commanConfig.architect_layout_status.approved') && $status->status_id!=config('commanConfig.architect_layout_status.forward')))
                            <div class="col-sm-6">
                                {{-- <p> Click 'Choose File' to upload Layout</p>

                                <p> Upload a file here in Autocad format</p> --}}
                                <div class="custom-file">
                                    <input type="hidden" id="layout_in_pdf_field_name" value="layout_in_pdf">
                                    <input class="custom-file-input" name="layout_in_pdf_format" type="file" id="layout_in_pdf_format"
                                        required="">
                                    <label class="custom-file-label" for="layout_in_pdf_format">Choose file...</label>
                                </div>
                            </div>
                            @endif
                            <div class="col-sm-6"  style="">
                                    <a target="_blank" id="upload_layout_in_pdf_format_file" class="btn btn-primary col-md-6" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayout->upload_layout_in_pdf_format}}"
                                        style="display:{{$ArchitectLayout->upload_layout_in_pdf_format!=''?'block':'none'}};">Download
                                        Layout</a>
                            </div>
                        </div>
                        
                        <span class="text-danger" id="upload_layout_in_pdf_format_error"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                    <div class="m-subheader">
                        <div class="d-flex align-items-center">
                            <h3 class="section-title section-title--small">
                                    {{$ArchitectLayout->upload_layout_in_excel_format!=''?'Download':'Upload'}} Excel
                            </h3>
                        </div>

                        <div class="row">
                            @if(session()->get('role_name')==config('commanConfig.junior_architect') && ($status->status_id!=config('commanConfig.architect_layout_status.approved') && $status->status_id!=config('commanConfig.architect_layout_status.forward')))
                            <div class="col-sm-6">
                                {{-- <h4 class="section-title section-title--small">
                                    Upload Excel
                                </h4> --}}
                                {{-- <p> Click 'Choose File' to upload Excel</p>

                                <p> Upload a file here in .excel format</p> --}}
                                <div class="custom-file">
                                    <input type="hidden" id="layout_in_excel_field_name" value="layout_in_excel">
                                    <input class="custom-file-input" name="layout_in_excel_format" type="file" id="layout_in_excel_format"
                                        required="">
                                    <label class="custom-file-label" for="layout_in_excel_format">Choose file...</label>
                                </div>
                            </div>
                            @endif
                            <div class="col-sm-6" id="upload_layout_in_excel_format_file_display" style="display:{{$ArchitectLayout->upload_layout_in_excel_format!=''?'block':'none'}}">
                                {{-- <h4 class="section-title section-title--small">
                                    Download
                                </h4> --}}
                                {{-- <p> Click 'Download Excel reprot' to download & view</p> --}}
                                <a target="_blank" id="upload_layout_in_excel_format_file" class="btn btn-primary col-md-6"
                                    href="{{config('commanConfig.storage_server').'/'.$ArchitectLayout->upload_layout_in_excel_format}}">Download
                                    Excel Report</a>
                            </div>
                        </div>

                        <span class="text-danger" id="upload_layout_in_excel_format_error"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                    <div class="m-subheader">
                        <div class="d-flex align-items-center">
                            <h3 class="section-title section-title--small">
                                    {{$ArchitectLayout->upload_architect_note!=''?'Download':'Upload'}} Architect Note
                            </h3>
                        </div>

                        <div class="row">
                            @if(session()->get('role_name')==config('commanConfig.junior_architect') && ($status->status_id!=config('commanConfig.architect_layout_status.approved') && $status->status_id!=config('commanConfig.architect_layout_status.forward')))
                            <div class="col-sm-6">
                                {{-- <h4 class="section-title section-title--small">
                                    Upload Note
                                </h4> --}}
                                {{-- <p> Click 'Choose File' to upload Note</p>

                                <p> Upload a file here in .excel format</p> --}}
                                <div class="custom-file">
                                    <input type="hidden" id="architect_note_field_name" value="upload_architect_note">
                                    <input class="custom-file-input" name="upload_architect_note" type="file" id="upload_architect_note"
                                        required="">
                                    <label class="custom-file-label" for="upload_architect_note">Choose file...</label>
                                </div>
                            </div>
                            @endif
                            <div class="col-sm-6" id="upload_architect_note_display" style="display:{{$ArchitectLayout->upload_architect_note!=''?'block':'none'}}">
                                {{-- <h4 class="section-title section-title--small">
                                    Download
                                </h4> --}}
                                {{-- <p> Click 'Download Note' to download & view</p> --}}
                                <a target="_blank" id="upload_architect_note_file" class="btn btn-primary col-md-6"
                                    href="{{config('commanConfig.storage_server').'/'.$ArchitectLayout->upload_architect_note}}">Download
                                    Excel Report</a>
                            </div>
                        </div>

                        <span class="text-danger" id="upload_architect_note_error"></span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
