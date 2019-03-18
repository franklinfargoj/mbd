@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Self Redevelopment</h3>
                {{ Breadcrumbs::render('society_noc_cc_application_create', $id) }}

            </div>
        </div>

        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

            <form id="save_noc_application_self" role="form" method="post" class="m-form m-form--rows m-form--label-align-right floating-labels-form" action="{{ route('save_noc_cc_application_self') }}">
                @csrf
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label mhada-multiple-label" for="application_type_id" >asdSelect Layout:</label>
                            <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layouts" name="layout_id" required>
                                <option value="">Select Layout</option>
                                @foreach($layouts as $layout)
                                    <option value="{{ $layout['id'] }}">{{ $layout['layout_name'] }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('application_type_id')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="preceding_officer_name">Department:</label>
                            <input type="text" id="department_name" name="department_name" class="form-control form-control--custom m-input" value="Resident Executive Engineer" readonly>
                            <input type="hidden" name="application_master_id" value="{{ $id }}" required>
                            <span class="help-block">{{$errors->first('department_name')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="case_year">Building No:</label>
                            <input type="text" id="building_no" name="building_no" class="form-control form-control--custom m-input" value="{{ $society_details->building_no }}" readonly>
                            <span class="help-block">{{$errors->first('building_no')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="name">Society Name:</label>
                            <input type="text" id="name" name="name" class="form-control form-control--custom m-input" value="{{ $society_details->name }}" readonly>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="address">Society Address:</label>
                            <textarea id="address" name="address" class="form-control form-control--custom form-control--fixed-height m-input" readonly>{{ $society_details->address }}</textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="offer_letter_number">Offer Letter Number:</label>
                            <input type="text" id="offer_letter_number" name="offer_letter_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('offer_letter_number') }}" required>
                            <span class="help-block">{{$errors->first('offer_letter_number')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="offer_letter_date">Offer Letter Date:</label>
                            <input type="text" id="offer_letter_date" name="offer_letter_date" class="form-control form-control--custom m-input m_datepicker" value="{{ old('offer_letter_date') }}" required>
                            <span class="help-block">{{$errors->first('offer_letter_date')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="mcgm_iod_number">MCGM IOD Number :</label>
                            <input type="text" id="mcgm_iod_number" name="mcgm_iod_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('mcgm_iod_number') }}" required>
                            <span class="help-block">{{$errors->first('mcgm_iod_number')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="mcgm_iod_date">MCGM IOD Date :</label>
                            <input type="text" id="mcgm_iod_date" name="mcgm_iod_date" class="form-control form-control--custom m-input m_datepicker" value="{{ old('mcgm_iod_date') }}" required>
                            <span class="help-block">{{$errors->first('mcgm_iod_date')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="noc_no">NOC for IOD Number :</label>
                            <input type="text" id="noc_no" name="noc_no" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('noc_no') }}" required>
                            <span class="help-block">{{$errors->first('noc_no')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="noc_date">NOC for IOD Date :</label>
                            <input type="text" id="noc_date" name="noc_date" class="form-control form-control--custom m-input m_datepicker" value="{{ old('noc_date') }}" required>
                            <span class="help-block">{{$errors->first('noc_date')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="tripartite_agreement_date">Tripartite Agreement Date :</label>
                            <input type="text" id="tripartite_agreement_date" name="tripartite_agreement_date" class="form-control form-control--custom m-input m_datepicker" value="{{ old('tripartite_agreement_date') }}" required>
                            <span class="help-block">{{$errors->first('tripartite_agreement_date')}}</span>
                        </div>
                        {{--<div class="col-sm-4 offset-sm-1 form-group"> <!-- offset-sm-1 -->--}}
                            {{--<label class="col-form-label" for="tripartite_agreement_number">Tripartite AgreementNumber :</label>--}}
                            {{--<input type="text" id="tripartite_agreement_number" name="tripartite_agreement_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('tripartite_agreement_number') }}" required>--}}
                            {{--<span class="help-block">{{$errors->first('tripartite_agreement_number')}}</span>--}}
                        {{--</div>--}}
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="developer_name">Developer Name:  {{--<span class="star">*</span>--}}</label>
                            <input type="text" id="developer_name" name="developer_name" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('developer_name') }}" required>
                            <span class="help-block">{{$errors->first('developer_name')}}</span>
                        </div>
                    </div>

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <button type="submit"  class="btn btn-primary">Save</button>
                                        <a href="{{URL::previous()}}" class="btn btn-secondary">Cancel</a>
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
@section('js')
    <script>

        var today = new Date();

        $('.m_datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            endDate: today
        });

    </script>

@endsection