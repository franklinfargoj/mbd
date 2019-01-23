<div class="m-portlet m-portlet--forms-view m-portlet--mobile">
    <div class="m-portlet__body m-portlet__body--spaced">
        <form id="service_charges" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
            action="{{url('importSociety')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="year">File:</label>
                    <input type="file" name="file">
                    <span class="help-block error">{{$errors->first('file')}}</span>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="btn-list">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>