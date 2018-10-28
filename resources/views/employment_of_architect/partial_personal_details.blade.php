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
