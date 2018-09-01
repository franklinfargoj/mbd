@extends('admin.layouts.app')
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/society_detail/'.$id)}}">{{$header_data['menu']}}</a>
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
                    <form id="addSocietyDetail" role="form" method="post" class="form-horizontal" action="{{route('society_detail.store')}}">
                        @csrf

                        <input type="hidden" name="village_id" value="{{ $id }}">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3  control-label" for="society_name">Society Name</label>
                                <div class="col-md-3">
                                    <input type="text" id="society_name" name="society_name" class="form-control validate"  value="{{ old('society_name') }}"  />
                                    <span class="help-block">{{$errors->first('society_name')}}</span>
                                </div>

                                <label class="col-md-3  control-label" for="district">District</label>
                                <div class="col-md-3">
                                    <input type="text" id="district" name="district" class="form-control validate"  value="{{ old('district') }}"  />
                                    <span class="help-block">{{$errors->first('district')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="taluka">Taluka</label>
                                <div class="col-md-3">
                                    <input type="text" id="taluka" name="taluka" class="form-control"  value="{{ old('taluka') }}"  />
                                    <span class="help-block">{{$errors->first('taluka')}}</span>
                                </div>

                                <label class="col-md-3 control-label" for="survey_number">Survey Number</label>
                                <div class="col-md-3">
                                    <input type="text" id="survey_number" name="survey_number" class="form-control"  value="{{ old('survey_number') }}"  />
                                    <span class="help-block">{{$errors->first('survey_number')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="cts_number">CTS Number</label>
                                <div class="col-md-3">
                                    <input type="text" id="cts_number" name="cts_number" class="form-control"  value="{{ old('cts_number') }}"  />
                                    <span class="help-block">{{$errors->first('cts_number')}}</span>
                                </div>

                                <label class="col-md-3  control-label" for="chairman">Chairman</label>
                                <div class="col-md-3">
                                    <input type="text" id="chairman" name="chairman" class="form-control"  value="{{ old('chairman') }}"  />
                                    <span class="help-block">{{$errors->first('chairman')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="society_address">Society Address</label>
                                <div class="col-md-3">
                                    <textarea id="society_address" name="society_address" class="form-control">{{ old('society_address') }}</textarea>
                                    <span class="help-block">{{$errors->first('society_address')}}</span>
                                </div>

                                <label class="col-md-3 control-label" for="area">Area</label>
                                <div class="col-md-3">
                                    <input type="text" id="area" name="area" class="form-control"  value="{{ old('area') }}"  />
                                    <span class="help-block">{{$errors->first('area')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="date_on_service_tax">Date mentioned on service tax letters</label>
                                <div class="col-md-3">
                                    <input type="text" id="date_on_service_tax" name="date_on_service_tax" class="form-control"  value="{{ old('date_on_service_tax') }}"  />
                                    <span class="help-block">{{$errors->first('date_on_service_tax')}}</span>
                                </div>

                                <label class="col-md-3 control-label" for="surplus_charges">Surplus Charges</label>
                                <div class="col-md-3">
                                    <input type="text" id="surplus_charges" name="surplus_charges" class="form-control"  value="{{ old('surplus_charges') }}"  />
                                    <span class="help-block">{{$errors->first('surplus_charges')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="surplus_charges_last_date">Last date of paying surplus charges</label>
                                <div class="col-md-3">
                                    <input type="text" id="surplus_charges_last_date" name="surplus_charges_last_date" class="form-control"  value="{{ old('surplus_charges_last_date') }}"  />
                                    <span class="help-block">{{$errors->first('surplus_charges_last_date')}}</span>
                                </div>

                                <label class="col-md-3 control-label" for="other_land_id">Others</label>
                                <div class="col-md-3">
                                    <select class="form-control" id="other_land_id" name="other_land_id">
                                        @foreach($arrData['other_land'] as $other_land_details)
                                            <option value="{{ $other_land_details->id  }}">{{ $other_land_details->land_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">{{$errors->first('other_land_id')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-8">
                                    <a href="{{url('/society_detail/'.$id)}}" role="button" class="btn default">Cancel</a>
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
            $( "#date_on_service_tax, #surplus_charges_last_date" ).datepicker({
                dateFormat: "yy-mm-dd"
            });
        } );
    </script>
@endsection