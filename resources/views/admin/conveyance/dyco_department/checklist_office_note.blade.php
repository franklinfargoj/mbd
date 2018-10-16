@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.conveyance.dyco_department.action',compact('data'))
@endsection

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
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#checklist-scrutiny" role="tab"
                    aria-selected="false">
                    <i class="la la-cog"></i> Checklist Scrutiny
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#dycdo-note" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i>DyCDO Note
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <div class="tab-pane active show" id="checklist-scrutiny" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-subheader">
                            <div class="d-flex align-items-center justify-content-center">
                                <h3 class="section-title">
                                    मिळकत व्यव्थापन विनिमय २१(६) नुसार इमारतीचे अभिहस्तांतरण करावयाचा प्रस्थाव
                                </h3>
                            </div>
                        </div>
                        <div class="m-section__content mb-0 table-responsive">
                            <form class="nav-tabs-form" id ="checklistFRM" role="form" method="POST" action="{{ route('dyco.storeChecklistData')}}">
                            @csrf
                            <input type="hidden" name="application_id" value="{{$data->id}}">
                                <table id="one" class="table mb-0 table--box-input" style="padding-top: 10px;">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                                src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("one");'
                                                style="max-width: 22px"></a>
                                    </div>
                                    <thead class="thead-default">
                                        <tr>
                                            <th class="table-data--xs">
                                                #
                                            </th>
                                            <th>
                                                मुद्दा
                                            </th>
                                            <th class="table-data--md" style="width: 300px">
                                                तपशील
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>सह गृह संस्थेचे नाव</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="home_organization_name" id="home_organization_name"
                                                    value="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>संस्था नोंदणी दिनांक</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="registration_date" id="registration_date"
                                                    value="" />
                                            </td>
                                        </tr>  
                                        <tr>
                                            <td>3.</td>
                                            <td>चाळ क्र</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="chawl_no" id="chawl_no"
                                                    value="" />
                                            </td>
                                        </tr>     
                                        <tr>
                                            <td>4.</td>
                                            <td>वसाहतीचे नाव</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="colony_name" id="colony_name"
                                                    value="" />
                                            </td>
                                        </tr>  
                                        <tr>
                                            <td>5.</td>
                                            <td>मिळकत व्यवस्थापक यांचे ना डे प्रमाण पत्रं</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="property_certificate" id="property_certificate"
                                                    value="" />
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>i.</td>
                                            <td>सदनिकाधारकांच्या विहित नमुन्यातील यादी</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="tenants_list" id="tenants_list"
                                                    value="" />
                                            </td>
                                        </tr>   
                                        <tr>
                                            <td>ii.</td>
                                            <td>दिनांक</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="date" id="date"
                                                    value="" />
                                            </td>
                                        </tr>    
                                        <tr>
                                            <td>6.</td>
                                            <td>योजनेचा उत्पन्न गट</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="scheme_income_group" id="scheme_income_group"
                                                    value="" />
                                            </td>
                                        </tr>   
                                        <tr>
                                            <td>7.</td>
                                            <td>सदनिकां ची एकूण संख्या</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="total_flat" id="total_flat"
                                                    value="" />
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>8.</td>
                                            <td>प्रथम सदनिका वितरणाची दिनांक</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="first_flat_issue_date" id="first_flat_issue_date"
                                                    value="" />
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>9.</td>
                                            <td>वितरण वैयक्तिक आहे का</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="individual_destribution" id="individual_destribution"
                                                    value="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10.</td>
                                            <td>सदनिका वितरणाची पद्धत</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="flat_delivery_method" id="flat_delivery_method"
                                                    value="" />
                                            </td>
                                        </tr>   
                                        <tr>
                                            <td>11.1</td>
                                            <td>HPS असल्यास हफ्त्यांचा कालावधी</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="hps_installement_time" id="hps_installement_time"
                                                    value="" />
                                            </td>
                                        </tr>   
                                        <tr>
                                            <td>11.2</td>
                                            <td>HPS असल्यास पूर्ण झाल्याची दिनांक</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="hps_installement_date" id="hps_installement_date"
                                                    value="" />
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>12</td>
                                            <td>अंतिम विक्री किंमत</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="final_sale_price" id="final_sale_price"
                                                    value="" />
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>12.2</td>
                                            <td>बांधकाम किंमत</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="contruction_price" id="contruction_price"
                                                    value="" />
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>12.3</td>
                                            <td>जमिनीचे अधिमूल्य</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="land_premium" id="land_premium"
                                                    value="" />
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>13</td>
                                            <td>संपूर्ण विक्री किंमत भरणा केली आहे काय</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="payment_completed" id="payment_completed"
                                                    value="" />
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>14</td>
                                            <td>जमिनीचे अधिमूल्य भरले आहे काय</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="land_premium_completed" id="land_premium_completed"
                                                    value="" />
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>15</td>
                                            <td>संस्थेने भरायायचा भुभाडे चा वार्षिक दर</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="organization_rent_rate" id="organization_rent_rate"
                                                    value="" />
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>16</td>
                                            <td>संस्थेने भुभाडे कोणत्या तारिखे पर्यंत भरलेले आहे</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="last_date_of_rent" id="last_date_of_rent"
                                                    value="" />
                                            </td>
                                        </tr>                                          
                                        <tr>
                                            <td>17</td>
                                            <td>सेवा शुल्क भरणा केल्याची दिनांक</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="service_tax_date" id="service_tax_date"
                                                    value="" />
                                            </td>
                                        </tr>                                          
                                        <tr>
                                            <td>18</td>
                                            <td>संस्थेने भरावयाचा सेवा शुल्काचा दर</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="service_tax_rate" id="service_tax_rate"
                                                    value="" />
                                            </td>
                                        </tr>                                          
                                        <tr>
                                            <td>19</td>
                                            <td>कार्य अभि यांच्या नकाशा नुसार </td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="work_assignment" id="work_assignment"
                                                    value="" />
                                            </td>
                                        </tr>                                          
                                        <tr>
                                            <td>19.1</td>
                                            <td>संस्थेचे एकूण क्षेत्रफळ</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="society_area" id="society_area"
                                                    value="" />
                                            </td>
                                        </tr>                                          
                                        <tr>
                                            <td>19.2</td>
                                            <td>नकाशामध्ये चतुर्सिमा, सर्व्हे नं सी ती एस  नं इ तपशील दिला आहे का</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="serve_map" id="serve_map"
                                                    value="" />
                                            </td>
                                        </tr>                                          
                                        <tr>
                                            <td>20</td>
                                            <td>संस्थेस सेवा हस्तांतरीत केले आहेत काय</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="service_delivered" id="service_delivered"
                                                    value="" />
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>20.1</td>
                                            <td>पंप हाऊस भूमिगत टाकी</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="pump_house" id="pump_house"
                                                    value="" />
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>20.2</td>
                                            <td>मालमत्ता कर</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="property_tax" id="property_tax"
                                                    value="" />
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>20.3</td>
                                            <td>पाणी कर</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="water_tax" id="water_tax"
                                                    value="" />
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>21</td>
                                            <td>इमारत चाळीच्या बांधकामाची पूर्णत्वाची तारीख</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="contruction_competion_date" id="contruction_competion_date"
                                                    value="" />
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>22</td>
                                            <td>सह गृह संस्थेने विक्री कारनामा व भाडे पट्टा कारनाम्याचे मसुदे मान्य केलेल्या सर्वसाधारण सभेच्या ठरावाचा दिनांक</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="resolution_meeting_date" id="resolution_meeting_date"
                                                    value="" />
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>23</td>
                                            <td>पदाधिकाऱ्यांची नावे</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="members_name" id="members_name"
                                                    value="" />
                                            </td>
                                        </tr>                                               
                                    </tbody>
                                </table>
                                <div class="" style="margin-top: 29px;">
                                    <button type="submit" class="btn btn-primary btn-custom" 
                                    id="uploadBtn">submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="dycdo-note" role="tabpanel">
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
                                            <h5>Upload Note</h5>
                                            <span class="hint-text">Click on 'Upload' to upload DyCDO - Note</span>
                                            <form action="" method="post">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" name="dyco_note" type="file" id="test-upload"
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
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download Note</h5>
                                            <span class="hint-text">Download DyCDO Note uploaded by DyCDO</span>
                                            <div class="mt-auto">
                                                <button class="btn btn-primary">Download Note Format</button>
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
