<html>

<head>
    <title></title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        label{
            text-transform: capitalize;
        }
    </style>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
   
</head>

<!------ Include the above in your HEAD tag ---------->

<body>
    <div class="container">
        @if(session()->has( 'success' ) )
        <div class="alert alert-success">
            {{ session()->get( 'success' ) }}
        </div>
        @endif
        @if(session()->has( 'failed' ) )
        <div class="alert alert-danger">
            {{ session()->get( 'failed' ) }}
        </div>
        @endif
        <div class="col-sm-3 overlay overlay--login h-100vh">
            <div class="d-flex justify-content-center align-items-center login-page-header">
                <img class="login-logo" src="{{asset('/img/logo-short.png')}}">
            </div>
        </div>
        <div class="col-sm-6 overlay overlay--login h-100vh">
            <div class="text-center w-100 m-login--left-box">
                <h4 class="text-uppercase">Maharashtra Housing and Area Development Board</h4>
            </div>
        </div>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td colspan="1">
                        <form class="well form-horizontal" method="post" action="{{route('postform')}}">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Full Name</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-user"></i></span><input id="full_name"
                                                name="full_name" placeholder="Full Name" class="form-control"
                                                value="{{old('full_name')}}" type="text" required="true"></div>
                                        @if ($errors->has('full_name'))
                                        <span class="text-danger">{{ $errors->first('full_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Email</label>
                                    <div class="col-md-5 inputGroupContainer">
                                       <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email" name="email" placeholder="Email" class="form-control" required="true" value="{{old('email')}}" type="text"></div>
                                       @if ($errors->has('email'))
                                       <span class="text-danger">{{ $errors->first('email') }}</span>
                                       @endif
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="col-md-4 control-label">Phone Number</label>
                                    <div class="col-md-5 inputGroupContainer">
                                       <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="phonenumber" name="phonenumber" placeholder="Phone Number" class="form-control" required="true" value="{{old('phonenumber')}}" type="text"></div>
                                       @if ($errors->has('phonenumber'))
                                       <span class="text-danger">{{ $errors->first('phonenumber') }}</span>
                                       @endif
                                    </div>
                                 </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Address Permanant</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-home"></i></span><input
                                                id="permanant_address" name="permanant_address"
                                                placeholder="Address Permanant" class="form-control"
                                                value="{{old('permanant_address')}}" type="text" required="true"></div>
                                        @if ($errors->has('permanant_address'))
                                        <span class="text-danger">{{ $errors->first('permanant_address') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Address Present</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-home"></i></span><input
                                                id="address_present" name="address_present"
                                                placeholder="Address Present" class="form-control" required="true"
                                                value="{{old('address_present')}}" type="text"></div>
                                        @if ($errors->has('address_present'))
                                        <span class="text-danger">{{ $errors->first('address_present') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Residing in Staff quarter?</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="col-lg-3">
                                        <label>
                                             <input type="radio" name="residing_in_staff_quarter" value="1"
                                                required {{old('residing_in_staff_quarter')=='1'?'checked':''}} onClick="show_staff_quarter_details();">&nbsp;&nbsp;Yes
                                        </label>
                                        </div>
                                        <div class="col-lg-3">
                                        <label> 
                                            <input type="radio" name="residing_in_staff_quarter" value="2"
                                                required {{old('residing_in_staff_quarter')=='2'?'checked':''}} onClick="hide_staff_quarter_details();">&nbsp;&nbsp;No
                                        </label>
                                        </div>
                                        @if ($errors->has('residing_in_staff_quarter'))
                                        <span
                                            class="text-danger">{{ $errors->first('residing_in_staff_quarter') }}</span>
                                        @endif
                                    </div>
                                </div>



                                <div class="form-group residing_in_staff_quarter" style="display:{{old('residing_in_staff_quarter')=='1'?'':'none'}};">
                                    <label class="col-md-4 control-label">Staff quarter area</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-th"></i></span><input
                                                id="staff_quarter_area" name="staff_quarter_area"
                                                placeholder="Staff quarter area" class="form-control"
                                                value="{{old('staff_quarter_area')}}" type="text" required="true"></div>
                                        @if ($errors->has('staff_quarter_area'))
                                        <span class="text-danger">{{ $errors->first('staff_quarter_area') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group  residing_in_staff_quarter" style="display:{{old('residing_in_staff_quarter')=='1'?'':'none'}};">
                                    <label class="col-md-4 control-label">Staff quarter address</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-home"></i></span><input
                                                id="staff_quarter_address" name="staff_quarter_address"
                                                placeholder="Staff quarter address" class="form-control"
                                                value="{{old('staff_quarter_address')}}" type="text" required="true"></div>
                                        @if ($errors->has('staff_quarter_address'))
                                        <span class="text-danger">{{ $errors->first('staff_quarter_address') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group  residing_in_staff_quarter" style="display:{{old('residing_in_staff_quarter')=='1'?'':'none'}};">
                                    <label class="col-md-4 control-label">Date Of allotment of Staff quarter</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-calendar"></i></span><input
                                                id="date_of_allotment_of_staff_quarter" name="date_of_allotment_of_staff_quarter"
                                                placeholder="Date Of allotment of Staff quarter" class="form-control datepicker" required="true"
                                                value="{{old('date_of_allotment_of_staff_quarter')}}" type="text" autocomplete="off"></div>
                                        @if ($errors->has('date_of_allotment_of_staff_quarter'))
                                        <span
                                            class="text-danger">{{ $errors->first('date_of_allotment_of_staff_quarter') }}</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-4 control-label">Post</label>
                                    <div class="col-md-3 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-th"></i></span><input id="post" name="post"
                                                placeholder="Post" class="form-control" required="true"
                                                value="{{old('post')}}" type="text"></div>
                                        @if ($errors->has('post'))
                                        <span class="text-danger">{{ $errors->first('post') }}</span>
                                        @endif
                                    </div>
                                    <label class="col-md-1 control-label">Class</label>
                                    <div class="col-md-3 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-th"></i></span><input id="class" name="class"
                                                placeholder="Class" class="form-control" required="true"
                                                value="{{old('class')}}" type="text"></div>
                                        @if ($errors->has('class'))
                                        <span class="text-danger">{{ $errors->first('class') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Pay Scale</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-envelope"></i></span><input id="pay_scale"
                                                name="pay_scale" placeholder="Pay Scale" class="form-control"
                                                required="true" value="{{old('pay_scale')}}" type="text"></div>
                                        @if ($errors->has('pay_scale'))
                                        <span class="text-danger">{{ $errors->first('pay_scale') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Income Category Group</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-list-alt"></i></span><input
                                                id="income_category_group" name="income_category_group"
                                                placeholder="Income Category Group" class="form-control" required="true"
                                                value="{{old('income_category_group')}}" type="text"></div>
                                        @if ($errors->has('income_category_group'))
                                        <span class="text-danger">{{ $errors->first('income_category_group') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Date Of Birth</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-calendar"></i></span><input id="dob"
                                                name="dob" placeholder="Date Of Birth" class="form-control datepicker"
                                                required="true" value="{{old('dob')}}" type="text" autocomplete="off">
                                        </div>
                                        @if ($errors->has('dob'))
                                        <span class="text-danger">{{ $errors->first('dob') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Date Of Appointment in MHADA</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-calendar"></i></span><input
                                                id="date_of_appoinment_in_mhada" name="date_of_appoinment_in_mhada"
                                                placeholder="Date Of Appointment in MHADA" class="form-control datepicker" required="true"
                                                value="{{old('date_of_appoinment_in_mhada')}}" type="text" autocomplete="off"></div>
                                        @if ($errors->has('date_of_appoinment_in_mhada'))
                                        <span
                                            class="text-danger">{{ $errors->first('date_of_appoinment_in_mhada') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Whether received any house from MHADA?</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="col-lg-3">
                                        <label> <input type="radio" name="received_house_from_mhada" value="1"
                                                required {{old('received_house_from_mhada')=='1'?'checked':''}} onClick="show_provision();">&nbsp;&nbsp;Yes</label>
                                        </div>
                                        <div class="col-lg-3">
                                        <label> <input type="radio" name="received_house_from_mhada" value="2"
                                                required {{old('received_house_from_mhada')=='2'?'checked':''}} onClick="hide_provision();">&nbsp;&nbsp;No</label>
                                        </div>
                                        @if ($errors->has('received_house_from_mhada'))
                                        <span
                                            class="text-danger">{{ $errors->first('received_house_from_mhada') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group" id="whether_received_any_house_from_mhada" style="display:{{old('received_house_from_mhada')=='1'?'':'none'}};">
                                    <label class="col-md-4 control-label">If yes under which provision</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-inr"></i></span><input
                                                id="under_which_provosion" name="under_which_provosion"
                                                placeholder="If Yes Under Which Provision" class="form-control"
                                                 value="{{old('under_which_provosion')}}" type="text">
                                        </div>
                                        @if ($errors->has('under_which_provosion'))
                                        <span class="text-danger">{{ $errors->first('under_which_provosion') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Do you / your spouse own house?</label>
                                    <div class="col-md-5 inputGroupContainer">
                                            <div class="col-lg-3">
                                        <label> <input type="radio" name="you_or_your_spouse_own_house" value="1"
                                                required {{old('you_or_your_spouse_own_house')=='1'?'checked':''}} onclick="show_name_of_city();">&nbsp;&nbsp;Yes</label></div>
                                                <div class="col-lg-3">
                                        <label> <input type="radio" name="you_or_your_spouse_own_house" value="2"
                                                required {{old('you_or_your_spouse_own_house')=='2'?'checked':''}} onclick="hide_name_of_city();">&nbsp;&nbsp;No</label></div>
                                        @if ($errors->has('you_or_your_spouse_own_house'))
                                        <span
                                            class="text-danger">{{ $errors->first('you_or_your_spouse_own_house') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group" id="you_or_spouse_own_house" style="display:{{old('you_or_your_spouse_own_house')=='1'?'':'none'}};">
                                    <label class="col-md-4 control-label">If yes name of the city</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-inr"></i></span><input
                                                id="if_yes_name_of_the_city" name="if_yes_name_of_the_city"
                                                placeholder="If Yes Name Of The City" class="form-control"
                                                 value="{{old('if_yes_name_of_the_city')}}" type="text">
                                        </div>
                                        @if ($errors->has('if_yes_name_of_the_city'))
                                        <span class="text-danger">{{ $errors->first('if_yes_name_of_the_city') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Do you have requirenment of house by
                                        MHADA?</label>
                                    <div class="col-md-5 inputGroupContainer">
                                            <div class="col-lg-3">
                                        <label> <input type="radio" name="requirement_of_house_by_mhada" value="1"
                                                required {{old('requirement_of_house_by_mhada')=='1'?'checked':''}} onclick="show_preferable_city();">&nbsp;&nbsp;Yes</label></div>
                                                <div class="col-lg-3">
                                        <label> <input type="radio" name="requirement_of_house_by_mhada" value="2"
                                                required {{old('requirement_of_house_by_mhada')=='2'?'checked':''}} onclick="hide_preferable_city();">&nbsp;&nbsp;No</label>
                                                </div>
                                        @if ($errors->has('requirement_of_house_by_mhada'))
                                        <span
                                            class="text-danger">{{ $errors->first('requirement_of_house_by_mhada') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group" id="show_or_hide_preferable_city" style="display:{{old('requirement_of_house_by_mhada')=='1'?'':'none'}};">
                                    <label class="col-md-4 control-label">Preferable city</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <ol class="list-group">
                                            <li class="col-xs-12 list-group-item">
                                                <div class="input-group"><span class="input-group-addon"><i
                                                            class="glyphicon glyphicon-gift"></i></span><input
                                                        id="preferable_city_1" name="preferable_city_1"
                                                        placeholder="City1" class="form-control" required="true"
                                                        value="{{old('preferable_city_1')}}" type="text">
                                                    @if ($errors->has('preferable_city_1'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('preferable_city_1') }}</span>
                                                    @endif
                                                </div>
                                            </li>
                                            <li class="col-xs-12 list-group-item">
                                                <div class="input-group"><span class="input-group-addon"><i
                                                            class="glyphicon glyphicon-gift"></i></span><input
                                                        id="preferable_city_2" name="preferable_city_2"
                                                        placeholder="City2" class="form-control" required="true"
                                                        value="{{old('preferable_city_2')}}" type="text">
                                                    @if ($errors->has('preferable_city_2'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('preferable_city_2') }}</span>
                                                    @endif
                                                </div>
                                            </li>
                                            <li class="col-xs-12 list-group-item">
                                                <div class="input-group"><span class="input-group-addon"><i
                                                            class="glyphicon glyphicon-gift"></i></span><input
                                                        id="preferable_city_3" name="preferable_city_3"
                                                        placeholder="City3" class="form-control" required="true"
                                                        value="{{old('preferable_city_3')}}" type="text">
                                                    @if ($errors->has('preferable_city_3'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('preferable_city_3') }}</span>
                                                    @endif
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="col-md-offset-6 col-md-6">
                                    <input type="submit" class="btn btn-primary " name="submit" value="Submit">
                                </div>
                            </fieldset>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!------ Include the above in your HEAD tag ---------->
</body>
<script>
    $(function(){
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true
    });
});

function show_provision(){
  document.getElementById('whether_received_any_house_from_mhada').style.display ='block';
}
function hide_provision(){
  document.getElementById('whether_received_any_house_from_mhada').style.display = 'none';
}
function show_name_of_city(){
  document.getElementById('you_or_spouse_own_house').style.display ='block';
}
function hide_name_of_city(){
  document.getElementById('you_or_spouse_own_house').style.display = 'none';
}

function show_staff_quarter_details()
{
    document.getElementsByClassName('residing_in_staff_quarter')[0].style.display ='block';
    document.getElementsByClassName('residing_in_staff_quarter')[1].style.display ='block';
    document.getElementsByClassName('residing_in_staff_quarter')[2].style.display ='block';
}

function hide_staff_quarter_details()
{
    document.getElementsByClassName('residing_in_staff_quarter')[0].style.display = 'none';
    document.getElementsByClassName('residing_in_staff_quarter')[1].style.display = 'none';
    document.getElementsByClassName('residing_in_staff_quarter')[2].style.display = 'none';
}

function show_preferable_city()
{
    document.getElementById('show_or_hide_preferable_city').style.display ='block';
}

function hide_preferable_city()
{
    document.getElementById('show_or_hide_preferable_city').style.display = 'none';
}
</script>
</html>
