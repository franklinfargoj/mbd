@php
if($period_title == "")
    $period_title = "All";
@endphp

<h3>PeriodWisePendency({{$module_name}}):-({{$period_title}})</h3>
<table style="border-collapse:collapse;width:100%;text-align:center;padding:5px;" border="1">
    <thead>
        <tr>
            <th>Application No</th>
            <th>Layout Name</th>
            <th>Submission Date</th>
            <th>Society Name</th>
            <th>Building No</th>
            <th>Model</th>
            <th>Pending at User</th>
            <th>Pending Days</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{$item->application_no}}</td>
            <td>{{$item->layout_name}}</td>
            <td>{{$item->created_at}}</td>
            <td>{{$item->society_name}}</td>
            <td>{{$item->building_no}}</td>
            <td>{{$item->model}}</td>
            <td>{{$item->User}}[{{$item->Role}}]</td>
            <td>{{$item->days_pending}}</td>
        </tr>
        @endforeach
    </tbody>
</table>