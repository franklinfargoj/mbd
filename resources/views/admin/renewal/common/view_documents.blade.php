@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.renewal.'.$data->folder.'.action')
@endsection
@section('content')
    <div class="col-md-12">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Submitted Documents</h3>
                {{ Breadcrumbs::render('renewal_society_document',$data->id) }}
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
                                                @if($document_uploaded['application_id'] == $data->id)
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
                                            {{--@foreach($document->sc_document_status as $document_uploaded)--}}
                                            @if($document_uploaded['application_id'] == $data->id)
                                                <span>
                                        <a href="{{ config('commanConfig.storage_server').'/'.$document_uploaded['document_path'] }}" data-value='{{ $document->id }}'
                                           class="upload_documents" target="_blank" rel="noopener" download><button type="submit" class="btn btn-primary btn-custom">
                                                Download</button></a>
                                                    @if($data->srApplicationLog->status_id == 4)
                                                        <a href="{{ route('delete_sc_upload_docs', base64_encode($document->id)) }}" data-value='{{ $document->id }}'
                                                           class="upload_documents"></a>
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
    </div>
@endsection