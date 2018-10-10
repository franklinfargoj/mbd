@extends('admin.layouts.app')
@section('content')
<div class="custom-wrapper">
    <div class="col-md-12">
        @if(Session::has('success'))
        <div class="alert alert-success">
            <p> {{ Session::get('success') }} </p>
        </div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger">
            <p> {{ Session::get('error') }} </p>
        </div>
        @endif

        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Add Layout</h3>
            </div>
        </div>
        <div class="m-portlet">
            <form id="addlayoutForm" role="form" method="post" class="form-horizontal" action="{{route('architect_layout.store')}}">
                @csrf
                <div class="m-form__group row">
                    <div class="col-lg-7 form-group">
                        <label class="col-form-label">Layout Name</label>
                        <div class="@if($errors->has('layout_name')) has-error @endif">
                            <input type="text" name="layout_name" id="layout_name" class="form-control form-control--custom"
                                value="{{old('layout_name')}}">
                            <span class="text-danger">{{$errors->first('layout_name')}}</span>
                        </div>
                    </div>
                    <div class="col-lg-7 form-group">
                        <label class="col-form-label">Layout Address</label>
                        <div class="@if($errors->has('layout_address')) has-error @endif">
                            <textarea type="text" name="layout_address" id="layout_address" class="form-control form-control--custom form-control--fixed-height">{{old('layout_address')}}</textarea>
                            <span class="text-danger">{{$errors->first('layout_address')}}</span>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="btn-list">
                                    <button type="submit" class="btn btn-primary">Save & Add Layout Details</button>
                                    <a href="{{route('architect_layout.index')}}" role="button" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
