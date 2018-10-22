@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Arrears Charges Rate - {{$society->name}} {{$building->name}}</h3>
            {{-- {{ Breadcrumbs::render('society_detail') }} --}}
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        <div class="tools">
            <a href="{{url('arrears_charges/'.$society->id.'/'.$building->id.'/create')}}" class='btn m-btn--pill m-btn--custom btn-primary' id="arrears_charges">Add Arrears Charge </a>
        </div>
        @if(Session::has('success'))
        <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size:20px">×</span>
            </button> {{ Session::get('success') }}
        </div>
        @endif
        <form role="form" id="eeForm" method="get" action="{{ route('em.index') }}">
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
                        <input class="btn tran-btn Search" type="submit" value="Search" id="Search"/>
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
