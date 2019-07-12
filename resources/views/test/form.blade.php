<html>

<head>
    <title></title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                <h4 class="text-uppercase">Mumbai Housing and Area Development Board</h4>
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
                                                required="true" value="" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Address Permanant</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-home"></i></span><input
                                                id="permanant_address" name="permanant_address"
                                                placeholder="Address Permanant" class="form-control" required="true"
                                                value="" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Address Present</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-home"></i></span><input
                                                id="address_present" name="address_present"
                                                placeholder="Address Present" class="form-control" required="true"
                                                value="" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Residing in Staff quarter</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <label> <input type="radio" name="residing_in_staff_quarter" value="1"
                                                required>Yes</label>
                                        <label> <input type="radio" name="residing_in_staff_quarter" value="2"
                                                required>No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Post</label>
                                    <div class="col-md-3 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="fa fa-id-card"></i></span><input id="post" name="post"
                                                placeholder="Post" class="form-control" required="true" value=""
                                                type="text"></div>
                                    </div>
                                    <label class="col-md-1 control-label">Class</label>
                                    <div class="col-md-3 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="fa fa-id-card"></i></span><input id="class" name="class"
                                                placeholder="Class" class="form-control" required="true" value=""
                                                type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Pay Scale</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-inr"></i></span><input id="pay_scale"
                                                name="pay_scale" placeholder="Pay Scale" class="form-control"
                                                required="true" value="" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Income Category Group</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-inr"></i></span><input
                                                id="income_category_group" name="income_category_group"
                                                placeholder="Income Category Group" class="form-control" required="true"
                                                value="" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Date Of Birth</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-inr"></i></span><input id="dob"
                                                name="dob" placeholder="Date Of Birth" class="form-control"
                                                required="true" value="" type="date"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Date Of Appointment in MHADA</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-inr"></i></span><input
                                                id="date_of_appoinment_in_mhada" name="date_of_appoinment_in_mhada"
                                                placeholder="Income Category Group" class="form-control" required="true"
                                                value="" type="date"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Whether received any house from MHADA</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <label> <input type="radio" name="received_house_from_mhada" value="1"
                                                required>Yes</label>
                                        <label> <input type="radio" name="received_house_from_mhada" value="2"
                                                required>No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">If yes under which provision</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-inr"></i></span><input
                                                id="under_which_provosion" name="under_which_provosion"
                                                placeholder="If Yes Under Which Provision" class="form-control"
                                                required="true" value="" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Do you / your spouse own house Y/N</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <label> <input type="radio" name="you_or_your_spouse_own_house" value="1"
                                                required>Yes</label>
                                        <label> <input type="radio" name="you_or_your_spouse_own_house" value="2"
                                                required>No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">If yes name of the city</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-inr"></i></span><input
                                                id="if_yes_name_of_the_city" name="if_yes_name_of_the_city"
                                                placeholder="If Yes Name Of The City" class="form-control"
                                                required="true" value="" type="text"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Do you have requirenment of house by
                                        MHADA</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <label> <input type="radio" name="requirement_of_house_by_mhada" value="1"
                                                required>Yes</label>
                                        <label> <input type="radio" name="requirement_of_house_by_mhada" value="2"
                                                required>No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Preferable city</label>
                                    <div class="col-md-5 inputGroupContainer">
                                        <ol>
                                            <li>
                                                <div class="input-group"><span class="input-group-addon"><i
                                                            class="glyphicon glyphicon-inr"></i></span><input
                                                        id="preferable_city_1" name="preferable_city_1"
                                                        placeholder="City1" class="form-control" required="true"
                                                        value="" type="text"></div>
                                            </li>
                                            <li>
                                                <div class="input-group"><span class="input-group-addon"><i
                                                            class="glyphicon glyphicon-inr"></i></span><input
                                                        id="preferable_city_2" name="preferable_city_2"
                                                        placeholder="City2" class="form-control" required="true"
                                                        value="" type="text"></div>
                                            </li>
                                            <li>
                                                <div class="input-group"><span class="input-group-addon"><i
                                                            class="glyphicon glyphicon-inr"></i></span><input
                                                        id="preferable_city_3" name="preferable_city_3"
                                                        placeholder="City3" class="form-control" required="true"
                                                        value="" type="text"></div>
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

</html>
