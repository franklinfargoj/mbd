@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex">
            <h3 class="m-subheader__title">View Society</h3>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        <input type="hidden" name="village_id" value="{{ $arrData['society_data']->village_id }}">
        <div class="m-portlet__body m-portlet__body--spaced">
            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="society_name">Society Name:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" id="society_name" name="society_name" readonly class="form-control form-control--custom m-input"
                            value="{{ $arrData['society_data']->society_name }}">
                        <span class="help-block">{{$errors->first('society_name')}}</span>
                    </div>
                </div>

                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="district">District:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" id="district" name="district" readonly class="form-control form-control--custom m-input"
                            value="{{ $arrData['society_data']->district }}">
                        <span class="help-block">{{$errors->first('district')}}</span>
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="taluka">Taluka:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" id="taluka" name="taluka" readonly class="form-control form-control--custom m-input"
                            value="{{ $arrData['society_data']->taluka }}">
                        <span class="help-block">{{$errors->first('taluka')}}</span>
                    </div>
                </div>

                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="survey_number">Survey Number:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" id="survey_number" name="survey_number" readonly class="form-control form-control--custom m-input"
                            value="{{ $arrData['society_data']->survey_number }}">
                        <span class="help-block">{{$errors->first('survey_number')}}</span>
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="cts_number">CTS Number:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" id="cts_number" name="cts_number" readonly class="form-control form-control--custom m-input"
                            value="{{ $arrData['society_data']->cts_number }}">
                        <span class="help-block">{{$errors->first('cts_number')}}</span>
                    </div>
                </div>

                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="chairman">Chairman:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" id="chairman" name="chairman" readonly class="form-control form-control--custom m-input"
                            value="{{ $arrData['society_data']->chairman }}">
                        <span class="help-block">{{$errors->first('chairman')}}</span>
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="society_address">Society Address:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <textarea id="society_address" name="society_address" readonly class="form-control form-control--custom form-control--fixed-height"
                            class="form-control m-input">{{ $arrData['society_data']->society_address }}</textarea>
                        <span class="help-block">{{$errors->first('society_address')}}</span>
                    </div>
                </div>

                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="area">Area:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" id="area" name="area" readonly class="form-control form-control--custom m-input"
                            value="{{ $arrData['society_data']->area }}">
                        <span class="help-block">{{$errors->first('area')}}</span>
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="date_on_service_tax">Date mentioned on service tax letters:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" id="date_on_service_tax" name="date_on_service_tax" readonly class="form-control form-control--custom m-input"
                            value="{{ date(config('commanConfig.dateFormat'), strtotime($arrData['society_data']->date_on_service_tax)) }}">
                        <span class="help-block">{{$errors->first('date_on_service_tax')}}</span>
                    </div>
                </div>

                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="surplus_charges">Surplus Charges:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" id="surplus_charges" readonly name="surplus_charges" class="form-control form-control--custom m-input"
                            value="{{ $arrData['society_data']->surplus_charges }}">
                        <span class="help-block">{{$errors->first('surplus_charges')}}</span>
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="surplus_charges_last_date">Last date of paying surplus charges:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" id="surplus_charges_last_date" readonly name="surplus_charges_last_date"
                            class="form-control form-control--custom m-input" value="{{ date(config('commanConfig.dateFormat'), strtotime($arrData['society_data']->surplus_charges_last_date)) }}">
                        <span class="help-block">{{$errors->first('surplus_charges_last_date')}}</span>
                    </div>
                </div>

                <div class="col-lg-6 form-group">
                    <label class="col-form-label" for="other_land_id">Others:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <select disabled class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                            id="other_land_id" name="other_land_id">
                            @foreach($arrData['other_land'] as $other_land_details)
                            <option value="{{ $other_land_details->id  }}"
                                {{ ($other_land_details->id == $arrData['society_data']->other_land_id) }}>{{
                                $other_land_details->land_name }}</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{$errors->first('other_land_id')}}</span>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="btn-list">
                                <a href="{{url('/society_detail/'.$arrData['society_data']->village_id)}}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
