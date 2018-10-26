@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.conveyance.dyco_department.action',compact('applicationId'))
@endsection

@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-error display_msg">
    {{ session()->get('error') }}
</div>
@endif

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
                            <input type="hidden" name="application_id" value="{{ $checklist != '' ? $checklist->application_id : '' }}">
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
                                                <input type="text" class="form-control form-control--custom" name="home_organization_name" id="home_organization_name" value="{{ $checklist != '' ? $checklist->home_organization_name : '' }}" readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>संस्था नोंदणी दिनांक</td>
                                            <td class="text-center">
                                                <input type="text" class="txtbox v_text form-control form-control--custom m-input m_datepicker" name="registration_date" id="registration_date" value="{{ $checklist != '' && isset($checklist->registration_date) ? date('d-m-Y',strtotime($checklist->registration_date)) : '' }}" aria-describedby="visit_date-error" aria-invalid="false" readonly disabled>
                                            </td>
                                        </tr>  
                                        <tr>
                                            <td>3.</td>
                                            <td>चाळ क्र</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="chawl_no" id="chawl_no" value="{{ $checklist != '' ? $checklist->chawl_no : '' }}" readonly/>
                                            </td>
                                        </tr>     
                                        <tr>
                                            <td>4.</td>
                                            <td>वसाहतीचे नाव</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="colony_name" id="colony_name" value="{{ $checklist != '' ? $checklist->colony_name : '' }}" readonly/>
                                            </td>
                                        </tr>  
                                        <tr>
                                            <td>5.</td>
                                            <td>मिळकत व्यवस्थापक यांचे ना डे प्रमाण पत्रं</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="property_certificate" id="property_certificate" value="{{ $checklist != '' ? $checklist->property_certificate : '' }}" readonly/>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>i.</td>
                                            <td>सदनिकाधारकांच्या विहित नमुन्यातील यादी</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="tenants_list" id="tenants_list" value="{{ $checklist != '' ? $checklist->tenants_list : '' }}" readonly/>
                                            </td>
                                        </tr>   
                                        <tr>
                                            <td>ii.</td>
                                            <td>दिनांक</td>
                                            <td class="text-center">
                                                <input type="text" class="txtbox v_text form-control form-control--custom m-input m_datepicker" name="date" id="date" value="{{ $checklist != '' && isset($checklist->date) ? date('d-m-Y',strtotime($checklist->date)) : '' }}" aria-describedby="visit_date-error" aria-invalid="false" readonly disabled>
                                            </td>
                                        </tr>    
                                        <tr>
                                            <td>6.</td>
                                            <td>योजनेचा उत्पन्न गट</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="scheme_income_group" id="scheme_income_group" value="{{ $checklist != '' ? $checklist->scheme_income_group : '' }}" readonly/>
                                            </td>
                                        </tr>   
                                        <tr>
                                            <td>7.</td>
                                            <td>सदनिकां ची एकूण संख्या</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="total_flat" id="total_flat" value="{{ $checklist != '' ? $checklist->total_flat : '' }}" readonly/>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>8.</td>
                                            <td>प्रथम सदनिका वितरणाची दिनांक</td>
                                            <td class="text-center">
                                                <input type="text" class="txtbox v_text form-control form-control--custom m-input m_datepicker" name="first_flat_issue_date" id="first_flat_issue_date" value="{{ $checklist != '' && isset($checklist->first_flat_issue_date) ? date('d-m-Y',strtotime($checklist->first_flat_issue_date)) : '' }}" aria-describedby="visit_date-error" aria-invalid="false" readonly disabled>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>9.</td>
                                            <td>वितरण वैयक्तिक आहे का</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="individual_destribution" id="individual_destribution" value="{{ $checklist != '' ? $checklist->individual_destribution : '' }}" readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10.</td>
                                            <td>सदनिका वितरणाची पद्धत</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="flat_delivery_method" id="flat_delivery_method" value="{{ $checklist != '' ? $checklist->flat_delivery_method : '' }}" readonly/>
                                            </td>
                                        </tr>   
                                        <tr>
                                            <td>11.1</td>
                                            <td>HPS असल्यास हफ्त्यांचा कालावधी</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="hps_installement_time" id="hps_installement_time" value="{{ $checklist != '' ? $checklist->hps_installement_time : '' }}" readonly/>
                                            </td>
                                        </tr>   
                                        <tr>
                                            <td>11.2</td>
                                            <td>HPS असल्यास पूर्ण झाल्याची दिनांक</td>
                                            <td class="text-center">
                                            <input type="text" class="txtbox v_text form-control form-control--custom m-input m_datepicker" name="hps_installement_date" id="hps_installement_date" value="{{ $checklist != '' && isset($checklist->hps_installement_date) ? date('d-m-Y',strtotime($checklist->hps_installement_date)) : '' }}" aria-describedby="visit_date-error" aria-invalid="false" readonly disabled>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>12</td>
                                            <td>अंतिम विक्री किंमत</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="final_sale_price" id="final_sale_price" value="{{ $checklist != '' ? $checklist->final_sale_price : '' }}" readonly/>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>12.2</td>
                                            <td>बांधकाम किंमत</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="contruction_price" id="contruction_price" value="{{ $checklist != '' ? $checklist->contruction_price : '' }}" readonly/>
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>12.3</td>
                                            <td>जमिनीचे अधिमूल्य</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="land_premium" id="land_premium" value="{{ $checklist != '' ? $checklist->land_premium : '' }}" readonly/>
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>13</td>
                                            <td>संपूर्ण विक्री किंमत भरणा केली आहे काय</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="payment_completed" id="payment_completed" value="{{ $checklist != '' ? $checklist->payment_completed : '' }}" readonly/>
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>14</td>
                                            <td>जमिनीचे अधिमूल्य भरले आहे काय</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="land_premium_completed" id="land_premium_completed" value="{{ $checklist != '' ? $checklist->land_premium_completed : '' }}" readonly/>
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>15</td>
                                            <td>संस्थेने भरायायचा भुभाडे चा वार्षिक दर</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="organization_rent_rate" id="organization_rent_rate" value="{{ $checklist != '' && isset($checklist->organization_rent_rate) ? $checklist->organization_rent_rate : '' }}" readonly/>
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>16</td>
                                            <td>संस्थेने भुभाडे कोणत्या तारिखे पर्यंत भरलेले आहे</td>
                                            <td class="text-center">
                                               <input type="text" class="txtbox v_text form-control form-control--custom m-input m_datepicker" name="last_date_of_rent" id="last_date_of_rent" value="{{ $checklist != '' && isset($checklist->last_date_of_rent) ? date('d-m-Y',strtotime($checklist->last_date_of_rent)) : '' }}" aria-describedby="visit_date-error" aria-invalid="false" readonly disabled>
                                            </td>
                                        </tr>                                          
                                        <tr>
                                            <td>17</td>
                                            <td>सेवा शुल्क भरणा केल्याची दिनांक</td>
                                            <td class="text-center">
                                                 <input type="text" class="txtbox v_text form-control form-control--custom m-input m_datepicker" name="service_tax_date" id="service_tax_date" value="{{ $checklist != '' && isset($checklist->service_tax_date) ? date('d-m-Y',strtotime($checklist->service_tax_date)) : '' }}" aria-describedby="visit_date-error" aria-invalid="false" readonly disabled>
                                            </td>
                                        </tr>                                          
                                        <tr>
                                            <td>18</td>
                                            <td>संस्थेने भरावयाचा सेवा शुल्काचा दर</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="service_tax_rate" id="service_tax_rate" value="{{ $checklist != '' ? $checklist->service_tax_rate : '' }}" readonly/>
                                            </td>
                                        </tr>                                          
                                        <tr>
                                            <td>19</td>
                                            <td>कार्य अभि यांच्या नकाशा नुसार </td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="work_assignment" id="work_assignment" value="{{ $checklist != '' ? $checklist->work_assignment : '' }}" readonly/>
                                            </td>
                                        </tr>                                          
                                        <tr>
                                            <td>19.1</td>
                                            <td>संस्थेचे एकूण क्षेत्रफळ</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="society_area" id="society_area" value="{{ $checklist != '' ? $checklist->society_area : '' }}" readonly/>
                                            </td>
                                        </tr>                                          
                                        <tr>
                                            <td>19.2</td>
                                            <td>नकाशामध्ये चतुर्सिमा, सर्व्हे नं सी ती एस  नं इ तपशील दिला आहे का</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="serve_map" id="serve_map" value="{{ $checklist != '' ? $checklist->serve_map : '' }}" readonly/>
                                            </td>
                                        </tr>                                          
                                        <tr>
                                            <td>20</td>
                                            <td>संस्थेस सेवा हस्तांतरीत केले आहेत काय</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="service_delivered" id="service_delivered" value="{{ $checklist != '' ? $checklist->service_delivered : '' }}" readonly/>
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>20.1</td>
                                            <td>पंप हाऊस भूमिगत टाकी</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="pump_house" id="pump_house" value="{{ $checklist != '' ? $checklist->pump_house : '' }}" readonly/>
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>20.2</td>
                                            <td>मालमत्ता कर</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="property_tax" id="property_tax" value="{{ $checklist != '' ? $checklist->property_tax : '' }}" readonly/>
                                            </td>
                                        </tr>                                         
                                        <tr>
                                            <td>20.3</td>
                                            <td>पाणी कर</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="water_tax" id="water_tax" value="{{ $checklist != '' ? $checklist->water_tax : '' }}" readonly/>
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>21</td>
                                            <td>इमारत चाळीच्या बांधकामाची पूर्णत्वाची तारीख</td>
                                            <td class="text-center">
                                                <input type="text" class="txtbox v_text form-control form-control--custom m-input m_datepicker" name="contruction_competion_date" id="contruction_competion_date" value="{{ $checklist != '' && isset($checklist->contruction_competion_date) ? date('d-m-Y',strtotime($checklist->contruction_competion_date)) : '' }}" aria-describedby="visit_date-error" aria-invalid="false" readonly disabled>
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>22</td>
                                            <td>सह गृह संस्थेने विक्री कारनामा व भाडे पट्टा कारनाम्याचे मसुदे मान्य केलेल्या सर्वसाधारण सभेच्या ठरावाचा दिनांक</td>
                                            <td class="text-center">
                                                <input type="text" class="txtbox v_text form-control form-control--custom m-input m_datepicker" name="resolution_meeting_date" id="resolution_meeting_date" value="{{ $checklist != '' && isset($checklist->resolution_meeting_date) ? date('d-m-Y',strtotime($checklist->resolution_meeting_date)) : '' }}" aria-describedby="visit_date-error" aria-invalid="false" readonly disabled>
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>23</td>
                                            <td>पदाधिकाऱ्यांची नावे</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="members_name" id="members_name" value="{{ $checklist != '' ? $checklist->members_name : '' }}" readonly/>
                                            </td>
                                        </tr>                                               
                                    </tbody>
                                </table>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="tab-pane" id="dycdo-note" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download DyCDO Note</h5>
                                            <div class="mt-auto">
                                            @if(isset($checklist->dyco_note))
                                            <a href="{{ config('commanConfig.storage_server').'/'.$checklist->dyco_note }}"><Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                    Download </Button>
                                            </a>
                                            @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">*Note : DYCDO note is not available.</span>
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
@endsection

