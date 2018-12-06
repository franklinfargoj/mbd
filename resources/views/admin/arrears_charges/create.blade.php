@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Add Arrears Charge Rate</h3>
            {{-- {{ Breadcrumbs::render('society_detail') }} --}}
            <div class="ml-auto btn-list">
            <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
        </div>
    </div>
    <!-- END: Subheader -->
    
    <div class="m-portlet m-portlet--mobile">
        <h4 class="box-subheading ml-0">{{$society->society_name}} - {{$building->name}}</h4>

        <form id="service_charges" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="{{url('arrears_charges/'.encrypt($society->id).'/'.encrypt($building->id).'/store')}}">
            @csrf
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="year">Year:</label>
                    <select  id="year" name="year" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" required >
                        <option value="">Select Year</option>
                        @php $earliest_year = '2000'; @endphp

                        @foreach(range(date('Y'), $earliest_year) as $x)
                            <option value="{{$x }}" {{ old('year') == date('Y') || $x == date('Y')? 'selected' : '' }} >{{$x}}</option>
                        @endforeach
                    </select>
                    <span class="help-block error">{{$errors->first('year')}}</span>
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="case_year">Teanant Type:</label>
                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" name="tenant_type" required>
                        <option value="">Select Teanat Type</option>
                        @foreach($tenant_types as $tenant_type => $val)
                            <option value="{{$val}}" {{ old('tenant_type') == $val ? 'selected' : '' }} >{{$tenant_type}}</option>
                        @endforeach
                    </select>
                    <span class="help-block error">{{$errors->first('tenant_type')}}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="case_year">Old Rate:</label>
                    <input type="text" id="old_rate" name="old_rate" class="form-control form-control--custom m-input" value="{{old('old_rate')}}"  required>
                    <span class="help-block error">{{$errors->first('old_rate')}}</span>
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="case_year">Revise Rate:</label>
                    <input type="text" id="revise_rate" name="revise_rate" class="form-control form-control--custom m-input" value="{{old('revise_rate')}}" required>
                    <span class="help-block error">{{$errors->first('revise_rate')}}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="case_year">Interest % Old Rate:</label>
                    <input type="text" id="interest_on_old_rate" name="interest_on_old_rate" class="form-control form-control--custom m-input" value="{{old('interest_on_old_rate')}}" required>
                    <span class="help-block error">{{$errors->first('interest_on_old_rate')}}</span>
                </div>
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="case_year">Interest % on Difference:</label>
                    <input type="text" id="interest_on_differance" name="interest_on_differance" class="form-control form-control--custom m-input" value="{{old('interest_on_differance')}}" required>
                    <span class="help-block error">{{$errors->first('interest_on_differance')}}</span>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="btn-list">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{url('arrears_charges/'.encrypt($society->id).'/'.encrypt($building->id))}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection