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
            <h3 class="m-subheader__title">Calculation - {{$society->society_name}} - {{$tenant->first_name}} - {{$tenant->flat_no}}</h3>
           <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
         </div>

        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                <form method="post" enctype='multipart/form-data' action="{{route('create_arrear_calculation')}}">
                    {{ csrf_field() }}

                    <input type="text" name="tenant_id" value="{{$tenant->id}}" hidden>
                    <input type="text" name="building_id" value="{{$tenant->building_id}}" hidden>
                    <input type="text" name="society_id" value="{{$society->id}}" hidden>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">                          
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="bill_year" name="year" required>
                                        <option value="" style="font-weight: normal;">Select Year</option>
                                        <option value="<?php echo  date('Y');?>" style="font-weight: normal;"><?php echo  date('Y'); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-1 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-1 year")); ?></option>
                                    </select>
                                </div>
                            </div>       
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="bill_month" name="month" required>
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

                    <div class="row align-items-center">
                        <div id="bill_error" class="form-control-feedback"></div>
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
                        Old  Intrest Rate : {{$rate_card->interest_on_old_rate}} % 
                    </div>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">                            
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input ior" id="ior_year" name="oir_year" required>
                                        <option value="" style="font-weight: normal;">Select Year</option>
                                        <option value="<?php echo  date('Y');?>" style="font-weight: normal;"><?php echo  date('Y'); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-1 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-1 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-2 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-2 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-3 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-3 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-4 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-4 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-5 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-5 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-6 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-6 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-7 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-7 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-8 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-8 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-9 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-9 year")); ?></option>
                                    </select>
                                </div>
                            </div>       
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input ior" id="ior_month" name="oir_month" required>
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
                                    <label>Old Interest Amount : <span id="oia">0.00</span> /-</label>         
                                    <input type="text" id="old_intrest_amount" name="old_intrest_amount" hidden required>
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
                                        <option value="<?php echo  date('Y');?>" style="font-weight: normal;"><?php echo  date('Y'); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-1 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-1 year")); ?></option>
                                         <option value="<?php echo date("Y",strtotime("-2 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-2 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-3 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-3 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-4 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-4 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-5 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-5 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-6 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-5 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-7 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-7 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-8 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-8 year")); ?></option>
                                        <option value="<?php echo date("Y",strtotime("-9 year")); ?>" style="font-weight: normal;"><?php echo date("Y",strtotime("-9 year")); ?></option>
                                    </select>
                                </div>
                            </div>       
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input ida" id="ida_month" name="ida_month" required>
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
                                    <label>Diffrence Interest Amount : <span id="dia">0.00</span> /-</label>
                                    <input type="text" id="difference_intrest_amount" name="difference_intrest_amount" hidden required>
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
                                    <label class="radio-inline" style="margin-right: 1rem;"> <input type="radio" name="payment_status" value="1" required> Yes </label>
                                    <label class="radio-inline" style="margin-right: 1rem;"> <input type="radio" name="payment_status" value="0" required> No </label>
                                </div>  
                            </div>                          
                    </div>
            
                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                         <div class="col-md-4">Amount to be paid : <span id="total_amount">0.00</span> /-</div>
                         <input type="text" id="total_amount_val" name="total_amount" hidden required>
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

    function total_amount(){

                var ior = "<?php echo $rate_card->interest_on_old_rate ?>";
                var old_rate = "<?php echo $rate_card->old_rate ?>";
                
                var iod = "<?php echo $rate_card->interest_on_differance ?>";
                var rate_diff = "<?php echo $rate_card->revise_rate - $rate_card->old_rate ?>";
                
                var bill_year = $('#bill_year').val();
                var bill_month = $('#bill_month').val();
                bill_month = bill_month - 1;
                var ior_year = $('#ior_year').val();
                var ior_month = $('#ior_month').val();

                ior_month = ior_month - 1;

                var ida_year = $('#ida_year').val();
                var ida_month = $('#ida_month').val();

                ida_month = ida_month - 1;

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
                
                var months1 = monthDiff(
                                new Date(ior_year, ior_month, 01),
                                new Date(bill_year, bill_month, 30)  
                             );
                             console.log(bill_year+' '+bill_month)
                
                var months2 = monthDiff(
                                new Date(ida_year, ida_month, 01),
                                new Date(bill_year, bill_month, 30)  
                             );
                
                var iod_per = iod / 100;
                var ior_per = ior / 100;

                var old_rate = old_rate *months1;
                var rate_diff = rate_diff *months1;
                var old_intrest_amount = (old_rate * ior_per * months1).toFixed(2);

                var intrest_on_difference = (rate_diff * iod_per * months2).toFixed(2);

                $('#oia').html(old_intrest_amount);
                $('#old_intrest_amount').val(old_intrest_amount);                

                $('#dia').html(intrest_on_difference);
                $('#difference_intrest_amount').val(intrest_on_difference);

                var total = (parseFloat(old_rate)+parseFloat(old_intrest_amount)+parseFloat(rate_diff)+parseFloat(intrest_on_difference)).toFixed(2);

                 $('#total_amount').html(total);
                 $('#total_amount_val').val(total);

    }

function monthDiff(d1, d2) {
    var months;
    months = (d2.getFullYear() - d1.getFullYear()) * 12;
    months = months - d1.getMonth() + 1;
    months = months + d2.getMonth();
    return months <= 0 ? 0 : months;
}


</script>
@endsection
