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
            <h3 class="m-subheader__title m-subheader__title--separator">Update Society Ward & Colony Details</h3>
            {{ Breadcrumbs::render('em') }}
         </div>
   <form method="post" enctype='multipart/form-data' action="{{route('update_soc_ward_colony')}}">
        {{ csrf_field() }}
        <input type="hidden" value="{{ old('id', $society[0]->id) }}" name="id" />

        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <h4 class="m-subheader__title">Ward & Coloney - {{$society[0]->society_name}}</h4>
                </div>
            
                <div class="col-md-12" style="margin-top:40px;margin-bottom: 40px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="wards" name="wards" required>
                                        <option value="" style="font-weight: normal;">Select Ward</option>
                                        @foreach($wards as $key => $value)
                                        <option value="{{ $value->id }}" {{ old("wards", $soc_colony->ward_id) == $value->id ? 'selected' : '' }} >{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12" style="margin-top:40px;margin-bottom: 40px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-9">
                                <div class="form-group m-form__group" id="colony_select">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="colony" name="colony" required>
                                        <option value="" style="font-weight: normal;">Select Colony</option>
                                        @foreach($colonies as $key => $value)
                                        <option value="{{ $value->id }}" {{ old("colony", $society[0]->colony_id) == $value->id ? 'selected' : '' }} >{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                          
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-9">
                        <div class="form-group m-form__group">
                            <input type="submit" class="btn btn-success" name="submit" value="submit">

                            <a  class="btn btn-info" href="{{ route('get_societies') }}">Cancel</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
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


<script>
    /*$("#update_status").on("change", function () {
        $("#eeForm").submit();
    });*/

    $(document).ready(function () {
        $(".display_msg").delay(5000).slideUp(300);
    });

    

    $(document).on('change', '#wards', function(){
                var id = $(this).val();
                console.log(id);
                //return false;
                $.ajax({
                    url:"{{URL::route('get_colonies')}}",
                    type: 'get',
                    data: {id: id},
                        success: function(response){
                        console.log(response);
                        $('#colony_select').html(response);
                        $('#colony').selectpicker('refresh');
                    }
                });             
    });

</script>
@endsection
