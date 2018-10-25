@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Redevelopment Through Developer</h3>
{{--                {{ Breadcrumbs::render('society_offer_application_create', $id) }}--}}

            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

            <form id="save_sc_application" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{ route('society_conveyance.store') }}">
                @csrf
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="application_type_id">Layout:</label>
                            <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layouts" name="layout_id" required>
                                @foreach($layouts as $layout)
                                    <option value="{{ $layout['id'] }}">{{ $layout['layout_name'] }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('application_type_id')}}</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="preceding_officer_name">Society Name:</label>
                            <input type="text" id="society_name" name="society_name" class="form-control form-control--custom m-input" readonly>
                            {{--<input type="hidden" name="application_master_id" value="{{ $id }}">--}}
                            <span class="help-block">{{$errors->first('society_name')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="case_year">Society No:</label>
                            <input type="text" id="society_no" name="society_no" class="form-control form-control--custom m-input">
                            <span class="help-block">{{$errors->first('society_no')}}</span>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="society_address">Society Address:</label>
                            <textarea id="society_address" name="society_address" class="form-control form-control--custom form-control--fixed-height m-input"></textarea>
                            <span class="help-block">{{$errors->first('society_address')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="society_registration_no">Society Registration No:</label>
                            <input type="text" id="society_registration_no" name="society_registration_no" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('society_registration_no') }}">
                            <span class="help-block">{{$errors->first('society_registration_no')}}</span>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="society_registration_date">Society Registration Date:</label>
                            <input type="text" id="society_registration_date" name="society_registration_date" class="form-control form-control--custom m-input m_datepicker" value="{{ old('society_registration_date') }}">
                            <span class="help-block">{{$errors->first('society_registration_date')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="name">Scheme Name:</label>
                            <input type="text" id="scheme_name" name="scheme_name" class="form-control form-control--custom m-input">
                            <span class="help-block">{{$errors->first('scheme_name')}}</span>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="first_flat_issue_date">First Flat Issue Date:</label>
                            <input type="text" id="m_datepicker" name="first_flat_issue_date" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('first_flat_issue_date') }}">
                            <span class="help-block">{{$errors->first('first_flat_issue_date')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="residential_flat">Residential Flat:</label>
                            <input type="text" id="residential_flat" name="residential_flat" class="form-control form-control--custom m-input" value="{{ old('residential_flat') }}">
                            <span class="help-block">{{$errors->first('residential_flat')}}</span>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="non_residential_flat">Non-Residential Flat:</label>
                            <input type="text" id="non_residential_flat" name="non_residential_flat" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('resolution_no') }}">
                            <span class="help-block">{{$errors->first('non_residential_flat')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="total_flat">Total Flat:</label>
                            <input type="text" id="total_flat" name="total_flat" class="form-control form-control--custom m-input" value="{{ old('total_flat') }}">
                            <span class="help-block">{{$errors->first('total_flat')}}</span>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="property_tax">Property Tax:</label>
                            <input type="text" id="property_tax" name="property_tax" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('property_tax') }}">
                            <span class="help-block">{{$errors->first('property_tax')}}</span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="no_agricultural_tax">Non-Agricultural Tax:</label>
                            <input type="text" id="no_agricultural_tax" name="no_agricultural_tax" class="form-control form-control--custom m-input" value="{{ old('society_registration_date') }}">
                            <span class="help-block">{{$errors->first('no_agricultural_tax')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="water_bil">Water Bill:</label>
                            <input type="text" id="water_bil" name="water_bil" class="form-control form-control--custom m-input" value="{{ old('society_registration_date') }}">
                            <span class="help-block">{{$errors->first('water_bil')}}</span>
                        </div>
                    </div>

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <a href="{{url('/hearing')}}" class="btn btn-secondary">Cancel</a>
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