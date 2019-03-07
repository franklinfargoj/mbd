@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.oc_actions',compact('oc_applications'))
@endsection
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Consent For OC Application Form</h3>
                {{ Breadcrumbs::render('society_oc_edit',$oc_applications->id) }}&nbsp;({{ $oc_applications->ol_application_master->model }})

            </div> 
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

            <form id="save_offer_letter_application_dev" role="form" method="post" class="m-form m-form--rows m-form--label-align-right floating-labels-form" action="{{ route('society_oc_update') }}">
                @csrf
                <input type="hidden" name="applicationId" value="{{ $oc_applications->id}}">
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label mhada-multiple-label" for="application_type_id">Select layout:</label>
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layouts" name="layout_id" required>
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
                            <input type="hidden" name="application_master_id" value="{{ $id }}">
                            <input type="hidden" name="request_form_id" value="{{ $oc_application->request_form->id }}">
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
                            <label class="col-form-label" for="construction_details">Construction Details <span class="star">*</span></label>
                            <textarea id="construction_details" name="construction_details" class="form-control form-control--custom m-input" required>{{ $oc_application->request_form->construction_details }}</textarea>
                            <span class="help-block">{{$errors->first('construction_details')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="is_full_oc">Type Of OC</label>
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="is_full_oc" name="is_full_oc" required>
                                <option value="0" @if($oc_application->request_form->is_full_oc==0) selected @endif>Part OC</option>
                                <option value="1" @if($oc_application->request_form->is_full_oc==1) selected @endif>Full OC</option>
                            </select>
                            <span class="help-block">{{$errors->first('is_full_oc')}}</span>

                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="architect_name">Architect Name:</label>
                            <input type="text" id="architect_name" name="architect_name" class="form-control form-control--custom m-input" value="{{ $society_details->name_of_architect }}" readonly>
                            <span class="help-block">{{$errors->first('architect_name')}}</span>
                        </div>
                        @if($id == '16' || $id == '22')
                            <div class="col-sm-4 offset-sm-1 form-group">
                                <label class="col-form-label" for="developer_name">Developer Name:</label>
                                <input type="text" id="developer_name" name="developer_name" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $society_details->developer_name }}">
                                <span class="help-block">{{$errors->first('developer_name')}}</span>
                            </div>
                        @endif
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
                </div>
            </form>
        </div>
    </div>
@endsection