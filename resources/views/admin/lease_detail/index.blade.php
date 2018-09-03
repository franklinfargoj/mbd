@extends('admin.layouts.app')
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ url('/') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Lease Detail</span>
            </li>
        </ul>
        <div class="page-toolbar">

        </div>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Lease Details
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
                        <i class="fa fa-cogs"></i>Lease Details
                    </div>
                    <div class="tools">
                        @if($count > 0)
                            <a href="{{route('renew-lease.renew', $id)}}" class="yellow">Renew Lease</a>
                        @else
                            <a href="{{route('lease_detail.create', $id)}}" class="yellow">Add Lease</a>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">

                        {{--<div class="portlet-body form">
                            <form role="form" method="get" action="{{ route('hearing.index') }}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="published_from_date" class="col-md-4 control-label">
                                            From Date
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" name="office_date_from" id="office_date_from" class="form-control" value="{{ isset($getData['office_date_from'])? $getData['office_date_from'] : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">
                                            To Date
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" name="office_date_to" id="office_date_to" class="form-control" value="{{ isset($getData['office_date_to'])? $getData['office_date_to'] : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" style="margin-bottom: 15px;">
                                    <input type="submit" value="search" class="btn blue">
                                </div>

                            </form>
                        </div>--}}

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
@endsection

