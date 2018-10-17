@extends('admin.layouts.app')
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif
@php $route_name = Route::currentRouteName(); @endphp
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Requests For revising layout</h3>
            @if(session()->get('role_name')=='junior_architect')
            <a href="{{route('architect_layout.add')}}" class="btn btn-primary ml-auto">Add Layout</a>
            @endif
        </div>
        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <form role="form" id="eeForm" method="get" action="{{ route($route_name) }}">
                        <div class="row align-items-center mb-0">
                            <div class="col-md-2">
                                <div class="form-group m-form__group">
                                    <input type="text" id="submitted_at_from" name="submitted_at_from" class="form-control form-control--custom m-input m_datepicker"
                                        placeholder="From Date" value="{{ isset($getData['submitted_at_from'])? $getData['submitted_at_from'] : '' }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group m-form__group">
                                    <input type="text" id="submitted_at_to" name="submitted_at_to" class="form-control form-control--custom m-input m_datepicker"
                                        placeholder="To Date" value="{{ isset($getData['submitted_at_to'])? $getData['submitted_at_to'] : '' }}">
                                </div>
                            </div>

                            @php
                            $status = isset($getData['update_status'])? $getData['update_status'] : '';
                            @endphp

                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        id="update_status" name="update_status">
                                        <option value="" style="font-weight: normal;">Select Status</option>
                                        @foreach(config('commanConfig.applicationStatus') as $key =>
                                        $application_status)
                                        <option value="{{ $application_status }}"
                                            {{ ($status == $application_status) ? 'selected' : '' }}>{{
                                            ucwords(str_replace('_', ' ', $key)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group m-form__group">
                                    <div class="btn-list">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <button type="reset" onclick="window.location.href='{{ url("/ee") }}'" class="btn btn-metal">Reset</button>
                                    </div>
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav">
                <li class="nav-item {{$route_name=='architect_layout.index'?'active':''}}">
                    <a class="nav-link" href="{{route('architect_layout.index')}}">Requests Revision</a>
                </li>
                <li class="nav-item {{$route_name=='architect_layouts_layout_details.index'?'active':''}}">
                    <a class="nav-link" href="{{route('architect_layouts_layout_details.index')}}">Layout Details</a>
                </li>
            </ul>
        </nav>
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
    });

</script>
@endsection
