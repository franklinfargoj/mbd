@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.'.$ol_application->folder.'.action',compact('ol_application'))
@endsection
@section('content')
<style type="text/css" media="print">
    #printdiv { 
        size: auto;
        margin: 0mm;
    }
 
</style>
<!-- <div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Applications</h3>
            
            <div class="ml-auto btn-list">
                <a  onclick="goBack()" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                <a href="#" target="_blank" id="download_application_form" class="btn print-icon"
                    rel="noopener" onclick="printContent('printdiv')"><img src="{{asset('/img/print-icon.svg')}}" title="print"></a>
            </div>
        </div>
    </div>

</div> -->

<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Application</h3>
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
            <a href="{{ url()->previous() }}" class="btn btn-link ml-auto"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
        </div>
    </div>
     <div class="col-md-12">
       <iframe src="{{ config('commanConfig.storage_server').'/'.isset($ol_application->application_path) ? $ol_application->application_path : '' }}" width="940" height="600"></iframe>
    </div>   
    @if($ol_application->comments) 
    <div class="col-md-12">
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0">
            <div class="m-portlet__body m-portlet__body--table">
                <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                    <div class="">
                        <h3 class="section-title section-title--small">Society Comments :</h3>
                    </div>
                        <div class="remarks-suggestions table--box-input">
                            <div class="mt-3">
                                <label for="society_documents_comment">Additional Information</label>
                                    <textarea name="society_documents_comment" rows="5" cols="30" id="society_documents_comment" class="form-control form-control--custom" readonly>{{ $ol_application->comments->society_documents_comment }}</textarea>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>  
    </div> 
    @endif       
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
