@extends('admin.layouts.app')
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
    //latest layout upload
    $("#latest_layout").change(function() {
        $(".loader").show();
        var file_data = $('#latest_layout').prop('files')[0];
        var form_data = new FormData();
        var architect_layout_detail_id=$('#architect_layout_detail_id').val();
        var field_name=$('#latest_layout_field_name').val();
        form_data.append('file', file_data);
        form_data.append('architect_layout_detail_id', architect_layout_detail_id);
        form_data.append('field_name', field_name);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        $.ajax({
            url: "{{url('uploadLatestLayoutAjax')}}", // point to server-side PHP script
            data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                $(".loader").hide();
                if(data.status==true)
                {
                    $("#latest_layout_file").prop("href", data.file_path)
                    $("#latest_layout_file").css("display", "block");
                    $("#latest_layout_error").html('');
                }else
                {
                    $("#latest_layout_error").html(data.message);
                    //console.log(data.status+" "+data.message)
                }
            }
        });
    });
    
    //old approved layout
    $("#old_approved_layout").change(function() {
        $(".loader").show();
        var file_data = $('#old_approved_layout').prop('files')[0];
        var form_data = new FormData();
        var architect_layout_detail_id=$('#architect_layout_detail_id').val();
        var field_name=$('#old_approved_layout_field_name').val();
        form_data.append('file', file_data);
        form_data.append('architect_layout_detail_id', architect_layout_detail_id);
        form_data.append('field_name', field_name);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        $.ajax({
            url: "{{url('uploadLatestLayoutAjax')}}", // point to server-side PHP script
            data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                $(".loader").hide();
                if(data.status==true)
                {
                    $("#old_approved_layout_file").prop("href", data.file_path)
                    $("#old_approved_layout_file").css("display", "block");
                    $("#old_approved_layout_error").html('');
                }else
                {
                    $("#old_approved_layout_error").html(data.message);
                    //console.log(data.status+" "+data.message)
                }
            }
        });
    });

    //last submitted layout for approval
    $("#last_submitted_layout").change(function() {
        $(".loader").show();
        var file_data = $('#last_submitted_layout').prop('files')[0];
        var form_data = new FormData();
        var architect_layout_detail_id=$('#architect_layout_detail_id').val();
        var field_name=$('#last_submitted_layout_field_name').val();
        form_data.append('file', file_data);
        form_data.append('architect_layout_detail_id', architect_layout_detail_id);
        form_data.append('field_name', field_name);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        $.ajax({
            url: "{{url('uploadLatestLayoutAjax')}}", // point to server-side PHP script
            data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                $(".loader").hide();
                if(data.status==true)
                {
                    $("#last_submitted_layout_file").prop("href", data.file_path)
                    $("#last_submitted_layout_file").css("display", "block");
                    $("#last_submitted_layout_file_error").html('');
                }else
                {
                    $("#last_submitted_layout_file_error").html(data.message);
                    //console.log(data.status+" "+data.message)
                }
            }
        });
    });

    //survey report
    $("#survey_report").change(function() {
        $(".loader").show();
        var file_data = $('#survey_report').prop('files')[0];
        var form_data = new FormData();
        var architect_layout_detail_id=$('#architect_layout_detail_id').val();
        var field_name=$('#survey_report_field_name').val();
        form_data.append('file', file_data);
        form_data.append('architect_layout_detail_id', architect_layout_detail_id);
        form_data.append('field_name', field_name);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        $.ajax({
            url: "{{url('uploadLatestLayoutAjax')}}", // point to server-side PHP script
            data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                $(".loader").hide();
                if(data.status==true)
                {
                    $("#survey_report_file").prop("href", data.file_path)
                    $("#survey_report_file").css("display", "block");
                    $("#survey_report_file_error").html('');
                }else
                {
                    $("#survey_report_file_error").html(data.message);
                    //console.log(data.status+" "+data.message)
                }
            }
        });
    });

});

 $(document).ready(function () { 
    $('.add_ee_report').click(function () {
        var count=$(".optionBoxEE > div").length;
        count++;
        $('.blockEE:last').after(
            '<div class="blockEE">'+
                '<div class="form-group m-form__group row mb-0">'+
                    '<div class="col-lg-5 form-group">'+
                        '<input placeholder="Document Name" type="text" name="ee_document_name[]" class="form-control form-control--custom"'+
                        '<span class="help-block"></span>'+
                    '</div>'+
                    '<div class="col-lg-5 form-group">'+
                        '<div class="custom-file">'+
                            '<input type="file" id="extract_'+count+'" name="ee_report[]" class="custom-file-input">'+
                            '<label title="" class="custom-file-label" for="extract_'+count+'">Choose file</label>'+
                            '<span class="help-block"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-lg-2 form-group mt-2">'+
                    '<i class="fa fa-close btn--add-delete removeEE"></i>'+
                    '</div>'+
                '</div>'+
            '</div>');
        $('.m-bootstrap-select').selectpicker('refresh');
        showUploadedFileName();
    });

    function showUploadedFileName() {
        $('.custom-file-input').change(function (e) {
            $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
        });
    }

    $('.optionBoxEE').on('click', '.removeEE', function () {
        $(this).parent().parent().remove();
    });
});
</script>
@endsection
@section('content')
<div class="loader" style="display:none;"></div>
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Add Detail -
                {{$ArchitectLayoutDetail->architect_layout->layout_name}}</h3>
        </div>
    </div>
    <form id="upload_latest_layout" method="post" enctype="multipart/form-data">
        <input type="hidden" id="architect_layout_detail_id" name="architect_layout_detail_id" value="{{$ArchitectLayoutDetail->id}}">
        @csrf
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                    <div class="m-subheader">
                        <div class="d-flex align-items-center">
                            <h3 class="section-title section-title--small">
                                Latest Layout:
                            </h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="custom-file">
                                    <input type="hidden" id="latest_layout_field_name" id="latest_layout_field_name"
                                        value="latest_layout">
                                    <input class="custom-file-input" name="latest_layout" type="file" id="latest_layout"
                                        required="">
                                    <label class="custom-file-label" for="latest_layout">Choose file...</label>
                                </div>
                            </div>
                            <a target="_blank" id="latest_layout_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->latest_layout}}"
                                style="display:{{$ArchitectLayoutDetail->latest_layout!=''?'block':'none'}};">uploaded
                                file</a>
                        </div>
                        <span class="text-danger" id="latest_layout_error"></span>
                        <!-- <div class="mt-auto">
                            <button type="submit" style="btn btn-primary" class="btn btn-primary btn-custom upload_note"
                                id="uploadBtn">Upload</button>
                        </div> -->
                    </div>
                    <div class="m-subheader">
                        <div class="d-flex align-items-center">
                            <h3 class="section-title section-title--small">
                                Old Approved Layout:
                            </h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="custom-file">
                                    <input type="hidden" id="old_approved_layout_field_name" id="old_approved_layout_field_name"
                                        value="old_approved_layout">
                                    <input class="custom-file-input" type="file" id="old_approved_layout" name="old_approved_layout">
                                    <label class="custom-file-label" for="old_approved_layout">Choose file...</label>
                                </div>
                            </div>
                            <a target="_blank" id="old_approved_layout_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->old_approved_layout}}"
                                style="display:{{$ArchitectLayoutDetail->old_approved_layout!=''?'block':'none'}};">uploaded
                                file</a>
                        </div>
                        <span class="text-danger" id="old_approved_layout_error"></span>
                        <!-- <div class="mt-auto">
                            <button type="submit" style="btn btn-primary" class="btn btn-primary btn-custom upload_note"
                                id="uploadBtn">Upload</button>
                        </div> -->
                    </div>
                    <div class="m-subheader">
                        <div class="d-flex align-items-center">
                            <h3 class="section-title section-title--small">
                                Last submitted layout for approval:
                            </h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="custom-file">
                                    <input type="hidden" id="last_submitted_layout_field_name" id="last_submitted_layout_field_name"
                                        value="last_submitted_layout_for_approval">
                                    <input class="custom-file-input" name="last_submitted_layout" type="file" id="last_submitted_layout"
                                        required="">
                                    <label class="custom-file-label" for="last_submitted_layout">Choose file...</label>
                                </div>
                            </div>
                            <a target="_blank" id="last_submitted_layout_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->last_submitted_layout_for_approval}}"
                                style="display:{{$ArchitectLayoutDetail->last_submitted_layout_for_approval!=''?'block':'none'}};">uploaded
                                file</a>
                        </div>
                        <span class="text-danger" id="last_submitted_layout_file_error"></span>
                        <!-- <div class="mt-auto">
                            <button type="submit" style="btn btn-primary" class="btn btn-primary btn-custom upload_note"
                                id="uploadBtn">Upload</button>
                        </div> -->
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
                                CTS plan
                            </h3>
                        </div>
                        <div class="mt-auto">
                            <a href="{{route('architect_layout_detail_cts_plan',['layout_detail_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                                class="btn btn-primary btn-custom upload_note" id="uploadBtn">Add CTS Detail</a>
                        </div>
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
                                PRC
                            </h3>
                        </div>
                        <div class="mt-auto">
                            <a href="{{route('architect_layout_detail_prc_detail',['layout_detail_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                                class="btn btn-primary btn-custom upload_note" id="uploadBtn">Add PRC Detail</a>
                        </div>
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
                                DP remark, CRZ remark and other
                            </h3>
                        </div>
                        <div class="mt-auto">
                            <a href="{{route('add_architect_detail_dp_crz_remark_add',['layout_detail_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                                class="btn btn-primary btn-custom upload_note" id="uploadBtn">Add Detail</a>
                        </div>
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
                                Survey report:
                            </h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="custom-file">
                                    <input type="hidden" id="survey_report_field_name" id="survey_report_field_name"
                                        value="survey_report">
                                    <input class="custom-file-input" name="survey_report" type="file" id="survey_report"
                                        required="">
                                    <label class="custom-file-label" for="survey_report">Choose file...</label>
                                </div>
                            </div>
                            <a target="_blank" id="survey_report_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->latest_layout}}"
                                style="display:{{$ArchitectLayoutDetail->survey_report!=''?'block':'none'}};">uploaded
                                file</a>
                        </div>
                        <span class="text-danger" id="survey_report_file_error"></span>
                        <!-- <div class="mt-auto">
                            <button type="submit" style="btn btn-primary" class="btn btn-primary btn-custom upload_note"
                                id="uploadBtn">Upload</button>
                        </div> -->
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
                                Executive Engineering report
                            </h3>
                        </div>
                        <div class="optionBoxEE">
                            <div class="blockEE">
                                <div class="form-group m-form__group row mb-0">
                                    <div class="col-lg-5 form-group">
                                        <input type="hidden" class="ee_doc_name" name="document_name[]" value="Area certificate">
                                        <label>Area certificate</label>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="col-lg-5 form-group">
                                        <div class="custom-file">
                                            <input type="file" id="extract" name="ee_report[]" class="custom-file-input">
                                            <label title="" class="custom-file-label" for="extract">Choose file</label>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-2 form-group mt-2">
                                    <i class="fa fa-close btn--add-delete" id=""></i>
                                </div> -->
                                </div>
                            </div>
                            <div class="blockEE">
                                <div class="form-group m-form__group row mb-0">
                                    <div class="col-lg-5 form-group">
                                        <input type="hidden" class="ee_doc_name" name="document_name[]" value="Area of Encroachmente">
                                        <label>Area of Encroachment</label>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="col-lg-5 form-group">
                                        <div class="custom-file">
                                            <input type="file" id="extract_1" name="ee_report[]" class="custom-file-input">
                                            <label title="" class="custom-file-label" for="extract_1">Choose file</label>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-2 form-group mt-2">
                                    <i class="fa fa-close btn--add-delete" id=""></i>
                                </div> -->
                                </div>
                            </div>
                            <div class="blockEE">
                                <div class="form-group m-form__group row mb-0">
                                    <div class="col-lg-5 form-group">
                                        <input type="hidden" class="ee_doc_name" name="document_name[]" value="Heading Over reservation">
                                        <label>Heading Over reservation</label>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="col-lg-5 form-group">
                                        <div class="custom-file">
                                            <input type="file" id="extract_2" name="ee_report[]" class="custom-file-input ee_doc_file">
                                            <label title="" class="custom-file-label" for="extract_2">Choose file</label>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-2 form-group mt-2">
                                    <i class="fa fa-close btn--add-delete" id=""></i>
                                </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <a class="btn--add-delete add_ee_report">add more </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
