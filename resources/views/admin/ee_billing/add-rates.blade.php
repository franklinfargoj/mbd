@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Add Society</h3>
            {{-- {{ Breadcrumbs::render('society_create') }} --}}
            <div class="ml-auto btn-list">
                <a href="javascript:void(0);" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <form id="addRates" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="">
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="year">Year:</label>
                        <select title="Select Village" id="year" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                            name="">
                            <option value="">one</option>
                            <option value="">two</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="type-of-tenament">Type of Tenament:</label>
                        <select title="Type of Tenament" id="type-of-tenament" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                            name="">
                            <option value="">one</option>
                            <option value="">two</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="water-charges">Water Charges:</label>
                        <input type="text" id="water-charges" name="water-charges" class="form-control form-control--custom m-input m_datepicker" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="electricity-charge">Electricity Charge:</label>
                        <input type="text" id="electricity-charge" name="electricity-charge" class="form-control form-control--custom m-input m_datepicker" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="pump-repair-charges">Pump Man & Repair Charges:</label>
                        <input type="text" id="pump-repair-charges" name="pump-repair-charges" class="form-control form-control--custom m-input m_datepicker" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="external-expender-charge">External Expender Charge:</label>
                        <input type="text" id="external-expender-charge" name="external-expender-charge" class="form-control form-control--custom m-input m_datepicker" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="administrative-charge">Administrative Charge:</label>
                        <input type="text" id="administrative-charge" name="administrative-charge" class="form-control form-control--custom m-input m_datepicker" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="lease-rent">Lease Rent:</label>
                        <input type="text" id="lease-rent" name="lease-rent" class="form-control form-control--custom m-input m_datepicker" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="na-assesment">N.A.Assessment:</label>
                        <input type="text" id="na-assesment" name="na-assesment" class="form-control form-control--custom m-input m_datepicker" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="other">Other:</label>
                        <input type="text" id="other" name="other" class="form-control form-control--custom m-input m_datepicker" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="btn-list d-flex align-items-center">
                                    <button type="submit" id="" class="btn btn-primary">Save</button>
                                    <a href="javascript:void(0);" class="btn btn-secondary">Cancel</a>
                                    <a href="javascript:void(0);" class="btn btn-link">add more</a>
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
