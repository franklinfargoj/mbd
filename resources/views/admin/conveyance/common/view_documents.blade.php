@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.conveyance.'.$data->folder.'.action')
@endsection
@section('content')
    <div class="col-md-12">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Society Documents</h3>
               
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
                                        @if($document->sc_document_status != null)
                                            @php $document_uploaded = $document->sc_document_status; @endphp
                                            {{--@foreach($document->sc_document_status as $document_uploaded)--}}
                                            @if($document_uploaded['application_id'] == $data->id)
                                                <span>
                                        <a href="{{ config('commanConfig.storage_server').'/'.$document_uploaded['document_path'] }}" data-value='{{ $document->id }}'
                                           class="upload_documents" target="_blank" rel="noopener" download><button type="submit" class="btn btn-primary btn-custom">
                                                Download</button></a>
                                                    @if($data->scApplicationLog->status_id == 4)
                                                        <a href="{{ route('delete_sc_upload_docs', base64_encode($document->id)) }}" data-value='{{ $document->id }}'
                                                           class="upload_documents"></a>
                                                    @endif
                                    </span>
                                            @endif
                                            {{--@endforeach--}}
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