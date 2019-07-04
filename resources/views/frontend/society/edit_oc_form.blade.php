@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.oc_actions',compact('oc_applications'))
@endsection
@section('content')
@php
    $floor = ['Ground','Stilt','parking'];
    $i = 1;

if($oc_application->request_form->is_full_oc==1){
    $style = 'display:none';
}  else{
    $style = 'display:flex';
}
@endphp

    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Consent For OC Application Form</h3>
                {{ Breadcrumbs::render('society_oc_edit',$oc_applications->id) }}&nbsp;({{ $oc_applications->ol_application_master->model }})

            </div> 
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

            <form id="save_offer_letter_application_dev" role="form" method="post" class="m-form m-form--rows m-form--label-align-right floating-labels-form" action="{{ route('society_oc_update') }}">
                @csrf
                <input type="hidden" name="applicationId" value="{{ $oc_applications->id}}">
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-4 col-lg-4 form-group">
                            <label class="col-form-label mhada-multiple-label" for="application_type_id">Select layout:</label>
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layouts" name="layout_id" required>
                                @foreach($layouts as $layout)
                                    <option value="{{ $layout['id'] }}">{{ $layout['layout_name'] }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('application_type_id')}}</span>
                        </div>
                        <div class="col-xl-4 col-lg-4 form-group">
                            <label class="col-form-label" for="preceding_officer_name">Department:</label>
                            <input type="text" id="department_name" name="department_name" class="form-control form-control--custom m-input" value="Executive Engineer" readonly>
                            <input type="hidden" name="application_master_id" value="{{ $id }}">
                            <input type="hidden" name="request_form_id" value="{{ $oc_application->request_form->id }}">
                            <span class="help-block">{{$errors->first('department_name')}}</span>
                        </div>
                        <div class="col-xl-4 col-lg-4 form-group">
                            <label class="col-form-label" for="case_year">Building No:</label>
                            <input type="text" id="building_no" name="building_no" class="form-control form-control--custom m-input" value="{{ $society_details->building_no }}" readonly>
                            <span class="help-block">{{$errors->first('building_no')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-4 col-lg-4 form-group">
                            <label class="col-form-label" for="name">Society Name:</label>
                            <input type="text" id="name" name="name" class="form-control form-control--custom m-input" value="{{ $society_details->name }}" readonly>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="col-xl-4 col-lg-4 form-group">
                            <label class="col-form-label" for="address">Society Address:</label>
                            <textarea id="address" name="address" class="form-control form-control--custom form-control--fixed-height m-input" readonly>{{ $society_details->address }}</textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                        <div class="col-xl-4 col-lg-4 form-group">
                            <label class="col-form-label" for="architect_name">Architect Name:</label>
                            <input type="text" id="architect_name" name="architect_name" class="form-control form-control--custom m-input" value="{{ $society_details->name_of_architect }}" readonly>
                            <span class="help-block">{{$errors->first('architect_name')}}</span>
                        </div>
                    </div>

                     <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-4 col-lg-4 form-group">
                            <label class="col-form-label" for="noc_number">NOC Number:</label>
                            <input type="text" id="noc_number" name="noc_number" class="form-control form-control--custom m-input" value="{{ isset($oc_application->request_form) ? $oc_application->request_form->noc_number : '' }}" required>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="col-xl-4 col-lg-4 form-group">
                            <label class="col-form-label" for="m_datepicker">NOC Date:</label>
                             <input type="text" id="m_datepicker" name="noc_date" data-date-end-date="+0d" class="form-control form-control--custom m-input m_datepicker" value="{{ (isset($oc_application->request_form) && $oc_application->request_form->noc_date) ? date(config('commanConfig.dateFormat'), strtotime($oc_application->request_form->noc_date)) : '' }}" required>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                        @if($id == '16' || $id == '22')
                            <div class="col-xl-4 col-lg-4 form-group">
                                <label class="col-form-label" for="developer_name">Developer Name:</label>
                                <input type="text" id="developer_name" name="developer_name" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $society_details->developer_name }}">
                                <span class="help-block">{{$errors->first('developer_name')}}</span>
                            </div>
                        @endif
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-4 col-lg-4 form-group">
                            <label class="col-form-label" for="cts_no">CTS NO:</label>
                            <input type="text" id="cts_no" name="cts_no" class="form-control form-control--custom m-input" value="{{ $oc_application->request_form->cts_no }}">
                            <span class="help-block">{{$errors->first('cts_no')}}</span>
                        </div>
                        <div class="col-xl-4 col-lg-4 form-group">
                            <label class="col-form-label" for="is_full_oc">Type Of OC</label>
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="is_full_oc" name="is_full_oc" required>
                                <option value="1" @if($oc_application->request_form->is_full_oc==1) selected @endif>Full OC</option>
                                <option value="0" @if($oc_application->request_form->is_full_oc==0) selected @endif>Part OC</option>
                            </select>
                            <span class="help-block">{{$errors->first('is_full_oc')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin part_visible" style="{{ $style }}">
                        <div class="col-xl-4 col-lg-4 form-group">
                            <label class="col-form-label" for="lease_deed_area">Supplymantry lease deed area(sq.mt) <span class="star">*</span></label>
                            <input type="text" id="lease_deed_area" name="lease_deed_area" class="form-control form-control--custom m-input" value="{{ $oc_application->request_form->lease_deed_area }}">
                        </div>
                        <div class="col-xl-4 col-lg-4 form-group">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="floor" name="floor" required>
                            @if(isset($floor))
                                @foreach($floor as $value)
                                    @if(isset($oc_application->request_form) && $value == $oc_application->request_form->floor)
                                        <option value="{{ $value }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endif
                                @endforeach    
                            @endif
                            </select>
                        </div>    
                        <div class="col-xl-4 col-lg-4 form-group">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="floor_no" name="floor_no" data-live-search="true" required>
                            @for($i=1;$i<=100;$i++)
                                @if(isset($oc_application->request_form) && $i == $oc_application->request_form->floor_no)
                                    <option value="{{$i}}" selected>{{ $i }}</option>
                                @else
                                    <option value="{{$i}}">{{ $i }}</option>
                                @endif
                            @endfor    
                            </select>
                        </div>
                    </div>

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <button type="submit"  class="btn btn-primary">Update</button>
                                        <a href="{{route('society_offer_letter_dashboard')}}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('actions_js')
<script type="text/javascript">
    //hide and show feilds on selected type of oc
    $("#is_full_oc").change(function(){
        var type = this.value;
        if (type == 0){
            $(".part_visible").show('slow');
        }else{
            $(".part_visible").hide('slow');
        }
    });
</script>
@endsection