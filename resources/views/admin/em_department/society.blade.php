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
                            <div class="col-md-12">
                                <div class="form-group m-form__group">
                                    <form action="{{route('get_societies')}}" method="get">
                                        <div class="row">    
                                            <div class="col-md-4">

                                                <label for="layout">Select Layout</label>

                                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                                    id="layout" name="layout">
                                                    <option value="" style="font-weight: normal;">Select Layout</option>
                                                    @foreach($layout_data as $key => $value)
                                                        @if(isset($layout_id) && $layout_id == $value->id)
                                                              <option value="{{ encrypt($value->id) }}" selected>{{ $value->layout_name }}</option>
                                                        @else
                                                        <option value="{{ encrypt($value->id) }}">{{ $value->layout_name }}</option>
                                                        @endif 
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-1 mt-4">
                                                <input type="submit" value="Search" class="mt-1 submit-button btn m-btn--pill m-btn--custom btn-primary mhada-btn-pill">
                                            </div>

                                            <div class="col-md-1 mt-4">
                                                <a href="{{ url('get_societies') }}" class="mt-1 btn m-btn--pill m-btn--custom btn-primary mhada-btn-pill">Reset</a>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>                          
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
       
        {{-- <div class="m-portlet__head px-0">
            <div class="m-portlet__head-caption">
                <h3 class="m-portlet__head-text">List of societies</h3>
            </div>
        </div> --}}

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

    //     $("#searchId").on("keyup", function() {
    //         var myLength = $(this).val().length;
    //         if(myLength >= 0){
    //         var value = $(this).val().toLowerCase();
    //         if(myLength == 0) {
    //             value = ' ';
    //         }
    //         $.ajax({
    //                 url:"{{URL::route('get_societies')}}",
    //                 type: 'get',
    //                 data: {search: value},
    //                     success: function(response){
    //                     //console.log(response);
    //                     // $('.m-portlet__body').html(response);
    //                     //$('#colony').selectpicker('refresh');
    //                 }
    //         });                
    //         }
    //     });
    // });

    // $(document).on('change', '#layout', function(){
    //             var id = $(this).val();
    //             //console.log(id);
    //             if(id != ''){
    //               $.ajax({
    //                 url:"{{URL::route('get_societies')}}",
    //                 type: 'get',
    //                 data: {id: id},
    //                     success: function(response){
    //                     //console.log(response);
    //                     // $('.m-portlet__body').html(response);
    //                     //$('#colony').selectpicker('refresh');
    //                 }
    //               });    
    //             }            
    // });



</script>
@endsection
