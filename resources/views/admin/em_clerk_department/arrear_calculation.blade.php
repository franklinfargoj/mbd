@extends('admin.layouts.app')
@section('actions')
    @include('admin.em_clerk_department.action')
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
            <h3 class="m-subheader__title">Calculation - {{$society[0]->name}} / {{$tenant[0]->first_name}} / {{$tenant[0]->flat_no}}</h3>
           
         </div>

        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                <form method="get" enctype='multipart/form-data' action="{{route('tenant_payment_list')}}">
                    {{ csrf_field() }}
                    <div class="row align-items-center" style="margin-bottom: 1rem;">                          
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="year" name="year" required>
                                        <option value="" style="font-weight: normal;">Select Year</option>
                                        <option value="<?php echo  date('Y');?>" style="font-weight: normal;"><?php echo  date('Y'); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-1 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-1 year")); ?></option>
                                    </select>
                                </div>
                            </div>       
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="month" name="month" required>
                                        <option value="" style="font-weight: normal;">Select Month</option>
                                        <option value="1" style="font-weight: normal;">Jan</option>
                                        <option value="2" style="font-weight: normal;">Feb</option>
                                        <option value="3" style="font-weight: normal;">Mar</option>
                                        <option value="4" style="font-weight: normal;">Apr</option>
                                        <option value="5" style="font-weight: normal;">May</option>
                                        <option value="6" style="font-weight: normal;">June</option>
                                        <option value="7" style="font-weight: normal;">July</option>
                                        <option value="8" style="font-weight: normal;">Aug</option>
                                        <option value="9" style="font-weight: normal;">Sep</option>
                                        <option value="10" style="font-weight: normal;">Oct</option>
                                        <option value="11" style="font-weight: normal;">Nov</option>
                                        <option value="12" style="font-weight: normal;">Dec</option>
                                    </select>
                                </div>
                            </div>                     
                    </div>
                    
                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                           <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout" name="layout" required>
                                        <option value="" style="font-weight: normal;">Select old rate</option>
                                        <option value="EWS" style="font-weight: normal;" >EWS</option>
                                        <option value="LIG" style="font-weight: normal;" >LIG</option>
                                        <option value="MIG" style="font-weight: normal;" >MIG</option>
                                        <option value="HIG" style="font-weight: normal;" >HIG</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout" name="layout" required>
                                        <option value="" style="font-weight: normal;">Select revised rate</option>
                                        <option value="EWS" style="font-weight: normal;">EWS</option>
                                        <option value="LIG" style="font-weight: normal;">LIG</option>
                                        <option value="MIG" style="font-weight: normal;">MIG</option>
                                        <option value="HIG" style="font-weight: normal;">HIG</option>
                                    </select>
                                </div>
                            </div>                        
                    </div>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                        Old  Intrest Rate - {{$rate_card[0]->interest_on_old_rate}} % :
                    </div>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">                            
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout" name="layout" required>
                                        <option value="" style="font-weight: normal;">Select Year</option>
                                        <option value="<?php echo  date('Y');?>" style="font-weight: normal;"><?php echo  date('Y'); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-1 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-1 year")); ?></option>
                                    </select>
                                </div>
                            </div>       
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout" name="layout" required>
                                        <option value="" style="font-weight: normal;">Select Month</option>
                                        <option value="1" style="font-weight: normal;">Jan</option>
                                        <option value="2" style="font-weight: normal;">Feb</option>
                                        <option value="3" style="font-weight: normal;">Mar</option>
                                        <option value="4" style="font-weight: normal;">Apr</option>
                                        <option value="5" style="font-weight: normal;">May</option>
                                        <option value="6" style="font-weight: normal;">June</option>
                                        <option value="7" style="font-weight: normal;">July</option>
                                        <option value="8" style="font-weight: normal;">Aug</option>
                                        <option value="9" style="font-weight: normal;">Sep</option>
                                        <option value="10" style="font-weight: normal;">Oct</option>
                                        <option value="11" style="font-weight: normal;">Nov</option>
                                        <option value="12" style="font-weight: normal;">Dec</option>               
                                    </select>
                                </div>
                            </div>    
                              <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <label>Old Interest Amount : - XXXX/-</label>
                                </div>
                            </div>                  
                    </div>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                         <div class="col-md-4">Diffrence: {{$rate_card[0]->revise_rate - $rate_card[0]-> old_rate}}/-</div>
                         <div class="col-md-4">Formula = Revise Rate - Old Rate</div>
                    </div>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                       Interest on Diffrence Amount - {{$rate_card[0]->interest_on_differance}}  % :
                    </div>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">                          
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout" name="layout" required>
                                        <option value="" style="font-weight: normal;">Select Year</option>
                                        <option value="<?php echo  date('Y');?>" style="font-weight: normal;"><?php echo  date('Y'); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-1 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-1 year")); ?></option>
                                    </select>
                                </div>
                            </div>       
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout" name="layout" required>
                                        <option value="" style="font-weight: normal;">Select Month</option>
                                        <option value="1" style="font-weight: normal;">Jan</option>
                                        <option value="2" style="font-weight: normal;">Feb</option>
                                        <option value="3" style="font-weight: normal;">Mar</option>
                                        <option value="4" style="font-weight: normal;">Apr</option>
                                        <option value="5" style="font-weight: normal;">May</option>
                                        <option value="6" style="font-weight: normal;">June</option>
                                        <option value="7" style="font-weight: normal;">July</option>
                                        <option value="8" style="font-weight: normal;">Aug</option>
                                        <option value="9" style="font-weight: normal;">Sep</option>
                                        <option value="10" style="font-weight: normal;">Oct</option>
                                        <option value="11" style="font-weight: normal;">Nov</option>
                                        <option value="12" style="font-weight: normal;">Dec</option>           
                                    </select>
                                </div>
                            </div>    
                              <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <label>Diffrence Interest Amount : - XXXX/-</label>
                                </div>
                            </div>                  
                    </div>


                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                            <div class="col-md-9">
                                <div class="form-group m-form__group building_list">
                                    <label class="radio-inline" style="margin-right: 1rem;">Paid</label>
                                    <label class="radio-inline" style="margin-right: 1rem;"> <input type="radio" name="payment_status" value="1"> Yes </label>
                                    <label class="radio-inline" style="margin-right: 1rem;"> <input type="radio" name="payment_status" value="0"> No </label>
                                </div>  
                            </div>                          
                    </div>
            
                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                         <div class="col-md-4">Amount to be paid = {{$rate_card[0]->old_rate}}/-</div>
                         <div class="col-md-8">Formula = old Amount + old Intrest amount + Diffrence Amount + Diffrence Intrest amount</div>
                    </div>

                <div class="row align-items-center mb-0">           
                    <div class="col-md-9">
                        <div class="form-group m-form__group">
                            <input type="submit" class="btn btn-success" name="save" value="Save">
                            <a  class="btn btn-info" href="{{ route('em_clerk.index') }}">Cancel</a>
                        </div>
                    </div>
                </div>

            </form>
                   
                </div>
            </div>
        </div>

        <div class="m-portlet m-portlet--compact filter-wrap">
         <div class="row align-items-center row--filter">
                <div class="col-md-12">
                   <h4>Monthly details of - {{$tenant[0]->first_name}} - {{$tenant[0]->flat_no}}</h4>
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
</script>
@endsection
