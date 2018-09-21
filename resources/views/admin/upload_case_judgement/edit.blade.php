@extends('admin.layouts.app')
@section('content')
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Upload Case Judgement</h3>
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

        <form id="editUploadCaseJudgement" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('upload_case_judgement.update', $arrData['hearing_data']->id)}}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <input type="hidden" name="hearing_id" value="{{ $arrData['hearing_data']->id }}">

            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <input type="text" id="case_year" name="case_year" class="form-control m-input" value="{{ $arrData['hearing_data']->case_year }}" readonly>
                        <span class="help-block">{{$errors->first('case_year')}}</span>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                            <input type="text" id="case_number" name="case_number" class="form-control m-input"  value="{{ $arrData['hearing_data']->case_number }}" readonly>
                            <span class="help-block">{{$errors->first('case_number')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="upload_judgement_case">Case Template:</label>
                            <input type="file" id="upload_judgement_case" name="upload_judgement_case" class="custom-file-input">{{ $arrData['hearing_data']->hearingUploadCaseJudgement[0]->judgement_case_filename }}
                            <input type="hidden" name="upload_case" value="{{ $arrData['hearing_data']->hearingUploadCaseJudgement[0]->upload_judgement_case }}">
                            <input type="hidden" name="judgement_case_filename" value="{{ $arrData['hearing_data']->hearingUploadCaseJudgement[0]->judgement_case_filename }}">
                            <span class="help-block">{{$errors->first('upload_judgement_case')}}</span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="description">Description:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <textarea id="description" name="description" class="form-control m-input">{{ $arrData['hearing_data']->hearingUploadCaseJudgement[0]->description }}</textarea>
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