<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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
    @php
        $tempBalance = $total;
        if($lastBill && !empty($lastBill) && 0 < $lastBill->balance_amount) {
            $tempBalance = $lastBill->balance_amount;
        }
    @endphp
    <div>
        <div>
            <h3>Bill for {{date("M", strtotime("2001-" . $month . "-01"))}}, {{$year}}</h3>
        </div>
        <div>
            <div style="width: 100%; margin-top: 30px;">
                <div style="width: 100%; float: left; margin-bottom: 20px;">
                    <div style="width: 30%; float: left;">Consumer No:TN-{{$consumer_number}}</div>
                </div>
                <div style="clear:both;"></div>
                <div style="width: 100%; float: left; margin-bottom: 20px;">
                    <div style="width: 70%; float: left;">Society Name: @if(!empty($society)){{$society->society_name}}@endif</div>
                </div>
                <div style="clear:both;"></div>
                <div style="width: 100%;float: left; margin-bottom: 20px;">
                    <div style="width: 30%; float: left;">Bill No:</div>
                    <div style="width: 70%; float: left;"></div>
                </div>
                <div style="clear:both;"></div>
                {{-- <div style="width: 100%; float: left; margin-bottom: 20px;">
                    <div style="width: 30%; float: left;">Name:</div>
                    <div style="width: 70%; float: left;"></div>
                </div>
                <div style="clear:both;"></div> --}}
            </div>
        </div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
            <tbody>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Tenant Name : {{$tenant->first_name.' '.$tenant->last_name}}</td>
                                    <td valign="top" style="text-align: right;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Bill Period :  {{date('1-M-Y', strtotime('-1 month'))}} to {{date('1-M-Y')}} </td>
                                    <td valign="top" style="text-align: right;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Buidling Name : {{$building->name}}</td>
                                    <td valign="top" style="text-align: right;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Bill Date : {{date('d-M-Y')}} </td>
                                    <td valign="top" style="text-align: right;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Address : @if(!empty($society)){{$society->society_address}}@endif</td>
                                    <td valign="top" style="text-align: right;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Due Date : {{date('d-M-Y', strtotime(date('Y-m-d'). ' + 5 days'))}} </td>
                                    <td valign="top" style="text-align: right;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
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
                        $totalTemp =  $total_service + $lastBill->balance_amount;
                    }
                @endphp
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Amount : {{$totalTemp}}</td>
                                    <td valign="top" style="text-align: right;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Late fee charge : {{ $total_after_due}}</td>
                                    <td valign="top" style="text-align: right;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="border: 2px solid #000; padding: 5px; margin-top: 30px;"><h3 style="text-align: center;">Bill Summary - {{date("M", strtotime("2001-" . $month . "-01"))}}, {{$year}}</h3></div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
            <thead>
                <tr>
                    <th valign="top" style="border: 1px solid #000; padding: 5px; width: 40%;">Bill Title - {{date("M", strtotime("2001-" . $month . "-01"))}}</th>
                    <th valign="top" style="border: 1px solid #000; padding: 5px; width: 60%;">Amount in Rs.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">Water Charges:</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$serviceChargesRate->water_charges}}</td>
                </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">Electric City Charge:</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$serviceChargesRate->electric_city_charge}}</td>
                </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">Pump Man & Repair Charges:</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$serviceChargesRate->pump_man_and_repair_charges}}</td>
                </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">External Expenture Charge:</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$serviceChargesRate->external_expender_charge}}</td>
                </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">Administrative Charge:</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$serviceChargesRate->administrative_charge}}</td>
                </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">Lease Rent:</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$serviceChargesRate->lease_rent}}</td>
                </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">N.A.Assessment:</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$serviceChargesRate->na_assessment}}</td>
                </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">Other:</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$serviceChargesRate->other}}</td>
                </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; font-weight: bold; text-align: right;">Total:</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; font-weight: bold;">{{$total_service}}</td>
                </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; font-weight: bold; text-align: right;">After Due date x% interest:</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; font-weight: bold;">{{$total_after_due}}</td>
                </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; font-weight: bold; text-align: right;">After Due date Amount payable:</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; font-weight: bold;">{{$total_service_after_due}}</td>
                </tr>
            </tbody>
        </table>

        @if(!$arreasCalculation->isEmpty())
            @php $total ='0'; @endphp

        <div style="border: 2px solid #000; padding: 5px; margin-top: 160px;"><h3 style="text-align: center;">Balance amount to be paid - Arrears</h3></div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
            <thead>
                <tr>
                    <th valign="top" style="border: 1px solid #000; padding: 5px; width: 25%;">Year</th>
                    <th valign="top" style="border: 1px solid #000; padding: 5px; width: 25%;">Month</th>
                    <th valign="top" style="border: 1px solid #000; padding: 5px; width: 25%;">Amount in Rs.</th>
                    <th valign="top" style="border: 1px solid #000; padding: 5px; width: 25%;">Penalty in Rs.</th>
                </tr>
            </thead>
            <tbody>
                @foreach($arreasCalculation as $calculation)
                    @php $total = $total + $calculation->total_amount; @endphp
                    <tr>
                        <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$calculation->year}}</td>
                        <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{date("M", strtotime("2001-" . $calculation->month . "-01"))}}</td>
                        <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$calculation->total_amount}}</td>
                        <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$calculation->old_intrest_amount + $calculation->difference_intrest_amount}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align: right; font-weight: bold;" colspan="2">Total</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center; font-weight: bold;">{{$total}}</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center; font-weight: bold;"></td>
                </tr>
               
            </tbody>
        </table>
        @endif
        <div style="border: 2px solid #000; padding: 5px; margin-top: 30px;"><h3 style="text-align: center;">Total amount to be paid</h3></div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
            <thead>
                <tr>
                    <th valign="top" style="border: 1px solid #000; padding: 5px; width: 50%;">Particulars</th>
                    <th valign="top" style="border: 1px solid #000; padding: 5px; width: 50%;">Amount in Rs.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">Balance Amount</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align: center;">{{$tempBalance}}</td>
                </tr>
                 @if($lastBill && !empty($lastBill) && 0 < $lastBill->credit_amount)
                    <tr>
                        <td valign="top" style="border: 1px solid #000; padding: 5px;">Credit Amount</td>
                        <td valign="top" style="border: 1px solid #000; padding: 5px; text-align: center;">{{$lastBill->credit_amount}}</td>
                    </tr>
                    @endif
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px;">Current month Bill amount before due date</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align: center;">{{$total_service}}</td>
                </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align: right; font-weight: bold;">Grand Total</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align: center; font-weight: bold;">{{$totalTemp}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>