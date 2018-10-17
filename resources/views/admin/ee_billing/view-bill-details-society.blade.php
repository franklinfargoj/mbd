@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">View Society Billing Details</h3>
            <div class="ml-auto btn-list">
                <a href="javascript:void(0);" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                <a href="javascript:void(0);" target="_blank" id="" class="btn print-icon"
                    rel="noopener" onclick=""><img src="{{asset('/img/print-icon.svg')}}" title="print"></a>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        <div class="m-portlet__body data-table--custom data-table--icons data-table--actions">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <form role="form" class="row align-items-end mb-0" id="eeForm" method="get" action="">
                        <div class="col-sm-3">
                            <div class="form-group m-form__group">
                                <select title="Select Year" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                    id="select-year" name="select-year">
                                    <option value="">2018</option>
                                    <option value="">2017</option>
                                    <option value="">2016</option>
                                    <option value="">2015</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group m-form__group">
                                <select title="Select Month" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                    id="select-month" name="select-month">
                                    <option value="">January</option>
                                    <option value="">February</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        <div class="m-portlet__body data-table--custom data-table--icons data-table--actions">
            <!-- Add Data Table here -->
        </div>
    </div>
</div>
@endsection
