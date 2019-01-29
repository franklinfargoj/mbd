@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.co_department.action_noc_cc',compact('noc_application'))
@endsection
@section('content')
<div class="custom-wrapper">
   <div class="col-md-12">
      <div class="d-flex">
         {{ Breadcrumbs::render('Forward_noc_cc_Application_co',$noc_application->id) }}
         <div class="ml-auto btn-list">
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
         </div>
      </div>
      <div class="">
         <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom">
            <li class="nav-item m-tabs__item" data-target="#document-scrunity">
               <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#scrutiny-history-tab">
               <i class="la la-cog"></i> Scrutiny History
               </a>
            </li>
            @if($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.in_process') ||
            ($arrData['get_current_status']->status_id ==
            config('commanConfig.applicationStatus.NOC_Generation') && session()->get('role_name') !=
            config('commanConfig.co_engineer')) || ($arrData['get_current_status']->status_id ==
            config('commanConfig.applicationStatus.NOC_Issued') && session()->get('role_name') !=
            config('commanConfig.ree_branch_head')) || ($arrData['get_current_status']->status_id ==
            config('commanConfig.applicationStatus.NOC_Issued') && session()->get('role_name') !=
            config('commanConfig.co_engineer')))
            <li class="nav-item m-tabs__item">
               <a class="nav-link m-tabs__link show" data-toggle="tab" href="#forward-application-tab">
               <i class="la la-cog"></i> Forward Application
               </a>
            </li>
            @endif
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
                              <span class="field-value">{{(isset($applicationData->application_no)
                              ? $applicationData->application_no : '')}}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Application Date:</span>
                              <span class="field-value">{{(isset($applicationData->submitted_at)
                              ?
                              date(config('commanConfig.dateFormat'),strtotime($applicationData->submitted_at))
                              : '')}}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Society Registration No:</span>
                              <span class="field-value">{{(isset($applicationData->eeApplicationSociety->registration_no)
                              ? $applicationData->eeApplicationSociety->registration_no : '')}}</span>
                           </div>
                        </div>                        
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Society Name:</span>
                              <span class="field-value">{{(isset($applicationData->eeApplicationSociety->name)
                              ? $applicationData->eeApplicationSociety->name : '')}}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Society Address:</span>
                              <span class="field-value">{{(isset($applicationData->eeApplicationSociety->address)
                              ? $applicationData->eeApplicationSociety->address : '')}}</span>
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
                              ? $applicationData->eeApplicationSociety->name_of_architect :
                              '')}}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Architect Mobile Number:</span>
                              <span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_mobile_no)
                              ? $applicationData->eeApplicationSociety->architect_mobile_no :
                              '')}}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Architect Address:</span>
                              <span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_address)
                              ? $applicationData->eeApplicationSociety->architect_address :
                              '')}}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Architect Telephone Number:</span>
                              <span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_telephone_no)
                              ?
                              $applicationData->eeApplicationSociety->architect_telephone_no
                              : '')}}</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-content">
            <div class="tab-pane active show" id="scrutiny-history-tab">
               <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                  <div class="portlet-body">
                     <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                        <h3 class="section-title section-title--small mb-4">
                            Remark History:
                        </h3>
                        @if(count($reeLogs) == 0 && count($coLogs) == 0)
                        <h4 class="section-title section-title--small mb-4"><small>No Remarks found..</small></h4>
                        @endif
                        @if(count($reeLogs) > 0)
                        <div class="remark-body">
                           <div class="border-bottom pb-2">
                              <span class="hint-text d-block font-weight-semi-bold">Remark by REE Department</span>
                           </div>
                           <div class="remarks-section">
                              <div class="m-scrollable m-scroller ps ps--active-y remarks-section-container"
                                 data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">
                                 <!-- EE logs -->
                                 @foreach($reeLogs as $log)
                                 @if($log->status_id == config('commanConfig.applicationStatus.forwarded'))
                                 @php $status = 'Forwarded'; @endphp
                                 @elseif($log->status_id == config('commanConfig.applicationStatus.reverted'))
                                 @php $status = 'Reverted'; @endphp
                                 @endif  
                                 <div class="remarks-section__data">
                                    <p class="remarks-section__data__row"><span>Date:</span><span>{{(isset($log) && $log->created_at != '' ? date("d-m-Y",
                                       strtotime($log->created_at)) : '')}}</span>
                                    </p>
                                    <p class="remarks-section__data__row"><span>Time:</span><span>{{(isset($log) && $log->created_at != '' ? date("H:i",
                                       strtotime($log->created_at)) : '')}}</span>
                                    </p>
                                    <p class="remarks-section__data__row"><span>Action:</span>
                                       <span>{{$status}} to {{isset($log->getRoleName->display_name) ? $log->getRoleName->display_name : ''}} From {{isset($log->getRole->display_name) ? $log->getRole->display_name : ''}}</span>
                                    </p>
                                    <p class="remarks-section__data__row"><span>Description:</span><span>{{(isset($log) ? $log->remark : '')}}</span></p>
                                 </div>
                                 @endforeach
                              </div>
                           </div>
                        </div>
                        @endif                                
                        @if(count($coLogs) > 0)
                        <div class="remark-body">
                           <div class="border-bottom pb-2">
                              <span class="hint-text d-block t-remark">Remark by CO Department</span>
                           </div>
                           <div class="remarks-section">
                              <div class="m-scrollable m-scroller ps ps--active-y remarks-section-container"
                                 data-scrollbar-shown="true" data-scrollable="true" data-max-height="130">
                                 @foreach($coLogs as $log)
                                 @if($log->status_id == config('commanConfig.applicationStatus.forwarded'))
                                 @php $status = 'Forwarded'; @endphp
                                 @elseif($log->status_id == config('commanConfig.applicationStatus.reverted'))
                                 @php $status = 'Reverted'; @endphp
                                 @endif
                                 <div class="remarks-section__data">
                                    <p class="remarks-section__data__row"><span>Date:</span><span>{{(isset($log) && $log->created_at != '' ? date("d-m-Y",
                                       strtotime($log->created_at)) : '')}}</span>
                                    </p>
                                    <p class="remarks-section__data__row"><span>Time:</span><span>{{(isset($log) && $log->created_at != '' ? date("H:i",
                                       strtotime($log->created_at)) : '')}}</span>
                                    </p>
                                    <p class="remarks-section__data__row"><span>Action:</span>
                                       <span>{{$status}} to {{isset($log->getRoleName->display_name) ? $log->getRoleName->display_name : ''}} From {{isset($log->getRole->display_name) ? $log->getRole->display_name : ''}}</span>
                                    </p>
                                    <p class="remarks-section__data__row"><span>Description:</span><span>{{(isset($log) ? $log->remark : '')}}</span></p>
                                 </div>
                                 @endforeach                                         
                              </div>
                           </div>
                        </div>
                        @endif     
                        <div class="remark-body" style="display:none;">
                           <div class="border-bottom pb-2">
                              <span class="hint-text d-block font-weight-semi-bold">Remark by
                              REE</span>
                           </div>
                           <div class="remarks-section">
                              <div class="m-scrollable m-scroller ps ps--active-y remarks-section-container"
                                 data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">
                                 @foreach($reeLogs as $log)
                                 @if($log->status_id == config('commanConfig.applicationStatus.forwarded'))
                                 @php $status = 'Forwarded'; @endphp
                                 @elseif($log->status_id == config('commanConfig.applicationStatus.reverted'))
                                 @php $status = 'Reverted'; @endphp
                                 @endif                       
                                 <!-- DyCE Logs-->
                                 <div class="remarks-section__data">
                                    <p class="remarks-section__data__row"><span>Date:</span><span>{{(isset($log) && $log->created_at != '' ? date("d-m-Y",
                                       strtotime($log->created_at)) : '')}}</span>
                                    </p>
                                    <p class="remarks-section__data__row"><span>Time:</span><span>{{(isset($log) && $log->created_at != '' ? date("H:i",
                                       strtotime($log->created_at)) : '')}}</span>
                                    </p>
                                    <p class="remarks-section__data__row"><span>Action:</span>
                                       <span>{{$status}} to {{isset($log->getRoleName->display_name) ? $log->getRoleName->display_name : ''}}</span>
                                    </p>
                                    <p class="remarks-section__data__row"><span>Description:</span>
                                       <span>{{(isset($log) ? $log->remark : '')}}</span>
                                    </p>
                                 </div>
                                 @endforeach
                                 <div class="remarks-section__data" style="display: none">
                                    <p class="remarks-section__data__row"><span>Date:</span><span>{{(isset($applicationData->dyceForwardLog)
                                       && $applicationData->dyceForwardLog->created_at !=
                                       '' ? date("d-m-Y",
                                       strtotime($applicationData->dyceForwardLog->created_at))
                                       : '')}}</span>
                                    </p>
                                    <p class="remarks-section__data__row"><span>Time:</span><span>{{(isset($applicationData->dyceForwardLog)
                                       && $applicationData->dyceForwardLog->created_at !=
                                       '' ? date("H:i",
                                       strtotime($applicationData->dyceForwardLog->created_at))
                                       : '')}}</span>
                                    </p>
                                    <p class="remarks-section__data__row"><span>Action:</span><span>Forward 
                                       to REE</span>
                                    </p>
                                    <p class="remarks-section__data__row"><span>Description:</span><span>{{(isset($applicationData->dyceForwardLog->remark)
                                       ? $applicationData->dyceForwardLog->remark : '')}}</span></ 
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div
            class="tab-pane show" id="forward-application-tab">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
               <div class="portlet-body">
                  <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                     <div class="">
                        <h3 class="section-title section-title--small">
                           Remark and Suggestions:
                        </h3>
                     </div>
                     <div class="remarks-suggestions">
                        <form action="{{ route('co.forward_noc_cc_application_data') }}"
                           id="forwardApplication" method="post">
                           @csrf
                           <input type="hidden" name="to_role_id" id="to_role_id">
                           <input type="hidden" name="check_status" class="check_status"
                              value="1">
                           <div class="m-form__group form-group">
                              <div class="m-radio-inline">
                                 @if($arrData['get_current_status']->status_id
                                 !=
                                 config('commanConfig.applicationStatus.NOC_Issued'))
                                 <label class="m-radio m-radio--primary">
                                 <input type="hidden" name="user_id">
                                 <input type="hidden" name="role_id">
                                 <input type="radio" name="remarks_suggestion"
                                    id="forward" class="forward-application"
                                    value="1" checked>
                                 Forward Application
                                 <span></span>
                                 </label>
                                 @endif
                                 @if(session()->get('role_name')
                                 !=
                                 config('commanConfig.ree_junior')
                                 &&
                                 $arrData['get_current_status']->status_id
                                 !=
                                 config('commanConfig.applicationStatus.NOC_Issued') && session()->get('role_name')
                                 !=
                                 config('commanConfig.co_engineer'))
                                 <label class="m-radio m-radio--primary">
                                 <input type="radio" name="remarks_suggestion"
                                    id="remark" class="forward-application"
                                    value="0"> Revert
                                 Application
                                 <span></span>
                                 </label>
                                 @endif
                              </div>
                              @if($arrData['get_current_status']->status_id
                              ==
                              config('commanConfig.applicationStatus.NOC_Issued')
                              && (session()->get('role_name')
                              ==
                              config('commanConfig.ree_branch_head')))
                              <label class="m-radio m-radio--primary">
                              <input type="radio" name="remarks_suggestion"
                                 id="remark" class="forward-application"
                                 value="1" checked> Send
                              To Society
                              <span></span>
                              </label>
                              @else
                              <div class="form-group m-form__group row mt-3 parent-data"
                                 id="select_dropdown">
                                 <label class="col-form-label col-lg-2 col-sm-12">
                                 Forward To:
                                 </label>
                                 <div class="col-lg-4 col-md-9 col-sm-12">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                       name="to_user_id" id="to_user_id">
                                       @if($arrData['get_forward_ree'])
                                       @foreach($arrData['get_forward_ree']
                                       as $parent)
                                       <option value="{{ $parent->user_id }}"
                                          data-role="{{ $parent->role_id }}">{{
                                          $parent->name
                                          }} ({{
                                          $arrData['ree_role_name']
                                          }})
                                       </option>
                                       @endforeach
                                       @else
                                       @if(isset($arrData['get_forward_co']))
                                       @foreach($arrData['get_forward_co']
                                       as $parent)
                                       <option value="{{ $parent->user_id }}"
                                          data-role="{{ $parent->role_id }}">{{
                                          $parent->name
                                          }} ({{
                                          $arrData['co_role_name']
                                          }})
                                       </option>
                                       @endforeach
                                       @endif
                                       @endif
                                    </select>
                                 </div>
                                 @endif
                              </div>
                              @if(
                              session()->get('role_name')
                                 !=
                                 config('commanConfig.ree_junior')
                              &&
                              $arrData['get_current_status']->status_id
                              !=
                              config('commanConfig.applicationStatus.NOC_Issued') && session()->get('role_name')
                                 !=
                              config('commanConfig.co_engineer'))
                              <div class="form-group m-form__group row mt-3 child-data"
                                 style="display: none">
                                 <label class="col-form-label col-lg-2 col-sm-12">
                                 Revert To:
                                 </label>
                                 <div class="col-lg-4 col-md-9 col-sm-12">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                       name="to_child_id" id="to_child_id">
                                       @if(isset($arrData['application_status']))
                                       @foreach($arrData['application_status']
                                       as $child)
                                       <option value="{{ $child->id }}"
                                          data-role="{{ $child->role_id }}">{{
                                          $child->name }}
                                          ({{
                                          strtoupper(str_replace('_',
                                          '
                                          ',$child->roles[0]->name))
                                          }})
                                       </option>
                                       @endforeach
                                       @endif
                                    </select>
                                 </div>
                              </div>
                              @endif
                              <div class="mt-3 table--box-input">
                                 <label for="remark">Remark:</label>
                                 <textarea class="form-control form-control--custom"
                                    name="remark" id="remark" cols="30"
                                    rows="5"></textarea>
                              </div>
                              @if($noc_application->noc_generation_status == 0)
                              <div class="mt-3 btn-list">
                                 <button type="submit" class="btn btn-primary">Save</button>
                                 {{--<button type="submit" id="sign"
                                    class="btn btn-primary forwrdBtn">Sign</button>
                                 <button type="submit" class="btn btn-primary forwrdBtn">Sign
                                 & Forward</button>
                                 <button type="submit" class="btn btn-primary forwrdBtn">Forward</button>--}}
                                 <button type="button" onclick="window.location.href='{{ url("/co_noc_cc_applications") }}'"
                                 class="btn btn-secondary">Cancel</button>
                              </div>
                              @elseif($noc_application->noc_generation_status != 0 && isset($noc_application->final_draft_noc_path))
                              <div class="mt-3 btn-list">
                                 <button type="submit" class="btn btn-primary">Save</button>
                                 {{--<button type="submit" id="sign"
                                    class="btn btn-primary forwrdBtn">Sign</button>
                                 <button type="submit" class="btn btn-primary forwrdBtn">Sign
                                 & Forward</button>
                                 <button type="submit" class="btn btn-primary forwrdBtn">Forward</button>--}}
                                 <button type="button" onclick="window.location.href='{{ url("/co_noc_cc_applications") }}'"
                                 class="btn btn-secondary">Cancel</button>
                              </div>
                              @else                                    
                              <div>
                                 <span class="error" style="display: block;color: #ce2323;margin-top: 13px;">
                                 * Note : Please generate and upload NOC. </span>
                              </div>
                              @endif
                           </div>
                           <input type="hidden" name="applicationId" value="{{$applicationData->id}}">
                        </form>
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
</div>
</div>
</div>
</div>
@endsection
@section('js')
<script>
   $(document).ready(function () {
       $(".forward-application").change(function () {
           var data = $(this).val();
   
           if (data == 1) {
               $(".parent-data").show();
               $(".child-data").hide();
               $(".check_status").val(1)
           } else {
               $(".parent-data").hide();
               $(".child-data").show();
               $(".check_status").val(0);
           }
       });
   
       $("#forwardApplication").on("submit", function () {
           var data = $(".check_status").val();
           if (data == 1) {
               var id = $("#to_user_id").find('option:selected').attr(
                   "data-role");
           } else {
               var id = $("#to_child_id").find('option:selected').attr(
                   "data-role");
           }
   
           $("#to_role_id").val(id);
       });
   });
   
</script>
@endsection