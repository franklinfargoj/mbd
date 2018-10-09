@extends('admin.layouts.app')
@section('content')

<div class="custom-wrapper">
    <div class="col-md-12">
        <div id="tabbed-content" class="">
            <ul id="top-tabs" class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom tabs">
                <li class="nav-item m-tabs__item active" data-target="#document-scrunity">
                    <a class="nav-link m-tabs__link">
                        <i class="la la-cog"></i> Document Scrutiny
                    </a>
                </li>
                <li class="nav-item m-tabs__item" data-target="#checklist-scrunity">
                    <a class="nav-link m-tabs__link">
                        <i class="la la-cog"></i> Checklist Scrutiny
                    </a>
                </li>
                <li class="nav-item m-tabs__item" data-target="#ee-note">
                    <a class="nav-link m-tabs__link">
                        <i class="la la-cog"></i> EE Note
                    </a>
                </li>
            </ul>
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
                                        <span class="field-value">A065543</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Application Date:</span>
                                        <span class="field-value">A065543</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Society Name:</span>
                                        <span class="field-value">A065543</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Society Address:</span>
                                        <span class="field-value">A065543</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Building Number:</span>
                                        <span class="field-value">A065543</span>
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
                                        <span class="field-value">A065543</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Architect Mobile Number:</span>
                                        <span class="field-value">A065543</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Architect Address:</span>
                                        <span class="field-value">A065543</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 field-col">
                                    <div class="d-flex">
                                        <span class="field-name">Architect Telephone Number:</span>
                                        <span class="field-value">A065543</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content">

                <div class="panel active" id="document-scrunity">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                <div class="m-subheader">
                                    <div class="d-flex align-items-center">
                                        <h3 class="section-title section-title--small">
                                            Document Scrutiny Sheet:
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-section__content mb-0 table-responsive">
                                    <table class="table mb-0">
                                        <thead class="thead-default">
                                            <th class="table-data--xs">#</th>
                                            <th>तपशील</th>
                                            <th class="table-data--xs">सोसायटी दस्तावेज</th>
                                            <th class="table-data--lg">टिप्पणी</th>
                                            <th class="table-data--xs">दस्तावेज</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td>संस्थेचा अर्ज परिशिष्ठ अ प्रमाणे</td>
                                                <td class="text-center"><img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></td>
                                                <td>
                                                    <p class="mb-2">Lorem ipsum dolor, sit amet consectetur
                                                        adipisicing elit. Quia sequi natus explicabo et
                                                        exercitationem cumque</p>
                                                    <div class="d-flex btn-list-inline-wrap">
                                                        <button class="btn btn-link btn-list-inline" style="cursor: pointer"
                                                            data-toggle="modal" data-target="#add-remark">Add</button>
                                                        <button class="btn btn-link btn-list-inline" style="cursor: pointer"
                                                            data-toggle="modal" data-target="#delete-remark">Delete</button>
                                                    </div>
                                                </td>
                                                <td class="text-center"><img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>संस्थेच्या सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा
                                                    ठराव</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>संस्थेच्या सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची
                                                    साक्षांकित प्रत</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>संस्थेच्या सर्वसाधारण सभेच्या ठरावात विकासकाचे नाव व
                                                    पत्ता
                                                    नमुद केलेल्या ठरावाची साक्षांकित प्रत</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td>संस्थेच्या सर्वसाधारण सभेच्या ठरावात
                                                    वास्तुशास्त्रज्ञाचे
                                                    नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>6.</td>
                                                <td>वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या
                                                    अधिकाराचे मान्यता पत्र</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>7.</td>
                                                <td>वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>8.</td>
                                                <td>विकासकाबरोबर केलेल्या नोंदणीकृत करारनाम्याची साक्षांकित
                                                    प्रत</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>9.</td>
                                                <td>७० % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>10.</td>
                                                <td>अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>11.</td>
                                                <td>भाडेपट्टा करारनामा (लीज डिड)</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>12.</td>
                                                <td>अभिहस्तांतरण नकाशा ची साक्षांकित प्रत</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>13.</td>
                                                <td>कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन
                                                    इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>14.</td>
                                                <td>संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>15.</td>
                                                <td>मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>16.</td>
                                                <td>नगरभुमापन नकाशे</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>17.</td>
                                                <td>मिळकत पत्रिका (PR कार्ड)</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>18.</td>
                                                <td>अस्तीत्वातील इमारतीचे फोटो</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>19.</td>
                                                <td>प्रस्तावीत इमारतीचा नकाशा</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>20.</td>
                                                <td>डी.पी.रिमार्क</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>21.</td>
                                                <td>उपनिबंधक यांचेसमक्ष सर्वसाधारण सभेमध्ये विकासकाची
                                                    नियुक्ती
                                                    झाल्याबाबतचे पत्र</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="modal fade show" id="add-remark" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add
                                                        Remark</h5>
                                                    <button style="cursor: pointer;" type="button" class="close"
                                                        data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form class="" action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="mb-4">
                                                            <label for="remark">Remark:</label>
                                                            <textarea class="form-control form-control--custom" name="remark"
                                                                id="remark" cols="30" rows="5"></textarea>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input class="custom-file-input" name="" type="file" id="test-upload"
                                                                required="">
                                                            <label class="custom-file-label" for="test-upload">Choose
                                                                file...</label>
                                                        </div>
                                                        <div class="mt-auto">
                                                            <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary">Save</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade show" id="delete-remark" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel2">Delete
                                                        Remark</h5>
                                                    <button style="cursor: pointer;" type="button" class="close"
                                                        data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form class="" action="" method="post">
                                                    <div class="modal-body">
                                                        <div class="mb-4">
                                                            <label for="remark">Remark:</label>
                                                            <textarea class="form-control form-control--custom" name="remark"
                                                                id="remark2" cols="30" rows="5"></textarea>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input class="custom-file-input" name="" type="file" id="test-upload2"
                                                                required="">
                                                            <label class="custom-file-label" for="test-upload2">Choose
                                                                file...</label>
                                                        </div>
                                                        <div class="mt-auto">
                                                            <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn2">Upload</button>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary">Save</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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

                <div class="panel" id="checklist-scrunity">
                    <ul id="scrunity-tabs" class="nav nav-pills nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" data-toggle="pill" href="#verification">
                                Consent Verification</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" data-toggle="pill" href="#demarcation">
                                Demarcation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" data-toggle="pill" href="#tit-bit">
                                Tit-Bit</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link disabled" data-toggle="pill" href="#relocation">
                                R.G. Relocation</a>
                        </li>
                    </ul>
                    <div class="m-portlet m-portlet--no-top-shadow">
                        <div class="tab-pane--nested-tabs__inner">
                            <form class="form--custom" action="" method="post">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <div class="col-sm-4 d-flex align-items-center">
                                                <label for="name">संस्थेचे नाव:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control--custom" id="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <div class="col-sm-4 d-flex align-items-center">
                                                <label for="building-no">इमारत क्र:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control--custom" id="building-no"
                                                    placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <div class="col-sm-4 d-flex align-items-center">
                                                <label for="name">अभिन्यास (Layout):</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control--custom" id="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <div class="col-sm-4 d-flex align-items-center">
                                                <label for="building-no">नोटीस चा तपशील:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control--custom" id="building-no"
                                                    placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <div class="col-sm-4 d-flex align-items-center">
                                                <label for="name">तपासणी अधिकाऱ्यांचे नाव:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control--custom" id="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="scrunity-check-date" class="col-sm-6">
                                        <div class="form-group row">
                                            <div class="col-sm-4 d-flex align-items-center">
                                                <label for="building-no">तपासणी दिनांक:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control--custom" id="building-no"
                                                    placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="scrunity-place-date" class="col-sm-6">
                                        <div class="form-group row">
                                            <div class="col-sm-4 d-flex align-items-center">
                                                <label for="building-no">स्थळ पाहणी दिनांक:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control--custom" id="building-no"
                                                    placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="verification">
                                <div class="table-checklist m-portlet__body m-portlet__body--table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-default">
                                                <th>#</th>
                                                <th class="table-data--xl">मुद्दा / तपशील</th>
                                                <th>होय</th>
                                                <th>नाही</th>
                                                <th>शेरा</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>७०% सभासदांनी पुनर्विकासास सहमती दर्शविली आहे
                                                        काय ?</td>
                                                    <td>
                                                        <label class="m-radio m-radio--primary">
                                                            <input type="radio" name="one">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="m-radio m-radio--primary">
                                                            <input type="radio" name="one">
                                                            <span></span>
                                                        </label></td>
                                                    <td>
                                                        <textarea class="form-control form-control--custom form-control--textarea"
                                                            name="remark-one" id="remark-one"></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="demarcation">
                                <div class="table-checklist m-portlet__body m-portlet__body--table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-default">
                                                <th>#</th>
                                                <th class="table-data--xl">मुद्दा / तपशील</th>
                                                <th>होय</th>
                                                <th>नाही</th>
                                                <th>शेरा</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>७०% सभासदांनी पुनर्विकासास सहमती दर्शविली आहे
                                                        काय ?</td>
                                                    <td>
                                                        <label class="m-radio m-radio--primary">
                                                            <input type="radio" name="one">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="m-radio m-radio--primary">
                                                            <input type="radio" name="one">
                                                            <span></span>
                                                        </label></td>
                                                    <td>
                                                        <textarea class="form-control form-control--custom form-control--textarea"
                                                            name="remark-one" id="remark-one"></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tit-bit">
                                <div class="table-checklist m-portlet__body m-portlet__body--table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-default">
                                                <th>#</th>
                                                <th class="table-data--xl">मुद्दा / तपशील</th>
                                                <th>होय</th>
                                                <th>नाही</th>
                                                <th>शेरा</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>७०% सभासदांनी पुनर्विकासास सहमती दर्शविली आहे
                                                        काय ?</td>
                                                    <td>
                                                        <label class="m-radio m-radio--primary">
                                                            <input type="radio" name="one">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="m-radio m-radio--primary">
                                                            <input type="radio" name="one">
                                                            <span></span>
                                                        </label></td>
                                                    <td>
                                                        <textarea class="form-control form-control--custom form-control--textarea"
                                                            name="remark-one" id="remark-one"></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="relocation">
                                <div class="table-checklist m-portlet__body m-portlet__body--table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-default">
                                                <th>#</th>
                                                <th class="table-data--xl">मुद्दा / तपशील</th>
                                                <th>होय</th>
                                                <th>नाही</th>
                                                <th>शेरा</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>७०% सभासदांनी पुनर्विकासास सहमती दर्शविली आहे
                                                        काय ?</td>
                                                    <td>
                                                        <label class="m-radio m-radio--primary">
                                                            <input type="radio" name="one">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="m-radio m-radio--primary">
                                                            <input type="radio" name="one">
                                                            <span></span>
                                                        </label></td>
                                                    <td>
                                                        <textarea class="form-control form-control--custom form-control--textarea"
                                                            name="remark-one" id="remark-one"></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>

                    </div>
                </div>

                <!-- <div class="tab-pane" id="three" aria-expanded="false">
                                three
                            </div> -->

                <div class="panel" id="ee-note">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table">
                                <div class="m-subheader" style="padding: 0;">
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
                                                    <span class="hint-text">Download REE Note uploaded by
                                                        REE</span>
                                                    <div class="mt-auto">
                                                        <button class="btn btn-primary">Download Note
                                                            Format</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 border-left">
                                                <div class="d-flex flex-column h-100 two-cols">
                                                    <h5>Upload Note</h5>
                                                    <span class="hint-text">Click on 'Upload' to upload REE
                                                        -
                                                        Note</span>
                                                    <form action="" method="post">
                                                        <div class="custom-file">
                                                            <input class="custom-file-input" name="" type="file" id="test-upload"
                                                                required="">
                                                            <label class="custom-file-label" for="test-upload">Choose
                                                                file...</label>
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
</div>

@endsection
