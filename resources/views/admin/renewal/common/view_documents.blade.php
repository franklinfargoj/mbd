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
                                <th>#</th>
                                <th>Document Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i=1; @endphp
                            @if($documents)
                            @endif
                            @foreach($documents as $document)
                                <tr>
                                    <td>{{ $i }}</td>                                    
                                    <td>{{ ucwords(str_replace('_', ' ', $document->document_name)) }}
                                        <span class="compulsory-text">(Compulsory Document)</span>
                                    </td>
                                    <td class="text-center">
                                        <h2 class="m--font-danger">
                                            <i class="{{ isset($document->sr_document_status) ? 'fa fa-check' : 
                                            'fa fa-remove' }} "></i>
                                        </h2>
                                    </td>
                                    <td>
                                        @if($document->sr_document_status)
                                            <span>
                                            <a href="{{ config('commanConfig.storage_server').'/'.$document->sr_document_status['document_path'] }}" target="_blank" class="btn btn-primary btn-custom" rel="noopener" download>Download</a>
                                            </span>
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