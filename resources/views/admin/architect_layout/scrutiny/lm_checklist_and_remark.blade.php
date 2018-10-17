<div class="loader" style="display:none;"></div>
<form action="{{route('post_lm_checklist_and_remark_report')}}" id="forwardApplication" method="post">
    @csrf
    <input type="hidden" id="architect_layout_id" name="architect_layout_id" value="{{$ArchitectLayout->id}}">
    <div class="optionBox">

        @php $j=1; @endphp
        @foreach ($check_list_and_remarks['lm_scrtiny_questions'] as $item)
        <div class="block">
            <input type="hidden" id="lm_report_id_{{$j}}" value="{{$item->id}}">
            @if($item->question!="")
            <p style="font-size: 16px">{{$item->question->title}}</p>
            @if($item->question->is_options==1)
            <p>
                <input type="radio" name="option[]" value="1" {{$item->question->label1==1?'selected':''}}>{{$item->question->label1}}
                <input type="radio" name="option[]" value="1" {{$item->question->label2==1?'selected':''}}>{{$item->question->label2}}
            </p>
            @endif
            @endif
            <div class="m-form__group row">
                <div class="col-lg-3 form-group">
                    <label for="Upload_Cts_Plan">Remark</label>
                </div>
                <div class="col-lg-7 form-group">
                    <div class="custom-file">
                        <textarea type="text" name="remark[]" id="remark" class="form-control form-control--custom form-control--fixed-height">{{$item->remark }}</textarea>
                        @if ($errors->has('remark'))
                        <span class="error">{{ $errors->first('remark') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="m-form__group row">
                <div class="col-lg-3 form-group">
                    <label for="Upload_Cts_Plan">Upload Report</label>
                </div>
                <div class="col-lg-7 form-group">
                    <div class="custom-file">
                        <input class="custom-file-input" name="lm_report[]" type="file" id="report_file_{{$j}}"
                            onchange="upload_lm_report(this.id,'lm_report_id_{{$j}}','report_file_{{$j}}','report_file_link_{{$j}}')">
                        <label class="custom-file-label" for="report_file_{{$j}}">Choose file...</label>
                        <input type="hidden" name="report_file_name[]" id="report_file_{{$j}}" value="">
                    <a target="_blank" id="report_file_link_{{$j}}" href="{{config('commanConfig.storage_server').'/'.$item->file}}" style="display:{{$item->file!=''?'block':'none'}}">uploaded
                            file</a>
                    </div>
                </div>
            </div>

        </div>
        @php $j++; @endphp
        @endforeach
    </div>
    <div class="row">
        <div class="col-sm-12">
            <a class="btn--add-delete add_lm_report">add more </a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="mt-3">
                <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Save</Button>
                <a href="{{ url()->previous() }}" class="btn btn-primary btn-custom">Back</a>
            </div>
        </div>
    </div>
</form>
