@extends('admin.crud_admin.app')
@section('actions')
    @include('admin.crud_admin.colony.actions')
@endsection
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Edit Colony</h3>
                {{ Breadcrumbs::render('edit_colony',$colony['id']) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
        </div>

        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile">
            <form id="editcolony" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('colony.update',$colony['id'])}}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="name">Colony Name:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" id="name" name="name" class="form-control form-control--custom m-input"  value="{{ $colony['name'] }}">
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="layout_id">Layouts:<span class="star">*</span></label>
                            <div class="m-input-icon m-input-icon--right">
                                <select title="Select Layout" data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout_id" name="layout_id">
                                    @foreach($layouts as $layout)
                                        <option value={{$layout->id}}>{{$layout->layout_name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{$errors->first('layout')}}</span>
                            </div>
                        </div>

                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="ward_id">Wards:<span class="star">*</span></label>
                            <div class="m-input-icon m-input-icon--right">
                                <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="ward_id" name="ward_id">
                                    @foreach($wards as $ward)
                                        <option value={{$ward->id}}  {{($ward->id == $colony['ward_id']) ? 'selected' : '' }}>{{$ward->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{$errors->first('ward_id')}}</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="btn-list">
                                    <button type="submit" id="edit_colony" class="btn btn-primary">Update</button>
                                    <a href="{{route('colony.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

