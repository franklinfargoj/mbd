@extends('admin.layouts.app')
@section('actions')
    @include('admin.em_clerk_department.action')
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
            <h3 class="m-subheader__title m-subheader__title--separator">Arrear Calculation</h3>
            {{ Breadcrumbs::render('em_clerk') }}
         </div>

        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                <form method="get" enctype='multipart/form-data' action="{{route('tenant_payment_list')}}">
                    {{ csrf_field() }}
                    <div class="row align-items-center" style="margin-bottom: 1rem;">                            
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout" name="layout" required>
                                        <option value="" style="font-weight: normal;">Select Layout</option>
                                        @foreach($layout_data as $key => $value)
                                        <option value="{{ encrypt($value->id) }}">{{ $value->layout_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block error">{{$errors->first('layout')}}</span>
                                </div>
                            </div>                          
                    </div>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                            <div class="col-md-4">
                                <div class="form-group m-form__group society_list">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="society" name="society" required>
                                        <option value="" style="font-weight: normal;">Select Society</option>
                                        @foreach($societies_data as $key => $value)
                                        <option value="{{ encrypt($value->id) }}">{{ $value->society_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block error">{{$errors->first('society')}}</span>
                                </div>
                            </div>                          
                    </div>

                    <div class="row align-items-center" style="margin-bottom: 1rem;">
                            <div class="col-md-4">
                                <div class="form-group m-form__group building_list">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="building" name="building" required>
                                        <option value="" style="font-weight: normal;">Select Building</option>
                                        @foreach($building_data as $key => $value)
                                        <option value="{{ encrypt($value->id) }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block error">{{$errors->first('building')}}</span>
                                </div>
                            </div>                          
                    </div>
            
                <div class="row align-items-center mb-0">           
                    <div class="col-md-9">
                        <div class="form-group m-form__group">
                            <input type="submit" class="btn m-btn--pill m-btn--custom btn-primary" name="search" value="Search">
                        </div>
                    </div>
                </div>

            </form>
                   
                </div>
                <div class="col-md-12">
                    <div class="m-portlet__body">
                        <!--begin: Datatable -->
                        @if($html)
                        {!! $html->table() !!}
                        @endif
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- END: Subheader -->

    <input type="hidden" id="myModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" />

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">

    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection

@section('datatablejs')
@if($html)
{!! $html->scripts() !!}
@endif
<script>
    /*$("#update_status").on("change", function () {
        $("#eeForm").submit();
    });*/

    $(document).ready(function () {
        $(".display_msg").delay(5000).slideUp(300);
    });

    $(document).on('change', '#layout', function(){
                var id = $(this).val();
                if(id != ''){
                  $.ajax({
                    url:"{{URL::route('em_society_list')}}",
                    type: 'get',
                    data: {id: id},
                        success: function(response){
                        console.log(response);
                        $('.society_list').html(response);
                        $('#society').selectpicker('refresh');
                    }
                  });    
                }            
    });

    $(document).on('change', '#society', function(){
                var id = $(this).val();
                //console.log(id);
                if(id != ''){
                  $.ajax({
                    url:"{{URL::route('em_building_list')}}",
                    type: 'get',
                    data: {id: id},
                        success: function(response){
                        //console.log(response);
                        $('.building_list').html(response);
                        $('#building').selectpicker('refresh');
                    }
                  });    
                }            
    });

</script>
@endsection
