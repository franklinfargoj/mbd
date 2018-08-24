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
            <form method="get" action="{{ route('resolution.index') }}">
              Title<input type="text" name="title" value="{{ isset($getData['title'])?$getData['title']:'' }}"><br><br>
              Resolution Type
              <select name="resolution_type_id">
                <option value="">Select Resolution Type</option>
                @foreach($resolutionTypes as $resolutionType)
                  <option value="{{ $resolutionType['id'] }}" {{ (isset($getData['resolution_type_id']) && $getData['resolution_type_id']==$resolutionType['id'])?'selected':'' }}>{{ $resolutionType['name'] }}</option>
                @endforeach
              </select>
              <br><br>
              Board
              <select name="board_id">
                <option value="">Select Board</option>
                @foreach($boards as $board)
                  <option value="{{ $board['id'] }}" {{ (isset($getData['board_id']) && $getData['board_id']==$board['id'])?'selected':'' }}>{{ $board['board_name'] }}</option>
                @endforeach
              </select>
              <br><br>
              From Date<input type="text" name="published_from_date"><br><br>
              To Date<input type="text" name="published_to_date">
              <input type="submit" value="search">
            </form>
            {!! $html->table() !!}
          </div>
        </div>
      </div>
      <!-- END SAMPLE TABLE PORTLET-->
    </div>
  </div>
  @endsection

  @section('js')
  {!! $html->scripts() !!}
  @endsection

