@extends('admin.layouts.app')
@section('content')
    @php 
        $total_service = $serviceChargesRate->water_charges + $serviceChargesRate->electric_city_charge + $serviceChargesRate->pump_man_and_repair_charges + $serviceChargesRate->external_expender_charge + $serviceChargesRate->administrative_charge + $serviceChargesRate->lease_rent + $serviceChargesRate->na_assessment + $serviceChargesRate->other; 

        $total_after_due = $total_service * 0.02; 

        $total_service_after_due = $total_service + $total_after_due;     
        $total ='0';           
    @endphp
    @if(!$arreasCalculation->isEmpty())  
      @foreach($arreasCalculation as $calculation)
            @php $total = $total + $calculation->total_amount; @endphp
      @endforeach
    @endif  

<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Generate Society Bill:@if(!empty($society)){{$society->society_name}}@endif|{{$building->building_no}}|{{$building->name}}|{{$tenant->first_name.' '.$tenant->last_name}}</h3>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <form action="">
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-6 form-group">
                        <span>Bill For: {{date("M", strtotime("2001-" . $month . "-01"))}}, {{$year}}</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-6 form-group">
                        <span>Consumer Number: TN-{{$consumer_number}}</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-6 form-group">
                        <span>Society Name: @if(!empty($society)){{$society->society_name}}@endif</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-6 form-group">
                        <span>Bill Number:</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <table class="display table table-responsive table-bordered" style="width:100%">
                        <tr><td>Tenant Name : {{$tenant->first_name.' '.$tenant->last_name}} </td><td>Bill Period : </td></tr>
                        <tr><td>Buidling Name : {{$building->name}} </td><td>Bill Date : {{date('d-M-Y')}} </td></tr>
                        <tr><td>Address : @if(!empty($society)){{$society->society_address}}@endif</td><td>Due Date : {{date('d-M-Y', strtotime(date('Y-m-d'). ' + 5 days'))}}</td></tr>
                        <tr><td>Amount : {{$total + $total_service}}</td> <td>Late fee charge : {{ $total_after_due}} </td></tr>
                    </table>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-12 form-group">
                        <p class="text-center">Bill Summary - {{date("M", strtotime("2001-" . $month . "-01"))}}, {{$year}}</p>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <table class="display table table-responsive table-bordered" style="width:100%">
                        <tr><th class="text-center">Bill Title - {{date("M", strtotime("2001-" . $month . "-01"))}} </th><th>Amount in Rs.</th></tr>
                        <tr>
                            <td>Water Charges  </td>
                            <td>{{$serviceChargesRate->water_charges}}</td>
                        </tr>
                        <tr>
                            <td>Electric City Charge </td>
                            <td>{{$serviceChargesRate->electric_city_charge}} </td>
                        </tr>
                        <tr>
                            <td>Pump Man & Repair Charges</td>
                            <td>{{$serviceChargesRate->pump_man_and_repair_charges}}</td>
                        </tr>
                        <tr>
                            <td>External  Expenture  Charge  </td>
                            <td>{{$serviceChargesRate->external_expender_charge}} </td>
                        </tr>
                        <tr>
                            <td>Administrative  Charge</td>
                            <td>{{$serviceChargesRate->administrative_charge}} </td>
                        </tr>
                        <tr>
                            <td>Lease Rent.   </td>
                            <td>{{$serviceChargesRate->lease_rent}}</td>
                        </tr>
                        <tr>
                            <td>N.A.Assessment</td>
                            <td>{{$serviceChargesRate->na_assessment}} </td>
                        </tr>
                        <tr>
                            <td>Insurance</td>
                            <td>{{$serviceChargesRate->other}}</td>
                        </tr>
                        <tr>
                            <td><p class="pull-right">Total</p></td>
                            <td>{{$total_service}}</td>
                        </tr>
                        <tr>
                            <td><p class="pull-right">After Due date 2% interest</p></td>
                            <td>{{$total_after_due}}</td>
                        </tr>
                        <tr>
                            <td><p class="pull-right">After Due date Amount payable</p></td>
                            <td>{{ $total_service_after_due }} </td>
                        </tr>
                    </table>
                </div>
               
                @if(!$arreasCalculation->isEmpty())               
                <div class="form-group m-form__group row">
                    <div class="col-sm-12 form-group">
                        <p class="text-center">Balance amount to be paid - Arrears</p>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <table class="display table table-responsive table-bordered" style="width:100%">
                        <tr>
                            <th class="text-center">Year</th>
                            <th class="text-center">Month</th>
                            <th class="text-center">Amount In Rs.</th>
                            <th class="text-center">Penalty in Rs</th>
                        </tr>
                        @foreach($arreasCalculation as $calculation)
                            <tr>
                                <td class="text-center">{{$calculation->year}}</td>
                                <td class="text-center">{{date("M", strtotime("2001-" . $calculation->month . "-01"))}}</td>
                                <td class="text-center">{{$calculation->total_amount}}</td>
                                <td class="text-center">{{$calculation->year}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"><p class="pull-right">Total</p></td><td>{{$total}}</td><td></td>
                        </tr>
                    </table>
                </div>
                @endif
                <div class="form-group m-form__group row">
                    <div class="col-sm-12 form-group">
                        <p class="text-center">Total Amount to be paid</p>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <table class="display table table-responsive table-bordered" style="width:100%">
                        <tr>
                            <th class="text-center">Perticulars</th>
                            <th class="text-center">Amount In Rs.</th>
                        </tr>
                        <tr>
                            <td>Balance Amount</td>
                            <td class="text-center">{{ $total }}</td>
                        </tr>
                        <tr>
                            <td>Current month Bill amount before due date</td>
                            <td class="text-center">{{$total_service}} </td>
                        </tr>
                        <tr>
                            <td><p class="pull-right">Total</p></td>
                            <td>{{$total + $total_service}}</td>
                        </tr>
                    </table>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="btn-list">
                                    <button type="submit" id="" class="btn btn-primary">Generate Society Bill</button>
                                    <a href="javascript:void(0);" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
