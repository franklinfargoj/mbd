@extends('admin.layouts.app')
@section('content')

<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="m-portlet__head">
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
           <div class="mr-auto">
              <h3 class="m-subheader__title m-subheader__title--separator title">
              Approve Offer Letter </h3>
           </div>
        </div>
      </div>
        </div>
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <div class="row">
                <div class="col-md-12">

                        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                            <div class="portlet-body">
                                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                    <div class="">
                                        <h3 class="section-title section-title--small">
                                        View offer letter</h3>
                                    </div>
                                        <div class="mt-3 btn-list">
                                            <button class="btn btn-primary">View</button>
                                        </div>
                                    <div class="remarks-suggestions">
                                        <div class="mt-3">
                                            <label for="demarkation_comments">Remark by REE</label>
                                            <textarea id="demarkation_comments" rows="5" cols="30" class="form-control form-control--custom"
                                                name="demarkation_comments"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                            <div class="portlet-body">
                                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                    <div class="">
                                        <h3 class="section-title section-title--small">
                                        Approve Offer letter</h3>
                                    </div>
                                    <div class="m-radio-inline">
                                      <label class="m-radio m-radio--primary">
                                          <input type="radio" name="remarks-suggestion" class="forward-application" value="1" checked=""> Approve Offer Letter
                                          <span></span>
                                      </label>
                                    </div>
                                    <div class="remarks-suggestions">
                                        <div class="mt-3">
                                            <label for="demarkation_comments">Remark</label>
                                            <textarea id="demarkation_comments" rows="5" cols="30" class="form-control form-control--custom"
                                                name="demarkation_comments"></textarea>
                                        </div>
                                        <div class="mt-3 btn-list">
                                            <button class="btn btn-primary">Approve</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

