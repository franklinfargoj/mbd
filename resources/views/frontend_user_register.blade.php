@extends('admin.layouts.app')
@section('content')
<form role="form" method="post" class="form-horizontal" action="{{url('frontend_register')}}" id="frontEndRegisterForm">
  @csrf
    <div class="form-body">
        <div class="form-group">
            <label class="col-md-4 control-label">Full Name</label>
            <div class="col-md-8 @if($errors->has('name')) has-error @endif">
                <div class="input-icon right">
                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                    <span class="help-block">{{$errors->first('name')}}</span>
                  </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Address</label>
            <div class="col-md-8 @if($errors->has('address')) has-error @endif">
                <div class="input-icon right">
                    <input type="text" name="address" class="form-control" value="{{old('address')}}">
                    <span class="help-block">{{$errors->first('address')}}</span>
                  </div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-4 control-label">Mobile Number</label>
            <div class="col-md-8 @if($errors->has('mobile_no')) has-error @endif">
                <div class="input-icon right">
                    <input type="text" name="mobile_no" class="form-control" value="{{old('mobile_no')}}">
                    <span class="help-block">{{$errors->first('mobile_no')}}</span>
                  </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Email Address</label>
            <div class="col-md-8 @if($errors->has('email')) has-error @endif">
                <div class="input-icon right">
                    <input type="email" name="email" class="form-control" value="{{old('email')}}">
                    <span class="help-block">{{$errors->first('email')}}</span>
                  </div>
            </div>
        </div>
      </div>

    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-4 col-md-8">
                <button type="submit" class="btn blue">Submit</button>
                <button type="reset" class="btn red">Cancel</button>
            </div>
        </div>
    </div>
</form>
@endsection
