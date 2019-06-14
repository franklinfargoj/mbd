@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.co_department.action_noc',compact('noc_application'))
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
         {{ Breadcrumbs::render('scrutiny-remark-noc_co',$noc_application->id) }}
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
         <div class="tab-content">
            @php
            $style = "display:none";
            $style1 = "display:none";
            $disabled='disabled';
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
                           <a href="{{ route('ree.noc_variation_report',$noc_application->id)}}" class="btn btn-primary">Generate Variation Report</a>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
           
             @if(isset($noc_application->noc_application_master) && $noc_application->noc_application_master->model == 'Premium')
            <div>
               <div class="m-portlet m-portlet--no-top-shadow">
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
                                      <tr>

                                         <td>1</td>
                                         <td><p>Plot Area as per demarcation </p>
                                             <p> i) Area as per Lease Deed <input type="text" id="lease_deed_area" name="area[lease_deed_area]" class="number plot_area form-control--custom text-box" value="{{ isset($data) ? $data->lease_deed_area : '' }}" {{$disabled}}></p>
                                             <p> ii) Additional land <input type="text" id="land_area" 
                                             name="area[land_area]" class="plot_area number form-control--custom text-box" value="{{ isset($data) ? $data->land_area : '' }}" {{$disabled}}></p>
                                         </td>
                                         <td><input type="text" id="plot_area" name="area[plot_area]" value="{{ isset($data) ? $data->plot_area : '' }}" class="form-control--custom text-box number" readonly></td>
                                      </tr>
                                      <tr>
                                         <td>2</td>
                                         <td>Built up Area permissible <input type="text" id="plot_area1" class="form-control--custom text-box" readonly value="{{ isset($data) ? $data->plot_area : '' }}"> * <input type="text" name="area[fsi]" class="number form-control--custom text-box" id="fsi" value="{{ isset($data) ? $data->fsi : '' }}" {{$disabled}}> FSI</td>
                                         <td><input type="text" name="area[buildup_area]" class="form-control--custom text-box" id="buildup_area" value="{{ isset($data) ? $data->buildup_area : '' }}" readonly></td>
                                      </tr>
                                      <tr>
                                         <td>3</td>
                                         <td>
                                            <p> i)Prorata per tenement <input type="text" id="tenement_no" 
                                            name="area[tenement_no]" class="tenement_area form-control--custom text-box number" value="{{ isset($data) ? $data->tenement_no : '' }}" {{$disabled}}></p>
                                            <p> ii)Area as per tenement <input type="text" id="tenement_area" name="area[tenement_area]" class="tenement_area form-control--custom text-box number" value="{{ isset($data) ? $data->tenement_area : '' }}" {{$disabled}}></p>
                                         </td>
                                         <td><input type="text" name="area[total_tenement_area]" id="total_tenement_area" value="{{ isset($data) ? $data->total_tenement_area : '' }}" class="form-control--custom text-box" readonly></td>
                                      </tr>
                                      <tr>
                                         <td>4</td>
                                         <td>From discretionary 10% quota of HON, VP/A from balance built up area of layout</td>
                                         <td><input type="text" class="form-control--custom text-box number" name="area[balance_buildup_area]" id="balance_buildup_area" value="{{ isset($data) ? $data->balance_buildup_area : '' }}" onkeyup="calculateTotalBUA()" {{$disabled}}> </td>
                                      </tr>
                                      <tr>
                                         <td>5</td>
                                         <td>Total BUA permissible (sr 2+3+4)</td>
                                         <td><input type="text" name="area[total_permissable_bua]" id="total_permissable_bua" class="form-control--custom text-box number" readonly value="{{ isset($data) ? $data->total_permissable_bua : '' }}"></td>
                                      </tr>
                                      <tr>
                                         <td>6</td>
                                         <td><b> Total built up area permitted for obtaining I.O.D /I.O.A </b></td>
                                         <td><input type="text" name="area[total_buildup_area]" class="form-control--custom text-box number" value="{{ isset($data) ? $data->total_buildup_area : '' }}" {{$disabled}}> </td>
                                      </tr>
                                      <tr>
                                         <td>7</td>
                                         <td>
                                             <p>i) Existing built up area <input type="text" 
                                             name="area[existing_buildup_area]" id="existing_buildup_area" class="noc_area form-control--custom text-box number" value="{{ isset($data) ? $data->existing_buildup_area : '' }}" {{$disabled}}>
                                             </p>
                                             <p>ii)BUA already allotted vide as lease,
                                                   <div class="col-sm-4 form-group">
                                                    <label class="col-form-label" for="m_datepicker"> NOC date: </label>
                                                    <input type="text" id="m_datepicker" name="area[noc_date]" data-date-end-date="+0d" class="form-control form-control--custom m-input m_datepicker" value="{{ isset($data) ? date(config('commanConfig.dateFormat'), strtotime($data->noc_date)) : '' }}" required {{$disabled}}>
                                                    <span class="help-block"></span> 
                                                </div> 
                                                 if any <input type="text" name="area[noc_vide_lease]" id="noc_vide_lease" class="noc_area form-control--custom text-box number" value="{{ isset($data) ? $data->noc_vide_lease : '' }}" {{$disabled}}></p>

                                             <p>iii)BUA permitted through this NOC <input type="text" name="area[noc_permitted_area]" id="noc_permitted_area" class="noc_area form-control--custom text-box number" value="{{ isset($data) ? $data->noc_permitted_area : '' }}" {{$disabled}}></p>
                                         </td>
                                         <td><input type="text" name="area[total_existing_permitted_area]" id="total_existing_permitted_area" class="form-control--custom text-box number" readonly value="{{ isset($data) ? $data->total_existing_permitted_area : '' }}"></td>
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
                                          <a download href="{{ config('commanConfig.storage_server').'/'.$noc_application->ree_office_note_noc}} ">
                                          <button class="btn btn-primary">
                                          Download</button>
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                                 @else
                                 <div class="col-sm-12" style="{{ $display }}">
                                    <div class="d-flex flex-column h-100 two-cols">
                                       <h5>Upload Note</h5>
                                       <span class="hint-text">Click on 'Upload' to upload REE - Note</span>
                                       <form action="{{ route('ree.upload_office-note-noc') }}" method="post"
                                          enctype="multipart/form-data">
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
   
</script>
@endsection