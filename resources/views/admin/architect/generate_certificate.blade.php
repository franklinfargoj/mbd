@extends('admin.layouts.app')
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="index.html">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>Issue certificated to selected candidate</span>
    </li>
  </ul>
  <div class="page-toolbar">

  </div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> Issue certificated to selected candidate
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
          <i class="fa fa-cogs"></i>Generate Certificate </div>
          <div class="tools1 pull-right">
          </div>
        </div>
        <div class="portlet-body">
          <div class="table-responsive">
            <h3>To generate draft certificate click on 'Generate' button</h3>
            <a href="{{url('finalCertificateGenerate/'.$encryptedId)}}" class="btn btn-danger" role="button">Generate</a>
          </div>
        </div>
      </div>
      <!-- END SAMPLE TABLE PORTLET-->
    </div>
</div>

@endsection
