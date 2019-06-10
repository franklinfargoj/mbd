@extends('admin.layouts.app')
@section('content')
    <div class="col-md-12">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Payment Details : {{$society[0]['society_name']}}</h3>
{{--                {{ Breadcrumbs::render('lease_detail') }}--}}
                {{--<div class="btn-list text-right ml-auto">--}}
                    {{--<a href="{{route('village_detail.index',['excel'=>'excel'])}}" name="excel" value="excel" class="btn excel-icon"><img src="{{asset('/img/excel-icon.svg')}}"></a>--}}
                    {{--<a target="_blank" href="{{route('village_detail.print')}}" class="btn print-icon"><img src="{{asset('/img/print-icon.svg')}}"></a>--}}
                {{--</div>--}}
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success fade in alert-dismissible show display_msg" style="margin-top:18px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button> {{ Session::get('success') }}
                </div>
            @endif
        <!-- END: Subheader -->

            <div class="m-portlet m-portlet--compact filter-wrap">
                <div class="row align-items-center row--filter">
                    <div class="col-md-12">
                        <form role="form" id="paymentsDetailsForm" class="floating-labels-form" method="get" action="{{route('payment_details',encrypt($society[0]['id']))}}">
                            <div class="row align-items-center mb-0">
                                <div class="col-md-3 p-m-0">
                                    <div class="form-group m-form__group focused">
                                        <label for="building_id" class="col-form-label mhada-multiple-label">Building Name:</label>
                                        <select title="Select Building" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                             data-id="{{$society[0]['id']}}"   id="building_id" name="building_id">
                                            @foreach($buildings as $building)
                                                <option value="{{$building->id}}"  {{ isset($getData['building_id'])? (($getData['building_id'] == $building->id) ? 'selected' : '') : '' }}>{{$building->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                @if($getData)
                                    @if(isset($getData['tenant_id']))
                                    <div id="tenants_list" class="col-md-3 p-m-0">
                                        <div class="form-group m-form__group focused">
                                            <label for="tenant_id" class="col-form-label mhada-multiple-label">Tenant Name:</label>
                                            <div class="tenants">
                                                <select title="Select Tenant" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                                        id="tenant_id" name="tenant_id">
                                                    @foreach($tenants as $tenant)
                                                        <option value="{{$tenant->id}}"  {{ isset($getData['tenant_id'])? (($getData['tenant_id'] == $tenant->id) ? 'selected' : '') : '' }}>{{$tenant->first_name.' '.$tenant->middle_name.' '.$tenant->last_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        @if($society[0]['society_bill_level'] == 2)
                                            <div id="tenants_list" class="col-md-3 p-m-0" style="display: none;">
                                                <div class="form-group m-form__group focused">
                                                    <label for="tenant_id" class="col-form-label mhada-multiple-label">Tenant Name:</label>
                                                    <div class="tenants">

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif

                                @else
{{--                                    @php dd($society[0]['society_bill_level']); @endphp--}}
                                    @if($society[0]['society_bill_level'] == 2)
                                    <div id="tenants_list" class="col-md-3 p-m-0" style="display: none;">
                                        <div class="form-group m-form__group focused">
                                            <label for="tenant_id" class="col-form-label mhada-multiple-label">Tenant Name:</label>
                                            <div class="tenants">

                                            </div>
                                        </div>
                                    </div>
                                     @endif
                                @endif


                                <div class="col">
                                    <div class="form-group m-form__group">
                                        <div class="btn-list">
                                            <button type="submit" class="btn m-btn--pill m-btn--custom btn-primary">Search</button>
                                            <button type="reset" onclick="window.location.href='{{ route("payment_details",encrypt($society[0]['id'])) }}'"
                                                    class="btn m-btn--pill m-btn--custom btn-metal">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <div class="m-portlet m-portlet--compact m-portlet--mobile">

            <div class="m-portlet__body data-table--custom data-table--icons data-table--actions">
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
    </div>
@endsection
@section('datatablejs')
{!! $html->scripts() !!}
<script>
    $(document).ready(function () {
        $(document).on("click", ".dd_details", function () {
            var id = $(this).attr("data-id");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                data:{
                    id:id
                },
                url:"{{ route('loadDDDetailsUsingAjax') }}",
                success:function(res)
                {
                    $("#myModal").html(res);
                    $("#myModalBtn").click();
                }
            });
        });
    });

</script>
        <script>
            $(document).on('change', '#building_id', function(){
                var building_id = $(this).val();
                var society_id = $(this).data('id');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{URL::route('getTenantsByAjax')}}",
                    type: 'POST',
                    data: {building_id: building_id,society_id : society_id},
                    success: function(response){
//console.log(response);
                        $('.tenants').html(response);
                        $('#tenants_list').show();
                        $('.m_selectpicker').selectpicker();

                    }
                });


            });


        </script>




@endsection
