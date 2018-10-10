@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Hearing Listing</h3>
            {{ Breadcrumbs::render('Hearing') }}
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        @if(Session::has('success'))
            <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:20px">×</span>
                </button> {{ Session::get('success') }}
            </div>
        @endif
        <div class="m-portlet__body m-portlet__body--spaced data-table--custom">
            <div class="btn-list text-right mb-4">
                <a href="{{route('hearing.index',['excel'=>'excel'])}}" name="excel" value="excel" class="btn excel-icon"><img src="{{asset('/img/excel-icon.svg')}}"></a>
                <!-- <button type="submit" name="excel" value="excel" class="btn excel-icon"><img src="{{asset('/img/excel-icon.svg')}}"></button> -->
                    <!-- <a target="_blank" href="{{route('hearing.print')}}"
                       class="btn btn-info">Print</a> -->
                <a target="_blank" href="{{route('resolution.print',['published_from_date'=>app('request')->input('published_from_date'),'published_to_date'=>app('request')->input('published_to_date'),'resolution_type_id'=>app('request')->input('resolution_type_id'),'board_id'=>app('request')->input('board_id')])}}"
                class="btn print-icon"><img src="{{asset('/img/print-icon.svg')}}"></a>
            </div>
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-8">
                        <form role="form" id="hearingForm" method="get" action="{{ route('hearing.index') }}">
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
                                        <input type="text" id="office_date_from" name="office_date_from" class="form-control form-control--custom m-input m_datepicker" placeholder="From Date" value="{{ isset($getData['office_date_from'])? $getData['office_date_from'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label for="office_date_to">To Date</label>
                                        <input type="text" id="office_date_to" name="office_date_to" class="form-control form-control--custom m-input m_datepicker" placeholder="To Date" value="{{ isset($getData['office_date_to'])? $getData['office_date_to'] : '' }}">
                                    </div>
                                </div>

                                @php
                                    $status = isset($getData['hearing_status_id'])? $getData['hearing_status_id'] : '';
                                @endphp

                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label for="office_date_to">Status</label>
                                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="hearing_status_id" name="hearing_status_id">
                                            <option value="">All</option>
                                            @foreach(config('commanConfig.hearingStatus') as $key => $hearing_status)
                                                <option value="{{ $hearing_status }}" {{ ($status == $hearing_status) ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', $key)) }}</option>
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
                                <!-- <div class="col-md-6 mt-5">
                                    <div class="btn-list text-right">
                                        <button type="submit" name="excel" value="excel" class="btn excel-icon"><img src="{{asset('/img/excel-icon.svg')}}"></button>
                                        <a target="_blank" href="{{route('resolution.print',['published_from_date'=>app('request')->input('published_from_date'),'published_to_date'=>app('request')->input('published_to_date'),'resolution_type_id'=>app('request')->input('resolution_type_id'),'board_id'=>app('request')->input('board_id')])}}"
                                            class="btn print-icon"><img src="{{asset('/img/print-icon.svg')}}"></a>
                                    </div>
                                </div> -->
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
</div>
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

    <script>
    // $("#hearing_status_id").on("change", function () {
    //     $("#hearingForm").submit();
    // });
    </script>
@endsection

