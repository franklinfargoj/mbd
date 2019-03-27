@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.REE_department.action_oc',compact('oc_application'))
@endsection
@section('css')
<!-- <style> -->
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css" />
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
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Approved Consent for OC 
            </h3>
            {{ Breadcrumbs::render('approved_oc',$oc_application->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m_panel">
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
                                <span class="field-value">{{(isset($applicationData->application_no) ?
                                $applicationData->application_no : '')}}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Application Date:</span>
                                <span class="field-value">{{(isset($applicationData->submitted_at) ?
                                date(config('commanConfig.dateFormat'),strtotime($applicationData->submitted_at)) :
                                '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                               <span class="field-name">Society registration no:</span>
                               <span class="field-value">{{(isset($applicationData->eeApplicationSociety->registration_no)
                               ? $applicationData->eeApplicationSociety->registration_no : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Society Name:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->name) ?
                                $applicationData->eeApplicationSociety->name : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Society Address:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->address) ?
                                $applicationData->eeApplicationSociety->address : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Building Number:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->building_no)
                                ? $applicationData->eeApplicationSociety->building_no : '')}}</span>
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
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->name_of_architect)
                                ? $applicationData->eeApplicationSociety->name_of_architect : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Mobile Number:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_mobile_no)
                                ? $applicationData->eeApplicationSociety->architect_mobile_no : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Address:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_address)
                                ? $applicationData->eeApplicationSociety->architect_address : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Telephone Number:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_telephone_no)
                                ? $applicationData->eeApplicationSociety->architect_telephone_no : '')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->
    <!-- Site Visit -->
        @php $disable = ''; 
          if($applicationData->ree_Jr_id && $applicationLog->status_id != config('commanConfig.applicationStatus.forwarded') && $applicationLog->status_id !=
          config('commanConfig.applicationStatus.reverted') && (!isset($oc_application->oc_path))){
            $disable = '';
          }else{
            $disable = 'disabled';
          }
          @endphp
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body" style="padding-right: 0;">
            <form action="{{route('ree.create_edit_oc')}}" method="post">
              @csrf
                <input type="hidden" name="applicationId" value="{{$applicationData->id}}">
                <h3 class="section-title section-title--small mb-0 ml-3">Consent for Oc:</h3>

                <div class="m-form__group form-group mt-2 mb-2 ml-3">
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

            @if($applicationData->ree_Jr_id && !empty($applicationData->oc_path) && $applicationData->OC_Generation_status == config('commanConfig.applicationStatus.OC_Approved'))
                <div class="row field-row">
                    <div class="col-md-6">
                        
                        @if($applicationData->oc_path)   
                        <!-- <a href="{{config('commanConfig.storage_server').'/'.$applicationData-> oc_path}}" class="btn btn-primary" target="_blank" rel="noopener"> 
                        View Consent for Oc</a> -->
                        @endif
                        <p></p>

                        <p>Click to view generated Consent for Oc in PDF format</p>
                       <!--  <a target="_blank" style="margin-top: 2%" href="{{config('commanConfig.storage_server').'/'.$oc_application->drafted_oc}}" class="btn btn-primary">Download Draft Consent Oc</a>  -->
                        <hr>
                        <input type="hidden" name="applicationId" value="{{ $oc_application->id }}">  
                        <input type="hidden" name="oc_type" value="{{ $oc_application->oc_type }}">  
                        <button type="submit" class="btn btn-primary">
                        Edit Draft Consent for Oc
                        </button>
                    </div>
            @endif
                </form>
                    @if($applicationData->ree_head && $applicationData->OC_Generation_status == config('commanConfig.applicationStatus.in_process') || ($applicationData->OC_Generation_status == config('commanConfig.applicationStatus.OC_Approved')))
                    <div class="col-sm-6 mt-4">
                        <div class="d-flex flex-column h-100">
                            <h5>Upload Consent for Oc</h5>
                            <span class="hint-text">Click on 'Upload' to upload Consent for Oc</span>
                            <form action="{{route('ree.upload_draft_consent_oc',$applicationData->id)}}" method="post"
                                enctype="multipart/form-data">
                            @csrf
                            <div class="custom-file">
                            <input class="custom-file-input pdfcheck" name="oc_letter" type="file"
                                id="test-upload" required="required">
                            <label class="custom-file-label" for="test-upload">Choose
                            file...</label>
                            <span class="text-danger" id="file_error"></span>
                            </div>
                            <div class="mt-auto">
                            <button type="submit" onclick="return confirm('Are you sure you want to upload the copy of Consent for OC.Please note once you upload, the same would be finalized and would be uneditable.');" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    @if($applicationData->OC_Generation_status == config('commanConfig.applicationStatus.OC_Approved') || $applicationData->OC_Generation_status == config('commanConfig.applicationStatus.sent_to_society'))
     <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body table--box-input">
            <p class="heading"> </p>
            <div class="col-xs-12 row row-list">
               <div class="col-sm-6">
                  <div class="d-flex flex-column h-100">
                     <h5>Download Draft Consent for OC</h5>
                     <div class="mt-auto">
                    @if(empty($oc_application->oc_path))
                        <a style="margin-top: 3%" target="_blank" href="{{config('commanConfig.storage_server').'/'.$oc_application->drafted_oc}}"
                           class="btn btn-primary">Download</a>
                    @else
                       <a style="margin-top: 3%" target="_blank" href="{{config('commanConfig.storage_server').'/'.$oc_application->oc_path}}"
                           class="btn btn-primary">Download</a> 
                    @endif
                     </div>
                  </div>
               </div> 
               @if(isset($oc_application->final_oc_agreement))
                   <div class="col-sm-6">
                      <div class="d-flex flex-column h-100">
                         <h5>Download Final Consent for OC</h5>
                         <div class="mt-auto">
                        
                            <a style="margin-top: 3%" target="_blank" href="{{config('commanConfig.storage_server').'/'.$oc_application->final_oc_agreement}}"
                               class="btn btn-primary">Download</a>
                         </div>
                      </div>
                   </div>
                @endif
            </div>
        </div>
    </div>  
    @endif  
    <!-- end  -->

    <!-- Demarkation verification -->
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body table--box-input">
            <h3 class="section-title section-title--small mb-0">Remark on Consent for OC :</h3>
            <p class="heading"> </p>
            <div class="col-xs-12 row row-list">
                <div class="col-md-12">
                    <p class="font-weight-semi-bold">Remark by REE</p>
                    <textarea rows="4" cols="63" name="demarkation_comments" class="form-control form-control--custom" readonly>{{(isset($applicationData->reeForwardLog) ? $applicationData->reeForwardLog->remark : '')}}</textarea>
                </div>
            </div>
            <div class="col-xs-12 row row-list border-0">
                <div class="col-md-12">
                    <p class="font-weight-semi-bold">Remark by CO</p>
                    <textarea rows="4" cols="63" name="demarkation_comments" class="form-control form-control--custom" readonly>{{(isset($applicationData->coLog) ? $applicationData->coLog->remark : '')}}</textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- end  -->
    <!-- Encrochment verification -->
    <form role="form" id="approved_letter" name="approved_letter" class="form-horizontal" method="post" action="{{route('ree.send_oc_issued_society')}}"
        enctype="multipart/form-data">
        @csrf
    @if($ree_head && $applicationData->OC_Generation_status != config('commanConfig.applicationStatus.sent_to_society'))
    <input type="hidden" name="applicationId" value="{{$applicationData->id}}">
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body table--box-input">
            <h3 class="section-title section-title--small">Send to Society:</h3>
            <div class="col-xs-12 row">
                <div class="col-md-12">
                    <p class="font-weight-semi-bold">Remark</p>
                    <textarea rows="4" cols="63" required name="remark" class="form-control form-control--custom"></textarea>
                    <button type="submit" class="btn btn-primary mt-3" onclick="return confirm('Are you sure you want to sent this Consent for Oc to society?');">Send Consent for OC </button>
                </div>
            </div>
        </div>
    </div>
    @endif
    </form>
</div>
@endsection