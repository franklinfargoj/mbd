@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Architect Applications</h3>
        </div>
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
    <!-- END: Subheader -->
    {{-- <div class="m-portlet m-portlet--compact filter-wrap">
        <div class="row align-items-center row--filter">
            <div class="col-md-12">
                <!-- <div class="form-group m-form__group row align-items-center"> -->
                <form class="form-group m-form__group row align-items-end" method="get" action="">
    
                </form>

                <!-- </div> -->
            </div>
        </div>
    </div> --}}
    <div class="m-portlet data-table--custom data-table--icons data-table--actions">
                {!! $html->table() !!}
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

@endsection