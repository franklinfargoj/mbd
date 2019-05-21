@php $route_name=\Request::route()->getName(); @endphp
@extends('admin.layouts.sidebarAction')
@section('actions')
    @if($route_name=='ree.show_reval_calculation_sheet'  || $route_name=='co.show_reval_calculation_sheet' || $route_name=='cap.show_reval_calculation_sheet' || $route_name=='vp.show_reval_calculation_sheet')

        @include('admin.'.$folder.$action,compact('ol_application'))


    @else
        @include('admin.'.$folder.$action,compact('ol_application'))
    @endif
@endsection
@section('content')
@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif
 
@if(session()->has('error'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif
<style>
.txtbox {
    width :200px;
</style>
<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Calculation Sheet </h3>
                @if($route_name=='co.show_calculation_sheet')
                    {{ Breadcrumbs::render('calculation_sheet_co',$ol_application->id) }}
                @elseif($route_name=='cap.show_calculation_sheet') 
                    {{ Breadcrumbs::render('calculation_sheet_cap',$ol_application->id) }}
                @elseif($route_name=='vp.show_calculation_sheet') 
                    {{ Breadcrumbs::render('calculation_sheet_vp',$ol_application->id) }}       
                @elseif($route_name=='ree.show_calculation_sheet') 
                    {{ Breadcrumbs::render('REE_calculation',$ol_application->id) }} @elseif($route_name=='ree_applications.custom_calculation_sheet') 
                    {{ Breadcrumbs::render('reval_calculation_sheet',$ol_application->id) }} @elseif($route_name=='ree.show_reval_calculation_sheet') 
                    {{ Breadcrumbs::render('reval_calculation_sheet',$ol_application->id) }} 
                    @elseif($route_name=='co.show_reval_calculation_sheet')
                    {{ Breadcrumbs::render('reval_co_calculation_sheet',$ol_application->id) }}@elseif($route_name=='cap.show_reval_calculation_sheet')
                    {{ Breadcrumbs::render('reval_cap_calculation_sheet',$ol_application->id) }}
                    @elseif($route_name=='vp.show_reval_calculation_sheet')
                    {{ Breadcrumbs::render('reval_vp_calculation_sheet',$ol_application->id) }}
                    @else  
                @endif
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom"
            role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#one" role="tab" aria-selected="false">
                    <i class="la la-cog"></i> परिगणनेचा तक्ता - अ
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#two" role="tab" aria-selected="false">
                    <i class="la la-briefcase"></i> Part payment
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#three" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i>1st installment
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#four" role="tab" aria-selected="false">
                    <i class="la la-cog"></i> 2nd, 3rd & 4th installment
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#five" role="tab" aria-selected="false">
                    <i class="la la-briefcase"></i>Summary
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#six" role="tab" aria-selected="false">
                    <i class="la la-briefcase"></i>Concession Sheet
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#seven" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i>REE - Note
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active show" id="one" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        परिगणनेचा तक्ता - अ
                                    </h3>
                                </div>
                            </div> 
                            <div class="m-section__content mb-0 table-responsive">
                                    <div class="d-flex justify-content-start align-items-center mb-4">
                                        <span class="flex-shrink-0 text-nowrap">Total Number of buildings:</span>
                                        <input type="text" class="form-control form-control--xs form-control--custom flex-grow-0 ml-3" placeholder="0"
                                            name="total_no_of_buildings" id="total_no_of_buildings" value="<?php if(isset($calculationSheetDetails->total_no_of_buildings)) { echo $calculationSheetDetails->total_no_of_buildings; }  ?>" readonly/>
                                    </div>
                                    <div id="print_one">
                                    <table id="one" class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("print_one");' style="max-width: 22px" class="printBtn"></a>
                                        </div>
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs" style = "border-style: ridge;">
                                                    #
                                                </th>
                                                <th style = "border-style: ridge;">
                                                    तपशील
                                                </th>
                                                <th class="table-data--md" style = "border-style: ridge;">
                                                    रक्कम रु
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style = "border-style: ridge;">1.</td>
                                                <td style = "border-style: ridge;">
                                                    कार्यकारी अभियंता यांचे सिमांकन नकाशानुसार
                                                    भूखंडाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    1. भाडेपट्टा करारनाम्यानुसार क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="total_area form-control form-control--custom txtbox" placeholder="0"
                                                        name="area_as_per_lease_agreement" id="area_as_per_lease_agreement"
                                                        value="<?php if(isset($calculationSheetDetails->area_as_per_lease_agreement)) { echo $calculationSheetDetails->area_as_per_lease_agreement; } ?>" readonly/>
                                                </td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    2. टिट बिट भूखंडाचे क्षेत्र
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="total_area form-control form-control--custom txtbox" placeholder="0"
                                                        name="area_of_tit_bit_plot" id="area_of_tit_bit_plot" value="<?php  if(isset($calculationSheetDetails->area_of_tit_bit_plot)) { echo $calculationSheetDetails->area_of_tit_bit_plot; } ?>" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    3. आर जी भूखंडाचे क्षेत्र
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="total_area form-control form-control--custom txtbox" placeholder="0"
                                                        name="area_of_rg_plot" id="area_of_rg_plot" value="<?php if(isset($calculationSheetDetails->area_of_rg_plot)) { echo $calculationSheetDetails->area_of_rg_plot; } ?>" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    4. NTBNIB भूखंडाचे क्षेत्र
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="total_area form-control form-control--custom txtbox" placeholder="0"
                                                        name="area_of_ntbnib_plot" id="area_of_ntbnib_plot" value="<?php if(isset($calculationSheetDetails->area_of_ntbnib_plot)) { echo $calculationSheetDetails->area_of_ntbnib_plot;} ?>" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td class="font-weight-bold" style = "border-style: ridge;">
                                                    Total भूखंडाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="min_val_for_calculation form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                        name="area_of_total_plot" id="area_of_total_plot" value="<?php if(isset($calculationSheetDetails->area_of_total_plot)) { echo $calculationSheetDetails->area_of_total_plot; } ?>" readonly/></td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">2.</td>
                                                <td style = "border-style: ridge;">
                                                    अभिन्यासानुसार भूखंडाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" class="min_val_for_calculation form-control form-control--custom txtbox" name="area_as_per_introduction"
                                                        id="area_as_per_introduction" value="<?php if(isset($calculationSheetDetails->area_as_per_introduction)) { echo $calculationSheetDetails->area_as_per_introduction; } ?>" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">3.</td>
                                                <td style = "border-style: ridge;">
                                                    परिगणनाकरिता ग्राह्य भूखंडाचे क्षेत्रफळ (किमान क्षेत्र)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="permissible_area total_permissible form-control form-control--custom txtbox"
                                                        name="area_of_subsistence_to_calculate" id="area_of_subsistence_to_calculate"
                                                        value="<?php if(isset($calculationSheetDetails->area_of_subsistence_to_calculate)) { echo $calculationSheetDetails->area_of_subsistence_to_calculate; }?>" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">4.</td>
                                                <td style = "border-style: ridge;">
                                                    अनुज्ञेय चटई क्षेत्र निर्देशांक
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" class="permissible_area total_permissible form-control form-control--custom txtbox"
                                                        name="permissible_carpet_area_coordinates" id="permissible_carpet_area_coordinates"
                                                        value="<?php if(isset($calculationSheetDetails->permissible_carpet_area_coordinates)) { echo $calculationSheetDetails->permissible_carpet_area_coordinates; } ?>" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">5.</td>
                                                <td style = "border-style: ridge;">
                                                    अनुज्ञेय बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="total_permissible form-control form-control--custom txtbox"
                                                        name="permissible_construction_area" id="permissible_construction_area"
                                                        value="<?php if(isset($calculationSheetDetails->permissible_construction_area)) { echo $calculationSheetDetails->permissible_construction_area;} ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">6.</td>
                                                <td style = "border-style: ridge;">
                                                    म न पा कडून प्राप्त LOI नुसार / मंजूर अभिन्यासानुसार / अनुज्ञेय प्रोरेटा क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    1. प्रति सदनिका चौ मी क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" class="proratata_area form-control form-control--custom txtbox"
                                                        name="sqm_area_per_slot" id="sqm_area_per_slot" value="<?php if(isset($calculationSheetDetails->sqm_area_per_slot)) { echo $calculationSheetDetails->sqm_area_per_slot; } ?>" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    2. एकूण सदनिका
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" class="proratata_area total_permissible form-control form-control--custom txtbox"
                                                        name="total_house" id="total_house" value="<?php if(isset($calculationSheetDetails->total_house)) { echo $calculationSheetDetails->total_house; } ?>" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td class="font-weight-bold" style = "border-style: ridge;">
                                                    Total
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" readonly class="form-control form-control--custom txtbox"
                                                        name="permissible_proratata_area" id="permissible_proratata_area"
                                                        value="<?php if(isset($calculationSheetDetails->permissible_proratata_area)) { echo $calculationSheetDetails->permissible_proratata_area; }?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">7.</td>
                                                <td style = "border-style: ridge;">
                                                    वितरणाकरीता प्रस्तावित केलेले प्रोरेटा बांधकाम क्षेत्रफळ (85% पर्यंत सीमित )
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    1. प्रति सदनिका चौ मी प्रोरेटा बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" class="total_permissible form-control form-control--custom txtbox"
                                                        name="per_sq_km_proyerta_construction_area" id="per_sq_km_proyerta_construction_area"
                                                        value="<?php if(isset($calculationSheetDetails->per_sq_km_proyerta_construction_area)) { echo $calculationSheetDetails->per_sq_km_proyerta_construction_area; } ?>" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td class="font-weight-bold" style = "border-style: ridge;">
                                                    Total
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="form-control form-control--custom txtbox"
                                                        name="proratata_construction_area" id="proratata_construction_area"
                                                        value="<?php if(isset($calculationSheetDetails->proratata_construction_area)) { echo $calculationSheetDetails->proratata_construction_area; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">8.</td>
                                                <td style = "border-style: ridge;">
                                                    मा उपाध्यक्ष / प्रा यांचे अधिकारातील १०% राखीव कोट्यामधून
                                                    संस्थेस वितरित करावयाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" class="total_permissible form-control form-control--custom txtbox"
                                                        name="area_in_reserved_seats_for_vp_pio" id="area_in_reserved_seats_for_vp_pio"
                                                        value="<?php if(isset($calculationSheetDetails->area_in_reserved_seats_for_vp_pio)) { echo $calculationSheetDetails->area_in_reserved_seats_for_vp_pio; } ?>" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">9.</td>
                                                <td style = "border-style: ridge;">
                                                    एकूण अनुज्ञेय बांधकाम क्षेत्रफळ (अ.क्र. ५ + ७ + 8)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="remaining_area form-control form-control--custom txtbox"
                                                        name="total_permissible_construction_area" id="total_permissible_construction_area"
                                                        value="<?php if(isset($calculationSheetDetails->total_permissible_construction_area)) { echo $calculationSheetDetails->total_permissible_construction_area; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">10.</td>
                                                <td style = "border-style: ridge;">
                                                    अस्तित्वातील बांधकाम क्षेत्रफळ (सी - ५७)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" class="remaining_area form-control form-control--custom txtbox"
                                                        name="existing_construction_area" id="existing_construction_area"
                                                        value="<?php if(isset($calculationSheetDetails->existing_construction_area)) { echo $calculationSheetDetails->existing_construction_area; } ?>" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">11.</td>
                                                <td style = "border-style: ridge;">
                                                    उर्वरित बांधकाम क्षेत्रफळ (अ.क्र 9. - अ.क्र.10 )
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" readonly class="form-control form-control--custom txtbox"
                                                        name="remaining_area" id="remaining_area" value="<?php if(isset($calculationSheetDetails->remaining_area)) { echo $calculationSheetDetails->remaining_area; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">12.</td>
                                                <td style = "border-style: ridge;">
                                                    रेडीरेकनर २०१८ - १९ 
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" class="redirekner_val form-control form-control--custom txtbox"
                                                        name="redirekner_value" id="redirekner_value" value="<?php if(isset($calculationSheetDetails->redirekner_value)) { echo $calculationSheetDetails->redirekner_value; } ?>" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">13.</td>
                                                <td style = "border-style: ridge;">
                                                    बांधकामाचा दर (रेडीरेकनर २०१८-१९)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" class="redirekner_val form-control form-control--custom txtbox"
                                                        name="redirekner_construction_rate" id="redirekner_construction_rate"
                                                        value="<?php if(isset($calculationSheetDetails->redirekner_construction_rate)) { echo $calculationSheetDetails->redirekner_construction_rate; } ?>" readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">14.</td>
                                                <td style = "border-style: ridge;">
                                                    LR/RC 
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" readonly class=" form-control form-control--custom txtbox"
                                                        name="redirekner_val" id="redirekner_val" value="<?php if(isset($calculationSheetDetails->redirekner_val)) { echo $calculationSheetDetails->redirekner_val; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">15.</td>
                                                <td style = "border-style: ridge;">
                                                    वि नि प्रो नियमावली नुसार २०३४ table C1 नुसारचा दर

                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                <div class="col-sm-12" style="margin-bottom: 12px;padding: 0px">
                                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input subtn" name="dcr_rate" id="dcr_rate" disabled>
                                                        <option value="" selected disabled>Select</option>
                                                        <option value="EWS" {{ isset($calculationSheetDetails->dcr_rate) && $calculationSheetDetails->dcr_rate == 'EWS' ? 'selected' : '' }}> EWS / LIG</option>
                                                        <option value="MIG" {{ isset($calculationSheetDetails->dcr_rate) && $calculationSheetDetails->dcr_rate == 'MIG' ? 'selected' : '' }}>MIG</option>
                                                        <option value="HIG" {{ isset($calculationSheetDetails->dcr_rate) && $calculationSheetDetails->dcr_rate == 'HIG' ? 'selected' : '' }}>HIG</option> 
                                                    </select>
                                                    </div>
                                                </td>
                                            </tr>    
                                            <tr>
                                                <td style = "border-style: ridge;">15.</td>
                                                <td style = "border-style: ridge;">
                                                    उर्वरितचटईक्षेत्राचे अधिमूल्य
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">1.1</td>
                                                <td style = "border-style: ridge;">
                                                <span class="label">
                                                     उर्वरित च.क्षे.रहिवासी वापर क्षेत्र </span>
                                                <input style="border: none;display: inline-block;" type="text" placeholder="0" readonly class="form-control form-control--custom txtbox"
                                                    name="remaining_residential_area" id="remaining_residential_area"
                                                    value="<?php if(isset($calculationSheetDetails->remaining_residential_area)) { echo $calculationSheetDetails->remaining_residential_area; } ?>" readonly/>
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td style = "border-style: ridge;">1.2</td>
                                                <td style = "border-style: ridge;">
                                                <span class="label"> दर </span>
                                                <input style="border: none;display: inline-block;" type="text" readonly placeholder="0" class="form-control form-control--custom txtbox"
                                                           name="calculated_dcr_rate_val" id="calculated_dcr_rate_val"
                                                           value="<?php if(isset($calculationSheetDetails->calculated_dcr_rate_val)) { echo $calculationSheetDetails->calculated_dcr_rate_val; } ?>" readonly/>
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                <span class="label">
                                                    अधिमूल्य </span>
                                                <input type="text" style="display: inline-block;" readonly placeholder="0" class="form-control form-control--custom txtbox infrastructure_charges"
                                                    name="balance_of_remaining_area" id="balance_of_remaining_area" 
                                                    value="<?php if(isset($calculationSheetDetails->balance_of_remaining_area)) { echo $calculationSheetDetails->balance_of_remaining_area; } ?>" readonly/>
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">2.1</td>
                                                <td style = "border-style: ridge;">
                                                <span class="label">
                                                    उर्वरित च.क्षे.रहिवासी वापर क्षेत्र </span>
                                                    <input style="border: none;display: inline-block;" type="text" placeholder="0" class="form-control form-control--custom txtbox"
                                                        name="remaining_commercial_area" id="remaining_commercial_area"
                                                        value="{{ isset($calculationSheetDetails->calculated_commercial_dcr_rate) ? $calculationSheetDetails->calculated_commercial_dcr_rate : '' }}"/>
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">2.2</td>
                                                <td style = "border-style: ridge;">
                                                <span class="label"> दर </span>
                                                    <input style="border: none;display: inline-block;" type="text" readonly placeholder="0" class="form-control form-control--custom txtbox"
                                                           name="calculated_commercial_dcr_rate" id="calculated_commercial_dcr_rate"
                                                           value="{{ isset($calculationSheetDetails->remaining_commercial_area) ? $calculationSheetDetails->remaining_commercial_area : '' }}" />
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                <span class="label"> अधिमूल्य </span>
                                                    <input style="border: none;display: inline-block;" type="text" readonly placeholder="0" class=" form-control form-control--custom txtbox"
                                                        name="balance_of_commercial_remaining_area" id="balance_of_commercial_remaining_area"
                                                        value="{{ isset($calculationSheetDetails->balance_of_commercial_remaining_area) ? $calculationSheetDetails->balance_of_commercial_remaining_area : '' }}"/>
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                </td>
                                            </tr>

                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    Total
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="form-control form-control--custom txtbox total_amount"
                                                        name="total_premium_amount" id="total_premium_amount"
                                                        value="{{ isset($calculationSheetDetails->total_premium_amount) ? $calculationSheetDetails->total_premium_amount : '' }}"/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">16.</td>
                                                <td style = "border-style: ridge;">
                                                    दि.०८.१०.२०१३ च्या अधिसूचनेमधील अनु.क्र.५ ए ,नुसार ७ % ऑफ
                                                    इन्फ्रास्टक्चर शुल्क रक्कम
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="form-control form-control--custom txtbox"
                                                        name="infrastructure_fee_amount" id="infrastructure_fee_amount"
                                                        value="<?php if(isset($calculationSheetDetails->infrastructure_fee_amount)) { echo $calculationSheetDetails->infrastructure_fee_amount; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">17.</td>
                                                <td style = "border-style: ridge;">
                                                    वजा - सुधारित वि. नि. नि. ३३(५)(२) अंतर्गत मु. मं. न. पा. कडे भारावयाची  इन्फ्रास्ट्रुक्चर शुल्क (उर्वरित चटईक्षेत्राचे अधिमूल्य * १२.५%)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="form-control form-control--custom txtbox"
                                                        name="infrastructure_charges" class="infrastructure_charges" id="infrastructure_charges"
                                                        value="<?php if(isset($calculationSheetDetails->infrastructure_charges)) { echo $calculationSheetDetails->infrastructure_charges; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">18.</td>
                                                <td style = "border-style: ridge;">
                                                    उर्वरित चटईक्षेत्राचे देय रक्कम
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="total_amount form-control form-control--custom txtbox"
                                                        name="remaining_mat_area" id="remaining_mat_area"
                                                        value="<?php if(isset($calculationSheetDetails->remaining_mat_area)) { echo $calculationSheetDetails->remaining_mat_area; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">19.</td>
                                                <td style = "border-style: ridge;">
                                                    छाननी शुल्क रु.६०००/- [for 1 building]
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="total_amount form-control form-control--custom txtbox"
                                                        name="scrutiny_fee" id="scrutiny_fee" value="<?php if(isset($calculationSheetDetails->scrutiny_fee)) { echo $calculationSheetDetails->scrutiny_fee; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">20.</td>
                                                <td style = "border-style: ridge;">
                                                    अभिन्यास मंजुरी शुल्क रु,१०००/ - प्रति गाळा
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="total_amount form-control form-control--custom txtbox"
                                                        name="layout_approval_fee" id="layout_approval_fee" value="<?php if(isset($calculationSheetDetails->layout_approval_fee)) { echo $calculationSheetDetails->layout_approval_fee; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td style = "border-style: ridge;">21.</td>
                                                <td style = "border-style: ridge;">
                                                    डेब्रिज रिमूव्हल शुल्क रु.६६००/- [for 1 building]
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                <div>
                                                    <div class="m-radio-inline subtn">
                                                        <label class="m-radio m-radio--primary">
                                                            <input type="radio" class="radioBtn debrajRadioBtn" name="is_debraj_fee_paid" value="1" disabled 
                                                            {{isset($calculationSheetDetails->is_debraj_fee_paid) &&  $calculationSheetDetails->is_debraj_fee_paid == 1 ? 'checked' : '' }} >Yes
                                                                <span></span>
                                                        </label>
                                                        <label class="m-radio m-radio--primary">
                                                            <input type="radio" class="radioBtn debrajRadioBtn" name="is_debraj_fee_paid" value="0" disabled {{isset($calculationSheetDetails->is_debraj_fee_paid) &&  $calculationSheetDetails->is_debraj_fee_paid == 0 ? 'checked' : '' }} > No
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>     
                                                <div> 
                                                <input style="border: none;" type="text" readonly placeholder="" class="total_amount form-control form-control--custom txtbox debraj_fee"
                                                    name="debraj_removal_fee" id="debraj_removal_fee" value="{{ isset($calculationSheetDetails->debraj_removal_fee) ? $calculationSheetDetails->debraj_removal_fee : '' }}" readonly/>
                                                </div>    

                                                </td>
                                            </tr> 
                                          
                                            <tr>
                                                <td style = "border-style: ridge;">22.</td>
                                                <td style = "border-style: ridge;">
                                                    पाणी वापर शुल्क (रु.१,००,०००/- ) [for 1 building]
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <div class="m-radio-inline subtn">
                                                        <label class="m-radio m-radio--primary">
                                                            <input type="radio" class="radioBtn WaterRadioBtn" name="is_water_charges_paid" value="1" disabled {{isset($calculationSheetDetails->is_water_charges_paid) &&  $calculationSheetDetails->is_water_charges_paid == 1 ? 'checked' : '' }}>Yes
                                                                <span></span>
                                                        </label>
                                                        <label class="m-radio m-radio--primary">
                                                            <input type="radio" class="radioBtn WaterRadioBtn" name="is_water_charges_paid" value="0" disabled {{isset($calculationSheetDetails->is_water_charges_paid) &&  $calculationSheetDetails->is_water_charges_paid == 0 ? 'checked' : '' }}> No
                                                            <span></span>
                                                        </label>
                                                    </div>                                                
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="form-control total_amount form-control--custom txtbox WaterCharge"
                                                        name="water_usage_charges" id="water_usage_charges" value="{{ isset($calculationSheetDetails->water_usage_charges) ? $calculationSheetDetails->water_usage_charges : '' }}" readonly/>

                                                </td>
                                            </tr>                                            
                                            <tr>
                                                <td style = "border-style: ridge;">23.</td>
                                                <td style = "border-style: ridge;">
                                                    मु. मं. ठराव क्रमांक २५४/२८१३ दि. २३/०४/२०१० अन्वये पायाभूत सुविधांशुल्काची रक्कम (प्रति चौ. मी. रुपये १०७६.४० म्हणजेच रुपये १००/- प्रति चौ. फूट)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="form-control total_amount form-control--custom txtbox"
                                                        name="basic_infrastructure_amount" id="basic_infrastructure_amount" value="<?php if(isset($calculationSheetDetails->basic_infrastructure_amount)) { echo $calculationSheetDetails->basic_infrastructure_amount; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">24.</td>
                                                <td style = "border-style: ridge;">
                                                    प्रा. ठराव क्र ६२६० दि. ०४.०६.२००७ व ठराव क्र. ६३४९ दि. २५.११.२००८ अन्वये आर. जी. स्थलांतरणाकरिता दर रु. ५,५३०/- (१० टक्के रे. रे. सन २०१७-१८ रु. ५५३००/- प्रति चौ. मी. ) (१५८४. ४१ चौ. मी. X ५५३०)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    1. आर. जी. स्थलांतरणाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input type="text" placeholder="0" class="form-control form-control--custom txtbox"
                                                           name="area_of_rg_to_be_relocated" id="area_of_rg_to_be_relocated" value="<?php if(isset($calculationSheetDetails->area_of_rg_to_be_relocated)) { echo $calculationSheetDetails->area_of_rg_to_be_relocated; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    Total
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="total_amount form-control form-control--custom txtbox"
                                                           name="total_area_of_rg_to_be_relocated" id="total_area_of_rg_to_be_relocated"
                                                           value="<?php if(isset($calculationSheetDetails->total_area_of_rg_to_be_relocated)) { echo $calculationSheetDetails->total_area_of_rg_to_be_relocated; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">25.</td>
                                                <td style = "border-style: ridge;">
                                                    भुईभाड्याचे भांडवलीकरणे वार्षिक २.५ टक्के
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="total_amount form-control form-control--custom txtbox"
                                                           name="groundrent_capitalization_yearly" id="groundrent_capitalization_yearly" value="<?php if(isset($calculationSheetDetails->groundrent_capitalization_yearly)) { echo $calculationSheetDetails->groundrent_capitalization_yearly; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">26.</td>
                                                <td style = "border-style: ridge;">
                                                    आगाऊ भुईभाडे (प्रति वर्ष ८ टक्के दराने)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="total_amount form-control form-control--custom txtbox"
                                                           name="advance_groundrent_per_year" id="advance_groundrent_per_year" value="<?php if(isset($calculationSheetDetails->advance_groundrent_per_year)) { echo $calculationSheetDetails->advance_groundrent_per_year; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">27.</td>
                                                <td style = "border-style: ridge;">
                                                    नाममात्र भुईभाडे (Rs. 1 per year)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" class="total_amount form-control form-control--custom txtbox"
                                                           name="nominal_groundrent" id="nominal_groundrent" value="<?php if(isset($calculationSheetDetails->nominal_groundrent)) { echo $calculationSheetDetails->nominal_groundrent; } ?>" readonly/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">28.</td>
                                                <td style = "border-style: ridge;">
                                                    एकूण रक्कम रुपये (अ .क्र. 18+19+20+21+22+23+24(total)+25+26+27)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="form-control form-control--custom txtbox"
                                                        name="total_amount_in_rs" id="total_amount_in_rs" value="<?php if(isset($calculationSheetDetails->total_amount_in_rs)) { echo $calculationSheetDetails->total_amount_in_rs; } ?>" readonly/>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="two" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        अधिमूल्य रकमेचा चार सामान हफ्त्यांत भरणा करण्याबाबतचा प्रस्ताव
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                            src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("two");'
                                            style="max-width: 22px" class="printBtn"></a>
                                </div>
                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                    <thead class="thead-default">
                                        <tr>
                                            <th class="table-data--xs" style = "border-style: ridge;">
                                                #
                                            </th>
                                            <th style = "border-style: ridge;">
                                                तपशील
                                            </th>
                                            <th class="table-data--md" style = "border-style: ridge;">
                                                रक्कम रु
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style = "border-style: ridge;">1.</td>
                                            <td style = "border-style: ridge;">
                                                उर्वरितचटई क्षेत्राचे अधिमूल्य
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;"></td>
                                            <td style = "border-style: ridge;">
                                                उर्वरितच क्षे निरहिवासी वापर क्षेत्र
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" type="text" placeholder="0" readonly class="form-control form-control--custom txtbox" name="remaining_residential_area"
                                                    id="remaining_residential_area" value="<?php if(isset($calculationSheetDetails->remaining_residential_area)) { echo $calculationSheetDetails->remaining_residential_area;} ?>" readonly/>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;"></td>
                                            <td style = "border-style: ridge;">
                                                दर रु
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" type="text" readonly placeholder="0" class="form-control form-control--custom txtbox" name="calculated_dcr_rate_val"
                                                    id="calculated_dcr_rate_val" value="<?php if(isset($calculationSheetDetails->calculated_dcr_rate_val)) { echo  $calculationSheetDetails->calculated_dcr_rate_val; } ?>" readonly/>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;"></td>
                                            <td style = "border-style: ridge;">
                                                अधिमूल्य
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" type="text" readonly placeholder="0" class="form-control form-control--custom txtbox" name="remaining_area_of_resident_area_balance"
                                                    id="remaining_area_of_resident_area_balance" value="<?php if(isset($calculationSheetDetails->balance_of_remaining_area)) { echo $calculationSheetDetails->balance_of_remaining_area; } ?>" readonly/>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">2.</td>
                                            <td style = "border-style: ridge;">
                                                दि ०८.१०.२०१३ च्या अधिसूचने मधील अनु क्र ५या, नुसार ७% ऑफ
                                                साईट इन्फ्रास्ट्रुक्चर शुल्क - { (रे रे दर [table pt 11] *
                                                ७% ) } * { (३.० च क्षे नि प्रमाणे + प्रोरातक्षेत्रफ़ळ,
                                                [table 1 pt 8]) - (अस्तित्वातील बांधकाम क्षेत्रफळ [table 1
                                                pt 9]) }
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" type="text" readonly placeholder="0" class="form-control form-control--custom txtbox" name="off_site_infrastructure_fee"
                                                    id="off_site_infrastructure_fee" value="<?php if(isset($calculationSheetDetails->infrastructure_fee_amount)) { echo $calculationSheetDetails->infrastructure_fee_amount; } ?>" readonly/>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">3.</td>
                                            <td style = "border-style: ridge;">
                                                वजा - सुधारित वि. नि. नि. ३३(५)(२) अंतर्गत मु. मं. न. पा. कडे भारावयाची इन्फ्रास्ट्रुक्चर शुल्क (उर्वरित चटईक्षेत्राचे अधिमूल्य * १२.५%)
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" type="text" readonly placeholder="0" class="form-control form-control--custom txtbox"
                                                    name="infrastructure_charges" id="amount_to_be_paid_to_municipal1" readonly/ value="<?php if(isset($calculationSheetDetails->infrastructure_charges)) { echo $calculationSheetDetails->infrastructure_charges; } ?>">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">4.</td>
                                            <td style = "border-style: ridge;">
                                                उर्वरित चटईक्षेत्राचे देय रक्कम
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" type="text" readonly class="form-control form-control--custom txtbox" placeholder="0"
                                                    name="offsite_infrastructure_charge_to_mhada1" id="offsite_infrastructure_charge_to_mhada1" readonly value="<?php if(isset($calculationSheetDetails->remaining_mat_area)) { echo $calculationSheetDetails->remaining_mat_area; } ?>"/>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5.</td>
                                            <td class="font-weight-bold">
                                                १/४ अधिमूल्यापोटी शुल्क
                                            </td>
                                            <td class="text-center">
                                                <input style="border: none;" type="text" readonly class="form-control form-control--custom txtbox" placeholder="0"
                                                    name="non_profit_duty" id="non_profit_duty" readonly value="<?php if(isset($calculationSheetDetails->non_profit_duty)) { echo $calculationSheetDetails->non_profit_duty; } ?>"/>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="three" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        पहिल्या हप्त्याची रक्कम
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                            src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("three");'
                                            style="max-width: 22px" class="printBtn"></a>
                                </div>
                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">

                                    <thead class="thead-default">
                                        <tr>
                                            <th class="table-data--xs" style = "border-style: ridge;">
                                                #
                                            </th>
                                            <th style = "border-style: ridge;">
                                                तपशील
                                            </th>
                                            <th class="table-data--md" style = "border-style: ridge;">
                                                रक्कम रु
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style = "border-style: ridge;">1.</td>
                                            <td style = "border-style: ridge;">
                                                १/४ अधिमूल्यापोटी शुल्क (उर्वरितचटईक्षेत्राचे अधिमूल्य च्या
                                                १/४)
                                            </td> 
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input type="text" style="border: none;" readonly class="first_installment form-control form-control--custom txtbox" placeholder="0" readonly value="<?php if(isset($calculationSheetDetails->non_profit_duty)) { echo $calculationSheetDetails->non_profit_duty; } ?>"/>

                                            </td>
                                        </tr>
<!--                                         <tr>
                                            <td style = "border-style: ridge;">2.</td>
                                            <td style = "border-style: ridge;">
                                                म्हाडा कडे भरावयाची ऑफ साईट इन्फ्रास्ट्रुक्चर शुल्क रक्कम
                                                (२/७ * ऑफ साईट इन्फ्रास्ट्रुक्चर शुल्क)
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">

                                                <input type="text" style="border: none;" readonly placeholder="0" class="first_installment form-control form-control--custom txtbox"
                                                    name="offsite_infrastructure_charge_to_mhada1_installment" id="offsite_infrastructure_charge_to_mhada1_installment" readonly/>

                                            </td>
                                        </tr> -->
                                        <tr>
                                            <td style = "border-style: ridge;">2.</td>
                                            <td style = "border-style: ridge;">
                                                छाननी शुल्क
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input type="text" style="border: none;" readonly class="first_installment  form-control form-control--custom txtbox" placeholder="0"
                                                    name="scrutiny_fee" id="scrutiny_fee" value="<?php if(isset($calculationSheetDetails->scrutiny_fee)) { echo $calculationSheetDetails->scrutiny_fee; } ?>" readonly>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">3.</td>
                                            <td style = "border-style: ridge;">
                                                अभिन्यास मंजुरी शुल्क रु १,०००/- प्रति गळा
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input type="text" style="border: none;" readonly class="first_installment  form-control form-control--custom txtbox" placeholder="0"
                                                    name="layout_approval_fee" id="layout_approval_fee" value="<?php if(isset($calculationSheetDetails->layout_approval_fee)) { echo $calculationSheetDetails->layout_approval_fee; } ?>" readonly/>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">4.</td>
                                            <td style = "border-style: ridge;">
                                                डेब्रिज रिमूव्हल शुल्क रु ६६०० /-
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                           
                                                <input type="text" style="border: none;" readonly placeholder="0" class="first_installment  form-control form-control--custom txtbox"
                                                    name="debraj_removal_fee" id="debraj_removal" value="<?php if(isset($calculationSheetDetails->debraj_removal_fee)) { echo $calculationSheetDetails->debraj_removal_fee; } ?>" readonly/>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">5.</td>
                                            <td style = "border-style: ridge;">
                                                पाणी वापर शुल्क (रु १,००,०००/-)
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input type="text" style="border: none;" readonly placeholder="0" class="first_installment form-control form-control--custom txtbox"
                                                    name="water_usage_charges" id="water_usage_charges" value="<?php if(isset($calculationSheetDetails->water_usage_charges)) { echo $calculationSheetDetails->water_usage_charges; } ?>" readonly/>

                                            </td>
                                        </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">6.</td>
                                                <td style = "border-style: ridge;">
                                                    मु. मं. ठराव क्रमांक २५४/२८१३ दि. २३/०४/२०१० अन्वये पायाभूत सुविधांशुल्काची रक्कम (प्रति चौ. मी. रुपये १०७६.४० म्हणजेच रुपये १००/- प्रति चौ. फूट)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input type="text" style="border: none;" readonly placeholder="0" class="first_installment form-control form-control--custom txtbox"
                                                        name="basic_infrastructure_amount" id="basic_infrastructure_amount" value="<?php if(isset($calculationSheetDetails->basic_infrastructure_amount)) { echo $calculationSheetDetails->basic_infrastructure_amount; } ?>" />

                                                </td>
                                            </tr>                                        
                                        <tr>
                                            <td style = "border-style: ridge;">7.</td>
                                            <td style = "border-style: ridge;">
                                                प्रा. ठराव क्र ६२६० दि. ०४.०६.२००७ व ठराव क्र. ६३४९ दि. २५.११.२००८ अन्वये आर. जी. स्थलांतरणाकरिता दर रु. ५,५३०/- (१० टक्के रे. रे. सन २०१७-१८ रु. ५५३००/- प्रति चौ. मी. ) (१५८४. ४१ चौ. मी. X ५५३०)
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;"></td>
                                            <td style = "border-style: ridge;">
                                                1. आर. जी. स्थलांतरणाचे क्षेत्रफळ
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input type="text" style="border: none;" readonly placeholder="0" class="form-control form-control--custom txtbox"
                                                       name="area_of_rg_to_be_relocated" id="area_of_rg_to_be_relocated" value="<?php if(isset($calculationSheetDetails->area_of_rg_to_be_relocated)) { echo $calculationSheetDetails->area_of_rg_to_be_relocated; } ?>" readonly/>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;"></td>
                                            <td style = "border-style: ridge;">
                                                Total
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input type="text" style="border: none;" readonly placeholder="0" class="first_installment form-control form-control--custom txtbox"
                                                       name="total_area_of_rg_to_be_relocated" id="total_area_of_rg_to_be_relocated"
                                                       value="<?php if(isset($calculationSheetDetails->total_area_of_rg_to_be_relocated)) { echo $calculationSheetDetails->total_area_of_rg_to_be_relocated; } ?>" readonly/>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">8.</td>
                                            <td style = "border-style: ridge;">
                                                भुईभाड्याचे भांडवलीकरणे वार्षिक २.५ टक्के
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input type="text" style="border: none;" readonly placeholder="0" class="first_installment form-control form-control--custom txtbox"
                                                       name="groundrent_capitalization_yearly" id="groundrent_capitalization_yearly" value="<?php if(isset($calculationSheetDetails->groundrent_capitalization_yearly)) { echo $calculationSheetDetails->groundrent_capitalization_yearly; } ?>" readonly/>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">9.</td>
                                            <td style = "border-style: ridge;">
                                                आगाऊ भुईभाडे (प्रति वर्ष ८ टक्के दराने)
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input type="text" style="border: none;" readonly placeholder="0" class="first_installment form-control form-control--custom txtbox"
                                                       name="advance_groundrent_per_year" id="advance_groundrent_per_year" value="<?php if(isset($calculationSheetDetails->advance_groundrent_per_year)) { echo $calculationSheetDetails->advance_groundrent_per_year; } ?>" readonly/>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">10.</td>
                                            <td style = "border-style: ridge;">
                                                नाममात्र भुईभाडे (Rs. 1 per year)
                                            </td> 
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input type="text" style="border: none;" readonly placeholder="0" class="first_installment form-control form-control--custom txtbox"
                                                       name="nominal_groundrent" id="nominal_groundrent" value="<?php if(isset($calculationSheetDetails->nominal_groundrent)) { echo $calculationSheetDetails->nominal_groundrent; } ?>" readonly/>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">11.</td>
                                            <td class="font-weight-bold" style = "border-style: ridge;">
                                                एकूण मंडळाकडे भरणा करावयाची पहिल्या हप्त्याची रक्कम
                                                पूर्णांकामधे
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input type="text" style="border: none;" readonly class="form-control txtbox form-control--custom" placeholder="0"
                                                    name="payment_of_first_installment" id="payment_of_first_installment"
                                                    value="<?php  if(isset($calculationSheetDetails->payment_of_first_installment)) { echo $calculationSheetDetails->payment_of_first_installment; } ?>" readonly/>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="four" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        दुसऱ्या, तिसऱ्या आणि चौथ्या हप्त्याची रक्कम
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                            src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("four");'
                                            style="max-width: 22px" class="printBtn"></a>
                                </div>
                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                    <thead class="thead-default">
                                        <tr>
                                            <th class="table-data--xs" style = "border-style: ridge;">
                                                #
                                            </th>
                                            <th style = "border-style: ridge;">
                                                तपशील
                                            </th>
                                            <th class="table-data--md" style = "border-style: ridge;">
                                                रक्कम रु
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style = "border-style: ridge;">1.</td>
                                            <td style = "border-style: ridge;">
                                                १/४ अधिमूल्यापोटी शुल्क<span class="hint-text"><small>(उर्वरितचटईक्षेत्राचे
                                                        अधिमूल्य च्या १/४)</small></span>
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input type="text" style="border: none;" readonly class="form-control form-control--custom txtbox" placeholder="0"
                                                    name="non_profit_duty_val" id="non_profit_duty_val"
                                                    readonly value="<?php if(isset($calculationSheetDetails->non_profit_duty)) { echo $calculationSheetDetails->non_profit_duty; } ?>"/>


                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">2.</td>
                                            <td style = "border-style: ridge;">
                                                मंडळाकडे भरणा करावयाच्या दुसऱ्या, तिसऱ्या व चौथ्या
                                                हफ्त्याची रक्कम पूर्णांकामध्ये
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input type="text" style="border: none;" readonly class="form-control form-control--custom txtbox" placeholder="0"
                                                    name="payment_of_remaining_installment" id="payment_of_remaining_installment"
                                                    value="<?php if(isset($calculationSheetDetails->payment_of_remaining_installment)) { echo $calculationSheetDetails->payment_of_remaining_installment; } ?>" readonly/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- summary -->
            <div class="tab-pane" id="five" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        अधिमूल्य रकमेचा चार सामान हफ्त्यांत भरणा करण्याबाबतचा प्रस्ताव
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                            src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("five");' style="max-width: 22px" class="printBtn"></a>
                                </div>
                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                    <thead class="thead-default">
                                        <tr>
                                            <th class="table-data--xs" style = "border-style: ridge;">
                                                #
                                            </th>
                                            <th style = "border-style: ridge;">
                                                तपशील
                                            </th>
                                            <th class="table-data--md" style = "border-style: ridge;">
                                                रक्कम रु
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style = "border-style: ridge;">1.</td>
                                            <td>
                                                मंडळाकडे देकारपत्र जरी केल्याच्या दिनांकापासून पहिल्या सहा
                                                महिन्या पर्यंत भरणा करावयाची पहिल्या हफ्त्याची रक्कम
                                            </td>
                                            <td class="text-center">
                                                {{ isset($calculationSheetDetails->payment_of_first_installment) ?
                                                $calculationSheetDetails->payment_of_first_installment : 0 }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">2.</td>
                                            <td style = "border-style: ridge;">
                                                मंडळाकडे पहिले देकारपत्र जारी केल्याच्या दिनांकापासून एक
                                                वर्षाच्या आत, भरणा करावयाची दुसऱ्या हफ्त्याची रक्कम तसेच
                                                प्रत्यक्ष भरेपर्यंत प्रथम देकारपात्राच्या दिनांकापासून १२%
                                                (दार तिमाहीला परिगणनीय दराने) अधिक रकमेचा भरणा करावा लागेल
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                {{ isset($calculationSheetDetails->payment_of_remaining_installment)
                                                ? $calculationSheetDetails->payment_of_remaining_installment : 0 }}
                                                + interest

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">3.</td>
                                            <td style = "border-style: ridge;">
                                                मंडळाकडे पहिले देकारपत्र जारी केल्याच्या दिनांकापासून दोन
                                                वर्षाच्या आत, भरणा करावयाची तीसऱ्या हफ्त्याची रक्कम तसेच
                                                प्रत्यक्ष भरेपर्यंत प्रथम देकारपात्राच्या दिनांकापासून १२%
                                                (दर तिमाहीला परिगणनीय दराने) अधिक रकमेचा भरणा करावा लागेल
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                {{ isset($calculationSheetDetails->payment_of_remaining_installment)
                                                ? $calculationSheetDetails->payment_of_remaining_installment : 0 }}
                                                + interest

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">4.</td>
                                            <td style = "border-style: ridge;">
                                                मंडळाकडे पहिले देकारपत्र जारी केल्याच्या दिनांकापासून तीन
                                                वर्षाच्या आत, भरणा करावयाची चौथ्या हफ्त्याची रक्कम तसेच
                                                प्रत्यक्ष भरेपर्यंत प्रथम देकारपात्राच्या दिनांकापासून १२%
                                                (दर तिमाहीला परिगणनीय दराने) अधिक रकमेचा भरणा करावा लागेल
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                {{ isset($calculationSheetDetails->payment_of_remaining_installment)
                                                ? $calculationSheetDetails->payment_of_remaining_installment : 0 }}
                                                + interest

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">5.</td>
                                            <td class="font-weight-bold" style = "border-style: ridge;">
                                                एकूण
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                @if(isset($calculationSheetDetails->payment_of_remaining_installment) || isset($calculationSheetDetails->payment_of_first_installment))

                                                  {{ (3 * (float)(str_replace( ',', '',$calculationSheetDetails->payment_of_remaining_installment)) ) + (float)(str_replace( ',', '',$calculationSheetDetails->payment_of_first_installment)) }}
                                                @else
                                                    0
                                                @endif

                                                    + Total interest
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

              <!-- consseion sheet -->
            <div class="tab-pane" id="six" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        Concession Sheet
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto">
                                    <img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("six");' style="max-width: 22px" class="printBtn"></a>
                                </div>
                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                    <thead class="thead-default">
                                        <tr>
                                            <th class="table-data--xs" style = "border-style: ridge;">
                                                Sr.no
                                            </th>
                                            <th style = "border-style: ridge;width:50%">
                                                तपशील
                                            </th>
                                            <th class="table-data--md" style = "border-style: ridge;width:50%">
                                                Remark
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style = "border-style: ridge;">1.</td>
                                            <td>
                                                Change of tenement
                                            </td>
                                            <td class="text-left">
                                                {{ isset($concessionData) ? $concessionData->tenement_charges : '' }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">2.</td>
                                            <td style = "border-style: ridge;">
                                               R.G shiffting
                                            </td>
                                            <td class="text-left" style = "border-style: ridge;">
                                                {{ isset($concessionData) ? $concessionData->r_g_shiffting : '' }}

                                            </td>
                                        </tr>
                                        <tr>

                                            <td style = "border-style: ridge;">3.</td>
                                            <td style = "border-style: ridge;">
                                               OB/Other plot
                                            </td>
                                            <td class="text-left" style = "border-style: ridge;">
                                                {{ isset($concessionData) ? $concessionData->ob_other_plot : '' }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">4.</td>
                                            <td style = "border-style: ridge;">
                                                VP cota
                                            </td>
                                            <td class="text-left" style = "border-style: ridge;">
                                                {{ isset($concessionData) ? $concessionData->vp_cota : '' }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">5.</td>
                                            <td style = "border-style: ridge;">
                                                Encroachment on plot
                                            </td>
                                            <td class="text-left" style = "border-style: ridge;">
                                                {{ isset($concessionData) ? $concessionData->encroachment_plot : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">6.</td>
                                            <td style = "border-style: ridge;">
                                                Premium charges
                                            </td>
                                            <td class="text-left" style = "border-style: ridge;">
                                                {{ isset($concessionData) ? $concessionData->premium_charges : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">7.</td>
                                            <td style = "border-style: ridge;">
                                                Tit Bit land
                                            </td>
                                            <td class="text-left" style = "border-style: ridge;">
                                                {{ isset($concessionData) ? $concessionData->tit_bit_land : '' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- REE note -->
            <div class="tab-pane" id="six" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-section__content mb-0 table-responsive">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column h-100 two-cols">
                                            <h3 class="section-title section-title--small">Download REE Note</h3>
                                                <div class="mt-auto">
                                                    @if(isset($arrData['reeNote']->document_path))
                                                    <a href="{{config('commanConfig.storage_server').'/'.$arrData['reeNote']->document_path}}" target="_blank">

                                                        <button class="btn btn-primary">Download </button>
                                                    </a>
                                                    @else
                                                    <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                        * Note : REE note not available. </span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('calculation_sheet_js')
<script>
    $(document).ready(function () {

        // **Start** Save tabs location on window refresh or submit

        // Set first tab to active if user visits page for the first time

        if (localStorage.getItem("activeTab") === null) {
            document.querySelector(".nav-link.m-tabs__link").classList.add("active", "show");
        } else {
            document.querySelector(".nav-link.m-tabs__link").classList.remove("active", "show");
        }

        if (location.hash) {
            $('a[href=\'' + location.hash + '\']').tab('show');
        }
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('a[href="' + activeTab + '"]').tab('show');
        }

        $('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
            e.preventDefault()
            var tab_name = this.getAttribute('href')
            if (history.pushState) {
                history.pushState(null, null, tab_name)
            } else {
                location.hash = tab_name
            }
            localStorage.setItem('activeTab', tab_name)

            $(this).tab('show');

            localStorage.clear();
            return false;
        });

        $(window).on('popstate', function () {
            var anchor = location.hash ||
                $('a[data-toggle=\'tab\']').first().attr('href');
            $('a[href=\'' + anchor + '\']').tab('show');
            window.scrollTo(0, 0);
        });

        // // **End** Save tabs location on window refresh or submit

        $('input').on('keypress', function (event) {
            /* var regex = new RegExp("^[0-9]\d+$");
             var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
             if (!regex.test(key)) {
                 event.preventDefault();
                 return false;
             }*/

            /*  if ($(this).val().indexOf('.') > 0) {
                  var CharAfterdot = ($(this).val().length + 1) - $(this).val().indexOf('.');
                  if ( (($(this).val().length + 1) - $(this).val().indexOf('.')) > 3) {
                      event.preventDefault();
                      return false;
                  }

              }*/

            var $this = $(this);
            if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
                ((event.which < 48 || event.which > 57) &&
                    (event.which != 0 && event.which != 8))) {
                event.preventDefault();
            }

            var text = $(this).val();
            if ((event.which == 46) && (text.indexOf('.') == -1)) {
                setTimeout(function() {
                    if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                        $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
                    }
                }, 1);
            }

            if ((text.indexOf('.') != -1) &&
                (text.substring(text.indexOf('.')).length > 2) &&
                (event.which != 0 && event.which != 8) &&
                ($(this)[0].selectionStart >= text.length - 2)) {
                event.preventDefault();
            }

            // ============================== format no with comma

            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;

            // format number
            $(this).val(function(index, value) {

                return numberWithCommas(value);

            });
        });
    })

</script>
<script>
    function PrintElem(elem) {
        
        $(".txtbox").css("width","200px");
        $(".subtn").css("display","none");
        $(".printBtn").css("display","none");
        var printable = document.getElementById(elem).innerHTML;

       var mywindow = window.open('', 'PRINT', 'height=400,width=600');

        mywindow.document.write('<html><head><title>Maharashtra Housing and development authority</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(printable);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus();

        mywindow.print();
        mywindow.close();
        $(".subtn").css("display","block");
        $(".printBtn").css("display","block");

        return true;
    }    
</script>
@endsection
