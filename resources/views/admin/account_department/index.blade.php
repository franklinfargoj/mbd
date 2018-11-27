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
            <h3 class="m-subheader__title m-subheader__title--separator">List Of Society/Search Accounts</h3>
            {{ Breadcrumbs::render('search_accounts') }}
         </div>
   
        <form action="{{route('account_search')}}" method="get" class="">
        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    {{-- <h4 class="m-subheader__title"> List Of Society/Search Accounts</h4> --}}
                </div>

                <div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                        <div class="col-md-4">
                            <div class="form-group m-form__group">
                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout" name="layout_id" required>
                                    <option value="" style="font-weight: normal;">Select Layout</option>
                                    @foreach($layout_data as $key => $value)
                                        <option value="{{ encrypt($value->id) }}">{{ $value->layout_name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block error">{{$errors->first('layout_id')}}</span>
                            </div>
                        </div>                          
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                        <div class="col-md-4">
                            <div class="form-group m-form__group society_select">
                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="society" name="society_id" required>
                                    <option value="" style="font-weight: normal;">Select Societies</option>
                                </select>
                                <span class="help-block error">{{$errors->first('society_id')}}</span>
                            </div>
                        </div>                          
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                        <div class="col-md-4">
                            <div class="form-group m-form__group building_select">
                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="buidling" name="building_id" required>
                                    <option value="" style="font-weight: normal;">Select Buidling</option>
                                </select>
                                <span class="help-block error">{{$errors->first('building_id')}}</span>
                            </div>
                        </div>                          
                    </div>
                </div>
            </div>
            <div class="btn-list">
                <button type="submit" class="btn m-btn--pill m-btn--custom btn-primary">Search</button>
            </div>
        </div>
        </form>
    </div>
    <!-- END: Subheader -->
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

    $(document).on('change', '#layout', function(){
        var id = $(this).val();
        console.log(id);
        //return false;
        $.ajax({
            url:"{{URL::route('get_societies_select_layout')}}",
            type: 'get',
            data: {id: id},
                success: function(response){
                
                $('.society_select').html(response);
                $('#society').selectpicker('refresh');
            }
        });             
    });

    $(document).on('change', '#society', function(){
        var id = $(this).val();
        $.ajax({
            url:"{{URL::route('get_building_select_society')}}",
            type: 'get',
            data: {id: id},
                success: function(response){
                $('.building_select').html(response);
                $('#buidling').selectpicker('refresh');
            }
        });             
    });
</script>
@endsection
