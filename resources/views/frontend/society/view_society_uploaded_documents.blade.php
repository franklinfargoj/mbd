@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.actions',compact('ol_applications'))
@endsection
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">View Uploaded Documents </h3>
            {{ Breadcrumbs::render('documents_uploaded') }}
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--bordered-semi mb-0">
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <h3 class="section-title section-title--small">Uploaded Attachments:</h3>
            </div>
        </div>
        <div class="m-portlet__body m-portlet__body--table">
            <div class="m-section mb-0">
                <div class="m-section__content mb-0 table-responsive">
                    <table class="table mb-0">
                        <thead class="thead-default">
                            <tr>
                                <th> # </th>
                                <th> Document Name </th>
                                <th> Status </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @if($documents)
                                @foreach($documents as $document)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            {{ $document->name }}<span class="compulsory-text">
                                            @if(in_array($i, $optional_docs))<small><span style="color: green;">(Optional
                                                    Document)</span></small> @else <small>(Compulsory Document)</small> @endif</span>
                                        </td>
                                        @if(count($document->documents_uploaded) > 0 )
                                            <td class="text-center">
                                                <h2 class="m--font-danger">
                                                    <i class="fa fa-check"></i>
                                                </h2>
                                            </td>
                                            <td> 
                                            @if($document->is_multiple == 1)
                                                <a href="{{ route('upload_multiple_documents',[$society->id,$document->id]) }}" class="app-card__details mb-0">
                                                    click to upload documents</a>
                                            @else 
                                                @foreach($document->documents_uploaded as $doc)
                                                <span>
                                                    <a href="{{ config('commanConfig.storage_server').$doc->society_document_path }}" data-value='{{ $document->id }}' class="btn btn-primary btn-custom" download target="_blank" rel="noopener"> Download</a>
                                                </span>
                                                @endforeach        
                                            @endif        
                                            </td>
                                        @else
                                            <td class="text-center">
                                                <h2 class="m--font-danger">
                                                    <i class="fa fa-remove"></i>
                                                </h2>
                                            </td>
                                            <td></td>
                                        @endif
                                    </tr>
                                @php $i++; @endphp
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if($docs_count == $docs_uploaded_count)
    <div class="m-portlet m-portlet--bordered-semi mb-0">
        <div class="">
            <h3 class="section-title section-title--small">Submit Application:</h3>
        </div>
        <div class="m-portlet__body m-portlet__body--table">
            <div class="remarks-suggestions">
                <div class="mt-3">
                    <label for="society_documents_comment">Additional Information:</label>
                </div>
                <p>{{ ($documents_comment->society_documents_comment != 'N.A.') ?
                    $documents_comment->society_documents_comment : '-' }}</p>
            </div>
        </div>
    </div>
</div>
@endif
@endsection