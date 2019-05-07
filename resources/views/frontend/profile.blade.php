@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title{{----separator--}}">Profile</h3>
                {{ Breadcrumbs::render('admin_profile') }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
            <p class="sub-title">
                @if (session('success'))
                    <div class="alert alert-success profile_updated">
                        <div class="text-center">{{ session('success') }}</div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger profile_updated">
                        <div class="text-center danger">{{ session('error') }}</div>
                    </div>
                @endif
            </p>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
            <form id="update_profile" role="form" method="post" class="m-form m-form--rows m-form--label-align-right floating-labels-form" action=" @if(session()->all(['role_name']) == config('commanConfig.society_offer_letter')) {{ route('society.update_profile') }} @else {{ route('admin.update_profile') }} @endif " enctype="multipart/form-data">
                @csrf
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-3 form-group">
                            <label class="col-form-label" for="name">Society Name:
                            </label>
                            <input type="text" id="name" name="name" class="form-control form-control--custom m-input" value="" readonly>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="col-sm-3 offset-sm-1 form-group">
                            <label class="col-form-label" for="building_no">Society Building No:</label>
                            <textarea id="building_no" name="building_no" class="form-control form-control--custom form-control--fixed-height m-input" readonly></textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                        <div class="col-sm-3 offset-sm-1 form-group">
                            <label class="col-form-label" for="society_wing_no">Society Wing No:</label>
                            <textarea id="society_wing_no" name="society_wing_no" class="form-control form-control--custom form-control--fixed-height m-input" readonly></textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-3 form-group">
                            <label class="col-form-label" for="contact_no">Society Contact No:
                            </label>
                            <input type="text" id="contact_no" name="contact_no" class="form-control form-control--custom m-input" value="" readonly>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="col-sm-3 offset-sm-1 form-group">
                            <label class="col-form-label" for="email">Society Email:</label>
                            <textarea id="email" name="email" class="form-control form-control--custom form-control--fixed-height m-input" readonly></textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                        <div class="col-sm-3 offset-sm-1 form-group">
                            <label class="col-form-label" for="registration_no">Society Registration No:</label>
                            <textarea id="registration_no" name="registration_no" class="form-control form-control--custom form-control--fixed-height m-input" readonly></textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-7 form-group">
                            <label class="col-form-label" for="address">Society Address:
                            </label>
                            <input type="text" id="address" name="address" class="form-control form-control--custom m-input" value="" readonly>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-3 form-group">
                            <label class="col-form-label" for="chairman_name">Chairman Name:
                            </label>
                            <input type="text" id="chairman_name" name="chairman_name" class="form-control form-control--custom m-input" value="" readonly>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="col-sm-3 offset-sm-1 form-group">
                            <label class="col-form-label" for="secretary_name">Secretary Name:</label>
                            <textarea id="secretary_name" name="secretary_name" class="form-control form-control--custom form-control--fixed-height m-input" readonly></textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                        <div class="col-sm-3 offset-sm-1 form-group">
                            <label class="col-form-label" for="name_of_architect">Architect/ Licence Surveyor Name:</label>
                            <textarea id="name_of_architect" name="name_of_architect" class="form-control form-control--custom form-control--fixed-height m-input" readonly></textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-3 form-group">
                            <label class="col-form-label" for="architect_mobile_no">Architect Mobile Number:
                            </label>
                            <input type="text" id="architect_mobile_no" name="architect_mobile_no" class="form-control form-control--custom m-input" value="" readonly>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="col-sm-3 offset-sm-1 form-group">
                            <label class="col-form-label" for="architect_address">Architect Address:</label>
                            <textarea id="architect_address" name="architect_address" class="form-control form-control--custom form-control--fixed-height m-input" readonly></textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-3 form-group">
                            <label class="col-form-label" for="password">Password:
                            </label>
                            <input type="text" id="password" name="password" class="form-control form-control--custom m-input" value="" readonly>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="col-sm-3 offset-sm-1 form-group">
                            <label class="col-form-label" for="confirm_psssword">Confirm Password:</label>
                            <textarea id="confirm_psssword" name="confirm_psssword" class="form-control form-control--custom form-control--fixed-height m-input" readonly></textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <a href="{{ route('society_offer_letter_dashboard') }}" class="btn btn-secondary">Cancel</a>
                                        <button type="submit"  class="btn btn-primary">Update</button>
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
        $('input[name=email]').keyup(function(){
            var society_email = $('input[name=email]').val();
            var url = "{{ route('society.update_profile') }}";

            if(society_email != null && society_email.length > 2){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('society.update_profile') }}',
                    method: 'post',
                    data: {
                        society_email: society_email,
                        is_email_check: '1'
                    },
                    success: function(res){
                        if(res.society_email != undefined){
                            $('#email-error').text(res.society_email[0]).css('color', 'red');
                        }else{
                            $('#email-error').text('');
                        }
                    }
                });
            }
        });

        $('#update_profile').validate({
            rules:{
                name:{
                    required: true
                },
                email:{
                    required: true,
                    email: true
                },
                mobile_no: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10,
                },
                new_password: {
                    // required: true,
                    minlength:6,
                    maxlength:10
                },
                confirm_password: {
                    // required: true,
                    minlength:6,
                    maxlength:10,
                    equalTo: "#new_password",
                }
            },
            messages: {
                confirm_password:{
                    equalTo:"Password doesn't match."
                },
                mobile_no:{
                    number: 'Enter only Numeric Value',
                    minlength: 'Enter Only 10 Characters',
                    maxlength: 'Enter Only 10 Characters'
                }
            }
        });

        $(document).ready(function(){
            $('.profile_updated').delay("slow").slideUp("slow");
        });

    </script>
@endsection
