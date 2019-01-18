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
                $status= $hearing['hearingStatusLog']['0']['hearing_status_id'];
                $config_array = array_flip(config('commanConfig.hearingStatus'));
                $hearing_status = ucwords(str_replace('_', ' ', $config_array[$status]));

                if($hearing_status == 'Scheduled Meeting' && count($hearing['hearingSchedule']['prePostSchedule']) > 0) {
                    if ($hearing['hearingSchedule']['prePostSchedule'][0]['pre_post_status'] == 1) {
                        $hearing_status = $hearing_status . ' Preponed';
                    }else{
                        $hearing_status = $hearing_status . ' Postponed';
                    }
                }

            @endphp
            <td>{{$hearing_status}}</td>
        </tr>

        @php
            $i++;
        @endphp
    @endforeach
</table>

<script type="text/javascript">
    window.print();
</script>