@extends('admin.layouts.app')
@section('content')
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Hearing Listing</h3>
            </div>
            <div>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content"></div>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">

                    </h3>
                </div>
            </div>
            <a class="btn btn-danger" href="{{route('hearing.create')}}" style="float: right;margin-top: 3%">Add Hearing</a>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:20px">×</span>
                </button> {{ Session::get('success') }}
            </div>
        @endif
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <form role="form" method="get" action="{{ route('hearing.index') }}">
                            <div class="form-group m-form__group row align-items-center">
                                {{--<div class="col-md-4">
                                    <label for="exampleSelect1">Search</label>
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="m_form_search">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                             <span>
                             <i class="la la-search"></i>
                             </span>
                             </span>
                                    </div>
                                </div>--}}
                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label for="office_date_from">From Date</label>
                                        <input type="text" id="office_date_from" name="office_date_from" class="m_datepicker form-control m-input m-input--solid" placeholder="From Date" value="{{ isset($getData['office_date_from'])? $getData['office_date_from'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label for="office_date_to">To Date</label>
                                        <input type="text" id="office_date_to" name="office_date_to" class="form-control m-input m-input--solid m_datepicker" placeholder="To Date" value="{{ isset($getData['office_date_to'])? $getData['office_date_to'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label for="office_date_to">Status</label>
                                        <select class="form-control m-input" id="hearing_status_id" name="hearing_status_id">
                                            <option value="">All</option>
                                            @foreach($hearing_status as $status)
                                                <option value="{{ $status->id }}">{{ $status->status_title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-8" style="margin-top: 15px;">
                                    <div class="form-group m-form__group">
                                        <div class="btn-list">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                            <button type="button" onclick="window.location.href='{{ url("/hearing") }}'" class="btn btn-primary">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
            <!--begin: Datatable -->
        {!! $html->table() !!}
        <!--end: Datatable -->
        </div>
    </div>
    <input type="hidden" id="myModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" />

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">

    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
@endsection
@section('datatablejs')
{!! $html->scripts() !!}
    <script>
        {{--function deleteHearing(id)--}}
        {{--{--}}
            {{--if(confirm("Are you sure to delete?"))--}}
            {{--{--}}
                {{--$.ajax({--}}
                    {{--headers: {--}}
                        {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                    {{--},--}}
                    {{--type:"POST",--}}
                    {{--data:{--}}
                        {{--id:id--}}
                    {{--},--}}
                    {{--url:"{{ route('loadDeleteReasonOfHearingUsingAjax') }}",--}}
                    {{--success:function(res)--}}
                    {{--{--}}
                        {{--$("#myModal").html(res);--}}
                        {{--$("#myModalBtn").click();--}}
                    {{--}--}}
                {{--});--}}
            {{--}--}}
        {{--}--}}

        $(document).ready(function () {
            $(document).on("click", ".delete-hearing", function () {
                var id = $(this).attr("data-id");
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"POST",
                    data:{
                        id:id
                    },
                    url:"{{ route('loadDeleteReasonOfHearingUsingAjax') }}",
                    success:function(res)
                    {
                        $("#myModal").html(res);
                        $("#myModalBtn").click();
                    }
                });
            });
        });
    </script>
@endsection

