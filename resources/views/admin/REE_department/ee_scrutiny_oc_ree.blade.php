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

<div class="custom-wrapper">
   <div class="col-md-12">
      <div class="d-flex">
         {{ Breadcrumbs::render('scrutiny-remark-oc-ee',$oc_application->id) }}
         <div class="ml-auto btn-list">
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
         </div>
      </div>
      <div id="tabbed-content" class="">
         <ul id="top-tabs" class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom tabs">
            <li class="nav-item m-tabs__item active" data-target="#ree-scrunity" id="section-1">
               <a class="nav-link m-tabs__link">
               <i class="la la-cog"></i>EE Scrutiny
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
                              <span class="field-value">{{
                              $oc_application->application_no ?
                              $oc_application->application_no : '' }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Application Date:</span>
                              <span class="field-value">{{
                              $oc_application->submitted_at ?
                              date(config('commanConfig.dateFormat'),
                              strtotime($oc_application->submitted_at)) : ''}}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Society Registration No:</span>
                              <span class="field-value">{{
                              $oc_application->eeApplicationSociety->registration_no }}</span>
                           </div>
                        </div>                        
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Society Name:</span>
                              <span class="field-value">{{
                              $oc_application->eeApplicationSociety->name }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Society Address:</span>
                              <span class="field-value">{{
                              $oc_application->eeApplicationSociety->address }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Building Number:</span>
                              <span class="field-value">{{
                              $oc_application->eeApplicationSociety->building_no
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
                              $oc_application->eeApplicationSociety->name_of_architect
                              }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Architect Mobile Number:</span>
                              <span class="field-value">{{
                              $oc_application->eeApplicationSociety->architect_mobile_no
                              }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Architect Address:</span>
                              <span class="field-value">{{
                              $oc_application->eeApplicationSociety->architect_address
                              }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Architect Telephone Number:</span>
                              <span class="field-value">{{
                              $oc_application->eeApplicationSociety->architect_telephone_no
                              }}</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <!-- Scrutiny table -->
         <div class="tab-content">
            <div class="m-portlet m-portlet--no-top-shadow">
               <h3 class="section-title">
                  <center>EE Scrutiny Pointers</center>
               </h3>
               <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                  <div class="table-responsive">
                     <table class="table">
                        <thead class="thead-default">
                           <th>Sr.No</th>
                           <th class="table-data--xl">Topics</th>
                           <th>Yes</th>
                           <th>No</th>
                           <th>Comments</th>
                        </thead>
                        <tbody>
                           @php $i = 1; @endphp
                           @foreach($data as $question)
                              <tr>
                                 <td>{{ isset($question->group) && isset($question->sort_by) ? $question->group.'.'.$question->sort_by : $question->group }}</td>
                                 <td>{{ $question->question }}</td>
                                 <td>
                                    <label class="m-radio m-radio--primary">
                                    <input disabled type="radio" value="1" {{ (isset($question->ocScrutinyAnswer) && $question->ocScrutinyAnswer->answer == 1) ? 'checked' : '' }}>
                                    <span></span>
                                    </label>
                                 </td>
                                 <td> 
                                    <label class="m-radio m-radio--primary">
                                    <input disabled type="radio" value="0" {{ (isset($question->ocScrutinyAnswer) && $question->ocScrutinyAnswer->answer == 0) ? 'checked' : '' }}>
                                    <span></span>
                                    </label>
                                 </td>
                                 <td>
                                    @if($question->remarks_applicable == 1)
                                       <textarea readonly class="form-control form-control--custom form-control--textarea">{{ isset($question->ocScrutinyAnswer) ? $question->ocScrutinyAnswer->remark : '' }} </textarea>
                                    @else
                                       {{'Not Applicable'}};
                                    @endif
                                    @if($question->is_upload == 1)

                                       <a target="_blank" class="btn-link" href="{{isset($question->ocScrutinyAnswer) ? config('commanConfig.storage_server').'/'.$question->ocScrutinyAnswer->document_path : ''}}" download >Download</a>
                                    @endif
                                 </td>
                              </tr>
                           @endforeach
                           <tr>
                              <td colspan="2">Additional Remarks (If any)</td>
                              <td colspan="3">
                                 <textarea readonly class="form-control form-control--custom form-control--textarea" >{{ isset($oc_application->ee_additional_remarks) ? $oc_application->ee_additional_remarks : '' }}</textarea>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               @if(isset($ansCount) && count($ansCount) > 0)
                  <a href="{{ route('ee.oc_ee_variation_report',$oc_application->id)}}" class="btn btn-primary">Generate Variation Report</a>
               @endif
            </div>
            <!-- EE note -->
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
               <div class="portlet-body">
                  <div class="m-portlet__body m-portlet__body--table">
                     <div class="m-subheader" style="padding: 0;">
                        <div class="d-flex">
                           <h4 class="section-title">
                              EE Note
                           </h4>
                        </div>
                     </div>
                  @if(isset($arrData['eeNote']) && count($arrData['eeNote']) > 0)
                     <div class="m-section__content mb-0 table-responsive">
                           <div class="col-sm-8">
                              <div class="d-flex flex-column h-100 two-cols">
                                 <h5>Download EE Note</h5>
                                 <div class="table-responsive">
                                 <table class="mt-2 table table-hover" id="dtBasicExample"> 
                                 <thead>
                                   <tr>
                                       <th>Document Name</th>
                                       <th class="text-center">Download</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($arrData['eeNote'] as $note)  
                                      <tr>
                                          <td>                                                                  @php
                                             if($note->document_name){
                                                $fileName = explode(".",$note->document_name)[0]; 
                                             }elseif($note->document_path){
                                                $fileName = explode(".",explode('/',$note->document_path)[1])[0];
                                             }
                                          @endphp 

                                          {{ isset($fileName) ? $fileName : ''}} 
                                          </td>
                                          <td class="text-center">
                                              <a class="btn-link" download href="{{ config('commanConfig.storage_server').'/'.$note->document_path}} " target="_blank" download> Download </a> 
                                          </td>
                                      </tr>
                                    @endforeach
                                 </tbody>    
                              </table>

                                 @elseif(isset($oc_application->status) && ($oc_application->status->status_id == config('commanConfig.applicationStatus.forwarded')))
                                 <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                 * Note : EE note not available. </span>
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
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script>
   $(document).ready(function () {
      $('#dtBasicExample').DataTable();
      $('.dataTables_length').addClass('bs-select');

      $('#dtBasicExample_wrapper > .row:first-child').remove();
    });  

    $('#dtBasicExample').dataTable({searching: false, ordering:false, info: false});
</script>
@endsection