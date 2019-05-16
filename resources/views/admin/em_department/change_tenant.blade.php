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

    @if(session()->has('warning'))
        <div class="alert alert-danger display_msg">
            {{ session()->get('warning') }}
        </div>
    @endif
    <div class="col-md-12">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center" id="search_box">
                <h3 class="m-subheader__title m-subheader__title--separator">Change Tenant</h3>
                {{ Breadcrumbs::render('em') }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left"
                                                                                         style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
        </div>
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
            <form class="m-form m-form--rows m-form--label-align-right" method="post" enctype='multipart/form-data' action="{{route('save_changed_tenants')}}">
                {{ csrf_field() }}
                <input type="hidden" value="{{ old('id', $tenant->id) }}" name="id" />
                <input type="hidden" value="{{ old('id', $tenant->id) }}" name="tenant_primary_id" />
                <input type="hidden" value="{{ old('building_id', $tenant->building_id) }}" name="building_id" />
                <input type="hidden" value="{{ old('building_id', $tenant->building_id) }}" name="tenant_building_id" />
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label">Flat No.</label>
                            <div class="@if($errors->has('flat_no')) has-error @endif">
                                <input type="text" name="flat_no" id="flat_no" class="form-control form-control--custom m-input"
                                       value="{{old('flat_no', $tenant->flat_no)}}">
                                <input type="hidden" name="tenant_flat_no" id="flat_no" class="form-control form-control--custom m-input"
                                       value="{{old('flat_no', $tenant->flat_no)}}">
                                <span class="help-block error">{{$errors->first('flat_no')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label">Salutation</label>
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="salutation"
                                    name="salutation" required>
                                <option value="" style="font-weight: normal;">Select Salutation</option>
                                <option value="Shri"
                                        {{ old("salutation", $tenant->salutation) == "Shri" ? 'selected' : '' }}>Shri</option>
                                <option value="Smt" {{ old("salutation", $tenant->salutation) == "Smt" ? 'selected' : '' }}>Smt</option>
                                <option value="Kumari"
                                        {{ old("salutation", $tenant->salutation) == "Kumari" ? 'selected' : '' }}>Kumari</option>
                            </select>
                            <input type="hidden" name="tenant_salutation" id="tenant_salutation" class="form-control form-control--custom m-input"
                                   value="{{old('salutation', $tenant->salutation)}}">
                            <span class="help-block error">{{$errors->first('salutation')}}</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label">First name</label>
                            <div class="@if($errors->has('first_name')) has-error @endif">
                                <input type="text" name="first_name" id="first_name" class="form-control form-control--custom m-input"
                                       value="{{old('first_name', $tenant->first_name)}}">
                                <input type="hidden" name="tenant_first_name" id="tenant_first_name" class="form-control form-control--custom m-input"
                                       value="{{old('first_name', $tenant->first_name)}}">
                                <span class="help-block error">{{$errors->first('first_name')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label">Middle name</label>
                            <div class="@if($errors->has('middle_name')) has-error @endif">
                                <div class="input-icon right">
                                    <input type="text" name="middle_name" id="middle_name" class="form-control form-control--custom m-input"
                                           value="{{old('middle_name', $tenant->middle_name)}}">
                                    <input type="hidden" name="tenant_middle_name" id="tenant_middle_name" class="form-control form-control--custom m-input"
                                           value="{{old('middle_name', $tenant->middle_name)}}">
                                    <span class="help-block error">{{$errors->first('middle_name')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label">Last name</label>
                            <div class="@if($errors->has('last_name')) has-error @endif">
                                <div class="input-icon right">
                                    <input type="text" name="last_name" id="last_name" class="form-control form-control--custom m-input"
                                           value="{{old('last_name', $tenant->last_name)}}">
                                    <input type="hidden" name="tenant_last_name" id="tenant_last_name" class="form-control form-control--custom m-input"
                                           value="{{old('last_name', $tenant->last_name)}}">
                                    <span class="help-block error">{{$errors->first('last_name')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label">Mobile</label>
                            <div class="@if($errors->has('mobile')) has-error @endif">
                                <div class="input-icon right">
                                    <input type="text" name="mobile" id="mobile" class="form-control form-control--custom m-input"
                                           value="{{old('mobile', $tenant->mobile)}}">
                                    <input type="hidden" name="tenant_mobile" id="tenant_mobile" class="form-control form-control--custom m-input"
                                           value="{{old('mobile', $tenant->mobile)}}">
                                    <span class="help-block error">{{$errors->first('mobile')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label">Email ID</label>
                            <div class="@if($errors->has('email_id')) has-error @endif">
                                <input type="text" name="email_id" id="email_id" class="form-control form-control--custom m-input"
                                       value="{{old('email_id', $tenant->email_id)}}">
                                <input type="hidden" name="tenant_email_id" id="tenant_email_id" class="form-control form-control--custom m-input"
                                       value="{{old('email_id', $tenant->email_id)}}">
                                <span class="help-block error">{{$errors->first('email_id')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label">Use</label>
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="use"
                                    name="use" required>
                                <option value="" style="font-weight: normal;">Select Use</option>
                                <option value="Residential"
                                        {{ old("use", $tenant->use) == "Residential" ? 'selected' : '' }}>Residential</option>
                                <option value="Commercial" {{ old("use", $tenant->use) == "Commercial" ? 'selected' : '' }}>Commercial</option>
                            </select>
                            <input type="hidden" name="tenant_use" id="tenant_use" class="form-control form-control--custom m-input"
                                   value="{{old('use', $tenant->use)}}">
                            <span class="help-block error">{{$errors->first('use')}}</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label">Carpet Area</label>
                            <div class="@if($errors->has('carpet_area')) has-error @endif">
                                <input type="text" name="carpet_area" id="carpet_area" class="form-control form-control--custom m-input"
                                       value="{{old('carpet_area', $tenant->carpet_area)}}">
                                <input type="hidden" name="tenant_carpet_area" id="tenant_carpet_area" class="form-control form-control--custom m-input"
                                       value="{{old('carpet_area', $tenant->carpet_area)}}">
                                <span class="help-block error">{{$errors->first('carpet_area')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label">Tenant Type</label>
                            <select type="hidden" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="tenant_type"
                                    name="tenant_type" required>
                                <option value="" style="font-weight: normal;">Select Tenament</option>
                                @foreach($tenament as $key => $value)
                                    <option value="{{ $value->id }}"
                                            {{ old("tenant_type", $tenant->tenant_type) == $value->id ? 'selected' : '' }}>{{
                                $value->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="tenant_tenant_type" id="tenant_tenant_type" class="form-control form-control--custom m-input"
                                   value="{{old('tenant_type', $tenant->tenant_type)}}">
                            <span class="help-block error">{{$errors->first('tenant_type')}}</span>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <input type="submit" class="btn btn-primary mhada-btn-pill" name="submit" value="Submit">
                                        <a class="btn btn-secondary mhada-btn-pill" href="{{ route('get_tenants', [encrypt($tenant->building_id)]) }}">Cancel</a>
                                    </div>
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
    <div class="col-md-12">
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                    <div class="remark-body">
                        <div class="pb-2">
                            <h3 class="section-title section-title--small mb-2">
                                Tenant History:
                            </h3>
                        </div>
                    </div>
                    <div class="col-md-12 table-responsive">
                        <table id="dtBasicExample" class="table" style="font-size: 14px">
                            <thead>
                            <tr>
                                <th class="th-sm">Sr.No</th>
                                <th class="th-sm">Building Name</th>
                                <th class="th-sm">Flat No.</th>
                                <th class="th-sm">Salutation</th>
                                <th class="th-sm">First Name</th>
                                <th class="th-sm">Middle Name</th>
                                <th class="th-sm">Last Name</th>
                                <th class="th-sm">Mobile</th>
                                <th class="th-sm">Email Id</th>
                                <th class="th-sm">Use</th>
                                <th class="th-sm">Carpet Area</th>
                                <th class="th-sm">Tenant Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tenant_log as $key=>$tenant)
                                <tr>
                                    <td> {{$key + 1}}</td>
                                    <td> {{$tenant['master_building']['name'] ?? ''}}</td>
                                    <td> {{$tenant['flat_no'] ?? ''}}</td>
                                    <td> {{$tenant['salutation'] ?? ''}}</td>
                                    <td> {{$tenant['first_name'] ?? ''}}</td>
                                    <td> {{$tenant['middle_name'] ?? ''}}</td>
                                    <td> {{$tenant['last_name'] ?? ''}}</td>
                                    <td> {{$tenant['mobile'] ?? ''}}</td>
                                    <td> {{$tenant['email_id'] ?? ''}}</td>
                                    <td> {{$tenant['use'] ?? ''}}</td>
                                    <td> {{$tenant['carpet_area'] ?? ''}}</td>
                                    <td> {{$tenant['tenanttype']['name'] ?? ''}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');

            $('#dtBasicExample_wrapper > .row:first-child').remove();
        });

        $('table').dataTable({searching: false, ordering: false, info: false});
    </script>
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
