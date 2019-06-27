@extends('frontend.layouts.sidebarAction')
@section('css')
<style type="text/css">
    .font_w500{
        font-weight: 500;
    }
</style>
@endsection
@section('actions')
    @include('frontend.society.conveyance.actions',compact('sc_application', 'documents', 'documents_uploaded'))
@endsection
@section('content')
    <div class="col-md-12">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader px-0">
            <div class="d-flex">
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
            <!-- stamp duty letter -->
            <div class="tab-pane section-1 active show" id="stamp-duty-letter" role="tabpanel">
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="m-portlet__body" style="padding-right: 0;">
                        <div class=" row-list">
                            <div class="row">
                                @if(count($uploaded_document_ids) > 0 && isset($uploaded_document_ids['conveyance_stamp_duty_letter']))
                                    <div class="col-sm-6">
                                        <span class="hint-text font_w500">Click on 'Download' to download Pay Stamp Duty Letter</span>
                                            <div class="mt-3">
                                                <a href="{{ config('commanConfig.storage_server') .'/'. $uploaded_document_ids['conveyance_stamp_duty_letter']->sc_document_status->document_path }}" target="_blank" class="btn btn-primary btn-custom" rel="noopener">Download</a>
                                            </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sale deed agreement -->
            <div class="tab-pane section-2" id="sale-deed-agreement" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <form action="{{ route('upload_sale_lease') }}" id="sale_deed_agreement" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="application_id" name="application_id" value="{{ $sc_application->id }}">
                            <input type="hidden" id="document_name" name="document_name" value="{{ $document_lease['sale_deed_agreement']}}">
                            <div class="m-portlet__body w-100 row-list" style="padding-right: 0;">
                                <div class="row mt-3">
                                    @if($sc_application->scApplicationLog->status_id != config('commanConfig.conveyance_status.forwarded'))
                                        <div class="col-sm-6 d-flex flex-column h-100">
                                            <span class="hint-text font_w500">Click on 'Upload' to upload Sale Deed Agreement</span>
                                            <div class="custom-file mt-3">
                                                <input class="custom-file-input pdfcheck" name="document_path" type="file"
                                                       id="test-upload_sale_dee" required="required">
                                                <label class="custom-file-label" for="test-upload_sale_dee">Choose
                                                    file...</label>
                                                <span class="text-danger" id="file_error"></span>
                                            </div>
                                        </div>
                                    @endif

                                    @if(count($uploaded_document_ids) > 0 && isset($uploaded_document_ids['sale_deed_agreement']))
                                        <div class="col-sm-6 border-left">
                                            <span class="hint-text font_w500">Click on 'Download' to download Sale Deed Agreement</span>
                                            <div class="mt-3">
                                                <a href="{{ config('commanConfig.storage_server') .'/'. $uploaded_document_ids['sale_deed_agreement']->sc_document_status->document_path }}" target="_blank" class="btn btn-primary btn-custom" rel="noopener">Download</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-xs-12 row mt-3">
                                    <div class="col-xs-12 mt-3" style="width: 890px;">
                                    <span class="font_w500">Comments</span>
                                        <textarea class="form-control form-control--custom" name="remark" rows="5" cols="30" id="remark" placeholder="Comments" class="form-control"> 
                                        </textarea>
                                    </div>
                                        
                                    @if($sc_application->scApplicationLog->status_id != config('commanConfig.conveyance_status.forwarded'))
                                        <div class="col-xs-12 mt-4">
                                            <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>

            <div class="tab-pane section-3" id="lease-deed-agreement" role="tabpanel">
                <!-- lease deed agreement -->
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <form action="{{ route('upload_sale_lease') }}" id="lease_deed_agreement"  method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="application_id" name="application_id" value="{{ $sc_application->id }}">
                            <input type="hidden" id="document_name" name="document_name" value="{{ $document_lease['lease_deed_agreement']}}">
                            <div class="m-portlet__body" style="padding-right: 0;">
                                <div class="row w-100 row-list">
                                    @if($sc_application->scApplicationLog->status_id != config('commanConfig.conveyance_status.forwarded'))
                                        <div class="col-sm-6 d-flex flex-column h-100">
                                            <span class="hint-text font_w500">Click on 'Upload' to upload Lease Deed Agreement</span>
                                               
                                            <div class="custom-file mt-3">
                                                <input class="custom-file-input pdfcheck" name="document_path" type="file"
                                                       id="test-upload_lease_deed" required="required">
                                                <label class="custom-file-label" for="test-upload_lease_deed">Choose
                                                    file...</label>
                                                <span class="text-danger" id="file_error"></span>
                                                
                                            </div>
                                        </div>
                                    @endif

                                    @if(count($uploaded_document_ids) > 0 && isset($uploaded_document_ids['lease_deed_agreement']))
                                        <div class="col-sm-6 border-left">
                                            <span class="hint-text font_w500">Click on 'Download' to download Lease Deed Agreement</span>
                                            <div class="mt-3">
                                                <a href="{{ config('commanConfig.storage_server') .'/'. $uploaded_document_ids['lease_deed_agreement']->sc_document_status->document_path }}" target="_blank" class="btn btn-primary btn-custom" rel="noopener">Download</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-12">
                                    <div class="d-flex flex-column h-100">
                                        <span class="font_w500"> Comments : </span>
                                        <textarea name="remark" rows="5" cols="30" id="remark" placeholder="Write your comments here" class="form-control form-control--custom" ></textarea>
                                        @if($sc_application->scApplicationLog->status_id != config('commanConfig.conveyance_status.forwarded'))
                                            <div class="mt-auto"><br/>
                                                <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>

            <div class="tab-pane section-4" id="society-resolution-undertaking" role="tabpanel">
                <!-- Society Resolution div here -->
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                            <div class="m-subheader">
                                <div class="row">
                                    @if($sc_application->scApplicationLog->status_id != config('commanConfig.conveyance_status.forwarded'))
                                        <div class="col-sm-6 d-flex flex-column h-100">
                                            <span class="hint-text font_w500">Click on 'Upload' to upload signed & stamped society resolution.</span>
                                            <form action="{{ route('upload_sale_lease') }}" id="society_resolution" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="custom-file mt-3">
                                                    <input class="custom-file-input pdfcheck" name="document_path" type="file"
                                                           id="test-upload_society resolution" required="required">
                                                    <label class="custom-file-label" for="test-upload_society resolution">Choose
                                                        file...</label>
                                                    <span class="text-danger" id="file_error"></span>
                                                    <input type="hidden" id="application_id" name="application_id" value="{{ $sc_application->id }}">
                                                    <input type="hidden" id="document_name" name="document_name" value="{{ $document_lease['sc_resolution']}}">
                                                </div>
                                                <div class="mt-auto">
                                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                    @if(count($uploaded_document_ids) > 0 && isset($uploaded_document_ids['sc_resolution']))
                                        <div class="col-sm-6 border-left mt-3">
                                            <span class="hint-text font_w500">Click on 'Download' to downaload Society Resolution</span>
                                            <div class="mt-3">
                                                <a href="{{ config('commanConfig.storage_server') .'/'. $uploaded_document_ids['sc_resolution']->sc_document_status->document_path }}" target="_blank" class="btn btn-primary btn-custom" rel="noopener">Download</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- society under taking -->
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                            <div class="w-100 row-list">
                                <div class="row">
                                    @if($sc_application->scApplicationLog->status_id != config('commanConfig.conveyance_status.forwarded'))
                                        <div class="col-sm-6 d-flex flex-column h-100">
                                                <span class="hint-text font_w500">Click on 'Upload' to upload signed & stamped society undertaking</span>
                                            <form action="{{ route('upload_sale_lease') }}" id="society_undertaking" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="custom-file mt-3">
                                                    <input class="custom-file-input pdfcheck" name="document_path" type="file"
                                                           id="test-upload_society_undertaking" required="required">
                                                    <label class="custom-file-label" for="test-upload_society_undertaking">Choose
                                                        file...</label>
                                                    <span class="text-danger" id="file_error"></span>
                                                    <input type="hidden" id="application_id" name="application_id" value="{{ $sc_application->id }}">
                                                    <input type="hidden" id="document_name" name="document_name" value="{{ $document_lease['sc_undertaking']}}">
                                                </div>
                                                <div class="mt-auto">
                                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif

                                    @if(count($uploaded_document_ids) > 0 && isset($uploaded_document_ids['sc_undertaking']))
                                        <div class="col-sm-6 border-left">
                                            <span class="hint-text font_w500">Click on 'Download' to download Society Undertaking</span>
                                            <div class="mt-3">
                                                <a href="{{ config('commanConfig.storage_server') .'/'. $uploaded_document_ids['sc_undertaking']->sc_document_status->document_path }}" target="_blank" class="btn btn-primary btn-custom" rel="noopener">Download</a>
                                            </div>
                                        </div>
                                    @endif

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Indemnity bond -->
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                            <div class="w-100 row-list">
                                <div class="row">
                                    @if($sc_application->scApplicationLog->status_id != config('commanConfig.conveyance_status.forwarded'))
                                        <div class="col-sm-6 d-flex flex-column h-100">
                                            <span class="hint-text font_w500">Click on 'Upload' to upload Indemnity Bond</span>
                                            <form action="{{ route('upload_sale_lease') }}" id="sc_Indemnity Bond" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="custom-file mt-3">
                                                    <input class="custom-file-input pdfcheck" name="document_path" type="file"
                                                           id="test-upload_sc_Indemnity Bond" required="required">
                                                    <label class="custom-file-label" for="test-upload_sc_Indemnity Bond">Choose
                                                        file...</label>
                                                    <span class="text-danger" id="file_error"></span>
                                                    <input type="hidden" id="application_id" name="application_id" value="{{ $sc_application->id }}">
                                                    <input type="hidden" id="document_name" name="document_name" value="{{ $document_lease['sc_indemnity_bond']}}">
                                                </div>
                                                <div class="mt-auto">
                                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                    @if(count($uploaded_document_ids) > 0 && isset($uploaded_document_ids['sc_indemnity_bond']))
                                        <div class="col-sm-6 border-left">
                                            <span class="section-title font_w500">Click on 'Download' to download Indemnity Bond</span>
                                            <div class="mt-3">
                                                <a href="{{ config('commanConfig.storage_server') .'/'. $uploaded_document_ids['sc_indemnity_bond']->sc_document_status->document_path }}" target="_blank" class="btn btn-primary btn-custom" rel="noopener">Download</a>
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

        <!-- common upload and submit -->
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
            <div class="portlet-body">
                <div class="m-portlet__body" style="padding-right: 0;"> 
                    <form action="{{ route('upload_sale_lease') }}" id="sale_deed_agreement" method="post" enctype="multipart/form-data">
                        @csrf 
                        <input type="hidden" id="application_id" name="application_id" value="{{ $sc_application->id }}">
                        <div class="mt-auto"><br/>
                            @if($sc_application->scApplicationLog->status_id != config('commanConfig.conveyance_status.forwarded'))
                                <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Submit & Forward</button>
                            @endif
                        </div>
                    </form>    
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