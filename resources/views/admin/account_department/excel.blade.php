
            <!--begin: Datatable -->
            <table>
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Old Rate</th>
                    <th>Interest % on Old Rate</th>
                    <th>Revised Rate</th>
                    <th>Interest % on Difference</th>
                    <th>Payment Status</th>
                    <th>Final Rent Amount</th>
                </tr>
            </thead>
            <tbody id="myTable">
            @if(!empty($arrears_calculations) && !empty($arrears_charges))
                @foreach($arrears_calculations as $key => $value )
                    <tr>    
                        <td>{{date("M", mktime(0, 0, 0, $value->month, 10))}}</td>
                        <td>{{$value->year}}</td>
                        <td>{{$arrears_charges->old_rate}}</td>
                        <td>{{$arrears_charges->interest_on_old_rate}}</td>
                        <td>{{$arrears_charges->revise_rate}}</td>
                        <td>{{$arrears_charges->interest_on_differance}}</td>
                        <td>{{$value->payment_status}}</td>
                        <td>{{$value->total_amount}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center">No Data Found.</td>
                </tr>
            @endif
            </tbody>
            </table>
            