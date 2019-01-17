@extends('frontend.layouts.app')
@section('body')
	<div class="m-grid__item m-grid__item--fluid  m-grid__item--order-tablet-and-mobile-1  m-login__wrapper">

      <!--begin::Body-->
      <div class="m-login__body">

        <!--begin::Signin-->
        <div class="m-login__signin">
          <div class="m-login__title">
            <h3>Register Applicant</h3>
          </div>
          <div class="m-portlet">
            <form class="m-form m-form--state m-form--fit m-form--label-align-right" id="rti_frontend_register" method="post" action="{{ route('rti_frontend.store', $id) }}">
            @csrf
            Application for obtaining information under the Right to Information Act, 2005
              <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                  <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                      <label class="col-form-label">Board</label>
                      <select class="form-control m-input" name="option">
                        <option value="">Select Board</option>
                        @foreach($boards as $board)
                        <option value="{{ $board->id }}">{{$board->board_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                      <label class="col-form-label">Department</label>
                      <select class="form-control m-input" name="option">
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{$department->department_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                      <label class="col-form-label">Department</label>
                      <select class="form-control m-input" name="option">
                        <option value="0">Select Department</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{$department->department_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                      <label class="col-form-label">Department</label>
                      <select class="form-control m-input" name="option">
                        <option value="0">Select Department</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{$department->department_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                      <label class="col-form-label">Department</label>
                      <select class="form-control m-input" name="option">
                        <option value="0">Select Department</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{$department->department_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                      <label class="col-form-label">Department</label>
                      <select class="form-control m-input" name="option">
                        <option value="0">Select Department</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{$department->department_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                      <label class="col-form-label">Department</label>
                      <select class="form-control m-input" name="option">
                        <option value="0">Select Department</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{$department->department_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                      <label class="col-form-label">Department</label>
                      <select class="form-control m-input" name="option">
                        <option value="0">Select Department</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{$department->department_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                      <label class="col-form-label">Department</label>
                      <select class="form-control m-input" name="option">
                        <option value="0">Select Department</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{$department->department_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                      <label class="col-form-label">Department</label>
                      <select class="form-control m-input" name="option">
                        <option value="0">Select Department</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{$department->department_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>        
        </div>
        <!--end::Signin-->
      </div>
      <!--end::Body-->
    </div>
@endsection