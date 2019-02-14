<div class="m-portlet__head px-0 m-portlet__head--top">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon m--hide">
                <i class="la la-gear"></i>
            </span>
            <h3 class="m-portlet__head-text">
                Payment Details
            </h3>
        </div>
    </div>
</div>
<div class="m-form__group row align-items-end mhada-lease-margin">
    <div class="col-sm-4 form-group">
        <label class="col-form-label" for="cash">Cash Paid<span class="star">*</span></label>
        <input type="text" id="cash" name="cash" class="form-control form-control--custom m-input" value="{{old('cash')?old('cash'):($application->fee_payment_details!=""?$application->fee_payment_details->cash:"")}}">
        @if ($errors->has('cash'))
        <span class="text-danger">{{ $errors->first('cash') }}</span>
        @endif
    </div>
    <div class="col-sm-4 form-group">
        <label class="col-form-label" for="pay_order_no">Pay Order No<span class="star">*</span></label>
        <input type="text" id="pay_order_no" name="pay_order_no" class="form-control form-control--custom m-input" value="{{old('pay_order_no')?old('pay_order_no'):($application->fee_payment_details!=""?$application->fee_payment_details->pay_order_no:"")}}">
        @if ($errors->has('pay_order_no'))
        <span class="text-danger">{{ $errors->first('pay_order_no') }}</span>
        @endif
    </div>
    <div class="col-sm-4 form-group">
        <label class="col-form-label" for="bank">Bank Name<span class="star">*</span></label>
        <input type="text" id="bank" name="bank" class="form-control form-control--custom m-input" value="{{old('bank')?old('bank'):($application->fee_payment_details!=""?$application->fee_payment_details->bank:"")}}">
        @if ($errors->has('bank'))
        <span class="text-danger">{{ $errors->first('bank') }}</span>
        @endif
    </div>
    <div class="col-sm-4 form-group">
        <label class="col-form-label" for="branch">Branch Name<span class="star">*</span></label>
        <input type="text" id="branch" name="branch" class="form-control form-control--custom m-input" value="{{old('branch')?old('branch'):($application->fee_payment_details!=""?$application->fee_payment_details->branch:"")}}">
        @if ($errors->has('branch'))
        <span class="text-danger">{{ $errors->first('branch') }}</span>
        @endif
    </div>
    <div class="col-sm-4 form-group">
        <label class="col-form-label" for="date_of_payment">Payment Date<span class="star">*</span></label>
        <input type="text" id="date_of_payment" name="date_of_payment" class="form-control form-control--custom m-input m_datepicker" value="{{old('date_of_payment')?old('date_of_payment'):($application->fee_payment_details!=""?$application->fee_payment_details->date_of_payment:"")}}">
        @if ($errors->has('date_of_payment'))
        <span class="text-danger">{{ $errors->first('date_of_payment') }}</span>
        @endif
    </div>
</div>
<div class="m-portlet__head px-0 m-portlet__head--top mhada-pb">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon m--hide">
                <i class="la la-gear"></i>
            </span>
            <h3 class="m-portlet__head-text">
                Receipt Details
            </h3>
        </div>
    </div>
</div>
<div class="m-form__group row mb-0">
    <div class="col-sm-4 form-group">
        <label class="col-form-label" for="receipt_no">Receipt No<span class="star">*</span></label>
        <input type="text" id="receipt_no" name="receipt_no" class="form-control form-control--custom m-input" value="{{old('receipt_no')?old('receipt_no'):($application->fee_payment_details!=""?$application->fee_payment_details->receipt_no:"")}}">
        @if ($errors->has('receipt_no'))
        <span class="text-danger">{{ $errors->first('receipt_no') }}</span>
        @endif
    </div>
    <div class="col-sm-4 form-group">
        <label class="col-form-label" for="receipt_date">Receipt Date<span class="star">*</span></label>
        <input type="text" id="receipt_date" name="receipt_date" class="form-control form-control--custom m-input m_datepicker" value="{{old('receipt_date')?old('receipt_date'):($application->fee_payment_details!=""?$application->fee_payment_details->receipt_date:"")}}">
        @if ($errors->has('receipt_date'))
        <span class="text-danger">{{ $errors->first('receipt_date') }}</span>
        @endif
    </div>
</div>
