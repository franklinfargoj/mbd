@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Ward & Colony</h3>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <form id="ward-colony" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="">
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="ward">Ward:</label>
                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="ward"
                            name="ward">
                            <option value="">Select Ward</option>
                            <option value="">Ward 1</option>
                        </select>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="colony">Colony:</label>
                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="colony"
                            name="colony">
                            <option value="">Select Colony</option>
                            <option value="">Tagornagar</option>
                        </select>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="btn-list">
                                    <button type="submit" id="edit_society" class="btn btn-primary">Save</button>
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
