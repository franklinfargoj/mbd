@extends('admin.layouts.app')
@section('content')
        <div class="col-md-12">
            <div class="m-subheader px-0 m-subheader--top">
                <div class="d-flex align-items-center">
                    <h3 class="m-subheader__title m-subheader__title--separator">Document Submitted By Society</h3>
                    <a href="{{ url('/ee') }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
            <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0 m-portlet--table">

                <div class="m-portlet__body m-portlet__body--table">
                    <div class="m-section mb-0">
                        <div class="m-section__content mb-0 table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-default">
                                <tr>
                                    <th width="10%">
                                        #
                                    </th>
                                    <th width="90%">
                                        तपशील
                                    </th>
                                    <th>
                                        दस्तावेज
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($arrData['society_document'] as $document)
                                    <tr>
                                        <td>{{ $i }}.</td>
                                        <td>{{ $document->name }}<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                                        </td>
                                        @php
                                            $path = $arrData['society_document_data'][$document->id]['society_document_path'];

                                        @endphp
                                        <td class="text-center"><a download href="{{ asset($path) }}"><img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a></td>
                                    </tr>

                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection