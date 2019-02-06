<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NOC</title>
</head>
    
<body>
    <div class="m_portlet">
        <form id="OfferLetterFRM" action="{{ route('ree.save_draft_noc')}}" method="post">
            @csrf
            <input type="hidden" id="applicationId" name="applicationId" value="{{$applicatonId}}">
            <textarea id="ckeditorText" name="ckeditorText" style="display:none">
                @if($content != "") {{$content}} @else
                <div style="" id="">

                    <!-- Header starts here -->
                    <div>
                        <div style="margin-top: 30px; text-align: right;">
                            <div style="float: left; width: 56%;"></div>
                            <div style="float: left; width: 44%;">
                                <div style="text-align: left;">
                                    <span>CO/MB/REE/NOC/F-1004/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/2018</span>
                                </div>
                                <div style="text-align: left;">
                                    <span>Date:</span>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <h3 style="text-decoration: underline; text-align: center;">NOC</h3>
                        <p> </p>
                        <div style="margin-top: -15px;">
                            <p style="margin-bottom:0; line-height:0.25;">To,</p>
                            <p style="margin-bottom:0; line-height:0.25;">The Executive Engineer,</p>
                            <p style="margin-bottom:0; line-height:0.25;">Building Permission Cell,</p>
                            <p style="margin-bottom:0; line-height:0.25;">Greater Mumbai, MHADA,</p>
                            <p style="margin-bottom:0; line-height:0.25;">Bandra (E),Mumbai 400 051.</p>
                            <!-- <p style="margin-bottom:0; line-height:0.25;">Mumbai - 400 083.</p> -->
                        </div>
                    </div> 

                    <!-- Header ends here -->

                    <!-- Subject starts here -->

                    <div style="padding-left: 50px; margin-top: 30px; line-height: 1.5;">

                        <table style="width: 100%; border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td valign="top" style="border: 1px solid #000; text-align: center; padding: 5px;">Sub:</td>
                                    <td valign="top" style="border: 1px solid #000; padding: 5px;">
                                        N. O. C. for proposed redevelopment of existing Building No. <span style="font-weight: bold;"> {{($model->eeApplicationSociety->building_no ? $model->eeApplicationSociety->building_no : '________')}} </span>, known as <span style="font-weight: bold;"> {{($model->eeApplicationSociety->name ? $model->eeApplicationSociety->name : '')}} ( {{($model->eeApplicationSociety->address ? $model->eeApplicationSociety->address : '________')}} )</span> under DCR 33(5) dated 08.10.2013 & it's modification dtd. 03.07.2017.
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" style="border: 1px solid #000; text-align: center; padding: 5px;">Ref:</td>
                                    <td valign="top" style="border: 1px solid #000; padding: 5px;">
                                        <span style="display: block; margin-bottom: 4px;">1. This Office Offer letter No.  <span style="font-weight: bold;">{{($model->request_form->offer_letter_number ?$model->request_form->offer_letter_number:'________')}}</span>, Dated <span style="font-weight: bold;">{{($model->request_form->offer_letter_date ? date('d-m-Y',strtotime($model->request_form->offer_letter_date)) : '________')}} </span></span>
                                        <span style="display: block;">2. Society's letter dated <span style="font-weight: bold;"> {{($model->request_form->created_at ? date('d-m-Y',strtotime($model->request_form->created_at)) : '________')}}. </span></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--  -->
                    <!-- Subject ends here -->

                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        Sir,
                    </p>
                    <p lang="en-GB">
                        The applicant has complied requisites for obtaining No Objection Certificate (NOC) for allotment of additional buildable area &amp; pro-rata BUA of layout for redevelopment of their building under subject. There is no objection of this office to his undertaking construction as per the proposal of the said society under certain terms and conditions.
                    </p>
                    <p lang="en-GB">
                        Allotment of additional BUA approved and allotted by this NOC is as under:
                    </p>
                    <ol type="i">
                        <li> 
                            <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                The above allotment is on sub-divided plot as per lease deed admeasuring about <strong>{{ isset($calculationData) ? $calculationData->area_as_per_lease_agreement : '________' }} m<sup>2</sup></strong> (Lease Area). The total built up area should be permitted up to existing BUA <strong>{{ isset($calculationData) ? $calculationData->existing_construction_area : '________'}} m<sup>2</sup></strong> + <strong>{{ isset($calculationData) ? $calculationData->proratata_construction_area : '________'}} m<sup>2</sup></strong> (for residential use) [i.e. ________ m<sup>2</sup> in the form of additional BUA + ___________ m<sup>2</sup> in the form of balance built up area of layout (Pro-rata)] to be allotted now thus total BUA = <strong>{{ isset($calculationData) ? $calculationData->total_permissible_construction_area : '________'}} m<sup>2</sup></strong> only.
                            </p>
                        </li>
                        <li>
                            <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                Allotment of total BUA of <strong>{{ isset($calculationData) ? $calculationData->total_permissible_construction_area : '________'}} m<sup>2</sup></strong> (for residential use) is permitted for I.O.D./ I.O.A. purpose only.
                            </p>
                        </li>
                        <li>
                            <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                Since the Society has paid first installment i.e. 25 % amount of premium towards additional built up area of <strong>{{ isset($calculationData) ? $calculationData->proratata_construction_area : '________'}} m<sup>2</sup></strong> as per A.R. Resolution 6749, Dt. 11.07.2017, hence Commencement certificate shall be issued for<strong>________ </strong>m<sup>2 </sup>(for Residential use) <sup> </sup>[i.e. <strong>________ </strong>m<sup>2 </sup>permitted through this NOC. (Proportionate to the first installment paid by the Society as per offer letter under reference no. 1) and <strong>{{ isset($calculationData) ? $calculationData->existing_construction_area : '________'}} m<sup>2</sup></strong> Existing Built up area.
                            </p>
                        </li>
                    </ol>
                    <p lang="en-GB">
                        The NOC is granted as per policy laid down by the MHADA vide MHADA Resolution Nos. 6260 Dt.04/06/2007, A. R. No. 6397 dated 5/05/2009 , A. R. No. 6422 dated 07.08.2009 and A.R. no. 6749, Dt. 11/07/2017 and circular dated 16/06/2011 &amp; 21/12/2011 subject to following conditions. The other additional terms and conditions as per Annexure-I shall also apply &amp; are appended separately.
                    </p>
                    <center>
                        <table style="width: 720px; border-collapse: collapse;" border="1">
                            <tbody>
                                <tr valign="top">
                                    <td style="width: 50px;">
                                        <ol start="1">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td style="width: 670px;">
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The work of redevelopment should be carried out as per plans submitted to this office along with detailed proposal, as per prior approval of EE,BP Cell, Greater Mumbai / MHADA.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td>
                                        <ol start="2">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td>
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            Necessary Approvals to the plans from EE,BP Cell, Greater Mumbai / MHADA should be obtained before starting of work.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td>
                                        <ol start="3">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td>
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The work should be carried out under the supervision of the Competent Registered Architect and Licensed Structural Engineer.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td>
                                        <ol start="4">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td>
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The work should be carried out entirely at applicant’s own risk and cost and MHADA Board will not be responsible for any mishap or irregularity at any time.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td>
                                        <ol start="5">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td>
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            <strong>
                                                The built up area permitted as per statement below.
                                            </strong>
                                        </p>
                <!-- Table 1 starts here -->
                                    @if($custom == '1')
                                    <div>
                                        <h3 align="center" style="text-transform: uppercase; font-weight: bold; text-decoration: underline;">Table-1</h3>
                                        <table style="width: 100%; text-align: center; border-collapse: collapse;">
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th style="width: 4%; border: 1px solid #000; padding: 5px 10px">Sr.No</th>
                                                    <th style="width: 65%; border: 1px solid #000; padding: 5px 10px">Particular</th>
                                                    <th style="border: 35% solid #000; padding: 5px 10px">Amount in Rs.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php $i = 1; @endphp
                                            @foreach($table1 as $value)
                                                
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">{{$i}}</td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">{{ isset($value['title']) ? $value['title'] : '' }}</td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"> <span style="font-weight: bold">{{ isset($value['amount']) ? $value['amount'] : '' }} </td>
                                                </tr> 
                                            @php $i++; @endphp
                                            @endforeach    
                                            </tbody>
                                        </table>
                                    </div>                          
                                    @else
                                    <div>

                                        <h3 style="text-transform: uppercase; font-weight: bold; text-decoration: underline; text-align: center;">Table-1</h3>
                                        <table style="width: 100%; text-align: center; border-collapse: collapse;">
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th style="width: 10%; border: 1px solid #000; padding: 5px 10px">Sr.No</th>
                                                    <th style="width: 65%; border: 1px solid #000; padding: 5px 10px">Particular</th>
                                                    <th style="width: 35%; border: 1px solid #000; padding: 5px 10px">Amount in Rs.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">1.</td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Scrutiny Fees (
                                                        Residential Use )</td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"> <span style="font-weight: bold">{{(isset($calculationData) ? $calculationData->scrutiny_fee : '')}} </td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">2.</td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Debris Removal Rs.
                                                        6600/- Per Bldg.</td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold">{{(isset($calculationData) ? $calculationData->debraj_removal_fee : '')}} </span></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">3.</td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Layout approval
                                                        fees (Rs. 1,000/- X 32 T/s)</td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold"> {{ isset($calculationData) ? $calculationData->layout_approval_fee : '' }} </span></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">4.</td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Deposit Amount for
                                                        Water Charges as per CE-II / A's Circular dated 02.06.2009</td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold"> {{ isset($calculationData) ? $calculationData->water_usage_charges : '' }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">5.</td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Ready Reckoner
                                                        Rate of 2018-19
                                                        (CTS No. 351 (pt), Hariyali, Tagore Nagar)</td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->redirekner_value : '' }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">6.</td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Rate of
                                                        Construction </td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->redirekner_construction_rate : '' }}</span></td>
                                                </tr>
                                                <tr> 
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">7.</td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">LR /RC Ratio
                                                        (55,900.00 / 27,500.00)</td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->redirekner_val : '' }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">8.</td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Premium towards
                                                        additional buildable area for use of <span style="font-weight: bold"> {{ isset($calculationData) ? $calculationData->remaining_area : '' }} m<sup>2</sup> </span> sq. mt. by charging Rs.
                                                        ___________@ ___________ current Ready Reckoner Rate of 2018-19 (i.e. ___________ of Rs.<span style="font-weight: bold"> {{ isset($calculationData) ? $calculationData->calculated_dcr_rate_val : '' }}/-) </span> as per
                                                        Table C-1, in DCR 33(5),dated 03.07.2017. </td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->balance_of_remaining_area : '' }} </span></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">9.</td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Offsite
                                                        infrastructure charges
                                                        (RR Rate 2018-19 Rs. {{ isset($calculationData) ? $calculationData->redirekner_value : '' }} /- x 7%) x (Permissible BUA as per 3.0 FSI ___________ m2 +
                                                        ___________ m<sup>2</sup> balance BUA of layout (Pro-rata ) - (Existing BUA <span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->existing_construction_area : '' }} m<sup>2</sup></span>) =  (
                                                        <span style="font-weight: bold">{{ (isset($calculationData) ? $calculationData->remaining_area : '') }} m<sup>2</sup></span> X <span style="font-weight: bold"> 

                                                        {{ isset($calculationData) ? $calculationData->redirekner_value : '' }} X 7%)</span></td>
                                                    
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->infrastructure_fee_amount : '' }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">10.</td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Amount to be paid
                                                        to MCGM
                                                        (5/7 of Sr. No. 09)</td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"> <span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->amount_to_be_paid_to_municipal : '' }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">11.</td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Amount to be paid
                                                        to MHADA (2/7 of Sr.No. 09)</td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">
                                                    <span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->offsite_infrastructure_charge_to_mhada : '' }}
                                                    </span></td>
                                                </tr>                            
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">For R.G. relocation Rs. <span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->redirekner_value : '' }}
                                                    </span>/- (10% of Rs <span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->redirekner_value : '' }} </span> per m2 of R. R. 2017-18 ) *

                                                     {{ isset($calculationData) ? $calculationData->area_of_rg_to_be_relocated : '' }}   </td>

                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">
                                                    <span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->total_area_of_rg_to_be_relocated : '' }}
                                                    </span></td>
                                                </tr>                            
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Capitalization of lease rent annual 2.5%</td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">
                                                    <span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->groundrent_capitalization_yearly : '' }}
                                                    </span></td>
                                                </tr>                           
                                                 <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Advance Lease rent 8%</td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">
                                                    <span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->advance_groundrent_per_year : '' }}
                                                    </span></td>
                                                </tr>                            
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Nominal Lease rent</td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">
                                                    <span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->nominal_groundrent : '' }}
                                                    </span></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">12.</td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Total Amount to be
                                                        paid to MHADA <table style="width: 100%;">
                                                            <tr>
                                                                <td style="font-size: 12px;">( Sr.No.1+2+3+4+8+11)</td>
                                                                <td style="text-align: right;">Say Amount</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold">{{ isset($calculationData) ? $calculationData->total_amount_in_rs : '' }} </span></td>
                                                </tr>
