@extends('admin.layouts.app')
@section('content')
<!-- BEGIN: Subheader -->
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">RTI Applicants Listing </h3>
            {{ Breadcrumbs::render('rti_applicants') }}
            <!-- <button type="button" class="btn btn-transparent ml-auto" data-toggle="collapse" data-target="#filter">
                <img class="filter-icon" src="{{asset('/img/filter-icon.svg')}}">Filter
            </button> -->
        </div>
        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <form class="form-group m-form__group row align-items-center mb-0" method="get" action="{{ url('rti_applicants') }}">
                        <div class="col-md-2">
                            <div class="form-group m-form__group">
                                <input type="text" name="date_of_submission" id="date_of_submission" class="form-control form-control--custom m-input m_datepicker"
                                    value="{{ isset($getData['date_of_submission'])? $getData['date_of_submission'] : '' }}"
                                    placeholder="Date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group m-form__group">
                                <select name="status" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input">
                                    <option value="0">Select Status</option>
                                    @foreach($rti_statuses as $rti_status)
                                    <option value="{{ $rti_status['id'] }}" @if(count($getData)> 0)
                                        {{ ($rti_status['id'] == $getData['status'] ?'selected':'' )}}
                                        @endif>{{ $rti_status['status_title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group m-form__group">
                                <div class="btn-list">
                                    <button type="submit" class="btn m-btn--pill m-btn--custom btn-primary">Search</button>
                                    <button type="reset" class="btn m-btn--pill m-btn--custom btn-metal">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right">
                <!-- <div class="form-group m-form__group row align-items-center"> -->

                <!-- </div> -->
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
</div>
<!-- END EXAMPLE TABLE PORTLET-->
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
