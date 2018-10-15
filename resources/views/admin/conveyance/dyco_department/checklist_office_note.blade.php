@extends('admin.layouts.app')
@section('css')

@section('content')

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
                 </h3>
            <div class="ml-auto btn-list">
                <a href="" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
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
                        
                    </h3>
                </div>
                <!-- <span class="field-name"> Download  Note uploaded by CAP</span> -->
<!--                 <div class="d-flex flex-wrap align-items-center mb-5 upload_doc_1">
                </div> -->

                    <Button type="button" class="s_btn btn btn-primary" id="submitBtn"> Download </Button>
                </a>
                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
            </div>
        </div>
    </form>
</div>
@endsection
