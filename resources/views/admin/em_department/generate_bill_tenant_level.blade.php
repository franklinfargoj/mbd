@extends('admin.layouts.app')
@section('actions')
    @include('admin.em_department.action',compact('ol_application'))
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center" id="search_box">
            <h3 class="m-subheader__title m-subheader__title--separator">Application for Offer Letter</h3>
            {{ Breadcrumbs::render('em') }}
         </div>
   
        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <h4 class="m-subheader__title"> Bill Generation </h4>
                </div>

                <div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout" name="layout" required>
                                        <option value="" style="font-weight: normal;">Select Layout</option>
                                         @foreach($layout_data as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->layout_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group m-form__group ward-div">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="wards" name="wards" required>
                                        <option value="" style="font-weight: normal;">Select Ward</option>
                                        @foreach($wards_data as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group m-form__group colony_select">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="colony" name="colony" required>
                                        <option value="" style="font-weight: normal;">Select Colony</option>
                                        @foreach($colonies_data as $key => $value)
                                        <option value="{{ $value->id }}" >{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group m-form__group society_select">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="society" name="society" required>
                                        <option value="" style="font-weight: normal;">Select Societies</option>
                                        @foreach($societies_data as $key => $value)
                                        <option value="{{ $value->id }}" >{{ $value->society_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-12">
                                <div class="form-group m-form__group ">
                                    Billing Level : Tenant level Billing.
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group m-form__group building_select">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="building" name="building" required>
                                        <option value="" style="font-weight: normal;">Select Buildings</option>
                                        @foreach($building_data as $key => $value)
                                        <option value="{{ $value->id }}" >{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                          
                    </div>
                </div>

                
                <div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-12">
                                <div class="form-group m-form__group tenant-list">
                                   
                                </div>
                            </div>                          
                    </div>
                </div>


    
            </div>
        </div>
    </div>
    <!-- END: Subheader -->

    <input type="hidden" id="myModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" />

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
             
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection
@section('datatablejs')


<script>
    /*$("#update_status").on("change", function () {
        $("#eeForm").submit();
    });*/

    $(document).ready(function () {
        $(".display_msg").delay(5000).slideUp(300);
    });

    $(document).on('change', '#layout', function(){
                var id = $(this).val();
                //console.log(id);
                //return false;
                $.ajax({
                    url:"{{URL::route('get_wards')}}",
                    type: 'get',
                    data: {id: id},
                        success: function(response){
                        //console.log(response);
                        $('.ward-div').html(response);
                        $('#wards').selectpicker('refresh');
                    }
                });             
    });

    $(document).on('change', '#wards', function(){
                var id = $(this).val();
                //console.log(id);
                //return false;
                $.ajax({
                    url:"{{URL::route('get_colonies')}}",
                    type: 'get',
                    data: {id: id},
                        success: function(response){
                        //console.log(response);
                        $('.colony_select').html(response);
                        $('#colony').selectpicker('refresh');
                    }
                });             
    });

    $(document).on('change', '#colony', function(){
                var id = $(this).val();
                //console.log(id);
                //return false;
                $.ajax({
                    url:"{{URL::route('get_society_select')}}",
                    type: 'get',
                    data: {id: id},
                        success: function(response){
                        //console.log(response);
                        $('.society_select').html(response);
                        $('#society').selectpicker('refresh');
                    }
                });             
    });

    $(document).on('change', '#society', function(){
                var id = $(this).val();
                //console.log(id);
                //return false;
                $.ajax({
                    url:"{{URL::route('get_building_select')}}",
                    type: 'get',
                    data: {id: id},
                        success: function(response){
                        //console.log(response);
                        $('.building_select').html(response);
                        $('#building').selectpicker('refresh');
                    }
                });             
    });

    $(document).on('change', '#building', function(){
                var id = $(this).val();
                console.log(id);
                //return false;
                $.ajax({
                    url:"{{URL::route('get_tenant_ajax')}}",
                    type: 'get',
                    data: {id: id},
                        success: function(response){
                        //console.log(response);
                        $('.tenant-list').html(response);
                        //$('#building').selectpicker('refresh');
                    }
                });             
    });



</script>
@endsection
