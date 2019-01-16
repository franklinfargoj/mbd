<table border="1" style="border-collapse:collapse; max-width: 100%;">
    <tr>
        <th>Sr. No.</th>
        <th>Case No.</th>
        <th>Case Year</th>
        <th>Case Reg. Date</th>
        <th>Apellent Name</th>
        <th>Appelent Mobile No.</th>
        <th>Status</th>
    <tr>
    @php
        $i = 1;
    @endphp
    @foreach($hearing_data as $hearing)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $hearing['case_number'] }}</td>
            <td>{{ $hearing['case_year'] }}</td>
            <td>{{ $hearing['office_date'] }}</td>
            <td>{{ $hearing['applicant_name'] }}</td>
            <td>{{ $hearing['applicant_mobile_no'] }}</td>
            @php
                $config_array = array_flip(config('commanConfig.hearingStatus'));
                $current_status = $hearing['hearingStatusLog']['0']['hearing_status_id'];
            @endphp
            <td>{{ (array_key_exists($current_status, $config_array)) ? ucwords(str_replace('_', ' ', $config_array[$current_status])) : "" }}</td>
        </tr>

        @php
            $i++;
        @endphp
    @endforeach
</table>

<script type="text/javascript">
    window.print();
</script>