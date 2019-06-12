@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.co_department.action_noc',compact('noc_application'))
@endsection
@section('css')
<!-- <style> -->
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css" />

<!-- </style> -->
@endsection
@section('content') 

<div class="col-md-12"> 
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Society Documents </h3>
                {{ Breadcrumbs::render('society_noc_documents_co',$noc_application->id) }}
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div>

    <!-- society and Appointed Architect details -->
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body m-portlet__body--table main_panel">
            <table class="table mb-0">
                <thead class="thead-default">
                    <th class="table-data--xs">अ क्र.</th>
                    <th>तपशील</th>
                    <th class="table-data--xs">दस्तावेज</th>
                </thead>
                <tbody>
                    <?php $i=0; ?>
                     @if($societyDocuments)
                    @foreach($societyDocuments as $data)
                    <tr>
                        <td>{{$data->group }}.{{($data->sort_by != 0) ? $data->sort_by : ''}}</td>
                        <td>{{($data->name)}}

                            @if(isset($data->is_optional) && $data->is_optional == 1)
                                <span style="color: green;display:block"><small>(Optional Document)</small></span>
                            @else
                                <span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            @endif

                        </td>
                        <td class="text-center">
                            @if(isset($data->documents_uploaded[0]->society_document_path))
                                @if($data->is_other == 1) 
                                    <a href="{{ route('view_noc_other_document',[encrypt($noc_application->id),encrypt($data->id)]) }}" class="app-card__details mb-0 btn-link" style="font-size: 14px">View</a>

                                @else
                                    <a target="_blank" href="{{ asset($data->documents_uploaded[0]->society_document_path) }}">
                                    <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>
                                @endif
                            @else
                                <h2 class="m--font-danger">
                                    <i class="fa fa-remove"></i>
                                </h2>  
                            @endif      
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($comments) 
<div class="col-md-12">
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0">
        <div class="m-portlet__body m-portlet__body--table">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                <div class="">
                    <h3 class="section-title section-title--small">Society Comments :</h3>
                </div>
                    <div class="remarks-suggestions table--box-input">
                        <div class="mt-3">
                            <label for="society_documents_comment">Additional Information</label>
                            <textarea name="society_documents_comment" rows="5" cols="30" id="society_documents_comment" class="form-control form-control--custom" readonly>{{ $comments->society_documents_comment }}</textarea>
                        </div>
                    </div>
            </div>
        </div>
    </div>  
</div> 
@endif
@endsection
