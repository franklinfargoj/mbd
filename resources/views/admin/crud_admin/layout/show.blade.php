@extends('admin.crud_admin.app')
@section('actions')
    @include('admin.crud_admin.layout.actions')
@endsection

@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">View Layout</h3>
                {{ Breadcrumbs::render('layout_view',$layout['id']) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="layout_name">Layout Name:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="layout_name" disabled name="layout_name" class="form-control form-control--custom m-input"  value="{{ $layout['layout_name'] }}">
                            <span class="text-danger">{{$errors->first('layout_name')}}</span>
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="division">Division:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" disabled id="division" name="division" class="form-control form-control--custom m-input"  value="{{ $layout['division'] }}">
                            <span class="text-danger">{{$errors->first('division')}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 form-group">
                        <label class="col-form-label" for="board">Board:<span class="star">*</span></label>
                        <select disabled class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="board"
                                name="board">
                            @foreach($arrData['board'] as $board_details)
                                <option value="{{ $board_details->id  }}"
                                        {{ ($board_details->id == $layout['board']) ? "selected" : "" }}>{{
                                $board_details->board_name }}</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{$errors->first('board')}}</span>
                    </div>

                    {{--<div class="col-lg-6 form-group">--}}
                        {{--<label class="col-form-label" for="redirect_to">Redirect To:</label>--}}
                        {{--<div class="m-input-icon m-input-icon--right">--}}
                            {{--<input type="text" disabled id="redirect_to" name="redirect_to" class="form-control form-control--custom m-input" value="{{ $layout['redirect_to'] }}">--}}
                            {{--<span class="text-danger">{{$errors->first('redirect_to')}}</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>

            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="btn-list">
                                <a href="{{route('layouts.index')}}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--@section('js')--}}
    {{--<script>--}}
        {{--var file = "{{ $arrData['village_data']['7_12_extract'] }}";--}}

        {{--if (file == 1) {--}}
            {{--$(".extract_upload").show();--}}
        {{--} else {--}}
            {{--$(".extract_upload").hide();--}}
        {{--}--}}
        {{--$(".file_upload").on("change", function () {--}}
            {{--if ($(this).val() == 1) {--}}
                {{--$(".extract_upload").show();--}}
            {{--} else {--}}
                {{--$(".extract_upload").hide();--}}
            {{--}--}}
        {{--});--}}

    {{--</script>--}}
{{--@endsection--}}
