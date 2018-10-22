@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.REE_department.action',compact('ol_application'))
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

<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="d-flex">
            {{ Breadcrumbs::render('calculation_sheet',$ol_application->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#one" role="tab" aria-selected="false">
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
                            <div class="m-section__content mb-0 table-responsive">
                                <form role="form" method="POST" action="{{ route('save_sharing_calculation_details') }}">
                                    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                    <input name="application_id" type="hidden" value="{{ $applicationId }}" />
                                    <input name="user_id" type="hidden" value="{{ $user->id }}" />
                                    <input name="redirect_tab" type="hidden" value="two" />
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                                src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("one");'
                                                style="max-width: 22px"></a>
                                    </div>
                                    <table class="table mb-0 table--box-input" style="padding-top: 10px;">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs">
                                                    #
                                                </th>
                                                <th>
                                                    तपशील
                                                </th>
                                                <th class="table-data--md">
                                                    रक्कम रु
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td>
                                                    कार्यकारी अभियंता /कुर्ला विभाग यांचे सिमांकन नकाशानुसार भूखंडाचे
                                                    क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    1. भाडेपट्टा करारनाम्यानुसार क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="total_area form-control form-control--custom"
                                                           name="area_as_per_lease_agreement" id="area_as_per_lease_agreement" value="{{ isset($calculationSheetDetails[0]->area_as_per_lease_agreement) ? $calculationSheetDetails[0]->area_as_per_lease_agreement : 0 }}" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    2. टिट बिट भूखंडाचे क्षेत्र
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="total_area form-control form-control--custom"
                                                        name="area_of_tit_bit_plot" id="area_of_tit_bit_plot" value="{{ isset($calculationSheetDetails[0]->area_of_tit_bit_plot) ? $calculationSheetDetails[0]->area_of_tit_bit_plot : 0 }}" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="font-weight-bold">
                                                    Total भूखंडाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input class="min_val_for_calculation form-control form-control--custom" readonly type="text"
                                                        name="area_of_total_plot" id="area_of_total_plot" value="{{ isset($calculationSheetDetails[0]->area_of_total_plot) ? $calculationSheetDetails[0]->area_of_total_plot : 0 }}" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>
                                                    अभिन्यासानुसार भूखंडाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    1. भाडेपट्टा करारनाम्यानुसार क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="abhinyas_total_area  form-control form-control--custom"
                                                           name="abhinyas_area_as_per_lease_agreement" id="abhinyas_area_as_per_lease_agreement" value="{{ isset($calculationSheetDetails[0]->abhinyas_area_as_per_lease_agreement) ? $calculationSheetDetails[0]->abhinyas_area_as_per_lease_agreement : 0 }}" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    2. टिट बिट भूखंडाचे क्षेत्र
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="abhinyas_total_area form-control form-control--custom"
                                                           name="abhinyas_area_of_tit_bit_plot" id="abhinyas_area_of_tit_bit_plot" value="{{ isset($calculationSheetDetails[0]->abhinyas_area_of_tit_bit_plot) ? $calculationSheetDetails[0]->abhinyas_area_of_tit_bit_plot : 0 }}" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="font-weight-bold">
                                                    Total भूखंडाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input class="min_val_for_calculation form-control form-control--custom" readonly type="text"
                                                           name="abhinyas_area_of_total_plot" id="abhinyas_area_of_total_plot" value="{{ isset($calculationSheetDetails[0]->abhinyas_area_of_total_plot) ? $calculationSheetDetails[0]->abhinyas_area_of_total_plot : 0 }}" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>
                                                    परिगणनाकरिता ग्राह्य भूखंडाचे क्षेत्रफळ (किमान क्षेत्र)
                                                </td>
                                                <td class="text-center">
                                                    <input readonly class=" form-control form-control--custom"
                                                           type="text" name="area_of_​​subsistence_to_calculate" id="area_of_​​subsistence_to_calculate"
                                                           value="{{ isset($calculationSheetDetails[0]->area_of_​​subsistence_to_calculate) ? $calculationSheetDetails[0]->area_of_​​subsistence_to_calculate : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>
                                                    अनुज्ञेय चटई क्षेत्र निर्देशांक
                                                </td>
                                                <td class="text-center">
                                                    <input class="remaining_area infra_fee form-control form-control--custom"
                                                        type="text" name="permissible_carpet_area_coordinates" id="permissible_carpet_area_coordinates"
                                                        value="{{ isset($calculationSheetDetails[0]->permissible_carpet_area_coordinates) ? $calculationSheetDetails[0]->permissible_carpet_area_coordinates : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td>
                                                    अनुज्ञेय बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="permissible_construction_area" id="permissible_construction_area"
                                                        value="{{ isset($calculationSheetDetails[0]->permissible_construction_area) ? $calculationSheetDetails[0]->permissible_construction_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6.</td>
                                                <td>
                                                    म.न.पा .कडून ल. ओ. आय. पत्रानुसार अनुज्ञेय प्रोरेटा क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    1. प्रति सदनिका चौ मी क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input class="remaining_area infra_fee form-control form-control--custom"
                                                        type="text" name="sqm_area_per_slot" id="sqm_area_per_slot"
                                                        value="{{ isset($calculationSheetDetails[0]->sqm_area_per_slot) ? $calculationSheetDetails[0]->sqm_area_per_slot : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    2. एकूण सदनिका
                                                </td>
                                                <td class="text-center">
                                                    <input class="remaining_area infra_fee form-control form-control--custom"
                                                        type="text" name="total_house" id="total_house" value="{{ isset($calculationSheetDetails[0]->total_house) ? $calculationSheetDetails[0]->total_house : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="font-weight-bold">
                                                    Total
                                                </td>
                                                <td class="text-center">
                                                    <input class="remaining_area form-control form-control--custom"
                                                        readonly type="text" name="permissible_proratata_area" id="permissible_proratata_area"
                                                        value="{{ isset($calculationSheetDetails[0]->permissible_proratata_area) ? $calculationSheetDetails[0]->permissible_proratata_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7.</td>
                                                <td>
                                                    अनुज्ञेय बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="total_permissible_construction_area" id="total_permissible_construction_area"
                                                        value="{{ isset($calculationSheetDetails[0]->total_permissible_construction_area) ? $calculationSheetDetails[0]->total_permissible_construction_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8.</td>
                                                <td>
                                                    अनुज्ञेय चटई क्षेत्रफळ प्रतिगाळा
                                                </td>
                                                <td class="text-center">
                                                    <input class="remaining_area form-control form-control--custom"
                                                        type="text" name="permissible_mattress_area" id="permissible_mattress_area"
                                                        value="{{ isset($calculationSheetDetails[0]->permissible_mattress_area) ? $calculationSheetDetails[0]->permissible_mattress_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>9.</td>
                                                <td>
                                                    सुधारित वि नि नि ३३(५) प्रमाणे अनुज्ञेय चटई क्षेत्रफळ वर ३५%
                                                    प्रतिगाळा
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="revised_permissible_mattress_area" id="revised_permissible_mattress_area"
                                                        value="{{ isset($calculationSheetDetails[0]->revised_permissible_mattress_area) ? $calculationSheetDetails[0]->revised_permissible_mattress_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>10.</td>
                                                <td>
                                                    सुधारित वि नि नि ३३(५) दि ३.७.२०१७ रोजीच्या फ्रबदलाच्या अधिसूचने
                                                    नुसार निवासी वापर करिता वाढीव क्षेत्रफळ ३५% मिळून किमान ३५ चौमी
                                                    अनुज्ञेय आहे. त्यामुळे अ क्र ७ मधील क्षेत्रफळ कमी असल्याने ३५ चौ मी
                                                    गृहीत धरण्यात येत आहे
                                                </td>
                                                <td class="text-center">
                                                    <input class="remaining_area form-control form-control--custom"
                                                        type="text" name="revised_increased_area_for_residential_use"
                                                        id="revised_increased_area_for_residential_use" value="{{ isset($calculationSheetDetails[0]->revised_increased_area_for_residential_use) ? $calculationSheetDetails[0]->revised_increased_area_for_residential_use : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>11.</td>
                                                <td>
                                                    एकूण पुनर्वसन चटई क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="total_rehabilitation_mattress_area" id="total_rehabilitation_mattress_area"
                                                        value="{{ isset($calculationSheetDetails[0]->total_rehabilitation_mattress_area) ? $calculationSheetDetails[0]->total_rehabilitation_mattress_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>12.</td>
                                                <td>
                                                    सादर प्रकरणामध्ये भूखंड हा ४००० चौ मी पेक्षा कमी असल्याने DCR टेबल
                                                    अ नुसार अतिरिक्त हक्क
                                                </td>
                                                <td class="text-center">
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
                                                <td></td>
                                                <td>
                                                    Total
                                                </td>
                                                <td class="text-center">
                                                    <input readonly class="form-control form-control--custom" type="text"
                                                        name="total_additional_claims" id="total_additional_claims"
                                                        value="{{ isset($calculationSheetDetails[0]->total_additional_claims) ? $calculationSheetDetails[0]->total_additional_claims : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>13.</td>
                                                <td>
                                                    एकूण पुनर्वसन चटई क्षेत्र फळ

                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="total_rehabilitation_mattress_area_with_dcr" id="total_rehabilitation_mattress_area_with_dcr"
                                                        value="{{ isset($calculationSheetDetails[0]->total_rehabilitation_mattress_area) ? $calculationSheetDetails[0]->total_rehabilitation_mattress_area : 0 }}" />

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>14.</td>
                                                <td>
                                                    एकूण पुनर्वसन बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input class="remaining_area form-control form-control--custom"
                                                        readonly type="text" name="total_rehabilitation_construction_area"
                                                        id="total_rehabilitation_construction_area" value="{{ isset($calculationSheetDetails[0]->total_rehabilitation_construction_area) ? $calculationSheetDetails[0]->total_rehabilitation_construction_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" align="right"><input type="submit" name="submit" class="btn btn-primary"
                                                        value="Next" /> </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <div class="modal fade show" id="dcr-a-modal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1">उर्वरितचटईक्षेत्राचे
                                                        अधिमूल्य दर</h5>
                                                    <button style="cursor: pointer;" type="button" class="close"
                                                        data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="table text-center table--dark">
                                                            <thead>
                                                                <th>Area plot under redevelopment</th>
                                                                <th>Additional Entitlement (As % of carpet area of
                                                                    existing tenament)</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Upto 4000 sq.m</td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_a_val" id=""
                                                                                    value="0"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_a_val) && $calculationSheetDetails[0]->dcr_a_val == 'nil' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>Nil</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Above 4000 sq. m to 2 hect</td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_a_val" id=""
                                                                                    value="15"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_a_val) && $calculationSheetDetails[0]->dcr_a_val == '15' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>15%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Above 2 hect to 5 hect</td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_a_val" id=""
                                                                                    value="25"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_a_val) && $calculationSheetDetails[0]->dcr_a_val == '25' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>25%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Above 5 hetc to 10 hect</td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_a_val" id=""
                                                                                    value="35"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_a_val) && $calculationSheetDetails[0]->dcr_a_val == '35' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>35%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Above 10 hect</td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_a_val" id=""
                                                                                    value="45"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_a_val) && $calculationSheetDetails[0]->dcr_a_val == '45' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>45%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
                                <form role="form" method="POST" action="{{ route('save_sharing_calculation_details') }}">
                                    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                    <input name="application_id" type="hidden" value="{{ $applicationId }}" />
                                    <input name="user_id" type="hidden" value="{{ $user->id }}" />
                                    <input name="redirect_tab" type="hidden" value="three" />
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                                src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("two");'
                                                style="max-width: 22px"></a>
                                    </div>
                                    <table class="table mb-0 table--box-input" style="padding-top: 10px;">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs">
                                                    #
                                                </th>
                                                <th>
                                                    तपशील
                                                </th>
                                                <th class="table-data--md">
                                                    रक्कम रु
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td>
                                                    LR
                                                </td>
                                                <td class="text-center">
                                                    <input class="infra_fee form-control form-control--custom" type="text"
                                                        name="lr_val" id="lr_val" value="{{ isset($calculationSheetDetails[0]->lr_val) ? $calculationSheetDetails[0]->lr_val : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>
                                                    RC
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" type="text" name="rc_val"
                                                        id="rc_val" value="{{ isset($calculationSheetDetails[0]->rc_val) ? $calculationSheetDetails[0]->rc_val : 0 }}" />

                                                </td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>
                                                    LC/RC
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="lr_rc_division_val" id="lr_rc_division_val" value="{{ isset($calculationSheetDetails[0]->lr_rc_division_val) ? $calculationSheetDetails[0]->lr_rc_division_val : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>
                                                    सुधारित वि नि नि ३३(५) मधील तक्त्या नुसार LC/RC करिता प्रोत्साहन
                                                    क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <span style="cursor: pointer" data-toggle="modal" data-target="#dcr-b-modal">
                                                        DCR B
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td>
                                                    बांधकाम क्षेत्रफलकरीता प्रोत्साहन चटई क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="mattress_area_for_construction_area" id="mattress_area_for_construction_area"
                                                        value="{{ isset($calculationSheetDetails[0]->mattress_area_for_construction_area) ? $calculationSheetDetails[0]->mattress_area_for_construction_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" align="right"><input type="submit" name="submit" class="btn btn-primary"
                                                        value="Next" /> </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                    <div class="modal fade show" id="dcr-b-modal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1">Table B</h5>
                                                    <button style="cursor: pointer;" type="button" class="close"
                                                        data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="table text-center table--dark">
                                                            <thead>
                                                                <th>Basic ratio (LC/RC)</th>
                                                                <th>Incentive (as % of admissible rehablitation area)</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Above 6.00</td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_b_val" id=""
                                                                                    value="40"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_b_val) && $calculationSheetDetails[0]->dcr_b_val == '40' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>40%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Above 4.00 and upto 6.00</td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_b_val" id=""
                                                                                    value="50"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_b_val) && $calculationSheetDetails[0]->dcr_b_val == '50' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>50%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Above 2.00 and upto 4,00</td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_b_val" id=""
                                                                                    value="60"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_b_val) && $calculationSheetDetails[0]->dcr_b_val == '60' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>60%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Upto 2.00</td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_b_val" id=""
                                                                                    value="70"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_b_val) && $calculationSheetDetails[0]->dcr_b_val == '70' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>70%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Above 10 hect</td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_b_val" id=""
                                                                                    value="45"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_b_val) && $calculationSheetDetails[0]->dcr_b_val == '45' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>45%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                <form role="form" method="POST" action="{{ route('save_sharing_calculation_details') }}">
                                    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                    <input name="application_id" type="hidden" value="{{ $applicationId }}" />
                                    <input name="user_id" type="hidden" value="{{ $user->id }}" />
                                    <input name="redirect_tab" type="hidden" value="four" />
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                                src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("three");'
                                                style="max-width: 22px"></a>
                                    </div>
                                    <table class="table mb-0 table--box-input" style="padding-top: 10px;">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs">
                                                    #
                                                </th>
                                                <th>
                                                    तपशील
                                                </th>
                                                <th class="table-data--md">
                                                    रक्कम रु
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td>
                                                    उर्वरित क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="remaining_area" id="remaining_area" value="{{ isset($calculationSheetDetails[0]->remaining_area) ? $calculationSheetDetails[0]->remaining_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>
                                                    LC/RC
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="lr_rc_division_val" id="lr_rc_division_val" value="{{ isset($calculationSheetDetails[0]->lr_rc_division_val) ? $calculationSheetDetails[0]->lr_rc_division_val : 0 }}" />

                                                </td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>
                                                    सादर प्रकरणामध्ये भूखंड हा ४००० चौ मी पेक्षा कमी असल्याने DCR टेबल
                                                    C नुसार shariung हक्क
                                                </td>
                                                <td class="text-center">
                                                    <span style="cursor: pointer" data-toggle="modal" data-target="#select-dcr">
                                                        DCR C
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>
                                                    संस्थेचा हिस्सा
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="society_share" id="society_share" value="{{ isset($calculationSheetDetails[0]->society_share) ? $calculationSheetDetails[0]->society_share : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td>

                                                    म्हाडाचा हिस्सा

                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="mhada_share" id="mhada_share" value="{{ isset($calculationSheetDetails[0]->mhada_share) ? $calculationSheetDetails[0]->mhada_share : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6.</td>
                                                <td>

                                                    फंजिबल सह म्हाडाचा हिस्सा

                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="mhada_share_with_fungib" id="mhada_share_with_fungib"
                                                        value="{{ isset($calculationSheetDetails[0]->mhada_share_with_fungib) ? $calculationSheetDetails[0]->mhada_share_with_fungib : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" align="right"><input type="submit" name="submit" class="btn btn-primary"
                                                        value="Next" /> </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <div class="modal fade show" id="select-dcr" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel2">Table C</h5>
                                                    <button style="cursor: pointer;" type="button" class="close"
                                                        data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="table text-center table--dark">
                                                            <thead>
                                                                <th>Basic ratio (LC/RC)</th>
                                                                <th>Cooprative society share</th>
                                                                <th>Mhada share</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Above 6.00</td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_c_society_val"
                                                                                    id="" value="30"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_c_society_val) && $calculationSheetDetails[0]->dcr_c_society_val == '30' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>30%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_c_mhada_val"
                                                                                    id="" value="70"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_c_mhada_val) && $calculationSheetDetails[0]->dcr_c_mhada_val == '70' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>70%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Above 4.00 and upto 6.00</td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_c_society_val"
                                                                                    id="" value="35"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_c_society_val) && $calculationSheetDetails[0]->dcr_c_society_val == '35' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>35%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_c_mhada_val"
                                                                                    id="" value="65"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_c_mhada_val) && $calculationSheetDetails[0]->dcr_c_mhada_val == '65' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>65%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Above 2.00 and upto 4,00</td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_c_society_val"
                                                                                    id="" value="40"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_c_society_val) && $calculationSheetDetails[0]->dcr_c_society_val == '40' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>40%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_c_mhada_val"
                                                                                    id="" value="60"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_c_mhada_val) && $calculationSheetDetails[0]->dcr_c_mhada_val == '60' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>60%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Upto 2.00</td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_c_society_val"
                                                                                    id="" value="45"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_c_society_val) && $calculationSheetDetails[0]->dcr_c_society_val == '45' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>45%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="dcr_c_mhada_val"
                                                                                    id="" value="55"
                                                                                    {{ isset($calculationSheetDetails[0]->dcr_c_mhada_val) && $calculationSheetDetails[0]->dcr_c_mhada_val == '55' ? 'checked' : '' }}>
                                                                                <span class="m-radio--box-span">
                                                                                    <span>55%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                <form role="form" method="POST" action="{{ route('save_sharing_calculation_details') }}">
                                    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                    <input name="application_id" type="hidden" value="{{ $applicationId }}" />
                                    <input name="user_id" type="hidden" value="{{ $user->id }}" />
                                    <input name="redirect_tab" type="hidden" value="four" />
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                                src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("four");'
                                                style="max-width: 22px"></a>
                                    </div>
                                    <table class="table mb-0 table--box-input" style="padding-top: 10px;">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs">
                                                    #
                                                </th>
                                                <th>
                                                    तपशील
                                                </th>
                                                <th class="table-data--md">
                                                    रक्कम रु
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td>
                                                    अस्तित्वातील बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input class="infra_fee  form-control form-control--custom" type="text"
                                                        name="existing_construction_area" id="existing_construction_area"
                                                        value="{{ isset($calculationSheetDetails[0]->existing_construction_area) ? $calculationSheetDetails[0]->existing_construction_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>
                                                    दि.०८.१०.२०१३ च्या अधिसूचनेमधील अनु.क्र.५ ए ,नुसार ७ % ऑफ
                                                    इन्फ्रास्टक्चर शुल्क रक्कम
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="off_site_infrastructure_fee" id="off_site_infrastructure_fee"
                                                        value="{{ isset($calculationSheetDetails[0]->off_site_infrastructure_fee) ? $calculationSheetDetails[0]->off_site_infrastructure_fee : 0 }}" />

                                                </td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>
                                                    उपरोक्त ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क रकमेपैकी म.न.पा.स भरवायची
                                                    ५/७ रक्कम (५/७ X अनु.क्र.१६)
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="amount_to_be_paid_to_municipal" id="amount_to_be_paid_to_municipal"
                                                        value="{{ isset($calculationSheetDetails[0]->amount_to_be_paid_to_municipal) ? $calculationSheetDetails[0]->amount_to_be_paid_to_municipal : 0 }}" />


                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>
                                                    म्हाडाकडे भरवायची ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क रक्कम (२/७ *
                                                    अनु.क्र.१६ )
                                                </td>
                                                <td class="text-center">
                                                    <input class="total_amount_in_rs form-control form-control--custom"
                                                        readonly type="text" name="offsite_infrastructure_charge_to_mhada"
                                                        id="offsite_infrastructure_charge_to_mhada" value="{{ isset($calculationSheetDetails[0]->offsite_infrastructure_charge_to_mhada) ? $calculationSheetDetails[0]->offsite_infrastructure_charge_to_mhada : 0 }}" />


                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td>
                                                    छाननी शुल्क
                                                </td>
                                                <td class="text-center">
                                                    <input class="total_amount_in_rs form-control form-control--custom"
                                                        readonly type="text" name="scrutiny_fee" id="scrutiny_fee"
                                                        value="{{ isset($calculationSheetDetails[0]->scrutiny_fee) ? $calculationSheetDetails[0]->scrutiny_fee : 6000 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6.</td>
                                                <td>
                                                    डेब्रिज रिमूव्हल शुल्क रु.६६००/-
                                                </td>
                                                <td class="text-center">
                                                    <input class="total_amount_in_rs form-control form-control--custom"
                                                        readonly type="text" name="debraj_removal_fee" id="debraj_removal_fee"
                                                        value="{{ isset($calculationSheetDetails[0]->debraj_removal_fee) ? $calculationSheetDetails[0]->debraj_removal_fee : 6600 }}" />


                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7.</td>
                                                <td>
                                                    अभिन्यास मंजुरी शुल्क रु,१०००/ - प्रति गाळा
                                                </td>
                                                <td class="text-center">
                                                    <input class="total_amount_in_rs form-control form-control--custom"
                                                        readonly type="text" name="layout_approval_fee" id="layout_approval_fee"
                                                        value="{{ isset($calculationSheetDetails[0]->layout_approval_fee) ? $calculationSheetDetails[0]->layout_approval_fee : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8.</td>
                                                <td>
                                                    पाणी वापर शुल्क (रु.१,००,०००/- )
                                                </td>
                                                <td class="text-center">
                                                    <input class="total_amount_in_rs form-control form-control--custom"
                                                        readonly type="text" name="water_usage_charges" id="water_usage_charges"
                                                        value="{{ isset($calculationSheetDetails[0]->water_usage_charges) ? $calculationSheetDetails[0]->water_usage_charges : 100000 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>9.</td>
                                                <td>
                                                    एकूण रक्कम रुपये
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="total_amount_in_rs" id="total_amount_in_rs" value="{{ isset($calculationSheetDetails[0]->total_amount_in_rs) ? $calculationSheetDetails[0]->total_amount_in_rs : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>10.</td>
                                                <td>
                                                    बृहनमुंबई महानगर पालिकेकडे भरणा करावयाची रक्कम
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="amount_to_b_paid_to_municipal_corporation" id="amount_to_b_paid_to_municipal_corporation"
                                                        value="{{ isset($calculationSheetDetails[0]->amount_to_b_paid_to_municipal_corporation) ? $calculationSheetDetails[0]->amount_to_b_paid_to_municipal_corporation : 0 }}" />


                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" align="right"><input type="submit" name="submit" class="btn btn-primary"
                                                        value="Next" /> </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="five" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        Note
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column h-100 two-cols">
                                            <h3 class="section-title section-title--small">Download REE Note</h3>
                                                <!-- <span class="hint-text">Download  Note uploaded by REE</span> -->
                                                <div class="mt-auto">
                                                    @if(isset($arrData['reeNote']->document_path))
                                                    <a href="{{config('commanConfig.storage_server').'/'.$arrData['reeNote']->document_path}}">

                                                        <button class="btn btn-primary">Download</button>
                                                    </a>
                                                    @else
                                                    <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                        * Note : REE note not available. </span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 border-left">
                                            <div class="d-flex flex-column h-100 two-cols">
                                                <h5>Upload REE Note</h5>
                                                <!-- <span class="hint-text">Click on 'Upload' to upload  - Note</span> -->
                                                <form action="{{ route('ree.upload_ree_note') }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="application_id" value="{{ $applicationId }}">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" name="ree_note" type="file" id="test-upload"
                                                            required="">
                                                        <label class="custom-file-label" for="test-upload">Choose file
                                                            ...</label>
                                                    </div>
                                                    <span class="text-danger" id="file_error"></span>
                                                    <div class="mt-auto">
                                                        <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                    </div>
                                                </form>
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

     /*   $('input.form-control').each(function (key,elem) {
           var value= $(elem).val();
            value = value.replace(/,/g,'');
            $(this).attr('value', numberWithCommas(value));
        })
*/



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


            // ============================== format no with comma
            /*
            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;

            // format number
            $(this).val(function(index, value) {
                //return value
                  //  .replace(/\D/g, "")
                  //  .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
         //           ;

                value = value.replace(/,/g,'');
                return numberWithCommas(value);
*/
            });


        });
        function numberWithCommas(x) {
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }

        $("#total_permissible_construction_area").attr('value', parseFloat($("#permissible_construction_area").val()) +
            parseFloat($("#permissible_proratata_area").val()));

        $("#remaining_area").attr('value', parseFloat($("#total_permissible_construction_area").val()) - parseFloat($("#total_rehabilitation_construction_area").val()) - parseFloat($("#mattress_area_for_construction_area").val()));

        var lr_cal = parseFloat(0.07 * $("#lr_val").val());
        var substract = parseFloat($("#total_permissible_construction_area").val()) - parseFloat($(
            "#existing_construction_area").val());
        var off_site_infra_fee = Math.ceil(substract * lr_cal);
        $("#off_site_infrastructure_fee").attr('value',off_site_infra_fee );

        $("#amount_to_be_paid_to_municipal").attr('value', Math.ceil(5 / 7 * off_site_infra_fee));
        $("#offsite_infrastructure_charge_to_mhada").attr('value', Math.ceil(2 / 7 * off_site_infra_fee ));
        $("#amount_to_b_paid_to_municipal_corporation").attr('value', Math.ceil(5 / 7 * off_site_infra_fee));


        $("#layout_approval_fee").attr('value', 1000 * $("#total_house").val());


        var total_amount_in_rs = 0;
        $(".total_amount_in_rs").each(function () {
            total_amount_in_rs += +$(this).val();
        });
        $("#total_amount_in_rs").attr('value', Math.ceil(total_amount_in_rs));






    })

