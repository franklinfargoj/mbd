@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.renewal.'.$data->folder.'.action')
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

@php
    if(isset($data->approveAgreement->document_path))
        $document = $data->approveAgreement->document_path;
    else if(isset($data->DraftSignAgreement->document_path))
        $document = $data->DraftSignAgreement->document_path;    
    else if(isset($data->renewalAgreement->document_path))
        $document = $data->renewalAgreement->document_path;
@endphp

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
         <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Lease Agreement </h3>
                     {{ Breadcrumbs::render('renewal_approve_sale_lease',$data->id) }}
                    <div class="ml-auto btn-list">
                        <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                    </div>
            </div>
        </div>  
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#sale-deed-agreement" role="tab"
                    aria-selected="false">
                    <i class="la la-cog"></i> Renewal of Lease Agreement
                </a>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane active show" id="sale-deed-agreement" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-subheader" style="padding: 0;">
                            <div class="d-flex align-items-center justify-content-center">
                                <h4 class="section-title">
                                    Renewal of Lease Agreement
                                </h4>
                            </div> 
                        </div>
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Click to download Lease deed agreement </span>
                                            <div class="mt-auto">
                                                @if(isset($document))
                                                <a href="{{ config('commanConfig.storage_server').'/'.$document }}" target="_blank">
                                                <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : Lease deed agreement is not available.</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
        
    <!-- display all Agreements comments -->
    @if(count($data->AgreementComments) > 0)       
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body">
            <h3 class="section-title section-title--small">Remark History </h3>
                <div class="remark-body">
                    <div class="remarks-section">
                        <div class="m-scrollable m-scroller ps ps--active-y remarks-section-container"
                            data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">
                            @foreach($data->AgreementComments as $comment)
                                <div class="remarks-section__data">
                                    <p class="remarks-section__data__row"><span>Remark By {{ isset($comment->Roles->display_name) ?  $comment->Roles->display_name : '' }}</p>
                                    <p class="remarks-section__data__row"><span>Remark:</span><span>{{ isset($comment->remark) ? $comment->remark : '' }}</span></p>
                                </div>
                            @endforeach                                         
                        </div>
                    </div>
                </div>               
            </div>    
        </div> 
    @endif  

    <!-- Add your remark -->
    @if($data->status->status_id != config('commanConfig.renewal_status.forwarded') && $data->status->status_id != config('commanConfig.renewal_status.reverted'))    
    <form class="nav-tabs-form" id ="CommentFRM" role="form" method="POST" action="{{ route('renewal.save_agreement_comments')}}">
    @csrf        
        <input type="hidden" name="application_id" id="application_id" value="{{ isset($data->id) ? $data->id : '' }}">  
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body">
                <h3 class="section-title section-title--small">Remark</h3>
                <div class="col-xs-12 row">
                    <div class="col-md-12">
                        <textarea rows="4" cols="63" name="remark"></textarea>
                        <button type="submit" class="btn btn-primary mt-3" style="display:block">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif   
</div>

@endsection

@section('js')
<script>
    // $(".stamp_letter").change(function(){

    //     var id = this.id;
    //     myfile = $("#"+id).val();
    //     var ext = myfile.split('.').pop();
        

    //         if (ext == "pdf"){
    //             $(".loader").show();
    //             var fileData = $("#"+id).prop('files')[0];
    //             var applicationId = $("#application_id").val();
    //             console.log(applicationId);

    //             var form_data = new FormData();
    //             form_data.append('file', fileData);  
    //             form_data.append('doc_name', myfile);  
    //             form_data.append('application_id', applicationId);  
    //             form_data.append('_token', document.getElementsByName("_token")[0].value);  
                
    //             // ajax call to save file    
    //             $.ajax({
    //                 url: "/upload_renewal_stamp_letter", // point to server-side PHP script
    //                 data: form_data,
    //                 type: 'POST',
    //                 contentType: false, // The content type used when sending data to the server.
    //                 cache: false, // To unable request pages to be cached
    //                 processData: false,
    //                 success: function(data) {
    //                     $(".loader").hide();
    //                     if(data == 'success')
    //                         $("#file_error"+id).css("display","none");
    //                 }
    //             });                     
    //         }else{
    //             $("#file_error"+id).text("Invalid type of file uploaded.");
    //             $("#"+id).closest(".custom-file").addClass("has-error");
    //         }        
    // });

    $("#stampFRM").validate({
        rules: {            
            stamp_letter: {
                extension: "pdf",
                required: true
            },
        }, messages: {           
            stamp_letter: {
                extension: "Invalid type of file uploaded (only pdf allowed)."
            }
        }
    }); 

    $("#sendToSociety").click(function(){
        
        var stampLetter = $("#oldStamp").val();
        if(stampLetter != ""){
            $("#stampError").css("display","none"); 
            return true;           
        }else{
            $("#stampError").css("display","block");
            return false;
        }
    });       
</script>
@endsection


