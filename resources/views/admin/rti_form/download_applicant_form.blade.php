<div class="m-grid m-grid--hor m-grid--root m-page">
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2 light-bg"
    id="m_login" style="position: relative;">

    <div class="m-grid__item m-grid__item--fluid m-login__wrapper rti-app-register-form">
        <div class="m-grid__item m-grid__item--fluid">
            <div class="m-login__container m-login__container--sign-in m-login__container--rounded-fields">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi">
                    <div class="m-login__signin">
                        <div class="m-login__head">
                            <h1 class="m-login__title mb-0 display-4">
                                RTI Application Registration
                            </h1>
                            <p class="sub-title"></p>
                        </div>
                            <p class="text-center">
                                Application for obtaining information under the Right to Information Act, 2005
                            </p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Board</label>
                                        @foreach($boards as $board_value)
                                            @if($application_form_data->board_id==$board_value->id)
                                            <h3>{{$board_value->board_name}}</h3>
                                            @endif
                                         @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Department</label>
                                            @foreach($departments as $department_value)
                                                @if($application_form_data->department_id==$department_value->id)
                                                <h3>{{$department_value->department_name}}</h3>
                                                @endif
                                            @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Full Name</label>
                                        <input class="form-control form-control--custom m-input" type="text"
                                            placeholder="Full Name" value="{{$application_form_data->applicant_name}}" name="name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Address</label>
                                        <textarea class="form-control form-control--custom m-input" name="address"
                                            placeholder="Enter Address">{{$application_form_data->applicant_addr}}</textarea>
                                    </div>
                                </div>
                          
                                <div class="col-sm-12">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Subject matter of information</label>
                                        <input class="form-control form-control--custom m-input" type="text" value="{{  $application_form_data->info_subject}}"
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
                                                placeholder="Select a Date" name="info_period_from" value="{{$application_form_data->info_period_from}}"
                                                autocomplete="off">
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control--custom m-input m_datepicker" type="text"
                                                placeholder="Select a Date" name="info_period_to" value="{{$application_form_data->info_period_to}}"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Description of the information required</label>
                                        <textarea class="form-control form-control--custom form-control--textarea m-input"
                                            type="text" placeholder="Enter Description" name="info_descr" autocomplete="off">{{$application_form_data->info_descr}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group m-form__group check-error">
                                    <label for="" class="col-form-label">Whether information is required by?</label>
                                    <div class="m-radio-inline mt-3 error-wrap">
                                        <label for="rtiInfoRespondRadios1" class="m-radio m-radio--primary">
                                            <input type="radio" id="rtiInfoRespondRadios1" name="info_post_or_person"
                                                value="1" {{ $application_form_data->info_post_or_person=='1'?'checked':''}}>Post
                                            <span></span>
                                        </label>
                                        <label for="rtiInfoRespondRadios2" class="m-radio m-radio--primary">
                                            <input type="radio" id="rtiInfoRespondRadios2" name="info_post_or_person"
                                                value="0" {{ $application_form_data->info_post_or_person=='0'?'checked':''}}>Person
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                
                                @if($application_form_data->info_post_type=='1')
                                <div class="col-sm-12" >
                                    <label class="mb-0">Post Type</label>
                                    <div class="m-radio-inline mt-3 form-group m-form__group error-wrap">
                                        <label class="m-radio m-radio--primary">
                                            <input type="radio" name="info_post_type" id="rtiPostTypeRadios1"
                                                {{ $application_form_data->info_post_type=='1'?'checked':''}} value="1">
                                            Ordinary
                                            <span></span>
                                        </label>
                                        <label class="m-radio m-radio--primary">
                                            <input type="radio" name="info_post_type" id="rtiPostTypeRadios2"
                                                {{ $application_form_data->info_post_type=='2'?'checked':''}} value="2">
                                            Registered
                                            <span></span>
                                        </label>
                                        <label class="m-radio m-radio--primary">
                                            <input type="radio" name="info_post_type" id="rtiPostTypeRadios3"
                                                {{ $application_form_data->info_post_type=='3'?'checked':''}} value="3">
                                            Speed
                                            <span></span>
                                        </label>
                                        <span class="help-block">{{$errors->first('info_post_type')}}</span>
                                    </div>
                                </div>
                                @endif
                                <div class="">
                                    <div class="form-group m-form__group">
                                        <label for="" class="mb-0">Whether the applicant is below poverty line?</label>
                                        <div class="m-radio-inline mt-3 error-wrap">
                                            <label class="m-radio m-radio--primary">
                                                <input class="form-control" type="radio" name="applicant_below_poverty_line"
                                                    value="1"
                                                    {{ $application_form_data->applicant_below_poverty_line=='1'?'checked':''}}>Yes
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--primary">
                                                <input class="form-control" type="radio" name="applicant_below_poverty_line"
                                                    value="0"
                                                    {{ $application_form_data->applicant_below_poverty_line=='0'?'checked':''}}>No
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
                                
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

