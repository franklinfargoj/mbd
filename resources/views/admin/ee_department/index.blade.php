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
            {{ Breadcrumbs::render('ee') }}
            <button type="button" class="btn btn-transparent ml-auto" data-toggle="collapse" data-target="#filter">
                <img class="filter-icon" src="{{asset('/img/filter-icon.svg')}}">Filter
            </button>
        </div>
        <div id="filter" class="m-portlet filter-wrap collapse show">
            <div class="row align-items-center">
                <div class="col-xl-8 order-2 order-xl-1">
                    <form role="form" id="eeForm" method="get" action="{{ route('ee.index') }}">
                        <div class="form-group m-form__group row align-items-center mb-0">
                            {{--<div class="col-md-4">--}}
                                {{--<label for="exampleSelect1">Search</label>--}}
                                {{--<div class="m-input-icon m-input-icon--left">--}}
                                    {{--<input type="text" class="form-control m-input m-input--solid" placeholder="Search..."
                                        id="m_form_search">--}}
                                    {{--<span class="m-input-icon__icon m-input-icon__icon--left">--}}
                                        {{--<span>--}}
                                            {{--<i class="la la-search"></i>--}}
                                            {{--</span>--}}
                                        {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <input type="text" id="submitted_at_from" name="submitted_at_from" class="form-control form-control--custom m-input m_datepicker"
                                        placeholder="From Date" value="{{ isset($getData['submitted_at_from'])? $getData['submitted_at_from'] : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <input type="text" id="submitted_at_to" name="submitted_at_to" class="form-control form-control--custom m-input m_datepicker"
                                        placeholder="To Date" value="{{ isset($getData['submitted_at_to'])? $getData['submitted_at_to'] : '' }}">
                                </div>
                            </div>

                            @php
                            $status = isset($getData['update_status'])? $getData['update_status'] : '';
                            @endphp

                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        id="update_status" name="update_status">
                                        <option value="">Select Status</option>
                                        @foreach(config('commanConfig.applicationStatus') as $key =>
                                        $application_status)
                                        <option value="{{ $application_status }}"
                                            {{ ($status == $application_status) ? 'selected' : '' }}>{{
                                            ucwords(str_replace('_', ' ', $key)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-8" style="margin-top: 15px;">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        {{--<div class="m-portlet__head">--}}
            {{--<div class="m-portlet__head-caption">--}}
                {{--<div class="m-portlet__head-title">--}}
                    {{--<h3 class="m-portlet__head-text">--}}

                        {{--</h3>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--<a class="btn btn-danger" href="{{route('hearing.create')}}" style="float: right;margin-top: 3%">Add
                Hearing</a>--}}
            {{--</div>--}}
        <div class="m-portlet__body">
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

    $(document).ready(function () {
        $(".display_msg").delay(5000).slideUp(300);
    });

</script>
@endsection
