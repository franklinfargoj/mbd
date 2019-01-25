@extends('admin.layouts.app')
@section('content')

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">{{ ucfirst($society_name)}} Society Lease Details</h3>
            {{ Breadcrumbs::render('lease_detail',encrypt($id)) }}
            <div class="ml-auto btn-list">
                {{--<a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>--}}
                    <a href="?excel=excel" name="excel" value="excel" class="btn excel-icon"><img src="{{asset('/img/excel-icon.svg')}}"></a>
                    <a target="_blank" href="{{route('lease_detail.print',['id'=>$id])}}" class="btn print-icon"><img src="{{asset('/img/print-icon.svg')}}"></a>
            </div>
        </div>

        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <form role="form" id="eeForm" method="get" action="">
                        <div class="row align-items-center mb-0">
                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <input type="text" id="society_name" name="society_name" class="form-control form-control--custom m-input"
                                           placeholder="Society Name" value="{{ isset($getData['society_name'])? $getData['society_name'] : '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <input type="text" id="lease_date_from" name="lease_date_from" class="form-control form-control--custom m-input m_datepicker"
                                           placeholder="From Date" value="{{ isset($getData['lease_date_from'])? $getData['lease_date_from'] : '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <input type="text" id="lease_date_to" name="lease_date_to" class="form-control form-control--custom m-input m_datepicker"
                                           placeholder="To Date" value="{{ isset($getData['lease_date_to'])? $getData['lease_date_to'] : '' }}">
                                </div>
                            </div>

                            {{--<div class="col-md-3">--}}
                                {{--<div class="form-group m-form__group">--}}
                                    {{--<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"--}}
                                            {{--id="update_status" name="update_status">--}}
                                        {{--<option value="" style="font-weight: normal;">Select Status</option>--}}
                                            {{--<option value="">ABC</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="col">
                                <div class="form-group m-form__group">
                                    <div class="btn-list">
                                        <button type="submit" class="btn m-btn--pill m-btn--custom btn-primary">Search</button>
                                        <button type="reset" onclick="window.location.href='{{ route("lease_detail.index",'0') }}'"
                                                class="btn m-btn--pill m-btn--custom btn-metal">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        @if(Session::has('success'))
        <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size:20px">×</span>
            </button> {{ Session::get('success') }}
        </div>
        @endif
        <div class="m-portlet__body data-table--custom data-table--icons data-table--actions">
            <!--begin: Search Form -->
            {{--<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-4">
                                    <label for="exampleSelect1">Search</label>
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input m-input--solid" placeholder="Search..."
                                            id="m_form_search">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label>Resolution Type</label>
                                        <select class="form-control m-input m-input--square" id="exampleSelect1">
                                            <option>Mhada resolutions</option>
                                            <option>MBR Resolutions</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label>From Date</label>
                                        <input type="date" class="form-control m-input m-input--solid" placeholder="From Date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label>To Date</label>
                                        <input type="date" class="form-control m-input m-input--solid" placeholder="From Date">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
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
<?php //dd($html->scripts()); ?>
@section('datatablejs')
{!! $html->scripts() !!}
<script>
    /*$( function() {
        $( "#published_from_date, #published_to_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    } );*/

</script>
@endsection
