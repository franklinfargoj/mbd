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
        DyCE Scrutiny & Remark </h3>
     </div>
  </div>
</div>
<div class="m-content"></div>

<!-- society and Appointed Architect details -->
<form role="form" id="CAPnotes" style="margin-top: 30px;" name="CAPnotes" class="form-horizontal" method="post" action="{{ route('cap.uploadCapNote')}}"
    enctype="multipart/form-data">
   @csrf 

 <div class="m-portlet m-portlet--mobile m_panel">
    <div class="m-portlet__body main_panel">
      <div class="d-flex align-items-center">
          <h3 class="section-title section-title--small">
              Upload Note
          </h3>
      </div>
      <span class="field-name"> Click on 'Upload' to upload CAP - Note</span>
      <div class="d-flex flex-wrap align-items-center mb-5 upload_doc_1">
          <div class="custom-file width-auto mb-0 position-relative">
              <input type="file" class="file custom-file-input upload_file_1" name="document[]" id="test-upload">
              <label class="custom-file-label" for="test-upload">Choose file ...</label>
          </div>
      </div>  
      <input type="submit" class="s_btn btn btn-primary" id="submitBtn" value="Upload">              
    </div>
</div> 
</form>
@endsection   