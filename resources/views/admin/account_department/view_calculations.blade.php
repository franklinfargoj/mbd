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
            <h3 class="m-subheader__title m-subheader__title--separator">Calculation Of Tenant - {{$data['tenant']->first_name.' '.$data['tenant']->last_name}} - {{$data['tenant']->flat_no}}</h3>
            {{ Breadcrumbs::render('calculations',encrypt($data['ward']->layout_id),encrypt($data['society']->id),encrypt($data['building']->id)) }}
         </div>
        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <div class="row align-items-center mb-0">                            
                        <div class="col-md-4">
                            <div class="form-group m-form__group">
                                <form action="{{url('view_calculations/'.encrypt($data['tenant']->id).'/'.$data['year'])}}" method="get" class="view_calculations">
                                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="year" name="selectYear" required>
                                    <option value="" style="font-weight: normal;">Select Year</option>
                                    @foreach($data['years'] as $key => $value)
                                        <option @if($value == $data['year']) selected @endif value="{{$value}}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                </form>
                            </div>
                        </div>   
                        <div class="col-md-4">
                            <div class="form-group m-form__group">
                                <a href="{{url('view_calculations/'.encrypt($data['tenant']->id).'/'.$data['year'].'?is_download=1')}}" class="btn m-btn--pill m-btn--custom btn-primary">Download</a>
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
            {!! $html->table() !!}
            <!--end: Datatable -->
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection
@section('datatablejs')
{!! $html->scripts() !!}
<script type="text/javascript">
    $('#year').on('change',function(){
        $('.view_calculations').submit();
    });
</script>
@endsection