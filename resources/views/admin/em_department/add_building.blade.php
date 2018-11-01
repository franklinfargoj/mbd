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
         </div>
   <form method="post" enctype='multipart/form-data' action="{{route('create_building')}}">
        {{ csrf_field() }}
        <input type="hidden" value="{{ old('society_id', $society_id) }}" name="society_id" />

        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <h4 class="m-subheader__title">Add Building</h4>
                </div>
            
                <div class="col-md-12" style="margin-top:40px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Building / Chawl Name</label>
                                        <div class="col-md-8 @if($errors->has('name')) has-error @endif">
                                        <div class="input-icon right">
                                             <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                                            <span class="help-block">{{$errors->first('name')}}</span>
                                        </div>
                                        </div>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:40px;margin-bottom: 40px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Building / Chawl Number</label>
                                        <div class="col-md-8 @if($errors->has('building_no')) has-error @endif">
                                        <div class="input-icon right">
                                             <input type="text" name="building_no" id="building_no" class="form-control" value="{{old('building_no')}}">
                                            <span class="help-block">{{$errors->first('building_no')}}</span>
                                        </div>
                                        </div>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-9">
                        <div class="form-group m-form__group">
                            <input type="submit" class="btn btn-success" name="submit" value="submit">

                            <a  class="btn btn-info" href="{{ route('get_buildings', [$society_id]) }}">Cancel</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
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
    });

</script>
@endsection
