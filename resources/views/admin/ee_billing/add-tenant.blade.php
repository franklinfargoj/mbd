@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Add Tenant</h3>
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
                        <label class="col-form-label" for="flat-no">Flat No:</label>
                        <input type="text" id="flat-no" name="flat-no" class="form-control form-control--custom m-input m_datepicker"
                            value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="salutation">Salutations:</label>
                        <select title="Select Salutations" id="salutation" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                            name="">
                            <option value="">Shri</option>
                            <option value="">Smt</option>
                            <option value="">Kumari</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="first-name">First Name:</label>
                        <input type="text" id="first-name" name="first-name" class="form-control form-control--custom m-input m_datepicker"
                            value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="middle-name">Middle Name:</label>
                        <input type="text" id="middle-name" name="middle-name" class="form-control form-control--custom m-input m_datepicker"
                            value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="last-name">Last Name:</label>
                        <input type="text" id="last-name" name="last-name" class="form-control form-control--custom m-input m_datepicker"
                            value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="mobile">Mobile:</label>
                        <input type="text" id="mobile" name="mobile" class="form-control form-control--custom m-input m_datepicker"
                            value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="email-id">Email ID:</label>
                        <input type="text" id="email-id" name="email-id" class="form-control form-control--custom m-input m_datepicker"
                            value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="use">Use:</label>
                        <select title="Select Use" id="use" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                            name="">
                            <option value="">Residential</option>
                            <option value="">Commercial</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="carpet-area">Carpet Area:</label>
                        <input type="text" id="carpet-area" name="carpet-area" class="form-control form-control--custom m-input m_datepicker"
                            value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="use">Tenament Type:</label>
                        <select title="Select Type" id="use" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                            name="">
                            <option value="">EWS</option>
                            <option value="">LIG</option>
                            <option value="">MIG</option>
                            <option value="">HIG</option>
                        </select>
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
