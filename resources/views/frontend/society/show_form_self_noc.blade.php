@extends('admin.layouts.app')
@section('content')
    <style>
        .help-block{
            color: red;
        }
    </style>
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Self Redevelopment</h3>
                {{ Breadcrumbs::render('society_noc_application_create', $id) }}

            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

            <form id="save_noc_application_self" role="form" method="post" class="m-form m-form--rows m-form--label-align-right floating-labels-form" action="{{ route('save_noc_application_self') }}">
                @csrf
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label mhada-multiple-label" for="application_type_id">Select layout: <span class="star">*</span></label>
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" data-live-search="true" id="layouts" name="layout_id" required>
                                <option value="">Select layout</option>
                                @foreach($layouts as $layout)
                                    <option value="{{ $layout['id'] }}">{{ $layout['layout_name'] }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('application_type_id')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="preceding_officer_name">Department:</label>
                            <input type="text" id="department_name" name="department_name" class="form-control form-control--custom m-input" value="Resident Executive Engineer" readonly>
                            <input type="hidden" name="application_master_id" value="{{ $id }}" required>
                            <span class="help-block">{{$errors->first('department_name')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="case_year">Building No:</label>
                            <input type="text" id="building_no" name="building_no" class="form-control form-control--custom m-input" value="{{ $society_details->building_no }}" readonly>
                            <span class="help-block">{{$errors->first('building_no')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="name">Society Name:</label>
                            <input type="text" id="name" name="name" class="form-control form-control--custom m-input" value="{{ $society_details->name }}" readonly>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="address">Society Address:</label>
                            <textarea id="address" name="address" class="form-control form-control--custom form-control--fixed-height m-input" readonly>{{ $society_details->address }}</textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="offer_letter_number">Offer letter number: <span class="star">*</span></label>
                            <input type="text" id="offer_letter_number" name="offer_letter_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('offer_letter_number') }}" required>
                            <span class="help-block">{{$errors->first('offer_letter_number')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="m_datepicker">Offer letter date:</label>
                            <input type="text" id="m_datepicker" name="offer_letter_date" class="form-control form-control--custom m-input m_datepicker" data-date-end-date="+0d" value="{{ old('offer_letter_date') }}" required
                            readonly="readonly">
                            <span class="help-block">{{$errors->first('offer_letter_date')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="demand_draft_amount">
                            Premium pay order amount (Rs.): <span class="star">*</span></label>
                            <input type="text" id="demand_draft_amount" name="demand_draft_amount" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('demand_draft_amount') }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_amount')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="demand_draft_number">Premium receipt number : <span class="star">*</span></label>
                            <input type="text" id="demand_draft_number" name="demand_draft_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('demand_draft_number') }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_number')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="receipt-date">Premium receipt date : <span class="star">*</span></label>
                            <input type="text" id="receipt-date" data-date-end-date="+0d" name="demand_draft_date" class="form-control form-control--custom m-input m_datepicker" value="{{ old('demand_draft_date') }}" readonly="readonly" required>
                            <span class="help-block">{{$errors->first('demand_draft_date')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="offsite_infra_charges">Offsite Infrastructure charges amount(Rs.) : <span class="star">*</span></label>
                            <input type="text" id="offsite_infra_charges" name="offsite_infra_charges" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('offsite_infra_charges') }}" required>
                            <span class="help-block">{{$errors->first('offsite_infra_charges')}}</span>
                        </div>
                    </div> 

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="offsite_infra_receipt">Offsite Infrastructure receipt number : <span class="star">*</span></label>
                            <input type="text" id="offsite_infra_receipt" name="offsite_infra_receipt" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('offsite_infra_receipt') }}" required>
                            <span class="help-block">{{$errors->first('offsite_infra_receipt')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="offsite_infra_charges_receipt_date">Offsite Infrastructure charges receipt date : <span class="star">*</span></label>
                             <input type="text" id="offsite_infra_charges_receipt_date" name="offsite_infra_charges_receipt_date" class="form-control form-control--custom m-input m_datepicker" data-date-end-date="+0d" value="{{ old('offsite_infra_charges_receipt_date') }}" required
                            readonly="readonly">
                            <span class="help-block">{{$errors->first('offsite_infra_charges_receipt_date')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="water_charges_amount">Water charges amount(Rs.) : <span class="star">*</span></label>
                            <input type="text" id="water_charges_amount" name="water_charges_amount" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('water_charges_amount') }}" required>
                            <span class="help-block">{{$errors->first('water_charges_amount')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="water_charges_receipt_number">Water charges receipt number : <span class="star">*</span></label>
                            <input type="text" id="water_charges_receipt_number" name="water_charges_receipt_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('water_charges_receipt_number') }}" required>
                            <span class="help-block">{{$errors->first('water_charges_receipt_number')}}</span>
                        </div>
                    </div>

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <button type="submit"  class="btn btn-primary">Save</button>
                                        <a href="{{URL::previous()}}" class="btn btn-secondary">Cancel</a>
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