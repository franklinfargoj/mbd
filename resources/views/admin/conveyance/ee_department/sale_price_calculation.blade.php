@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.conveyance.ee_department.action'))
@endsection

@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

<div class="col-md-12"> 
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Sale Price Calculation </h3>
                 {{ Breadcrumbs::render('conveyance_ee_calculation',$data->id) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
        </div>
    </div>
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
            <li class="nav-item m-tabs__item sale-tabs" id="sale-1">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#calculation-sale-price" role="tab"
                    aria-selected="false">
                    <i class="la la-cog"></i> Calculation of Sale Price
                </a>
            </li>
            <li class="nav-item m-tabs__item sale-tabs" id="sale-2">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#demarcation-plan" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i> Demarcation Plan
                </a>
            </li>
            <li class="nav-item m-tabs__item sale-tabs" id="sale-3">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#covering-letter" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i> Covering Letter
                </a>
            </li>
        </ul>
    </div> 

    <div class="tab-content">
        <div class="tab-pane active show sale-1" id="calculation-sale-price" role="tabpanel">
        <form class="nav-tabs-form" role="form" class="form-horizontal" method="POST" action="{{ route('ee.save_calculation_data') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="redirect_tab" value="demarcation-plan">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table" id="calculation">
                        <div class="m-subheader">

                            Building/Chawl No. 
                            <input class="letter-form-input letter-form-input--md" type="text" name="chawl_no" value="{{ isset($data->ConveyanceSalePriceCalculation->chawl_no) ? $data->ConveyanceSalePriceCalculation->chawl_no : '' }}" style="border: none;border-bottom: 1px solid #212529;"> 
                            Consisting 
                            <input class="letter-form-input letter-form-input--md" type="text"  name="consisting" 
                            value="{{ isset($data->ConveyanceSalePriceCalculation->consisting) ? $data->ConveyanceSalePriceCalculation->consisting : '' }}" style="border: none;border-bottom: 1px solid #212529;">  
                             T/S Out of Project of 
                             <input class="letter-form-input letter-form-input--md"
                                    type="text" name="project_of" value="{{ isset($data->ConveyanceSalePriceCalculation->project_of) ? $data->ConveyanceSalePriceCalculation->project_of : '' }}" style="border: none;border-bottom: 1px solid #212529;">
                            T/S Under 
                            <input class="letter-form-input letter-form-input--md"
                                    type="text" name="ts_under" value="{{ isset($data->ConveyanceSalePriceCalculation->ts_under) ? $data->ConveyanceSalePriceCalculation->ts_under : '' }}" style="border: none;border-bottom: 1px solid #212529;">  
                            Income Group at
                            <input class="letter-form-input letter-form-input--md"
                                    type="text" name="income_group" value="{{ isset($data->ConveyanceSalePriceCalculation->income_group) ? $data->ConveyanceSalePriceCalculation->income_group : '' }}" style="border: none;border-bottom: 1px solid #212529;"> 
                        </div>
                        <div class="m-section__content mb-0 table-responsive">
                            
                            <input type="hidden" name="user_id" value="{{ (Auth::Id() != null ? Auth::Id() : '' ) }}">
                            <input type="hidden" name="application_id" value="{{ isset($data->id) ? $data->id : '' }}">
                                <table id="one" class="table mb-0 table--box-input" border="1" style="border-collapse: collapse; border-spacing: 0;"> 
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto">
                                        <img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("calculation");' class="printbtn" style="max-width: 22px"></a>
                                    </div>
                                    <thead class="thead-default">
                                        <tr>
                                            <th class="table-data--xs">
                                                Sr. No
                                            </th>
                                            <th>
                                                Particulars
                                            </th>
                                            <th class="table-data--md">
                                                Remarks & Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>Rate of Charges(With Detailed Working in Support thereof) for common
                                                service with reference to the common service with reference to the
                                                common service being rendered by the board</td>
                                            <td class="text-center">
                                                <input type="text" style="border: none;" class="form-control form-control--custom" name="common_service_rate" value="{{ isset($data->ConveyanceSalePriceCalculation->common_service_rate) ? $data->ConveyanceSalePriceCalculation->common_service_rate : '' }}" />
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>2.</td>
                                            <td>Date of Handling over Pump House & Under Ground Tank to Society</td>
                                            <td class="text-center">
                                                <input type="text" style="border: none;" class="txtbox v_text form-control form-control--custom m-input m_datepicker" name="pump_house" id="pump_house" value="{{ isset($data->ConveyanceSalePriceCalculation->pump_house) ? date('d-m-Y',strtotime($data->ConveyanceSalePriceCalculation->pump_house)) : '' }}" aria-describedby="visit_date-error" aria-invalid="false" readonly >
                                            </td>
                                        </tr>                                       
                                         <tr>
                                            <td>3.</td>
                                            <td>The Plinith area of each tenement in Sq.Ft And Sq.Mtrs.</td>
                                            <td class="text-center">
                                                <input type="text" style="border: none;" class="form-control form-control--custom" name="tenement_plinth_area" value="{{ isset($data->ConveyanceSalePriceCalculation->tenement_plinth_area) ? $data->ConveyanceSalePriceCalculation->tenement_plinth_area : '' }}" />
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>4.</td>
                                            <td>The Carpet Area of each tenement in Sq.Ft.and Sq.Mtrs.</td>
                                            <td class="text-center">
                                                <input type="text" style="border: none;" class="form-control form-control--custom" name="tenement_carpet_area" value="{{ isset($data->ConveyanceSalePriceCalculation->tenement_carpet_area) ? $data->ConveyanceSalePriceCalculation->tenement_carpet_area : '' }}"  />
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>5.</td>
                                            <td>The Plinth area of Building Sq.Ft and Sq.Mtrs</td>
                                            <td class="text-center">
                                                <input type="text" style="border: none;" class="form-control form-control--custom" name="building_plinth_area" value="{{ isset($data->ConveyanceSalePriceCalculation->building_plinth_area) ? $data->ConveyanceSalePriceCalculation->building_plinth_area : '' }}"/>
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>6.</td>
                                            <td>The Carpet Area of Building in Sq.FT and Sq.Mtrs.</td>
                                            <td class="text-center">
                                                <input type="text" style="border: none;" class="form-control form-control--custom" name="building_carpet_area" value="{{ isset($data->ConveyanceSalePriceCalculation->building_carpet_area) ? $data->ConveyanceSalePriceCalculation->building_carpet_area : '' }}" />
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>7.1.</td>
                                            <td>Cost of Construction</td>
                                            <td class="text-center">
                                                <input type="text" style="border: none;" class="form-control form-control--custom" 
                                                name="construction_cost" value="{{ isset($data->ConveyanceSalePriceCalculation->construction_cost) ? $data->ConveyanceSalePriceCalculation->construction_cost : '' }}" />
                                            </td>
                                        </tr>                                       
                                         <tr>
                                            <td>7.2</td>
                                            <td>Premium of Land With Infrastructure (I.e Cost of land and Fillings) Lease Rent (Per Annum)</td>
                                            <td class="text-center">
                                                <input type="text" style="border: none;" class="form-control form-control--custom" name="land_premiun_infrastructure" value="{{ isset($data->ConveyanceSalePriceCalculation->land_premiun_infrastructure) ? $data->ConveyanceSalePriceCalculation->land_premiun_infrastructure : '' }}" />
                                            </td>
                                        </tr>                                        
                                         <tr>
                                            <td></td>
                                            <td>The Final Sale price of the tenement</td>
                                            <td class="text-center">
                                                <input type="text" style="border: none;" class="form-control form-control--custom" name="final_sale_price_tenement" value="{{ isset($data->ConveyanceSalePriceCalculation->final_sale_price_tenement) ? $data->ConveyanceSalePriceCalculation->final_sale_price_tenement : '' }}" />
                                            </td>
                                        </tr>                             
                                         <tr>
                                            <td>8</td>
                                            <td>The Date of Completion of the above Building/Chawl</td>
                                            <td class="text-center">
                                    
                                                <input type="text" style="border: none;" class="txtbox v_text form-control form-control--custom m-input m_datepicker" name="completion_date" id="registration_date" value="{{ isset($data->ConveyanceSalePriceCalculation->completion_date) ? date('d-m-Y',strtotime($data->ConveyanceSalePriceCalculation->completion_date)) : '' }}" aria-describedby="visit_date-error" aria-invalid="false" readonly >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    <p>9. The Schedule of the Property</p>
                                    <p>All the Piece or Parcel of land bearing Plot/ Building No 
                                     <input class="letter-form-input letter-form-input--md" type="text" name="building_no" value="{{ isset($data->ConveyanceSalePriceCalculation->building_no) ? $data->ConveyanceSalePriceCalculation->building_no : '' }}" style="border: none;border-bottom: 1px solid #212529;">
                                     Admeasuring 
                                    <input class="letter-form-input letter-form-input--md" type="text" name="admeasure" value="{{ isset($data->ConveyanceSalePriceCalculation->admeasure) ? $data->ConveyanceSalePriceCalculation->admeasure : '' }}" style="border: none;border-bottom: 1px solid #212529;">
                                    Sq.mtrs. There about being S.No
                                     <input class="letter-form-input letter-form-input--md" type="text" name="s_no"
                                            value="{{ isset($data->ConveyanceSalePriceCalculation->s_no) ? $data->ConveyanceSalePriceCalculation->s_no : '' }}" style="border: none;border-bottom: 1px solid #212529;"> 

                                    and C.T.S No 
 
                                    <input class="letter-form-input letter-form-input--md" type="text" name="CTS_no" value="{{ isset($data->ConveyanceSalePriceCalculation->CTS_no) ? $data->ConveyanceSalePriceCalculation->CTS_no : '' }}" style="border: none;border-bottom: 1px solid #212529;">
                                    Situated at 

                                    <input class="letter-form-input letter-form-input--md" type="text" name="situated_at" value="{{ isset($data->ConveyanceSalePriceCalculation->situated_at) ? $data->ConveyanceSalePriceCalculation->situated_at : '' }}" style="border: none;border-bottom: 1px solid #212529;"> 
                                    In the registrations district of 
                                    <input class="letter-form-input letter-form-input--md" type="text" name="district" value="{{ isset($data->ConveyanceSalePriceCalculation->district) ? $data->ConveyanceSalePriceCalculation->district : '' }}" style="border: none;border-bottom: 1px solid #212529;"> District and Bounded that is to say.
                                    </p>
                                    <p>On or towards the North By: <input class="letter-form-input letter-form-input--md"
                                            type="text" name="north_dimension" value="{{ isset($data->ConveyanceSalePriceCalculation->north_dimension) ? $data->ConveyanceSalePriceCalculation->north_dimension : '' }}" style="border: none;border-bottom: 1px solid #212529;"></p>

                                    <p>On or towards the South By:

                                     <input class="letter-form-input letter-form-input--md"
                                            type="text" name="south_dimension" value="{{ isset($data->ConveyanceSalePriceCalculation->south_dimension) ? $data->ConveyanceSalePriceCalculation->south_dimension : '' }}" style="border: none;border-bottom: 1px solid #212529;"></p>
                                    <p>
                                    On or towards the West By: 

                                    <input class="letter-form-input letter-form-input--md"
                                            type="text" name="west_dimension" value="{{ isset($data->ConveyanceSalePriceCalculation->west_dimension) ? $data->ConveyanceSalePriceCalculation->west_dimension : '' }}" style="border: none;border-bottom: 1px solid #212529;"></p>
                                    <p>On or towards the East By: 

                                    <input class="letter-form-input letter-form-input--md"
                                            type="text" name="east_dimension" value="{{ isset($data->ConveyanceSalePriceCalculation->east_dimension) ? $data->ConveyanceSalePriceCalculation->east_dimension : '' }}" style="border: none;border-bottom: 1px solid #212529;"></p>
                                </div>
                            
                        </div>
                    </div>
                    <div class="mt-auto">
                        <button type="submit" class="btn btn-primary btn-custom">
                        Submit</button>
                    </div>                                
                    <!-- place -->
                </div>
            </div>
        </form>    
        </div>

        <div class="tab-pane sale-2" id="demarcation-plan" role="tabpanel">
        <form class="nav-tabs-form" role="form" id="demarcationFRM" name="demarcationFRM" method="POST" class="form-horizontal" action="{{ route('ee.save_demarcation_plan') }}" enctype="multipart/form-data">
        
        @csrf
        <input type="hidden" name="redirect_tab" value="demarcation-plan">
            <input type="hidden" name="application_id" value="{{ isset($data->id) ? $data->id : '' }}">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">

                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Download demarcation Map</span>
                                            <div class="mt-auto">
                                                @if(isset($data->ConveyanceSalePriceCalculation->demarcation_map))

                                                <input type="hidden" name="oldFileName" value="{{ $data->ConveyanceSalePriceCalculation->demarcation_map }}">
                                                <a href="{{ config('commanConfig.storage_server').'/'.$data->ConveyanceSalePriceCalculation->demarcation_map }}" target="_blank">

                                                    <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : Demarcation Map is not available.</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Upload</h5>
                                            <span class="hint-text">Click to upload Demarcation Map</span>
                                            <form action="" method="post">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" name="demarcation_plan" type="file" id="test-upload"
                                                        required="">
                                                    <label class="custom-file-label" for="test-upload">Choose
                                                        file...</label>
                                                </div>
                                                <div class="mt-auto" style="margin-top: 13px !important;">
                                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div> 
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>    
        </div>
        <div class="tab-pane sale-3" id="covering-letter" role="tabpanel">
        <form class="nav-tabs-form" role="form" name="CoveringFRM" id="CoveringFRM" method="POST" class="form-horizontal" action="{{ route('ee.save_covering_letter') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="redirect_tab" value="covering-letter">
            <input type="hidden" name="application_id" value="{{ isset($data->id) ? $data->id : '' }}">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 ">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Click to download letter.</span>
                                            <div class="mt-auto">
                                                @if(isset($data->ConveyanceSalePriceCalculation->ee_covering_letter))

                                                <input type="hidden" name="oldFileName" value="{{ $data->ConveyanceSalePriceCalculation->ee_covering_letter }}">
                                                <a href="{{ config('commanConfig.storage_server').'/'.$data->ConveyanceSalePriceCalculation->ee_covering_letter }}" target="_blank">

                                                    <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : Covering Letter is not available.</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Upload</h5>
                                            <span class="hint-text">Click on 'Upload' to upload letter</span>
                                            <form action="" method="post">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" name="covering_letter" type="file" id="test-upload2">
                                                    <label class="custom-file-label" for="test-upload2">Choose
                                                        file...</label>
                                                </div>
                                                <div class="mt-auto" style="margin-top: 13px !important;">
                                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>    
        </div>
    </div>
</div>
@endsection

@section('js')
    <script> 

    function PrintElem(elem) {

        $("#"+elem+"_btn").css("display","none");
        $(".printbtn").css("display","none");
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
        $(".printbtn").css("display","block");
        $("#"+elem+"_btn").css("display","block");

        return true;
    } 

    $("#demarcationFRM").validate({
        rules: {
            demarcation_plan: {
                required: true,
                extension: "pdf"
            },
        }, messages: {
            demarcation_plan: {
                extension: "Invalid type of file uploaded (only pdf allowed)."
            }
        }
    });  

    $("#CoveringFRM").validate({
        rules: {
            covering_letter: {
                required: true,
                extension: "pdf"
            },
        }, messages: {
            covering_letter: {
                extension: "Invalid type of file uploaded (only pdf allowed)."
            }
        }
    }); 

        $(document).ready(function () {

        // **Start** Save tabs location on window refresh or submit

        // Set first tab to active if user visits page for the first time

        if (localStorage.getItem("activeTab") === null) {
            document.querySelector(".nav-link.m-tabs__link").classList.add("active", "show");
        } else {
            document.querySelector(".nav-link.m-tabs__link").classList.remove("active", "show");
        }

        if (location.hash) {
            $('a[href=\'' + location.hash + '\']').tab('show');
        }
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('a[href="' + activeTab + '"]').tab('show');
        }

        $('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
            e.preventDefault()
            var tab_name = this.getAttribute('href')
            if (history.pushState) {
                history.pushState(null, null, tab_name)
            } else {
                location.hash = tab_name
            }
            localStorage.setItem('activeTab', tab_name)

            $(this).tab('show');

            localStorage.clear();
            return false;
        });

        $(window).on('popstate', function () {
            var anchor = location.hash ||
                $('a[data-toggle=\'tab\']').first().attr('href');
            $('a[href=\'' + anchor + '\']').tab('show');
            window.scrollTo(0, 0);
        });
     });          

    </script>

@endsection    
