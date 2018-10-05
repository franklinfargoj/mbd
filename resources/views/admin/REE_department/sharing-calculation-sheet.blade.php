@extends('admin.layouts.app')
@section('content')

<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">
                <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#one" role="tab"
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
                                <form role="form" method="POST" action="">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <span class="flex-shrink-0 text-nowrap">Total Number of buildings:</span>
                                        <input type="text" class="form-control form-control--xs form-control--custom flex-grow-0 ml-3"
                                            name="total_no_of_buildings" id="total_no_of_buildings" value="" />
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                                src="{{asset('/img/print-icon.svg')}}"></a>
                                    </div>
                                    <table class="table mb-0 table--box-input" style="padding-top: 10px;">
                                        <input name="_token" type="hidden" value="" />
                                        <input name="application_id" type="hidden" value="" />
                                        <input name="user_id" type="hidden" value="" />
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
                                                    <input type="text" class="form-control form-control--custom" name=""
                                                        id="" value="" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    1. टिट बिट भूखंडाचे क्षेत्र
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control--custom" name="area_as_per_lease_agreement"
                                                        id="area_as_per_lease_agreement" value="" />
                                                </td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="font-weight-bold">
                                                    Total भूखंडाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="area_of_total_plot" id="area_of_total_plot" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>
                                                    अनुज्ञेय चटई क्षेत्र निर्देशांक
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom" name=""
                                                        id="" value="" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>
                                                    अनुज्ञेय बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom"
                                                        readonly name="" id="" value="(Table1 Point 1 * Table 1 Point 2)" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>
                                                    म.न.पा .कडून ल. ओ. आय. पत्रानुसार अनुज्ञेय प्रोरेटा क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom"
                                                        readonly name="" id="" value="" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    1. प्रति सदनिका चौ मी क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom"
                                                        readonly name="" id="" value="" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    2. एकूण सदनिका
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom"
                                                        readonly name="" id="" value="" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="font-weight-bold">
                                                    Total
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="" id="" value="(प्रति सदनिका चौ मी क्षेत्रफळ  *  एकूण सदनिका )" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td>
                                                    अनुज्ञेय बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom" name=""
                                                        id="" value="(Table1 Point 3 + Table 1 Point 4)" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6.</td>
                                                <td>
                                                    अनुज्ञेय चटई क्षेत्रफळ प्रतिगाळा
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom" name=""
                                                        id="" value="" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7.</td>
                                                <td>
                                                    सुधारित वि नि नि ३३(५) प्रमाणे अनुज्ञेय चटई क्षेत्रफळ वर ३५%
                                                    प्रतिगाळा
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom" name=""
                                                        id="" value="(Table1 Point 6 *  35%)" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8.</td>
                                                <td>
                                                    सुधारित वि नि नि ३३(५) दि ३.७.२०१७ रोजीच्या फ्रबदलाच्या अधिसूचने
                                                    नुसार निवासी वापर करिता वाढीव क्षेत्रफळ ३५% मिळून किमान ३५ चौमी
                                                    अनुज्ञेय आहे. त्यामुळे अ क्र ७ मधील क्षेत्रफळ कमी असल्याने ३५ चौ मी
                                                    गृहीत धरण्यात येत आहे
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom" name=""
                                                        id="" value="min amount is 35 (input)" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>9.</td>
                                                <td>
                                                    एकूण पुनर्वसन चटई क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom" name=""
                                                        id="" value="pt 8 * एकूण सदनिका" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>10.</td>
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
                                                                                <input type="radio" name="carpet-area-radio"
                                                                                    id="" value="">
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
                                                                                <input type="radio" name="carpet-area-radio"
                                                                                    id="" value="">
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
                                                                                <input type="radio" name="carpet-area-radio"
                                                                                    id="" value="">
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
                                                                                <input type="radio" name="carpet-area-radio"
                                                                                    id="" value="">
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
                                                                                <input type="radio" name="carpet-area-radio"
                                                                                    id="" value="">
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
                            <div class="m-section__content mb-0 table-responsive">
                                <form role="form" method="POST" action="">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                                src="{{asset('/img/print-icon.svg')}}"></a>
                                    </div>
                                    <table class="table mb-0 table--box-input" style="padding-top: 10px;">
                                        <input name="_token" type="hidden" value="" />
                                        <input name="application_id" type="hidden" value="" />
                                        <input name="user_id" type="hidden" value="" />
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
                                                    LC
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom" name=""
                                                        id="" value="" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>
                                                    RC
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom" name="area_as_per_lease_agreement"
                                                        id="area_as_per_lease_agreement" value="" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>
                                                    LC/RC
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-control form-control--custom" readonly type="text"
                                                        name="area_of_total_plot" id="area_of_total_plot" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>
                                                    सुधारित वि नि नि ३३(५) मधील तक्त्या नुसार LC/RC करिता प्रोत्साहन
                                                    क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom" name=""
                                                        id="" value="in %" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td>
                                                    बांधकाम क्षेत्रफलकरीता प्रोत्साहन चटई क्षेत्रफळ
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom"
                                                        readonly name="" id="" value="table 1 pt 12 * 3" />
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
                            <div class="m-section__content mb-0 table-responsive">
                                <form role="form" method="POST" action="">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                                src="{{asset('/img/print-icon.svg')}}"></a>
                                    </div>
                                    <table class="table mb-0 table--box-input" style="padding-top: 10px;">
                                        <input name="_token" type="hidden" value="" />
                                        <input name="application_id" type="hidden" value="" />
                                        <input name="user_id" type="hidden" value="" />
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
                                                    <input type="text" class="form-control form-control--custom" name=""
                                                        id="" value="(Table 1 pt 5 - tb 1 pt 12 -  tb 2 pt 5)" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>
                                                    LC/RC
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom" name="area_as_per_lease_agreement"
                                                        id="area_as_per_lease_agreement" value="" />
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
                                                        Select DCR
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>
                                                    अभिन्यास मंजुरी शुल्क रु १,०००/- प्रति गळा
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom" name=""
                                                        id="" value="in %" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td>
                                                    डेब्रिज रिमूव्हल शुल्क रु ६६०० /-
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom"
                                                        readonly name="" id="" value="6600" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6.</td>
                                                <td>
                                                    पाणी वापर शुल्क (रु १,००,०००/-)
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom"
                                                        readonly name="" id="" value="6600" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7.</td>
                                                <td class="font-weight-bold">
                                                    एकूण मंडळाकडे भरणा करावयाची पहिल्या हप्त्याची रक्कम पूर्णांकामधे
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom"
                                                        readonly name="" id="" value="" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="modal fade show" id="select-dcr" tabindex="-1" role="dialog"
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
                                                                                <input type="radio" name="rehab-area"
                                                                                    id="" value="">
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
                                                                                <input type="radio" name="rehab-area"
                                                                                    id="" value="">
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
                                                                                <input type="radio" name="rehab-area"
                                                                                    id="" value="">
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
                                                                                <input type="radio" name="rehab-area"
                                                                                    id="" value="">
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
                                                                                <input type="radio" name="rehab-area"
                                                                                    id="" value="">
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
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Table C</h5>
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
                                                                                <input type="radio" name="society-share-radio"
                                                                                    id="" value="">
                                                                                <span class="m-radio--box-span">
                                                                                    <span>30%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="mhada-share-radio"
                                                                                    id="" value="">
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
                                                                                <input type="radio" name="society-share-radio"
                                                                                    id="" value="">
                                                                                <span class="m-radio--box-span">
                                                                                    <span>35%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="mhada-share-radio"
                                                                                    id="" value="">
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
                                                                                <input type="radio" name="society-share-radio"
                                                                                    id="" value="">
                                                                                <span class="m-radio--box-span">
                                                                                    <span>40%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="mhada-share-radio"
                                                                                    id="" value="">
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
                                                                                <input type="radio" name="society-share-radio"
                                                                                    id="" value="">
                                                                                <span class="m-radio--box-span">
                                                                                    <span>45%</span>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="position-relative">
                                                                        <div class="m-radio--box">
                                                                            <label class="m-radio m-radio--box-label">
                                                                                <input type="radio" name="mhada-share-radio"
                                                                                    id="" value="">
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
                            <div class="m-section__content mb-0 table-responsive">
                                <form role="form" method="POST" action="">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                                src="{{asset('/img/print-icon.svg')}}"></a>
                                    </div>
                                    <table class="table mb-0 table--box-input" style="padding-top: 10px;">
                                        <input name="_token" type="hidden" value="" />
                                        <input name="application_id" type="hidden" value="" />
                                        <input name="user_id" type="hidden" value="" />
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
                                                    <input type="text" class="form-control form-control--custom" name=""
                                                        id="" value="" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>
                                                    दि.०८.१०.२०१३ च्या अधिसूचनेमधील अनु.क्र.५ ए ,नुसार ७ % ऑफ
                                                    इन्फ्रास्टक्चर शुल्क रक्कम
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom" name="area_as_per_lease_agreement"
                                                        id="area_as_per_lease_agreement" value="[ (tb 1 pt 4 - tb 4 pt 1) * (LR * 7%) ]" />
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
                                                        name="area_of_total_plot" id="area_of_total_plot" value="5/7 * tb 4 pt 1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>
                                                    म्हाडाकडे भरवायची ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क रक्कम (२/७ *
                                                    अनु.क्र.१६ )
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom" name=""
                                                        id="" value="2/7 * tb4 pt 1" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td>
                                                    छाननी शुल्क
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom"
                                                        readonly name="" id="" value="६,०००" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6.</td>
                                                <td>
                                                    डेब्रिज रिमूव्हल शुल्क रु.६६००/-
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom"
                                                        readonly name="" id="" value="१००० * एकूण सदनिका" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7.</td>
                                                <td>
                                                    अभिन्यास मंजुरी शुल्क रु,१०००/ - प्रति गाळा
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom"
                                                        readonly name="" id="" value="6600" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8.</td>
                                                <td>
                                                    पाणी वापर शुल्क (रु.१,००,०००/- )
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom"
                                                        readonly name="" id="" value="१,००,०००" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>9.</td>
                                                <td>
                                                    पाणी वापर शुल्क (रु.१,००,०००/- )
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom"
                                                        readonly name="" id="" value="4+5+6+7+8" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>10.</td>
                                                <td>
                                                    बृहनमुंबई महानगर पालिकेकडे भरणा करावयाची रक्कम
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" class="form-control form-control--custom"
                                                        readonly name="" id="" value="tb 4 pt 3" />
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
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="application_id" value="">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" name="ree_note" type="file" id="test-upload"
                                                            required="">
                                                        <label class="custom-file-label" for="test-upload">Choose file
                                                            ...</label>
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
