@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.REE_department.action_noc',compact('noc_application'))
@endsection
@section('css')
<style type="text/css">
   .text-box{
      width: 173px;
    height: 35px;
   }
</style>
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
                                       <th>Sr.No</th>
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
                           @if(count($arrData['scrutiny_answers_to_questions']) > 0)
                           <a href="{{ route('ree.noc_variation_report',$noc_application->id)}}" class="btn btn-primary">Generate Variation Report</a>
                           @endif
                        </form>
                     </div>
                  </div>
               </div>
            </div>            
            @if(isset($noc_application->noc_application_master) && $noc_application->noc_application_master->model == 'Premium')
               <div>
                  <div class="m-portlet m-portlet--no-top-shadow">
                  <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                           NOC Calculation Sheet:
                        </h3>
                     </div>
                     <div class="tab-content">
                        <div>
                           <form class="form--custom" action="{{ route('ree.save_noc_scrutiny') }}" method="post">
                              @csrf
                              <input type="hidden" name="applicationId" value="{{ $noc_application->id }}">
                              <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                                 <div class="table-responsive">
                                    <table class="table">
                                       <thead class="thead-default">
                                          <th>Sr.No</th>
                                          <th class="table-data--xl">Buitup area permitted as per statement below</th>
                                          <th>In m2</th>
                                       </thead>
                                       <tbody>
                                       @php 
                                          if (isset($noc_application->OlCalculationSheet)){
                                             $lease = $noc_application->OlCalculationSheet->area_as_per_lease_agreement; 
                                             $tit = $noc_application->OlCalculationSheet->area_of_tit_bit_plot;

                                             $vpPio = str_replace(",", "", $noc_application->OlCalculationSheet->area_in_reserved_seats_for_vp_pio);
                                             $tenament = str_replace(",", "", $noc_application->OlCalculationSheet->permissible_proratata_area);

                                             $plotArea = str_replace(",", "", $lease) + str_replace(",", "", $tit);

                                             $buildupArea = $plotArea * str_replace(",", "", $noc_application->OlCalculationSheet->permissible_carpet_area_coordinates);

                                             $totalBUA = $buildupArea + $vpPio + $tenament;

                                          }
                                       @endphp
                                         <tr>

                                            <td>1</td>
                                            <td><p>Plot Area as per demarcation </p>
                                                <p> i) Area as per Lease Deed <input type="text" id="lease_deed_area" name="area[lease_deed_area]" class="float plot_area form-control--custom text-box" value="{{ isset($data) ? $data->lease_deed_area : (isset($noc_application->OlCalculationSheet) ? $noc_application->OlCalculationSheet->area_as_per_lease_agreement : '') }}" {{$disabled}}></p>

                                                <p> ii) Additional land <input type="text" id="land_area" 
                                                name="area[land_area]" class="plot_area float form-control--custom text-box" value="{{ isset($data) ? $data->land_area : 
                                                (isset($noc_application->OlCalculationSheet) ? $noc_application->OlCalculationSheet->area_of_tit_bit_plot : '') }}" {{$disabled}}></p>
                                            </td>
                                            <td><input type="text" id="plot_area" name="area[plot_area]" value="{{ isset($data) ? $data->plot_area : (isset($plotArea) ? number_format($plotArea) : '') }}" class="form-control--custom text-box float" readonly></td>
                                         </tr>
                                         <tr>
                                            <td>2</td>
                                            <td>Built up Area permissible <input type="text" id="plot_area1" class="form-control--custom text-box" readonly value="{{ isset($data) ? $data->plot_area : (isset($plotArea) ? $plotArea : '') }}"> * <input type="text" name="area[fsi]" class="float form-control--custom text-box" id="fsi" value="{{ isset($data) ? $data->fsi : (isset($noc_application->OlCalculationSheet) ? $noc_application->OlCalculationSheet->permissible_carpet_area_coordinates : '') }}" {{$disabled}}> FSI</td>
                                            <td>
                                            <input type="text" name="area[buildup_area]" class="form-control--custom text-box" id="buildup_area" value="{{ isset($data) ? $data->buildup_area : (isset($buildupArea) ? number_format($buildupArea) : '') }}" readonly></td>
                                         </tr>
                                         <tr>
                                            <td>3</td>
                                            <td>
                                               <p> i)Prorata per tenement <input type="text" id="tenement_no" 
                                               name="area[tenement_no]" class="tenement_area form-control--custom text-box float" value="{{ isset($data) ? $data->tenement_no : 
                                               (isset($noc_application->OlCalculationSheet) ? $noc_application->OlCalculationSheet->total_house : '') }}" {{$disabled}}></p>

                                               <p> ii)Area as per tenement <input type="text" id="tenement_area" name="area[tenement_area]" class="tenement_area form-control--custom text-box float" value="{{ isset($data) ? $data->tenement_area : 
                                               (isset($noc_application->OlCalculationSheet) ? $noc_application->OlCalculationSheet->sqm_area_per_slot : '') }}" {{$disabled}}></p>
                                            </td>
                                            <td><input type="text" name="area[total_tenement_area]" id="total_tenement_area" value="{{ isset($data) ? $data->total_tenement_area : (isset($noc_application->OlCalculationSheet) ? $noc_application->OlCalculationSheet->permissible_proratata_area : '') }}" class="form-control--custom text-box" readonly></td>
                                         </tr>
                                         <tr>
                                            <td>4</td>
                                            <td>From discretionary 10% quota of HON, VP/A from balance built up area of layout</td>
                                            <td><input type="text" class="form-control--custom text-box float" name="area[balance_buildup_area]" id="balance_buildup_area" value="{{ isset($data) ? $data->balance_buildup_area : (isset($noc_application->OlCalculationSheet) ? $noc_application->OlCalculationSheet->area_in_reserved_seats_for_vp_pio : '') }}" onkeyup="calculateTotalBUA()" {{$disabled}}> </td>
                                         </tr>
                                         <tr>
                                            <td>5</td>
                                            <td>Total BUA permissible (sr 2+3+4)</td>
                                            <td><input type="text" name="area[total_permissable_bua]" id="total_permissable_bua" class="form-control--custom text-box float" readonly value="{{ isset($data) ? $data->total_permissable_bua : 
                                            (isset($totalBUA) ? number_format($totalBUA) : '' )}}"></td>
                                         </tr>
                                         <tr>
                                            <td>6</td>
                                            <td><p style="font-weight: 700;">Total built up area permitted for obtaining I.O.D /I.O.A </p>
                                             <p> i) <input type="text" id="residential_use" 
                                               name="area[residential_use]" class="tenement_area form-control--custom text-box float total_buitup" value="{{ isset($data) ? $data->residential_use : '' }}" {{$disabled}}> sq.mt for residential use</p>

                                               <p> ii) <input type="text" id="commercial_use" 
                                               name="area[commercial_use]" class="tenement_area form-control--custom text-box float total_buitup" value="{{ isset($data) ? $data->commercial_use : '' }}" {{$disabled}}> sq.mt for commercial use</p>
                                            </td>
                                            <td><input type="text" id="total_buildup_area" name="area[total_buildup_area]" class="form-control--custom text-box float" value="{{ isset($data) ? $data->total_buildup_area : (isset($totalBUA) ? number_format($totalBUA) : '') }}" {{$disabled}}> </td>
                                         </tr>
                                         <tr>
                                            <td>7</td>
                                            <td style="line-height: 3.5;">
                                                <input type="text" id="" class="form-control--custom text-box float total_existing" readonly value="{{ isset($data) ? $data->total_existing_permitted_area : '' }}" > m<sup>2</sup> 
                                                [i.e <input type="text" id="existing_residential_use" name="area[existing_residential_use]" class="form-control--custom text-box float noc_area" value="{{ isset($data) ? $data->existing_residential_use : '' }}" {{$disabled}}> m<sup>2</sup> for residential use + 

                                                <input type="text" id="existing_commercial_use" name="area[existing_commercial_use]" class="form-control--custom text-box float" value="{{ isset($data) ? $data->existing_commercial_use : '' }}" {{$disabled}}> m<sup>2</sup> for commercial use) permited through this NOC. (Proportinate to the first installment paid by the society as per other letter under reference no. 1) and 

                                                <input type="text" 
                                                name="area[existing_buildup_area]" id="existing_buildup_area" class="noc_area form-control--custom text-box float" value="{{ isset($data) ? $data->existing_buildup_area : '' }}" {{$disabled}}> m<sup>2</sup> 

                                                (i.e <input type="text" id="existing_bua" name="area[existing_bua]" class="form-control--custom text-box float" value="{{ isset($data) ? $data->existing_bua : '' }}" {{$disabled}}> m<sup>2</sup> existing BUA + 

                                                <input type="text" id="additional_area" name="area[additional_area]" class="form-control--custom text-box float noc_area" value="{{ isset($data) ? $data->additional_area : '' }}" {{$disabled}}> m<sup>2</sup> 

                                                additional BUA ( <input type="text" id="additional_residential_bua" name="area[additional_residential_bua]" class="form-control--custom text-box float" value="{{ isset($data) ? $data->additional_residential_bua : '' }}" {{$disabled}}> m<sup>2</sup> for residential use +

                                                <input type="text" id="additional_commercial_bua" name="area[additional_commercial_bua]" class="form-control--custom text-box float" value="{{ isset($data) ? $data->additional_commercial_bua : '' }}" {{$disabled}}> m<sup>2</sup> for commercial use))]

                                                <!-- <p>i) Existing built up area <input type="text" 
                                                name="area[existing_buildup_area]" id="existing_buildup_area" class="noc_area form-control--custom text-box float" value="{{ isset($data) ? $data->existing_buildup_area : '' }}" {{$disabled}}>
                                                </p>
                                                <p>ii)BUA already allotted vide as lease,
                                                   <div class="col-sm-4 form-group">
                                                    <label class="col-form-label" for="m_datepicker"> NOC date: </label>
                                                    <input type="text" id="m_datepicker" name="area[noc_date]" data-date-end-date="+0d" class="form-control form-control--custom m-input m_datepicker" value="{{ isset($data) ? date(config('commanConfig.dateFormat'), strtotime($data->noc_date)) : '' }}" required {{$disabled}}>
                                                    <span class="help-block"></span> 
                                                </div> 
                                                 if any <input type="text" name="area[noc_vide_lease]" id="noc_vide_lease" class="noc_area form-control--custom text-box float" value="{{ isset($data) ? $data->noc_vide_lease : '' }}" {{$disabled}}></p>

                                                <p>iii)BUA permitted through this NOC <input type="text" name="area[noc_permitted_area]" id="noc_permitted_area" class="noc_area form-control--custom text-box float" value="{{ isset($data) ? $data->noc_permitted_area : '' }}" {{$disabled}}></p> -->
                                            </td>
                                            <td><input type="text" name="area[total_existing_permitted_area]" id="total_existing_permitted_area" class="form-control--custom text-box float" readonly value="{{ isset($data) ? $data->total_existing_permitted_area : '' }}"></td>
                                         </tr>
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
            @endif
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
                                          <a target="_blank" download href="{{ config('commanConfig.storage_server').'/'.$noc_application->ree_office_note_noc}} ">
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

   //build up area js

   $(".float").keypress(function(event){
      var key = window.event ? event.keyCode : event.which;
      if ((event.keyCode == 8 || event.keyCode == 46
          || event.keyCode == 37 || event.keyCode == 39) && this.value.split('.').length < 2) {
             return true;
         }
      else if ( key < 48 || key > 57 ) {
         return false;
      }
      else return true;   
   });

   $(".plot_area").keyup(function(){

     var lease_deed = $("#lease_deed_area").val().replace(/,/g, "") || 0;
     var land = $("#land_area").val().replace(/,/g, "") || 0;
      var total = (parseFloat(lease_deed) + parseFloat(land));
     if (!isNaN(total)){
      $("#plot_area").val(total.toFixed(2));
      $("#plot_area1").val(total.toFixed(2));
     }
     calculateBuildupArea();
     calculateTotalBUA();
   });

   function calculateBuildupArea(){
      var val = $("#fsi").val().replace(/,/g, "") || 0;
       var plot_area = $("#plot_area1").val();
      var total = (parseFloat(val) * parseFloat(plot_area));
      if (!isNaN(total)){
         $("#buildup_area").val(total.toFixed(2));
      }
   }

   $("#fsi").keyup(function(){
      calculateBuildupArea();
      calculateTotalBUA();   
   }); 

   $(".tenement_area").keyup(function(){
      var tenementNo = $("#tenement_no").val().replace(/,/g, "") || 0;
      var tenementArea = $("#tenement_area").val().replace(/,/g, "") || 0;
      var total = (parseFloat(tenementNo) * parseFloat(tenementArea));
      if (!isNaN(total)){
         $("#total_tenement_area").val(total.toFixed(2));
      }
      calculateTotalBUA();
   });

   function calculateTotalBUA(){
      var buildupArea = $("#buildup_area").val().replace(/,/g, "") || 0;
      var tenementArea = $("#total_tenement_area").val().replace(/,/g, "") || 0;
      var balArea = $("#balance_buildup_area").val().replace(/,/g, "") || 0;
      var total = (parseFloat(buildupArea) + parseFloat(tenementArea) + parseFloat(balArea));
      if (!isNaN(total)){
         $("#total_permissable_bua").val(total.toFixed(2));
         $("#total_buildup_area").val(total.toFixed(2));
      }
   }

   $(".noc_area").keyup(function(){
      var nocPermitted = $("#existing_residential_use").val() || 0;
      var area = $("#existing_buildup_area").val() || 0;
      var videLease = $("#additional_area").val() || 0;

      var total = (parseFloat(nocPermitted) + parseFloat(area) + parseFloat(videLease));
      if (!isNaN(total)){
         console.log(total);
         $("#total_existing_permitted_area").val(total.toFixed(2));
         $(".total_existing").val(total.toFixed(2));
      }
   });

   $(".total_buitup").keyup(function(){
      var res = $("#residential_use").val() || 0;
      var com = $("#commercial_use").val() || 0;

      var total = (parseFloat(res) + parseFloat(com));
      if (!isNaN(total)){
         $("#total_buildup_area").val(total.toFixed(2));
      }
   });
   
</script>
@endsection