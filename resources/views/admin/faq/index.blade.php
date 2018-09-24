@extends('admin.layouts.app')
@section('content')
<div class="page-bar">
  <!-- <ul class="page-breadcrumb">
    <li>
      <a href="index.html">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>FAQ</span>
    </li>
  </ul>
  <div class="page-toolbar">

  </div> -->
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<div class="m-subheader px-0 m-subheader--top">
    <div class="d-flex">
            <h3 class="m-subheader__title">FAQs</h3>
        <div>
        </div>
    </div>
</div>
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
          <i class="fa fa-cogs"></i>FAQ Listing </div>
          <div class="btn-list text-right mb-4">
                <a href="{{route('faq.index',['excel'=>'excel'])}}" name="excel" value="excel" class="btn btn-info">Excel</button>
                <a target="_blank" href="{{route('faq.print_data')}}"
                    class="btn btn-info">Print</a>
            </div>
          <div class="tools1 pull-right">
            <a href="{{route('faq.create')}}" role="button" style="margin-top: 5px;" class="btn btn-default">Add FAQ </a>
          </div>
        </div> 
        <div class="portlet-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover datatable mdl-data-table dataTable">
              <thead>
                <tr>
                  <th>Question</th>
                  <th>Answer</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($faqs as $row)
                <tr>
                  <td>{{$row->question}}</td>
                  <td>{{$row->answer}}</td>
                  <td>
                    <a title="Edit" href="{{ route('faq.edit', $row->id) }}">Edit</a>
                    &nbsp;
                    <a title="Edit" href="{{ url('faq/change_status/'. $row->id) }}">{{($row->status==0)? 'Inactive' : 'Active'}}</a>
                  </td>
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
