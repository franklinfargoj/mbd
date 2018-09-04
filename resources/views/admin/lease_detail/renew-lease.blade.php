@extends('admin.layouts.app')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Add Society </h3>
            </div>
            <div>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content"></div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">

                    </h3>
                </div>
            </div>
        </div>

        <form id="renewLeaseDetail" role="form" method="post" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" action="{{route('renew-lease.update-lease', $id)}}">
            @csrf
            <input type="hidden" name="society_id" value="{{ $id }}">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_rule_other">Lease rule 16 & other:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_rule_other" name="lease_rule_other" class="form-control m-input" value="{{ old('lease_rule_other') }}">
                            <span class="help-block">{{$errors->first('lease_rule_other')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_basis">School/society/ others on lease basis:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_basis" name="lease_basis" class="form-control m-input" value="{{ old('lease_basis') }}">
                            <span class="help-block">{{$errors->first('lease_basis')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="area">Area:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="area" name="area" class="form-control m-input"  value="{{ old('area') }}">
                            <span class="help-block">{{$errors->first('area')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_period">Lease Period:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_period" name="lease_period" class="form-control m-input"  value="{{ old('lease_period') }}">
                            <span class="help-block">{{$errors->first('lease_period')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_start_date">Start date of lease:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="date" id="lease_start_date" name="lease_start_date" class="form-control m-input"  value="{{ old('lease_start_date') }}">
                            <span class="help-block">{{$errors->first('lease_start_date')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_rent">Land rent / lease rent:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_rent" name="lease_rent" class="form-control m-input"  value="{{ old('lease_rent') }}">
                            <span class="help-block">{{$errors->first('lease_rent')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_rent_start_month">Month to start collection of lease rent:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-input" id="lease_rent_start_month" name="lease_rent_start_month">
                                @foreach($arrData['month_data'] as $month)
                                    <option value="{{ $month->id  }}" {{ (date('n') == $month->id) ? "selected" : "" }}>{{ $month->month_name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('lease_rent_start_month')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="interest_per_lease_agreement">Interest as per Lease agreement, in %:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="interest_per_lease_agreement" name="interest_per_lease_agreement" class="form-control m-input"  value="{{ old('interest_per_lease_agreement') }}">
                            <span class="help-block">{{$errors->first('interest_per_lease_agreement')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_renewal_date">Date of Renewal of lease:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="date" id="lease_renewal_date" name="lease_renewal_date" class="form-control" class="form-control m-input"  value="{{ old('lease_renewal_datedate_on_service_tax') }}">
                            <span class="help-block">{{$errors->first('lease_renewal_date')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="lease_renewed_period">Period of renewed Lease:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_renewed_period" name="lease_renewed_period" class="form-control" class="form-control m-input"  value="{{ old('lease_renewed_period') }}">
                            <span class="help-block">{{$errors->first('lease_renewed_period')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="rent_per_renewed_lease">Lease rent as per renewed lease:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="rent_per_renewed_lease" name="rent_per_renewed_lease" class="form-control" class="form-control m-input"  value="{{ old('rent_per_renewed_lease') }}">
                            <span class="help-block">{{$errors->first('rent_per_renewed_lease')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="interest_per_renewed_lease_agreement">Interest as per renewed Lease agreement, in %:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="interest_per_renewed_lease_agreement" name="interest_per_renewed_lease_agreement" class="form-control" class="form-control m-input"  value="{{ old('interest_per_renewed_lease_agreement') }}">
                            <span class="help-block">{{$errors->first('interest_per_renewed_lease_agreement')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="month_rent_per_renewed_lease">Month to start collection of lease rent as per renewed lease:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-input" id="month_rent_per_renewed_lease" name="month_rent_per_renewed_lease">
                                @foreach($arrData['month_data'] as $month)
                                    <option value="{{ $month->id  }}" {{ (date('n') == $month->id) ? "selected" : "" }}>{{ $month->month_name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('month_rent_per_renewed_lease')}}</span>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{url('/lease_detail/'.$id)}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection