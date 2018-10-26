@extends('admin.layouts.app')
@section('content')

<div class="col-md-12">
    <div class="d-flex form-steps-wrap">
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 1</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 2</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 3</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 4</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 5</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 6</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 7</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 8</button>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <form id="editVillageDetail" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="{{route('village_detail.update', $arrData['village_data']['id'])}}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="board_id">Board:</label>
                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="board_id"
                            name="board_id">
                            @foreach($arrData['board'] as $board_details)
                            <option value="{{ $board_details->id  }}"
                                {{ ($board_details->id == $arrData['village_data']['board_id']) ? "selected" : "" }}>{{
                                $board_details->board_name }}</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{$errors->first('board_id')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="sr_no">Land Survey No:</label>
                        <input type="text" id="sr_no" name="sr_no" class="form-control form-control--custom m-input"
                            value="{{ $arrData['village_data']['sr_no'] }}">
                        <span class="help-block">{{$errors->first('sr_no')}}</span>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="btn-list">
                                <button type="submit" id="" class="btn btn-primary">Save</button>
                                <a href="" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
