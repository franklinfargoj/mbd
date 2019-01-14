@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.hearing.actions',compact('hearing_data'))
@endsection
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex">
            <h3 class="m-subheader__title">Forward Case</h3>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

        <form id="forwardCase" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('forward_case.update', $arrData['hearing']->hearingForwardCase[0]->id)}}">
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
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <input type="text" id="case_year" name="case_year" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->case_year }}" disabled>
                        <span class="help-block">{{$errors->first('case_year')}}</span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                        <input type="text" id="case_number" name="case_number" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->id }}" disabled>
                        <span class="help-block">{{$errors->first('case_number')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="appellant_name">Apellent Name:</label>
                        <input type="text" id="appellant_name" name="appellant_name" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->applicant_name }}" disabled>
                        <span class="help-block">{{$errors->first('appellant_name')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="respondent_name">Respondent Name:</label>
                        <input type="text" id="respondent_name" name="respondent_name" class="form-control form-control--custom m-input"
                               value="{{ $arrData['hearing']->respondent_name }}" disabled>
                        <span class="help-block">{{$errors->first('respondent_name')}}</span>
                    </div>
                </div>

                {{--<div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label">Board:</label>
                        <input type="text" class="form-control m-input" value="{{ $arrData['hearing']->hearingBoard->board_name }}"
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
                        <label class="col-form-label" for="board">Board:</label>
                        @foreach($arrData['board'] as $boardVal)
                        @if($boardVal->id == $arrData['hearing']->hearingForwardCase[0]->board_id)
                        @php $board = $boardVal->board_name; @endphp
                        @endif
                        @endforeach
                        <input type="text" id="board" name="board" class="form-control form-control--custom m-input"
                               value="{{ $board }}" readonly>
                        <span class="help-block">{{$errors->first('board')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="department">Department:</label>
                        {{--                        @php dd($arrData['hearing']->hearingForwardCase[0]->department_id); @endphp--}}
                        @foreach($arrData['department'] as $department)
                        @if($department->id == $arrData['hearing']->hearingForwardCase[0]->department_id)
                        @php $department_name = $department->department_name; @endphp
                        @endif
                        @endforeach
                        <input type="text" id="department" name="department" class="form-control form-control--custom m-input"
                               value="{{ $department_name }}" readonly>
                        <span class="help-block">{{$errors->first('department')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="description">Description:</label>
                        <textarea disabled id="description" name="description" class="form-control form-control--custom form-control--fixed-height m-input">{{ $arrData['hearing']->hearingForwardCase[0]->description }}</textarea>
                        <span class="help-block">{{$errors->first('description')}}</span>
                    </div>
                </div>

            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="btn-list">
                                <a href="{{url('/hearing')}}" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@include('admin.hearing.delete_hearing')
@endsection

@section('js')
<script>
    var dept_id = "{{ $arrData['hearing']->hearingForwardCase[0]->department_id }}";

    $(document).ajaxComplete(function () {
        $("#department_id").val(dept_id).trigger("change");
    });


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
