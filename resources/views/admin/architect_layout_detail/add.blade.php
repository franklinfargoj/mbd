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
    function scrollToElement(ele) {
        $(window).scrollTop(ele.offset().top - 75).scrollLeft(ele.offset().left);
    }
    var layoutUploadElement = $(window.location.hash);
    scrollToElement(layoutUploadElement);


    //add dp remark
    
    // $('#dp_remark_form').validate({
    //     rules:{
    //         "dp_remark_letter":{
    //             required:true,
    //             extension: "pdf|doc|docx",
    //         },
    //         "dp_remark_plan":{
    //             required:true,
    //             extension: "pdf|doc|docx",
    //         },
    //         "dp_comment":"required",
    //         // "crz_remark_letter[]":{
    //         //     required:true,
    //         //     extension: "pdf|doc|docx",
    //         // },
    //         // "crz_remark_plan[]":{
    //         //     required:true,
    //         //     extension: "pdf|doc|docx",
    //         // },
    //         // "crz_comment":"required"
    //     }
    // });

    
    $("#crz_remark_form").validate({
        rules:{
            "crz_remark_letter":{
                required:true,
                extension: "pdf|doc|docx",
            },
            "crz_remark_plan":{
                required:true,
                extension: "pdf|doc|docx",
            },
            "crz_comment":"required",
        },
        submitHandler: function(form) {
            return true;
        }
    });

    

    $("#dp_remark_form").validate({
        rules:{
            "dp_remark_letter":{
                required:true,
                extension: "pdf|doc|docx",
            },
            "dp_remark_plan":{
                required:true,
                extension: "pdf|doc|docx",
            },
            "dp_comment":"required",
        },
        submitHandler: function(form) {
            return true;
            // var form_data = new FormData();
            // var architect_layout_detail_id=$('#architect_layout_detail_id').val();
            // var dp_comment=$('#dp_comment').val();
            // var dp_remark_letter = $('#dp_remark_letter_file').prop('files')[0];
            // form_data.append('dp_remark_letter', dp_remark_letter);
            // form_data.append('architect_layout_detail_id', architect_layout_detail_id);
            // form_data.append('dp_comment', dp_comment);
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-Token': '{{csrf_token()}}'
            //         }
            //     });
            //     $.ajax({
            //     type: "POST",           
            //     url: "{{route('post_architect_detail_dp_crz_remark_add')}}", 
            //    // dataType : 'json',
            //     data: form_data,
            //    // mimeType: "multipart/form-data",
            //     cache: false,             
            //     processData: false,
                      
            //     success: function(data) {
            //         console.log(data)
            //         //$('#loading').hide();
            //         //$("#message").html(data);
            //     }
            // });
        }
    });
 

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
                    if(!$("#latest-layout-tab").hasClass('filled'))
                    {
                        $("#latest-layout-tab").addClass('filled');
                    }
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
                    if(!$("#old-approved-layout-tab").hasClass('filled'))
                    {
                        $("#old-approved-layout-tab").addClass('filled');
                    }
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
                    if(!$("#last-submitted-layout-for-approval-tab").hasClass('filled'))
                    {
                        $("#last-submitted-layout-for-approval-tab").addClass('filled');
                    }
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
                    if(!$("#survey-report-tab").hasClass('filled'))
                    {
                        $("#survey-report-tab").addClass('filled');
                    }
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

//EE report add and delete

 $(document).ready(function () { 
    $('.add_ee_report').click(function () {
        var count=$(".optionBoxEE > div").length;
        count++;
        $('.blockEE:last').after(
            '<div class="blockEE">'+
                '<div class="form-group m-form__group row mb-0">'+
                    '<div class="col-lg-4 form-group">'+
                        '<input placeholder="Document Name" type="text" id="ee_doc_name_'+count+'" name="ee_document_name[]" class="form-control form-control--custom">'+
                        '<input type="hidden" id="ee_report_doc_id_'+count+'" value="">'+
                        '<span class="help-block"></span>'+
                    '</div>'+
                    '<div class="col-lg-4 form-group">'+
                        '<div class="custom-file">'+
                            '<input type="file" id="ee_extract_'+count+'" name="ee_report_'+count+'" class="custom-file-input" onchange="getEEReportData(this.id,\'ee_doc_name_'+count+'\',\'ee_doc_error_'+count+'\',\'ee_report_uploaded_file_'+count+'\',\'ee_report_doc_id_'+count+'\',true)">'+
                            '<label title="" class="custom-file-label" for="ee_extract_'+count+'">Choose file</label>'+
                            '<a class="btn-link" target="_blank" style="display:none;" id="ee_report_uploaded_file_'+count+'" href="">download</a>'+
                            '<span class="text-danger" id="ee_doc_error_'+count+'"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-lg-2 form-group mt-2">'+
                    '<i class="fa fa-close btn--remove-delete removeEE" id="delete_ee_doc_'+count+'" onclick="delete_ee_doc(\'ee_report_doc_id_'+count+'\',\'delete_ee_doc_'+count+'\')"></i>'+
                    '</div>'+
                '</div>'+
            '</div>');
        $('.m-bootstrap-select').selectpicker('refresh');
        showUploadedFileName();
    });

    // function showUploadedFileName() {
    //     $('.custom-file-input').change(function (e) {
    //         $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
    //     });
    // }

    $('.optionBoxEE').on('click', '.removeEE', function () {
            $(this).parent().parent().remove();
    });

//Em report add and delete
$('.add_em_report').click(function () {
        var count=$(".optionBoxEM > div").length;
        count++;
        $('.blockEM:last').after(
            '<div class="blockEM">'+
                '<div class="form-group m-form__group row mb-0">'+
                    '<div class="col-lg-4 form-group">'+
                        '<input placeholder="Document Name" type="text" id="em_doc_name_'+count+'" name="em_document_name[]" class="form-control form-control--custom">'+
                        '<input type="hidden" id="em_report_doc_id_'+count+'" value="">'+
                        '<span class="help-block"></span>'+
                    '</div>'+
                    '<div class="col-lg-4 form-group">'+
                        '<div class="custom-file">'+
                            '<input type="file" id="em_extract_'+count+'" name="em_report_'+count+'" class="custom-file-input" onchange="getEMReportData(this.id,\'em_doc_name_'+count+'\',\'em_doc_error_'+count+'\',\'em_report_uploaded_file_'+count+'\',\'em_report_doc_id_'+count+'\',true)">'+
                            '<label title="" class="custom-file-label" for="em_extract_'+count+'">Choose file</label>'+
                            '<a class="btn-link" target="_blank" style="display:none;" id="em_report_uploaded_file_'+count+'" href="">download</a>'+
                            '<span class="text-danger" id="em_doc_error_'+count+'"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-lg-2 form-group mt-2">'+
                    '<i class="fa fa-close btn--remove-delete removeEM" id="delete_em_doc_'+count+'" onclick="delete_em_doc(\'em_report_doc_id_'+count+'\',\'delete_em_doc_'+count+'\')"></i>'+
                    '</div>'+
                '</div>'+
            '</div>');
        $('.m-bootstrap-select').selectpicker('refresh');
        showUploadedFileName();
    });

    // function showUploadedFileName() {
    //     $('.custom-file-input').change(function (e) {
    //         $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
    //     });
    // }

    $('.optionBoxEM').on('click', '.removeEM', function () {
            $(this).parent().parent().remove();
    });
    
    //REE report add and delete
$('.add_ree_report').click(function () {
        var count=$(".optionBoxREE > div").length;
        count++;
        $('.blockREE:last').after(
            '<div class="blockREE">'+
                '<div class="form-group m-form__group row mb-0">'+
                    '<div class="col-lg-4 form-group">'+
                        '<input placeholder="Document Name" type="text" id="ree_doc_name_'+count+'" name="ree_document_name[]" class="form-control form-control--custom">'+
                        '<input type="hidden" id="ree_report_doc_id_'+count+'" value="">'+
                        '<span class="help-block"></span>'+
                    '</div>'+
                    '<div class="col-lg-4 form-group">'+
                        '<div class="custom-file">'+
                            '<input type="file" id="ree_extract_'+count+'" name="ree_report_'+count+'" class="custom-file-input" onchange="getREEReportData(this.id,\'ree_doc_name_'+count+'\',\'ree_doc_error_'+count+'\',\'ree_report_uploaded_file_'+count+'\',\'ree_report_doc_id_'+count+'\',true)">'+
                            '<label title="" class="custom-file-label" for="ree_extract_'+count+'">Choose file</label>'+
                            '<a class="btn-link" target="_blank" style="display:none;" id="ree_report_uploaded_file_'+count+'" href="">download</a>'+
                            '<span class="text-danger" id="ree_doc_error_'+count+'"></span>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-lg-2 form-group mt-2">'+
                    '<i class="fa fa-close btn--remove-delete removeREE" id="delete_ree_doc_'+count+'" onclick="delete_ree_doc(\'ree_report_doc_id_'+count+'\',\'delete_ree_doc_'+count+'\')"></i>'+
                    '</div>'+
                '</div>'+
            '</div>');
        $('.m-bootstrap-select').selectpicker('refresh');
        showUploadedFileName();
    });

    // function showUploadedFileName() {
    //     $('.custom-file-input').change(function (e) {
    //         $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
    //     });
    // }

    $('.optionBoxREE').on('click', '.removeREE', function () {
            $(this).parent().parent().remove();
    });
});



