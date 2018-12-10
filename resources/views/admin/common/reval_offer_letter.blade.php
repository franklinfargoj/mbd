@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.'.$ol_application->folder.'.reval_action',compact('ol_application'))
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
            <h3 class="m-subheader__title m-subheader__title--separator">Revalidation Application</h3>
            @php
            $route_name=\Request::route()->getName();
            @endphp
            @if($route_name=='ee.view_application')
            {{ Breadcrumbs::render('view_application_ee',$ol_application->id) }}
            @elseif($route_name=='vp.view_application')
            {{ Breadcrumbs::render('view_application_vp',$ol_application->id) }}
            @elseif($route_name=='ree.view_application')
            {{ Breadcrumbs::render('view_application_ree',$ol_application->id) }}
            @elseif($route_name=='ree.view_reval_application')
                {{ Breadcrumbs::render('view_reval_application_ree',$ol_application->id) }}
            @elseif($route_name=='co.view_application')
            {{ Breadcrumbs::render('view_application_co',$ol_application->id) }}
            @elseif($route_name=='dyce.view_application')
            {{ Breadcrumbs::render('view_application_dyce',$ol_application->id) }}
            @elseif($route_name=='cap.view_application')
            {{ Breadcrumbs::render('view_application',$ol_application->id) }}
            @else
            @endif
            <div class="ml-auto btn-list">
                <a  onclick="goBack()" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                <a href="#" target="_blank" id="download_application_form" class="btn print-icon"
                    rel="noopener" onclick="printContent('printdiv')"><img src="{{asset('/img/print-icon.svg')}}" title="print"></a>
            </div>
        </div>
    </div>
        <iframe src="{{ $ol_application->application_path}}" width="1000" height="482"></iframe>

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
