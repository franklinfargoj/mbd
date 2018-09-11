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
	    		<p> Application Number: </p>
	    		<p> Society Name: </p>
	    		<p> Building Number: </p>
	    	</div>      	
	    	<div class="col-md-6 div_right">
	    		<p> Application Date </p>
	    		<p> Society Address: </p>
	    	</div> 
	    </div>	
    	<p class="heading"> Appointed Architect Details: </p>
    	<div class="col-md-12 row">
    		<div class="col-md-6 div_left">
    			<p> Name of Architect: </p>	
    			<p> Architect Address: </p>	
    		</div>
	    	<div class="col-md-6 div_right">
	    		<p> Architect mobile number: </p>
	    		<p> Architect telephone number: </p>
	    	</div>     		
    	</div> 
    </div>    
</div>  
<!-- end -->

<!-- Site Visit -->
 <div class="m-portlet m-portlet--mobile m_panel">
    <div class="m-portlet__body" style="padding-right: 0;"> 
    	<p class="heading"> Site Visit </p>  
    	<div class="col-xs-12 row">
    		<div class="col-md-6 div_left site_v">
    			<label> Society Name: </label>
    			<input type="text" class="txtbox s_text" name="society_name" id="society_name">    			
    			<label> Name of Officer: </label>
    			<input type="text" class="txtbox o_text" name="officer_name[]" id="officer_name">
    			<a href="#" class="add_more" onclick="addMoreText(this);">add more </a>
<!--     			<label> Upload supporting files: </label>
    			<input type="file" class="file" name=""> -->
    		</div>
    		<div class="col-md-6 div_right">
    			<label> Building number: </label>
    			<input type="text" class="txtbox b_text" name="building_no" id="building_no">     
    			<label> Date of site visit: </label>			
    			<input type="date" class="txtbox v_text" name="visit_date" id="visit_date">  
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
    			<textarea rows="4" cols="63"></textarea>
    			<input type="button" class="s_btn" name="" value="save">
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
    			<input type="radio" class="radioBtn" name="encrochment" value="yes"> Yes
  				<input type="radio" class="radioBtn" name="encrochment" value="no"> No 
    			<p class="e_comments">If Yes, Comments</p>
    			<textarea rows="4" cols="63"></textarea>
    			<input type="button" class="s_btn" name="" value="save">
    		</div>
    	</div>
    </div>
</div>   
<!-- end  -->
@endsection
@section('js')
<script>
	// $(".add_more").click(function(e){
	// 	e.preventDefault();
	// 	$(this).css("display","none");
	// 	// var html = "<label> Name of Officer: </label>"+
	// 	// html = "<input type='text' class='txtbox o_text' name='officer_name' id='officer_name'>"+
	// 	// html = "<a href class='add_more'>add more </a>";

	// 	// $(".site_v").append(html);
	// 	$(".site_v").append("<label> Name of Officer: </label><input type='text' class='txtbox o_text' name='officer_name' id='officer_name'><a href class='add_more' onclick='addMoreText(this);'>add more </a>");
	// });

	function addMoreText(id){
		return false;
		console.log(id);
		// $(this).css("display","none");
		$(".site_v").append("<label> Name of Officer: </label><input type='text' class='txtbox o_text' name='officer_name' id='officer_name'><a href class='add_more' onclick='addMoreText(this);'>add more </a>");
	}
</script>
@endsection
