@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.'.$oc_application->folder.'.action_oc',compact('oc_application'))
@endsection
@section('content')
<style type="text/css" media="print">
    #printdiv {
        size: auto;
        margin: 0mm;
    }
 
</style>

<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Application for Consent for OC</h3>
           @php
            $route_name=\Request::route()->getName();
            @endphp
            @if($route_name=='ee.view_oc_application')
            {{ Breadcrumbs::render('view_oc_application_ee',$oc_application->id) }}
            @elseif($route_name=='ree.view_application')
            {{ Breadcrumbs::render('view_application_ree',$oc_application->id) }}
            @elseif($route_name=='co.view_application')
            {{ Breadcrumbs::render('view_application_co',$oc_application->id) }}
            @else
            @endif
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div>
       <iframe src="{{ config('commanConfig.storage_server').'/'.isset($oc_application->application_path) ? $oc_application->application_path : '' }}" width="1000" height="600"></iframe>
</div>

@endsection
@section('download_application_form_js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#download_application_form').click(function () {
            $(this).hide();
        });
    });

    function printContent(element) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(element).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
    function goBack() {
        window.history.back();
    }
</script>
@endsection
