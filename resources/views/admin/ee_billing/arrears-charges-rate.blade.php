@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Arrears Charges Rate</h3>
            {{-- {{ Breadcrumbs::render('society_create') }} --}}
            <div class="ml-auto btn-list">
                <a href="javascript:void(0);" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile">
        <button class="btn btn-primary" data-toggle="modal" data-target="#add-arrears">Add</button>
        <div class="modal fade show" id="add-arrears" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Rate</h5>
                        <button style="cursor: pointer;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group m-form__group row">
                            <div class="col-sm-6">
                                <label class="col-form-label" for="year">Year:</label>
                                <select title="Select Year" id="year" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                    name="">
                                    <option value="">one</option>
                                    <option value="">two</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label text-nowrap" for="old-rate">Old Rate:</label>
                                <input type="text" id="old-rate" name="old-rate" class="form-control form-control--custom m-input"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-sm-6">
                                <label class="col-form-label text-nowrap" for="revise-rate">Revise Rate:</label>
                                <input type="text" id="revise-rate" name="revise-rate" class="form-control form-control--custom m-input"
                                    value="">
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label text-nowrap" for="interest-old-rate">Interest % on old
                                    rate:</label>
                                <input type="text" id="interest-old-rate" name="interest-old-rate" class="form-control form-control--custom m-input"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-sm-6">
                                <label class="col-form-label text-nowrap" for="interest-difference-amount">Interest %
                                    on difference amount:</label>
                                <input type="text" id="interest-difference-amount" name="interest-difference-amount"
                                    class="form-control form-control--custom m-input m_datepicker" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
