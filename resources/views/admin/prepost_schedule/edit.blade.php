@extends('admin.layouts.app')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Prepone/ Postpone Hearing</h3>
            </div>
            <div>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content"></div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">

                    </h3>
                </div>
            </div>
        </div>

        <form role="form" id="prePostSchedule" method="post" files="true" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" action="{{route('fix_schedule.update', $arrData['schedule_prepost_data']->hearingSchedule->prePostSchedule[0]->id)}}">
            @csrf
            @method("PUT")
            <input type="hidden" name="hearing_schedule_id" value="{{ $arrData['schedule_prepost_data']->hearingSchedule->id }}">
            <input type="hidden" name="hearing_id" value="{{ $arrData['schedule_prepost_data']->id }}">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="pre_post_status">Is 7/12 on MHADA's Name:</label>
                        <div class="m-radio-inline">
                            <label class="m-radio m-radio--solid">
                                <input type="radio" name="pre_post_status" value="1" {{ ($arrData['schedule_prepost_data']->hearingSchedule->prePostSchedule[0]->pre_post_status == 1) ? "checked" : "" }}> Prepone
                                <span></span>
                            </label>
                            <label class="m-radio m-radio--solid">
                                <input type="radio" name="pre_post_status" value="0" {{ ($arrData['schedule_prepost_data']->hearingSchedule->prePostSchedule[0]->pre_post_status == 0) ? "checked" : "" }}> Postpone
                                <span class="help-block"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <input type="text" id="case_year" name="case_year" class="form-control m-input" value="{{ $arrData['schedule_prepost_data']->case_year }}" readonly>
                        <span class="help-block">{{$errors->first('case_year')}}</span>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="case_number" name="case_number" class="form-control m-input"  value="{{ $arrData['schedule_prepost_data']->case_number }}" readonly>
                            <span class="help-block">{{$errors->first('case_number')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="appellant_name">Apellent Name:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="appellant_name" name="appellant_name" class="form-control m-input"  value="{{ $arrData['schedule_prepost_data']->applicant_name }}" readonly>
                            <span class="help-block">{{$errors->first('appellant_name')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="respondent_name">Respondent Name:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="respondent_name" name="respondent_name" class="form-control m-input"  value="{{ $arrData['schedule_prepost_data']->respondent_name }}" readonly>
                            <span class="help-block">{{$errors->first('respondent_name')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="first_hearing_date">First Hearing Date:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="first_hearing_date" name="first_hearing_date" class="form-control" class="form-control m-input"  value="{{ $arrData['schedule_prepost_data']->hearingSchedule->preceding_date }}" readonly>
                            <span class="help-block">{{$errors->first('first_hearing_date')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="preceding_officer_name">Preceding Officer Name:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="preceding_officer_name" name="preceding_officer_name" class="form-control m-input"  value="{{ $arrData['schedule_prepost_data']->preceding_officer_name }}" readonly>
                            <span class="help-block">{{$errors->first('preceding_officer_name')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="date">Select Date:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="date" id="date" name="date" class="form-control" class="form-control m-input"  value="{{ $arrData['schedule_prepost_data']->hearingSchedule->prePostSchedule[0]->date }}">
                            <span class="help-block">{{$errors->first('date')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="description">Description:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <textarea id="description" name="description" class="form-control m-input">{{ $arrData['schedule_prepost_data']->hearingSchedule->prePostSchedule[0]->description }}</textarea>
                            <span class="help-block">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid">
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{url('/hearing')}}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection