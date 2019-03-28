@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.conveyance.dyco_department.action',compact('data'))
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
                Sale & Lease Deed Agreement</h3>
                 {{ Breadcrumbs::render('conveyance_draft_sale_lease',$data->id) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
        </div>
    </div> 
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#sale-deed-agreement" role="tab"
                    aria-selected="false">
                    <i class="la la-cog"></i> Sale Deed Agreement
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#lease-deed-agreement" role="tab"
                    aria-selected="true">
                    <i class="la la-bell-o"></i> Lease Deed Agreement
                </a>
            </li>
        </ul>
    </div>
<form class="nav-tabs-form" id ="agreementFRM" role="form" method="POST" action="{{ route('dyco.save_agreement')}}" enctype="multipart/form-data">
@csrf

<input type="hidden" name="applicationId" value="{{ isset($data) ? $data->id : '' }}">
    <div class="tab-content">
        <div class="tab-pane active show" id="sale-deed-agreement" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-section__content mb-0 table-responsive">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column h-100 two-cols">
                                                <h5>Generate</h5>
                                                <span class="hint-text">Click to Generate Sale Deed Agreement </span>
                                                <div class="mt-auto">
                                                    @if(isset($data->DraftGeneratedSale))
                                                     <Button type="button" class="s_btn btn btn-primary" data-toggle="modal" data-target="#myModal">
                                                            Edit </Button>
                                                    </a>
                                                    @else
                                                    <Button type="button" class="s_btn btn btn-primary" data-toggle="modal" data-target="#myModal">
                                                            Generate </Button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @if(isset($data->DraftGeneratedSale))
                                        <div class="col-sm-6 border-left">
                                            <div class="d-flex flex-column h-100 two-cols">
                                                <h5>Download</h5>
                                                <span class="hint-text">Click to download Sale Deed Agreement </span>
                                                <div class="mt-auto">
                                                    
                                                    <a href="{{ config('commanConfig.storage_server').'/'.$data->DraftGeneratedSale->document_path }}" target="_blank">
                                                    <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                            Download </Button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>  
            </div>   
            <!-- <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Click to download Sale Deed Agreement </span>
                                            <div class="mt-auto">
                                                @if(isset($data->DraftGeneratedSale))
                                                
                                                <a href="{{ config('commanConfig.storage_server').'/'.$data->DraftGeneratedSale->document_path }}" target="_blank">
                                                <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : Sale Deed Agreement is not available.</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Upload</h5>
                                            <span class="hint-text">Click to upload Sale Deed Agreement</span>
                                                <div class="custom-file">
                                                    <input class="custom-file-input sale_file" name="sale_agreement" type="file" id="test-upload1">
                                                
                                                        <label class="custom-file-label" for="test-upload1">Choose
                                                        file...</label>  
                                                    @if(isset($data->DraftSaleAgreement))

                                                       <input type="hidden" name="oldSaleFile" value="{{ $data->DraftSaleAgreement->document_path }}">
                                                            <a target="_blank" class="btn-link" href="{{ config('commanConfig.storage_server').'/'.$data->DraftSaleAgreement->document_path }}" download>Download</a> 
                                                    @endif 
                                                </div>
                                                <div class="mt-3">
                                                    <button type="submit" id="sale_btn" class="btn btn-primary mt-3 upload_btn" style="display:block">Upload</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Add Send to JT CO here -->
        </div>

        <div class="tab-pane" id="lease-deed-agreement" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-section__content mb-0 table-responsive">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column h-100 two-cols">
                                                <h5>Generate</h5>
                                                <span class="hint-text">Click to Generate Lease Deed Agreement </span>
                                                <div class="mt-auto">
                                                    @if(isset($data->DraftGeneratedLease))
                                                     <Button type="button" class="s_btn btn btn-primary" data-toggle="modal" data-target="#generateLeaseAgr">
                                                            Edit </Button>
                                                    </a>
                                                    @else
                                                    <Button type="button" class="s_btn btn btn-primary" data-toggle="modal" data-target="#generateLeaseAgr">
                                                            Generate </Button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @if(isset($data->DraftGeneratedLease))
                                        <div class="col-sm-6 border-left">
                                            <div class="d-flex flex-column h-100 two-cols">
                                                <h5>Download</h5>
                                                <span class="hint-text">Click to download Lease Deed Agreement</span>
                                                <div class="mt-auto">    
                                                    <a href="{{ config('commanConfig.storage_server').'/'.$data->DraftGeneratedLease->document_path }}" target="_blank">
                                                    <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                            Download </Button>
                                                    </a>  
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>  
            </div>  

            <!-- <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Click to download Lease Deed Agreement</span>
                                            <div class="mt-auto">
                                                @if(isset($data->DraftGeneratedLease))
                                                
                                                <a href="{{ config('commanConfig.storage_server').'/'.$data->DraftGeneratedLease->document_path }}" target="_blank">
                                                <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : Lease Deed Agreement is not available.</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 border-left">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Upload</h5>
                                            <span class="hint-text">Click to upload Lease Deed Agreement</span>
                                                <div class="custom-file">
                                                    <input class="custom-file-input" name="lease_agreement" type="file" id="test-upload2">
   
                                                    <label class="custom-file-label" for="test-upload2">Choose
                                                        file...</label>
                                                       @if(isset($data->DraftLeaseAgreement))
                                                       <input type="hidden" name="oldLeaseFile" value="{{ isset($data->DraftLeaseAgreement->document_path) ? $data->DraftLeaseAgreement->document_path : '' }}">
                                                            <a target="_blank" class="btn-link" href="{{ config('commanConfig.storage_server').'/'.$data->DraftLeaseAgreement->document_path }}" download>Download</a> 
                                                        @endif
                                                </div>
                                                <div class="mt-3">
                                                    <button type="submit" id="lease_btn" class="btn btn-primary mt-3 upload_btn" style="display:block">Upload</button>
                                                 </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    @if(count($data->AgreementComments) > 0)       
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body">
            <h3 class="section-title section-title--small">Remark History </h3>
                <div class="remark-body">
                    <div class="remarks-section">
                        <div class="m-scrollable m-scroller ps ps--active-y remarks-section-container"
                            data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">
                            @foreach($data->AgreementComments as $comment)
                                <div class="remarks-section__data">
                                    <p class="remarks-section__data__row"><span>Remark By {{ isset($comment->Roles->display_name) ?  $comment->Roles->display_name : '' }}</p>
                                    <p class="remarks-section__data__row"><span>Remark:</span><span>{{ isset($comment->remark) ? $comment->remark : '' }}</span></p>
                                </div>
                            @endforeach                                         
                        </div>
                    </div>
                </div>               
            </div>    
        </div> 
    @endif      
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body">
            <h3 class="section-title section-title--small">Remark</h3>
            <div class="col-xs-12 row">
                <div class="col-md-12">
                    <textarea rows="4" cols="63" name="remark"></textarea>
                    <button type="submit" id="remark_btn" class="btn btn-primary mt-3 upload_btn" style="display:block">Save</button>
                </div>
            </div>
        </div>
    </div>
 </form>   
</div>

<!-- Modal for generate sale  deed agreement-->
<div class="modal modal-large fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sale Deed Agreement</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="saleAgreement" action="{{ route('dyco.generateSaleLeaseAgreement') }}" method="POST">
                @csrf 
                 <input type="hidden" name="oldDraftSale" value="{{ isset($data->DraftGeneratedSale) ?  $data->DraftGeneratedSale->document_path : '' }}"> 

                 <input type="hidden" name="oldTextSale" value="{{ isset($data->textSaleAgreement) ?  $data->textSaleAgreement->document_path : '' }}">
                    <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
                     <textarea id="ckeditorText" name="saleAgreement" style="display: none;">
                        <div style="" id="">
                            <div style="padding-left: 15px;">
                            @if($saleContent != '')
                                {{$saleContent}}
                            @else
                                <p style="font-weight: bold; font-size: 16px; margin-bottom: 10px;">Subject:</p>
                                <div style="line-height: 2.0; padding-left: 20px;">
                                <p style="font-size: 15px;">THIS DEED OF SALE made at Mumbai this     day of         -2015 (Two Thousand Fifteen) between the Maharashtra Housing and Area Development Authority, a Statutory corporation constituted under the Maharashtra Housing and Area Development Act 1976, (Mah. XXVIII of 1977), (here in after  referred to as ‘the said Act’) having its office at Griha Nirman Bhavan, Kala Nagar, Bandra(East), Mumbai-400 051, the vendor (here in after referred to as ‘The Authority’ which expression shall unless the context requires otherwise include its successors and assigns)of the one part:</p>
                                <center><p> <b>AND</b></p></center>
                                
                                <p> <b> {{ isset($data->societyApplication) ? $data->societyApplication->name : '' }} </b> Co-operative Housing Society Ltd. A Co-operative society duly registered under the Maharashtra Co-operative Societies Act, 1960 (MAH. XXIV of 1961) and bearing registration No. <b> {{ isset($data->societyApplication) ? $data->societyApplication->registration_no : '' }} </b> dated __/__/____ and having its registered office at Bldg. No.___, _______ Nagar, _________, Mumbai- ________ the purchaser (hereinafter referred to as ‘the society’ which expression shall unless the context requires otherwise include its successors and permitted assigns) of the Other Part:</p>
                                <p>WHEREAS the Authority being duly constituted with effect from the 5th day of December, 1977 under Government Notification in the Public works and Housing Development No. ARD-1077 (1) Desk-44 dated the 5th December, 1977, the Maharashtra Housing Board a Corporation established underthe Mumbai Housing Board Act, 1948 (Bom LXLX of 1948) (hereinafter referred to as ‘the Board’) stood dissolved by operation of section 15 of the said Act :</p>
                                <p>AND WHEREAS, under clauses (a) and (b) of section 189 of the said Act all the property, rights, liabilities and obligations of the said dissolved Board including those arising under any agreement or contract have become the property, rights, liabilities and obligations of the Authority.</p>
                                <p>AND WHEREAS, The Government of India had formulated a Housing Scheme for the construction and allotment of tenements on rental basis to industrial workers known as the Subsidised Industrial Housing Scheme:</p>
                                <p>AND WHEREAS, the board had in pursuance of the said Government of India Scheme built the building bearing No.____ at Survey No. ____(Pt.) and C.T.S. No. _____(Part) at Village ______, ______ Nagar, _________, Mumbai- ________ (hereinafter referred to as ‘the said building’) and more particularly describe in Schedule I hereunder written for housing industrial workers as provided in that Scheme for residential use:</p>
                                <p>AND WHEREAS, the tenements in the said building were allotted to individual allot tees specified in Schedule-II hereunder written on rental basis for residential use:</p>
                                <p>AND WHEREAS persistent demand were made by the occupant industrial workers that the tenements constructed for them under the Subsidised Industrial Housing Scheme of the Government of India by the various housing Authorities should be sold to them:</p>
                                <p>AND WHEREAS the conference of the Housing Ministers of all the States held at Calcutta in December,1975 had recommended to the Government of India to consider the transfer to these tenements to the occupants on ownership basis by giving them opportunity to pay for these tenements in suitable installments as it was found that it was practically</p>
                                <p>impossible to dispossess superannuated workers or workers who have crossed the prescribed income limit and consequently have become ineligible for the retention of tenements in the occupation:</p>
                                <p>AND WHEREAS the Government of India after considering the entire problem have permitted the State Government to transfer such tenements on certain conditions laid down by the Government of India in this behalf:</p>
                                <p>AND WHEREAS on the basis of the guidelines laid down by the Government of India the Government of Maharashtra have inter-alia directed that the buildings built by the Housing Board and other agencies under certain schemes should be offered for sale in “as is and where is condition” to the authorised and unauthorised occupants whose occupation is regularised on their paying the penalty amounting to fifty percent(50%) of the cost of the tenements in lump sum for residential purpose on the basis of hire purchase after the occupants of such tenements have formed a Co-operative Housing Society:</p>
                                <p>AND WHEREAS, the said allot tees have formed themselves into a co-operative Housing Society called the ________________________ Co-operative Housing Society Ltd., the said society being the other party of these presents.</p>
                                <p>AND WHEREAS, the Authority as successor of the Board is the owner of and/or otherwise well and sufficient entitled to the said building and the said building is the absolute property of the Authority:</p>
                                <p>AND WEREAS, the Authority has at the request of the society decided to convey the said building more particularly described in schedule I hereunder written by way of sale and to grant the land underneath and appurtenant thereto by way of lease to the society subject to the terms, conditions and covenants hereinafter appearing and contained:</p>
                                <p>AND WHEREAS, in pursuance of such a decision the land underneath and appurtenant to the said building is being granted by the authority to the Society on a lease for a period of ninety/sixty years & renewable by every 30-30 years once/twice by a separate lease deed of even date between the Authority and the Society:</p>
                                <p>AND WHEREAS, the said building intended to be sold to the Society at the price of Rs. _________ (Rupees___________________Only) exclusive of the rebates given by the Government of India, Government of Maharashtra and the Authority from time to time and the said amount of Rs.______ (Rupees____________________________Only) being the sale price of the said building has been received by the Authority in full from time to time from the allottees and/or the Society (the receipt of which the Authority doth hereby admit and acknowledge).</p>
                                <p>AND WHEREAS, it is expedient to convey the right, title and interest of the Authority in the said building to the Society and the Authority hereby agree to convey and the Society hereby agrees to accept such conveyance by way of sale, the right, title and interest of the Authority in the said building on terms, conditions and covenants as are contained be hereinafter.</p>
                                <center><p><b>NOW THIS DEED OF SALE WITNESSESTH AS FOLLOWS:</b></p></center>
                                <p>1. In consideration of the payment of Rs. ______ (Rupees____________________________Only)  (exclusive of the rebates given by the Government of India, Government of Maharashtra and the Authority from time to time) paid by the allot tees and/or the Society to the Authority on or before the execution of these presents (the receipt of which sum of Rs. ______ (Rupees____________________________Only)  the Authority doth hereby admit and acknowledge) being the full consideration amount payable to the Authority, the Authority as the absolute owner hereby conveys grants and assures into the society by way of sale, all the property consisting of the ____ tenements in building bearing No.___ standing on the piece or parcel of land at S.No.___(Pt.) and C.T.S. No._____(Part) at village ________,________ Nagar, ___________ And more particularly described in the first schedule hereto and for clarity delineated on the plan hereto annexed and thereon shown by yellow colour together with all its appurtenance (such appurtenance not being land) and all the estate, rights, titles, interest use in heritance property possession benefit claim and demand of the Authority into out of and upon the same as against any other person whatsoever TOHAVE AND TO HOLD the said building as owner for residential use subject however to the terms, conditions, and covenants hereinafter appearing.</p>
                                <p>2. The said building till the time of execution of these presents has been  in possession of the said society and the Authority hereby covenants that the Society shall from the time of execution of these presents, continue to be in possession of the said building and hold and enjoy the same as owner there of without any interruption or disturbance by the Authority or any person claiming through or under the Authority subject, however to the terms and conditions and covenants incorporated in those presents.</p>
                                <p>3.The Authority hereby covenants with the society that the said building hereby sold is free from all encumbrances whatsoever except as stated herein and the Authority is entitled to sale and convey the same to the society in the manner aforesaid.</p>
                                <p>4. The Authority hereby agrees to do and execute and cause to be done and executed all such further and other acts, deeds, things, conveyance and assurance for better and more perfectly conveying and transferring the said building and every part thereof into the society as may be reasonably required by the society.</p>
                                <p>5. The society hereby expressly agrees that the land underneath and appurtenant to the said building is and continues to be property of the Authority and that the Society has no right, title or interest in the said land except the rights reserved under a separate lease in respect of such land to be executed between the Authority and the Society simultaneously with these presents.</p>
                                <p>6. The society shall, bear, pay and discharge all existing and future rates, taxes, assessments, duties impositions and outgoings whatsoever assessed, imposed and charged upon the said building provided that all the such taxes, rates, assessments, duties, impositions and outgoing shall, till the date of conveyance of the said building, be borne by the Authority, if there remain any arrears to this effect and any claims are made in respect thereof on the society by the Government local Authority or any other authority under any law for the time being in force in the State of Maharashtra, the society shall be entitled to call upon the Authority, to pay all such arrears, and the Authority agrees that it shall pay the same after due verification.</p>
                                <p>7. The society shall pay to the Authority such proportion to be fixed by the Authority of all expenses as may be determined by the Authority payable from time to time in respect of constructing repairing re-building and cleaning all party walls, party fences, party hedges sewerage drains gates road paths pavements and other things the use of which is common to the premises hereby sold and to the adjoining premises and also a proportion in respect of Charges for water supply and electric supply where separate meters in respect of such service have not been fitted to the premises hereby sold.  The society shall pay towards such proportion of such expenses in advances and on account sum of Rs. _______(Rupees_______________________Only) (tentative) at every quarter of the year the first of such payment paid upto _______, 20__ and the subsequent payment to be made on the first day of the first month of the quarter falling subsequent to the first payment provided such expenses are incurred in future with the full knowledge and consent of the society, if the said sum of Rs. _______(Rupees_______________________Only) to be paid by the Society towards expenses aforesaid shall remain unpaid for one month after becoming payable (whether demanded or not) the society shall pay such unpaid amount or part thereof together with interest there on at 18% p.a. remaining from the date when the sum becomes payable till the payment is made by the society any advance or otherwise to be paid by the society to this effect shall become payable by the society subject to the conditions aforesaid.  The Authority shall adjust such sums from time to time and render account thereof to the society within a reasonable time.  The society hereby agrees to join the federation of the Co-operative Housing Societies owning buildings in the above scheme which shall take over the management and maintenance of the common services aforesaid.</p>
                                <p>8. It is hereby agreed and declared that all moneys, sum dues and other charges payable under these presents shall be deemed to be arrears of rent payable in respect of the said building and shall be recoverable from the society in the same manner as arrears of the land revenue as provided in Section 180 of the said Act, as amended from time to time provided always that this clause shall not affect other rights, power and remedies of the Authority in this behalf.</p>
                                <p>9. It is hereby further agreed and declared that the society shall be by virtue of this sale deed acquired any right of light or air which would prejudice the free use and enjoyment of any adjoining land of the Authority for constructing building or for any other purposes whatsoever and that any enjoyment of light or air by the society or its successors in title from or over the adjoining land of the Authority shall be deemed to be had with the consent of the Authority.</p>
                                <p>10. All the costs including the stamp duty and registration charges of this Deed of Sale shall be borne by the society.</p>
                                <p>11. The Authority is exempted from payment of income tax under sub-section (20-A) of section 10 of the Income Tax Act, 1961 read with section 4 of the Finance Act, 1970.</p>
                                <p>12. It is hereby clarified that the said Buildings are having  
                                ______ Square feet i.e. ______ Square meter plinth area and ______ sq.ft. i.e. ______ sq.mtrs. Carpet area and is having a total of ___ tenements.  The plinth area of each tenement is ______ sq.ft. i.e. ______ Sq.mtrs.  The carpet area of each tenements is ______ Sq.ft. i.e. ______ sq.mtrs. and the value of each tenement is Rs. ______</p>
                                <p>IN WITNESS WHEREOF the signature of                      Shri._______________, Dy.CO (E.M.) Mumbai Housing and Area    Development Board, Mumbai for and on behalf of Maharashtra Housing And Area Development Authority has been set hereunder and the seal of the Authority has also been affixed and attested by the officer of the Authority, and the Signature of Shri._______________–Chairman, Shri._____________-Secretory and Shri.____________ Member of the Managing Committee of the Society for and on behalf of the Society under the Authority of the Society given to them to execute these presents for and on behalf of the Society vide Society’s General Body’s Resolution passed in its meeting held on __/__/____ And the seal of the Society has been affixed hereinto on the day and the year first herein above written. </p>
                                <center><p><b>SCHEDULE – 1</b></p></center>
                                <center><p><b>SCHEDULE OF PROPERTY ABOVE REFFERRED TO </b></p></center>
                                <p>All that the building No.____ having a multi storeyed structure situated on the land bearing Survey No.____(Pt.), C.T.S. No.____(Part) at Village________, ______ Nagar, ________, Mumbai- ________ in the registration Sub-District of Bandra Mumbai Suburban District area admeasuring _______ Sq.Mtrs. and bounded as follows:</p>
                                <p>That is to say:</p>
                                <p>On or towards the North by    :  </p>
                                <p>On or towards the West by     :  </p>   
                                <p>On or towards the South by    :  </p>   
                                <p>On or towards the East by     :</p>
                                <center><p><b>SCHEDULE – II</b></p></center>
                                <p>LIST OF BONAFIDE MEMBERS OF ________________________ CO.OP.HSG.SOC.LTD.</p>
                                <p>
                                    <table>
                                        <tr>
                                        <th>Sr.No </th>
                                        <th>T.No </th>
                                        <th>Name Of Tenant </th>
                                        <th>Carpet area of each tenement (Sq.mtrs.) </th>
                                        <th>Premium of land of each tenement.(In Rs.) </th>
                                        </tr>
                                        <tr>
                                            <td>  </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                        </tr>
                                    </table>
                                </p>
                                <p>SIGNED SEALED AND DELIVERED
                                By Shri._____________/ Dy. CO (E.M.)
                                Mumbai Housing and Area Develop-
                                ment Board Mumbai in presence of
                                Smt.___________________________
                                Mumbai Housing and Area Develop-
                                ment Board Mumbai.</p>
                                <p>Dy. CO (E.M.)
                                MUMBAI HOUSING & AREA
                                DEVELOPMENT BOARD,MUMBAI.</p>
                                <p>The common seal of the Maharashtra
                                Housing And Area Development 
                                Authority affixed in the presence of 
                                Smt.___________________________
                                Mumbai Housing and Area Develop-
                                ment Board has signed in token thereof
                                in the presence of Shri                  ____.</p>
                                <p>C.D.O.
                                MUMBAI HOUSING & AREA
                                DEVELOPMENT BOARD,MUMBAI.</p>
                                <p>SINGED SEALED AND DELIVERED
                                BY:</p>
                                <p>1.Shri/Smt ______________ (Chairman) </p>
                                <p>2Shri/Smt______________ (Secretary)</p>
                                <p>3 Shri/Smt______________Member of (Member)</p>
                                <p>The managing committee of the said                    
                                Society who have hereinto affixed   
                                Their signatures in the presence of
                                Shri  ______________  a Member of the Society</p>
                                <p>The Common Seal of the _________ Co-operative Housing 
                                Society Ltd. is affixed in the presence of  Shri.______________, Secretary who has signed in token thereof in the presence of 
                                Shri ______________  A member of ______________  the society.</p>
                                <p>DATED THIS  ___________ DAY OF __________ 2015</p>
                                <p>MAHARASHTRA HOUSING AND AREA DEVELOPMENT AUTHORITY </p>
                                <p>AND</p>
                                <p>THE ____________________ CO-OP. HSG.SOC.LTD.AT  BLDG.NO.___,_________________, ______________, MUMBAI- 400 ___. </p>
                                 <p>DEED OF SALE</p>
                                 <p>Shri. C.M. Vachasundar</p>
                                 <p>Legal Advisor,</p>
                                 <p>Maharashtra housing and Area Development Authority</p>
                                 <p>Mumbai – 400 051.</p>
                                <center><p><b>AFFIDAVIT CUM DECLARATION</b></p></center>
                                <p>I Mr. BABASAHEB DATTARAY JADHAV, an adult, Indian Inhabitant residing at "PRABHAT" Plot No.262-282, RSC-33, Gorai II, Borivali (W), Mumbai – 400 091, do hereby state on solemn affirmation as under :</p>
                                <p>1. I say that I am residing in the aforesaid address from last several years along with my family members.</p>
                                <p>2. I further say and declare that there are two issues out of said wed lock namely prajakta B.Jadhav born on 25/10/1986 and Pronav B Jadhav Born on 4/11/1991.</p> 
                                <p>3. I am making this Affidavit with a view to submit before the Concern authority to prove that there are two issues out of my said web lock.</p>
                                <p>Whatever is stated in the foregoing paras are true and correct to the best of my knowledge and belief if found incorrect I will be held liable u/s 199, 200 of I.P.C.</p>
                                <p>Solemnly affirm at Mumbai            )</p>
                                <p>This on dated 15th September 2010        ) Deponent</p> 
                                <p>t is hereby clarified that the said Buildings are having  
                                 ______ Square feet i.e. ______ Square meter plinth area and   
                                 ______ sq.ft. i.e. ______ sq.mtrs. Carpet area and is having a total 
                                 of ___ tenements.  The plinth area of each tenement is ______ 
                                 sq.ft. i.e. ______ Sq.mtrs.  The carpet area of each tenements is 
                                 ______ Sq.ft. i.e. ______ sq.mtrs. and the value of each tenement 
                                 is Rs. ______</p> 
                                 <p>It is hereby clarified that the said Buildings are having  
                                 ______ Square feet i.e. ______ Square meter plinth area and   
                                 ______ sq.ft. i.e. ______ sq.mtrs. Carpet area and is having a total 
                                 of ___ tenements.  The plinth area of each tenement is ______ 
                                 sq.ft. i.e. ______ Sq.mtrs.  The carpet area of each tenements is 
                                 ______ Sq.ft. i.e. ______ sq.mtrs. and the value of each tenement 
                                 is Rs. ______</p> 
                                 <p>It is hereby clarified that the said Buildings are having  
                             ______ Square feet i.e. ______ Square meter plinth area and   
                             ______ sq.ft. i.e. ______ sq.mtrs. Carpet area and is having a total 
                             of ___ tenements.  The plinth area of each tenement is ______ 
                             sq.ft. i.e. ______ Sq.mtrs.  The carpet area of each tenements is 
                             ______ Sq.ft. i.e. ______ sq.mtrs. and the value of each tenement 
                             is Rs. ______ </p>
                            @endif

                                </div> 
                                
                            </div>    
                        </div>
                    </textarea>
                    <input type="submit" class="btn btn-primary btn-custom" value="Submit">
                </form>    
            </div>
        </div>
    </div>
