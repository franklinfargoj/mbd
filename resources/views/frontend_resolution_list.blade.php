@extends('admin.layouts.app')
@section('content')

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
              <input type="date" name="published_from_date" id="published_from_date" class="form-control">
            </div>
              </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-md-4 control-label">
                To Date
              </label>
              <div class="col-md-8">
                <input type="text" name="published_to_date" class="form-control">
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
  @endsection

  @section('js')
  {!! $html->scripts() !!}
  @endsection

