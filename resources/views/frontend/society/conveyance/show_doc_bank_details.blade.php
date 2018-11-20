@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.conveyance.actions',compact('sc_application'))
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
                                {{ $document->document_name }}<span class="compulsory-text">(Compulsory Document)</span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger">
                                    @if($document->sc_document_status != null)
                                        @php $document_uploaded = $document->sc_document_status; @endphp
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
                                @if($document->sc_document_status != null)
                                    @php $document_uploaded = $document->sc_document_status; @endphp
                                {{--@foreach($document->sc_document_status as $document_uploaded)--}}
                                @if($document_uploaded['application_id'] == $sc_application->id)
                                <span>
                                        <a href="{{ config('commanConfig.storage_server').'/'.$document_uploaded['document_path'] }}" data-value='{{ $document->id }}'
                                           class="upload_documents" target="_blank" rel="noopener" download><button type="submit" class="btn btn-primary btn-custom">
                                                Download</button></a>
                                        @if($sc_application->scApplicationLog->status_id == 4)
                                            <a href="{{ route('delete_sc_upload_docs', base64_encode($document->id)) }}" data-value='{{ $document->id }}'
                                               class="upload_documents"><button type="submit" class="btn btn-primary btn-custom">
                                                    <i class="fa fa-trash"></i></button></a>
                                        @endif
                                    </span>
                                @else
                                <form action="{{ route('upload_sc_docs') }}" method="post" enctype='multipart/form-data' class="sc_upload_documents_form"
                                      id="sc_upload_documents_form_{{ $document->id }}">
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
                                <form action="{{ route('upload_sc_docs') }}" method="post" enctype='multipart/form-data' class="sc_upload_documents_form"
                                      id="sc_upload_documents_form_{{ $document->id }}">
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
                </div>
            </div>
        </div>
    </div>
    @if(!empty($documents) && !empty($documents_uploaded))
        @if(count($documents) == count($documents_uploaded))
            <div class="m-portlet">
                <div>
                    <div>
                        <div class="portlet-body">
                            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                                <div class="">
                                    <h3 class="section-title section-title--small">Enter Bank Details:</h3>
                                </div>
                                <form action="{{ route('society_bank_details') }}" id="society_bank_details" method="post" enctype='multipart/form-data'>
                                    @csrf
                                    <div class="m-portlet__body m-portlet__body--spaced">
                                        @for($i=0; $i < count($sc_bank_details_fields); $i++)
                                            @if($i != 0) @php $i++; @endphp @endif
                                                <div class="form-group m-form__group row">
                                                    @if(isset($sc_bank_details_fields[$i]))
                                                        <div class="col-sm-4 form-group">
                                                            <label class="col-form-label" for="{{ $sc_bank_details_fields[$i] }}">@php $labels = implode(' ', explode('_', $sc_bank_details_fields[$i])); echo ucwords($labels); @endphp:</label>
                                                            @php if($sc_application->scApplicationLog->status_id == 2 || (count($society_bank_details) > 0 && $sc_application->scApplicationLog->status_id == 4)){ $readonly = 'readonly'; $value = $society_bank_details[$sc_bank_details_fields[$i]]; }else{ $readonly = ''; $value = ''; }; echo $comm_func->form_fields($sc_bank_details_fields[$i], 'text','' , '', $value, $readonly); @endphp
                                                            <span id="error_{{ $sc_bank_details_fields[$i] }}" class="help-block">{{$errors->first($sc_bank_details_fields[$i])}}</span>
                                                        </div>
                                                    @endif
                                                    @if(isset($sc_bank_details_fields[$i+1]))
                                                        <div class="col-sm-4 offset-sm-1 form-group">
                                                            <label class="col-form-label" for="{{ $sc_bank_details_fields[$i+1] }}">@php $labels = implode(' ', explode('_', $sc_bank_details_fields[$i+1])); echo ucwords($labels); @endphp:</label>
                                                            @php if($sc_application->scApplicationLog->status_id == 2 || (count($society_bank_details) > 0 && $sc_application->scApplicationLog->status_id == 4)){ $readonly = 'readonly'; $value = $society_bank_details[$sc_bank_details_fields[$i+1]]; }else{ $readonly = ''; $value = ''; }; echo $comm_func->form_fields($sc_bank_details_fields[$i+1], 'text','' , '', $value, $readonly); @endphp
                                                            <span id="error_{{ $sc_bank_details_fields[$i+1] }}" class="help-block">{{$errors->first($sc_bank_details_fields[$i+1])}}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                        @endfor
                                        <div class="mt-3 btn-list">
                                            <button class="btn btn-primary" type="submit" id="uploadBtn">Submit</button>
                                            <a href="{{route('society_offer_letter_dashboard')}}" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                    <!-- <a href="{{ route('society_offer_letter_dashboard') }}" class="btn btn-primary btn-custom" id="">Cancel</a> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
@endsection
@section('datatablejs')
    <script>
        $(document).ready(function(){
            $('.sc_upload_documents_form').on('change', function(){
                var id = $(this).closest('tr').find("input[name='document_id']")[0].value;

                if(id == 1){
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
