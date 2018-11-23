@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.conveyance.actions',compact('sc_application'))
@endsection
@section('content')

    <div class="col-md-12">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader px-0">
            <div class="d-flex">
                {{-- {{ Breadcrumbs::render('calculation_sheet',$ol_application->id) }} --}}
                <div class="ml-auto btn-list">
                    <a href="javascript:void(0);" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
            <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
                <li class="nav-item m-tabs__item em_tabs" id="section-1">
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#stamp-duty-letter" role="tab"
                       aria-selected="false">
                        <i class="la la-cog"></i> Letter to Pay Stamp Duty
                    </a>
                </li>
                <li class="nav-item m-tabs__item em_tabs" id="section-2">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#sale-deed-agreement" role="tab" aria-selected="true">
                        <i class="la la-bell-o"></i> Sale Deed Agreement
                    </a>
                </li>
                <li class="nav-item m-tabs__item em_tabs" id="section-3">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#lease-deed-agreement" role="tab" aria-selected="true">
                        <i class="la la-bell-o"></i> Lease Deed Agreement
                    </a>
                </li>
                <li class="nav-item m-tabs__item em_tabs" id="section-4">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#society-resolution-undertaking" role="tab" aria-selected="true">
                        <i class="la la-bell-o"></i> Society Resolution & Undertalking
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <div class="tab-pane section-1 active show" id="stamp-duty-letter" role="tabpanel">
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="m-portlet__body" style="padding-right: 0;">
                        <div class=" row-list">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Letter to Pay Stamp Duty</h5>
                                    <span class="hint-text">Click on 'Upload' to Letter to Pay Stamp Duty</span>
                                    <p>
                                        {{--@if (session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')))--}}
                                        {{--<div class="alert alert-success society_registered">--}}
                                        {{--<div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')) }}</div>--}}
                                        {{--</div>--}}
                                        {{--@endif--}}
                                        {{--@if (session('error'))--}}
                                        {{--<div class="alert alert-danger society_registered">--}}
                                        {{--<div class="text-center">{{ session('error') }}</div>--}}
                                        {{--</div>--}}
                                        {{--@endif--}}
                                    </p>
                                    <form action="{{ route('upload_sale_lease') }}" id="no_dues_certi_upload" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="custom-file">
                                            <input class="custom-file-input pdfcheck" name="no_dues_certificate" type="file"
                                                   id="test-upload" required="required">
                                            <label class="custom-file-label" for="test-upload">Choose
                                                file...</label>
                                            <span class="text-danger" id="file_error"></span>
                                            <input type="hidden" id="applicationId" name="applicationId" value="{{ $sc_application->id }}">
                                            <input type="hidden" id="document_id" name="document_id" value="{{ $sc_application->id }}">
                                        </div>
                                        <div class="mt-auto">
                                            <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane section-2" id="sale-deed-agreement" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <div class="m-portlet__body" style="padding-right: 0;">
                            <div class="w-100 row-list">
                                <div class="">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column h-100">
                                                <h5>Download Sale Deed Agreement</h5>
                                                <span class="hint-text">Click on 'Upload' to upload List of Non-Bonafide Allottees</span>
                                                <p>
                                                @if (session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')))
                                                    <div class="alert alert-success society_registered">
                                                        <div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')) }}</div>
                                                    </div>
                                                @endif
                                                @if (session('error'))
                                                    <div class="alert alert-danger society_registered">
                                                        <div class="text-center">{{ session('error') }}</div>
                                                    </div>
                                                    @endif
                                                    </p>
                                                    <form action="" id="no_dues_certi_upload" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="custom-file">
                                                            <input class="custom-file-input pdfcheck" name="no_dues_certificate" type="file"
                                                                   id="test-upload" required="required">
                                                            <label class="custom-file-label" for="test-upload">Choose
                                                                file...</label>
                                                            <span class="text-danger" id="file_error"></span>
                                                            <input type="hidden" id="applicationId" name="applicationId" value="{{ $sc_application->id }}">
                                                        </div>
                                                        <div class="mt-auto">
                                                            <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 border-left">
                                            <div class="d-flex flex-column h-100">
                                                <h5>Upload Sale Deed Agreement</h5>
                                                <span class="hint-text">Click on 'Upload' to upload Lease Deed Agreement</span>
                                                <p>
                                                @if (session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')))
                                                    <div class="alert alert-success society_registered">
                                                        <div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')) }}</div>
                                                    </div>
                                                @endif
                                                @if (session('error'))
                                                    <div class="alert alert-danger society_registered">
                                                        <div class="text-center">{{ session('error') }}</div>
                                                    </div>
                                                    @endif
                                                    </p>
                                                    <form action="" id="no_dues_certi_upload" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="custom-file">
                                                            <input class="custom-file-input pdfcheck" name="no_dues_certificate" type="file"
                                                                   id="test-upload" required="required">
                                                            <label class="custom-file-label" for="test-upload">Choose
                                                                file...</label>
                                                            <span class="text-danger" id="file_error"></span>
                                                            <input type="hidden" id="applicationId" name="applicationId" value="{{ $sc_application->id }}">
                                                        </div>
                                                        <div class="mt-auto">
                                                            <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <div class="m-portlet__body" style="padding-right: 0;">
                            <div class="w-100 row-list">
                                <div class="">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="d-flex flex-column h-100">
                                                <h5>Comments</h5>
                                                <p>
                                                @if (session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')))
                                                    <div class="alert alert-success society_registered">
                                                        <div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')) }}</div>
                                                    </div>
                                                @endif
                                                @if (session('error'))
                                                    <div class="alert alert-danger society_registered">
                                                        <div class="text-center">{{ session('error') }}</div>
                                                    </div>
                                                    @endif
                                                    </p>
                                                    <form action="" id="no_dues_certi_upload" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <textarea></textarea>
                                                        <div class="mt-auto">
                                                            <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane section-3" id="lease-deed-agreement" role="tabpanel">
                <!-- Society Resolution div here -->
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <div class="m-portlet__body" style="padding-right: 0;">
                            <div class="w-100 row-list">
                                <div class="">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column h-100">
                                                <h5>Download Lease Deed Agreement</h5>
                                                <span class="hint-text">Click on 'Upload' to upload List of Non-Bonafide Allottees</span>
                                                <p>
                                                @if (session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')))
                                                    <div class="alert alert-success society_registered">
                                                        <div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')) }}</div>
                                                    </div>
                                                @endif
                                                @if (session('error'))
                                                    <div class="alert alert-danger society_registered">
                                                        <div class="text-center">{{ session('error') }}</div>
                                                    </div>
                                                    @endif
                                                    </p>
                                                    <form action="" id="no_dues_certi_upload" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="custom-file">
                                                            <input class="custom-file-input pdfcheck" name="no_dues_certificate" type="file"
                                                                   id="test-upload" required="required">
                                                            <label class="custom-file-label" for="test-upload">Choose
                                                                file...</label>
                                                            <span class="text-danger" id="file_error"></span>
                                                            <input type="hidden" id="applicationId" name="applicationId" value="{{ $sc_application->id }}">
                                                        </div>
                                                        <div class="mt-auto">
                                                            <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 border-left">
                                            <div class="d-flex flex-column h-100">
                                                <h5>Upload Lease Deed Agreement</h5>
                                                <span class="hint-text">Click on 'Upload' to upload Lease Deed Agreement</span>
                                                <p>
                                                @if (session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')))
                                                    <div class="alert alert-success society_registered">
                                                        <div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')) }}</div>
                                                    </div>
                                                @endif
                                                @if (session('error'))
                                                    <div class="alert alert-danger society_registered">
                                                        <div class="text-center">{{ session('error') }}</div>
                                                    </div>
                                                    @endif
                                                    </p>
                                                    <form action="" id="no_dues_certi_upload" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="custom-file">
                                                            <input class="custom-file-input pdfcheck" name="no_dues_certificate" type="file"
                                                                   id="test-upload" required="required">
                                                            <label class="custom-file-label" for="test-upload">Choose
                                                                file...</label>
                                                            <span class="text-danger" id="file_error"></span>
                                                            <input type="hidden" id="applicationId" name="applicationId" value="{{ $sc_application->id }}">
                                                        </div>
                                                        <div class="mt-auto">
                                                            <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <div class="m-portlet__body" style="padding-right: 0;">
                            <div class="w-100 row-list">
                                <div class="">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="d-flex flex-column h-100">
                                                <h5>Comments</h5>
                                                <p>
                                                @if (session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')))
                                                    <div class="alert alert-success society_registered">
                                                        <div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')) }}</div>
                                                    </div>
                                                @endif
                                                @if (session('error'))
                                                    <div class="alert alert-danger society_registered">
                                                        <div class="text-center">{{ session('error') }}</div>
                                                    </div>
                                                    @endif
                                                    </p>
                                                    <form action="" id="no_dues_certi_upload" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <textarea></textarea>
                                                        <div class="mt-auto">
                                                            <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane section-4" id="society-resolution-undertaking" role="tabpanel">
                <!-- Society Resolution div here -->
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                            <div class="m-subheader">
                                <h4>Society Resolution</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100">
                                            <h5>Download Society resolution format</h5>
                                            <p>
                                            @if (session(config('commanConfig.no_dues_certificate.redirect_message_status.draft_text')))
                                                <div class="alert alert-success society_registered">
                                                    <div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message_status.draft_text')) }}</div>
                                                </div>
                                            @endif
                                            @if (session('error'))
                                                <div class="alert alert-danger society_registered">
                                                    <div class="text-center">{{ session('error') }}</div>
                                                </div>
                                                @endif
                                                </p>
                                                <p>Download society resolution in .pdf format</p><p></p>
                                                {{--<button class="btn btn-primary btn-custom" id="uploadBtn" data-toggle="modal" data-target="#myModal">Edit</button>--}}
                                                {{--@if($data->sc_form_request->template_file)--}}
                                                {{--<a href="{{ config('commanConfig.storage_server').'/'.$data->sc_form_request->template_file }}" class="btn btn-primary" data-toggle="modal" data-target="#myModal">--}}
                                                {{--Download</a>--}}
                                                {{--@endif--}}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100">
                                            <h5>Upload Signed & Stamped society resolution here</h5>
                                            <span class="hint-text">Click on 'Upload' to upload signed & stamped society resolution.</span>
                                            <p>
                                            @if (session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')))
                                                <div class="alert alert-success society_registered">
                                                    <div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')) }}</div>
                                                </div>
                                            @endif
                                            @if (session('error'))
                                                <div class="alert alert-danger society_registered">
                                                    <div class="text-center">{{ session('error') }}</div>
                                                </div>
                                                @endif
                                                </p>
                                                <form action="" id="no_dues_certi_upload" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="custom-file">
                                                        <input class="custom-file-input pdfcheck" name="no_dues_certificate" type="file"
                                                               id="test-upload" required="required">
                                                        <label class="custom-file-label" for="test-upload">Choose
                                                            file...</label>
                                                        <span class="text-danger" id="file_error"></span>
                                                        <input type="hidden" id="applicationId" name="applicationId" value="{{ $sc_application->id }}">
                                                    </div>
                                                    <div class="mt-auto">
                                                        <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                    </div>
                                                </form>
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
                            <div class="w-100 row-list">
                                <h4>Society undertaking</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100">
                                            <h5>Download Society undertaking format</h5>
                                            <p>
                                            @if (session(config('commanConfig.no_dues_certificate.redirect_message_status.draft_text')))
                                                <div class="alert alert-success society_registered">
                                                    <div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message_status.draft_text')) }}</div>
                                                </div>
                                            @endif
                                            @if (session('error'))
                                                <div class="alert alert-danger society_registered">
                                                    <div class="text-center">{{ session('error') }}</div>
                                                </div>
                                                @endif
                                                </p>
                                                <p>Download society resolution in .pdf format</p><p></p>
                                                {{--<button class="btn btn-primary btn-custom" id="uploadBtn" data-toggle="modal" data-target="#myModal">Edit</button>--}}
                                                {{--@if($data->sc_form_request->template_file)--}}
                                                {{--<a href="{{ config('commanConfig.storage_server').'/'.$data->sc_form_request->template_file }}" class="btn btn-primary" data-toggle="modal" data-target="#myModal">--}}
                                                {{--Download</a>--}}
                                                {{--@endif--}}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100">
                                            <h5>Upload Signed & Stamped society undertaking here</h5>
                                            <span class="hint-text">Click on 'Upload' to upload signed & stamped society undertaking</span>
                                            <p>
                                            @if (session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')))
                                                <div class="alert alert-success society_registered">
                                                    <div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')) }}</div>
                                                </div>
                                            @endif
                                            @if (session('error'))
                                                <div class="alert alert-danger society_registered">
                                                    <div class="text-center">{{ session('error') }}</div>
                                                </div>
                                                @endif
                                                </p>
                                                <form action="" id="no_dues_certi_upload" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="custom-file">
                                                        <input class="custom-file-input pdfcheck" name="no_dues_certificate" type="file"
                                                               id="test-upload" required="required">
                                                        <label class="custom-file-label" for="test-upload">Choose
                                                            file...</label>
                                                        <span class="text-danger" id="file_error"></span>
                                                        <input type="hidden" id="applicationId" name="applicationId" value="{{ $sc_application->id }}">
                                                    </div>
                                                    <div class="mt-auto">
                                                        <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                    </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal modal-large fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">No Dues Certificate</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="noDuesCerti" action="" method="POST">
                            @csrf
                            <input type="hidden" id="applicationId" name="applicationId" value="{{$sc_application->id }}">
                            {{--<input type="hidden" id="document_id" name="text_document_id" value="{{ $no_dues_certificate_docs['text_no_dues_certificate']->id }}">--}}
                            {{--<input type="hidden" id="document_id" name="pdf_document_id" value="{{ $no_dues_certificate_docs['drafted_no_dues_certificate']->id }}">--}}
                            {{--<textarea id="ckeditorText" name="ckeditorText" style="display: none;">--}}
                            {{--@if(!empty($content))--}}
                                    {{--@php echo $content; @endphp--}}
                                {{--@else--}}
                                    <div style="float: left; padding-left: 15px;">
                                        <span style="font-weight: bold; font-size: 20px; ">Subject:</span>
                                        <div style="float: left;line-height: 2.0; padding-left: 20px;">
                                        <p style="font-size: 15px; ">It is to certify that Building No. ____________ consisting of _____________ T/S under the _____________ Scheme at __________ In favour of ___________
Co-op. Housing Society Ltd. Have paid all the dues in respect of above bldg./bldgs. Including the final sale price for the bldg. and premium of the land as
                                            follow:</p>
                                        </div>
                                        <p style="float: left;line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                                            5. Final Sale Price of the Bldg/bldgs.<br/>

                                            (A) Cost of Construction<span style="padding-left: 30px;">________________</span><br/>

                                            (B) Premium Land<span style="padding-left: 68px;">________________</span><br/>

                                            <span style="padding-left: 70px;">Total<span style="padding-left: 88px;">________________</span></span>
                                        </p>
                                    </div>
                                {{--@endif--}}
                                </textarea>
                            <input type="submit" value="save" style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('datatablejs')
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.replace('ckeditorText', {
            height: 700,
            allowedContent: true
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script>
        $(document).ready(function () {
            // pdf validation
            // $("#uploadBtn").click(function () {
            //
            //     myfile = $("#test-upload").val();
            //     var ext = myfile.split('.').pop();
            //     if (myfile != '') {
            //
            //         if (ext != "pdf") {
            //             $("#file_error").text("Invalid type of file uploaded (only pdf allowed).");
            //             return false;
            //         } else {
            //             $("#file_error").text("");
            //             return true;
            //         }
            //     } else {
            //         $("#file_error").text("This field required");
            //         return false;
            //     }
            // });

            //cookies setting for tabs
            $(".display_msg").delay("slow").slideUp("slow");

            var id = Cookies.get('sectionId');
            if (id != undefined) {
                //alert(id);


                $(".tab-pane").removeClass('active');
                $(".nav-link").removeClass('active');
                $(".m-tabs__item").removeClass('active');
                $("#" + id+ " a").addClass('active');

                $("." + id).addClass('active');
            }

            $(".em_tabs").on('click', function () {
                $(".nav-link").removeClass('active');
                Cookies.set('sectionId', this.id);
            });

            $('#no_dues_certi_upload').validate({
                rules:{
                    no_dues_certificate: {
                        required:true,
                        extension:'pdf'
                    }
                },
                messages:{
                    no_dues_certificate: {
                        required: 'File is required to upload.',
                        extension: 'File only in pdf format is required.'
                    }
                }
            });

            $('#no_dues_certi_upload').validate({
                rules:{
                    no_dues_certificate: {
                        required:true,
                        extension:'pdf'
                    }
                },
                messages:{
                    no_dues_certificate: {
                        required: 'File is required to upload.',
                        extension: 'File only in pdf format is required.'
                    }
                }
            });
            list_of_allottees_upload
            $('.society_registered').delay("slow").slideUp("slow");

        });
    </script>


@endsection