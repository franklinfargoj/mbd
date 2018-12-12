@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.conveyance.actions',compact('sc_application', 'documents', 'documents_uploaded'))
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
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#sale-deed-agreement" role="tab"
                       aria-selected="false">
                        <i class="la la-cog"></i> Sale Deed Agreement
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
            <div class="tab-pane section-1 active show" id="sale-deed-agreement" role="tabpanel">
                <div class="m-portlet m-portlet--mobile m_panel">
                    <div class="m-portlet__body" style="padding-right: 0;">
                        <div class=" row-list">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="section-title section-title--small mb-0">Download Stamped & Signed Agreement</h4>
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
                                        <p>Click Download to download Sale deed agreement in .pdf format.</p>
                                        {{--<button class="btn btn-primary btn-custom" id="uploadBtn" data-toggle="modal" data-target="#myModal">Edit</button>--}}
                                        {{--@if($data->sc_form_request->template_file)--}}
                                        <a href="{{ config('commanConfig.storage_server') .'/'. $sale_deed_agreement->document_path }}" class="btn btn-primary" target="_blank" rel="noopener">Download</a>
                                        {{--@endif--}}
                                </div>
                            </div>
                        </div>
                        <div class="w-100 row-list">
                            <div class="">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="d-flex flex-column h-100">
                                            <h5>Upload Registered Agreement</h5>
                                            <span class="hint-text">Click on 'Upload' to upload Sale deed agreement</span>
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
                                                <form action="{{ route('upload_signed_sale_lease') }}" id="sale_deed_agreement" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="m-portlet__body m-portlet__body--spaced">
                                                        @for($i=0; $i < count($field_names); $i++)
                                                            @if($i != 0)
                                                                @php $i++; @endphp
                                                            @endif
                                                            @if(isset($field_names[$i]) && ($field_names[$i] == 'application_id' || $field_names[$i] == 'agreement_type_id' || $field_names[$i] == 'application_id' || $field_names[$i] == 'user_id' || $field_names[$i] == 'society_flag' || $field_names[$i] == 'status_id' || $field_names[$i] == 'document_id'))
                                                                @php $type = 'hidden'; if($field_names[$i] == 'application_id'){ $value = $sc_application->id; } if($field_names[$i] == 'agreement_type_id' || $field_names[$i] == 'document_id'){ $value = $sale_agreement_type_id; } if($field_names[$i] == 'user_id'){ $value = Auth::user()->id; } if($field_names[$i] == 'status_id'){ $value = $status; } if($field_names[$i] == 'society_flag'){ $value = $society_flag; } echo $comm_func->form_fields($field_names[$i], $type,'' , '', $value); @endphp
                                                            @else
                                                                @php $type = 'text'; @endphp
                                                            @endif
                                                            @if(isset($field_names[$i+1]) && ($field_names[$i+1] == 'application_id' || $field_names[$i+1] == 'agreement_type_id' || $field_names[$i+1] == 'application_id' || $field_names[$i+1] == 'user_id' || $field_names[$i+1] == 'society_flag' || $field_names[$i+1] == 'status_id' || $field_names[$i+1] == 'document_id'))
                                                                @php if($field_names[$i+1] == 'application_id'){ $value_1 = $sc_application->id; } if($field_names[$i+1] == 'agreement_type_id' || $field_names[$i+1] == 'document_id'){ $value_1 = $sale_agreement_type_id; } if($field_names[$i+1] == 'user_id'){ $value_1 = Auth::user()->id; } if($field_names[$i+1] == 'status_id'){ $value_1 = $status; } if($field_names[$i+1] == 'society_flag'){ $value_1 = $society_flag; } $type_1 = 'hidden'; echo $comm_func->form_fields($field_names[$i+1], $type_1,'' , '', $value_1);  @endphp
                                                            @else
                                                                @php $type_1 = 'text'; @endphp
                                                            @endif
                                                            @if($type != 'hidden' || $type_1 != 'hidden')
                                                                <div class="form-group m-form__group row">
                                                                    @if(isset($field_names[$i]))
                                                                        @php if($field_names[$i] == 'document_path'){ $type = 'file'; } @endphp
                                                                        @if($type != 'hidden')
                                                                            <div class="col-sm-4 form-group">
                                                                                <label class="col-form-label" for="{{ $field_names[$i] }}">@php if($field_names[$i] == 'document_path'){ echo 'Upload Sale Deed Agreement'; }else{ $labels = implode(' ', explode('_', $field_names[$i])); echo ucwords($labels); } @endphp:</label>
                                                                                @php if(isset($sc_registrar_details['Sale Deed Agreement']) && count($sc_registrar_details['Sale Deed Agreement']) > 0){ $value = $sc_registrar_details['Sale Deed Agreement'][$field_names[$i]]; $readonly = 'readonly'; }else{ $value =''; $readonly = ''; } echo $comm_func->form_fields($field_names[$i], $type,'' , '', $value, $readonly); @endphp
                                                                                <span id="error_{{ $field_names[$i] }}" class="help-block">{{$errors->first($field_names[$i])}}</span>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if(isset($field_names[$i+1]))
                                                                        @php if($field_names[$i+1] == 'document_path'){ $type = 'file'; } @endphp
                                                                        @if($type_1 != 'hidden')
                                                                            <div class="col-sm-4 offset-sm-1 form-group">
                                                                                <label class="col-form-label" for="{{ $field_names[$i+1] }}">@php if($field_names[$i+1 ] == 'document_path'){ echo 'Upload Sale Deed Agreement'; }else{ $labels = implode(' ', explode('_', $field_names[$i+1])); echo ucwords($labels); } @endphp:</label>
                                                                                @php if(isset($sc_registrar_details['Sale Deed Agreement']) && count($sc_registrar_details['Sale Deed Agreement']) > 0){ $value = $sc_registrar_details['Sale Deed Agreement'][$field_names[$i+1]]; $readonly = 'readonly'; }else{ $value =''; $readonly = ''; } echo $comm_func->form_fields($field_names[$i+1], $type_1,'' , '', $value, $readonly); @endphp
                                                                                <span id="error_{{ $field_names[$i+1] }}" class="help-block">{{$errors->first($field_names[$i+1])}}</span>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                @php $type = ''; @endphp
                                                            @endif
                                                        @endfor
                                                        {{--<div class="form-group m-form__group row">--}}
                                                        {{--<div class="col-sm-4 form-group">--}}
                                                        {{--<label class="col-form-label" for="template">Upload File:</label>--}}
                                                        {{--<div class="custom-file">--}}
                                                        {{--<input class="custom-file-input pdfcheck" name="no_dues_certificate" type="file"--}}
                                                        {{--id="test-upload" required="required">--}}
                                                        {{--<label class="custom-file-label" for="test-upload">Choose--}}
                                                        {{--file...</label>--}}
                                                        {{--<span class="text-danger" id="file_error"></span>--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        <div class="mt-3 btn-list">
                                                            @if(!(isset($sc_registrar_details['Sale Deed Agreement']) && count($sc_registrar_details['Sale Deed Agreement']) > 0))
                                                                <button class="btn btn-primary" type="submit" id="uploadBtn">Submit</button>
                                                            @endif
                                                            <a href="{{route('society_conveyance.index')}}" class="btn btn-secondary">Cancel</a>
                                                        </div>
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
            <div class="tab-pane section-2" id="lease-deed-agreement" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body" style="padding-right: 0;">
                            <div class=" row-list">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="section-title section-title--small mb-0">Download Stamped & Signed Agreement</h4>
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
                                            <p>Click Download to download Lease deed agreement in .pdf format.</p>
                                            {{--@if($data->sc_form_request->template_file)--}}
                                            <a href="{{ config('commanConfig.storage_server') .'/'. $lease_deed_agreement->document_path }}" class="btn btn-primary" target="_blank" rel="noopener">Download</a>
                                            {{--@endif--}}
                                    </div>
                                </div>
                            </div>
                            <div class="w-100 row-list">
                                <div class="">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="d-flex flex-column h-100">
                                                <h5>Upload Registered Agreement</h5>
                                                <span class="hint-text">Click on 'Upload' to upload Lease deed agreement</span>
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
                                                <form action="{{ route('upload_signed_sale_lease') }}" id="lease_deed_agreement" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="m-portlet__body m-portlet__body--spaced">
                                                            @for($i=0; $i < count($field_names); $i++)
                                                                @if($i != 0)
                                                                    @php $i++; @endphp
                                                                @endif
                                                                @if(isset($field_names[$i]) && ($field_names[$i] == 'application_id' || $field_names[$i] == 'agreement_type_id' || $field_names[$i] == 'application_id' || $field_names[$i] == 'user_id' || $field_names[$i] == 'society_flag' || $field_names[$i] == 'status_id' || $field_names[$i] == 'document_id'))
                                                                    @php $type = 'hidden'; if($field_names[$i] == 'application_id'){ $value = $sc_application->id; } if($field_names[$i] == 'agreement_type_id' || $field_names[$i] == 'document_id'){ $value = $lease_agreement_type_id; } if($field_names[$i] == 'user_id'){ $value = Auth::user()->id; } if($field_names[$i] == 'status_id'){ $value = $status; } if($field_names[$i] == 'society_flag'){ $value = $society_flag; } echo $comm_func->form_fields($field_names[$i], $type,'' , '', $value); @endphp
                                                                @else
                                                                    @php $type = 'text'; @endphp
                                                                @endif
                                                                @if(isset($field_names[$i+1]) && ($field_names[$i+1] == 'application_id' || $field_names[$i+1] == 'agreement_type_id' || $field_names[$i+1] == 'application_id' || $field_names[$i+1] == 'user_id' || $field_names[$i+1] == 'society_flag' || $field_names[$i+1] == 'status_id' || $field_names[$i+1] == 'document_id'))
                                                                        @php if($field_names[$i+1] == 'application_id'){ $value_1 = $sc_application->id; } if($field_names[$i+1] == 'agreement_type_id' || $field_names[$i+1] == 'document_id'){ $value_1 = $lease_agreement_type_id; } if($field_names[$i+1] == 'user_id'){ $value_1 = Auth::user()->id; } if($field_names[$i+1] == 'status_id'){ $value_1 = $status; } if($field_names[$i+1] == 'society_flag'){ $value_1 = $society_flag; } $type_1 = 'hidden'; echo $comm_func->form_fields($field_names[$i+1], $type_1,'' , '', $value_1);  @endphp
                                                                @else
                                                                    @php $type_1 = 'text'; @endphp
                                                                @endif
                                                                @if($type != 'hidden' || $type_1 != 'hidden')
                                                                    <div class="form-group m-form__group row">
                                                                        @if(isset($field_names[$i]))
                                                                            @php if($field_names[$i] == 'document_path'){ $type = 'file'; $field_names[$i] = $field_names[$i].'_lease'; } @endphp
                                                                            @if($type != 'hidden')
                                                                                <div class="col-sm-4 form-group">
                                                                                    <label class="col-form-label" for="{{ $field_names[$i] }}">@php if($field_names[$i] == 'document_path_lease'){ echo 'Upload Lease Deed Agreement'; }else{ $labels = implode(' ', explode('_', $field_names[$i])); echo ucwords($labels); } @endphp:</label>
                                                                                    @php if(isset($sc_registrar_details['Lease Deed Agreement']) && count($sc_registrar_details['Lease Deed Agreement']) > 0){ $value = $sc_registrar_details['Lease Deed Agreement'][$field_names[$i]]; $readonly = 'readonly'; }else{ $value =''; $readonly = ''; } echo $comm_func->form_fields($field_names[$i], $type,'' , '', $value, $readonly); @endphp
                                                                                    <span id="error_{{ $field_names[$i] }}" class="help-block">{{$errors->first($field_names[$i])}}</span>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                        @if(isset($field_names[$i+1]))
                                                                                @php if($field_names[$i+1] == 'document_path'){ $type = 'file'; $field_names[$i+1] = $field_names[$i+1].'_lease'; } @endphp
                                                                            @if($type_1 != 'hidden')
                                                                                <div class="col-sm-4 offset-sm-1 form-group">
                                                                                    <label class="col-form-label" for="{{ $field_names[$i+1] }}">@php if($field_names[$i+1] == 'document_path_lease'){ echo 'Upload Lease Deed Agreement'; }else{ $labels = implode(' ', explode('_', $field_names[$i+1])); echo ucwords($labels); } @endphp:</label>
                                                                                    @php if(isset($sc_registrar_details['Lease Deed Agreement']) && count($sc_registrar_details['Lease Deed Agreement']) > 0){ $value = $sc_registrar_details['Lease Deed Agreement'][$field_names[$i+1]]; $readonly = 'readonly'; }else{ $value =''; $readonly = ''; } echo $comm_func->form_fields($field_names[$i+1], $type_1,'' , '', $value, $readonly); @endphp
                                                                                    <span id="error_{{ $field_names[$i+1] }}" class="help-block">{{$errors->first($field_names[$i+1])}}</span>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                    @php $type = ''; @endphp
                                                                @endif
                                                            @endfor
                                                                {{--<div class="form-group m-form__group row">--}}
                                                                    {{--<div class="col-sm-4 form-group">--}}
                                                                        {{--<label class="col-form-label" for="template">Upload File:</label>--}}
                                                                        {{--<div class="custom-file">--}}
                                                                            {{--<input class="custom-file-input pdfcheck" name="no_dues_certificate" type="file"--}}
                                                                                   {{--id="test-upload" required="required">--}}
                                                                            {{--<label class="custom-file-label" for="test-upload">Choose--}}
                                                                                {{--file...</label>--}}
                                                                            {{--<span class="text-danger" id="file_error"></span>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                                <div class="mt-3 btn-list">
                                                                @if(!(isset($sc_registrar_details['Lease Deed Agreement']) && count($sc_registrar_details['Lease Deed Agreement']) > 0))
                                                                    <button class="btn btn-primary" type="submit" id="uploadBtn">Submit</button>
                                                                @endif
                                                                <a href="{{route('society_conveyance.index')}}" class="btn btn-secondary">Cancel</a>
                                                            </div>
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

            var id = Cookies.get('sectionid');
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

            function showUploadedFileName() {
                $('.custom-file-input').change(function (e) {
                    $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
                });
            }
            showUploadedFileName();

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

            $('.society_registered').delay("slow").slideUp("slow");

        });
    </script>


@endsection