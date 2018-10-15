@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.hearing.actions',compact('hearing_data'))
@endsection
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Forward Case</h3>
            {{ Breadcrumbs::render('Forward Case', $arrData['hearing']->id) }}
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

        <form id="forwardCase" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('forward_case.store')}}">
            @csrf
            <input type="hidden" name="hearing_id" value="{{ $arrData['hearing']->id }}">
            <input type="hidden" name="role_id" id="role_id">
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
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <input type="text" id="case_year" name="case_year" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->case_year }}" readonly>
                        <span class="help-block">{{$errors->first('case_year')}}</span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                        <input type="text" id="case_number" name="case_number" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->id }}" readonly>
                        <span class="help-block">{{$errors->first('case_number')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="appellant_name">Apellent Name:</label>
                        <input type="text" id="appellant_name" name="appellant_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->applicant_name }}" readonly>
                        <span class="help-block">{{$errors->first('appellant_name')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="respondent_name">Respondent Name:</label>
                        <input type="text" id="respondent_name" name="respondent_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing']->respondent_name }}" readonly>
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
                        <label class="col-form-label" for="board">Board:</label>
                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="board_id"
                            name="board">
                            <option value="">Select Board</option>
                            @foreach($arrData['board'] as $boardVal)
                            <option value="{{ $boardVal->id }}" {{ count($arrData['board'])==1?'selected':'' }}>{{
                                $boardVal->board_name }}</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{$errors->first('board')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="department">Department:</label>
                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="department_id"
                            name="department">
                            <option value="">Select Department</option>
                        </select>
                        <span class="help-block">{{$errors->first('department')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="user">User:</label>
                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="user"
                            name="user">
                            <option value="">Select User</option>
                        </select>
                        <span class="help-block">{{$errors->first('user')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control form-control--custom form-control--fixed-height m-input">{{ old('description') }}</textarea>
                        <span class="help-block">{{$errors->first('description')}}</span>
                    </div>
                </div>

            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-sm-4">
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
    @include('admin.hearing.delete_hearing')
@endsection
@section('datatablejs')
    <script>
        loadDepartmentsOfBoard();

        $('#board_id').change(function(){
            loadDepartmentsOfBoard();
            $('.m_selectpicker').selectpicker('refresh');
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
                url:"{{ route('loadDepartmentsOfBoardForHearing') }}",
                success:function(res){
                    $('#department_id').html(res);
                    $('.m_selectpicker').selectpicker('refresh');
                    $("#user").val('default');
                    $("#user").find('option').not(':first').remove();
                    $("#user").selectpicker("refresh");
                }
            });
        }

        $("#department_id").change(function () {
            var department_id = $("#department_id option:selected").val();
            var department_name = $("#department_id option:selected").html();
            var board_id = $("#board_id option:selected").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                data:{
                    department_name:department_name,
                    board_id: board_id,
                    department_id: department_id
                },
                url:"{{ route('getDepartmentUser') }}",
                success:function(res){
                    $('#user').html(res);
                    $('.m_selectpicker').selectpicker('refresh');
                }
            });
        });

        $("#forwardCase").on("submit", function () {
            var id = $("#user").find('option:selected').attr("data-role");

            $("#role_id").val(id);
        });
    </script>
@endsection