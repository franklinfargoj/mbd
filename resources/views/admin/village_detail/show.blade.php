@extends('admin.layouts.app')
{{--@extends('admin.layouts.sidebarAction')--}}
{{--@section('actions')--}}
    {{--@include('admin.village_detail.action',compact('arrData'))--}}
{{--@endsection--}}
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">View Land</h3>
            {{ Breadcrumbs::render('village_view',$arrData['village_data']['id']) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <div class="m-portlet__body m-portlet__body--spaced m-form floating-labels-form floating-labels-form--disabled">
            <div class="m-form__group row align-items-end">
                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label" for="board_id">Board:</label>
                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="board_id"
                            name="board_id" disabled>
                        @foreach($arrData['board'] as $board_details)
                            <option value="{{ $board_details->id  }}"
                                    {{ ($board_details->id == $arrData['village_data']['board_id']) ? "selected" : "" }}>{{
                                $board_details->board_name }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">{{$errors->first('board_id')}}</span>
                </div>

                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label" for="sr_no">Land Survey No:</label>
                    <input type="text" id="sr_no" name="sr_no" class="form-control form-control--custom m-input"
                           value="{{ $arrData['village_data']['sr_no'] }}" disabled>
                    <span class="help-block">{{$errors->first('sr_no')}}</span>
                </div>

                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label" for="village_name">Village Name:</label>
                    <input type="text" id="village_name" name="village_name" class="form-control form-control--custom m-input"
                           value="{{ $arrData['village_data']['village_name'] }}" disabled="">
                    <span class="help-block">{{$errors->first('village_name')}}</span>
                </div>

                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label" for="land_source_id">Land Source:</label>
                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="land_source_id"
                            name="land_source_id" disabled>
                        @foreach($arrData['land_source'] as $landDetails)
                            <option value="{{ $landDetails->id  }}"
                                    {{ ($landDetails->id == $arrData['village_data']['land_source_id']) ? "selected" : "" }}>{{
                                $landDetails->source_name }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">{{$errors->first('land_source_id')}}</span>
                </div>

                <div class="col-sm-4 form-group focused" id="other_land_source">
                        <label class="col-form-label" for="other_land_source">Enter Other Land Source:<span class="star">*</span></label>
                        <textarea disabled id="other_land_source" name="other_land_source" class="form-control form-control--custom form-control--fixed-height m-input">{{$arrData['village_data']['other_land_source']  }}</textarea>
                        <span class="help-block">{{$errors->first('other_land_source')}}</span>
                </div>

                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label" for="land_address">Land Address:</label>
                    <input type="text" id="land_address" name="land_address" class="form-control form-control--custom m-input"
                           value="{{ $arrData['village_data']['land_address'] }}" disabled>
                    <span class="help-block">{{$errors->first('land_address')}}</span>
                </div>

                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label" for="district">District:</label>
                        <select disabled class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="district" name="district">
                            @foreach($districts as $district)
                                <option value="{{$district->id}}" {{($district->id == $arrData['village_data']['district']) ? 'selected' : '' }}>{{$district->district_name}}</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{$errors->first('district')}}</span>
                </div>

                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label" for="taluka">Taluka:</label>
                        <select disabled class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="taluka" name="taluka">
                            @foreach($talukas as $taluka)
                                <option value="{{$taluka->id}}" {{($taluka->id == $arrData['village_data']['taluka']) ? 'selected' : '' }}>{{$taluka->taluka_name}}</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{$errors->first('taluka')}}</span>
                </div>

                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label" for="total_area">Total Area (sq. m.):</label>
                    <input type="text" id="total_area" name="total_area" class="form-control form-control--custom m-input"
                           value="{{ $arrData['village_data']['total_area'] }}" disabled>
                    <span class="help-block">{{$errors->first('total_area')}}</span>
                </div>

                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label" for="possession_date">Possession Date:</label>
                    <input type="text" id="possession_date" name="possession_date" class="form-control form-control--custom m_datepicker"
                           disabled value="{{ date(config('commanConfig.dateFormat'), strtotime($arrData['village_data']['possession_date'])) }}">
                    <span class="help-block">{{$errors->first('possession_date')}}</span>
                </div>

                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label" for="remark">Remark:<span class="star">*</span></label>
                        <select disabled class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="remark" name="remark">
                            <option value="Test 1" {{$arrData['village_data']['remark'] == 'Test 1' ? 'selected':''}}>Test 1</option>
                            <option value="Test 2" {{$arrData['village_data']['remark'] == 'Test 2' ? 'selected':''}}>Test 2</option>
                            <option value="other" {{$arrData['village_data']['remark'] == 'other' ? 'selected':''}}>Other</option>
                        </select>
                        <span class="help-block">{{$errors->first('remark')}}</span>
                </div>
                <div class="col-sm-4 form-group focused" id="other" style="display: none">
                        <label class="col-form-label" for="other_remark">Entered Remark:<span class="star">*</span></label>
                        <textarea disabled id="other_remark" name="other_remark" class="form-control form-control--custom form-control--fixed-height m-input">{{$arrData['village_data']['other_remark']}}</textarea>
                        <span class="help-block">{{$errors->first('other_remark')}}</span>
                </div>

                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label" for="land_cost">Land Cost(in Rs.):</label>
                    <input disabled type="text" id="land_cost" name="land_cost" class="form-control form-control--custom"
                           class="form-control form-control--custom m-input" value="{{ $arrData['village_data']['land_cost'] }}">
                    <span class="help-block">{{$errors->first('land_cost')}}</span>
                </div>

                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label" for="property_card">Property Card No:</label>
                        <input disabled type="text" id="property_card" name="property_card" class="form-control form-control--custom"
                               class="form-control form-control--custom m-input" value="{{ $arrData['village_data']['property_card'] }}">
                        <span class="help-block">{{$errors->first('property_card')}}</span>
                </div>

                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label" for="property_card_area">Property Card Area(sq.m.):</label>
                    <input disabled type="text" id="property_card_area" name="property_card_area" class="form-control form-control--custom" class="form-control form-control--custom m-input"  value="{{$arrData['village_data']['property_card_area'] }}">
                    <span class="help-block">{{$errors->first('property_card_area')}}</span>
                </div>

                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label position-static" for="property_card_mhada_name">Is Property card (PR card) is on
                        MHADA’s name:</label>
                    <div class="m-radio-inline">
                        <label class="m-radio m-radio--primary">
                            <input type="radio" name="property_card_mhada_name" value="1"
                                  disabled  {{ ($arrData['village_data']['property_card_mhada_name'] == 1) ? "checked" : "" }}>
                            Yes
                            <span class="help-block"></span>
                        </label>
                        <label class="m-radio m-radio--primary">
                            <input disabled type="radio" name="property_card_mhada_name" value="0"
                                    {{ ($arrData['village_data']['property_card_mhada_name'] == 0) ? "checked" : "" }}>
                            No
                            <span class="help-block"></span>
                        </label>
                    </div>
                </div>

                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label position-static" for="file_upload">Is 7/12 extract available ?</label>
                    <div class="m-radio-inline">
                        <label class="m-radio m-radio--primary">
                            <input disabled type="radio" class="file_upload" name="file_upload" value="1" id="file_upload"
                                    {{ ($arrData['village_data']['7_12_extract'] == 1) ? "checked" : "" }}> Yes
                            <span class="help-block"></span>
                        </label>
                        <label class="m-radio m-radio--primary">
                            <input disabled type="radio" class="file_upload" name="file_upload" value="0" id="file_upload"
                                    {{ ($arrData['village_data']['7_12_extract'] == 0) ? "checked" : "" }}> No
                            <span class="help-block"></span>
                        </label>
                    </div>
                </div>
                <div class="col-sm-4 form-group focused extract_upload">
                    <label class="col-form-label position-static" for="mhada_name">Is 7/12 on MHADA's Name:</label>
                    <div class="m-radio-inline">
                        <label class="m-radio m-radio--primary">
                            <input disabled type="radio" name="mhada_name" value="1"
                                    {{ ($arrData['village_data']['7_12_mhada_name'] == 1) ? "checked" : "" }}> Yes
                            <span class="help-block"></span>
                        </label>
                        <label class="m-radio m-radio--primary">
                            <input disabled type="radio" name="mhada_name" value="0"
                                    {{ ($arrData['village_data']['7_12_mhada_name'] == 0) ? "checked" : "" }}> No
                            <span class="help-block"></span>
                        </label>
                    </div>
                </div>

            <div class="form-group m-form__group row extract_upload">
                <div class="col-sm-4 form-group focused">
                    <label class="col-form-label position-static" for="extract">7/12 Extract:</label>
                    <div class="custom-file">
                        <div class="d-flex">
                            <div class="text-truncate text-primary">{{ $arrData['village_data']['extract_file_name'] }}</div>
                            <a href="{{ config('commanConfig.storage_server').$arrData['village_data']['extract_file_path'].$arrData['village_data']['extract_file_name'] }}"><img style="cursor:pointer;" download class="download-icon-pdf" src="{{ asset('/img/down-arrow.svg') }}"></a>
                        </div>

                        <input type="hidden" name="extract_file_name" value="{{ $arrData['village_data']['extract_file_name'] }}">
                        <input type="hidden" name="extract_file_path" value="{{ $arrData['village_data']['extract_file_path'] }}">
                        <span class="help-block">{{$errors->first('extract')}}</span>
                    </div>
                </div>
                <div class="col-sm-4 form-group focused extract_upload">

                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions px-0">
                <div class="row">
                    <div class="col-lg-12 mb-0">
                        <div class="btn-list">
                            <a href="{{url('/village_detail')}}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        var file = "{{ $arrData['village_data']['7_12_extract'] }}";

        if (file == 1) $(".extract_upload").show();
        else $(".extract_upload").hide();

        $(".file_upload").on("change", function () {
            if ($(this).val() == 1) $(".extract_upload").show();
            else $(".extract_upload").hide();
        });

        if($('#remark').val() == 'other') $("#other").show();
        else{$("#other").hide();}

        if($('#land_source_id').val() == '4') $("#other").show();
        else $("#other_land_source").hide();


        $("#remark").on("change", function () {
            if($(this).val() == 'other') $("#other").show();
            else $("#other").hide();
        });

        $("#land_source_id").on("change", function () {
            if($(this).val() == 4) $("#other_land_source").show();
            else $("#other_land_source").hide();
        });

    </script>
@endsection
