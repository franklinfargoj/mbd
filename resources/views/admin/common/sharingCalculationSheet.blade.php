@php
    $route_name=\Request::route()->getName();
@endphp

@extends('admin.layouts.sidebarAction')
@section('actions')
    @if($route_name=='ree.show_reval_calculation_sheet' || $route_name=='co.show_reval_calculation_sheet' || $route_name=='cap.show_reval_calculation_sheet' || $route_name=='vp.show_reval_calculation_sheet' )
        @include('admin.'.$ol_application->folder.'.reval_action',compact('ol_application'))
    @else
        @include('admin.'.$ol_application->folder.'.action',compact('ol_application'))
    @endif
@endsection
@section('content')

<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Calculation Sheet </h3>
                @if($route_name=='co.show_calculation_sheet')
                {{ Breadcrumbs::render('calculation_sheet_co',$ol_application->id) }}
                @elseif($route_name=='vp.show_calculation_sheet')
                {{ Breadcrumbs::render('calculation_sheet_vp',$ol_application->id) }}
                @elseif($route_name=='cap.show_calculation_sheet')
                {{ Breadcrumbs::render('calculation_sheet_cap',$ol_application->id) }}
                @elseif($route_name=='ree.show_calculation_sheet')
                {{ Breadcrumbs::render('REE_calculation',$ol_application->id) }}
                @elseif($route_name=='ree.show_reval_calculation_sheet')
                {{ Breadcrumbs::render('reval_calculation_sheet',$ol_application->id) }}
                @elseif($route_name=='cap.show_reval_calculation_sheet')
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

        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#one" role="tab" aria-selected="false">
                    <i class="la la-cog"></i> Table A
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#two" role="tab" aria-selected="false">
                    <i class="la la-briefcase"></i> Table B
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#three" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i>Table C
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#four" role="tab" aria-selected="false">
                    <i class="la la-cog"></i> Other Charges Table D
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#five" role="tab" aria-selected="true">
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
                                    <h3 class="section-title">तक्ता - अ</h3>
                                </div>
                            </div>
                            <div id="one" class="m-section__content mb-0 table-responsive">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("one");'
                                                style="max-width: 22px" class="printBtn"></a>
                                    </div>
                                <div class="d-flex justify-content-start align-items-center mb-4">
                                    <span class="flex-shrink-0 text-nowrap">Total Number of buildings:</span>
                                    <input type="text" readonly class="form-control form-control--xs form-control--custom flex-grow-0 ml-3" placeholder="0"
                                           name="total_no_of_buildings" id="total_no_of_buildings" value="<?php if(isset($calculationSheetDetails[0]->total_no_of_buildings)) { echo $calculationSheetDetails[0]->total_no_of_buildings; } else { echo '1'; } ?>" />
                                </div>
                                    <table class="table mb-0" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs" style = "border-style: ridge;">
                                                    #
                                                </th>
                                                <th style = "border-style: ridge;width:30px"> तपशील </th>
                                                <th class="table-data--md" style = "border-style: ridge;"> रक्कम रु
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td style = "border-style: ridge;">1.</td>
                                            <td style = "border-style: ridge;">
                                                कार्यकारी अभियंता /कुर्ला विभाग यांचे सिमांकन नकाशानुसार भूखंडाचे
                                                क्षेत्रफळ
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
                                                <input style="border: none;" type="text" placeholder="0" class="total_area form-control form-control--custom"
                                                       name="area_as_per_lease_agreement" id="area_as_per_lease_agreement"
                                                   readonly    value="<?php if(isset($calculationSheetDetails[0]->area_as_per_lease_agreement) ) { echo $calculationSheetDetails[0]->area_as_per_lease_agreement; }  ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;"></td>
                                            <td style = "border-style: ridge;">
                                                2. टिट बिट भूखंडाचे क्षेत्र
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" type="text" placeholder="0" class="total_area form-control form-control--custom"
                                                       readonly  name="area_of_tit_bit_plot" id="area_of_tit_bit_plot" value="<?php if(isset($calculationSheetDetails[0]->area_of_tit_bit_plot)) { echo $calculationSheetDetails[0]->area_of_tit_bit_plot; } ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;"></td>
                                            <td class="font-weight-bold" style = "border-style: ridge;">
                                                Total भूखंडाचे क्षेत्रफळ
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" placeholder="0" class="min_val_for_calculation form-control form-control--custom"
                                                       readonly type="text" name="area_of_total_plot" id="area_of_total_plot"
                                                       value="<?php if(isset($calculationSheetDetails[0]->area_of_total_plot)) { echo $calculationSheetDetails[0]->area_of_total_plot; } ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">2.</td>
                                            <td style = "border-style: ridge;">
                                                अभिन्यासानुसार भूखंडाचे क्षेत्रफळ
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
                                                <input style="border: none;" type="text" placeholder="0" class="abhinyas_total_area  form-control form-control--custom"
                                                       name="abhinyas_area_as_per_lease_agreement" id="abhinyas_area_as_per_lease_agreement"
                                                       readonly  value="<?php if(isset($calculationSheetDetails[0]->abhinyas_area_as_per_lease_agreement)) { echo $calculationSheetDetails[0]->abhinyas_area_as_per_lease_agreement; } ?>"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;"></td>
                                            <td style = "border-style: ridge;">
                                                2. टिट बिट भूखंडाचे क्षेत्र
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" type="text" placeholder="0" class="abhinyas_total_area form-control form-control--custom"
                                                       name="abhinyas_area_of_tit_bit_plot" id="abhinyas_area_of_tit_bit_plot"
                                                       readonly  value="<?php if(isset($calculationSheetDetails[0]->abhinyas_area_of_tit_bit_plot)) { echo $calculationSheetDetails[0]->abhinyas_area_of_tit_bit_plot; } ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;"></td>
                                            <td class="font-weight-bold" style = "border-style: ridge;">
                                                Total भूखंडाचे क्षेत्रफळ
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" class="min_val_for_calculation form-control form-control--custom" placeholder="0"
                                                       readonly type="text" name="abhinyas_area_of_total_plot" id="abhinyas_area_of_total_plot"
                                                       value="<?php if(isset($calculationSheetDetails[0]->abhinyas_area_of_total_plot)) { echo $calculationSheetDetails[0]->abhinyas_area_of_total_plot; } ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">3.</td>
                                            <td style = "border-style: ridge;">
                                                परिगणनाकरिता ग्राह्य भूखंडाचे क्षेत्रफळ (किमान क्षेत्र)
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" readonly class="infra_fee form-control form-control--custom" placeholder="0"
                                                       type="text" name="area_of_​​subsistence_to_calculate" id="area_of_​​subsistence_to_calculate"
                                                       value="<?php if(isset($calculationSheetDetails[0]->area_of_​​subsistence_to_calculate)) { echo $calculationSheetDetails[0]->area_of_​​subsistence_to_calculate; } ?>" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">4.</td>
                                            <td style = "border-style: ridge;">
                                                अनुज्ञेय चटई क्षेत्र निर्देशांक
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" class="remaining_area infra_fee form-control form-control--custom" placeholder="0"
                                                       type="text" name="permissible_carpet_area_coordinates" id="permissible_carpet_area_coordinates"
                                                       readonly     value="<?php if(isset($calculationSheetDetails[0]->permissible_carpet_area_coordinates)) { echo $calculationSheetDetails[0]->permissible_carpet_area_coordinates; } ?>" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">5.</td>
                                            <td style = "border-style: ridge;">
                                                अनुज्ञेय बांधकाम क्षेत्रफळ
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" class="form-control form-control--custom" readonly type="text" placeholder="0"
                                                       name="permissible_construction_area" id="permissible_construction_area"
                                                       value="<?php if(isset($calculationSheetDetails[0]->permissible_construction_area)) { echo $calculationSheetDetails[0]->permissible_construction_area; } ?>" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">6.</td>
                                            <td style = "border-style: ridge;">
                                                म.न.पा .कडून ल. ओ. आय. पत्रानुसार अनुज्ञेय प्रोरेटा क्षेत्रफळ
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
                                                <input style="border: none;" class="remaining_area infra_fee form-control form-control--custom" placeholder="0" type="text" name="sqm_area_per_slot" id="sqm_area_per_slot"
                                                       readonly     value="<?php if(isset($calculationSheetDetails[0]->sqm_area_per_slot)) { echo $calculationSheetDetails[0]->sqm_area_per_slot; } ?>" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;"></td>
                                            <td style = "border-style: ridge;">
                                                2. एकूण सदनिका
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" class="remaining_area infra_fee form-control form-control--custom" placeholder="0"
                                                       readonly type="text" name="total_house" id="total_house" value="<?php if(isset($calculationSheetDetails[0]->total_house)) { echo $calculationSheetDetails[0]->total_house; } ?>" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;"></td>
                                            <td class="font-weight-bold" style = "border-style: ridge;">
                                                Total
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" class="remaining_area form-control form-control--custom" placeholder="0" readonly type="text" name="permissible_proratata_area" id="permissible_proratata_area"
                                                value="<?php if(isset($calculationSheetDetails[0]->permissible_proratata_area)) { echo $calculationSheetDetails[0]->permissible_proratata_area; } ?>" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">7.</td>
                                            <td style = "border-style: ridge;">
                                                एकूण अनुज्ञेय बांधकाम क्षेत्रफळ
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" class="remaining_area form-control form-control--custom" readonly type="text" placeholder="0"
                                                       name="total_permissible_construction_area" id="total_permissible_construction_area"
                                                       value="<?php if(isset($calculationSheetDetails[0]->total_permissible_construction_area)) { echo $calculationSheetDetails[0]->total_permissible_construction_area; } ?>" />

                                            </td> 
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">8.</td>
                                            <td style = "border-style: ridge;">
                                                अनुज्ञेय चटई क्षेत्रफळ प्रतिगाळा
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" class="remaining_area form-control form-control--custom" placeholder="0"
                                                       type="text" name="permissible_mattress_area" id="permissible_mattress_area"
                                                       readonly    value="<?php if(isset($calculationSheetDetails[0]->permissible_mattress_area)) { echo $calculationSheetDetails[0]->permissible_mattress_area; } ?>" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">9.</td>
                                            <td style = "border-style: ridge;">
                                                सुधारित वि नि नि ३३(५) प्रमाणे अनुज्ञेय चटई क्षेत्रफळ वर ३५%
                                                प्रतिगाळा
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" class="form-control form-control--custom" readonly type="text" placeholder="0"
                                                       name="revised_permissible_mattress_area" id="revised_permissible_mattress_area"
                                                       value="<?php if(isset($calculationSheetDetails[0]->revised_permissible_mattress_area)) { echo $calculationSheetDetails[0]->revised_permissible_mattress_area; } ?>" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">10.</td>
                                            <td style = "border-style: ridge;">
                                                सुधारित वि नि नि ३३(५) दि ३.७.२०१७ रोजीच्या फ्रबदलाच्या अधिसूचने
                                                नुसार निवासी वापर करिता वाढीव क्षेत्रफळ ३५% मिळून किमान ३५ चौमी
                                                अनुज्ञेय आहे. त्यामुळे अ क्र ७ मधील क्षेत्रफळ कमी असल्याने ३५ चौ मी
                                                गृहीत धरण्यात येत आहे
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" class="remaining_area form-control form-control--custom" placeholder="0"
                                                       type="text" name="revised_increased_area_for_residential_use"
                                                       readonly  id="revised_increased_area_for_residential_use" value="<?php if(isset($calculationSheetDetails[0]->revised_increased_area_for_residential_use)) { echo $calculationSheetDetails[0]->revised_increased_area_for_residential_use; } ?>" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">11.</td>
                                            <td style = "border-style: ridge;">
                                                एकूण पुनर्वसन चटई क्षेत्रफळ
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" class="form-control form-control--custom" readonly type="text" placeholder="0"
                                                       name="total_rehabilitation_mattress_area" id="total_rehabilitation_mattress_area"
                                                       value="<?php if(isset($calculationSheetDetails[0]->total_rehabilitation_mattress_area)) { echo $calculationSheetDetails[0]->total_rehabilitation_mattress_area; } ?>" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">12.</td>
                                            <td style = "border-style: ridge;">
                                                सादर प्रकरणामध्ये भूखंड हा ४००० चौ मी पेक्षा कमी असल्याने DCR टेबल
                                                अ नुसार अतिरिक्त हक्क
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                    <span style="cursor: pointer" data-toggle="modal" data-target="#dcr-a-modal">
                                                        DCR A
                                                    </span>
                                            </td>
                                        </tr>
                                        <!--<tr>
                                                <td></td>
                                                <td>
                                                    1. प्रति सदनिका चौ मी प्रोरेटा बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom"  type="text"
                                                           name="per_sq_km_proyerta_construction_area" id="per_sq_km_proyerta_construction_area" value="{{ isset($calculationSheetDetails[0]->per_sq_km_proyerta_construction_area) ? $calculationSheetDetails[0]->per_sq_km_proyerta_construction_area : 0 }}"/>

                                                </td>
                                            </tr>-->
                                        <tr>
                                            <td style = "border-style: ridge;"></td>
                                            <td style = "border-style: ridge;">
                                                Total
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" readonly class="form-control form-control--custom" type="text" placeholder="0"
                                                       name="total_additional_claims" id="total_additional_claims"
                                                       readonly    value="<?php if(isset($calculationSheetDetails[0]->total_additional_claims)) { echo $calculationSheetDetails[0]->total_additional_claims; } ?>" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">13.</td>
                                            <td style = "border-style: ridge;">
                                                एकूण पुनर्वसन चटई क्षेत्र फळ

                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" class="form-control form-control--custom" readonly type="text" placeholder="0"
                                                       name="total_rehabilitation_mattress_area_with_dcr" id="total_rehabilitation_mattress_area_with_dcr"
                                                       value="<?php  if(isset($calculationSheetDetails[0]->total_rehabilitation_mattress_area)) { echo $calculationSheetDetails[0]->total_rehabilitation_mattress_area; } ?>" />

                                            </td>
                                        </tr>

                                        <tr>
                                            <td style = "border-style: ridge;">14.</td>
                                            <td style = "border-style: ridge;">
                                                एकूण पुनर्वसन बांधकाम क्षेत्रफळ
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" class="remaining_area form-control form-control--custom" placeholder="0"
                                                       readonly type="text" name="total_rehabilitation_construction_area"
                                                       id="total_rehabilitation_construction_area" value="<?php if(isset($calculationSheetDetails[0]->total_rehabilitation_construction_area)) { echo $calculationSheetDetails[0]->total_rehabilitation_construction_area; } ?>" />

                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
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
                                    <h3 class="section-title">Table B</h3>
                                </div>
                            </div>
                            <div id="two" class="m-section__content mb-0 table-responsive">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("two");'
                                                style="max-width: 22px" class="printBtn"></a>
                                    </div>
                                    <table class="table mb-0" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs" style = "border-style: ridge;">
                                                    #
                                                </th>
                                                <th style = "border-style: ridge;width:30px">
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
                                                    LR
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input class="infra_fee form-control form-control--custom" type="text" name="lr_val" id="lr_val" value="{{ isset($calculationSheetDetails[0]->lr_val) ? $calculationSheetDetails[0]->lr_val : 0 }}"
                                                        readonly />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">2.</td>
                                                <td style = "border-style: ridge;">
                                                    RC
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom" type="text" name="rc_val"
                                                        id="rc_val" value="{{ isset($calculationSheetDetails[0]->rc_val) ? $calculationSheetDetails[0]->rc_val : 0 }}"
                                                        readonly />

                                                </td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">3.</td>
                                                <td style = "border-style: ridge;">
                                                    LC/RC
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom" readonly type="text"
                                                        name="lr_rc_division_val" id="lr_rc_division_val" value="{{ isset($calculationSheetDetails[0]->lr_rc_division_val) ? $calculationSheetDetails[0]->lr_rc_division_val : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">4.</td> 
                                                <td style = "border-style: ridge;">
                                                    सुधारित वि नि नि ३३(५) मधील तक्त्या नुसार LC/RC करिता प्रोत्साहन
                                                    क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom" readonly type="text"
                                                        name="dcr_b_val" id="dcr_b_val" value="{{ isset($calculationSheetDetails[0]->dcr_b_val) ? $calculationSheetDetails[0]->dcr_b_val.'%' : '0%' }}" />

                                                    <!-- data-target="#dcr-b-modal" -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">5.</td>
                                                <td style = "border-style: ridge;">
                                                    बांधकाम क्षेत्रफलकरीता प्रोत्साहन चटई क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom" readonly type="text"
                                                        name="mattress_area_for_construction_area" id="mattress_area_for_construction_area"
                                                        value="{{ isset($calculationSheetDetails[0]->mattress_area_for_construction_area) ? $calculationSheetDetails[0]->mattress_area_for_construction_area : 0 }}" />

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
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
                                    <h3 class="section-title">Table C</h3>
                                </div>
                            </div>
                            <div id="three" class="m-section__content mb-0 table-responsive">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("three");'
                                                style="max-width: 22px" class="printBtn"></a>
                                    </div>
                                    <table class="table mb-0" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs" style = "border-style: ridge;">
                                                    #
                                                </th>
                                                <th style = "border-style: ridge;width:30px">
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
                                                    उर्वरित क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input  class="form-control form-control--custom" readonly type="text" name="remaining_area" id="remaining_area" value="{{ isset($calculationSheetDetails[0]->remaining_area) ? $calculationSheetDetails[0]->remaining_area : 0 }}" style="width:100%" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">2.</td>
                                                <td style = "border-style: ridge;">
                                                    LC/RC
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom" readonly type="text"
                                                        name="lr_rc_division_val" id="lr_rc_division_val" value="{{ isset($calculationSheetDetails[0]->lr_rc_division_val) ? $calculationSheetDetails[0]->lr_rc_division_val : 0 }}" style="width:100%"/>

                                                </td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">3.</td>
                                                <td style = "border-style: ridge;">
                                                    सादर प्रकरणामध्ये भूखंड हा ४००० चौ मी पेक्षा कमी असल्याने DCR टेबल
                                                    C नुसार shariung हक्क
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom" readonly type="text"
                                                        name="dcr_c_society_val" id="dcr_c_society_val" value="{{ isset($calculationSheetDetails[0]->dcr_c_society_val) ? $calculationSheetDetails[0]->dcr_c_society_val.'%' : '0%' }}" style="width:100%"/>

                                                    <input style="border: none;" class="form-control form-control--custom" readonly type="text"
                                                        name="dcr_c_mhada_val" id="dcr_c_mhada_val" value="{{ isset($calculationSheetDetails[0]->dcr_c_mhada_val) ? $calculationSheetDetails[0]->dcr_c_mhada_val.'%' : '0%' }}" style="width:100%"/>

                                                    <!-- data-target="#select-dcr" -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">4.</td>
                                                <td style = "border-style: ridge;">
                                                    संस्थेचा हिस्सा
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom" readonly type="text"
                                                        name="society_share" id="society_share" value="{{ isset($calculationSheetDetails[0]->society_share) ? $calculationSheetDetails[0]->society_share : 0 }}" style="width:100%"/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">5.</td>
                                                <td style = "border-style: ridge;">

                                                    म्हाडाचा हिस्सा

                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom" readonly type="text"
                                                        name="mhada_share" id="mhada_share" value="{{ isset($calculationSheetDetails[0]->mhada_share) ? $calculationSheetDetails[0]->mhada_share : 0 }}" style="width:100%"/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">6.</td>
                                                <td style = "border-style: ridge;">

                                                    फंजिबल सह म्हाडाचा हिस्सा

                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom" readonly type="text"
                                                        name="mhada_share_with_fungib" id="mhada_share_with_fungib"
                                                        value="{{ isset($calculationSheetDetails[0]->mhada_share_with_fungib) ? $calculationSheetDetails[0]->mhada_share_with_fungib : 0 }}" style="width:100%"/>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
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
                                    <h3 class="section-title">Table D</h3>
                                </div>
                            </div>
                            <div id="four" class="m-section__content mb-0 table-responsive">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("four");'
                                                style="max-width: 22px" class="printBtn"></a>
                                    </div>
                                    <table class="table mb-0" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs" style = "border-style: ridge;">
                                                    #
                                                </th>
                                                <th style = "border-style: ridge;width:30px">
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
                                                    अस्तित्वातील बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="infra_fee  form-control form-control--custom" type="text"
                                                        name="existing_construction_area" id="existing_construction_area"
                                                        value="{{ isset($calculationSheetDetails[0]->existing_construction_area) ? $calculationSheetDetails[0]->existing_construction_area : 0 }}"
                                                        readonly />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">2.</td>
                                                <td style = "border-style: ridge;">
                                                    दि.०८.१०.२०१३ च्या अधिसूचनेमधील अनु.क्र.५ ए ,नुसार ७ % ऑफ
                                                    इन्फ्रास्टक्चर शुल्क रक्कम
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom" readonly type="text"
                                                        name="off_site_infrastructure_fee" id="off_site_infrastructure_fee"
                                                        value="{{ isset($calculationSheetDetails[0]->off_site_infrastructure_fee) ? $calculationSheetDetails[0]->off_site_infrastructure_fee : 0 }}" />

                                                </td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">3.</td>
                                                <td style = "border-style: ridge;">
                                                    उपरोक्त ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क रकमेपैकी म.न.पा.स भरवायची
                                                    ५/७ रक्कम (५/७ X अनु.क्र.२)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom" readonly type="text"
                                                        name="amount_to_be_paid_to_municipal" id="amount_to_be_paid_to_municipal"
                                                        value="{{ isset($calculationSheetDetails[0]->amount_to_be_paid_to_municipal) ? $calculationSheetDetails[0]->amount_to_be_paid_to_municipal : 0 }}" />


                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">4.</td>
                                                <td style = "border-style: ridge;">
                                                    म्हाडाकडे भरवायची ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क रक्कम (२/७ *
                                                    अनु.क्र.२ )
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="total_amount_in_rs form-control form-control--custom"
                                                        readonly type="text" name="offsite_infrastructure_charge_to_mhada"
                                                        id="offsite_infrastructure_charge_to_mhada" value="{{ isset($calculationSheetDetails[0]->offsite_infrastructure_charge_to_mhada) ? $calculationSheetDetails[0]->offsite_infrastructure_charge_to_mhada : 0 }}" />


                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">5.</td>
                                                <td style = "border-style: ridge;">
                                                    छाननी शुल्क
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="total_amount_in_rs form-control form-control--custom"
                                                        readonly type="text" name="scrutiny_fee" id="scrutiny_fee"
                                                        value="{{ isset($calculationSheetDetails[0]->scrutiny_fee) ? $calculationSheetDetails[0]->scrutiny_fee : 6000 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">6.</td>
                                                <td style = "border-style: ridge;">
                                                    डेब्रिज रिमूव्हल शुल्क रु.६६००/-
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="total_amount_in_rs form-control form-control--custom"
                                                        readonly type="text" name="debraj_removal_fee" id="debraj_removal_fee"
                                                        value="{{ isset($calculationSheetDetails[0]->debraj_removal_fee) ? $calculationSheetDetails[0]->debraj_removal_fee : 6600 }}" />


                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">7.</td>
                                                <td style = "border-style: ridge;">
                                                    अभिन्यास मंजुरी शुल्क रु,१०००/ - प्रति गाळा
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="total_amount_in_rs form-control form-control--custom"
                                                        readonly type="text" name="layout_approval_fee" id="layout_approval_fee"
                                                        value="{{ isset($calculationSheetDetails[0]->layout_approval_fee) ? $calculationSheetDetails[0]->layout_approval_fee : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">8.</td>
                                                <td style = "border-style: ridge;">
                                                    पाणी वापर शुल्क (रु.१,००,०००/- )
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="total_amount_in_rs form-control form-control--custom"
                                                        readonly type="text" name="water_usage_charges" id="water_usage_charges"
                                                        value="{{ isset($calculationSheetDetails[0]->water_usage_charges) ? $calculationSheetDetails[0]->water_usage_charges : 100000 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">9.</td>
                                                <td style = "border-style: ridge;">
                                                    एकूण रक्कम रुपये
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom" readonly type="text"
                                                        name="total_amount_in_rs" id="total_amount_in_rs" value="{{ isset($calculationSheetDetails[0]->total_amount_in_rs) ? $calculationSheetDetails[0]->total_amount_in_rs : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">10.</td>
                                                <td style = "border-style: ridge;">
                                                    बृहनमुंबई महानगर पालिकेकडे भरणा करावयाची रक्कम
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom" readonly type="text"
                                                        name="amount_to_b_paid_to_municipal_corporation" id="amount_to_b_paid_to_municipal_corporation"
                                                        value="{{ isset($calculationSheetDetails[0]->amount_to_b_paid_to_municipal_corporation) ? $calculationSheetDetails[0]->amount_to_b_paid_to_municipal_corporation : 0 }}" />


                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="five" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-section__content mb-0 table-responsive">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column h-100 two-cols">
                                            <h3 class="section-title section-title--small">Download REE Note</h3>
                                                <!-- <span class="hint-text">Download  Note uploaded by REE</span> -->
                                                <div class="mt-auto">
                                                    @if(isset($arrData['reeNote']->document_path))
                                                    <a href="{{ config('commanConfig.storage_server').'/'.$arrData['reeNote']->document_path }}" target="_blank">
                                                        <button class="btn btn-primary">Download</button>
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
            /*   if (event.shiftKey == true) {
                   event.preventDefault();
               }

               if ($(this).val().indexOf('.') > 0) {
                   if ( (($(this).val().length + 1) - $(this).val().indexOf('.')) > 3) {
                       event.preventDefault();
                   }

               }


               if ((event.keyCode >= 48 && event.keyCode <= 57) ||
                   (event.keyCode >= 96 && event.keyCode <= 105) ||
                   event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
                   event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {
               } else {
                   event.preventDefault();
               }


               if($(this).val().indexOf('.') !== -1 && event.keyCode == 190 )
                   event.preventDefault();
                   //if a decimal has been added, disable the "."-button

                   */

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



        });
       /* $("#total_permissible_construction_area").attr('value', parseFloat($("#permissible_construction_area").val()) +
            parseFloat($("#permissible_proratata_area").val()));

        $("#remaining_area").attr('value', parseFloat($("#total_permissible_construction_area").val()) -
            parseFloat($("#total_rehabilitation_construction_area").val()) - parseFloat($(
                "#mattress_area_for_construction_area").val()));

        var lr_cal = parseFloat(0.07 * $("#lr_val").val());
        var substract = parseFloat($("#total_permissible_construction_area").val()) - parseFloat($(
            "#existing_construction_area").val());
        $("#off_site_infrastructure_fee").attr('value', substract * lr_cal);

        $("#layout_approval_fee").attr('value', 1000 * $("#total_house").val());


        var total_amount_in_rs = 0;
        $(".total_amount_in_rs").each(function () {
            total_amount_in_rs += +$(this).val();
        });
        $("#total_amount_in_rs").attr('value', total_amount_in_rs);
*/





    })

