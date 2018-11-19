<form id="dpcrz_remark_form" enctype="multipart/form-data" method="post" action="{{route('post_architect_detail_dp_crz_remark_add')}}">
    @csrf
    <input type="hidden" name="architect_layout_detail_id" value="{{$ArchitectLayoutDetail->id}}">
    <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <h3 class="section-title section-title--small">
                    DP Remark
                </h3>
            </div>
            <div class="m-form__group row">
                <div class="col-lg-3 form-group">
                    <label for="Upload_Cts_Plan">Letter</label>
                </div>
                <div class="col-lg-7 form-group">

                    <div class="custom-file">
                        <input accept="pdf" title="please upload file with pdf extension" class="custom-file-input" {{ $ArchitectLayoutDetail->dp_letter!=""?"":"required" }} name="dp_remark_letter" type="file" id="dp_remark_letter_file">
                        <label class="custom-file-label" for="dp_remark_letter_file">Choose file...</label>
                        @if($ArchitectLayoutDetail->dp_letter!="")
                        <a class="btn-link" target="_blank" id="dp_remark_letter_uploaded_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->dp_letter}}">download</a>
                        @endif
                        @if ($errors->has('dp_remark_letter'))
                        <span class="error">{{ $errors->first('dp_remark_letter') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="m-form__group row">
                <div class="col-lg-3 form-group">
                    <label for="Upload_Cts_Plan">DP Plan</label>
                </div>
                <div class="col-lg-7 form-group">
                    <div class="custom-file">
                        <input accept="pdf" title="please upload file with pdf extension" class="custom-file-input" {{ $ArchitectLayoutDetail->dp_plan!=""?"":"required" }} name="dp_remark_plan" type="file" id="dp_remark_plan_file">
                        <label class="custom-file-label" for="dp_remark_plan_file">Choose file...</label>
                        @if($ArchitectLayoutDetail->dp_plan!="")
                        <a class="btn-link" target="_blank" id="dp_remark_plan_uploaded_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->dp_plan}}">download</a>
                        @endif
                        @if ($errors->has('dp_remark_plan'))
                        <span class="error">{{ $errors->first('dp_remark_plan') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="m-form__group row">
                <div class="col-lg-3 form-group">
                    <label for="Upload_Cts_Plan">Comments</label>
                </div>
                <div class="col-lg-7 form-group">
                    <div class="custom-file">
                        <textarea type="text" name="dp_comment" id="dp_comment" class="form-control form-control--custom form-control--fixed-height">{{old('dp_comment')?old('dp_comment'):$ArchitectLayoutDetail->dp_comment}}</textarea>
                        @if ($errors->has('dp_comment'))
                        <span class="error">{{ $errors->first('dp_comment') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <h3 class="section-title section-title--small">
                    CRZ Remark
                </h3>
            </div>
            <div class="m-form__group row">
                <div class="col-lg-3 form-group">
                    <label for="Upload_Cts_Plan">Letter</label>
                </div>
                <div class="col-lg-7 form-group">

                    <div class="custom-file">
                        <input accept="pdf" title="please upload file with pdf extension" class="custom-file-input" {{ $ArchitectLayoutDetail->crz_letter!=""?"":"required" }} name="crz_remark_letter" type="file" id="crz_remark_letter_file">
                        <label class="custom-file-label" for="crz_remark_letter_file">Choose file...</label>
                        @if($ArchitectLayoutDetail->crz_letter!="")
                        <a class="btn-link" target="_blank" id="crz_remark_letter_uploaded_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->crz_letter}}">download</a>
                        @endif
                        @if ($errors->has('crz_remark_letter'))
                        <span class="error">{{ $errors->first('crz_remark_letter') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="m-form__group row">
                <div class="col-lg-3 form-group">
                    <label for="Upload_Cts_Plan">CRZ Plan</label>
                </div>
                <div class="col-lg-7 form-group">
                    <div class="custom-file">
                        <input accept="pdf" title="please upload file with pdf extension" class="custom-file-input" {{ $ArchitectLayoutDetail->crz_plan!=""?"":"required" }} name="crz_remark_plan" type="file" id="crz_remark_plan_file">
                        <label class="custom-file-label" for="crz_remark_plan_file">Choose file...</label>
                        @if($ArchitectLayoutDetail->crz_plan!="")
                        <a class="btn-link" target="_blank" id="crz_remark_plan_uploaded_file" href="{{config('commanConfig.storage_server').'/'.$ArchitectLayoutDetail->crz_plan}}">download</a>
                        @endif
                        @if ($errors->has('crz_remark_plan'))
                        <span class="error">{{ $errors->first('crz_remark_plan') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="m-form__group row">
                <div class="col-lg-3 form-group">
                    <label for="Upload_Cts_Plan">Comments</label>
                </div>
                <div class="col-lg-7 form-group">
                    <div class="custom-file">
                        <textarea type="text" name="crz_comment" id="crz_comment" class="form-control form-control--custom form-control--fixed-height">{{old('crz_comment')?old('crz_comment'):$ArchitectLayoutDetail->crz_comment}}</textarea>
                        @if ($errors->has('crz_comment'))
                        <span class="error">{{ $errors->first('crz_comment') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-lg-3">
                        </div>
                        <div class="col-lg-6">
                            <div class="btn-list">
                                <button type="submit" class="btn btn-primary"> Save </button>
                                <a href="{{route('architect_layout_detail.edit',['layout_detail_id'=>encrypt($ArchitectLayoutDetail->id)])}}"
                                    role="button" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
