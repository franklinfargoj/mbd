@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.tripatite.actions',compact('ol_applications'))
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
            @if (session('success'))
                <div class="alert alert-success society_registered">
                    <div class="text-center">{{ session('success') }}</div>
                </div>
            @endif
            <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
                <li class="nav-item m-tabs__item em_tabs" id="section-1">
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#stamp-duty-letter" role="tab"
                       aria-selected="false">
                        <i class="la la-cog"></i> Tripartite Agreement
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
                                @if($tripartite_agreement)
                                    <div class="col-sm-6">
                                        <div>
                                            <span class="hint-text">Click on 'Download' to download Tripartite Agreement</span>
                                            <p></p>
                                            <a href="{{ config('commanConfig.storage_server') .'/'. $tripartite_agreement->society_document_path }}" target="_blank" class="btn btn-primary btn-custom" rel="noopener">Download Tripartite Agreement</a>
                                        </div>
                                    </div>
                                @endif

                                    @if($ol_applications->olApplicationStatus[0]->status_id == config('commanConfig.conveyance_status.pending') && $ol_applications->current_status_id == config('commanConfig.applicationStatus.draft_tripartite_agreement'))
                                        <div class="col-sm-6 @if($ol_applications->olApplicationStatus[0]->status_id == config('commanConfig.conveyance_status.pending') && $ol_applications->current_status_id == config('commanConfig.applicationStatus.draft_tripartite_agreement')) border-left @endif">
                                            <div class="d-flex flex-column h-100">
                                                {{--<h5>Upload Sale Deed Agreement</h5>--}}
                                                <span class="hint-text">Click on 'Upload' to upload Sale Deed Agreement</span>
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
                                                    <form action="{{ route('upload_tripartite_agreement') }}" id="sale_deed_agreement" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="custom-file">
                                                            <input class="custom-file-input pdfcheck" name="document_path" type="file"
                                                                   id="test-upload_sale_dee" required="required">
                                                            <label class="custom-file-label" for="test-upload_sale_dee">Choose
                                                                file...</label>
                                                            <span class="text-danger" id="file_error"></span>
                                                            <input type="hidden" id="application_id" name="application_id" value="{{ $ol_applications->id }}">
                                                            {{--<input type="hidden" id="document_name" name="document_name" value="{{ $document_lease['sale_deed_agreement']}}">--}}
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

            $('.society_registered').delay("slow").slideUp("slow");

        });
    </script>


@endsection