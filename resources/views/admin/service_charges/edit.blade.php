@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Edit Service Charge Rate</h3>
            {{-- {{ Breadcrumbs::render('society_detail') }} --}}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left"
                        style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->

    <div class="m-portlet m-portlet--forms-view m-portlet--mobile">
        <div class="m-portlet__body m-portlet__body--spaced">
            <h4 class="box-subheading ml-0">{{$society->society_name}} - {{$building->name}}</h4>
            <form id="service_charges" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
                action="{{url('service_charges/'.encrypt($service_charge->id).'/update')}}">
                @csrf
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="year">Year:</label>
                        <select id="year" name="year" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" required>
                            <option value="">Select Year</option>
                            @php $earliest_year = '2000'; @endphp
                            @foreach(range(date('Y'), $earliest_year) as $x)
                            <option value="{{$x}}" {{ $x == $service_charge->year? 'selected' : '' }}>{{$x}}</option>
                            @endforeach
                        </select>
                        <span class="help-block error">{{$errors->first('year')}}</span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="case_year">Teanant Type:</label>
                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" name="tenant_type" required>
                            <option value="">Select Teanat Type</option>
                            @foreach($tenant_types as $tenant_type => $val)
                            <option value="{{$val}}"
                                {{ old('tenant_type', $service_charge->tenant_type) == $val ? 'selected' : '' }}>{{$tenant_type}}</option>
                            @endforeach
                        </select>
                        <span class="help-block error">{{$errors->first('tenant_type')}}</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="case_year">Water Charges:</label>
                        <input type="text" id="water_charges" name="water_charges" class="form-control form-control--custom m-input"
                            value="{{old('water_charges', $service_charge->water_charges)}}" required>
                        <span class="help-block error">{{$errors->first('water_charges')}}</span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="case_year">Electric City Charge:</label>
                        <input type="text" id="electric_city_charge" name="electric_city_charge" class="form-control form-control--custom m-input"
                            value="{{old('electric_city_charge', $service_charge->electric_city_charge)}}" required>
                        <span class="help-block error">{{$errors->first('electric_city_charge')}}</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="case_year">Pump Man & Repair Charges:</label>
                        <input type="text" id="pump_man_and_repair_charges" name="pump_man_and_repair_charges" class="form-control form-control--custom m-input"
                            value="{{old('pump_man_and_repair_charges', $service_charge->pump_man_and_repair_charges)}}"
                            required>
                        <span class="help-block error">{{$errors->first('pump_man_and_repair_charges')}}</span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="case_year">External Expender Charge:</label>
                        <input type="text" id="external_expender_charge" name="external_expender_charge" class="form-control form-control--custom m-input"
                            value="{{old('external_expender_charge', $service_charge->external_expender_charge)}}"
                            required>
                        <span class="help-block error">{{$errors->first('external_expender_charge')}}</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="case_year">Administrative Charge:</label>
                        <input type="text" id="administrative_charge" name="administrative_charge" class="form-control form-control--custom m-input"
                            value="{{old('administrative_charge', $service_charge->administrative_charge)}}" required>
                        <span class="help-block error">{{$errors->first('administrative_charge')}}</span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="case_year">Lease Rent:</label>
                        <input type="text" id="lease_rent" name="lease_rent" class="form-control form-control--custom m-input"
                            value="{{old('lease_rent', $service_charge->lease_rent)}}" required>
                        <span class="help-block error">{{$errors->first('lease_rent')}}</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="case_year">N.A.Assessment:</label>
                        <input type="text" id="na_assessment" name="na_assessment" class="form-control form-control--custom m-input"
                            value="{{old('na_assessment', $service_charge->na_assessment)}}" required>
                        <span class="help-block error">{{$errors->first('na_assessment')}}</span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="case_year">Other:</label>
                        <input type="text" id="other" name="other" class="form-control form-control--custom m-input"
                            value="{{old('other', $service_charge->other)}}" required>
                        <span class="help-block error">{{$errors->first('other')}}</span>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="btn-list">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('service_charges/'.encrypt($society->id).'/'.encrypt($building->id))}}"
                                        class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection
