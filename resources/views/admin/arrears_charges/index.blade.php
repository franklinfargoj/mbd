@extends('admin.layouts.app')
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
            <h3 class="m-subheader__title m-subheader__title--separator">Arrears Charges Rate</h3>
            {{ Breadcrumbs::render('arrears_charges',encrypt($society->id),encrypt($building->id)) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link pull-right"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="box-subheading ml-0 mb-0">{{$society->society_name}} - {{$building->name}}</h4>
            <div class="tools">
                <a href="{{url('arrears_charges/'.encrypt($society->id).'/'.encrypt($building->id).'/create')}}" class='btn m-btn--pill m-btn--custom btn-primary pull-right' id="arrears_charges">Add Arrears Charge </a>
            </div>
        </div>
        {!! $html->table() !!}
    </div>
</div>

<!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection
@section('datatablejs')
{!! $html->scripts() !!}

<script>
    $(document).ready(function () {
        $(".display_msg").delay(5000).slideUp(300);
    });
</script>
@endsection
