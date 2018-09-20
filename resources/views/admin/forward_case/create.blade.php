@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex">
            <h3 class="m-subheader__title">Upload Case Judgement</h3>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">        

        <form id="forwardCase" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('forward_case.store')}}">
            @csrf
            <input type="hidden" name="hearing_id" value="{{ $arrData['hearing']->id }}">
            <div class="m-portlet__body m-portlet__body--spaced">

                <div class="m-portlet__head px-0">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
						<span class="m-portlet__head-icon m--hide">
						<i class="la la-gear"></i>
						</span>
                            <h3 class="m-portlet__head-text">
                                Forward Case :-
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <input type="text" id="case_year" name="case_year" class="form-control form-control--custom m-input" value="{{ $arrData['hearing']->case_year }}" readonly>
                        <span class="help-block">{{$errors->first('case_year')}}</span>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                            <input type="text" id="case_number" name="case_number" class="form-control form-control--custom m-input"  value="{{ $arrData['hearing']->case_number }}" readonly>
                            <span class="help-block">{{$errors->first('case_number')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="appellant_name">Apellent Name:</label>
                            <input type="text" id="appellant_name" name="appellant_name" class="form-control form-control--custom m-input"  value="{{ $arrData['hearing']->applicant_name }}" readonly>
                            <span class="help-block">{{$errors->first('appellant_name')}}</span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="respondent_name">Respondent Name:</label>
                            <input type="text" id="respondent_name" name="respondent_name" class="form-control form-control--custom m-input"  value="{{ $arrData['hearing']->respondent_name }}" readonly>
                            <span class="help-block">{{$errors->first('respondent_name')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label">Board:</label>
                            <input type="text"  class="form-control form-control--custom m-input"  value="{{ $arrData['hearing']->hearingBoard->board_name }}" readonly>
                            <span class="help-block"></span>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label">Department:</label>
                            <input type="text"  class="form-control form-control--custom m-input"  value="{{ $arrData['hearing']->hearingDepartment->department_name }}" readonly>
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
                        <label class="col-form-label" for="board">Board:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="board_id" name="board">
                                <option value="">Select Board</option>
                                @foreach($arrData['board'] as $boardVal)
                                    <option value="{{ $boardVal->id }}" {{ count($arrData['board'])==1?'selected':'' }}>{{ $boardVal->board_name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('board')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="department">Department:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="department_id" name="department">
                                <option value="">Select Department</option>
                            </select>
                            <span class="help-block">{{$errors->first('department')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="description">Description:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <textarea id="description" name="description" class="form-control form-control--custom form-control--fixed-height m-input">{{ old('description') }}</textarea>
                            <span class="help-block">{{$errors->first('description')}}</span>
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