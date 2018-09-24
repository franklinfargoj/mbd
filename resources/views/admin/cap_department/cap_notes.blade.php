@extends('admin.layouts.app')
@section('css')
<!-- <style> -->
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css"/>

<!-- </style> -->
@endsection
@section('content')

<!-- BEGIN: Subheader -->
<div class="m-subheader ">
  <div class="d-flex align-items-center">
     <div class="mr-auto">
        <h3 class="m-subheader__title m-subheader__title--separator title">
        CAP - Notes </h3>
     </div>
  </div>
</div>
<div class="m-content"></div>

<!-- society and Appointed Architect details -->
<form role="form" id="CAPnotes" style="margin-top: 30px;" name="CAPnotes" class="form-horizontal" method="post" action="{{ route('cap.upload_cap_note')}}"
    enctype="multipart/form-data">
   @csrf 

  <input type="hidden" name="applicationId" value="{{(isset($applicationId) ? $applicationId : '')}}">
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
                                      <h5>Download Note</h5>
                                      <span class="hint-text">Download CAP Note uploaded by CAP</span>
                                      <div class="mt-auto">
                                          <a href="{{ asset(isset($capNote->document_path) ? $capNote->document_path : '' )}}" class="s_btn btn btn-primary" disabled id="submitBtn">Download</a> 
                                      </div>
                                  </div>
                              </div>
                              <div class="col-sm-6 border-left">
                                  <div class="d-flex flex-column h-100 two-cols">
                                      <h5>Upload Note</h5>
                                      <span class="hint-text">Click on 'Upload' to upload CAP - Note
                                      -
                                      Note</span>
                                      <form action="" method="post">
                                          <div class="custom-file">
                                              <input class="custom-file-input"  type="file"
                                                     id="test-upload" name="cap_note" required="">
                                              <label class="custom-file-label" for="test-upload">Choose
                                                  file...</label>
                                          </div>
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
  </div>
</form>



@endsection   