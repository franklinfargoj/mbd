@extends('admin.layouts.app')
@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ url('/') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>RTI Applicants</span>
            </li>
        </ul>
        <div class="page-toolbar">

        </div>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> RTI Applicants
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
                        <i class="fa fa-cogs"></i>RTI Applicants Listing
                    </div>
                    <div class="tools">
                        <!-- <a href="{{route('hearing.create')}}" class="yellow">Add Hearing</a> -->
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <div class="portlet-body form">
                            <div class="col-md-12">
                    <div class="col-md-6">
                        <form role="form" method="get" action="{{ url('rti_applicants') }}">
                            <div class="form-group">
                                <label for="date_of_submission" class="col-md-4 control-label">
                                    Date of Submission
                                </label>
                                <div class="col-md-8">
                                    <input type="text" name="date_of_submission" id="date_of_submission" class="form-control" value="{{ isset($getData['date_of_submission'])? $getData['date_of_submission'] : '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">
                                    Status
                                </label>
                                <div class="col-md-9">
                                    <select name="status" class="form-control">
                                        <option value="0">  Select Status  </option>
                                      @foreach($rti_statuses as $rti_status)
                                        <option value="{{ $rti_status['id'] }}" 
                                        @if(count($getData) > 0)
                                            {{ ($rti_status['id'] == $getData['status'] ?'selected':'' )}}
                                        @endif>{{ $rti_status['status_title'] }}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom: 15px;">
                                <input type="submit" value="search" class="btn blue">
                            </div>
                        </form>
                    </div>
                </div>
                        </div>

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
    <script>
        $( function() {
            $( "#date_of_submission" ).datepicker({
                dateFormat: "yy-mm-dd"
            });
        } );
    </script>
    {{--<script>
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
    </script>--}}
@endsection

