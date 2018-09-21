@extends('admin.layouts.app')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Upload Case Judgement</h3>
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

        <form id="forwardCase" role="form" method="post" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" action="{{route('forward_case.store')}}">
            @csrf
            <input type="hidden" name="hearing_id" value="{{ $arrData['hearing']->id }}">
            <div class="m-portlet__body">

                <div class="m-portlet__head">
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
                        <input type="text" id="case_year" name="case_year" class="form-control m-input" value="{{ $arrData['hearing']->case_year }}" readonly>
                        <span class="help-block">{{$errors->first('case_year')}}</span>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="case_number" name="case_number" class="form-control m-input"  value="{{ $arrData['hearing']->case_number }}" readonly>
                            <span class="help-block">{{$errors->first('case_number')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="appellant_name">Apellent Name:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="appellant_name" name="appellant_name" class="form-control m-input"  value="{{ $arrData['hearing']->applicant_name }}" readonly>
                            <span class="help-block">{{$errors->first('appellant_name')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="respondent_name">Respondent Name:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="respondent_name" name="respondent_name" class="form-control m-input"  value="{{ $arrData['hearing']->respondent_name }}" readonly>
                            <span class="help-block">{{$errors->first('respondent_name')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label">Board:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text"  class="form-control m-input"  value="{{ $arrData['hearing']->hearingBoard->board_name }}" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label">Department:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text"  class="form-control m-input"  value="{{ $arrData['hearing']->hearingDepartment->department_name }}" readonly>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__head">
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
                            <select class="form-control m-input" id="board_id" name="board">
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
                            <select class="form-control m-input" id="department_id" name="department">
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
                            <textarea id="description" name="description" class="form-control m-input">{{ old('description') }}</textarea>
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
@section('js')
    <script>
        loadDepartmentsOfBoard();

        $('#board_id').change(function(){
            loadDepartmentsOfBoard();
        });

        function loadDepartmentsOfBoard()
        {
            var board_id = $('#board_id').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                data:{
                    board_id:board_id
                },
                url:"{{ route('loadDepartmentsOfBoardUsingAjax') }}",
                success:function(res){
                    $('#department_id').html(res);
                }
            });
        }
    </script>
@endsection