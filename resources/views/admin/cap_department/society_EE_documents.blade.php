@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.cap_department.action',compact('ol_application'))
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
                            <a href="{{ config('commanConfig.storage_server').'/'.$data->EE_document_path }}">
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
@endsection
