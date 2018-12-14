@extends('frontend.rti.login')
@section('body')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2 no-radius-form light-bg"
    id="m_login" style="position: relative;">
    <div class="m-login__logo m-login__logo--header transparent-bg no-shadow text-center">
        <a href="{{ url('/') }}"></a>
        <img src="{{asset('assets/app/media/img/logos/mhada-logo.png')}}" width="550">
        </a>
    </div>

    <div class="m-grid__item m-grid__item--fluid m-login__wrapper rti-app-register-form">
        <div class="m-grid__item m-grid__item--fluid">
            <div class="m-login__container m-login__container--sign-in m-login__container--rounded-fields">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled d-flex align-items-center justify-content-center mb-0">
                        @foreach ($errors->all() as $error)
                        <li>Error: {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi">
                    <div class="m-login__signin">
                        <div class="m-login__head">
                            <h1 class="m-login__title mb-0 display-4">
                                RTI Registration
                            </h1>
                            <p class="sub-title"></p>
                        </div>
                        <form class="m-login__form m-form" id="rti_application_form" method="post" action="{{route('rti_frontend_application')}}" enctype="multipart/form-data">
                            @csrf
                            {{--<p class="text-center">--}}
                                {{--Application for obtaining information under the Right to Information Act, 2005--}}
                            {{--</p>--}}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Board</label>
                                        <input class="form-control m-input" type="hidden" name="user_id" value="{{ $id }}">
                                        <select class="form-control form-control--custom m-bootstrap-select m_selectpicker m-input"
                                            name="board_id">
                                            <option value="0">Select Board</option>
                                            @foreach($boards as $board_value)
                                            <option {{old('board_id')==$board_value->id?'selected':''}} value="{{ $board_value->id }}">{{
                                                $board_value->board_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Department</label>
                                        <select class="form-control form-control--custom m-bootstrap-select m_selectpicker m-input"
                                            name="department_id">
                                            <option value="0">Select Department</option>
                                            @foreach($departments as $department_value)
                                            <option {{old('department_id')==$department_value->id?'selected':''}} value="{{ $department_value->id }}">{{
                                                $department_value->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Full Name</label>
                                        <input class="form-control form-control--custom m-input" type="text"
                                            placeholder="Full Name" value="{{old('name')}}" name="name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Address</label>
                                        <textarea class="form-control form-control--custom m-input" name="address"
                                            placeholder="Enter Address">{{old('address')}}</textarea>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-6">
                        <div class="form-group m-form__group">
                            <label for="" class="col-form-label">Particulars of information required</label>
                        </div>
                        </div> -->
                                <div class="col-sm-12">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Subject matter of information</label>
                                        <input class="form-control form-control--custom m-input" type="text" value="{{old('info_subject')}}"
                                            placeholder="Enter Subject" name="info_subject">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group m-form__group row" style="margin-left: -15px; margin-right: -15px;">
                                        <div class="col-sm-12">
                                            <label for="" class="col-form-label">The period to which the information
                                                relates</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control--custom m-input m_datepicker" type="text"
                                                placeholder="Select a Date From" name="info_period_from" value="{{old('info_period_from')}}"
                                                autocomplete="off">
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control--custom m-input m_datepicker" type="text"
                                                placeholder="Select a Date To" name="info_period_to" value="{{old('info_period_to')}}"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Description of the information required</label>
                                        <textarea class="form-control form-control--custom form-control--textarea m-input"
                                            type="text" placeholder="Enter Description" name="info_descr" autocomplete="off">{{old('info_descr')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group m-form__group check-error">
                                    <label for="" class="col-form-label">Whether information is required by?</label>
                                    <div class="m-radio-inline mt-3 error-wrap">
                                        <label for="rtiInfoRespondRadios1" class="m-radio m-radio--primary">
                                            <input type="radio" id="rtiInfoRespondRadios1" name="info_post_or_person"
                                                value="1" {{ old('info_post_or_person')=='1'?'checked':''}}>Post
                                            <span></span>
                                        </label>
                                        <label for="rtiInfoRespondRadios2" class="m-radio m-radio--primary">
                                            <input type="radio" id="rtiInfoRespondRadios2" name="info_post_or_person"
                                                value="0" {{ old('info_post_or_person')=='0'?'checked':''}}>Person
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12" id="infoPostTypeFormgroup" style="display:{{ old('info_post_type')!=""?(old('info_post_type')=='1'?'block':'none'):'none'}};">
                                    <label class="mb-0">Post Type</label>
                                    <div class="m-radio-inline mt-3 form-group m-form__group error-wrap">
                                        <label class="m-radio m-radio--primary">
                                            <input type="radio" name="info_post_type" id="rtiPostTypeRadios1"
                                                {{ old('info_post_type')=='1'?'checked':''}} value="1">
                                            Ordinary
                                            <span></span>
                                        </label>
                                        <label class="m-radio m-radio--primary">
                                            <input type="radio" name="info_post_type" id="rtiPostTypeRadios2"
                                                {{ old('info_post_type')=='2'?'checked':''}} value="2">
                                            Registered
                                            <span></span>
                                        </label>
                                        <label class="m-radio m-radio--primary">
                                            <input type="radio" name="info_post_type" id="rtiPostTypeRadios3"
                                                {{ old('info_post_type')=='3'?'checked':''}} value="3">
                                            Speed
                                            <span></span>
                                        </label>
                                        <span class="help-block">{{$errors->first('info_post_type')}}</span>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group m-form__group">
                                        <label for="" class="mb-0">Whether the applicant is below poverty line?</label>
                                        <div class="m-radio-inline mt-3 error-wrap">
                                            <label class="m-radio m-radio--primary">
                                                <input class="form-control" type="radio" name="applicant_below_poverty_line"
                                                    value="1"
                                                    {{ old('applicant_below_poverty_line')=='1'?'checked':''}}>Yes
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--primary">
                                                <input class="form-control" type="radio" name="applicant_below_poverty_line"
                                                    value="0"
                                                    {{ old('applicant_below_poverty_line')=='0'?'checked':''}}>No
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group m-form__group custom-file" id="povertyLineProofFile" style="display:{{ old('applicant_below_poverty_line')!=""?(old('applicant_below_poverty_line')=='1'?'block':'none'):'none'}};">
                                        <input type="file" id="poverty-file" class="custom-file-input" name="poverty_line_proof_file">
                                        <label class="custom-file-label" for="poverty-file">Choose file ...</label>
                                        <span class="text-danger">{{$errors->first('poverty_line_proof_file')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="m-login__form-action mt-4 mb-4">
                                        <button id="m_login_signin_submit_rti_application" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primary">
                                            Register
                                        </button>
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
@endsection
