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
 
<div class="col-md-12"> 
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Sale & Lease Deed Agreement</h3>
                 {{ Breadcrumbs::render('conveyance_stamp_sale_lease',$data->id) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
        </div>
    </div> 
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom nav-tabs--stamp-duty" role="tablist">
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
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#resolution" role="tab"
                    aria-selected="true">
                    <i class="la la-bell-o"></i> Society Resolution & Undertalking
                </a>
            </li>
        </ul>
    </div> 

@php
     if(isset($data->StampSaleByDycdo->document_path) && session()->get('role_name') == config('commanConfig.joint_co'))
        $document = $data->StampSaleByDycdo->document_path;
    else if(isset($data->StampSaleAgreement->document_path))
        $document = $data->StampSaleAgreement->document_path;
@endphp
@php 
     if(isset($data->StampLeaseByDycdo->document_path) && session()->get('role_name') == config('commanConfig.joint_co'))
        $document1 = $data->StampLeaseByDycdo->document_path;
    else if(isset($data->StampLeaseAgreement->document_path) )
        $document1 = $data->StampLeaseAgreement->document_path;
@endphp 

<form class="nav-tabs-form" id ="agreementFRM" role="form" method="POST" action="{{ route('conveyance.save_stamp_duty_agreement')}}" enctype="multipart/form-data">

@csrf 
 <input type="hidden" name="application_id" value="{{ isset($data->id) ? $data->id : '' }}">
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
                                                <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : Sale Deed Agreement is not available.</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Upload</h5>
                                            <span class="hint-text">Click on 'Upload' to upload Sale Deed Agreement</span>
                                                <div class="custom-file">
                                                    <input class="custom-file-input" name="sale_agreement" type="file" id="test-upload1">
                                                
                                                        <label class="custom-file-label" for="test-upload1">Choose
                                                        file...</label> 

                                                        @if(isset($data->StampSaleByDycdo->document_path) && session()->get('role_name') == config('commanConfig.dycdo_engineer'))

                                                        <a href="{{ config('commanConfig.storage_server').'/'.$data->StampSaleByDycdo->document_path }}" class="btn-link" target="_blank">Download </a>

                                                        @elseif(isset($data->StampSaleByJtco->document_path) && session()->get('role_name') == config('commanConfig.joint_co'))
                                                        <a href="{{ config('commanConfig.storage_server').'/'.$data->StampSaleByJtco->document_path }}" class="btn-link" target="_blank">Download </a>
                                                        @endif
                                                </div>
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-primary mt-3 upload_btn" style="display:block">Upload</button>   
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
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Upload</h5>
                                            <span class="hint-text">Click to upload Lease Deed Agreement</span>
                                                <div class="custom-file">
                                                    <input class="custom-file-input" name="lease_agreement" type="file" id="test-upload2">
   
                                                    <label class="custom-file-label" for="test-upload2">Choose
                                                        file...</label>
                                                    
                                                    @if(isset($data->StampLeaseByDycdo->document_path) && session()->get('role_name') == config('commanConfig.dycdo_engineer'))

                                                        <a href="{{ config('commanConfig.storage_server').'/'.$data->StampLeaseByDycdo->document_path }}" class="btn-link" target="_blank">Download </a>

                                                        @elseif(isset($data->StampLeaseByJtco->document_path) && session()->get('role_name') == config('commanConfig.joint_co'))
                                                        <a href="{{ config('commanConfig.storage_server').'/'.$data->StampLeaseByJtco->document_path }}" class="btn-link" target="_blank">Download </a>
                                                        @endif  
                                                </div>
                                                 <div class="mt-3">
                                                    <button type="3" id="lease_btn" class="btn btn-primary mt-3 upload_btn" style="display:block">Upload</button>   
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


        <div class="tab-pane" id="resolution" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Download Society resolution</span>
                                            <div class="mt-auto">
                                                @if(isset($data->resolution->document_path))
                                                <a href="{{ config('commanConfig.storage_server').'/'.$data->resolution->document_path }}" target="_blank">
                                                <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : Society resolution is not available.</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div >
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Download Society undertaking</span>
                                            <div class="mt-auto">
                                                @if(isset($data->undertaking->document_path))
                                                <a href="{{ config('commanConfig.storage_server').'/'.$data->undertaking->document_path }}" target="_blank">
                                                <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : Society undertaking is not available.</span>
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

            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Download Indemnity Bond</span>
                                            <div class="mt-auto">
                                                @if(isset($data->indemnity->document_path))
                                                <a href="{{ config('commanConfig.storage_server').'/'.$data->indemnity->document_path }}" target="_blank">
                                                <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : Indemnity Bond is not available.</span>
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
 
    <div id="sale-lease-aggrement" style="margin-top: 30px;">
    
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

        <div class="m-portlet m-portlet--mobile m_panel">  
            <div class="m-portlet__body">   
                <div class="col-xs-12 row">
                    <div class="col-md-12">
                        <h3 class="section-title section-title--small">Remark</h3>
                            <textarea rows="4" cols="63" name="remark" class="form-control form-control--custom"></textarea>  
                            <button type="submit" class="btn btn-primary mt-3 upload_btn" id="remark_btn" style="display:block">Save</button>
                    </div>
                </div>
            </div>
        </div>     
    </div>
</form>    
@endsection

@section('js')
<script type="text/javascript">
    document.querySelector(".nav-tabs--stamp-duty").addEventListener('click', function(e) {
        if(e.target.href.indexOf("resolution") === -1) {
            document.getElementById("sale-lease-aggrement").classList.remove("d-none");
            console.log("!resolution", e.target.href.indexOf("resolution"));            
        } else if (e.target.href.indexOf("resolution") >= -1) {
        console.log("resolution", e.target.href.indexOf("resolution"));

            document.getElementById("sale-lease-aggrement").classList.add("d-none");
        }
        

    })

$(".upload_btn").click(function(){
    var btn = this.id;
    if (btn == 'sale_btn'){ 
        $("#agreementFRM").validate({
            rules: {
                sale_agreement: {
                    required : true,
                    extension: "pdf"
                }          
            }, messages: {
                sale_agreement: {
                    extension: "Invalid type of file uploaded (only pdf allowed)."
                }
            }
        });
    } else if (btn == 'lease_btn'){
        $("#agreementFRM").validate({
            rules: {
                lease_agreement: {
                    required : true,
                    extension: "pdf"
                }          
            }, messages: {
                lease_agreement: {
                    extension: "Invalid type of file uploaded (only pdf allowed)."
                }
            }
        });
    } else if (btn == 'remark_btn'){
        $("#agreementFRM").validate({
            rules: {
                remark: {
                    required : true,
                }          
            }
        });
    }
});    
</script>

@endsection