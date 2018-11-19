@extends('admin.layouts.sidebarAction')
@section('actions')
@include('employment_of_architect.actions',compact('application'))
@endsection
@section('content')

<div class="col-md-12">
    <div class="m-subheader px-0">
        <div class="d-flex">
            {{-- {{ Breadcrumbs::render('calculation_sheet',$ol_application->id) }} --}}
            <div class="ml-auto btn-list">
                <a href="{{route('appointing_architect.step9',['id'=>encrypt($application->id)])}}" class="btn btn-link"><i
                        class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--compact form-accordion mt-4">
        <div class="d-flex justify-content-between align-items-center form-steps-toplinks">
            <a class="btn--unstyled section-title section-title--small form-count-title d-flex justify-content-between collapsed"
                data-toggle="collapse" href="#form_1">
                <span class="form-accordion-title">APPLICATION FORM FOR EMPLOYMENT OF ARCHITECT</span><span class="accordion-icon"></span>
            </a>
        </div>
        <div class="m-portlet__body m-portlet__body--spaced collapse" id="form_1" data-parent="#accordion">
            @include('employment_of_architect.partial_personal_details',compact('application'))
            @include('employment_of_architect.partial_payment_details',compact('application'))
        </div>
    </div>

    <div class="m-portlet m-portlet--compact form-accordion">
        <div class="d-flex justify-content-between align-items-center form-steps-toplinks">
            <a class="btn--unstyled section-title section-title--small form-count-title d-flex justify-content-between collapsed"
                data-toggle="collapse" href="#form_2">
                <span class="form-accordion-title">EMPANELMENT OF ARCHITECT/CONSULTANT WITH MHADA</span><span class="accordion-icon"></span>
            </a>
        </div>
        <div class="m-portlet__body m-portlet__body--spaced collapse" id="form_2" data-parent="#accordion">
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Enclosures
                        </h3>
                    </div>
                </div>
            </div>
            @php $i=0; @endphp
            @foreach($application->enclosures as $enclosure)
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">{{$i+1}}.</label>
                    <input type="text" id="" name="enclosures[]" class="form-control form-control--custom m-input w-100"
                        value="{{$enclosure->enclosure}}">
                </div>
                <span class="help-block"></span>
            </div>
            @php $i=$i+1; @endphp
            @endforeach
            <div class="m-checkbox-list mt-5">
                <label class="m-checkbox m-checkbox--primary">
                    <input {{$application->application_info_and_its_enclosures_verify==1?"checked":""}} type="checkbox"
                        name="application_info_and_its_enclosures_verify" value="1"> Is verified by me and the same is
                    correct by my knowledge
                    <span class=""></span>
                </label>
                @if ($errors->has('application_info_and_its_enclosures_verify'))
                <span class="text-danger">{{ $errors->first('application_info_and_its_enclosures_verify') }}</span>
                @endif
            </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--compact form-accordion">
        <div class="d-flex justify-content-between align-items-center form-steps-toplinks">
            <a class="btn--unstyled section-title section-title--small form-count-title d-flex justify-content-between collapsed"
                data-toggle="collapse" href="#form_3">
                <span class="form-accordion-title">ARCHITECT/CONSULTANT</span><span class="accordion-icon"></span></a>
        </div>
        <div class="m-portlet__body m-portlet__body--spaced collapse" id="form_3" data-parent="#accordion">
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Details of Establishment:</label>
                    <input type="text" id="" name="details_of_establishment" class="form-control form-control--custom m-input"
                        value="{{$application->details_of_establishment}}">
                    @if ($errors->has('details_of_establishment'))
                    <span class="text-danger">{{ $errors->first('details_of_establishment') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Branch Office Details:</label>
                    <input type="text" id="" name="branch_office_details" class="form-control form-control--custom m-input"
                        value="{{$application->branch_office_details}}">
                    @if ($errors->has('branch_office_details'))
                    <span class="text-danger">{{ $errors->first('branch_office_details') }}</span>
                    @endif
                </div>
            </div>
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Details of Staff
                        </h3>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Architects:</label>
                    <input type="text" id="" name="staff_architects" class="form-control form-control--custom m-input"
                        value="{{$application->staff_architects}}">
                    @if ($errors->has('staff_architects'))
                    <span class="text-danger">{{ $errors->first('staff_architects') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Engineer:</label>
                    <input type="text" id="" name="staff_engineers" class="form-control form-control--custom m-input"
                        value="{{$application->staff_engineers}}">
                    @if ($errors->has('staff_engineers'))
                    <span class="text-danger">{{ $errors->first('staff_engineers') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Supporting (Tech.):</label>
                    <input type="text" id="" name="staff_supporting_tech" class="form-control form-control--custom m-input"
                        value="{{$application->staff_supporting_tech}}">
                    @if ($errors->has('staff_supporting_tech'))
                    <span class="text-danger">{{ $errors->first('staff_supporting_tech') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Supporting (Non Tech.):</label>
                    <input type="text" id="" name="staff_supporting_nontech" class="form-control form-control--custom m-input"
                        value="{{$application->staff_supporting_nontech}}">
                    @if ($errors->has('staff_supporting_nontech'))
                    <span class="text-danger">{{ $errors->first('staff_supporting_nontech') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Others:</label>
                    <input type="text" id="" name="staff_others" class="form-control form-control--custom m-input"
                        value="{{$application->staff_others}}">
                    @if ($errors->has('staff_others'))
                    <span class="text-danger">{{ $errors->first('staff_others') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Total:</label>
                    <input type="text" id="" name="staff_total" class="form-control form-control--custom m-input" value="{{$application->staff_total}}">
                    @if ($errors->has('staff_total'))
                    <span class="text-danger">{{ $errors->first('staff_total') }}</span>
                    @endif
                </div>
            </div>
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <div class="d-flex">
                            <h3 class="m-portlet__head-text mr-5">
                                Details of C.A.D Facility
                            </h3>
                            <div class="m-radio-inline">
                                <label class="m-radio m-radio--primary">
                                    <input type="radio" name="is_cad_facility" value="1"
                                        {{$application->is_cad_facility==1?'checked':''}}> Yes
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--primary">
                                    <input type="radio" name="is_cad_facility" value="0"
                                        {{$application->is_cad_facility==0?'checked':''}}>
                                    No
                                    <span></span>
                                </label>
                                @if ($errors->has('is_cad_facility'))
                                <span class="text-danger">{{ $errors->first('is_cad_facility') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Computers:</label>
                    <input type="text" id="" name="cad_facility_no_of_computers" class="form-control form-control--custom m-input"
                        value="{{$application->cad_facility_no_of_computers}}">
                    @if ($errors->has('cad_facility_no_of_computers'))
                    <span class="text-danger">{{ $errors->first('cad_facility_no_of_computers') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">No of Printers:</label>
                    <input type="text" id="" name="cad_facility_no_of_printers" class="form-control form-control--custom m-input"
                        value="{{$application->cad_facility_no_of_printers}}">
                    @if ($errors->has('cad_facility_no_of_printers'))
                    <span class="text-danger">{{ $errors->first('cad_facility_no_of_printers') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Plotters:</label>
                    <input type="text" id="" name="cad_facility_no_of_plotters" class="form-control form-control--custom m-input"
                        value="{{$application->cad_facility_no_of_plotters}}">
                    @if ($errors->has('cad_facility_no_of_plotters'))
                    <span class="text-danger">{{ $errors->first('cad_facility_no_of_plotters') }}</span>
                    @endif
                </div>
            </div>
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <div class="d-flex">
                            <h3 class="m-portlet__head-text">
                                DETAILS IF REGISTRATION WITH COUNCIL OF ARCHITECTURE
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Principle:</label>
                    <input type="text" id="" name="reg_with_council_of_architecture_principle" class="form-control form-control--custom m-input"
                        value="{{$application->reg_with_council_of_architecture_principle}}">
                    @if ($errors->has('reg_with_council_of_architecture_principle'))
                    <span class="text-danger">{{ $errors->first('reg_with_council_of_architecture_principle') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Associate:</label>
                    <input type="text" id="" name="reg_with_council_of_architecture_associate" class="form-control form-control--custom m-input"
                        value="{{$application->reg_with_council_of_architecture_associate}}">
                    @if ($errors->has('reg_with_council_of_architecture_associate'))
                    <span class="text-danger">{{ $errors->first('reg_with_council_of_architecture_associate') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Partner:</label>
                    <input type="text" id="" name="reg_with_council_of_architecture_partner" class="form-control form-control--custom m-input"
                        value="{{$application->reg_with_council_of_architecture_partner}}">
                    @if ($errors->has('reg_with_council_of_architecture_partner'))
                    <span class="text-danger">{{ $errors->first('reg_with_council_of_architecture_partner') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Total Registered Persons:</label>
                    <input type="text" id="" name="reg_with_council_of_architecture_total_registered_persons" class="form-control form-control--custom m-input"
                        value="{{$application->reg_with_council_of_architecture_total_registered_persons}}">
                    @if ($errors->has('reg_with_council_of_architecture_total_registered_persons'))
                    <span class="text-danger">{{
                        $errors->first('reg_with_council_of_architecture_total_registered_persons') }}</span>
                    @endif
                </div>
            </div>
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <div class="d-flex">
                            <h3 class="m-portlet__head-text">
                                Extra
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Awards, Prizes Etc</label>
                    <input type="text" id="" name="award_prizes_etc" class="form-control form-control--custom m-input"
                        value="{{$application->award_prizes_etc}}">
                    @if ($errors->has('award_prizes_etc'))
                    <span class="text-danger">{{ $errors->first('award_prizes_etc') }}</span>
                    @endif
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Other Information:</label>
                    <input type="text" id="" name="other_information" class="form-control form-control--custom m-input"
                        value="{{$application->other_information}}">
                    @if ($errors->has('other_information'))
                    <span class="text-danger">{{ $errors->first('other_information') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--compact form-accordion">
        <div class="d-flex justify-content-between align-items-center form-steps-toplinks">
            <a class="btn--unstyled section-title section-title--small form-count-title d-flex justify-content-between collapsed"
                data-toggle="collapse" href="#form_4">
                <span class="form-accordion-title">DETAIL OF 5 IMPORTANT PROJECTS</span><span class="accordion-icon"></span>
            </a>
        </div>
        <div class="m-portlet__body m-portlet__body--spaced m-portlet__body--table collapse" id="form_4" data-parent="#accordion">
            <div class="">
                <div class="table-responsive">
                    <table id="table-form-4" class="table table--box-input imp_projects">
                        <thead class="thead-default">
                            <tr>
                                <th>Name of Client</th>
                                <th>Location</th>
                                <th>Category of Client</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($application->imp_projects as $imp_project)
                            <tr class="cloneme">
                                <td>
                                    <input type="hidden" name="imp_project_id[]" value="{{$imp_project->id}}">
                                    <input name="name_of_client[]" value="{{$imp_project->name_of_client}}" placeholder="Name of Client"
                                        type="text" class="form-control form-control--custom">
                                </td>
                                <td>
                                    <input name="location[]" value="{{$imp_project->location}}" placeholder="Location"
                                        type="text" class="form-control form-control--custom">
                                </td>
                                <td>
                                    <input name="category_of_client[]" value="{{$imp_project->category_of_client}}"
                                        placeholder="Category of Client" type="text" class="form-control form-control--custom">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--compact form-accordion">
        <div class="d-flex justify-content-between align-items-center form-steps-toplinks">
            <a class="btn--unstyled section-title section-title--small form-count-title d-flex justify-content-between collapsed"
                data-toggle="collapse" href="#form_5">
                <span class="form-accordion-title">DETAILS OF WORK HANDLED</span><span class="accordion-icon"></span>
            </a>
        </div>
        <div class="m-portlet__body m-portlet__body--spaced m-portlet__body--table collapse" id="form_5" data-parent="#accordion">
            <div class="">
                <div class="table-responsive">
                    <table id="table-form-4" class="table table--box-input imp_projects">
                        <thead class="thead-default">
                            <tr>
                                <th>Name of Client</th>
                                <th>No. of Dwelling Units / Flats</th>
                                <th>Land Area in Sq. mt</th>
                                <th>Built Up Area in Sq. mt</th>
                                <th>Value of Works in Rs. (Lakhs)</th>
                                <th>Year of Completion / Start</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $project_count=$application->imp_project_work_handled->count();
                            @endphp
                            @if($project_count>1)
                            @php $k=($project_count-1); @endphp
                            @else
                            @php $k=0; @endphp
                            @endif
                            @for($j=0;$j<(1+$k);$j++) <tr class="cloneme">
                                <td>
                                    <input type="hidden" name="imp_project_work_handled_id[]" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->id:''):''}}">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        id="" name="eoa_application_imp_project_detail_id[]">
                                        @foreach($application->imp_projects as $imp_projects)
                                        <option
                                            {{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?($application->imp_project_work_handled[$j]->eoa_application_imp_project_detail_id==$imp_projects->id?'selected':''):''):''}}
                                            value="{{$imp_projects->id}}">{{$imp_projects->name_of_client}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input name="no_of_dwelling[]" placeholder="No. of Dwelling" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->no_of_dwelling:''):''}}"
                                        type="text" class="form-control form-control--custom"></td>
                                <td><input name="land_area_in_sq_mt[]" placeholder="Land Area" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->land_area_in_sq_mt:''):''}}"
                                        type="text" class="form-control form-control--custom"></td>
                                <td><input name="built_up_area_in_sq_mt[]" placeholder="Built Up Area" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->built_up_area_in_sq_mt:''):''}}"
                                        type="text" class="form-control form-control--custom"></td>
                                <td><input name="value_of_work_in_rs[]" placeholder="Value of Works" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->value_of_work_in_rs:''):''}}"
                                        type="text" class="form-control form-control--custom"></td>
                                <td><input name="year_of_completion_start[]" placeholder="Year" value="{{$application->imp_project_work_handled!=''?(isset($application->imp_project_work_handled[$j])?$application->imp_project_work_handled[$j]->year_of_completion_start:''):''}}"
                                        type="text" class="form-control form-control--custom">

                                </td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--compact form-accordion">
        <div class="d-flex justify-content-between align-items-center form-steps-toplinks">
            <a class="btn--unstyled section-title section-title--small form-count-title d-flex justify-content-between collapsed"
                data-toggle="collapse" href="#form_6">
                <span class="form-accordion-title">DETAILS OF IMPORTANT/SENIOR PROFESSIONALS IN THE FIRM</span><span
                    class="accordion-icon"></span>
            </a>
        </div>
        <div class="m-portlet__body m-portlet__body--spaced m-portlet__body--table collapse" id="form_6" data-parent="#accordion">
            <div class="">
                <div class="table-responsive">
                    <table id="table-form-4" class="table table--box-input imp_projects">
                        <thead class="thead-default">
                            <tr>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Qualifications</th>
                                <th>Year of Qualification</th>
                                <th>Length of Service Firm Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $project_count=$application->imp_senior_professionals->count();
                            @endphp
                            @if($project_count>1)
                            @php $k=($project_count-1); @endphp
                            @else
                            @php $k=0; @endphp
                            @endif
                            @for($j=0;$j<(1+$k);$j++) <tr class="cloneme">
                                <td>
                                    <input type="hidden" name="imp_senior_professional_id[]" value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->id:''):''}}">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        id="" name="category[]">
                                        @foreach(config('commanConfig.eoa_imp_senior_professionals_category')
                                        as
                                        $key=>$cat)
                                        <option
                                            {{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?($application->imp_senior_professionals[$j]->category==$key?'selected':''):''):''}}
                                            value="{{$key}}">{{$cat}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->name:''):''}}"
                                        placeholder="Name" name="name[]" type="text" class="form-control form-control--custom"></td>
                                <td>
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        id="" name="qualifications[]">
                                        @foreach(config('commanConfig.eoa_imp_senior_professionals_qualifications')
                                        as
                                        $key=>$qual)
                                        <option
                                            {{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?($application->imp_senior_professionals[$j]->qualifications==$key?'selected':''):''):''}}
                                            value="{{$key}}">{{$qual}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input name="year_of_qualification[]" placeholder="Year of Qualification" type="text"
                                        class="form-control form-control--custom" value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->year_of_qualification:''):''}}"></td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        <input value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->len_of_service_with_firm_in_year:''):''}}"
                                            name="len_of_service_with_firm_in_year[]" placeholder="Length (Firm)" type="text"
                                            class="form-control form-control--custom select-box-list">
                                        <input value="{{$application->imp_senior_professionals!=''?(isset($application->imp_senior_professionals[$j])?$application->imp_senior_professionals[$j]->len_of_service_with_firm_in_month:''):''}}"
                                            name="len_of_service_with_firm_in_month[]" placeholder="Length (Total)"
                                            type="text" class="form-control form-control--custom select-box-list">
                                    </div>

                                </td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="">

        <h3 class="section-title section-title--small">PROJECT SHEET DETAILS - WORK IN HAND</h3>
        @php $j=0; @endphp
        @foreach($work_in_hand as $work_in_ha)
        <div class="m-portlet m-portlet--compact form-accordion">
            <div class="d-flex justify-content-between align-items-center form-steps-toplinks">
                <a class="btn--unstyled section-title section-title--small form-count-title d-flex justify-content-between collapsed"
                    data-toggle="collapse" href="#work_in_hand_{{$j+1}}">
                    <span class="form-accordion-title">Project {{$j+1}}:</span><span class="accordion-icon"></span></a>
            </div>

            <div class="m-portlet__body m-portlet__body--spaced collapse form-count" id="work_in_hand_{{$j+1}}"
                data-parent="#accordion">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Name of Project:</label>
                        <input type="text" id="" name="name_of_project" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->name_of_project}}">

                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Location:</label>
                        <input type="text" id="" name="location" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->location}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Name of Client:</label>
                        <input type="text" id="" name="name_of_client" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->name_of_client}}">
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Address:</label>
                        <input type="text" id="" name="address" class="form-control form-control--custom m-input" value="{{$work_in_ha->address}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Phone Number:</label>
                        <input type="text" id="" name="tel_no" class="form-control form-control--custom m-input" value="{{$work_in_ha->tel_no}}">
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="extract">Upload copy of agreement:
                            <!--<span class="star">*</span>--></label>
                        <div class="custom-file">
                            @php
                            $file="";
                            $file=isset($work_in_ha->copy_of_agreement)?$work_in_ha->copy_of_agreement:'';
                            @endphp
                            <a style="display:{{$file!=''?'block':'none'}}" target="_blank" class="btn-link" href="{{config('commanConfig.storage_server').'/'.$file}}">download</a>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Build Up Area in m<sup>2</sup>:</label>
                        <input type="text" id="" name="built_up_area_in_sq_m" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->built_up_area_in_sq_m}}">
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Land Area in m<sup>2</sup>:</label>
                        <input type="text" id="" name="land_area_in_sq_m" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->land_area_in_sq_m}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Estimated Value of Projects:</label>
                        <input type="text" id="" name="estimated_value_of_project" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->estimated_value_of_project}}">
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Completed Value of Projects:</label>
                        <input type="text" id="" name="completed_value_of_project" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->completed_value_of_project}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Date of Start:</label>
                        <input type="text" id="" name="date_of_start" class="form-control form-control--custom m_datepicker"
                            readonly value="{{$work_in_ha->date_of_start}}">
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Date of Completion:</label>
                        <input type="text" id="" name="date_of_completion" class="form-control form-control--custom m_datepicker"
                            readonly value="{{$work_in_ha->date_of_completion}}">

                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Whether Service Terminated by Client:</label>
                        <input type="text" id="" name="whether_service_terminated_by_client" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->whether_service_terminated_by_client}}">
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Salient Features of Project:</label>
                        <input type="text" id="" name="salient_features_of_project" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->salient_features_of_project}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Reasons for Delay (If any):</label>
                        <input type="text" id="" name="reason_for_delay_if_any" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->reason_for_delay_if_any}}">
                    </div>
                </div>
            </div>
        </div>
        @php $j++; @endphp
        @endforeach
    </div>

    <div class="">
        <h3 class="section-title section-title--small">PROJECT SHEET DETAILS - WORK COMPLETED</h3>
        @php $j=0; @endphp
        @foreach($work_completed as $work_in_ha)
        <div class="m-portlet m-portlet--compact form-accordion">
            <div class="d-flex justify-content-between align-items-center form-steps-toplinks">
                <a class="btn--unstyled section-title section-title--small form-count-title d-flex justify-content-between collapsed"
                    data-toggle="collapse" href="#work_completed_{{$j+1}}">
                    <span class="form-accordion-title">Project {{$j+1}}:</span><span class="accordion-icon"></span></a>
            </div>
            <div class="m-portlet__body m-portlet__body--spaced collapse form-count" id="work_completed_{{$j+1}}"
                data-parent="#accordion">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Name of Project:</label>
                        <input type="text" id="" name="name_of_project" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->name_of_project}}">

                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Location:</label>
                        <input type="text" id="" name="location" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->location}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Name of Client:</label>
                        <input type="text" id="" name="name_of_client" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->name_of_client}}">
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Address:</label>
                        <input type="text" id="" name="address" class="form-control form-control--custom m-input" value="{{$work_in_ha->address}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Phone Number:</label>
                        <input type="text" id="" name="tel_no" class="form-control form-control--custom m-input" value="{{$work_in_ha->tel_no}}">
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="extract">Upload copy of agreement:
                            <!--<span class="star">*</span>--></label>
                        <div class="custom-file">
                            @php
                            $file="";
                            $file=isset($work_in_ha->copy_of_agreement)?$work_in_ha->copy_of_agreement:'';
                            @endphp
                            <a style="display:{{$file!=''?'block':'none'}}" target="_blank" class="btn-link" href="{{config('commanConfig.storage_server').'/'.$file}}">download</a>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Build Up Area in m<sup>2</sup>:</label>
                        <input type="text" id="" name="built_up_area_in_sq_m" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->built_up_area_in_sq_m}}">
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Land Area in m<sup>2</sup>:</label>
                        <input type="text" id="" name="land_area_in_sq_m" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->land_area_in_sq_m}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Estimated Value of Projects:</label>
                        <input type="text" id="" name="estimated_value_of_project" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->estimated_value_of_project}}">
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Completed Value of Projects:</label>
                        <input type="text" id="" name="completed_value_of_project" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->completed_value_of_project}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Date of Start:</label>
                        <input type="text" id="" name="date_of_start" class="form-control form-control--custom m_datepicker"
                            readonly value="{{$work_in_ha->date_of_start}}">
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Date of Completion:</label>
                        <input type="text" id="" name="date_of_completion" class="form-control form-control--custom m_datepicker"
                            readonly value="{{$work_in_ha->date_of_completion}}">

                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Whether Service Terminated by Client:</label>
                        <input type="text" id="" name="whether_service_terminated_by_client" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->whether_service_terminated_by_client}}">
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Salient Features of Project:</label>
                        <input type="text" id="" name="salient_features_of_project" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->salient_features_of_project}}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Reasons for Delay (If any):</label>
                        <input type="text" id="" name="reason_for_delay_if_any" class="form-control form-control--custom m-input"
                            value="{{$work_in_ha->reason_for_delay_if_any}}">
                    </div>
                </div>
            </div>
        </div>
        @php $j++; @endphp
        @endforeach
    </div>

    <div class="m-portlet m-portlet--compact form-accordion">
        <div class="d-flex justify-content-between align-items-center form-steps-toplinks">
            <a class="btn--unstyled section-title section-title--small form-count-title d-flex justify-content-between collapsed"
                data-toggle="collapse" href="#form_9">
                <span class="form-accordion-title">Supporting Documents</span><span class="accordion-icon"></span>
            </a>
        </div>
        @csrf
        <input type="hidden" name="application_id" value="{{$application->id}}">
        <div class="m-portlet__body m-portlet__body--spaced collapse form-count" id="form_9" data-parent="#accordion">
            <div class="">
                <div class="table-responsive">
                    <table id="table-form-4" class="table table--box-input imp_projects">
                        <thead class="thead-default">
                            <tr>
                                <th>Name of Document</th>
                                <th>Attachment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $project_count=$application->supporting_documents->count();
                            @endphp
                            @if($project_count>1)
                            @php $k=($project_count-1); @endphp
                            @else
                            @php $k=0; @endphp
                            @endif
                            @for($j=0;$j<(1+$k);$j++) <tr class="cloneme">
                                <td>
                                    <input type="hidden" name="doc_id[]" value="{{$application->supporting_documents!=''?(isset($application->supporting_documents[$j])?$application->supporting_documents[$j]->id:''):''}}">
                                    <input required name="document_name[]" placeholder="Name of document" value="{{$application->supporting_documents!=''?(isset($application->supporting_documents[$j])?$application->supporting_documents[$j]->document_name:''):''}}"
                                        type="text" class="form-control form-control--custom">
                                </td>
                                <td>
                                    <div class="custom-file mb-0 d-flex align-items-center">
                                        @php
                                        $file="";
                                        $file=isset($application->supporting_documents[$j])?$application->supporting_documents[$j]->document_path:'';
                                        @endphp
                                        <a style="display:{{$file!=''?'block':'none'}}" target="_blank" class="btn-link"
                                            href="{{config('commanConfig.storage_server').'/'.$file}}">download</a>
                                    </div>
                                </td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
    <div class="m-form__actions px-0">
        <div class="btn-list">
            @if($application->form_step==10 && $application->ArchitectApplicationStatusForLoginListing->count()<=0)
                <form method="post" action="{{route('appointing_architect.send_to_architect')}}">
                @csrf
                <input type="hidden" name="app_id" value="{{$application->id}}">
                <button type="submit" id="" class="btn btn-primary">Submit Application</button>
                </form>
                @endif

                {{-- <a href="" class="btn btn-secondary">Cancel</a> --}}
        </div>
    </div>
</div>
</div>

@endsection
@section('js')
<script>
    $("input").filter(
        function (index, item) {
            if (item.name !== 'app_id' && item.name !== '_token') {
                item.setAttribute("disabled", true);
            }
        });
    $("select").filter(
        function (index, item) {
            if (item.name !== 'app_id' && item.name !== '_token') {
                item.setAttribute("disabled", true);
            }
        });

</script>
@endsection
