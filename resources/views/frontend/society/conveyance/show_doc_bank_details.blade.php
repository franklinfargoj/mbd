@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.conveyance.actions',compact('sc_application', 'documents', 'documents_uploaded'))
@endsection
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Upload documents</h3>
{{--            {{ Breadcrumbs::render('conveyance_society_document') }}--}}
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0">
        <div class="m-portlet__body m-portlet__body--table">
            <div class="m-section mb-0">
                <div class="m-section__content mb-0 table-responsive">
                    <table class="table mb-0">
                        <thead class="thead-default">
                        <tr>
                            <th>Sr.no</th>
                            <th> Document Name </th>
                            <th> Status </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=1; $doc_uploaded = 0; @endphp
                        @foreach($documents as $document)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                {{ $document->document_name }}
                                @if($document->is_optional == 0)
                                    <span class="compulsory-text">
                                    <small>(Compulsory Document)</small></span>
                                @else
                                    <span class="compulsory-text"> <small>
                                    <span style="color: green;">
                                    (Optional Document)</small> </span>
                                @endif
                            </td>
                            @if(count($document->sc_document_status) > 0 )
                                <td class="text-center">
                                    <h2 class="m--font-danger">
                                         <i class="fa fa-check"></i>
                                    </h2>
                                </td>
                                <td>
                                @if($document->is_other == 1) 
                                <!-- href="{{ route('upload_other_documents',[encrypt($sc_application->id),encrypt($document->id)]) }}" -->
                                    <a href="" class="app-card__details mb-0 btn-link" style="font-size: 14px" data-target="#myModal" data-toggle="modal"> upload other documents</a> 
                                @else
                                    <a href="{{ config('commanConfig.storage_server').'/'.$document->sc_document_status->document_path }}" data-value='{{ $document->id }}' class="upload_documents" target="_blank" rel="noopener" download>
                                    <button type="submit" class="btn btn-primary btn-custom">Download</button></a>
                                    @if($sc_application->scApplicationLog->status_id == config('commanConfig.conveyance_status.pending'))
                                        <a href="{{ route('delete_sc_upload_docs', encrypt($document->sc_document_status->id)) }}" data-value='{{ $document->id }}' class="upload_documents"><button type="submit" class="btn btn-primary btn-custom"><i class="fa fa-trash"></i></button></a>
                                    @endif    
                                @endif    
                                </td>                    
                            @else 
                                <td class="text-center">
                                    <h2 class="m--font-danger">
                                        <i class="fa fa-remove"></i>
                                    </h2>
                                </td>
                                <td>
                                @if($document->is_other == 1) 
                                <!-- href="{{ route('upload_other_documents',[encrypt($sc_application->id),encrypt($document->id)]) }}" -->
                                    <a  class="app-card__details mb-0 btn-link" style="font-size: 14px" data-target="#myModal" data-toggle="modal">
                                    upload other documents</a> 
                                @else    
                                    <form action="{{ route('upload_sc_docs') }}" method="post" enctype='  multipart/form-data' class="sc_upload_documents_form"
                                          id="sc_upload_documents_form_{{ $document->id }}">
                                        @csrf
                                        <div class="custom-file">
                                            <input class="custom-file-input" name="document_name" type="file" id="test-upload_{{ $document->id }}" required>
                                            <input class="form-control m-input" type="hidden" name="document_id" value="{{ $document->id }}">
                                            <label class="custom-file-label" for="test-upload_{{ $document->id }}">Choose
                                                file ...</label>
                                            <span class="help-block">
                                                @if(session('error_'.$document->id))
                                                session('error_'.$document->id)
                                                @endif
                                            </span>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                    </form>  
                                @endif     
                                </td>
                            @endif
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- bank details -->
    <div class="m-portlet">
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
                                            @php if($society_bank_details!=null && ($sc_application->scApplicationLog->status_id == config('commanConfig.conveyance_status.reverted') || $sc_application->scApplicationLog->status_id == config('commanConfig.conveyance_status.pending'))){ $readonly = ''; $value = $society_bank_details[$sc_bank_details_fields[$i]]; }else{ if($society_bank_details==null){ $readonly = ''; }else{ $readonly = 'readonly'; }  $value = $society_bank_details[$sc_bank_details_fields[$i]]; }  echo $comm_func->form_fields($sc_bank_details_fields[$i], 'text','' , '', $value, $readonly); @endphp
                                            <span id="error_{{ $sc_bank_details_fields[$i] }}" class="help-block">{{$errors->first($sc_bank_details_fields[$i])}}</span>
                                        </div>
                                    @endif
                                    @if(isset($sc_bank_details_fields[$i+1]))
                                        <div class="col-sm-4 offset-sm-1 form-group">
                                            <label class="col-form-label" for="{{ $sc_bank_details_fields[$i+1] }}">@php $labels = implode(' ', explode('_', $sc_bank_details_fields[$i+1])); echo ucwords($labels); @endphp:</label>
                                            @php if($society_bank_details!=null && ($sc_application->scApplicationLog->status_id == config('commanConfig.conveyance_status.reverted') || $sc_application->scApplicationLog->status_id == config('commanConfig.conveyance_status.pending'))){ $readonly = ''; $value = $society_bank_details[$sc_bank_details_fields[$i+1]]; }else{ if($society_bank_details ==null){ $readonly = ''; }else{ $readonly = 'readonly'; } $value = $society_bank_details[$sc_bank_details_fields[$i+1]]; }  echo $comm_func->form_fields($sc_bank_details_fields[$i+1], 'text','' , '', $value, $readonly); @endphp
                                            <span id="error_{{ $sc_bank_details_fields[$i+1] }}" class="help-block">{{$errors->first($sc_bank_details_fields[$i+1])}}</span>
                                        </div>
                                    @endif
                                </div>
                        @endfor
                        <div class="mt-3 btn-list">
                            @if($sc_application->scApplicationLog->status_id == config('commanConfig.conveyance_status.pending') || $sc_application->scApplicationLog->status_id == config('commanConfig.conveyance_status.reverted'))
                                <button class="btn btn-primary" type="submit" id="uploadBtn">Submit</button>
                            @endif
                            <a href="{{route('society_conveyance.index')}}" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Upload Documents</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form action="{{ route('upload_sc_docs') }}" method="post" enctype='multipart/form-data' class="sc_upload_documents_form"
            id="sc_upload_documents_form_{{ $document->id }}">
            @csrf
            <div class="col-sm-6 form-group">
                <label class="col-form-label" for="other_document_name">Document Name:</label>
                <input type="text" id="other_document_name" name="other_document_name" class="form-control form-control--custom m-input">

                <span class="help-block">{{$errors->first('doc_name')}}</span>
            </div>
            <div class="col-sm-6 form-group">
                <label class="col-form-label" for="doc_name">Upload Document:</label>
                <div class="custom-file @if(session('error_'.$document->id)) has-error @endif">
                    <input class="custom-file-input" name="document_name" type="file" id="test-upload_{{ $document->id }}"
                    @if($document->is_optional == '0') required @endif>
                    <input class="form-control m-input" type="hidden" name="document_id" value="{{ $document->id }}">
                    <label class="custom-file-label" for="test-upload_{{ $document->id }}">Choose
                        file ...</label>
                    <span class="help-block text-danger">
                            @if(session('error_'.$document->id))
                            {{session('error_'.$document->id)}}
                            @endif
                        </span>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn_{{ $document->id }}">Upload</button>
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
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

            $('.other_doc_add_more').on('click', function(){
                $('#other_document_replace').show();
            });

        });
    </script>
@endsection
