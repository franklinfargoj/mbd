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

<form role="form" id="CAPnotes" style="margin-top: 30px;" name="CAPnotes" class="form-horizontal" method="post" enctype="multipart/form-data">
   @csrf 

   <div class="m-portlet m-portlet--mobile m_panel">
      <div class="m-portlet__body main_panel">
        <div class="d-flex align-items-center">
            <h3 class="section-title section-title--small">
                Download Note
            </h3>
        </div>
        <span class="field-name"> Download CAP Note uploaded by CAP</span>
        <div class="d-flex flex-wrap align-items-center mb-5 upload_doc_1">
        </div> 
        @if(isset($capNote->document_path))
          <a href="{{ asset($capNote->document_path) }}">
          <Button type="button" class="s_btn btn btn-primary" id="submitBtn"> Download </Button>
         </a>
        @else
        <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;"> 
        *Note : CAP note is not available.</span>  
        @endif
                    
      </div>
  </div> 
</form>
@endsection   