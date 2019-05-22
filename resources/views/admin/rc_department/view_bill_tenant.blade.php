@if(false == $is_download)
@extends('admin.layouts.app')
@section('content')
@endif
    @php 
        $total_service = $currentBill->service_charges->water_charges + $currentBill->service_charges->electric_city_charge + $currentBill->service_charges->pump_man_and_repair_charges + $currentBill->service_charges->external_expender_charge + $currentBill->service_charges->administrative_charge + $currentBill->service_charges->lease_rent + $currentBill->service_charges->na_assessment + $currentBill->service_charges->other; 
        $total_after_due = $total_service * 0.015; 
        $total_service_after_due = $total_service + $total_after_due;     
        $total ='0';           
    @endphp
    @if(!$arreasCalculation->isEmpty())  
      @foreach($arreasCalculation as $calculation)
            @php $total = $total + $calculation->total_amount; @endphp
      @endforeach
    @endif  
    @php
        // $tempBalance = $total;
        // if($lastBill && !empty($lastBill) && 0 < $lastBill->balance_amount) {
        //     $tempBalance = $lastBill->balance_amount;
        // }
    @endphp
@if(false == $is_download)
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
@endif

<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Generate Tenant Bill:
                @if(!empty($society)){{$society->society_name}}@endif | {{$building->building_no}} | {{$building->name}} | {{$tenant->first_name.' '.$tenant->last_name}}</h3>
            @if(false == $is_download)
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
            @endif
         </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

               {{--  <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="btn-list pull-right">
                                    <a onclick="goBack()" class="btn btn-block btn-primary m-btn m-btn--pill m-btn--custom m-login__btn m-login__btn--primary">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
        <form method="post" action="{{route('create_tenant_bill')}}">
            {{ csrf_field() }}
            <input type="text" name="tenant_id" value="{{$tenant->id}}" hidden>
            <input type="text" name="building_id" value="{{$building->id}}" hidden>
            <input type="text" name="society_id" value="{{$society->id}}" hidden>
            <input type="text" name="bill_from" value="{{date('1-m-Y')}}" hidden>
            <input type="text" name="bill_to" value="{{date('1-m-Y', strtotime('+1 month'))}}" hidden>
            <input type="text" name="bill_month" value="{{date('n')}}" hidden>
            <input type="text" name="bill_year" value="{{date('Y')}}" hidden>
            <input type="text" name="monthly_bill" value="{{$total_service}}" hidden>
            <input type="text" name="arrear_bill" value="{{$total}}" hidden>
            <input type="text" name="total_service_after_due" value="{{$total_service_after_due}}" hidden>
            <input type="text" name="late_fee_charge" value="{{$total_after_due}}" hidden>


            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-6 form-group">
                        <span>Bill For: {{date("M", strtotime("2001-" . $month . "-01"))}}, {{$year}}</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-6 form-group">
                        <span>Consumer Number: TN-{{$consumer_number}}</span>
                        <input type="text" name="consumer_number" value="TN-{{$consumer_number}}" hidden>

                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-6 form-group">
                        <span>Society Name: @if(!empty($society)){{$society->society_name}}@endif</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-6 form-group">
                        <span>Bill Number: {{$currentBill->bill_number}}</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <table class="display table table-responsive table-bordered" style="width:100%">
                        <tr><td>Tenant Name : {{$tenant->first_name.' '.$tenant->last_name}} </td><td>Bill Period :  {{date('1-M-Y', strtotime('-1 month'))}} to {{date('1-M-Y')}} </td></tr>

                        <tr><td>Buidling Name : {{$building->name}} </td><td>Bill Date : {{date('d-M-Y')}} <input type="text" name="bill_date" value="{{date('d-m-Y')}}" hidden> </td></tr>

                        <tr><td>Address : @if(!empty($society)){{$society->society_address}}@endif</td><td>Due Date : {{date('d-M-Y', strtotime(date('Y-m-d'). ' + 5 days'))}} <input type="text" name="due_date" value="{{date('d-m-Y', strtotime(date('Y-m-d'). ' + 5 days'))}}" hidden> </td></tr>
                        @php
                            $totalTemp = $total + $total_service;
                            if($lastBill && !empty($lastBill) && 0 < $lastBill->credit_amount) {
                                if($total + $total_service > $lastBill->credit_amount) {
                                    $totalTemp =  ($total + $total_service) - $lastBill->credit_amount;  
                                } else {
                                    $totalTemp =  0;    
                                }
                            }
                            if($lastBill && !empty($lastBill) && 0 < $lastBill->balance_amount) {
                                $totalTemp =  $total + $total_service + $lastBill->balance_amount;
                            }
                        @endphp
                        <tr><td>Amount : {{$totalTemp}} <input type="text" name="total_bill" value="{{$totalTemp}}" hidden></td> <td>Late fee charge : {{ $total_after_due}} </td></tr>
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
                            <td>{{$currentBill->service_charges->water_charges}}</td>
                        </tr>
                        <tr>
                            <td>Electric City Charge </td>
                            <td>{{$currentBill->service_charges->electric_city_charge}} </td>
                        </tr>
                        <tr>
                            <td>Pump Man & Repair Charges</td>
                            <td>{{$currentBill->service_charges->pump_man_and_repair_charges}}</td>
                        </tr>
                        <tr>
                            <td>External  Expenture  Charge  </td>
                            <td>{{$currentBill->service_charges->external_expender_charge}} </td>
                        </tr>
                        <tr>
                            <td>Administrative  Charge</td>
                            <td>{{$currentBill->service_charges->administrative_charge}} </td>
                        </tr>
                        <tr>
                            <td>Lease Rent.   </td>
                            <td>{{$currentBill->service_charges->lease_rent}}</td>
                        </tr>
                        <tr>
                            <td>N.A.Assessment</td>
                            <td>{{$currentBill->service_charges->na_assessment}} </td>
                        </tr>
                        <tr>
                            <td>Other</td>
                            <td>{{$currentBill->service_charges->other}}</td>
                        </tr>
                        <tr>
                            <td><p class="pull-right">Total</p></td>

                            <td>{{$total_service}}</td>
                        </tr>
                        <tr>
                            <td><p class="pull-right">After Due date 1.5% interest</p></td>
                            <td>{{$total_after_due}}</td>
                        </tr>
                        <tr>
                            <td><p class="pull-right">After Due date Amount payable</p></td>

                            <td>{{ $total_service_after_due }} </td>
                        </tr>
                    </table>
                </div>
                @if($lastBill==null)
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
                                <td class="text-center">{{$calculation->total_amount - $calculation->old_intrest_amount - $calculation->difference_intrest_amount }}</td>
                                <td class="text-center">{{$calculation->old_intrest_amount + $calculation->difference_intrest_amount}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"><p class="pull-right">Total</p></td><td>{{$total}}</td><td></td>
                        </tr>
                    </table>
                </div>
                @endif
                @else 
                <div style="border: 2px solid #000; padding: 5px; margin-top: 20px;"><h3 style="text-align: center;">Balance amount to be paid - Arrears</h3></div>
                <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
                    <thead>
                        <tr>
                            <th valign="top" style="background-color: lightblue; padding: 5px; width: 25%;">Year</th>
                            <th valign="top" style="background-color: lightblue; padding: 5px; width: 25%;">Month</th>
                            <th valign="top" style="background-color: lightblue; padding: 5px; width: 25%;">Amount in Rs.</th>
                            <th valign="top" style="background-color: lightblue; padding: 5px; width: 25%;">Penalty in Rs.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $total=0;
                            $total=$currentBill->prev_arrear_balance+$currentBill->prev_arrear_interest_balance;
                        @endphp
                            <tr>
                                <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{$lastBill->bill_year}}</td>
                                <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{date("M", strtotime("2001-" . $lastBill->bill_month . "-01"))}}</td>
                                <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{$lastBill->prev_arrear_balance }}</td>
                                <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{$lastBill->prev_arrear_interest_balance }}</td>
                                <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$lastBill->bill_year}}</td>
                                <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{date("M", strtotime("2001-" . $lastBill->bill_month . "-01"))}}</td>
                                <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$currentBill->prev_arrear_balance }}</td>
                                <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$currentBill->prev_arrear_interest_balance }}</td>
                            </tr>
                        <tr>
                            <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: right; font-weight: bold;" colspan="2">Total</td>
                            <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center; font-weight: bold;">{{$total}}</td>
                            <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center; font-weight: bold;"></td>
                        </tr>
                       
                    </tbody>
                </table>
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
                            <td class="text-center">{{($lastBill?$lastBill->balance_amount:0)+$currentBill->arrear_bill}}</td>
                        </tr>
                        @if($lastBill && !empty($lastBill) && 0 < $lastBill->credit_amount)
                        <tr>
                            <td>Credit Amount</td>
                            <td class="text-center">{{$lastBill->credit_amount}}</td>
                        </tr>
                        @endif
                        {{-- <tr>
                            <td >Total arrear charges</td>
                            <td class="text-center">{{$total}}</td>
                        </tr> --}}
                        <tr>
                            <td >Service Charges</td>
                            <td class="text-center">{{$total_service}}</td>
                        </tr>
                        <tr>
                            <td>Current month Bill amount before due date</td>
                            <td class="text-center">{{$total_service+$total}} </td>
                        </tr>
                        <tr>
                            <td>Current month Bill amount after due date</td>
                            <td class="text-center">{{ceil($total_service_after_due+$total)}} </td>
                        </tr>
                        {{-- <tr>
                            <td><p class="pull-right">Total</p></td>
                            <td>{{$totalTemp}}</td>
                        </tr> --}}
                    </table>
                </div>

            </div>
        </form>
    </div>
</div>
@if(false == $is_download)
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
@endif