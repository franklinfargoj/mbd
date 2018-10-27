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
        <h3 class="section-title section-title--small">Form 1:</h3>
        <form action="{{route('appointing_architect.step1_post')}}" id="" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="application_id" value="{{$application->id}}">
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Category of panel applied for</label>
                    </div>
                    <div class="col-sm-2 offset-sm-1 form-group">
                        <input {{config('commanConfig.eoa_panel_categories.HOUSING')==$application->category_of_panel?'checked':''}} type="radio" id="" name="category_of_panel" class="form-control" value="{{config('commanConfig.eoa_panel_categories.HOUSING')}}">
                        <label class="col-form-label" for="">HOUSING</label>
                    </div>
                    <div class="col-sm-2 offset-sm-1 form-group">
                        <input {{config('commanConfig.eoa_panel_categories.LANDSCAPE')==$application->category_of_panel?'checked':''}} type="radio" id="" name="category_of_panel" class="form-control" value="{{config('commanConfig.eoa_panel_categories.LANDSCAPE')}}">
                        <label class="col-form-label" for="">LANDSCAPE</label>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Name of Application:</label>
                        <input type="text" id="" name="name_of_applicant" class="form-control form-control--custom m-input"
                            value="{{$application->name_of_applicant}}">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Address:</label>
                        <input type="text" id="" name="address" class="form-control form-control--custom m-input" value="{{$application->address}}">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">City:</label>
                        <input type="text" id="" name="city" class="form-control form-control--custom m-input" value="{{$application->city}}">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">PIN:</label>
                        <input type="text" id="" name="pin" class="form-control form-control--custom m-input" value="{{$application->pin}}">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Office No:</label>
                        <input type="text" id="" name="off" class="form-control form-control--custom m-input" value="{{$application->off}}">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Telephone No:</label>
                        <input type="text" id="" name="res" class="form-control form-control--custom m-input" value="{{$application->res}}">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Mobile No:</label>
                        <input type="text" id="" name="mobile" class="form-control form-control--custom m-input" value="{{$application->mobile}}">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Fax No:</label>
                        <input type="text" id="" name="fax" class="form-control form-control--custom m-input" value="{{$application->fax}}">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>
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
