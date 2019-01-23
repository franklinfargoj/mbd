@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.REE_department.action_noc',compact('noc_application'))
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
         {{ Breadcrumbs::render('scrutiny-remark-noc',$noc_application->id) }}
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
                              <span class="field-name">Society registration no:</span>
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
         <div class="tab-content">
            @php
            if(isset($arrData['get_last_status']) && ($arrData['get_last_status']->status_id ==
            config('commanConfig.applicationStatus.forwarded')))
            { 
            $style = "display:none";
            $style1 = "display:none";
            $disabled='disabled';
            }
            elseif (session()->get('role_name') != config('commanConfig.ree_junior'))
            { 
            $style = "display:none";
            $style1 = "display:none";
            $disabled='disabled';
            }
            else
            {
            $style = "";
            $style1 = "";
            $disabled="";
            }
            @endphp
            <div>
               <div class="m-portlet m-portlet--no-top-shadow">
                  <div class="tab-content">
                     <div>
                        <form class="form--custom" action="{{ route('ree.scrutiny_verification') }}" method="post">
                           @csrf
                           <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                              <div class="table-responsive">
                                 <table class="table">
                                    <thead class="thead-default">
                                       <th>#</th>
                                       <th class="table-data--xl">Topics</th>
                                       <th>Yes</th>
                                       <th>No</th>
                                       <th>Comments</th>
                                    </thead>
                                    <tbody>
                                       @php
                                       $i = 1;
                                       @endphp
                                       <input type="hidden" name="society_id" value="{{ $arrData['society_detail']->id }}">
                                       <input type="hidden" name="application_id" value="{{ $noc_application->id }}">
                                       @foreach($arrData['scrutiny_questions_noc'] as
                                       $each_question)
                                       <input type="hidden" name="question_id[{{$i}}]" value="{{ $each_question->id }}">
                                       @php if(isset($each_question->is_compulsory) && $each_question->is_compulsory == '1'){
                                       $required = 'required';
                                       }
                                       else{
                                       $required = '';
                                       }
                                       @endphp
                                       {{--
                                       @php

                                        if(isset($arrData['scrutiny_answers_to_questions'][$each_question->id]))
                                        {
                                            $disabled='disabled';
                                            $style = "display:none";
                                        }else{
                                          if(session()->get('role_name') == config('commanConfig.ree_junior'))
                                          {
                                            $disabled='';
                                            $style = "";
                                          }
                                        }
                                       @endphp
                                       --}}
                                       <tr>
                                          <td>{{ $i }}.</td>
                                          <td>{{ $each_question->question }}</td>
                                          <td>
                                             <label class="m-radio m-radio--primary">
                                             <input {{$disabled}} type="radio" name="answer[{{$i}}]"
                                             value="1" required
                                             {{ (isset($arrData['scrutiny_answers_to_questions'][$each_question->id]) && $arrData['scrutiny_answers_to_questions'][$each_question->id]['answer'] == 1) ? 'checked' : '' }}>
                                             <span></span>
                                             </label>
                                          </td>
                                          @php
                                          if(isset($arrData['scrutiny_answers_to_questions'][$each_question->id]['answer'])
                                          &&
                                          $arrData['scrutiny_answers_to_questions'][$each_question->id]['answer']
                                          == 0)
                                          {
                                          $checked = 'checked';
                                          }
                                          else{
                                          $checked = '';
                                          }
                                          @endphp
                                          <td>
                                             <label class="m-radio m-radio--primary">
                                             <input {{$disabled}} type="radio" name="answer[{{$i}}]"
                                             value="0" {{ $checked }}>
                                             <span></span>
                                             </label>
                                          </td>
                                          <td>
                                             @php
                                             if($each_question->remarks_applicable == 1)
                                             {
                                             @endphp
                                             <textarea {{$disabled}} class="form-control form-control--custom form-control--textarea"
                                             name="remark[{{$i}}]" id="remark-one">{{ isset($arrData['scrutiny_answers_to_questions'][$each_question->id]) ? $arrData['scrutiny_answers_to_questions'][$each_question->id]['remark'] : '' }}
                                             </textarea>
                                             @php
                                             }else{
                                             echo 'Not Applicable';
                                             }
                                             @endphp
                                          </td>
                                       </tr>
                                       @php
                                       $i++;
                                       @endphp
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <button type="submit" style="{{ $style }}" class="btn btn-primary saveBtn" next_tab = "nested_tab_2">Save</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- <div class="tab-pane" id="three" aria-expanded="false">
               three
               </div> -->
            @php
            if(isset($arrData['get_last_status']) && ($arrData['get_last_status']->status_id ==
            config('commanConfig.applicationStatus.forwarded')))
            $display = "display:none";
            elseif (session()->get('role_name') != config('commanConfig.ree_junior'))
            $display = "display:none";
            else
            $display = "";
            @endphp
            <div>
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
                                 @if(isset($noc_application->ree_office_note_noc) && !empty($noc_application->ree_office_note_noc))
                                 <div class="col-sm-6">
                                    <div class="d-flex flex-column h-100 two-cols">
                                       <h5>Download Note</h5>
                                       <div class="mt-auto">
                                          <a download href="{{ config('commanConfig.storage_server').'/'.$noc_application->ree_office_note_noc}} ">
                                          <button class="btn btn-primary">
                                          Download Note</button>
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                                 @else
                                 <div class="col-sm-6" style="{{ $display }}">
                                    <div class="d-flex flex-column h-100 two-cols">
                                       <h5>Upload Note</h5>
                                       <span class="hint-text">Click on 'Upload' to upload REE - Note</span>
                                       <form action="{{ route('ree.upload_office-note-noc') }}" method="post"
                                          enctype="multipart/form-data" style="margin-left: -2%;">
                                          @csrf
                                          <input type="hidden" name="application_id" value="{{ $noc_application->id }}">
                                          <div class="custom-file">
                                             <input class="custom-file-input" name="ree_office_note_noc" type="file"
                                                id="test-upload" required="">
                                             <label class="custom-file-label" for="test-upload">Choose
                                             file...</label>
                                          </div>
                                          <span class="text-danger" id="file_error"></span>
                                          <div class="mt-auto">
                                             <button type="submit" style="{{ $style1 }}" class="btn btn-primary btn-custom upload_note"
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
   
</script>
@endsection