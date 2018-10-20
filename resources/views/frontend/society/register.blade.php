@extends('frontend.rti.login')
@section('body')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login--singin" id="m_login" style="position: relative;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5 overlay overlay--signup h-100vh d-flex justify-content-center">
                <div class="mt-3">
                    <a href="{{ url('/') }}"></a>
                    <img src="{{ asset('/img/logo-short.png')}}">
                    </a>
                </div>
                <div class="m-login__head m-login__head--signup align-self-center">
                    <h1 class="m-login__title mb-0 text-white">
                        MUMBAI HOUSING AND AREA DEVELOPMENT BOARD
                    </h1>
                </div>
            </div>
            <!-- {{ $errors }} -->
            <div class="col-sm-7 d-flex light-bg">
                <div class="m-grid__item m-grid__item--fluid m-login__wrapper align-items-center signup-wrapper">
                    <div class="m-login__container h-100 d-flex align-items-center">
                        <div class="align-items-center">
                            <h3 class="block-title">Society Registration</h3>
                            <div class="m-portlet mb-0">
                                <div class="d-block">
                                    <form class='m-login__form m-form m-login__signup' id='sign_up_form_society_offer_letter'
                                        action="{{ route('society_offer_letter.store') }}" method="post">
                                        @csrf

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group @if($errors->has('society_name')) has-error @endif">
                                                    <!-- <label for="" class="col-form-label">First Name</label> -->
                                                    <input class="form-control form-control--custom m-input" type="text"
                                                        placeholder="Society Name" name="society_name" value="{{ old('society_name') }}">
                                                    <span class="text-danger">{{$errors->first('society_name')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group @if($errors->has('society_contact_no')) has-error @endif">
                                                    <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                                                    <input class="form-control form-control--custom m-input" type="text"
                                                        placeholder="Society Contact No" name="society_contact_no"
                                                        value="{{ old('society_contact_no') }}">
                                                    <span class="help-block">{{$errors->first('society_contact_no')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group @if($errors->has('society_building_no')) has-error @endif">
                                                    <!-- <label for="" class="col-form-label">Email Address</label> -->
                                                    <input class="form-control form-control--custom m-input" type="text"
                                                        placeholder="Society Building No" name="society_building_no"
                                                        value="{{ old('society_building_no') }}">
                                                    <span id="society_building_no" class="text-danger">{{$errors->first('society_building_no')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group @if($errors->has('society_registration_no')) has-error @endif">
                                                    <!-- <label for="" class="col-form-label">Mobile No</label> -->
                                                    <input class="form-control form-control--custom m-input" type="text"
                                                        placeholder="Society Registration No" name="society_registration_no"
                                                        value="{{ old('society_registration_no') }}">
                                                    <span id="society_registration_no" class="text-danger">{{$errors->first('society_registration_no')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group m-form__group @if($errors->has('society_address')) has-error @endif">
                                                    <!-- <label for="" class="col-form-label">Last Name</label> -->
                                                    <textarea class="form-control form-control--custom form-control--fixed-height m-input"
                                                        placeholder="Society Address" name="society_address" value="{{ old('society_address') }}"></textarea>
                                                    <span class="text-danger">{{$errors->first('society_address')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group @if($errors->has('society_architect_name')) has-error @endif">
                                                    <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                                                    <input class="form-control form-control--custom m-input" type="text"
                                                        placeholder="Architect Name" name="society_architect_name"
                                                        value="{{ old('society_architect_name') }}">
                                                    <span class="help-block">{{$errors->first('society_architect_name')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group @if($errors->has('society_email')) has-error @endif">
                                                    <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                                                    <input class="form-control form-control--custom m-input" type="email"
                                                        placeholder="Email Address" name="society_email" value="{{ old('society_email') }}">
                                                    <span id="society_email" class="text-danger">{{$errors->first('society_email')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group @if($errors->has('society_architect_mobile_no')) has-error @endif">
                                                    <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                                                    <input class="form-control form-control--custom m-input" type="text"
                                                        placeholder="Architect Mobile Number" name="society_architect_mobile_no"
                                                        value="{{ old('society_architect_mobile_no') }}">
                                                    <span class="text-danger">{{$errors->first('society_architect_mobile_no')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group @if($errors->has('optional_society_email')) has-error @endif">
                                                    <!-- <label for="" class="col-form-label">Confirm Password</label> -->
                                                    <input class="form-control form-control--custom m-input" type="email"
                                                        placeholder="Optional Email Address" name="optional_society_email"
                                                        value="{{ old('society_email') }}">
                                                    <span id="optional_society_email" class="text-danger">{{$errors->first('optional_society_email')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group m-form__group @if($errors->has('society_architect_address')) has-error @endif">
                                                    <!-- <label for="" class="col-form-label">Password</label> -->
                                                    <textarea class="form-control form-control--custom form-control--fixed-height m-input"
                                                        placeholder="Architect Address" name="society_architect_address"
                                                        value="{{ old('society_architect_address') }}"></textarea>
                                                    <span class="text-danger">{{$errors->first('society_architect_address')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group @if($errors->has('society_password')) has-error @endif">
                                                    <!-- <label for="" class="col-form-label">Password</label> -->
                                                    <input class="form-control form-control--custom m-input" type="password"
                                                        placeholder="Password" name="society_password" id="password"
                                                        value="{{ old('society_password') }}" title="">
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Password should be minimum 6 & maximum 10 characters."><i class="fa fa-info-circle" style="color: orange;float: right;"></i></a>
                                                    <span class="help-block">{{$errors->first('society_password')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group @if($errors->has('conf_society_password')) has-error @endif">
                                                    <!-- <label for="" class="col-form-label">Password</label> -->
                                                    <input class="form-control form-control--custom m-input" type="password"
                                                        placeholder="Confirm Password" name="conf_society_password"
                                                        value="{{ old('conf_society_password') }}" title="">
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Password should be minimum 6 & maximum 10 characters."><i class="fa fa-info-circle" style="color: orange;float: right;"></i></a>
                                                    <span class="help-block">{{$errors->first('conf_society_password')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-login__form-action d-flex justify-content-center">
                                            <button id="m_login_signup_submit_society_offer_letter" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-login__btn">
                                                Sign Up
                                            </button>
                                            &nbsp;&nbsp;
                                            <a href="{{ route('society_offer_letter.index') }}" id="" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-login__btn">
                                                <!-- <i class="la la-close"></i> -->Cancel
                                            </a>
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
@endsection
@section('js')
    <script>
        $('input[name=society_email]').keyup(function(){
            var society_email = $('input[name=society_email]').val();
            var url = "{{ route('society_offer_letter.store') }}";
            if(society_email != null){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('society_offer_letter.store') }}',
                    method: 'post',
                    data: {
                        society_email: society_email
                    },
                    success: function(res){
                        if(res.society_email != undefined){
                            $('#society_email').text(res.society_email[0]);
                        }
                    }
                });
            }
        });
        $('input[name=optional_society_email]').keyup(function(){
            var optional_society_email = $('input[name=optional_society_email]').val();
            var url = "{{ route('society_offer_letter.store') }}";
            if(optional_society_email != null){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('society_offer_letter.store') }}',
                    method: 'post',
                    data: {
                        optional_society_email: optional_society_email
                    },
                    success: function(res){
                        if(res.optional_society_email != undefined){
                            $('#optional_society_email').text(res.optional_society_email[0]);
                        }
                    }
                });
            }
        });
        // $('input[name=society_registration_no]').keyup(function(){
        //     var society_registration_no = $('input[name=society_registration_no]').val();
        //     if(society_registration_no.match(',|-|/') == null){
        //         $('#society_registration_no').text('Society registration no. is in incorrect format.');
        //     }else{
        //         $('#society_registration_no').text('');
        //     }
        // });
    </script>
@endsection
