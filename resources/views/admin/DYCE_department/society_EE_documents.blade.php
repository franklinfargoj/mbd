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
    <table class="table table-striped">
    <thead>
      <tr>
        <th>अ क्र.</th>
        <th>तपशील</th>
        <th>सोसायटी दस्तावेज</th>
        <th>EE दस्तावेज</th>
        <th>टिप्पणी</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td><i class="fa fa-file-text" style="font-size:30px;color:#d21111"></td>
        <td><i class="fa fa-file-text" style="font-size:30px;color:#d21111"></td>
        <td>john@example.com</td>
      </tr>
    </tbody>
  </table>
    </div>
</div> 
@endsection   