@extends('admin.layouts.app')

@section('actions')
    
@if(Auth::user()->role_id == 7)         
      @include('admin.rc_department.action',compact('ol_application'))        
@else
     @include('admin.em_department.action',compact('ol_application'))     
@endif

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
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Society Billing details - @if(!empty($society)){{$society->name}}@endif @if(!empty($building)){{$building->building_no . ' - ' .$building->name}}@endif @if(!empty($tenant)) {{$tenant->first_name.' '.$tenant->last_name}} @endif</h3>
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
            {{-- {{ Breadcrumbs::render('society_detail') }} --}}
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        @if(Session::has('success'))
        <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size:20px">×</span>
            </button> {{ Session::get('success') }}
        </div>
        @endif
        <form role="form" id="Form" method="get" action="{{ route('billing_calculations') }}">
            <input type="hidden" name="society_id" value="@if(!empty($society)){{encrypt($society->id)}}@endif">
            <input type="hidden" name="building_id" value="@if(!empty($building)){{encrypt($building->id)}}@endif">
            <input type="hidden" name="tenant_id" value="@if(!empty($tenant)){{encrypt($tenant->id)}}@endif">
            <div class="row align-items-center mb-0">
                <div class="col-md-3">
                    <div class="form-group m-form__group">
                        <select id="year" name="year" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                            placeholder="Select Year" required>
                            <option value="">Select Year</option>
                            @if(!empty($years)) 
                                @foreach($years as $year)
                                    <option value="{{$year}}" @if($select_year == $year) selected @endif>{{$year}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                {{-- <div class="col-md-3">
                    <div class="form-group m-form__group">
                        <select id="month" name="month" class="form-control form-control--custom m-input"
                            placeholder="Select Month" required>
                            <option value="">Select Month</option>
                            @if(!empty($months)) 
                                @foreach($months as $key => $month)
                                    <option value="{{$key}}" @if($real_select_month == $key) selected @endif>{{$month}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div> --}}
                <div class="col-md-3 col-sm-3">
                    <div class="form-group m-form__group">
                        <input class="submit-button btn m-btn--pill m-btn--custom btn-primary Search" type="submit" value="Search" id="Search"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
        <div class="m-portlet m-portlet--compact m-portlet--mobile">
            <div class="dataTables_wrapper table-responsive" style="margin-left: -30px; margin-right: -30px; overflow-x: auto;">
                <!--begin: Datatable -->
                {!! $html->table() !!}
                <!--end: Datatable -->
            </div>
        </div>
</div>

<!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection
@section('datatablejs')
{!! $html->scripts() !!}
@endsection