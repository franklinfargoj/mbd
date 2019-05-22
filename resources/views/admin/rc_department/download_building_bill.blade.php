<body>
    @php 
        $total_service = $TransBillGenerate->service_charges->water_charges + $TransBillGenerate->service_charges->electric_city_charge + $TransBillGenerate->service_charges->pump_man_and_repair_charges + $TransBillGenerate->service_charges->external_expender_charge + $TransBillGenerate->service_charges->administrative_charge + $TransBillGenerate->service_charges->lease_rent + $TransBillGenerate->service_charges->na_assessment + $TransBillGenerate->service_charges->other; 

        $total_service = $total_service;

        $total_after_due = $total_service * 0.015; 

        $total_service_after_due = $total_service + $total_after_due;   

        $total ='0';    

        $tempBalance = 0;
        // if($lastBill) {
        //         if( 0 < $lastBill->total_bill_after_due_date ) {
        //             $tempBalance += $lastBill->balance;
        //         }
        // }      
    @endphp
    @if(!$arreasCalculation->isEmpty())  
      @foreach($arreasCalculation as $calculation)
            @php $total = $total + $calculation->total_amount; @endphp
      @endforeach
    @endif  
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
                            <td style="line-height: 20px;">Consumer No: BL-{{$consumer_number}}</td>
                        </tr>
                        <tr>
                            <td style="line-height: 20px;">Society Name: @if(!empty($society)){{$society->society_name}}@endif</td>
                        </tr>
                        <tr>
                            <td style="line-height: 20px;">Bill No: {{$Tenant_bill_id->bill_number}}</td>
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
                                    <td valign="top" style="font-weight: bold;">Buidling Name : {{$building->name}}</td>
                                    <td valign="top" style="text-align: right;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Bill Period : {{date('1-M-Y', strtotime($TransBillGenerate->bill_from))}} to {{date('1-M-Y',strtotime($TransBillGenerate->bill_to))}}</td>
                                    <td valign="top" style="text-align: right;"></td>
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
                                    <td valign="top" style="text-align: right;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Bill Date : {{date('d-M-Y',strtotime($TransBillGenerate->bill_date))}} </td>
                                    <td valign="top" style="text-align: right;"></td>
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
                                    <td valign="top" style="font-weight: bold;">Total Tenament : {{ $number_of_tenants->tenant_count()->first()->count }}</td>
                                    <td valign="top" style="text-align: right;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Due Date : {{date('d-M-Y', strtotime($TransBillGenerate->due_date))}} </td>
                                    <td valign="top" style="text-align: right;"></td>
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
                                    <td valign="top" style="font-weight: bold;">Amount : {{$TransBillGenerate->total_bill_temp}}</td>
                                    <td valign="top" style="text-align: right;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td valign="top" style="font-weight: bold;">Late fee charge : {{ $TransBillGenerate->late_fee_charge}}</td>
                                    <td valign="top" style="text-align: right;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="border: 1px solid #000; padding: 5px; margin-top: 30px;background-color: lightblue;"><h3 style="text-align: center;">Bill Summary - {{date("M", strtotime("2001-" . $month . "-01"))}}, {{date('Y',strtotime($TransBillGenerate->bill_date))}}</h3></div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
            <thead>
                <tr>
                    <th valign="top" style="background-color: lightblue; padding:10px 5px; width: 40%;">Bill Title - {{date("M", strtotime("2001-" . $month . "-01"))}}</th>
                    <th valign="top" style="background-color: lightblue; padding:10px 5px; width: 60%;">Amount in Rs.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Water Charges:</td>
                    <td valign="top" style="background-color: #f1f3f4; text-align: center; padding: 5px; text-align: center;">{{$TransBillGenerate->service_charges->water_charges==null?'0.00':$TransBillGenerate->service_charges->water_charges}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Electric City Charge:</td>
                    <td valign="top" style="background-color: #f1f3f4; text-align: center; padding: 5px; text-align: center;">{{$TransBillGenerate->service_charges->electric_city_charge==null?'0.00':$TransBillGenerate->service_charges->electric_city_charge}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Pump Man & Repair Charges:</td>
                    <td valign="top" style="background-color: #f1f3f4; text-align: center; padding: 5px; text-align: center;">{{$TransBillGenerate->service_charges->pump_man_and_repair_charges==null?'0.00':$TransBillGenerate->service_charges->pump_man_and_repair_charges}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px;">External Expenditure Charge:</td>
                    <td valign="top" style="background-color: #f1f3f4; text-align: center; padding: 5px; text-align: center;">{{$TransBillGenerate->service_charges->external_expender_charge==null?'0.00':$TransBillGenerate->service_charges->external_expender_charge}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Administrative Charge:</td>
                    <td valign="top" style="background-color: #f1f3f4; text-align: center; padding: 5px; text-align: center;">{{$TransBillGenerate->service_charges->administrative_charge==null?'0.00':$TransBillGenerate->service_charges->administrative_charge}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Lease Rent:</td>
                    <td valign="top" style="background-color: #f1f3f4; text-align: center; padding: 5px; text-align: center;">{{$TransBillGenerate->service_charges->lease_rent==null?'0.00':$TransBillGenerate->service_charges->lease_rent}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px;">N.A.Assessment:</td>
                    <td valign="top" style="background-color: #f1f3f4; text-align: center; padding: 5px; text-align: center;">{{$TransBillGenerate->service_charges->na_assessment==null?'0.00':$TransBillGenerate->service_charges->na_assessment}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Property Tax:</td>
                    <td valign="top" style="background-color: #f1f3f4; text-align: center; padding: 5px; text-align: center;">{{$TransBillGenerate->service_charges->property_tax==null?'0.00':$TransBillGenerate->service_charges->property_tax}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Other:</td>
                    <td valign="top" style="background-color: #f1f3f4; text-align: center; padding: 5px; text-align: center;">{{$TransBillGenerate->service_charges->other==null?'0.00':$TransBillGenerate->service_charges->other}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; font-weight: bold; text-align: right;">Total:</td>
                    <td valign="top" style="background-color: #f1f3f4; text-align: center; padding: 5px; font-weight: bold; text-align: center;">{{$total_service}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; font-weight: bold; text-align: right;">After Due date 1.5% interest:</td>
                    <td valign="top" style="background-color: #f1f3f4; text-align: center; padding: 5px; font-weight: bold; text-align: center;">{{$total_after_due}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4; padding: 5px; font-weight: bold; text-align: right;">After Due date Amount payable:</td>
                    <td valign="top" style="background-color: #f1f3f4; text-align: center; padding: 5px; font-weight: bold; text-align: center;">{{$total_service_after_due}}</td>
                </tr>
            </tbody>
        </table>
        @if($lastBill==null)
        @if(!$arreasCalculation->isEmpty())
            @php $total ='0'; @endphp

        <div style="border: 1px solid #000; padding: 5px; margin-top: 160px;"><h3 style="text-align: center;">Balance amount to be paid - Arrears</h3></div>
        <table class="display table table-responsive table-bordered" style="width:100%">
                <tr>
                    <th valign="top" style="border: 1px solid #000; padding: 5px; width: 25%;">Year</th>
                    <th valign="top" style="border: 1px solid #000; padding: 5px; width: 25%;">Month</th>
                    <th valign="top" style="border: 1px solid #000; padding: 5px; width: 25%;">Amount In Rs.</th>
                    <th valign="top" style="border: 1px solid #000; padding: 5px; width: 25%;">Penalty in Rs</th>
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
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align: center;">{{$calculation_year}} </td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align: center;">{{date("M", strtotime("2001-" . $calculation->month . "-01"))}}</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align: center;">{{$amont_in_rupees }}</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align: center;">{{$penalty_in_rupees}}</td>
                </tr>
                <tr>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align: center; font-weight: bold;" colspan="2">Total</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align: center; font-weight: bold;">{{$total}}</td>
                    <td valign="top" style="border: 1px solid #000; padding: 5px; text-align: center; font-weight: bold;"></td>
                </tr>
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
                    $total=$TransBillGenerate->prev_arrear_balance+$TransBillGenerate->prev_arrear_interest_balance;
                @endphp
                    <tr>
                        <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$lastBill->bill_year}}</td>
                        <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{date("M", strtotime("2001-" . $lastBill->bill_month . "-01"))}}</td>
                        <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$TransBillGenerate->prev_arrear_balance }}</td>
                        <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$TransBillGenerate->prev_arrear_interest_balance }}</td>
                    </tr>
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
                    <th valign="top" style=" padding: 5px; width: 50%; background-color: lightblue;">Particulars</th>
                    <th valign="top" style=" padding: 5px; width: 50%; background-color: lightblue;">Amount in Rs.</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                    <td valign="top" style=" padding:10px 5px;">Balance Amount</td>
                    <td valign="top" style=" padding:10px 5px; text-align: center;" class="text-center">{{($lastBill?$lastBill->balance_amount:0)+$TransBillGenerate->arrear_bill}}</td>
                </tr>
                @if($lastBill)
                @php
                    $credit_amount =0;
                    $credit_amount += $lastBill->credit_amount;
                @endphp
                @if(0 <$credit_amount)
                <tr>
                    <td valign="top" style="background-color: #f1f3f4;  padding: 5px;">Credit Amount</td>
                    <td valign="top" style="background-color: #f1f3f4;  padding: 5px; text-align: center;" class="text-center">{{$credit_amount}}</td>
                </tr>
                @endif
                @endif
                {{-- <tr>
                    <td valign="top" style="background-color: #f1f3f4;  padding: 5px;">Total arrear charges</td>
                    <td valign="top" style="background-color: #f1f3f4;  padding: 5px; text-align: center;" class="text-center">{{$total}}</td>
                </tr> --}}
                <tr>
                    <td valign="top" style="background-color: #f1f3f4;  padding: 5px;">Service Charges</td>
                    <td valign="top" style="background-color: #f1f3f4;  padding: 5px; text-align: center;" class="text-center">{{$total_service}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4;  padding: 5px;">Bill Amount Before due date</td>
                    <td valign="top" style="background-color: #f1f3f4;  padding: 5px; text-align: center;" class="text-center">{{$total_service+$total}}</td>
                </tr>
                <tr>
                    <td valign="top" style="background-color: #f1f3f4;  padding: 5px;">Bill Amount After due date</td>
                    <td valign="top" style="background-color: #f1f3f4;  padding: 5px; text-align: center;" class="text-center">{{$total_service_after_due+$total}}</td>
                </tr>
                {{-- <tr>
                    <td valign="top" style="background-color: #f1f3f4;  padding: 5px; font-weight: bold;">Grand Total</td>
                    <td valign="top" style="background-color: #f1f3f4;  padding: 5px; text-align: center; font-weight: bold;">{{$TransBillGenerate->total_bill_temp}}</td>
                </tr> --}}
            </tbody>
        </table>
    </div>
</div>