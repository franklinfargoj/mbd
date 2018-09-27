<table border="1" style="border-collapse:collapse; max-width: 100%;">
    <tr>
        @foreach($dataListKeys as $dataListKey)
            <th>{{$dataListKey}}</th>
        @endforeach
    <tr>
    @foreach($dataListMaster as $village_dat)
    <tr>
        <td>{{$village_dat['id']}}</td>
        <td>{{$village_dat['Board']}}</td>
        <td>{{$village_dat['Land Sr. No']}}</td>
        <td>{{$village_dat['Village Name']}}</td>
        <td>{{$village_dat['Land Source']}}</td>
        <td>{{$village_dat['Land Address']}}</td>
        <td>{{$village_dat['District']}}</td>
        <td>{{$village_dat['Taluka']}}</td>
        <td>{{$village_dat['Total Area']}}</td>
        <td>{{$village_dat['Possession Date']}}</td>
        <td>{{$village_dat['Remark']}}</td>
        <td>{{$village_dat['Land Cost']}}</td>
        <td>{{$village_dat["Is 7/12 on MHADA's Name"]}}</td>
        <td>{{$village_dat['Property Card']}}</td>
        <td>{{$village_dat['Is Property card (PR card) is on MHADA’s name']}}</td>
        <td>{{$village_dat['7/12 Extract']}}</td>
        <td>{{$village_dat['7/12 Extract file name']}}</td>
    </tr>
    @endforeach
</table>

<script type="text/javascript">
window.print();
</script>