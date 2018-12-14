@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.renewal.actions',compact('sc_application'))
@endsection
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Upload documents</h3>
            {{ Breadcrumbs::render('documents_upload') }}
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0">
        <!-- <div class="m-portlet__head main-sub-title">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="flaticon-statistics"></i>
                    </span>
                    <h2 class="m-portlet__head-label m-portlet__head-label--custom">
                        <span>
                            Upload Attachments
                        </span>
                    </h2>
                </div>
            </div>
        </div> -->

        <div class="m-portlet__body m-portlet__body--table">
            <div class="m-section mb-0">
                <div class="m-section__content mb-0 table-responsive">
                    <table class="table mb-0">
                        <thead class="thead-default">
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Document Name
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=1; @endphp
                        @foreach($documents as $document)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                {{ ucwords(str_replace('_', ' ', $document->document_name)) }}<span class="compulsory-text">(Compulsory Document)</span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger">
                                    @if($document->sr_document_status != null)
                                        @php $document_uploaded = $document->sr_document_status; @endphp
                                    @if($document_uploaded['application_id'] == $sc_application->id)
                                    <i class="fa fa-check"></i>
                                    @else
                                    <i class="fa fa-remove"></i>
                                    @endif
                                    @else
                                    <i class="fa fa-remove"></i>
                                    @endif
                                </h2>
                            </td>
                            <td>
                                @if($document->sr_document_status != null)
                                    @php $document_uploaded = $document->sr_document_status; @endphp
                                {{--@foreach($document->sr_document_status as $document_uploaded)--}}
                                @if($document_uploaded['application_id'] == $sc_application->id)
                                <span>
                                        <a href="{{ config('commanConfig.storage_server').'/'.$document_uploaded['document_path'] }}" data-value='{{ $document->id }}'
                                           class="upload_documents" target="_blank" rel="noopener" download><button type="submit" class="btn btn-primary btn-custom">
                                                Download</button></a>
                                        @if($sc_application->srApplicationLog->status_id == 4)
                                            <a href="{{ route('delete_sr_upload_docs', encrypt($document->id)) }}" data-value='{{ $document->id }}'
                                               class="upload_documents"><button type="submit" class="btn btn-primary btn-custom">
                                                    <i class="fa fa-trash"></i></button></a>
                                        @endif
                                    </span>
                                @else
                                <form action="{{ route('upload_sr_docs') }}" method="post" enctype='multipart/form-data' class="sr_upload_documents_form"
                                      id="sr_upload_documents_form_{{ $document->id }}">
                                    @csrf
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="document_name" type="file" class=""
                                               id="test-upload_{{ $document->id }}" required>
                                        <input class="form-control m-input" type="hidden" name="document_id" value="{{ $document->id }}">
                                        <label class="custom-file-label" for="test-upload_{{ $document->id }}">Choose
                                            file ...</label>
                                        <span class="help-block">
                                                @if(session('error_'.$document->id))
                                                session('error_'.$document->id)
                                                @endif
                                            </span>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                </form>
                                @endif
                                {{--@endforeach--}}
                                @else
                                <form action="{{ route('upload_sr_docs') }}" method="post" enctype='multipart/form-data' class="sr_upload_documents_form"
                                      id="sr_upload_documents_form_{{ $document->id }}">
                                    @csrf
                                    <div class="custom-file @if(session('error_'.$document->id)) has-error @endif">
                                        <input class="custom-file-input" name="document_name" type="file" id="test-upload_{{ $document->id }}"
                                               required>
                                        <input class="form-control m-input" type="hidden" name="document_id" value="{{ $document->id }}">
                                        <label class="custom-file-label" for="test-upload_{{ $document->id }}">Choose
                                            file ...</label>
                                        <span class="help-block text-danger">
                                                @if(session('error_'.$document->id))
                                                {{session('error_'.$document->id)}}
                                                @endif
                                            </span>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn_{{ $document->id }}">Upload</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" id="uploaded_id" value="{{ $uploaded_document_id }}">
                </div>
            </div>
        </div>
    </div>
    @if(!empty($documents) && !empty($documents_uploaded))
        @if(count($documents) == count($documents_uploaded))
            <div class="m-portlet">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                    <div class="">
                        <h3 class="section-title section-title--small">Submit Application:</h3>
                    </div>
                    <form action="{{ route('society_doc_comment') }}" method="post" enctype='multipart/form-data'>
                        @csrf
                        <div class="remarks-suggestions table--box-input">
                            <div class="mt-3">
                                <label for="society_documents_comment">Additional Information:</label>
                                <div class="@if($errors->has('society_documents_comment')) has-error @endif">
                                    <textarea name="society_documents_comment" rows="5" cols="30" id="society_documents_comment" class="form-control form-control--custom">@if(isset($renewal_doc_comments) && count($renewal_doc_comments) > 0) {{ $renewal_doc_comments->society_documents_comment }} @endif</textarea>
                                    <span class="help-block">{{$errors->first('society_documents_comment')}}</span>
                                </div>
                            </div>
                            <div class="mt-3 btn-list">
                                <button class="btn btn-primary" type="submit" id="uploadBtn">Submit</button>
                                <a href="{{route('society_offer_letter_dashboard')}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    <!-- <a href="{{ route('society_offer_letter_dashboard') }}" class="btn btn-primary btn-custom" id="">Cancel</a> -->
                    </form>
                </div>
            </div>
        @endif
    @endif
</div>
@endsection
@section('datatablejs')
    <script>
        $(document).ready(function(){
            $('.sr_upload_documents_form').on('change', function(){

                var id = $(this).closest('tr').find("input[name='document_id']")[0].value;
                var uploaded_id = $('#uploaded_id').val();

                if(id == uploaded_id){
                    $(this).validate({
                        rules:{
                            document_name : {
                                extension: 'xls'
                            }
                        },
                        messages: {
                            document_name : {
                                extension: 'Only .xls required for this document.'
                            }
                        }
                    });
                }else{
                    $(this).validate({
                        rules:{
                            document_name : {
                                extension: 'pdf'
                            }
                        },
                        messages: {
                            document_name : {
                                extension: 'Only .pdf required for this document.'
                            }
                        }
                    });
                }

            });

            $('#society_bank_details').validate({
                rules: {
                    account_no:{
                        required:true,
                        number:true
                    },
                    ifsc_code:{
                        required:true
                    },
                    bank_name:{
                        required:true
                    }
                },
                messages: {
                    account_no:{
                        required:'Enter Bank Account number.',
                    },
                    ifsc_code:{
                        required:'Enter Bank IFSC code'
                    },
                    bank_name:{
                        required:'Enter Bank Name.'
                    }
                }
            });

            $('#ifsc_code').on('keyup', function () {
                var str = $(this).val();
                var exp = /^[A-Z]{4}[0][\d]{6}/;

                if(str.length > 10){
                    if(!exp.test(str) || str.length > 11){
                        $('#error_ifsc_code').text('IFSC code not valid.').addClass('text-danger');
                    }else{
                        $('#error_ifsc_code').text('');
                    }
                }else{
                    if(empty(str)){
                        $('#error_ifsc_code').text('');
                    }
                }
            });
        });
    </script>
@endsection
