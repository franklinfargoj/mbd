@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.oc_actions',compact('oc_applications'))
@endsection
@section('css')
    <style type="text/css">
        .heading{
            font-weight: 500;
            font-size: 15px;
        }
    </style>
@endsection
@section('content')
@php
    $floor = ['Ground','Stilt','parking'];
    $i = 1;
@endphp

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">View Uploaded Documents </h3>
            {{ Breadcrumbs::render('oc_documents_upload',encrypt($oc_applications->id)) }}
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
                                <th> Sr. No </th>
                                <th> Document Name </th>
                                <th> Status </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @foreach($documents as $document)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>
                                    {{ $document->name }}
                                    @if($document->is_optional == 0)
                                        @if($document->full_oc_document == 0)
                                            <span class="compulsory-text">
                                            <small>(Compulsory Document)</small></span>
                                        @elseif($document->full_oc_document == 1 && $oc_applications->request_form->is_full_oc == 1)   
                                            <span class="compulsory-text">
                                            <small>(Compulsory Document)</small></span>
                                        @else
                                            <span class="compulsory-text"> <small>
                                            <span style="color: green;">
                                            (Optional Document)</small> </span>    
                                        @endif    
                                    @else
                                    <span class="compulsory-text"> <small>
                                    <span style="color: green;">
                                    (Optional Document)</small> </span>
                                    @endif
                                </td>
                                @if(count($document->ocDocumentsUploaded) > 0 )
                                    <td class="text-center">
                                        <h2 class="m--font-danger">
                                             <i class="fa fa-check"></i>
                                        </h2>
                                    </td>
                                    <td>
                                        <a href="{{ asset($document->ocDocumentsUploaded->society_document_path) }}" data-value='{{ $document->id }}'
                                            class="btn btn-primary btn-custom" download target="_blank" rel="noopener">
                                                Download</a>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
        <!-- constructed building details table -->
    <div class="m-portlet m-portlet--bordered-semi mb-0">
        <div class="m-portlet__body m-portlet__body--table">
            <div class="m-portlet__body m-portlet__body--table">
                <div class="m-section__content mb-0 table-responsive">
                    <span class="heading">Details of newly constructed building</span>
                    <table class="table mb-0">
                        <thead class="thead-default">
                            <tr>
                                <th> Name </th>
                                <th> Values </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Floors <span class="star">*</span></td>
                                <td>
                                    <div class="row col-md-12">
                                        <div class="col-md-6">
                                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="floor" name="floor" disabled>
                                            @if(isset($floor))
                                                @foreach($floor as $value)
                                                    @if(isset($conDetails) && $value == $conDetails->floor)
                                                        <option value="{{ $value }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $value }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach    
                                            @endif
                                            </select>
                                        </div>    
                                        <div class="col-md-6">
                                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="floor_no" name="floor_no" data-live-search="true" disabled>
                                            @for($i=1;$i<=100;$i++)
                                                @if(isset($conDetails) && $i == $conDetails->floor_no)
                                                    <option value="{{$i}}" selected>{{ $i }}</option>
                                                @else
                                                    <option value="{{$i}}">{{ $i }}</option>
                                                @endif
                                            @endfor    
                                            </select>
                                        </div>
                                    </div>        
                                </td>
                            </tr>
                            <tr>
                                <td>No of rehab tenements <span class="star">*</span></td>
                                <td>
                                    <input type="text" id="rehab_tenements" name="rehab_tenements" class="form-control form-control--custom m-input" value="{{ isset($conDetails) ? $conDetails->rehab_tenements : '' }}" readonly>  
                                </td>
                            </tr>
                            <tr>
                                <td>No of sale tenements <span class="star">*</span></td>
                                <td>
                                    <input type="text" id="sale_tenements" name="sale_tenements" class="form-control form-control--custom m-input" value="{{ isset($conDetails) ? $conDetails->sale_tenements : '' }}" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>No of MHADA tenements <span class="star">*</span></td>
                                <td>
                                   <input type="text" id="mhada_tenements" name="mhada_tenements" class="form-control form-control--custom m-input" value="{{ isset($conDetails) ? $conDetails->mhada_tenements : '' }}"  readonly> 
                                </td>
                            </tr>
                            <tr>
                                <td>Total No of constructed tenements <span class="star">*</span></td>
                                <td>
                                   <input type="text" id="constructed_tenements" name="constructed_tenements" class="form-control form-control--custom m-input" value="{{ isset($conDetails) ? $conDetails->constructed_tenements : '' }}" readonly> 
                                </td>
                            </tr>
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
                <p>
                    @if(isset($documents_comment->society_documents_comment) && ($documents_comment->society_documents_comment != 'N.A.'))
                       {{ $documents_comment->society_documents_comment }}
                      @else
                        {{ '-' }}
                        @endif
                  </p>
            </div>
        </div>
    </div>
</div>
@endif
@endsection