@extends('admin.layouts.sidebarAction')
@section('css')
<!-- <style> -->
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css" />

<!-- </style> -->
@endsection
@section('content')

@if(session()->has('success'))
  <div class="alert alert-success display_msg">
      {{ session()->get('success') }}
  </div>  
  @endif
  @if(session()->has('pdf_error')) 
   <div class="alert alert-error display_msg">
      {{ session()->get('pdf_error') }}
  </div>
@endif

<!-- BEGIN: Subheader -->
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
                CAP - Notes </h3>
               
                <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div>

    <!-- society and Appointed Architect details -->
    <form role="form" id="CAPnotes" style="margin-top: 30px;" name="CAPnotes" class="form-horizontal" method="post"
        action="{{ route('cap.upload_cap_note')}}" enctype="multipart/form-data">
        @csrf

        <div class="panel" id="ee-note">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-subheader" style="padding: 0;">
                            <div class="d-flex align-items-center justify-content-center">
                                <h3 class="section-title">
                                    Note
                                </h3>
                            </div>
                        </div>
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download CAP Note</h5>
                                            <!-- <span class="hint-text">Download  Note uploaded by CAP</span> -->
                                            <div class="mt-auto">


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Upload CAP Note</h5>
                                            <!-- <span class="hint-text">Click on 'Upload' to upload  - Note -->
                                                
                                                <!-- Note</span> -->
                                            <!-- <form action="" method="post"> -->
                                                <div class="custom-file">
                                                    <input class="custom-file-input cap_note" type="file" id="test-upload" name="cap_note"
                                                        required="">
                                                    <label class="custom-file-label" for="test-upload">Choose
                                                        file...</label>
                                                </div>
                                                <span class="text-danger" id="file_error"></span>
                                                <div class="mt-auto">
                                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                </div>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection   
@section('js')
  <script>
    
  </script>
@endsection




