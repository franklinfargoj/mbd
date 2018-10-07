@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Listing</h3>
            {{ Breadcrumbs::render('society_dashboard') }}
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
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
<?php //dd($html->scripts()); ?>
@section('datatablejs')
{!! $html->scripts() !!}
<script>
    /*$( function() {
        $( "#published_from_date, #published_to_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    } );*/

</script>
<script>
    function deleteResolution(id) {
        if (confirm("Are you sure to delete?")) {
            console.log(id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    id: id
                },
                url: "{{ route('loadDeleteReasonOfResolutionUsingAjax') }}",
                success: function (res) {
                    $("#myModal").html(res);
                    $("#myModalBtn").click();
                }
            });
        }
    }

</script>
@endsection
