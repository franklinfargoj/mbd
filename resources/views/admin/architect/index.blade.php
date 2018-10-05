@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Architect Applications</h3>

        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-md-12 order-2 order-xl-1">
                        <!-- <div class="form-group m-form__group row align-items-center"> -->
                        <form class="form-group m-form__group row align-items-end" method="get" action="{{url('architect_application')}}">
                            <div class="col-md-3">
                                <label for="exampleSelect1">Search For</label>
                                <input type="text" class="form-control form-control--custom m-input" placeholder="Application No, Candidate Name, Email ID OR Mobile No" title="Enter Application No, Candidate Name, Email ID OR Mobile No"
                                    id="m_form_search" name="keyword" value="{{ old('keyword') }}">
                            </div>
                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <label>From Date</label>
                                    <input type="text" class="form-control form-control--custom m-input m_datepicker"
                                        placeholder="From Date" name="from" value="{{ (!empty($getData) ? $getData['from'] : '') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <label>To Date</label>
                                    <input type="text" class="form-control form-control--custom m-input m_datepicker"
                                        placeholder="From Date" name="to" value="{{ (!empty($getData) ? $getData['to'] : '') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <label>Resolution Type</label>
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        id="exampleSelect1" name="resolution_type_id">
                                        <option value="0">Sort by Status</option>
                  
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <button type="submit" name="reset" value="Reset" class="btn btn-primary">Reset</button>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="btn-list text-right">
                                    <button type="submit" name="excel" value="excel" class="btn excel-icon"><img src="{{asset('/img/excel-icon.svg')}}"></button>
                                    <a target="_blank" href=""
                                        class="btn print-icon"><img src="{{asset('/img/print-icon.svg')}}"></a>
                                </div>
                            </div>
                        </form>
                        <!-- </div> -->
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
