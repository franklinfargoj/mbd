@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.conveyance.actions',compact('sc_application', 'documents', 'documents_uploaded'))
@endsection
@section('css')
<style type="text/css">
.error{
    display: block;
    color: #ce2323;
    margin-bottom: 17px;
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
<div class="alert alert-danger display_msg">
    {{ session()->get('error') }}
</div> 
@endif
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Society Conveyance Application Form</h3>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

            <form id="save_sc_application" role="form" method="post" class="m-form m-form--rows m-form--label-align-right floating-labels-form" action="{{ route('society_conveyance.update', $id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="layout_id">Layout:</label>
                            <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout_id" name="layout_id" required>
                                @foreach($layouts as $layout)
                                    @if(isset($sc_application) && $sc_application->layout_id == $layout['id'])
                                        <option value="{{ $layout['id'] }}" selected>{{ $layout['layout_name'] }}</option>
                                    @else
                                        <option value="{{ $layout['id'] }}">{{ $layout['layout_name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="hidden" name="society_id" value="{{ $society_details->id }}">
                            <span class="help-block">{{$errors->first('layout_id')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="society_name">Society Name:</label>
                            <input type="text" id="society_name" name="society_name" class="form-control form-control--custom m-input" value="{{ isset($sc_application->sc_form_request) ? $sc_application->sc_form_request->society_name : '' }}" readonly="" required=""> 
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="society_no">Society No:</label>
                            <input type="text" id="society_no" name="society_no" class="form-control form-control--custom m-input" value="{{ isset($sc_application->sc_form_request) ? $sc_application->sc_form_request->society_no : '' }}" readonly="" required="">
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="scheme_name">Scheme Name:</label>
                            <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="scheme_name" name="scheme_name" required="" value="{{ isset($sc_application->sc_form_request) ? $sc_application->sc_form_request->society_no : '' }}">
                                @if(isset($master_tenant_type) && count($master_tenant_type) > 0)
                                    @foreach($master_tenant_type as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="first_flat_issue_date">First Flat Issue Date:</label>
                            <input type="text" id="first_flat_issue_date" name="first_flat_issue_date" class="form-control form-control--custom m-input m_datepicker" value="{{ isset($sc_application->sc_form_request) ? date(config('commanConfig.dateFormat'), strtotime($sc_application->sc_form_request->first_flat_issue_date)) : '' }}" required="">
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="no_of_residential_flat">No Of Residential Flat:</label>
                            <input type="text" id="no_of_residential_flat" name="no_of_residential_flat" class="form-control form-control--custom m-input" value="{{ isset($sc_application->sc_form_request) ? $sc_application->sc_form_request->no_of_residential_flat : '' }}" required="" autocomplete="off"> 
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="no_of_non_residential_flat">No Of Non Residential Flat:</label>
                            <input type="text" id="no_of_non_residential_flat" name="no_of_non_residential_flat" class="form-control form-control--custom m-input" value="{{ isset($sc_application->sc_form_request) ? $sc_application->sc_form_request->no_of_non_residential_flat : '' }}" required="">
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="total_no_of_flat">Total No Of Flat:</label>
                            <input type="text" id="total_no_of_flat" name="total_no_of_flat" class="form-control form-control--custom m-input" value="{{ isset($sc_application->sc_form_request) ? $sc_application->sc_form_request->total_no_of_flat : '' }}" required=""> 
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="society_registration_no">Society Registration No:</label>
                            <input type="text" id="society_registration_no" name="society_registration_no" class="form-control form-control--custom m-input" value="{{ isset($sc_application->sc_form_request) ? $sc_application->sc_form_request->society_registration_no : '' }}">
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="society_registration_date">Society Registration Date:</label>
                            <input type="text" id="society_registration_date" name="society_registration_date" class="form-control form-control--custom m-input m_datepicker" value="{{ isset($sc_application->sc_form_request) ? date(config('commanConfig.dateFormat'), strtotime($sc_application->sc_form_request->society_registration_date)) : '' }}" required=""> 
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="property_tax">Property Tax:</label>
                            <input type="text" id="property_tax" name="property_tax" class="form-control form-control--custom m-input" value="{{ isset($sc_application->sc_form_request) ? $sc_application->sc_form_request->property_tax : '' }}" required="">
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="water_bill">Water Bill:</label>
                            <input type="text" id="water_bill" name="water_bill" class="form-control form-control--custom m-input" value="{{ isset($sc_application->sc_form_request) ? $sc_application->sc_form_request->water_bill : '' }}" required=""> 
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="non_agricultural_tax">Non Agricultural Tax:</label>
                            <input type="text" id="non_agricultural_tax" name="non_agricultural_tax" class="form-control form-control--custom m-input" value="{{ isset($sc_application->sc_form_request) ? $sc_application->sc_form_request->non_agricultural_tax : '' }}" required="">
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="society_address">Society Address:</label>
                            <input type="text" id="society_address" name="society_address" class="form-control form-control--custom m-input" value="{{ isset($sc_application->sc_form_request) ? $sc_application->sc_form_request->society_address : '' }}" required="" readonly> 
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="nature_of_building">Nature Of Building:</label>
                            <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="nature_of_building" name="nature_of_building" required="">
                                @if(isset($building_nature) && count($building_nature) > 0)
                                    @foreach($building_nature as $value)
                                        @if(isset($sc_application->sc_form_request) && $sc_application->sc_form_request->nature_of_building == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endif    
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="tax_paid_to_MHADA_or_BMC">Tax Paid To MHADA Or BMC:</label>
                            <input type="text" id="tax_paid_to_MHADA_or_BMC" name="tax_paid_to_MHADA_or_BMC" class="form-control form-control--custom m-input" value="{{ isset($sc_application->sc_form_request) ? $sc_application->sc_form_request->tax_paid_to_MHADA_or_BMC : '' }}" required=""> 
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="service_charge_type">Service Charge Type:</label>
                            <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="service_charge_type" name="service_charge_type" required="">
                                @if(isset($service_charge_names) && count($service_charge_names) > 0)
                                    @foreach($service_charge_names as $value)
                                        @if(isset($sc_application->sc_form_request) && $sc_application->sc_form_request->service_charge_type == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endif        
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="service_charge">Service Charge:</label>
                            <input type="text" id="service_charge" name="service_charge" class="form-control form-control--custom m-input" value="{{ isset($sc_application->sc_form_request) ? $sc_application->sc_form_request->service_charge : '' }}" required=""> 
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <p><a href="{{ route('sc_download') }}" class="btn btn-primary" target="_blank" rel="noopener">Download Template</a> </p>
                            <span class="help-block">{{$errors->first('no_agricultural_tax')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <div class="custom-file">
                                <input class="custom-file-input" name="template" type="file"
                                       id="test-upload">
                                <label class="custom-file-label" for="test-upload">Choose
                                    file ...</label>
                                <span class="help-block error">@if(session('error')) {{ session('error') }} @endif {{$errors->first('template')}}</span>
                            </div>
                            <span>
                            @if(isset($sc_application->sc_form_request->template_file))
                                <a href="{{ config('commanConfig.storage_server').'/'.$sc_application->sc_form_request->template_file }}" class="btn btn-link">Download uploaded file</a>
                            @endif
                        </div>
                    </div>

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <a href="{{ route('society_conveyance.index') }}" class="btn btn-secondary">Cancel</a>
                                        <button type="submit"  class="btn btn-primary">Update</button>
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