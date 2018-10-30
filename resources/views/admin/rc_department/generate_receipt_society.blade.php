@extends('admin.layouts.app')

@section('css')
 <link href="{{asset('/css/jquery.dropdown.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('actions')
    @include('admin.rc_department.action',compact('ol_application'))
@endsection

@section('content')
<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Generate Receipt</h3>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <form action="">
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Account Code:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Society Name:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Building Number:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Flat Number:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Amount Paid By:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Bill Amount of month:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-12 form-group">
                        <label class="col-form-label" for="payment-mode">Payment Mode:</label>
                        <div class="m-radio-inline">
                            <label class="m-radio m-radio--primary">
                                <input type="radio" name="payment-mode" checked="" value=""> Cash Payment
                                <span></span>
                            </label>
                            <label class="m-radio m-radio--primary">
                                <input type="radio" name="payment-mode" value=""> DD Payment
                                <span></span>
                            </label>
                            <label class="m-radio m-radio--primary">
                                <input type="radio" name="payment-mode" value=""> Online Payment
                                <span></span>
                            </label>
                        </div>
                    </div>
                    
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-3 form-group">
                        <label class="col-form-label" for="">DD Number:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>

                    <div class="col-sm-3 form-group">
                        <label class="col-form-label" for="">Bank Name:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-3 form-group">
                        <label class="col-form-label" for="">Amount Paid:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span></span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-6 form-group">
                        <label class="col-form-label" for="">Receipt generation except following tenaments :</label>
                        <div class="dropdown-sin-2">
                            <select style="display:none" multiple placeholder="Select" name="except_tenaments"></select>
                        </div>
                        <span class="help-block"></span>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label class="col-form-label" for="">Tenaments Having Credit Amount :</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>

                </div>



                <div class="form-group m-form__group row">
                    <label class="col-form-label col-sm-12" for="">Payment Made for months:</label>
                    <div class="col-sm-4 form-group">
                        <input type="text" id="payment-made-from-month" name="payment-made-from-month" class="form-control form-control--custom m-input m_datepicker"
                            value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <input type="text" id="payment-made-to-month" name="payment-made-to-month" class="form-control form-control--custom m-input m_datepicker"
                            value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="">Amount Balance:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="">Credit Amount:</label>
                        <input type="text" id="" name="" class="form-control form-control--custom m-input" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="btn-list">
                                    <button type="submit" id="" class="btn btn-primary">Generate Receipt</button>
                                    <a href="{{route('bill_collection_society')}}" class="btn btn-secondary">Cancel</a>
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

<script type="text/javascript" src="{{ asset('/js/jquery.dropdown.min.js') }}"></script>

 <script>
    $(document).ready(function () {
        
        var json2 = JSON.parse('<?php echo $buildings; ?>');

        //console.log(json2);

        $('.dropdown-sin-2').dropdown({
          data: json2,
          input: '<input type="text" maxLength="20" placeholder="Search">'
        });
    });    
  </script>
@endsection