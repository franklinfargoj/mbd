@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex">
            <h3 class="m-subheader__title">Send Notice to Appellant</h3>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">

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
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <input type="text" id="case_year" name="case_year" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->case_year }}" readonly>
                        <span class="help-block">{{$errors->first('case_year')}}</span>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                        <input type="text" id="case_number" name="case_number" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->case_number }}" readonly>
                        <span class="help-block">{{$errors->first('case_number')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="appellant_name">Apellent Name:</label>
                        <input type="text" id="appellant_name" name="appellant_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->applicant_name }}" readonly>
                        <span class="help-block">{{$errors->first('appellant_name')}}</span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="respondent_name">Respondent Name:</label>
                        <input type="text" id="respondent_name" name="respondent_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->respondent_name }}" readonly>
                        <span class="help-block">{{$errors->first('respondent_name')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label">Board:</label>
                        <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']->hearingBoard->board_name }}"
                            readonly>
                        <span class="help-block"></span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label">Department:</label>
                        <input type="text" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']->hearingDepartment->department_name }}"
                            readonly>
                        <span class="help-block"></span>
                    </div>
                </div>

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
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label">Preceding Date:</label>
                        <input type="text" class="form-control form-control--custom m-input m_datepicker" value="{{ $arrData['hearing']->hearingSchedule->preceding_date }}"
                            readonly>
                        <span class="help-block"></span>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="preceding_time">Preceding Time:</label>
                        <input type="text" id="preceding_time" name="preceding_time" class="form-control form-control--custom m-input"
                            value="{{$arrData['hearing']->hearingSchedule->preceding_time }}" readonly />
                        <span class="help-block">{{$errors->first('preceding_time')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="upload_notice">Upload Notice:</label>
                        <div class="custom-file">
                            <input type="file" id="upload_notice" name="upload_notice" class="form-control form-control--custom"
                                style="display: none">
                            <div>{{$arrData['hearing']->hearingSendNoticeToAppellant[0]->upload_notice_filename }}</div>
                            <span class="help-block">{{$errors->first('upload_notice')}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="comment">Comment:</label>
                        <textarea id="comment" name="comment" class="form-control form-control--custom form-control--fixed-height m-input">{{ $arrData['hearing']->hearingSendNoticeToAppellant[0]->comment }}</textarea>
                        <span class="help-block">{{$errors->first('comment')}}</span>
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
