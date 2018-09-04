@extends('admin.layouts.app')
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="index.html">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>Evaluate Architect Application</span>
    </li>
  </ul>
  <div class="page-toolbar">

  </div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> Evaluate Architect Application
  <small>&nbsp;</small>
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
  <div class="col-md-12">
    @if(Session::has('success'))
    <div class="note note-success">
      <div class="caption">
        <i class="fa fa-gift"></i> {{Session::get('success')}}
      </div>
      <div class="tools pull-right">
        <a href="" class="remove" data-original-title="" title=""> </a>
      </div>
    </div>
    @endif

    <div class="portlet box purple">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Evaluate supporting documents </div>
          <div class="tools1 pull-right">
            
          </div>
        </div>
        <div class="portlet-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover datatable mdl-data-table dataTable">
              <thead>
                <tr>
                  <th>Document Name</th>
                  <th>Document</th>
                  <th>Marks</th>
                  <th>Remark</th>
                </tr>
              </thead>
              <tbody>
                @php $i = 0; @endphp
                @forelse($application as $row)
                @php $i = $i + $row->marks; @endphp
                <tr>
                  <td>{{$row->document_name}}</td>
                  <td>{{$row->document_path}}</td>
                  <td><input type="text" name="marks[]" value="{{$row->marks}}"><input type="hidden" name="id[]" value="{{$row->id}}"></td>
                  <td><textarea name="remark[]">{{$row->remark}}</textarea></td>
                </tr>
                @empty
                <tr>
                  <td colspan="4">No record found</td>
                </tr>
                @endforelse
                <tr>
                  <th>Grand total</th>
                  <th>&nbsp;</th>
                  <th>{{$i}}</th>
                  <th>&nbsp;</th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- END SAMPLE TABLE PORTLET-->
    </div>
</div>

            @endsection
