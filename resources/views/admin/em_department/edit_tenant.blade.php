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
            <h3 class="m-subheader__title m-subheader__title--separator">Edit Tenant</h3>
            {{ Breadcrumbs::render('em') }}
         </div>
   <form method="post" enctype='multipart/form-data' action="{{route('update_tenant')}}">
        {{ csrf_field() }}
         <input type="hidden" value="{{ old('id', $tenant->id) }}" name="id" />
        <input type="hidden" value="{{ old('building_id', $tenant->building_id) }}" name="building_id" />

        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <h4 class="m-subheader__title">Edit Tenant</h4>
                </div>
            
                <div class="col-md-12" style="margin-top:10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Flat No.</label>
                                        <div class="col-md-8 @if($errors->has('flat_no')) has-error @endif">
                                        <div class="input-icon right">
                                             <input type="text" name="flat_no" id="flat_no" class="form-control" value="{{old('flat_no', $tenant->flat_no)}}">
                                            <span class="help-block">{{$errors->first('flat_no')}}</span>
                                        </div>
                                        </div>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group m-form__group">
                                    <label class="col-md-4 control-label">Saluation</label>
                                    <select class="col-md-8 form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="salutation" name="salutation" required>
                                        <option value="" style="font-weight: normal;">Select Saluation</option>
                                        <option value="Shri"  {{ old("salutation", $tenant->salutation) == "Shri" ? 'selected' : '' }} >Shri</option>
                                        <option value="Smt"  {{ old("salutation", $tenant->salutation) == "Smt" ? 'selected' : '' }}>Smt</option>
                                        <option value="Kumari"  {{ old("salutation", $tenant->salutation) == "Kumari" ? 'selected' : '' }}>Kumari</option>
                                    </select>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">First name</label>
                                        <div class="col-md-8 @if($errors->has('first_name')) has-error @endif">
                                        <div class="input-icon right">
                                             <input type="text" name="first_name" id="first_name" class="form-control" value="{{old('first_name', $tenant->first_name)}}">
                                            <span class="help-block">{{$errors->first('first_name')}}</span>
                                        </div>
                                        </div>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Middle name</label>
                                        <div class="col-md-8 @if($errors->has('middle_name')) has-error @endif">
                                        <div class="input-icon right">
                                             <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{old('middle_name', $tenant->middle_name)}}">
                                            <span class="help-block">{{$errors->first('middle_name')}}</span>
                                        </div>
                                        </div>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Last name</label>
                                        <div class="col-md-8 @if($errors->has('last_name')) has-error @endif">
                                        <div class="input-icon right">
                                             <input type="text" name="last_name" id="last_name" class="form-control" value="{{old('last_name', $tenant->last_name)}}">
                                            <span class="help-block">{{$errors->first('last_name')}}</span>
                                        </div>
                                        </div>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Mobile</label>
                                        <div class="col-md-8 @if($errors->has('mobile')) has-error @endif">
                                        <div class="input-icon right">
                                             <input type="text" name="mobile" id="mobile" class="form-control" value="{{old('mobile', $tenant->mobile)}}">
                                            <span class="help-block">{{$errors->first('mobile')}}</span>
                                        </div>
                                        </div>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Email ID</label>
                                        <div class="col-md-8 @if($errors->has('email_id')) has-error @endif">
                                        <div class="input-icon right">
                                             <input type="text" name="email_id" id="email_id" class="form-control" value="{{old('email_id', $tenant->email_id)}}">
                                            <span class="help-block">{{$errors->first('email_id')}}</span>
                                        </div>
                                        </div>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group m-form__group">
                                    <label class="col-md-4 control-label">Use</label>
                                    <select class="col-md-8 form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="use" name="use" required>
                                        <option value="" style="font-weight: normal;">Select Use</option>
                                        <option value="Residential" {{ old("use", $tenant->use) == "Residential" ? 'selected' : '' }} >Residential</option>
                                        <option value="Commercial" {{ old("use", $tenant->use) == "Commercial" ? 'selected' : '' }} >Commercial</option>
                                    </select>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Carpet Area</label>
                                        <div class="col-md-8 @if($errors->has('carpet_area')) has-error @endif">
                                        <div class="input-icon right">
                                             <input type="text" name="carpet_area" id="carpet_area" class="form-control" value="{{old('carpet_area', $tenant->carpet_area)}}">
                                            <span class="help-block">{{$errors->first('carpet_area')}}</span>
                                        </div>
                                        </div>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group m-form__group">
                                    <label class="col-md-4 control-label">Tenant Type</label>
                                    <select class=" col-md-8 form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="tenant_type" name="tenant_type" required>
                                        <option value="" style="font-weight: normal;">Select Tenament</option>
                                        @foreach($tenament as $key => $value)
                                        <option value="{{ $value->id }}" {{ old("tenant_type", $tenant->tenant_type) == $value->id ? 'selected' : '' }} >{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                          
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="col-md-9">
                        <div class="form-group m-form__group">
                            <input type="submit" class="btn m-btn--pill m-btn--custom btn-primary" name="submit" value="submit">

                            <a  class="btn m-btn--pill m-btn--custom btn-metal" href="{{ route('get_tenants', [$tenant->building_id]) }}">Cancel</a>
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
