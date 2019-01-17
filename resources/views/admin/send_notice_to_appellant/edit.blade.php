@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.hearing.actions',compact('hearing_data'))
@endsection
@section('content')
@php
    $login_user = session()->get('role_name');
        if(($login_user == config('commanConfig.co_pa')) || ($login_user == config('commanConfig.joint_co_pa')))
            $visiblity = '';
        else
            $visiblity = 'disabled';
@endphp


<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Send Notice to Appellant</h3>
            {{ Breadcrumbs::render('Send Notice To Appellant', $arrData['hearing']->id) }}
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

        <form id="editSendNoticeToAppellant" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="{{route('send_notice_to_appellant.update', $arrData['hearing']->hearingSendNoticeToAppellant[0]->id)}}"
            enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="hearing_id" value="{{ $arrData['hearing']->id }}">
            <input type="hidden" name="notice" id="notice" value="{{ $arrData['hearing']->hearingSendNoticeToAppellant[0]->upload_notice }}">
            <input type="hidden" name="upload_notice_filename" id="upload_notice_filename" value="{{ $arrData['hearing']->hearingSendNoticeToAppellant[0]->upload_notice_filename }}">
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="m-portlet__head px-0">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Send Notice to Appellant :-
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <input disabled type="text" id="case_year" name="case_year" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->case_year }}" >
                        <span class="help-block">{{$errors->first('case_year')}}</span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                        <input disabled type="text" id="case_number" name="case_number" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->id }}">
                        <span class="help-block">{{$errors->first('case_number')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="appellant_name">Apellent Name:</label>
                        <input disabled type="text" id="appellant_name" name="appellant_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->applicant_name }}">
                        <span class="help-block">{{$errors->first('appellant_name')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="respondent_name">Respondent Name:</label>
                        <input disabled type="text" id="respondent_name" name="respondent_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->respondent_name }}">
                        <span class="help-block">{{$errors->first('respondent_name')}}</span>
                    </div>
                </div>

                {{--<div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label">Board:</label>
                        <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']->hearingBoard->board_name }}"
                            readonly>
                        <span class="help-block"></span>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label">Department:</label>
                        <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']->hearingDepartment->department_name }}"
                            readonly>
                        <span class="help-block"></span>
                    </div>
                </div>--}}

                <div class="m-portlet__head px-0 m-portlet__head--top">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Forward To :-
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label">Preceding Date:</label>
                        <input disabled type="text" class="form-control form-control--custom m-input m_datepicker" value="{{ $hearing_data['preceding_date'] }}"
                            >
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="preceding_time">Preceding Time:</label>
                        <input disabled type="text" id="preceding_time" name="preceding_time" class="form-control form-control--custom m-input"
                            value="{{$hearing_data['preceding_time'] }}"/>
                        <span class="help-block">{{$errors->first('preceding_time')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="upload_notice">Upload Notice:</label>
                        <div class="custom-file">
                            <input  {{$visiblity}} type="file" id="upload_notice" name="upload_notice" class="form-control form-control--custom"
                            style="display: none">
                            <label title="{{$arrData['hearing']->hearingSendNoticeToAppellant[0]->upload_notice_filename }}" class="custom-file-label" for="upload_notice">{{$arrData['hearing']->hearingSendNoticeToAppellant[0]->upload_notice_filename }}</label>
                            <span class="help-block">{{$errors->first('upload_notice')}}</span>
                        </div>
                        <span><a href="{{ config('commanConfig.storage_server').'/'. $hearing_data->hearingSendNoticeToAppellant[0]->upload_notice }}" target="_blank" rel="noopener">Download</a></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="comment">Comment:</label>
                        <textarea {{$visiblity}} id="comment" name="comment" class="form-control form-control--custom form-control--fixed-height m-input">{{ $arrData['hearing']->hearingSendNoticeToAppellant[0]->comment }}</textarea>
                        <span class="help-block">{{$errors->first('comment')}}</span>
                    </div>
                </div>

            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="btn-list">
                                @if($visiblity == '')
                                <button type="submit" class="btn btn-primary">Save</button>
                                @endif
                                <a href="{{url('/hearing')}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@if(count($hearingLogs->hearingSendNoticeToAppellant) > 0)
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
                    <table id="dtBasicExample" class="table">
                        <thead>
                        <tr>
                            <th class="th-sm">sr.</th>
                            <th class="th-sm">Date</th>
                            <th class="th-sm">Time</th>
                            <th class="th-sm">User</th>
                            <th class="th-sm">Role</th>
                            <th class="th-sm">Comment</th>
                            <th class="th-sm">Notice</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($hearingLogs->hearingSendNoticeToAppellant as $log)
                            <tr>
                                <td> {{$i}}</td>
                                <td> {{ isset($log->created_at) ? date("d-m-Y",strtotime($log->created_at)) : '' }}</td>
                                <td> {{ isset($log->created_at) ? date("H:i",strtotime($log->created_at)) : '' }}</td>
                                <td> {{ isset($log->userDetails->name) ? $log->userDetails->name : '' }}</td>
                                <td> {{ isset($log->userDetails->roleDetails->name) ? $log->userDetails->roleDetails->name : '' }}</td>
                                <td> {{ isset($log->comment) ? $log->comment : '' }}</td>
                                <td>
                                    @if($log->upload_notice)
                                        <a href="{{ config('commanConfig.storage_server').'/'.$log->upload_notice }}" target="_blank"> <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>
                                    @endif
                                </td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif

@include('admin.hearing.delete_hearing')
@endsection
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');

        $('#dtBasicExample_wrapper > .row:first-child').remove();
    });

    $('table').dataTable({searching: false, ordering:false, info: false});
</script>