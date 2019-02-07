@extends('admin.layouts.app')
{{--@section('js')--}}
{{--<script type="text/javascript">--}}
    {{--// $(document).ready(function() {--}}
    {{--//     var last_valid_selection = null;--}}
    {{--//     $('#villages').change(function(event) {--}}
    {{--//     if ($(this).val().length > 4) {--}}
    {{--//         $(this).val(last_valid_selection);--}}
    {{--//     } else {--}}
    {{--//         last_valid_selection = $(this).val();--}}
    {{--//     }--}}
    {{--//     });--}}
    {{--// });--}}

{{--</script>--}}
{{--@endsection--}}
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Edit Society</h3>
            {{ Breadcrumbs::render('society_detail_edit',encrypt($id)) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <form id="editSocietyDetail" role="form" method="post" class="floating-labels-form m-form m-form--rows m-form--label-align-right"
            action="{{route('society_detail.update', $arrData['society_data']->id)}}">
            @csrf
            <div class="m-portlet__body m-portlet__body--spaced">
            <div class="m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="villages-select">Villages:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <select title="Select Village" data-live-search="true" id="villages-select" multiple class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                    name="villages[]">
                                @foreach($arrData['villages'] as $village)
                                    <option value="{{ $village->id }}" {{ (in_array($village->id,$villages_belongs)) ? 'selected' : '' }}  >{{ $village->village_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{$errors->first('villages')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="layout">Layouts:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout" name="layout">
                                @foreach($arrData['layouts'] as $layout)
                                    <option value={{$layout->id}}  {{($layout->id == $arrData['society_data']['layout_id']) ? 'selected' : '' }}>{{$layout->layout_name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{$errors->first('layout')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="society_name">Society Name:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="society_name" name="society_name" class="form-control form-control--custom m-input"
                                value="{{ $arrData['society_data']->society_name }}">
                            <span class="text-danger">{{$errors->first('society_name')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="society_reg_no">Society Reg. No.:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="society_reg_no" name="society_reg_no" class="form-control form-control--custom m-input"
                                   value="{{ $arrData['society_data']->society_reg_no }}">
                            <span class="text-danger">{{$errors->first('society_reg_no')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="district">District:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="district" name="district">
                                <option value="Andheri">Andheri</option>
                                <option value="Bandra">Bandra</option>
                                <option value="Dadar">Dadar</option>
                            </select>
                            <span class="text-danger">{{$errors->first('district')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="taluka">Taluka:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="taluka" name="taluka">
                                <option value="Kurla">Kurla</option>
                                <option value="Andheri">Andheri</option>
                                <option value="Santacruz">Santacruz</option>
                            </select>
                            <span class="text-danger">{{$errors->first('taluka')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="survey_number">Survey Number:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="survey_number" name="survey_number" class="form-control form-control--custom m-input"
                                   value="{{ $arrData['society_data']->survey_number }}">
                            <span class="text-danger">{{$errors->first('survey_number')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="cts_number">CTS Number:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="cts_number" name="cts_number" class="form-control form-control--custom m-input"
                                   value="{{ $arrData['society_data']->cts_number }}">
                            <span class="text-danger">{{$errors->first('cts_number')}}</span>
                        </div>
                    </div>


                    {{--<div class="col-sm-4 form-group">
                        <label class="col-form-label" for="chairman">Chairman:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="chairman" name="chairman" class="form-control form-control--custom m-input"
                                value="{{ $arrData['society_data']->chairman }}">
                            <span class="help-block">{{$errors->first('chairman')}}</span>
                        </div>
                    </div>--}}
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="society_address">Society Address:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <textarea id="society_address" name="society_address" class="form-control form-control--custom form-control--fixed-height"
                                      class="form-control m-input">{{ $arrData['society_data']->society_address }}</textarea>
                            <span class="text-danger">{{$errors->first('society_address')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="area">Area (sq. m.):<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="area" name="area" class="form-control form-control--custom m-input"
                                   value="{{ $arrData['society_data']->area }}">
                            <span class="text-danger">{{$errors->first('area')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="chairman">Name of Chairman:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="chairman" name="chairman" class="form-control form-control--custom m-input"
                                   value="{{ $arrData['society_data']->chairman }}">
                            <span class="text-danger">{{$errors->first('chairman')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="chairman_mob_no">Chairman's Mobile No:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="chairman_mob_no" name="chairman_mob_no" class="form-control form-control--custom m-input"
                                   value="{{ $arrData['society_data']->chairman_mob_no }}">
                            <span class="text-danger">{{$errors->first('chairman_mob_no')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-4 form-group">

                        <label class="col-form-label" for="secretary">Name of Secretary:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="secretary" name="secretary" class="form-control form-control--custom m-input"
                                   value="{{ $arrData['society_data']->secretary }}">
                            <span class="text-danger">{{$errors->first('secretary')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="secretary_mob_no">Secretary's Mobile No:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="secretary_mob_no" name="secretary_mob_no" class="form-control form-control--custom m-input"
                                   value="{{  $arrData['society_data']->secretary_mob_no }}">
                            <span class="text-danger">{{$errors->first('secretary_mob_no')}}</span>
                        </div>
                    </div>
                    {{--<div class="col-sm-4 form-group">--}}
                        {{--<label class="col-form-label" for="area">Area (sq. m.):</label>--}}
                        {{--<div class="m-input-icon m-input-icon--right">--}}
                            {{--<input type="text" id="area" name="area" class="form-control form-control--custom m-input"--}}
                                {{--value="{{ $arrData['society_data']->area }}">--}}
                            {{--<span class="help-block">{{$errors->first('area')}}</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="society_email_id">Society's Email Id:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="society_email_id" name="society_email_id" class="form-control form-control--custom m-input"
                                   value="{{ $arrData['society_data']->society_email_id }}">
                            <span class="text-danger">{{$errors->first('society_email_id')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="date_on_service_tax">Date mentioned on service tax letters:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="date_on_service_tax" name="date_on_service_tax" class="form-control form-control--custom m-input m_datepicker"
                                   value="{{ date(config('commanConfig.dateFormat'), strtotime($arrData['society_data']->date_on_service_tax)) }}">
                            <span class="text-danger">{{$errors->first('date_on_service_tax')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="surplus_charges">Surplus Charges(in Rs.):<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="surplus_charges" name="surplus_charges" class="form-control form-control--custom m-input"
                                   value="{{ $arrData['society_data']->surplus_charges }}">
                            <span class="text-danger">{{$errors->first('surplus_charges')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="surplus_charges_last_date">Last date of paying surplus
                            charges:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="surplus_charges_last_date" name="surplus_charges_last_date" class="form-control form-control--custom m-input m_datepicker"
                                   value="{{ date(config('commanConfig.dateFormat'), strtotime($arrData['society_data']->surplus_charges_last_date)) }}">
                            <span class="text-danger">{{$errors->first('surplus_charges_last_date')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="other_land_id">Others:<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                    id="other_land_id" name="other_land_id">
                                @foreach($arrData['other_land'] as $other_land_details)
                                    <option value="{{ $other_land_details->id  }}"
                                            {{ ($other_land_details->id == $arrData['society_data']['other_land_id']) ? 'selected' : '' }}>{{
                                    $other_land_details->land_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{$errors->first('other_land_id')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label position-static" for="society_conveyed">Is Society Conveyed ?<span class="star">*</span></label>
                        <div class="m-radio-inline">
                            <label class="m-radio m-radio--primary">
                                <input type="radio" class="society_conveyed" name="society_conveyed" value="1"
                                {{ ($arrData['society_data']->society_conveyed == 1) ? "checked" : "" }} > Yes
                                <span class="text-danger"></span>
                            </label>
                            <label class="m-radio m-radio--primary">
                                <input type="radio" class="society_conveyed" name="society_conveyed" value="0"
                                        {{ ($arrData['society_data']->society_conveyed == 0) ? "checked" : "" }}> No
                                <span class="text-danger"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4 form-group hide">
                        <label class="col-form-label" for="date_of_conveyance">Date of Conveyance:<span class="star">*</span></label>
                        <input type="text" id="date_of_conveyance" name="date_of_conveyance"
                               class="form-control form-control--custom m-input m_datepicker"
                               value="{{ $arrData['society_data']->date_of_conveyance }}">
                        <span class="text-danger">{{$errors->first('date_of_conveyance')}}</span>
                    </div>

                    <div class="col-sm-4 form-group hide">
                        <label class="col-form-label" for="area_of_conveyance">Area of Conveyance (sq. m.):<span class="star">*</span></label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="area_of_conveyance" name="area_of_conveyance"
                                   class="form-control form-control--custom m-input"
                                   value="{{ $arrData['society_data']->area_of_conveyance }}">
                            <span class="text-danger">{{$errors->first('area_of_conveyance')}}</span>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-sm-4 mb-0">
                                <div class="btn-list">
                                    <button type="submit" id="edit_society" class="btn btn-primary">Save</button>
                                    <a href="{{url('/society_detail/'.$arrData['society_data']->village_id)}}" class="btn btn-secondary">Cancel</a>
                                </div>
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
        if($('.society_conveyed:checked').val() == 1)
        {
            $(".hide").show();
        }
        else{
            $(".hide").hide();
        }
        $(".society_conveyed").on("change", function () {
            if($(this).val() == 1)
            {
                $(".hide").show();
            }
            else{
                $(".hide").hide();
            }
        });

    </script>
@endsection
