@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.'.$folder.'.action_noc',compact('noc_application'))
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
                {{ Breadcrumbs::render('calculation_sheet',$noc_application->id) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
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
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#five" role="tab" aria-selected="false">
                    <i class="la la-briefcase"></i>Concession Sheet
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#six" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i>REE - Note
                </a>
            </li>
        </ul>
        <div class="tab-content">
        <div class="tab-pane active show" id="one" role="tabpanel">
        <form role="form" method="POST" action="{{ route('save_noc_sharing_calculation_details') }}">
            <div id="print_one">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">तक्ता - अ</h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                    <input name="application_id" type="hidden" value="{{ $noc_application->id }}" />
                                    <input name="user_id" type="hidden" value="{{ $user->id }}" />
                                    <input name="society_id" type="hidden" value="{{ $noc_application->society_id }}" />
                                    <input name="redirect_tab" type="hidden" value="two" />
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                                src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("print_one");'
                                                style="max-width: 22px" class="printBtn"></a>
                                    </div>
                                    <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs" style = "border-style: ridge;">
                                                    Sr.no
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
                                                    <input style="border: none;" type="text" placeholder="0" class="total_area form-control form-control--custom txtbox"
                                                        name="area_as_per_lease_agreement" id="area_as_per_lease_agreement"
                                                        value="{{ isset($calculation) ? $calculation->area_as_per_lease_agreement : ''  }}" {{$readonly}}/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    2. टिट बिट भूखंडाचे क्षेत्र
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" class="total_area form-control form-control--custom txtbox"
                                                        name="area_of_tit_bit_plot" id="area_of_tit_bit_plot" value="{{ isset($calculation) ? $calculation->area_of_tit_bit_plot : ''  }}" {{$readonly}}/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td class="font-weight-bold" style = "border-style: ridge;">
                                                    Total भूखंडाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" placeholder="0" class="min_val_for_calculation form-control form-control--custom txtbox"
                                                        readonly type="text" name="area_of_total_plot" id="area_of_total_plot"
                                                        value="{{ isset($calculation) ? $calculation->area_of_total_plot : ''  }}" {{$readonly}}/>
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
                                                    <input style="border: none;" type="text" placeholder="0" class="abhinyas_total_area  form-control form-control--custom txtbox"
                                                        name="abhinyas_area_as_per_lease_agreement" id="abhinyas_area_as_per_lease_agreement"
                                                        value="{{ isset($calculation) ? $calculation->abhinyas_area_as_per_lease_agreement : ''  }}" {{$readonly}}/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    2. टिट बिट भूखंडाचे क्षेत्र
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" class="abhinyas_total_area form-control form-control--custom txtbox"
                                                        name="abhinyas_area_of_tit_bit_plot" id="abhinyas_area_of_tit_bit_plot"
                                                        value="{{ isset($calculation) ? $calculation->abhinyas_area_of_tit_bit_plot : ''  }}" {{$readonly}}/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td class="font-weight-bold" style = "border-style: ridge;">
                                                    Total भूखंडाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="min_val_for_calculation form-control form-control--custom txtbox" placeholder="0"
                                                        readonly type="text" name="abhinyas_area_of_total_plot" id="abhinyas_area_of_total_plot"
                                                        value="{{ isset($calculation) ? $calculation->abhinyas_area_of_total_plot : ''  }}" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">3.</td>
                                                <td style = "border-style: ridge;">
                                                    परिगणनाकरिता ग्राह्य भूखंडाचे क्षेत्रफळ (किमान क्षेत्र)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" readonly class="infra_fee form-control form-control--custom txtbox" placeholder="0"
                                                           type="text" name="area_of_​​subsistence_to_calculate" id="area_of_​​subsistence_to_calculate"
                                                           value="{{ isset($calculation) ? $calculation->area_of_​​subsistence_to_calculate : ''  }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">4.</td>
                                                <td style = "border-style: ridge;">
                                                    अनुज्ञेय चटई क्षेत्र निर्देशांक
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="remaining_area infra_fee form-control form-control--custom txtbox" placeholder="0"
                                                        type="text" name="permissible_carpet_area_coordinates" id="permissible_carpet_area_coordinates"
                                                        value="{{ isset($calculation) ? $calculation->permissible_carpet_area_coordinates : ''  }}" {{$readonly}}/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">5.</td>
                                                <td style = "border-style: ridge;">
                                                    अनुज्ञेय बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                        name="permissible_construction_area" id="permissible_construction_area"
                                                        value="{{ isset($calculation) ? $calculation->permissible_construction_area : ''  }}"/>

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
                                                    <input style="border: none;" class="remaining_area infra_fee form-control form-control--custom txtbox" placeholder="0"
                                                        type="text" name="sqm_area_per_slot" id="sqm_area_per_slot"
                                                        value="{{ isset($calculation) ? $calculation->sqm_area_per_slot : ''  }}" {{$readonly}}/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    2. एकूण सदनिका
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="remaining_area infra_fee form-control form-control--custom txtbox" placeholder="0"
                                                        type="text" name="total_house" id="total_house" value="{{ isset($calculation) ? $calculation->total_house : ''  }}" {{$readonly}}/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td class="font-weight-bold" style = "border-style: ridge;">
                                                    Total
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="remaining_area form-control form-control--custom txtbox" placeholder="0"
                                                        readonly type="text" name="permissible_proratata_area" id="permissible_proratata_area"
                                                        value="{{ isset($calculation) ? $calculation->permissible_proratata_area : ''  }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">7.</td>
                                                <td style = "border-style: ridge;">
                                                    एकूण अनुज्ञेय बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="remaining_area form-control form-control--custom txtbox"  readonly type="text" placeholder="0"
                                                        name="total_permissible_construction_area" id="total_permissible_construction_area"
                                                        value="{{ isset($calculation) ? $calculation->total_permissible_construction_area : ''  }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">8.</td>
                                                <td style = "border-style: ridge;">
                                                    अनुज्ञेय चटई क्षेत्रफळ प्रतिगाळा
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="remaining_area form-control form-control--custom txtbox" placeholder="0"
                                                        type="text" name="permissible_mattress_area" id="permissible_mattress_area"
                                                        value="{{ isset($calculation) ? $calculation->permissible_mattress_area : ''  }}" {{$readonly}}/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">9.</td>
                                                <td style = "border-style: ridge;">
                                                    सुधारित वि नि नि ३३(५) प्रमाणे अनुज्ञेय चटई क्षेत्रफळ वर ३५%
                                                    प्रतिगाळा
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                        name="revised_permissible_mattress_area" id="revised_permissible_mattress_area"
                                                        value="{{ isset($calculation) ? $calculation->revised_permissible_mattress_area : ''  }}" />

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
                                                    <input style="border: none;" class="remaining_area form-control form-control--custom txtbox" placeholder="0"
                                                        type="text" name="revised_increased_area_for_residential_use"
                                                        id="revised_increased_area_for_residential_use" value="{{ isset($calculation) ? $calculation->revised_increased_area_for_residential_use : ''  }}" {{$readonly}}/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">11.</td>
                                                <td style = "border-style: ridge;">
                                                    एकूण पुनर्वसन चटई क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                        name="total_rehabilitation_mattress_area" id="total_rehabilitation_mattress_area"
                                                        value="{{ isset($calculation) ? $calculation->total_rehabilitation_mattress_area : ''  }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">12.</td>
                                                <td style = "border-style: ridge;">
                                                    सादर प्रकरणामध्ये भूखंड हा ४००० चौ मी पेक्षा कमी असल्याने DCR टेबल
                                                    अ नुसार अतिरिक्त हक्क
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <span style="cursor: pointer" data-toggle="modal" data-target="#dcr-a-modal" class="subtn">
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
                                                    <input style="border: none;" readonly class="form-control form-control--custom txtbox" type="text" placeholder="0"
                                                        name="total_additional_claims" id="total_additional_claims"
                                                        value="{{ isset($calculation) ? $calculation->total_additional_claims : ''  }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">13.</td>
                                                <td style = "border-style: ridge;">
                                                    एकूण पुनर्वसन चटई क्षेत्र फळ

                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                        name="total_rehabilitation_mattress_area_with_dcr" id="total_rehabilitation_mattress_area_with_dcr"
                                                        value="{{ isset($calculation) ? $calculation->total_rehabilitation_mattress_area_with_dcr : ''  }}" />

                                                </td>
                                            </tr>

                                            <tr>
                                                <td style = "border-style: ridge;">14.</td>
                                                <td style = "border-style: ridge;">
                                                    एकूण पुनर्वसन बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="remaining_area form-control form-control--custom txtbox" placeholder="0"
                                                        readonly type="text" name="total_rehabilitation_construction_area"
                                                        id="total_rehabilitation_construction_area" value="{{ isset($calculation) ? $calculation->total_rehabilitation_construction_area : ''  }}" />

                                                </td>
                                            </tr>
                                            @if($visible == true)
                                            <tr>
                                                <td colspan="3" align="right">
                                                <input type="submit" name="submit" class="btn btn-primary subtn"
                                                        value="Next" /> </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                                            {{ isset($calculation) && $calculation->dcr_a_val == 'nil' ? 'checked' : '' }}>
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
                                                            {{ isset($calculation->dcr_a_val) && $calculation->dcr_a_val == '15' ? 'checked' : '' }}>
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
                                                            {{ isset($calculation->dcr_a_val) && $calculation->dcr_a_val == '25' ? 'checked' : '' }}>
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
                                                            {{ isset($calculation->dcr_a_val) && $calculation->dcr_a_val == '35' ? 'checked' : '' }}>
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
                                                            {{ isset($calculation->dcr_a_val) && $calculation->dcr_a_val == '45' ? 'checked' : '' }}>
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
            <div class="tab-pane" id="two" role="tabpanel">
                <form role="form" method="POST" action="{{ route('save_noc_sharing_calculation_details') }}">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                        <div class="portlet-body" id="print_two">
                            <div class="m-portlet__body m-portlet__body--table">
                                <div class="m-subheader">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h3 class="section-title">Table B</h3>
                                    </div>
                                </div>
                                <div id="two" class="m-section__content mb-0 table-responsive">
                                        <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                        <input name="application_id" type="hidden" value="{{ $noc_application->id }}" />
                                        <input name="user_id" type="hidden" value="{{ $user->id }}" />
                                        <input name="society_id" type="hidden" value="{{ $noc_application->society_id }}" />
                                        <input name="redirect_tab" type="hidden" value="three" />
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("print_two");' style="max-width: 22px" class="printBtn"></a>
                                        </div>
                                        <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                            <thead class="thead-default">
                                                <tr>
                                                    <th class="table-data--xs" style = "border-style: ridge;">
                                                        Sr.no
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
                                                        LR
                                                    </td>
                                                    <td class="text-center" style = "border-style: ridge;">
                                                        <input class="infra_fee form-control form-control--custom txtbox" type="text" placeholder="0"
                                                            name="lr_val" id="lr_val" value="{{ isset($calculation) ? $calculation->lr_val : ''  }}" {{$readonly}}/>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style = "border-style: ridge;">2.</td>
                                                    <td style = "border-style: ridge;">
                                                        RC
                                                    </td>
                                                    <td class="text-center" style = "border-style: ridge;">
                                                        <input style="border: none;" class="form-control form-control--custom txtbox" type="text" name="rc_val" placeholder="0"
                                                            id="rc_val" value="{{ isset($calculation) ? $calculation->rc_val : ''  }}" {{$readonly}}/>

                                                    </td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style = "border-style: ridge;">3.</td>
                                                    <td style = "border-style: ridge;">
                                                        LC/RC
                                                    </td>
                                                    <td class="text-center" style = "border-style: ridge;">
                                                        <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                            name="lr_rc_division_val" id="lr_rc_division_val" value="{{ isset($calculation) ? $calculation->lr_rc_division_val : ''  }}" />

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style = "border-style: ridge;">4.</td>
                                                    <td style = "border-style: ridge;">
                                                        सुधारित वि नि नि ३३(५) मधील तक्त्या नुसार LC/RC करिता प्रोत्साहन
                                                        क्षेत्रफळ
                                                    </td>
                                                    <td class="text-center" style = "border-style: ridge;">
                                                        <span class="subtn" style="cursor: pointer" data-toggle="modal" data-target="#dcr-b-modal">
                                                            DCR B
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style = "border-style: ridge;">5.</td>
                                                    <td style = "border-style: ridge;">
                                                        बांधकाम क्षेत्रफलकरीता प्रोत्साहन चटई क्षेत्रफळ
                                                    </td>
                                                    <td  class="text-center" style = "border-style: ridge;">
                                                        <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                            name="mattress_area_for_construction_area" id="mattress_area_for_construction_area"
                                                            value="{{ isset($calculation) ? $calculation->mattress_area_for_construction_area : ''  }}" />

                                                    </td>
                                                </tr>
                                                @if($visible == true)
                                                <tr>
                                                    <td colspan="3" align="right"><input type="submit" name="submit" class="btn btn-primary subtn"
                                                            value="Next" /> </td>
                                                </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                                    {{ isset($calculation->dcr_b_val) && $calculation->dcr_b_val == '40' ? 'checked' : '' }}>
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
                                                                    {{ isset($calculation->dcr_b_val) && $calculation->dcr_b_val == '50' ? 'checked' : '' }}>
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
                                                                    {{ isset($calculation->dcr_b_val) && $calculation->dcr_b_val == '60' ? 'checked' : '' }}>
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
                                                                    {{ isset($calculation->dcr_b_val) && $calculation->dcr_b_val == '70' ? 'checked' : '' }}>
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
                                                                    {{ isset($calculation->dcr_b_val) && $calculation->dcr_b_val == '45' ? 'checked' : '' }}>
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
            <div class="tab-pane" id="three" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">Table C</h3>
                                </div>
                            </div>
                            <form role="form" method="POST" action="{{ route('save_noc_sharing_calculation_details') }}">
                            <div id="print_three" class="m-section__content mb-0 table-responsive">
                                    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                    <input name="application_id" type="hidden" value="{{ $noc_application->id }}" />
                                    <input name="user_id" type="hidden" value="{{ $user->id }}" />
                                    <input name="society_id" type="hidden" value="{{ $noc_application->society_id }}" />
                                    <input name="redirect_tab" type="hidden" value="four" />
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("print_three");'
                                                style="max-width: 22px" class="printBtn"></a>
                                    </div>
                                    <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs" style = "border-style: ridge;">
                                                    Sr.no
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
                                                    उर्वरित क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                        name="remaining_area" id="remaining_area" 
                                                        value="{{ isset($calculation) ? $calculation->remaining_area : ''  }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">2.</td>
                                                <td style = "border-style: ridge;">
                                                    LC/RC
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                        name="lr_rc_division_val" id="lr_rc_division_val" value="{{ isset($calculation) ? $calculation->lr_rc_division_val : ''  }}" />

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
                                                    <span style="cursor: pointer" data-toggle="modal" data-target="#select-dcr" class="subtn">
                                                        DCR C
                                                    </span>
                                                    <input type="hidden" name="dcr_c_mhada_val" id="dcr_c_mhada_val" value="0" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">4.</td>
                                                <td style = "border-style: ridge;">
                                                    संस्थेचा हिस्सा
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                        name="society_share" id="society_share" 
                                                        value="{{ isset($calculation) ? $calculation->society_share : ''  }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">5.</td>
                                                <td style = "border-style: ridge;">

                                                    म्हाडाचा हिस्सा

                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                        name="mhada_share" id="mhada_share" value="{{ isset($calculation) ? $calculation->mhada_share : ''  }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">6.</td>
                                                <td style = "border-style: ridge;">

                                                    फंजिबल सह म्हाडाचा हिस्सा

                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                        name="mhada_share_with_fungib" id="mhada_share_with_fungib"
                                                        value="{{ isset($calculation) ? $calculation->mhada_share_with_fungib : ''  }}" />

                                                </td>
                                            </tr>
                                            @if($visible == true)
                                            <tr>
                                                <td colspan="3" align="right">
                                                <input type="submit" name="submit" class="btn btn-primary subtn"
                                                        value="Next" /> </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal fade show table-c-modal" id="select-dcr" tabindex="-1"
                                     role="dialog" aria-labelledby="exampleModalLabel">
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
                                                    <table class="table text-center table--dark table--dark--rows">
                                                        <thead>
                                                        <th>Basic ratio (LC/RC)</th>
                                                        <th>Cooprative society share</th>
                                                        <th>Mhada share</th>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td class="position-relative">
                                                                <label class="m-radio m-radio--row" for="test">
                                                                    <input type="radio" id="test" name="dcr_c_society_val" value="30">
                                                                    <span class="m-radio--row__span">
                                                                            <span>Above 6.00</span>
                                                                        </span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <span>30%</span>
                                                            </td>
                                                            <td>
                                                                <span>70%</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="position-relative">
                                                                <label class="m-radio m-radio--row" for="test1">
                                                                    <input type="radio" id="test1" name="dcr_c_society_val" value="35">
                                                                    <span class="m-radio--row__span">
                                                                            <span>Above 4.00 and upto 6.00</span>
                                                                        </span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <span>35%</span>
                                                            </td>
                                                            <td>
                                                                <span>65%</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="position-relative">
                                                                <label class="m-radio m-radio--row" for="test3">
                                                                    <input type="radio" id="test3" name="dcr_c_society_val" value="40">
                                                                    <span class="m-radio--row__span">
                                                                            <span>Above 2.00 and upto 4.00</span>
                                                                        </span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <span>40%</span>
                                                            </td>
                                                            <td>
                                                                <span>60%</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="position-relative">
                                                                <label class="m-radio m-radio--row" for="test4">
                                                                    <input type="radio" id="test4" name="dcr_c_society_val" value="45">
                                                                    <span class="m-radio--row__span">
                                                                            <span>Upto 2.00</span>
                                                                        </span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <span>45%</span>
                                                            </td>
                                                            <td>
                                                                <span>55%</span>
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
            <div class="tab-pane" id="four" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">Table D</h3>
                                </div>
                            </div>
                            <div id="print_four" class="m-section__content mb-0 table-responsive">
                                <form role="form" method="POST" action="{{ route('save_noc_sharing_calculation_details') }}">
                                    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                    <input name="application_id" type="hidden" value="{{ $noc_application->id }}" />
                                    <input name="user_id" type="hidden" value="{{ $user->id }}" />
                                    <input name="society_id" type="hidden" value="{{ $noc_application->society_id }}" />
                                    <input name="redirect_tab" type="hidden" value="five" />
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("print_four");'
                                                style="max-width: 22px" class="printBtn"></a>
                                    </div>
                                    <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs" style = "border-style: ridge;">
                                                    Sr.no
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
                                                    अस्तित्वातील बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="infra_fee  form-control form-control--custom txtbox" type="text" placeholder="0"
                                                        name="existing_construction_area" id="existing_construction_area"
                                                        value="{{ isset($calculation) ? $calculation->existing_construction_area : ''  }}" {{$readonly}}/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">2.</td>
                                                <td style = "border-style: ridge;">
                                                    दि.०८.१०.२०१३ च्या अधिसूचनेमधील अनु.क्र.५ ए ,नुसार ७ % ऑफ
                                                    इन्फ्रास्टक्चर शुल्क रक्कम
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                        name="off_site_infrastructure_fee" id="off_site_infrastructure_fee"
                                                        value="{{ isset($calculation) ? $calculation->off_site_infrastructure_fee : ''  }}" />

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
                                                    <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                        name="amount_to_be_paid_to_municipal" id="amount_to_be_paid_to_municipal"
                                                        value="{{ isset($calculation) ? $calculation->amount_to_be_paid_to_municipal : ''  }}" />


                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">4.</td>
                                                <td style = "border-style: ridge;">
                                                    म्हाडाकडे भरवायची ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क रक्कम (२/७ *
                                                    अनु.क्र.२ )
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="total_amount_in_rs form-control form-control--custom txtbox" placeholder="0"
                                                        readonly type="text" name="offsite_infrastructure_charge_to_mhada"
                                                        id="offsite_infrastructure_charge_to_mhada" value="{{ isset($calculation) ? $calculation->offsite_infrastructure_charge_to_mhada : ''  }}"  />


                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">5.</td>
                                                <td style = "border-style: ridge;">
                                                    छाननी शुल्क
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="total_amount_in_rs form-control form-control--custom txtbox" placeholder="0"
                                                        readonly type="text" name="scrutiny_fee" id="scrutiny_fee"
                                                        value="{{ isset($calculation) ? $calculation->scrutiny_fee : ''  }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">6.</td>
                                                <td style = "border-style: ridge;">
                                                    डेब्रिज रिमूव्हल शुल्क रु.६६००/-
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="total_amount_in_rs form-control form-control--custom txtbox" placeholder="0"
                                                        readonly type="text" name="debraj_removal_fee" id="debraj_removal_fee"
                                                        value="{{ isset($calculation) ? $calculation->debraj_removal_fee : ''  }}"/>


                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">7.</td>
                                                <td style = "border-style: ridge;">
                                                    अभिन्यास मंजुरी शुल्क रु,१०००/ - प्रति गाळा
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="total_amount_in_rs form-control form-control--custom txtbox" placeholder="0"
                                                        readonly type="text" name="layout_approval_fee" id="layout_approval_fee"
                                                        value="{{ isset($calculation) ? $calculation->layout_approval_fee : ''  }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">8.</td>
                                                <td style = "border-style: ridge;">
                                                    पाणी वापर शुल्क (रु.१,००,०००/- )
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="total_amount_in_rs form-control form-control--custom txtbox" placeholder="0"
                                                        readonly type="text" name="water_usage_charges" id="water_usage_charges"
                                                        value="{{ isset($calculation) ? $calculation->water_usage_charges : ''  }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">9.</td>
                                                <td style = "border-style: ridge;">
                                                    एकूण रक्कम रुपये
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                        name="total_amount_in_rs" id="total_amount_in_rs" value="{{ isset($calculation) ? $calculation->total_amount_in_rs : ''  }}" />

                                                </td> 
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">10.</td>
                                                <td style = "border-style: ridge;">
                                                    बृहनमुंबई महानगर पालिकेकडे भरणा करावयाची रक्कम
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom txtbox" readonly type="text" placeholder="0"
                                                        name="amount_to_b_paid_to_municipal_corporation" id="amount_to_b_paid_to_municipal_corporation"
                                                        value="{{ isset($calculation) ? $calculation->amount_to_b_paid_to_municipal_corporation : ''  }}" />


                                                </td>
                                            </tr>
                                            @if($visible == true)
                                            <tr>
                                                <td colspan="3" align="right"><input type="submit" name="submit" class="btn btn-primary subtn"
                                                        value="Next" /> </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <!-- consseion sheet -->
            <div class="tab-pane" id="five" role="tabpanel">
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
                                    <img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("five");' style="max-width: 22px" class="printBtn"></a>
                                </div>
                                 <form class="nav-tabs-form" role="form" method="POST" action="{{ route('save_noc_sharing_calculation_details') }}">
                                 @csrf
                                 <input name="application_id" type="hidden" value="{{ $noc_application->id }}" />
                                 <input name="redirect_tab" type="hidden" value="six" />
                                 <input name="redirect_route" type="hidden" value="ol_sharing_calculation_sheet/" />
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
                                                रक्कम रु
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style = "border-style: ridge;">1.</td>
                                            <td>
                                                Change of tenement
                                            </td>
                                            <td class="text-center">
                                                <textarea class="form-control form-control--custom form-control--textarea" style="border-right: none;resize: none;" name="tenement_charges" id="tenement_charges" {{$readonly}}> {{ isset($calculation) ? $calculation->tenement_charges : ''  }}</textarea>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">2.</td>
                                            <td style = "border-style: ridge;">
                                               R.G shiffting
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <textarea class="form-control form-control--custom form-control--textarea" style="border-right: none;border-top: none;resize: none;" name="r_g_shiffting" id="r_g_shiffting" {{$readonly}}>{{ isset($calculation) ? $calculation->r_g_shiffting : ''  }}</textarea>

                                            </td>
                                        </tr>
                                        <tr>

                                            <td style = "border-style: ridge;">3.</td>
                                            <td style = "border-style: ridge;">
                                               OB/Other plot
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <textarea class="form-control form-control--custom form-control--textarea" style="border-right: none;border-top: none;resize: none;" name="ob_other_plot" id="ob_other_plot" {{$readonly}}>{{ isset($calculation) ? $calculation->ob_other_plot : ''  }}</textarea>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">4.</td>
                                            <td style = "border-style: ridge;">
                                                VP cota
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <textarea class="form-control form-control--custom form-control--textarea" style="border-right: none;border-top: none;resize: none;" name="vp_cota" id="vp_cota" {{$readonly}}>{{ isset($calculation) ? $calculation->vp_cota : '' }}</textarea>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">5.</td>
                                            <td style = "border-style: ridge;">
                                                Encroachment on plot
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <textarea class="form-control form-control--custom form-control--textarea" style="border-right: none;border-top: none;resize: none;" name="encroachment_plot" id="encroachment_plot" {{$readonly}}>{{ isset($calculation) ? $calculation->encroachment_plot : '' }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">6.</td>
                                            <td style = "border-style: ridge;">
                                                Premium charges
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <textarea class="form-control form-control--custom form-control--textarea" style="border-right: none;border-top: none;resize: none;" name="premium_charges" id="premium_charges" {{$readonly}}>{{ isset($calculation) ? $calculation->premium_charges : '' }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">7.</td>
                                            <td style = "border-style: ridge;">
                                                Tit Bit land
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <textarea class="form-control form-control--custom form-control--textarea" style="border-right: none;border-top: none;resize: none;" name="tit_bit_land" id="tit_bit_land" {{$readonly}}>{{ isset($calculation) ? $calculation->tit_bit_land : '' }}</textarea>
                                            </td>
                                        </tr>
                                        @if($visible == true)
                                        <tr>
                                            <td colspan="3" align="right">
                                            <input type="submit" class="btn btn-primary btn-next subtn subt-btn" value="Next" /> </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                </form>
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
                                                <div class="mt-auto">
                                                    @if(isset($calculation->ree_note))
                                                    <a href="{{config('commanConfig.storage_server').'/'.$calculation->ree_note }}" target="_blank">

                                                    <button class="btn btn-primary">Download</button>
                                                    </a>
                                                    @else
                                                    <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                        * Note : REE note not available. </span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        @if($visible == true)
                                            <div class="col-sm-6 border-left">
                                                <div class="d-flex flex-column h-100 two-cols">
                                                    <h5>Upload REE Note</h5>
                                                    
                                                    <form action="{{ route('save_noc_sharing_calculation_details') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="application_id" value="{{ $noc_application->id }}">
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
                setTimeout(function () {
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
                //return value
                  //  .replace(/\D/g, "")
                  //  .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
         //           ;

              //  value = value.replace(/,/g,'');
                return numberWithCommas(value);

            });


    });




        totalPermissibleConstructionArea();

        remainingArea();

        offSiteInfrastructureFee();

        layoutApprovalFee();

        totalAmountInRs();





    })

