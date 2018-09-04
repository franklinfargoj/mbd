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

        <form id="addSocietyDetail" role="form" method="post" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" action="{{route('society_detail.store')}}">
            @csrf
            <input type="hidden" name="village_id" value="{{ $id }}">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="society_name">Society Name:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="society_name" name="society_name" class="form-control m-input" value="{{ old('society_name') }}">
                            <span class="help-block">{{$errors->first('society_name')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="district">District:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="district" name="district" class="form-control m-input" value="{{ old('district') }}">
                            <span class="help-block">{{$errors->first('district')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="taluka">Taluka:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="taluka" name="taluka" class="form-control m-input"  value="{{ old('taluka') }}">
                            <span class="help-block">{{$errors->first('taluka')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="survey_number">Survey Number:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="survey_number" name="survey_number" class="form-control m-input"  value="{{ old('survey_number') }}">
                            <span class="help-block">{{$errors->first('survey_number')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="cts_number">CTS Number:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="cts_number" name="cts_number" class="form-control m-input"  value="{{ old('cts_number') }}">
                            <span class="help-block">{{$errors->first('cts_number')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="Chairman">Chairman:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="chairman" name="chairman" class="form-control m-input"  value="{{ old('chairman') }}">
                            <span class="help-block">{{$errors->first('chairman')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="society_address">Society Address:</label>
                        <div class="m-input-icon m-input-icon--right">
                        <textarea id="society_address" name="society_address" class="form-control" class="form-control m-input">{{ old('society_address') }}</textarea>
                            <span class="help-block">{{$errors->first('society_address')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="area">Area:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="area" name="area" class="form-control m-input"  value="{{ old('area') }}">
                            <span class="help-block">{{$errors->first('area')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="date_on_service_tax">Date mentioned on service tax letters:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="date" id="date_on_service_tax" name="date_on_service_tax" class="form-control" class="form-control m-input"  value="{{ old('date_on_service_tax') }}">
                            <span class="help-block">{{$errors->first('date_on_service_tax')}}</span>
                        </div>
                    </div>

                     <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="surplus_charges">Surplus Charges:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="surplus_charges" name="surplus_charges" class="form-control" class="form-control m-input"  value="{{ old('surplus_charges') }}">
                            <span class="help-block">{{$errors->first('surplus_charges')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="surplus_charges_last_date">Last date of paying surplus charges:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="date" id="surplus_charges_last_date" name="surplus_charges_last_date" class="form-control" class="form-control m-input"  value="{{ old('surplus_charges_last_date') }}">
                            <span class="help-block">{{$errors->first('surplus_charges_last_date')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="other_land_id">Others:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-input" id="other_land_id" name="other_land_id">
                                @foreach($arrData['other_land'] as $other_land_details)
                                    <option value="{{ $other_land_details->id  }}">{{ $other_land_details->land_name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('other_land_id')}}</span>
                        </div>
                    </div>
                </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid">
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{url('/society_detail/'.$id)}}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection