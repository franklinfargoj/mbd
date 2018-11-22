@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.formation.actions',compact('sf_application'))
@endsection
@section('content')
<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="d-flex">

            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
        <div class="">
            <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom">
                <li class="nav-item m-tabs__item" data-target="#document-scrunity">
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#scrutiny_and_remark">
                        <i class="la la-cog"></i> Scrutiny Summary & Remark
                    </a>
                </li>

                {{-- <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link show" data-toggle="tab" href="#list_of_allottees">
                        <i class="la la-cog"></i> List of Allottees
                    </a>
                </li>

                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link show" data-toggle="tab" href="#society_resolution">
                        <i class="la la-cog"></i> Society Resolution
                    </a>
                </li> --}}
            </ul>

            <div class="tab-content">
                <div class="loader" style="display:none;"></div>
                <div class="tab-pane active show" id="scrutiny_and_remark">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                                <div class="m-subheader">
                                    <div class="d-flex align-items-center">
                                        <h3 class="section-title section-title--small">
                                            Society Details:
                                        </h3>
                                    </div>
                                    <div class="row field-row">
                                        <div class="col-sm-6 field-col">
                                            <div class="d-flex">
                                                <span class="field-name">Application Number:</span>
                                                <span class="field-value">{{(isset($data->application_no) ?
                                                    $data->application_no : '')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 field-col">
                                            <div class="d-flex">
                                                <span class="field-name">Application Date:</span>
                                                <span class="field-value">{{($data->created_at) ?
                                                    date(config('commanConfig.dateFormat'),strtotime($data->created_at))
                                                    : ''}}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 field-col">
                                            <div class="d-flex">
                                                <span class="field-name">Society Name:</span>
                                                <span class="field-value">{{(isset($data->societyApplication->name)
                                                    ? $data->societyApplication->name : '')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 field-col">
                                            <div class="d-flex">
                                                <span class="field-name">Society Address:</span>
                                                <span class="field-value">{{(isset($data->societyApplication->address)
                                                    ? $data->societyApplication->address : '')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 field-col">
                                            <div class="d-flex">
                                                <span class="field-name">Building Number:</span>
                                                <span class="field-value">{{(isset($data->societyApplication->building_no)
                                                    ? $data->societyApplication->building_no : '')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-subheader">
                                    <div class="d-flex align-items-center">
                                        <h3 class="section-title section-title--small">
                                            Appointed Architect Details:
                                        </h3>
                                    </div>
                                    <div class="row field-row">
                                        <div class="col-sm-6 field-col">
                                            <div class="d-flex">
                                                <span class="field-name">Name of Architect:</span>
                                                <span class="field-value">{{(isset($data->societyApplication->name_of_architect)
                                                    ? $data->societyApplication->name_of_architect : '')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 field-col">
                                            <div class="d-flex">
                                                <span class="field-name">Architect Mobile Number:</span>
                                                <span class="field-value">{{(isset($data->societyApplication->architect_mobile_no)
                                                    ? $data->societyApplication->architect_mobile_no : '')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 field-col">
                                            <div class="d-flex">
                                                <span class="field-name">Architect Address:</span>
                                                <span class="field-value">{{(isset($data->societyApplication->architect_address)
                                                    ? $data->societyApplication->architect_address : '')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 field-col">
                                            <div class="d-flex">
                                                <span class="field-name">Architect Telephone Number:</span>
                                                <span class="field-value">{{(isset($data->societyApplication->architect_telephone_no)
                                                    ? $data->societyApplication->architect_telephone_no : '')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                                <div class="m-subheader">
                                    <div class="d-flex align-items-center">
                                        <h3 class="section-title section-title--small">
                                            Scrutiny Summary & Remark
                                        </h3>
                                    </div>
                                    <div class="row field-row">
                                        @if($read_only!=1)
                                        <form action="{{route('formation.post_em_srutiny_and_remark')}}" id="forwardApplication"
                                            method="post">
                                            @csrf
                                            @endif
                                            <input type="hidden" id="upload_file_route_name" name="upload_file_route_name"
                                                value="{{route('formation.upload_em_scrutiny_document_for_sf')}}">
                                            <input type="hidden" id="sf_application" name="sf_application" value="{{$sf_application->id}}">
                                            <div class="optionBox">
                                                @php $j=0; @endphp
                                                @foreach ($check_list_and_remarks as $item)
                                                <div class="block">
                                                    <input type="hidden" name="report_id[]" id="report_id_{{$j}}" value="{{$item->id}}">
                                                    @if($item->question!="")
                                                    <p style="font-size: 16px"><strong>{{$j+1}}.
                                                            {{$item->question->title}}</strong></p>
                                                    @if($item->question->is_options==1)
                                                    <p>
                                                        <input {{$read_only!=0?'disabled':''}} type="radio" name="lable[{{$j}}]"
                                                            value="1" {{$item->label1==1?'checked':''}}>{{$item->question->label1}}
                                                        <input {{$read_only!=0?'disabled':''}} type="radio" name="lable[{{$j}}]"
                                                            value="2" {{$item->label2==1?'checked':''}}>{{$item->question->label2}}
                                                    </p>
                                                    @endif
                                                    @endif
                                                    @if($item->question->is_options!=1)
                                                    <div class="m-form__group row">
                                                        <div class="col-lg-7 form-group">
                                                            <div class="custom-file">
                                                                <input {{$read_only!=0?'disabled':''}} class="custom-file-input"
                                                                    name="report[]" type="file" id="report_file_{{$j}}"
                                                                    onchange="upload_report(this.id,'report_id_{{$j}}','report_file_{{$j}}','report_file_link_{{$j}}')">
                                                                <label class="custom-file-label" for="report_file_{{$j}}">Choose
                                                                    file...</label>
                                                                <input type="hidden" name="report_file_name[]" id="report_file_{{$j}}"
                                                                    value="">
                                                                <a target="_blank" class="btn-link" id="report_file_link_{{$j}}"
                                                                    href="{{config('commanConfig.storage_server').'/'.$item->file}}"
                                                                    style="display:{{$item->file!=''?'block':'none'}}">download</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                @php $j++; @endphp
                                                @endforeach
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="mt-3">
                                                        @if($read_only!=1)
                                                        <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Save</Button>
                                                        @endif
                                                        <a href="{{ url()->previous() }}" class="btn btn-primary btn-custom">Back</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($read_only!=1)
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                                <div class="m-subheader">
                                    <div class="d-flex align-items-center">
                                        <h3 class="section-title section-title--small">
                                            No dues certificate
                                        </h3>
                                    </div>
                                    <div class="w-100 row-list">
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column h-100">
                                                <h5>Download No Dues Certificate</h5>
                                                <div class="mt-auto">
                                                    {{-- @php
                                                    dd($no_dues_certificate_docs['drafted_no_dues_certificate']['sc_document_status']);
                                                    @endphp--}}
                                                    @if($sf_application->no_due_certificate!= "")
                                                    <a href="{{ config('commanConfig.storage_server').'/'.$sf_application->no_due_certificate }}"
                                                        class="btn btn-primary" target="_blank" rel="noopener">Download</a>
                                                    @else
                                                    <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                        * Note : No Dues Certificate not available. </span>
                                                    @endif
                                                    <a href="{{route('formation.get_no_dues_certificate',['id'=>encrypt($sf_application->id)])}}"
                                                        class="btn btn-primary">Generate No Due Certificate</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($sf_application->no_due_certificate!= "")
                                    <div class="w-100 row-list">
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column h-100">
                                                <h5>Send to Society</h5>
                                                <div class="mt-auto">
                                                @if($sf_application->no_dues_certificate_sent_to_society==0)
                                                    <form action="{{route('formation.send_no_due_to_society')}}" method="post">
                                                            @csrf
                                                        <input type="hidden" name="application_id" value="{{encrypt($sf_application->id)}}">
                                                        <button type="submit" class="btn btn-primary" rel="noopener">Send No
                                                            Due Certificate
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-success">sent to society</span>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="tab-pane show" id="list_of_allottees">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                <div class="">
                                    <h3 class="section-title section-title--small">
                                        List of Alloteee
                                    </h3>
                                </div>
                                <div class="remarks-suggestions">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane show" id="society_resolution">
                    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                                <div class="m-subheader">
                                    <div class="d-flex align-items-center">
                                        <h3 class="section-title section-title--small">
                                            Society Resolution
                                        </h3>
                                    </div>
                                    <div class="row field-row">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<style>
    .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('/img/loading-spinner-blue.gif') 50% 50% no-repeat rgb(249, 249, 249);
        opacity: .8;
    }

</style>
@endsection
@section('js')
<script>
    function upload_report(current_id, report_id, report_file_name, report_file_link) {
        var upload_file_route_name = $("#upload_file_route_name").val();
        $(".loader").show();
        var application_id = $('#sf_application').val();
        var report_id = document.getElementById(report_id).value;
        var filename = $("#" + current_id).val();
        var extension = filename.replace(/^.*\./, '');
        if (extension == 'pdf') {
            var file_data = $('#' + current_id).prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('application_id', application_id);
            form_data.append('report_id', report_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{csrf_token()}}'
                }
            });
            $.ajax({
                url: upload_file_route_name, // point to server-side PHP script
                data: form_data,
                type: 'POST',
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                success: function (data) {
                    $(".loader").hide();
                    if (data.status == true) {

                        $("#" + report_file_link).prop("href", data.file_path)
                        $("#" + report_file_link).css("display", "block");
                        var res = report_file_link.split("_");
                        var report_id = res[res.length - 1]
                        $('#report_id_' + report_id).val(data.doc_id)
                    } else {}
                }
            });
        } else {
            var filename = $("#" + current_id).val('');
            alert('please upload pdf file');
            $(".loader").hide();
        }

    }

</script>
@endsection
