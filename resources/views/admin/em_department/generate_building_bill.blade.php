@extends('admin.layouts.app')

@section('content')

    @php 
        $total_service = $serviceChargesRate->water_charges + $serviceChargesRate->electric_city_charge + $serviceChargesRate->pump_man_and_repair_charges + $serviceChargesRate->external_expender_charge + $serviceChargesRate->administrative_charge + $serviceChargesRate->lease_rent + $serviceChargesRate->na_assessment + $serviceChargesRate->other +$serviceChargesRate->property_tax; 
        
        $total_service = $total_service;

        $total_after_due = $total_service * 0.015; 
    
        $total_service_after_due = $total_service + $total_after_due;   
    
        $total ='0';           
    @endphp
    @if(count($lastBill)<=0)
        @if(!$arreasCalculation->isEmpty())  
        @foreach($arreasCalculation as $calculation)
                @php $total = $total + $calculation->total_amount; @endphp
        @endforeach
        @endif  
    @endif
    @php
    // dd($total);
    //$total ='0';  
        $tempBalance = $total;
        // if($lastBill && count($lastBill)>0 ) {
        //     foreach($lastBill as $lastbil) {
        //         if( 0 < $lastbil->balance_amount ) {
        //             $tempBalance += $lastbil->balance_amount;
        //         }
        //     }
        // }

        $arrear_interest=0;
        if(count($lastBill)>0)
        {
            //dd($lastBill);
            if($lastBill[0]->arrear_balance>0)
            {
                //dd($arrear_data);
                if($arrear_data)
                {
                    $arrear_interest=($arrear_data->old_rate*($arrear_data->interest_on_old_rate/100))+(($arrear_data->revise_rate-$arrear_data->old_rate)*($arrear_data->interest_on_differance/100));
                }
            $tempBalance=$tempBalance+($lastBill[0]->arrear_balance+$arrear_interest);
            }
            if($lastBill[0]->service_charge_balance>0)
            {
            $tempBalance=$tempBalance+($lastBill[0]->service_charge_balance+($lastBill[0]->service_charge_balance*0.015));
            }
            
        }
    @endphp

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


