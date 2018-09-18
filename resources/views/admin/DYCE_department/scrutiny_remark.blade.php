@extends('admin.layouts.app')
@section('css')
<!-- <style> -->
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css"/>

@endsection
@section('content')

<div class="col-md-12">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader px-0 m-subheader--top">
		<div class="d-flex align-items-center">
			<h3 class="m-subheader__title">DyCE Scrutiny & Remark</h3>
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
								<span class="field-value">{{(isset($applicationData->application_no) ? $applicationData->application_no : '')}} 
								</span>
							</div>
						</div>
						<div class="col-sm-6 field-col">
							<div class="d-flex">
								<span class="field-name">Application Date:</span>
								<span class="field-value">{{(isset($applicationData->created_at) ? $applicationData->created_at : '')}}</span>
							</div>
						</div>
						<div class="col-sm-6 field-col">
							<div class="d-flex">
								<span class="field-name">Society Name:</span>
								<span class="field-value">{{(isset($applicationData->eeApplicationSociety->name) ? $applicationData->eeApplicationSociety->name : '')}}</span>
							</div>
						</div>
						<div class="col-sm-6 field-col">
							<div class="d-flex">
								<span class="field-name">Society Address:</span>
								<span class="field-value">{{(isset($applicationData->eeApplicationSociety->address) ? $applicationData->eeApplicationSociety->address : '')}}</span>
							</div>
						</div>
						<div class="col-sm-6 field-col">
							<div class="d-flex">
								<span class="field-name">Building Number:</span>
								<span class="field-value">{{(isset($applicationData->eeApplicationSociety->building_no) ? $applicationData->eeApplicationSociety->building_no : '')}}</span>
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
								<span class="field-value">{{(isset($applicationData->eeApplicationSociety->name_of_architect) ? $applicationData->eeApplicationSociety->name_of_architect : '')}}</span>
							</div>
						</div>
						<div class="col-sm-6 field-col">
							<div class="d-flex">
								<span class="field-name">Architect Mobile Number:</span>
								<span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_mobile_no) ? $applicationData->eeApplicationSociety->architect_mobile_no : '')}}</span>
							</div>
						</div>
						<div class="col-sm-6 field-col">
							<div class="d-flex">
								<span class="field-name">Architect Address:</span>
								<span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_address) ? $applicationData->eeApplicationSociety->architect_address : '')}}</span>
							</div>
						</div>
						<div class="col-sm-6 field-col">
							<div class="d-flex">
								<span class="field-name">Architect Telephone Number:</span>
								<span class="field-value">{{(isset($applicationData->eeApplicationSociety->architect_telephone_no) ? $applicationData->eeApplicationSociety->architect_telephone_no : '')}}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</div>    
	<!-- end -->

	<!-- Site Visit -->
	<form role="form" id="dyce_scrunity_Form" name="scrunityForm" class="form-horizontal" method="post" action="{{ route('dyce.store')}}" enctype="multipart/form-data">

	@csrf
		<div class="m-portlet m-portlet--mobile m_panel">
			<div class="m-portlet__body" style="padding-right: 0;"> 
				<p class="heading"> Site Visit </p>  
				<div class="col-xs-12 row">
					<div class="col-md-6 div_left site_v">
						<label> Society Name: </label>
						<input type="text" class="txtbox s_text" name="society_name" id="society_name" value="{{(isset($applicationData->eeApplicationSociety->name) ? $applicationData->eeApplicationSociety->name : '')}}" readonly> 

						<?php $i=2;?>
						@if(isset($applicationData->SiteVisitorOfficers))
							@foreach($applicationData->SiteVisitorOfficers as $officerName)
								@if(!empty($officerName))
									<div class="officer_name_{{$i}}">   			
										<label> Name of Officer: </label>
										<input type="text" class="txtbox o_text" name="officer_name[]" id="officer_name" value="{{$officerName}}">
										<i class="fa fa-close icon2" id="icon_{{$i}}" onclick="removeOfficerName(this.id)"></i>
									</div>
								@endif
								<?php $i++;?>
							@endforeach
						@endif

						<div class="officer_name_1">   			
							<label> Name of Officer: </label>
							<input type="text" class="txtbox o_text" name="officer_name[]" id="officer_name">
							<a class="add_more" onclick="addMoreText(this);">add more </a>
							<i class="fa fa-close icon" id="icon_1" onclick="removeOfficerName(this.id)"></i>
						</div>
					</div>

					<div class="col-md-6 div_right">
						<label> Building number: </label>
						<input type="text" class="txtbox b_text" name="building_no" id="building_no" value="{{(isset($applicationData->eeApplicationSociety->building_no) ? $applicationData->eeApplicationSociety->building_no : '')}}" readonly>     
						<label> Date of site visit: </label>			
						<input type="date" class="txtbox v_text" name="visit_date" id="visit_date" value="{{(isset($applicationData->date_of_site_visit) ? $applicationData->date_of_site_visit : '')}}">  
					</div>
					<div class="col-xs-12 all_documents">
					<?php $i=2;?>
					@if(isset($applicationData->visitDocuments))
						@foreach($applicationData->visitDocuments as $documents)
							<div class="col-xs-12 upload_doc_{{$i}}">
								<label> Upload supporting files: </label>
								<div class="col-md-12 custom-file">
									<input type="file" class="file custom-file-input" name="document[]" id="test-upload_{{$i}}">
									<label class="custom-file-label" for="test-upload_{{$i}}">{{explode('/',$documents->document_path)[3]}}</label>
								</div>  
								<input type="hidden" class="upload_doc_{{$i}}" id="documentId" name="documentId[]" 
								value="{{$documents->id}}" readonly>
								<i class="fa fa-close doc2" id="document_{{$i}}" onclick="removeDocuments(this.id)"></i>
								<span> </span>
							</div>
							<?php $i++;?>
						@endforeach
					@endif
						<div class="col-xs-12 upload_doc_1">
							<label> Upload supporting files: </label>
							<div class="custom-file">
								<input type="file" class="file custom-file-input" name="document[]" type="file" id="test-upload">
								<!-- <input type="file" class="file" name="documents[]"> -->
								<label class="custom-file-label" for="test-upload">Choose file ...</label>
							</div>  
							<a class="add_more" onclick="addMoreDocuments(this);">add more </a>
							<i class="fa fa-close doc" id="document_1" onclick="removeDocuments(this.id)"></i>
						</div>	
					</div>
				</div>
			</div>    
		</div>   
		<!-- end  -->

		<!-- Demarkation verification -->
		<div class="m-portlet m-portlet--mobile m_panel">
			<div class="m-portlet__body"> 
				<p class="heading"> Demarkation verification </p>
				<div class="col-xs-12 row">
					<div class="col-md-12">
						<p>Comments</p>
						<textarea rows="4" cols="63" name="demarkation_comments">{{(isset($applicationData->demarkation_verification_comment) ? $applicationData->demarkation_verification_comment : '')}}</textarea>
						<!-- <input type="button" class="s_btn" name="" value="save"> -->
					</div>
				</div>
			</div>
		</div>   
		<!-- end  -->

		<!-- Encrochment verification -->
		<div class="m-portlet m-portlet--mobile m_panel">
			<div class="m-portlet__body"> 
				<p class="heading"> Encrochment Verification </p>
				<div class="col-xs-12 row">
					<div class="col-md-12">
						<span>Is there any encrochment ?</span>
						<input type="radio" class="radioBtn" name="encrochment" value="1" {{(isset($applicationData->demarkation_verification_comment) && $applicationData->is_encrochment == '1' ? 'checked' : '')}}> Yes
						<input type="radio" class="radioBtn" name="encrochment" value="0" {{(isset($applicationData->demarkation_verification_comment) && $applicationData->is_encrochment == '0' ? 'checked' : '')}}>No
						<span class="error" id="encrochment_error" style="display:none;color:#f4516c">this feild required</span>
						<p class="e_comments">If Yes, Comments</p>
						<textarea rows="4" cols="63" id="encrochment_comments" name="encrochment_comments">{{(isset($applicationData->encrochment_verification_comment) ? $applicationData->encrochment_verification_comment : '')}}</textarea>
						<span class="error" id="encrochment_comments_error" style="display:none;color:#f4516c">this feild required</span>
						<input type="button" class="s_btn" id="submitBtn" name="" value="save">
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
  	$("#dyce_scrunity_Form").validate({
	    rules:{
	      demarkation_comments	: "required",
	      officer_name 			: "required",
	      visit_date		    : "required",
	      // "document[]" 			: "required",
	      "officer_name[]"      : "required",
	    }
  	});

	function removeOfficerName(data){
		var id = data.substr(5,2);
		$(".officer_name_"+id).css("display","none");
		$(".officer_name_"+id+" input").attr("disabled","disabled");			
	}

	function addMoreText(text){

		var  id = $("#OfficiersCount").val();
		$(text).css("display","none");
		$('.icon').css("visibility","visible");
		$(".site_v").append("<div class='officer_name_"+id+"'><label> Name of Officer: </label><input type='text' class='txtbox o_text' name='officer_name[]' id='officer_name'><a class='add_more' onclick='addMoreText(this);'>add more </a><i class='fa fa-close icon' id='icon_"+id+"' onclick='removeOfficerName(this.id)'></i></div>");
		id++;
		$("#OfficiersCount").val(id);
	}

	function selectFile() {
		$('.custom-file-input').change(function (e) {
	      $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
	    });
	}

	function addMoreDocuments(text){
		var  id = $("#documentCount").val();
		$(text).css("display","none");
		$('.doc').css("visibility","visible");
		$(".all_documents").append("<div class='col-xs-12 upload_doc_"+id+"'><label> Upload supporting files: </label><div class='custom-file'><input type='file' class='file custom-file-input' name='document[]' id='test_upload_"+id+"'><label class='custom-file-label' for='test_upload_"+id+"'> Choose file .. </label></div><i class='fa fa-close doc' id='document_"+id+"' onclick='removeDocuments(this.id)'></i><a class='add_more' onclick='addMoreDocuments(this);'>add more </a></div>");	
		id++;
		selectFile();
		$("#documentCount").val(id);	
	}

	function removeDocuments(data){
		var id = data.substr(9,2);
		$(".upload_doc_"+id).css("display","none");
		$(".upload_doc_"+id).attr("disabled","disabled");
	}

	$("#submitBtn").click(function(){

		var enrochComment = $("#encrochment_comments").val();
		var isEnrochment  = $("input[name=encrochment]:checked").val();
		
		if (isEnrochment == undefined)
			$("#encrochment_error").css("display","block");
		else
			$("#encrochment_error").css("display","none");

		if (isEnrochment == '1' && enrochComment == ""){
			$("#encrochment_comments_error").css("display","block");
		}else{
			$("#encrochment_comments_error").css("display","none");
			$( "#dyce_scrunity_Form" ).submit();
		}
	});
</script>
@endsection




