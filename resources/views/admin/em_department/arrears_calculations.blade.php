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
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Arrears Calculation</h3>
            {{-- {{ Breadcrumbs::render('society_detail') }} --}}
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        <div class="row align-items-center row--filter">
            <div class="col-md-12">
                <h4 class="m-subheader__title">Calculation Of Society - {{$society->name}} {{$building->name}}</h4>
            </div>
        </div>
        @if(Session::has('success'))
        <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size:20px">×</span>
            </button> {{ Session::get('success') }}
        </div>
        @endif
        <form role="form" id="Form" method="get" action="{{ route('arrears_calculations') }}">
            <input type="hidden" name="society_id" value="{{$society->id}}">
            <input type="hidden" name="building_id" value="{{$building->id}}">
            <div class="row align-items-center mb-0">
                <div class="col-md-2">
                    <div class="form-group m-form__group">
                        <select id="year" name="year" class="form-control form-control--custom m-input"
                            placeholder="Select Year" >
                            <option value="">Select Year</option>
                            @if(!empty($years)) 
                                @foreach($years as $year)
                                    <option value="{{$year}}" @if($select_year == $year) selected @endif>{{$year}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 search-filter clearfix">
                        <input class="btn btn-primary Search" type="submit" value="Search" id="Search"/>
                    </div>
                </div>
            </div>
        </form>
        {!! $html->table() !!}
    </div>
</div>

<!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection
@section('datatablejs')
{!! $html->scripts() !!}
@endsection
