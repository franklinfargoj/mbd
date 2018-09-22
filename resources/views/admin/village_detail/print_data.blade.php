<table border="1" style="border-collapse:collapse; max-width: 100%;">
    <tr>
        <th>board</th>
        <th>sr_no</th>
        <th>village_name</th>
        <th>land_address</th>
        <th>district</th>
        <th>taluka</th>
        <th>total_area</th>
        <th>possession_date</th>
        <th>remark</th>
        <th>7_12_extract</th>
        <th>7_12_mhada_name</th>
        <th>property_card</th>
        <th>property_card_mhada_name</th>
        <th>land_cost</th>
        <th>created_at</th>
        <th>updated_at</th>
    <tr>
    @foreach($village_data as $village_dat)
    <tr>
        <td>{{$village_dat->board}}</td>
        <td>{{$village_dat->sr_no}}</td>
        <td>{{$village_dat->village_name}}</td>
        <td>{{$village_dat->land_address}}</td>
        <td>{{$village_dat->district}}</td>
        <td>{{$village_dat->taluka}}</td>
        <td>{{$village_dat->total_area}}</td>
        <td>{{$village_dat->possession_date}}</td>
        <td>{{$village_dat->remark}}</td>
        <td>{{$village_dat['7_12_extract']}}</td>
        <td>{{$village_dat['7_12_mhada_name']}}</td>
        <td>{{$village_dat->property_card}}</td>
        <td>{{$village_dat->property_card_mhada_name}}</td>
        <td>{{$village_dat->land_cost}}</td>
        <td>{{$village_dat->created_at}}</td>
        <td>{{$village_dat->updated_at}}</td>
    </tr>
    @endforeach
</table>

<script type="text/javascript">
window.print();
</script>