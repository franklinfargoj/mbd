@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex">
            <h3 class="m-subheader__title">Hearing Listing</h3>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head px-0">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">

                    </h3>
                </div>
            </div>
            <div class="text-right">
                <a class="btn btn-primary" href="{{route('hearing.create')}}">Add Hearing</a>
            </div>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:20px">×</span>
                </button> {{ Session::get('success') }}
            </div>
        @endif
        <div class="m-portlet__body  m-portlet__body--spaced data-table--custom">
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
                                        <input type="text" id="office_date_from" name="office_date_from" class="form-control form-control--custom m-input m_datepicker" placeholder="From Date" value="{{ isset($getData['office_date_from'])? $getData['office_date_from'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label for="office_date_to">To Date</label>
                                        <input type="text" id="office_date_to" name="office_date_to" class="form-control form-control--custom m-input m_datepicker" placeholder="From Date" value="{{ isset($getData['office_date_to'])? $getData['office_date_to'] : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-8" style="margin-top: 15px;">
                                    <div class="form-group m-form__group">
                                        <button type="submit" class="btn btn-primary">Search</button>
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
</div>
@endsection
@section('datatablejs')
{!! $html->scripts() !!}
    <script>
        function deleteHearing(id)
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
                    url:"{{ route('loadDeleteReasonOfHearingUsingAjax') }}",
                    success:function(res)
                    {
                        $("#myModal").html(res);
                        $("#myModalBtn").click();
                    }
                });
            }
        }
    </script>
@endsection