</div>

 <!-- Modal for generate lease deed agreement-->
<div class="modal modal-large fade" id="generateLeaseAgr" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lease Deed Agreement</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="saleAgreement" action="{{ route('dyco.generateSaleLeaseAgreement') }}" method="POST">
                @csrf 
                 <input type="hidden" name="oldDraftLease" value="{{ isset($data->DraftGeneratedLease) ?  $data->DraftGeneratedLease->document_path : '' }}">

                 <input type="hidden" name="oldtextLease" value="{{ isset($data->textLeaseAgreement) ?  $data->textLeaseAgreement->document_path : '' }}">
                    <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
                     <textarea id="ckeditorText1" name="leaseAgreement" style="display: none;">
                        <div style="" id="">
                            <div style="padding-left: 15px;">
                            @if($leaseContent != '')
                                    {{$leaseContent}}
                            @else
                                <p style="font-weight: bold; font-size: 16px; margin-bottom: 10px;">Subject:</p>
                                <div style="line-height: 2.0; padding-left: 20px;">
                                <p style="font-size: 15px;">THIS INDENTURE OF LEASE made at Mumbai this             -
                                Day of      2015 (Two Thousand Fifteen) between the MAHARASHTRA HOUSING AND AREA DEVELOPMENT AUTHORITY a statutory Corporation Constituted under the Maharashtra Housing and Area Development Act 1976, (Mah. XXVIII of 1977), ( hereinafter referred to as ‘the said Act’) having its office at Griha Nirman Bhavan, Kala Nagar, Bandra(East), Mumbai – 51, the lessor (hereinafter referred to as ‘The Authority’ which expression shall unless the context requires otherwise include its successors and assigns) of the One part:</p>
                                <center><p> <b>AND</b></p></center>
                                <p> <b> {{ isset($data->societyApplication) ? $data->societyApplication->name : '' }} </b> CO-OPERATIVE HOUSING SOCIETY LTD, a Co-operative Society duly registered under the Maharashtra Co-operative Societies Act, 1960 (Mah. XXIV of 1961) and bearing registration No. <b> {{ isset($data->societyApplication) ? $data->societyApplication->registration_no : '' }} </b> dated __/__/____ and having its registered office at Bldg. No.____, _______ Nagar, _________, Mumbai- _______.  The lessee (hereinafter referred to as ‘the Society’ which expression shall unless the context requires otherwise include its successors and permitted assigns) of the other part:</p>
                                <p>WHEREAS the authority being duly constituted with effect form the 5th day of December, 1977, under Government Notification in the Public works and Housing Department No. ARD 1077(1) Desk-44 dated 5th December, 1977, the Maharashtra Housing Board Act, 1948(Bom LXIX of 1948) (hereinafter referred to as ‘the Board’) stood dissolved by operation of section 15 of the said Act : </p>
                                <p>AND WHEREAS, under clauses (a) and (b) of Section 189 of the said Act all the property, rights, liabilities and obligations of the said dissolved Board including those arising under any agreement or contract have become the property, rights, liabilities and obligations of the Authority :</p>
                                
                                <p>AND WHEREAS, the Board was possessed or otherwise well and sufficiently entitled to a piece or parcel of land admeasuring ______ Sq. Meters situated at S.No._____(Pt.), C.S.No.________(Part) of village _________ being part of the Board’s land at ______ Nagar, __________, Mumbai- ________ in the registration sub district of Kurla Mumbai Suburban District and more particularly described in the Schedule hereinafter written and shown by red coloured boundary line on the plan hereto appended (hereinafter referred to as the said land). </p>

                                <p>AND WHEREAS, the said land has now become the property of the Authority and all rights, liabilities and obligations of the Board, as aforesaid in relation to the said land have become the rights, liabilities and obligations of the Authority:</p>

                                <p>AND WHEREAS, the building No.___ situated at ______ Nagar, ________ Mumbai consisting of _____ tenements constructed on the said land for residential use (hereinafter referred to as ‘the said building’) is being conveyed to the society by a Sale deed of even date between the Authority and the society and it is now expedient and necessary to lease the said land underneath and appurtenant to the said building to the said society:</p>

                                <p>AND WHEREAS, the Authority has agreed to lease the said land and the society has agreed to accept such lease for a period of ninety/sixty years & renewable by every 30-30 years once/twice with effect from the __/__/____ on the terms, conditions, rents and covenants hereinafter appearing.</p>

                                <p>AND WHEREAS, it is expedient and necessary to execute this indenture of lease in favour of the society in pursuance of the above mentioned agreement.</p>

                                <p>AND WHEREAS, before the execution of these presents the Society has paid a sum of Rs. _______ (Rupees_______________________Only) towards premium and Rs. ________(Rupees__________________________only) towards lease Rent for the period from __/__/____ to __/__/____ (the receipt of which the Authority doth hereby admit and acknowledge).</p>

                                 <center><p><b>NOW THIS INDENTURE OF LEASE WITHNESSETH AS FOLLOWS:</b></p></center>
                                <p>1. In consideration of the afore said sum of Rs. _______ (Rupees_______________________Only) towards premium and Rs. ________(Rupees__________________________only) towards lease Rent for the period from __/__/____ to __/__/____  paid by the Society to the Authority before the execution of these presents (the receipt of which the Authority before doth hereby admit and acknowledge) and in consideration of the Rent and covenants hereinafter reserved and contained the Authority doth hereby demise by way of lease into the Society the said land being a part of the Authority’s estate and shown on the plan annexed hereto and thereon bounded on red TO HAVE AND TO HOLD the said land for residential use for a term of ninety nine years commencing on the _____ day of _____ 1980 (hereinafter referred to as ‘the commencement date’) for residential use subject to the terms and conditions hereinafter mentioned yielding and paying therefore during the said terms a sum of Rs. _______ (Rupees_____________________only) per annum as lease Rent without any deduction to be paid in advance every year on or before the 5th day from the date on which the yearly terms begins every years at the office of the Authority or such other place as the Authority may from time to time specify in this behalf and intimate to the society;</p>


                                <p>2. The Society doth hereby covenant with the Authority in the following manner that is to say :-</p>

                                <p>a)To pay as aforesaid the lease Rent of Rs. _______ (Rupees_____________________only) in advance every year on or before the fifth day of the commencement of each year for which the same is payable in the manner aforesaid without any deduction or abetment whatsoever.</p>

                                <p>a. To pay interest on such amount of Lease Rent or any part thereof or any other dues to be paid by the society to the Authority as shall remain unpaid (whether formally demanded or not) for thirty days after the date on which the said amount or any part thereof or any other dues has or have become payable as aforesaid at the rate of 18 % per annum until the whole of such amount or dues has or have been paid.</p>

                                <p>b. To peacefully vacate the said land on the expiry of the term of the lease hereby agreed to be granted or the extended term or earlier determination of the lease as the case may be and hand over the possession of the same to the Authority in its them existing condition:</p>

                                <p>c. To abide by all rules regulation by-law and conditions now or at any time hereafter duly prescribed by the Government, Municipal Corporation of Greater Mumbai or of the Authority is so far as they relate to the said land:</p>

                                <p>d. To abide by and be bound by the provisions of the said Act and the rules and regulations and by-laws made under the said Act or under any law for the time being in force in so far as they relate to the said land:</p>

                                <p>e. To bear, pay and discharge all the present and future rates, taxes, ceases, assessments, duties and impositions and outgoings whatsoever assessed, imposed and charged upon the said land by the Government or the Municipal Corporation of Greater Mumbai or any other.  Local Authority or statutory body under any laws for the time being in force including all sanitary and water cesses of any kind whatsoever whether payable by the Authority or the society and all expenses relating thereto if any, and save and keep harmless and indemnified the Authority in respect thereof:</p>

                                <center><p><b>NOW THIS DEED OF SALE WITNESSESTH AS FOLLOWS:</b></p></center>
                                <p>f. The present property taxes comes to Rs._______ per year and non agricultural Taxes comes to Rs. ______/- per year.</p>

                                <p>g. To permit the Authority and its authorised agents at all reasonable time to enter upon the said land and buildings erected thereon for the purpose of collection of rent or any other dues or for any other lawful purposes :</p>

                                <p>h. Not to assign, sublet, underlet or otherwise transfer in any other manner whatsoever including parting with the possession of the whole or any part of said land or its interest there under or benefit of this lease to any person or persons or change the user of the said land or any part thereof without the previous written permission of the Authority:</p>

                                <p>i. To keep and maintain the open space of the said land in a clean neat and sanitary condition:</p>

                                <p>j. To pay full compensation to the Authority for any loss, damage or injury that may be caused to the said land or any part thereof by reason of the excessive user or any act of omission or commission on the part of the society its servant or others in its employment or of the visitors or any other persons coming to or on the said land or to the building and to indemnify the Authority on all such accounts:</p>

                                <p>k. It is agreed that lessee is entitled only to the floor space index (F.S.I.) consumed under the building conveyed to him.  Any unutilized FSI for the said land in excess of the said building or any additional FSI becoming available due to any change or modification in the DC Rules and Regulations at any point of time shall be the property of the Authority.  The lessee shall be entitled to make a request to the Authority for utilization of such additional or balance FSI.  Such request shall be considered on merits and on payment of additional premium and additional lease rent and on additional terms and conditions as determined by the Authority from time to time.</p>

                                <p>l. “That lessee shall abide by the terms and conditions vis-à-vis Development permission as well as Policies and Guidelines prescribed by the Authority in case Lessor decide to revise the layout as per modified DCR 33(5)”.</p>

                                <p>m. The lessee in case decide to redevelop the building under DCR 33(9) of the DC Regulation, 1981 shall obtain prior permission of the Authority for execution of the Scheme under DCR 33(9);</p>

                                <p>n. To use the plot as well as building standing thereon only for the residential purpose and not for any other use.</p>

                                <p>o. Not to do or suffer anything to be done on the said land which may cause damage, nuisance, annoyance or inconvenience to the occupiers of the adjacent premises or to the Authority or to the neighborhood.</p>

                                <p>3. The Authority hereby covenants with the society that on the society paying the rents hereby reserved and observing and complying with the duties and obligations of the society herein contained the society shall peacefully hold and enjoy the said land during the said term without any unlawful interruption by the Authority or any person claiming through or under the Authority.</p>

                                <p>4. The lessee hereby agreed that the lessee shall pay the dues towards service charges of the period from __/__/____ to __/__/____ in respect of the Bldg. No. __ situated on the land demised to the lessee, within a period of one year from the execution of this present with 18% interest thereon to the Authority, the authority reserves its legal rights to recover the said dues towards service charges from the lessee, as arrears of the land revenue as provided in section 67 and section 180 of the MHADA Act, 1976.</p>

                                <p>5. It is hereby agreed that the society shall so hold the said land TOGETHER WITH the right in common with the Authority and the occupiers of the adjoining premises of the Authority to use for all purpose the roads and passages made or hereafter to be made by or for the accommodation of the Authority the free passage and running of water and soil coming from any other building and land of the Authority and any other lessees of the Authority on the adjoining premises by in or through the channels, water courses made or to be made upon or under the said land or any of them or any part thereof.</p>

                                <p>6. The Authority shall at all times have power, without obtaining any consent of or making compensation to the society to deal as the Authority may think fit, with any of the lands and premises adjoining or opposite or adjacent to the said land and have power to erect or permit to be erected on such adjoining, opposite or adjacent lands or premises any building whatsoever whether such building shall, or shall not affect or diminish the light or air which may nor or any time during the term hereby granted be enjoyed by the society or the occupants of the said land or any part thereof and also have power to permit any such buildings to be used for any purposes which the Authority may approve.</p>

                                <p>7. It is hereby agreed and declared that all moneys, sums dues and other charges payable by the society under these presents shall be deemed to be arrears of rent payable in respect of the said land and shall be recoverable from the society in the same manner as arrears of land revenue as provided in the Sections 67 and 180 of the said Act as amended from time to time provided always that this clause shall not affect other rights, powers and remedies of the Authority in this behalf.</p>

                                <p>8. It is hereby also agreed that if the lease rent hereby reserved or any part thereof or other dues, if any together with interest thereon, if any, to be paid by the society shall be in arrears for ninety days after becoming payable (whether formally demanded or not) or if the society fails to observe any of the terms, conditions or covenants stipulated herein then and in any of the said events it shall be lawful for the Authority at any time thereafter by giving ninety days notice to terminate the lease forthwith and there upon re-enter upon and take possession of the said land and the building and other erections, fixtures materials, plants, chattels and effects thereupon and to hold and dispose of the same as the property of the Authority, as if this lease had not been entered into and without making to the society any compensation or allowances for the same.  It is hereby further agreed that the rights given by this clause shall be without prejudice to any other rights of action of the Authority in respect of any breach of the covenants herein contained by the society and it shall be lawful for the Authority to remove the society and all other persons in or upon the said land or any part thereof, and its effects there from without in any way being liable to any suit, action indictment or other proceedings for trespass damage or otherwise provided that if the society complies with the requirements of the aforesaid notice within the period stipulated in such notice or within such extended period as the Authority may permit in writing the Authority shall not exercise the said right of re-entry.</p>

                                <p>9. The said land is leased for a period of Ninety/Sixty years from the date of commencement i.e. __/__/____ and the lease shall be renewable by 30-30 years period once/twice on the terms and conditions determined by the Authority from time to time.</p>

                                <p>10. The Society shall comply all the legal requirements including payment of Stamp Duty required either for the purpose of Agreement with the allotees or for the purpose of utilization of TDR/Balance FSI in pursuance of NOC granted by the Mumbai Board. In case any complaint is received for non payment of stamp duty, registration of any documents required to be stamped in accordance with law, then the NOC is liable to be cancelled. The allottees/Society shall submit an Affidavit-cum-Undertaking to the effect that they will comply all the necessary legal requirements including payment of stamp duty and Registration charges.</p> 

                                <p>11. The Authority and the Society further agree that if during the tenure of this lease the society does not commit breach of any of the terms and conditions of these presents the lease may after the expiry of the period of ninety nine years may be renewable at the option of the Authority for such further period and on such terms and conditions as the Authority may deem fit.  The Society shall on the expiry of the term hereby reserved or of the term so renewed peacefully surrender the possession of the said land to the Authority.</p>

                                <p>12. Any notice intimation or demand required to be given or made by the Authority on the society under this deed of lease shall be deemed to be duly and properly given or made if given by the officer duly authorized by the Authority in that behalf and shall be deemed to be duly served if addressed to the society and delivered or affixed at the said land or at the address of the office of the society as stated herein-above and any notice to be given to the Authority will be sufficient served if addressed to the Vice President and Chief-Executive Officer of the Authority and delivered at his office.</p>

                                <p>13. The society shall bear and pay all costs, charges and expenses and professional charges of and incidental to the correspondence, preparation, execution and completion of this lease in duplicate thereof incurred by the Authority including stamp duty registration charges, out of pocket expenses and other outgoings in relation thereto and those occasioned to the Authority by reasons of any breach of terms conditions and covenants contained in these presents and for enforcing any right of the Authority under these presents.</p>

                                <p>14. The land under the building and the land appurtenant should construe to mean land which is required for setback, etc., of the building. Only these are leased to the Society. All other balance lands in a layout therefore would remain the property of MHADA. </p> 

                                <p> IN WITNESS WHEREOF THE signature of Shri. ____________ Dy. CO (E.M.), Mumbai Housing and area development Board, Mumbai for and on behalf of the Authority has been set hereunder and the seal of the Authority has been affixed and attested by the officer of the Authority and the signature of Shri._______________–Chairman, Shri._____________-Secretory and Shri.____________ -Member of the Managing Committee of the Society for and on behalf of the society have been set hereunder under the authority of the society given to them to execute these presents, for and on behalf of the society as provided in the society’s General Body’s Resolution passed in its meeting held on __/__/_____ and the seal of the society has been affixed hereinto on the day and the year first hereinabove written. </p> 

                                <center><p><b>SCHEDULE – I</b></p></center>

                                 <p>All that piece or parcel of land or ground of plot situated and lying underneath and appurtenant to building No.___ at Survey No.___ and City Survey No.____(Part) at ________________________ in the Registration sub-district of ________ and District of Mumbai City admeasuring _________ Sq. Meters of hereabout and bounded as follows that is to say:</p>

                                 <p>On or towards the North by    :  </p>
                                 <p>On or towards the West by     : </p>
                                 <p>On or towards the South by    :  </p>  
                                <p>On or towards the East by     : </p>

                                <center><p><b>SCHEDULE – II</b></p></center>
                                <p>LIST OF BONAFIDE MEMBERS OF ________________________ CO.OP.HSG.SOC.LTD.</p>
                                <p>
                                    <table>
                                        <tr>
                                        <th>Sr.No </th>
                                        <th>T.No </th>
                                        <th>Name Of Tenant </th>
                                        <th>Carpet area of each tenement (Sq.mtrs.) </th>
                                        <th>Premium of land of each tenement.(In Rs.) </th>
                                        </tr>
                                        <tr>
                                            <td>  </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                        </tr>
                                    </table>
                                </p>
                                <p>SEALED AND DELIVERED SIGNED </p>
                                <p>By Shri._____________/ Dy. CO (E.M.)</p>
                                <p>Mumbai Housing and Area Development Board Mumbai in presence of Shri __________________________ Mumbai Housing and Area Development Board Mumbai.</p>
                                <p>Dy. CO (E.M.) MUMBAI HOUSING & AREA DEVELOPMENT BOARD, MUMBAI.</p>
                                <p>The common seal of the Maharashtra Housing and Area Development Authority affixed in the presence of Shri __________________________ Mumbai Housing and Area Development Board has signed in token thereof in the presence of Shri  __________________________ </p>
                                <p>C.D.O. Dy. CO (E.M.) MUMBAI HOUSING AND AREA DEVELOPMENT BOARD </p>
                                <p>SINGED SEALED AND DELIVERED BY:</p>
                                <p>1.Shri/Smt______________-Chairman (Chairman)</p> 
                                <p>2Shri/Smt______________-Secretary (Secretary) </p>
                                <p>3 Shri/Smt______________Member of                 (Member)</p>
                                <p>The managing committee of the said                    
                                    Society who have hereinto affixed                    
                                    their signatures in the presence of
                                    Shri                                             a
                                    Member of the Society. </p>
                                <p>The Common Seal of the ________________________ Co-operative Housing Society Ltd. is affixed in the presence of Shri.__________________, Secretary who has signed in token thereof in the presence of 
                                Shri                                                .
                                A member of the society. </p>  
                                <p>DATED THIS           DAY OF       2015</p>
                                <p>MAHARASHTRA HOUSING AND AREA DEVELOPMENT AUTHORITY</p>
                                <p>AND</p>
                                <p>THE __________________________ </p>
                                <p>CO-OP. HSG.SOC.LTD.AT</p>
                                <p>BLDG.NO.___,_________________,</p>
                                <p>______________, MUMBAI- 400 ___.</p>
                                <p>INDENTURE OF LEASE</p>
                                <p>Shri. C.M. Vachasundar</p>
                                <p>Legal Advisor,</p>
                                <p>Maharashtra housing and Area </p>
                                <p>Development Authority</p>
                                <p>Mumbai – 400 051.</p>        
                                @endif
                                </div> 
                                
                            </div>    
                        </div>
                    </textarea>
                    <input type="submit" class="btn btn-primary btn-custom" value="Submit">
                </form>    
            </div>
        </div>
    </div>
</div>    

@endsection

@section('js')
<script>
$(".upload_btn").click(function(){
    var btn = this.id;
    if (btn == 'sale_btn'){ 
        $("#agreementFRM").validate({
            rules: {
                sale_agreement: {
                    required : true,
                    extension: "pdf"
                }          
            }, messages: {
                sale_agreement: {
                    extension: "Invalid type of file uploaded (only pdf allowed)."
                }
            }
        });
    } else if (btn == 'lease_btn'){
        $("#agreementFRM").validate({
            rules: {
                lease_agreement: {
                    required : true,
                    extension: "pdf"
                }          
            }, messages: {
                lease_agreement: {
                    extension: "Invalid type of file uploaded (only pdf allowed)."
                }
            }
        });
    } else if (btn == 'remark_btn'){
        $("#agreementFRM").validate({
            rules: {
                remark: {
                    required : true,
                }          
            }
        });
    }
});

</script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.replace('ckeditorText', {
        height: 700,
        allowedContent: true
    });    
    CKEDITOR.replace('ckeditorText1', {
        height: 700,
        allowedContent: true
    });

</script>
@endsection
