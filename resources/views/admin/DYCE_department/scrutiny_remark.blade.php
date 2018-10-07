@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.DYCE_department.action',compact('ol_application'))
@endsection
@section('css')
<!-- <style> -->
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

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
            <h3 class="m-subheader__title">DyCE Scrutiny & Remark</h3>
            {{ Breadcrumbs::render('scrutiny_remark-dyce',$ol_application->id) }}
        </div>
    </div>
    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                <div class="m-subheader">
                    <div class="">
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
                                <span class="field-value">{{($applicationData->submitted_at) ? date(config('commanConfig.dateFormat'),strtotime($applicationData->submitted_at)) : ''}}</span>
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
    <form role="form" id="dyce_scrunity_Form" style="margin-top: 30px;" name="scrunityForm" class="form-horizontal" method="post" action="{{ route('dyce.store')}}"
        enctype="multipart/form-data">

        @csrf
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                    <div class="">
                        <h3 class="section-title section-title--small">
                            Site Visit:
                        </h3>
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col-md-6 site_v">
								<div class="d-flex align-items-center mb-5">
									<label class="site-visit-label">Society Name:</label>
									<input type="text" class="txtbox form-control form-control--custom m_input" name="society_name" id="society_name" value="{{(isset($applicationData->eeApplicationSociety->name) ? $applicationData->eeApplicationSociety->name : '')}}"
										readonly>
								</div>
                                @if($is_view)
                                    <?php $i=2;?>
                                    @if(isset($applicationData->SiteVisitorOfficers))
                                        @foreach($applicationData->SiteVisitorOfficers as $officerName)
                                            @if(!empty($officerName))
                                            <div class="officer_name_{{$i}}">
            									<div class="d-flex align-items-center mb-5">
            										<label class="site-visit-label">Name of Officer:</label>
            										<input type="text" class="txtbox form-control form-control--custom m_input" name="officer_name[]" id="officer_name"
            											value="{{$officerName}}">
            										<i class="fa fa-close icon2" id="icon_{{$i}}" onclick="removeOfficerName(this.id)"></i>
            									</div>
                                            </div>
                                            @endif
                                            <?php $i++;?>
                                        @endforeach
                                    @endif

                                    <div class="officer_name_1">
    									<div class="d-flex align-items-center mb-5">
    										<label class="site-visit-label">Name of Officer:</label>
    										<div class="position-relative">
    											<input type="text" class="txtbox form-control form-control--custom m_input" name="officer_name[]" id="officer_name">
    											<a class="add_more" onclick="addMoreText(this);">add more </a>
    											<i class="fa fa-close icon close-icon" id="icon_1" onclick="removeOfficerName(this.id)"></i>
    										</div>									
    									</div>
                                    </div>
                                @else
                                    <div class="officer_name">
                                        <div class="d-flex align-items-center mb-5">
                                            <label class="site-visit-label">Name of Officer:</label>
                                            <div class="position-relative">
                                                <span class="field-value" style="word-break: break-all;">{{$applicationData->site_visit_officers}}</span>
                                            </div>                                  
                                        </div>
                                    </div>                                
                                @endif
                            </div>

                            <div class="col-md-6">
								<div class="d-flex align-items-center mb-5">
									<label class="site-visit-label">Building number:</label>
									<input type="text" class="txtbox b_text form-control form-control--custom m_input" name="building_no" id="building_no" value="{{(isset($applicationData->eeApplicationSociety->building_no) ? $applicationData->eeApplicationSociety->building_no : '')}}"
										readonly>
								</div>
								<div class="d-flex align-items-center mb-5">
									<label class="site-visit-label">Date of site visit:</label>
									<input type="text" class="txtbox v_text form-control form-control--custom m-input {{($is_view ? 'm_datepicker' : '' )}}"
										name="visit_date" id="visit_date" value="{{(isset($applicationData->date_of_site_visit) ? date('d-m-Y',strtotime($applicationData->date_of_site_visit)) : '')}}" {{(!($is_view) ? 'readonly' : '' )}}>
								</div>
                            </div>
                            <div class="col-md-12 all_documents">
                            @if($is_view)
                                <?php $i=2;?>
                                @if(isset($applicationData->visitDocuments))
                                    @foreach($applicationData->visitDocuments as $documents)
                                     
                                    <div class="d-flex align-items-center mb-5 upload_doc_{{$i}}">
                                        <label class="site-visit-label">Upload supporting files:</label>
                                        <div class="custom-file custom-file--fixed mb-0 position-relative">
                                            <input type="file" class="file custom-file-input file_ext upload_file_{{$i}}" name="document[]" id="test-upload_{{$i}}">
                                            <label class="custom-file-label" for="test-upload_{{$i}}" id="file_label_{{$i}}">{{isset(explode('/',$documents->document_path)[1]) ? explode('/',$documents->document_path)[1] : ''}}</label>
                                            <span id="file_error_{{$i}}" class="text-danger"></span>
    										<input type="hidden" class="upload_doc_{{$i}}" id="documentId" name="documentId[]"
                                            value="{{$documents->id}}" readonly>
    										<i class="fa fa-close doc2 close-icon" id="document_{{$i}}" onclick="removeDocuments(this.id)"></i>
    										<span></span>
                                        </div>
                                    </div>
                                    <?php $i++;?>
                                    @endforeach
                                @endif
                                <div class="d-flex align-items-center mb-5 upload_doc_1">
                                    <label class="site-visit-label">Upload supporting files:</label>
                                    <div class="custom-file custom-file--fixed mb-0 position-relative">
                                        <input type="file" class="file custom-file-input file_ext upload_file_1" name="document[]" id="test-upload_1">
                                        <label class="custom-file-label" for="test-upload_1" id="file_label_1">Choose file ...</label>
                                        <span id="file_error_1" class="text-danger"></span>
										<a class="add_more" id="add_more_1" onclick="addMoreDocuments(this);">add more</a>
										<i class="fa fa-close doc close-icon" id="document_1" onclick="removeDocuments(this.id)"></i>
                                    </div>
                                </div>
                            @else
                                @foreach($applicationData->visitDocuments as $data)

                                    <div class="col-sm-12 field-col">
                                        <div class="d-flex">
                                            <span style="width: 200px;">Supporting Documents:</span>
                                            <a href="{{config('commanConfig.storage_server').'/'.$data->document_path}}" target="_blank">

                                            <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>
                                            <span class="field-value" style="padding-left: 15px;">{{ (isset(explode('/',$data->document_path)[1]) ? explode('/',$data->document_path)[1]: '') }}</span>
                                        </div>
                                    </div>
                                @endforeach                            
                            @endif    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end  -->

        <!-- Demarkation verification -->
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
					<div class="">
						<h3 class="section-title section-title--small">
							Demarcation verification:
						</h3>
					</div>
					<div class="remarks-suggestions">
						<div class="mt-3">
							<label for="demarkation_comments">Comments:</label>
							<textarea id="demarkation_comments" rows="5" cols="30" class="form-control form-control--custom" name="demarkation_comments" {{(!($is_view) ? 'readonly' : '' )}}>{{(isset($applicationData->demarkation_verification_comment) ? $applicationData->demarkation_verification_comment : '')}}</textarea>
						</div>
					</div>
                </div>
            </div>
        </div>
        <!-- end  -->

        <!-- Encrochment verification -->
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
					<div class="">
						<h3 class="section-title section-title--small">
							Encroachment Verification:
						</h3>
					</div>
                    <div class="m-form__group form-group">
						<div class="m-radio-inline">
							<span class="mr-3">Is there any encroachment ?</span>
							<label class="m-radio m-radio--primary">
								<input type="radio" class="radioBtn" name="encrochment" value="1" checked
									{{(isset($applicationData->demarkation_verification_comment) && $applicationData->is_encrochment == '1' ? 'checked' : '')}} {{(!($is_view) ? 'disabled' : '' )}}>Yes
									<span></span>
							</label>
							<label class="m-radio m-radio--primary">
								<input type="radio" class="radioBtn" name="encrochment" value="0"
									{{(isset($applicationData->demarkation_verification_comment) && $applicationData->is_encrochment == '0' ? 'checked' : '')}} {{(!($is_view) ? 'disabled' : '' )}}>No
								<span></span>
							</label>
						</div>
						<div class="mt-3">
							<label class="e_comments" for="encrochment_comments">If Yes, Comments:</label>
							<textarea rows="5" cols="30" class="form-control form-control--custom" id="encrochment_comments" name="encrochment_comments" {{(!($is_view) ? 'readonly' : '' )}}>{{(isset($applicationData->encrochment_verification_comment) ? $applicationData->encrochment_verification_comment : '')}}</textarea>
							<span class="error" id="encrochment_comments_error" style="display:none;color:#f4516c">This feild is required</span>
						</div>
						<div class="mt-3">
                        @if($is_view && ($ol_application->log->status_id == config('commanConfig.applicationStatus.in_process')))
							<button type="button" class="s_btn btn btn-primary" id="submitBtn" name="">Save</button>
                        @endif    

						</div>				
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="applicationId" value="{{(isset($applicationData->id) ? $applicationData->id : '')}}">
    </form>

    <input type="hidden" name="OfficiersCount" id="OfficiersCount" value="{{(isset($applicationData->SiteVisitorOfficers) ? count($applicationData->SiteVisitorOfficers)+2 : '')}}">
    <input type="hidden" name="documentCount" id="documentCount" value="{{(isset($applicationData->visitDocuments) ? count($applicationData->visitDocuments)+2 : '')}}">
