@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Add Service Charge Rate - {{$society->name}} {{$building->name}}</h3>
            {{-- {{ Breadcrumbs::render('society_detail') }} --}}
        </div>
    </div> 
    <!-- END: Subheader -->
    
    <div class="m-portlet m-portlet--mobile">
        <div class="tools">
            <a href="{{url('service_charges/'.encrypt($society->id).'/'.encrypt($building->id))}}" class='btn m-btn--pill m-btn--custom btn-primary pull-right'>Back</a>
        </div>
        <form id="service_charges" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="{{url('service_charges/'.encrypt($society->id).'/'.encrypt($building->id).'/store')}}">
            @csrf
            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="year">Year:</label>
                    <select  id="year" name="year" class="form-control form-control--custom m-input" required>
                        <option value="">Select Year</option>
                        <option value="{{date('Y')}}" {{ old('year') == date('Y') ? 'selected' : '' }}>{{date('Y')}}</option>
                    </select>
                    <span class="help-block error">{{$errors->first('year')}}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="case_year">Teanant Type:</label>
                    <select class="form-control form-control--custom m-input" name="tenant_type" required>
                        <option value="">Select Teanat Type</option>
                        @foreach($tenant_types as $tenant_type => $val)
                            <option value="{{$val}}" {{ old('tenant_type') == $val ? 'selected' : '' }}>{{$tenant_type}}</option>
                        @endforeach
                    </select>
                    <span class="help-block error">{{$errors->first('tenant_type')}}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="case_year">Water Charges:</label>
                    <input type="text" id="water_charges" name="water_charges" class="form-control form-control--custom m-input" value="{{old('water_charges')}}" required>
                    <span class="help-block error">{{$errors->first('water_charges')}}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="case_year">Electric City Charge:</label>
                    <input type="text" id="electric_city_charge" name="electric_city_charge" class="form-control form-control--custom m-input" value="{{old('electric_city_charge')}}" required>
                    <span class="help-block error">{{$errors->first('electric_city_charge')}}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="case_year">Pump Man & Repair Charges:</label>
                    <input type="text" id="pump_man_and_repair_charges" name="pump_man_and_repair_charges" class="form-control form-control--custom m-input" value="{{old('pump_man_and_repair_charges')}}" required>
                    <span class="help-block error">{{$errors->first('pump_man_and_repair_charges')}}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="case_year">External Expender Charge:</label>
                    <input type="text" id="external_expender_charge" name="external_expender_charge" class="form-control form-control--custom m-input" value="{{old('external_expender_charge')}}" required>
                    <span class="help-block error">{{$errors->first('external_expender_charge')}}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="case_year">Administrative Charge:</label>
                    <input type="text" id="administrative_charge" name="administrative_charge" class="form-control form-control--custom m-input" value="{{old('administrative_charge')}}" required>
                    <span class="help-block error">{{$errors->first('administrative_charge')}}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="case_year">Lease Rent:</label>
                    <input type="text" id="lease_rent" name="lease_rent" class="form-control form-control--custom m-input" value="{{old('lease_rent')}}" required>
                    <span class="help-block error">{{$errors->first('lease_rent')}}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="case_year">N.A.Assessment:</label>
                    <input type="text" id="na_assessment" name="na_assessment" class="form-control form-control--custom m-input" value="{{old('na_assessment')}}" required>
                    <span class="help-block error">{{$errors->first('na_assessment')}}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="case_year">Other:</label>
                    <input type="text" id="other" name="other" class="form-control form-control--custom m-input" value="{{old('other')}}" required>
                    <span class="help-block error">{{$errors->first('other')}}</span>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="btn-list">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{url('service_charges/'.encrypt($society->id).'/'.encrypt($building->id))}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection