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
            <!-- society details div here -->
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                        <div class="m-subheader">
                            <div class="d-flex align-items-center">
                                <h3 class="section-title section-title--small">
                                    Society Details:
                                </h3>
                            </div>
                            <div class="row field-row">
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Application Number:</span>
                                        <span class="field-value">{{ isset($data->application_no) ? $data->application_no : '' }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Application Date:</span>
                                        <span class="field-value">{{ isset($data->created_at) ? date(config('commanConfig.dateFormat'),strtotime($data->created_at)) : '' }}</span>

                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Society Name:</span>
                                        <span class="field-value">{{ isset($data->societyApplication->name) ? $data->societyApplication->name : '' }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Society Address:</span>
                                        <span class="field-value">{{ isset($data->societyApplication->address) ? $data->societyApplication->address : '' }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Building Number:</span>
                                        <span class="field-value">{{ isset($data->societyApplication->building_no) ? $data->societyApplication->building_no : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-subheader">
                            <div class="d-flex align-items-center">
                                <h3 class="section-title section-title--small">
                                    Appointed Architect Details:
                                </h3>
                            </div>
                            <div class="row field-row">
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Name of Architect:</span>
                                        <span class="field-value">{{ isset($data->societyApplication->name_of_architect) ? $data->societyApplication->name_of_architect : '' }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Architect Mobile Number:</span>
                                        <span class="field-value">{{ isset($data->societyApplication->architect_mobile_no) ? $data->societyApplication->architect_mobile_no : '' }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Architect Address:</span>
                                        <span class="field-value">{{ isset($data->societyApplication->architect_address) ? $data->societyApplication->architect_address : '' }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Architect Telephone Number:</span>
                                        <span class="field-value">{{ isset($data->societyApplication->architect_telephone_no) ? $data->societyApplication->architect_telephone_no : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--document scrutiny sheet div here -->
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                        <div class="m-subheader">
                            <div class="d-flex align-items-center">
                                <h3 class="section-title section-title--small">
                                    Document Scrutiny Sheet
                                </h3>
                            </div>
                                <div class="col-xs-12 field-col">
                                    <div class="col-xs-12 d-flex">
                                        <span class="">1. Recent receipt of service charge paid</span>
                                        <span class="field-value"></span>

                                    </div>
                                </div>                                
                                <div class="col-xs-12 field-col">
                                    <div class="col-xs-12 d-flex">
                                        <span class="">2. Allotement letters are avilable for all house owners or not?</span>
                                        <div class="m-radio-inline">
                                            <label class="m-radio m-radio--primary">
                                                <input type="radio" class="radioBtn" name="Allotement" value="1" checked >Yes
                                                    <span></span>
                                            </label>
                                            <label class="m-radio m-radio--primary">
                                                <input type="radio" class="radioBtn" name="Allotement" value="0">No
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>                                

                                <div class="col-xs-12 field-col">
                                    <div class="col-xs-12 d-flex">
                                        <span class="">3. Society has uploaded society resolution or not ?</span>
                                        <div class="m-radio-inline">
                                            <label class="m-radio m-radio--primary">
                                                <input type="radio" class="radioBtn" name="society_resolution" value="1" checked >Yes
                                                    <span></span>
                                            </label>
                                            <label class="m-radio m-radio--primary">
                                                <input type="radio" class="radioBtn" name="society_resolution" value="0">No
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Generate No dues certificate div here -->
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                        <div class="m-subheader">
                            <div class="d-flex align-items-center">
                                <h3 class="section-title section-title--small">
                                    Generate No dues certificate
                                </h3>
                            </div>
                            <span class="hint-text d-block">Generate No due certificate, if all service charges are paid by the society</span>
                                <div class="mt-auto">
                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Generate</button>
                                </div>    
                        </div>
                    </div>
                </div>
            </div>            
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
            <!-- Society Resolution div here -->
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                        <div class="m-subheader">
                            <div class="d-flex align-items-center">
                                <h3 class="section-title section-title--small">
                                    Society Resolution
                                </h3>
                            </div>
                            <span class="hint-text d-block">Please Download copy of Society resolution in pdf format</span>
                                <div class="mt-auto">
                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Download</button>
                                </div>    
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>
@endsection
