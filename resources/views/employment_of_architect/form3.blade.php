@extends('admin.layouts.app')
@section('content')

<div class="col-md-12">dsaasdsdadas
    <div class="d-flex form-steps-wrap">
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 1</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 2</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 3</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 4</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 5</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 6</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 7</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 8</button>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <h3 class="section-title section-title--small">Form 3:</h3>
        <form id="" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="" enctype="multipart/form-data">
            @csrf
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Name of Application:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Address:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">City:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">PIN:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Office No:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Telephone No:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Mobile No:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Fax No:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Details of Establishment:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Branch Office Details:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
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
                            Details of Staff
                        </h3>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Architects:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Engineer:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Supporting (Tech.):</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Supporting (Non Tech.):</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Others:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Total:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <div class="d-flex">
                            <h3 class="m-portlet__head-text mr-5">
                                Details of C.A.D Facility
                            </h3>
                            <div class="m-radio-inline">
                                <label class="m-radio m-radio--primary">
                                    <input type="radio" name="cad-facility"> Yes
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--primary">
                                    <input type="radio" name="cad-facility"> No
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Computers:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">No of Printers:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">No of Plotters:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <div class="d-flex">
                            <h3 class="m-portlet__head-text">
                                Details of Registration with Council of Architecture
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Principle:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Associate:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Partner:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Total Registered Persons:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="m-portlet__head px-0 m-portlet__head--top">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <div class="d-flex">
                            <h3 class="m-portlet__head-text">
                                Extra
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Awards, Prizes Etc:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Other Information:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
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
