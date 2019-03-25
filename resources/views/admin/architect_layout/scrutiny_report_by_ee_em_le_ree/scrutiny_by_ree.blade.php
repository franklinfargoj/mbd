<div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
    <div class="portlet-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                    {{-- <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                            src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("ree_scrutiny");'
                            style="max-width: 22px"></a> --}}
                </div>
        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf" id="ree_scrutiny">
            <div class="">
                <h3 class="section-title section-title--small">
                    Report
                </h3>
            </div>
            <div class="remarks-suggestions scrutiny-checklist_and_remarks">
                <div id="wrapper">
                    <table class="table" style="width:50%">
                        @forelse($ArchitectLayout->ree_scrutiny_reports as $ree_scrutiny_report)
                        <tr>
                            <td style="width: 25%">{{$ree_scrutiny_report->name_of_document}}</td>
                            <td style="width:25%"><a target="_blank" class="btn-link" href="{{ config('commanConfig.storage_server')."/".$ree_scrutiny_report->file}}">Download</a></td>
                        </tr>
                        @empty
                        No reports found
                        @endforelse
                    </table>
                </div>
            </div>
            <div class="">
                <h3 class="section-title section-title--small">
                    Questionnaire
                </h3>
            </div>
            <div class="remarks-suggestions">
                    @forelse ($ArchitectLayout->ree_scrutiny_checklist_and_remarks as $item)
                    <div class="block">
                        <input type="hidden" name="report_id[]" value="{{$item->id}}">
                        @if($item->question!="")
                        <p style="font-size: 16px"><strong>{{$item->question->title}}</strong></p>
                        @if($item->question->is_options==1)
                        <p>
                            <input type="radio" disabled value="1" {{$item->label1==1?'checked':''}}>{{$item->question->label1}}
                            <input type="radio" disabled value="2" {{$item->label2==1?'checked':''}}>{{$item->question->label2}}
                        </p>
                        @endif
                        @endif
                        <div class="m-form__group row">
                            <div class="col-lg-3 form-group">
                                <label for="Upload_Cts_Plan">Remark</label>
                            </div>
                            <div class="col-lg-7 form-group">
                                <div class="custom-file">
                                    <textarea type="text" disabled name="remark[]" id="remark" class="form-control form-control--custom form-control--fixed-height">{{$item->remark }}</textarea>
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
                                    <a target="_blank" class="btn-link" href="{{config('commanConfig.storage_server').'/'.$item->file}}"
                                        style="display:{{$item->file!=''?'block':'none'}}">Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    No checklist and remark found
                    @endforelse
                </div>
        </div>
    </div>
</div>