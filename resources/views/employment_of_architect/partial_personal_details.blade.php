<div class="m-portlet__body m-portlet__body--spaced">
    <div class="form-group m-form__group row">
        <div class="col-sm-12 form-group">
            <label class="col-form-label" for="">Category of panel applied for</label>
        </div>
        <div class="col-sm-2 form-group">
            <label class="m-radio m-radio--primary">
                <input
                    {{config('commanConfig.eoa_panel_categories.HOUSING')==$application->category_of_panel?'checked':''}}
                    type="radio" id="" name="category_of_panel" class="form-control" value="{{config('commanConfig.eoa_panel_categories.HOUSING')}}">Housing
                <span></span>
            </label>
        </div>
        <div class="col-sm-2 form-group">
            <label class="m-radio m-radio--primary">
                <input
                    {{config('commanConfig.eoa_panel_categories.LANDSCAPE')==$application->category_of_panel?'checked':''}}
                    type="radio" id="" name="category_of_panel" class="form-control" value="{{config('commanConfig.eoa_panel_categories.LANDSCAPE')}}">Landscape
                <span></span>
            </label>
            @if ($errors->has('category_of_panel'))
            <span class="text-danger">{{ $errors->first('category_of_panel') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="">Name of Application:</label>
            <input type="text" id="" name="name_of_applicant" class="form-control form-control--custom m-input" value="{{$application->name_of_applicant}}">
            @if ($errors->has('name_of_applicant'))
            <span class="text-danger">{{ $errors->first('name_of_applicant') }}</span>
            @endif
        </div>
        <div class="col-sm-4 offset-sm-1 form-group">
            <label class="col-form-label" for="">Address:</label>
            <input type="text" id="" name="address" class="form-control form-control--custom m-input" value="{{$application->address}}">
            @if ($errors->has('address'))
            <span class="text-danger">{{ $errors->first('address') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="">City:</label>
            <input type="text" id="" name="city" class="form-control form-control--custom m-input" value="{{$application->city}}">
            @if ($errors->has('city'))
            <span class="text-danger">{{ $errors->first('city') }}</span>
            @endif
        </div>
        <div class="col-sm-4 offset-sm-1 form-group">
            <label class="col-form-label" for="">PIN:</label>
            <input type="text" id="" name="pin" class="form-control form-control--custom m-input" value="{{$application->pin}}">
            @if ($errors->has('pin'))
            <span class="text-danger">{{ $errors->first('pin') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="">Office No:</label>
            <input type="text" id="" name="off" class="form-control form-control--custom m-input" value="{{$application->off}}">
            @if ($errors->has('off'))
            <span class="text-danger">{{ $errors->first('off') }}</span>
            @endif
        </div>
        <div class="col-sm-4 offset-sm-1 form-group">
            <label class="col-form-label" for="">Telephone No:</label>
            <input type="text" id="" name="res" class="form-control form-control--custom m-input" value="{{$application->res}}">
            @if ($errors->has('res'))
            <span class="text-danger">{{ $errors->first('res') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="">Mobile No:</label>
            <input type="text" id="" name="mobile" class="form-control form-control--custom m-input" value="{{$application->mobile}}">
            @if ($errors->has('mobile'))
            <span class="text-danger">{{ $errors->first('mobile') }}</span>
            @endif
        </div>
        <div class="col-sm-4 offset-sm-1 form-group">
            <label class="col-form-label" for="">Fax No:</label>
            <input type="text" id="" name="fax" class="form-control form-control--custom m-input" value="{{$application->fax}}">
            @if ($errors->has('fax'))
            <span class="text-danger">{{ $errors->first('fax') }}</span>
            @endif
        </div>
    </div>
</div>