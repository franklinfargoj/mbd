@extends('admin.layouts.app')
@section('actions')
    @include('admin.hearing.actions',compact('hearing_data'))
@endsection
@section('content')
<div class="m-subheader px-0 m-subheader--top">
    <div class="d-flex align-items-center">
        <h3 class="m-subheader__title m-subheader__title--separator">Prepone/ Postpone Hearing</h3>
        {{ Breadcrumbs::render('Prepone/Postpone Hearing', $arrData['schedule_prepost_data']->id) }}
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">

        <form role="form" id="prePostSchedule" method="post" files="true" class="m-form m-form--rows m-form--label-align-right"
            action="{{route('fix_schedule.update', $arrData['schedule_prepost_data']->hearingSchedule->prePostSchedule[0]->id)}}">
            @csrf
            @method("PUT")
            <input type="hidden" name="hearing_schedule_id" value="{{ $arrData['schedule_prepost_data']->hearingSchedule->id }}">
            <input type="hidden" name="hearing_id" value="{{ $arrData['schedule_prepost_data']->id }}">
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="pre_post_status">Prepone/Postpone Hearing:</label>
                        <div class="m-radio-inline">
                            <label class="m-radio m-radio--primary">
                                <input type="radio" name="pre_post_status" value="1"
                                    {{ ($arrData['schedule_prepost_data']->hearingSchedule->prePostSchedule[0]->pre_post_status == 1) ? "checked" : "" }}>
                                Prepone
                                <span></span>
                            </label>
                            <label class="m-radio m-radio--primary">
                                <input type="radio" name="pre_post_status" value="0"
                                    {{ ($arrData['schedule_prepost_data']->hearingSchedule->prePostSchedule[0]->pre_post_status == 0) ? "checked" : "" }}>
                                Postpone
                                <span class="help-block"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <input type="text" id="case_year" name="case_year" class="form-control form-control--custom m-input"
                            value="{{ $arrData['schedule_prepost_data']->case_year }}" readonly>
                        <span class="help-block">{{$errors->first('case_year')}}</span>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                        <input type="text" id="case_number" name="case_number" class="form-control form-control--custom m-input"
                            value="{{ $arrData['schedule_prepost_data']->case_number }}" readonly>
                        <span class="help-block">{{$errors->first('case_number')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="appellant_name">Apellent Name:</label>
                        <input type="text" id="appellant_name" name="appellant_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['schedule_prepost_data']->applicant_name }}" readonly>
                        <span class="help-block">{{$errors->first('appellant_name')}}</span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="respondent_name">Respondent Name:</label>
                        <input type="text" id="respondent_name" name="respondent_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['schedule_prepost_data']->respondent_name }}" readonly>
                        <span class="help-block">{{$errors->first('respondent_name')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="first_hearing_date">First Hearing Date:</label>
                        <input type="text" id="first_hearing_date" name="first_hearing_date" class="form-control form-control--custom"
                            class="form-control form-control--custom m-input" value="{{ $arrData['schedule_prepost_data']->hearingSchedule->preceding_date }}"
                            readonly>
                        <span class="help-block">{{$errors->first('first_hearing_date')}}</span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="preceding_officer_name">Preceding Officer Name:</label>
                        <input type="text" id="preceding_officer_name" name="preceding_officer_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['schedule_prepost_data']->preceding_officer_name }}" readonly>
                        <span class="help-block">{{$errors->first('preceding_officer_name')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="date">Select Date:</label>
                        <input type="text" id="date" name="date" class="form-control form-control--custom m_datepicker"
                            class="form-control form-control--custom m-input" value="{{ $arrData['schedule_prepost_data']->hearingSchedule->prePostSchedule[0]->date }}">
                        <span class="help-block">{{$errors->first('date')}}</span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control form-control--custom form-control--fixed-height m-input">{{ $arrData['schedule_prepost_data']->hearingSchedule->prePostSchedule[0]->description }}</textarea>
                        <span class="help-block">{{$errors->first('description')}}</span>
                    </div>
                </div>

            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="btn-list">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{url('/hearing')}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@include('admin.hearing.delete_hearing')

