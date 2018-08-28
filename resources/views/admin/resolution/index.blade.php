@extends('admin.layouts.app')
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="index.html">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>Resolutions</span>
    </li>
  </ul>
  <div class="page-toolbar">

  </div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> Resolutions
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
          <i class="fa fa-cogs"></i>Resolution Listing 
        </div>
        <div class="tools">
          <a href="{{route('resolution.create')}}" class="yellow">Add Resolution </a>
        </div>
        </div>
        <div class="portlet-body">
          <div class="table-responsive">
            
              <div class="portlet-body form">
                  <form role="form" method="get" action="{{ route('resolution.index') }}">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-md-4 control-label">
                Resolution Type
              </label>
              <div class="col-md-8">
                <select name="resolution_type_id" class="form-control">
                  <option value="">Select Resolution Type</option>
                  @foreach($resolutionTypes as $resolutionType)
                    <option value="{{ $resolutionType['id'] }}" {{ (isset($getData['resolution_type_id']) && $getData['resolution_type_id']==$resolutionType['id'])?'selected':'' }}>{{ $resolutionType['name'] }}</option>
                  @endforeach
                </select>
              </div>
              </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-md-4 control-label">
                Board
              </label>
              <div class="col-md-8">
                <select name="board_id" class="form-control">
                  <option value="">Select Board</option>
                  @foreach($boards as $board)
                    <option value="{{ $board['id'] }}" {{ (isset($getData['board_id']) && $getData['board_id']==$board['id'])?'selected':'' }}>{{ $board['board_name'] }}</option>
                  @endforeach
                </select>
              </div>
                </div>
              </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="published_from_date" class="col-md-4 control-label">
                From Date
              </label>
              <div class="col-md-8">
              <input type="date" name="published_from_date" id="published_from_date" class="form-control" value="{{ isset($getData['published_from_date'])? $getData['published_from_date'] : '' }}">
            </div>
              </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-md-4 control-label">
                To Date
              </label>
              <div class="col-md-8">
                <input type="date" name="published_to_date" id="published_to_date" class="form-control" value="{{ isset($getData['published_to_date'])? $getData['published_to_date'] : '' }}">
              </div>
              </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-md-4 control-label">
                  Title
                </label>
                <div class="col-md-8">
                <input type="text" name="title" value="{{ isset($getData['title'])?$getData['title']:'' }}" class="form-control">
              </div>
                </div>
                </div>

                <div class="col-md-6">
                <input type="submit" value="search" class="btn blue">
                </div>
                
              </form>
              </div>
            
            {!! $html->table() !!}
          </div>
        </div>
      </div>
      <!-- END SAMPLE TABLE PORTLET-->
    </div>
  </div>

  <input type="hidden" id="myModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" />

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  
</div>
  @endsection

  @section('js')
  {!! $html->scripts() !!}
  <script>
    function deleteResolution(id)
    {
      if(confirm("Are you sure to delete?"))
      {
        $.ajax({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            data:{
              id:id
            },
            url:"{{ route('loadDeleteReasonOfResolutionUsingAjax') }}",
            success:function(res)
            {
              $("#myModal").html(res);
              $("#myModalBtn").click();
            }
        });
      }
    }
  </script>
  @endsection

