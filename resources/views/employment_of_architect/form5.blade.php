@extends('admin.layouts.app')
@section('content')

<div class="col-md-12">
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
    <form id="" role="form" method="post" class="m-form m-form--rows m-form--label-align-right form-steps-box" action="" enctype="multipart/form-data">
        <div class="m-portlet m-portlet--mobile">
            <h3 class="section-title section-title--small">Form 5:</h3>
            @csrf
            <div class="m-portlet__body m-portlet__body--table">
                <div class="">
                    <div class="table-responsive">
                        <table id="table-form-4" class="table table--box-input">
                            <thead class="thead-default">
                                <tr>
                                    <th>Name of Client</th>
                                    <th>No. of Dwelling Units / Flats</th>
                                    <th>Land Area in Sq. mt</th>
                                    <th>Built Up Area in Sq. mt</th>
                                    <th>Value of Works in Rs. (Lakhs)</th>
                                    <th>Year of Completion / Start</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id=""
                                            name="">
                                            <option value="">one</option>
                                            <option value="">two</option>
                                            <option value="">three</option>
                                        </select>
                                    </td>
                                    <td><input placeholder="No. of Dwelling" type="text" class="form-control form-control--custom"></td>
                                    <td><input placeholder="Land Area" type="text" class="form-control form-control--custom"></td>
                                    <td><input placeholder="Built Up Area" type="text" class="form-control form-control--custom"></td>
                                    <td><input placeholder="Value of Works" type="text" class="form-control form-control--custom"></td>
                                    <td><input placeholder="Year" type="text" class="form-control form-control--custom"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions p-0">
                <div class="row">
                    <div class="col">
                        <div class="btn-list d-flex justify-content-end">
                            <button type="submit" id="" class="btn btn-primary">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('js')
@endsection