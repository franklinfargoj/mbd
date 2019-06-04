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
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center" id="search_box">
            <h3 class="m-subheader__title m-subheader__title--separator">Ward & Colony Details</h3>
            {{ Breadcrumbs::render('em') }}
            <div class="ml-auto btn-list">
                <a href="{{ route('get_societies') }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left"
                        style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <div class="m-portlet__body">
            <form class="m-form m-form--rows m-form--label-align-right" method="post" enctype='multipart/form-data'
                action="{{route('update_soc_ward_colony')}}">
                {{ csrf_field() }}
                <input type="hidden" value="{{ old('id', $society[0]->id) }}" name="id" />

                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h4 class="m-subheader__title--hint mb-4" style="margin-left: 0;">Ward & Colony for
                            {{$society[0]->society_name}}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-form-label">Select Ward</label>
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="wards"
                                name="wards" required>
                                <option value="" style="font-weight: normal;">Select Ward</option>
                                @foreach($wards as $key => $value)
                                <option value="{{ $value->id }}"
                                    @if(!empty($soc_colony)){{ old("wards", $soc_colony->ward_id) == $value->id ? 'selected' : '' }} @endif>{{
                                    $value->name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block error">{{$errors->first('wards')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-3" id="colony_select">
                        <div class=" form-group">
                            <label class="col-form-label">Select Colony</label>
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="colony"
                                name="colony" required>
                                <option value="" style="font-weight: normal;">Select Colony</option>
                                @foreach($colonies as $key => $value)
                                <option value="{{ $value->id }}"
                                    {{ old("colony", $society[0]->colony_id) == $value->id ? 'selected' : '' }}>{{
                                    $value->name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block error">{{$errors->first('colony')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <div class="btn-list mt-3">
                            <input type="submit" class="btn btn-primary mhada-btn-pill" name="submit" value="Submit">
                        <a class="btn btn-secondary mhada-btn-pill" href="{{route('get_societies')}}">Cancel</a>
                        </div>        
                    </div>
                </div>
                
            </form>
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



    $(document).on('change', '#wards', function () {
        var id = $(this).val();
        console.log(id);
        //return false;
        $.ajax({
            url: "{{URL::route('get_colonies')}}",
            type: 'get',
            data: {
                id: id
            },
            success: function (response) {
                console.log(response);
                $('#colony_select').html(response);
                $('#colony').selectpicker('refresh');
            }
        });
    });

</script>
@endsection