</div>
@endsection
@section('js')
<script>

var isError = 0;
    $("#dyce_scrunity_Form").validate({
        rules: {
            demarkation_comments: "required",
            officer_name: "required",
            visit_date: "required",
        	encrochment : "required",
            "officer_name[]": "required",
        }
    });

    function removeOfficerName(data) {
        var id = data.substr(5, 2);
        $(".officer_name_" + id).css("display", "none");
        $(".officer_name_" + id + " input").attr("disabled", "disabled");
    }

    function addMoreText(text) {

        var id = $("#OfficiersCount").val();
        $(text).css("display", "none");
        $('.icon').css("visibility", "visible");
        $(".site_v").append("<div class='officer_name_" + id +
            "'><div class='d-flex align-items-center mb-5'><label class='site-visit-label'>Name of Officer:</label><div class='position-relative'><input type='text' class='txtbox form-control form-control--custom m_input' name='officer_name[]' id='officer_name'><a class='add_more' onclick='addMoreText(this);'>add more </a><i class='fa fa-close icon close-icon' id='icon_" +
            id + "' onclick='removeOfficerName(this.id)'></i></div></div></div>");
        id++;
        $("#OfficiersCount").val(id);
    }

    function selectFile() {
        $('.custom-file-input').change(function (e) {
            $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
        });
    }

    function addMoreDocuments(text) {

        var id = $.trim(text.id.substr(9,2));
        myfile= $("#test-upload_"+id).val();
        var ext = myfile.split('.').pop();

        if (ext != "pdf"){
            $("#file_error_"+id).text("Invalid type of file uploaded (only pdf allowed)");
            $("#test-upload_"+id).closest(".custom-file").addClass("has-error");
            isError = 1;
        }
        else{
            $("#file_error_"+id).text("");
            $("#test-upload_"+id).closest(".custom-file").removeClass("has-error");
            isError = 0;
        }    
        
        if(isError == 0){
            var id = $("#documentCount").val();
            $(text).css("display", "none");
            $('.doc').css("visibility", "visible");
            $(".all_documents").append("<div class='d-flex flex-wrap align-items-center mb-5 upload_doc_"+id+"'><label class='site-visit-label'>Upload supporting files:</label><div class='custom-file custom-file--fixed mb-0 position-relative'><input type='file' class='file custom-file-input file_ext upload_file_"+id+"' name='document[]' id='test-upload_" +
                id + "'><label class='custom-file-label' for='test-upload_"+id+"' id='file_label_"+id+"'> Choose file .. </label><span class='text-danger' id='file_error_"+id+"'></span><i class='fa fa-close doc close-icon' id='document_" + id +
                "' onclick='removeDocuments(this.id)'></i><a class='add_more' id='add_more_"+id+"' onclick='addMoreDocuments(this);'>add more </a></div></div>"
            );
            id++;
            selectFile();
            $("#documentCount").val(id);            
         }
    }

    function removeDocuments(data) {
        var id = data.substr(9, 2);
        $(".upload_doc_" + id).css("visibility", "hidden");
        $(".upload_doc_" + id).css("position", "absolute");
        $(".upload_doc_" + id).attr("disabled", "disabled");
        $(".upload_file_" + id).attr("disabled", "disabled");
    }

    $("#submitBtn").click(function () {   

        var enrochComment = $("#encrochment_comments").val();
        var isEnrochment = $("input[name=encrochment]:checked").val();

        if (isEnrochment == '1' && enrochComment == "") {
            $("#encrochment_comments_error").css("display", "block");
        } else {
            $("#encrochment_comments_error").css("display", "none");
            $("#dyce_scrunity_Form").submit();
        }

    });

    $(document).ready(function(){
        $(".display_msg").delay(5000).slideUp(300);
    }); 

</script>
@endsection