<!--                                                 <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                                                    <td colspan="2" style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Rs.
                                                        {{  converNumberToWord(isset($calculationData) ? str_replace( ',', '',$calculationData->total_amount_in_rs) : '' ) }}</td>
                                                </tr> -->
                                                <tr>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                                                    <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Total Amount to be
                                                        paid to MCGM (Sr.No. 10)</td>
                                                    <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold"> {{ isset($calculationData) ? $calculationData->offsite_infrastructure_charges_to_municipal_corporation : '' }}</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif                                    

                <!-- Table 1 ends here -->                                                      
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="6">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            No additional F.S.I. should be utilized other than mentioned above and carpet area for existing members / tenements should be retained as per Govt. G.R. शासन निर्णय क्र।बैठक ११०९/प्र।क्र।३६/गृनिभ। मंत्रालय dated 26/08/2009.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="7">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The work should be carried out within the land underneath &amp; appurtenant to the society / society's building or plot leased by the Board / as per approved subdivision.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="8">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            Responsibility of any damage or loss of adjoining properties if any will vest entirely with the society and M.H.&amp; A. D. Board will not be responsible in any manner.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="9">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The user of this construction under this NOC should be restricted to <strong>RESIDENTIAL </strong>purpose only. Separate permission for other user will have to be obtained.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="10">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            Barbed wire fencing/ chain link Compound wall along boundary line is permitted after getting demarcation fixed from the Executive Engineer Kurla Division, Mumbai Board.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td  >
                                        <ol start="11">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The Society shall have to construct and maintain separate underground water tank, pump house and overhead water tank to meet requirement of the proposed and existing development and obtain separate water meter &amp; water connection.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="12">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The society shall have to obtain approval for amended plans as and when amended else the NOC for Occupation Certificate from EE,BP Cell, Greater Mumbai / MHADA will not be granted.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="13">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            One set of plan along with letter should be forwarded to the office of Resident Executive Engineer / Mumbai Board as token of your approval.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="14">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The Chief Officer / Mumbai Board reserve the right to cancel NOC without giving any notice.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="15">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            All the terms and conditions mentioned in earlier Offer letter, NOC letter &amp; the accompanying list (Annexure-I ) appended to this letter will be applicable to the society.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="16">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The redevelopment proposal should be prepared adhering to the Development Plan reservation, Building regulations and any other rules applicable to building construction by the EE,BP Cell, Greater Mumbai / MHADA.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="17">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The plans of the proposed building shall be submitted to EE,BP Cell, Greater Mumbai / MHADA within six months from the date of issue of this NOC positively for its approval, failing which the NOC will stand cancelled.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td  >
                                        <ol start="18">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The NOC holder will have to communicate the actual date of commencement of work and to submit progress report of the redevelopment scheme by every month till completion of scheme to the Executive Engineer / Kurla Divn. / M.B. under intimation to this office.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="19">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            If NOC holder fails to start the redevelopment work within 12 months from the date of issue of NOC, the right is reserved to cancel the NOC by this office.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td  >
                                        <ol start="20">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The reconstruction of new building for the rehabilitation of old occupiers shall be completed within a period of 30 months from the date of issue of this NOC. In case NOC holder fails to do so, extension to the above time limit may be granted depending on the merits of the case and on payment of an extension fee as may be decided by the office from time to time.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="21">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The road widening that may be proposed in the revised layout will be binding on the society &amp; the society should handover the affected area of road widening to the MCGM at their own cost.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="22">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            All terms &amp; conditions of lease deed and sale deed are binding on the society.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="23">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            After issue of NOC, during course of demolition of old buildings &amp; during course of redevelopment work if any mishap / collapse occur, the entire responsibility of the same will lie with NOC holder. However all the necessary precautionary measures shall be taken to avoid mishap / collapse and the work of demolition &amp; redevelopment shall be carried out under strict supervision of Architect and R.C.C. Consultant.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="24">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The proposal of issue of NOC for obtaining occupation Certificate from EE,BP Cell, Greater Mumbai / MHADA to the newly constructed building will have to be submitted along-with the following documents / information.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px; text-align: center;" lang="en-US" align="justify">
                                            a)
                                        </p>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            Copy of approved plan along-with copy of IOD &amp; C.C. from EE,BP Cell, Greater Mumbai / MHADA. The name of the occupiers against concerned tenements proposed to be allotted in new building should be clearly shown in the plan along-with carpet area to be given. Matching statement i.e. Name of occupant, Room No., existing area and proposed allotted area.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px; text-align: center;" lang="en-US" align="justify">
                                            b)
                                        </p>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            The concerned Architect &amp; NOC Holder / Developer should give certificate that the newly constructed building is in accordance with the plans approved by EE,BP Cell, Greater Mumbai / MHADA &amp; the tenements constructed for rehabilitation of the occupiers of building are as per the areas and amenities as prescribed in the agreement executed with the occupiers.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;  text-align: center;" lang="en-US" align="justify">
                                            c)
                                        </p>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            Photographs of the newly constructed building taken from various angles.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="25">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            If it is subsequently found that the documents / information submitted with your application for NOC are incorrect or forged, mis-leading then this NOC will be cancelled and NOC holder will be held responsible for the consequences / losses, if any thereof if arises in future.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="26">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            Necessary trial pits / trial bores shall be taken at the captioned property to ascertain the bearing capacity of the soil and foundation shall be designed accordingly. R.C.C. design of the new proposed building shall be prepared taking into account the aspect of Mumbai Seismic Zone and same should be got approved from R.C.C. Consultant / Structural Engineer, registered with MCGM.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td>
                                        <ol start="27">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            MHADA reserve its right to withdraw, change, alter, amend their offer letter and conditions mentioned therein in future at any point of time without giving any reason to do so.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td>
                                        <ol start="28">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            On approval to revised layout plan by EE,BP Cell, Greater Mumbai / MHADA, all terms &amp; conditions laid down therein shall be binding on the society.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="29">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            By this letter you are requested not to issue Occupation Certificate unless consent letter duly signed by Chief Officer / Mumbai Board is obtained and submitted to your Department by the applicant.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td >
                                        <ol start="30">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            This NOC is issued for the purpose of IOD/ IOA and approval of plans for BUA of <strong>___________ m
                                            <sup>2</sup></strong>  as shown in condition No. 5 of this letter. The Commencement Certificate shall be issued for BUA <strong>___________ m<sup>2 </sup></strong>(for Residential use)<sup> </sup>[i.e. <strong>___________ m<sup>2 </sup> </strong>(for Residential use) permitted through this NOC. (Proportionate to the first installment paid by the Society as per offer letter under reference no. 1) and <strong>___________ m <sup>2</sup></strong>  Existing Built up area.]
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td>
                                        <ol start="31">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            After approval of layout with 3.00 FSI from Architect Layout Cell, Greater Mumbai / MHADA society will be entitled to additional Pro-rata share of FSI as per approved layout. Further society's allotted Pro-rata share as per this NOC will be adjusted against it's allotted pro-rata share as an when layout is approved by the Architect Layout Cell, Greater Mumbai / MHADA with 3.00 FSI.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td>
                                        <ol start="32">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            Allotment of the layout pro-rata B.U.A. in this case will not create any imbalance of F.S.I. / B.U.A. in the layout though the same is not yet approved as per FSI 3.00 as per D.C.R. 33(5) dated 08/10/2013 Government notification.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td>
                                        <ol start="33">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            Society has to ensure that Contractors / Sub-Contractors appointed by the society or Developer of the Society, who are in charge of construction work; shall be registered with MBOCWW Board &amp; are required to fulfill the obligations as contemplated in Building and other construction workers (Regulation of Employment and condition of service) Act,1996. And further these Contractors / Sub-Contractors are required to fulfill all the conditions stipulated in the above Act, for the benefits of workers.
                                        </p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td>
                                        <ol start="34">
                                            <li>
                                            </li>
                                        </ol>
                                    </td>
                                    <td >
                                        <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                            All the dues should be cleared by Society before issue of Occupation Certificate.
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </center>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        It is, therefore, directed that the proposed work should be carried out strictly adhering to the terms and conditions as mentioned above. In case of any breach to above condition &amp; other terms and conditions annexed herewith, the NOC will stand cancelled.
                    </p>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        Now, MHADA is considering the proposal for amendment of the layout for 3.00 FSI and also all the directives given in the Govt. Resolution of U.D.D. vide No. TPB /4308 /74 /C.N0.11 /2008 /UD-11, dated 6/12/2008 shall be applicable to the applicant.
                    </p>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        <strong>Encl.: Annexure-I.</strong>
                    </p>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        <strong>(Draft approved by CO/MB) </strong>
                    </p>
                    <table style="width: 80%; border-collapse: collapse;" align="right">
                        <tbody>
                            <tr valign="top">
                                <td width="226">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="right">
                                        Sd/-
                                    </p>
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="right">
                                        ({{ isset($reeHead) ? $reeHead : '________'}})
                                    </p>
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="right">
                                        <strong>Resident Executive Engineer.</strong>
                                    </p>
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="right">
                                        <strong>M. H. &amp; A. D. Board</strong>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="left">
                        <strong>\</strong>
                    </p>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        <strong>Copy to:</strong> The Secretary, The Secretary, Building No.<strong>{{($model->eeApplicationSociety->building_no ? $model->eeApplicationSociety->building_no : '')}} </strong>, known {{($model->eeApplicationSociety->name ? $model->eeApplicationSociety->name : '')}} ( {{($model->eeApplicationSociety->address ? $model->eeApplicationSociety->address : '')}} ). ENCL.- ANNEXURE – I.
                    </p>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        <strong>Copy to </strong>
                        <strong>Licensed Surveyor</strong> : _______________________.
                    </p>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        Copy forwarded to information and necessary action in the matter to the: -
                    </p>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        1. Executive Engineer, Housing ___________ Division.
                    </p>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        i) He is directed to take necessary action as per demarcation &amp; as per prevailing policy of MHADA.
                    </p>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        ii) He is directed to recover all the dues from the society concerned to Estate Department &amp; intimate the same to this office.
                    </p>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        iii) He is directed to recover any dues, land revenue, audit remarks concerned to Land Department if any pending with the society &amp; intimate the same to this office. 
                    </p>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        2. Copy to Architect / Layout cell / M.B.
                    </p>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        3. Copy to Sr.Clerk for MIS record.
                    </p>
                    <table style="width: 100%; border-collapse: collapse;" align="right">
                        <tbody>
                            <tr valign="top">
                                <td width="226">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="right">
                                        Sd/-
                                    </p>
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="right">
                                        ({{ isset($reeHead) ? $reeHead : '________'}})
                                    </p>
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="right">
                                        <strong>Resident Executive Engineer.</strong>
                                    </p>
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="right">
                                        <strong>M. H. &amp; A. D. Board</strong>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="center">
                        <em><u>ANNEXURE –I</u></em>
                    </p>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="left">
                        <strong>
                            (Conditions made applicable to NOC granted vide No. CO /MB/REE/NOC/F-
                        </strong>
                        <strong>1004 / /2018, Date :______________________)</strong>
                    </p>
                    <h2 lang="en-US" align="center">
                        TERMS AND CONDITIONS
                    </h2>
                    <p lang="en-GB">
                        The additional buildable area is granted as per policy laid down by MHADA vide NOC mentioned above as per resolution no.5998 dated:09/01/2004 and amended A.R.No.6041, dt.29/7/2004, A.R.No. 6260 Dt. 04/06/2007 , A. R. 6349 dated 25/11/2008, A. R. No. 6383 dated 24/02/2009 ,A.R. No. 6397 dated 5/05/2009 &amp; A.R. No. 6422 dated 07.08.2009 are subject to following terms and conditions.
                    </p>
                    <table style="width: 720px; border: 1px solid #000; border-collapse: collapse;">
                        <tbody>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol>
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        All the terms and conditions mentioned in the Layout which was processed to EE,BP Cell, Greater Mumbai / MHADA shall be applicable to the society.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="2">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        The set of plans approved by EE,BP Cell, Greater Mumbai / MHADA duly certified by the Architect should be submitted to this office before commencement of work.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="3">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        The society will have to construct and maintain separate tank if necessary with approval of EE,BP Cell, Greater Mumbai / MHADA.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="4">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        The society will have to enter into a separate Lease Agreement of Society &amp; will have to get the rectification deed done through concerned Estate Manager &amp; Legal Department of the Board for additional area granted before asking from Occupation Certificate from EE,BP Cell, Greater Mumbai / MHADA.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="5">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        The society will have to submit stability of the existing structure / proposed work through Registered Licensed Structural Engineer by MCGM.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="6">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        The society will have to obtain separate P. R. card as per the approved sub division / plot leased out by the board duly signed by S. L. R. before asking for Occupation Permission from EE,BP Cell, Greater Mumbai / MHADA.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="7">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        The society will have to obtain approval for amended plans as and when the Society amends the plans.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="8">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        The society should submit undertaking on Rs. 250/- Stamp paper for not having any objection if the newly developable plots are either developed by the Board or by the allotted of the Board in Tagore Nagar, layout.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="9">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        The Society will have to hand over the set back area free of cost to MCGM &amp; proof of the same will have to be submitted to this office. The society will have to inform about encroachment to EE,BP Cell, Greater Mumbai / MHADA at their own cost and M.H.A.D. Board shall not be held responsible.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="10">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        The pro-rata charges towards construction of D. P. as implemented by MCGM will be paid from the premium received from the society for the purchase of additional BUA for which receipts shall be submitted by the society from EE,BP Cell, Greater Mumbai / MHADA in favor of Chief Accounts Officer / MHAD Board.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="11">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        The Society will have to submit Undertaking on Rs. 250/- stamp paper agreeing to pay the difference in premium if any as and when MHADA reviews the policy for allotment of F.S.I. / T.D.R. (Form V).
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="12">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        Before issuing the NOC for Occupation Tanker Water or Extra Water charges payment clearance should be produced by the Society.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="13">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        The redevelopment Proposal should be approved adhering to the Development Plan reservation, Building regulations and any other rules applicable to Building construction by the Building Proposal Dept. in Planning Authority, MHADA.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="14">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        The charges as may be levied by MCGM, from time to time (apart from FSI charges), for e.g. Pro-rata charges for Roads, shall be paid by the society to MCGM directly, on demand from MCGM.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="15">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        The society shall indemnify MHADA against any legal action regarding payment of stamp duty for a) Transfer of built tenements to beneficiaries and b) Purchase of balance FSI /T. D. R. etc. as may be required under provisions of Stamp Duty Act.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="16">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        It is therefore, directed that the proposed work should be carried out strictly adhering to the terms and conditions mentioned as above. In case of any breach to above condition the NOC will stand cancelled.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="17">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        This allotment is subject to payment of Stamp duty if / as and when may be imposed by the Govt. of Maharashtra (Under the relevance provisions of Maharashtra Stamp Duty Act. The allottee will have to submit an Undertaking to this effect on Stamp paper worth Rs.100/-)
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="18">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        MCGM has incurred expenditure for on site infrastructure prior to modification in DCR 33 (5) and after modification in DCR 33 (5). The Pro-rata premium shall be payable by the society as and when competent authority communicates to you.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td height="28">
                                    <ol start="19">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td style="border: 1px solid #000;">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        The Pro-rata premium for approval of revised layout under DCR 33 (5) with 3.0 FSI shall also be payable by society as and when communicated to you.
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border: 1px solid #000;">
                                    <ol start="20">
                                        <li>
                                        </li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                                        MHADA reserve its right to withdraw, change, alter, amend their offer letter and conditions mentioned therein in future at any point of time without giving any reason to do so.
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
                        <strong>(Draft approved by CO/MB)</strong>
                    </p>
                    <table style="width: 100%; border-collapse: collapse;" align="right">
                        <tbody>
                            <tr valign="top">
                                <td width="100%">
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="right">
                                        ({{ isset($reeHead) ? $reeHead : '________'}})
                                    </p>
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="right">
                                        <strong>Resident Executive Engineer.</strong>
                                    </p>
                                    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="right">
                                        <strong>M. H. &amp; A. D. Board</strong>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    @endif

            </textarea>
            <input type="submit" id="submit" value="save" style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;">
        </form>
        </div>
</body>

</html>
<script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.replace('ckeditorText', {
        height: 700,
        allowedContent: true
    });
</script>
<script>