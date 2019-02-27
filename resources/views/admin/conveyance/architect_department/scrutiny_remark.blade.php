@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.conveyance.'.$data->folder.'.action')
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
            <h3 class="m-subheader__title m-subheader__title--separator">
                Scrutiny & Remark </h3>
                 {{ Breadcrumbs::render('conveyance_architect_scrutiny',$data->id) }}
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
                                <span class="field-value"> {{ isset($data->application_no) ? $data->application_no : '' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Application Date:</span>
                                <span class="field-value">{{ isset($data->created_at) ? $data->created_at : '' }}</span>


                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Society Registration No:</span>
                                <span class="field-value">{{ isset($data->societyApplication->registration_no) ? $data->societyApplication->registration_no : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Society Name:</span>
                                <span class="field-value">{{ isset($data->societyApplication->name) ? $data->societyApplication->name : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Society Address:</span>
                                <span class="field-value">{{ isset($data->societyApplication->address) ? $data->societyApplication->address : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Building Number:</span>
                                <span class="field-value">{{ isset($data->societyApplication->building_no) ? $data->societyApplication->building_no : '' }}</span>
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
                                <span class="field-value">{{ isset($data->societyApplication->name_of_architect) ? $data->societyApplication->name_of_architect : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Mobile Number:</span>
                                <span class="field-value">{{ isset($data->societyApplication->architect_mobile_no) ? $data->societyApplication->architect_mobile_no : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Address:</span>
                                <span class="field-value">{{ isset($data->societyApplication->architect_address) ? $data->societyApplication->architect_address : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Architect Telephone Number:</span>
                                <span class="field-value">{{ isset($data->societyApplication->architect_telephone_no) ? $data->societyApplication->architect_telephone_no : '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->
<form class="nav-tabs-form" id ="conveyanceMapFRM" role="form" method="POST" action="{{ route('conveyance.save_architect_scrutiny_remark')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
    <!-- Site Visit -->
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-subheader" style="padding: 0;">
                            <div class="d-flex align-items-center justify-content-center">
                                <h4 class="section-title">
                                    Conveyance map
                                </h4>
                            </div>
                        </div>
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                
                                <div class="col-sm-6">
                                    <div class="d-flex flex-column h-100 two-cols">
                                        <h5>Download</h5>
                                        <span class="hint-text">Click to download Conveyance map </span>
                                        <div class="mt-auto">
                                            @if(isset($data->conveyance_map->document_path))
                                             <input type="hidden" name="oldFileName" value="{{ $data->conveyance_map->document_path }}">
                                            <a href="{{ config('commanConfig.storage_server').'/'.$data->conveyance_map->document_path }}" target="_blank">
                                            <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                    Download </Button>
                                            </a>
                                            @else
                                            <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                *Note : Conveyance map is not available.</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>                                    
                                @if(session()->get('role_name') == config('commanConfig.junior_architect') && 
                                ($data->status->status_id != config('commanConfig.conveyance_status.forwarded') && $data->status->status_id != config('commanConfig.conveyance_status.reverted') ))
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Upload</h5>
                                            <span class="hint-text">Click on 'Upload' to upload Conveyance map</span>
                                                <div class="custom-file">
                                                    <input class="custom-file-input" name="conveyance_map" type="file" id="test-upload1">
                                                
                                                        <label class="custom-file-label" for="test-upload1">Choose
                                                        file...</label>   
                                                </div>
                                            <div class="d-flex">
                                                <button type="submit" class="btn btn-primary mt-3" style="display:block">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</form>            
</div> 
@endsection

@section('js')
<script>
    $("#conveyanceMapFRM").validate({
        rules: {
            conveyance_map: {
                required: true,
                extension: "pdf"
            },
        }, messages: {
            conveyance_map: {
                extension: "Invalid type of file uploaded (only pdf allowed)."
            }
        }
    }); 
</script>    
@endsection    
