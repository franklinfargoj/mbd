@extends('admin.layouts.app')
@section('content')
@if(session()->has('success'))
    <div class="alert alert-success display_msg">
        {{ session()->get('success') }}
    </div>
@endif
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Application for Offer Letter</h3>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-md-12 order-2 order-xl-1">
                        <form role="form" id="eeForm" method="get" class="form-group m-form__group row align-items-end" action="{{ route('vp.index') }}">
<!--                                 <div class="col-md-3">
                                    <label for="exampleSelect1">Search</label>
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control form-control--custom m-input" placeholder="Search..."
                                            id="m_form_search">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span>
                                                <i class="la la-search"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div> -->
                                <div class="col-md-3">
                                    <div class="form-group m-form__group">
                                        <label for="office_date_from">From Date</label>
                                        <input type="text" id="submitted_at_from" name="submitted_at_from" class="form-control form-control--custom m-input m_datepicker"
                                            placeholder="From Date" readonly value="{{ isset($getData['submitted_at_from'])? $getData['submitted_at_from'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-form__group">
                                        <label for="office_date_to">To Date</label>
                                        <input type="text" id="submitted_at_to" name="submitted_at_to" class="form-control form-control--custom m-input m_datepicker"
                                            placeholder="To Date" readonly value="{{ isset($getData['submitted_at_to'])? $getData['submitted_at_to'] : '' }}">
                                    </div>
                                </div>

                                @php
                                $status = isset($getData['update_status'])? $getData['update_status'] : '';
                                @endphp

                                <div class="col-md-3">
                                    <div class="form-group m-form__group">
                                        <label for="office_date_to">Status</label>
                                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="update_status" name="update_status">
                                            <option value="">All</option>
                                            @foreach(config('commanConfig.applicationStatus') as $key =>
                                            $application_status)
                                            <option value="{{ $application_status }}"
                                                {{ ($status == $application_status) ? 'selected' : '' }}>{{
                                                ucwords(str_replace('_', ' ', $key)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3" style="margin-top: 15px;">
                                    <div class="form-group m-form__group">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
            <!--begin: Datatable -->
            {!! $html->table() !!}
            <!--end: Datatable -->
        </div>
    </div>
    <input type="hidden" id="myModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" />

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">

    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection
@section('datatablejs')
{!! $html->scripts() !!}

<script>
    $("#update_status").on("change", function () {
        $("#eeForm").submit();
    });

</script>
@endsection
