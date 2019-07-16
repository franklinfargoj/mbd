@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.conveyance.actions',compact('sc_application'))
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
<div class="panel" id="ee-note">
    <!-- upload and download application form -->
    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table">
                <div class="m-subheader" style="padding: 0;">
                    <div class="d-flex align-items-center justify-content-center">
                        <h4 class="section-title">
                            Application for {{ $sc_application->scApplicationType->application_type }}
                        </h4>
                    </div>
                </div>
                <div class="m-section__content mb-0 table-responsive">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="d-flex flex-column h-100 two-cols">
                                    <h5>Download Conveyance Application</h5>
                                    <span class="hint-text">Download submitted application in .pdf format</span>
                                    <div class="mt-auto">
                                        <a title="Donwload Conveyance Application" href="{{ route('sc_form_download') }}" target="_blank" class="btn btn-primary" rel="noopener"><i class="icon-pencil"></i>Donwload Conveyance Application</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 border-left">
                                <div class="d-flex flex-column h-100 two-cols">
                                    <h5>Upload Signed & Stamped Application here</h5>
                                    <span class="hint-text">Click on 'Upload' to upload signed & stamped application for society conveyance.</span>
                                    <form id="sc_form" action="{{ route('sc_form_upload') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="applicationId" value="{{ $sc_application->id }}">
                                        <div class="custom-file">
                                            <input class="custom-file-input" name="sc_application_form" type="file" id="test-upload" required="">
                                            <label class="custom-file-label" for="test-upload">Choose
                                                file...</label>
                                            <span class="help-block">
                                        </span>
                                            <input type="hidden" name="id" value="{{ $sc_application->id }}">
                                        </div>
                                        @if(isset($uploaded_stamped_application->document_path))
                                            <a class="btn-link" target="_blank" href=" {{ config('commanConfig.storage_server').$uploaded_stamped_application->document_path }}"> Download </a>
                                        @endif
                                        <div class="mt-auto">
                                            <button type="submit" class="btn btn-primary btn-custom"
                                                    id="uploadBtn">Upload</button>
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

    <!-- forward application -->
    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table">
                <div class="m-subheader" style="padding: 0;">
                    <div class="d-flex">
                        <h4 class="section-title" style="margin-left: 31px;">
                            Forward Application
                        </h4>
                    </div>
                </div>
                <div class="m-section__content mb-0 table-responsive">
                    <div class="container">
                        <div class="col-sm-12">
                            <span class="hint-text">Click on 'Submit' to forward society conveyance application form.</span>
                            <form id="sc_form" action="{{ route('sc_submit_application') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="applicationId" value="{{ $sc_application->id }}">
                                <input type="hidden" name="applicationFile" value="{{ isset($uploaded_stamped_application->document_path) ? $uploaded_stamped_application->document_path : '' }}">
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary btn-custom"
                                            id="uploadBtn" onclick="return confirm('Are you sure you want to submit the application.');">Submit</button>
                                    @if(!isset($uploaded_stamped_application) && !isset($uploaded_stamped_application->document_path))
                                        <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                        * Note : Please upload signed Conveyance application. </span>
                                    @endif            
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('datatablejs')
    <script>
        $('#sc_form').validate({
            rules:{
                sc_application_form: {
                    required:true,
                    extension:'pdf'
                }
            },
            messages:{
                sc_application_form: {
                    required: 'File is required to upload.',
                    extension: 'File only in pdf format is required.'
                }
            }
        });
    </script>
@endsection
