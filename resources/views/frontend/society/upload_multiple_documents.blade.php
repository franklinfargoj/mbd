@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.actions',compact('ol_applications'))
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
@section('content')
<div class="loader" style="display:none;"></div>
<div class="col-md-12"> 
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Upload documents</h3>
            {{ Breadcrumbs::render('documents_upload',$ol_applications->id) }}

             @if($ol_applications->status->status_id != config('commanConfig.applicationStatus.forwarded'))
            <a href="{{ route('documents_upload',encrypt($ol_applications->id)) }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            @else
                <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>            
            @endif
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0" style="max-height: 1200px;">
    
        @if($ol_applications->status->status_id != config('commanConfig.applicationStatus.forwarded'))
            <form id="myFrm" role="form" class="form-horizontal">
            @csrf
                <div style="margin-left: 30px;">
                    <div class="col-sm-10" >
                        <div class="form-group row">
                            <div class="col-sm-4 d-flex align-items-center">
                                <label for="name">
                                    @if(isset($type) && $type == 'other') 
                                        Name of Document
                                    @else Name of Member @endif :</label>
                                </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control--custom" name="memberName" id="memberName" value="" required>
                            </div>
                        </div>
                    </div>  
                    <div class="col-sm-10">
                        <div class="form-group row">
                            <div class="col-sm-4 d-flex align-items-center">
                                <label for="name">Upload Document:</label>
                            </div>
                            <div class="col-sm-8">
                                <div class="custom-file ">
                                    <input class="custom-file-input file_upload" name="document_name" type="file" id="test-upload" required>
                                    <label class="custom-file-label" for="test-upload">Choose
                                        file ...</label>
                                    <span id="file_error" class="text-danger"></span>
                                </div>                        
                            </div>
                        </div> 
                    </div> 
                </div>
                <div class="col-sm-6" style="margin-bottom: 34px;">
                    <input type="submit" class="btn btn-primary btn-custom" id="uploadBtn" style="float: right" value="Upload"> 
                </div>  
            </form> 
        @endif    

        @if(count($documents) > 0)   
            <div class="col-sm-10 table-responsive" style="top: 25px;left: 30px;">
                <table class="mt-2 table table-hover" id="dtBasicExample"> 
                    <thead>
                        <tr>
                            <th>Sr.no</th>
                            <th>Name</th>
                            <th>Document</th>
                            @if($ol_applications->status->status_id != config('commanConfig.applicationStatus.forwarded'))
                                <th>Action</th>
                            @endif    
                        </tr>
                    </thead>    
                    <tbody>
                            @php $i = 1;@endphp 
                            @foreach($documents as $document)
                            <tr>
                                <td>{{ $i }}</td>
                                <td> 
                                @if(isset($type) && $type == 'other')
                                    {{ isset($document->document_name) ? $document->document_name : '' }}
                                @else
                                    {{ isset($document->member_name) ? $document->member_name : '' }} 
                                @endif
                                </td>
                                <td class=""> 
                                    <a class="btn-link" href="{{ config('commanConfig.storage_server').'/'.$document->society_document_path }}" download target="_blank"> Download </a> 
                                </td>
                                @if($ol_applications->status->status_id != config('commanConfig.applicationStatus.forwarded'))
                                    <td>
                                        <i class="fa fa-close icon2 d-icon hide-print" id="{{ isset($document->id) ? $document->id : '' }}" onclick="deleteDocument(this.id)"></i>
                                        <input type="hidden" name= "oldFile" id="oldFile_{{$document->id}}" value="{{ isset($document->society_document_path) ? $document->society_document_path : '' }}"> 
                                    </td>
                                @endif    
                            </tr>
                            @php $i++;@endphp 
                            @endforeach
                    </tbody>    
                </table>
            </div> 
        @endif
    </div>   
</div>

@endsection
@section('actions_js')
<script type="text/javascript">
    
    $("#uploadBtn").click(function(){
        if ($("#myFrm").valid() == true){
            $('.loader').show();
            var myfile = $(".file_upload").val();
            var ext = myfile.split('.').pop();
            var memberName = $("#memberName").val();
            var fileData = $(".file_upload").prop('files')[0];
            var documentId = '<?php echo $documentId; ?>';
            var societyId = '<?php echo $ol_applications->society_id; ?>';
            var applicationId = '<?php echo $ol_applications->id; ?>';               
            var type = '<?php echo $type; ?>';               
            
            var form_data = new FormData();
            form_data.append('file', fileData);   
            form_data.append('societyId', societyId);  
            form_data.append('applicationId', applicationId);  
            form_data.append('documentId', documentId);  
            form_data.append('memberName', memberName);  
            form_data.append('type', type);  
            form_data.append('_token', document.getElementsByName("_token")[0].value);
      
            $.ajax({
                url: "/society/save_documents",
                data: form_data,
                dataType : "json",
                type: 'POST',
                contentType: false, 
                cache: false,
                processData: false,
                success: function(response) { 
                    if (response.status == 'success'){
                        $.notify("Document uploaded successfully", 'success');
                        setTimeout(function() {
                        location.reload();
                        $(".loader").hide();
                        }, 1000);
                    }else{
                        $.notify("Something went wrong, Please contact Admin");
                    }
                },
                error: function() {
                $.notify("Something went wrong, Please contact Admin");
            },
            });                
        }
    });

    $("#myFrm").validate({
        rules: {
            memberName: {
                required : true,
            },
            document_name: {
                required : true,
                extension: "pdf"
            },            
        }, messages: {
            document_name: {
                extension: "Invalid type of file uploaded (only pdf allowed)."
            }
        }
    });  

    function deleteDocument(id){

        var oldFile = $("#oldFile_"+id).val();
        var form_data = new FormData();
        form_data.append('id', id);
        form_data.append('oldFile', oldFile);
        form_data.append('_token', document.getElementsByName("_token")[0].value);
        $(".loader").show();

        $.ajax({
            url: "/society/delete_documents",
            data: form_data,
            type: 'POST',
            dataType : "json",
            contentType: false,
            cache: false, 
            processData: false,
            success: function(response) {                
                if (response.status == 'success'){
                    $(".loader").hide();
                    location.reload();
                }else{
                    alert('Something went wrong, Please contact Admin.');
                }
            }
        });                 
    } 

    $(document).ready(function () {
      $('#dtBasicExample').DataTable();
      $('.dataTables_length').addClass('bs-select');

      $('#dtBasicExample_wrapper > .row:first-child').remove();
    });  

    $('table').dataTable({searching: false, ordering:false, info: false});
</script>
@endsection


