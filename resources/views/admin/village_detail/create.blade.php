@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Add Land</h3>
            {{ Breadcrumbs::render('village_create') }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <form id="addVillageDetail" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('village_detail.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="board_id">Board:<span class="star">*</span></label>
                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="board_id" name="board_id">
                            @foreach($arrData['board'] as $board_details)
                                <option value="{{ $board_details->id  }}">{{ $board_details->board_name }}</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{$errors->first('board_id')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="sr_no">Land Survey No:<span class="star">*</span></label>
                        <input type="text" id="sr_no" name="sr_no" class="form-control form-control--custom m-input" value="{{ old('sr_no') }}">
                        <span class="help-block">{{$errors->first('sr_no')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="village_name">Village Name:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="village_name" name="village_name" class="form-control form-control--custom m-input"  value="{{ old('village_name') }}">
                            <span class="help-block">{{$errors->first('village_name')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="land_source_id">Land Source:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="land_source_id" name="land_source_id">
                                @foreach($arrData['land_source'] as $landDetails)
                                    <option value="{{ $landDetails->id  }}">{{ $landDetails->source_name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('land_source_id')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="land_address">Land Address:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="land_address" name="land_address" class="form-control form-control--custom m-input"  value="{{ old('land_address') }}">
                            <span class="help-block">{{$errors->first('land_address')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="district">District:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="district" name="district">
                                <option value="Andheri">Andheri</option>
                                <option value="Bandra">Bandra</option>
                                <option value="Dadar">Dadar</option>
                            </select>
                            <span class="help-block">{{$errors->first('district')}}</span>
                        </div>
                        {{--<div class="m-input-icon m-input-icon--right">--}}
                            {{--<input type="text" id="district" name="district" class="form-control form-control--custom m-input"  value="{{ old('district') }}">--}}
                            {{--<span class="help-block">{{$errors->first('district')}}</span>--}}
                        {{--</div>--}}
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="taluka">Taluka:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="taluka" name="taluka">
                                <option value="Kurla">Kurla</option>
                                <option value="Andheri">Andheri</option>
                                <option value="Santacruz">Santacruz</option>
                            </select>
                            <span class="help-block">{{$errors->first('taluka')}}</span>
                        </div>
                        {{--<div class="m-input-icon m-input-icon--right">--}}
                            {{--<input type="text" id="taluka" name="taluka" class="form-control form-control--custom" class="form-control form-control--custom m-input"  value="{{ old('taluka') }}">--}}
                            {{--<span class="help-block">{{$errors->first('taluka')}}</span>--}}
                        {{--</div>--}}
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="total_area">Total Area (sq. m.):<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="total_area" name="total_area" class="form-control form-control--custom m-input"  value="{{ old('total_area') }}">
                            <span class="help-block">{{$errors->first('total_area')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="possession_date">Possession Date:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="possession_date" name="possession_date" class="form-control form-control--custom m-input m_datepicker" readonly value="{{ old('possession_date') }}">
                            <span class="help-block">{{$errors->first('possession_date')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="remark">Remark:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="remark" name="remark">
                                <option value="Test 1">Test 1</option>
                                <option value="Test 2">Test 2</option>
                                <option value="other">Other</option>
                            </select>
                            <span class="help-block">{{$errors->first('remark')}}</span>
                            {{--<textarea id="remark" name="remark" class="form-control form-control--custom form-control--fixed-height m-input">{{ old('remark') }}</textarea>--}}
                            {{--<span class="help-block">{{$errors->first('remark')}}</span>--}}
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row" id="other" style="display: none">
                    <div class="col-sm-4 form-group">
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <div class="m-input-icon m-input-icon--right">
                            <label class="col-form-label" for="other_remark">Enter Remark:<span class="star">*</span></label>
                            <textarea id="other_remark" name="other_remark" class="form-control form-control--custom form-control--fixed-height m-input">{{ old('other_remark') }}</textarea>
                            <span class="help-block">{{$errors->first('other_remark')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="land_cost">Land Cost:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="land_cost" name="land_cost" class="form-control form-control--custom" class="form-control form-control--custom m-input"  value="{{ old('land_cost') }}">
                            <span class="help-block">{{$errors->first('land_cost')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="property_card">Property Card No:<span class="star">*</span></label>
                        <input type="text" id="property_card" name="property_card" class="form-control form-control--custom" class="form-control form-control--custom m-input"  value="{{ old('property_card') }}">
                        <span class="help-block">{{$errors->first('property_card')}}</span>

                    </div>
                </div>

                <div class="form-group m-form__group row align-items-center">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="property_card_area">Property Card Area:<span class="star">*</span></label>
                            <input type="text" id="property_card_area" name="property_card_area" class="form-control form-control--custom" class="form-control form-control--custom m-input"  value="{{ old('property_card_area') }}">
                            <span class="help-block">{{$errors->first('property_card_area')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">

                        <label class="col-form-label" for="property_card_mhada_name">Is MHADA's Name On Property Card ?<span class="star">*</span></label>
                        <div class="m-radio-inline">
                            <label class="m-radio m-radio--primary">
                                <input type="radio" name="property_card_mhada_name" value="1"> Yes
                                <span></span>
                            </label>
                            <label class="m-radio m-radio--primary">
                                <input type="radio" name="property_card_mhada_name" value="0" checked=""> No
                                <span class="help-block"></span>
                            </label>
                        </div>
                    </div>

                    {{--<div class="col-sm-4 offset-sm-1 form-group">--}}
                        {{--<label class="col-form-label" for="property_card_mhada_name">Is Property card (PR card) is on MHADA’s name:</label>--}}
                        {{--<div class="m-radio-inline">--}}
                            {{--<label class="m-radio m-radio--primary">--}}
                                {{--<input type="radio" name="property_card_mhada_name" value="1"> Yes--}}
                                {{--<span></span>--}}
                            {{--</label>--}}
                            {{--<label class="m-radio m-radio--primary">--}}
                                {{--<input type="radio" name="property_card_mhada_name" value="0" checked=""> No--}}
                                {{--<span class="help-block"></span>--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="file_upload">Is 7/12 extract available ?<span class="star">*</span></label>
                        <div class="m-radio-inline">
                            <label class="m-radio m-radio--primary">
                                <input type="radio" class="file_upload" name="file_upload" value="1"> Yes
                                <span class="help-block"></span>
                            </label>
                            <label class="m-radio m-radio--primary">
                                <input type="radio" class="file_upload" name="file_upload" value="0" checked> No
                                <span class="help-block"></span>
                            </label>
                        </div>

                        {{--<label class="col-form-label" for="file_upload">Is 7/12 extract available ?</label>
                        <div class="m-radio-inline">
                            <label class="m-radio m-radio--primary">
                                <input type="radio" class="file_upload" name="file_upload" value="1" checked> Yes
                                <span class="help-block"></span>
                            </label>
                            <label class="m-radio m-radio--primary">
                                <input type="radio" class="file_upload" name="file_upload" value="0"> No
                                <span class="help-block"></span>
                            </label>
                        </div>--}}

                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group extract_upload">
                        <label class="col-form-label" for="mhada_name">Is 7/12 on MHADA's Name:<span class="star">*</span></label>
                        <div class="m-radio-inline">
                            <label class="m-radio m-radio--primary">
                                <input type="radio" name="mhada_name" value="1"> Yes
                                <span></span>
                            </label>
                            <label class="m-radio m-radio--primary">
                                <input type="radio" name="mhada_name" value="0" checked> No
                                <span class="help-block"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row extract_upload">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="extract">7/12 Extract:<span class="star">*</span></label>
                        <div class="custom-file">
                            <input class="custom-file-input" name="extract" type="file"
                                   id="extract" value="{{ old('extract') }}">
                            <label class="custom-file-label" for="extract">Choose
                                file...</label>
                            <span class="help-block">{{$errors->first('extract')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group extract_upload">
                    </div>

                </div>


            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="btn-list">
                                <button type="submit" id="add_village" class="btn btn-primary">Save</button>
                                <a href="{{url('/village_detail')}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
    <script>
        if($(".file_upload").val() == 0) $(".extract_upload").show();
        else $(".extract_upload").hide();

        $(".file_upload").on("change", function () {
           if($(this).val() == 1) $(".extract_upload").show();
           else $(".extract_upload").hide();
        });

        $("#remark").on("change", function () {
            if($(this).val() == 'other') $("#other").show();
            else $("#other").hide();
        });
    </script>
@endsection
