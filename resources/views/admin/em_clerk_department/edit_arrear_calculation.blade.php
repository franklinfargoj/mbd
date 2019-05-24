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

@if(session()->has('warning'))
    <div class="alert alert-danger display_msg">
        {{ session()->get('warning') }}
    </div>  
@endif

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center" id="search_box">
            <h3 class="m-subheader__title">Calculation - {{$society->name}} / {{$tenant->first_name}} / {{$tenant->flat_no}}</h3>
           
         </div>

        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                <form method="post" enctype='multipart/form-data' action="{{route('create_arrear_calculation')}}">
                    {{ csrf_field() }}
                    <input type="text" name="row_id" value="{{old('month', $arrear_row->id)}}" hidden>
                    <input type="text" name="tenant_id" value="{{$tenant->id}}" hidden>
                    <input type="text" name="building_id" value="{{$tenant->building_id}}" hidden>
                    <input type="text" name="society_id" value="{{$society->id}}" hidden>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">                          
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="bill_year" name="year" required>
                                        <option value="" style="font-weight: normal;">Select Year</option>
                                        <option value="<?php echo  date('Y');?>" {{ old("year", $arrear_row->year) == date('Y') ? 'selected' : '' }} style="font-weight: normal;"><?php echo  date('Y'); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-1 year")); ?>"  {{ old("year", $arrear_row->year) == date("Y",strtotime("-1 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-1 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-2 year")); ?>"  {{ old("year", $arrear_row->year) == date("Y",strtotime("-2 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-2 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-3 year")); ?>"  {{ old("year", $arrear_row->year) == date("Y",strtotime("-3 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-3 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-4 year")); ?>"  {{ old("year", $arrear_row->year) == date("Y",strtotime("-4 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-4 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-5 year")); ?>"  {{ old("year", $arrear_row->year) == date("Y",strtotime("-5 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-5 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-6 year")); ?>"  {{ old("year", $arrear_row->year) == date("Y",strtotime("-6 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-6 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-7 year")); ?>"  {{ old("year", $arrear_row->year) == date("Y",strtotime("-7 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-7 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-8 year")); ?>"  {{ old("year", $arrear_row->year) == date("Y",strtotime("-8 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-8 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-9 year")); ?>"  {{ old("year", $arrear_row->year) == date("Y",strtotime("-9 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-9 year")); ?></option>
                                    </select>
                                </div>
                            </div>       
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="bill_month" name="month" required>
                                        <option value="" style="font-weight: normal;">Select Month</option>
                                        <option value="1" {{ old("month", $arrear_row->month) == '1' ? 'selected' : '' }} style="font-weight: normal;">Jan</option>
                                        <option value="2" {{ old("month", $arrear_row->month) == '2' ? 'selected' : '' }} style="font-weight: normal;">Feb</option>
                                        <option value="3" {{ old("month", $arrear_row->month) == '3' ? 'selected' : '' }} style="font-weight: normal;">Mar</option>
                                        <option value="4" {{ old("month", $arrear_row->month) == '4' ? 'selected' : '' }} style="font-weight: normal;">Apr</option>
                                        <option value="5" {{ old("month", $arrear_row->month) == '5' ? 'selected' : '' }} style="font-weight: normal;">May</option>
                                        <option value="6" {{ old("month", $arrear_row->month) == '6' ? 'selected' : '' }} style="font-weight: normal;">June</option>
                                        <option value="7" {{ old("month", $arrear_row->month) == '7' ? 'selected' : '' }} style="font-weight: normal;">July</option>
                                        <option value="8" {{ old("month", $arrear_row->month) == '8' ? 'selected' : '' }} style="font-weight: normal;">Aug</option>
                                        <option value="9" {{ old("month", $arrear_row->month) == '9' ? 'selected' : '' }} style="font-weight: normal;">Sep</option>
                                        <option value="10" {{ old("month", $arrear_row->month) == '10' ? 'selected' : '' }} style="font-weight: normal;">Oct</option>
                                        <option value="11" {{ old("month", $arrear_row->month) == '11' ? 'selected' : '' }} style="font-weight: normal;">Nov</option>
                                        <option value="12" {{ old("month", $arrear_row->month) == '12' ? 'selected' : '' }} style="font-weight: normal;">Dec</option>
                                    </select>
                                </div>
                            </div>                     
                    </div>

                    <div class="row align-items-center">
                        <div id="bill_error" class="form-control-feedback"></div>
                    </div>
                    
                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                           <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout" name="layout" required>
                                        <option value="" style="font-weight: normal;">Select old rate</option>
                                        <option value="EWS" {{$tenant->tenanttype->name=='EWS'?'selected':''}} {{ old("layout", $arrear_row->layout) == '12' ? 'selected' : '' }} style="font-weight: normal;" >EWS</option>
                                        <option value="LIG" {{$tenant->tenanttype->name=='LIG'?'selected':''}} {{ old("layout", $arrear_row->layout) == '12' ? 'selected' : '' }} style="font-weight: normal;" >LIG</option>
                                        <option value="MIG" {{$tenant->tenanttype->name=='MIG'?'selected':''}} {{ old("layout", $arrear_row->layout) == '12' ? 'selected' : '' }} style="font-weight: normal;" >MIG</option>
                                        <option value="HIG" {{$tenant->tenanttype->name=='HIG'?'selected':''}} {{ old("layout", $arrear_row->layout) == '12' ? 'selected' : '' }} style="font-weight: normal;" >HIG</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout" name="layout" required>
                                        <option value="" style="font-weight: normal;">Select revised rate</option>
                                        <option value="EWS" {{$tenant->tenanttype->name=='EWS'?'selected':''}} {{ old("layout", $arrear_row->layout) == '12' ? 'selected' : '' }} style="font-weight: normal;">EWS</option>
                                        <option value="LIG" {{$tenant->tenanttype->name=='LIG'?'selected':''}} {{ old("layout", $arrear_row->layout) == '12' ? 'selected' : '' }} style="font-weight: normal;">LIG</option>
                                        <option value="MIG" {{$tenant->tenanttype->name=='MIG'?'selected':''}} {{ old("layout", $arrear_row->layout) == '12' ? 'selected' : '' }} style="font-weight: normal;">MIG</option>
                                        <option value="HIG" {{$tenant->tenanttype->name=='HIG'?'selected':''}}{{ old("layout", $arrear_row->layout) == '12' ? 'selected' : '' }} style="font-weight: normal;">HIG</option>
                                    </select>
                                </div>
                            </div>                        
                    </div>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                        Old  Intrest Rate : {{$rate_card->interest_on_old_rate}} %  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No of Months : <span class="no_of_months"></span> 
                    </div>
                
                    <div class="row align-items-center" style="margin-bottom: 1rem;">                            
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input ior" id="ior_year" name="oir_year" required>
                                        <option value="" style="font-weight: normal;">Select Year</option>
                                        <option value="<?php echo  date('Y');?>" {{ old("oir_year", $arrear_row->oir_year) == date('Y') ? 'selected' : '' }}  style="font-weight: normal;"><?php echo  date('Y'); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-1 year")); ?>" {{ old("oir_year", $arrear_row->oir_year) == date("Y",strtotime("-1 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-1 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-2 year")); ?>" {{ old("oir_year", $arrear_row->oir_year) == date("Y",strtotime("-2 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-2 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-3 year")); ?>" {{ old("oir_year", $arrear_row->oir_year) == date("Y",strtotime("-3 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-3 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-4 year")); ?>" {{ old("oir_year", $arrear_row->oir_year) == date("Y",strtotime("-4 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-4 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-5 year")); ?>" {{ old("oir_year", $arrear_row->oir_year) == date("Y",strtotime("-5 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-5 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-6 year")); ?>" {{ old("oir_year", $arrear_row->oir_year) == date("Y",strtotime("-6 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-6 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-7 year")); ?>" {{ old("oir_year", $arrear_row->oir_year) == date("Y",strtotime("-7 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-7 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-8 year")); ?>" {{ old("oir_year", $arrear_row->oir_year) == date("Y",strtotime("-8 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-8 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-9 year")); ?>" {{ old("oir_year", $arrear_row->oir_year) == date("Y",strtotime("-9 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-9 year")); ?></option>
                                    </select>
                                </div>
                            </div>       
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input ior" id="ior_month" name="oir_month" required>
                                        <option value="" style="font-weight: normal;">Select Month</option>
                                        <option value="1" {{ old("oir_month", $arrear_row->oir_month) == '1' ? 'selected' : '' }} style="font-weight: normal;">Jan</option>
                                        <option value="2" {{ old("oir_month", $arrear_row->oir_month) == '2' ? 'selected' : '' }} style="font-weight: normal;">Feb</option>
                                        <option value="3" {{ old("oir_month", $arrear_row->oir_month) == '3' ? 'selected' : '' }} style="font-weight: normal;">Mar</option>
                                        <option value="4" {{ old("oir_month", $arrear_row->oir_month) == '4' ? 'selected' : '' }} style="font-weight: normal;">Apr</option>
                                        <option value="5" {{ old("oir_month", $arrear_row->oir_month) == '5' ? 'selected' : '' }} style="font-weight: normal;">May</option>
                                        <option value="6" {{ old("oir_month", $arrear_row->oir_month) == '6' ? 'selected' : '' }} style="font-weight: normal;">June</option>
                                        <option value="7" {{ old("oir_month", $arrear_row->oir_month) == '7' ? 'selected' : '' }} style="font-weight: normal;">July</option>
                                        <option value="8" {{ old("oir_month", $arrear_row->oir_month) == '8' ? 'selected' : '' }} style="font-weight: normal;">Aug</option>
                                        <option value="9" {{ old("oir_month", $arrear_row->oir_month) == '9' ? 'selected' : '' }} style="font-weight: normal;">Sep</option>
                                        <option value="10" {{ old("oir_month", $arrear_row->oir_month) == '10' ? 'selected' : '' }} style="font-weight: normal;">Oct</option>
                                        <option value="11" {{ old("oir_month", $arrear_row->oir_month) == '11' ? 'selected' : '' }} style="font-weight: normal;">Nov</option>
                                        <option value="12" {{ old("oir_month", $arrear_row->oir_month) == '12' ? 'selected' : '' }} style="font-weight: normal;">Dec</option>               
                                    </select>
                                </div>
                            </div>    
                              <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <label>Old Interest Amount : <span id="oia">{{ old('old_intrest_amount', $arrear_row->old_intrest_amount) != null ? old('old_intrest_amount', $arrear_row->old_intrest_amount) : 0.00 }}</span> /-</label>         
                                    <input type="text" id="old_intrest_amount" name="old_intrest_amount" value="{{ old('old_intrest_amount', $arrear_row->old_intrest_amount)}}"  hidden required>
                                </div>
                            </div>                  
                    </div>

                    <div class="row align-items-center">
                        <div id="oir_error" class="form-control-feedback"></div>
                    </div>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                         <div class="col-md-4">Diffrence: {{$rate_card->revise_rate - $rate_card->old_rate}} /-</div>

                        <input type="text" id="difference_amount" name="difference_amount" value="<?php echo $rate_card->revise_rate - $rate_card->old_rate; ?>" hidden required>

                         <div class="col-md-4"><!-- Formula = Revise Rate - Old Rate --></div>
                    </div>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                       Interest on Diffrence Amount : {{$rate_card->interest_on_differance}}  %    
                    </div>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">                          
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input ida" id="ida_year" name="ida_year" required>
                                        <option value="" style="font-weight: normal;">Select Year</option>
                                        <option value="<?php echo  date('Y');?>" {{ old("ida_year", $arrear_row->ida_year) == date('Y') ? 'selected' : '' }} style="font-weight: normal;"><?php echo  date('Y'); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-1 year")); ?>" {{ old("ida_year", $arrear_row->ida_year) == date("Y",strtotime("-1 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-1 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-2 year")); ?>" {{ old("ida_year", $arrear_row->ida_year) == date("Y",strtotime("-2 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-2 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-3 year")); ?>" {{ old("ida_year", $arrear_row->ida_year) == date("Y",strtotime("-3 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-3 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-4 year")); ?>" {{ old("ida_year", $arrear_row->ida_year) == date("Y",strtotime("-4 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-4 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-5 year")); ?>" {{ old("ida_year", $arrear_row->ida_year) == date("Y",strtotime("-5 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-5 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-6 year")); ?>" {{ old("ida_year", $arrear_row->ida_year) == date("Y",strtotime("-6 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-6 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-7 year")); ?>" {{ old("ida_year", $arrear_row->ida_year) == date("Y",strtotime("-7 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-7 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-8 year")); ?>" {{ old("ida_year", $arrear_row->ida_year) == date("Y",strtotime("-8 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-8 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-9 year")); ?>" {{ old("ida_year", $arrear_row->ida_year) == date("Y",strtotime("-9 year")) ? 'selected' : '' }} style="font-weight: normal;"><?php echo date("Y",strtotime("-9 year")); ?></option>
                                    </select>
                                </div>
                            </div>       
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input ida" id="ida_month" name="ida_month" required>
                                        <option value="" style="font-weight: normal;">Select Month</option>
                                        <option value="1" {{ old("ida_month", $arrear_row->ida_month) == '1' ? 'selected' : '' }} style="font-weight: normal;">Jan</option>
                                        <option value="2" {{ old("ida_month", $arrear_row->ida_month) == '2' ? 'selected' : '' }} style="font-weight: normal;">Feb</option>
                                        <option value="3" {{ old("ida_month", $arrear_row->ida_month) == '3' ? 'selected' : '' }} style="font-weight: normal;">Mar</option>
                                        <option value="4" {{ old("ida_month", $arrear_row->ida_month) == '4' ? 'selected' : '' }} style="font-weight: normal;">Apr</option>
                                        <option value="5" {{ old("ida_month", $arrear_row->ida_month) == '5' ? 'selected' : '' }} style="font-weight: normal;">May</option>
                                        <option value="6" {{ old("ida_month", $arrear_row->ida_month) == '6' ? 'selected' : '' }} style="font-weight: normal;">June</option>
                                        <option value="7" {{ old("ida_month", $arrear_row->ida_month) == '7' ? 'selected' : '' }} style="font-weight: normal;">July</option>
                                        <option value="8" {{ old("ida_month", $arrear_row->ida_month) == '8' ? 'selected' : '' }} style="font-weight: normal;">Aug</option>
                                        <option value="9" {{ old("ida_month", $arrear_row->ida_month) == '9' ? 'selected' : '' }} style="font-weight: normal;">Sep</option>
                                        <option value="10" {{ old("ida_month", $arrear_row->ida_month) == '10' ? 'selected' : '' }} style="font-weight: normal;">Oct</option>
                                        <option value="11" {{ old("ida_month", $arrear_row->ida_month) == '11' ? 'selected' : '' }} style="font-weight: normal;">Nov</option>
                                        <option value="12" {{ old("ida_month", $arrear_row->ida_month) == '12' ? 'selected' : '' }} style="font-weight: normal;">Dec</option>           
                                    </select>
                                </div>
                            </div>    
                              <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <label>Diffrence Interest Amount : <span id="dia">{{ old('difference_intrest_amount', $arrear_row->difference_intrest_amount) != null ? old('difference_intrest_amount', $arrear_row->difference_intrest_amount) : 0.00 }}</span> /-</label>
                                    <input type="text" id="difference_intrest_amount" name="difference_intrest_amount" value="{{ old('difference_intrest_amount', $arrear_row->difference_intrest_amount)}}" hidden required>
                                </div>
                            </div>                  
                    </div>

                    <div class="row align-items-center">
                        <div id="ida_error" class="form-control-feedback"></div>
                    </div>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                            <div class="col-md-9">
                                <div class="form-group m-form__group building_list">
                                    <label class="radio-inline" style="margin-right: 1rem;">Paid</label>
                                    <label class="radio-inline" style="margin-right: 1rem;"> <input type="radio" name="payment_status" value="1" {{ old("payment_status", $arrear_row->payment_status) == '1' ? 'checked' : '' }}  required> Yes </label>
                                    <label class="radio-inline" style="margin-right: 1rem;"> <input type="radio" name="payment_status" value="0" {{ old("payment_status", $arrear_row->payment_status) == '0' ? 'checked' : '' }} required> No </label>
                                </div>  
                            </div>                          
                    </div>
            
                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                         <div class="col-md-4">Amount to be paid : <span id="total_amount"> {{ old('total_amount', $arrear_row->total_amount) != null ? old('total_amount', $arrear_row->total_amount) : 0.00 }}</span> /-</div>
                         <input type="text" id="total_amount_val" name="total_amount" value="{{ old('total_amount', $arrear_row->total_amount)}}" hidden required>
                         <div class="col-md-8"><!-- Formula = old rate + old Intrest amount + Diffrence Amount + Diffrence Intrest amount --></div>
                    </div>

                <div class="row align-items-center mb-0">           
                    <div class="col-md-9">
                        <div class="form-group m-form__group">
                            <input type="submit" class="btn m-btn--pill m-btn--custom btn-primary" name="save" value="Save">
                            <a  class="btn m-btn--pill m-btn--custom btn-metal" href="{{ route('em_clerk.index') }}">Cancel</a>
                        </div>
                    </div>
                </div>

            </form>
                   
                </div>
            </div>
        </div>

        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="portlet-title">
            <div class="caption">
                <div class="tools">
                  <h4>Monthly details of - {{$tenant->first_name}} - {{$tenant->flat_no}}</h4>
                </div>
            </div>
         <div class="m-portlet__body">
            <!--begin: Datatable -->
            {!! $html->table() !!}
            <!--end: Datatable -->
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
 {!! $html->scripts() !!}
{{-- <script>
    /*$("#update_status").on("change", function () {
        $("#eeForm").submit();
    });*/
    $(document).ready(function () {
        $(".display_msg").delay(5000).slideUp(300);
    });

    $(document).on('change', '.ior', function(){
        total_amount();
    });

    $(document).on('change', '.ida', function(){
        total_amount();
    });

    function total_amount(){

                var ior = "<?php echo $rate_card->interest_on_old_rate ?>";
                var old_rate = "<?php echo $rate_card->old_rate ?>";
                
                var iod = "<?php echo $rate_card->interest_on_differance ?>";
                var rate_diff = "<?php echo $rate_card->revise_rate - $rate_card->old_rate ?>";
                
                var bill_year = $('#bill_year').val();
                var bill_month = $('#bill_month').val();

                var ior_year = $('#ior_year').val();
                var ior_month = $('#ior_month').val();

                var ida_year = $('#ida_year').val();
                var ida_month = $('#ida_month').val();

                if(bill_year == '' || bill_month == ''){
                    $('#bill_error').html('select Year and month for arrear Calculation.');
                    return false;
                } else if(ior_year == '' || ior_month == ''){
                  $('#bill_error').html(''); 
                  $('#ior_error').html('select Year and month of arrear Calculation.');
                    return false;
                } else if(ida_year == '' || ida_month == ''){
                  $('#ior_error').html('');
                  $('#ida_error').html('select Year and month of arrear Calculation.');
                    return false;
                } else {
                    $('#ida_error').html('');
                }

                var months1 = monthDiff(
                                new Date(ior_year, ior_month, 1),
                                new Date(bill_year, (bill_month), 30)  
                             );

                var months2 = monthDiff(
                                new Date(ida_year, ida_month, 1),
                                new Date(bill_year, (bill_month), 30)  
                             );
                var iod_per = iod / 100;
                var ior_per = ior / 100;

                var old_intrest_amount = (old_rate * ior_per * months1).toFixed(2);

                var intrest_on_difference = (rate_diff * iod_per * months2).toFixed(2);

                $('#oia').html(old_intrest_amount);
                $('#old_intrest_amount').val(old_intrest_amount);                

                $('#dia').html(intrest_on_difference);
                $('#difference_intrest_amount').val(intrest_on_difference);

                // var total = (parseFloat(old_rate)+parseFloat(old_intrest_amount)+parseFloat(rate_diff)+parseFloat(intrest_on_difference)).toFixed(2);
                var total = (parseFloat(old_rate *months1)+parseFloat(old_intrest_amount)+parseFloat(rate_diff*months1)+parseFloat(intrest_on_difference)).toFixed(2);
                
                 $('#total_amount').html(total);
                 $('#total_amount_val').val(total);
    }

function monthDiff(d1, d2) {
    var months;
    months = (d2.getFullYear() - d1.getFullYear()) * 12;
    months -= d1.getMonth() + 1;
    months += d2.getMonth() -1;
    return months <= 0 ? 0 : months;
}


</script> --}}
<script>
    /*$("#update_status").on("change", function () {
        $("#eeForm").submit();
    });*/
    $(document).ready(function () {
        $(".display_msg").delay(5000).slideUp(300);
    });

    $(document).on('change', '.ior', function(){
        total_amount();
    });

    $(document).on('change', '.ida', function(){
        total_amount();
    });


    var old_rate_old = 0;
    var old_rate_diff = 0;
    var old_iod = 0;
    var old_ior = 0;
    var old_intrest_amount1 = 0;
    var old_intrest_amount2 = 0;
    var intrest_on_difference1 = 0;
    var intrest_on_difference2 = 0;
    var old_intrest_amount = 0;
    var intrest_on_difference = 0;
    var iod_per = 0;
    var ior_per = 0;
    var old_rate = 0;
    var ior = 0;
    var iod = 0;
    var rate_diff = 0
    var total1 = 0 
    var total = 0;
    var total2 = 0;
    var currentYear = '';
    var Year = '';
    var currentMonth = '';

    function total_amount(){
                
                ior = "<?php echo $rate_card->interest_on_old_rate ?>";
                old_rate = "<?php echo $rate_card->old_rate ?>";
                
                iod = "<?php echo $rate_card->interest_on_differance ?>";
                rate_diff = "<?php echo $rate_card->revise_rate - $rate_card->old_rate ?>";
                
                var bill_year = $('#bill_year option:selected').val();
                var bill_month = $('#bill_month option:selected').val();
                // bill_month = bill_month - 1;
                var ior_year = $('#ior_year option:selected').val();
                var ior_month = $('#ior_month option:selected').val();
                // if( ior_month != 1 ) {
                    // ior_month = ior_month - 1;
                // }

                var ida_year = $('#ida_year option:selected').val();
                var ida_month = $('#ida_month option:selected').val();

                // ida_month = ida_month - 1;


                var currentDate = new Date(),

                currentMonth = currentDate.getMonth(),

                currentYear = currentDate.getFullYear();

                var building_id = "<?php  echo encrypt($tenant->building_id); ?>";
                var society_id = "<?php  echo encrypt($society->id); ?>";

                var year_diff = currentYear-ior_year;
                // if(year_diff > 1) {
                    var start_year = bill_year;
                    var end_year = ior_year;

                    $.ajax({
                        url:"{{URL::route('get_arrear_charges_multiple')}}",
                        type: 'get',
                        data: {start_year: start_year,building_id:building_id,society_id:society_id,ior_year:ior_year,ior_month:ior_month, ida_month:ida_month,ida_year:ida_year},
                            success: function(response){
                            var strResponse = $.parseJSON(response);
                            
                                console.log(strResponse)
                            if (true == strResponse.result && null != strResponse.data ) {
                                old_rate_old = [];
                                old_rate_diff = [];
                                old_iod = [];
                                old_ior = [];

                                $.each(strResponse.data,function(i,v) {
                                    old_rate_old[v.year] = Number(v.old_rate);
                                    old_rate_diff[v.year] = Number(v.revise_rate) - Number(v.old_rate);
                                    old_iod[v.year] = Number(v.interest_on_differance);
                                    old_ior[v.year] = Number(v.interest_on_old_rate);
                                });
                                // bill_month = bill_month - 1;
                                var start_date = new Date(ior_year,ior_month,01);
                                var end_date = new Date(bill_year,bill_month,01);
                                bill_month++;
                                var dates = dateRange(ior_year+'-'+ior_month+'-'+01,bill_year+'-'+bill_month+'-'+01);                    
                                //console.log(dates)
                                var start_date_int = new Date(ida_year, ida_month, 01);
                                var end_date_int = new Date(bill_year, bill_month, 01);
                                
                                var datesint = dateRange(ida_year+'-'+ida_month+'-'+01,bill_year+'-'+bill_month+'-'+01);                    

                                //console.log(datesint+"ok");

                                if(null != dates ) {
                                    var old_intrest_amount_temp = 0;
                                    var intrest_on_difference_temp = 0;
                                    var old_total = 0;
                                    var old_total_intrest_on_difference = 0;

                                    for(i=0; i < dates.length;i++) {
                                        var monthlyDate = dates[i];
                                        
                                        var tempYear = new Date(monthlyDate).getFullYear();
                                        var tempMonth = new Date(monthlyDate).getMonth();
                                        
                                        tempMonth = tempMonth +1;
                                        

                                        if(tempMonth > 3 ) {
                                            //console.log('elm',old_ior[tempYear])
                                            old_ior_per = old_ior[tempYear] / 100;

                                            var temp = parseFloat(old_rate_old[tempYear] * old_ior_per ).toFixed(2);
                                        } else if(tempMonth <=3 ) {
                                            //console.log('elm',old_ior[tempYear])
                                            old_ior_per = old_ior[tempYear-1] / 100;

                                            var temp = parseFloat(old_rate_old[tempYear-1] * old_ior_per ).toFixed(2);
                                        } 

                                        if(tempMonth > 3 ) {
                                            
                                            old_total += parseFloat(old_rate_old[tempYear]) + parseFloat(temp) || 0;
                                        } else if(tempMonth <= 3) {
                                            old_total += parseFloat(old_rate_old[tempYear-1]) + parseFloat(temp) || 0;
                                        }
                                        
                                        old_intrest_amount_temp += parseFloat(temp) || 0;
                                        
                                    }
                                    
                                    $('.no_of_months').html(datesint.length+1)
                                    for(i=0; i < datesint.length;i++) {
                                        var monthlyDate = datesint[i];
                                        
                                        var tempYear = new Date(monthlyDate).getFullYear();
                                        var tempMonth = new Date(monthlyDate).getMonth();
                                        
                                        tempMonth = tempMonth +1;
                                        

                                        if(tempMonth > 3 ) {

                                            old_iod_per = old_iod[tempYear] / 100;

                                            var temp1 = parseFloat(old_rate_diff[tempYear] * old_iod_per).toFixed(2);
                                        } else if(tempMonth <=3 ) {
                                            old_iod_per = old_iod[tempYear-1] / 100;

                                            var temp1 = parseFloat(old_rate_diff[tempYear-1] * old_iod_per).toFixed(2);
                                        } 

                                        if(tempMonth > 3 ) {
                                            
                                            old_total_intrest_on_difference += parseFloat(old_rate_diff[tempYear]) + parseFloat(temp1) || 0;
                                        } else if(tempMonth <= 3) {
                                            old_total_intrest_on_difference += parseFloat(old_rate_diff[tempYear-1]) + parseFloat(temp1) || 0;
                                        }
                                        
                                        intrest_on_difference_temp += parseFloat(temp1) || 0;
                                        
                                    };
                                    
                                    old_intrest_amount = old_intrest_amount_temp;
                                    intrest_on_difference = intrest_on_difference_temp;
                                    total = old_total + old_total_intrest_on_difference;
                                }

                                $('#oia').html(Math.ceil(old_intrest_amount));
                                $('#old_intrest_amount').val(Math.ceil(old_intrest_amount));

                                $('#dia').html(Math.ceil(intrest_on_difference));
                                $('#difference_intrest_amount').val(Math.ceil(intrest_on_difference));
                            
                                 $('#total_amount').html(Math.ceil(total));
                                 $('#total_amount_val').val(Math.ceil(total));
                            } else {
                                old_intrest_amount = 0;
                                intrest_on_difference = 0;
                                total = 0;
                                $('#ior_error').html('');
                                $('#ida_error').html('Arrear charges not defined for selected year.');

                                $('#oia').html(Math.ceil(old_intrest_amount));
                                $('#old_intrest_amount').val(Math.ceil(old_intrest_amount));

                                $('#dia').html(Math.ceil(intrest_on_difference));
                                $('#difference_intrest_amount').val(Math.ceil(intrest_on_difference));
                            
                                $('#total_amount').html(Math.ceil(total));
                                $('#total_amount_val').val(Math.ceil(total));
                            }
                        }
                    });
                    
                // } else {
                    // ior_month = ior_month - 1;
                    // ida_month = ida_month - 1;
                    // if(currentYear != ior_year || (ior_month <=3 && currentYear == ior_year )) {
                    //     if(ior_month <=3 && currentYear == ior_year) {
                    //         Year = currentYear -1;
                    //     } else if(ida_month <=3 && currentYear == ida_year) {
                    //         Year = ida_year;
                    //     } else {
                    //         Year = ior_year;
                    //     }

                    //     $.ajax({
                    //         url:"{{URL::route('get_arrear_charges')}}",
                    //         type: 'get',
                    //         data: {year: Year,building_id:building_id,society_id:society_id },
                    //             success: function(response){
                    //             var strResponse = $.parseJSON(response);
                                
                    //             if (true == strResponse.result && null != strResponse.data) {
                    //                 old_rate_old = Number(strResponse.data.old_rate);
                    //                 old_rate_diff = Number(strResponse.data.revise_rate) - Number(strResponse.data.old_rate);
                    //                 old_iod = Number(strResponse.data.interest_on_differance);
                    //                 old_ior = Number(strResponse.data.interest_on_old_rate);
                    //             } else {
                    //                 $('#ior_error').html('');
                    //                 $('#ida_error').html('Arrear charges not defined for selected year.');
                    //             }
                    //         }
                    //     });
                    // }

                    // var months1 = monthDiff(
                    //             new Date(ior_year, ior_month, 01),
                    //             new Date(bill_year, bill_month, 01)  
                    //          );
                    //          // console.log(bill_year+' '+bill_month)
                
                    // var months2 = monthDiff(
                    //                 new Date(ida_year, ida_month, 01),
                    //                 new Date(bill_year, bill_month, 01)  
                    //              );
                    
                    // iod_per = iod / 100;
                    // ior_per = ior / 100;

                    // if(ior_month > 3 && currentYear != ior_year || (ior_month <=3 && currentYear == ior_year)) {
                    //     if(ior_month <=3 && currentYear == ior_year) {
                    //         var old_monthDiff1 = monthDiff(
                    //                 new Date(ior_year, ior_month, 01),
                    //                 new Date(ior_year, 4, 01)
                    //              );

                    //         var old_monthDiff2 = monthDiff(
                    //                 new Date(ida_year, ida_month, 01),
                    //                 new Date(ida_year, 4, 01)
                    //              );
                    //     } else if (ior_month ==3 && currentYear == ior_year) {
                    //         var old_monthDiff1 = 1;
                    //         var old_monthDiff2 = 1;

                    //     } else {

                    //         var old_monthDiff1 = monthDiff(
                    //                 new Date(ior_year, 3, 01),
                    //                 new Date(ior_year, ior_month, 01)
                    //              );

                    //         var old_monthDiff2 = monthDiff(
                    //                 new Date(ida_year, 3, 01),
                    //                 new Date(ida_year, ida_month, 01)
                    //              );
                    //     }
                    //     old_iod_per = old_iod / 100;
                    //     old_ior_per = old_ior / 100;

                    //     console.log(old_monthDiff1);
                    //     console.log(old_monthDiff2);

                    //     old_intrest_amount1 = (old_rate_old * old_ior_per * old_monthDiff1).toFixed(2);

                    //     intrest_on_difference1 = (old_rate_diff * old_iod_per * old_monthDiff2).toFixed(2);

                    //     var new_monthDiff1 = monthDiff(
                    //                 new Date(bill_year, 3, 01),
                    //                 new Date(bill_year, bill_month, 01)
                    //              );

                    //     var new_monthDiff2 = monthDiff(
                    //                 new Date(bill_year, 3, 01),
                    //                 new Date(bill_year, bill_month, 01)
                    //              );

                    //     old_intrest_amount2 = (old_rate * ior_per * new_monthDiff1).toFixed(2);

                    //     intrest_on_difference2 = (rate_diff * iod_per * new_monthDiff2).toFixed(2);

                    //     old_intrest_amount = (Number(old_intrest_amount1) + Number(old_intrest_amount2));

                    //     intrest_on_difference = (Number(intrest_on_difference1) + Number(intrest_on_difference2));


                    //     total1 = (parseFloat(old_rate_old *old_monthDiff1)+parseFloat(old_intrest_amount1)+parseFloat(old_rate_diff*old_monthDiff2)+parseFloat(intrest_on_difference1)).toFixed(2);

                    //     total2 = (parseFloat(old_rate *new_monthDiff1)+parseFloat(old_intrest_amount2)+parseFloat(rate_diff*new_monthDiff2)+parseFloat(intrest_on_difference2)).toFixed(2);

                    //     total = Number(total1) + Number(total2);
                    // } else {

                    //     // console.log(months2);
                        
                    //     // if(months1 > 0 ) {
                    //         // var old_rate = old_rate *months1;
                    //         // var rate_diff = rate_diff *months1;
                    //     // }
                    //     console.log(months1);
                    //     old_intrest_amount = (old_rate * ior_per * months1).toFixed(2);

                    //     intrest_on_difference = (rate_diff * iod_per * months2).toFixed(2);

                    //     // $('#oia').html(old_intrest_amount);
                    //     // $('#old_intrest_amount').val(old_intrest_amount);                

                    //     // $('#dia').html(intrest_on_difference);
                    //     // $('#difference_intrest_amount').val(intrest_on_difference);

                    //     total = (parseFloat(old_rate *months1)+parseFloat(old_intrest_amount)+parseFloat(rate_diff*months1)+parseFloat(intrest_on_difference)).toFixed(2);
                    // }
                // }

               

                if(bill_year == '' || bill_month === ''){
                    $('#bill_error').html('select Year and month for arrear Calculation.');
                    return false;
                } else if(ior_year == '' || ior_month === '') {
                    $('#bill_error').html(''); 
                    $('#ior_error').html('select Year and month of arrear Calculation.');
                    return false;
                } else if(ida_year == '' || ida_month === '') {
                    $('#ior_error').html('');
                    $('#ida_error').html('select Year and month of arrear Calculation.');
                    return false;
                } else {
                    $('#ida_error').html('');
                }
                
                
                $('#oia').html(Math.ceil(old_intrest_amount));
                $('#old_intrest_amount').val(Math.ceil(old_intrest_amount));

                $('#dia').html(Math.ceil(intrest_on_difference));
                $('#difference_intrest_amount').val(Math.ceil(intrest_on_difference));
            
                 $('#total_amount').html(Math.ceil(total));
                 $('#total_amount_val').val(Math.ceil(total));

    }

function monthDiff(d1, d2) {
    var months;
    months = (d2.getFullYear() - d1.getFullYear()) * 12;
    months = months - d1.getMonth() + 1;
    months = months + d2.getMonth() - 1;
    return months <= 0 ? 0 : months;
}


function dateRange(startDate, endDate) {
    // end_date = '2017-03-01';
  var start      = startDate.split('-');
  var end        = endDate.split('-');
  var startYear  = parseInt(start[0]);
  var endYear    = parseInt(end[0]);
  var dates      = [];

  for(var i = startYear; i <= endYear; i++) {
    var endMonth = i != endYear ? 11 : parseInt(end[1]) - 1;
    var startMon = i === startYear ? parseInt(start[1])-1 : 0;
    for(var j = startMon; j <= endMonth; j = j > 12 ? j % 12 || 11 : j+1) {
      var month = j+1;
      var displayMonth = month < 10 ? '0'+month : month;
      dates.push([i, displayMonth, '01'].join('-'));
    }
  }
  dates.splice(-1,1);
  return dates;
}

function formatDate(passedDate) {
    var d = passedDate.getDate();
    var m =  passedDate.getMonth();
    var y = passedDate.getFullYear();

    var returnDate = y+'-'+m+'-'+d;

    return returnDate;
}

</script>
@endsection
