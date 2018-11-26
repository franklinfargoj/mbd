@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Service Charges Rate - {{$society->name}} {{$building->name}}</h3>
            {{ Breadcrumbs::render('service_charges',encrypt($society->id),encrypt($building->id)) }}
        </div>
        
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        <div class="tools">
            <a href="{{url('service_charges/'.encrypt($society->id).'/'.encrypt($building->id).'/create')}}" class='btn m-btn--pill m-btn--custom btn-primary'>Add Service Charge </a>
        </div>
        @if(Session::has('success'))
        <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size:20px">×</span>
            </button> {{ Session::get('success') }}
        </div>
        
        @endif
        {!! $html->table() !!}
    </div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection
@section('datatablejs')
{!! $html->scripts() !!}
@endsection
