@extends('admin.layouts.app')
@section('content')

<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">
                <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom"
                    role="tablist">
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#one" role="tab"
                            aria-selected="false">
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
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#six" role="tab" aria-selected="true">
                            <i class="la la-bell-o"></i>REE - Note
                        </a>
                    </li>
                </ul>
            </div>
        </div>
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
                                <form  role="form" method="POST"  action="{{ route('save_calculation_details') }}">
                                    <div class="d-flex justify-content-start align-items-center mb-4">
                                        <span class="flex-shrink-0 text-nowrap">Total Number of buildings:</span>
                                        <input type="text" class="form-control form-control--xs form-control--custom flex-grow-0 ml-3" name="total_no_of_buildings"
                                               id="total_no_of_buildings" value="{{ isset($calculationSheetDetails[0]->total_no_of_buildings) ? $calculationSheetDetails[0]->total_no_of_buildings : '' }}" />
                                    </div>
                                <table class="table mb-0" style="padding-top: 10px;" >
                                    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                    <input name="application_id" type="hidden" value="{{ $applicationId }}"/>
                                    <input name="user_id" type="hidden" value="{{ $user->id }}"/>
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
                                                कार्यकारी अभियंता /कुर्ला विभाग यांचे सिमांकन नकाशानुसार
                                                भूखंडाचे क्षेत्रफळ
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
                                                <input type="text" class="form-control form-control--custom" name="area_as_per_lease_agreement"
                                                       id="area_as_per_lease_agreement" value="{{ isset($calculationSheetDetails[0]->area_as_per_lease_agreement) ? $calculationSheetDetails[0]->area_as_per_lease_agreement : 0 }}" />
                                            </td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                2. टिट बिट भूखंडाचे क्षेत्र
                                            </td>
                                            <td class="text-center">
                                                  <input type="text" class="total_area form-control form-control--custom" name="area_of_tit_bit_plot" id="area_of_tit_bit_plot" value="{{ isset($calculationSheetDetails[0]->area_of_tit_bit_plot) ? $calculationSheetDetails[0]->area_of_tit_bit_plot : 0 }}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                3. आर जी भूखंडाचे क्षेत्र
                                            </td>
                                            <td class="text-center">
                                                  <input type="text" class="total_area form-control form-control--custom" name="area_of_rg_plot" id="area_of_rg_plot" value="{{ isset($calculationSheetDetails[0]->area_of_rg_plot) ? $calculationSheetDetails[0]->area_of_rg_plot : 0 }}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                4. NTBNIB भूखंडाचे क्षेत्र
                                            </td>
                                            <td class="text-center">
                                                  <input type="text" class="total_area form-control form-control--custom" name="area_of_ntbnib_plot" id="area_of_ntbnib_plot" value="{{ isset($calculationSheetDetails[0]->area_of_ntbnib_plot) ? $calculationSheetDetails[0]->area_of_ntbnib_plot : 0 }}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="font-weight-bold">
                                                Total भूखंडाचे क्षेत्रफळ
                                            </td>
                                            <td class="text-center">
                                                <input class="form-control form-control--custom" readonly type="text" name="area_of_total_plot" id="area_of_total_plot" /></td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>
                                                अभिनण्यानुसार भूखंडाचे क्षेत्रफळ
                                            </td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="area_as_per_introduction" id="area_as_per_introduction" value="{{ isset($calculationSheetDetails[0]->area_as_per_introduction) ? $calculationSheetDetails[0]->area_as_per_introduction : 0 }}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>
                                                परिगणनाकरिता ग्राह्य भूखंडाचे क्षेत्रफळ (Min of 1 & 2)
                                            </td>
                                            <td class="text-center">
                                                <input type="text" class="permissible_area total_permissible form-control form-control--custom"  name="area_of_​​subsistence_to_calculate" id="area_of_​​subsistence_to_calculate" value="{{ isset($calculationSheetDetails[0]->area_of_​​subsistence_to_calculate) ? $calculationSheetDetails[0]->area_of_​​subsistence_to_calculate : 0 }}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>
                                                अनुज्ञेय चटई क्षेत्र निर्देशांक
                                            </td>
                                            <td class="text-center">
                                                <input type="text" class="permissible_area total_permissible form-control form-control--custom" name="permissible_carpet_area_coordinates" id="permissible_carpet_area_coordinates" value="{{ isset($calculationSheetDetails[0]->permissible_carpet_area_coordinates) ? $calculationSheetDetails[0]->permissible_carpet_area_coordinates : 0 }}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5.</td>
                                            <td>
                                                अनुज्ञेय बांधकाम क्षेत्रफळ
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="total_permissible form-control form-control--custom" name="permissible_construction_area" id="permissible_construction_area" value="{{ isset($calculationSheetDetails[0]->permissible_construction_area) ? $calculationSheetDetails[0]->permissible_construction_area : 0 }}"/>
                                                (Table1 Point 3 * Table 1 Point 4)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6.</td>
                                            <td>
                                                म.न.पा .कडून ल. ओ. आय. पत्रानुसार अनुज्ञेय प्रोरेटा
                                                क्षेत्रफळ
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
                                                <input type="text" class="proratata_area form-control form-control--custom" name="sqm_area_per_slot" id="sqm_area_per_slot" value="{{ isset($calculationSheetDetails[0]->sqm_area_per_slot) ? $calculationSheetDetails[0]->sqm_area_per_slot : 0 }}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                2. एकूण सदनिका
                                            </td>
                                            <td class="text-center">
                                                <input type="text" class="proratata_area total_permissible form-control form-control--custom" name="total_house" id="total_house" value="{{ isset($calculationSheetDetails[0]->total_house) ? $calculationSheetDetails[0]->total_house : 0 }}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="font-weight-bold">
                                                Total
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="form-control form-control--custom" name="permissible_proratata_area" id="permissible_proratata_area" />
                                                (प्रति सदनिका चौ मी क्षेत्रफळ * एकूण सदनिका)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7.</td>
                                            <td>
                                                अनुज्ञेय प्रोरेटा बांधकाम क्षेत्रफळ (85% पर्यंत सीमित )
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                1. प्रति सदनिका चौ मी प्रोरेटा बांधकाम क्षेत्रफळ
                                            </td>
                                            <td class="text-center">
                                                <input type="text" class="total_permissible form-control form-control--custom" name="per_sq_km_proyerta_construction_area" id="per_sq_km_proyerta_construction_area" value="{{ isset($calculationSheetDetails[0]->per_sq_km_proyerta_construction_area) ? $calculationSheetDetails[0]->per_sq_km_proyerta_construction_area : 0 }}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="font-weight-bold">
                                                Total
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="form-control form-control--custom" name="proratata_construction_area" id="proratata_construction_area" />
                                                (प्रति सदनिका चौ मी प्रोरेटा बांधकाम क्षेत्रफळ * एकूण
                                                सदनिका)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8.</td>
                                            <td>
                                                मा उपाध्यक्ष / प्रा यांचे अधिकारातील १०% राखीव कोट्यामधून
                                                संस्थेस वितरित करावयाचे क्षेत्रफळ
                                            </td>
                                            <td class="text-center">
                                                <input type="text" class="total_permissible form-control form-control--custom" name="area_in_reserved_seats_for_vp_pio" id="area_in_reserved_seats_for_vp_pio" value="{{ isset($calculationSheetDetails[0]->area_in_reserved_seats_for_vp_pio) ? $calculationSheetDetails[0]->area_in_reserved_seats_for_vp_pio : 0 }}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9.</td>
                                            <td>
                                                एकूण अनुज्ञेय बांधकाम क्षेत्रफळ (अ.क्र. ५ + ७ + 8)
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="remaining_area form-control form-control--custom" name="total_permissible_construction_area" id="total_permissible_construction_area" value="{{ isset($calculationSheetDetails[0]->total_permissible_construction_area) ? $calculationSheetDetails[0]->total_permissible_construction_area : 0 }}"/>
                                                tb1 pt 5 + tb1 pt 7
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10.</td>
                                            <td>
                                                अस्तित्वातील बांधकाम क्षेत्रफळ (सी - ५७)
                                            </td>
                                            <td class="text-center">
                                                <input type="text" class="remaining_area form-control form-control--custom" name="existing_construction_area" id="existing_construction_area" value="{{ isset($calculationSheetDetails[0]->existing_construction_area) ? $calculationSheetDetails[0]->existing_construction_area : 0 }}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>11.</td>
                                            <td>
                                                उर्वरित क्षेत्रफळ (अ.क्र 9. - अ.क्र.10 )
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="form-control form-control--custom" name="remaining_area" id="remaining_area" />
                                                (pt 9 - pt 10)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>12.</td>
                                            <td>
                                                रेडीरेकनर २०१८ - १९ , न. भू. क्र. ३५१ (पै), व्हिलेज-
                                                हरियाली ,
                                                टागोरनगर झोन क्रमांक. ११२/५३५, दर रुपये रु. ५५,९०० /-
                                                (पृष्ठ
                                                क्रमांक सी - ६०५ ते सी -६०७ )
                                            </td>
                                            <td class="text-center">
                                                <input type="text" class="redirekner_val form-control form-control--custom" name="redirekner_value" id="redirekner_value" value="{{ isset($calculationSheetDetails[0]->redirekner_value) ? $calculationSheetDetails[0]->redirekner_value : 0 }}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>13.</td>
                                            <td>
                                                बांधकामाचा दर (रेडीरेकनर २०१८-१९)
                                            </td>
                                            <td class="text-center">
                                                <input type="text" class="redirekner_val form-control form-control--custom" name="redirekner_construction_rate" id="redirekner_construction_rate" value="{{ isset($calculationSheetDetails[0]->redirekner_construction_rate) ? $calculationSheetDetails[0]->redirekner_construction_rate : 0 }}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>14.</td>
                                            <td>
                                                LR/RC = ५५,९००/२७५००
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="total_amount form-control form-control--custom"  name="redirekner_val" id="redirekner_val" />
                                                tb 1 pt 12 / tb 1 pt 13
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>15.</td>
                                            <td>
                                                उर्वरितचटईक्षेत्राचे अधिमूल्य
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                1. उर्वरित च.क्षे.रहिवासी वापर क्षेत्र
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="form-control form-control--custom" name="remaining_residential_area" id="remaining_residential_area" />
                                                tb 1 pt 11
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                2. दर (DCR % of tb 1 pt 12)
                                            </td>
                                            <td class="text-center">
                                                <span style="cursor: pointer" data-toggle="modal" data-target="#select-from-dcr">Select
                                                    from DCR</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                अधिमूल्य
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="form-control form-control--custom" name="balance_of_remaining_area" id="balance_of_remaining_area" />
                                                (tb 1 pt 15-1 * tb 1 pt 15-2)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>16.</td>
                                            <td>
                                                दि.०८.१०.२०१३ च्या अधिसूचनेमधील अनु.क्र.५ ए ,नुसार ७ % ऑफ
                                                इन्फ्रास्टक्चर शुल्क रक्कम
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="form-control form-control--custom" name="infrastructure_fee_amount" id="infrastructure_fee_amount" />
                                                (tb1 pt 11 * tb1 pt 12 * 7%)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>17.</td>
                                            <td>
                                                उपरोक्त ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क रकमेपैकी म.न.पा.स
                                                भरवायची ५/७ रक्कम (५/७ X अनु.क्र.१६)
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="total_amount form-control form-control--custom" name="amount_to_be_paid_to_municipal" id="amount_to_be_paid_to_municipal" />

                                                5/7 * tb 1 pt 16
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>18.</td>
                                            <td>
                                                म्हाडाकडे भरवायची ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क रक्कम (२/७
                                                *
                                                अनु.क्र.१६ )
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="total_amount form-control form-control--custom" name="offsite_infrastructure_charge_to_mhada" id="offsite_infrastructure_charge_to_mhada" />

                                                2/7 * tb1 pt 16
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>19.</td>
                                            <td>
                                                छाननी शुल्क
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="total_amount form-control form-control--custom" name="scrutiny_fee" id="scrutiny_fee" value="6000" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>20.</td>
                                            <td>
                                                अभिन्यास मंजुरी शुल्क रु,१०००/ - प्रति गाळा
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="total_amount form-control form-control--custom" name="layout_approval_fee" id="layout_approval_fee" />
                                                १००० * एकूण सदनिका
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>21.</td>
                                            <td>
                                                डेब्रिज रिमूव्हल शुल्क रु.६६००/- [for 1 building]
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="total_amount form-control form-control--custom" name="debraj_removal_fee" id="debraj_removal_fee" />

                                                ६,६००
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>22.</td>
                                            <td>
                                                पाणी वापर शुल्क (रु.१,००,०००/- ) [for 1 building]
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="form-control form-control--custom" name="water_usage_charges" id="water_usage_charges" />

                                                १,००,०००
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>23.</td>
                                            <td>
                                                एकूण रक्कम रुपये (अ .क्र.१५+१८+१९+२०+२१+२२)
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="form-control form-control--custom" name="total_amount_in_rs" id="total_amount_in_rs" />

                                                tb1 pt (१४+१७+१८+१९+ २०+२१)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>24.</td>
                                            <td>
                                                बृहनमुंबई महानगर पालिकेकडे ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क
                                                रक्कमपैकी भरणा करावयाची ५/७ रक्कम
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="form-control form-control--custom" name="offsite_infrastructure_charges_to_municipal_corporation" id="offsite_infrastructure_charges_to_municipal_corporation" />

                                                tb 1 pt 17
                                            </td>
                                        </tr>
                                          <tr><td colspan="3" align="right"><input type="submit" name="submit" class="btn btn-primary" value="Next" /> </td></tr>
                                    </tbody>
                                </table>

                                <div class="modal fade show" id="select-from-dcr" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">उर्वरितचटईक्षेत्राचे
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
                                                            <th>LR/LC</th>
                                                            <th>LR/LC</th>
                                                            <th>LR/LC</th>
                                                            <th>LR/LC</th>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>0 to 2</td>
                                                            <td class="position-relative">
                                                                <div class="m-radio--box">
                                                                    <label class="m-radio m-radio--box-label">
                                                                        <input type="radio"name="dcr_rate_in_percentage" id="dcr_rate_in_percentage"   value="40"  {{ $calculationSheetDetails[0]->dcr_rate_in_percentage == '40' ? 'checked' : '' }}>
                                                                        <span class="m-radio--box-span"><span>40%</span></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td class="position-relative">
                                                                <div class="m-radio--box">
                                                                    <label class="m-radio m-radio--box-label">
                                                                        <input type="radio"name="dcr_rate_in_percentage" id="dcr_rate_in_percentage"   value="60" {{ $calculationSheetDetails[0]->dcr_rate_in_percentage == '60' ? 'checked' : '' }}>
                                                                        <span class="m-radio--box-span"><span>60%</span></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td class="position-relative">
                                                                <div class="m-radio--box">
                                                                    <label class="m-radio m-radio--box-label">
                                                                        <input type="radio"name="dcr_rate_in_percentage" id="dcr_rate_in_percentage"   value="80" {{ $calculationSheetDetails[0]->dcr_rate_in_percentage == '80' ? 'checked' : '' }}>
                                                                        <span class="m-radio--box-span"><span>80%</span></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2 to 4</td>
                                                            <td class="position-relative"><div class="m-radio--box">
                                                                    <label class="m-radio m-radio--box-label">
                                                                        <input type="radio"name="dcr_rate_in_percentage" id="dcr_rate_in_percentage"   value="45" {{ $calculationSheetDetails[0]->dcr_rate_in_percentage == '45' ? 'checked' : '' }}>
                                                                        <span class="m-radio--box-span"><span>45%</span></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td class="position-relative"><div class="m-radio--box">
                                                                    <label class="m-radio m-radio--box-label">
                                                                        <input type="radio"name="dcr_rate_in_percentage" id="dcr_rate_in_percentage"   value="65" {{ $calculationSheetDetails[0]->dcr_rate_in_percentage == '65' ? 'checked' : '' }}>
                                                                        <span class="m-radio--box-span"><span>65%</span></span>
                                                                    </label>
                                                                </div></td>
                                                            <td class="position-relative"><div class="m-radio--box">
                                                                    <label class="m-radio m-radio--box-label">
                                                                        <input type="radio"name="dcr_rate_in_percentage" id="dcr_rate_in_percentage"   value="85" {{ $calculationSheetDetails[0]->dcr_rate_in_percentage == '85' ? 'checked' : '' }}>
                                                                        <span class="m-radio--box-span"><span>85%</span></span>
                                                                    </label>
                                                                </div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4 to 6</td>
                                                            <td class="position-relative"><div class="m-radio--box">
                                                                    <label class="m-radio m-radio--box-label">
                                                                        <input type="radio"name="dcr_rate_in_percentage" id="dcr_rate_in_percentage"   value="50" {{ $calculationSheetDetails[0]->dcr_rate_in_percentage == '50' ? 'checked' : '' }}>
                                                                        <span class="m-radio--box-span"><span>50%</span></span>
                                                                    </label>
                                                                </div></td>
                                                            <td class="position-relative"><div class="m-radio--box">
                                                                    <label class="m-radio m-radio--box-label">
                                                                        <input type="radio"name="dcr_rate_in_percentage" id="dcr_rate_in_percentage"   value="70" {{ $calculationSheetDetails[0]->dcr_rate_in_percentage == '70' ? 'checked' : '' }}>
                                                                        <span class="m-radio--box-span"><span>70%</span></span>
                                                                    </label>
                                                                </div></td>
                                                            <td class="position-relative"><div class="m-radio--box">
                                                                    <label class="m-radio m-radio--box-label">
                                                                        <input type="radio"name="dcr_rate_in_percentage" id="dcr_rate_in_percentage"   value="90" {{ $calculationSheetDetails[0]->dcr_rate_in_percentage == '90' ? 'checked' : '' }}>
                                                                        <span class="m-radio--box-span"><span>90%</span></span>
                                                                    </label>
                                                                </div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>above 6</td>
                                                            <td class="position-relative"><div class="m-radio--box">
                                                                    <label class="m-radio m-radio--box-label">
                                                                        <input type="radio"name="dcr_rate_in_percentage" id="dcr_rate_in_percentage"   value="55" {{ $calculationSheetDetails[0]->dcr_rate_in_percentage == '55' ? 'checked' : '' }}>
                                                                        <span class="m-radio--box-span"><span>55%</span></span>
                                                                    </label>
                                                                </div></td>
                                                            <td class="position-relative"><div class="m-radio--box">
                                                                    <label class="m-radio m-radio--box-label">
                                                                        <input type="radio"name="dcr_rate_in_percentage" id="dcr_rate_in_percentage"   value="75" {{ $calculationSheetDetails[0]->dcr_rate_in_percentage == '75' ? 'checked' : '' }}>
                                                                        <span class="m-radio--box-span"><span>75%</span></span>
                                                                    </label>
                                                                </div></td>
                                                            <td class="position-relative"><div class="m-radio--box">
                                                                    <label class="m-radio m-radio--box-label">
                                                                        <input type="radio"name="dcr_rate_in_percentage" id="dcr_rate_in_percentage"   value="95" {{ $calculationSheetDetails[0]->dcr_rate_in_percentage == '95' ? 'checked' : '' }}>
                                                                        <span class="m-radio--box-span"><span>95%</span></span>
                                                                    </label>
                                                                </div></td>
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
                                    <h3 class="section-title">
                                        अधिमूल्य रकमेचा चार सामान हफ्त्यांत भरणा करण्याबाबतचा प्रस्ताव
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                <form  role="form" method="POST"  action="{{ route('save_calculation_details') }}">
                                    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                    <input name="application_id" type="hidden" value="{{ $applicationId }}"/>
                                    <input name="user_id" type="hidden" value="{{ $user->id }}"/>
                                <table class="table mb-0">
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
                                                उर्वरितचटई क्षेत्राचे अधिमूल्य
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                उर्वरितच क्षे निरहिवासी वापर क्षेत्र
                                            </td>
                                            <td class="text-center">
                                                <input type="text"  class="form-control form-control--custom" name="remaining_area_of_resident_area" id="remaining_area_of_resident_area" value="{{ isset($calculationSheetDetails[0]->remaining_area_of_resident_area) ? $calculationSheetDetails[0]->remaining_area_of_resident_area : 0 }}" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                दर रु
                                            </td>
                                            <td class="text-center">
                                                <input type="text"  class="form-control form-control--custom" name="remaining_area_of_resident_area_rate" id="remaining_area_of_resident_area_rate" value="{{ isset($calculationSheetDetails[0]->remaining_area_of_resident_area_rate) ? $calculationSheetDetails[0]->remaining_area_of_resident_area_rate : 0 }}" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                अधिमूल्य
                                            </td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="remaining_area_of_resident_area_balance" id="remaining_area_of_resident_area_balance" value="{{ isset($calculationSheetDetails[0]->remaining_area_of_resident_area_balance) ? $calculationSheetDetails[0]->remaining_area_of_resident_area_balance : 0 }}" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>
                                                दि ०८.१०.२०१३ च्या अधिसूचने मधील अनु क्र ५या, नुसार ७% ऑफ
                                                साईट इन्फ्रास्ट्रुक्चर शुल्क - { (रे रे दर [table pt 11] *
                                                ७% ) } * { (३.० च क्षे नि प्रमाणे + प्रोरातक्षेत्रफ़ळ,
                                                [table 1 pt 8]) - (अस्तित्वातील बांधकाम क्षेत्रफळ [table 1
                                                pt 9]) }
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="form-control form-control--custom" name="off_site_infrastructure_fee" id="off_site_infrastructure_fee" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>
                                                उपरोक्त ऑफ साईट इन्फ्रास्ट्रक्चर शुक्ल रक्कमेपैकी म न प स
                                                भरावयाची ५/७ रक्कम (५/७ * अनु क्र २)
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="form-control form-control--custom" name="amount_to_be_paid_to_municipal1" id="amount_to_be_paid_to_municipal1" />

                                                (5/7 * table 2 pt 2)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>
                                                म्हाडाकडे भरावयाची ऑफ साईट इन्फ्रास्ट्रुक्चर शुल्क रक्कम
                                                (२/७ * अनु क्र २)
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="form-control form-control--custom" name="offsite_infrastructure_charge_to_mhada1" id="offsite_infrastructure_charge_to_mhada1" />


                                                (2/7 * table 2 pt 2)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5.</td>
                                            <td class="font-weight-bold">
                                                १/४ अधिमूल्यापोटी शुल्क
                                            </td>
                                            <td class="text-center">
                                                <input type="text" readonly class="form-control form-control--custom" name="non_profit_duty" id="non_profit_duty" />

                                                (Table 2 pt 1 amount * 1/4)
                                            </td>
                                        </tr>
                                        <tr><td colspan="3" align="right"><input type="submit" name="submit" class="btn btn-primary" value="Next" /> </td></tr>
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
                                    <h3 class="section-title">
                                        पहिल्या हप्त्याची रक्कम
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                <table class="table mb-0">
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
                                                १/४ अधिमूल्यापोटी शुल्क (उर्वरितचटईक्षेत्राचे अधिमूल्य च्या
                                                १/४)
                                            </td>
                                            <td class="text-center">
                                                (Table 2 pt 1 amount * 1/4)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>
                                                म्हाडा कडे भरावयाची ऑफ साईट इन्फ्रास्ट्रुक्चर शुल्क रक्कम
                                                (२/७ * ऑफ साईट इन्फ्रास्ट्रुक्चर शुल्क)
                                            </td>
                                            <td class="text-center">
                                                (2/7 * Table 2 pt 2 amount)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>
                                                छाननी शुल्क
                                            </td>
                                            <td class="text-center">
                                                ६०००
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>
                                                अभिन्यास मंजुरी शुल्क रु १,०००/- प्रति गळा
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5.</td>
                                            <td>
                                                डेब्रिज रिमूव्हल शुल्क रु ६६०० /-
                                            </td>
                                            <td class="text-center">
                                                ६६००
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6.</td>
                                            <td>
                                                पाणी वापर शुल्क (रु १,००,०००/-)
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7.</td>
                                            <td class="font-weight-bold">
                                                एकूण मंडळाकडे भरणा करावयाची पहिल्या हप्त्याची रक्कम
                                                पूर्णांकामधे
                                            </td>
                                            <td class="text-center">

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
                                        मंडळाकडे एकूण भरणा करावयाच्या रकमेचा गोषवारा
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                <table class="table mb-0">
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
                                                १/४ अधिमूल्यापोटी शुल्क<span class="hint-text"><small>(उर्वरितचटईक्षेत्राचे
                                                        अधिमूल्य च्या १/४)</small></span>
                                            </td>
                                            <td class="text-center">
                                                (Table 2 pt 2)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>
                                                मंडळाकडे भरणा करावयाच्या दुसऱ्या, तिसऱ्या व चौथ्या
                                                हफ्त्याची रक्कम पूर्णांकामध्ये
                                            </td>
                                            <td class="text-center">

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
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        अधिमूल्य रकमेचा चार सामान हफ्त्यांत भरणा करण्याबाबतचा प्रस्ताव
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                <table class="table mb-0">
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
                                                मंडळाकडे देकारपत्र जरी केल्याच्या दिनांकापासून पहिल्या सहा
                                                महिन्या पर्यंत भरणा करावयाची पहिल्या हफ्त्याची रक्कम
                                            </td>
                                            <td class="text-center">
                                                (Table 3 pt 7)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>
                                                मंडळाकडे पहिले देकारपत्र जारी केल्याच्या दिनांकापासून एक
                                                वर्षाच्या आत, भरणा करावयाची दुसऱ्या हफ्त्याची रक्कम तसेच
                                                प्रत्यक्ष भरेपर्यंत प्रथम देकारपात्राच्या दिनांकापासून १२%
                                                (दार तिमाहीला परिगणनीय दराने) अधिक रकमेचा भरणा करावा लागेल
                                            </td>
                                            <td class="text-center">
                                                (Table 4 pt 2 + interest)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>
                                                मंडळाकडे पहिले देकारपत्र जारी केल्याच्या दिनांकापासून दोन
                                                वर्षाच्या आत, भरणा करावयाची तीसऱ्या हफ्त्याची रक्कम तसेच
                                                प्रत्यक्ष भरेपर्यंत प्रथम देकारपात्राच्या दिनांकापासून १२%
                                                (दर तिमाहीला परिगणनीय दराने) अधिक रकमेचा भरणा करावा लागेल
                                            </td>
                                            <td class="text-center">
                                                (Table 4 pt 2 + interest)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>
                                                मंडळाकडे पहिले देकारपत्र जारी केल्याच्या दिनांकापासून तीन
                                                वर्षाच्या आत, भरणा करावयाची चौथ्या हफ्त्याची रक्कम तसेच
                                                प्रत्यक्ष भरेपर्यंत प्रथम देकारपात्राच्या दिनांकापासून १२%
                                                (दर तिमाहीला परिगणनीय दराने) अधिक रकमेचा भरणा करावा लागेल
                                            </td>
                                            <td class="text-center">
                                                (Table 4 pt 2 + interest)
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="six" role="tabpanel">
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
                                                <h5>Download Note</h5>
                                                <span class="hint-text">Download REE Note uploaded by REE</span>
                                                <div class="mt-auto">
                                                    <button class="btn btn-primary">Download Note Format</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 border-left">
                                            <div class="d-flex flex-column h-100 two-cols">
                                                <h5>Upload Note</h5>
                                                <span class="hint-text">Click on 'Upload' to upload REE - Note</span>
                                                <form action="" method="post">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" name="" type="file" id="test-upload"
                                                            required="">
                                                        <label class="custom-file-label" for="test-upload">Choose file ...</label>
                                                    </div>
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
            var sum = 0;
            $(".total_area").each(function(){
                sum += +$(this).val();
            });
            $("#area_of_total_plot").val(sum);

            $("#permissible_construction_area").val($("#area_of_​​subsistence_to_calculate").val()*$("#permissible_carpet_area_coordinates").val());

            $("#permissible_proratata_area").val($("#sqm_area_per_slot").val()*$("#total_house").val());

            $("#proratata_construction_area").val($("#per_sq_km_proyerta_construction_area").val()*$("#total_house").val());


            var sub = parseFloat($("#total_permissible_construction_area").val()) - parseFloat($("#existing_construction_area").val());
            $("#remaining_area").val(sub);
            $("#remaining_residential_area").val(sub);



            if (parseFloat($("#redirekner_construction_rate").val()) === 0 || isNaN(parseFloat($("#redirekner_construction_rate").val()))) {
                $("#redirekner_val").val(null);
            }
            else {
                var div = parseFloat($("#redirekner_value").val()) / parseFloat($("#redirekner_construction_rate").val());
                $("#redirekner_val").val(div.toFixed(2));
            }


            var balance = $("#remaining_residential_area").val() * ( $("input[name=dcr_rate_in_percentage]:checked").val() / 100 ) ;
            $("#balance_of_remaining_area").val(balance.toFixed(2));


            $("#infrastructure_fee_amount").val((parseFloat($("#remaining_area").val()) * parseFloat($("#redirekner_value").val()) * (7/100)).toFixed(2));

            var fee_amount = (parseFloat($("#remaining_area").val()) * parseFloat($("#redirekner_value").val()) * (7/100)).toFixed(2);
            $("#infrastructure_fee_amount").val(fee_amount);
            $("#amount_to_be_paid_to_municipal").val(5/7 * fee_amount);
            $("#offsite_infrastructure_charges_to_municipal_corporation").val(5/7 * fee_amount);
            $("#offsite_infrastructure_charge_to_mhada").val(2/7 * fee_amount);

            $("#layout_approval_fee").val(1000*$("#total_house").val());


            $("#debraj_removal_fee").val(6600 * $("#total_no_of_buildings").val());
            $("#water_usage_charges").val(100000 * $("#total_no_of_buildings").val());

            var total_amount = 0;
            $(".total_amount").each(function(){
                total_amount += +$(this).val();
            });
            $("#total_amount_in_rs").val(total_amount);



            var offsite_infra_fee = ($("#remaining_area").val() * (7/100)) * ($("#area_in_reserved_seats_for_vp_pio").val() - $("#total_permissible_construction_area").val());

            $("#off_site_infrastructure_fee").val(offsite_infra_fee.toFixed(2));

            $("#amount_to_be_paid_to_municipal1").val(5/7 * offsite_infra_fee.toFixed(2));
            $("#offsite_infrastructure_charge_to_mhada1").val(2/7 * offsite_infra_fee.toFixed(2));

            $("#non_profit_duty").val(1/4 * $("#remaining_area_of_resident_area_balance").val());

        })
    </script>
    <script>
        $(document).on("keyup", "#total_no_of_buildings", function() {
            $("#debraj_removal_fee").val(6600 * $("#total_no_of_buildings").val());
            $("#water_usage_charges").val(100000 * $("#total_no_of_buildings").val());
        });

        $(document).on("keyup", ".total_area", function() {
            var sum = 0;
            $(".total_area").each(function(){
                sum += +$(this).val();
            });
            $("#area_of_total_plot").val(sum);
        });

        $(document).on("keyup", ".permissible_area", function() {

            $("#permissible_construction_area").val($("#area_of_​​subsistence_to_calculate").val()*$("#permissible_carpet_area_coordinates").val());
        });


        $(document).on("keyup", ".proratata_area", function() {

            $("#permissible_proratata_area").val($("#sqm_area_per_slot").val()*$("#total_house").val());
        });

        $(document).on("keyup", "#per_sq_km_proyerta_construction_area", function() {

            $("#proratata_construction_area").val($(this).val()*$("#total_house").val());
        });

        $(document).on("keyup", "#total_house", function() {

            $("#proratata_construction_area").val($("#per_sq_km_proyerta_construction_area").val()*$(this).val());
            $("#layout_approval_fee").val(1000*$(this).val());
        });


        $(document).on("keyup", ".total_permissible", function() {

            var total = parseFloat($("#permissible_construction_area").val()) + parseFloat($("#proratata_construction_area").val()) + parseFloat($('#area_in_reserved_seats_for_vp_pio').val());
            $("#total_permissible_construction_area").val(total);
        });

        $(document).on("keyup", ".remaining_area", function() {

            if(parseFloat($("#total_permissible_construction_area").val()) <  parseFloat($("#existing_construction_area").val()) )
            {
                alert('अस्तित्वातील बांधकाम क्षेत्रफळ should be less than एकूण अनुज्ञेय बांधकाम क्षेत्रफळ'); return false;

            }

            var sub = parseFloat($("#total_permissible_construction_area").val()) - parseFloat($("#existing_construction_area").val());
            $("#remaining_area").val(sub);
            $("#remaining_residential_area").val(sub);

            var balance = $("#remaining_residential_area").val() * ( $("input[type=radio][name=dcr_rate_in_percentage]").val() / 100 ) ;
            $("#balance_of_remaining_area").val(balance.toFixed(2));

        });


        $(document).on("keyup", ".redirekner_val", function() {

            if (parseFloat($("#redirekner_construction_rate").val()) === 0 || isNaN(parseFloat($("#redirekner_construction_rate").val()))) {
                $("#redirekner_val").val(null);
            }
            else {
                var div = parseFloat($("#redirekner_value").val()) / parseFloat($("#redirekner_construction_rate").val());
                $("#redirekner_val").val(div.toFixed(2));
            }


        });


        $(document).on("change", "input[type=radio][name=dcr_rate_in_percentage]", function() {

            var balance = $("#remaining_residential_area").val() * ( $(this).val() / 100 ) ;
            $("#balance_of_remaining_area").val(balance.toFixed(2));
        });


        $(document).on("keyup", "#redirekner_value", function() {
            var fee_amount = (parseFloat($("#remaining_area").val()) * parseFloat($("#redirekner_value").val()) * (7/100)).toFixed(2);
            $("#infrastructure_fee_amount").val(fee_amount);
            $("#amount_to_be_paid_to_municipal").val(5/7 * fee_amount);
            $("#offsite_infrastructure_charges_to_municipal_corporation").val(5/7 * fee_amount);
            $("#offsite_infrastructure_charge_to_mhada").val(2/7 * fee_amount);

            var total_amount = 0;
            $(".total_amount").each(function(){
                total_amount += +$(this).val();
            });
            $("#total_amount_in_rs").val(total_amount);

        });

        $(document).on("keyup", "#remaining_area_of_resident_area_balance", function() {
            $("#non_profit_duty").val(1/4 * $("#remaining_area_of_resident_area_balance").val());
        });


    </script>
@endsection
