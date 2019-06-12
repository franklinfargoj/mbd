@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.actions_noc',compact('noc_applications'))
@endsection
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Edit NOC Application Form</h3>
                {{ Breadcrumbs::render('noc_edit',encrypt($noc_application->id)) }}&nbsp;({{ $noc_application->noc_application_master->model }})

            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

            <form id="save_noc_application_dev" role="form" method="post" class="m-form m-form--rows m-form--label-align-right floating-labels-form" action="{{ route('society_noc_update') }}">
                @csrf
                <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group">
                            <label class="col-form-label" for="application_type_id">Select layout: <span class="star">*</span></label>
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layouts" data-live-search="true" name="layout_id" required>
                                @foreach($layouts as $layout)
                                    @if(isset($noc_application) && $noc_application->layout_id == $layout['id'])
                                        <option value="{{ $layout['id'] }}" selected>{{ $layout['layout_name'] }}</option>
                                    @else
                                        <option value="{{ $layout['id'] }}">{{ $layout['layout_name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('application_type_id')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group">
                            <label class="col-form-label" for="preceding_officer_name">Department:</label>
                            <input type="text" id="department_name" name="department_name" class="form-control form-control--custom m-input" value="Resident Executive Engineer" readonly>
                            <input type="hidden" name="application_master_id" value="{{ $id }}" >
                            <input type="hidden" name="applicationId" value="{{ $noc_application->id }}" >
                            <input type="hidden" name="request_form_id" value="{{ $noc_application->request_form->id }}">
                            <span class="help-block">{{$errors->first('department_name')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group">
                            <label class="col-form-label" for="case_year">Building No:</label>
                            <input type="text" id="building_no" name="building_no" class="form-control form-control--custom m-input" value="{{ $society_details->building_no }}" readonly>
                            <span class="help-block">{{$errors->first('building_no')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group">
                            <label class="col-form-label" for="name">Society Name:</label>
                            <input type="text" id="name" name="name" class="form-control form-control--custom m-input" value="{{ $society_details->name }}" readonly>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group">
                            <label class="col-form-label" for="address">Society Address:</label>
                            <textarea id="address" name="address" class="form-control form-control--custom form-control--fixed-height m-input" readonly>{{ $society_details->address }}</textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group">
                            <label class="col-form-label" for="offer_letter_number">Offer letter number: <span class="star">*</span></label>
                            <input type="text" id="offer_letter_number" name="offer_letter_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $noc_application->request_form->offer_letter_number }}" required>
                            <span class="help-block">{{$errors->first('offer_letter_number')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group">
                            <label class="col-form-label" for="offer_letter_date">Offer letter date:</label>
                            <input type="text" id="m_datepicker" name="offer_letter_date" class="form-control form-control--custom m-input m_datepicker" value="{{ date(config('commanConfig.dateFormat'), strtotime($noc_application->request_form->offer_letter_date)) }}" required>
                            <span class="help-block">{{$errors->first('offer_letter_date')}}</span>
                        </div>
                    </div>

                    <!-- show feilds at premium application -->
                    @if(isset($model) && $model == 'Premium')
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="demand_draft_amount">Premium pay order amount (Rs.) : <span class="star">*</span></label>
                            <input type="text" id="demand_draft_amount" name="demand_draft_amount" class="form-control form-control--custom form-control--fixed-height m-input number" value="{{ $noc_application->request_form->demand_draft_amount }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_amount')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="demand_draft_number">Premium receipt number : <span class="star">*</span></label>
                            <input type="text" id="demand_draft_number" name="demand_draft_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $noc_application->request_form->demand_draft_number }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_number')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="demand_draft_date">Premium receipt date : <span class="star">*</span></label>
                            <input type="text" id="m_datepicker" name="demand_draft_date" class="form-control form-control--custom m-input m_datepicker" value="{{ date(config('commanConfig.dateFormat'), strtotime($noc_application->request_form->demand_draft_date)) }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_date')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="demand_draft_bank">Offsite Infrastructure charges amount(Rs.) :<span class="star">*</span></label>
                            <input type="text" id="offsite_infra_charges" name="offsite_infra_charges" class="form-control form-control--custom form-control--fixed-height m-input number" value="{{ $noc_application->request_form->offsite_infra_charges }}" required>
                            <span class="help-block">{{$errors->first('offsite_infra_charges')}}</span>
                        </div>
                    </div>
                    
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="offsite_infra_receipt">Offsite Infrastructure receipt number : <span class="star">*</span></label>
                            <input type="text" id="offsite_infra_receipt" name="offsite_infra_receipt" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $noc_application->request_form->offsite_infra_receipt }}" required>
                            <span class="help-block">{{$errors->first('offsite_infra_receipt')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="offsite_infra_charges_receipt_date">Offsite Infrastructure charges receipt date : <span class="star">*</span></label>
                             <input type="text" id="m_datepicker" name="offsite_infra_charges_receipt_date" class="form-control form-control--custom m-input m_datepicker" data-date-end-date="+0d" value="{{ date(config('commanConfig.dateFormat'), strtotime($noc_application->request_form->offsite_infra_charges_receipt_date)) }}" required
                            readonly="readonly">
                            <span class="help-block">{{$errors->first('offsite_infra_charges_receipt_date')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="water_charges_amount">Water charges amount(Rs.) : <span class="star">*</span></label>
                            <input type="text" id="water_charges_amount" name="water_charges_amount" class="form-control form-control--custom form-control--fixed-height m-input number" value="{{ $noc_application->request_form->water_charges_amount }}" required>
                            <span class="help-block">{{$errors->first('water_charges_amount')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="water_charges_receipt_number">Water charges receipt number : <span class="star">*</span></label>
                            <input type="text" id="water_charges_receipt_number" name="water_charges_receipt_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $noc_application->request_form->water_charges_receipt_number }}" required>
                            <span class="help-block">{{$errors->first('water_charges_receipt_number')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="water_charges_date">
                            Water charges date : <span class="star">*</span></label>
                             <input type="text" id="water_charges_date" name="water_charges_date" class="form-control form-control--custom m-input m_datepicker" data-date-end-date="+0d" value="{{ date(config('commanConfig.dateFormat'), strtotime($noc_application->request_form->water_charges_date)) }}" required readonly="readonly">
                            <span class="help-block">{{$errors->first('water_charges_date')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group">
                            <label class="col-form-label" for="full_bua">Full BUA : <span class="star">*</span></label>
                            <input type="text" id="full_bua" name="full_bua" class="form-control form-control--custom form-control--fixed-height m-input number total_bua" value="{{ $noc_application->request_form->full_bua }}" required>
                            <span class="help-block">{{$errors->first('full_bua')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> 
                            <label class="col-form-label" for="existing_bua">Exisitng BUA : <span class="star">*</span></label>
                            <input type="text" id="existing_bua" name="existing_bua" class="form-control form-control--custom form-control--fixed-height m-input number total_bua" value="{{ $noc_application->request_form->existing_bua }}" required>
                            <span class="help-block">{{$errors->first('existing_bua')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> 
                            <label class="col-form-label" for="full_bua">25 % BUA : <span class="star">*</span></label>
                            <input type="text" id="percent_bua" name="percent_bua" class="form-control form-control--custom form-control--fixed-height m-input number total_bua" value="{{ $noc_application->request_form->percent_bua }}" required>
                            <span class="help-block">{{$errors->first('percent_bua')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group t_bua"> 
                            <label class="col-form-label" for="existing_bua">Total BUA : <span class="star">*</span></label>
                            <input type="text" id="total_bua" name="total_bua" class="form-control form-control--custom form-control--fixed-height m-input number" value="{{ $noc_application->request_form->total_bua }}" required>
                            <span class="help-block">{{$errors->first('total_bua')}}</span>
                        </div>
                    </div>

                    <!-- show feilds at sharing application -->
                    @elseif(isset($model) && $model == 'Sharing')
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="demand_draft_amount">Offsite infrastructure charges paid to MHADA (Rs.) : <span class="star">*</span></label>
                            <input type="text" id="demand_draft_amount" name="demand_draft_amount" class="form-control form-control--custom form-control--fixed-height m-input number" value="{{ $noc_application->request_form->demand_draft_amount }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_amount')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="demand_draft_number">Offsite infrastructure charges receipt number : <span class="star">*</span></label>
                            <input type="text" id="demand_draft_number" name="demand_draft_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $noc_application->request_form->demand_draft_number }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_number')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="demand_draft_date">Offsite infrastructure charges receipt date : <span class="star">*</span></label>
                            <input type="text" id="m_datepicker" name="demand_draft_date" class="form-control form-control--custom m-input m_datepicker" value="{{ date(config('commanConfig.dateFormat'), strtotime($noc_application->request_form->demand_draft_date)) }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_date')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="demand_draft_bank">Offsite Infrastructure charges paid to planning authority(Rs.) :<span class="star">*</span></label>
                            <input type="text" id="offsite_infra_charges" name="offsite_infra_charges" class="form-control form-control--custom form-control--fixed-height m-input number" value="{{ $noc_application->request_form->offsite_infra_charges }}" required>
                            <span class="help-block">{{$errors->first('offsite_infra_charges')}}</span>
                        </div>
                    </div>
                    
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="offsite_infra_receipt">Offsite Infrastructure planning authority receipt number : <span class="star">*</span></label>
                            <input type="text" id="offsite_infra_receipt" name="offsite_infra_receipt" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $noc_application->request_form->offsite_infra_receipt }}" required>
                            <span class="help-block">{{$errors->first('offsite_infra_receipt')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="offsite_infra_charges_receipt_date">Offsite Infrastructure planning authority receipt date : <span class="star">*</span></label>
                             <input type="text" id="m_datepicker" name="offsite_infra_charges_receipt_date" class="form-control form-control--custom m-input m_datepicker" data-date-end-date="+0d" value="{{ date(config('commanConfig.dateFormat'), strtotime($noc_application->request_form->offsite_infra_charges_receipt_date)) }}" required
                            readonly="readonly">
                            <span class="help-block">{{$errors->first('offsite_infra_charges_receipt_date')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="water_charges_amount">Water charges amount(Rs.) : <span class="star">*</span></label>
                            <input type="text" id="water_charges_amount" name="water_charges_amount" class="form-control form-control--custom form-control--fixed-height m-input number" value="{{ $noc_application->request_form->water_charges_amount }}" required>
                            <span class="help-block">{{$errors->first('water_charges_amount')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="water_charges_receipt_number">Water charges receipt number : <span class="star">*</span></label>
                            <input type="text" id="water_charges_receipt_number" name="water_charges_receipt_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $noc_application->request_form->water_charges_receipt_number }}" required>
                            <span class="help-block">{{$errors->first('water_charges_receipt_number')}}</span>
                        </div>
                        
                    </div>
                    @endif

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
    $(".total_bua").keyup(function(){
        var sum = 0;
        var full_bua = $("#full_bua").val() || 0;
        var existing_bua = $("#existing_bua").val() || 0;
        var percent_bua = $("#percent_bua").val() || 0;
        sum = parseFloat(full_bua) + parseFloat(existing_bua) + parseFloat(percent_bua);
        $(".t_bua").addClass('focused');
        $("#total_bua").attr('value',sum.toFixed(2));
    });
</script>
@endsection
