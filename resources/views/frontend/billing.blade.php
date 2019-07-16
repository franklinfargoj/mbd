
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="wyFG2KMwS41F1a0SGhlmHTCtv3UQQqFFsAggSkoq">

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
                            <div class="d-flex d-lg-none justify-content-center align-items-center login-page-header">
                                <img class="login-logo" src="http://rrboardbilling.php-dev.in/img/logo-short.png">
                            </div>
                            <div class="d-none d-lg-flex justify-content-center align-items-center login-page-header">
                                <img class="login-logo" src="http://rrboardbilling.php-dev.in/img/logo-short.png">
                            </div>
                            <div class="text-center w-100 m-login--left-box">
                                <h4 class="text-uppercase">MAHARASHTRA HOUSING AND AREA DEVELOPMENT AUTHORITY</h4>
                                <h5 class="text-uppercase mt-3">MBD BOARD BILLING SYSTEM</h5>
                            </div>

                            <div class="m-login__container m-login--right-box">
                                <div class="m-login__signin m-login__signin--box">
                                    <div class="m-login__head">
                                        <p class="sub-title">
                                        </p>
                                    </div>
                                    <form id="check-form" class="m-login__form m-form" action="{{route('payment_billing')}}" method="POST">
                                                                             <div>

                                        @csrf
                                            <label for="acc_no">Consumer No <span style="color:red">*</span></label>

                                            <input type="text" style="text-transform: capitalize;" class="form-control m-input" id="consumer_no" name="consumer_no" value="">
                                            <span class="help-block" style="color:red;"></span>
                                        </div>
                                        <button type="submit" class="btn btn-block btn-primary m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primary">
                                            Submit
                                        </button>
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
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script>
    $('#check-form').submit(function () {
        $('#consumer_noError').remove();

        var consumer_no = $('#consumer_no').val();
        if(consumer_no==''){
            $('#consumer_no').css('border','1px solid red');
            $("<span id='consumerError' style='color:red'>Please Pay minimum amount of this month</span>").insertAfter("#amount");
            if(consumer_no==''){
                $('#consumer_no').css('border','1px solid red');
                $("<span id='consumer_noError' style='color:red'>Consumer field required</span>").insertAfter("#consumer_no");
            }else{
                $('#consumer_no').css('border','1px solid green');
                $('#consumer_noError').remove();
            }
            return false;
        }

    });


</script>


</html>
