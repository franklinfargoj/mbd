@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.co_department.action_noc_cc',compact('noc_application'))
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
      <div class="d-flex">
         {{ Breadcrumbs::render('scrutiny-remark-noc_cc_co',$noc_application->id) }}
         <div class="ml-auto btn-list">
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
         </div>
      </div>
      <div id="tabbed-content" class="">
         <ul id="top-tabs" class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom tabs">
            <li class="nav-item m-tabs__item active" data-target="#ree-scrunity" id="section-1">
               <a class="nav-link m-tabs__link">
               <i class="la la-cog"></i>REE Note
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
                              <span class="field-value">{{
                              $arrData['society_detail']->application_no ?
                              $arrData['society_detail']->application_no : '' }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Application Date:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->submitted_at ?
                              date(config('commanConfig.dateFormat'),
                              strtotime($arrData['society_detail']->submitted_at)) : ''}}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Society Registration No:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->registration_no }}</span>
                           </div>
                        </div>                        
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Society Name:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->name }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Society Address:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->address }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Building Number:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->building_no
                              }}</span>
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
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->name_of_architect
                              }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Architect Mobile Number:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->architect_mobile_no
                              }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Architect Address:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->architect_address
                              }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Architect Telephone Number:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->architect_telephone_no
                              }}</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

          <div id="tabbed-content" class="">
              <form action="{{ route('ree.upload_office-note-noc-cc') }}" method="post"
                    enctype="multipart/form-data" style="margin-top: 2%;">
                  @csrf
                  <input type="hidden" name="application_id" value="{{(isset($noc_application->id) ? $noc_application->id : '')}}">
                  <div>
                      <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                          <div class="portlet-body">
                              <div class="m-portlet__body m-portlet__body--table">
                                  <div class="" style="padding: 0;">
                                      <div class="d-flex align-items-center">
                                          <h3 class="section-title">
                                              Ree Note
                                          </h3>
                                      </div>
                                  </div>
                                  <div class="m-section__content mb-0 table-responsive">
                                      <div class="container">
                                          <div class="row">
                                              <div class="col-sm-6">
                                                  <div class="d-flex flex-column h-100 two-cols">
                                                      <h5>Download Ree Note</h5>
                                                      <!-- <span class="hint-text">Download Note uploaded by CAP</span> -->
                                                      <div class="mt-auto">
                                                          @if(isset($noc_application->ree_office_note_noc) && !empty($noc_application->ree_office_note_noc))
                                                              <a target="_blank" href="{{ config('commanConfig.storage_server').'/'.$noc_application->ree_office_note_noc}}">
                                                                  <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                                      Download </Button>
                                                              </a>
                                                          @else
                                                              <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
*Note : Ree note is not available.</span>
                                                          @endif

                                                      </div>
                                                  </div>
                                              </div>
                                              @if(session()->get('role_name')==config('commanConfig.ree_junior') && ($noc_application->status->status_id == config('commanConfig.applicationStatus.in_process') ))
                                                  <div class="col-sm-6 border-left">
                                                      <div class="d-flex flex-column h-100 two-cols">
                                                          <h5>Upload Ree Note</h5>
                                                          <!-- <span class="hint-text">Click on 'Upload' to upload - Note -->

                                                          <!-- Note</span> -->
                                                          <!-- <form action="" method="post"> -->
                                                          <div class="custom-file">
                                                              <input class="custom-file-input ree_note" type="file" id="test-upload" name="ree_office_note_noc"
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
          
      </div>
   </div>
</div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script>
   
</script>
@endsection