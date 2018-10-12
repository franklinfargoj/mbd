@extends('admin.layouts.app')
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Resolution Listing</h3>
            {{ Breadcrumbs::render('resolution') }}
            <div class="ml-auto">
                <div class="btn-list">
                    <!-- <button type="button" class="btn btn-transparent ml-auto" data-toggle="collapse" data-target="#filter">
                        <img class="filter-icon" src="{{asset('/img/filter-icon.svg')}}">Filter
                    </button> -->
                    <button type="submit" name="excel" value="excel" class="btn excel-icon"><img src="{{asset('/img/excel-icon.svg')}}"></button>
<!--                     <a target="_blank" href="{{route('resolution.print',['published_from_date'=>app('request')->input('published_from_date'),'published_to_date'=>app('request')->input('published_to_date'),'resolution_type_id'=>app('request')->input('resolution_type_id'),'board_id'=>app('request')->input('board_id')])}}"
                        class="btn print-icon"><img src="{{asset('/img/print-icon.svg')}}"></a>
                    <a class="btn btn-primary" href="{{route('resolution.create')}}">Add Resolution</a> -->
                </div>
            </div>
        </div>
        <div id="filter" class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <!-- <div class="form-group m-form__group row align-items-center"> -->
                    <form class="row align-items-end mb-0" method="get" action="{{ url('/resolution') }}">
                        <div class="col-md-2">
                            <div class="form-group m-form__group">
                                <input type="text" class="form-control form-control--custom m-input" placeholder="Search..."
                                    id="m_form_search" name="title" value="{{ (!empty($getData) ? $getData['title'] : '') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group m-form__group">
                                <input type="text" class="form-control form-control--custom m-input m_datepicker"
                                    placeholder="From Date" name="published_from_date" value="{{ (!empty($getData) ? $getData['published_from_date'] : '') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group m-form__group">
                                <input type="text" class="form-control form-control--custom m-input m_datepicker"
                                    placeholder="To Date" name="published_to_date" value="{{ (!empty($getData) ? $getData['published_to_date'] : '') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group m-form__group">
                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                    id="exampleSelect1" name="resolution_type_id">
                                    <option value="0">Select Resolution Type</option>
                                    @foreach($resolutionTypes as $resolutionType)
                                    <option
                                        {{ (!empty($getData) ? ($getData['resolution_type_id']==$resolutionType['id']?'selected':'') : '') }}
                                        value="{{ $resolutionType['id'] }}">{{ $resolutionType['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group m-form__group">
                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                    id="exampleSelect1" name="board_id">
                                    <option value="0">Select Board</option>
                                    @foreach($boards as $board)
                                    <option
                                        {{ (!empty($getData) ? ($getData['board_id']==$board['id']?'selected':'') : '') }}
                                        value="{{ $board['id'] }}">{{ $board['board_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group m-form__group">
                                <div class="btn-list">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <button type="reset" class="btn btn-metal">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
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
