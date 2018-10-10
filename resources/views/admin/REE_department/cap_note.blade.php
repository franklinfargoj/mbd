@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.REE_department.action',compact('ol_application'))
@endsection
@section('css')
<!-- <style> -->
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css" />

<!-- </style> -->
@endsection
@section('content')

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
                CAP - Notes </h3>
            {{ Breadcrumbs::render('cap_note_ree',$ol_application->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>

    <form role="form" id="CAPnotes" style="margin-top: 30px;" name="CAPnotes" class="form-horizontal" method="post"
        enctype="multipart/form-data">
        @csrf

        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body main_panel">
                <div class="d-flex align-items-center">
                    <h3 class="section-title section-title--small">
                        Download CAP Note
                    </h3>
                </div>
                <!-- <span class="field-name"> Download  Note uploaded by CAP</span> -->
                <div class="d-flex flex-wrap align-items-center mb-5 upload_doc_1">
                </div>
                @if(isset($capNote->document_path))
                <a href="{{ config('commanConfig.storage_server').'/'.$capNote->document_path }}">
                    <Button type="button" class="s_btn btn btn-primary" id="submitBtn"> Download </Button>
                </a>
                @else
                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                    *Note : CAP note is not available.</span>
                @endif

            </div>
        </div>
    </form>
</div>
@endsection
