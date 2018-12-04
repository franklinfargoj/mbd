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
            <h3 class="m-subheader__title m-subheader__title--separator">Payment Details</h3>
            {{ Breadcrumbs::render('payment_details',encrypt($ward->layout_id),encrypt($society->id),encrypt($building->id)) }}
         </div>
   
        
        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <div class="row align-items-center mb-0">                            
                        <div class="col-md-4">
                            <div class="form-group m-form__group">
                                <form action="{{url('payment_details/'.encrypt($tenant->id).'/'.$year)}}" method="get" class="payment_details">
                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="year" name="selectYear" required>
                                    <option value="" style="font-weight: normal;">Select Year</option>
                                    @foreach($years as $key => $value)
                                        <option value="{{$value}}" @if($value == $year) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
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
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Payment Mode</th>
                    <th>Date Of Payment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="myTable">
            @if(!empty($paymentDetails) && count($paymentDetails))
                @foreach($paymentDetails as $key => $value )
                    <tr>    
                        <td>{{date("M", mktime(0, 0, 0, $value->bill_month, 10))}}</td>
                        <td>@if(count($value->trans_payment)){{$value->trans_payment->first()->amount_paid}}@endif</td>
                        <td>{{$value->status}}</td>
                        <td>@if(count($value->trans_payment)){{$value->trans_payment->first()->mode_of_payment}}@endif</td>
                        <td>@if(count($value->trans_payment)){{date('d-m-Y',strtotime($value->trans_payment->first()->created_at))}}@endif</td>
                        <td>
                            {!! Form::open(['method' => 'get', 'route' => 'view_bill_tenant']) !!}
                            {{ Form::hidden('tenant_id', encrypt($tenant->id)) }}
                            {{ Form::hidden('building_id', encrypt($building->id)) }}
                            {{ Form::hidden('society_id', encrypt($society->id)) }}
                            {{ Form::button('<span class="btn-icon btn-icon--edit"><img src="/img/view-arrears-calculation-icon.svg"></span> View Bill', array('class'=>'btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center','type'=>'submit')) }}
                            {!! Form::close() !!}
                        </td>
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