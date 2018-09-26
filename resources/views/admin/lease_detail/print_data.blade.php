<table border="1" style="border-collapse:collapse; max-width: 100%;">
    <tr>
        @foreach($dataListKeys as $dataListKey)
            <th>{{$dataListKey}}</th>
        @endforeach
    <tr>
    @foreach($dataListMaster as $lease_dat)
    <tr>
        <td>{{$lease_dat['id']}}</td>
        <td>{{$lease_dat['Lease rule 16 & other']}}</td>
        <td>{{$lease_dat['School/society/ others on lease basis']}}</td>
        <td>{{$lease_dat['Area']}}</td>
        <td>{{$lease_dat['Lease Period']}}</td>
        <td>{{$lease_dat['Start date of lease']}}</td>
        <td>{{$lease_dat['Land rent / lease rent']}}</td>
        <td>{{$lease_dat['Month to start collection of lease rent']}}</td>
        <td>{{$lease_dat['Interest as per Lease agreement, in %']}}</td>
        <td>{{$lease_dat['Date of Renewal of lease']}}</td>
        <td>{{$lease_dat['Period of renewed Lease']}}</td>
        <td>{{$lease_dat['Lease rent as per renewed lease']}}</td>
        <td>{{$lease_dat['Interest as per renewed Lease agreement, in %']}}</td>
        <td>{{$lease_dat['Month to start collection of lease rent as per renewed lease']}}</td>
    </tr>
    @endforeach
</table>

<script type="text/javascript">
window.print();
</script>