//Architect layout detail add ee report one by one
function getEEReportData(id, doc_name,doc_error,uploaded_file_id,ee_report_doc_id,replace_hidden_to_label=false)
{
    //alert(doc_error)
    $(".loader").show();
    var doc_name1=document.getElementById(doc_name).value;
    var architect_layout_detail_id=$('#architect_layout_detail_id').val();
    if(doc_name1!="")
    {
        //document.getElementById(doc_error).value = "";
        var file_data = $('#'+id).prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('architect_layout_detail_id', architect_layout_detail_id);
        form_data.append('doc_name', doc_name1);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        $.ajax({
            url: "{{url('architect_layout_detail_post_ee_report')}}", // point to server-side PHP script
            data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                
                $(".loader").hide();
                if(data.status==true)
                {
                    if(!$("#ee_reports_tab").hasClass('filled'))
                    {
                        $("#ee_reports_tab").addClass('filled');
                    }
                    if(replace_hidden_to_label)
                    {
                    $("#"+doc_name).replaceWith("<label>" + doc_name1 + "</label>");
                    }
                    $("#"+uploaded_file_id).prop("href", data.file_path)
                    $("#"+uploaded_file_id).css("display", "block");
                    document.getElementById(ee_report_doc_id).value=data.doc_id
                    document.getElementById(doc_error).innerHTML = "";
                }else
                {
                    document.getElementById(id).value = null;
                    document.getElementById(doc_error).innerHTML = data.message;
                }
            }
        });
    }else
    {
        document.getElementById(doc_error).innerHTML = "Please Enter Document Name";
        document.getElementById(id).value = null;
        $(".loader").hide();
    }
    showUploadedFileName();
}
//architect_layout_detail_delete_ee_report one by one
function delete_ee_doc(id,doc_id)
{
    var ee_doc_delete_id=document.getElementById(id).value;
    if(ee_doc_delete_id!="")
    {
        if(confirm('Are you sure?'))
        {
            
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    }
                });
                $.ajax({
                    url: "{{url('architect_layout_detail_delete_ee_report')}}", // point to server-side PHP script
                    data: {ee_doc_delete_id:ee_doc_delete_id},
                    type: 'POST',
                    success: function(data) {
                        $(".loader").hide();
                    }
                });
                $("#"+doc_id).parent().parent().remove();
        }
    }
}

//Architect layout detail add em report one by one
function getEMReportData(id, doc_name,doc_error,uploaded_file_id,em_report_doc_id,replace_hidden_to_label=false)
{

    $(".loader").show();
    var doc_name1=document.getElementById(doc_name).value;
    var architect_layout_detail_id=$('#architect_layout_detail_id').val();
    if(doc_name1!="")
    {
        document.getElementById(doc_error).value = "";
        var file_data = $('#'+id).prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('architect_layout_detail_id', architect_layout_detail_id);
        form_data.append('doc_name', doc_name1);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        $.ajax({
            url: "{{url('architect_layout_detail_post_em_report')}}", // point to server-side PHP script
            data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                $(".loader").hide();
                if(data.status==true)
                {
                    if(!$("#em_reports_tab").hasClass('filled'))
                    {
                        $("#em_reports_tab").addClass('filled');
                    }
                    if(replace_hidden_to_label)
                    {
                        $("#"+doc_name).replaceWith("<label>" + doc_name1 + "</label>");
                    }
                    $("#"+uploaded_file_id).prop("href", data.file_path)
                    $("#"+uploaded_file_id).css("display", "block");
                    document.getElementById(em_report_doc_id).value=data.doc_id
                    document.getElementById(doc_error).innerHTML = "";
                }else
                {
                    document.getElementById(doc_error).innerHTML = data.message;
                }
            }
        });
    }else
    {
        document.getElementById(doc_error).innerHTML = "Please Enter Document Name";
        document.getElementById(id).value = null;
        $(".loader").hide();
    }
    showUploadedFileName();
}
//architect_layout_detail_delete_em_report one by one
function delete_em_doc(id,doc_id)
{
    var em_doc_delete_id=document.getElementById(id).value;
    if(em_doc_delete_id!="")
    {
        if(confirm('Are you sure?'))
        {
            
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    }
                });
                $.ajax({
                    url: "{{url('architect_layout_detail_delete_em_report')}}", // point to server-side PHP script
                    data: {em_doc_delete_id:em_doc_delete_id},
                    type: 'POST',
                    success: function(data) {
                        $(".loader").hide();
                    }
                });
                $("#"+doc_id).parent().parent().remove();
        }
    }
}

