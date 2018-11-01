@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.architect.actions',compact('ArchitectApplication'))
@endsection
@section('content')
<div class="col-md-12">
    <div id="show-offer-letter" style="display: block;">
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body" style="padding-right: 0;">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    <div class="caption">
                        <i class="fa fa-gift"></i> {{Session::get('success')}}
                    </div>
                    <div class="tools pull-right">
                        <a href="" class="remove" data-original-title="" title=""> </a>
                    </div>
                </div>
                @endif
                @if(Session::has('error'))
                <div class="alert alert-error">
                    <div class="caption">
                        <i class="fa fa-gift"></i> {{Session::get('error')}}
                    </div>
                    <div class="tools pull-right">
                        <a href="" class="remove" data-original-title="" title=""> </a>
                    </div>
                </div>
                @endif
                <h3 class="section-title section-title--small mb-0">Certificate:</h3>
                {{-- <div class="row-list">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="font-weight-semi-bold">Edit Offer letter</p>
                            <p>Click to view generated offer letter in PDF format</p>
                            <a href="{{route('architect.edit_certificate',$encryptedId)}}" class="btn btn-primary">
                                Edit
                                offer Letter</a>
                            <!-- <button type="submit">Edit offer Letter </button> -->
                        </div>
                    </div>
                </div> --}}

                <div class="w-100 row-list">
                    <div class="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="d-flex flex-column h-100">
                                    <h5>Download Certificate</h5>
                                    <span class="hint-text">Want to make changes in Certificate, click
                                        on below button to download Certificate</span>
                                    <div class="mt-3">

                                        @if($ArchitectApplication->drafted_certificate!="")
                                        <a target="_blank" href="{{config('commanConfig.storage_server').'/'.$ArchitectApplication->certificate_path}}"
                                            class="btn btn-primary">Download Certificate</a>
                                        @else
                                        <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                            * Note : Offer Letter not available. </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(config('commanConfig.architect')==session()->get('role_name'))
                            <div class="col-sm-6 border-left">
                                <div class="d-flex flex-column h-100">
                                    <h5>Upload Certificate</h5>
                                    <span class="hint-text">Click on 'Upload' to upload Certificate</span>
                                    <form action="{{route('architect.post_final_signed_certificate')}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="custom-file">
                                            <input class="custom-file-input pdfcheck" name="certificate" type="file" id="test-upload"
                                                required="required">
                                            <label class="custom-file-label" for="test-upload">Choose
                                                file...</label>
                                            <input type="hidden" name="ap_no" value="{{$encryptedId}}">
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
        @if(config('commanConfig.architect')==session()->get('role_name'))
        @php 
        $status_id=isset($ArchitectApplication->statusLog[0])?$ArchitectApplication->statusLog[0]->status_id:0; 
        @endphp
        
        @if($status_id!=config('commanConfig.architect_applicationStatus.approved'))
        <form role="form" id="sendForApproval" style="margin-top: 30px;" name="sendForApproval" class="form-horizontal"
    method="post" action="{{route('appointing_architect.send_to_candidate')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="applicationId" value="{{$encryptedId}}">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                        <div class="">
                            <h3 class="section-title section-title--small">Send to Candidate:</h3>
                        </div>
                        <div class="remarks-suggestions">
                            <div class="mt-3 table--box-input">
                                <label for="demarkation_comments">Comment:</label>
                                <textarea required id="demarkation_comments" rows="5" cols="30" class="form-control form-control--custom"
                                    name="comment"></textarea>
                            </div>
                            <div class="mt-3 btn-list">
                                <button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endif
        @endif
    </div>
</div>
@endsection
