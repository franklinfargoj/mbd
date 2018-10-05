<table border="1" style="border-collapse:collapse">
    <tr>
        @foreach($dataListKeys as $dataListKey)
            <th>{{$dataListKey}}</th>
        @endforeach
    <tr>
    @foreach($dataListMaster as $resolution)
    <tr>
        @foreach($dataListKeys as $dataListKey)
            <td>{{$resolution[$dataListKey]}}</td>
        @endforeach
    </tr>
    @endforeach
</table>

<script type="text/javascript">
window.print();
</script>