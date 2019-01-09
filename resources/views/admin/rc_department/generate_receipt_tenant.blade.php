@extends('admin.layouts.app')

@section('actions')
    @include('admin.rc_department.action')
@endsection

@section('content')
<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Generate Receipt</h3>
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <form method="post" action="{{route('payment_receipt_tenant')}}">
            {{ csrf_field() }}

            <input type="text" name="tenant_id" value="{{$bill->tenant_id}}" hidden>
            <input type="text" name="building_id" value="{{$bill->building_id}}" hidden>
            <input type="text" name="society_id" value="{{$bill->society_id}}" hidden>

            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Account Code:</label>
                        <input type="text" name="account_code" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Bill No:</label>
                        <input type="text" name="bill_no" class="form-control form-control--custom m-input" value="{{$bill->id}}" readonly>
                        <span class="help-block"></span>
                    </div>

                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Society Name:</label>
                        <input type="text" class="form-control form-control--custom m-input" value="{{$bill->society_detail->society_name}}" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>
                
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Building Number:</label>
                        <input type="text" class="form-control form-control--custom m-input" value="{{$bill->building_detail->building_no}}" readonly>
                        <span class="help-block"></span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Flat Number:</label>
                        <input type="text" class="form-control form-control--custom m-input" value="{{$bill->tenant_detail->flat_no}}" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Amount Paid By:</label>
                        <input type="text" name="amount_paid_by" class="form-control form-control--custom m-input" value="" required>
                        <span class="help-block"></span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Bill Amount of month:</label>
                        <input type="text" name="bill_amount" class="form-control form-control--custom m-input" value="@if(strtotime(date('Y-m-d')) < strtotime(date('Y-m-d',strtotime($bill->due_date)))) {{$bill->total_bill}} @else  {{$bill->total_bill_after_due_date}} @endif" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-12 form-group">
                        <label class="col-form-label" for="payment-mode">Payment Mode:</label>
                        <div class="m-radio-inline">
                            <label class="m-radio m-radio--primary">
                                <input type="radio" name="payment_mode" checked value="cash"> Cash Payment
                                <span></span>
                            </label>
                            <label class="m-radio m-radio--primary">
                                <input type="radio" name="payment_mode" value="dd" > DD Payment
                                <span></span>
                            </label>
                            <label class="m-radio m-radio--primary">
                                <input type="radio" name="payment_mode" value="online" disabled> Online Payment
                                <span></span>
                            </label>
                        </div>
                    </div>                    
                </div>

                <div class="form-group m-form__group row" id="cash_block">
                    <div class="col-sm-3 form-group">
                        <label class="col-form-label" for="">Amount Paid:</label>
                        <input type="number" id="cash_amount" name="cash_amount" class="form-control form-control--custom m-input" value="0">
                        <span></span>
                    </div>
                </div>

                <div class="form-group m-form__group row" id="dd_block">
                    <div class="col-sm-3 form-group">
                        <label class="col-form-label" for="">DD Number:</label>
                        <input type="text" id="dd_no" name="dd_no" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>

                    <div class="col-sm-3 form-group">
                        <label class="col-form-label" for="">Bank Name:</label>
                        <input type="text" id="" name="bank_name" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-3 form-group">
                        <label class="col-form-label" for="">Amount Paid:</label>
                        <input type="number" id="dd_amount" name="dd_amount" class="form-control form-control--custom m-input" value="0">
                        <span></span>
                    </div>
                </div>
                
                <div class="form-group m-form__group row" id="online_block">
                    <div class="col-sm-3 form-group">
                        <label class="col-form-label" for="">DD Number:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>

                    <div class="col-sm-3 form-group">
                        <label class="col-form-label" for="">Bank Name:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-3 form-group">
                        <label class="col-form-label" for="">Amount Paid:</label>
                        <input type="number" id="online_amount" name="online_amount" class="form-control form-control--custom m-input amount_paid" value="0">
                        <span></span>
                    </div>
                </div>
 
                <div class="form-group m-form__group row">
                    <label class="col-form-label col-sm-12" for="">Payment Made for months:</label>
                    <div class="col-sm-4 form-group">
                        <input type="text" id="payment-made-from-month" name="from_date" class="form-control form-control--custom m-input"
                            value="{{$bill->bill_from}}" readonly>
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <input type="text" id="payment-made-to-month" name="to_date" class="form-control form-control--custom m-input"
                            value="{{$bill->bill_to}}" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Amount Balance:</label>
                        <input type="text" id="balance_amount" name="balance_amount" class="form-control form-control--custom m-input" value="@if(strtotime(date('Y-m-d')) < strtotime(date('Y-m-d',strtotime($bill->due_date)))) {{$bill->total_bill}} @else  {{$bill->total_bill_after_due_date}} @endif" readonly>
                        <span class="help-block"></span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Credit Amount:</label>
                        <input type="text" id="credit_amount" name="credit_amount" class="form-control form-control--custom m-input" value="00" readonly>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="btn-list">
                                    <button type="submit" id="" class="btn btn-primary">Generate Receipt</button>
                                    <a href="{{route('bill_collection_tenant')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
 <script>
    $(document).ready(function () {
        /* Multi select with search data code toggle payment mode start here */
        $('#dd_block').hide();
        $('#online_block').hide();

        $('input[type=radio][name=payment_mode]').change(function() {
            if (this.value == 'cash') {
                 $('#cash_block').show();
                 $('#dd_block').hide();
                 $('#online_block').hide();
            } else if (this.value == 'dd') {
                  $('#cash_block').hide();
                  $('#dd_block').show();
                  $('#online_block').hide();
            } else if (this.value == 'online') {
                $('#cash_block').hide();
                $('#dd_block').hide();
                $('#online_block').show();
                
            } 
        });
        /* Multi select with search data code toggle payment mode ends here */

        $('#online_amount').change(function(){
            var amount = $('#online_amount').val(); 
            $('#dd_amount').val('');
            $('#cash_amount').val('');
            calc(amount);
        });

        $('#cash_amount').change(function(){
            var amount = $('#cash_amount').val(); 
            $('#online_amount').val('');
            $('#dd_amount').val('');
            calc(amount); 
        });

        $('#dd_amount').change(function(){
            var amount = $('#dd_amount').val(); 
            $('#cash_amount').val('');
            $('#online_amount').val('');
            calc(amount);
        });

        function calc(amount){
           
            var bill_amount = '@if(strtotime(date('Y-m-d')) < strtotime(date('Y-m-d',strtotime($bill->due_date)))) {{$bill->total_bill}} @else  {{$bill->total_bill_after_due_date}} @endif';
            var balance = '<?php echo 0; ?>';
            var credit = '<?php echo 0; ?>'; 
            
            
            //if (/^\d+$/.test(amount)) {              
            if (amount.match(/^-?\d*(\.\d+)?$/)) {              
               //console.log(amount);
                var diff = bill_amount - amount;
                if(diff < 0){
                    credit = (parseFloat(credit) + parseFloat(Math.abs(diff))).toFixed(2);
                    //console.log(credit);
                    $('#balance_amount').val(balance);
                    $('#credit_amount').val(credit);
                } else {
                    balance = (parseFloat(balance) + parseFloat(Math.abs(diff))).toFixed(2);
                    //console.log(balance);
                    $('#credit_amount').val(credit);
                    $('#balance_amount').val(balance);
                }
            } else {
                alert('Only Numbers allowed.');
            }

        }

    });    
  </script>
@endsection