@extends('admin.layouts.app')
@section('css')
<!-- <style> -->
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css"/>

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
<form role="form" id="dyce_scrunity_Form" name="scrunityForm" class="form-horizontal" method="post" action="" enctype="multipart/form-data">

 @csrf
	 <div class="m-portlet m-portlet--mobile m_panel">
	    <div class="m-portlet__body" style="padding-right: 0;"> 
	    	<p class="heading"> Site Visit </p>  
                <div class="row field-row">
                    <div class="col-sm-6 field-col">
                        <div class="d-flex">
                            <span class="field-name">Society Name:</span>
                            <span class="field-value">{{(isset($applicationData->eeApplicationSociety->name) ? $applicationData->eeApplicationSociety->name : '')}} 
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6 field-col">
                        <div class="d-flex">
                            <span class="field-name">Building number:</span>
                            <span class="field-value">{{(isset($applicationData->eeApplicationSociety->building_no) ? $applicationData->eeApplicationSociety->building_no : '')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-6 field-col">
                        <div class="d-flex">
                            <span class="field-name">Name of Inspector:</span>
                            <span class="field-value" style="width: 242px;word-break: break-all;"></span>
                        </div>
                    </div>
                    <div class="col-sm-6 field-col">
                        <div class="d-flex">
                            <span class="field-name">Date of site visit:</span>
                            <span class="field-value">{{(isset($applicationData->date_of_site_visit) ? $applicationData->date_of_site_visit : '')}}</span>
                        </div>
                    </div>
                    @foreach($applicationData->visitDocuments as $data)
                        <div class="col-sm-12 field-col">
                            <div class="d-flex">
                                <span style="width: 200px;">Supporting Documents:</span>
                                <a href="{{asset($data->document_path)}}">
                                <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}" style="height:44px"></a>
                                <span class="field-value" style="padding-left: 15px;">{{(explode('/',$data->document_path)[3])}}</span>
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
	    	<p class="heading"> Demarkation verification </p>
	    	<div class="col-xs-12 row">
	    		<div class="col-md-12">
	    			<p>Comments</p>
	    			<textarea rows="4" cols="63" name="demarkation_comments" readonly>{{(isset($applicationData->demarkation_verification_comment) ? $applicationData->demarkation_verification_comment : '')}}</textarea>
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
	    			<input type="radio" class="radioBtn" name="encrochment" value="1" disabled {{(isset($applicationData->demarkation_verification_comment) && $applicationData->is_encrochment == '1' ? 'checked' : '')}}> Yes
	  				<input type="radio" class="radioBtn" name="encrochment" value="0" disabled {{(isset($applicationData->demarkation_verification_comment) && $applicationData->is_encrochment == '0' ? 'checked' : '')}}>No
	    			<p class="e_comments">If Yes, Comments</p>
	    			<textarea rows="4" cols="63" id="encrochment_comments" name="encrochment_comments" readonly>{{(isset($applicationData->encrochment_verification_comment) ? $applicationData->encrochment_verification_comment : '')}}</textarea>
	    		</div>
	    	</div>
	    </div>
	</div>
</form>  
@endsection





