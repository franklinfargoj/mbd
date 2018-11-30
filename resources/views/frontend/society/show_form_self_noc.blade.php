@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Self Redevelopment</h3>
                {{ Breadcrumbs::render('society_noc_application_create', $id) }}

            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

            <form id="save_noc_application_self" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{ route('save_noc_application_self') }}">
                @csrf
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="application_type_id">Application Type:</label>
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layouts" name="layout_id" required>
                                @foreach($layouts as $layout)
                                    <option value="{{ $layout['id'] }}">{{ $layout['layout_name'] }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('application_type_id')}}</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="preceding_officer_name">Department:</label>
                            <input type="text" id="department_name" name="department_name" class="form-control form-control--custom m-input" value="EE" readonly>
                            <input type="hidden" name="application_master_id" value="{{ $id }}" required>
                            <span class="help-block">{{$errors->first('department_name')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="case_year">Building No:</label>
                            <input type="text" id="building_no" name="building_no" class="form-control form-control--custom m-input" value="{{ $society_details->building_no }}" readonly>
                            <span class="help-block">{{$errors->first('building_no')}}</span>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
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

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="offer_letter_number">Offer letter number:</label>
                            <input type="text" id="offer_letter_number" name="offer_letter_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('offer_letter_number') }}" required>
                            <span class="help-block">{{$errors->first('offer_letter_number')}}</span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="offer_letter_date">Offer letter date:</label>
                            <input type="text" id="m_datepicker" name="offer_letter_date" class="form-control form-control--custom m-input m_datepicker" value="{{ old('offer_letter_date') }}" required>
                            <span class="help-block">{{$errors->first('offer_letter_date')}}</span>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="demand_draft_amount">Demand Draft / Pay order amount :</label>
                            <input type="text" id="demand_draft_amount" name="demand_draft_amount" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('demand_draft_amount') }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_amount')}}</span>
                        </div>
                        <div class="col-sm-4 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="demand_draft_number">Demand draft / Pay order number :</label>
                            <input type="text" id="demand_draft_number" name="demand_draft_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('demand_draft_number') }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_number')}}</span>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="demand_draft_date">Demand Draft / Pay order date :</label>
                            <input type="text" id="m_datepicker" name="demand_draft_date" class="form-control form-control--custom m-input m_datepicker" value="{{ old('demand_draft_date') }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_date')}}</span>
                        </div>
                        <div class="col-sm-4 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="demand_draft_bank">Bank name :</label>
                            <input type="text" id="demand_draft_bank" name="demand_draft_bank" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('demand_draft_bank') }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_bank')}}</span>
                        </div>
                    </div>

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <a href="{{url('/application/'.$id)}}" class="btn btn-secondary">Cancel</a>
                                        <button type="submit"  class="btn btn-primary">Save</button>
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