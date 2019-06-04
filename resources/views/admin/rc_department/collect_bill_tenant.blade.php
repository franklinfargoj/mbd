@extends('admin.layouts.app')
@section('actions')
@include('admin.rc_department.action')
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
            <h3 class="m-subheader__title m-subheader__title--separator">Bill Collection Level</h3>
              {{ Breadcrumbs::render('em') }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
        <form action="{{route('get_building_bill_collection')}}" method="get">
            <div class="m-portlet filter-wrap">
                <div class="row align-items-center mb-3">
                    <div class="col-md-12">
                        <h4 class="m-subheader__title"></h4>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="form-group m-form__group">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                id="layout" name="layout" required>
                                <option value="" style="font-weight: normal;">Select Layout</option>
                                @foreach($layout_data as $key => $value)
                                @if($layoutId == $value->id)
                                <option value="{{ encrypt($value->id) }}" selected>{{ $value->layout_name }}</option>
                                @else
                                <option value="{{ encrypt($value->id) }}">{{ $value->layout_name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-md-4">
                        <div class="form-group m-form__group ward-div">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                id="wards" name="wards" required>
                                <option value="" style="font-weight: normal;">Select Ward</option>
                                {{-- @foreach($wards_data as $key => $value)
                                @if($wardId == $value->id)
                                <option value="{{ encrypt($value->id) }}" selected>{{ $value->name }}</option>
                                @else
                                <option value="{{ encrypt($value->id) }}">{{ $value->name }}</option>
                                @endif
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-md-4">
                        <div class="form-group m-form__group colony_select">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                id="colony" name="colony" required>
                                <option value="" style="font-weight: normal;">Select Colony</option>
                                {{-- @foreach($colonies_data as $key => $value)
                                @if($colonyId == $value->id)
                                <option value="{{ encrypt($value->id) }}" selected>{{ $value->name }}</option>
                                @else
                                <option value="{{ encrypt($value->id) }}">{{ $value->name }}</option>
                                @endif
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-md-4">
                        <div class="form-group m-form__group society_select">
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                id="society" name="society" required>
                                <option value="" style="font-weight: normal;" selected>Select Societies</option>
                                @if(isset($society_name))
                                <option value="{{encrypt($society_id)}}" selected>{{$society_name}}</option>
                                @endif
                                {{-- @foreach($societies_data as $key => $value)
                                <option value="{{ encrypt($value->id) }}">{{ $value->society_name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                </div>
                @if(isset($buildingId) && isset($building_name))
                <div class="row align-items-center mb-0">
                    <div class="col-md-4">
                        <div class="form-group m-form__group  building_selected">
                            <select required class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                id="building" name="building" required>
                                <option value="{{encrypt($buildingId)}}" selected>{{$building_name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row align-items-center mb-3">
                    <div class=" col-md-12 building_select">
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-md-9">
                        <div class="form-group m-form__group">
                            <input type="submit" class="submit-button btn m-btn--pill m-btn--custom btn-primary" name="search"
                                value="Search" disabled>
                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>

    <div class="m-portlet">
        @if($html)
        {!! $html->table() !!}
        @endif
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

    $(document).on('change', '#layout', function () {
        var id = $(this).val();
        //console.log(id);
        //return false;
        $.ajax({
            url: "{{URL::route('get_wards')}}",
            type: 'get',
            data: {
                id: id
            },
            success: function (response) {
                //console.log(response);
                $('.ward-div').html(response);

                $('#wards').selectpicker('refresh');
            }
        });
    });

    $(document).on('change', '#wards', function () {
        var id = $(this).val();
        //console.log(id);
        //return false;
        $.ajax({
            url: "{{URL::route('get_colonies')}}",
            type: 'get',
            data: {
                id: id
            },
            success: function (response) {
                //console.log(response);
                $('.colony_select').html(response);
                $('#colony').selectpicker('refresh');
            }
        });
    });

    $(document).on('change', '#colony', function () {
        var id = $(this).val();
        //console.log(id);
        //return false;
        $.ajax({
            url: "{{URL::route('get_society_select')}}",
            type: 'get',
            data: {
                id: id
            },
            success: function (response) {
                //console.log(response);
                $('.society_select').html(response);
                $('#society').selectpicker('refresh');
            }
        });
    });

    $(document).on('change', '#society', function () {
        var id = $(this).val();
        //console.log(id);
        //return false;
        if ($(this).text() != 'Select Societies') {
            $('.submit-button').prop('disabled', false);
        }
        $.ajax({
            url: "{{URL::route('get_building_select_updated_RC')}}",
            type: 'get',
            data: {
                id: id
            },
            success: function (response) {
                //console.log(response);
                $('.building_select').html(response);
                $('.tenant-list').html('');
                // $('#layoutId').val($('#layout').val());
                // $('#wardId').val($('#wards').val());
                // $('#colonyId').val($('#colony').val());
                // $('#societyId').val(id);
                $('.building_selected').remove();
                $('#building').selectpicker('refresh');
                // $('.hide_search_button').hide();
            }
        });
    });

    $(document).on('change', '#building', function () {
        var id = $(this).val();
        console.log(id);
        //return false;

        console.log(response);
        $('#building').val(id);
        //$('.tenant-list').html(response);
        //$('#building').selectpicker('refresh');

    });

</script>
@endsection
