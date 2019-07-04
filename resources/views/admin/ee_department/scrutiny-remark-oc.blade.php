@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.ee_department.action_oc',compact('oc_application'))
@endsection
@section('css')
<style>
    .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('/img/loading-spinner-blue.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>
@endsection
@section('content')
<div class="loader" style="display:none;"></div>
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

@php
   $i = 1; $required = '';
   if(isset($oc_application->status) && ($oc_application->status->status_id ==
   config('commanConfig.applicationStatus.forwarded')))
   { 
      $style = "display:none";
      $disabled='disabled';
   }
   elseif (session()->get('role_name') != config('commanConfig.ee_junior_engineer'))
   { 
      $style = "display:none";
      $disabled='disabled';
   }
   else
   {
      $style = "";
      $disabled="";
   }
@endphp

<div class="custom-wrapper">
   <div class="col-md-12">
      <div class="d-flex">
         {{ Breadcrumbs::render('scrutiny-remark-ee-oc',$oc_application->id) }}
         <div class="ml-auto btn-list">
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
         </div>
      </div>
      <div id="tabbed-content" class="">
         <ul id="top-tabs" class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom tabs">
            <li class="nav-item m-tabs__item active" data-target="#ree-scrunity" id="section-1">
               <a class="nav-link m-tabs__link">
               <i class="la la-cog"></i>Scrutiny
               </a>
            </li>
         </ul>

         <!-- society details -->
         <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
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

         <!-- oc scrutiny question nd answer -->
         <div class="m-portlet m-portlet--no-top-shadow">
            <form class="form--custom" action="{{ route('ee.scrutiny_verification_oc') }}" method="post">
               @csrf
               <input type="hidden" name="society_id" value="{{ $oc_application->society_id }}">
               <input type="hidden" name="application_id" id="application_id" value="{{ $oc_application->id }}">
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
                        @foreach($data as $question)
                           <input type="hidden" name="question_id[{{$i}}]" value="{{ $question->id }}">
                              @php if($question->is_compulsory == '1'){
                                 $required = 'required';
                              } @endphp
                           <tr>
                              <td>{{ isset($question->group) && isset($question->sort_by) ? $question->group.'.'.$question->sort_by : $question->group }}
                              </td>

                              <td><p>{{ $question->question }}</p></td>
                              <td>
                                 @if($question->option_applicable == 1)
                                    <label class="m-radio m-radio--primary">
                                    <input {{$disabled}} type="radio" name="answer[{{$i}}]" value="1" 
                                    {{ $required }} {{ (isset($question->ocScrutinyAnswer) && $question->ocScrutinyAnswer->answer == 1) ? 'checked' : '' }}>
                                    <span></span>
                                    </label>
                                 @endif   
                              </td>
                              <td>
                                 @if($question->option_applicable == 1)
                                    <label class="m-radio m-radio--primary">
                                    <input {{$disabled}} type="radio" name="answer[{{$i}}]"
                                    value="0" {{ $required }} {{ (isset($question->ocScrutinyAnswer) && $question->ocScrutinyAnswer->answer == 0) ? 'checked' : '' }}>
                                    <span></span>
                                    </label>
                                 @endif   
                              </td>
                              <td>
                                 <!-- display remark -->
                                 @if($question->remarks_applicable == 1)
                                    <textarea {{$disabled}} class="form-control form-control--custom form-control--textarea" name="remark[{{$i}}]" id="remark-one">{{ isset($question->ocScrutinyAnswer) ? $question->ocScrutinyAnswer->remark : '' }}</textarea>
                                 @else
                                    {{'Not Applicable'}};
                                 @endif 

                                 @if($question->is_upload == 1)

                                    <input type="hidden" id="question_id" value="{{ isset($question) ? $question->id : '' }}">
                                    <div class="custom-file mt-3" style="{{$style}}">
                                       <input class="custom-file-input file-upload" type="file" id="test-upload_{{$question->id}}" data-index = "{{$question->id}}" 
                                       {{(isset($question->ocScrutinyAnswer->document_path)) ? '' : 'required' }}>
                                       <label class="custom-file-label" for="test-upload_{{$question->id}}">Choose file...</label>
                                       <input type="hidden" id="document_{{$question->id}}" name="document_path[{{$i}}]" value="{{isset($question->ocScrutinyAnswer) ? $question->ocScrutinyAnswer->document_path : '' }}"> 
                                       <span class="text-danger file_error_{{$question->id}}"></span>
                                    </div>
                                    @if(isset($question->ocScrutinyAnswer))
                                       <a target="_blank" class="btn-link" id="file_{{$question->id}}" href="{{isset($question->ocScrutinyAnswer) ? config('commanConfig.storage_server').'/'.$question->ocScrutinyAnswer->document_path : ''}}" download >Download</a>
                                    @endif 
                                 @endif
                              </td>
                           </tr>
                           @php $i++; @endphp
                        @endforeach
                           <tr>
                              <td colspan="2">Additional Remarks (If any)</td>
                              <td colspan="3">
                                 <textarea {{$disabled}} class="form-control form-control--custom form-control--textarea"
                                 name="ee_additional_remarks" id="remark-one">{{ isset($oc_application->ee_additional_remarks) ? $oc_application->ee_additional_remarks : '' }}</textarea>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <button type="submit" style="{{ $style }}" class="btn btn-primary saveBtn" next_tab = "nested_tab_2">Save</button>
               @if(isset($ansCount) && count($ansCount) > 0)
                  <a href="{{ route('ee.oc_ee_variation_report',$oc_application->id)}}" class="btn btn-primary">Generate Variation Report</a>
               @endif
            </form>
         </div>

         <!-- EE note -->
         <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
            <div class="m-portlet__body m-portlet__body--table">
               <div class="m-subheader" style="padding: 0;">
                  <div class="d-flex">
                     <h3 class="section-title">
                        Note
                     </h3>
                  </div>
               </div>
               <div class="m-section__content mb-0 table-responsive">
                  <div class="col-sm-6" style="{{ $style }}">
                     <div class="d-flex flex-column h-100 two-cols">
                        <h5>Upload Note</h5>
                        <span class="hint-text">Click on 'Upload' to upload EE Note</span>
                        <form action="{{ route('ee.upload_office-note-oc') }}" method="post"
                           enctype="multipart/form-data" style="margin-left: -2%;">
                           @csrf
                           <input type="hidden" name="application_id" value="{{ $oc_application->id }}">
                           <div class="custom-file">
                              <input class="custom-file-input" name="ee_office_note_oc" type="file"
                                 id="test-upload" required="">
                              <label class="custom-file-label" for="test-upload">Choose
                              file...</label>
                           </div>
                           <span class="text-danger" id="file_error"></span>
                           <div class="mt-auto">
                              <button type="submit" style="{{ $style }}" class="btn btn-primary btn-custom upload_note"
                                 id="uploadBtn">Upload</button>
                           </div>
                        </form>
                     </div> 
                  </div>
               </div>
               
               <div class="m-section__content mb-0 table-responsive" style="margin-top: 30px">
                  <div class="col-sm-8 d-flex flex-column h-100 two-cols row" style="padding-left: 66px;">
                    <h5>Download EE Note</h5>
                     @if(isset($arrData['eeNote']) && count($arrData['eeNote']) > 0)
                        <div class="table-responsive">
                           <table class="mt-2 table table-hover" id="dtBasicExample"> 
                              <thead>
                                 <tr>
                                    <th>Document Name</th>
                                    <th class="text-center">Download</th>
                                    <th class="text-center" style="{{$style}}">Delete</th>   
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($arrData['eeNote'] as $note)  
                                    <tr>
                                       <td>                                       
                                          @php
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
                                       <td class="text-center" style="{{$style}}">
                                           <i class="fa fa-close icon2 d-icon hide-print" id="{{ isset($note->id) ? $note->id : '' }}" onclick="removeDocuments(this.id)"></i>
                                           <input type="hidden" name= "oldFile" id="oldFile_{{$note->id}}" value="{{ isset($note->document_path) ? $note->document_path : '' }}"> 
                                       </td>
                                    </tr>
                                 @endforeach
                              </tbody>    
                           </table>
                        </div>
                     @elseif(isset($oc_application->status) && ($oc_application->status->status_id == config('commanConfig.applicationStatus.forwarded')))
                        <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;"> * Note : EE note not available. </span>
                     @endif
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
   $(".editDocumentStatus, .deleteDocumentStatus").on("click", function () {
       var documentstatusid = $(this).attr('data-documentstatusid');
       var id = $(this).attr('data-id');
       $.ajax({
           type: "POST",
           url: "{{ route('get-ee-scrutiny-data') }}",
           data: {
               "_token": "{{ csrf_token() }}",
               "documentStatusId": documentstatusid,
           },
           cache: false,
           success: function (res) {
               $("#comment_by_EE_" + id).val(res.comment_by_EE);
               $("#oldFileName_" + id).val(res.EE_document_path);
   
               $("#fileName_" + id).val(res.EE_document_path);
           }
       });
   });
   
   //        $("#demarcation_date, #tit_bit_date").datepicker();
   
   $(".submt_btn").click(function () {
       var id = this.id.substr(10, 2);
       console.log(id);
       myfile = $("#EE_document_path_" + id).val();
       var ext = myfile.split('.').pop();
       console.log(ext);
       if (myfile != '') {
           if (ext != "pdf") {
               $("#file_error_" + id).text("Invalid type of file uploaded (only pdf allowed).");
               return false;
           } else {
               $("#file_error_" + id).text("");
               return true;
           }
       } 
       // else {
       //     $("#file_error_" + id).text("This field required");
       //     return false;
       // }
   });
   
   $(".edit_btn").click(function () {
       var id = this.id.substr(8, 2);
       myfile = $("#EE_document_" + id).val();
       var ext = myfile.split('.').pop();
   
       if (myfile != '') {
           if (ext != "pdf") {
               $("#edit_file_error_" + id).text("Invalid type of file uploaded (only pdf allowed).");
               return false;
           } else {
               $("#edit_file_error_" + id).text("");
               return true;
           }
        } 
        // else {
       //     $("#edit_file_error_" + id).text("This field required");
       //     return false;
       // }
   });
   
   $(".upload_note").click(function () {
       myfile = $("#test-upload").val();
       var ext = myfile.split('.').pop();
       if (myfile != '') {
   
           if (ext != "pdf") {
               $("#file_error").text("Invalid type of file uploaded (only pdf allowed).");
               return false;
           } else {
               $("#file_error").text("");
               return true;
           }
       } else {
           $("#file_error").text("This field required");
           return false;
       }
   });

   $(".file-upload").change(function(){
      var questionId = $(this).attr('data-index');
      var myfile = $(this).val();
      console.log(myfile);
      var ext = myfile.split('.').pop();
      if (ext == "pdf"){
          $(".loader").show();
          var fileData = $(this).prop('files')[0];
          var applicationId = $("#application_id").val();
          
          var form_data = new FormData();
          form_data.append('file', fileData);  
          form_data.append('application_id', applicationId);  
          form_data.append('question_id', questionId);  
          form_data.append('_token', document.getElementsByName("_token")[0].value);

          $.ajax({
              url: "/upload_oc_scrutiny_documents", // point to server-side PHP script
              data: form_data,
              type: 'POST',
              contentType: false, // The content type used when sending data to the server.
              cache: false, // To unable request pages to be cached
              processData: false,
              success: function(result) {
               var  res = JSON.parse(result);
               console.log(res);
               if (res.status == 'success'){
                  $(".file_error_"+questionId).text("");
                  $("#file_"+questionId).css("display","block")
                  $("#file_"+questionId).attr("href", res.data);
                  $("#document_"+questionId).val(res.filePath);
               }
                  $(".loader").hide();
                  // if(data == 'success')
                      // $("#file_error_"+id).css("display","none");
              }
          });
      }else{
         $(".file_error_"+questionId).text("Invalid type of file uploaded (only pdf allowed).");
      }
   });

   function removeDocuments(id) {
     
        var oldFile = $("#oldFile_"+id).val();
        var form_data = new FormData();
        form_data.append('id', id);
        form_data.append('oldFile', oldFile);
        form_data.append('_token', document.getElementsByName("_token")[0].value);
        $(".loader").show();
   
            $.ajax({
                url: "/delete_oc_note",
                data: form_data,
                type: 'POST',
                contentType: false, 
                cache: false, 
                processData: false,
                success: function(data) {
                    console.log(data);
                    $(".loader").hide();
                    if (data == 'success'){
                        location.reload();
                    }
                }
            })        
    }

   $(document).ready(function () {
      $('#dtBasicExample').DataTable();
      $('.dataTables_length').addClass('bs-select');

      $('#dtBasicExample_wrapper > .row:first-child').remove();
    });  

    $('#dtBasicExample').dataTable({searching: false, ordering:false, info: false});
   
</script>
@endsection