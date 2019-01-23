@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.hearing.actions',compact('hearing_data'))
@endsection
@section('content')
    {{--{{dd($hearing_data)}}--}}
    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                <div class="remark-body">
                    <div class="pb-2">
                        <h3 class="section-title section-title--small mb-2">
                            History:
                        </h3>
                    </div>
                </div>
                <div class="col-md-12 table-responsive">
                    <table id="dtBasicExample" class="table" style="font-size: 14px">
                        <thead>
                        <tr>
                            <th class="th-sm">sr.</th>
                            <th class="th-sm">Case Log Type</th>>
                            <th class="th-sm">Date</th>
                            <th class="th-sm">Time</th>
                            <th class="th-sm">User</th>
                            <th class="th-sm">Role</th>
                            <th class="th-sm">Case Template</th>
                            <th class="th-sm">Supporting documents</th>
                            <th class="th-sm">Judgement Case Template</th>
                            <th class="th-sm">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@php $i = 1; @endphp--}}
                        {{--@foreach($hearingLogs->hearingPrePostSchedule as $log)--}}
                            {{--<tr>--}}
                                {{--<td> {{$i}}</td>--}}
                                {{--<td> {{ isset($log->date) ? $log->date : '' }}</td>--}}
                                {{--<td> {{ isset($log->time) ? $log->time : '' }}</td>--}}
                                {{--<td> {{ isset($log->userDetails->name) ? $log->userDetails->name : '' }}</td>--}}
                                {{--<td> {{ isset($log->userDetails->roleDetails->name) ? $log->userDetails->roleDetails->name : '' }}</td>--}}
                                {{--<td> {{ isset($log->description) ? $log->description : '' }}</td>--}}
                            {{--</tr>--}}
                            {{--@php $i++; @endphp--}}
                        {{--@endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');

        $('#dtBasicExample_wrapper > .row:first-child').remove();
    });

    $('table').dataTable({searching: false, ordering:false, info: false});
</script>
@endsection