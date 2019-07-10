@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.conveyance.dyco_department.action')
@endsection
@section('content')
     
<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Forward Application </h3>
                     {{ Breadcrumbs::render('conveyance_forward_application',$data->id) }}
                    <div class="ml-auto btn-list">
                        <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                    </div>
            </div>
        </div> 

        <div class="">
            <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom">
                <li class="nav-item m-tabs__item" data-target="#document-scrunity">
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#scrutiny-history-tab">
                        <i class="la la-cog"></i> Scrutiny History
                    </a>
                </li>

                @if(( (session()->get('role_name') == config('commanConfig.dycdo_engineer') || session()->get('role_name') == config('commanConfig.cdo_engineer') || session()->get('role_name') == config('commanConfig.dyco_engineer')) 

                && $data->status->status_id != config('commanConfig.conveyance_status.forwarded') 
                && $data->status->status_id != config('commanConfig.conveyance_status.reverted'))

                || $data->status->status_id == config('commanConfig.conveyance_status.Stamped_sale_&_lease_deed') 

                || $data->status->status_id == config('commanConfig.conveyance_status.Draft_sale_&_lease_deed') 

                || $data->status->status_id == config('commanConfig.conveyance_status.in_process') )
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
                                        <span class="field-value">{{(isset($data->application_no) ?
                                            $data->application_no : '')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Application Date:</span>
                                        <span class="field-value">{{($data->created_at) ?
                                            date(config('commanConfig.dateFormat'),strtotime($data->created_at))
                                            : ''}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Society Registration No:</span>
                                        <span class="field-value">{{(isset($data->societyApplication->registration_no)
                                            ? $data->societyApplication->registration_no : '')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Society Name:</span>
                                        <span class="field-value">{{(isset($data->societyApplication->name)
                                            ? $data->societyApplication->name : '')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col"> 
                                    <div class="d-flex">
                                        <span class="field-name">Society Address:</span>
                                        <span class="field-value">{{(isset($data->societyApplication->address)
                                            ? $data->societyApplication->address : '')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Building Number:</span>
                                        <span class="field-value">{{(isset($data->societyApplication->building_no)
                                            ? $data->societyApplication->building_no : '')}}</span>
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
                                        <span class="field-value">{{(isset($data->societyApplication->name_of_architect)
                                            ? $data->societyApplication->name_of_architect : '')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Architect Mobile Number:</span>
                                        <span class="field-value">{{(isset($data->societyApplication->architect_mobile_no)
                                            ? $data->societyApplication->architect_mobile_no : '')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Architect Address:</span>
                                        <span class="field-value">{{(isset($data->societyApplication->architect_address)
                                            ? $data->societyApplication->architect_address : '')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Architect Telephone Number:</span>
                                        <span class="field-value">{{(isset($data->societyApplication->architect_telephone_no)
                                            ? $data->societyApplication->architect_telephone_no : '')}}</span>
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
                                <div class="pb-2">
                                    <h3 class="section-title section-title--small mb-2">
                                        Remark History:
                                    </h3>
                                </div> 
                                <div class="col-md-12 table-responsive">  
                                    <table id="dtBasicExample" class="table">
                                      <thead>
                                        <tr>
                                          <th class="th-sm">Role Name</th>
                                          <th class="th-sm">Date</th>
                                          <th class="th-sm">Time</th>
                                          <th class="th-sm">Action</th>
                                          <th class="th-sm">Description</th>
                                        </tr>
                                      </thead> 
                                      <tbody>
                                      @if($remarkHistory)
                                          @foreach($remarkHistory as $log)

                                            @if($log->status_id == config('commanConfig.applicationStatus.forwarded'))
                                                @php $status = 'Forwarded'; @endphp
                                            @elseif($log->status_id == config('commanConfig.applicationStatus.reverted'))
                                                @php $status = 'Reverted'; @endphp
                                            @endif 

                                            <tr>
                                                <td>{{isset($log->getRole->display_name) ? $log->getRole->display_name : ''}}</td>
                                                <td>{{(isset($log) && $log->created_at != '' ? date("d-m-Y",
                                                            strtotime($log->created_at)) : '')}}</td>
                                                <td>{{(isset($log) && $log->created_at != '' ? date("H:i",
                                                            strtotime($log->created_at)) : '')}}</td>
                                                <td>{{$status}} to {{isset($log->getRoleName->display_name) ? $log->getRoleName->display_name : ''}}</td>
                                                <td>{{(isset($log) ? $log->remark : '')}}</td>
                                            </tr>
                                            @endforeach
                                        @endif    
                                      </tbody>
                                    </table>
                                </div>                                                            
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane show" id="forward-application-tab">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                <div class="">
                                    <h3 class="section-title section-title--small">
                                        Remarks and Suggestions:
                                    </h3>
                                </div>
                                <div class="remarks-suggestions">
                                    <form action="{{ route('dyco.forward_application_data') }}" id="forwardApplication" method="post">
                                        @csrf
                                        <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
                                        <input type="hidden" name="to_role_id" id="to_role_id">
                                        
                                        <input type="hidden" name="check_status" class="check_status" value="1">

                                        <div class="m-form__group form-group">
                                            <div class="m-radio-inline">
                                                <!-- disable forward  -->
                                                @if(session()->get('role_name') == config('commanConfig.dyco_engineer') && $data->status->status_id == config('commanConfig.conveyance_status.Send_society_to_pay_stamp_duty'))
                                                @else
                                                
                                                <label class="m-radio m-radio--primary">
                                                    <input type="radio" name="remarks_suggestion" id="forward" class="forward-application"
                                                        value="1" checked> Forward Application
                                                    <span></span>
                                                </label>
                                                @endif

                                                @if($data->child != "")    
                                                    <label class="m-radio m-radio--primary">
                                                        <input type="radio" name="remarks_suggestion" id="remark" class="forward-application"
                                                            value="0"> Revert Application
                                                        <span></span>
                                                    </label>  
                                                @endif
                                            </div>
                                            <!-- forward parent -->
                                            @if(session()->get('role_name') == config('commanConfig.dyco_engineer') && $data->status->status_id == config('commanConfig.conveyance_status.Send_society_to_pay_stamp_duty'))
                                            @else
                                                <div class="form-group m-form__group row mt-3 parent-data" id="select_dropdown">
                                                    <label class="col-form-label col-lg-2 col-sm-12">
                                                        Forward To:
                                                    </label>
                                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="to_user" value="" name="to_user_id[]" {{(count($parentData) > 1 && session()->get('role_name') == config('commanConfig.dyco_engineer')) ? 'multiple' : '' }}>

                                                            @if(count($parentData) > 0 && session()->get('role_name') == config('commanConfig.dyco_engineer'))

                                                            @foreach($parentData as $parent)
                                                                <option value="{{ $parent->id}}" data-role="{{ $parent->role_id }}">{{ $parent->name }} ({{ $parent->roles[0]->display_name }})</option>
                                                            @endforeach

                                                            @elseif($data->parent)
                                                                @foreach($data->parent as $parent)
                                                                    <option value="{{ $parent->id}}" data-role="{{ $parent->role_id }}">{{ $parent->name }} ({{ $parent->roles[0]->display_name }})</option>
                                                                @endforeach
                                                            @endif    
                                                             
                                                            
                                                        </select> 
                                                        <span class="error" style="display: none;color: #ce2323;margin-bottom: 17px;"> * Required</span>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- revert child -->
                                            <input type="hidden" id="society_flag" name="society_flag" value="0">
                                             @if($data->child != "")
                                            <div class="form-group m-form__group row mt-3 child-data" style="display: none">
                                                <label class="col-form-label col-lg-2 col-sm-12">
                                                    Revert To:
                                                </label>
                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="to_child_id" name="to_child_id[]">

                                                        @if(count($childData) > 0 && session()->get('role_name') == config('commanConfig.dyco_engineer'))

                                                        @foreach($childData as $child)
                                                            <option value="{{ $child->id}}" data-role="{{ $child->role_id }}">{{ $child->name }} ({{ $child->roles[0]->display_name }})</option>
                                                        @endforeach
                                                        
                                                        @elseif(isset($data->child))
                                                            @foreach($data->child as $child)
                                                                <option value="{{ $child->id }}" data-society="{{ ($child->role_id == $data->society_role_id) ? 1 : 0 }}"
                                                                data-role="{{ $child->role_id }}">{{ $child->name }} ({{ $child->roles[0]->display_name }}) </option>
                                                            @endforeach
                                                        @endif    
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                            @if(count($parentData) > 1)
                                                @foreach($parentData as $parent)
                                                    <div class="mt-3 table--box-input show_parent">
                                                        <label for="remark" style="font-weight: 500;">Remark for {{ $parent->roles[0]->display_name }}:</label>
                                                        <textarea class="form-control form-control--custom" name="remark[{{$parent->id}}]" id="remark"
                                                            cols="30" rows="5"></textarea>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="mt-3 table--box-input show_parent">
                                                    <label for="remark" style="font-weight: 500;">Remark :</label>
                                                    <textarea class="form-control form-control--custom" name="remark" id="remark"
                                                        cols="30" rows="5"></textarea>
                                                </div>
                                            @endif
                                                <div class="mt-3 table--box-input show_child" style="display: none">
                                                    <label for="remark" style="font-weight: 500;">Remark :</label>
                                                    <textarea class="form-control form-control--custom" name="remark" id="remark_child" cols="30" rows="5" disabled></textarea>
                                                </div>

                                                <div class="mt-3 btn-list">
                                                    <button type="submit" class="btn btn-primary">Forward</button>
                                                    {{--<button type="submit" id="sign" class="btn btn-primary forwrdBtn">Sign</button>
                                                    <button type="submit" class="btn btn-primary forwrdBtn">Sign & Forward</button>
                                                    <button type="submit" class="btn btn-primary forwrdBtn">Forward</button>--}}
                                                    <button type="button" onclick="window.location='{{ route("conveyance.index") }}'" class="btn btn-secondary" >Cancel</button>
                                                </div>
                                        </div>
                                        <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
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
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $(".forward-application").change(function () {
            var data = $(this).val();

            if (data == 1) {
                $(".parent-data").show();
                $(".child-data").hide();
                $(".check_status").val(1);
                $(".show_parent").show('slow');
                $(".show_child").hide('slow');
                $("#remark_child").attr('disabled','');
            } else {
                $(".show_parent").hide('slow');
                $(".show_child").show('slow');
                $("#remark_child").removeAttr('disabled');
                $(".parent-data").hide();
                $(".child-data").show();
                $(".check_status").val(0);
            }
        });

        $("#forwardApplication").on("submit", function () {
            var data = $(".check_status").val();
            if (data == 1) {
                var id = $("#to_user").find('option:selected').attr("data-role");
                
                if (id != undefined){
                    $(".error").css("display","none");
                    var user_id = $("#to_user").find('option:selected').attr("value");
                }else{
                    $(".error").css("display","block");
                    return false;
                }
                
            } else {
                
                var id = $("#to_child_id").find('option:selected').attr("data-role");
                var society_flag = $("#to_child_id").find('option:selected').attr("data-society");
                $("#society_flag").val(society_flag);
                var user_id = $("#to_child_id").find('option:selected').attr("value");
            }
            $("#to_role_id").val(id);
            // $("#to_user_id").val(user_id);
        });
    });

    $(document).ready(function () {
      $('#dtBasicExample').DataTable();
      $('.dataTables_length').addClass('bs-select');

      $('#dtBasicExample_wrapper > .row:first-child').remove();
    });  

    $('table').dataTable({searching: false, ordering:false, info: false});      

</script>

@endsection
