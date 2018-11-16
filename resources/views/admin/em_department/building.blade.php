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
            {{ Breadcrumbs::render('em') }}
         </div>

    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-text">
                    <h3 class="m-portlet__head-text"> List of buildings </h3>
                    <div id="filter" class="ml-auto"><input type="search" id="searchId" class="form-control input-sm input-small input-inline form-control--custom"
                    placeholder="Search ..."></div>    
                </div>
            </div>

            <div class='btn-icon-list'>
                <a href="{{route('add_building', [$society_id])}}" class='d-flex flex-column align-items-center' style="padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px; float: right;margin-top: 3%"><span class='btn-icon btn-icon--edit'><img src="{{asset('/img/add-icon.svg')}}"></span>Add Building</a>
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
                        <a href="{{route('get_tenants', [encrypt($value->id)])}}" class='d-flex flex-column align-items-center ' style="padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;" ><span class='btn-icon btn-icon--view'><img src="{{asset('/img/view-icon.svg')}}"></span>Tenant Detail</a>
                    
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
