@extends('admin.layouts.app')
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('/lease_detail/'.$id)}}">{{$header_data['menu']}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Renew {{$header_data['menu']}}
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
                        <i class="fa fa-gift"></i> Renew {{$header_data['menu']}} </div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body form" style="display: block;">
                    <form id="renewLeaseDetail" role="form" method="post" class="form-horizontal" action="{{route('renew-lease.update-lease', $id)}}">
                        @csrf

                        <input type="hidden" name="society_id" value="{{ $id }}">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3  control-label" for="lease_rule_other">Lease rule 16 & other</label>
                                <div class="col-md-3">
                                    <input type="text" id="lease_rule_other" name="lease_rule_other" class="form-control validate"  value="{{ old('lease_rule_16_other') }}"  />
                                    <span class="help-block">{{$errors->first('lease_rule_other')}}</span>
                                </div>

                                <label class="col-md-3  control-label" for="lease_basis">School/society/ others on lease basis</label>
                                <div class="col-md-3">
                                    <input type="text" id="lease_basis" name="lease_basis" class="form-control validate"  value="{{ old('lease_basis') }}"  />
                                    <span class="help-block">{{$errors->first('lease_basis')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="taluka">Area</label>
                                <div class="col-md-3">
                                    <input type="text" id="area" name="area" class="form-control"  value="{{ $arrData['lease_data']->area }}"  />
                                    <span class="help-block">{{$errors->first('area')}}</span>
                                </div>

                                <label class="col-md-3 control-label" for="survey_number">Lease Period</label>
                                <div class="col-md-3">
                                    <input type="text" id="lease_period" name="lease_period" class="form-control"  value="{{ old('lease_period') }}"  />
                                    <span class="help-block">{{$errors->first('lease_period')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="cts_number">Start date of lease</label>
                                <div class="col-md-3">
                                    <input type="text" id="lease_start_date" name="lease_start_date" class="form-control"  value="{{ old('lease_start_date') }}"  />
                                    <span class="help-block">{{$errors->first('lease_start_date')}}</span>
                                </div>

                                <label class="col-md-3  control-label" for="lease_rent">Land rent / lease rent</label>
                                <div class="col-md-3">
                                    <input type="text" id="lease_rent" name="lease_rent" class="form-control"  value="{{ old('lease_rent') }}"  />
                                    <span class="help-block">{{$errors->first('lease_rent')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="lease_rent_start_month">Month to start collection of lease rent</label>
                                <div class="col-md-3">
                                    <select class="form-control" id="lease_rent_start_month" name="lease_rent_start_month">
                                        @foreach($arrData['month_data'] as $month)
                                            <option value="{{ $month->id  }}" {{ (date('n') == $month->id) ? "selected" : "" }}>{{ $month->month_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">{{$errors->first('lease_rent_start_month')}}</span>
                                </div>

                                <label class="col-md-3 control-label" for="interest_per_lease_agreement">Interest as per Lease agreement, in %</label>
                                <div class="col-md-3">
                                    <input type="text" id="interest_per_lease_agreement" name="interest_per_lease_agreement" class="form-control"  value="{{ old('interest_per_lease_agreement') }}"  />
                                    <span class="help-block">{{$errors->first('interest_per_lease_agreement')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="lease_renewal_date">Date of Renewal of lease</label>
                                <div class="col-md-3">
                                    <input type="text" id="lease_renewal_date" name="lease_renewal_date" class="form-control"  value="{{ old('lease_renewal_date') }}"  />
                                    <span class="help-block">{{$errors->first('lease_renewal_date')}}</span>
                                </div>

                                <label class="col-md-3 control-label" for="lease_renewed_period">Period of renewed Lease</label>
                                <div class="col-md-3">
                                    <input type="text" id="lease_renewed_period" name="lease_renewed_period" class="form-control"  value="{{ old('lease_renewed_period') }}"  />
                                    <span class="help-block">{{$errors->first('lease_renewed_period')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="rent_per_renewed_lease">Lease rent as per renewed lease</label>
                                <div class="col-md-3">
                                    <input type="text" id="rent_per_renewed_lease" name="rent_per_renewed_lease" class="form-control"  value="{{ old('rent_per_renewed_lease') }}"  />
                                    <span class="help-block">{{$errors->first('rent_per_renewed_lease')}}</span>
                                </div>

                                <label class="col-md-3 control-label" for="interest_per_renewed_lease_agreement">Interest as per renewed Lease agreement, in %</label>
                                <div class="col-md-3">
                                    <input type="text" id="interest_per_renewed_lease_agreement" name="interest_per_renewed_lease_agreement" class="form-control"  value="{{ old('interest_per_renewed_lease_agreement') }}"  />
                                    <span class="help-block">{{$errors->first('interest_per_renewed_lease_agreement')}}</span>
                                </div>

                            </div>

                            <div class="form-group">
                                {{--<label class="col-md-3 control-label" for="rent_per_renewed_lease">Lease rent as per renewed lease</label>
                                <div class="col-md-3">
                                    <input type="text" id="rent_per_renewed_lease" name="rent_per_renewed_lease" class="form-control"  value="{{ $arrData['lease_data']->rent_per_renewed_lease }}"  />
                                    <span class="help-block">{{$errors->first('rent_per_renewed_lease')}}</span>
                                </div>--}}

                                <label class="col-md-3 control-label" for="month_rent_per_renewed_lease">Month to start collection of lease rent as per renewed lease</label>
                                <div class="col-md-3">
                                    <select class="form-control" id="month_rent_per_renewed_lease" name="month_rent_per_renewed_lease">
                                        @foreach($arrData['month_data'] as $month)
                                            <option value="{{ $month->id  }}" {{ (date('n') == $month->id) ? "selected" : "" }}>{{ $month->month_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">{{$errors->first('month_rent_per_renewed_lease')}}</span>
                                </div>

                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-8">
                                    <a href="{{url('/lease_detail/'.$id)}}" role="button" class="btn default">Cancel</a>
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
            $( "#lease_start_date, #lease_renewal_date" ).datepicker({
                dateFormat: "yy-mm-dd"
            });
        } );
    </script>
@endsection