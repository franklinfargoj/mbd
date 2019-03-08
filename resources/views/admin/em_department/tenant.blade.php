@extends('admin.layouts.app')

@section('actions')
@include('admin.em_department.action',compact('ol_application'))
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

@if(session()->has('warning'))
<div class="alert alert-danger display_msg">
    {{ session()->get('warning') }}
</div>
@endif
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center" id="search_box">
            <h3 class="m-subheader__title m-subheader__title--separator">Tenant List </h3>
            {{ Breadcrumbs::render('tenant_list',encrypt($society_id),encrypt($building_id)) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left"
                        style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>

    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        <div class='btn-icon-list'>
            <a href="{{route('add_tenant', [$building_id])}}" class='mhada-btn-pill btn m-btn--pill m-btn--custom btn-primary pull-right'
                style="">Add Tenant</a>
        </div>
        <div class="m-portlet__body">
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
    /*$("#update_status").on("change", function () {
        $("#eeForm").submit();
    });*/

    $(document).ready(function () {
        $(".display_msg").delay(5000).slideUp(300);

        $("#searchId").on("keyup", function () {
            var myLength = $(this).val().length;
            if (myLength >= 0) {

                var value = $(this).val().toLowerCase();
                if (myLength == 0) {
                    value = ' ';
                }
                $.ajax({
                    url: "{{URL::route('get_tenants', [$building_id])}}",
                    type: 'get',
                    data: {
                        search: value
                    },
                    success: function (response) {
                        console.log(response);
                        $('.m-portlet__body').html(response);
                        //$('#colony').selectpicker('refresh');
                    }
                });
            }
        });

    });

</script>
@endsection
