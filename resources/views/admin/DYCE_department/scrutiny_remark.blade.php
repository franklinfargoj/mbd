@extends('admin.layouts.app')
@section('css')
<!-- <style> -->
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css"/>

<!-- </style> -->
@endsection
@section('content')

<!-- BEGIN: Subheader -->
<div class="m-subheader ">
  <div class="d-flex align-items-center">
     <div class="mr-auto">
        <h3 class="m-subheader__title m-subheader__title--separator title">
        DyCE Scrutiny & Remark </h3>
     </div>
  </div>
</div>
<div class="m-content"></div>

<!-- society and Appointed Architect details -->
 <div class="m-portlet m-portlet--mobile m_panel">
    <div class="m-portlet__body main_panel">
	    <p class="heading"> Society Details: </p>
	    <div class="col-xs-12 row"> 
	    	<div class="col-md-6 div_left">
	    		<p> Application Number: 
	    		<span class="t_value">{{(isset($applicationData->application_no) ? $applicationData->application_no : '')}}</span></p>
	    		
	    		<p> Society Name: 
	    		<span class="t_value">{{(isset($applicationData->eeApplicationSociety->name) ? $applicationData->eeApplicationSociety->name : '')}}</span></p>
	    		
	    		<p> Building Number: 
	    		<span>{{(isset($applicationData->eeApplicationSociety->building_no) ? $applicationData->eeApplicationSociety->building_no : '')}}</span></p>
	    	</div>      	
	    	<div class="col-md-6 div_right">
	    		<p> Application Date :
	    		<span>{{(isset($applicationData->created_at) ? $applicationData->created_at : '')}}</span></p>
	    		
	    		<p> Society Address: 
	    		<span>{{(isset($applicationData->eeApplicationSociety->address) ? $applicationData->eeApplicationSociety->address : '')}}</span></p>
	    	</div> 
	    </div>	
    	<p class="heading"> Appointed Architect Details: </p>
    	<div class="col-md-12 row">
    		<div class="col-md-6 div_left">
    			<p> Name of Architect: 
    			<span>{{(isset($applicationData->eeApplicationSociety->name_of_architect) ? $applicationData->eeApplicationSociety->name_of_architect : '')}}</span></p>	
    			
    			<p> Architect Address: 
    			<span>{{(isset($applicationData->eeApplicationSociety->architect_address) ? $applicationData->eeApplicationSociety->architect_address : '')}}</span></p>	
    		</div>
	    	<div class="col-md-6 div_right">
	    		<p> Architect mobile number:
	    		<span>{{(isset($applicationData->eeApplicationSociety->architect_mobile_no) ? $applicationData->eeApplicationSociety->architect_mobile_no : '')}}</span> </p>
	    		
	    		<p> Architect telephone number: 
	    		<span>{{(isset($applicationData->eeApplicationSociety->architect_telephone_no) ? $applicationData->eeApplicationSociety->architect_telephone_no : '')}}</span>
	    		</p>
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
	    		@if(isset($applicationDocuments))
		    		@foreach($applicationDocuments as $documents)	    		
		    			<div class="col-xs-12 upload_doc_{{$i}}">
			    		    <label> Upload supporting files: </label>
	                        <div class="col-md-12 custom-file">
	                            <input type="file" class="file custom-file-input" name="document[]" id="test-upload">
	                            <label class="custom-file-label" for="test-upload">{{explode('/',$documents->document_path)[3]}}</label>
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
                            <label class="custom-file-label" for="test-upload">Choose file...</label>
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
	  				<input type="radio" class="radioBtn" name="encrochment" value="0" {{(isset($applicationData->demarkation_verification_comment) && $applicationData->is_encrochment == '0' ? 'checked' : '')}}> No 
	    			<p class="e_comments">If Yes, Comments</p>
	    			<textarea rows="4" cols="63" name="encrochment_comments">{{(isset($applicationData->encrochment_verification_comment) ? $applicationData->encrochment_verification_comment : '')}}</textarea>
	    			<input type="submit" class="s_btn" name="" value="save">
	    		</div>
	    	</div>
	    </div>
	</div>
	<input type="hidden" name="applicationId" value="{{$applicationData->id}}">
</form>  

<input type="hidden" name="OfficiersCount" id="OfficiersCount" value="{{(isset($applicationData->SiteVisitorOfficers) ? count($applicationData->SiteVisitorOfficers)+2 : '')}}"> 
<input type="hidden" name="documentCount" id="documentCount" value="{{(isset($applicationDocuments) ? count($applicationDocuments)+2 : '')}}"> 

@endsection
@section('js')
<script>
  $("#dyce_scrunity_Form").validate({
    rules:{
      demarkation_comments	: "required",
      officer_name 			: "required",
      visit_date		    : "required",
      document 				: "required",
      encrochment 			: "required",
      encrochment_comments  : "required",
    }
  });

	function removeOfficerName(data){
		var id = data.substr(5,2);
		$(".officer_name_"+id).css("display","none");
		$(".officer_name_"+id+" input").attr("disabled","disabled");			
	}
	// $(".add_more").click(function(e){
	// 	e.preventDefault();
	// 	$(this).css("display","none");
	// 	// var html = "<label> Name of Officer: </label>"+
	// 	// html = "<input type='text' class='txtbox o_text' name='officer_name' id='officer_name'>"+
	// 	// html = "<a href class='add_more'>add more </a>";

	// 	// $(".site_v").append(html);
	// 	$(".site_v").append("<label> Name of Officer: </label><input type='text' class='txtbox o_text' name='officer_name' id='officer_name'><a href class='add_more' onclick='addMoreText(this);'>add more </a>");
	// });

	function addMoreText(text){

		var  id = $("#OfficiersCount").val();
		$(text).css("display","none");
		$('.icon').css("visibility","visible");
		$(".site_v").append("<div class='officer_name_"+id+"'><label> Name of Officer: </label><input type='text' class='txtbox o_text' name='officer_name[]' id='officer_name'><a class='add_more' onclick='addMoreText(this);'>add more </a><i class='fa fa-close icon' id='icon_"+id+"' onclick='removeOfficerName(this.id)'></i></div>");
		id++;
		$("#OfficiersCount").val(id);
	}

	function addMoreDocuments(text){

		var  id = $("#documentCount").val();
		$(text).css("display","none");
		$('.doc').css("visibility","visible");
		$(".all_documents").append("<div class='col-xs-12 upload_doc_'"+id+"'><label> Upload supporting files: </label><div class='custom-file'><input type='file' class='file custom-file-input' name='document[]' id='test-upload_"+id+"'><label class='custom-file-label' for='test-upload_"+id+"'> Choose file .. </label></div><i class='fa fa-close doc' id='document_"+id+"' onclick='removeDocuments(this.id)'></i><a class='add_more' onclick='addMoreDocuments(this);'>add more </a></div>");	
		id++;
		$("#documentCount").val(id);	
	}

	function removeDocuments(data){
		var id = data.substr(9,2);
		$(".upload_doc_"+id).css("display","none");
		$(".upload_doc_"+id).attr("disabled","disabled");
	}
</script>
@endsection




