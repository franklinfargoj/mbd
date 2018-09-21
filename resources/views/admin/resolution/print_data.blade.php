<table border="1" style="border-collapse:collapse">
    <tr>
        <th>board_name</th>
        <th>department_name</th>
        <th>resolutionType</th>
        <th>resolution_code</th>
        <th>published_date</th>
        <th>filepath</th>
        <th>filename</th>
    <tr>
    @foreach($resolutions as $resolution)
    <tr>
        <td>{{$resolution->board_name}}</td>
        <td>{{$resolution->department_name}}</td>
        <td>{{$resolution->resolutionType}}</td>
        <td>{{$resolution->resolution_code}}</td>
        <td>{{$resolution->published_date}}</td>
        <td>{{$resolution->filepath}}</td>
        <td>{{$resolution->filename}}</td>
    </tr>
    @endforeach
</table>

<script type="text/javascript">
window.print();
</script>