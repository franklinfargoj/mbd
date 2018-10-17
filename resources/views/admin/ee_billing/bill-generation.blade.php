@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Manage Masters</h3>
        </div>
    </div>
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        <div class="m-portlet__body data-table--custom data-table--icons data-table--actions">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <form role="form" class="row align-items-end mb-0" id="eeForm" method="get" action="{{ route('ree_applications.index') }}">
                        <div class="col-sm-3">
                            <div class="form-group m-form__group">
                                <select title="Select Layout" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                    id="select-layout" name="select-layout">
                                    <option value="">Nahur, Mulund</option>
                                    <option value="">Mithagar Road, Mulund</option>
                                    <option value="">Tagornagar, Vikhroli</option>
                                    <option value="">Nehru Nagar, Kurla</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group m-form__group">
                                <select title="Select Ward" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                    id="select-ward" name="select-ward">
                                    <option value="">Nahur, Mulund</option>
                                    <option value="">Mithagar Road, Mulund</option>
                                    <option value="">Tagornagar, Vikhroli</option>
                                    <option value="">Nehru Nagar, Kurla</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group m-form__group">
                                <select title="Select Colony" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                    id="select-colony" name="select-colony">
                                    <option value="">Nahur, Mulund</option>
                                    <option value="">Mithagar Road, Mulund</option>
                                    <option value="">Tagornagar, Vikhroli</option>
                                    <option value="">Nehru Nagar, Kurla</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group m-form__group">
                                <select title="Select Society" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                    id="select-society" name="select-society">
                                    <option value="">Nahur, Mulund</option>
                                    <option value="">Mithagar Road, Mulund</option>
                                    <option value="">Tagornagar, Vikhroli</option>
                                    <option value="">Nehru Nagar, Kurla</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group m-form__group">
                                <select title="Billing Level" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                    id="select-society" name="select-society" disabled readonly>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        <div class="m-portlet__body data-table--custom data-table--icons data-table--actions">
            <!-- Add Data Table here -->
        </div>
    </div>
</div>
@endsection
