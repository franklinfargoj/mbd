@extends('frontend.rti.login')
@section('body')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2 light-bg"
    id="m_login" style="position: relative;">
    <div class="m-login__logo m-login__logo--header transparent-bg no-shadow text-center">
          <a href="{{ url('/') }}"></a>
          <img src="{{asset('assets/app/media/img/logos/mhada-logo.png')}}" width="550">
          </a>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
        <div class="m-grid__item m-grid__item--fluid">
            <div class="m-login__container m-login__container--sign-in">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi">
                    <div class="m-login__signin">
                        <div class="m-login__head">
                            <h1 class="m-login__title mb-0 display-4">
                                RTI Application Registration
                            </h1>
                            <p class="sub-title"></p>
                        </div>
                        <form class="m-login__form m-form" id="rti_application_form" method="post" action="{{route('rti_frontend_application')}}">
                            @csrf
                            <p class="text-center">
                            Application for obtaining information under the Right to Information Act, 2005
                            </p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Board</label>
                                        <input class="form-control m-input" type="hidden" name="user_id" value="{{ $id }}">
                                        <select class="form-control form-control--custom m-bootstrap-select m_selectpicker m-input" name="board_id">
                                            <option value="0">Select Board</option>
                                            @foreach($boards as $board_value)
                                            <option value="{{ $board_value->id }}">{{ $board_value->board_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Department</label>
                                        <select class="form-control form-control--custom m-bootstrap-select m_selectpicker m-input" name="department_id">
                                            <option value="0">Select Department</option>
                                            @foreach($departments as $department_value)
                                            <option value="{{ $department_value->id }}">{{
                                                $department_value->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Full Name</label>
                                        <input class="form-control m-input" type="text" placeholder="Full Name" name="name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Address</label>
                                        <textarea class="form-control m-input" name="address" placeholder="Enter Address"></textarea>
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
                                        <input class="form-control m-input" type="text" placeholder="Enter Subject" name="info_subject">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">The period to which the information relates</label>
                                        <div class="d-flex">
                                        <input class="form-control form-control--custom m-input m_datepicker" type="text" placeholder="Select a Date" name="info_period_from"
                                            autocomplete="off">
                                        <input class="form-control form-control--custom m-input m_datepicker" style="margin-left: 30px;" type="text" placeholder="Select a Date" name="info_period_to"
                                            autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Description of the information required</label>
                                        <input class="form-control m-input" type="text" placeholder="Enter Description"
                                            name="info_descr" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group m-form__group">
                                  <label for="" class="col-form-label">Whether information is required by?</label>
                                  <div class="m-radio-inline mt-3">
                                    <label for="rtiInfoRespondRadios1" class="m-radio m-radio--primary">
                                      <input type="radio" id="rtiInfoRespondRadios1" name="info_post_or_person"
                                          value="1">Post
                                          <span></span>
                                    </label>
                                    <label for="rtiInfoRespondRadios2" class="m-radio m-radio--primary">
                                      <input type="radio" id="rtiInfoRespondRadios2" name="info_post_or_person"
                                          value="0">Person
                                          <span></span>
                                    </label>
                                  </div>
                                </div>
                                <div class="col-sm-12" id="infoPostTypeFormgroup" style="display:none;">
                                    <label class="mb-0">Post Type</label>
                                    <div class="m-radio-inline mt-3 form-group m-form__group">
                                        <label class="m-radio m-radio--primary">
                                            <input type="radio" name="info_post_type" id="rtiPostTypeRadios1" value="1">
                                            Ordinary
                                            <span></span>
                                        </label>
                                        <label class="m-radio m-radio--primary">
                                            <input type="radio" name="info_post_type" id="rtiPostTypeRadios2" value="2">
                                            Registered
                                            <span></span>
                                        </label>
                                        <label class="m-radio m-radio--primary">
                                            <input type="radio" name="info_post_type" id="rtiPostTypeRadios3" value="3">
                                            Speed
                                            <span></span>
                                        </label>
                                        <span class="help-block">{{$errors->first('info_post_type')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group m-form__group">
                                    <label for="" class="mb-0">Whether the applicant is below poverty line?</label>
                                    <div class="m-radio-inline mt-3">
                                        <label class="m-radio m-radio--primary">
                                        <input class="form-control" type="radio" name="applicant_below_poverty_line" value="1">Yes
                                        <span></span>
                                        </label>
                                        <label class="m-radio m-radio--primary">
                                        <input class="form-control" type="radio" name="applicant_below_poverty_line" value="0">No
                                        <span></span>
                                        </label>     
                                    </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                <div class="form-group m-form__group custom-file" id="povertyLineProofFile" style="display:none;">
                                    <input type="file" id="poverty-file" class="custom-file-input" name="poverty_line_proof_file">
                                    <label class="custom-file-label" for="poverty-file">Choose file ...</label>
                                    <span class="help-block">{{$errors->first('poverty_line_proof')}}</span>
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
