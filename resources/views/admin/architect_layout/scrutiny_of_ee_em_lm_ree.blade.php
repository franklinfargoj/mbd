@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.architect_layout.actions',compact('ArchitectLayout'))
@endsection
@section('content')
<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="d-flex">
            {{ Breadcrumbs::render('architect_Layout_scrutiny_of_ee_em_lm_ree',$ArchitectLayout->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
        <div class="">
            <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom">
                <li class="nav-item m-tabs__item" data-target="#document-scrunity">
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#scrutiny-ee">
                        <i class="la la-cog"></i> EE Scrutiny
                    </a>
                </li>

                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link show" data-toggle="tab" href="#scrutiny-lm">
                        <i class="la la-cog"></i> LM Scrutiny
                    </a>
                </li>

                <li class="nav-item m-tabs__item" data-target="#document-scrunity">
                    <a class="nav-link m-tabs__link  show" data-toggle="tab" href="#scrutiny-em">
                        <i class="la la-cog"></i> EM Scrutiny
                    </a>
                </li>

                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link show" data-toggle="tab" href="#scrutiny-ree">
                        <i class="la la-cog"></i> REE Scrutiny
                    </a>
                </li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active show" id="scrutiny-ee">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                <div class="">
                                    <h3 class="section-title section-title--small">
                                        Report
                                    </h3>
                                </div>
                                <div class="remarks-suggestions">
                                    <table class="table" style="width:50%">
                                        @forelse($ArchitectLayout->ee_scrutiny_reports as $ee_scrutiny_report)
                                        <tr>
                                            <td style="width: 25%">{{$ee_scrutiny_report->name_of_document}}</td>
                                            <td style="width:25%"><a target="_blank" class="btn-link" href="{{ config('commanConfig.storage_server')."/".$ee_scrutiny_report->file}}">Download</a></td>
                                        </tr>
                                        @empty
                                        No reports found
                                        @endforelse
                                    </table>
                                </div>
                                <div class="">
                                    <h3 class="section-title section-title--small">
                                        Questionnaire
                                    </h3>
                                </div>
                                <div class="remarks-suggestions">
                                    @forelse ($ArchitectLayout->ee_scrutiny_checklist_and_remarks as $item)
                                    <div class="block">
                                        <input type="hidden" name="report_id[]" value="{{$item->id}}">
                                        @if($item->question!="")
                                        <p style="font-size: 16px"><strong>{{$item->question->title}}</strong></p>
                                        @if($item->question->is_options==1)
                                        <p>
                                            <input type="radio" value="1" {{$item->label1==1?'checked':''}}>{{$item->question->label1}}
                                            <input type="radio" value="2" {{$item->label2==1?'checked':''}}>{{$item->question->label2}}
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
                </div>

                <div class="tab-pane show" id="scrutiny-lm">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                <div class="">
                                    <h3 class="section-title section-title--small">
                                        Report
                                    </h3>
                                </div>
                                <div class="remarks-suggestions scrutiny-checklist_and_remarks">
                                    <div id="wrapper">
                                        <table class="table" style="width:50%">
                                            @forelse($ArchitectLayout->land_scrutiny_reports as $lm_scrutiny_report)
                                            <tr>
                                                <td style="width: 25%">{{$lm_scrutiny_report->name_of_document}}</td>
                                                <td style="width:25%"><a target="_blank" class="btn-link" href="{{ config('commanConfig.storage_server')."/".$lm_scrutiny_report->file}}">Download</a></td>
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
                                    @forelse ($ArchitectLayout->land_scrutiny_checklist_and_remarks as $item)
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
                </div>

                <div class="tab-pane show" id="scrutiny-em">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                <div class="">
                                    <h3 class="section-title section-title--small">
                                        Report
                                    </h3>
                                </div>
                                <div class="remarks-suggestions scrutiny-checklist_and_remarks">
                                    <div id="wrapper">
                                        <table class="table" style="width:50%">
                                            @forelse($ArchitectLayout->em_scrutiny_reports as $em_scrutiny_report)
                                            <tr>
                                                <td style="width: 25%">{{$em_scrutiny_report->name_of_document}}</td>
                                                <td style="width:25%"><a target="_blank" class="btn-link" href="{{ config('commanConfig.storage_server')."/".$em_scrutiny_report->file}}">Download</a></td>
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
                                        @forelse ($ArchitectLayout->em_scrutiny_checklist_and_remarks as $item)
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
                </div>

                <div class="tab-pane show" id="scrutiny-ree">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
