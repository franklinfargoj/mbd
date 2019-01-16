@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.rti_form.actions',compact('rti_applicant'))
@endsection
@section('css')
<!-- <style>
    .disabled_input{
		border: none;
		background-color: transparent !important;
		padding: 0;
    }
</style> -->
@endsection
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Schedule Meeting</h3>
            {{ Breadcrumbs::render('schedule_meeting',$rti_applicant->id) }}
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                <div class="m-subheader">
                    <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                            Meeting Details:
                        </h3>
                    </div>
                    <div class="row field-row">
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Application Number:</span>
                                <span class="field-value">{{ $rti_applicant->unique_id }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Date of Submission:</span>
                                <span class="field-value">{{ date('d-m-Y', strtotime($rti_applicant->created_at)) }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6 field-col">
                            <div class="d-flex">
                                <span class="field-name">Applicant Name:</span>
                                <span class="field-value">{{ $rti_applicant->applicant_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile">
        @if ($readonly!=1)
        <form id="rti_schedule_meeting" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="{{ url('/rti_schedule_meeting/'.$rti_applicant->id) }}">
            @endif
            @csrf
            <div class="m-portlet__body m-portlet__body--spaced m-portlet--forms-view">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label">Meeting Scheduled Date:</label>
                        <div class="@if($errors->has('meeting_scheduled_date')) has-error @endif">
                            <input type="hidden" name="application_no" id="application_no" class="form-control" value="{{ $rti_applicant->unique_id }}">
                            <input {{$readonly==1?'disabled':''}} type="text" name="meeting_scheduled_date" id="meeting_scheduled_date"
                                readonly class="form-control form-control--custom m_datepicker" value="{{ (!empty($rti_meetings_scheduled->meeting_scheduled_date) ? $rti_meetings_scheduled->meeting_scheduled_date : '' ) }}">
                            <span class="help-block">{{$errors->first('meeting_scheduled_date')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label">Meeting Time:</label>
                        <div class="@if($errors->has('meeting_time')) has-error @endif">
                            <input {{$readonly==1?'disabled':''}} type="text" name="meeting_time" id="meeting_time"
                                class="form-control form-control--custom m_timepicker m-input" value="{{ (!empty($rti_meetings_scheduled->meeting_time) ? $rti_meetings_scheduled->meeting_time : '' ) }}">
                            <span class="help-block">{{$errors->first('meeting_time')}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label">Meeting Venue:</label>
                        <div class="@if($errors->has('meeting_venue')) has-error @endif">
                            <input {{$readonly==1?'disabled':''}} type="text" name="meeting_venue" id="meeting_venue"
                                class="form-control form-control--custom m-input" value="{{ (!empty($rti_meetings_scheduled->meeting_venue) ? $rti_meetings_scheduled->meeting_venue : '') }}">
                            <span class="help-block">{{$errors->first('meeting_venue')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label">Concern Person Name:</label>
                        <div class="@if($errors->has('contact_person_name')) has-error @endif">
                            <input {{$readonly==1?'disabled':''}} type="text" name="contact_person_name" id="contact_person_name"
                                class="form-control form-control--custom m-input" value="{{ (!empty($rti_meetings_scheduled->contact_person_name) ? $rti_meetings_scheduled->contact_person_name : '' ) }}">
                            <span class="help-block">{{$errors->first('contact_person_name')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @if ($readonly!=1)
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-list">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{url('rti_applicants')}}" role="button" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endif
    </div>
    <div class="m-portlet m-portlet--mobile">
            <h3 class="section-title section-title--small">
                History:
            </h3>
        <table id="dtBasicExample" class="table">
            <thead>
                </tr>
                <th>Meeting Scheduled Date</th>
                <th>Meeting Time</th>
                <th>Meeting Venue</th>
                <th>Concern Person Name</th>
                <th>User</th>
                <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meeting_history as $meeting_host)
                <tr>
                    <td>{{$meeting_host->meeting_scheduled_date}}</td>
                    <td>{{$meeting_host->meeting_time}}</td>
                    <td>{{$meeting_host->meeting_venue}}</td>
                    <td>{{$meeting_host->contact_person_name}}</td>
                    <td>{{$meeting_host->user!=""?$meeting_host->user->name:''}}</td>
                    <td>{{$meeting_host->user!=""?$meeting_host->user->roles[0]->name:''}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('js')
<script src="{{asset('/js/mdtimepicker.min.js')}}" type="text/javascript"></script>
<script>
    $(function () {
        $("#meeting_scheduled_date").datepicker({
            dateFormat: "yy-mm-dd"
        });
        $('#meeting_time').mdtimepicker();
    });

    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');

        $('#dtBasicExample_wrapper > .row:first-child').remove();
    });

    $('table').dataTable({
        searching: false,
        ordering: false,
        info: false
    });

</script>
@endsection
