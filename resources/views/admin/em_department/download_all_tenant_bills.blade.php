<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

{{--@php--}}
    {{--//dd($pdf_data);die();--}}
{{--$mpdf = new \Mpdf\Mpdf();--}}
{{--@endphp--}}

{{--@foreach($pdf_data as $bill_data)--}}
    @php
        $total_service = $bill_data['TransBillGenerate']->service_charges->water_charges + $bill_data['TransBillGenerate']->service_charges->electric_city_charge + $bill_data['TransBillGenerate']->service_charges->pump_man_and_repair_charges + $bill_data['TransBillGenerate']->service_charges->external_expender_charge + $bill_data['TransBillGenerate']->service_charges->administrative_charge +$bill_data['TransBillGenerate']->service_charges->property_tax+ $bill_data['TransBillGenerate']->service_charges->lease_rent + $bill_data['TransBillGenerate']->service_charges->na_assessment + $bill_data['TransBillGenerate']->service_charges->other;
        $total_after_due = $total_service * 0.015;
        $total_service_after_due = $total_service + $total_after_due;
        $total ='0';
    @endphp

    @if(!$bill_data['arreasCalculation']->isEmpty())
        @foreach($bill_data['arreasCalculation'] as $calculation)
            @php $total = $total + $calculation->total_amount; @endphp
        @endforeach
    @endif

    <div>
        <div>
            <h3>Bill for {{date("M", strtotime("2001-" . $bill_data['month'] . "-01"))}}, {{$bill_data['year']}}</h3>
        </div>

        <table style="width: 720px;border-collapse: collapse;">
            <tr>
                <td style="text-align:center;">
                    <table>
                        <tr>
                            <td>
                                <img src="{{ public_path().'/img/logo-big.png' }}" style="width: 70%;">
                            </td>
                        </tr>
                    </table>
                    <span style="font-size: 19px;">MUMBAI BOARD</span>
                </td>
                <td style="width: 360px;">
                    <table style="font-size: 19px;">
                        <tr>
                            <td style="line-height: 20px;">Consumer No : TN-{{$bill_data['consumer_number']}}</td>
                        </tr>
                        <tr>
                            <td style="line-height: 20px;">Society Name : @if(!empty($bill_data['society'])){{$bill_data['society']->society_name}}@endif</td>
                        </tr>
                        <tr>
                            <td style="line-height: 20px;">Bill No : {{$bill_data['TransBillGenerate']->bill_number}}</td>
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
                            <td valign="top" style="font-weight: bold;">Tenant Name : {{$bill_data['tenant']->first_name.' '.$bill_data['tenant']->last_name}}</td>
                            <td valign="top" style="text-align: center;"></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                    <table>
                        <tbody>
                        <tr>
                            <td valign="top" style="font-weight: bold;">Bill Period :  {{date('1-M-Y', strtotime($bill_data['TransBillGenerate']->bill_from ))}} to {{date('d-M-Y',strtotime($bill_data['TransBillGenerate']->bill_to))}} </td>
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
                            <td valign="top" style="font-weight: bold;">Buidling Name : {{$bill_data['building']->name}}</td>
                            <td valign="top" style="text-align: center;"></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                    <table>
                        <tbody>
                        <tr>
                            <td valign="top" style="font-weight: bold;">Bill Date : {{date('d-M-Y',strtotime($bill_data['TransBillGenerate']->bill_date))}} </td>
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
                            <td valign="top" style="font-weight: bold;">Address : @if(!empty($bill_data['society'])){{$bill_data['society']->society_address}}@endif</td>
                            <td valign="top" style="text-align: center;"></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                    <table>
                        <tbody>
                        <tr>
                            <td valign="top" style="font-weight: bold;">Due Date : {{date('d-M-Y', strtotime($bill_data['TransBillGenerate']->due_date))}} </td>
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
                            <td valign="top" style="font-weight: bold;">Amount : {{$bill_data['TransBillGenerate']->total_bill}}</td>
                            <td valign="top" style="text-align: center;"></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                    <table>
                        <tbody>
                        <tr>
                            <td valign="top" style="font-weight: bold;">Late fee charge : {{ $bill_data['TransBillGenerate']->late_fee_charge}}</td>
                            <td valign="top" style="text-align: center;"></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
        <div style="border: 1px solid #000; padding: 5px; margin-top: 30px;background-color: lightblue;"><h3 style="text-align: center;">Bill Summary - {{date("M", strtotime("2001-" . $bill_data['month'] . "-01"))}}, {{$bill_data['year']}}</h3></div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
            <thead>
            <tr>
                <th valign="top" style=" padding: 10px 5px; width: 40%;background-color: lightblue;">Bill Title - {{date("M", strtotime("2001-" . $bill_data['month'] . "-01"))}}</th>
                <th valign="top" style=" padding: 10px 5px; width: 60%;background-color: lightblue;">Amount in Rs.</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">Water Charges</td>
                <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$bill_data['TransBillGenerate']->service_charges->water_charges}}</td>
            </tr>
            <tr>
                <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">Electric City Charge</td>
                <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$bill_data['TransBillGenerate']->service_charges->electric_city_charge}}</td>
            </tr>
            <tr>
                <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">Pump Man & Repair Charges</td>
                <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$bill_data['TransBillGenerate']->service_charges->pump_man_and_repair_charges}}</td>
            </tr>
            <tr>
                <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">External Expenditure Charge</td>
                <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$bill_data['TransBillGenerate']->service_charges->external_expender_charge}}</td>
            </tr>
            <tr>
                <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">Administrative Charge</td>
                <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$bill_data['TransBillGenerate']->service_charges->administrative_charge}}</td>
            </tr>
            <tr>
                <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">Lease Rent</td>
                <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$bill_data['TransBillGenerate']->service_charges->lease_rent}}</td>
            </tr>
            <tr>
                <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">N.A.Assessment</td>
                <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$bill_data['TransBillGenerate']->service_charges->na_assessment}}</td>
            </tr>
            <tr>
                <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">Property Tax</td>
                <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$bill_data['TransBillGenerate']->service_charges->property_tax==null?'0.00':$bill_data['TransBillGenerate']->service_charges->property_tax}}</td>
            </tr>
            <tr>
                <td valign="top" style=" padding: 5px; background-color: #f1f3f4;">Other</td>
                <td valign="top" style=" padding: 5px;text-align: center; background-color: #f1f3f4;">{{$bill_data['TransBillGenerate']->service_charges->other}}</td>
            </tr>
            <tr>
                <td valign="top" style=" padding: 5px; font-weight: bold; text-align: right; background-color: #f1f3f4;">Total</td>
                <td valign="top" style=" padding: 5px; font-weight: bold;text-align: center; background-color: #f1f3f4;">{{$total_service}}</td>
            </tr>
            <tr>
                <td valign="top" style=" padding: 5px; font-weight: bold; text-align: right; background-color: #f1f3f4;">After Due date 1.5% interest</td>
                <td valign="top" style=" padding: 5px; font-weight: bold;text-align: center; background-color: #f1f3f4;">{{ceil($total_after_due)}}</td>
            </tr>
            <tr>
                <td valign="top" style=" padding: 5px; font-weight: bold; text-align: right; background-color: #f1f3f4;">After Due date Amount payable</td>
                <td valign="top" style=" padding: 5px; font-weight: bold;text-align: center; background-color: #f1f3f4;">{{ceil($total_service_after_due)}}</td>
            </tr>
            </tbody>
        </table>
        @if($bill_data['lastBill']==null)
            @if(!$bill_data['arreasCalculation']->isEmpty())
                @php $total ='0'; @endphp

                <div style="border: 1px solid #000; padding: 5px; margin-top: 20px;background-color: lightblue;"><h3 style="text-align: center;">Balance amount to be paid - Arrears</h3></div>
                <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
                    <thead>
                    <tr>
                        <th valign="top" style="background-color:lightblue; padding: 5px; width: 25%;">Year</th>
                        <th valign="top" style="background-color:lightblue; padding: 5px; width: 25%;">Month</th>
                        <th valign="top" style="background-color:lightblue; padding: 5px; width: 25%;">Amount in Rs.</th>
                        <th valign="top" style="background-color:lightblue; padding: 5px; width: 25%;">Penalty in Rs.</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bill_data['arreasCalculation'] as $calculation)
                        @php $total = $total + $calculation->total_amount; @endphp
                        <tr>
                            <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{$calculation->year}}</td>
                            <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{date("M", strtotime("2001-" . $calculation->month . "-01"))}}</td>
                            <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{$calculation->total_amount- $calculation->old_intrest_amount - $calculation->difference_intrest_amount}}</td>
                            <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{$calculation->old_intrest_amount + $calculation->difference_intrest_amount}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: right; font-weight: bold;" colspan="2">Total</td>
                        <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center; font-weight: bold;">{{$total}}</td>
                        <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center; font-weight: bold;"></td>
                    </tr>

                    </tbody>
                </table>
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
                    $total=$bill_data['TransBillGenerate']->prev_arrear_balance+$bill_data['TransBillGenerate']->prev_arrear_interest_balance;
                @endphp
                <tr>
                     <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{$bill_data['lastBill']->bill_year}}</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{date("M", strtotime("2001-" . $bill_data['lastBill']->bill_month . "-01"))}}</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{$bill_data['lastBill']->arrear_balance }}</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{$bill_data['lastBill']->arrear_interest_balance }}</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{$bill_data['lastBill']->bill_year}}</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{date("M", strtotime("2001-" . $bill_data['lastBill']->bill_month . "-01"))}}</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{$bill_data['TransBillGenerate']->prev_arrear_balance }}</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{$bill_data['TransBillGenerate']->prev_arrear_interest_balance }}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: right; font-weight: bold;" colspan="2">Total</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center; font-weight: bold;">{{$total}}</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center; font-weight: bold;"></td>
                </tr>

                </tbody>
            </table>
        @endif
        <div style="border: 1px solid #000; padding: 5px; margin-top: 35px;background-color: lightblue;"><h3 style="text-align: center;">Total amount to be paid</h3></div>
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
                <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: center;">{{ceil($bill_data['TransBillGenerate']->prev_service_charge_balance+$bill_data['TransBillGenerate']->prev_arrear_balance+$bill_data['TransBillGenerate']->prev_arrear_interest_balance-$bill_data['TransBillGenerate']->prev_credit)}}</td>
            </tr>
            @if($bill_data['TransBillGenerate'] && !empty($bill_data['TransBillGenerate']) && 0 < $bill_data['TransBillGenerate']->credit_amount)
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px;text-align: right;">Credit Amount</td>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: center;">{{$bill_data['TransBillGenerate']->credit_amount}}</td>
                </tr>
            @endif
             <tr>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;text-align: right;">Total arrear charges</td>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: center;">{{$total}}</td>
            </tr>
            <tr>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;text-align: right;">Service Charges</td>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: center;">{{$total_service}}</td>
            </tr>
            <tr>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: right; font-weight: bold;">Bill Amount Before due date</td>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: center; font-weight: bold;">{{ceil($bill_data['TransBillGenerate']->monthly_bill+$bill_data['TransBillGenerate']->prev_service_charge_balance+$bill_data['TransBillGenerate']->prev_arrear_balance+$bill_data['TransBillGenerate']->prev_arrear_interest_balance-$bill_data['TransBillGenerate']->prev_credit)}}</td>
            </tr>
            <tr>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: right; font-weight: bold;">Bill Amount After due date</td>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align: center; font-weight: bold;">{{ceil($bill_data['TransBillGenerate']->total_service_after_due+$bill_data['TransBillGenerate']->prev_service_charge_balance+$bill_data['TransBillGenerate']->prev_arrear_balance+$bill_data['TransBillGenerate']->prev_arrear_interest_balance-$bill_data['TransBillGenerate']->prev_credit)}}</td>
            </tr>
            </tbody>
        </table>
    </div>
    {{--@php   $mpdf->AddPage();   @endphp--}}
    {{--<hr>--}}
    {{--<pagebreak />--}}


{{--@endforeach--}}
</body>
</html>