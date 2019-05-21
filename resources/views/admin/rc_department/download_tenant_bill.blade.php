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
        $total_service = $serviceChargesRate->water_charges + $serviceChargesRate->electric_city_charge + $serviceChargesRate->pump_man_and_repair_charges + $serviceChargesRate->external_expender_charge + $serviceChargesRate->administrative_charge +$serviceChargesRate->property_tax+ $serviceChargesRate->lease_rent + $serviceChargesRate->na_assessment + $serviceChargesRate->other; 
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
        
    @endphp
    <div>
        <div>
            <h3>Bill for {{date("M", strtotime("2001-" . $month . "-01"))}}, {{$year}}</h3>
        </div>
        <table style="width: 720px;border-collapse: collapse;">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>
                                <img src="{{ public_path().'/img/logo-big.png' }}" style="width: 80%;">
                            </td>
                        </tr>
                    </table> 
                </td>
                <td style="width: 360px;">
                    <table style="font-size: 19px;">
                        <tr>
                            <td style="line-height: 20px;">Consumer No : TN-{{$consumer_number}}</td>
                        </tr>
                        <tr>
                            <td style="line-height: 20px;">Society Name : @if(!empty($society)){{$society->society_name}}@endif</td>
                        </tr>
                        <tr>
                            <td style="line-height: 20px;">Bill No : {{$TransBillGenerate->bill_number}}</td>
                        </tr>
                    </table>
                </td>
                
            </tr>
        </table>
        
        <table style="width: 720px; border-collapse: collapse; margin-top: 30px;">
            <tbody>
                <tr>
                    <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Tenant Name : {{$tenant->first_name.' '.$tenant->last_name}}</td>
                                    <td valign="top" style="text-align: center;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Bill Period :  {{date('1-M-Y', strtotime($TransBillGenerate->bill_from ))}} to {{date('d-M-Y',strtotime($TransBillGenerate->bill_to))}} </td>
                                    <td valign="top" style="text-align: center;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Buidling Name : {{$building->name}}</td>
                                    <td valign="top" style="text-align: center;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Bill Date : {{date('d-M-Y',strtotime($TransBillGenerate->bill_date))}} </td>
                                    <td valign="top" style="text-align: center;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Address : @if(!empty($society)){{$society->society_address}}@endif</td>
                                    <td valign="top" style="text-align: center;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Due Date : {{date('d-M-Y', strtotime($TransBillGenerate->due_date))}} </td>
                                    <td valign="top" style="text-align: center;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                @php
                    
                @endphp
                <tr>
                    <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Amount : {{$TransBillGenerate->total_bill}}</td>
                                    <td valign="top" style="text-align: center;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Late fee charge : {{ $TransBillGenerate->late_fee_charge}}</td>
                                    <td valign="top" style="text-align: center;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="border: 1px solid #000; padding: 5px; margin-top: 30px;background-color: lightblue;"><h3 style="text-align: center;">Bill Summary - {{date("M", strtotime("2001-" . $month . "-01"))}}, {{$year}}</h3></div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
            <thead>
                <tr>
                    <th valign="top" style=" padding: 10px 5px; width: 40%;background-color: lightblue;">Bill Title - {{date("M", strtotime("2001-" . $month . "-01"))}}</th>
                    <th valign="top" style=" padding: 10px 5px; width: 60%;background-color: lightblue;">Amount in Rs.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">Water Charges</td>
                    <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$serviceChargesRate->water_charges}}</td>
                </tr>
                <tr>
                    <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">Electric City Charge</td>
                    <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$serviceChargesRate->electric_city_charge}}</td>
                </tr>
                <tr>
                    <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">Pump Man & Repair Charges</td>
                    <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$serviceChargesRate->pump_man_and_repair_charges}}</td>
                </tr>
                <tr>
                    <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">External Expenture Charge</td>
                    <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$serviceChargesRate->external_expender_charge}}</td>
                </tr>
                <tr>
                    <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">Administrative Charge</td>
                    <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$serviceChargesRate->administrative_charge}}</td>
                </tr>
                <tr>
                    <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">Lease Rent</td>
                    <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$serviceChargesRate->lease_rent}}</td>
                </tr>
                <tr>
                    <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">N.A.Assessment</td>
                    <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$serviceChargesRate->na_assessment}}</td>
                </tr>
                <tr>
                    <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">Property Tax</td>
                    <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$serviceChargesRate->property_tax==null?'0.00':$serviceChargesRate->property_tax}}</td>
                </tr>
                <tr>
                    <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">Other</td>
                    <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$serviceChargesRate->other}}</td>
                </tr>
                <tr>
                    <td valign="top" style=" padding: 5px; font-weight: bold; text-align: right; background-color: #f1f3f4;">Total</td>
                    <td valign="top" style=" padding: 5px; font-weight: bold;text-align: center; background-color: #f1f3f4;">{{$total_service}}</td>
                </tr>
                <tr>
                    <td valign="top" style=" padding: 5px; font-weight: bold; text-align: right; background-color: #f1f3f4;">After Due date 1.5% interest</td>
                    <td valign="top" style=" padding: 5px; font-weight: bold;text-align: center; background-color: #f1f3f4;">{{$total_after_due}}</td>
                </tr>
                <tr>
                    <td valign="top" style=" padding: 5px; font-weight: bold; text-align: right; background-color: #f1f3f4;">After Due date Amount payable</td>
                    <td valign="top" style=" padding: 5px; font-weight: bold;text-align: center; background-color: #f1f3f4;">{{$total_service_after_due}}</td>
                </tr>
            </tbody>
        </table>
        @if($lastBill==null)
        @if(!$arreasCalculation->isEmpty())
            @php $total ='0'; @endphp

        <div style="border: 2px solid #000; padding: 5px; margin-top: 20px;"><h3 style="text-align: center;">Balance amount to be paid - Arrears</h3></div>
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
                        <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$calculation->total_amount- $calculation->old_intrest_amount - $calculation->difference_intrest_amount}}</td>
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
        @else
        <div style="border: 2px solid #000; padding: 5px; margin-top: 20px;"><h3 style="text-align: center;">Balance amount to be paid - Arrears</h3></div>
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
                @php 
                    $total=0;
                    $total=$lastBill->arrear_balance+$lastBill->arrear_interest_balance;
                @endphp
                    <tr>
                        <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$lastBill->bill_year}}</td>
                        <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{date("M", strtotime("2001-" . $lastBill->bill_month . "-01"))}}</td>
                        <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$lastBill->arrear_balance }}</td>
                        <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$lastBill->arrear_interest_balance }}</td>
                    </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align: right; font-weight: bold;" colspan="2">Total</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center; font-weight: bold;">{{$total}}</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center; font-weight: bold;"></td>
                </tr>
               
            </tbody>
        </table>
        @endif
        <div style="border: 1px solid #000; padding: 5px; margin-top: 30px;background-color: lightblue;"><h3 style="text-align: center;">Total amount to be paid</h3></div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
            <thead>
                <tr>
                    <th valign="top" style=" padding: 10px 5px; width: 50%;background-color: lightblue;">Particulars</th>
                    <th valign="top" style=" padding: 10px 5px; width: 50%;background-color: lightblue;">Amount in Rs.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px;text-align: right;">Balance Amount</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: center;">{{($lastBill?$lastBill->balance_amount:0)+$TransBillGenerate->arrear_bill}}</td>
                </tr>
                 @if($TransBillGenerate && !empty($TransBillGenerate) && 0 < $TransBillGenerate->credit_amount)
                    <tr>
                        <td valign="top" style="background-color: #f1f3f4; padding: 5px;text-align: right;">Credit Amount</td>
                        <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: center;">{{$TransBillGenerate->credit_amount}}</td>
                    </tr>
                @endif
                {{-- <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Total arrear charges</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: center;">{{$total}}</td>
                </tr> --}}
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px;text-align: right;">Service Charges</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: center;">{{$total_service}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: right; font-weight: bold;">Bill Amount Before due date</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: center; font-weight: bold;">{{ceil($total_service+$total)}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: right; font-weight: bold;">Bill Amount After due date</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: center; font-weight: bold;">{{ceil($total_service_after_due+$total)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>