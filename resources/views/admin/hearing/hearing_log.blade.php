@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.hearing.actions',compact('hearing_data'))
@endsection
@section('content')
    {{--    {{dd($hearing_data->hearingSchedule1->toArray())}}--}}
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
                            <th class="th-sm">Case Log Type</th>
                            <th class="th-sm">User</th>
                            <th class="th-sm">Role</th>
                            <th class="th-sm">Date</th>
                            <th class="th-sm">Time</th>
                            <th class="th-sm">Case Template</th>
                            <th class="th-sm">Supporting documents</th>
                            <th class="th-sm">Judgement Case Template</th>
                            <th class="th-sm">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($hearing_data->hearingSchedule1 as $log)
                            @if(isset($log->scheduledCaseJudagementDetails))
                                <tr>
                                    <td> {{$i}}</td>
                                    <td>Schedule Meeting</td>
                                    <td> {{ $log->userDetails->name }}</td>
                                    <td> {{ $log->userDetails->roleDetails->name }}</td>
                                    <td class="text-nowrap"> {{ $log->preceding_date }}</td>
                                    <td class="text-nowrap"> {{ $log->preceding_time }}</td>
                                    <td>
                                        @if($log->case_template)
                                            <div class="d-flex justify-content-center btn-icon-list">
                                                <a href="{{ asset($log->case_template) }}" target="_blank">
                                                    <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}">
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($log->update_supporting_documents)
                                            <div class="d-flex justify-content-center btn-icon-list">

                                                <a href="{{ $log->update_supporting_documents }}"
                                                   target="_blank"> <img class="pdf-icon"
                                                                         src="{{ asset('/img/pdf-icon.svg')}}"></a>
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-center btn-icon-list">
                                                N.A.
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($log->scheduledCaseJudagementDetails)
                                            <div class="d-flex justify-content-center btn-icon-list">
                                                <a href="{{ config('commanConfig.storage_server').'/'.$log->scheduledCaseJudagementDetails->upload_judgement_case }}"
                                                   target="_blank">
                                                    <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}">
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center btn-icon-list">
                                            <a class="d-flex flex-column align-items-center" data-toggle="modal" data-target="#scheduledModal">
                                                    <span class="btn-icon btn-icon--view">
                                                        <img src="{{ asset('/img/view-icon.svg')}}">
                                                    </span>View
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <div style="top: 50%; transform: translateY(-50%)" class="modal fade" id="scheduledModal" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Description</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{$log->description}}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @if(isset($log->prePostSchedule))
                                @if(count($log->prePostSchedule) > 0)
                                    <tr>
                                        <td> {{$i}}</td>
                                        <td class="text-center">Pre/Post Schedule Meeting</td>
                                        <td> {{ $log->prePostSchedule['0']->userDetails->name }}</td>
                                        <td> {{ $log->prePostSchedule['0']->userDetails->roleDetails->name }}</td>
                                        <td> {{ $log->prePostSchedule['0']->date }}</td>
                                        <td> {{ $log->prePostSchedule['0']->time }}</td>
                                        <td>
{{--                                            @php dd($log->case_template) @endphp--}}
                                            @if($log->prePostSchedule['0']->hearing_schedule_id == $log->id)
                                                <div class="d-flex justify-content-center btn-icon-list">
                                                    <a href="{{ $log->case_template }}"
                                                    target="_blank">
                                                        <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}">
                                                    </a>
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-center btn-icon-list">
                                                    N.A.
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($log->prePostSchedule['0']->hearing_schedule_id == $log->id)
                                                <div class="d-flex justify-content-center btn-icon-list">
                                                    <a href="{{$log->update_supporting_documents }}"
                                                       target="_blank">
                                                        <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}">
                                                    </a>
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-center btn-icon-list">
                                                    N.A.
                                                </div>
                                            @endif
                                            {{--@if($log->upload_judgement_case)--}}
                                            {{--<a href="{{ config('commanConfig.storage_server').'/'.$log->upload_judgement_case }}" target="_blank"> <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>--}}
                                            {{--@endif--}}
                                        </td>
                                        <td>
                                            @if($log->prePostSchedule['0']->prePostCaseJudagementDetails)
                                                <div class="d-flex justify-content-center btn-icon-list">
                                                    <a href="{{ config('commanConfig.storage_server').'/'.$log->prePostSchedule['0']->prePostCaseJudagementDetails->upload_judgement_case }}"
                                                       target="_blank">
                                                        <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}">
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center btn-icon-list">
                                                <a class="d-flex flex-column align-items-center" data-toggle="modal" data-target="#prePostModal">
                                                    <span class="btn-icon btn-icon--view">
                                                        <img src="{{ asset('/img/view-icon.svg')}}">
                                                    </span>View
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div style="top: 50%; transform: translateY(-50%)" class="modal fade" id="prePostModal" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Description</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{$log->prePostSchedule['0']->description}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endif
                            @endif
                            @php $i++; @endphp
                        @endforeach
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

        $('table').dataTable({searching: false, ordering: false, info: false});
    </script>
@endsection