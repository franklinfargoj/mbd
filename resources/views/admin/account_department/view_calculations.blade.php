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
            <h3 class="m-subheader__title m-subheader__title--separator">Calculation Of Tenant - {{$tenant->first_name.' '.$tenant->last_name}} - {{$tenant->flat_no}}</h3>
            {{ Breadcrumbs::render('calculations',encrypt($ward->layout_id),encrypt($society->id),encrypt($building->id)) }}
         </div>
   
        
        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <div class="row align-items-center mb-0">                            
                        <div class="col-md-4">
                            <div class="form-group m-form__group">
                                <form action="{{url('view_calculations/'.encrypt($tenant->id).'/'.$year)}}" method="get" class="view_calculations">
                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="year" name="selectYear" required>
                                    <option value="" style="font-weight: normal;">Select Year</option>
                                    @foreach($years as $key => $value)
                                        <option value="{{$value}}" @if($value == $year) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                </form>
                            </div>
                        </div>   
                        <div class="col-md-4">
                            <div class="form-group m-form__group">
                                <a href="{{url('view_calculations/'.encrypt($tenant->id).'/'.$year.'?is_download=1')}}" class="btn m-btn--pill m-btn--custom btn-primary">Download</a>
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

                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            <!--begin: Datatable -->
            <table class="display table table-responsive table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Old Rate</th>
                    <th>Interest % on Old Rate</th>
                    <th>Revised Rate</th>
                    <th>Interest % on Difference</th>
                    <th>Payment Status</th>
                    <th>Final Rent Amount</th>
                </tr>
            </thead>
            <tbody id="myTable">
            @if(!empty($arrears_calculations) && !empty($arrears_charges))
                @foreach($arrears_calculations as $key => $value )
                    <tr>    
                        <td>{{$value->month}}</td>
                        <td>{{$value->year}}</td>
                        <td>{{$arrears_charges->old_rate}}</td>
                        <td>{{$arrears_charges->interest_on_old_rate}}</td>
                        <td>{{$arrears_charges->revise_rate}}</td>
                        <td>{{$arrears_charges->interest_on_diffrence}}</td>
                        <td>{{$value->payment_status}}</td>
                        <td>{{$value->total_amount}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center">No Data Found.</td>
                </tr>
            @endif
            </tbody>
            </table>
            <!--end: Datatable -->
            {{-- {!!$arrears_calculations->render()!!} --}}
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection

<script type="text/javascript">
    $('#year').on('change',function(){
        $('.view_calculations').submit();
    });
</script>