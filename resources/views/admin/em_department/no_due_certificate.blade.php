@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.em_department.action_oc',compact('oc_application'))
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
      {!! '
      <div class="alert alert-success alert-block">'.session('success_msg').'</div>
      ' !!}
      @endif
   </div>
   <div class="col-md-12">
      <div class="d-flex">
         {{ Breadcrumbs::render('em_generate_no_due_certificate',$oc_application->id) }}
         <div class="ml-auto btn-list">
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
         </div>
      </div>
      <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
         <li class="nav-item m-tabs__item">
            <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#generate-no-due_cert" role="tab"
               aria-selected="false">
            <i class="la la-cog"></i> No Dues Certificate
            </a>
         </li>
         <li class="nav-item m-tabs__item">
            <a class="nav-link m-tabs__link show" data-toggle="tab" href="#covering_letter">
            <i class="la la-cog"></i> Covering Letter
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
                           <span class="field-name">Society Registration No:</span>
                           <span class="field-value">{{(isset($societyData->eeApplicationSociety->registration_no) ?
                           $societyData->eeApplicationSociety->registration_no : '')}}</span>
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
         <div class="tab-pane active show" id="generate-no-due_cert">
            <div class="m-portlet m-portlet--mobile m_panel">
               <div class="m-portlet__body" style="padding-right: 0;">
                  @if($societyData->em_eng && !(isset($oc_application->status->status_id) && $oc_application->status->status_id == 2))
                  <h3 class="section-title section-title--small mb-0">No Dues Certificate:</h3>
                  <div class=" row-list">
                     <div class="row">
                        <div class="col-md-12">
                           <p class="font-weight-semi-bold">
                              @if(!empty($oc_application->no_dues_certificate_draft))
                              Edit No Dues Certificate
                              @else
                              Generate No Dues Certificate
                              @endif
                           </p>
                           <p>Click to view generated No Dues Certificate in PDF format</p>
                           <a href="{{route('em.create_edit_ndc',$societyData->id)}}" class="btn btn-primary">
                           @if(!empty($oc_application->no_dues_certificate_draft))
                           Edit No Dues Certificate
                           @else
                           Generate No Dues Certificate
                           @endif
                           </a>
                           <!-- <button type="submit">Edit offer Letter </button> -->
                        </div>
                     </div>
                  </div>
                  @endif
                  @if(!empty($oc_application->no_dues_certificate_draft))
                  <div class="w-100 row-list">
                     <div class="">
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="d-flex flex-column h-100">
                                 <h5>Download No Dues Certificate</h5>
                                 <div class="mt-auto">
                                    <a style="margin-top: 3%" target="_blank" href="{{config('commanConfig.storage_server').'/'.$oc_application->no_dues_certificate_draft}}"
                                       class="btn btn-primary">Download</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endif
               </div>
            </div>
         </div>
         <div class="tab-pane show" id="covering_letter">
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
                              @if(isset($oc_application->em_office_note_oc) && !empty($oc_application->em_office_note_oc))
                              <div class="col-sm-6">
                                 <div class="d-flex flex-column h-100 two-cols">
                                    <h5>Download Note</h5>
                                    <div class="mt-auto">
                                       <a target="_blank" href="{{ config('commanConfig.storage_server').'/'.$oc_application->em_office_note_oc}} ">
                                       <button class="btn btn-primary">
                                       Download EM Note</button>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                              @else
                              <div class="col-sm-6">
                                 <div class="d-flex flex-column h-100 two-cols">
                                    <h5>Upload Note</h5>
                                    <span class="hint-text">Click on 'Upload' to upload EM - Cover letter</span>
                                    <form action="{{ route('em.upload_office-note-oc') }}" method="post"
                                       enctype="multipart/form-data" style="margin-left: -2%;">
                                       @csrf
                                       <input type="hidden" name="application_id" value="{{ $oc_application->id }}">
                                       <div class="custom-file">
                                          <input class="custom-file-input" name="em_office_note_oc" type="file"
                                             id="test-upload" required="">
                                          <label class="custom-file-label" for="test-upload">Choose
                                          file...</label>
                                       </div>
                                       <span class="text-danger" id="file_error"></span>
                                       <div class="mt-auto">
                                          <button type="submit" class="btn btn-primary btn-custom upload_note"
                                             id="uploadBtn">Upload</button>
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