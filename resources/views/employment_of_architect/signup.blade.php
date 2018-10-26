@extends('frontend.rti.login')
@section('body')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login--singin" style="position: relative;">
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
            <div class="col-sm-7 d-flex light-bg">
                <div class="m-grid__item m-grid__item--fluid m-login__wrapper align-items-center signup-wrapper">
                    <div class="m-login__container h-100 d-flex align-items-center">
                        <div class="align-items-center">
                            <h3 class="block-title">Appointing Architect</h3>
                            <div class="m-portlet mb-0">
                                <div class="d-block">
                                    <form method="post" class="m-login__form m-form m-login__signup" action="{{route('appointing_architect.post_signup')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group">
                                                    <input class="form-control form-control--custom m-input" type="text"
                                                        name="name" value="{{old('name')}}" placeholder="Name">
                                                    @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group">
                                                    <input class="form-control form-control--custom m-input" type="text"
                                                        name="email" value="{{old('email')}}" placeholder="Email">
                                                    @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group">
                                                    <input class="form-control form-control--custom m-input" type="text"
                                                        name="mobile_no" value="{{old('mobile_no')}}" placeholder="Mobile No.">
                                                    @if ($errors->has('mobile_no'))
                                                    <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group">
                                                    <textarea class="form-control form-control--custom form-control--fixed-height m-input"
                                                        name="address" placeholder="Address">{{old('address')}}</textarea>
                                                    @if ($errors->has('address'))
                                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group">
                                                    <input class="form-control form-control--custom m-input" type="password" name="password" placeholder="Password">
                                                    <a class="input-hint" href="#" data-toggle="tooltip" data-placement="top" title="Password should be minimum 6 & maximum 10 characters."><i class="fa fa-info-circle" style="color: orange;float: right;"></i></a>
                                                    @if ($errors->has('password'))
                                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group m-form__group">
                                                    <input class="form-control form-control--custom m-input" type="password" name="confirm_password" placeholder="Confirm Password">
                                                    @if ($errors->has('confirm_password'))
                                                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-login__form-action d-flex justify-content-center btn-list">
                                            <button id="" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-login__btn">Sign Up</button>
                                        <a href="{{route('appointing_architect.login')}}" id="" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-login__btn">Cancel</a>
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
