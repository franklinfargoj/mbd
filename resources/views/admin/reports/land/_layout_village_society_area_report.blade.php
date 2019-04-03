
<h3>Layout - Village - Society - Area Report :(Layouts : {{$layout_names}})</h3>
<table style="border-collapse:collapse;width:100%;text-align:center;padding:5px;" border="1">
    <thead>
    <tr>
        <th>No</th>
        <th>Layout Name</th>
        <th>Village Name</th>
        <th>Village Area(m.sq.)</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($dataListMaster as $key => $data)
        <tr>
            <td>{{$data['id']}}</td>
            <td>{{$data['Layout Name']}}</td>
            <td>{{$data['Village Name']}}</td>
            <td>{{$data['Village Area(m.sq.)']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
