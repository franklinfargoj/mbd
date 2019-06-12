@extends('admin.layouts.app')
@section('content')
    <style>
        .help-block{
            color: red;
        }
    </style>
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Self Redevelopment</h3>
                {{ Breadcrumbs::render('society_noc_application_create', $id) }}

            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

            <form id="save_noc_application_self" role="form" method="post" class="m-form m-form--rows m-form--label-align-right floating-labels-form" action="{{ route('save_noc_application_self') }}">
                @csrf
                <div class="m-portlet__body m-portlet__body--spaced mhada-lg-tag">
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group">
                            <label class="col-form-label mhada-multiple-label" for="application_type_id">Select layout: <span class="star">*</span></label>
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" data-live-search="true" id="layouts" name="layout_id" required>
                                <option value="">Select layout</option>
                                @foreach($layouts as $layout)
                                    <option value="{{ $layout['id'] }}">{{ $layout['layout_name'] }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('application_type_id')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group">
                            <label class="col-form-label" for="preceding_officer_name">Department:</label>
                            <input type="text" id="department_name" name="department_name" class="form-control form-control--custom m-input" value="Resident Executive Engineer" readonly>
                            <input type="hidden" name="application_master_id" value="{{ $id }}" required>
                            <span class="help-block">{{$errors->first('department_name')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group">
                            <label class="col-form-label" for="case_year">Building No:</label>
                            <input type="text" id="building_no" name="building_no" class="form-control form-control--custom m-input" value="{{ $society_details->building_no }}" readonly>
                            <span class="help-block">{{$errors->first('building_no')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group">
                            <label class="col-form-label" for="name">Society Name:</label>
                            <input type="text" id="name" name="name" class="form-control form-control--custom m-input" value="{{ $society_details->name }}" readonly>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group">
                            <label class="col-form-label" for="address">Society Address:</label>
                            <textarea id="address" name="address" class="form-control form-control--custom form-control--fixed-height m-input" readonly>{{ $society_details->address }}</textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group">
                            <label class="col-form-label" for="offer_letter_number">Offer letter number: <span class="star">*</span></label>
                            <input type="text" id="offer_letter_number" name="offer_letter_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('offer_letter_number') }}" required>
                            <span class="help-block">{{$errors->first('offer_letter_number')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group">
                            <label class="col-form-label" for="m_datepicker">Offer letter date:</label>
                            <input type="text" id="m_datepicker" name="offer_letter_date" class="form-control form-control--custom m-input m_datepicker" data-date-end-date="+0d" value="{{ old('offer_letter_date') }}" required
                            readonly="readonly">
                            <span class="help-block">{{$errors->first('offer_letter_date')}}</span>
                        </div>
                    </div>

                    <!-- show feilds at premium application -->
                    @if(isset($model) && $model == 'Premium')
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!--  -->
                            <label class="col-form-label" for="demand_draft_amount">
                            Premium pay order amount (Rs.): <span class="star">*</span></label>
                            <input type="text" id="demand_draft_amount" name="demand_draft_amount" class="form-control form-control--custom form-control--fixed-height m-input number" value="{{ old('demand_draft_amount') }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_amount')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> <!--  -->
                            <label class="col-form-label" for="demand_draft_number">Premium receipt number : <span class="star">*</span></label>
                            <input type="text" id="demand_draft_number" name="demand_draft_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('demand_draft_number') }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_number')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!--  -->
                            <label class="col-form-label" for="receipt-date">Premium receipt date : <span class="star">*</span></label>
                            <input type="text" id="receipt-date" data-date-end-date="+0d" name="demand_draft_date" class="form-control form-control--custom m-input m_datepicker" value="{{ old('demand_draft_date') }}" readonly="readonly" required>
                            <span class="help-block">{{$errors->first('demand_draft_date')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> <!--  -->
                            <label class="col-form-label" for="offsite_infra_charges">Offsite Infrastructure charges amount(Rs.) : <span class="star">*</span></label>
                            <input type="text" id="offsite_infra_charges" name="offsite_infra_charges" class="form-control form-control--custom form-control--fixed-height m-input number" value="{{ old('offsite_infra_charges') }}" required>
                            <span class="help-block">{{$errors->first('offsite_infra_charges')}}</span>
                        </div>
                    </div> 

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!--  -->
                            <label class="col-form-label" for="offsite_infra_receipt">Offsite Infrastructure receipt number : <span class="star">*</span></label>
                            <input type="text" id="offsite_infra_receipt" name="offsite_infra_receipt" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('offsite_infra_receipt') }}" required>
                            <span class="help-block">{{$errors->first('offsite_infra_receipt')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> <!--  -->
                            <label class="col-form-label" for="offsite_infra_charges_receipt_date">Offsite Infrastructure charges receipt date : <span class="star">*</span></label>
                             <input type="text" id="offsite_infra_charges_receipt_date" name="offsite_infra_charges_receipt_date" class="form-control form-control--custom m-input m_datepicker" data-date-end-date="+0d" value="{{ old('offsite_infra_charges_receipt_date') }}" required
                            readonly="readonly">
                            <span class="help-block">{{$errors->first('offsite_infra_charges_receipt_date')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!--  -->
                            <label class="col-form-label" for="water_charges_amount">Water charges amount(Rs.) : <span class="star">*</span></label>
                            <input type="text" id="water_charges_amount" name="water_charges_amount" class="form-control form-control--custom form-control--fixed-height m-input number" value="{{ old('water_charges_amount') }}" required>
                            <span class="help-block">{{$errors->first('water_charges_amount')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> <!--  -->
                            <label class="col-form-label" for="water_charges_receipt_number">Water charges receipt number : <span class="star">*</span></label>
                            <input type="text" id="water_charges_receipt_number" name="water_charges_receipt_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('water_charges_receipt_number') }}" required>
                            <span class="help-block">{{$errors->first('water_charges_receipt_number')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!--  -->
                            <label class="col-form-label" for="water_charges_date">
                            Water charges date : <span class="star">*</span></label>
                             <input type="text" id="water_charges_date" name="water_charges_date" class="form-control form-control--custom m-input m_datepicker" data-date-end-date="+0d" value="{{ old('water_charges_date') }}" required readonly="readonly">
                            <span class="help-block">{{$errors->first('water_charges_date')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group">
                            <label class="col-form-label" for="full_bua">Full BUA : <span class="star">*</span></label>
                            <input type="text" id="full_bua" name="full_bua" class="form-control form-control--custom form-control--fixed-height m-input number total_bua" value="{{ old('full_bua') }}" required>
                            <span class="help-block">{{$errors->first('full_bua')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> 
                            <label class="col-form-label" for="existing_bua">Exisitng BUA : <span class="star">*</span></label>
                            <input type="text" id="existing_bua" name="existing_bua" class="form-control form-control--custom form-control--fixed-height m-input number total_bua" value="{{ old('existing_bua') }}" required>
                            <span class="help-block">{{$errors->first('existing_bua')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> 
                            <label class="col-form-label" for="percent_bua">25 % BUA : <span class="star">*</span></label>
                            <input type="text" id="percent_bua" name="percent_bua" class="form-control form-control--custom form-control--fixed-height m-input number total_bua" value="{{ old('percent_bua') }}" required>
                            <span class="help-block">{{$errors->first('percent_bua')}}</span>
                        </div>
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group t_bua"> 
                            <label class="col-form-label" for="total_bua">Total BUA : <span class="star">*</span></label>
                            <input type="text" id="total_bua" name="total_bua" class="form-control form-control--custom form-control--fixed-height m-input number" value="{{ old('total_bua') }}" required>
                            <span class="help-block">{{$errors->first('total_bua')}}</span>
                        </div>
                    </div>

                    <!-- show feilds at sharing application -->
                    @elseif(isset($model) && $model == 'Sharing')
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!--  -->
                            <label class="col-form-label" for="demand_draft_amount">
                            Offsite infrastructure charges paid to MHADA (Rs.): <span class="star">*</span></label>
                            <input type="text" id="demand_draft_amount" name="demand_draft_amount" class="form-control form-control--custom form-control--fixed-height m-input number" value="{{ old('demand_draft_amount') }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_amount')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> <!--  -->
                            <label class="col-form-label" for="demand_draft_number">Offsite infrastructure charges receipt number : <span class="star">*</span></label>
                            <input type="text" id="demand_draft_number" name="demand_draft_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('demand_draft_number') }}" required>
                            <span class="help-block">{{$errors->first('demand_draft_number')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!--  -->
                            <label class="col-form-label" for="receipt-date">Offsite infrastructure charges receipt date : <span class="star">*</span></label>
                            <input type="text" id="receipt-date" data-date-end-date="+0d" name="demand_draft_date" class="form-control form-control--custom m-input m_datepicker" value="{{ old('demand_draft_date') }}" readonly="readonly" required>
                            <span class="help-block">{{$errors->first('demand_draft_date')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6 form-group"> <!--  -->
                            <label class="col-form-label" for="offsite_infra_charges">Offsite Infrastructure charges paid to planning authority(Rs) <span class="star">*</span></label>
                            <input type="text" id="offsite_infra_charges" name="offsite_infra_charges" class="form-control form-control--custom form-control--fixed-height m-input number" value="{{ old('offsite_infra_charges') }}" required>
                            <span class="help-block">{{$errors->first('offsite_infra_charges')}}</span>
                        </div>
                    </div> 

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 col-lg-6 form-group"> <!--  -->
                            <label class="col-form-label" for="offsite_infra_receipt">Offsite Infrastructure planning authority receipt number : <span class="star">*</span></label>
                            <input type="text" id="offsite_infra_receipt" name="offsite_infra_receipt" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('offsite_infra_receipt') }}" required>
                            <span class="help-block">{{$errors->first('offsite_infra_receipt')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 col-lg-6  form-group"> <!--  -->
                            <label class="col-form-label" for="offsite_infra_charges_receipt_date">Offsite Infrastructure planning authority receipt date : <span class="star">*</span></label>
                             <input type="text" id="offsite_infra_charges_receipt_date" name="offsite_infra_charges_receipt_date" class="form-control form-control--custom m-input m_datepicker" data-date-end-date="+0d" value="{{ old('offsite_infra_charges_receipt_date') }}" required
                            readonly="readonly">
                            <span class="help-block">{{$errors->first('offsite_infra_charges_receipt_date')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-xl-5 form-group"> <!--  -->
                            <label class="col-form-label" for="water_charges_amount">Water charges amount(Rs.) : <span class="star">*</span></label>
                            <input type="text" id="water_charges_amount" name="water_charges_amount" class="form-control form-control--custom form-control--fixed-height m-input number" value="{{ old('water_charges_amount') }}" required>
                            <span class="help-block">{{$errors->first('water_charges_amount')}}</span>
                        </div>
                        <div class="col-xl-5 offset-xl-1 form-group"> <!--  -->
                            <label class="col-form-label" for="water_charges_receipt_number">Water charges receipt number : <span class="star">*</span></label>
                            <input type="text" id="water_charges_receipt_number" name="water_charges_receipt_number" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ old('water_charges_receipt_number') }}" required>
                            <span class="help-block">{{$errors->first('water_charges_receipt_number')}}</span>
                        </div>
                    </div>
                    @endif
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <button type="submit"  class="btn btn-primary">Save</button>
                                        <a href="{{URL::previous()}}" class="btn btn-secondary">Cancel</a>
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
<script type="text/javascript">
    $(".total_bua").keyup(function(){
        var sum = 0;
        var full_bua = $("#full_bua").val() || 0;
        var existing_bua = $("#existing_bua").val() || 0;
        var percent_bua = $("#percent_bua").val() || 0;
        console.log(full_bua);
        sum = parseFloat(full_bua) + parseFloat(existing_bua) + parseFloat(percent_bua);
        $(".t_bua").addClass('focused');
        $("#total_bua").attr('value',sum.toFixed(2));
    });
</script>
@endsection