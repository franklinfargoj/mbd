@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.'.$folder.'.action',compact('ol_application'))
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif
@php
$route_name=\Request::route()->getName();
@endphp
  
<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="d-flex">
        @if($route_name=='co.show_calculation_sheet')
            {{ Breadcrumbs::render('calculation_sheet_co',$ol_application->id) }}
        @elseif($route_name=='cap.show_calculation_sheet') 
            {{ Breadcrumbs::render('calculation_sheet_cap',$ol_application->id) }}
        @elseif($route_name=='vp.show_calculation_sheet') 
            {{ Breadcrumbs::render('calculation_sheet_vp',$ol_application->id) }}       
        @elseif($route_name=='ree.show_calculation_sheet') 
            {{ Breadcrumbs::render('REE_calculation',$ol_application->id) }}   
        @endif
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom"
            role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#one" role="tab" aria-selected="false">
                    <i class="la la-cog"></i> परिगणनेचा तक्ता - अ
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#two" role="tab" aria-selected="false">
                    <i class="la la-briefcase"></i> Part payment
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#three" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i>1st installment
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#four" role="tab" aria-selected="false">
                    <i class="la la-cog"></i> 2nd, 3rd & 4th installment
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#five" role="tab" aria-selected="false">
                    <i class="la la-briefcase"></i>Summary
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#six" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i>REE - Note
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active show" id="one" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        परिगणनेचा तक्ता - अ
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">

                                    <div class="d-flex justify-content-start align-items-center mb-4">
                                        <span class="flex-shrink-0 text-nowrap">Total Number of buildings:</span>
                                        <input type="text" class="form-control form-control--xs form-control--custom flex-grow-0 ml-3" placeholder="0"
                                            name="total_no_of_buildings" id="total_no_of_buildings" value="{{ isset($buldingNumber) ? $buldingNumber : '' }}" readonly />
                                    </div>
                                    <table id="one" class="table mb-0 table--box-input table1" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <input name="redirect_tab" type="hidden" value="two" />
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("one");' class="printBtn" style="max-width: 22px"></a>
                                        </div>
                                        <thead class="thead-default">
                                            <tr>
                                               <th >
                                                    तपशील
                                                </th>
                                                <th class="table-data--md" style = "width:50%">
                                                    रक्कम रु
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         
                                        @if($ol_application->table1)
                                        @php $i = 1; @endphp
                                            @foreach($ol_application->table1 as $data) 
                                                <tr>
                                                    <td style="width:70%">
                                                    <input type="hidden" name="table1[{{$i}}][hiddenId]" value="{{ isset($data['id']) ? $data['id'] : '' }}">

                                                    <textarea name="table1[{{$i}}][title]" class="form-control form-control--custom" 
                                                    style="width:100%; height:50px; resize: none;" readonly>{{ isset($data['title'])? $data['title'] : '' }}</textarea>

                                                        <!-- <input type="text" class="form-control form-control--custom" name="table1[{{$i}}][title]" value="{{ isset($data['title'])? $data['title'] : '' }}" readonly> -->
                                                    </td>
                                                    <td class="text-center"> 
                                                        <input type="text" class="form-control form-control--custom" name="table1[{{$i}}][amount]" value="{{ isset($data['amount'])? $data['amount'] : '' }}" readonly style="height:50px;width:100%;">
                                                    </td>
                                                </tr>  
                                            @php $i++; @endphp                                               
                                            @endforeach 
                                        @endif      
                                        </tbody>
                                    </table>                      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="two" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        अधिमूल्य रकमेचा चार सामान हफ्त्यांत भरणा करण्याबाबतचा प्रस्ताव
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                    <input name="redirect_tab" type="hidden" value="three" />
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto">
                                        <img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("two");'
                                                style="max-width: 22px" class="printBtn"></a>
                                    </div>
                                    <table class="table mb-0 table--box-input table2" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <thead class="thead-default">
                                            <tr>
                                               <th style = "width:50%">
                                                    तपशील
                                                </th>
                                                <th class="table-data--md" style = "width:50%">
                                                    रक्कम रु
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         
                                        @if($ol_application->table2)
                                        @php $i = 1; @endphp
                                            @foreach($ol_application->table2 as $data) 
                                                <tr>
                                                    <td style="width:70%">
                                                    <input type="hidden" name="table2[{{$i}}][hiddenId]" value="{{ isset($data['id']) ? $data['id'] : '' }}">

          <!--                                               <input type="text" class="form-control form-control--custom" name="table2[{{$i}}][title]" value="{{ isset($data['title'])? $data['title'] : '' }}" readonly> -->

                                                    <textarea name="table2[{{$i}}][title]" class="form-control form-control--custom" 
                                                    style="width:100%; height:50px; resize: none;" readonly>{{ isset($data['title'])? $data['title'] : '' }}</textarea>
                                                        
                                                    </td>
                                                    <td class="text-center" style="width:30%"> 
                                                        <input type="text" class="form-control form-control--custom" name="table2[{{$i}}][amount]" value="{{ isset($data['amount'])? $data['amount'] : '' }}" readonly style="height:50px;width:100%;">
                                                    </td>
                                                </tr>  
                                            @php $i++; @endphp                                               
                                            @endforeach
                                        @endif      
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="three" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        पहिल्या हप्त्याची रक्कम
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                    <input name="redirect_tab" type="hidden" value="four" />
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto">
                                        <img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("three");'
                                                style="max-width: 22px" class="printBtn"></a>
                                    </div>
                                    <table class="table mb-0 table--box-input table3" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <thead class="thead-default">
                                            <tr>
                                               <th style = "width:50%">
                                                    तपशील
                                                </th>
                                                <th class="table-data--md" style = "width:50%">
                                                    रक्कम रु
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         
                                        @if($ol_application->table3)
                                        @php $i = 1; @endphp
                                            @foreach($ol_application->table3 as $data) 
                                                <tr>
                                                    <td style="width:70%">
                                                    <input type="hidden" name="table3[{{$i}}][hiddenId]" value="{{ isset($data['id']) ? $data['id'] : '' }}">

                                                        <!-- <input type="text" class="form-control form-control--custom" name="table3[{{$i}}][title]" value="{{ isset($data['title'])? $data['title'] : '' }}" readonly> -->

                                                        <textarea name="table3[{{$i}}][title]" class="form-control form-control--custom" 
                                                    style="width:100%; height:50px; resize: none;" readonly>{{ isset($data['title'])? $data['title'] : '' }}</textarea>

                                                    </td>
                                                    <td class="text-center" style="width:30%"> 
                                                        <input type="text" class="form-control form-control--custom" name="table3[{{$i}}][amount]" value="{{ isset($data['amount'])? $data['amount'] : '' }}" readonly style="height:50px;width:100%;">
                                                    </td>
                                                </tr>  
                                            @php $i++; @endphp                                               
                                            @endforeach 
                                        @endif      
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="four" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        दुसऱ्या, तिसऱ्या आणि चौथ्या हप्त्याची रक्कम
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                    <input name="redirect_tab" type="hidden" value="five" />
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto">
                                        <img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("four");'
                                                style="max-width: 22px" class="printBtn"></a>
                                    </div>
                                    <table class="table mb-0 table--box-input table4" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <thead class="thead-default">
                                            <tr>
                                               <th style = "width:50%">
                                                    तपशील
                                                </th>
                                                <th class="table-data--md" style = "width:50%">
                                                    रक्कम रु
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         
                                        @if($ol_application->table4)
                                        @php $i = 1; @endphp
                                            @foreach($ol_application->table4 as $data) 
                                                <tr>
                                                    <td style="width:70%">
                                                    <input type="hidden" name="table4[{{$i}}][hiddenId]" value="{{ isset($data['id']) ? $data['id'] : '' }}">

                                                     <!--    <input type="text" class="form-control form-control--custom" name="table4[{{$i}}][title]" value="{{ isset($data['title'])? $data['title'] : '' }}" readonly> -->

                                                        <textarea name="table4[{{$i}}][title]" class="form-control form-control--custom" 
                                                    style="width:100%; height:50px; resize: none;" readonly>{{ isset($data['title'])? $data['title'] : '' }}</textarea>

                                                    </td>
                                                    <td class="text-center" style="width:30%"> 
                                                        <input type="text" class="form-control form-control--custom" name="table4[{{$i}}][amount]" value="{{ isset($data['amount'])? $data['amount'] : '' }}" readonly style="height:50px;width:100%;">
                                                    </td>
                                                </tr>  
                                            @php $i++; @endphp                                               
                                            @endforeach 
                                        @endif      
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="tab-pane" id="five" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        अधिमूल्य रकमेचा चार सामान हफ्त्यांत भरणा करण्याबाबतचा प्रस्ताव
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("five");' style="max-width: 22px" class="printBtn"></a>
                                </div>
                                <table class="table mb-0 table--box-input" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                    <thead class="thead-default">
                                        <tr>
                                            <th class="table-data--xs">
                                                #
                                            </th>
                                            <th>
                                                तपशील
                                            </th>
                                            <th class="table-data--md">
                                                रक्कम रु
                                            </th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr>
                                            <td style = "border-style: ridge;">1.</td>
                                            <td style = "border-style: ridge;">
                                                मंडळाकडे देकारपत्र जरी केल्याच्या दिनांकापासून पहिल्या सहा
                                                महिन्या पर्यंत भरणा करावयाची पहिल्या हफ्त्याची रक्कम
                                                <input type="hidden" class="form-control form-control--custom" name="table5[1][title]" value="within_6months">
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" type="text" class="form-control form-control--custom" name="table5[1][amount]" value="{{ isset($summary['within_6months']) ? $summary['within_6months'] : '' }}" readonly>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">2.</td>
                                            <td style = "border-style: ridge;">
                                                मंडळाकडे पहिले देकारपत्र जारी केल्याच्या दिनांकापासून एक
                                                वर्षाच्या आत, भरणा करावयाची दुसऱ्या हफ्त्याची रक्कम तसेच
                                                प्रत्यक्ष भरेपर्यंत प्रथम देकारपात्राच्या दिनांकापासून १२%
                                                (दार तिमाहीला परिगणनीय दराने) अधिक रकमेचा भरणा करावा लागेल
                                                <input type="hidden" class="form-control form-control--custom" name="table5[2][title]" value="within_1year">
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" type="text" class="form-control form-control--custom" name="table5[2][amount]" value="{{ isset($summary['within_1year']) ? $summary['within_1year'] : '' }}" readonly>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">3.</td>
                                            <td style = "border-style: ridge;">
                                                मंडळाकडे पहिले देकारपत्र जारी केल्याच्या दिनांकापासून दोन
                                                वर्षाच्या आत, भरणा करावयाची तीसऱ्या हफ्त्याची रक्कम तसेच
                                                प्रत्यक्ष भरेपर्यंत प्रथम देकारपात्राच्या दिनांकापासून १२%
                                                (दर तिमाहीला परिगणनीय दराने) अधिक रकमेचा भरणा करावा लागेल
                                                <input type="hidden" class="form-control form-control--custom" name="table5[3][title]" value="within_2year">
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" type="text" class="form-control form-control--custom" name="table5[3][amount]" value="{{ isset($summary['within_2year']) ? $summary['within_2year'] : '' }}" readonly>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">4.</td>
                                            <td style = "border-style: ridge;">
                                                मंडळाकडे पहिले देकारपत्र जारी केल्याच्या दिनांकापासून तीन
                                                वर्षाच्या आत, भरणा करावयाची चौथ्या हफ्त्याची रक्कम तसेच
                                                प्रत्यक्ष भरेपर्यंत प्रथम देकारपात्राच्या दिनांकापासून १२%
                                                (दर तिमाहीला परिगणनीय दराने) अधिक रकमेचा भरणा करावा लागेल
                                                <input type="hidden" class="form-control form-control--custom" name="table5[4][title]" value="within_3year">
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" type="text" class="form-control form-control--custom" name="table5[4][amount]" value="{{ isset($summary['within_3year']) ? $summary['within_3year'] : '' }}" readonly>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">5.</td>
                                            <td class="font-weight-bold" style = "border-style: ridge;">
                                                एकूण
                                                <input type="hidden" class="form-control form-control--custom" name="table5[5][title]" value="total">
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                <input style="border: none;" type="text" class="form-control form-control--custom" name="table5[5][amount]" value="{{ isset($summary['total']) ? $summary['total'] : '' }}" readonly>
                                            </td>
                                        </tr>  
                                    </tbody>
                                </table>                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="six" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-section__content mb-0 table-responsive">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column h-100 two-cols">
                                            <h3 class="section-title section-title--small">Download REE Note</h3>
                                                <!-- <span class="hint-text">Download  Note uploaded by REE</span> -->
                                                <div class="mt-auto">
                                                    @if(isset($reeNote->document_path))
                                                    <a href="{{config('commanConfig.storage_server').'/'.$reeNote->document_path}}"  target="_blank">

                                                        <button class="btn btn-primary">Download </button>
                                                    </a>
                                                    @else
                                                    <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                        * Note : REE note not available. </span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('calculation_sheet_js')
