@php
    if($period_title == "")
        $period_title = "All";

//dd($data);
@endphp

<h3>Period Wise {{$module_name}}:-({{$period_title}})</h3>
<table style="border-collapse:collapse;width:100%;text-align:center;padding:5px;" border="1">
    <thead>
    <tr>
        <th>Sr. No.</th>
        <th>preceding_officer_name</th>
        <th>case_year</th>
        <th>case_number</th>
        <th>role_id</th>
        <th>application_type_id</th>
        <th>applicant_name</th>
        <th>applicant_mobile_no</th>
        <th>applicant_address</th>
        <th>respondent_name</th>
        <th>respondent_mobile_no</th>
        <th>respondent_address</th>
        <th>case_type</th>
        <th>office_year</th>
        <th>office_number</th>
        <th>office_date</th>
        <th>office_tehsil</th>
        <th>office_village</th>
        <th>office_remark</th>
        <th>department_id</th>
        <th>board_id</th>
        <th>hearing_status_id</th>
        {{--<th>hearing_schedule</th>--}}
        {{--<th>hearing_forward_case</th>--}}
        {{--<th>hearing_send_notice_to_appellant</th>--}}
        {{--<th>hearing_upload_case_judgement</th>--}}
    </tr>
    </thead>
    <tbody>
    @foreach ($data as $key => $item)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$item['preceding_officer_name']}}</td>
            <td>{{$item['case_year']}}</td>
            <td>{{$item['case_number']}}</td>
            <td>{{$item['role_id']}}</td>
            <td>{{$item['application_type_id']}}</td>
            <td>{{$item['applicant_name']}}</td>
            <td>{{$item['applicant_mobile_no']}}</td>
            <td>{{$item['applicant_address']}}</td>
            <td>{{$item['respondent_name']}}</td>
            <td>{{$item['respondent_mobile_no']}}</td>
            <td>{{$item['respondent_address']}}</td>
            <td>{{$item['case_type']}}</td>
            <td>{{$item['office_year']}}</td>
            <td>{{$item['office_number']}}</td>
            <td>{{$item['office_date']}}</td>
            <td>{{$item['office_tehsil']}}</td>
            <td>{{$item['office_village']}}</td>
            <td>{{$item['office_remark']}}</td>
            <td>{{$item['department_id']}}</td>
            <td>{{$item['board_id']}}</td>
            <td>{{$item['hearing_status_id']}}</td>
            {{--<td>{{$item['hearing_status_log']}}</td>--}}
            {{--<td>{{$item['hearing_schedule']}}</td>--}}
            {{--<td>{{$item['hearing_forward_case']}}</td>--}}
            {{--<td>{{$item['hearing_send_notice_to_appellant']}}</td>--}}
            {{--<td>{{$item['hearing_upload_case_judgement']}}</td>--}}
        </tr>
    @endforeach
    </tbody>
</table>