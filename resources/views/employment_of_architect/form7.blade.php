@extends('admin.layouts.app')
@section('content')

<div class="col-md-12">
    <div class="d-flex form-steps-wrap">
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 1</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 2</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 3</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 4</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 5</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 6</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab active">Step 7</button>
        <button class="btn--unstyled flex-grow-1 form-step-tab">Step 8</button>
    </div>
    <form id="step7-form" role="form" method="post" class="collapse show m-form m-form--rows m-form--label-align-right form-steps-box" action=""
        enctype="multipart/form-data">
        <div class="m-portlet m-portlet--mobile form-accordion">
            <a class="btn--unstyled section-title section-title--small form-count-title" data-toggle="collapse" href="">Form 1:</a>
            @csrf
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Name of Application:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Name of Project:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Location:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Name of Client:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Address:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Phone Number:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Build Up Area in m<sup>2</sup>:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Land Area in m<sup>2</sup>:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Estimated Value of Projects:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Completed Value of Projects:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Date of Start:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m_datepicker" readonly
                        value="">
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Date of Completion:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m_datepicker" readonly
                        value="">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Whether Service Terminated by Client:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-4 offset-sm-1 form-group">
                    <label class="col-form-label" for="">Salient Features of Project:</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="">Reasons for Delay (If any):</label>
                    <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                    <span class="help-block"></span>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions p-0">
                <div class="btn-list d-flex justify-content-between align-items-center">
                    <a id="add-more" class="btn--add-delete add">add more<a>
                            <button type="submit" id="" class="btn btn-primary">Next</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection


@section('js')
<script>
    $('#add-more').click(function (e) {
        e.preventDefault();
        var formAccordion = $("#step7-form .form-accordion").clone();
        var formAccordionCount = formAccordion.find('.form-count-title').length;
        var formAccordionNumber = formAccordion.find('.form-count-title').text();
        console.log("number", parseInt(formAccordionNumber));
        formAccordion.find('input select').val('').end().insertAfter(
            "#step7-form .form-accordion:last");
    });

</script>
@endsection
