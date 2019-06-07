@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Payment Details : {{$society_name}}</h3>
{{--                {{ Breadcrumbs::render('lease_detail') }}--}}
                {{--<div class="btn-list text-right ml-auto">--}}
                    {{--<a href="{{route('village_detail.index',['excel'=>'excel'])}}" name="excel" value="excel" class="btn excel-icon"><img src="{{asset('/img/excel-icon.svg')}}"></a>--}}
                    {{--<a target="_blank" href="{{route('village_detail.print')}}" class="btn print-icon"><img src="{{asset('/img/print-icon.svg')}}"></a>--}}
                {{--</div>--}}
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success fade in alert-dismissible show display_msg" style="margin-top:18px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button> {{ Session::get('success') }}
                </div>
            @endif
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--compact m-portlet--mobile">

            <div class="m-portlet__body data-table--custom data-table--icons data-table--actions">
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
<?php //dd($html->scripts()); ?>
@section('datatablejs')
{!! $html->scripts() !!}
<script>
    $(document).ready(function () {
        $(document).on("click", ".dd_details", function () {
            var id = $(this).attr("data-id");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                data:{
                    id:id
                },
                url:"{{ route('loadDDDetailsUsingAjax') }}",
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
