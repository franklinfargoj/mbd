@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.conveyance.'.$data->folder.'.action')
@endsection
@section('css')

<style>
    .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('/img/loading-spinner-blue.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>
@endsection
@section('content')
<div class="loader" style="display:none;"></div>

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-success display_msg">
    {{ session()->get('error') }}
</div>
@endif

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

    <!-- conveyance map -->
    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table">
                <form class="nav-tabs-form" id ="conveyanceMapFRM" role="form" method="POST" action="{{ route('conveyance.save_architect_scrutiny_remark')}}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
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
                                        *Note : Conveyance map is not uploaded.</span>
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
                </form>            
            </div>
        </div>
    </div>

    <!-- Architect Note -->
    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table">
            @if(session()->get('role_name') == config('commanConfig.junior_architect') && ($data->status->status_id != config('commanConfig.conveyance_status.forwarded') && $data->status->status_id != config('commanConfig.conveyance_status.reverted') ))
                <div class="m-subheader" style="padding: 0;">
                    <div class="d-flex" style="padding-left: 32px;">
                        <h4 class="section-title">
                            Architect Note
                        </h4>
                    </div>
                </div>

                
                <div class="col-sm-6" style="">
                    <div class="d-flex flex-column h-100 two-cols">
                        <h5>Upload Note</h5>
                        <span class="hint-text">Click on 'Upload' to upload Architect note</span>
                        <form action="{{ route('conveyance.upload_architect_note') }}" method="post"
                            enctype="multipart/form-data" id="ArchitectNote">
                            @csrf
                            <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
                            <div class="custom-file">
                                <input class="custom-file-input" name="architect_note" type="file"
                                    id="test-upload" required="">
                                <label class="custom-file-label" for="test-upload">Choose
                                    file...</label>
                            </div>
                            <span class="text-danger" id="file_error"></span>
                            <div class="mt-auto">
                                <button type="submit" style="" class="btn btn-primary btn-custom upload_note"
                                    id="uploadBtn">Upload</button>
                            </div>
                        </form>
                    </div>
                </div> 
                @endif

                
                <div class="m-section__content mb-0 table-responsive" style="margin-top: 30px">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="d-flex flex-column h-100 two-cols">
                                    @if(isset($architectNote) && count($architectNote) > 0)
                                        <h5>Download Architect Note</h5>
                                        <div class="table-responsive">
                                            <table class="mt-2 table table-hover" id="architectNoteTable" >
                                            <thead>
                                                <tr>
                                                    <th>Document</th>
                                                    <th>Download</th>
                                                    @if(session()->get('role_name') == config('commanConfig.junior_architect') && ($data->status->status_id != config('commanConfig.conveyance_status.forwarded') && $data->status->status_id != config('commanConfig.conveyance_status.reverted') ))
                                                        <th>Delete</th>
                                                    @endif
                                                </tr>
                                            </thead> 
                                                <tbody>
                                                    @foreach($architectNote as $note)
                                                        <tr>
                                                             <td>
                                                                @php
                                                                    if($note->document_path){
                                                                        $fileName = explode(".",explode('/',$note->document_path)[1])[0];
                                                                    }
                                                                @endphp 

                                                                {{ isset($fileName) ? $fileName : ''}} 
                                                            </td>
                                                            <td class="text-center">
                                                                <a class="btn-link" download href="{{ config('commanConfig.storage_server').'/'.$note->document_path}} " target="_blank" download>
                                                                Download </a> 
                                                            </td>
                                                            @if(session()->get('role_name') == config('commanConfig.junior_architect') && ($data->status->status_id != config('commanConfig.conveyance_status.forwarded') && $data->status->status_id != config('commanConfig.conveyance_status.reverted') ))
                                                            <td class="text-center" style="">
                                                                <i class="fa fa-close icon2 d-icon hide-print" id="{{ isset($note->id) ? $note->id : '' }}" onclick="removeDocuments(this.id)"></i>
                                                                <input type="hidden" name= "oldFile" id="oldFile_{{$note->id}}" value="{{ isset($note->document_path) ? $note->document_path : '' }}"> 
                                                            </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>    
                                            </table>

                                        </div>
                                    @else
                                    <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                        * Note : Architect Note not uploaded. </span>
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

    $("#ArchitectNote").validate({
        rules: {
            architect_note: {
                required: true,
                extension: "pdf"
            },
        }, messages: {
            architect_note: {
                extension: "Invalid type of file uploaded (only pdf allowed)."
            }
        }
    }); 

     $(document).ready(function () {
      $('#architectNoteTable').DataTable();
      $('.dataTables_length').addClass('bs-select');

      $('#architectNoteTable > .row:first-child').remove();
    });  

    $('table').dataTable({searching: false, ordering:false, info: false});

    function removeDocuments(id) {
     
        var oldFile = $("#oldFile_"+id).val();
        var form_data = new FormData();
        form_data.append('id', id);
        form_data.append('oldFile', oldFile);
        form_data.append('_token', document.getElementsByName("_token")[0].value);
        $(".loader").show();
   
        $.ajax({
            url: "/delete_architect_note",
            data: form_data,
            type: 'POST',
            contentType: false,
            cache: false, 
            processData: false,
            success: function(data) {
                console.log(data);
                $(".loader").hide();
                if (data == 'success'){
                    location.reload();
                }
            }
        })        
    }
</script>    
@endsection    
