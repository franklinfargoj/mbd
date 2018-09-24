@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Upload Case Judgement</h3>
            {{ Breadcrumbs::render('Upload Case Judgement', $arrData['hearing_data']->id) }}
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">

        <form id="editUploadCaseJudgement" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="{{route('upload_case_judgement.update', $arrData['hearing_data']->id)}}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <input type="hidden" name="hearing_id" value="{{ $arrData['hearing_data']->id }}">

            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <input type="text" id="case_year" name="case_year" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing_data']->case_year }}" readonly>
                        <span class="help-block">{{$errors->first('case_year')}}</span>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                        <input type="text" id="case_number" name="case_number" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing_data']->case_number }}" readonly>
                        <span class="help-block">{{$errors->first('case_number')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="upload_judgement_case">Case Template:</label>
                        <div class="custom-file">
                            <input type="file" id="upload_judgement_case" name="upload_judgement_case" class="custom-file-input" style="display: none">
                            <label title="{{$arrData['hearing_data']->hearingUploadCaseJudgement[0]->judgement_case_filename }}" class="custom-file-label" for="upload_judgement_case">{{$arrData['hearing_data']->hearingUploadCaseJudgement[0]->judgement_case_filename }}</label>
                            <input type="hidden" name="upload_case" value="{{ $arrData['hearing_data']->hearingUploadCaseJudgement[0]->upload_judgement_case }}">
                            <input type="hidden" name="judgement_case_filename" value="{{ $arrData['hearing_data']->hearingUploadCaseJudgement[0]->judgement_case_filename }}">
                        </div>
                        <span class="help-block">{{$errors->first('upload_judgement_case')}}</span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control form-control--custom form-control--fixed-height m-input">{{ $arrData['hearing_data']->hearingUploadCaseJudgement[0]->description }}</textarea>
                        <span class="help-block">{{$errors->first('description')}}</span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <div class="m-checkbox-list">

                            <label class="m-checkbox m-checkbox--primary">
                                <input type="checkbox" name="close_case" value="1" {{ ($arrData['hearing_status']->hearing_status_id == config('commanConfig.hearingStatus.case_close')) ? "checked" : "" }}> Close case
                                <span></span>
                            </label>
                        </div>
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
