@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.renewal.actions',compact('sc_application', 'documents', 'documents_uploaded'))
@endsection
@section('content')
    <div class="col-md-12">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader px-0">
            <div class="d-flex">
                {{ Breadcrumbs::render('society_renewal_sale_lease', $sc_application->id) }}
                <div class="ml-auto btn-list">
                    <a href="javascript:void(0);" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success society_renewal_agreement">
                    <div class="text-center">{{ session('success') }}</div>
                </div>
            @endif
            @if (session('error_db'))
                <div class="alert alert-danger society_renewal_agreement">
                    <div class="text-center">{{ session('error_db') }}</div>
                </div>
            @endif
            <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
                <li class="nav-item m-tabs__item em_tabs" id="section-1">
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#stamp-duty-letter" role="tab"
                       aria-selected="false">
                        <i class="la la-cog"></i> Letter to Pay Stamp Duty
                    </a>
                </li>
                <li class="nav-item m-tabs__item em_tabs" id="section-2">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#lease-deed-agreement" role="tab" aria-selected="true">
                        <i class="la la-bell-o"></i> Lease Deed Agreement
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
                                @if(count($uploaded_document_ids) > 0 && isset($uploaded_document_ids['renewal_stamp_duty_letter']))
                                    <div class="col-sm-6">
                                        <div>
                                            <span class="hint-text">Click on 'Download' to download Pay Stamp Duty Letter</span>
                                            <p></p>
                                            <a href="{{ config('commanConfig.storage_server') .'/'. $uploaded_document_ids['renewal_stamp_duty_letter']->sr_agreement_document_status->document_path }}" target="_blank" class="btn btn-primary btn-custom" rel="noopener">Download Pay Stamp Duty Letter</a>
                                        </div>
                                    </div>
                                @endif

                                {{--@if($sc_application->srApplicationLog->status_id != config('commanConfig.renewal_status.Sent_society_for_registration_of_sale_&_lease'))--}}
                                {{--<div class="col-md-6 @if(count($uploaded_document_ids) > 0 && isset($uploaded_document_ids['conveyance_stamp_duty_letter'])) border-left @endif">--}}
                                {{--<h5>Letter to Pay Stamp Duty</h5>--}}
                                {{--<span class="hint-text">Click on 'Upload' to Letter to Pay Stamp Duty</span>--}}
                                {{--<p>--}}
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
                                {{--</p>--}}
                                {{--</div>--}}
                                {{--@endif--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane section-2" id="lease-deed-agreement" role="tabpanel">
                <!-- Society Resolution div here -->
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <div class="m-portlet__body" style="padding-right: 0;">
                            <div class="w-100 row-list">
                                <div class="">
                                    <div class="row">
                                        @if(count($uploaded_document_ids) > 0 && isset($uploaded_document_ids['renewal_lease_deed_agreement']))
                                            <div class="col-sm-6">
                                                <div>
                                                    <span class="hint-text">Click on 'Download' to download Lease Deed Agreement</span>
                                                    <p></p>
                                                    <a href="{{ config('commanConfig.storage_server') .'/'. $uploaded_document_ids['renewal_lease_deed_agreement']->sr_agreement_document_status->document_path }}" target="_blank" class="btn btn-primary btn-custom" rel="noopener">Download Lease Deed Agreement</a>
                                                </div>
                                            </div>
                                        @endif
                                        @if($sc_application->srApplicationLog->status_id == config('commanConfig.renewal_status.pending') || $sc_application->srApplicationLog->status_id == config('commanConfig.renewal_status.Send_society_to_pay_stamp_duty'))
                                            <div class="col-sm-6 @if($sc_application->srApplicationLog->status_id == config('commanConfig.renewal_status.pending') || $sc_application->srApplicationLog->status_id == config('commanConfig.renewal_status.Send_society_to_pay_stamp_duty')) border-left @endif">
                                                <div class="d-flex flex-column h-100">
                                                    {{--<h5>Upload Lease Deed Agreement</h5>--}}
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
                                                        <form action="{{ route('upload_lease') }}" id="lease_deed_agreement" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="custom-file">
                                                                <input class="custom-file-input pdfcheck" name="document_path" type="file"
                                                                       id="test-upload_lease_deed" required="required">
                                                                <label class="custom-file-label" for="test-upload_lease_deed">Choose
                                                                    file...</label>
                                                                <span class="text-danger" id="file_error"></span>
                                                                <input type="hidden" id="application_id" name="application_id" value="{{ $sc_application->id }}">
                                                                <input type="hidden" id="document_name" name="document_name" value="{{ $document_lease['renewal_lease_deed_agreement']}}">
                                                            </div>
                                                            {{--<div class="mt-auto">--}}
                                                                {{--<button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>--}}
                                                            {{--</div>--}}
                                                        {{--</form>--}}
                                                </div>
                                            </div>
                                        @endif
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
                                                    {{--<form action="{{ route('upload_sale_lease') }}" id="lease_deed_agreement_comment" method="post" enctype="multipart/form-data">--}}
                                                        @csrf
                                                        <textarea name="remark" rows="5" cols="30" id="remark" class="form-control form-control--custom" @if(isset($sc_agreement_comment) && array_key_exists(config('commanConfig.scAgreements.renewal_lease_deed_agreement'), $sc_agreement_comment) == true) readonly @endif>@if(isset($sc_agreement_comment) && array_key_exists(config('commanConfig.scAgreements.renewal_lease_deed_agreement'), $sc_agreement_comment) == true) {{ $sc_agreement_comment[config('commanConfig.scAgreements.renewal_lease_deed_agreement')]->remark }} @endif</textarea>
                                                        <input type="hidden" id="application_id" name="application_id" value="{{ $sc_application->id }}">
                                                        <input  type="hidden" id="document_name" name="document_name" value="{{ $document_lease['renewal_lease_deed_agreement']}}">
                                                        <div class="mt-auto"><br/>
                                                            {{--@if(isset($sc_agreement_comment) && array_key_exists(config('commanConfig.scAgreements.lease_deed_agreement'), $sc_agreement_comment) == false)--}}
                                                            {{--<button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>--}}
                                                            {{--@endif--}}
                                                            @if(($sc_application->srApplicationLog->status_id == config('commanConfig.renewal_status.pending') || $sc_application->srApplicationLog->status_id == config('commanConfig.renewal_status.Send_society_to_pay_stamp_duty') || $sc_application->srApplicationLog->status_id == config('commanConfig.renewal_status.Send_society_for_registration_of_sale_&_lease')))
                                                                <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Submit</button>
                                                            @endif
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

            $('#stamp_duty_letter').validate({
                rules:{
                    document_path: {
                        required:true,
                        extension:'pdf'
                    }
                },
                messages:{
                    document_path: {
                        required: 'File is required to upload.',
                        extension: 'File only in pdf format is required.'
                    }
                }
            });

            $('#sale_deed_agreement').validate({
                rules:{
                    document_path: {
                        required:true,
                        extension:'pdf'
                    }
                },
                messages:{
                    document_path: {
                        required: 'File is required to upload.',
                        extension: 'File only in pdf format is required.'
                    }
                }
            });

            $('#lease_deed_agreement').validate({
                rules:{
                    document_path: {
                        required:true,
                        extension:'pdf'
                    }
                },
                messages:{
                    document_path: {
                        required: 'File is required to upload.',
                        extension: 'File only in pdf format is required.'
                    }
                }
            });

            $('#society_resolution').validate({
                rules:{
                    document_path: {
                        required:true,
                        extension:'pdf'
                    }
                },
                messages:{
                    document_path: {
                        required: 'File is required to upload.',
                        extension: 'File only in pdf format is required.'
                    }
                }
            });

            $('#society_undertaking').validate({
                rules:{
                    document_path: {
                        required:true,
                        extension:'pdf'
                    }
                },
                messages:{
                    document_path: {
                        required: 'File is required to upload.',
                        extension: 'File only in pdf format is required.'
                    }
                }
            });
            $('.society_renewal_agreement').delay("slow").slideUp("slow");
        });

    </script>


@endsection