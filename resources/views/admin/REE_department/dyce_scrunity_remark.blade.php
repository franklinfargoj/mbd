@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.REE_department.action',compact('ol_application'))
@endsection
@section('css')
<!-- <style> -->
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">DyCE Scrutiny & Remark </h3>
            {{ Breadcrumbs::render('DYCE_scrutiny_ree',$ol_application->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m_panel">
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
                                <span class="field-value">{{(isset($applicationData->application_no) ?
                                    $applicationData->application_no : '')}}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Application Date:</span>
                                <span class="field-value">{{(isset($applicationData->submitted_at) ?
                                    date(config('commanConfig.dateFormat'),strtotime($applicationData->submitted_at)) :
                                    '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Society Name:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->name) ?
                                    $applicationData->eeApplicationSociety->name : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Society Address:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->address) ?
                                    $applicationData->eeApplicationSociety->address : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Building Number:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->building_no)
                                    ? $applicationData->eeApplicationSociety->building_no : '')}}</span>
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
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->name_of_architect)
                                    ? $applicationData->eeApplicationSociety->name_of_architect : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Mobile Number:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_mobile_no)
                                    ? $applicationData->eeApplicationSociety->architect_mobile_no : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Address:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_address)
                                    ? $applicationData->eeApplicationSociety->architect_address : '')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Telephone Number:</span>
                                <span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_telephone_no)
                                    ? $applicationData->eeApplicationSociety->architect_telephone_no : '')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->

    <!-- Site Visit -->
    <form role="form" id="dyce_scrunity_Form" name="scrunityForm" class="form-horizontal" method="post" action=""
        enctype="multipart/form-data">

        @csrf
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body" style="padding-right: 0;">
                <h3 class="section-title section-title--small">
                    Site Visit:
                </h3>
                <div class="row field-row">
                    <div class="col-sm-6 field-col">
                        <div class="d-flex">
                            <span class="field-name">Society Name:</span>
                            <span class="field-value">{{(isset($applicationData->eeApplicationSociety->name) ?
                                $applicationData->eeApplicationSociety->name : '')}}
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6 field-col">
                        <div class="d-flex">
                            <span class="field-name">Building number:</span>
                            <span class="field-value">{{(isset($applicationData->eeApplicationSociety->building_no) ?
                                $applicationData->eeApplicationSociety->building_no : '')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-6 field-col">
                        <div class="d-flex">
                            <span class="field-name">Name of Inspector:</span>
                            <span class="field-value" style="width: 242px;word-break: break-all;">{{(isset($applicationData->site_visit_officers)
                                ? $applicationData->site_visit_officers : '')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-6 field-col">
                        <div class="d-flex">
                            <span class="field-name">Date of site visit:</span>
                            <span class="field-value">{{($applicationData->date_of_site_visit) ? date(config('commanConfig.dateFormat'),strtotime($applicationData->date_of_site_visit)) : ''}}</span>
                        </div>
                    </div>
                    @foreach($applicationData->visitDocuments as $data)

                        @php $fileName = explode('/',$data->document_path)[1];
                            $imgIcon = explode('.',$fileName)[1];
                        @endphp 
                    <div class="col-sm-12 field-col">
                        <div class="d-flex">
                            <span style="width: 200px;">Upload Site Photos:</span>
                            <a href="{{config('commanConfig.storage_server').'/'.$data->document_path}}">
                                @if($imgIcon == 'pdf')
                                    <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}">
                                            
                                @else
                                    <i class="pdf-icon fa fa-file-image-o" aria-hidden="true" style="color: #862727;font-size: 19px;"></i>  
                                @endif
                            </a>
                            <span class="field-value" style="padding-left: 15px;">{{ (isset(explode('/',$data->document_path)[1]) ? explode('/',$data->document_path)[1]: '') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- end  -->

        <!-- Demarkation verification -->
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body">
                <h3 class="section-title section-title--small">
                    Demarkation Verification:
                </h3>
                <div class="remarks-suggestions">
                    <div class="mt-3 table--box-input">
                        <label for="demarkation_comments">Comments:</label>
                        <textarea rows="5" cols="30" class="form-control form-control--custom" name="demarkation_comments"
                            readonly>{{(isset($applicationData->demarkation_verification_comment) ? $applicationData->demarkation_verification_comment : '')}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- end  -->

        <!-- Encrochment verification -->
        <div class="m-portlet m-portlet--mobile m_panel table--box-input">
            <div class="m-portlet__body">
                <h3 class="section-title section-title--small">
                    Encrochment Verification:
                </h3>
                <div class="m-form__group form-group">
                    <span class="mr-3">Is there any encrochment ?</span>
                    <label class="m-radio m-radio--primary">
                        <input type="radio" class="radioBtn" name="encrochment" value="1" disabled
                            {{(isset($applicationData->demarkation_verification_comment) && $applicationData->is_encrochment == '1' ? 'checked' : '')}}>
                        Yes
                        <span></span>
                    </label>
                    <label class="m-radio m-radio--primary">
                        <input type="radio" class="radioBtn" name="encrochment" value="0" disabled
                            {{(isset($applicationData->demarkation_verification_comment) && $applicationData->is_encrochment == '0' ? 'checked' : '')}}>No
                        <span></span>
                    </label>
                    <div class="mt-3">
                        <label class="e_comments" for="encrochment_comments">If Yes, Comments:</label>
                        <textarea rows="5" cols="30" class="form-control form-control--custom" id="encrochment_comments"
                            name="encrochment_comments" readonly>{{(isset($applicationData->encrochment_verification_comment) ? $applicationData->encrochment_verification_comment : '')}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