<div class="container-fluid">
    <div class="ml-auto btn-list">
        <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
    </div>
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Generate Society Bill</h3>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <form method="post" action="{{route('create_society_bill')}}">
            {{ csrf_field() }}
            <input type="hidden" name="regenate" value="{{$regenate}}">
            <input type="text" name="building_id" value="{{$building->id}}" hidden>
            <input type="text" name="society_id" value="{{$society->id}}" hidden>
            <input type="text" name="bill_from" value="{{date('1-m-Y', strtotime('-1 month'))}}" hidden>
            <input type="text" name="bill_to" value="{{date('1-m-Y')}}" hidden>
            <input type="text" name="bill_month" value="{{$month}}" hidden>
            <input type="text" name="bill_year" value="{{$bill_year}}" hidden>
            <input type="text" name="monthly_bill" value="{{$total_service}}" hidden>
            <input type="text" name="arrear_bill" value="{{$total}}" hidden>
            <input type="text" name="total_service_after_due" value="{{$total_service_after_due}}" hidden>
            <input type="text" name="late_fee_charge" value="{{$total_after_due}}" hidden>
            <input type="text" name="no_of_tenant" value="{{$number_of_tenants->tenant_count()->first()->count}}" hidden>

            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-6 form-group">
                        <span>Bill For:{{date("M", strtotime("2001-" . $month . "-01"))}}, {{$year}}</span>
                        <input type="text" name="bill_date" value="{{date('d-m-Y')}}" hidden>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-6 form-group">
                        <span>Consumer Number: BL-{{$consumer_number}}</span>
                         <input type="text" name="consumer_number" value="BL-{{$consumer_number}}" hidden>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-6 form-group">
                        <span>Society Name: @if(!empty($society)){{$society->society_name}}@endif</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-6 form-group">
                        <span>Bill Number: </span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <table class="display table table-responsive table-bordered" style="width:100%">
                        <tr><td>Buidling Name : {{$building->name}} </td><td>Bill Period : {{date('1-M-Y', strtotime('-1 month'))}} to {{date('1-M-Y')}} </td></tr>
                        <tr><td>Address : @if(!empty($society)){{$society->society_address}}@endif </td><td>Bill Date : {{date('d-M-Y')}}  <input type="text" name="bill_date" value="{{date('d-m-Y')}}" hidden></td></tr>
                        <tr><td>Total Tenament : {{ $number_of_tenants->tenant_count()->first()->count }} </td><td>Due Date : {{date('d-M-Y', strtotime(date('Y-m-d'). ' + 5 days'))}} <input type="text" name="due_date" value="{{date('d-m-Y', strtotime(date('Y-m-d'). ' + 5 days'))}}" hidden> </td></tr>

                        @php
                        $totalTemp = $total + $total_service;
                        $credit = 0;
                        if($lastBill && !empty($lastBill) ) {
                            foreach($lastBill as $lastbil) {
                                $credit += $lastbil->credit_amount;
                            }
                        }

                        if($lastBill && !empty($lastBill) && 0 < $credit) {
                            if($total + $total_service > $credit) {
                                $totalTemp =  ($total + $total_service) - $credit;  
                            } else {
                                $totalTemp =  0;    
                            }
                        }


                        $balance = 0;
                        if($lastBill && !empty($lastBill)) {
                            foreach($lastBill as $lastbil) {
                                $balance += $lastbil->balance_amount;
                            }
                        }
                        
                        if($lastBill && !empty($lastBill) && 0 < $balance) {
                            $totalTemp = $total+ $total_service + $balance;
                        }
                    @endphp

                        <tr><td>Amount : {{$totalTemp}} <input type="text" name="total_bill" value="{{$totalTemp}}" hidden> </td><td>Late fee charge : {{ $total_after_due}} </td></tr>
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
                            <td>Property Tax</td>
                            <td>{{$serviceChargesRate->property_tax}} </td>
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
                            <td>Other</td>
                            <td>{{$serviceChargesRate->other}}</td>
                        </tr>
                        <tr>
                            <td><p class="pull-right">Total</p></td>
                            <td>{{$total_service}}</td>
                        </tr>
                        <tr>
                            <td><p class="pull-right">After Due date 1.5% interest</p></td>
                            <td> {{$total_after_due}} </td>
                        </tr>
                        <tr>
                            <td><p class="pull-right">After Due date Amount payable</p></td>
                            <td> {{$total_service_after_due}} </td>
                        </tr>
                    </table>
                </div>
                @if(count($lastBill)<=0)
                @if(!$arreasCalculation->isEmpty())
                @php $total ='0'; @endphp
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
                        @php
                            $amont_in_rupees=0;
                            $penalty_in_rupees=0;
                            $calculation_month="";
                            $calculation_year="";
                            $arrear_ids=array();
                        @endphp
                        @foreach($arreasCalculation as $calculation)
                            @php 
                            $total = $total + $calculation->total_amount; 
                            $amont_in_rupees=$amont_in_rupees+($calculation->total_amount - $calculation->old_intrest_amount -
                            $calculation->difference_intrest_amount);
                            $penalty_in_rupees=$penalty_in_rupees+($calculation->old_intrest_amount +
                            $calculation->difference_intrest_amount);
                            $arrear_ids[]=$calculation->id;
                            $calculation_month=$calculation->month;
                            $calculation_year=$calculation->year;
                            @endphp
                            {{-- <tr>
                                <td>{{$calculation->year}} <input name='arrear_id[]' type='text' value='{{$calculation->id}}'
                                        hidden> </td>
                                <td>{{date("M", strtotime("2001-" . $calculation->month . "-01"))}}</td>
                                <td>{{$calculation->total_amount - $calculation->old_intrest_amount -
                                    $calculation->difference_intrest_amount }}</td>
                                <td>{{$calculation->old_intrest_amount +
                                    $calculation->difference_intrest_amount}}</td>
                            </tr> --}}
                        @endforeach
                        <tr>
                            <td>{{$calculation_year}} <input name='arrear_id' type='text' value='{{json_encode($arrear_ids)}}'
                                    hidden> </td>
                            <td>{{date("M", strtotime("2001-" . $calculation->month . "-01"))}}</td>
                            <td>{{$amont_in_rupees }}</td>
                            <td>{{$penalty_in_rupees}}</td>
                        </tr>
                        <tr>
                            <td colspan="3"><p class="pull-right">Total</p></td><td>{{$total}}</td><td></td>
                        </tr>
                    </table>
                </div>
                @endif
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
                            <td class="text-center">{{$tempBalance}}</td>
                        </tr>
                        @if($lastBill && !empty($lastBill))
                        @php
                            $credit_amount =0;
                            foreach($lastBill as $lastbil) {
                                $credit_amount += $lastbil->credit_amount;
                            }
                        @endphp
                        @if(0 <$credit_amount)
                        <tr>
                            <td>Credit Amount</td>
                            <td class="text-center">{{$credit_amount}}</td>
                        </tr>
                        @endif
                        @endif
                        {{-- <tr>
                            <td>Total arrear charges</td>
                            <td class="text-center">{{$total}}</td>
                        </tr> --}}
                        <tr>
                            <td>Service Charges</td>
                            <td class="text-center">{{$total_service}}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Bill Amount Before due date</td>
                            <td class="text-center ont-weight-bold">{{$total_service+$tempBalance}}</td>
                        </tr>
                        <tr>
                            <td>Bill Amount After due date</td>
                            <td class="text-center">{{$total_service_after_due+$tempBalance}}</td>
                        </tr>
                        {{-- <tr>
                            <td><p class="pull-right">Total</p></td><td>{{$totalTemp}}</td>
                        </tr> --}}
                    </table>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            @if((is_null($check) || $check == '') && false == $regenate)
                            <div class="col-sm-4">
                                <div class="btn-list">
                                    <button type="submit" id="" class="btn btn-primary">Generate Society Bill</button>
                                </div>
                            </div>
                            @endif
                            @if(true == $regenate) 
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <button type="submit" id="" class="btn btn-primary">Regenerate Society Bill</button>
                                    </div>
                                </div>
                            @endif
                            <div class="col-sm-2">
                                <div class="btn-list">
                                    <a onclick="goBack()" class="btn btn-secondary">Cancel</a>
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
@section('datatablejs')
<script>
    /*$("#update_status").on("change", function () {
        $("#eeForm").submit();
    });*/
function goBack() {
    window.history.back();
}
</script>
@endsection