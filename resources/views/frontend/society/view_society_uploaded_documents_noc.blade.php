@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.actions_noc',compact('noc_applications'))
@endsection
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">View Uploaded Documents </h3>
            {{ Breadcrumbs::render('noc_documents_upload',encrypt($noc_applications->id)) }}
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
                                <th>
                                    Sr.No
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
                                <td>{{$document->group }}.{{($document->sort_by != 0) ? $document->sort_by : ''}}</td>
                                <td>
                                    {{ $document->name }}
                                    @if($document->is_optional == 0)
                                        <span class="compulsory-text">
                                        <small>(Compulsory Document)</small></span>
                                        
                                        @else
                                        <span class="compulsory-text"> <small>
                                        <span style="color: green;">
                                        (Optional Document)</small> </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <h2 class="m--font-danger">
                                        @if(count($document->documents_uploaded) > 0 )
                                        @foreach($document->documents_uploaded as $document_uploaded)
                                        @if($document_uploaded['society_id'] == $society->id)
                                        <i class="fa fa-check"></i>
                                        @else
                                        <i class="fa fa-remove"></i>
                                        @endif
                                        @endforeach
                                        @else
                                        <i class="fa fa-remove"></i>
                                        @endif
                                    </h2>
                                </td>
                                <td>
                                    @if(count($document->documents_uploaded) > 0 )
                                    @foreach($document->documents_uploaded as $document_uploaded)
                                    @if($document_uploaded['society_id'] == $society->id)
                                    <span>
                                        <a href="{{ asset($document_uploaded['society_document_path']) }}" data-value='{{ $document->id }}'
                                            class="btn btn-primary btn-custom" download target="_blank" rel="noopener">
                                                Download</a>
                                    </span>
                                    @endif
                                    @endforeach
                                    @else

                                    @endif
                                </td>
                            </tr>
                            @endforeach
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