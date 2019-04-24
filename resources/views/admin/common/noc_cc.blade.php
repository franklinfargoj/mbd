@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.'.$noc_application->folder.'.action_noc_cc',compact('noc_application'))
@endsection
@section('content')
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
                View Application </h3>
            {{ Breadcrumbs::render('view_application_noc_cc',$noc_application->id) }}
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div>

<style type="text/css" media="print">
    #printdiv {
        size: auto;
        margin: 0mm;
    }
 
</style> 
<div class="col-md-12">
<iframe src="{{ config('commanConfig.storage_server').'/'.isset($noc_application->application_path) ? $noc_application->application_path : '' }}" width="1000" height="600"></iframe>
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
