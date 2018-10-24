@extends('admin.layouts.app')
@section('css')

@section('content')

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0">
        <div class="d-flex">
            {{-- {{ Breadcrumbs::render('calculation_sheet',$ol_application->id) }} --}}
            <div class="ml-auto btn-list">
                <a href="javascript:void(0);" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#calculation-sale-price" role="tab"
                    aria-selected="false">
                    <i class="la la-cog"></i> Calculation of Sale Price
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#demarcation-plan" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i> Demarcation Plan
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#covering-letter" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i> Covering Letter
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <div class="tab-pane active show" id="calculation-sale-price" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-subheader">
                            <div class="d-flex align-items-center justify-content-center">
                                <h3 class="section-title text-uppercase">
                                    Statement
                                </h3>
                            </div>
                            <p>Building/Chawl No. <input class="letter-form-input letter-form-input--md" type="text" name="chawl_no" value=""> Consisting 
                            <input class="letter-form-input letter-form-input--md"
                                    type="text"  name="consisting" value="">
                             T/S Out of Project of 
                             <input class="letter-form-input letter-form-input--md"
                                    type="text" name="project_of" value="">
                            T/S Under 
                            <input class="letter-form-input letter-form-input--md"
                                    type="text" name="ts_under" value=""> 
                            Income Group at
                            <input class="letter-form-input letter-form-input--md"
                                    type="text" name="income_group" value=""></p>
                        </div>
                        <div class="m-section__content mb-0 table-responsive">
                            <form class="nav-tabs-form" role="form" method="POST" action="{{ route('ee.save_calculation_data') }}">
                            @csrf

                            <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
                                <table id="one" class="table mb-0 table--box-input" style="padding-top: 10px;">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                                src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("one");'
                                                style="max-width: 22px"></a>
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
                                                <input type="text" class="form-control form-control--custom" name="common_service_rate" value="" />
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>2.</td>
                                            <td>Date of Handling over Pump House & Under Ground Tank to Society</td>
                                            <td class="text-center">
                                                <input type="text" class="txtbox v_text form-control form-control--custom m-input m_datepicker" name="pump_house" id="pump_house" value="" aria-describedby="visit_date-error" aria-invalid="false" readonly>
                                            </td>
                                        </tr>                                       
                                         <tr>
                                            <td>3.</td>
                                            <td>The Plinith area of each tenement in Sq.Ft And Sq.Mtrs.</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="tenement_plinth_area" value="" />
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>4.</td>
                                            <td>The Carpet Area of each tenement in Sq.Ft.and Sq.Mtrs.</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="tenement_carpet_area" value="" />
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>5.</td>
                                            <td>The Plinth area of Building Sq.Ft and Sq.Mtrs</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="building_plinth_area" value="" />
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>6.</td>
                                            <td>The Carpet Area of Building in Sq.FT and Sq.Mtrs.</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="building_carpet_area" value="" />
                                            </td>
                                        </tr>                                        
                                        <tr>
                                            <td>7.1.</td>
                                            <td>Cost of Construction</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="" id=""
                                                    value="" />
                                            </td>
                                        </tr>                                       
                                         <tr>
                                            <td>7.2</td>
                                            <td>Premium of Land With Infrastructure (I.e Cost of land and Fillings) Lease Rent (Per Annum)</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="" id=""
                                                    value="" />
                                            </td>
                                        </tr>                                        
                                         <tr>
                                            <td></td>
                                            <td>The Final Sale price of the tenement</td>
                                            <td class="text-center">
                                                <input type="text" class="form-control form-control--custom" name="final_sale_price_tenement" value="" />
                                            </td>
                                        </tr>                                        
                                         <tr>
                                            <td>8</td>
                                            <td>The Date of Completion of the above Building/Chawl</td>
                                            <td class="text-center">
                                    
                                                <input type="text" class="txtbox v_text form-control form-control--custom m-input m_datepicker" name="completion_date" id="registration_date" value="" aria-describedby="visit_date-error" aria-invalid="false" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    <p>The Schedule of the Property</p>
                                    <p>All the Piece or Parcel of land bearing Plot/ Building No 
                                    <input class="letter-form-input letter-form-input--md" type="text" name="building_no" value="">
                                     Admeasuring 
                                    <input class="letter-form-input letter-form-input--md" type="text" name="admeasure" value="">
                                    Sq.mtrs. There about being S.No
                                     <input class="letter-form-input letter-form-input--md" type="text" name="s_no"
                                            value=""> 
                                    and C.T.S No <input class="letter-form-input letter-form-input--md"
                                            type="text" name="CTS_no" value="">
                                    Situated at <input class="letter-form-input letter-form-input--md" type="text" name="situated_at" value=""> 
                                    In the registrations district of 
                                    <input class="letter-form-input letter-form-input--md" type="text" name="district" value=""> District and Bounded that is to say.
                                    </p>
                                    <p>On or towards the North By: <input class="letter-form-input letter-form-input--md"
                                            type="text" name="north_dimension" value=""></p>
                                    <p>On or towards the South By: <input class="letter-form-input letter-form-input--md"
                                            type="text" name="south_dimension" value=""></p>
                                    <p>On or towards the West By: <input class="letter-form-input letter-form-input--md"
                                            type="text" name="west_dimension" value=""></p>
                                    <p>On or towards the East By: <input class="letter-form-input letter-form-input--md"
                                            type="text" name="east_dimension" value=""></p>
                                </div>
                                <div class="mt-auto">
                                    <button type="submit" class="btn btn-primary btn-custom">
                                    Submit</button>
                                </div>                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="demarcation-plan" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-subheader" style="padding: 0;">
                            <div class="d-flex align-items-center justify-content-center">
                                <h3 class="section-title">
                                    Demarcation Plan
                                </h3>
                            </div>
                        </div>
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Upload Demarcation Map</h5>
                                            <span class="hint-text">Click on 'Upload' to upload Demarcation Map</span>
                                            <form action="" method="post">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" name="" type="file" id="test-upload"
                                                        required="">
                                                    <label class="custom-file-label" for="test-upload">Choose
                                                        file...</label>
                                                </div>
                                                <div class="mt-auto">
                                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download Demarcation Map</h5>
                                            <span class="hint-text">Download demarcation Map in .dwg (Autocad) format</span>
                                            <div class="mt-auto">
                                                <button class="btn btn-primary">Download Map</button>
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
        <div class="tab-pane" id="covering-letter" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-subheader" style="padding: 0;">
                            <div class="d-flex align-items-center justify-content-center">
                                <h3 class="section-title">
                                    Covering Letter
                                </h3>
                            </div>
                        </div>
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Upload</h5>
                                            <span class="hint-text">Click on 'Upload' to upload letter</span>
                                            <form action="" method="post">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" name="" type="file" id="test-upload2"
                                                        required="">
                                                    <label class="custom-file-label" for="test-upload2">Choose
                                                        file...</label>
                                                </div>
                                                <div class="mt-auto">
                                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn2">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Click Download to download letter in .doc format.</span>
                                            <div class="mt-auto">
                                                <button class="btn btn-primary">Download Letter</button>
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
