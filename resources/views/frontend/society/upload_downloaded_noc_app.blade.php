@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.actions_noc',compact('noc_applications'))
@endsection
@section('content')
@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div> 
@endif

@if(session()->has('error'))
<div class="alert alert-danger display_msg">
    {{ session()->get('error') }}
</div> 
@endif
<style>
.help-block{
    color:red;
} 
</style>
<div class="panel" id="ee-note">
    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table">
                <div class="m-subheader" style="padding: 0;">
                    <div class="d-flex align-items-center justify-content-center">
                        <h4 class="section-title">
                            {{ $application_details->noc_application_master->title }}
                        </h4>
                    </div>
                </div>
                <div class="m-section__content mb-0 table-responsive">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="d-flex flex-column h-100 two-cols">
                                    <h5>Download Noc Application</h5>
                                    <span class="hint-text">Download submitted application in .pdf format</span>
                                    <div class="mt-auto">
                                        <a title="Download Noc Application" href="{{ route('society_noc_application_download',encrypt($noc_applications->id)) }}" target="_blank" class="btn btn-primary" rel="noopener"><i class="icon-pencil"></i>Download Noc Application</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 border-left">
                                <div class="d-flex flex-column h-100 two-cols">
                                    <h5>Upload Signed & Stamped Application here</h5>
                                    <span class="hint-text">Click on 'Upload' to upload signed & stamped application of Noc.</span>
                                    <form action="{{ route('upload_society_noc') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <input type="hidden" name="applicationId" value="{{ $noc_applications->id }}">
                                        <div class="custom-file">
                                            <input class="custom-file-input" name="noc_application_form" type="file"
                                                id="test-upload" required="">
                                            <label class="custom-file-label" for="test-upload">Choose file...</label>
                                            <span class="help-block">
                                                @if(session('error_uploaded_file'))
                                                {{session('error_uploaded_file')}}
                                                @endif
                                            </span> 
                                            @if(isset($noc_applications->application_path) && $noc_applications->application_path != 'test')
                                            <p><a href="{{ $noc_applications->application_path }}" class="btn-link" target="_blank"> Download </a> </p>
                                            @endif
                                            <input type="hidden" name="id" value="{{ $application_details->id }}">
                                        </div>
                                        <div class="mt-auto">
                                            <button type="submit" class="btn btn-primary btn-custom"
                                                id="uploadBtn">Upload and Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- submit application block -->
    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                <div class="">
                    <h3 class="section-title section-title--small">Submit Application</h3>
                    <span class="hint-text">click on 'submit' to submit application</span>
                </div>
                <form action="{{ route('submit_noc_application') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="applicationId" value="{{ $noc_applications->id }}">
                    <div class="remarks-suggestions table--box-input">
                        <div class="mt-3 btn-list">
                            <button class="btn btn-primary" type="submit" id="submitas" onclick="return confirm('Are you sure you want to submit the application.');" {{ ($noc_applications->application_path == 'test') ? 'disabled' : '' }}>Submit</button>
                           
                        @if(isset($noc_applications->application_path) && $noc_applications->application_path == 'test')
                            <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                 * Note : Please upload sign NOC Application. </span>
                        @endif          
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection