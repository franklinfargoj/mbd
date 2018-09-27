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
            </div>
        </div>
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
                                <form  role="form" method="POST"  action="">
                                    <div class="d-flex justify-content-start align-items-center mb-4">
                                        <span class="flex-shrink-0 text-nowrap">Total Number of buildings:</span>
                                        <input type="text" class="form-control form-control--xs form-control--custom flex-grow-0 ml-3" name="total_no_of_buildings"
                                               id="total_no_of_buildings" value="" />
                                    </div>
                                <table class="table mb-0" style="padding-top: 10px;" >
                                    <input name="_token" type="hidden" value="" />
                                    <input name="application_id" type="hidden" value=""/>
                                    <input name="user_id" type="hidden" value=""/>
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
                                                कार्यकारी अभियंता /कुर्ला विभाग यांचे सिमांकन नकाशानुसार भूखंडाचे क्षेत्रफळ
                                            </td>
                                            <td class="text-center">
                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                1.टिट बिट भूखंडाचे क्षेत्र
                                            </td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="area_as_per_lease_agreement" id="area_as_per_lease_agreement" value="" />
                                            </td></td>
                                        </tr>
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