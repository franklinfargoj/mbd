@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.architect_layout.actions',compact('ArchitectLayout'))
@endsection
@section('content')
<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="d-flex">
            {{ Breadcrumbs::render('architect_Layout_scrutiny_of_ee_em_lm_ree',$ArchitectLayout->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
        <div class="">
            <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom">
                <li class="nav-item m-tabs__item" data-target="#document-scrunity">
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#scrutiny-ee">
                        <i class="la la-cog"></i> EE Scrutiny
                    </a>
                </li>

                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link show" data-toggle="tab" href="#scrutiny-lm">
                        <i class="la la-cog"></i> LM Scrutiny
                    </a>
                </li>

                <li class="nav-item m-tabs__item" data-target="#document-scrunity">
                    <a class="nav-link m-tabs__link  show" data-toggle="tab" href="#scrutiny-em">
                        <i class="la la-cog"></i> EM Scrutiny
                    </a>
                </li>

                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link show" data-toggle="tab" href="#scrutiny-ree">
                        <i class="la la-cog"></i> REE Scrutiny
                    </a>
                </li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active show" id="scrutiny-ee">
                    @include('admin.architect_layout.scrutiny_report_by_ee_em_le_ree.scrutiny_by_ee',compact('ArchitectLayout'))
                </div>

                <div class="tab-pane show" id="scrutiny-lm">
                    @include('admin.architect_layout.scrutiny_report_by_ee_em_le_ree.scrutiny_by_lm',compact('ArchitectLayout'))
                </div>

                <div class="tab-pane show" id="scrutiny-em">
                    @include('admin.architect_layout.scrutiny_report_by_ee_em_le_ree.scrutiny_by_em',compact('ArchitectLayout'))
                </div>
                <div class="tab-pane show" id="scrutiny-ree">
                @include('admin.architect_layout.scrutiny_report_by_ee_em_le_ree.scrutiny_by_ree',compact('ArchitectLayout'))                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
function PrintElem(elem) {
$('.btn-link').css('display','none')
var printable = document.getElementById(elem).innerHTML;

var mywindow = window.open('', 'PRINT', 'height=1200,width=1200');

mywindow.document.write('<html><head><title>Maharashtra Housing and development authority</title>');
mywindow.document.write('</head><body >');
mywindow.document.write(printable);
mywindow.document.write('</body></html>');

mywindow.document.close();
mywindow.focus();

mywindow.print();
mywindow.close();
$('.btn-link').css('display','block')
return true;
} 
</script>    
@endsection
