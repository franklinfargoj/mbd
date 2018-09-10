@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Lease Details</h3>
            </div>
            <div>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content"></div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">

                    </h3>
                </div>
            </div>
            @if($count > 0)
                <a class="btn btn-danger" href="{{route('renew-lease.renew', $id)}}" style="float: right;margin-top: 3%">Renew Lease</a>
            @else
                <a class="btn btn-danger" href="{{route('lease_detail.create', $id)}}" style="float: right;margin-top: 3%">Add Lease</a>
            @endif
        </div>
        <div class="m-portlet__body">
            <!--begin: Search Form -->
        {{--<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
            <div class="row align-items-center">
                <div class="col-xl-8 order-2 order-xl-1">
                    <div class="form-group m-form__group row align-items-center">
                        <div class="col-md-4">
                            <label for="exampleSelect1">Search</label>
                            <div class="m-input-icon m-input-icon--left">
                                <input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="m_form_search">
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                     <span>
                     <i class="la la-search"></i>
                     </span>
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






