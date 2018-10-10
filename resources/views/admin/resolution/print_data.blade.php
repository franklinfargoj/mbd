<div id="print_data">
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
</div>

<script type="text/javascript">
printContent('print_data');
function printContent(element) {
    alert();
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(element).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
    window.location = "{{route('resolution.index')}}";
}
</script>