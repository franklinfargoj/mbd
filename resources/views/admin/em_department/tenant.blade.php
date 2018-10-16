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

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center" id="search_box">
            <h3 class="m-subheader__title m-subheader__title--separator">Society Details | Building | Tenant </h3>
            {{ Breadcrumbs::render('em') }}
         </div>

    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-text">
                    <h3 class="m-portlet__head-text"> List of tenants</h3>
                    <div id="filter" class="ml-auto"><input type="search" id="searchId" class="form-control input-sm input-small input-inline form-control--custom"
                    placeholder="Search ..."></div>     
                </div>
            </div>
            <a class="btn btn-danger" href="#" style="float: right;margin-top: 3%">Add
                Tenant</a>
            </div>
        <div class="m-portlet__body">
            <!--begin: Datatable -->
        <table id="example" class="display table table-responsive table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Flat No.</th>
                <th>Saluation</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Use</th>
                <th>Carpet Area</th>
                <th>Tenant Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($buildings as $key => $value )
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->flat_no}}</td>
                <td>{{$value->saluation}}</td>
                <td>{{$value->first_name}}</td>
                <td>{{$value->middle_name}}</td>
                <td>{{$value->last_name}}</td>
                <td>{{$value->use}}</td>
                <td>{{$value->carpet_area}}</td>
                <td>{{$value->tenant_type}}</td>
                <td>
                    <a class="btn btn-info" href="{{route('get_tenants', [$value->id])}}">Edit</a>
                    <a class="btn btn-danger" href="">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Sr. No.</th>
                <th>Flat No.</th>
                <th>Saluation</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Use</th>
                <th>Carpet Area</th>
                <th>Tenant Type</th>
                <th>Action</th>
            </tr>
        </tfoot>
        </table>

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


<script>
    /*$("#update_status").on("change", function () {
        $("#eeForm").submit();
    });*/

    $(document).ready(function () {
        $(".display_msg").delay(5000).slideUp(300);
    });

</script>
@endsection
