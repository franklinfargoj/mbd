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
    <div class="m-subheader px-0">
        <div class="d-flex">
            {{-- {{ Breadcrumbs::render('calculation_sheet',$ol_application->id) }} --}}
            <div class="ml-auto btn-list">
                <a href="javascript:void(0);" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
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
<form class="nav-tabs-form" id ="StampSignAgreementFRM" role="form" method="POST" action="{{ route('dyco.save_stamp_sign_agreement')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
    <div class="tab-content">
        <div class="tab-pane active show" id="sale-deed-agreement" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-subheader" style="padding: 0;">
                            <div class="d-flex align-items-center justify-content-center">
                                <h4 class="section-title">
                                    Sale Deed Agreement
                                </h4>
                            </div>
                        </div>
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Click to download Sale Deed Agreement </span>
                                            <div class="mt-auto">
                                                @if(isset($data->StampSignSaleAgreement->document_path))
                                                <a href="{{ config('commanConfig.storage_server').'/'.$data->StampSignSaleAgreement->document_path }}">
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
                        <div class="m-subheader" style="padding: 0;">
                            <div class="d-flex align-items-center justify-content-center">
                                <h4 class="section-title">
                                    Lease Deed Agreement
                                </h4>
                            </div>
                        </div>
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Click to download Lease Deed Agreement</span>
                                            <div class="mt-auto">
                                                @if(isset($data->StampSignLeaseAgreement->document_path))
                                                <a href="{{ config('commanConfig.storage_server').'/'.$data->StampSignLeaseAgreement->document_path }}">
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
    @if($status->status_id == config('commanConfig.applicationStatus.in_process'))
        <div class="m-portlet m-portlet--mobile m_panel">  
            <div class="m-portlet__body">   
                <div class="col-xs-12 row">
                    <div class="col-md-12">
                        <h3 class="section-title section-title--small">Remark</h3>
                            <textarea rows="4" cols="63" name="remark"></textarea>
                            <button type="submit" class="btn btn-primary mt-3" style="display:block">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endif 
 </form>   
</div>

@if(session()->get('role_name') == config('commanConfig.dyco_engineer') && $status->status_id != config('commanConfig.applicationStatus.forwarded'))
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body">
            <h3 class="section-title section-title--small">Send To Society</h3>
            <div class="col-xs-12 row">
                <div class="col-md-12">
                    <form class="nav-tabs-form" id ="agreementFRM" role="form" method="POST" action="{{ route('dyco.send_to_society')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
                        <div class="col-md-6" style="display: inline;">
                                <Button type="submit" class="s_btn btn btn-primary" id="submitBtn">
                                send to society </Button>
                            </div>     
                    </form>    
                </div>
            </div>
        </div>
    </div>
@endif      


@endsection
