@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.actions_noc_cc',compact('noc_applications'))
@endsection
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Redevelopment Application Form</h3>
                {{ Breadcrumbs::render('noc_cc_edit') }}&nbsp;({{ $noc_application->noc_application_master->model }})

            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

            <form id="save_noc_application_dev" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{ route('society_noc_cc_update') }}">
                @csrf
                <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="application_type_id">Application Type:</label>
                            <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layouts" name="layout_id" required>
                                @foreach($layouts as $layout)
                                    <option value="{{ $layout['id'] }}">{{ $layout['layout_name'] }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('application_type_id')}}</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="preceding_officer_name">Department:</label>
                            <input type="text" id="department_name" name="department_name" class="form-control form-control--custom m-input" value="Resident Executive Engineer" readonly>
                            <input type="hidden" name="application_master_id" value="{{ $id }}" required>
                            <input type="hidden" name="request_form_id" value="{{ $noc_application->request_form->id }}">
                            <span class="help-block">{{$errors->first('department_name')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="case_year">Building No:</label>
                            <input type="text" id="building_no" name="building_no" class="form-control form-control--custom m-input" value="{{ $society_details->building_no }}" readonly>
                            <span class="help-block">{{$errors->first('building_no')}}</span>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
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

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="offer_letter_number">Offer Letter Number:</label>
                            <input type="text" id="offer_letter_number" name="offer_letter_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $noc_application->request_form->offer_letter_number }}" required>
                            <span class="help-block">{{$errors->first('offer_letter_number')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="offer_letter_date">Offer Letter Date:</label>
                            <input type="text" id="m_datepicker" name="offer_letter_date" class="form-control form-control--custom m-input m_datepicker" value="{{ date(config('commanConfig.dateFormat'), strtotime($noc_application->request_form->offer_letter_date)) }}" required>
                            <span class="help-block">{{$errors->first('offer_letter_date')}}</span>
                        </div>
                    </div>


                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="mcgm_iod_number">MCGM IOD Number :</label>
                            <input type="text" id="mcgm_iod_number" name="mcgm_iod_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $noc_application->request_form->mcgm_iod_number }}" required>
                            <span class="help-block">{{$errors->first('mcgm_iod_number')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="mcgm_iod_date">MCGM IOD Date :</label>
                            <input type="text" id="m_datepicker" name="mcgm_iod_date" class="form-control form-control--custom m-input m_datepicker" value="{{ date(config('commanConfig.dateFormat'), strtotime($noc_application->request_form->mcgm_iod_date)) }}" required>
                            <span class="help-block">{{$errors->first('mcgm_iod_date')}}</span>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="noc_no">NOC for IOD Number :</label>
                            <input type="text" id="noc_no" name="noc_no" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $noc_application->request_form->noc_no }}" required>
                            <span class="help-block">{{$errors->first('noc_no')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="noc_date">NOC for IOD Date :</label>
                            <input type="text" id="m_datepicker" name="noc_date" class="form-control form-control--custom m-input m_datepicker" value="{{ date(config('commanConfig.dateFormat'), strtotime($noc_application->request_form->noc_date)) }}" required>
                            <span class="help-block">{{$errors->first('noc_date')}}</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group"> <!-- offset-sm-1 -->
                            <label class="col-form-label" for="tripartite_agreement_date">Tripartite agreement date :</label>
                            <input type="text" id="m_datepicker" name="tripartite_agreement_date" class="form-control form-control--custom m-input m_datepicker" value="{{ date(config('commanConfig.dateFormat'), strtotime($noc_application->request_form->tripartite_agreement_date)) }}" required>
                            <span class="help-block">{{$errors->first('tripartite_agreement_date')}}</span>
                        </div>
                        {{--<div class="col-sm-4 offset-sm-1 form-group"> <!-- offset-sm-1 -->--}}
                            {{--<label class="col-form-label" for="tripartite_agreement_number">Tripartite agreement number :</label>--}}
                            {{--<input type="text" id="tripartite_agreement_number" name="tripartite_agreement_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $noc_application->request_form->tripartite_agreement_number }}" required>--}}
                            {{--<span class="help-block">{{$errors->first('tripartite_agreement_number')}}</span>--}}
                        {{--</div>--}}
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="developer_name">Developer Name:  {{--<span class="star">*</span>--}}</label>
                            <input type="text" id="developer_name" name="developer_name" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $noc_application->request_form->developer_name}}" required>
                            <span class="help-block">{{$errors->first('developer_name')}}</span>
                        </div>
                    </div>

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <button type="submit"  class="btn btn-primary">Update</button>
                                        <a href="{{route('society_offer_letter_dashboard')}}" class="btn btn-secondary">Cancel</a>
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