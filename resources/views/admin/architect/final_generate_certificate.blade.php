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
    @if(Session::has('error'))
    <div class="note note-error">
      <div class="caption">
        <i class="fa fa-gift"></i> {{Session::get('error')}}
      </div>
      <div class="tools pull-right">
        <a href="" class="remove" data-original-title="" title=""> </a>
      </div>
    </div>
    @endif

    <div class="portlet box purple">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-cogs"></i>Certificate </div>
          <div class="tools1 pull-right">
          </div>
        </div>
        <div class="portlet-body">
          <div class="col-md-12">
          {{-- @if(!$ArchitectApplication->drafted_certificate!="") --}}
            <h3>View Certificate</h3>
            <h5>Want to make changes in Certificate, click on below button to download Certificate in editable format</h5>
            <a href="{{route('architect.edit_certificate',$encryptedId)}}" class="btn btn-danger" role="button">View Certificate</a>
            <!-- <a href="javascript:void(0);" class="btn btn-danger" data-toggle="modal" data-target="#certificateModal" role="button">View Certificate</a> -->
            {{-- @endif--}}
          </div>
          <div class="row">
            <div class="col-md-6">
            @if($ArchitectApplication->drafted_certificate!="")
              <h3>Download Certificate</h3>
              <h5>Click to view generated Certificate in PDF format</h5>
              <a target="_blank" href="{{config('commanConfig.storage_server').'/'.$ArchitectApplication->certificate_path}}" class="btn btn-danger" role="button">Download Certificate</a>

            @endif
            </div>
            <div class="col-md-6">
              <h3>Upload Certificate</h3>
              <h5>Click on 'Upload' to upload certificate in</h5>
              <form class="form-control" action="{{route('architect.post_final_signed_certificate')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="certificate" accept="application/*" required>
                <input type="hidden" name="ap_no" value="{{$encryptedId}}">
                <input type="submit" value="Submit"  class="btn btn-danger">
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- END SAMPLE TABLE PORTLET-->
    </div>
</div>

<div id="certificateModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Certificate</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Content</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection
