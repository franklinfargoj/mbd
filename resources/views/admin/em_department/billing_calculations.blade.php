@extends('admin.layouts.app')

@section('actions')
    
@if(Auth::user()->role_id == 7)         
      @include('admin.rc_department.action',compact('ol_application'))        
@else
     @include('admin.em_department.action',compact('ol_application'))     
@endif

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
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Society Billing details - @if(!empty($society)){{$society->name}}@endif |@if(!empty($building)){{$building->building_no . '|' .$building->name}}@endif | @if(!empty($tenant)) {{$tenant->first_name.' '.$tenant->last_name}} @endif</h3>
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
            {{-- {{ Breadcrumbs::render('society_detail') }} --}}
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        @if(Session::has('success'))
        <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size:20px">×</span>
            </button> {{ Session::get('success') }}
        </div>
        @endif
        <form role="form" id="Form" method="get" action="{{ route('billing_calculations') }}">
            <input type="hidden" name="society_id" value="@if(!empty($society)){{encrypt($society->id)}}@endif">
            <input type="hidden" name="building_id" value="@if(!empty($building)){{encrypt($building->id)}}@endif">
            <div class="row align-items-center mb-0">
                <div class="col-md-3">
                    <div class="form-group m-form__group">
                        <select id="year" name="year" class="form-control form-control--custom m-input"
                            placeholder="Select Year" >
                            <option value="">Select Year</option>
                            @if(!empty($years)) 
                                @foreach($years as $year)
                                    <option value="{{$year}}" @if($select_year == $year) selected @endif>{{$year}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                {{-- <div class="col-md-3">
                    <div class="form-group m-form__group">
                        <select id="month" name="month" class="form-control form-control--custom m-input"
                            placeholder="Select Month" >
                            <option value="">Select Month</option>
                            @if(!empty($months)) 
                                @foreach($months as $key => $month)
                                    <option value="{{$key}}" @if($real_select_month == $key) selected @endif>{{$month}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div> --}}
                <div class="col-md-3 col-sm-3">
                    <input class="btn btn-primary Search" type="submit" value="Search" id="Search"/>
                </div>
            </div>
        </form>
        <div class="m-portlet m-portlet--compact m-portlet--mobile">
            <div class="m-portlet__body table-responsive" style="overflow-x:auto;" >
                <table id="billing_calculations" class="display table table-responsive table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Month,Year</th>
                            <th>Water charges</th>
                            <th>Electricity charges</th>
                            <th>Pumpman & Repair charges</th>
                            <th>External expender</th>
                            <th>Administrative Charge</th>
                            <th>Lease rent</th>
                            <th>N. A. Assessment</th>
                            <th>Other Charges</th>
                            <th>Total</th>
                            <th>Balance amount</th>
                            <th>Interest amount</th>
                            <th>Grand Total</th>
                            <th>Amount paid</th>
                            <th>Files (bill & receipt)</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php 
                        $total_service_charges = $service_charges->water_charges + $service_charges->electric_city_charge+$service_charges->pump_man_and_repair_charges+$service_charges->external_expender_charge+$service_charges->administrative_charge+$service_charges->lease_rent+$service_charges->na_assessment+$service_charges->other;
                    @endphp

                    @foreach($arreas_calculations as $key => $arreas_calculation )
                        <tr>
                            <td>{{date("M", mktime(0, 0, 0, $arreas_calculation->month, 10)).','.$arreas_calculation->year}}</td>
                            <td>@if(!empty($tenant)){{$service_charges->water_charges}}@else{{$service_charges->water_charges*$building->tenant_count()->first()->count}}@endif</td>
                            <td>@if(!empty($tenant)){{$service_charges->electric_city_charge}}@else{{$service_charges->electric_city_charge*$building->tenant_count()->first()->count}}@endif</td>
                            <td>@if(!empty($tenant)){{$service_charges->pump_man_and_repair_charges}}@else{{$service_charges->pump_man_and_repair_charges*$building->tenant_count()->first()->count}}@endif</td>
                            <td>@if(!empty($tenant)){{$service_charges->external_expender_charge}}@else{{$service_charges->external_expender_charge*$building->tenant_count()->first()->count}}@endif</td>
                            <td>@if(!empty($tenant)){{$service_charges->administrative_charge}}@else{{$service_charges->administrative_charge*$building->tenant_count()->first()->count}}@endif</td>
                            <td>@if(!empty($tenant)){{$service_charges->lease_rent}}@else{{$service_charges->lease_rent*$building->tenant_count()->first()->count}}@endif</td>
                            <td>@if(!empty($tenant)){{$service_charges->na_assessment}}@else{{$service_charges->na_assessment*$building->tenant_count()->first()->count}}@endif</td>
                            <td>@if(!empty($tenant)){{$service_charges->other}}@else{{$service_charges->other*$building->tenant_count()->first()->count}}@endif</td>
                            <td>@if(!empty($tenant)){{$total_service_charges}}@else{{$service_charges->total_service_charges*$building->tenant_count()->first()->count}}@endif</td>
                            <td>{{$arreas_calculation->old_intrest_amount + $arreas_calculation->difference_amount}}</td>
                            <td>{{$arreas_calculation->old_intrest_amount + $arreas_calculation->difference_intrest_amount}}</td>
                            <td>{{$total_service_charges+$arreas_calculation->old_intrest_amount + $arreas_calculation->difference_amount+$arreas_calculation->old_intrest_amount + $arreas_calculation->difference_intrest_amount}}</td>
                            @if(!empty($amount_paid) && array_key_exists($arreas_calculation->tenant_id, $amount_paid))
                                <td>{{$amount_paid[$arreas_calculation->tenant_id]}}</td>
                            @else
                                <td>0</td>
                            @endif
                            <td>

                                {!! Form::open(['method' => 'get', 'route' => 'downloadBill']) !!}
                                @if(!empty($tenant)){{ Form::hidden('tenant_id', encrypt($tenant->id)) }}@endif
                                {{ Form::hidden('building_id',encrypt($building->id)) }}
                                {{ Form::hidden('society_id', encrypt($society->id)) }}
                                {{ Form::hidden('month', $arreas_calculation->month) }}
                                {{ Form::hidden('year', $arreas_calculation->year) }}
                                {{ Form::button('<span class="btn-icon btn-icon--edit"><img src="/img/view-arrears-calculation-icon.svg"></span> Donwload Bill', array('class'=>'btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center','type'=>'submit')) }}
                                {!! Form::close() !!}

                                @if(!empty($reciepts) && array_key_exists($arreas_calculation->tenant_id, $reciepts) && !empty($tenant))
                                    {!! Form::open(['method' => 'get', 'route' => 'downloadReceipt']) !!}
                                    @if(!empty($tenant)){{ Form::hidden('tenant_id', encrypt($tenant->id)) }}@endif
                                    {{ Form::hidden('building_id',encrypt($building->id)) }}
                                    {{ Form::hidden('bill_no', encrypt($reciepts[$arreas_calculation->tenant_id])) }}
                                    {{ Form::hidden('except_tenaments[]', '') }}
                                    {{ Form::button('<span class="btn-icon btn-icon--edit"><img src="/img/view-arrears-calculation-icon.svg"></span> Donwload Receipt', array('class'=>'btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center','type'=>'submit')) }}
                                    {!! Form::close() !!}
                                @endif
                                {{-- @if('1' == $arreas_calculation->payment_status) Paid @else Not Paid @endif  --}}
                                {{-- -  --}}
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection