<div>
    <div>
        <h3>Bill for {{date('F', mktime(0, 0, 0, $bill[0]->bill_details->bill_month, 10))}}, {{$bill[0]->bill_details->bill_year}}</h3>
        <h3 style="text-decoration: underline; text-align: center;">Receipt for {{date('F', mktime(0, 0, 0, $bill[0]->bill_details->bill_month, 10))}}, {{$bill[0]->bill_details->bill_year}}</h3>
    </div>

    <table style="width: 720px;border-collapse: collapse;">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>
                                <img src="{{ public_path().'/img/logo-big.png' }}" style="width: 70%;">
                            </td>
                        </tr>
                    </table> 
                </td>
                <td style="width: 360px;">
                    <table style="font-size: 19px;">
                        <tr>
                            <td style="line-height: 20px;">Consumer No : BL-{{$consumer_number}}</td>
                        </tr>
                        <tr>
                            <td style="line-height: 20px;">Bill No : {{$bill[0]->bill_no}}</td>
                        </tr>
                        <tr>
                            <td style="line-height: 20px;">Building Name : {{$building->name}}</td>
                        </tr>
                    </table>
                </td>
                
            </tr>
        </table>


    <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
        <tbody>
            <tr>
                <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Total Tenament:</td>
                                <td valign="top" style="text-align: right;">{{$number_of_tenants->tenant_count()->first()->count}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Bill Period:</td>
                                <td valign="top" style="text-align: right;">{{$bill[0]->from_date}} to {{$bill[0]->to_date}}</td>
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
                                <td valign="top" style="font-weight: bold;">Society Name:</td>
                                <td valign="top" style="text-align: right;">{{$society->society_name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Bill Date:</td>
                                <td valign="top" style="text-align: right;">{{$bill[0]->bill_details->bill_date}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td rowspan="2" valign="top" style="background-color: #FFEFD5; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Address:</td>
                                <td valign="top" style="text-align: right;">{{$society->society_address}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Payment Date:</td>
                                <td valign="top" style="text-align: right;">{{date('d-m-Y', strtotime($bill[0]->created_at))}}</td>
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
                                <td valign="top" style="font-weight: bold;">Late Fee:</td>
                                <td valign="top" style="text-align: right;">{{$bill[0]->bill_details->late_fee_charge}}</td>
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
                                <td valign="top" style="font-weight: bold;">Amount Paid:</td>
                                <td valign="top" style="text-align: right;">{{$amount_paid}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Payment Mode:</td>
                                <td valign="top" style="text-align: right;"> {{$bill[0]->mode_of_payment}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="border: 1px solid #000; padding: 5px; margin-top: 30px; background-color: lightblue;"><h3 style="text-align: center;">Bill Summary for {{date('F', mktime(0, 0, 0, $bill[0]->bill_details->bill_month, 10))}}, {{$bill[0]->bill_details->bill_year}}</h3></div>
    <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
        <thead>
            <tr>
                <th valign="top" style="padding: 10px 5px; width: 40%;background-color: lightblue;">Payment Details</th>
                <th valign="top" style="padding: 10px 5px; width: 60%;background-color: lightblue;">Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Payment Mode:</td>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">{{$bill[0]->mode_of_payment}}</td>
            </tr>
            <tr>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Amount Paid By:</td>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">{{$bill[0]->paid_by}}</td>
            </tr>
            @if(isset($bill[0]->dd_details->dd_no))
            <tr>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">DD/Cheque No:</td>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">{{$bill[0]->dd_details->dd_no}}</td>
            </tr>
            <tr>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Bank Name:</td>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">{{$bill[0]->dd_details->bank_name}}</td>
            </tr>
            @endif
            <tr>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Amount Paid:</td>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">{{$amount_paid}}</td>
            </tr>
            <tr>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Payment made for months:</td>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">{{$bill[0]->from_date}} to {{$bill[0]->to_date}}</td>
            </tr>
            <tr>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Balance Amount:</td>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">{{$bill[0]->balance_amount}}</td>
            </tr>
            <tr>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">Credit Amount:</td>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px;">{{ $bill[0]->credit_amount}}</td>
            </tr>
        </tbody>
    </table>
    {{-- <div style="border: 2px solid #000; padding: 5px; margin-top: 160px;"><h3 style="text-align: center;">List of tenant for which receipt generated</h3></div>
    <table style="width: 100%; border-collapse: collapse; margin-top: 40px;">
        <thead>
            <tr>
                <th valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">Sr. No</th>
                <th valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">Room No</th>
                <th valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">Tenant Name</th>
            </tr>
        </thead>
        <tbody>
            @php
                $count = 1;
            @endphp
            @foreach($tenants as $row => $val) 
            <tr>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">&nbsp;{{$count++}}</td>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{$val->flat_no}}</td>
                <td valign="top" style="background-color: #f1f3f4; padding: 5px; text-align:center;">{{$val->first_name}}&nbsp;{{$val->last_name}}</td>
            </tr>
            @endforeach
    </table> --}}
</div>