</script>
<script>
    $(document).on("keyup", ".total_area", function () {
        var sum = 0;
        $(".total_area").each(function () {
            sum += +$(this).val();
        });
        $("#area_of_total_plot").attr('value', sum);

        var sorted = $(".min_val_for_calculation").sort(

            function(a, b) {
                return a.value - b.value
            });
        var lowest = sorted[0].value;

        $("#area_of_​​subsistence_to_calculate").attr('value',lowest);

    });

    $(document).on("keyup", ".abhinyas_total_area", function () {
        var sum = 0;
        $(".abhinyas_total_area").each(function () {
            sum += +$(this).val();
        });
        $("#abhinyas_area_of_total_plot").attr('value', sum);

        var sorted = $(".min_val_for_calculation").sort(

            function(a, b) {
                return a.value - b.value
            });
        var lowest = sorted[0].value;

        $("#area_of_​​subsistence_to_calculate").attr('value',lowest);

    });



    $(document).on("keyup", ".total_area , .abhinyas_total_area , #permissible_carpet_area_coordinates", function () {

        $("#permissible_construction_area").attr('value', $("#area_of_​​subsistence_to_calculate").val() * $(
            "#permissible_carpet_area_coordinates").val());

        $("#total_permissible_construction_area").attr('value', parseFloat($("#permissible_construction_area").val()) +
            parseFloat($("#permissible_proratata_area").val()));


    });

    $(document).on("keyup", "#sqm_area_per_slot , #total_house", function () {

        var sqm_area_per_slot = (isNaN($("#sqm_area_per_slot").val())) ? 0 : $("#sqm_area_per_slot").val();
        var total_house = (isNaN($("#total_house").val())) ? 0 : $("#total_house").val();

        $("#permissible_proratata_area").attr('value', sqm_area_per_slot * total_house);

        $("#total_permissible_construction_area").attr('value', parseFloat($("#permissible_construction_area").val()) +
            parseFloat($("#permissible_proratata_area").val()));


    });

    $(document).on("keyup", "#permissible_mattress_area", function () {

        $("#revised_permissible_mattress_area").attr('value', (1.35 * $(this).val()).toFixed(2));

    });

    $(document).on("keyup", "#revised_increased_area_for_residential_use", function () {

        $("#total_rehabilitation_mattress_area").attr('value', $("#total_house").val() * $(this).val());

        $("#total_rehabilitation_mattress_area_with_dcr").attr('value', parseFloat($("#total_additional_claims")
                .val()) +
            parseFloat($("#total_rehabilitation_mattress_area").val()));

        $("#total_rehabilitation_construction_area").attr('value', parseFloat($(
            "#total_rehabilitation_mattress_area_with_dcr").val()) * 1.2);
    });
    $(document).on("keyup", "#lr_val , #rc_val", function () {

        var div = parseFloat($("#lr_val").val()) / parseFloat($("#rc_val").val());

        $("#lr_rc_division_val").attr('value', div.toFixed(2));

    });

    $(document).on("keyup", "#total_rehabilitation_construction_area", function () {

        $("#mattress_area_for_construction_area").attr('value', (($("input[type=radio][name=dcr_b_val]").val() /
            100) * $(
            this).val()).toFixed(2));

    });

    $(document).on("change", "input[type=radio][name=dcr_b_val]", function () {

        $("#mattress_area_for_construction_area").attr('value', (($(this).val() / 100) * $(
            "#total_rehabilitation_construction_area").val()).toFixed(2));

    });

    $(document).on("keyup", ".remaining_area", function () {
        $("#remaining_area").attr('value', parseFloat($("#total_permissible_construction_area").val()) -
            parseFloat($(
                "#total_rehabilitation_construction_area").val()) - parseFloat($(
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
        var off_site_infra_fee = Math.ceil(substract * lr_cal);
        $("#off_site_infrastructure_fee").attr('value', off_site_infra_fee);

        $("#amount_to_be_paid_to_municipal").attr('value', Math.ceil(5 / 7 * off_site_infra_fee));
        $("#offsite_infrastructure_charge_to_mhada").attr('value', Math.ceil(2 / 7 * off_site_infra_fee ));
        $("#amount_to_b_paid_to_municipal_corporation").attr('value', Math.ceil(5 / 7 * off_site_infra_fee));

    });


  /*  $(document).on("keyup", "#existing_construction_area", function () {
        $("#amount_to_be_paid_to_municipal").attr('value', Math.ceil(5 / 7 * $(this).val()));
        $("#offsite_infrastructure_charge_to_mhada").attr('value', Math.ceil(2 / 7 * $(this).val()));
        $("#amount_to_b_paid_to_municipal_corporation").attr('value', Math.ceil(5 / 7 * $(this).val()));
    }); */


    $(document).on("keyup", "#total_house", function () {
        $("#layout_approval_fee").attr('value', 1000 * $(this).val());

    });



    $(document).on("keyup", ".total_amount_in_rs", function () {
        var total_amount_in_rs = 0;
        $(".total_amount_in_rs").each(function () {
            total_amount_in_rs += +$(this).val();
        });
        $("#total_amount_in_rs").attr('value', Math.ceil(total_amount_in_rs));
    });

    $(document).on("change", "input[type=radio][name=dcr_a_val]", function () {

        var dcr_a_val = (isNaN($(this).val())) ? 0 : $(this).val();
        var permissible_mattress_area = (isNaN($("#permissible_mattress_area").val())) ? 0 : $(
            "#permissible_mattress_area").val();
        var total_house = (isNaN($("#total_house").val())) ? 0 : $("#total_house").val();

        var total_claims = (dcr_a_val / 100) * permissible_mattress_area * total_house;
        $("#total_additional_claims").attr('value', total_claims.toFixed(2));


        $("#total_rehabilitation_mattress_area_with_dcr").attr('value', parseFloat($("#total_additional_claims")
                .val()) +
            parseFloat($("#total_rehabilitation_mattress_area").val()));

        $("#total_rehabilitation_construction_area").attr('value', parseFloat($(
            "#total_rehabilitation_mattress_area_with_dcr").val()) * 1.2);
    });
    $(document).on("keyup", "#total_house, #permissible_mattress_area", function () {

        var dcr_a_val = (isNaN($("input[type=radio][name=dcr_a_val]:checked").val())) ? 0 : $(
            "input[type=radio][name=dcr_a_val]:checked").val();
        var permissible_mattress_area = (isNaN($("#permissible_mattress_area").val())) ? 0 : $(
            "#permissible_mattress_area").val();
        var total_house = (isNaN($("#total_house").val())) ? 0 : $("#total_house").val();

        var total_claims = (dcr_a_val / 100) * permissible_mattress_area * total_house;
        $("#total_additional_claims").attr('value', total_claims.toFixed(2));

        $("#total_rehabilitation_mattress_area_with_dcr").attr('value', parseFloat($("#total_additional_claims")
                .val()) +
            parseFloat($("#total_rehabilitation_mattress_area").val()));

        $("#total_rehabilitation_construction_area").attr('value', parseFloat($(
            "#total_rehabilitation_mattress_area_with_dcr").val()) * 1.2);

    });


    function PrintElem(elem) {
        var mywindow = window.open('', 'PRINT', 'height=600,width=600');
        mywindow.document.write('<html><head><title>Maharashtra Housing and development authority</title>');

        mywindow.document.write('</head><body>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    }
    $(window).on('popstate', function () {
        var anchor = location.hash ||
            $('a[data-toggle=\'tab\']').first().attr('href');
        $('a[href=\'' + anchor + '\']').tab('show');
    });

    // **End** Save tabs location on window refresh or submit

    $("#uploadBtn").click(function () {
        myfile = $("#test-upload").val();
        var ext = myfile.split('.').pop();
        if (myfile != '') {

            if (ext != "pdf") {
                $("#file_error").text("Invalid type of file uploaded (only pdf allowed).");
                return false;
            } else {
                $("#file_error").text("");
                return true;
            }
        } else {
            $("#file_error").text("This field required");
            return false;
        }
    });

    $(document).ready(function () {
        $(".display_msg").delay(5000).slideUp(300);
    });

</script>

@endsection
