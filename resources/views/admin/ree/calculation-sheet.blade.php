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

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                2. टिट बिट भूखंडाचे क्षेत्र
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                3. आर जी भूखंडाचे क्षेत्र
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                4. NTBNIB भूखंडाचे क्षेत्र
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="font-weight-bold">
                                                Total भूखंडाचे क्षेत्रफळ
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>
                                                अभिनण्यानुसार भूखंडाचे क्षेत्रफळ
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>
                                                परिगणनाकरिता ग्राह्य भूखंडाचे क्षेत्रफळ (Min of 1 & 2)
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>
                                                अनुज्ञेय चटई क्षेत्र निर्देशांक
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5.</td>
                                            <td>
                                                अनुज्ञेय बांधकाम क्षेत्रफळ
                                            </td>
                                            <td class="text-center">
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

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                2. एकूण सदनिका
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="font-weight-bold">
                                                Total
                                            </td>
                                            <td class="text-center">
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

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="font-weight-bold">
                                                Total
                                            </td>
                                            <td class="text-center">
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

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9.</td>
                                            <td>
                                                एकूण अनुज्ञेय बांधकाम क्षेत्रफळ (अ.क्र. ५ + ७ + 8)
                                            </td>
                                            <td class="text-center">
                                                tb1 pt 5 + tb1 pt 7
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10.</td>
                                            <td>
                                                अस्तित्वातील बांधकाम क्षेत्रफळ (सी - ५७)
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>11.</td>
                                            <td>
                                                उर्वरित क्षेत्रफळ (अ.क्र 9. - अ.क्र.10 )
                                            </td>
                                            <td class="text-center">
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
                                                रेडीरेकनर २०१८ - १९
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>13.</td>
                                            <td>
                                                बांधकामाचा दर (रेडीरेकनर २०१८-१९)
                                            </td>
                                            <td class="text-center">
                                                रेडीरेकनर २०१८ - १९
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>14.</td>
                                            <td>
                                                LR/RC = ५५,९००/२७५००
                                            </td>
                                            <td class="text-center">
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
                                                2/7 * tb1 pt 16
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>19.</td>
                                            <td>
                                                छाननी शुल्क
                                            </td>
                                            <td class="text-center">
                                                ६,०००
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>20.</td>
                                            <td>
                                                अभिन्यास मंजुरी शुल्क रु,१०००/ - प्रति गाळा
                                            </td>
                                            <td class="text-center">
                                                १००० * एकूण सदनिका
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>21.</td>
                                            <td>
                                                डेब्रिज रिमूव्हल शुल्क रु.६६००/- [for 1 building]
                                            </td>
                                            <td class="text-center">
                                                ६,६००
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>22.</td>
                                            <td>
                                                पाणी वापर शुल्क (रु.१,००,०००/- ) [for 1 building]
                                            </td>
                                            <td class="text-center">
                                                १,००,०००
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>23.</td>
                                            <td>
                                                एकूण रक्कम रुपये (अ .क्र.१५+१८+१९+२०+२१+२२)
                                            </td>
                                            <td class="text-center">
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
                                                tb 1 pt 17
                                            </td>
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
                                                                <td>40%</td>
                                                                <td>60%</td>
                                                                <td>80%</td>
                                                            </tr>
                                                            <tr>
                                                                <td>2 to 4</td>
                                                                <td>45%</td>
                                                                <td>65%</td>
                                                                <td>85%</td>
                                                            </tr>
                                                            <tr>
                                                                <td>4 to 6</td>
                                                                <td>50%</td>
                                                                <td>70%</td>
                                                                <td>90%</td>
                                                            </tr>
                                                            <tr>
                                                                <td>above 6</td>
                                                                <td>55%</td>
                                                                <td>75%</td>
                                                                <td>95%</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                दर रु
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                अधिमूल्य
                                            </td>
                                            <td class="text-center">

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

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>
                                                उपरोक्त ऑफ साईट इन्फ्रास्ट्रक्चर शुक्ल रक्कमेपैकी म न प स
                                                भरावयाची ५/७ रक्कम (५/७ * अनु क्र २)
                                            </td>
                                            <td class="text-center">
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
                                                (2/7 * table 2 pt 2)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5.</td>
                                            <td class="font-weight-bold">
                                                १/४ अधिमूल्यापोटी शुल्क
                                            </td>
                                            <td class="text-center">
                                                (Table 2 pt 1 amount * 1/4)
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
