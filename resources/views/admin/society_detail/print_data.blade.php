<table border="1" style="border-collapse:collapse; max-width: 100%;">
    <tr>
        @foreach($dataListKeys as $dataListKey)
            <th>{{$dataListKey}}</th>
        @endforeach
    <tr>
    @foreach($dataListMaster as $society_dat)
    <tr>
        <td>{{$society_dat['id']}}</td>
        <td>{{$society_dat['Society Name']}}</td>
        <td>{{$society_dat['District']}}</td>
        <td>{{$society_dat['Taluka']}}</td>
        <td>{{$society_dat['Village']}}</td>
        <td>{{$society_dat['Survey Number']}}</td>
        <td>{{$society_dat['CTS Number']}}</td>
        <td>{{$society_dat['Chairman']}}</td>
        <td>{{$society_dat['Society Address']}}</td>
        <td>{{$society_dat['Area']}}</td>
        <td>{{$society_dat['Date mentioned on service tax letters']}}</td>
        <td>{{$society_dat['Surplus Charges']}}</td>
        <td>{{$society_dat['Lease rent as per renewed lease']}}</td>
        <td>{{$society_dat['Last date of paying surplus charges']}}</td>
        <td>{{$society_dat['Land Name']}}</td>
    </tr>
    @endforeach
</table>

<script type="text/javascript">
window.print();
</script>