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
            <h3 class="m-subheader__title m-subheader__title--separator">List of Buildings</h3>
            {{ Breadcrumbs::render('building_list',encrypt($society_id)) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
         </div>
         <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <form role="form" id="eeForm" method="get" action="{{route('get_buildings',[encrypt($society_id)])}}">
                        <div class="row align-items-center mb-0">
                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <input type="text" id="building_no" name="building_no" class="form-control form-control--custom m-input"
                                        placeholder="Building Number" value="{{$building_no}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group m-form__group">
                                    <input type="text" id="building_name" name="building_name" class="form-control form-control--custom m-input" placeholder="Building Name" value="{{$building_name}}">
                                </div>
                            </div>
                            @php
                            // $status = isset($getData['update_status'])? $getData['update_status'] : '';
                            @endphp

                            <div class="col">
                                <div class="form-group m-form__group">
                                    <div class="btn-list">
                                        <button type="submit" class="btn m-btn--pill m-btn--custom btn-primary">Search</button>
                                        <button type="reset" onclick="window.location.href='{{ route("get_buildings",[$society_id]) }}'"
                                            class="btn m-btn--pill m-btn--custom btn-metal">Reset</button>
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
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-text">
                    {{-- <h3 class="m-portlet__head-text"> List of buildings </h3> --}}
                    <div id="dataTableBuilder_filter" class="col-md-4 ml-auto pull-left"><input type="search" id="searchId" class="form-control input-sm input-small input-inline form-control--custom"
                    placeholder="Search ..."></div>    
                </div>
            </div>

            <div class='btn-icon-list'>
                <a href="{{route('add_building', [$society_id])}}" class='btn m-btn--pill m-btn--custom btn-primary pull-right' style="">Add Building</a>
            </div>
 
           </div>
        <div class="m-portlet__body">
            <!--begin: Datatable -->
        <table id="example" class="display table table-responsive table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Building / Chawl Number</th>
                <th>Building / Chawl Name</th>
                <th>Number of Tenant</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="myTable">
        <?php $row_no = 1; ?>
        @foreach($buildings as $key => $value )
            <tr>
                <td>{{$row_no++}}</td>
                <td>{{$value->building_no}}</td>
                <td>{{$value->name}}</td>
                <td><?php echo isset($value->tenant_count[0]->count) ? $value->tenant_count[0]->count : '0'; ?></td>
                <td>
                    <div class='d-flex btn-icon-list'>
                        <a href="{{route('get_tenants', [encrypt($value->id)])}}" class='d-flex flex-column align-items-center ' style="padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;" ><span class='btn-icon btn-icon--view'><img src="{{asset('/img/view-icon.svg')}}"></span>Tenant Details</a>
                    
                        <a href="{{route('edit_building', [encrypt($value->id)])}}" class='d-flex flex-column align-items-center' style="padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;"><span class='btn-icon btn-icon--edit'><img src="{{asset('/img/edit-icon.svg')}}"></span>Edit</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Sr. No.</th>
                <th>Building / Chawl Number</th>
                <th>Building / Chawl Name</th>
                <th>Number of Tenant</th>
                <th>Action</th>
            </tr>
        </tfoot>
        </table>
        {!! $buildings->render() !!}
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

        $("#searchId").on("keyup", function() {
            var myLength = $(this).val().length;
            if(myLength >= 0){

            var value = $(this).val().toLowerCase();
            if(myLength == 0) {
                value = ' ';
            }
            $.ajax({
                    url:"{{URL::route('get_buildings', [$society_id])}}",
                    type: 'get',
                    data: {search: value},
                        success: function(response){
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
