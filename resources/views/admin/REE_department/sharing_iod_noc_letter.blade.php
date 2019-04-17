<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <title>NOC</title>
</head>
<body>
    <div class="m_portlet">
        <form action="{{route('ree.save_draft_noc')}}" id="OfferLetterFRM" method="post" name="OfferLetterFRM">
            @csrf <input id="applicationId" name="applicationId" type="hidden" value="{{$applicatonId}}">
            <textarea id="ckeditorText" name="ckeditorText" style="display:none">               @if($content != "") {{$content}} @else
            <div id="" style="">
                <!-- Header starts here -->
                <div>
                    <div style="margin-top: 30px; text-align: right;">
                        <div style="float: left; width: 56%;"></div>
                        <div style="float: left; width: 44%;">
                            <div style="text-align: left;">
                                <span>NO.CO/MB/REE/NOC /F-976/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/2018</span>
                            </div>
                            <div style="text-align: left;">
                                <span>Date:</span>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <h3 style="text-decoration: underline; text-align: center;">NOC FOR I.O.D. PURPOSE ONLY</h3>
                    <p></p>
                    <div style="margin-top: -15px;">
                        <p style="margin-bottom:0; line-height:0.25;">To,</p>
                        <p style="margin-bottom:0; line-height:0.25;">The Executive Engineer,</p>
                        <p style="margin-bottom:0; line-height:0.25;">Building Proposal cell,</p>
                        <p style="margin-bottom:0; line-height:0.25;">Special Planning Authority,</p>
                        <p style="margin-bottom:0; line-height:0.25;">MHADA,Bandra (E),Mumbai 400 051.</p><!-- <p style="margin-bottom:0; line-height:0.25;">Mumbai - 400 083.</p> -->
                    </div>
                </div><!-- Header ends here -->
                <!-- Subject starts here -->
                <div style="padding-left: 50px; margin-top: 30px; line-height: 1.5;">
                    <table style="width: 100%; border-collapse: collapse; border-bottom: none;">
                        <tbody>
                            <tr>
                                <td style="border: 1px solid #000; text-align: center; padding: 5px;" valign="top">Sub:</td>
                                <td style="border: 1px solid #000; padding: 5px;" valign="top">Proposed redevelopment of existing building No. <span style="font-weight: bold;">{{($model->eeApplicationSociety->building_no ? $model->eeApplicationSociety->building_no : '')}}</span> , known as <span style="font-weight: bold;">{{($model->eeApplicationSociety->name ? $model->eeApplicationSociety->name : '')}} ( {{($model->eeApplicationSociety->address ? $model->eeApplicationSociety->address : '')}} )</span> under DCR 33(5) dated 08.10.2013 & it's modification dtd. 03.07.2017.</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; text-align: center; padding: 5px;" valign="top">Ref:</td>
                                <td style="border: 1px solid #000; padding: 5px;" valign="top"><span style="display: block; margin-bottom: 4px;">1. This Office Offer letter No. <span style="font-weight: bold;">{{($model->request_form->offer_letter_number ?$model->request_form->offer_letter_number:'')}}</span>, Dated <span style="font-weight: bold;">{{($model->request_form->offer_letter_date ? date('d-m-Y',strtotime($model->request_form->offer_letter_date)) : '')}}</span></span> <span style="display: block;">2. Society's Architect letter dated <span style="font-weight: bold;">{{($model->request_form->created_at ? date('d-m-Y',strtotime($model->request_form->created_at)) : '')}}.</span></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div><!--  -->
                <!-- Subject ends here -->
                Sir,
                <p><br></p>
                <p>The applicant has complied with all requisites for obtaining No Objection Certificate (NOC) for IOD only, for redevelopment of their building under subject. There is no objection of this office to his undertaking construction as per the proposal of the said society under certain terms and conditions, on the plot admeasuring about <strong>{{ isset($calculationData) ? $calculationData->area_of_total_plot : '________' }} m<sup>2</sup></strong> as per lease area.</p>
                <p><sup></sup>The NOC is granted as per policy laid down under DCR 33(5), dated 08.10.2013 &amp; it's modification dated 03.07.2017 subject to following conditions. The other additional terms and conditions as per Annexure-I shall also apply &amp; are appended separately.</p>
                <p><br></p>
                <center>
                    <table border="1" style="width: 720px; border-collapse: collapse;margin-top:50px">
                        <colgroup>
                            <col>
                            <col>
                        </colgroup>
                        <tbody>
                            <tr valign="top">
                                <td>
                                    <ol>
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">This NOC is issued to only for the IOD purpose from S.P.A./ MHADA.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="2">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The work of redevelopment should be carried out as per plans submitted to this office along with detailed proposal, as per prior approval of S.P.A./ MHADA</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="3">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">Necessary Approvals to the plans from S.P.A./ MHADA should be obtained before starting of work.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="4">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The work should be carried out under the supervision of the Competent Registered Architect and Licensed Structural Engineer.</p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="5">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The work should be carried out entirely at applicant’s own risk and cost and MHAD Board will not be responsible for any mishap or irregularity at any time.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td style="border-bottom: none;">
                                    <ol start="6">
                                        <li></li>
                                    </ol>
                                </td>
                                <td style="border-bottom: none;">
                                    <p style="padding-left: 5px; padding-right: 5px;"><b>The built up area permitted is as per statement below.</b></p>
                                </td>
                            </tr>
                            </tbody>
                            </table>
                            <h3 style="text-transform: uppercase; text-decoration: underline; text-align: center;">Statement A (Particulars of Area Sharing)</h3>
                <table style="width: 720px; text-align: center; border-collapse: collapse; table-layout: fixed;">
                    <thead style="text-align: center;">
                        <tr>
                            <th style="width: 8%; border: 1px solid #000; padding: 5px 10px">Sr.No</th>
                            <th style="width: 65%; border: 1px solid #000; padding: 5px 10px">Particular</th>
                            <th style="width: 35%; border: 1px solid #000; padding: 5px 10px;">Area in m <sup>2</sup></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                            <td colspan="2" style="border: 1px solid #000; padding: 5px 10px; text-align: center;">Table - A</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">1.</td>

                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Plot area as per lease deed {{ isset($calculationData) ? $calculationData->area_of_total_plot : '' }}
                            </td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->area_of_total_plot : '' }} m<sup>2</sup></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">2.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">FSI Permissible</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->permissible_carpet_area_coordinates : '' }}</td> 
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">3.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Permissible BUA  (_____ m<sup>2</sup>  X _____ )</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->permissible_construction_area : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">4.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Pro-rata BUA  (_____ m<sup>2</sup> Per T/s  X _____ T/s )</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->permissible_proratata_area : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">5.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Total Permissible BUA  (Sr.No.__ )</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->total_permissible_construction_area : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">6.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Existing Carpet Area</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->permissible_mattress_area : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">7.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Rehabilitation area entitlement (_____ + _____% = _____ per T/s)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->revised_permissible_mattress_area : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">8.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">As per Revised DCR 33(5) dated 08.10.2013 & it's modification dated 03.07.2017,  a basic entitlement equivalent to the carpet area of the existing tenement plus _____% thereof, subject to a minimum carpet area of _____ m<sup>2</sup></td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->revised_increased_area_for_residential_use : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">9.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Total Rehabilitation  Carpet area (_____ m<sup>2</sup> X _____  Ts)</td>
                            
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->total_rehabilitation_mattress_area : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">10.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Additional entitlement governed by size of plot</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"> {{ isset($calculationData) ? $calculationData->total_additional_claims : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">11.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Total BUA for rehabilitation (_____ m<sup>2</sup> x _____)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->total_rehabilitation_construction_area : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                            <td colspan="2" style="border: 1px solid #000; padding: 5px 10px; text-align: center;">
                            Table - B</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">12.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Ready Reckoner Rate of 2017-18 CTS No. _____ (pt), </td>

                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->lr_val : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">13.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Rate of Construction</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->rc_val : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">14.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">LR/RC Ratio (_____ = _____)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->lr_rc_division_val : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">15.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Incentive FSI admissible against the FSI required for rehabilitation for LR/RC Ratio _____ as per table 'B' of DCR</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->dcr_b_val : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">16.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Incentive BUA (_____ m<sup>2</sup> x {{ ($calculationData) ? $calculationData->dcr_b_val : '_____' }}%)
                        </td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->mattress_area_for_construction_area : '' }}</td>
                        </tr>                        
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                            <td colspan="2" style="border: 1px solid #000; padding: 5px 10px; text-align: center;">Table - C</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">17.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Balance area for  sharing (_____ – (_____ + _____))</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->remaining_area : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">18.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">For LR/RC Ratio (_____/_____ = _____) as per table-C of DCR</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->lr_rc_division_val : '' }} </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">19.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"> <div>Society share [_____  X {{ isset($calculationData) ? $calculationData->dcr_c_society_val : '_____' }}%]</div>

                            <div>MHADA's share [_____  X {{ isset($calculationData) !="" ? $calculationData->dcr_c_mhada_val : '_____' }}%]</div></td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">

                            <div>{{ isset($calculationData) ? $calculationData->society_share : '' }}</div>

                            <div>{{ isset($calculationData) ? $calculationData->mhada_share : '' }}</div></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">20.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">MHADA's share with fungible ___% (_____ m<sup>2</sup> + _____%)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">

                            {{ isset($calculationData) ? $calculationData->mhada_share_with_fungib : '' }}</td>
                        </tr>
                    </tbody>
                </table>

            <!-- Table 1 ends here -->

            <!-- Table 2 starts here -->


                   <!--  <h3 style="text-transform: uppercase; font-weight: bold; text-decoration: underline; text-align: center; margin-top: 70px;">
                    Statement B (Particulars of Payment)</h3>

                <table style="width: 720px; text-align: center; border-collapse: collapse; table-layout: fixed;">
                    <thead style="text-align: center;">
                        <tr>
                            <th style="width: 8%; border: 1px solid #000; padding: 5px 10px">Sr.No</th>
                            <th style="width: 65%; border: 1px solid #000; padding: 5px 10px">Particular</th>
                            <th style="width: 35%; border: 1px solid #000; padding: 5px 10px">Area in m <sup>2</sup></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                            <td colspan="2" style="border: 1px solid #000; padding: 5px 10px; text-align: center;">Table - A</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">1.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Scrutiny Fees/-  For Residential Rs. {{ isset($calculationData) ? $calculationData->scrutiny_fee : '_____' }}/-</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->scrutiny_fee : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">2.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Debris Removal Rs. _____/- Per Bldg.</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->debraj_removal_fee : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">3.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Layout approval fees  (Rs. 1,000/- X 32 T/s)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) !="" ? $calculationData->layout_approval_fee : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">4.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Deposit Amount for Water Charges as per  CE-II /A's Circular dated 02.06.2009</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->water_usage_charges : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">5.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Offsite infrastructure charges (RR Rate 2017-18 Rs. _____/- x _____%) x (Permissible BUA as per _____ FSI {{ isset($calculationData) ? $calculationData->permissible_construction_area : '_____' }} m<sup>2</sup> + 

                            {{ isset($calculationData) ? $calculationData->permissible_proratata_area : '_____' }} m<sup>2</sup> balance BUA of layout (Pro-rata ) – (Existing BUA _____ m<sup>2</sup>) (_____ m<sup>2</sup> X _____ X _____%)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->off_site_infrastructure_fee : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">6.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Amount to be paid to MCGM  (5/7 of Sr. No. _____)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->amount_to_be_paid_to_municipal : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">7.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Amount to be paid to MHADA (2/7 of Sr.No._____)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? $calculationData->offsite_infrastructure_charge_to_mhada : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">8.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Total Amount to be paid to MHADA ( Sr.No.1+2+3+4+7) <div style="text-align: right;">Say Amount</div> </td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><div></div><div>{{ isset($calculationData) ? $calculationData->total_amount_in_rs : '' }}</div></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                            <td colspan="2" style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Rs. {{  converNumberToWord(isset($calculationData) ? str_replace( ',', '',$calculationData->amount_to_b_paid_to_municipal_corporation) : '' ) }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Total Amount to be paid to MCGM (Sr.No._____)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ isset($calculationData) ? str_replace( ',', '',$calculationData->amount_to_b_paid_to_municipal_corporation) : '' }}</td>
                        </tr>
                    </tbody>
                </table> -->
                    <table  border="1" style="width: 720px; border-collapse: collapse;">
                        <tbody>
                            <tr valign="top">
                                <td>
                                    <ol start="7">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p><br></p>
                                    <p style="padding-left: 5px; padding-right: 5px;">Total permissible area for sharing is <strong>{{ isset($calculationData) ? $calculationData->remaining_area : '________' }} m<sup>2</sup></strong>. Out of this net built up share  <strong>{{ isset($calculationData) ? $calculationData->mhada_share : '________' }} m<sup>2</sup></strong> (with fungible <strong>{{ isset($calculationData) ? $calculationData->mhada_share_with_fungib : '________' }} m<sup>2</sup></strong>) shall be handed over to MHADA free of cost in form of constructed residential tenements of carpet area upto <strong>45 </strong> <sup> m2 </sup> each.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="8">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">These tenements shall be handed over to MHADA within a period of 3 years from date of issue of Commencement Certificate from S.P.A./ MHADA. In case if any time extension is required in future for any unforeseen reason/due to any natural calamities; same will be considered only after approval of Hon. Vice President / Authority.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="9">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">No additional F.S.I. should be utilized other than mentioned in table A &amp; B &amp; C.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="10">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">It is binding on society to handover built up area in the form of constructed T/s as decided by MHADA.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="11">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The work should be carried out within the land underneath &amp; appurtenant to the society / society's building or plot leased by the Board / as per approved subdivision.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="12">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">Responsibility of any damage or loss of adjoining properties if any will vest entirely with the society and M.H.&amp; A. D. Board will not be responsible in any manner.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="13">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The use of this construction should be restricted to RESIDENTIAL purpose only. Separate permission for other user will have to be obtained.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="14">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">Barbed wire fencing/ chain link Compound wall along boundary line is permitted after getting demarcation fixed from the Executive Engineer Goregaon Division Mumbai board and Asst. Land Manager / Kurla Mumbai Board.</p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="15">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The Society shall have to construct and maintain separate underground water tank, pump house and overhead water tank to meet requirement of the proposed and existing development and obtain separate water meter &amp; water connection.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="16">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The society shall have to obtain approval for amended plans as and when amended else the NOC for Occupation Certificate from S.P.A./ MHADA will not be granted.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="17">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">One set of plan along with letter should be forwarded to the office of Resident Executive Engineer/Mumbai Board as token of your approval.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="18">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The Chief Officer / Mumbai Board reserve the right to cancel NOC without giving any notice.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="19">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">All the terms and conditions mentioned in earlier Offer letters, NOC letters &amp; the accompanying list (Annexure-I) appended to this letter will be applicable to the society.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="20">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The redevelopment proposal should be prepared adhering to the Development Plan reservation, Building regulations and any other rules applicable to Building construction by the Building Proposal Dept. in S.P.A./ MHADA.</p>
                                    <p><br></p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="21">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The plans of the proposed building shall be submitted to S.P.A./ MHADA within six months from the date of issue of this NOC positively for its approval, failing which the NOC will stand cancelled.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="22">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The NOC holder will have to communicate the actual date of commencement of work and to submit progress report of the redevelopment scheme by every month till completion of scheme to the Executive Engineer / Kurla Divn. / M.B. under intimation to this office.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="23">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">If NOC holder fails to start the redevelopment work within 12 months from the date of issue of NOC for Commencement Certificate. The right is reserved to cancel the NOC by this office.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="24">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The reconstruction of new building for the rehabilitation of old occupiers shall be completed within a period of 30 months from the date of issue of this NOC. In case NOC holder fails to do so, extension to the above time limit may be granted depending on the merits of the case and on payment of an extension fee as may be decided by the office from time to time.</p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="25">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The road widening that may be proposed in the revised layout will be binding on the society &amp; the society should handover the affected area of road widening to the MCGM at their own cost.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="26">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">All terms &amp; conditions of lease deed &amp; sale deed are binding on the society.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="27">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">After issue of NOC, during course of demolition of old buildings &amp; during course of redevelopment work if any mishap / collapse occur, the entire responsibility of the same will lie with NOC holder. However all the necessary precautionary measures shall be taken to avoid mishap / collapse and the work of demolition &amp; redevelopment shall be carried out under strict supervision of Architect and R.C.C. Consultant.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="28">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The proposal of issue of NOC for obtaining occupation Certificate from S.P.A./ MHADA to the newly constructed building will have to be submitted along-with the following documents / information.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px; text-align: center;" lang="en-US" align="justify">a)</p>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">Copy of approved plan along-with copy of IOD &amp; C.C. from S.P.A./ MHADA. The name of the occupiers against concerned tenements proposed to be allotted in new building should be clearly shown in the plan along-with carpet area to be given. Matching statement i.e. Name of occupant, Room No., existing area and proposed allotted area.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px; text-align: center;" lang="en-US" align="justify">b)</p>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The concerned Architect &amp; NOC Holder / Developer should give certificate that the newly constructed building is in accordance with the plans approved by S.P.A./ MHADA &amp; the tenements constructed for rehabilitation of the occupiers of building are as per the areas and amenities as prescribed in the agreement executed with the occupiers.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px; text-align: center;" lang="en-US" align="justify">c)</p>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">Photographs of the newly constructed building taken from various angles.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="29">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">If it is subsequently found that the documents / information submitted with your application for NOC are incorrect or forged, mis-leading then this NOC will be cancelled and NOC holder will be held responsible for the consequences / losses, if any thereof if arises in future.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="30">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">Necessary trial pits / trial bores shall be taken at the captioned property to ascertain the bearing capacity of the soil and foundation shall be designed accordingly. R.C.C. design of the new proposed building shall be prepared taking into account the aspect of Mumbai Seismic Zone and same should be got approved from R.C.C. Consultant / Structural Engineer, registered with MCGM.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="31">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">As far as possible separate building for rehabilitation of existing tenants &amp; for the purpose of free sale, taking into account the plot area of the captioned property shall be constructed. The NOC holder has to form the independent Co.Op. Hsg. Society for rehab building of tenants as well as for free sale component after giving possession to the existing tenants &amp; prospective buyers, wherever possible.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="32">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">MHADA reserve its right to withdraw, change, alter and amend their offer letter and conditions mentioned therein in future at any point of time without giving any reason to do so.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="33">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">On approval to revised layout plan by S.P.A./ MHADA, all terms &amp; conditions laid down therein shall be binding on the society.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="34">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">By this letter you are requested not to issue Commencement Certificate unless consent letter duly signed by Chief Officer / Mumbai Board is obtained and submitted to your Department by the applicant.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="35">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">All the dues should be cleared by Society before issue of No Objection Certificate for C.C.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="36">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The society shall have to follow the Co-Op Dept.'s G.R. No. सगृयो २००७ / प्र. क्र. ५५४/१४-स, दि. ३ जानेवारी २००९ for redevelopment.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="37">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;"><b>This NOC is treated for issue of I.O.D. &amp; plans sanction purpose only.</b> In this matter the C.C. will be issued after execution of tri-party agreement for MHADA B.U.A. &amp; after getting further concurrence from Mumbai Board.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="38">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The society shall have to provide proportionate parking &amp; common amenities to the tenants of MHADA share (Housing Stock).</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="39">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">It is mandatory for society/developer to execute the agreement for surrender of <strong>{{ isset($calculationData) ? $calculationData->mhada_share : '________' }} m<sup>2</sup></strong>(with fungible <strong>{{ isset($calculationData) ? $calculationData->mhada_share_with_fungib : '________' }} m<sup>2</sup></strong>) BUA free of cost to MHADA. The said agreement executed between parties after issue of I.O.D. and before issue of final NOC.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="40">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">Constructed area to be surrendered should comprise of tenements having carpet area up to
                                     <strong> 45 </strong> m2 accordingly you have to submit the plans to the authority prior to NOC.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="41">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">All the terms and conditions mentioned in the Layout which was processed to M.C.G.M shall be applicable to the society.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="42">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The set of plans approved by S.P.A./ MHADA duly certified by the Architect should be submitted to this office before commencement of work.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="43">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The society will have to construct and maintain separate tank if necessary with approval of M.C.G.M.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="44">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The society will have to submit stability of the redeveloped structure / proposed work through Registered Licensed Structural Engineer by S.P.A./ MHADA.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="45">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The society will have to obtain separate P. R. card as per the approved sub division / plot leased out by the board duly signed by S. L. R. before asking for Occupation Permission from S.P.A./ MHADA.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="46">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The society will have to obtain approval for amended plans as and when the Society amends the plans.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="47">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The society should submit undertaking on Rs. 250/- Stamp paper for not having any objection if the newly developable plots are either developed by the Board or by the allotted of the Board in Kannamwar Nagar layout.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="48">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The Society will have to hand over the set back area free of cost to MCGM &amp; proof of the same will have to be submitted to this office. The society will have to inform about form encroachment to M.C.G.M. at their own cost and M.H.A.D. Board shall not be held responsible.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="49">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The pro-rata charges towards construction of D. P. as implemented by MCGM will be paid from the premium received from the society for the purchase of additional BUA for which receipts shall be submitted by the society from MCGM in favour of Chief Accounts Officer / MHAD Board.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="50">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The Society will have to submit Undertaking on Rs. 250/- stamp paper agreeing to pay the difference in premium if any as and when MHADA reviews the policy for allotment of F.S.I. / T.D.R. (Form V).</p>
                                    <p><br></p>
                                </td>
                            </tr><tr valign="top">
                                <td>
                                    <ol start="51">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">Before issuing the NOC for Occupation Tanker Water or Extra Water charges payment clearance should be produced by the Society.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="52">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The redevelopment Proposal should be approved adhering to the Development Plan reservation, Building regulations and any other rules applicable to Building construction by the Building Proposal Dept. in S.P.A./ MHADA.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="53">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The charges as may be levied by S.P.A./ MHADA, from time to time (apart from FSI charges), for e.g. Pro-rata charges for Roads, shall be paid by the society to S.P.A./ MHADA directly, on demand from S.P.A./ MHADA.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="54">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The society shall indemnify MHADA against any legal action regarding payment of stamp duty for a) Transfer of built tenements to beneficiaries and b) Purchase of balance FSI /T. D. R. etc. as may be required under provisions of Stamp Duty Act.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="55">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">It is therefore, directed that the proposed work should be carried out strictly adhering to the terms and conditions mentioned as above. In case of any breach to above condition the NOC will stand cancelled.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="56">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">This allotment is subject to payment of Stamp duty if / as and when may be imposed by the Govt. of Maharashtra (Under the relevance provisions of Maharashtra Stamp Duty Act. The allottee will have to submit an Undertaking to this effect on Stamp paper worth Rs.100/-).</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="57">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">MCGM has incurred expenditure for on site infrastructure prior to modification in DCR 33 (5) and after modification in DCR 33 (5). The Pro-rata premium shall be payable by the society as and when competent authority communicates to you.</p>
                                    <p><br></p>
                                </td>
                            </tr><tr valign="top">
                                <td>
                                    <ol start="58">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The Pro-rata premium for approval of revised layout under DCR 33 (5) with <strong>{{ isset($calculationData) ? $calculationData->permissible_carpet_area_coordinates : '________' }} </strong> FSI shall also be payable by society as and when communicated to you.</p>
                                    <p><br></p>
                                </td>
                            </tr>

                          <!--   <tr valign="top">
                                <td>
                                    <ol start="41">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The society will have to submit attested Xerox copy of minute book for resolution redevelopment of the society bldg., with <strong>{{ isset($calculationData) ? $calculationData->permissible_carpet_area_coordinates : '________' }} </strong> FSI before NOC for C.C.</p>
                                    <p><br></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <ol start="42">
                                        <li></li>
                                    </ol>
                                </td>
                                <td>
                                    <p style="padding-left: 5px; padding-right: 5px;">The further IOD for redevelopment shall be issued after payment of Offsite infrastructure charges of <strong> {{ isset($calculationData) ? $calculationData->off_site_infrastructure_fee : '________' }} Rs.</strong> to MCGM as intimated in the offer letter No. <strong> {{($model->request_form->offer_letter_number ?$model->request_form->offer_letter_number:'')}} </strong> Dated – <strong>{{($model->request_form->offer_letter_date ? date('d-m-Y',strtotime($model->request_form->offer_letter_date)) : '')}}</strong>.</p>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </center>
                <p><br></p>
                <p style="padding-left: 5px; padding-right: 5px;">It is, therefore, directed that the proposed work should be carried out strictly adhering to the terms and conditions as mentioned above. In case of any breach to above condition &amp; other terms and conditions annexed herewith, the NOC will stand cancelled.</p>
                <p>Now, MHADA is considering the proposal for amendment of the layout for <strong>{{ isset($calculationData) ? $calculationData->permissible_carpet_area_coordinates : '________' }} </strong> FSI. Further <strong>{{ isset($calculationData) ? $calculationData->permissible_carpet_area_coordinates : '________' }} </strong> FSI is granted to the applicant on the notionally sub-divided area, hence the proposal should be considered for <strong>{{ isset($calculationData) ? $calculationData->permissible_carpet_area_coordinates : '________' }} </strong> FSI and all the directives given in the DCR 33(5), dated 08.10.2013 &amp; it's modification dated 03.07.2017 shall be applicable to the applicant.</p>
                <p>Encl.: Annexure-I</p>
                
                <p><b>Copy to</b> : The Secretary,Bldg.No.<strong>{{($model->eeApplicationSociety->building_no ? $model->eeApplicationSociety->building_no : '')}}</strong>, known as 
                <strong> {{($model->eeApplicationSociety->name ? $model->eeApplicationSociety->name : '')}} ( {{($model->eeApplicationSociety->address ? $model->eeApplicationSociety->address : '')}} )</strong></p>
                
                <p><b>Copy to Architect</b>: <strong>{{ isset($model->eeApplicationSociety) ? $model->eeApplicationSociety->name_of_architect : '' }} , {{ isset($model->eeApplicationSociety) ? $model->eeApplicationSociety->architect_address: '' }} </strong> for information.</p>

                <p><b>Copy forwarded for information and necessary action in the matter to: -</b></p>
                <p>1) Architect, Layout Cell, Mumbai Board</p>
                <p>2) Executive Engineer ________ Division</p>
                <ol type="i">
                    <li>
                        <p>He is directed to take necessary action as per demarcation &amp; as per prevailing policy of MHADA.</p>
                    </li>
                    <li>
                        <p>He is directed to recover all the dues from the society concerned to Estate Department &amp; intimate the same to this office.</p>
                    </li>
                    <li>
                        <p>He is directed to recover any dues, land revenue, audit remarks concerned to Land Department if any pending with the society &amp; intimate the same to this office.</p>
                    </li>
                </ol>
                <p>3) Chief Accounts Office/M.B.</p>
                <p>He is directed to recover the amount of offer letter on time &amp; furnish certified copy to this office. As well as check above calculation of offer letter thoroughly. If any changes/irregularities found in the said offer letter intimate to this office accordingly.</p>
                <p style="top:30px">4) Sr. Clerk for MIS record.</p>
                <p><br></p>
               <!--  <p align="center"><b>ANNEXURE–I</b></p>
                <p><b>(Conditions made applicable to NOC granted vide No. CO /MB /REE/NOC /F-976/ /2018, Date :______________________)</b></p> -->
                <!-- <h2 align="center" lang="en-IN">TERMS AND CONDITIONS</h2>
                <p>The additional build able area is granted as per policy laid down by MHADA vied NOC mentioned above as per DCR 33(5), dated 08.10.2013 &amp; it's modification dated 03.07.2017 &amp; MHADA's resolution no.5998 dated:09/01/2004 and amended A.R.No.6041, dt.29/7/2004, A.R. No. 6260 Dt. 04/06/2007, A. R. 6349 dated 25/11/2008, A. R. No. 6383 dated 24/02/2009, A. R. No. 6397 dated 5/05/2009 &amp; A.R. No. 6422 dated 07.08.2009 are subject to following terms and conditions.</p>
                <p><br></p>
                <table border="1" style="width: 720px; border-collapse: collapse;">
                    <colgroup>
                        <col>
                        <col>
                    </colgroup>
                    <tbody>
                        <tr valign="top">
                            <td>
                                <ol>
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">All the terms and conditions mentioned in the Layout which was processed to M.C.G.M shall be applicable to the society.</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="2">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">The set of plans approved by S.P.A./ MHADA duly certified by the Architect should be submitted to this office before commencement of work.</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="3">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">The society will have to construct and maintain separate tank if necessary with approval of M.C.G.M</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="4">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">The society will have to submit stability of the redeveloped structure / proposed work through Registered Licensed Structural Engineer by S.P.A./ MHADA</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="5">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">The society will have to obtain separate P. R. card as per the approved sub division / plot leased out by the board duly signed by S. L. R. before asking for Occupation Permission from S.P.A./ MHADA</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="6">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">The society will have to obtain approval for amended plans as and when the Society amends the plans.</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="7">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">The society should submit undertaking on Rs. 250/- Stamp paper for not having any objection if the newly developable plots are either developed by the Board or by the allotted of the Board in Kannamwar Nagar layout.</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="8">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">The Society will have to hand over the set back area free of cost to MCGM &amp; proof of the same will have to be submitted to this office. The society will have to inform about form encroachment to M.C.G.M. at their own cost and M.H.A.D. Board shall not be held responsible.</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="9">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">The pro-rata charges towards construction of D. P. as implemented by MCGM will be paid from the premium received from the society for the purchase of additional BUA for which receipts shall be submitted by the society from MCGM in favour of Chief Accounts Officer / MHAD Board.</p>
                                <p><br></p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="10">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">The Society will have to submit Undertaking on Rs. 250/- stamp paper agreeing to pay the difference in premium if any as and when MHADA reviews the policy for allotment of F.S.I. / T.D.R. (Form V).</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="11">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">Before issuing the NOC for Occupation Tanker Water or Extra Water charges payment clearance should be produced by the Society.</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="12">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">The redevelopment Proposal should be approved adhering to the Development Plan reservation, Building regulations and any other rules applicable to Building construction by the Building Proposal Dept. in S.P.A./ MHADA.</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="13">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">The charges as may be levied by S.P.A./ MHADA, from time to time (apart from FSI charges), for e.g. Pro-rata charges for Roads, shall be paid by the society to S.P.A./ MHADA directly, on demand from S.P.A./ MHADA.</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="14">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">The society shall indemnify MHADA against any legal action regarding payment of stamp duty for a) Transfer of built tenements to beneficiaries and b) Purchase of balance FSI /T. D. R. etc. as may be required under provisions of Stamp Duty Act.</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="15">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">It is therefore, directed that the proposed work should be carried out strictly adhering to the terms and conditions mentioned as above. In case of any breach to above condition the NOC will stand cancelled.</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="16">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">This allotment is subject to payment of Stamp duty if / as and when may be imposed by the Govt. of Maharashtra (Under the relevance provisions of Maharashtra Stamp Duty Act. The allottee will have to submit an Undertaking to this effect on Stamp paper worth Rs.100/-)</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="17">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">MCGM has incurred expenditure for on site infrastructure prior to modification in DCR 33 (5) and after modification in DCR 33 (5). The Pro-rata premium shall be payable by the society as and when competent authority communicates to you.</p>
                                <p><br></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <ol start="18">
                                    <li></li>
                                </ol>
                            </td>
                            <td>
                                <p style="padding-left: 5px; padding-right: 5px;">The Pro-rata premium for approval of revised layout under DCR 33 (5) with <strong>{{ isset($calculationData) ? $calculationData->permissible_carpet_area_coordinates : '________' }} </strong> FSI shall also be payable by society as and when communicated to you.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p><b>(Draft approved by CO/MB)</b></p>
                <table style="width: 100%; border-collapse: collapse;">
                    <tbody>
                        <tr valign="top">
                            <td align="right">
                                <p><br></p>
                                <p>Sd/-</p>
                                <p>({{ isset($reeHead) ? $reeHead : '________'}})</p>
                                <p><b>Resident Executive Engineer.</b></p>
                                <p><b>M. H. &amp; A. D. Board</b></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p><br></p> -->
                @endif
                </textarea>
            <input id="submit" style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;"
                type="submit" value="save">
    </div>
    </form>
    </div>
</body>

</html>
<script src="{{asset('/js/jquery-3.3.1.min.js')}}">
</script>
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}">
</script>
<script>
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.replace('ckeditorText', {
        height: 700,
        allowedContent: true
    });
</script>
