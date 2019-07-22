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
                <h3 class="m-subheader__title m-subheader__title--separator">Bill Generation Level</h3>
                {{ Breadcrumbs::render('em') }}
            </div>
            <form action="{{route('get_tenant_ajax')}}" method="get">
                <div class="m-portlet filter-wrap">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            {{-- <h4 class="m-subheader__title"> Bill Generation </h4> --}}
                        </div>
                    </div>

                    <div class="row align-items-center mb-3">
                        <div class="col-sm-4">
                            <div class="form-group m-form__group">
                                <label class="col-form-label">Select Layout</label>
                                <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout" name="layout" required>
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
                        <div class="col-sm-4 offset-sm-1">
                            <div class="form-group m-form__group ward-div">
                                <label class="col-form-label">Select Ward</label>
                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="wards" name="wards" required>
                                    <option value="" style="font-weight: normal;">Select Ward</option>
                                    @if(isset($ward_list))
                                        @foreach($ward_list as $key => $value)
                                            {{--                                            @if($wardId == $value->id)--}}
                                            <option value="{{ encrypt($value->id) }}" {{($value->id == $wardId) ? 'selected':''  }}>{{ $value->name }}</option>
                                            {{--@else--}}
                                            {{--<option value="{{ encrypt($value->id) }}">{{ $value->name }}</option>--}}
                                            {{--@endif--}}
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-sm-4">
                            <div class="form-group m-form__group colony_select">
                                <label class="col-form-label">Select Colony</label>
                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="colony" name="colony" required>
                                    <option value="" style="font-weight: normal;">Select Colony</option>
                                    @if(isset($colony_list))
                                        @foreach($colony_list as $key => $value)
                                            {{--@if($colonyId == $value->id)--}}
                                            <option value="{{ encrypt($value->id) }}" {{($colonyId == $value->id) ? 'selected' : ''}}>{{ $value->name }}</option>
                                            {{--@else--}}
                                            {{--<option value="{{ encrypt($value->id) }}">{{ $value->name }}</option>--}}
                                            {{--@endif--}}
                                        @endforeach

                                        {{--@else--}}
                                        {{--@foreach($colonies_data as $key => $value)--}}
                                        {{--@if($colonyId == $value->id)--}}
                                        {{--<option value="{{ encrypt($value->id) }}" selected>{{ $value->name }}</option>--}}
                                        {{--@else--}}
                                        {{--<option value="{{ encrypt($value->id) }}">{{ $value->name }}</option>--}}
                                        {{--@endif--}}
                                        {{--@endforeach--}}
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 offset-sm-1">
                            <div class="form-group m-form__group society_select">
                                <label class="col-form-label">Select Societies</label>
                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="society" name="society" required>
                                    <option value="" style="font-weight: normal;" {{$html == ''? 'selected':'' }}>Select Societies</option>
                                    @if(isset($society_list))
                                        @foreach($society_list as $key => $value)
                                            {{--@if(isset($society_name))--}}
                                            {{--<option value="{{encrypt($value->id)}}" {{ ($value->society_name == $society_name) ? 'selected' :'' }}>{{$value->society_name}}</option>--}}
                                            {{--@elseif($society_id == $value->id)--}}
                                            <option value="{{ encrypt($value->id) }}" {{ ($value->id == $society_id) ? 'selected' :'' }}>{{ $value->society_name }}</option>
                                            {{--@else--}}
                                            {{--<option value="{{ encrypt($value->id) }}">{{ $value->society_name }}</option>--}}
                                            {{--@endif--}}
                                        @endforeach
                                        {{--@else--}}
                                        {{--@foreach($societies_data as $key => $value)--}}
                                        {{--@if($society_id == $value->id)--}}
                                        {{--<option value="{{ encrypt($value->id) }}" selected>{{ $value->society_name }}</option>--}}
                                        {{--@else--}}
                                        {{--<option value="{{ encrypt($value->id) }}" >{{ $value->society_name }}</option>--}}
                                        {{--@endif--}}
                                        {{--@endforeach--}}
                                    @endif

                                </select>
                            </div>
                        </div>
                    </div>

                    @php $search_year = date('Y'); @endphp

                    <div class="row align-items-center mb-3">
                        <div class="col-sm-4">
                            <div class="form-group m-form__group">
                                <label class="col-form-label">Year</label>
                                <select id="year" name="year" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        placeholder="Select Year" required>
                                    <option value="">Select Year</option>
                                    <option value="<?php echo date('Y');?>" @if($search_year == date('Y')) selected @endif><?php echo date('Y'); ?></option>
                                    <option value="<?php echo date("Y",strtotime("-1 year")); ?>" @if($search_year == date("Y",strtotime("-1 year"))) selected @endif ><?php echo date("Y",strtotime("-1 year")); ?></option>
                                    <option value="<?php echo date("Y",strtotime("-2 year")); ?>" @if($search_year == date("Y",strtotime("-2 year"))) selected @endif><?php echo date("Y",strtotime("-2 year")); ?></option>
                                    <option value="<?php echo date("Y",strtotime("-3 year")); ?>" @if($search_year == date("Y",strtotime("-3 year"))) selected @endif><?php echo date("Y",strtotime("-3 year")); ?></option>
                                    <option value="<?php echo date("Y",strtotime("-4 year")); ?>" @if($search_year == date("Y",strtotime("-4 year"))) selected @endif><?php echo date("Y",strtotime("-4 year")); ?></option>
                                    <option value="<?php echo date("Y",strtotime("-5 year")); ?>" @if($search_year == date("Y",strtotime("-5 year"))) selected @endif ><?php echo date("Y",strtotime("-5 year")); ?></option>
                                    <option value="<?php echo date("Y",strtotime("-6 year")); ?>" @if($search_year == date("Y",strtotime("-6 year"))) selected @endif><?php echo date("Y",strtotime("-6 year")); ?></option>
                                    <option value="<?php echo date("Y",strtotime("-7 year")); ?>" @if($search_year == date("Y",strtotime("-7 year"))) selected @endif><?php echo date("Y",strtotime("-7 year")); ?></option>
                                    <option value="<?php echo date("Y",strtotime("-8 year")); ?>" @if($search_year == date("Y",strtotime("-8 year"))) selected @endif><?php echo date("Y",strtotime("-8 year")); ?></option>
                                    <option value="<?php echo date("Y",strtotime("-9 year")); ?>" @if($search_year == date("Y",strtotime("-9 year"))) selected @endif><?php echo date("Y",strtotime("-9 year")); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 offset-sm-1">
                            <div class="form-group m-form__group">
                                <label class="col-form-label">Month</label>
                                <select id="month" name="month" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        placeholder="Select month" required>
                                    <option value="">Select month</option>
                                    <option value='1'>Janaury</option>
                                    <option value='2'>February</option>
                                    <option value='3'>March</option>
                                    <option value='4'>April</option>
                                    <option value='5'>May</option>
                                    <option value='6'>June</option>
                                    <option value='7'>July</option>
                                    <option value='8'>August</option>
                                    <option value='9'>September</option>
                                    <option value='10'>October</option>
                                    <option value='11'>November</option>
                                    <option value='12'>December</option></select>
                            </div>
                        </div>
                    </div>

                    @if(isset($buildingId) && isset($building_name) && $buildingId !=0)
                        <div class="row align-items-center mb-3 building">
                            <div class="col-md-12">
                                <div class="form-group m-form__group ">
                                    Billing Level : Tenant level Billing.
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center mb-3 building">
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="building" name="building" required>
                                        @foreach($building_list as $building)
                                            <option value="{{encrypt($building->id)}}" {{ ($building->id == $buildingId) ? 'selected' :'' }}>{{$building->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif


                    <div class="row align-items-center mb-3">
                        <div class=" col-md-12 building_select">

                        </div>
                    </div>

                    @php $search_year = ''; @endphp
                    @php $search_month = ''; @endphp


                </div>


                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="btn-list">
                                    {{--<input type="submit" class="submit-button btn m-btn--pill m-btn--custom btn-primary mhada-btn-pill" name="search" value="Search" disabled>--}}
                                    <input type="submit" class="submit-button btn m-btn--pill m-btn--custom btn-primary mhada-btn-pill" name="download" value="Download" disabled>
                                    {{--                                    <a href="{{ url('generate_tenant_bill') }}" class="submit-button btn m-btn--pill m-btn--custom btn-primary mhada-btn-pill">Download Bills</a>--}}

                                    <a href="{{ route('generate_tenant_bill.download') }}" class="btn btn-secondary mhada-btn-pill">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>

        @if($html)
            <div class="m-portlet m-portlet--compact">{!! $html->table() !!}</div>
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
    {{--@if($html)--}}
        {{--{!! $html->scripts() !!}--}}
    {{--@endif--}}

    <script>
        /*$("#update_status").on("change", function () {
            $("#eeForm").submit();
        });*/

        $(document).ready(function () {
            $(".display_msg").delay(5000).slideUp(300);


            if((($('#layout').val() != '') && ($('#wards').val() != '')
                    && ($('#colony').val() != '') && ($('#society').val() != '') && ($('#building').val() != '')) ){

                $('.submit-button').prop('disabled',false);

            }

        });



        //
        //    $(document).on('change', '#layout', function() {
        //        var id = $(this).val();
        //
        //        alert(id);
        //
        //    });
        //
        //








        $(document).on('change', '#layout', function(){
            var id = $(this).val();
            //console.log(id);
            //return false;
            $.ajax({
                url:"{{URL::route('get_wards')}}",
                type: 'get',
                data: {id: id},
                success: function(response){
                    //console.log(response);
                    $('.ward-div').html(response);
                    $('#wards').selectpicker('refresh');

                    if((($('#layout').val() == '') || ($('#wards').val() == '')
                            || ($('#colony').val() == '') || ($('#society').val() == '') || ($('#building').val() == '')) ){

                        $('.submit-button').prop('disabled',true);

                    }

                }
            });
        });

        $(document).on('change', '#wards', function(){
            var id = $(this).val();
            //console.log(id);
            //return false;
            $.ajax({
                url:"{{URL::route('get_colonies')}}",
                type: 'get',
                data: {id: id},
                success: function(response){
                    //console.log(response);
                    $('.colony_select').html(response);
                    $('#colony').selectpicker('refresh');
                    if((($('#layout').val() == '') || ($('#wards').val() == '')
                            || ($('#colony').val() == '') || ($('#society').val() == '') || ($('#building').val() == '')) ){

                        $('.submit-button').prop('disabled',true);

                    }
                }
            });
        });

        $(document).on('change', '#colony', function(){
            var id = $(this).val();
            //console.log(id);
            //return false;
            $.ajax({
                url:"{{URL::route('get_society_select')}}",
                type: 'get',
                data: {id: id},
                success: function(response){
                    //console.log(response);
                    $('#society').selectpicker('refresh');

                    $('.society_select').html(response);
                    $('#society').selectpicker('refresh');
                    if((($('#layout').val() == '') || ($('#wards').val() == '')
                            || ($('#colony').val() == '') || ($('#society').val() == '') || ($('#building').val() == '')) ){

                        $('.submit-button').prop('disabled',true);

                    }

                }
            });
        });

        $(document).on('change', '#society', function(){
            var id = $(this).val();
            if($(this).text() != 'Select Societies') {
                $('.submit-button').prop('disabled',false);
            }
            $('.building').remove();
            $.ajax({
                url:"{{URL::route('get_building_select_updated')}}",
                type: 'get',
                data: {id: id},
                success: function(response){
                    //console.log(response);
                    $('.building_select').html(response);
                    $('.tenant-list').html('');
                    $('#building').selectpicker('refresh');

                    $('.building_list').remove();
                    if((($('#layout').val() == '') || ($('#wards').val() == '')
                            || ($('#colony').val() == '') || ($('#society').val() == '') || ($('#building').val() == '')) ){

                        $('.submit-button').prop('disabled',true);

                    }
                }
            });
        });

        $(document).on('change', '#building', function(){
            var id = $(this).val();
            if($(this).text() != 'Select Building') {
                $('.submit-button').prop('disabled',false);
            }

            // console.log(id);
            //return false;
            // $.ajax({
            //     url:"{{URL::route('get_tenant_ajax')}}",
            //     type: 'get',
            //     data: {id: id},
            //         success: function(response){
            //         //console.log(response);
            //         $('.tenant-list').html(response);
            //         //$('#building').selectpicker('refresh');
            //     }
            // });
        });

        $('.m_selectpicker').selectpicker();

    </script>
@endsection
