<table border="1" style="border-collapse:collapse; max-width: 100%;">
    <tr>
        <th>society_name</th>
        <th>district</th>
        <th>taluka</th>
        <th>village</th>
        <th>survey_number</th>
        <th>cts_number</th>
        <th>chairman</th>
        <th>society_address</th>
        <th>area</th>
        <th>date_on_service_tax</th>
        <th>surplus_charges</th>
        <th>surplus_charges_last_date</th>
        <th>village_name</th>
        <th>land_name</th>
    <tr>
    @foreach($society_data as $society_dat)
    <tr>
        <td>{{$society_dat->society_name}}</td>
        <td>{{$society_dat->district}}</td>
        <td>{{$society_dat->taluka}}</td>
        <td>{{$society_dat->village}}</td>
        <td>{{$society_dat->survey_number}}</td>
        <td>{{$society_dat->cts_number}}</td>
        <td>{{$society_dat->chairman}}</td>
        <td>{{$society_dat->society_address}}</td>
        <td>{{$society_dat->area}}</td>
        <td>{{$society_dat->date_on_service_tax}}</td>
        <td>{{$society_dat->surplus_charges}}</td>
        <td>{{$society_dat->surplus_charges_last_date}}</td>
        <td>{{$society_dat->village_name}}</td>
        <td>{{$society_dat->land_name}}</td>
    </tr>
    @endforeach
</table>

<script type="text/javascript">
window.print();
</script>