</script>
<script>
    //==========================================   CALCULATION START ==========================

    function numberWithCommas(x) {

        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }

    function cleanNumber(value)
    {
        return value.toString().replace(/\,/g,'');
    }


    function areaOfTotalPlot()
    {
        var sum = 0;
        $(".total_area").each(function () {

           var total_area_val = cleanNumber($(this).val());

           var areaVal = (!total_area_val || isNaN(total_area_val)) ? 0 : total_area_val;

            sum += +parseFloat(areaVal);
        });
        if(sum > 0)
        {
            sum = sum.toFixed(2);
        }
        $("#area_of_total_plot").attr('value', numberWithCommas(sum));
    }

    function areaOfSubsistenceToCalculate()
    {
        var area = (!cleanNumber($("#area_of_total_plot").val()) || isNaN(cleanNumber($("#area_of_total_plot").val()))) ? 0 : cleanNumber($("#area_of_total_plot").val());

        var sorted = $(".min_val_for_calculation").sort(

            function (a, b) {
                return cleanNumber(a.value) - cleanNumber(b.value)
            });
        var lowest = sorted[0].value;
        if (lowest == ''){
            lowest = area;
        } 

        $("#area_of_​​subsistence_to_calculate").attr('value', numberWithCommas(lowest));
    }


    function abhinyasAreaOfTotalPlot()
    {
        var sum = 0;
        $(".abhinyas_total_area").each(function () {

            var total_area_val = cleanNumber($(this).val());

            var areaVal = (!total_area_val || isNaN(total_area_val)) ? 0 : total_area_val;
            sum += +areaVal;
        });
        if(sum > 0)
        {
            sum = sum.toFixed(2);
        }
        $("#abhinyas_area_of_total_plot").attr('value', numberWithCommas(sum));
    }

    function permissibleConstructionArea()
    {
        var area_of_subsistence_to_calculate = cleanNumber($("#area_of_​​subsistence_to_calculate").val());
        var permissible_carpet_area_coordinates = cleanNumber($("#permissible_carpet_area_coordinates").val());

        area_of_subsistence_to_calculate = (!area_of_subsistence_to_calculate || isNaN(area_of_subsistence_to_calculate)) ? 0 : area_of_subsistence_to_calculate;
        permissible_carpet_area_coordinates = (!permissible_carpet_area_coordinates || isNaN(permissible_carpet_area_coordinates)) ? 0 : permissible_carpet_area_coordinates;

        $("#permissible_construction_area").attr('value', numberWithCommas((parseFloat(area_of_subsistence_to_calculate) * parseFloat(permissible_carpet_area_coordinates)).toFixed(2)));
    }

    function totalPermissibleConstructionArea()
    {
        var permissible_construction_area = (!cleanNumber($("#permissible_construction_area").val()) || isNaN(cleanNumber($("#permissible_construction_area").val()))) ? 0 : cleanNumber($("#permissible_construction_area").val());
        var permissible_proratata_area = (!cleanNumber($("#permissible_proratata_area").val()) || isNaN(cleanNumber($("#permissible_proratata_area").val()))) ? 0 : cleanNumber($("#permissible_proratata_area").val());

        $("#total_permissible_construction_area").attr('value', numberWithCommas((parseFloat(permissible_construction_area) + parseFloat(permissible_proratata_area)).toFixed(2)));
    }

    function permissibleProratataArea()
    {
        var sqm_area_per_slot = (!cleanNumber($("#sqm_area_per_slot").val()) || isNaN(cleanNumber($("#sqm_area_per_slot").val()))) ? 0 : cleanNumber($("#sqm_area_per_slot").val());
        var total_house = (!cleanNumber($("#total_house").val()) || isNaN(cleanNumber($("#total_house").val()))) ? 0 : cleanNumber($("#total_house").val());

        $("#permissible_proratata_area").attr('value', numberWithCommas((sqm_area_per_slot * total_house).toFixed(2)));
    }

    function totalRehabilitationMattressArea()
    {
        var revised_increased_area_for_residential_use = (!cleanNumber($("#revised_increased_area_for_residential_use").val()) || isNaN(cleanNumber($("#revised_increased_area_for_residential_use").val()))) ? 0 : cleanNumber($("#revised_increased_area_for_residential_use").val());
        var total_house = (!cleanNumber($("#total_house").val()) || isNaN(cleanNumber($("#total_house").val()))) ? 0 : cleanNumber($("#total_house").val());

        $("#total_rehabilitation_mattress_area").attr('value', numberWithCommas((total_house * revised_increased_area_for_residential_use).toFixed(2)));
    }

    function totalRehabilitationMattressAreaWithDcr()
    {
        var total_additional_claims = (!cleanNumber($("#total_additional_claims").val()) || isNaN(cleanNumber($("#total_additional_claims").val()))) ? 0 : cleanNumber($("#total_additional_claims").val());
        var total_rehabilitation_mattress_area = (!cleanNumber($("#total_rehabilitation_mattress_area").val()) || isNaN(cleanNumber($("#total_rehabilitation_mattress_area").val()))) ? 0 : cleanNumber($("#total_rehabilitation_mattress_area").val());

        $("#total_rehabilitation_mattress_area_with_dcr").attr('value', numberWithCommas((parseFloat(total_additional_claims) + parseFloat(total_rehabilitation_mattress_area)).toFixed(2)));
    }

    function totalRehabilitationConstructionArea()
    {
        var total_rehabilitation_mattress_area_with_dcr = (!cleanNumber($("#total_rehabilitation_mattress_area_with_dcr").val()) || isNaN(cleanNumber($("#total_rehabilitation_mattress_area_with_dcr").val()))) ? 0 : cleanNumber($("#total_rehabilitation_mattress_area_with_dcr").val());

        $("#total_rehabilitation_construction_area").attr('value', numberWithCommas((parseFloat(total_rehabilitation_mattress_area_with_dcr) * 1.2).toFixed(2)));
    }

    function mattressAreaForConstructionArea()
    {
        var dcr_b_val = (!$("input[type=radio][name=dcr_b_val]:checked").val() || isNaN($("input[type=radio][name=dcr_b_val]:checked").val())) ? 0 : $("input[type=radio][name=dcr_b_val]:checked").val();
        var total_rehabilitation_construction_area = (!cleanNumber($("#total_rehabilitation_construction_area").val()) || isNaN(cleanNumber($("#total_rehabilitation_construction_area").val()))) ? 0 : cleanNumber($("#total_rehabilitation_construction_area").val());

        $("#mattress_area_for_construction_area").attr('value', numberWithCommas(((dcr_b_val / 100) * total_rehabilitation_construction_area).toFixed(2)));
    }

    function lrRcDivisionVal()
    {
        var lr_val = (!cleanNumber($("#lr_val").val()) || isNaN(cleanNumber($("#lr_val").val()))) ? 0 : cleanNumber($("#lr_val").val());
        var rc_val = (!cleanNumber($("#rc_val").val()) || isNaN(cleanNumber($("#rc_val").val()))) ? 0 : cleanNumber($("#rc_val").val());

        var div = parseFloat(lr_val) / parseFloat(rc_val);

        if(rc_val!=0)
        {
            $("#lr_rc_division_val").attr('value', numberWithCommas(div.toFixed(2)));
        }

    }

    function totalAdditionalClaims()
    {
        var dcr_a_val = (!$("input[type=radio][name=dcr_a_val]:checked").val() || isNaN($("input[type=radio][name=dcr_a_val]:checked").val())) ? 0 : $("input[type=radio][name=dcr_a_val]:checked").val();
        var permissible_mattress_area = (!cleanNumber($("#permissible_mattress_area").val()) || isNaN(cleanNumber($("#permissible_mattress_area").val()))) ? 0 : cleanNumber($("#permissible_mattress_area").val());

        var total_house = (!cleanNumber($("#total_house").val()) || isNaN(cleanNumber($("#total_house").val()))) ? 0 : cleanNumber($("#total_house").val());

        var total_claims = (dcr_a_val / 100) * permissible_mattress_area * total_house;

        $("#total_additional_claims").attr('value', numberWithCommas(total_claims.toFixed(2)));
    }

    function remainingArea()
    {
        var total_permissible_construction_area = (!cleanNumber($("#total_permissible_construction_area").val()) || isNaN(cleanNumber($("#total_permissible_construction_area").val()))) ? 0 : cleanNumber($("#total_permissible_construction_area").val());
        var total_rehabilitation_construction_area = (!cleanNumber($("#total_rehabilitation_construction_area").val()) || isNaN(cleanNumber($("#total_rehabilitation_construction_area").val()))) ? 0 : cleanNumber($("#total_rehabilitation_construction_area").val());
        var mattress_area_for_construction_area = (!cleanNumber($("#mattress_area_for_construction_area").val()) || isNaN(cleanNumber($("#mattress_area_for_construction_area").val()))) ? 0 : cleanNumber($("#mattress_area_for_construction_area").val());

        $("#remaining_area").attr('value', numberWithCommas((parseFloat(total_permissible_construction_area) - parseFloat(total_rehabilitation_construction_area) - parseFloat(mattress_area_for_construction_area)).toFixed(2)));
    }

    function offSiteInfrastructureFee()
    {
        var lr_val = (!cleanNumber($("#lr_val").val()) || isNaN(cleanNumber($("#lr_val").val()))) ? 0 : cleanNumber($("#lr_val").val());
        var total_permissible_construction_area = (!cleanNumber($("#total_permissible_construction_area").val()) || isNaN(cleanNumber($("#total_permissible_construction_area").val()))) ? 0 : cleanNumber($("#total_permissible_construction_area").val());
        var existing_construction_area = (!cleanNumber($("#existing_construction_area").val()) || isNaN(cleanNumber($("#existing_construction_area").val()))) ? 0 : cleanNumber($("#existing_construction_area").val());


        var lr_cal = parseFloat(0.07 * lr_val);
        var substract = parseFloat(total_permissible_construction_area) - parseFloat(existing_construction_area);
        var off_site_infra_fee = Math.ceil(substract * lr_cal);

        $("#off_site_infrastructure_fee").attr('value', numberWithCommas(off_site_infra_fee));

        $("#amount_to_be_paid_to_municipal").attr('value', numberWithCommas(Math.ceil(5 / 7 * off_site_infra_fee)));
        $("#offsite_infrastructure_charge_to_mhada").attr('value', numberWithCommas(Math.ceil(2 / 7 * off_site_infra_fee)));
        $("#amount_to_b_paid_to_municipal_corporation").attr('value', numberWithCommas(Math.ceil(5 / 7 * off_site_infra_fee)));

    }

    function layoutApprovalFee()
    {
        var total_house = (!cleanNumber($("#total_house").val()) || isNaN(cleanNumber($("#total_house").val()))) ? 0 : cleanNumber($("#total_house").val());

        $("#layout_approval_fee").attr('value', numberWithCommas(1000 * total_house));
    }

    function totalAmountInRs()
    {
        var total_amount_in_rs = 0;
        $(".total_amount_in_rs").each(function () {
            var amountVal = (!cleanNumber(this.value) || isNaN(cleanNumber($(this).val()))) ? 0 : cleanNumber($(this).val());
            total_amount_in_rs += +amountVal;
        });
        $("#total_amount_in_rs").attr('value', numberWithCommas(Math.ceil(total_amount_in_rs)));
    }

    // =========================================================

    $(document).on("keyup blur", ".total_area", function () {
        areaOfTotalPlot();

        areaOfSubsistenceToCalculate();

    });

    $(document).on("keyup blur", ".abhinyas_total_area", function () {

        abhinyasAreaOfTotalPlot();

        areaOfSubsistenceToCalculate();

    });



    $(document).on("keyup blur", ".total_area , .abhinyas_total_area , #permissible_carpet_area_coordinates", function () {

        permissibleConstructionArea();

        totalPermissibleConstructionArea

    });

    $(document).on("keyup blur", "#sqm_area_per_slot , #total_house", function () {

        permissibleProratataArea();

        totalPermissibleConstructionArea();


    });

    $(document).on("keyup blur", "#permissible_mattress_area", function () {

        var permissible_mattress_area = (!cleanNumber($(this).val()) || isNaN(cleanNumber($(this).val()))) ? 0 : cleanNumber($(this).val());

        $("#revised_permissible_mattress_area").attr('value', numberWithCommas((1.35 * permissible_mattress_area).toFixed(2)));

    });

    $(document).on("keyup blur", "#revised_increased_area_for_residential_use", function () {

        totalRehabilitationMattressArea();

        totalRehabilitationMattressAreaWithDcr();

        totalRehabilitationConstructionArea();

        mattressAreaForConstructionArea();
    });


    $(document).on("keyup blur", "#lr_val , #rc_val", function () {

        lrRcDivisionVal();

    });

    $(document).on("keyup blur", "#total_rehabilitation_construction_area", function () {

        mattressAreaForConstructionArea();

    });

    $(document).on("change", "input[type=radio][name=dcr_b_val]", function () {

        mattressAreaForConstructionArea();

    });

    $(document).on("keyup blur", ".remaining_area", function () {


        remainingArea();

    });


    $(document).on("change blur", "input[type=radio][name=dcr_c_society_val]", function () {

        var dcr_c_val = (!cleanNumber($(this).val()) || isNaN(cleanNumber($(this).val()))) ? 0 : cleanNumber($(this).val());
        var remaining_area = (!cleanNumber($("#remaining_area").val()) || isNaN(cleanNumber($("#remaining_area").val()))) ? 0 : cleanNumber($("#remaining_area").val());

        $("#society_share").attr('value', numberWithCommas(((dcr_c_val / 100) * remaining_area).toFixed(2)));

        $("#dcr_c_mhada_val").attr('value',(100-dcr_c_val));

        var mhada_share = (((100-dcr_c_val) / 100) * remaining_area).toFixed(2);

        $("#mhada_share").attr('value', numberWithCommas(mhada_share));
        $("#mhada_share_with_fungib").attr('value', numberWithCommas((mhada_share * 1.35).toFixed(2)));
    });


    $(document).on("keyup blur", ".infra_fee", function () {

        offSiteInfrastructureFee();
    });


    $(document).on("keyup blur", "#total_house", function () {

        layoutApprovalFee();

    });



    $(document).on("keyup blur", ".total_amount_in_rs", function () {

        totalAmountInRs();
    });

    $(document).on("change blur", "input[type=radio][name=dcr_a_val]", function () {

        totalAdditionalClaims();

        totalRehabilitationMattressAreaWithDcr();

        totalRehabilitationConstructionArea();

        mattressAreaForConstructionArea();

    });
    $(document).on("keyup blur", "#total_house, #permissible_mattress_area", function () {

        totalAdditionalClaims();

        totalRehabilitationMattressArea();

        totalRehabilitationMattressAreaWithDcr();

        totalRehabilitationConstructionArea();

        mattressAreaForConstructionArea();

    });

    //==========================================   CALCULATION END ==========================

    function PrintElem(elem) {

        $(".txtbox").css("width","200px");
        $(".subtn").css("display","none");
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
        $(".subtn").css("display","block");
        $(".printBtn").css("display","block"); 

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

    // Select row when radio is checked

    $('.table-c-modal tr input').change(function () {
        $('.table-c-modal tr').removeClass("active");
        if (".table-c-modal tr:has(input[checked='true'])") {
            $(this).closest("tr").addClass("active");
        }
    });

</script>

@endsection
