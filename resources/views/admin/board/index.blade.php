@extends('admin.layouts.app')
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="index.html">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>Boards</span>
    </li>
  </ul>
  <div class="page-toolbar">

  </div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> Boards
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

    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet box purple">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Board Listing </div>
          <div class="tools">
            <a href="{{route('board.create')}}" class="yellow">Add Board </a>
          </div>
        </div>
        <div class="portlet-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover datatable mdl-data-table dataTable">
              <thead>
                <tr>
                  <th>Board Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($boards as $row)
                <tr>
                  <td>{{$row->board_name}}</td>
                  <td><a title="Edit" href="{{ url('board/change_status/'. $row->id) }}">{{($row->status==0)? 'Inactive' : 'Active'}}</a></td>
                  <td><a title="Edit" href="{{ route('board.edit', $row->id) }}"><i class="icon-pencil"></i>Edit</a></td>
                </tr>
                @empty
                <tr>
                  <td colspan="3">No record found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- END SAMPLE TABLE PORTLET-->
    </div>
  </div>
  @endsection