//Architect layout detail add ree report one by one
function getREEReportData(id, doc_name,doc_error,uploaded_file_id,ree_report_doc_id,replace_hidden_to_label=false)
{
    $(".loader").show();
    var doc_name1=document.getElementById(doc_name).value;
    var architect_layout_detail_id=$('#architect_layout_detail_id').val();
    if(doc_name1!="")
    {
        document.getElementById(doc_error).value = "";
        var file_data = $('#'+id).prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('architect_layout_detail_id', architect_layout_detail_id);
        form_data.append('doc_name', doc_name1);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        $.ajax({
            url: "{{url('architect_layout_detail_post_ree_report')}}", // point to server-side PHP script
            data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                $(".loader").hide();
                if(data.status==true)
                {
                    if(!$("#ree_reports_tab").hasClass('filled'))
                    {
                        $("#ree_reports_tab").addClass('filled');
                    }
                    if(replace_hidden_to_label)
                    {
                        $("#"+doc_name).replaceWith("<label>" + doc_name1 + "</label>");
                    }
                    $("#"+uploaded_file_id).prop("href", data.file_path)
                    $("#"+uploaded_file_id).css("display", "block");
                    document.getElementById(ree_report_doc_id).value=data.doc_id
                    document.getElementById(doc_error).innerHTML = "";
                }else
                {
                    document.getElementById(doc_error).innerHTML = data.message;
                }
            }
        });
    }else
    {
        document.getElementById(doc_error).innerHTML = "Please Enter Document Name";
        document.getElementById(id).value = null;
        $(".loader").hide();
    }
    showUploadedFileName();
}
//architect_layout_detail_delete_ree_report one by one
function delete_ree_doc(id,doc_id)
{
    var ree_doc_delete_id=document.getElementById(id).value;
    if(ree_doc_delete_id!="")
    {
        if(confirm('Are you sure?'))
        {
            
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    }
                });
                $.ajax({
                    url: "{{url('architect_layout_detail_delete_ree_report')}}", // point to server-side PHP script
                    data: {ree_doc_delete_id:ree_doc_delete_id},
                    type: 'POST',
                    success: function(data) {
                        $(".loader").hide();
                    }
                });
                $("#"+doc_id).parent().parent().remove();
        }
    }
}

//Architect layout detail add land report 
function getLandReportData(id, doc_name,doc_error,uploaded_file_id,land_report_doc_id,replace_hidden_to_label=false)
{
    $(".loader").show();
    var doc_name1=document.getElementById(doc_name).value;
    var architect_layout_detail_id=$('#architect_layout_detail_id').val();
    if(doc_name1!="")
    {
        document.getElementById(doc_error).value = "";
        var file_data = $('#'+id).prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('architect_layout_detail_id', architect_layout_detail_id);
        form_data.append('doc_name', doc_name1);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });
        $.ajax({
            url: "{{url('architect_layout_detail_post_land_report')}}", // point to server-side PHP script
            data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                $(".loader").hide();
                if(data.status==true)
                {
                    if(!$("#land_reports_tab").hasClass('filled'))
                    {
                        $("#land_reports_tab").addClass('filled');
                    }
                    if(replace_hidden_to_label)
                    {
                        $("#"+doc_name).replaceWith("<label>" + doc_name1 + "</label>");
                    }
                    $("#"+uploaded_file_id).prop("href", data.file_path)
                    $("#"+uploaded_file_id).css("display", "block");
                    document.getElementById(land_report_doc_id).value=data.doc_id
                    document.getElementById(doc_error).innerHTML = "";
                }else
                {
                    document.getElementById(doc_error).innerHTML = data.message;
                }
            }
        });
    }else
    {
        document.getElementById(doc_error).innerHTML = "Please Enter Document Name";
        document.getElementById(id).value = null;
        $(".loader").hide();
    }
    showUploadedFileName();
}

function showUploadedFileName() {
        $('.custom-file-input').change(function (e) {
            $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
        });
    }
</script>

<script>
    //cts plan detail
        $(document).ready(function() {  
            $('.addCTS').click(function() {
                var count=$(".optionBoxCTS > div").length;
                    //count++;
                $('.blockCTS:last').after('<div class="blockCTS position-relative form-group"><input placeholder="CTS no" type="text" name="cts_no['+count+']" class="form-control form-control--custom" required><a href="#" class="fa fa-close btn--remove-delete remove"></a></div>');
            });
            $('.optionBoxCTS').on('click','.remove',function() {
                $(this).parent().remove();
            }); 
        });
        function deleteCtsDetail(tt,id)
        {
            if(confirm('Are you sure?'))
            {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                }
                });
                $.ajax({
                    url:'{{route("delete_cts_detail")}}',
                    method:'POST',
                    data:{cts_detail_id:id},
                    success:function(data){
                        console.log(data);
                        $(tt).parent().remove();
                    }
                })
            }
        }
    
    </script>

<script>
    //prc details
        $(document).ready(function () {
            
            
            $('.addPrc').click(function () {
                var count=$(".optionBoxPrc > div").length;
                count++;
                $('.blockPrc:last').after(
                    '<div class="blockPrc">'+
                    '<div class="form-group m-form__group row mb-0">'+
                                '<div class="col-lg-5 form-group">'+
                                    '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="" name="cts_no[]">'+
                                        @foreach($ArchitectLayoutDetail->cts_plan_details as $cts_plan_detail)
                                        '<option value="{{$cts_plan_detail->id}}">{{$cts_plan_detail->cts_no}}</option>'+
                                        @endforeach
                                    '</select>'+
                                    '<span class="help-block"></span>'+
                                '</div>'+
                                '<div class="col-lg-5 form-group">'+
                                    '<div class="custom-file">'+
                                        '<input type="file" id="extract_'+count+'" name="pr_cards[]" class="custom-file-input">'+
                                        '<label title="" class="custom-file-label" for="extract_'+count+'">Choose file</label>'+
                                        '<span class="help-block"></span>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-lg-2 form-group mt-2">'+
                                    '<a href="javascript:void()" class="remove"><i class="fa fa-close btn--remove-delete"></i></a>'+
                                '</div>'+
                            '</div>'+
                    '</div>'
                );
                $('.m-bootstrap-select').selectpicker('refresh');
                showUploadedFileName();
            });
    
            function showUploadedFileName() {
                $('.custom-file-input').change(function (e) {
                    $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
                });
            }
    
            $('.optionBoxPrc').on('click', '.remove', function () {
                $(this).parent().parent().remove();
            });
        });
    
        function deletePrCardDetail(tt,id)
        {
            if(confirm('Are you sure?'))
            {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                }
                });
                $.ajax({
                    url:'{{route("delete_prc_detail")}}',
                    method:'POST',
                    data:{pr_card_detail_id:id},
                    success:function(data){
                        $(tt).parent().parent().remove();
                    }
                })
            }
        }

    function deleteCrzRemark(event,id)
    {
        $(".loader").show();
        if(confirm('Are you sure?'))
            {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                }
                });
        $.ajax({
            url:"{{route('delete_crz_remark')}}",
            method:'POST',
            data:{crz_id:id},
            cache: false,
            success:function(data){

                if(data.status=='success')
                {
                    event.closest('tr').remove();
                }
                $(".loader").hide();
            }
        })
     }
    }
       
    function deleteDpRemark(event,id)
    {
        $(".loader").show();
        if(confirm('Are you sure?'))
            {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                }
                });
                
        $.ajax({
            url:"{{route('delete_dp_remark')}}",
            method:'POST',
            data:{dp_id:id},
            cache: false,
            success:function(data){
                if(data.status=='success')
                {
                    event.closest('tr').remove();
                }
                $(".loader").hide();
            }
        })
        }
    }

    $.validator.prototype.checkForm = function () {
        //overriden in a specific page
        this.prepareForm();
        for (var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++) {
            if (this.findByName(elements[i].name).length !== undefined && this.findByName(elements[i].name).length >
                1) {
                for (var cnt = 0; cnt < this.findByName(elements[i].name).length; cnt++) {
                    this.check(this.findByName(elements[i].name)[cnt]);
                }
            } else {
                this.check(elements[i]);
            }
        }
        return this.valid();
    };
    $('#add_cts_plan').validate({
        rules: {
            "cts_no[]": "required",
            "cts_plan_file[]": {
                required:true,
                extension: "pdf|doc|docx",
            },
        }
    });

    $('#add_prc_details').validate({
        rules: {
            "cts_no[]": "required",
            "pr_cards[]": {
                required:true,
                extension: "pdf|doc|docx",
            },
        }
    });

    
    //tab localstorage
    $(document).ready(function () {

// **Start** Save tabs location on window refresh or submit

// Set first tab to active if user visits page for the first time

if (localStorage.getItem("activeTab") === null) {
    document.querySelector(".nav-link.m-tabs__link").classList.add("active", "show");
} else {
    document.querySelector(".nav-link.m-tabs__link").classList.remove("active", "show");
}

if (location.hash) {
    $('a[href=\'' + location.hash + '\']').tab('show');
}
var activeTab = localStorage.getItem('activeTab');
if (activeTab) {
    $('a[href="' + activeTab + '"]').tab('show');
}

$('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
    e.preventDefault()
    var tab_name = this.getAttribute('href')
    if (history.pushState) {
        history.pushState(null, null, tab_name)
    } else {
        location.hash = tab_name
    }
    localStorage.setItem('activeTab', tab_name)

    $(this).tab('show');

    localStorage.clear();
    return false;
});

$(window).on('popstate', function () {
    var anchor = location.hash ||
        $('a[data-toggle=\'tab\']').first().attr('href');
    $('a[href=\'' + anchor + '\']').tab('show');
    window.scrollTo(0, 0);
});

// // **End** Save tabs location on window refresh or submit

})

    </script>
