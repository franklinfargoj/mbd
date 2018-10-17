@extends('admin.layouts.app')
@section('css')

@section('content')

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0">
        <div class="d-flex">
            {{-- {{ Breadcrumbs::render('calculation_sheet',$ol_application->id) }} --}}
            <div class="ml-auto btn-list">
                <a href="javascript:void(0);" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#scrutiny-summary-remark" role="tab"
                    aria-selected="false">
                    <i class="la la-cog"></i> Scrutiny Summaary & Remark
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#list-of-allottes" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i> List of Allottes
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#society-resolution" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i> Society Resolution
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <div class="tab-pane active show" id="scrutiny-summary-remark" role="tabpanel">
            <!-- Add society details div here -->
            <!-- Add document scrutiny sheet div here -->
            <!-- Add Generate No dues certificate div here -->
        </div>
        <div class="tab-pane" id="list-of-allottes" role="tabpanel">
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-subheader">
                            <div class="d-flex align-items-center justify-content-center">
                                <h3 class="section-title text-uppercase">List of Allotte</h3>
                            </div>
                        </div>
                        <div class="m-section__content mb-0 table-responsive">
                            <form class="nav-tabs-form" role="form" method="POST" action="">
                                <table id="one" class="table mb-0 table--box-input" style="padding-top: 10px;">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                                src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("one");'
                                                style="max-width: 22px"></a>
                                    </div>
                                    <thead class="thead-default">
                                        <tr>
                                            <th class="table-data--xs">Sr. No</th>
                                            <th>Tenement No.</th>
                                            <th class="table-data--md">Name of Tenant</th>
                                            <th>Residential / Non Residential</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>A3A3</td>
                                            <td>A .N.Joshi</td>
                                            <td>Residential</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
        <div class="tab-pane" id="society-resolution" role="tabpanel">
            <!-- Add Society Resolution div here -->
        </div>
    </div>
</div>
@endsection
