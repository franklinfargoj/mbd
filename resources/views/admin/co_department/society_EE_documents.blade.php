@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.co_department.action',compact('ol_application'))
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
                Society & EE Documents </h3>
                {{ Breadcrumbs::render('society_EE_documents_co',$ol_application->id) }}
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
                    <th class="table-data--xs">सोसायटी दस्तावेज</th>
                    <th class="table-data--xs">EE दस्तावेज</th>
                    <th class="table-data--lg">टिप्पणी</th>
                </thead>
                <tbody>
                    <?php $i=0; ?>
                    @foreach($societyDocuments[0]->societyDocuments as $data)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{($data->documents_Name[0]->name)}}</td>
                        <td class="text-center"><a href="{{ asset($data->society_document_path) }}">
                                <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a></td>
                        <td class="text-center">
                            @if(isset($data->EE_document_path))
                            <a href="{{config('commanConfig.storage_server').'/'.$data->EE_document_path}}">
                                <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a>
                            @endif
                        </td>
                        <td>
                            <p class="mb-2">{{($data->comment_by_EE)}}</p>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($societyDocuments[0]->documentComments) 
<div class="col-md-12">
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0">
        <div class="m-portlet__body m-portlet__body--table">
            <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                <div class="">
                    <h3 class="section-title section-title--small">Society Comments :</h3>
                </div>
                <form action="{{ route('add_documents_comment') }}" method="post" enctype='multipart/form-data'>
                    @csrf
                    <div class="remarks-suggestions table--box-input">
                        <div class="mt-3">
                            <label for="society_documents_comment">Additional Information:</label>
                            <div class="@if($errors->has('society_documents_comment')) has-error @endif">
                                <textarea name="society_documents_comment" rows="5" cols="30" id="society_documents_comment" class="form-control form-control--custom" readonly>{{ $societyDocuments[0]->documentComments->society_documents_comment }}</textarea>
                                <span class="help-block">{{$errors->first('society_documents_comment')}}</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>  
</div> 
@endif
@endsection