@endsection
@section('content')
<div class="loader" style="display:none;"></div>
<div class="col-md-12">
    <div class="m-subheader px-0 mb-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Add Detail -
                {{$ArchitectLayoutDetail->architect_layout->master_layout!=""?$ArchitectLayoutDetail->architect_layout->master_layout->layout_name:''}}</h3>

            {{
            Breadcrumbs::render('architect_layout_add_details',encrypt($ArchitectLayoutDetail->architect_layout->id))
            }}
        </div>
        @if(Session::has('success'))
        <div class="alert alert-success display_msg">
            <p> {{ Session::get('success') }} </p>
        </div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger display_msg">
            <p> {{ Session::get('error') }} </p>
        </div>
        @endif
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom nav-tabs--steps">
            <li class="nav-item m-tabs__item {{$ArchitectLayoutDetail->cts_plan_details->count()>0?'filled':''}}"
                data-target="#document-scrunity">
                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#cts-plan-tab">CTS Plan
                    {!!$ArchitectLayoutDetail->cts_plan_details->count()>0?'<i class="fa fa-check"></i>':''!!}</a>
            </li>
            <li class="nav-item m-tabs__item {{$ArchitectLayoutDetail->pr_card_details->count()>0?'filled':''}}">
                <a class="nav-link m-tabs__link " data-toggle="tab" href="#prc-tab">PRC
                    {!!$ArchitectLayoutDetail->pr_card_details->count()>0?'<i class="fa fa-check"></i>':''!!}</a>
            </li>
            @php
                $dp_crz_remark=0;
                if($ArchitectLayoutDetail->ArchitectLayoutDetailDpRemark->count()>0 && $ArchitectLayoutDetail->ArchitectLayoutDetailCrzRemark->count()>0)
                {
                    $dp_crz_remark=1;
                }
            @endphp
            <li class="nav-item m-tabs__item {{$dp_crz_remark==1?'filled':''}}">
                <a class="nav-link m-tabs__link " data-toggle="tab" href="#dp-remark-tab">DP Remark, CRZ Remark and
                    other {!!$dp_crz_remark==1?'<i class="fa fa-check"></i>':''!!}</a>
            </li>
        </ul>
    </div>
    {{-- <form id="upload_latest_layout" method="post" enctype="multipart/form-data"> --}}
        <input type="hidden" id="architect_layout_detail_id" name="architect_layout_detail_id" value="{{$ArchitectLayoutDetail->id}}">
        @csrf
        <div class="tab-content">
            <div class="tab-pane active show" id="cts-plan-tab">
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                            <div class="m-subheader">
                                {{-- <div class="d-flex align-items-center">
                                    <h3 class="section-title section-title--small">
                                        CTS plan
                                    </h3>
                                </div> --}}
                                <div class="mt-auto">
                                    @include('admin.architect_layout_detail.cts_plan_detail',compact('ArchitectLayoutDetail'))
                                    {{-- <a href="{{route('architect_layout_detail_cts_plan',['layout_detail_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                                        class="btn btn-primary btn-custom upload_note" id="uploadBtn">Add CTS Detail</a>
                                    --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="prc-tab">
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                            <div class="m-subheader">
                                {{-- <div class="d-flex align-items-center">
                                    <h3 class="section-title section-title--small">
                                        PRC
                                    </h3>
                                </div> --}}
                                <div class="mt-auto">
                                    {{-- <a href="{{route('architect_layout_detail_prc_detail',['layout_detail_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                                        class="btn btn-primary btn-custom upload_note" id="uploadBtn">Add PRC Detail</a>
                                    --}}
                                    @include('admin.architect_layout_detail.prc_detail',compact('ArchitectLayoutDetail'))
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="dp-remark-tab">
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                            <div class="m-subheader">
                                {{-- <div class="d-flex align-items-center">
                                    <h3 class="section-title section-title--small">
                                        DP remark, CRZ remark and other
                                    </h3>
                                </div> --}}
                                <div class="mt-auto">
                                    @include('admin.architect_layout_detail.dp_crz_remark',compact('ArchitectLayoutDetail'))
                                    {{-- <a href="{{route('add_architect_detail_dp_crz_remark_add',['layout_detail_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                                        class="btn btn-primary btn-custom upload_note" id="uploadBtn">Add Detail</a>
                                    --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!----  ---  ee em ree lm report-------------------------------------------------------- -->

        <ul id="layouts_upload" class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom nav-tabs--steps">
            <li class="nav-item m-tabs__item {{$ArchitectLayoutDetail->ee_reports->count()>0?'filled':''}}" data-target="#document-scrunity" id="ee_reports_tab">
                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#ee-report">EE Report
                    <i class="fa fa-check"></i>
                </a>
            </li>
            <li class="nav-item m-tabs__item {{$ArchitectLayoutDetail->em_reports->count()>0?'filled':''}}" id="em_reports_tab">
                <a class="nav-link m-tabs__link " data-toggle="tab" href="#em-report">EM Report
                    <i class="fa fa-check"></i>
                </a>
            </li>
            <li class="nav-item m-tabs__item {{$ArchitectLayoutDetail->ree_reports->count()>0?'filled':''}}" id="ree_reports_tab">
                <a class="nav-link m-tabs__link " data-toggle="tab" href="#ree-report">REE Report
                    <i class="fa fa-check"></i>
                </a>
            </li>
            <li class="nav-item m-tabs__item {{$ArchitectLayoutDetail->land_reports->count()>0?'filled':''}}" id="land_reports_tab">
                <a class="nav-link m-tabs__link " data-toggle="tab" href="#land-report">Land Report
                    <i class="fa fa-check"></i>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active show" id="ee-report">
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                            <div class="m-subheader">
                                {{-- <div class="d-flex align-items-center">
                                    <h3 class="section-title section-title--small">
                                        Executive Engineering report
                                    </h3>
                                </div> --}}
                                <div class="optionBoxEE">
                                @php  
                                $ee_report_1=$ArchitectLayoutDetail->ee_reports->where('name_of_documents','Area certificate')->first();
                                @endphp
                                    <div class="blockEE">
                                        <div class="form-group m-form__group row mb-0">
                                            <div class="col-lg-4 form-group">
                                                <input type="hidden" class="ee_doc_name" id="ee_doc_name" name="document_name[]"
                                                    value="Area certificate">
                                                <label>Area certificate</label>
                                                <input type="hidden" id="ee_report_doc_id" value="{{($ee_report_1!=null)?$ee_report_1->id:''}}">
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <div class="custom-file">
                                                    <input type="file" id="ee_extract" name="ee_report" onchange="getEEReportData(this.id,'ee_doc_name','ee_doc_error','ee_report_uploaded_file','ee_report_doc_id')"
                                                        class="custom-file-input">
                                                    <label title="" class="custom-file-label" for="ee_extract">Choose
                                                        file</label>
                                                    <a class="btn-link" target="_blank" style="display:{{($ee_report_1!=null) ?'block':'none'}}"
                                                        id="ee_report_uploaded_file" href="{{config('commanConfig.storage_server').'/'.($ee_report_1!=null?$ee_report_1->upload_file:'')}}">download</a>
                                                    <span class="text-danger" id="ee_doc_error"></span>
                                                </div>
                                            </div>
                                            <!-- <div class="col-lg-2 form-group mt-2">
                                                        <i class="fa fa-close btn--add-delete" id=""></i>
                                                    </div> -->
                                        </div>
                                    </div>
                                @php 
                                $ee_report_2=$ArchitectLayoutDetail->ee_reports->where('name_of_documents','Area of Encroachmente')->first();
                                //print_r($ee_report_2);
                                @endphp
                                    <div class="blockEE">
                                        <div class="form-group m-form__group row mb-0">
                                            <div class="col-lg-4 form-group">
                                                <input type="hidden" class="ee_doc_name" id="ee_doc_name_1" name="ee_document_name[]"
                                                    value="Area of Encroachmente">
                                                <label>Area of Encroachment</label>
                                                <input type="hidden" id="ee_report_doc_id_1" value="{{($ee_report_2!=null)?$ee_report_2->id:''}}">
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <div class="custom-file">
                                                    <input type="file" id="ee_extract_1" name="ee_report_1" class="custom-file-input"
                                                        onchange="getEEReportData(this.id,'ee_doc_name_1','ee_doc_error_1','ee_report_uploaded_file_1','ee_report_doc_id_1')">
                                                    <label title="" class="custom-file-label" for="ee_extract_1">Choose
                                                        file</label>
                                                    <a class="btn-link" target="_blank" style="display:{{($ee_report_2!=null)?'block':'none'}}"
                                                        id="ee_report_uploaded_file_1" href="{{config('commanConfig.storage_server').'/'.(($ee_report_2!=null)?$ee_report_2->upload_file:'')}}">download</a>
                                                    <span class="text-danger" id="ee_doc_error_1"></span>
                                                </div>
                                            </div>
                                            <!-- <div class="col-lg-2 form-group mt-2">
                                                        <i class="fa fa-close btn--add-delete" id=""></i>
                                                    </div> -->
                                        </div>
                                    </div>
                                @php  
                                $ee_report_3=$ArchitectLayoutDetail->ee_reports->where('name_of_documents','Heading Over reservation')->first();
                                @endphp
                                    <div class="blockEE">
                                        <div class="form-group m-form__group row mb-0">
                                            <div class="col-lg-4 form-group">
                                                <input type="hidden" class="ee_doc_name" id="ee_doc_name_2" name="document_name[]"
                                                    value="Heading Over reservation">
                                                <label>Heading Over reservation</label>
                                                <input type="hidden" id="ee_report_doc_id_2" value="{{($ee_report_3!=null)?$ee_report_3->id:''}}">
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <div class="custom-file">
                                                    <input type="file" id="ee_extract_2" name="ee_report_2" class="custom-file-input ee_doc_file"
                                                        onchange="getEEReportData(this.id,'ee_doc_name_2','ee_doc_error_2','ee_report_uploaded_file_2','ee_report_doc_id_2')">
                                                    <label title="" class="custom-file-label" for="ee_extract_2">Choose
                                                        file</label>
                                                    <a class="btn-link" target="_blank" style="display:{{($ee_report_3!=null)?'block':'none'}}"
                                                        id="ee_report_uploaded_file_2" href="{{config('commanConfig.storage_server').'/'.($ee_report_3!=null?$ee_report_3->upload_file:'')}}">download</a>
                                                    <span class="text-danger" id="ee_doc_error_2"></span>
                                                </div>
                                            </div>
                                            <!-- <div class="col-lg-2 form-group mt-2">
                                                        <i class="fa fa-close btn--add-delete" id=""></i>
                                                    </div> -->
                                        </div>
                                    </div>
                                    @php $i=3; @endphp
                                    @foreach($ArchitectLayoutDetail->ee_reports as $ee_report)
                                    @if(!in_array($ee_report->name_of_documents,array('Area certificate','Area of Encroachmente','Heading Over reservation')))
                                    <div class="blockEE">
                                        <div class="form-group m-form__group row mb-0">
                                            <div class="col-lg-4 form-group">
                                                <input type="hidden" class="ee_doc_name" id="ee_doc_name_{{$i}}" name="document_name[]"
                                                    value="Heading Over reservation">
                                                <label>{{$ee_report->name_of_documents}}</label>
                                                <input type="hidden" id="ee_report_doc_id_{{$i}}" value="{{isset($ee_report->id)?$ee_report->id:''}}">
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <div class="custom-file">
                                                    <input type="file" id="ee_extract_{{$i}}" name="ee_report_{{$i}}"
                                                        class="custom-file-input ee_doc_file" onchange="getEEReportData(this.id,'ee_doc_name_{{$i}}','ee_doc_error_{{$i}}','ee_report_uploaded_file_{{$i}}','ee_report_doc_id_{{$i}}')">
                                                    <label title="" class="custom-file-label" for="ee_extract_{{$i}}">Choose
                                                        file</label>
                                                    <a class="btn-link" target="_blank" style="display:{{isset($ee_report->upload_file)?'block':'none'}}"
                                                        id="ee_report_uploaded_file_{{$i}}" href="{{config('commanConfig.storage_server').'/'.(isset($ee_report->upload_file)?$ee_report->upload_file:'')}}">download</a>
                                                    <span class="text-danger" id="ee_doc_error_{{$i}}"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 form-group mt-2">
                                                <i class="fa fa-close btn--remove-delete" id="delete_ee_doc_{{$i}}"
                                                    onclick="delete_ee_doc('ee_report_doc_id_{{$i}}','delete_ee_doc_{{$i}}')"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @php $i++ @endphp
                                    @endif
                                    @endforeach
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
            </div>
            <div class="tab-pane" id="em-report">
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                            <div class="m-subheader">
                                {{-- <div class="d-flex align-items-center">
                                    <h3 class="section-title section-title--small">
                                        EM report
                                    </h3>
                                </div> --}}
                                <div class="optionBoxEM">
                                    @php  
                                    $em_report_1=$ArchitectLayoutDetail->em_reports->where('name_of_documents','Number of tenants')->first();
                                    @endphp
                                    <div class="blockEM">
                                        <div class="form-group m-form__group row mb-0">
                                            <div class="col-lg-4 form-group">
                                                <input type="hidden" class="em_doc_name" id="em_doc_name" name="document_name[]"
                                                    value="Number of tenants">
                                                <label>Number of tenants</label>
                                                <input type="hidden" id="em_report_doc_id" value="{{($em_report_1!=null)?$em_report_1->id:''}}">
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <div class="custom-file">
                                                    <input type="file" id="em_extract" name="em_report" onchange="getEMReportData(this.id,'em_doc_name','em_doc_error','em_report_uploaded_file','em_report_doc_id')"
                                                        class="custom-file-input">
                                                    <label title="" class="custom-file-label" for="em_extract">Choose
                                                        file</label>
                                                    <a class="btn-link" target="_blank" style="display:{{$em_report_1!=null?'block':'none'}}"
                                                        id="em_report_uploaded_file" href="{{config('commanConfig.storage_server').'/'.($em_report_1!=null?$em_report_1->upload_file:'')}}">download</a>
                                                    <span class="text-danger" id="em_doc_error"></span>
                                                </div>
                                            </div>
                                            <!-- <div class="col-lg-2 form-group mt-2">
                                                        <i class="fa fa-close btn--add-delete" id=""></i>
                                                    </div> -->
                                        </div>
                                    </div>
                                    @php  
                                    $em_report_2=$ArchitectLayoutDetail->em_reports->where('name_of_documents','Category')->first();
                                    @endphp
                                    <div class="blockEM">
                                        <div class="form-group m-form__group row mb-0">
                                            <div class="col-lg-4 form-group">
                                                <input type="hidden" class="em_doc_name" id="em_doc_name_1" name="em_document_name[]"
                                                    value="Category">
                                                <label>Category</label>
                                                <input type="hidden" id="em_report_doc_id_1" value="{{$em_report_2!=null?$em_report_2->id:''}}">
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <div class="custom-file">
                                                    <input type="file" id="em_extract_1" name="em_report_1" class="custom-file-input"
                                                        onchange="getEMReportData(this.id,'em_doc_name_1','em_doc_error_1','em_report_uploaded_file_1','em_report_doc_id_1')">
                                                    <label title="" class="custom-file-label" for="em_extract_1">Choose
                                                        file</label>
                                                    <a class="btn-link" target="_blank" style="display:{{$em_report_2!=null?'block':'none'}}"
                                                        id="em_report_uploaded_file_1" href="{{config('commanConfig.storage_server').'/'.($em_report_2!=null?$em_report_2->upload_file:'')}}">download</a>
                                                    <span class="text-danger" id="em_doc_error_1"></span>
                                                </div>
                                            </div>
                                            <!-- <div class="col-lg-2 form-group mt-2">
                                                        <i class="fa fa-close btn--add-delete" id=""></i>
                                                    </div> -->
                                        </div>
                                    </div>
                                    @php $i=2; @endphp
                                    @foreach ($ArchitectLayoutDetail->em_reports as $em_report)
                                    @if(!in_array($em_report->name_of_documents,array('Number of tenants','Category')))
                                    <div class="blockEM">
                                        <div class="form-group m-form__group row mb-0">
                                            <div class="col-lg-4 form-group">
                                                <input type="hidden" class="em_doc_name" id="em_doc_name_{{$i}}" name="document_name[]"
                                                    value="{{isset($em_report->name_of_documents)?$em_report->name_of_documents:''}}">
                                                <label>{{$em_report->name_of_documents}}</label>
                                                <input type="hidden" id="em_report_doc_id_{{$i}}" value="{{isset($em_report->id)?$em_report->id:''}}">
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <div class="custom-file">
                                                    <input type="file" id="em_extract_{{$i}}" name="em_report_{{$i}}"
                                                        class="custom-file-input em_doc_file" onchange="getEMReportData(this.id,'em_doc_name_{{$i}}','em_doc_error_{{$i}}','em_report_uploaded_file_{{$i}}','em_report_doc_id_{{$i}}')">
                                                    <label title="" class="custom-file-label" for="em_extract_{{$i}}">Choose
                                                        file</label>
                                                    <a class="btn-link" target="_blank" style="display:{{isset($em_report->upload_file)?'block':'none'}}"
                                                        id="em_report_uploaded_file_{{$i}}" href="{{config('commanConfig.storage_server').'/'.(isset($em_report->upload_file)?$em_report->upload_file:'')}}">download</a>
                                                    <span class="text-danger" id="em_doc_error_{{$i}}"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 form-group mt-2">
                                                <i class="fa fa-close btn--remove-delete" id="delete_em_doc_{{$i}}"
                                                    onclick="delete_em_doc('em_report_doc_id_{{$i}}','delete_em_doc_{{$i}}')"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @php $i++ @endphp
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a class="btn--add-delete add_em_report">add more </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="ree-report">
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                            <div class="m-subheader">
                                {{-- <div class="d-flex align-itrees-center">
                                    <h3 class="section-title section-title--small">
                                        REE report
                                    </h3>
                                </div> --}}
                                <div class="optionBoxREE">
                                    @php  
                                    $ree_report_1=$ArchitectLayoutDetail->ree_reports->where('name_of_documents','NOC given for redevelopment')->first();
                                    @endphp
                                    <div class="blockREE">
                                        <div class="form-group m-form__group row mb-0">
                                            <div class="col-lg-4 form-group">
                                                <input type="hidden" class="ree_doc_name" id="ree_doc_name" name="document_name[]"
                                                    value="NOC given for redevelopment">
                                                <label>NOC given for redevelopment</label>
                                                <input type="hidden" id="ree_report_doc_id" value="{{$ree_report_1!=null?$ree_report_1->id:''}}">
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <div class="custom-file">
                                                    <input type="file" id="ree_extract" name="ree_report" onchange="getREEReportData(this.id,'ree_doc_name','ree_doc_error','ree_report_uploaded_file','ree_report_doc_id')"
                                                        class="custom-file-input">
                                                    <label title="" class="custom-file-label" for="ree_extract">Choose
                                                        file</label>
                                                    <a class="btn-link" target="_blank" style="display:{{$ree_report_1!=null?'block':'none'}}"
                                                        id="ree_report_uploaded_file" href="{{config('commanConfig.storage_server').'/'.($ree_report_1!=null?$ree_report_1->upload_file:'')}}">download</a>
                                                    <span class="text-danger" id="ree_doc_error"></span>
                                                </div>
                                            </div>
                                            <!-- <div class="col-lg-2 form-group mt-2">
                                                        <i class="fa fa-close btn--add-delete" id=""></i>
                                                    </div> -->
                                        </div>
                                    </div>
                                    @php  
                                    $ree_report_2=$ArchitectLayoutDetail->ree_reports->where('name_of_documents','Pro Rata Distribution')->first();
                                    @endphp
                                    <div class="blockREE">
                                        <div class="form-group m-form__group row mb-0">
                                            <div class="col-lg-4 form-group">
                                                <input type="hidden" class="ree_doc_name" id="ree_doc_name_1" name="ree_document_name[]"
                                                    value="Pro Rata Distribution">
                                                <label>Pro Rata Distribution</label>
                                                <input type="hidden" id="ree_report_doc_id_1" value="{{$ree_report_2!=null?$ree_report_2->id:''}}">
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <div class="custom-file">
                                                    <input type="file" id="ree_extract_1" name="ree_report_1" class="custom-file-input"
                                                        onchange="getREEReportData(this.id,'ree_doc_name_1','ree_doc_error_1','ree_report_uploaded_file_1','ree_report_doc_id_1')">
                                                    <label title="" class="custom-file-label" for="ree_extract_1">Choose
                                                        file</label>
                                                    <a class="btn-link" target="_blank" style="display:{{$ree_report_2!=null?'block':'none'}}"
                                                        id="ree_report_uploaded_file_1" href="{{config('commanConfig.storage_server').'/'.($ree_report_2!=null?$ree_report_2->upload_file:'')}}">download</a>
                                                    <span class="text-danger" id="ree_doc_error_1"></span>
                                                </div>
                                            </div>
                                            <!-- <div class="col-lg-2 form-group mt-2">
                                                        <i class="fa fa-close btn--add-delete" id=""></i>
                                                    </div> -->
                                        </div>
                                    </div>
                                    @php $i=1; @endphp
                                    @foreach ($ArchitectLayoutDetail->ree_reports as $ree_report)
                                    @if(!in_array($ree_report->name_of_documents,array('NOC given for redevelopment','Pro Rata Distribution')))
                                    <div class="blockREE">
                                        <div class="form-group m-form__group row mb-0">
                                            <div class="col-lg-4 form-group">
                                                <input type="hidden" class="ree_doc_name" id="ree_doc_name_{{$i}}" name="document_name[]"
                                                    value="{{isset($ree_report->name_of_documents)?$ree_report->name_of_documents:''}}">
                                                <label>{{$ree_report->name_of_documents}}</label>
                                                <input type="hidden" id="ree_report_doc_id_{{$i}}" value="{{isset($ree_report->id)?$ree_report->id:''}}">
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <div class="custom-file">
                                                    <input type="file" id="ree_extract_{{$i}}" name="ree_report_{{$i}}"
                                                        class="custom-file-input ree_doc_file" onchange="getREEReportData(this.id,'ree_doc_name_{{$i}}','ree_doc_error_{{$i}}','ree_report_uploaded_file_{{$i}}','ree_report_doc_id_{{$i}}')">
                                                    <label title="" class="custom-file-label" for="ree_extract_{{$i}}">Choose
                                                        file</label>
                                                    <a class="btn-link" target="_blank" style="display:{{isset($ree_report->upload_file)?'block':'none'}}"
                                                        id="ree_report_uploaded_file_{{$i}}" href="{{config('commanConfig.storage_server').'/'.(isset($ree_report->upload_file)?$ree_report->upload_file:'')}}">download</a>
                                                    <span class="text-danger" id="ree_doc_error_{{$i}}"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 form-group mt-2">
                                                <i class="fa fa-close btn--remove-delete" id="delete_ree_doc_{{$i}}"
                                                    onclick="delete_ree_doc('ree_report_doc_id_{{$i}}','delete_ree_doc_{{$i}}')"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @php $i++ @endphp
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a class="btn--add-delete add_ree_report">add more </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="land-report">
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                            <div class="m-subheader">
                                {{-- <div class="d-flex align-itrees-center">
                                    <h3 class="section-title section-title--small">
                                        Land report
                                    </h3>
                                </div> --}}
                                <div class="optionBoxLand">
                                    <div class="blockLand">
                                        <div class="form-group m-form__group row mb-0">
                                            <div class="col-lg-4 form-group">
                                                <input type="hidden" class="land_doc_name" id="land_doc_name" name="document_name[]"
                                                    value="Total area">
                                                <label>Total area</label>
                                                <input type="hidden" id="land_report_doc_id" value="{{isset($ArchitectLayoutDetail->land_reports[0])?$ArchitectLayoutDetail->land_reports[0]->id:''}}">
                                            </div>
                                            <div class="col-lg-4 form-group">
                                                <div class="custom-file">
                                                    <input type="file" id="land_extract" name="land_report" onchange="getLandReportData(this.id,'land_doc_name','land_doc_error','land_report_uploaded_file','land_report_doc_id')"
                                                        class="custom-file-input">
                                                    <label title="" class="custom-file-label" for="land_extract">Choose
                                                        file</label>
                                                    <a class="btn-link" target="_blank" style="display:{{isset($ArchitectLayoutDetail->land_reports[0])?'block':'none'}}"
                                                        id="land_report_uploaded_file" href="{{config('commanConfig.storage_server').'/'.(isset($ArchitectLayoutDetail->land_reports[0])?$ArchitectLayoutDetail->land_reports[0]->upload_file:'')}}">download</a>
                                                    <span class="text-danger" id="land_doc_error"></span>
                                                </div>
                                            </div>
                                            <!-- <div class="col-lg-2 form-group mt-2">
                                                        <i class="fa fa-close btn--add-delete" id=""></i>
                                                    </div> -->
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-sm-12">
                                        <a class="btn--add-delete add_land_report">add more </a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ul  class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom nav-tabs--steps">
                <li class="nav-item m-tabs__item {{$ArchitectLayoutDetail->old_approved_layout!=''?'filled':''}}" id="old-approved-layout-tab" data-target="#document-scrunity">
                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#old-approved-layout">Old Approved Layout
                        <i class="fa fa-check"></i>
                    </a>
                </li>
                <li class="nav-item m-tabs__item {{$ArchitectLayoutDetail->latest_layout!=''?'filled':''}}" id="latest-layout-tab">
                    <a class="nav-link m-tabs__link " data-toggle="tab" href="#latest-layout">Latest Layout
                        <i class="fa fa-check"></i>
                    </a>
                </li>
                <li class="nav-item m-tabs__item {{$ArchitectLayoutDetail->last_submitted_layout_for_approval!=''?'filled':''}}" id="last-submitted-layout-for-approval-tab">
                    <a class="nav-link m-tabs__link " data-toggle="tab" href="#last-submitted-layout-for-approval">Last submitted layout for approval
                        <i class="fa fa-check"></i>
                    </a>
                </li>
                <li class="nav-item m-tabs__item {{$ArchitectLayoutDetail->survey_report!=''?'filled':''}}" id="survey-report-tab">
                    <a class="nav-link m-tabs__link " data-toggle="tab" href="#survey-report">Survey report
                        <i class="fa fa-check"></i>
                    </a>
                </li>
            </ul>
    
            <div class="tab-content">
                <div class="tab-pane active show" id="old-approved-layout">
                    <div class="m-portlet m-portlet--mobile m_panel">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                                <div class="m-subheader">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <h3 class="section-title section-title--small">
                                                Old Approved Layout:
                                            </h3>
                                        </div>
                                        <div class="custom-file">
                                            <input type="hidden" id="old_approved_layout_field_name" id="old_approved_layout_field_name"
                                                value="old_approved_layout">
                                            <input class="custom-file-input" type="file" id="old_approved_layout" name="old_approved_layout">
                                            <label class="custom-file-label" for="old_approved_layout">Choose file...</label>
                                        </div>
                                        <a class="btn-link" target="_blank" id="old_approved_layout_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->old_approved_layout}}"
                                            style="display:{{$ArchitectLayoutDetail->old_approved_layout!=''?'block':'none'}};">download</a>
                                        <span class="text-danger" id="old_approved_layout_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="latest-layout">
                    <div class="m-portlet m-portlet--mobile m_panel">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                                <div class="m-subheader">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <h3 class="section-title section-title--small">
                                                Latest Layout:
                                            </h3>
                                        </div>
                                        <div class="custom-file">
                                            <input type="hidden" id="latest_layout_field_name" value="latest_layout">
                                            <input class="custom-file-input" name="latest_layout" type="file" id="latest_layout"
                                                required="">
                                            <label class="custom-file-label" for="latest_layout">Choose file...</label>
                                        </div>
                                        <a class="btn-link" target="_blank" id="latest_layout_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->latest_layout}}"
                                            style="display:{{$ArchitectLayoutDetail->latest_layout!=''?'block':'none'}};">download</a>
                                        <span class="text-danger" id="latest_layout_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="last-submitted-layout-for-approval">
                    <div class="m-portlet m-portlet--mobile m_panel">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                                <div class="m-subheader">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <h3 class="section-title section-title--small">
                                                Last submitted layout for approval:
                                            </h3>
                                        </div>
                                        <div class="custom-file">
                                            <input type="hidden" id="last_submitted_layout_field_name" id="last_submitted_layout_field_name"
                                                value="last_submitted_layout_for_approval">
                                            <input class="custom-file-input" name="last_submitted_layout" type="file" id="last_submitted_layout"
                                                required="">
                                            <label class="custom-file-label" for="last_submitted_layout">Choose file...</label>
                                        </div>
                                        <a class="btn-link" target="_blank" id="last_submitted_layout_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->last_submitted_layout_for_approval}}"
                                            style="display:{{$ArchitectLayoutDetail->last_submitted_layout_for_approval!=''?'block':'none'}};">download</a>
                                        <span class="text-danger" id="last_submitted_layout_file_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="survey-report">
                    <div class="m-portlet m-portlet--mobile m_panel">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                                <div class="m-subheader">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <h3 class="section-title section-title--small">
                                                Survey report:
                                            </h3>
                                        </div>
                                        <div class="custom-file">
                                            <input type="hidden" id="survey_report_field_name" value="survey_report">
                                            <input class="custom-file-input" name="survey_report" type="file" id="survey_report"
                                                required="">
                                            <label class="custom-file-label" for="survey_report">Choose file...</label>
                                        </div>
                                        <a class="btn-link" target="_blank" id="survey_report_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->latest_layout}}"
                                            style="display:{{$ArchitectLayoutDetail->survey_report!=''?'block':'none'}};">download</a>
                                        <span class="text-danger" id="survey_report_file_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- <div class="m-portlet m-portlet--mobile m_panel" id="layouts_upload">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                    <div class="m-subheader">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <h3 class="section-title section-title--small">
                                        Old Approved Layout:
                                    </h3>
                                </div>
                                <div class="custom-file">
                                    <input type="hidden" id="old_approved_layout_field_name" id="old_approved_layout_field_name"
                                        value="old_approved_layout">
                                    <input class="custom-file-input" type="file" id="old_approved_layout" name="old_approved_layout">
                                    <label class="custom-file-label" for="old_approved_layout">Choose file...</label>
                                </div>
                                <a class="btn-link" target="_blank" id="old_approved_layout_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->old_approved_layout}}"
                                    style="display:{{$ArchitectLayoutDetail->old_approved_layout!=''?'block':'none'}};">download</a>
                                <span class="text-danger" id="old_approved_layout_error"></span>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <h3 class="section-title section-title--small">
                                        Latest Layout:
                                    </h3>
                                </div>
                                <div class="custom-file">
                                    <input type="hidden" id="latest_layout_field_name" value="latest_layout">
                                    <input class="custom-file-input" name="latest_layout" type="file" id="latest_layout"
                                        required="">
                                    <label class="custom-file-label" for="latest_layout">Choose file...</label>
                                </div>
                                <a class="btn-link" target="_blank" id="latest_layout_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->latest_layout}}"
                                    style="display:{{$ArchitectLayoutDetail->latest_layout!=''?'block':'none'}};">download</a>
                                <span class="text-danger" id="latest_layout_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="m-subheader">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <h3 class="section-title section-title--small">
                                        Last submitted layout for approval:
                                    </h3>
                                </div>
                                <div class="custom-file">
                                    <input type="hidden" id="last_submitted_layout_field_name" id="last_submitted_layout_field_name"
                                        value="last_submitted_layout_for_approval">
                                    <input class="custom-file-input" name="last_submitted_layout" type="file" id="last_submitted_layout"
                                        required="">
                                    <label class="custom-file-label" for="last_submitted_layout">Choose file...</label>
                                </div>
                                <a class="btn-link" target="_blank" id="last_submitted_layout_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->last_submitted_layout_for_approval}}"
                                    style="display:{{$ArchitectLayoutDetail->last_submitted_layout_for_approval!=''?'block':'none'}};">download</a>
                                <span class="text-danger" id="last_submitted_layout_file_error"></span>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <h3 class="section-title section-title--small">
                                        Survey report:
                                    </h3>
                                </div>
                                <div class="custom-file">
                                    <input type="hidden" id="survey_report_field_name" value="survey_report">
                                    <input class="custom-file-input" name="survey_report" type="file" id="survey_report"
                                        required="">
                                    <label class="custom-file-label" for="survey_report">Choose file...</label>
                                </div>
                                <a class="btn-link" target="_blank" id="survey_report_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->latest_layout}}"
                                    style="display:{{$ArchitectLayoutDetail->survey_report!=''?'block':'none'}};">download</a>
                                <span class="text-danger" id="survey_report_file_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}



        <!--  ----------------------------------------------------------------- -->
        {{--
        <!-- Add EE Report -->
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">

                </div>
            </div>
        </div>
        <!-- Add EM Report -->
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">

                </div>
            </div>
        </div>
        <!-- Add REE Report -->
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">

                </div>
            </div>
        </div>
        <!-- Add Land Report -->
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">

                </div>
            </div>
        </div> --}}
        <!-- Court case or dispute on land -->
        <div class="m-portlet m-portlet--mobile m_panel" id="court-case-or-dispute-on-land-section">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                    <div class="m-subheader">
                        <div class="d-flex align-items-center">
                            <h3 class="section-title section-title--small">
                                Court case or Dispute on land
                            </h3>
                        </div>
                        <div class="mt-auto">
                            <a href="{{route('architect_layout_detail_court_case_or_dispute_on_land.index',['layout_detail_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                                class="btn btn-primary btn-custom upload_note" id="uploadBtn">
                                {{$ArchitectLayoutDetail->layout_detail_court_matter_or_dispute->count()>0?'View
                                Detail':'Add Detail'}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                    <div class="m-subheader">
                        <div class="mt-auto">
                            <div class="d-flex">
                                @if ($send_for_revision==1)
                                <form method="post" action="{{route('architect_layout.send_for_revision')}}"> 
                                        @csrf
                                    <input type="hidden" name="layout_id" value="{{$ArchitectLayoutDetail->architect_layout_id}}">
                                    <input type="submit" class="btn btn-primary btn-custom h-100" name="send_for_revision" value="Send For Revision">
                                    </form>
                                @endif
                                {{-- <a href="{{route('architect_layout_details.view',['layout_id'=>encrypt($ArchitectLayoutDetail->architect_layout_id)])}}"
                                    class="btn btn-primary btn-custom upload_note" id="uploadBtn">Save</a> --}}
                                <a href="{{route('architect_layout_details.view',['layout_id'=>encrypt($ArchitectLayoutDetail->architect_layout_id)])}}"
                                    class="btn btn-primary ml-3" id="uploadBtn">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--
    </form> --}}
</div>

@endsection
