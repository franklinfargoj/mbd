@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.hearing.actions',compact('hearing_data'))
@endsection
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">View hearing</h3>
            {{ Breadcrumbs::render('View Hearing', $arrData['hearing']['id']) }}
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <div class="m-portlet__body m-portlet__body--spaced">
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label">Name of Preceding Officer:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['preceding_officer_name'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label">Case Year:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['case_year'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label">Case Number:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['id'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label">Application Type:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $hearing_data->hearingApplicationType->application_type }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label">Name of Applicant:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['applicant_name'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label">Mobile Number:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['applicant_mobile_no'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label">Address:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['applicant_address'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label">Respondent Details:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['respondent_name'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label">Case Type:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['case_type'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label">Year:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['office_year'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label">Number:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['office_number'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label">Date:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['office_date'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label">Tehsil:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['office_tehsil'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label">Village:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['office_village'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label">Remarks:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']['office_remark'] }}"
                        readonly>
                    <span class="help-block"></span>
                </div>

                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label">Status:</label>
                    <input type="text" class="form-control form-control--custom m-input" value="{{ $status_value }}"
                        readonly>
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid">
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="{{url('hearing')}}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('admin.hearing.delete_hearing')
@endsection
