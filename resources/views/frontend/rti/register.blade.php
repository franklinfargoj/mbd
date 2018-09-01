@extends('frontend.layouts.app')
@section('body')
	<div class="m-grid__item m-grid__item--fluid  m-grid__item--order-tablet-and-mobile-1  m-login__wrapper">
      <!--begin::Head-->
      <!-- <div class="m-login__head">
        <span>Don't have an account?</span>
        <a href="#" class="m-link m--font-danger">Sign Up</a>
      </div> -->
      <!--end::Head-->

      <!--begin::Body-->
      <div class="m-login__body">

        <!--begin::Signin-->
        <div class="m-login__signin">
          <div class="m-login__title">
            <h3>Register</h3>
          </div>
			<form class="m-form m-form--state m-form--fit m-form--label-align-right" id="rti_frontend_register" method="post" action="{{ route('rti_frontend.store') }}">
			@csrf
				<div class="m-portlet__body">
					<div class="m-form__section m-form__section--first">
						<div class="form-group m-form__group row">
							<div class="col-lg-12">
								<label class="form-control-label">Name of User</label>
								<input type="text" name="username" class="form-control m-input" placeholder="Enter Name of User" value="">
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-12 m-form__group-sub">
								<label class="form-control-label">Address:</label>
								<textarea class="form-control m-input" name="address" placeholder="Enter Address"></textarea>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-12 m-form__group-sub">
								<label class="form-control-label">Mobile No:</label>
								<input type="number" class="form-control m-input" name="mobile_no" placeholder="Enter Mobile No" value="">
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-12 m-form__group-sub">
								<label class="col-form-label">Email</label>
								<input type="text" class="form-control m-input" name="email" placeholder="Enter your email" data-toggle="m-tooltip" title="Email Address">					
								<span class="m-form__help">We'll never share your email with anyone else.</span>
							</div>
						</div>
					</div>
				</div>
				<div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions m-form__actions">
						<div class="row">
							<div class="col-lg-12">
								<button type="submit" class="btn btn-accent">Submit</button>
								<button type="reset" class="btn btn-secondary">Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>



          <!--begin::Action-->
          <!-- <div class="m-login__action">
            <a href="{{ route('rti_frontend.create') }}" class="m-link">
              <button id="m_login_signin_submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Register</button>
            </a>
            <a href="#">
              <button id="m_login_signin_submit" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Register</button>
            </a>
          </div> -->
          <!--end::Action-->
        </div>
        <!--end::Signin-->
      </div>
      <!--end::Body-->
    </div>
@endsection