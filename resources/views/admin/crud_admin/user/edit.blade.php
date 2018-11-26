@extends('admin.crud_admin.app')
@section('actions')
    @include('admin.crud_admin.user.actions')
@endsection
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Edit User</h3>
                {{ Breadcrumbs::render('edit_user',$user['id']) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
        </div>

        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile">
            <form id="edituser" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('users.update',$user['id'])}}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="name">Name:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" id="name" name="name" class="form-control form-control--custom m-input"  value="{{ $user['name'] }}">
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            </div>
                        </div>

                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="email">Email:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" id="email" name="email" class="form-control form-control--custom m-input"  value="{{ $user['email'] }}">
                                <span class="text-danger">{{$errors->first('email')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="mobile_no">Mobile No:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" id="mobile_no" name="mobile_no" class="form-control form-control--custom m-input"  value="{{ $user['mobile_no'] }}">
                                <span class="text-danger">{{$errors->first('mobile_no')}}</span>
                            </div>
                        </div>

                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="address">Address:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" id="address" name="address" class="form-control form-control--custom m-input"  value="{{ $user['address'] }}">
                                <span class="text-danger">{{$errors->first('address')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="password">Password:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" id="password" name="password" class="form-control form-control--custom m-input"  value="">
                                <span class="text-danger">{{$errors->first('password')}}</span>
                            </div>
                        </div>

                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="confirm-password">Confirm Password:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" id="confirm-password" name="password_confirmation" class="form-control form-control--custom m-input">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="service_start_date">Service Start Date:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" id="service_start_date" name="service_start_date" class="form-control form-control--custom m-input m_datepicker"  value="{{ date(config('commanConfig.dateFormat'), strtotime($user['service_start_date'])) }}">
                                <span class="text-danger">{{$errors->first('service_start_date')}}</span>
                            </div>
                        </div>

                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="service_end_date">Service End Date:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" id="service_end_date" name="service_end_date" class="form-control form-control--custom m-input m_datepicker"  value="{{ date(config('commanConfig.dateFormat'), strtotime($user['service_end_date'])) }}">
                                <span class="text-danger">{{$errors->first('service_end_date')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="role_id">Role:<span class="star">*</span></label>
                            <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="role-id" name="role_id">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id  }}" {{ ($role->id == $user['role_id']) ? "selected" : "" }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('role_id')}}</span>
                        </div>

                        {{--<div class="col-sm-4 offset-sm-1 form-group">--}}
                        {{--<label class="col-form-label" for="email">Email:</label>--}}
                        {{--<div class="m-input-icon m-input-icon--right">--}}
                        {{--<input type="text" id="email" name="email" class="form-control form-control--custom m-input"  value="{{ old('email') }}">--}}
                        {{--<span class="text-danger">{{$errors->first('email')}}</span>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="btn-list">
                                    <button type="submit" id="edit_user" class="btn btn-primary">Update</button>
                                    <a href="{{route('users.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

