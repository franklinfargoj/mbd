@extends('admin.layouts.app')

@section('content')

    @php 
        $total_service = $serviceChargesRate->water_charges + $serviceChargesRate->electric_city_charge + $serviceChargesRate->pump_man_and_repair_charges + $serviceChargesRate->external_expender_charge + $serviceChargesRate->administrative_charge + $serviceChargesRate->lease_rent + $serviceChargesRate->na_assessment + $serviceChargesRate->other; 

        $total_service = $total_service * $number_of_tenants->tenant_count()->first()->count;

        $total_after_due = $total_service * 0.02; 

        $total_service_after_due = $total_service + $total_after_due;   

        $total ='0';           
    @endphp
    @if(!$arreasCalculation->isEmpty())  
      @foreach($arreasCalculation as $calculation)
            @php $total = $total + $calculation->total_amount; @endphp
      @endforeach
    @endif  


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
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">View Society Bill</h3>
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile">
               
                {{-- <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
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

        <form method="post" action="{{route('create_society_bill')}}">
            {{ csrf_field() }}
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
            <input type="text" name="no_of_tenant" value="{{$number_of_tenants->tenant_count()->first()->count}}" hidden>

            <div class="m-portlet__body m-portlet__body--table m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-6 form-group">
                        <span>Bill For: {{date("M", strtotime("2001-" . $month . "-01"))}}, {{$year}}</span>
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
                        <span>Bill Number: {{$association->bill_number}}</span>
                    </div>
                </div>
                <div>
                    <table class="display table table-responsive table-bordered" style="width:100%">
                        <tr><td>Buidling Name : {{$building->name}} </td><td>Bill Period : {{date('1-M-Y', strtotime('-1 month'))}} to {{date('1-M-Y')}} </td></tr>
                        <tr><td>Address : @if(!empty($society)){{$society->society_address}}@endif </td><td>Bill Date : {{date('d-M-Y')}}  <input type="text" name="bill_date" value="{{date('d-m-Y')}}" hidden></td></tr>
                        <tr><td>Total Tenament : {{ $number_of_tenants->tenant_count()->first()->count }} </td><td>Due Date : {{date('d-M-Y', strtotime(date('Y-m-d'). ' + 5 days'))}} <input type="text" name="due_date" value="{{date('d-m-Y', strtotime(date('Y-m-d'). ' + 5 days'))}}" hidden> </td></tr>
                        <tr><td>Amount : {{$total + $total_service}} <input type="text" name="total_bill" value="{{$total + $total_service}}" hidden> </td><td>Late fee charge : {{ $total_after_due}} </td></tr>
                    </table>
                </div>
                <p class="text-center">Bill Summary - {{date("M", strtotime("2001-" . $month . "-01"))}}, {{$year}}</p>
                <div>
                    <table class="display table table-responsive table-bordered" style="width:100%">
                        <thead class="thead-default">
                            <tr>
                                <th class="text-center">Bill Title - {{date("M", strtotime("2001-" . $month . "-01"))}} </th>
                                <th class="text-center">Amount in Rs.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Water Charges </td>
                                <td class="text-center">{{$serviceChargesRate->water_charges}}</td>
                            </tr>
                            <tr>
                                <td>Electric City Charge </td>
                                <td class="text-center">{{$serviceChargesRate->electric_city_charge}} </td>
                            </tr>
                            <tr>
                                <td>Pump Man & Repair Charges</td>
                                <td class="text-center">{{$serviceChargesRate->pump_man_and_repair_charges}}</td>
                            </tr>
                            <tr>
                                <td>External  Expenture  Charge  </td>
                                <td class="text-center">{{$serviceChargesRate->external_expender_charge}} </td>
                            </tr>
                            <tr>
                                <td>Administrative  Charge</td>
                                <td class="text-center">{{$serviceChargesRate->administrative_charge}} </td>
                            </tr>
                            <tr>
                                <td>Lease Rent.   </td>
                                <td class="text-center">{{$serviceChargesRate->lease_rent}}</td>
                            </tr>
                            <tr>
                                <td>N.A.Assessment</td>
                                <td class="text-center">{{$serviceChargesRate->na_assessment}} </td>
                            </tr>
                            <tr>
                                <td>Other</td>
                                <td class="text-center">{{$serviceChargesRate->other}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Total</td>
                                <td class="font-weight-bold text-center">{{$total_service}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">After Due date 2% interest</td>
                                <td class="font-weight-bold text-center">{{$total_after_due}} </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">After Due date Amount payable</td>
                                <td class="font-weight-bold text-center">{{$total_service_after_due}} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if(!$arreasCalculation->isEmpty())
                @php $total ='0'; @endphp
                <p class="text-center">Balance amount to be paid - Arrears</p>
                <div>
                    <table class="display table table-responsive table-bordered" style="width:100%">
                        <thead class="thead-default">
                            <tr>
                                <th class="text-center">Year</th>
                                <th class="text-center">Month</th>
                                <th class="text-center">Amount In Rs.</th>
                                <th class="text-center">Penalty in Rs</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($arreasCalculation as $calculation)
                                @php $total = $total + $calculation->total_amount; @endphp
                                <tr>
                                    <td class="text-center">{{$calculation->year}}</td>
                                    <td class="text-center">{{date("M", strtotime("2001-" . $calculation->month . "-01"))}}</td>
                                    <td class="text-center">{{$calculation->total_amount-($calculation->old_intrest_amount + $calculation->difference_intrest_amount)}}</td>
                                    <td class="text-center">{{$calculation->old_intrest_amount + $calculation->difference_intrest_amount}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="font-weight-bold text-center" colspan="3">Total</td><td class="font-weight-bold text-center">{{$total}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif
                <p class="text-center">Total Amount to be paid</p>
                <div>
                    <table class="display table table-responsive table-bordered" style="width:100%">
                        <thead class="thead-default">
                            <tr>
                                <th class="text-center">Particulars</th>
                                <th class="text-center">Amount In Rs.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Balance Amount</td>
                                <td class="text-center">{{$total}}</td>
                            </tr>
                            <tr>
                                <td>Current month Bill amount before due date</td>
                                <td class="text-center">{{$total_service}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Total</td><td class="text-center font-weight-bold">{{$total + $total_service}}</td>
                            </tr>
                        </tbody>
                    </table>
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