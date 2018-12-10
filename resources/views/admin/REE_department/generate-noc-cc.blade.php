@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.REE_department.action_noc_cc',compact('noc_application'))
@endsection
@section('content')
@if(session()->has('success'))
<div class="alert alert-success display_msg">
   {{ session()->get('success') }}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-success display_msg">
   {{ session()->get('error') }}
</div>
@endif
<div class="custom-wrapper">
    <div class="col-md-12">
        @if (Session::has('success_msg'))
            {!! '<div class="alert alert-success alert-block">'.session('success_msg').'</div>' !!}
       @endif
    </div>
   <div class="col-md-12">
      <div class="d-flex">
         {{ Breadcrumbs::render('generate_noc_cc',$noc_application->id) }}
         <div class="ml-auto btn-list">
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
         </div>
      </div>
      <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
         <li class="nav-item m-tabs__item">
            <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#generate-offer-letter" role="tab"
               aria-selected="false">
            <i class="la la-cog"></i> Generate Noc
            </a>
         </li>
      </ul>
      <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
         <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
               <div class="m-subheader">
                  <div class="d-flex align-items-center">
                     <h3 class="section-title section-title--small">
                        Society Details:
                     </h3>
                  </div>
                  <div class="row field-row">
                     <div class="col-sm-6 field-col">
                        <div class="d-flex">
                           <span class="field-name">Application Number:</span>
                           <span class="field-value">{{(isset($societyData->application_no) ?
                           $societyData->application_no : '')}}</span>
                        </div>
                     </div>
                     <div class="col-sm-6 field-col">
                        <div class="d-flex">
                           <span class="field-name">Application Date:</span>
                           <span class="field-value">{{ ($societyData->submitted_at ?
                           date(config('commanConfig.dateFormat'), strtotime($societyData->submitted_at))
                           : '')}}</span>
                        </div>
                     </div>
                     <div class="col-sm-6 field-col">
                        <div class="d-flex">
                           <span class="field-name">Society Name:</span>
                           <span class="field-value">{{(isset($societyData->eeApplicationSociety->name) ?
                           $societyData->eeApplicationSociety->name : '')}}</span>
                        </div>
                     </div>
                     <div class="col-sm-6 field-col">
                        <div class="d-flex">
                           <span class="field-name">Society Address:</span>
                           <span class="field-value">{{(isset($societyData->eeApplicationSociety->address) ?
                           $societyData->eeApplicationSociety->address : '')}}</span>
                        </div>
                     </div>
                     <div class="col-sm-6 field-col">
                        <div class="d-flex">
                           <span class="field-name">Building Number:</span>
                           <span class="field-value">{{(isset($societyData->eeApplicationSociety->building_no)
                           ? $societyData->eeApplicationSociety->building_no : '')}}</span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="m-subheader">
                  <div class="d-flex align-items-center">
                     <h3 class="section-title section-title--small">
                        Appointed Architect Details:
                     </h3>
                  </div>
                  <div class="row field-row">
                     <div class="col-sm-6 field-col">
                        <div class="d-flex">
                           <span class="field-name">Name of Architect:</span>
                           <span class="field-value">{{(isset($societyData->eeApplicationSociety->name_of_architect)
                           ? $societyData->eeApplicationSociety->name_of_architect : '')}}</span>
                        </div>
                     </div>
                     <div class="col-sm-6 field-col">
                        <div class="d-flex">
                           <span class="field-name">Architect Mobile Number:</span>
                           <span class="field-value">{{(isset($societyData->eeApplicationSociety->architect_mobile_no)
                           ? $societyData->eeApplicationSociety->architect_mobile_no : '')}}</span>
                        </div>
                     </div>
                     <div class="col-sm-6 field-col">
                        <div class="d-flex">
                           <span class="field-name">Architect Address:</span>
                           <span class="field-value">{{(isset($societyData->eeApplicationSociety->architect_address)
                           ? $societyData->eeApplicationSociety->architect_address : '')}}</span>
                        </div>
                     </div>
                     <div class="col-sm-6 field-col">
                        <div class="d-flex">
                           <span class="field-name">Architect Telephone Number:</span>
                           <span class="field-value">{{(isset($societyData->eeApplicationSociety->architect_telephone_no)
                           ? $societyData->eeApplicationSociety->architect_telephone_no : '')}}</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tab-content">
         <div id="show-noc">
            <div class="m-portlet m-portlet--mobile m_panel">
               <div class="m-portlet__body" style="padding-right: 0;">
                  @if($societyData->ree_Jr_id && empty($noc_application->final_draft_noc_path))
                  <h3 class="section-title section-title--small mb-0">Noc:</h3>
                  <div class=" row-list">
                     <div class="row">
                        <div class="col-md-12">
                           <p class="font-weight-semi-bold">
                            @if(!empty($noc_application->draft_noc_path))
                            Edit Draft Noc
                            @else
                            Generate Draft Noc
                            @endif
                           </p>
                           <p>Click to view generated Noc in PDF format</p>
                           <a href="{{route('ree.create_edit_noc_cc',$societyData->id)}}" class="btn btn-primary">
                               @if(!empty($noc_application->draft_noc_path))
                                Edit
                               @else
                                Generate
                               @endif
                            </a>
                           <!-- <button type="submit">Edit offer Letter </button> -->
                        </div>
                     </div>
                  </div>
                  @endif
                  @if(!empty($noc_application->draft_noc_path))
                  <div class="w-100 row-list">
                     <div class="">
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="d-flex flex-column h-100">
                                 <h5>Download Draft Noc</h5>
                                 <div class="mt-auto">
                                @if(empty($noc_application->final_draft_noc_path))
                                    <a style="margin-top: 3%" target="_blank" href="{{config('commanConfig.storage_server').'/'.$noc_application->draft_noc_path}}"
                                       class="btn btn-primary">Download</a>
                                @else
                                   <a style="margin-top: 3%" target="_blank" href="{{config('commanConfig.storage_server').'/'.$noc_application->final_draft_noc_path}}"
                                       class="btn btn-primary">Download</a> 
                                @endif
                                 </div>
                              </div>
                           </div>
                           @if($societyData->ree_Jr_id && $applicationLog->status_id !=
                           config('commanConfig.applicationStatus.forwarded') && empty($noc_application->final_draft_noc_path))
                           <div class="col-sm-6 border-left">
                              <div class="d-flex flex-column h-100">
                                 <h5>Upload Noc</h5>
                                 <span class="hint-text">Click on 'Upload' to upload Noc</span>
                                 <form action="{{route('ree.upload_draft_noc_cc',$societyData->id)}}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="custom-file">
                                       <input class="custom-file-input pdfcheck" name="noc_letter" type="file"
                                          id="test-upload" required="required">
                                       <label class="custom-file-label" for="test-upload">Choose
                                       file...</label>
                                       <span class="text-danger" id="file_error"></span>
                                    </div>
                                    <div class="mt-auto">
                                       <button type="submit" onclick="return confirm('Are you sure you want to upload the draft copy of NOC.Please note once you upload, the same would be finalized and would be uneditable.');" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                           @endif
                        </div>
                     </div>
                  </div>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('js')
<script>
   $('#generate-letter-button').on('click', function () {
       $('#show-offer-letter').css("display", "block");
       $(this).closest("#generate-offer-letter").remove();
   });
   
   $("#uploadBtn").click(function (e) {
   
       myfile = $("#test-upload").val();
       var ext = myfile.split('.').pop();
       if (myfile != "") {
           if (ext != "pdf") {
               $("#file_error").text("Invalid File format(pdf file only).");
               return false;
           } else {
               $("#file_error").text("");
           }
       } else {
           $("#file_error").text("This field required.");
           return false;
       }
   
   });
   
   $(document).ready(function () {
       $(".display_msg").delay(5000).slideUp(300);
   });
   
</script>
@endsection