</script>
<script>
    $(document).on("keyup", ".total_area", function () {
        var sum = 0;
        $(".total_area").each(function () {
            sum += +$(this).val();
        });
        $("#area_of_total_plot").attr('value', sum);
    });

    $(document).on("keyup", ".total_area , #permissible_carpet_area_coordinates", function () {

        $("#permissible_construction_area").attr('value', $("#area_of_total_plot").val() * $(
            "#permissible_carpet_area_coordinates").val());

        $("#total_permissible_construction_area").attr('value', parseFloat($("#permissible_construction_area").val()) +
            parseFloat($("#permissible_proratata_area").val()));


    });

    $(document).on("keyup", "#sqm_area_per_slot , #total_house", function () {

        $("#permissible_proratata_area").attr('value', $("#sqm_area_per_slot").val() * $("#total_house").val());

        $("#total_permissible_construction_area").attr('value', parseFloat($("#permissible_construction_area").val()) +
            parseFloat($("#permissible_proratata_area").val()));


    });

    $(document).on("keyup", "#permissible_mattress_area", function () {

        $("#revised_permissible_mattress_area").attr('value', 0.35 * $(this).val());

    });

    $(document).on("keyup", "#revised_increased_area_for_residential_use", function () {

        $("#total_rehabilitation_mattress_area").attr('value', $("#total_house").val() * $(this).val());

        $("#total_rehabilitation_mattress_area_with_dcr").attr('value', parseFloat($("#total_additional_claims")
            .val()) + parseFloat($("#total_rehabilitation_mattress_area").val()));

        $("#total_rehabilitation_construction_area").attr('value', parseFloat($(
            "#total_rehabilitation_mattress_area_with_dcr").val()) * 1.2);
    });
    $(document).on("keyup", "#lr_val , #rc_val", function () {

        var div = parseFloat($("#lr_val").val()) / parseFloat($("#rc_val").val());

        $("#lr_rc_division_val").attr('value', div.toFixed(2));

    });

    $(document).on("keyup", "#total_rehabilitation_construction_area", function () {

        $("#mattress_area_for_construction_area").attr('value', (($("input[type=radio][name=dcr_b_val]").val() /
            100) * $(this).val()).toFixed(2));

    });

    $(document).on("change", "input[type=radio][name=dcr_b_val]", function () {

        $("#mattress_area_for_construction_area").attr('value', (($(this).val() / 100) * $(
            "#total_rehabilitation_construction_area").val()).toFixed(2));

    });

    $(document).on("keyup", ".remaining_area", function () {
        $("#remaining_area").attr('value', parseFloat($("#total_permissible_construction_area").val()) -
            parseFloat($("#total_rehabilitation_construction_area").val()) - parseFloat($(
                "#mattress_area_for_construction_area").val()));

    });


    $(document).on("change", "input[type=radio][name=dcr_c_society_val]", function () {

        $("#society_share").attr('value', (($(this).val() / 100) * $("#remaining_area").val()).toFixed(2));

    });
    $(document).on("change", "input[type=radio][name=dcr_c_mhada_val]", function () {

        var mhada_share = (($(this).val() / 100) * $("#remaining_area").val()).toFixed(2);
        $("#mhada_share").attr('value', mhada_share);
        $("#mhada_share_with_fungib").attr('value', (mhada_share * 1.35).toFixed(2));

    });

    $(document).on("keyup", ".infra_fee", function () {
        var lr_cal = parseFloat(0.07 * $("#lr_val").val());
        var substract = parseFloat($("#total_permissible_construction_area").val()) - parseFloat($(
            "#existing_construction_area").val());
        $("#off_site_infrastructure_fee").attr('value', substract * lr_cal);

    });


    $(document).on("keyup", "#existing_construction_area", function () {
        $("#amount_to_be_paid_to_municipal").attr('value', (5 / 7 * $(this).val()).toFixed(2));
        $("#offsite_infrastructure_charge_to_mhada").attr('value', (2 / 7 * $(this).val()).toFixed(2));
        $("#amount_to_b_paid_to_municipal_corporation").attr('value', (5 / 7 * $(this).val()).toFixed(2));
    });


    $(document).on("keyup", "#total_house", function () {
        $("#layout_approval_fee").attr('value', 1000 * $(this).val());

    });



    $(document).on("keyup", ".total_amount_in_rs", function () {
        var total_amount_in_rs = 0;
        $(".total_amount_in_rs").each(function () {
            total_amount_in_rs += +$(this).val();
        });
        $("#total_amount_in_rs").attr('value', total_amount_in_rs);
    });

    $(document).on("change", "input[type=radio][name=dcr_a_val]", function () {

        var total_claims = ($(this).val() / 100) * $("#permissible_mattress_area").val() * $("#total_house").val();
        $("#total_additional_claims").val(total_claims.toFixed(2));

        $("#total_rehabilitation_mattress_area_with_dcr").attr('value', parseFloat($("#total_additional_claims")
            .val()) + parseFloat($("#total_rehabilitation_mattress_area").val()));

        $("#total_rehabilitation_construction_area").attr('value', parseFloat($(
            "#total_rehabilitation_mattress_area_with_dcr").val()) * 1.2);
    });
    $(document).on("keyup", "#total_house, #permissible_mattress_area", function () {
        var total_claims = ($("input[type=radio][name=dcr_a_val]:checked").val() / 100) * $(
            "#permissible_mattress_area").val() * $("#total_house").val();

        $("#total_additional_claims").attr('value', total_claims.toFixed(2));

        $("#total_rehabilitation_mattress_area_with_dcr").attr('value', parseFloat($("#total_additional_claims")
            .val()) + parseFloat($("#total_rehabilitation_mattress_area").val()));

        $("#total_rehabilitation_construction_area").attr('value', parseFloat($(
            "#total_rehabilitation_mattress_area_with_dcr").val()) * 1.2);

    });


    function printDiv(elem) {

        var divToPrint = document.getElementById(elem);

        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);

    }

    function PrintElem(elem) {
        $(".printBtn").css("display","none");
        var mywindow = window.open('', 'PRINT', 'height=600,width=600');
        mywindow.document.write('<html><head><title>Maharashtra Housing and development authority</title>');

        mywindow.document.write('</head><body>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();
        $(".printBtn").css("display","block");
        return true;
    }

</script>

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
            return false;
        });

        $(window).on('popstate', function () {
            var anchor = location.hash ||
                $('a[data-toggle=\'tab\']').first().attr('href');
            $('a[href=\'' + anchor + '\']').tab('show');
        });

        // **End** Save tabs location on window refresh or submit
    });

</script>
@endsection
