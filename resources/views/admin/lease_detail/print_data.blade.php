<table border="1" style="border-collapse:collapse; max-width: 100%;">
    <tr>
        <th>lease_rule_16_other</th>
        <th>lease_basis</th>
        <th>area</th>
        <th>lease_period</th>
        <th>lease_start_date</th>
        <th>lease_rent</th>
        <th>lease_rent_start_month</th>
        <th>interest_per_lease_agreement</th>
        <th>lease_renewal_date</th>
        <th>lease_renewed_period</th>
        <th>rent_per_renewed_lease</th>
        <th>interest_per_renewed_lease_agreement</th>
        <th>month_rent_per_renewed_lease</th>
        <th>payment_detail</th>
        <th>lease_status</th>
        <th>society_name</th>
    <tr>
    @foreach($lease_data as $lease_dat)
    <tr>
        <td>{{$lease_dat->lease_rule_16_other}}</td>
        <td>{{$lease_dat->lease_basis}}</td>
        <td>{{$lease_dat->area}}</td>
        <td>{{$lease_dat->lease_period}}</td>
        <td>{{$lease_dat->lease_start_date}}</td>
        <td>{{$lease_dat->lease_rent}}</td>
        <td>{{$lease_dat->lease_rent_start_month}}</td>
        <td>{{$lease_dat->interest_per_lease_agreement}}</td>
        <td>{{$lease_dat->lease_renewal_date}}</td>
        <td>{{$lease_dat->lease_renewed_period}}</td>
        <td>{{$lease_dat->rent_per_renewed_lease}}</td>
        <td>{{$lease_dat->interest_per_renewed_lease_agreement}}</td>
        <td>{{$lease_dat->month_rent_per_renewed_lease}}</td>
        <td>{{$lease_dat->payment_detail}}</td>
        <td>{{$lease_dat->lease_status}}</td>
        <td>{{$lease_dat->society_name}}</td>
    </tr>
    @endforeach
</table>

<script type="text/javascript">
window.print();
</script>