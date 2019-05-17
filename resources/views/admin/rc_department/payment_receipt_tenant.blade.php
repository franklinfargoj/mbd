<div>
    <div>
        <h3>Bill for {{date('F', mktime(0, 0, 0, $bill->bill_details->bill_month, 10))}}, {{$bill->bill_details->bill_year}}</h3>
        <h3 style="text-decoration: underline; text-align: center;">Receipt for {{date('F', mktime(0, 0, 0, $bill->bill_details->bill_month, 10))}}, {{$bill->bill_details->bill_year}}</h3>
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
                            <td style="line-height: 20px;">Bill No : {{$bill->bill_no}}</td>
                        </tr>
                        <tr>
                            <td style="line-height: 20px;">Room No : {{$tenant->flat_no}}</td>
                        </tr>
                        <tr>
                            <td style="line-height: 20px;">Tenant Name : {{$tenant->first_name}} {{$tenant->last_name}}</td>
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
                                <td valign="top" style="font-weight: bold;">Building name:</td>
                                <td valign="top" style="text-align: right;">{{$building->name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Bill Period:</td>
                                <td valign="top" style="text-align: right;">{{$bill->from_date}} to {{$bill->to_date}}</td>
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
                                <td valign="top" style="text-align: right;">{{$bill->bill_details->bill_date}}</td>
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
                                <td valign="top" style="text-align: right;">{{date('d-m-Y', strtotime($bill->created_at))}}</td>
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
                                <td valign="top" style="font-weight: bold;">Late Fee Charge:</td>
                                <td valign="top" style="text-align: right;">{{$bill->bill_details->late_fee_charge}}</td>
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
                                <td valign="top" style="text-align: right;">{{$bill->amount_paid}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="background-color: #FFEFD5; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Payment Mode:</td>
                                <td valign="top" style="text-align: right;">{{$bill->mode_of_payment}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="border: 1px solid #000; padding: 5px; margin-top: 30px;background-color: lightblue;"><h3 style="text-align: center;">Bill Summary for {{date('F', mktime(0, 0, 0, $bill->bill_details->bill_month, 10))}}, {{$bill->bill_details->bill_year}} </h3></div>
    <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
        <thead>
            <tr>
                <th valign="top" style="padding: 10px 5px; width: 40%;background-color: lightblue;">Payment Details</th>
                <th valign="top" style="padding: 10px 5px; width: 40%;background-color: lightblue;">Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td valign="top" style="background-color: #f1f3f4;">Payment Mode:</td>
                <td valign="top" style="padding: 5px; background-color: #f1f3f4;"> {{$bill->mode_of_payment}}</td>
            </tr>
            <tr>
                <td valign="top" style="background-color: #f1f3f4;">Amount Paid By:</td>
                <td valign="top" style="padding: 5px; background-color: #f1f3f4;">{{$bill->paid_by}}</td>
            </tr>
            @if(isset($bill->dd_details->dd_no))
            <tr>
                <td valign="top" style="background-color: #f1f3f4;">DD/Cheque No:</td>
                <td valign="top" style="padding: 5px; background-color: #f1f3f4;">{{$bill->dd_details->dd_no}}</td>
            </tr>
            <tr>
                <td valign="top" style="background-color: #f1f3f4;">Bank Name:</td>
                <td valign="top" style="padding: 5px; background-color: #f1f3f4;">{{$bill->dd_details->bank_name}}</td>
            </tr>
            @endif
            <tr>
                <td valign="top" style="background-color: #f1f3f4;">Amount Paid:</td>
                <td valign="top" style="padding: 5px; background-color: #f1f3f4;">{{$bill->amount_paid}}</td>
            </tr>
            <tr>
                <td valign="top" style="background-color: #f1f3f4;">Payment made for months:</td>
                <td valign="top" style="padding: 5px; background-color: #f1f3f4;">{{$bill->from_date}} to {{$bill->to_date}}</td>
            </tr>
            <tr>
                <td valign="top" style="background-color: #f1f3f4;">Balance Amount:</td>
                <td valign="top" style="padding: 5px; background-color: #f1f3f4;">{{$bill->balance_amount}}</td>
            </tr>
            <tr>
                <td valign="top" style="background-color: #f1f3f4;">Credit Amount:</td>
                <td valign="top" style="padding: 5px; background-color: #f1f3f4;">{{ $bill->credit_amount}}</td>
            </tr>
        </tbody>
    </table>
</div>