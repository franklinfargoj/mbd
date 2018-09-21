@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex">
            <h3 class="m-subheader__title">View hearing</h3>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body m-portlet__body--spaced">
            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Name of Preceding Officer:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['preceding_officer_name'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Case Year:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['case_year'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Case Number:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['case_number'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Application Type:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['hearing_application_type']['application_type'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Name of Applicant:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['applicant_name'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Mobile Number:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['applicant_mobile_no'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Address:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['applicant_address'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Respondent Details:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['respondent_name'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Case Type:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['case_type'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Year:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['office_year'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Number:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['office_number'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Date:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['office_date'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Tehsil:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['office_tehsil'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Village:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['office_village'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Remarks:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['office_remark'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-lg-6 form-group">
                    <label class="col-form-label">Status:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['hearing_status']['status_title'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{url('hearing')}}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
