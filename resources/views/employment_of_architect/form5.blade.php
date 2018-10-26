@extends('admin.layouts.app')
@section('content')

<div class="col-md-12">dsaasdsdadas
    <div class="d-flex form-steps-wrap">
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 1</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 2</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 3</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 4</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 5</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 6</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 7</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 8</button>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <h3 class="section-title section-title--small">Form 5:</h3>
        <form id="" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="" enctype="multipart/form-data">
            @csrf
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Name of Application:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input"
                            value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Address:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input"
                            value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">City:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input"
                            value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">PIN:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input"
                            value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Office No:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input"
                            value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Telephone No:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input"
                            value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Mobile No:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input"
                            value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Fax No:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input"
                            value="">
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
                            Payment Details:-
                        </h3>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Cash Paid:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input"
                        value="">
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Pay Order No:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input"
                        value="">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Bank Name:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input"
                        value="">
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Branch Name:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input"
                        value="">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Payment Date:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input"
                        value="">
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
                            Receipt Details:-
                        </h3>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Receipt No:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input"
                        value="">
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Receipt Date:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input"
                        value="">
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
                            Enclosures:-
                        </h3>
                    </div>
                </div>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">1.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">2.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">3.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">4.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">5.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">6.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">7.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">8.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">9.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">10.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">11.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">12.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">13.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">14.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>
            <div class="input-row-list">
                <div class="d-flex align-items-end">
                    <label class="mb-0 mr-4 font-weight-semi-bold" for="">15.</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input w-100" value="">
                </div>
                <span class="help-block"></span>
            </div>

            <div class="m-checkbox-list mt-5">
                <label class="m-checkbox m-checkbox--primary">
                    <input type="checkbox"> Is verified by me and the same is correct by my knowledge
                    <span></span>
                </label>
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
