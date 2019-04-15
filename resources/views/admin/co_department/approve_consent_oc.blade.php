@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.co_department.action_oc',compact('oc_application'))
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
   {{ session()->get('success') }}
</div>
@endif

<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Approve Consent for OC </h3>
                {{ Breadcrumbs::render('issue_consent_oc',$oc_application->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                <div class="w-100 row-list">
                    <div class="row">
                       <div class="col-sm-6">
                          <div class="d-flex flex-column h-100">
                             <h5>Download Draft OC</h5>
                             <div class="mt-auto">
                            @if(isset($applicationData->oc_path) && !empty($applicationData->oc_path))
                                <a style="margin-top: 3%" target="_blank" href="{{config('commanConfig.storage_server').'/'.$applicationData->oc_path}}"
                                   class="btn btn-primary">Download</a>
                            @else
                               <a style="margin-top: 3%" target="_blank" href="{{config('commanConfig.storage_server').'/'.$applicationData->oc_path}}"
                                   class="btn btn-primary">Download</a> 
                            @endif
                             </div>
                          </div>
                       </div>
                       @if(isset($oc_application->status->status_id) && $oc_application->status->status_id != config('commanConfig.applicationStatus.forwarded'))
                       <div class="col-sm-6 border-left">
                          <div class="d-flex flex-column h-100">
                             <h5>Upload Noc</h5>
                             <span class="hint-text">Click on 'Upload' to upload OC</span>
                             <form action="{{route('ree.upload_draft_consent_oc',$oc_application->id)}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="custom-file">
                                   <input class="custom-file-input pdfcheck" name="oc_letter" type="file"
                                      id="test-upload" required="required">
                                   <label class="custom-file-label" for="test-upload">Choose
                                   file...</label>
                                   <span class="text-danger" id="file_error"></span>
                                </div>
                                <div class="mt-auto">
                                   <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                </div>
                             </form>
                          </div>
                       </div>
                       @endif
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                <div class="">
                    <h3 class="section-title section-title--small">
                        Remark by REE</h3>
                </div>
                <!-- @if(isset($applicationData->oc_path) && !empty($applicationData->oc_path))
                <div class="mt-3 btn-list">
                    <a href="{{config('commanConfig.storage_server').'/'.$applicationData->oc_path}}" class="btn btn-primary" target="_blank">View Consent for OC</a>
                </div>
                @else
                <span class="text-danger">*Note : Consent for OC not available.</span>
                @endif -->

                <div class="remarks-suggestions">
                    <div class="mt-3">
                        <!-- <label for="demarkation_comments">Remark by REE</label> -->
                        <textarea id="demarkation_comments" rows="5" cols="30" class="form-control form-control--custom"
                            name="demarkation_comments" disabled>{{ isset($applicationData->ReeLog->remark) ? $applicationData->ReeLog->remark : '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        <form role="form" id="sendNoc" style="margin-top: 30px;" name="sendForApproval" class="form-horizontal" method="post" action="{{ route('co.issue_oc_letter_to_ree')}}" enctype="multipart/form-data">
        @csrf 
        <input type="hidden" name="applicationId" value="{{$applicationData->id}}">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                        <div class="">
                            <h3 class="section-title section-title--small">
                                Remarks by CO</h3>
                        </div>
                        <input type="hidden" name="is_approve_oc" value="1">
                        <div class="remarks-suggestions">
                            <div class="mt-3">
                                <textarea id="remark" rows="5" cols="30" class="form-control form-control--custom" name="remark" {{$oc_application->status->status_id == config('commanConfig.applicationStatus.forwarded') ? 'readonly' : '' }}></textarea>
                            </div>
                            @if($oc_application->status->status_id == config('commanConfig.applicationStatus.OC_Generation'))
                                <div class="mt-3 btn-list">
                                    <input type="submit" class="btn btn-primary" value="Approve">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>
</div>
@endsection