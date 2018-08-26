@extends('admin.layouts.app')
@section('content')
<form class="register-form" action="{{url('rti_form')}}" method="post" id="frontendRtiForm" style="display: block;">
@csrf
                <p>Application for obtaining information under the Right to Information Act, 2005 </p>
                <div class="form-group">
                    <label class="control-label">Board</label>
                    <div class="input-icon">
                        <select name="board_id" class="form-control placeholder-no-fix" required>
                                    <option value="">Select</option>
                                    @foreach($boards as $board)
                                    <option value="{{$board->id}}">{{$board->board_name}}</option>
                                    @endforeach
                        </select>

                </div>

                <div class="form-group">
                    <label class="control-label">Department</label>
                    <div class="input-icon">
                        <select name="department_id" class="form-control " required>
                                    <option value="">Select</option>
                                    @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->department_name}}</option>
                                    @endforeach
                        </select>
                </div>

                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Full Name</label>
                    <div class="input-icon">
                        <i class="fa fa-font"></i>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="fullname"> </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Address</label>
                    <div class="input-icon">
                        <i class="fa fa-check"></i>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Address" name="address"> </div>
                </div>
                <p>Particulars of information required </p>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Subject matter of information</label>
                    <div class="input-icon">
                        <i class="fa fa-check"></i>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Subject matter of information" name="info_subject"> </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="control-label visible-ie8 visible-ie9">The period to which the informationrelates </label>
                    <div class="input-icon">
                        <i class="fa fa-calendar"></i>
                        <input class="form-control" type="date" name="info_period_from"> </div> &nbsp;
                        <input class="form-control" type="date" name="info_period_to"> </div>
                </div>

                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Description of the information required </label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Description" name="info_descr"> </div>
                </div>

<div class="form-group">
<label class="col-md-4 control-label">Whether information is required by </label>
<div class="mt-radio-inline col-md-8">
<label class="mt-radio">
<input type="radio" name="info_post_or_person" id="rtiInfoRespondRadios" value="1" @if(old('status')==1) checked @endif> Post
<span></span>
</label>
<label class="mt-radio">
<input type="radio" name="info_post_or_person" id="rtiInfoRespondRadios" value="0" @if(old('status')==0) checked @endif> Person
<span></span>
</label>
<span class="help-block">{{$errors->first('info_post_or_person')}}</span>
</div>
</div>

<div class="form-group" id="infoPostTypeFormgroup"  style="display:none;">
<label class="col-md-4 control-label">Whether information is required by </label>
<div class="mt-radio-inline col-md-8">
<label class="mt-radio">
<input type="radio" name="info_post_type" id="rtiPostTypeRadios" value="1"> Ordinary
<span></span>
</label>
<label class="mt-radio">
<input type="radio" name="info_post_type" id="rtiPostTypeRadios" value="2"> Registered
<span></span>
</label>
<label class="mt-radio">
<input type="radio" name="info_post_type" id="rtiPostTypeRadios" value="3"> Speed
<span></span>
</label>
<span class="help-block">{{$errors->first('info_post_type')}}</span>
</div>
</div>

<div class="form-group">
<label class="col-md-4 control-label">Whether the applicant is below poverty line? </label>
<div class="mt-radio-inline col-md-8">
<label class="mt-radio">
<input type="radio" name="applicant_below_poverty_line" id="rtiPovertyLineRadios" value="1" @if(old('status')==1) checked @endif> Yes
<span></span>
</label>
<label class="mt-radio">
<input type="radio" name="applicant_below_poverty_line" id="rtiPovertyLineRadios" value="0" @if(old('status')==0) checked @endif> No
<span></span>
</label>
<span class="help-block">{{$errors->first('applicant_below_poverty_line')}}</span>

<div id="povertyLineProofFile"  style="display:none;">
<input type="file" class="form-control" name="poverty_line_proof_file" >
<span class="help-block">{{$errors->first('poverty_line_proof')}}</span>
</div>
</div>
</div>
                <div class="form-actions">
                    <button type="submit" id="register-submit-btn" class="btn green pull-right"> Submit </button>
                    <button type="reset" id="register-submit-btn"  class="btn red pull-right"> Cancel </button>
                </div>
            </form>

@endsection
