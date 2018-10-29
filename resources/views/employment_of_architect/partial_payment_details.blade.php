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
    <div class="form-group m-form__group row">
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="">Cash Paid:</label>
            <input type="text" id="" name="cash" class="form-control form-control--custom m-input" value="{{$application->fee_payment_details!=""?$application->fee_payment_details->cash:""}}">
            <span class="help-block"></span>
        </div>
        <div class="col-sm-4 offset-sm-1 form-group">
            <label class="col-form-label" for="">Pay Order No:</label>
            <input type="text" id="" name="pay_order_no" class="form-control form-control--custom m-input"
                value="{{$application->fee_payment_details!=""?$application->fee_payment_details->pay_order_no:""}}">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="">Bank Name:</label>
            <input type="text" id="" name="bank" class="form-control form-control--custom m-input" value="{{$application->fee_payment_details!=""?$application->fee_payment_details->bank:""}}">
            <span class="help-block"></span>
        </div>
        <div class="col-sm-4 offset-sm-1 form-group">
            <label class="col-form-label" for="">Branch Name:</label>
            <input type="text" id="" name="branch" class="form-control form-control--custom m-input" value="{{$application->fee_payment_details!=""?$application->fee_payment_details->branch:""}}">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="">Payment Date:</label>
            <input type="text" id="" name="date_of_payment" class="form-control form-control--custom m-input"
                value="{{$application->fee_payment_details!=""?$application->fee_payment_details->date_of_payment:""}}">
            <span class="help-block"></span>
        </div>
    </div>
    <div class="m-portlet__head px-0 m-portlet__head--top">
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
    <div class="form-group m-form__group row">
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="">Receipt No:</label>
            <input type="text" id="" name="receipt_no" class="form-control form-control--custom m-input" value="{{$application->fee_payment_details!=""?$application->fee_payment_details->receipt_no:""}}">
            <span class="help-block"></span>
        </div>
        <div class="col-sm-4 offset-sm-1 form-group">
            <label class="col-form-label" for="">Receipt Date:</label>
            <input type="text" id="" name="receipt_date" class="form-control form-control--custom m-input"
                value="{{$application->fee_payment_details!=""?$application->fee_payment_details->receipt_date:""}}">
            <span class="help-block"></span>
        </div>
    </div>