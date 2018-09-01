@extends('admin.layouts.app')
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/village_detail')}}">{{$header_data['menu']}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Add {{$header_data['menu']}}
            </li>
        </ul>
        <div class="page-toolbar">
        </div>
    </div>
    <!-- END PAGE BAR -->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('success'))
                <div class="note note-success">
                    <p> {{ Session::get('success') }} </p>
                </div>
            @endif

            <div class="portlet box purple">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i> Add {{$header_data['menu']}} </div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body form" style="display: block;">
                    <form id="addVillageDetail" role="form" method="post" class="form-horizontal" action="{{route('village_detail.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="board_id">Board</label>
                                <div class="col-md-3">
                                    <select class="form-control" id="board_id" name="board_id">
                                        @foreach($arrData['board'] as $board_details)
                                            <option value="{{ $board_details->id  }}">{{ $board_details->board_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">{{$errors->first('board_id')}}</span>
                                </div>

                                <label class="col-md-3  control-label" for="sr_no">Sr. No</label>
                                <div class="col-md-3">
                                    <input type="text" id="sr_no" name="sr_no" class="form-control validate"  value="{{ old('sr_no') }}"  />
                                    <span class="help-block">{{$errors->first('sr_no')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="village_name">Village Name</label>
                                <div class="col-md-3">
                                    <input type="text" id="village_name" name="village_name" class="form-control"  value="{{ old('village_name') }}"  />
                                    <span class="help-block">{{$errors->first('village_name')}}</span>
                                </div>

                                <label class="col-md-3 control-label" for="land_source_id">Land Source</label>
                                <div class="col-md-3">
                                    <select class="form-control" id="land_source_id" name="land_source_id">
                                        @foreach($arrData['land_source'] as $landDetails)
                                            <option value="{{ $landDetails->id  }}">{{ $landDetails->source_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">{{$errors->first('land_source_id')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="land_address">Land Address</label>
                                <div class="col-md-3">
                                    <input type="text" id="land_address" name="land_address" class="form-control"  value="{{ old('land_address') }}"  />
                                    <span class="help-block">{{$errors->first('land_address')}}</span>
                                </div>

                                <label class="col-md-3  control-label" for="district">District</label>
                                <div class="col-md-3">
                                    <input type="text" id="district" name="district" class="form-control"  value="{{ old('district') }}"  />
                                    <span class="help-block">{{$errors->first('district')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="taluka">Taluka</label>
                                <div class="col-md-3">
                                    <input type="text" id="taluka" name="taluka" class="form-control"  value="{{ old('taluka') }}"  />
                                    <span class="help-block">{{$errors->first('taluka')}}</span>
                                </div>

                                <label class="col-md-3 control-label" for="total_area">Total Area</label>
                                <div class="col-md-3">
                                    <input type="text" id="total_area" name="total_area" class="form-control"  value="{{ old('total_area') }}"  />
                                    <span class="help-block">{{$errors->first('total_area')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="possession_date">Possession Date</label>
                                <div class="col-md-3">
                                    <input type="text" id="possession_date" name="possession_date" class="form-control"  value="{{ old('possession_date') }}"  />
                                    <span class="help-block">{{$errors->first('possession_date')}}</span>
                                </div>

                                <label class="col-md-3 control-label" for="remark">Remark</label>
                                <div class="col-md-3">
                                    <textarea id="remark" name="remark" class="form-control">{{ old('remark') }}</textarea>
                                    <span class="help-block">{{$errors->first('remark')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="extract">7/12 Extract</label>
                                <div class="col-md-3">
                                    <input type="file" id="extract" name="extract" class="form-control file-upload">
                                    <span class="help-block">{{$errors->first('extract')}}</span>
                                </div>

                                <label class="col-md-3 control-label">Is 7/12 on MHADA's Name</label>
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" name="mhada_name"  value="1"> Yes
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="mhada_name" value="0" checked=""> No
                                        <span></span>
                                    </label>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="property_card">Property Card</label>
                                <div class="col-md-3">
                                    <input type="text" id="property_card" name="property_card" class="form-control"  value="{{ old('property_card') }}"  />
                                    <span class="help-block">{{$errors->first('property_card')}}</span>
                                </div>

                                <label class="col-md-3 control-label">Is Property card (PR card) is on MHADA’s name</label>
                                <div class="mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" name="property_card_mhada_name"  value="1"> Yes
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="property_card_mhada_name" value="0" checked=""> No
                                        <span></span>
                                    </label>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="land_cost">Land Cost</label>
                                <div class="col-md-3">
                                    <input type="text" id="land_cost" name="land_cost" class="form-control"  value="{{ old('land_cost') }}"  />
                                    <span class="help-block">{{$errors->first('land_cost')}}</span>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-8">
                                    <a href="{{url('/village_detail')}}" role="button" class="btn default">Cancel</a>
                                    <input type="submit" class="btn blue" value="Save"></input>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $( function() {
            $( "#possession_date" ).datepicker({
                dateFormat: "yy-mm-dd"
            });
        } );
    </script>
@endsection
