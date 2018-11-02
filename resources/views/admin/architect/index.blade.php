@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Architect Applications</h3>
        </div>
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--compact filter-wrap">
        <div class="row align-items-center row--filter">
            <div class="col-md-12">
                <!-- <div class="form-group m-form__group row align-items-center"> -->
                <form class="form-group m-form__group row align-items-end" method="get" action="{{url('architect_application')}}">
                    <div class="col-md-2">
                        <input type="text" class="form-control form-control--custom m-input" placeholder="Application No, Candidate Name, Email ID OR Mobile No"
                            title="Enter Application No, Candidate Name, Email ID OR Mobile No" id="m_form_search" name="keyword"
                            value="{{ (!empty($getData) ? (isset($getData['keyword'])?$getData['keyword']:'') : '') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control form-control--custom m-input m_datepicker" placeholder="From Date"
                            name="from" autocomplete="off" value="{{ (!empty($getData) ? (isset($getData['from'])?$getData['from']:'') : '') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" autocomplete="off" class="form-control form-control--custom m-input m_datepicker" placeholder="To Date"
                            name="to" value="{{ (!empty($getData) ? (isset($getData['to'])?$getData['to']:'') : '') }}">
                    </div>
                    <div class="col-md-3">
                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="exampleSelect1"
                            name="status">
                            <option value="">All</option>
                            @foreach(config('commanConfig.architect_applicationStatus') as $key=>$value)
                            <option
                                {{ (!empty($getData) ? (isset($getData['status'])?($getData['status']==$value?'selected':''):'') : '') }}
                                value="{{$value}}">{{$key}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="btn-list">
                            <button type="submit" class="btn m-btn--pill m-btn--custom btn-primary">Search</button>
                            <button type="submit" name="reset" value="Reset" class="btn m-btn--pill m-btn--custom btn-metal">Reset</button>
                        </div>
                    </div>
                    {{-- <div class="col-md-6 mt-5">
                                <div class="btn-list text-right">
                                    <button type="submit" name="excel" value="excel" class="btn excel-icon"><img src="{{asset('/img/excel-icon.svg')}}"></button>
                                    <a target="_blank" href=""
                                        class="btn print-icon"><img src="{{asset('/img/print-icon.svg')}}"></a>
                                </div>
                            </div>  --}}

                </form>

                <!-- </div> -->
            </div>
        </div>
    </div>
    <div class="m-portlet data-table--custom data-table--icons data-table--actions">
        <div class="d-flex justify-content-between">
            <h3 class="section-title section-title--small">Revision Requests</h3>
            <div class="topnav">
                <a class="btn-link {{isset($_GET['application_status'])?($_GET['application_status']==0?'active':''):'active'}}"
                 href="?application_status=0">All</a>
                <a class="btn-link {{isset($_GET['application_status'])?($_GET['application_status']==1?'active':''):''}}"
                    href="?application_status=1">Shortlisted</a>
                <a class="btn-link {{isset($_GET['application_status'])?($_GET['application_status']==2?'active':''):''}}"
                    href="?application_status=2">Final</a>
            </div>
        </div>
        {{-- @if($is_commitee==true)
        <form method="post" action="{{route('finalise_architect_application')}}">
            @else
            <form method="post" action="{{route('shortlist_architect_application')}}">
                @endif
                @csrf
                @if($is_view==true)
                <div class="btn-list mb-2">
                    <button type="submit" name="shortlist" value="shortlist" class="btn btn-primary">Shortlist</button>
                    <button type="submit" name="remove_shortlist" value="remove_shortlist" class="btn btn-primary">Remove
                        From Shortlisted List</button>
                </div>
                @endif
                @if($is_commitee==true)
                <div class="btn-list mb-2">
                    <button type="submit" name="final" value="final" class="btn btn-primary">Add to Final list</button>
                    <button type="submit" name="remove_final" value="remove_final" class="btn btn-primary">Remove
                        from Final list</button>
                </div>
                @endif --}}
                {!! $html->table() !!}
            {{-- </form> --}}
    </div>
    <input type="hidden" id="myModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" />

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">

    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection
<?php //dd($html->scripts()); ?>
@section('datatablejs')
{!! $html->scripts() !!}
<script>
    /*$( function() {
        $( "#published_from_date, #published_to_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    } );*/

</script>

@endsection
