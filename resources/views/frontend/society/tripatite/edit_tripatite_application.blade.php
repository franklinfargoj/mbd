@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.tripatite.actions',compact('ol_applications'))
@endsection
@section('content')

    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">
                {{ isset($title) ? $title : '' }}</h3>
                {{ Breadcrumbs::render('society_tripartite_edit_application', $id) }}&nbsp;({{ $ol_applications->ol_application_master->model }})

            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
            <form id="save_offer_letter_application_self" role="form" method="post" class="m-form m-form--rows m-form--label-align-right floating-labels-form" action="{{ route('tripartite_application_form_update') }}">
                @csrf
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="application_type_id">Layout:</label>
                            <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layouts" name="layout_id" required>
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
                            <input type="hidden" name="application_master_id" value="{{ $ol_applications->application_master_id }}" required>
                            <input type="hidden" name="application_id" value="{{ $ol_applications->id }}" required>
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
                            <input type="hidden" name="society_id" value="{{ $society_details->id }}">
                            <input type="text" id="name" name="name" class="form-control form-control--custom m-input" value="{{ $society_details->name }}" readonly>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="address">Society Address:</label>
                            <textarea id="address" name="address" class="form-control form-control--custom form-control--fixed-height m-input" readonly>{{ $society_details->address }}</textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                    </div>
                    @for($i=0; $i < count($form_fields); $i++)
                        @if($i != 0) @php $i++; @endphp @endif
                        <div class="m-form__group row mhada-lease-margin">
                            @if(isset($form_fields[$i]))
                                @php
                                    if($form_fields[$i] == 'revised_offer_letter_date' || $form_fields[$i] == 'revised_offer_letter_number')
                                        $required = '';
                                    else{
                                         $required = 'required';
                                        }
                                @endphp
                                <div class="col-sm-4 form-group">
                                    <label class="col-form-label" for="{{ $form_fields[$i] }}">@php $labels = implode(' ', explode('_', $form_fields[$i])); echo ucwords($labels); @endphp:</label>
                                    @if(strpos($form_fields[$i], 'date') != null)
                                        @php echo $comm_func->form_fields($form_fields[$i], 'date', '', '', $form_fields_values[$form_fields[$i]]) @endphp
                                    @else
                                        @php echo $comm_func->form_fields($form_fields[$i], 'text', '', '', $form_fields_values[$form_fields[$i]], '', $required) @endphp
                                    @endif
                                    <span class="help-block">{{ $errors->first($form_fields[$i]) }}</span>
                                </div>
                            @endif
                            @if(isset($form_fields[$i+1]))
                                    @php
                                        if($form_fields[$i+1] == 'revised_offer_letter_number' || $form_fields[$i+1] == 'revised_offer_letter_date')
                                            $required = '';
                                        else{
                                             $required = 'required';
                                            }
                                    @endphp
                                <div class="col-sm-4 offset-sm-1 form-group">
                                    <label class="col-form-label" for="{{ $form_fields[$i+1] }}">@php $labels = implode(' ', explode('_', $form_fields[$i+1])); echo ucwords($labels); @endphp:</label>
                                    @if(strpos($form_fields[$i+1], 'date') != null)
                                        @php echo $comm_func->form_fields($form_fields[$i+1], 'date', '', '', $form_fields_values[$form_fields[$i+1]]) @endphp
                                    @else
                                        @php echo $comm_func->form_fields($form_fields[$i+1], 'text', '', '', $form_fields_values[$form_fields[$i+1]], '', $required) @endphp
                                    @endif
                                    <span class="help-block">{{ $errors->first($form_fields[$i+1]) }}</span>
                                </div>
                            @endif
                        </div>
                    @endfor

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <a href="{{ route('society_offer_letter_dashboard') }}" class="btn btn-secondary">Cancel</a>
                                        <button type="submit"  class="btn btn-primary">Update</button>
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