@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Society Conveyance Application Form</h3>
                {{--                {{ Breadcrumbs::render('society_offer_application_create', $id) }}--}}

            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
            <form id="save_sc_application" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{ route('society_conveyance.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="m-portlet__body m-portlet__body--spaced">
                    @for($i=0; $i < count($field_names); $i++)
                        @if($i != 0) @php $i++; @endphp @endif
                        <div class="form-group m-form__group row">
                            @if(isset($field_names[$i]))
                                @if($field_names[$i] == 'password') @php $field_names[$i] = 'new_password'; $type = 'password'; @endphp @else @php $type = 'text'; @endphp @endif
                                    @if($field_names[$i] == 'confirm_password') @php $type = 'password'; @endphp @else @php $type = 'text'; @endphp @endif
                                <div class="col-sm-4 form-group">
                                    @if($field_names[$i] == 'password') @php dd($type); @endphp @endif
                                    <label class="col-form-label" for="{{ $field_names[$i] }}">@php $labels = implode(' ', explode('_', $field_names[$i])); echo ucwords($labels); @endphp:</label>
                                    @php echo $comm_func->form_fields($field_names[$i], $type, '', '', old($field_names[$i]), '', 'required') @endphp
                                    <span class="help-block" id="{{ $field_names[$i] }}-error">{{$errors->first($field_names[$i])}}</span>
                                </div>
                            @endif
                            @if(isset($field_names[$i+1]))
                                    @if($field_names[$i+1] == 'password') @php $field_names[$i+1] = 'new_password'; $type_1 = 'password' @endphp @else @php $type_1 = 'text'; @endphp @endif
                                        @if($field_names[$i+1] == 'confirm_password') @php $type_1 = 'password'; @endphp @else @php $type_1 = 'text'; @endphp @endif
                                <div class="col-sm-4 offset-sm-1 form-group">
                                    <label class="col-form-label" for="{{ $field_names[$i+1] }}">@php $labels = implode(' ', explode('_', $field_names[$i+1])); echo ucwords($labels); @endphp:</label>
                                    @php echo $comm_func->form_fields($field_names[$i], $type_1, '', '', old($field_names[$i]), '', 'required') @endphp
                                    <input type="hidden" name="id" value="{{ encrypt($users->id) }}">
                                    <span class="help-block" id="{{ $field_names[$i+1] }}-error">{{$errors->first($field_names[$i+1])}}</span>
                                </div>
                            @endif
                        </div>
                    @endfor

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <a href="{{ route('society_conveyance.index') }}" class="btn btn-secondary">Cancel</a>
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
