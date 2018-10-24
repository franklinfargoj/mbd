@extends('admin.layouts.app')
@section('actions')
    @include('admin.em_clerk_department.action')
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

<div class="col-md-12">
    
    <div class="m-portlet m-portlet--compact m-portlet--mobile">
        {{--<div class="m-portlet__head">--}}
            {{--<div class="m-portlet__head-caption">--}}
                {{--<div class="m-portlet__head-title">--}}
                    {{--<h3 class="m-portlet__head-text">--}}

                        {{--</h3>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--<a class="btn btn-danger" href="{{route('hearing.create')}}" style="float: right;margin-top: 3%">Add
                Hearing</a>--}}
            {{--</div>--}}
        <div class="m-portlet__body">
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
@endsection
@section('datatablejs')
{!! $html->scripts() !!}

<script>
    $(document).ready(function () {
        $(".display_msg").delay(5000).slideUp(300);
     });

</script>
@endsection
