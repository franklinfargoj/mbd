@extends('admin.layouts.app')
@section('css')
<!-- <style> -->
<link href="{{asset('/frontend/css/dyce_scrutiny.css')}}" rel="stylesheet" type="text/css"/>

<!-- </style> -->
@endsection
@section('content')

<!-- BEGIN: Subheader -->
<div class="m-subheader ">
  <div class="d-flex align-items-center">
     <div class="mr-auto">
        <h3 class="m-subheader__title m-subheader__title--separator title">
        DyCE Scrutiny & Remark </h3>
     </div>
  </div>
</div>
<div class="m-content"></div>

<!-- society and Appointed Architect details -->
 <div class="m-portlet m-portlet--mobile m_panel">
    <div class="m-portlet__body main_panel">
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
              <td class="text-center"><a href="{{ asset($data->EE_document_path) }}">
              <img class="pdf-icon" src="{{ asset('/img/pdf-icon.svg')}}"></a></td>
              <td><p class="mb-2">{{($data->comment_by_EE)}}</p></td>
            </tr>
            <?php $i++; ?>
          @endforeach
        </tbody>
      </table>
    </div>
</div> 
@endsection   