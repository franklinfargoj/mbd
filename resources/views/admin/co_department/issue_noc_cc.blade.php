@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.co_department.action_noc_cc',compact('noc_application'))
@endsection
@section('content')

<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Approve Noc </h3>
                {{ Breadcrumbs::render('issue_noc_cc',$noc_application->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>

    {{--<div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">--}}
        {{--<div class="portlet-body">--}}
            {{--<div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">--}}
                {{--<div class="">--}}
                    {{--<h3 class="section-title section-title--small">--}}
                        {{--View NOC</h3>--}}
                {{--</div>--}}
                {{--@if(isset($applicationData->final_draft_noc_path) && !empty($applicationData->final_draft_noc_path))--}}
                {{--<div class="mt-3 btn-list">--}}
                    {{--<a href="{{config('commanConfig.storage_server').'/'.$applicationData->final_draft_noc_path}}" class="btn btn-primary" target="_blank">View Noc</a>--}}
                {{--</div>--}}
                {{--@else--}}
                {{--<span class="text-danger">*Note : NOC not available.</span>--}}
                {{--@endif--}}
                {{--<div class="remarks-suggestions">--}}
                    {{--<div class="mt-3">--}}
                        {{--<label for="demarkation_comments">Remark by REE</label>--}}
                        {{--<textarea id="demarkation_comments" rows="5" cols="30" class="form-control form-control--custom"--}}
                            {{--name="demarkation_comments" disabled>{{ isset($applicationData->ReeLog->remark) ? $applicationData->ReeLog->remark : '' }}</textarea>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{----}}
                {{----}}
                {{----}}
                {{----}}
                {{----}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    @if(session()->has('success'))
        <div class="alert alert-success display_msg">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger display_msg">
            {{ session()->get('error') }}
        </div>
@endif


    <!-- Site Visit -->
    <input type="hidden" name="applicationId" value="{{$applicationData->id}}">
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body" style="padding-right: 0;">
            <h3 class="section-title">NOC CC:</h3>
            <div class="row field-row">
                <div class="col-md-6">
                    <h5>View NOC</h5>
                    <p>Click to view generated NOC in PDF format</p>
                    @if($applicationData->final_draft_noc_path)
                        <a href="{{config('commanConfig.storage_server').'/'.$applicationData->final_draft_noc_path}}" class="btn btn-primary" target="_blank" rel="noopener">
                            View NOC</a>
                    @endif
                </div>
                @if(!empty($applicationData->final_draft_noc_path))
                    <div class="col-sm-6 border-left">
                        <div class="d-flex flex-column h-100">
                            <h5>Upload Signed & Scanned Copy of NOC CC</h5>
                            <span class="hint-text">Click on 'Upload' to upload NOC-CC</span>
                            <form action="{{route('ree.upload_draft_noc_cc',$applicationData->id)}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="custom-file">
                                    <input class="custom-file-input pdfcheck" name="noc_letter" type="file"
                                           id="test-upload" required="required">
                                    <label class="custom-file-label" for="test-upload">Choose
                                        file...</label>
                                    <span class="text-danger" id="file_error"></span>
                                </div>
                                <div class="mt-auto">
                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- end  -->


    <form role="form" id="sendNoc" style="margin-top: 30px;" name="sendForApproval" class="form-horizontal" method="post" action="{{ route('co.issue_noc_cc_letter_to_ree')}}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="applicationId" value="{{$applicationData->id}}">
    @if($noc_application->status->status_id == config('commanConfig.applicationStatus.NOC_Generation'))
    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                <div class="">
                    <h3 class="section-title section-title--small">
                        Approve NOC</h3>
                </div>
                <div class="m-radio-inline">
                    <label class="m-radio m-radio--primary">
                        <input type="radio" name="is_approved" class="forward-application" value="1" checked="">
                        Approve NOC
                        <span></span>
                    </label>
                </div>
                <div class="remarks-suggestions">
                    <div class="mt-3">
                        <label for="demarkation_comments">Remarks by CO</label>
                        <textarea id="remark" rows="5" cols="30" class="form-control form-control--custom"
                            name="remark"></textarea>
                    </div>
                    <div class="mt-3 btn-list">
                        <input type="submit" class="btn btn-primary" value="Approve">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    </form>

</div>
</div>
@endsection