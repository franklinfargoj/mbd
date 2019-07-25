@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Society Conveyance Application Form</h3>
            </div>
        </div>
        <!-- END: Subheader -->

        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
            <form id="save_sc_application" role="form" method="post" class="m-form m-form--rows m-form--label-align-right floating-labels-form" action="{{ route('society_conveyance.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="layout_id">Layout:</label>
                            <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout_id" name="layout_id" required>
                                @foreach($layouts as $layout)
                                    <option value="{{ $layout['id'] }}">{{ $layout['layout_name'] }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="society_id" value="{{ $society_details->id }}">
                            <input type="hidden" name="sc_application_master_id" value="{{ $application_master_id->id }}">
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="society_name">Society Name:</label>
                            <input type="text" id="society_name" name="society_name" class="form-control form-control--custom m-input" value="{{ $society_details->name }}" readonly="" required="" autocomplete="off"> 
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="society_no">Society No:</label>
                            <input type="text" id="society_no" name="society_no" class="form-control form-control--custom m-input" value="{{ $society_details->building_no }}" readonly="" required="" autocomplete="off">
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="scheme_name">Scheme Name:</label>
                            <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="scheme_name" name="scheme_name" required="">
                                @if(isset($master_tenant_type) && count($master_tenant_type) > 0)
                                    @foreach($master_tenant_type as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="first_flat_issue_date">First Flat Issue Date:</label>
                            <input type="text" id="first_flat_issue_date" name="first_flat_issue_date" class="form-control form-control--custom m-input m_datepicker" value="" required="" autocomplete="off">
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="no_of_residential_flat">No Of Residential Flat:</label>
                            <input type="text" id="no_of_residential_flat" name="no_of_residential_flat" class="form-control form-control--custom m-input" value="" required="" autocomplete="off"> 
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="no_of_non_residential_flat">No Of Non Residential Flat:</label>
                            <input type="text" id="no_of_non_residential_flat" name="no_of_non_residential_flat" class="form-control form-control--custom m-input" value="" required="" autocomplete="off">
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="total_no_of_flat">Total No Of Flat:</label>
                            <input type="text" id="total_no_of_flat" name="total_no_of_flat" class="form-control form-control--custom m-input" value="" required="" autocomplete="off"> 
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="society_registration_no">Society Registration No:</label>
                            <input type="text" id="society_registration_no" name="society_registration_no" class="form-control form-control--custom m-input" value="" autocomplete="off">
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="society_registration_date">Society Registration Date:</label>
                            <input type="text" id="society_registration_date" name="society_registration_date" class="form-control form-control--custom m-input m_datepicker" value="" required="" autocomplete="off"> 
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="property_tax">Property Tax:</label>
                            <input type="text" id="property_tax" name="property_tax" class="form-control form-control--custom m-input" value="" required="" autocomplete="off">
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="water_bill">Water Bill:</label>
                            <input type="text" id="water_bill" name="water_bill" class="form-control form-control--custom m-input" value="" required="" autocomplete="off"> 
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="non_agricultural_tax">Non Agricultural Tax:</label>
                            <input type="text" id="non_agricultural_tax" name="non_agricultural_tax" class="form-control form-control--custom m-input" value="" required="" autocomplete="off">
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="society_address">Society Address:</label>
                            <input type="text" id="society_address" name="society_address" class="form-control form-control--custom m-input" value="{{ $society_details->address }}" required="" autocomplete="off"> 
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="nature_of_building">Nature Of Building:</label>
                            <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="nature_of_building" name="nature_of_building" required="">
                                @if(isset($building_nature) && count($building_nature) > 0)
                                    @foreach($building_nature as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="society_name">Tax Paid To MHADA Or BMC:</label>
                            <input type="text" id="society_name" name="society_name" class="form-control form-control--custom m-input" value="" required="" autocomplete="off"> 
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="service_charge_type">Service Charge Type:</label>
                            <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="service_charge_type" name="service_charge_type" required="">
                                @if(isset($service_charge_names) && count($service_charge_names) > 0)
                                    @foreach($service_charge_names as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="service_charge">Service Charge:</label>
                            <input type="text" id="service_charge" name="service_charge" class="form-control form-control--custom m-input" value="" required="" autocomplete="off"> 
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <p><a href="{{ route('sc_download') }}" class="btn btn-primary" target="_blank" rel="noopener">Download Template</a></p>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <div class="custom-file">
                                <input class="custom-file-input" name="template" type="file"
                                       id="test-upload" required>
                                <label class="custom-file-label" for="test-upload">Choose
                                    file ...</label>
                            </div>
                            <span class="help-block" @if(session('error')) style="color:red" @endif>@if(session('error')) {{ session('error') }} @endif {{$errors->first('template')}}</span>
                        </div>
                    </div>

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <a href="{{ route('society_conveyance.index') }}" class="btn btn-secondary">Cancel</a>
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
@section('datatablejs')
    <script>
        $('#society_registration_date').on( 'change',function(){
            var flat_date = $('#first_flat_issue_date').val();
            var society_date = $('#society_registration_date').val();
            console.log(society_date);
            console.log(flat_date);
            if(society_date > flat_date){
                $('#society_registration_date-error').html('<span style="color:red">Society registration date should not be greater than '+ flat_date +'</span>');
            }else{
                $('#society_registration_date-error').html('');
            }
        });

        $('#save_sc_application').validate({
            rules:{
                scheme_name:{
                    required:true,
                },
                first_flat_issue_date:{
                    required:true,
                },
                residential_flat:{
                    required:true,
                    number:true
                },
                non_residential_flat:{
                    required:true,
                    number:true
                },
                total_flat:{
                    required:true,
                    number:true
                },
                society_registration_date:{
                    required:true,
                },
                property_tax:{
                    required:true,
                    number:true
                },
                water_bill:{
                    required:true,
                    number:true
                },
                non_agricultural_tax:{
                    required:true,
                    number:true
                },
                template:{
                    required:true,
                    extension:'xls'
                }
            },
            messages:{
                template:{
                    required:true,
                    extension:'Only files with .xls type is required.'
                }
            }
        });


    </script>
@endsection