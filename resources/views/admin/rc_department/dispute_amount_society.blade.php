@extends('admin.layouts.app')
@section('actions')
    @include('admin.rc_department.action')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Dispute Bill</h3>
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
        </div>
        @if(session()->has('warning'))
            <div class="alert alert-danger display_msg">
                {{ session()->get('warning') }}
            </div>
        @endif

        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
            <form method="post" action="{{route('payment_dispute_society')}}">
                {{ csrf_field() }}
                {{--<input type="text" name="tenant_id" value="{{$bill[0]->tenant_id}}" hidden>--}}
                <input type="text" name="building_id" value="{{$bill[0]->building_id}}" hidden>
                <input type="text" name="society_id" value="{{$bill[0]->society_id}}" hidden>
                <input type="text" name="trans_bill_generate_id" value="{{$bill[0]->id}}" hidden>
                <div class="m-portlet__body m-portlet__body--spaced">
                    {{--<div class="form-group m-form__group row">--}}
                    {{--<div class="col-sm-4 form-group">--}}
                    {{--<label class="col-form-label" for="">Account Code:</label>--}}
                    {{--<input type="text" name="account_code" class="form-control form-control--custom m-input" value="">--}}
                    {{--<span class="help-block"></span>--}}
                    {{--</div>--}}

                    {{--<div class="col-sm-4 form-group">--}}
                    {{--<label class="col-form-label" for="">Bill No:</label>--}}
                    {{--<input type="text" name="bill_no" class="form-control form-control--custom m-input" value="{{$bill[0]->id}}" readonly>--}}
                    {{--<span class="help-block"></span>--}}
                    {{--</div>--}}

                    {{--</div>--}}
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="">Society Name:</label>
                            <input type="text" class="form-control form-control--custom m-input" value="{{$bill[0]->society_detail->society_name}}" readonly>
                            <span class="help-block"></span>
                        </div>

                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="service_charge_balance">Service Charge Balance:</label>
                            <input type="text" name="service_charge_balance" class="form-control form-control--custom m-input" value="{{$bill[0]->service_charge_balance}}" readonly>
                            <span class="help-block"></span>
                        </div>

                        {{--<div class="col-sm-4 offset-sm-1 form-group">--}}
                            {{--<label class="col-form-label" for="">Flat Number:</label>--}}
                            {{--<input type="text" class="form-control form-control--custom m-input" value="{{$bill[0]->tenant_detail->flat_no}}" readonly>--}}
                            {{--<span class="help-block"></span>--}}
                        {{--</div>--}}
                    </div>

                    {{--<div class="form-group m-form__group row">--}}
                        {{--<div class="col-sm-4 form-group">--}}
                            {{--<label class="col-form-label" for="">Building Number:</label>--}}
                            {{--<input type="text" class="form-control form-control--custom m-input" value="{{$bill[0]->building_detail->building_no}}" readonly>--}}
                            {{--<span class="help-block"></span>--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-4 offset-sm-1 form-group">--}}
                            {{--<label class="col-form-label" for="service_charge_balance">Service Charge Balance:</label>--}}
                            {{--<input type="text" name="service_charge_balance" class="form-control form-control--custom m-input" value="{{$bill[0]->service_charge_balance}}" readonly>--}}
                            {{--<span class="help-block"></span>--}}
                        {{--</div>--}}

                    {{--</div>--}}

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="arrear_balance">Arrear Balance:</label>
                            <input type="text" name="arrear_balance" class="form-control form-control--custom m-input" value="{{$bill[0]->arrear_balance}}" readonly>
                            <span class="help-block"></span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="arrear_interest_balance">Arrear Interest Balance:</label>
                            <input type="text" name="arrear_interest_balance" class="form-control form-control--custom m-input" value="{{$bill[0]->arrear_interest_balance}}" readonly>
                            <span class="help-block"></span>
                        </div>

                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="amount">Dispute:</label>
                            <input type="text" name="amount" class="form-control form-control--custom m-input" value="" required>
                            <span class="help-block"></span>
                        </div>

                        <div class="col-sm-4  offset-sm-1 form-group">
                            <label class="col-form-label" for="remark">Remark:</label>
                            <input type="text" name="remark" class="form-control form-control--custom m-input" value="" required>
                            <span class="help-block"></span>
                        </div>
                    </div>


                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <button type="submit" id="" class="btn btn-primary">Dispute Bill</button>
                                        <a href="{{route('bill_collection_tenant')}}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @if(/*isset($dispute_data) && !empty($dispute_data)*/ count($dispute_data) > 0)
            <div class="m-portlet m-portlet--compact m-portlet--mobile">
                <div class="m-portlet__body">
                    <!--begin: Search Form -->
                    <div class="m-form m-form--label-align-right">
                        <!-- <div class="form-group m-form__group row align-items-center"> -->

                        <!-- </div> -->
                    </div>
                    <!--end: Search Form -->
                    <!--begin: Datatable -->
                    <table class="table">
                        <tr>
                            <th>Sr No</th>
                            <th>Bill No</th>
                            <th>Dispute Amount</th>
                            <th>Remark</th>
                        </tr>
                        @foreach ($dispute_data as $key => $data)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$data['trans_bill_generate_id']}}</td>
                                <td>{{$data['amount']}}</td>
                                <td>{{$data['remark']}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
        @endif




    </div>
@endsection
