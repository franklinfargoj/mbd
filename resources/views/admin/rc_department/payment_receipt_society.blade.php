<div>
    <div>
        <h3>Bill for {{date('F', mktime(0, 0, 0, $bill[0]->bill_details->bill_month, 10))}}, {{$bill[0]->bill_details->bill_year}}</h3>
        <h3 style="text-decoration: underline; text-align: center;">Receipt for {{date('F', mktime(0, 0, 0, $bill[0]->bill_details->bill_month, 10))}}, {{$bill[0]->bill_details->bill_year}}</h3>
    </div>
    <div>
        <div style="width: 100%; margin-top: 30px;">
            <div style="width: 100%; float: left; margin-bottom: 20px;">
                <div style="width: 30%; float: left;">Consumer No:</div>
                <div style="width: 70%; float: left;">BL-{{$consumer_number}}</div>
            </div>
            <div style="clear:both;"></div>
            <div style="width: 100%;float: left; margin-bottom: 20px;">
                <div style="width: 30%; float: left;">Bill No:</div>
                <div style="width: 70%; float: left;">{{$bill[0]->bill_no}}</div>
            </div>
<!--             <div style="clear:both;"></div>
<div style="width: 100%; float: left; margin-bottom: 20px;">
    <div style="width: 30%; float: left;">Room No:</div>
    <div style="width: 70%; float: left;"></div>
</div> -->
            <div style="clear:both;"></div>
            <div style="width: 100%;float: left; margin-bottom: 20px;">
                <div style="width: 30%; float: left;">Building Name:</div>
                <div style="width: 70%; float: left;">{{$building->name}}</div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
        <tbody>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Total Tenament:</td>
                                <td valign="top" style="text-align: right;">{{$number_of_tenants->tenant_count()->first()->count}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
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
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Society Name:</td>
                                <td valign="top" style="text-align: right;">{{$society->society_name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
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
                <td rowspan="2" valign="top" style="border: 1px solid #000; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Address:</td>
                                <td valign="top" style="text-align: right;">{{$society->society_address}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
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
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
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
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Amount Paid:</td>
                                <td valign="top" style="text-align: right;">{{$amount_paid}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
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
    <div style="border: 2px solid #000; padding: 5px; margin-top: 30px;"><h3 style="text-align: center;">Bill Summary for {{date('F', mktime(0, 0, 0, $bill[0]->bill_details->bill_month, 10))}}, {{$bill[0]->bill_details->bill_year}}</h3></div>
    <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
        <thead>
            <tr>
                <th valign="top" style="border: 1px solid #000; padding: 5px; width: 40%;">Payment Details</th>
                <th valign="top" style="border: 1px solid #000; padding: 5px; width: 60%;">Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">Payment Mode:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$bill[0]->mode_of_payment}}</td>
            </tr>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">Amount Paid By:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$bill[0]->paid_by}}</td>
            </tr>
            @if(isset($bill[0]->dd_details->dd_no))
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">DD/Cheque No:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$bill[0]->dd_details->dd_no}}</td>
            </tr>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">Bank Name:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$bill[0]->dd_details->bank_name}}</td>
            </tr>
            @endif
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">Amount Paid:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$amount_paid}}</td>
            </tr>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">Payment made for months:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$bill[0]->from_date}} to {{$bill[0]->to_date}}</td>
            </tr>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">Balance Amount:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$balance_amount}}</td>
            </tr>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">Credit Amount:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{ $credit_amount}}</td>
            </tr>
        </tbody>
    </table>
    <div style="border: 2px solid #000; padding: 5px; margin-top: 160px;"><h3 style="text-align: center;">List of tenant for which receipt generated</h3></div>
    <table style="width: 100%; border-collapse: collapse; margin-top: 40px;">
        <thead>
            <tr>
                <th valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">Sr. No</th>
                <th valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">Room No</th>
                <th valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">Tenant Name</th>
            </tr>
        </thead>
        <tbody>
            @php
                $count = 1;
            @endphp
            @foreach($tenants as $row => $val) 
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">&nbsp;{{$count++}}</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$val->flat_no}}</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px; text-align:center;">{{$val->first_name}}&nbsp;{{$val->last_name}}</td>
            </tr>
            @endforeach
    </table>
</div>