@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.rti_form.actions',compact('rti_applicant'))
@endsection
@section('content')
<div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">View Application</h3>
            {{ Breadcrumbs::render('view_applicant',$rti_applicant->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
</div>
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
                                            <option value="">Select Board</option>
                                            @foreach($boards as $board_value)
                                            <option {{$rti_applicant->board_id==$board_value->id?'selected':''}} value="{{ $board_value->id }}">{{
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
                                            <option value="">Select Department</option>
                                            @foreach($departments as $department_value)
                                            <option {{$rti_applicant->department_id==$department_value->id?'selected':''}} value="{{ $department_value->id }}">{{
                                                $department_value->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Full Name</label>
                                        <input class="form-control form-control--custom m-input" type="text"
                                            placeholder="Full Name" value="{{$rti_applicant->applicant_name}}" name="name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Address</label>
                                        <textarea disabled class="form-control form-control--custom m-input" name="address"
                                            placeholder="Enter Address">{{$rti_applicant->applicant_addr}}</textarea>
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
                                        <input class="form-control form-control--custom m-input" type="text" value="{{$rti_applicant->info_subject}}"
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
                                                placeholder="Select a Date From" name="info_period_from" value="{{date('d-m-Y',strtotime($rti_applicant->info_period_from))}}"
                                                autocomplete="off">
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control--custom m-input m_datepicker" type="text"
                                                placeholder="Select a Date To" name="info_period_to" value="{{date('d-m-Y',strtotime($rti_applicant->info_period_to))}}"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group m-form__group">
                                        <label for="" class="col-form-label">Description of the information required</label>
                                        <textarea disabled class="form-control form-control--custom form-control--textarea m-input"
                                            type="text" placeholder="Enter Description" name="info_descr" autocomplete="off">{{$rti_applicant->info_descr}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group m-form__group check-error">
                                    <label for="" class="col-form-label">Whether information is required by?</label>
                                    <div class="m-radio-inline mt-3 error-wrap">
                                        <label for="rtiInfoRespondRadios1" class="m-radio m-radio--primary">
                                            <input type="radio" id="rtiInfoRespondRadios1" name="info_post_or_person"
                                                value="1" {{ $rti_applicant->info_post_or_person=='1'?'checked':''}}>Post
                                            <span></span>
                                        </label>
                                        <label for="rtiInfoRespondRadios2" class="m-radio m-radio--primary">
                                            <input type="radio" id="rtiInfoRespondRadios2" name="info_post_or_person"
                                                value="0" {{ $rti_applicant->info_post_or_person=='0'?'checked':''}}>Person
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12" id="infoPostTypeFormgroup" style="display:{{ $rti_applicant->info_post_or_person!=""?($rti_applicant->info_post_or_person=='1'?'block':'none'):'none'}};">
                                    <label class="mb-0">Post Type</label>
                                    <div class="m-radio-inline mt-3 form-group m-form__group error-wrap">
                                        <label class="m-radio m-radio--primary">
                                            <input type="radio" name="info_post_type" id="rtiPostTypeRadios1"
                                                {{ $rti_applicant->info_post_type=='1'?'checked':''}} value="1">
                                            Ordinary
                                            <span></span>
                                        </label>
                                        <label class="m-radio m-radio--primary">
                                            <input type="radio" name="info_post_type" id="rtiPostTypeRadios2"
                                                {{ $rti_applicant->info_post_type=='2'?'checked':''}} value="2">
                                            Registered
                                            <span></span>
                                        </label>
                                        <label class="m-radio m-radio--primary">
                                            <input type="radio" name="info_post_type" id="rtiPostTypeRadios3"
                                                {{ $rti_applicant->info_post_type=='3'?'checked':''}} value="3">
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
                                                    {{ $rti_applicant->applicant_below_poverty_line=='1'?'checked':''}}>Yes
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--primary">
                                                <input class="form-control" type="radio" name="applicant_below_poverty_line"
                                                    value="0"
                                                    {{ $rti_applicant->applicant_below_poverty_line=='0'?'checked':''}}>No
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group m-form__group custom-file" id="povertyLineProofFile" style="display:{{ $rti_applicant->applicant_below_poverty_line!=""?($rti_applicant->applicant_below_poverty_line=='1'?'block':'none'):'none'}};">
                                        <input type="file" id="poverty-file" class="custom-file-input" name="poverty_line_proof_file">
                                        <label class="custom-file-label" for="poverty-file">Choose file ...</label>
                                        <span class="text-danger">{{$errors->first('poverty_line_proof_file')}}</span>
                                    <a class="btn btn-link" href="{{config('commanConfig.storage_server').'/'.$rti_applicant->poverty_line_proof}}">download</a>
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
        $("input").filter(
            function (index, item) {
                if (item.name !== 'app_id' && item.name !== '_token') {
                    item.setAttribute("disabled", true);
                }
            });
        $("select").filter(
            function (index, item) {
                if (item.name !== 'app_id' && item.name !== '_token') {
                    item.setAttribute("disabled", true);
                }
            });

    </script>
    @endsection