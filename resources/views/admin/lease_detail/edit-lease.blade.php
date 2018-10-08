@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Edit Lease</h3>
            {{ Breadcrumbs::render('lease_edit', $id, $society_id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        <form id="renewLeaseDetail" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="{{route('update-lease.update', $id)}}">
            @csrf
            <input type="hidden" name="society_id" value="{{ $society_id }}">
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_rule_other">Lease rule 16 & other:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_rule_other" name="lease_rule_other" class="form-control form-control--custom m-input"
                                value="{{ $arrData['lease_data']->lease_rule_16_other }}">
                            <span class="help-block">{{$errors->first('lease_rule_other')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_basis">School/society/ others on lease basis:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_basis" name="lease_basis" class="form-control form-control--custom m-input"
                                value="{{ $arrData['lease_data']->lease_basis }}">
                            <span class="help-block">{{$errors->first('lease_basis')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="area">Area:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="area" name="area" class="form-control form-control--custom m-input"
                                value="{{ $arrData['lease_data']->area }}">
                            <span class="help-block">{{$errors->first('area')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_period">Lease Period:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_period" name="lease_period" class="form-control form-control--custom m-input"
                                value="{{ $arrData['lease_data']->lease_period }}">
                            <span class="help-block">{{$errors->first('lease_period')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_start_date">Start date of lease:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_start_date" name="lease_start_date" class="form-control form-control--custom m-input m_datepicker"
                                readonly value="{{ $arrData['lease_data']->lease_start_date }}">
                            <span class="help-block">{{$errors->first('lease_start_date')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_rent">Land rent / lease rent:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_rent" name="lease_rent" class="form-control form-control--custom m-input"
                                value="{{ $arrData['lease_data']->lease_rent }}">
                            <span class="help-block">{{$errors->first('lease_rent')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_rent_start_month">Month to start collection of lease
                            rent:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                id="lease_rent_start_month" name="lease_rent_start_month">
                                @foreach($arrData['month_data'] as $month)
                                <option value="{{ $month->id  }}" {{ ($month->id == $arrData['lease_data']->lease_rent_start_month) ? "selected" : "" }}>{{
                                    $month->month_name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('lease_rent_start_month')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="interest_per_lease_agreement">Interest as per Lease
                            agreement, in %:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="interest_per_lease_agreement" name="interest_per_lease_agreement"
                                class="form-control form-control--custom m-input" value="{{ $arrData['lease_data']->lease_rent_start_month }}">
                            <span class="help-block">{{$errors->first('interest_per_lease_agreement')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_renewal_date">Date of Renewal of lease:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_renewal_date" name="lease_renewal_date" class="form-control form-control--custom m-input m_datepicker"
                                readonly value="{{ $arrData['lease_data']->lease_renewal_date }}">
                            <span class="help-block">{{$errors->first('lease_renewal_date')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_renewed_period">Period of renewed Lease:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_renewed_period" name="lease_renewed_period" class="form-control form-control--custom m-input"
                                value="{{ $arrData['lease_data']->lease_renewed_period }}">
                            <span class="help-block">{{$errors->first('lease_renewed_period')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="rent_per_renewed_lease">Lease rent as per renewed lease:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="rent_per_renewed_lease" name="rent_per_renewed_lease" class="form-control form-control--custom m-input"
                                value="{{ $arrData['lease_data']->rent_per_renewed_lease }}">
                            <span class="help-block">{{$errors->first('rent_per_renewed_lease')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="interest_per_renewed_lease_agreement">Interest as per
                            renewed Lease agreement, in %:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="interest_per_renewed_lease_agreement" name="interest_per_renewed_lease_agreement"
                                class="form-control form-control--custom m-input" value="{{ $arrData['lease_data']->interest_per_renewed_lease_agreement }}">
                            <span class="help-block">{{$errors->first('interest_per_renewed_lease_agreement')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="month_rent_per_renewed_lease">Month to start collection of
                            lease rent as per renewed lease:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                id="month_rent_per_renewed_lease" name="month_rent_per_renewed_lease">
                                @foreach($arrData['month_data'] as $month)
                                <option value="{{ $month->id  }}" {{ ($month->id == $arrData['lease_data']->month_rent_per_renewed_lease) ? "selected" : "" }}>{{
                                    $month->month_name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('month_rent_per_renewed_lease')}}</span>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="btn-list">
                                    <button type="submit" id="renew_lease" class="btn btn-primary">Save</button>
                                    <a href="{{url('/lease_detail/'.$society_id. '/'.$village_id)}}" class="btn btn-secondary">Cancel</a>
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
