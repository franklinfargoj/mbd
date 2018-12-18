@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Society Details</h3>
            {{ Breadcrumbs::render('society_detail') }}
            <div class="btn-list text-right ml-auto">
                <a href="{{route('society_detail.index',['excel'=>'excel'])}}" name="excel" value="excel" class="btn excel-icon"><img
                        src="{{asset('/img/excel-icon.svg')}}"></a>
                <a target="_blank" href="{{route('society_detail.print')}}" class="btn print-icon"><img src="{{asset('/img/print-icon.svg')}}"></a>
            </div>
        </div>

        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <form role="form" id="societyForm" method="get" action="{{route('society_detail.index')}}">
                        <div class="row align-items-center mb-0">
                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <input type="text" id="society_name" name="society_name" class="form-control form-control--custom m-input"
                                           placeholder="Society Name" value="{{ isset($getData['society_name'])? $getData['society_name'] : '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <input type="text" id="sr_no" name="sr_no" class="form-control form-control--custom m-input"
                                           placeholder="Survey Number" value="{{ isset($getData['sr_no'])? $getData['sr_no'] : '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                            data-live-search="true" id="village" name="village">
                                        <option value="" style="font-weight: normal;">Select Village</option>
                                        {{--@foreach($villages as $village)--}}
                                            {{--<option value="{{$village->id}}" {{ isset($getData['village'])? (($getData['village'] == $village->id ) ? 'selected' : '') : '' }} >{{$village->village_name}}</option>--}}
                                        {{--@endforeach--}}
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group m-form__group">
                                    <div class="btn-list">
                                        <button type="submit" class="btn m-btn--pill m-btn--custom btn-primary">Search</button>
                                        <button type="reset" onclick="window.location.href='{{ route('society_detail.index') }}'"
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
