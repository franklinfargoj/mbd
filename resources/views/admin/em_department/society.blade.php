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
            <h3 class="m-subheader__title m-subheader__title--separator">Society List</h3>
            {{ Breadcrumbs::render('society_list') }}
         </div>

        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        id="layout" name="layout">
                                        <option value="" style="font-weight: normal;">Select Layout</option>
                                        @foreach($layout_data as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->layout_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                          
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
       
        <div class="m-portlet__head px-0">
            <div class="m-portlet__head-caption">
                {{-- <h3 class="m-portlet__head-text">List of societies</h3> --}}
                <div class="m-portlet__head-text">                   

                    <div id="dataTableBuilder_filter" class="dataTables_filter col-md-4 ml-auto pull-left"><input type="search" id="searchId" class="form-control input-lg input-large input-inline form-control--custom"
                    placeholder="Search ..."></div>  

                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            <!--begin: Datatable -->
        <table class="display table table-responsive table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Society Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="myTable">
        <?php $row_no = 1; ?>
        @foreach($societies as $key => $value )
            <tr>    
                 <td>{{$row_no++}}</td>
                <td data-search="{{$value->society_name}}">{{$value->society_name}}</td>
               <td>
                    <div class='d-flex btn-icon-list'>
                        <a href="{{route('get_buildings', [encrypt($value->id)])}}" class='d-flex flex-column align-items-center ' style="padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;"><span class='btn-icon btn-icon--view'><img src="{{asset('/img/view-icon.svg')}}"></span>Building Details</a>
                    
                        <a href="{{route('soc_bill_level', [encrypt($value->id)])}}" class='d-flex flex-column align-items-center' style="padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;"><span class='btn-icon btn-icon--edit'><img src="{{asset('/img/edit-icon.svg')}}"></span>Bill Level</a>
                       
                        <a href="{{route('soc_ward_colony', [encrypt($value->id)])}}" class='d-flex flex-column align-items-center' style="padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;"><span class='btn-icon btn-icon--delete'><img src="{{asset('/img/generate-bill-icon.svg')}}"></span>Ward & colony</a>

                    </div>
                
                    <!-- <a class="btn btn-info" href="{{route('get_buildings', [$value->id])}}">Society Detail</a>
                    <a class="btn btn-info" href="{{route('soc_bill_level', [$value->id])}}" >Bill Level</a>
                    <a class="btn btn-info"  href="{{route('soc_ward_colony', [$value->id])}}">Ward & colony</a> -->

                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Sr. No.</th>
                <th>Society Name</th>
                <th>Action</th>
            </tr>
        </tfoot>
        </table>
            <!--end: Datatable -->
            {!!$societies->render()!!}
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
                    url:"{{URL::route('get_societies')}}",
                    type: 'get',
                    data: {search: value},
                        success: function(response){
                        //console.log(response);
                        $('.m-portlet__body').html(response);
                        //$('#colony').selectpicker('refresh');
                    }
            });                
            }
        });
    });

    $(document).on('change', '#layout', function(){
                var id = $(this).val();
                //console.log(id);
                if(id != ''){
                  $.ajax({
                    url:"{{URL::route('get_societies')}}",
                    type: 'get',
                    data: {id: id},
                        success: function(response){
                        //console.log(response);
                        $('.m-portlet__body').html(response);
                        //$('#colony').selectpicker('refresh');
                    }
                  });    
                }            
    });



</script>
@endsection
