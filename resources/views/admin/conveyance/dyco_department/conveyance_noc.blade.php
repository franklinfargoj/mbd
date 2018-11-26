@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.conveyance.dyco_department.action',compact('data'))
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
            <!-- <h3 class="m-subheader__title m-subheader__title--separator">
            Approved Sale & Lease Deed Agreement
            </h3> -->
            {{-- {{ Breadcrumbs::render('calculation_sheet',$ol_application->id) }} --}}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
<form class="nav-tabs-form" id ="agreementFRM" role="form" method="POST" action="{{ route('dyco.send_to_society')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
   <!-- Generate stamp duty letter      -->
<div class="m-portlet m-portlet--mobile m_panel">
    <div class="m-portlet__body">
        <h3 class="section-title section-title--small">Generate NOC</h3>
        <div class="col-xs-12 row">
            <div class="col-md-12">
                <!-- <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}"> -->
              <!--   <div class="col-md-6" style="display: inline; margin-left: 20px;">
                    <a href="{{ route('dyco.generate_canveyance_noc',$data->id) }}" class="btn btn-primary">Generate </ -->
                   <!--  <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                      </Button> -->
                </div> 
            </div>
        </div>
        <div class="m-section__content mb-0 table-responsive" style="margin-top: 30px;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="d-flex flex-column h-100 two-cols">
                            <h5>Generate NOC</h5>
                            <span class="hint-text">Click to Generate NOC </span>
                            <div class="mt-auto">
                            
                                <a href="{{ route('dyco.generate_canveyance_noc',$data->id) }}" class="btn btn-primary">Generate </a>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 border-left">
                        <div class="d-flex flex-column h-100 two-cols">
                            <h5>Upload</h5>
                            <span class="hint-text">Click to upload Lease deed agreement</span>
                                <div class="custom-file">
                                    <input class="custom-file-input stamp_letter" name="stamp_letter" type="file" id="test-upload1"><label class="custom-file-label" for="test-upload1">Choose
                                        file...</label>   
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                   
    </div>
</div> 
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body">
            <h3 class="section-title section-title--small">NOC for Conveyance</h3>

        <div class="m-section__content mb-0 table-responsive" style="margin-top: 30px;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="d-flex flex-column h-100 two-cols">
                            <h5>Click to download NOC</h5>
                            <!-- <span class="hint-text"> </span> -->
                            <div class="mt-auto">
                                @if(isset($data->draftNOC->document_path))
                                <input type="hidden" name="draftNoc" value="{{ $data->draftNOC->document_path }}">
                                <a href="{{ config('commanConfig.storage_server').'/'.$data->draftNOC->document_path }}">
                                <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                        Download </Button>
                                </a>
                                @else
                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                    *Note : NOC is not available.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 border-left">
                        <div class="d-flex flex-column h-100 two-cols">
                            <h5>Click to send NOC to Society</h5>
                            <!-- <span class="hint-text"></span> -->
                     @if($data->is_view && $data->status->status_id == config('commanConfig.applicationStatus.NOC_Issued'))
                        <div class="col-md-6" style="display: inline;">
                            <Button type="submit" class="s_btn btn btn-primary" id="submitBtn">
                            Send to Society </Button>
                        </div> 
                    @endif 
                        </div>
                    </div>
                </div>
            </div>
        </div>            
            <!-- <div class="col-xs-12 row"> -->
                
<!--                 <div class="col-md-12">
                    <span class="hint-text d-block t-remark section-title"></h5>Please Download copy of NOC for Conveyance from here.</span>
                    <div class="col-md-6" style="display: inline;">
                        <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                        Download  </Button>
                    </div>
  
                </div> -->
            <!-- </div> -->
        </div>
    </div>
 </form>   
</div>

@endsection