<script>
    $(".add-more").click(function(){
        var val = this.id;
        console.log(val);
        var id = $("#"+val+"_Ids").val();
        id++;
        $('.'+val+' tbody').append('<tr><td><input type="text" class="form-control form-control--custom" name="'+val+'['+id+'][title]" value="" required> </td><td class="text-center"><input type="text" class="form-control form-control--custom" name="'+val+'['+id+'][amount]" value="" required></td><td><i class="fa fa-trash" id="delete'+id+'" onclick="deleteRow(this.id);" aria-hidden="true" style="font-size: 20px;color: #b21c1c;cursor: pointer;"></i></td></tr>');

        $("#"+val+"_Ids").val(id);
        });

    $(".deleteBtn").click(function(){
        $(this).closest('tr').remove();
        var data = this.id.split("_");
        var id = data[1];
        var valName = data[0];
        $("#"+valName+"_deletedIds").val($("#"+valName+"_deletedIds").val() + '#'+ id);
    });

    function deleteRow(id){
        $("#"+id).closest('tr').remove();
    }

    function PrintElem(elem) {
        $(".printBtn").css("display","none");
        var printable = document.getElementById(elem).innerHTML;

       var mywindow = window.open('', 'PRINT', 'height=400,width=600');

        mywindow.document.write('<html><head><title>Maharashtra Housing and development authority</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(printable);
        mywindow.document.write('</body></html>');

        mywindow.document.close();
        mywindow.focus();

        mywindow.print();
        mywindow.close();
        $(".printBtn").css("display","block");
        return true;
    }    
</script>
@endsection