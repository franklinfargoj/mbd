@extends('admin.layouts.app')
@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
            Application for Offer Letter</h3>
        </div>
        <div>
        </div>
    </div>
</div>
<!-- END: Subheader -->
<div class="m-content"></div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <form role="form" id="eeForm" method="get" action="{{ route('ree_applications.index') }}">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label for="office_date_from">From Date</label>
                                        <input type="date" id="office_date_from" name="office_date_from" class="form-control m-input m-input--solid" placeholder="From Date" value="{{ isset($getData['office_date_from'])? $getData['office_date_from'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label for="office_date_to">To Date</label>
                                        <input type="date" id="office_date_to" name="office_date_to" class="form-control m-input m-input--solid" placeholder="From Date" value="{{ isset($getData['office_date_to'])? $getData['office_date_to'] : '' }}">
                                    </div>
                                </div>

                                @php
                                    $status = isset($getData['update_status'])? $getData['update_status'] : '';
                                @endphp

                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label for="office_date_to">Status</label>
                                        <select class="form-control m-input" id="update_status" name="update_status">
                                            <option value="">All</option>
                                            <option value="1">In Progress</option>
                                            <option value="2">Forwarded</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-8" style="margin-top: 15px;">
                                    <div class="form-group m-form__group">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
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
@endsection
@section('datatablejs')
    {!! $html->scripts() !!}

    <script>
        $("#update_status").on("change", function () {
            $("#eeForm").submit();
        });
    </script>
@endsection