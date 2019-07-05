@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.REE_department.action_oc',compact('oc_application'))
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

@php $disable = ''; 
  if($societyData->ree_Jr_id && $applicationLog->status_id != config('commanConfig.applicationStatus.forwarded') && $applicationLog->status_id !=
  config('commanConfig.applicationStatus.reverted')) {
    $disable = '';
  }
  else{
    $disable = 'disabled';
  }
@endphp 
<div class="custom-wrapper">
  <div class="col-md-12">
      @if (Session::has('success_msg'))
          {!! '<div class="alert alert-success alert-block">'.session('success_msg').'</div>' !!}
     @endif
  </div>

  <div class="col-md-12">
    <div class="d-flex">
       {{ Breadcrumbs::render('generate_consent_oc',$oc_application->id) }}
       <div class="ml-auto btn-list">
          <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
       </div>
    </div>
    <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
       <li class="nav-item m-tabs__item">
          <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#generate-offer-letter" role="tab"
             aria-selected="false">
          <i class="la la-cog"></i> Generate Consent for OC
          </a>
       </li>
    </ul>
    <!-- society details -->
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
        <div id="show-noc">
          <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body" style="padding-right: 0;">
              <form action="{{route('ree.create_edit_oc')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="applicationId" value="{{ $societyData->id }}">
                <h3 class="section-title section-title--small mb-0">Consent for OC:</h3>
                <div class="m-form__group form-group mt-2 mb-2">
                  <div class="m-radio-inline">
                    <label for="" class="mr-2">Type :- </label>
                    <label class="m-radio m-radio--primary">
                    @if(isset($oc_application->oc_type))
                      <input type="radio" name="oc_type" value="full_oc" {{isset($oc_application->oc_type) && $oc_application->oc_type == 'full_oc' ? 'checked' : '' }} {{$disable}}> Full OC
                        <span></span>
                    @else
                        <input type="radio" name="oc_type" value="full_oc" checked {{$disable}}> Full OC
                        <span></span>
                    @endif    
                    </label>
                    <label class="m-radio m-radio--primary">
                        <input type="radio" name="oc_type" value="part_oc" {{isset($oc_application->oc_type) && $oc_application->oc_type == 'part_oc' ? 'checked' : '' }} {{$disable}}> Part OC
                        <span></span>
                    </label>
                  </div>
                </div>
                 <!-- edit and generate OC draft copy -->
               @if($societyData->ree_Jr_id && $applicationLog->status_id != config('commanConfig.applicationStatus.forwarded') && $applicationLog->status_id !=
                config('commanConfig.applicationStatus.reverted'))
                  <div class="col-md-12 row row-list" style="border-top: 1px solid #c5c2c2;">
                    <div class="col-md-6">
                     <p class="font-weight-semi-bold">
                      @if(!empty($oc_application->drafted_oc))
                        Edit Draft Consent for OC
                      @else
                        Generate Draft Consent for OC
                      @endif
                     </p>
                     <p>Click to edit/generate OC Agreement</p>
                     <button type="submit" class="btn btn-primary">
                         @if(!empty($oc_application->drafted_oc))
                            Edit
                         @else
                            Generate
                         @endif
                      </button>
                  </div>
                  <div class="col-sm-6 d-flex flex-column h-100 border-left">
                    <p class="font-weight-semi-bold">Download Draft Consent for OC</p>
                    <p>Click to download generated OC in PDF format</p>
                    <div class="">
                      <a style="margin-top: 3%" target="_blank" href="{{config('commanConfig.storage_server').'/'.$oc_application->drafted_oc}}"
                         class="btn btn-primary">Download</a>
                    </div>
                  </div> 
                </div>  
                @endif
              </form>

              <div class="w-100 row-list" style="border-top: 1px solid #c5c2c2;">
                <div class="row col-sm-12">
                  @if(isset($oc_application->drafted_oc) && $applicationLog->status_id != config('commanConfig.applicationStatus.forwarded'))
                   <div class="col-sm-6">
                      <div class="d-flex flex-column h-100">
                         <p class="font-weight-semi-bold">Upload Consent for OC</p>
                         <span class="hint-text">Click on 'Upload' to upload Consent for OC</span>
                         <form action="{{route('ree.upload_draft_consent_oc',$societyData->id)}}" method="post" enctype="multipart/form-data">
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
                  <!-- display uploaded oc agreement -->
                  @if(isset($oc_application->final_oc_agreement)) 
                  <div class="col-sm-6 border-left">
                    <div class="d-flex flex-column h-100">
                       <p class="font-weight-semi-bold">Download Final Consent for OC</p>
                       <p>Click to download uploaded OC Agreement in PDF format</p>
                       <div class="">
                      @if(isset($oc_application->final_oc_agreement))
                          <a style="margin-top: 3%" target="_blank" href="{{config('commanConfig.storage_server').'/'.$oc_application->final_oc_agreement}}"
                             class="btn btn-primary">Download</a>
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