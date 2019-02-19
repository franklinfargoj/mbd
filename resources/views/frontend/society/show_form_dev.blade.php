@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Redevelopment Through Developer</h3>
                {{ Breadcrumbs::render('society_offer_application_create', $id) }}

            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

            <form id="save_offer_letter_application_dev" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{ route('save_offer_letter_application_dev') }}">
                @csrf
                <input type="hidden" name="applicationId" value="{{ isset($data) ? $data->id : '' }}">
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="preceding_officer_name">Department: <span class="star">*</span></label>
                            {{--<input type="text" id="department_name" name="department_name" class="form-control form-control--custom m-input" value="EE" readonly>--}}
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" data-live-search="true" id="department_name" name="department_name" required>
                                <option value="">Select</option>
                                @foreach($ee_divisions as $ee_division)
                                    @if(isset($data) && $data->department_id == $ee_division->id)
                                        <option value="{{ $ee_division->id }}" selected>{{ $ee_division->division }}</option>
                                    @else
                                        <option value="{{ $ee_division->id }}">{{ $ee_division->division }}</option>
                                    @endif    
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('department_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="application_type_id">Layout:
                            <span class="star">*</span></label>
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" data-live-search="true" id="layouts" name="layout_id" required>
                                @foreach($layouts as $layout)
                                    @if(isset($data) && $data->layout_id == $layout['id'])
                                        <option value="{{ $layout['id'] }}" selected>{{ $layout['layout_name'] }}</option>
                                    @else
                                        <option value="{{ $layout['id'] }}">{{ $layout['layout_name'] }}</option>
                                    @endif    
                                @endforeach
                            </select>
                            <input type="hidden" name="application_master_id" value="{{ $id }}">
                            <span class="help-block">{{$errors->first('application_type_id')}}</span>
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
                            <label class="col-form-label" for="date_of_meeting">Date of Resolution: <span class="star">*</span></label>
                            <input type="text" id="date_of_meeting" name="date_of_meeting" data-date-end-date="+0d" class="form-control form-control--custom m-input m_datepicker" value="{{ (isset($data) && $data->request_form->date_of_meeting) ? date(config('commanConfig.dateFormat'), strtotime($data->request_form->date_of_meeting)) : '' }}" required readonly>
                            <span class="help-block">{{$errors->first('date_of_meeting')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="resolution_no">Resolution No: <span class="star">*</span></label>
                            <input type="text" id="resolution_no" name="resolution_no" class="form-control form-control--custom form-control--fixed-height m-input"  value="{{ (isset($data) && $data->request_form->resolution_no) ? $data->request_form->resolution_no : '' }}" required>
                            <span class="help-block">{{$errors->first('resolution_no')}}</span>
                        </div> 
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="architect_name">Architect Name:</label>
                            <input type="text" id="architect_name" name="architect_name" class="form-control form-control--custom m-input" value="{{ $society_details->name_of_architect }}" readonly>
                            <span class="help-block">{{$errors->first('architect_name')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="developer_name">Developer Name:  <span class="star">*</span></label>
                            <input type="text" id="developer_name" name="developer_name" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ isset($data) ? $data->request_form->developer_name : '' }}" required>
                            <span class="help-block">{{$errors->first('developer_name')}}</span>
                        </div>
                    </div>

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <a href="{{ route('society_offer_letter_dashboard') }}" class="btn btn-secondary">Cancel</a>
                                        <button type="submit"  class="btn btn-primary">Save</button>
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
{{--@section('js')--}}
    {{--<script>--}}
        {{----}}
    {{--</script>--}}
{{--@endsection--}}