<div class="m-portlet__body m-portlet__body--spaced">
    <div class=" m-form__group row align-items-end mhada-panel-top mhada-lease-margin">
        <div class="col-sm-12 form-group mhada-pb">
            <label class="col-form-label" for="">Category of panel applied for</label>
        </div>
        <div class="col-sm-2 form-group">
            <label class="m-radio m-radio--primary">
                <input
                    {{config('commanConfig.eoa_panel_categories.HOUSING')==$application->category_of_panel?'checked':''}}
                    type="radio" id="" name="category_of_panel" class="form-control" value="{{config('commanConfig.eoa_panel_categories.HOUSING')}}" checked>Housing
                <span></span>
            </label>
        </div>
        <div class="col-sm-2 form-group ">
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
    <div class=" m-form__group row align-items-end mhada-panel-top mhada-lease-margin">
        <div class="col-sm-4 form-group">
        <label class="col-form-label" for="name_of_applicant">Name of the Applicant<span class="star">*</span></label>
            <input type="text" id="name_of_applicant" name="name_of_applicant" class="form-control form-control--custom m-input" value="{{old('name_of_applicant')?old('name_of_applicant'):$application->name_of_applicant}}">
            @if ($errors->has('name_of_applicant'))
            <span class="text-danger">{{ $errors->first('name_of_applicant') }}</span>
            @endif
        </div>
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="address">Address<span class="star">*</span></label>
            <input type="text" id="address" name="address" class="form-control form-control--custom m-input" value="{{old('address')?old('address'):$application->address}}">
            @if ($errors->has('address'))
            <span class="text-danger">{{ $errors->first('address') }}</span>
            @endif
        </div>
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="city">City<span class="star">*</span></label>
            <input type="text" id="city" name="city" class="form-control form-control--custom m-input" value="{{old('city')?old('city'):$application->city}}">
            @if ($errors->has('city'))
            <span class="text-danger">{{ $errors->first('city') }}</span>
            @endif
        </div>
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="pin">PIN<span class="star">*</span></label>
            <input type="text" id="pin" name="pin" class="form-control form-control--custom m-input" value="{{old('pin')?old('pin'):$application->pin}}">
            @if ($errors->has('pin'))
            <span class="text-danger">{{ $errors->first('pin') }}</span>
            @endif
        </div>
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="off">Office No<span class="star">*</span></label>
            <input type="text" id="off" name="off" class="form-control form-control--custom m-input" value="{{old('off')?old('off'):$application->off}}">
            @if ($errors->has('off'))
            <span class="text-danger">{{ $errors->first('off') }}</span>
            @endif
        </div>
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="res">Telephone No<span class="star">*</span></label>
            <input type="text" id="res" name="res" class="form-control form-control--custom m-input" value="{{old('res')?old('res'):$application->res}}">
            @if ($errors->has('res'))
            <span class="text-danger">{{ $errors->first('res') }}</span>
            @endif
        </div>
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="mobile">Mobile No<span class="star">*</span></label>
            <input type="text" id="mobile" name="mobile" class="form-control form-control--custom m-input" value="{{old('mobile')?old('mobile'):$application->mobile}}">
            @if ($errors->has('mobile'))
            <span class="text-danger">{{ $errors->first('mobile') }}</span>
            @endif
        </div>
        <div class="col-sm-4 form-group">
            <label class="col-form-label" for="fax">Fax No</label>
            <input type="text" id="fax" name="fax" class="form-control form-control--custom m-input" value="{{old('fax')?old('fax'):$application->fax}}">
            @if ($errors->has('fax'))
            <span class="text-danger">{{ $errors->first('fax') }}</span>
            @endif
        </div>
    </div>
</div>
