@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.conveyance.'.$data->folder.'.action')
@endsection
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
                EM Scrutiny Remark </h3>
                 {{ Breadcrumbs::render('conveyance_em_scrutiny',$data->id) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
        </div>
    </div>
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
            <li class="nav-item m-tabs__item em_tabs" id="section-1">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#scrutiny-summary-remark" role="tab"
                    aria-selected="false">
                    <i class="la la-cog"></i> Scrutiny Summary & Remark
                </a>
            </li>
            <li class="nav-item m-tabs__item em_tabs" id="section-2">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#list-of-allottes" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i> List of Allottees
                </a>
            </li>
            <li class="nav-item m-tabs__item em_tabs" id="section-3">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#society-resolution" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i> Covering Letter
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <div class="tab-pane section-1 active show" id="scrutiny-summary-remark" role="tabpanel">
            <!-- No Dues Certificate -->
            <div class="m-portlet m-portlet--mobile m_panel">
                <div class="m-portlet__body" style="padding-right: 0;">
                    <div class="col-sm-12">
                        <div class="d-flex flex-column h-100">
                            <div class="mt-auto">
                                <p>Click to download No Dues Certificate</p>

                                @if($no_dues_certificate_docs['drafted_no_dues_certificate']['sc_document_status'] != null)
                                    <a href="{{ config('commanConfig.storage_server').'/'.$no_dues_certificate_docs['drafted_no_dues_certificate']['sc_document_status']->document_path }}"
                                       class="btn btn-primary" target="_blank" rel="noopener">Download</a>
                                @else
                                    <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                * Note : No Dues Certificate not available. </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- List of Allottesss -->
        <div class="tab-pane section-2" id="list-of-allottes" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body" style="padding-right: 0;">
                        <div class="col-md-12">
                            <p>Click to download generated list of allottees in xls format</p>

                            @if(!empty($society_list_docs['अधिकृत सभासदांची यादी (पती व पत्नी संयुक्त नावे)']->sc_document_status->document_path))
                                <a href="{{ config('commanConfig.storage_server').'/'.$bonafide_docs['bonafide_list']->sc_document_status->document_path }}" class="btn btn-primary"> Download</a>
                            @else
                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;"> * Note : Covering Letter is not available. </span>
                            @endif    
                         </div>
                    </div>
                </div>
            </div>        
        </div>

     <!-- covering letter    -->
        <div class="tab-pane section-3" id="society-resolution" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body" style="padding-right: 0;">
                        <p>Click to download Covering Letter in pdf format</p>
                        @if(!empty($covering_letter_docs['em_covering_letter']->sc_document_status))
                            <a href="{{ $covering_letter_docs['em_covering_letter']->sc_document_status->document_path }}" class="btn btn-primary" target="_blank" rel="noopener">
                                Download</a>
                        @else
                             <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;"> * Note : Covering Letter is not available. </span>       
                        @endif
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>


@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script>
    $(document).ready(function () {

    //cookies setting for tabs
        $(".display_msg").delay("slow").slideUp("slow");

        var id = Cookies.get('sectionId');
        if (id != undefined) {

        $(".tab-pane").removeClass('active');
        $(".nav-link").removeClass('active');
        $(".m-tabs__item").removeClass('active');
        $("#" + id+ " a").addClass('active');

        $("." + id).addClass('active');
        }

        $(".em_tabs").on('click', function () {
        $(".nav-link").removeClass('active');
        Cookies.set('sectionId', this.id);
        });
    });
</script>
@endsection