@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.conveyance.'.$data->folder.'.action')
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif
@php
    if(isset($data->ApprovedSaleAgreement->document_path))
        $document = $data->ApprovedSaleAgreement->document_path;
    else if(isset($data->SignSaleAgreement->document_path))
        $document = $data->SignSaleAgreement->document_path;    
    else if(isset($data->draftSaleAgreement->document_path))
        $document = $data->draftSaleAgreement->document_path;
@endphp
@php
    if(isset($data->ApprovedLeaseAgreement->document_path) )
        $document1 = $data->ApprovedLeaseAgreement->document_path;
    else if(isset($data->SignLeaseAgreement->document_path))
        $document1 = $data->SignLeaseAgreement->document_path;    
    else if(isset($data->draftLeaseAgreement->document_path))
        $document1 = $data->draftLeaseAgreement->document_path;
@endphp

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Sale & Lease Deed Agreement</h3>
                 {{ Breadcrumbs::render('conveyance_approve_sale_lease',$data->id) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
        </div>
    </div> 
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#sale-deed-agreement" role="tab"
                    aria-selected="false">
                    <i class="la la-cog"></i> Sale Deed Agreement
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#lease-deed-agreement" role="tab"
                    aria-selected="true">
                    <i class="la la-bell-o"></i> Lease Deed Agreement
                </a>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane active show" id="sale-deed-agreement" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Click to download Sale Deed Agreement </span>
                                            <div class="mt-auto">
                                                @if(isset($document))
                                                <a href="{{ config('commanConfig.storage_server').'/'.$document }}" target="_blank">
                                                <Button type="button" class="s_btn btn btn-primary" id="submit">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : Sale Deed Agreement is not available.</span>
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

            <!-- Add Send to JT CO here -->
        </div>

        <div class="tab-pane" id="lease-deed-agreement" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Click to download Lease Deed Agreement</span>
                                            <div class="mt-auto">
                                                @if(isset($document1))
                                                <a href="{{ config('commanConfig.storage_server').'/'.$document1 }}" target="_blank">
                                                <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : Lease Deed Agreement is not available.</span>
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

   <!-- Generate stamp duty letter      -->
@if(session()->get('role_name') == config('commanConfig.dyco_engineer') || session()->get('role_name') == config('commanConfig.dycdo_engineer') || session()->get('role_name') == config('commanConfig.cdo_engineer'))
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body">
            <div class="m-subheader" style="padding: 0;">
                <div class="d-flex align-items-center justify-content-center">
                    <h4 class="section-title">
                        Stamp Duty Letter
                    </h4>
                </div>
            </div>
            <div class="m-section__content mb-0 table-responsive" style="margin-top: 30px;">
                <div class="container">
                    <div class="row">  
                        <div class="col-sm-6">
                            <div class="d-flex flex-column h-100 two-cols">
                                <h5>Download</h5>
                                <span class="hint-text">Click to Download Stamp Duty Letter </span>
                                <div class="mt-auto">
                                    @if(session()->get('role_name') == config('commanConfig.dyco_engineer') && $data->status->status_id == config('commanConfig.conveyance_status.forwarded') && $data->approveStampLetter->document_path)
                                    
                                    <a href="{{ config('commanConfig.storage_server').'/'.$data->approveStampLetter->document_path }}" class="btn btn-primary" target="_blank">Download </a>  

                                    @elseif(isset($data->draftStampLetter->document_path))
                                    <a href="{{ config('commanConfig.storage_server').'/'.$data->draftStampLetter->document_path }}" class="btn btn-primary" target="_blank">Download </a>                                
                                    @else
                                    <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                        *Note : Stamp Duty Letter is not available.</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(session()->get('role_name') == config('commanConfig.dyco_engineer') && $data->status->status_id != config('commanConfig.conveyance_status.forwarded'))
                        <div class="col-sm-6 border-left">
                            <form class="nav-tabs-form" id ="stampFRM" role="form" method="POST" action="{{ route('dyco.save_conveyance_stamp_duty')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
                                <div class="d-flex flex-column h-100 two-cols">
                                    <h5>Upload</h5>
                                    <span class="hint-text">Click to upload Stamp Duty Letter</span>
                                        <input type="hidden" id="oldStamp" name="oldStamp" value="{{ isset($data->approveStampLetter->document_path) ? $data->approveStampLetter->document_path : '' }}">
                                            <div class="custom-file">
                                                <input class="custom-file-input stamp_letter" name="stamp_letter" type="file" id="test-upload1">
                                                <label class="custom-file-label" for="test-upload1">Choose
                                                    file...</label> 

                                                    @if(isset($data->approveStampLetter->document_path))
                                                    <a target="_blank" class="btn-link" href="{{ config('commanConfig.storage_server').'/'.$data->approveStampLetter->document_path }}" download>Download</a> 
                                                    @endif    
                                            </div>
                                        <div class="mt-3" >   
                                            <input type="submit" class="btn btn-primary" value="Upload">
                                         </div>                                
                                </div>
                            </form>                             
                        </div>
                        @endif
                    </div>
                </div>
            </div>                   
        </div>
    </div> 
@endif     

    <!-- Letter to pay stamp duty -->
    @if(session()->get('role_name') == config('commanConfig.dyco_engineer') && $data->status->status_id != config('commanConfig.conveyance_status.forwarded'))
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body">
                <div class="m-subheader" style="padding: 0;">
                    <div class="d-flex align-items-center justify-content-center">
                        <h4 class="section-title">
                            Send to Society
                        </h4>
                    </div>
                </div>     
                <div class="m-section__content mb-0 table-responsive" style="margin-top: 30px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="d-flex flex-column h-100 two-cols">
                                    <h5>Send to Stamp Duty Letter Society</h5>
                                    <div class="mt-auto">
                                        <form class="nav-tabs-form" id ="agreementFRM" role="form" method="POST" action="{{ route('dyco.send_to_society')}}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
                                                <input type="submit" class="s_btn btn btn-primary" id="submitStampBtn" value="Send to Society">
                                        </form> 
                                    </div>    
                                    <span class="error" id="stampError" style="display: none;color: #ce2323;margin-bottom: 17px;">
                                        *Note : Please Upload Stamp Duty Letter.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div> 
        </div>       
 @endif     

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

    @if($data->riders)
        <div class="m-portlet m-portlet--mobile m_panel">  
            <div class="m-portlet__body">   
                <div class="col-xs-12 row">
                    <div class="col-md-12">
                        <h3 class="section-title section-title--small">Riders</h3>
                        <textarea rows="4" cols="63" name="remark" readonly>{{ isset($data->riders) ? $data->riders : '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    @endif      

    @if($data->status->status_id != config('commanConfig.conveyance_status.forwarded') && $data->status->status_id != config('commanConfig.conveyance_status.reverted') )

        <div class="m-portlet m-portlet--mobile m_panel">  
            <form class="nav-tabs-form" id ="CommentFRM" role="form" method="POST" action="{{ route('conveyance.save_agreement_comments')}}">
                @csrf   
                 <input type="hidden" name="application_id" value="{{ isset($data->id) ? $data->id : '' }}">
                <div class="m-portlet__body">   
                    <div class="col-xs-12 row">
                        <div class="col-md-12">
                            <h3 class="section-title section-title--small">Remark</h3>
                                <textarea rows="4" cols="63" name="remark"></textarea>
                                <button type="submit" class="btn btn-primary mt-3" id="remark_btn" style="display:block">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endif
        
@endsection
@section('js')
<script>
    $("#stampFRM").validate({
        rules: {
            stamp_letter: {
                extension: "pdf",
                required : true
            },            
        }, messages: {
            stamp_letter: {
                extension: "Invalid type of file uploaded (only pdf allowed)."
            },            
        }
    });    

    $("#CommentFRM").validate({
        rules: {
            remark: {
                required : true
            },            
        }
    });  

    $("#submitStampBtn").click(function(){
        
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
