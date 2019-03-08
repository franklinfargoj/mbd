@extends('admin.layouts.app')
@section('actions')
@include('admin.em_department.action',compact('ol_application'))
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center" id="search_box">
            <h3 class="m-subheader__title m-subheader__title--separator">Add Building</h3>
            {{ Breadcrumbs::render('em') }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left"
                        style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <div class="m-portlet__body m-portlet__body--spaced">
            <form id="add_building" class="m-form m-form--rows m-form--label-align-right" method="post" enctype='multipart/form-data'
                action="{{route('create_building')}}">
                {{ csrf_field() }}
                <input type="hidden" value="{{ old('society_id', $society_id) }}" name="society_id" />
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label">Building / Chawl Name</label>
                        <div class="@if($errors->has('name')) has-error @endif">
                            <input type="text" name="name" id="name" class="form-control form-control--custom m-input"
                                value="{{old('name')}}" required>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label">Building / Chawl Number</label>
                        <div class="@if($errors->has('building_no')) has-error @endif">
                            <input type="text" name="building_no" id="building_no" class="form-control form-control--custom m-input"
                                value="{{old('building_no')}}" required>
                            <span class="help-block">{{$errors->first('building_no')}}</span>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="btn-list">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                                    <a class="btn btn-secondary" href="{{ route('get_buildings', [encrypt($society_id)]) }}">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END: Subheader -->

    <input type="hidden" id="myModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" />

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">

    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection
@section('datatablejs')


<script>
    /*$("#update_status").on("change", function () {
        $("#eeForm").submit();
    });*/

    $(document).ready(function () {
        $(".display_msg").delay(5000).slideUp(300);
        $('#add_building').validate({
            rules: {
                name: {
                    required: true
                },
                building_no: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter building/chawl name."
                },
                building_no: {
                    required: "Please enter building/chawl number."
                }
            }
        });
    });

</script>
@endsection
