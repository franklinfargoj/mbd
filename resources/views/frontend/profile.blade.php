@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title{{----separator--}}">Profile</h3>
                {{--                {{ Breadcrumbs::render('society_offer_application_create', $id) }}--}}
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
            <form id="update_profile" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action=" @if(session()->all(['role_name']) == config('commanConfig.society_offer_letter')) {{ route('society.update_profile') }} @else {{ route('admin.update_profile') }} @endif " enctype="multipart/form-data">
                @csrf
                <div class="m-portlet__body m-portlet__body--spaced">
                    @for($i=0; $i < count($field_names); $i++)
                        @if($i != 0) @php $i++; @endphp @endif
                        <div class="form-group m-form__group row">
                            @if(isset($field_names[$i]))
                            @if($field_names[$i] == 'password' || $field_names[$i] == 'confirm_password') @php if($field_names[$i] == 'password'){ $field_names[$i] = 'new_password'; } $type = 'password'; $value = ''; @endphp @else @php $type = 'text'; @endphp @endif
                                @if($field_names[$i] == 'id') @php $value = encrypt($users->id); $type = 'hidden'; @endphp @php echo $comm_func->form_fields($field_names[$i], $type, '', '', $value, '', 'required') @endphp @endif
                                @if($field_names[$i] == 'name') @php $value = $users->name; @endphp @endif
                                @if($field_names[$i] == 'email') @php $value = $users->email; @endphp @endif
                                @if($field_names[$i] == 'mobile_no') @php $value = $users->mobile_no; @endphp @endif
                                @if($type != 'hidden')
                                    <div class="col-sm-4 form-group">
                                        <label class="col-form-label" for="{{ $field_names[$i] }}">@php $labels = implode(' ', explode('_', $field_names[$i])); echo ucwords($labels); @endphp:</label>
                                        @if($field_names[$i] != 'email') @php echo $comm_func->form_fields($field_names[$i], $type, '', '', $value, '') @endphp @else @php echo $value; @endphp @endif
                                        <span class="help-block" id="{{ $field_names[$i] }}-error">{{$errors->first($field_names[$i])}}</span>
                                    </div>
                                @endif
                            @endif
                            @if(isset($field_names[$i+1]))
                                @if($field_names[$i+1] == 'password' || $field_names[$i+1] == 'confirm_password') @php if($field_names[$i+1] == 'password'){ $field_names[$i+1] = 'new_password'; } $type_1 = 'password'; $value_1 = ''; @endphp @else @php $type_1 = 'text'; @endphp @endif
                                    @if($field_names[$i+1] == 'id') @php $value_1 = encrypt($users->id); $type_1 = 'hidden'; @endphp @php echo $comm_func->form_fields($field_names[$i+1], $type_1, '', '', $value_1, '', 'required') @endphp @endif
                                    @if($field_names[$i+1] == 'name') @php $value_1 = $users->name; @endphp @endif
                                    @if($field_names[$i+1] == 'email') @php $value_1 = $users->email; @endphp @endif
                                    @if($field_names[$i+1] == 'mobile_no') @php $value_1 = $users->mobile_no; @endphp @endif
                                    @if($type_1 != 'hidden')
                                        <div class="col-sm-4 offset-sm-1 form-group">
                                            <label class="col-form-label" for="{{ $field_names[$i+1] }}">@php $labels = implode(' ', explode('_', $field_names[$i+1])); echo ucwords($labels); @endphp:</label>
                                            @if($field_names[$i+1] != 'email') @php echo $comm_func->form_fields($field_names[$i+1], $type_1, '', '', $value_1, '') @endphp @else <p> <b> @php echo $value_1; @endphp </b> </p> @endif
                                            <input type="hidden" name="id" value="{{ encrypt($users->id) }}">
                                            <span class="help-block" id="{{ $field_names[$i+1] }}-error">{{$errors->first($field_names[$i+1])}}</span>
                                        </div>
                                    @endif
                            @endif
                            @php $type = ''; @endphp
                        </div>
                    @endfor

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        {{--<a href=" @if(session()->all()['role_name'] == config('commanConfig.society_offer_letter')) {{ route('society_offer_letter_dashboard') }} @else {{ route('society_offer_letter_dashboard') }} @endif " class="btn btn-secondary">Cancel</a>--}}
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
