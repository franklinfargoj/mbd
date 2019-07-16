
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="Jyzt3ywIS2J5xFS3tBTpvrWk7d4SVw67OhiNsAgd">

    <title>MBD Billing|MHADA</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="http://rrboardbilling.php-dev.in/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="http://rrboardbilling.php-dev.in/css/custom.css" rel="stylesheet" type="text/css" />
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->
</head>

<body>
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor mhada-login-new m-login m-login--singin m-login--2 m-login-2--skin-2"
     id="m_login" style="position: relative;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12 overlay overlay--login min-height-100vh">

            </div>
            <div class="col-md-12 col-lg-12 login-box-wrap mhada-login-box">
                <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                    <div class="d-flex flex-wrap justify-content-center">
                        <div class="m-login-inner">

                            <div class="col-md-12">

                                <div class="m-portlet">
                                    <div class="m-portlet__body--table">
                                        <form id="payment_form" class="m-login__form m-form" action="{{route('pay_bill')}}" method="POST">
                                            <input type="hidden" name="bill_id"  value="{{$billing_detail->id}}">
                                            @csrf
                                            <div class="mb-4">
                                                <label class="col-form-label d-block" for=""><b>Payment Details</b> Due Date: {{$billing_detail->due_date}}</label>

                                            </div>
                                            <div class="row field-row">
                                                <div class="col-sm-6 field-col">
                                                    <span class="field-name">Building Name : </span>
                                                    <span class="field-value">{{$billing_detail->building_detail->name}}</span>
                                                </div>
                                                <div class="col-sm-6 field-col">
                                                    <span class="field-name">Society Name : </span>
                                                    <span class="field-value">{{$billing_detail->society_detail->name}}</span>
                                                </div>
                                                <div class="col-sm-6 field-col">
                                                    <span class="field-name">Building Number : </span>
                                                    <span class="field-value">{{$billing_detail->building_detail->building_no}}</span>
                                                </div>
                                                <div class="col-sm-6 field-col">
                                                    <span class="field-name">Flat Number : </span>
                                                    <span class="field-value">408</span>
                                                </div>
                                                <div class="col-sm-6 field-col">
                                                    <span class="field-name">Amount Paid By : </span>
                                                    <input type="text" class="form-control m-input" name="paid_by"
                                                                                     id="paid_by" value="">

                                                </div>
                                                @php
                                                    if(strtotime(date('Y-m-d')) < strtotime(date('Y-m-d',strtotime($billing_detail->due_date)))){
                                                                $total_amount = $billing_detail->total_bill;
                                                            }
                                                            else{
                                                                $total_amount = $billing_detail->total_bill_after_due_date;
                                                            }

                                                @endphp
                                                <div class="col-sm-6 field-col">
                                                    <span class="field-name">Bill Amount of Month {{$data['month']}} : </span>
                                                    <span class="field-value">Rs.{{$billing_detail->monthly_bill}}</span>
                                                </div>
                                                <div class="col-sm-6 field-col">
                                                    <span class="field-name">Arrears Amount of Month {{$data['month']}} : </span>
                                                    <span class="field-value">Rs. {{$billing_detail->arrear_bill}}</span>
                                                </div>
                                                <div class="col-sm-6 field-col">
                                                    <span class="field-name">Total Amount to be paid : </span>
                                                    <span class="field-value">{{$total_amount}}</span>
                                                </div>

                                                <div class="col-sm-12 field-col">
                                                    <span class="field-name">Amount to be paid:</span>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 " id="cash_payment">
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-12 form-group m-form__group mhada-category">
                                                                <label for="amount">
                                                                    Amount <span style="color: red;">*</span>
                                                                </label>
                                                                <input type="text" class="form-control m-input" name="amount" id="amount" value="">
                                                                <span class="help-block" style="color:red;"></span>
                                                            </div>
                                                            <div class="col-md-4 col-sm-12 form-group m-form__group mhada-category">
                                                                <label for="amount">
                                                                    Mobile No. <span style="color: red;">*</span>
                                                                </label>
                                                                <input type="text" class="form-control m-input" name="mob_no" id="mob_no" value="">
                                                                <span class="help-block" style="color:red;"></span>
                                                            </div>
                                                            <div class="col-md-4 col-sm-12 form-group m-form__group mhada-category">
                                                                <label for="amount">
                                                                    Email ID <span style="color: red;">*</span>
                                                                </label>
                                                                <input type="email" class="form-control m-input" name="email" id="email" value="">
                                                                <span class="help-block" style="color:red;"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-sm-6 field-col text-center">
                                                    <span class="field-name">Balance Amount:<span id="bal_amount"> 0.00</span></span>
                                                    <span class="field-value"></span>
                                                    <input type="hidden" class="form-control m-input" name="balance_amount" id="balance_amount" value="">

                                                </div>
                                                <div class="col-sm-6 field-col text-center">
                                                    <span class="field-name">Credit Amount:<span id="cred_amount"> 0.00</span></span>
                                                    <span class="field-value"></span>
                                                    <input type="hidden" class="form-control m-input" name="credit_amount" id="credit_amount" value="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="btn-wrap" style="display: flex">
                                                        <button type="submit" class="btn btn-action">Pay</button>
                                                        <a class="btn btn-default" href="{{route('billing')}}">Cancel</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>

    $('#payment_form').submit(function () {
        $('#amountError').remove();
        $('#emailError').remove();
        $('#mobError').remove();

        var email = $('#email').val();
        // alert(email=='');
        var mob = $('#mob_no').val();
        var paying = $('#amount').val();
        if(paying=='' || email=='' || mob==''){
            // $('#amount').css('border','1px solid red');
            // $("<span id='amountError' style='color:red'>Please Pay minimum amount of this month</span>").insertAfter("#amount");
            if(paying==''){
                $('#amount').css('border','1px solid red');
                $("<span id='amountError' style='color:red'>Amount field can not be empty</span>").insertAfter("#amount");
            }else{
                $('#amount').css('border','1px solid green');
                $('#amountError').remove();
            }
            if(email==''){
                $('#email').css('border','1px solid red');
                $("<span id='emailError' style='color:red'>email field required</span>").insertAfter("#email");
            }else{
                $('#emailError').remove();
                $('#email').css('border','1px solid green');
            }
            if(mob==''){
                $('#mob_no').css('border','1px solid red');
                $("<span id='mobError' style='color:red'>Mobile No required</span>").insertAfter("#mob_no");
            }else{
                $('#mobError').remove();
                $('#mob_no').css('border','1px solid green');
            }
            return false;
        }

    });


</script>
<script>
    $(document).ready(function () {

        $('#amount').change(function(){
            var amount = $('#amount').val();
            calc(amount);
        });


        function calc(amount){

            var bill_amount = '{{$total_amount}}';
            var balance = '<?php echo 0; ?>';
            var credit = '<?php echo ($billing_detail->credit_amount) ?? '00' ?>';


            if (amount.match(/^-?\d*(\.\d+)?$/)) {
                var diff = bill_amount - amount;

                if(diff < 0){
                    credit = (parseFloat(credit) + parseFloat(Math.abs(diff))).toFixed(2);
                    $('#bal_amount').text(' '+balance);
                    $('#balance_amount').val(balance);
                    $('#cred_amount').text(' '+credit);
                    $('#credit_amount').val(credit);
                } else {
                    balance = (parseFloat(balance) + parseFloat(Math.abs(diff))).toFixed(2);
                    $('#cred_amount').text(' '+credit);
                    $('#credit_amount').val(credit);
                    $('#bal_amount').text(' '+balance);
                    $('#balance_amount').val(balance);
                }
            } else {
                alert('Only Numbers allowed.');
            }

        }

    });
</script>

</html>
