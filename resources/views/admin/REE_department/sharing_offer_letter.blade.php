<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>


<body>
    <form id="OfferLetterFRM" action="{{ route('ree.save_offer_letter')}}" method="post">
        @csrf
        <input type="hidden" id="applicationId" name="applicationId" value="{{$applicatonId}}">
        <textarea id="ckeditorText" name="ckeditorText" style="display:none">
    <div style="" id="">
        <div style="width: 100%;">

            <!-- Header starts here -->
            <div>
                <div style="margin-top: 30px; text-align: right;">
                    <div style="float: left; width: 56%;"></div>
                    <div style="float: left; width: 44%;">
                        <div style="text-align: left;">
                            <span>No.CO/MB/REE/NOC/F-1008/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/2018</span>
                        </div>
                        <div style="text-align: left;">
                            <span>Date:</span>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <h3 style="text-decoration: underline; text-align: center;">Offer Letter</h3>
                    <p > </p>
                <div style="margin-top: -15px;">
                    <p style="margin-bottom:0; line-height:0.25;">To,</p>
                    <span style="margin-bottom:0; line-height:0.25;">The Secretary,</span>
                    <p style="margin-bottom:0; line-height:0.25;">Building No.
                        <span style="font-weight: bold;">{{($calculationData->eeApplicationSociety->building_no ? $calculationData->eeApplicationSociety->building_no : '')}}</span>
                    </p>
                    <p style="margin-bottom:0; line-height:0.25;">____________</p>
<!--                     <p style="margin-bottom:0; line-height:0.25;">Vikhroli (E),</p>
                    <p style="margin-bottom:0; line-height:0.25;">Mumbai - 400083.</p> -->
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
                                Proposed redevelopment of existing building No. <span style="font-weight: bold;">{{($calculationData->eeApplicationSociety->building_no ? $calculationData->eeApplicationSociety->building_no : '')}}</span>, known as  <span style="font-weight: bold;"></span> ______________ under  DCR 33(5), 
                                dated 08.10.2013 & it's modification dated 03.07.2017.
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" style="border: 1px solid #000; text-align: center; padding: 5px;">Ref:</td>
                            <td valign="top" style="border: 1px solid #000; padding: 5px;">
                                <span style="display: block; margin-bottom: 4px;">1. Society's proposal dt__________.</span>
                                <span style="display: block;">2. Hon. VP/A's approval dt.__________.</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--  -->
            <!-- Subject ends here -->

            <!-- Letter Body starts here -->

            <div style="line-height: 1.5;">
                <p style="margin-bottom: 5px;">Sir,</p>
                <p style="text-indent: 25px; margin-top: 5px; margin-bottom: 5px;">With reference to above cited letter you have submitted proposal for utilization of additional BUA under DCR 33(5), dated 08.10.2013 & it's modification dated 03.07.2017.</p>
                <p style="text-indent: 25px; margin-top: 5px; margin-bottom: 5px;">Your proposal has been scrutinized by this office & your proposal has been approved by competent authority as mentioned below:</p>
                <div style="padding-left: 15px;">
                    <div style="float: left; width: 4%;">i.</div>
                    <div style="float: left; width: 96%;">The proposal is approved by restricting the permissible FSI up to ___ FSI on the plot area of 
                    
                    <span style="font-weight: bold;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->area_of_tit_bit_plot : '_____' }} m<sup>2</sup> </span>

                    as per lease deed. Thus total permissible built up area is 

                    {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->total_permissible_construction_area : '_____' }} m<sup>2</sup> 

                    [_____ m<sup>2</sup> (___ FSI on _____ m<sup>2</sup> plot area) +
                      
                      {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->permissible_proratata_area : '_____' }} m<sup>2</sup>

                      Balance BUA of layout] (_____ m<sup>2</sup> rehab built up area + _____ m<sup>2</sup>  Incentive FSI + _____ m<sup>2</sup> to developer/society share + _____ m<sup>2</sup> MHADA's share (_____ m<sup>2</sup> with Fungible)</div>
                    <div style="clear: both;"></div>
                    <div style="float: left; width: 4%;">ii.</div>
                    <div style="float: left; width: 96%;">As per statement ''A'' herewith BUA share of _____ m<sup>2</sup> (_____ m<sup>2</sup> with Fungible) will have to be surrendered to MHADA free of cost in the form of constructed residential tenement of having carpet area upto _____ m<sup>2</sup>.  Accordingly an undertaking should be submitted by the society prior to issue of NOC. </div>
                    <div style="clear: both;"></div>
                    <div style="float: left; width: 4%;">iii.</div>
                    <div style="float: left; width: 96%;">You will have to execute tripartite agreement with MHADA for the surrender of built up area share if any prior to issue of NOC.</div>
                    <div style="clear: both;"></div>
                </div>
                <p style="text-indent: 25px; margin-top: 5px; margin-bottom: 5px;">You will have to submit an Undertaking & Indemnity Bond in prescribed proforma to agree to all conditions in the offer letter and any other condition that MHADA may think necessary.</p>
            </div>

            <!-- Letter Body ends here -->

            <!-- Table 1 starts here -->

            <div style="width: 100%;">
                <h3 style="text-transform: uppercase; font-weight: bold; text-decoration: underline; text-align: center;">Statement A (Particulars of Area Sharing)</h3>
                <table style="width: 100%; text-align: center; border-collapse: collapse; table-layout: fixed;">
                    <thead style="text-align: center;">
                        <tr>
                            <th style="width: 7%; border: 1px solid #000; padding: 5px 10px">Sr.No</th>
                            <th style="width: 74%; border: 1px solid #000; padding: 5px 10px">Particular</th>
                            <th style="width: 21%; border: 1px solid #000; padding: 5px 10px;">Area in m <sup>2</sup></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                            <td colspan="2" style="border: 1px solid #000; padding: 5px 10px; text-align: center;">Table - A</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">1.</td>

                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Plot area as per lease deed {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->area_of_total_plot : '_____' }} m<sup>2</sup>

                            </td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->area_of_total_plot : '_____' }} m<sup>2</sup></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">2.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">FSI Permissible</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->permissible_carpet_area_coordinates : '_____' }}</td> 
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">3.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Permissible BUA  (_____ m<sup>2</sup>  X _____ )</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->permissible_construction_area : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">4.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Pro-rata BUA  (_____ m<sup>2</sup> Per T/s  X _____ T/s )</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->permissible_proratata_area : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">5.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Total Permissible BUA  (Sr.No.__ )</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->total_permissible_construction_area : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">6.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Existing Carpet Area</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->permissible_mattress_area : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">7.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Rehabilitation area entitlement (_____ + _____% = _____ per T/s)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->revised_permissible_mattress_area : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">8.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">As per Revised DCR 33(5) dated 08.10.2013 & it's modification dated 03.07.2017,  a basic entitlement equivalent to the carpet area of the existing tenement plus _____% thereof, subject to a minimum carpet area of _____ m<sup>2</sup></td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->revised_increased_area_for_residential_use : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">9.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Total Rehabilitation  Carpet area (_____ m<sup>2</sup> X _____  Ts)</td>
                            
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->total_rehabilitation_mattress_area : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">10.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Additional entitlement governed by size of plot</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"> {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->total_additional_claims : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">11.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Total BUA for rehabilitation (_____ m<sup>2</sup> x _____)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->total_rehabilitation_construction_area : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                            <td colspan="2" style="border: 1px solid #000; padding: 5px 10px; text-align: center;">
                            Table - B</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">12.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Ready Reckoner Rate of 2017-18 CTS No. _____ (pt), {{($calculationData->eeApplicationSociety->address ? $calculationData->eeApplicationSociety->address : '')}}</td>

                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->lr_val : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">13.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Rate of Construction</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->rc_val : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">14.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">LR/RC Ratio (_____ = _____)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->lr_rc_division_val : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">15.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Incentive FSI admissible against the FSI required for rehabilitation for LR/RC Ratio _____ as per table 'B' of DCR</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->dcr_b_val : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">16.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Incentive BUA (_____ m<sup>2</sup> x {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->dcr_b_val : '_____' }}%)
</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->mattress_area_for_construction_area : '_____' }}</td>
                        </tr>                        
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                            <td colspan="2" style="border: 1px solid #000; padding: 5px 10px; text-align: center;">Table - C</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">17.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Balance area for  sharing (_____ – (_____ + _____))</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->remaining_area : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">18.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">For LR/RC Ratio (_____/_____ = _____) as per table-C of DCR</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->lr_rc_division_val : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">19.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"> <div>Society share [_____  X {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->dcr_c_society_val : '_____' }}%]</div>

                            <div>MHADA's share [_____  X {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->dcr_c_mhada_val : '_____' }}%]</div></td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">

                            <div>{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->society_share : '_____' }}</div>

                            <div>{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->mhada_share : '_____' }}</div></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">20.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">MHADA's share with fungible ___% (_____ m<sup>2</sup> + _____%)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">

                            {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->mhada_share_with_fungib : '_____' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Table 1 ends here -->

            <!-- Table 2 starts here -->

            <div style="margin-top: 30px;">

                <div style="text-align: center;">
                    <h3 style="text-transform: uppercase; font-weight: bold; text-decoration: underline;">Statement B (Particulars of Payment)</h3>
                </div>

                <table style="width: 100%; text-align: center; border-collapse: collapse; table-layout: fixed;">
                    <thead style="text-align: center;">
                        <tr>
                            <th style="width: 7%; border: 1px solid #000; padding: 5px 10px">Sr.No</th>
                            <th style="width: 74%; border: 1px solid #000; padding: 5px 10px">Particular</th>
                            <th style="width: 21%; border: 1px solid #000; padding: 5px 10px">Area in m <sup>2</sup></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                            <td colspan="2" style="border: 1px solid #000; padding: 5px 10px; text-align: center;">Table - A</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">1.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Scrutiny Fees/-  For Residential Rs. {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->scrutiny_fee : '_____' }}/-</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->scrutiny_fee : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">2.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Debris Removal Rs. _____/- Per Bldg.</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->debraj_removal_fee : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">3.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Layout approval fees  (Rs. 1,000/- X 32 T/s)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->layout_approval_fee : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">4.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Deposit Amount for Water Charges as per  CE-II /A's Circular dated 02.06.2009</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->water_usage_charges : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">5.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Offsite infrastructure charges (RR Rate 2017-18 Rs. _____/- x _____%) x (Permissible BUA as per _____ FSI {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->permissible_construction_area : '_____' }} m<sup>2</sup> + 

                            {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->permissible_proratata_area : '_____' }} m<sup>2</sup> balance BUA of layout (Pro-rata ) – (Existing BUA _____ m<sup>2</sup>) (_____ m<sup>2</sup> X _____ X _____%)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->off_site_infrastructure_fee : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">6.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Amount to be paid to MCGM  (5/7 of Sr. No. _____)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->amount_to_be_paid_to_municipal : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">7.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Amount to be paid to MHADA (2/7 of Sr.No._____)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->offsite_infrastructure_charge_to_mhada : '_____' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">8.</td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Total Amount to be paid to MHADA ( Sr.No.1+2+3+4+7) <div style="text-align: right;">Say Amount</div> </td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><div></div><div>{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->total_amount_in_rs : '_____' }}</div></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                            <td colspan="2" style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Rs. {{  converNumberToWord(($calculationData->sharingCalculationSheet) !="" ? str_replace( ',', '',$calculationData->sharingCalculationSheet->amount_to_b_paid_to_municipal_corporation) : '' ) }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                            <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Total Amount to be paid to MCGM (Sr.No._____)</td>
                            <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">{{ ($calculationData->sharingCalculationSheet) !="" ? str_replace( ',', '',$calculationData->sharingCalculationSheet->amount_to_b_paid_to_municipal_corporation) : '_____' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Table 2 ends here -->

            <div style="margin-top: 30px; line-height: 1.5">
                <p style="margin-bottom: 5px; margin-top: 5px;">1) You have to pay full payment at one stroke for heads as stated above statement "B" within 6 months from the date of issue of this letter. If the society fails to make balance payment within 6 months, then the Offer Letter will stand cancelled.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">2) Total permissible area for sharing is

                 {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->remaining_area : '_____' }} 

                 m<sup>2</sup> out of this net built up share {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->mhada_share : '_____' }} m<sup>2</sup>

                  ({{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->mhada_share_with_fungib : '_____' }}

                  m2 with Fungible) will be handed over to MHADA free of cost in form of constructed residential tenements of carpet area upto _____ m<sup>2</sup> each. </p>
                <p style="margin-bottom: 5px; margin-top: 5px;">3) These tenements shall be handed over to MHADA within the period of 3 years from date of issue of NOC.  In case if any time extension is required in future for any unforeseen reason / due to any natural calamities, same will be considered only after approval of Hon. Vice President / Authority.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">4) It is mandatory for you to execute the tripartite agreement for surrender 

                {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->mhada_share : '_____' }} m<sup>2</sup>

                ({{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->mhada_share_with_fungib : '_____' }} <sup>2</sup> 

                with Fungible) BUA area if any free of cost to MHADA prior to NOC. (Draft copy is enclosed herewith)</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">5) This allotment is subject to payment of Stamp duty if / as and when may be imposed by the Govt. of Maharashtra (Under the relevance provisions of Maharashtra Stamp Duty Act. The allottee will have to submit an Undertaking to this effect on Stamp paper worth Rs.100/-)</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">6) M.C.G.M. has incurred expenditure for onsite infrastructure prior to modification in D.C.R. 33(5) & after modification in D.C.R. 33(5). The pro-rata premium shall be payable by the Applicant & the pro-rata premium of revised layout under D.C.R. 33(5) with _____ FSI shall also payable by Applicant as and when communicated, a notarized undertaking incorporating above shall be submitted in this office before final NOC.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">7) You will abide all terms and conditions as may be laid under Offer /  NOC letter.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">8) You will abide the undertaking submitted by you for payment of premium for tit bit area if made if applicable.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">9) You will have to submit No dues certificate from concerned Estate Manager/Mumbai Board before issue of NOC.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">10) Your society will have to submit Property cards and CTS Plans as per approved sub-division Plot area before issue of consent for OC.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">11) Your Architect will have to verify the area & dimensions as per site report given by the Executive Engineer /Housing Kurla Division and submit the report about confirmation.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">12) MHADA reserve it's right to withdraw, change, alter, amend their offer letter and conditions mentioned therein in future at any time without giving any reason to do so.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">13) If MCGM communicates any kind of additional amount of offsite infrastructure, it is binding on the applicant to pay all such charges to MCGM. MHADA will not pay any kind of charges to be paid to planning & approving authority on part of MHADA as well as its part of Built –up share.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">14) The society shall have to provide parking & other amenities to MHADA share tenements & rehab tenements as per MCGM norms.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">15) The Pro-rata amount for approval of revised layout under DCR 33(5) with 3.00FSI shall also be payable by society as and when communicated to you.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">16) It should be sole responsibility of society to obtain the approval of plans / FSI from MCGM and this allotment is made subject to approval of MCGM.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">17) All conditions in lease deed and sale deed are applicable to the Society. </p>
                <p style="margin-bottom: 5px; margin-top: 5px;">18) It is binding on society to pay arrears if any as and when communicated by Mumbai Board.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">19) It is binding on society to handover MHADA's tenements as per approval and prevailing policy.,</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">20) The society will have to submit a copy of AGM/SGM of society.</p>
                <p style="margin-bottom: 5px; margin-top: 5px;">21) The society will have to submit NOC from previously appointed developer & previously appointed architect before issue of NOC.</p>
                <p style="text-indent: 25px; margin-top: 5px; margin-bottom: 5px;">An amount of

                 Rs.{{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->total_amount_in_rs : '_____' }}/- 

                 (Rs. {{  converNumberToWord(($calculationData->sharingCalculationSheet) !="" ? str_replace( ',', '',$calculationData->sharingCalculationSheet->total_amount_in_rs) : '' ) }}) may be paid in the office of the Chief Accounts Officer/ Mumbai Board, Third Floor, Griha Nirman Bhavan, Bandra (E), Mumbai – 400051 by Demand Draft/ Pay Order within SIX months from the date of issue of this letter and produce certified Xerox copy of the receipt in this office.</p> 
                <p style="text-indent: 25px; margin-top: 5px; margin-bottom: 5px;">The society should pay Rs. 

                {{ ($calculationData->sharingCalculationSheet) !="" ? $calculationData->sharingCalculationSheet->amount_to_b_paid_to_municipal_corporation : '_____' }}/- 

                (In words Rs. {{  converNumberToWord(($calculationData->sharingCalculationSheet) !="" ? str_replace( ',', '',$calculationData->sharingCalculationSheet->amount_to_b_paid_to_municipal_corporation) : '' ) }}) in the office of the Executive Engineer, {{($calculationData->eeApplicationSociety->address ? $calculationData->eeApplicationSociety->address : '')}}., within SIX months from the date of issue of this letter  and produce certified Xerox copy of the receipt in this office.</p>                 
                <p style="text-indent: 25px; margin-top: 5px; margin-bottom: 5px;">On receipt of the same & after execution of tripartite agreement as mentioned above  for surrender of constructed BUA as MHADA's share the NOC will be  processed under certain terms and condition, which may please, be noted.</p>                
                <p style="margin-bottom: 5px; margin-top: 5px;">Encl.: Annexure-I </p>
                <p style="margin-bottom: 5px; margin-top: 5px; font-weight: bold;">(Draft approved by CO/MB) </p>
                <div>
                    <div style="float: left; width: 70%">
                    </div>
                    <div style="margin-bottom: 5px; margin-top: 5px; font-weight: bold; float: left; width: 30%;">
                        <div style="text-align: center;">
                            <span style="display: block;">Sd/-</span>
                            <span style="display: block;">(Bhushan R. Desai)</span>
                            <span style="display: block; font-weight: bold;">Resident Executive Engineer.</span>
                            <span style="display: block; font-weight: bold;">M. H. & A. D. Board</span>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>

            <div style="margin-top: 30px; line-height: 1.5;">
                <p style="margin-bottom: 5px; margin-top: 5px;"><span style="font-weight: bold;">Copy to The Executive
                        Engineer, </span>Executive Engineer, ________________________________</p>
                <p style="margin-bottom: 5px; margin-top: 5px;"><span style="font-weight: bold;">Copy to Architect for
                        information: </span>

                        {{($calculationData->eeApplicationSociety->name_of_architect ? $calculationData->eeApplicationSociety->name_of_architect : '')}}, 

                        {{($calculationData->eeApplicationSociety->architect_address ? $calculationData->eeApplicationSociety->architect_address : '')}}  for information.</p>
                <div style="margin-bottom: 5px; margin-top: 5px;">
                    <span style="font-weight: bold; display: block;">Copy forwarded for information and necessary
                        action in the matter to: -</span>
                    <p style="margin-bottom: 5px; margin-top: 5px;">1) Architect, Layout Cell, Mumbai Board</p>
                    <p style="margin-bottom: 0; margin-top: 15px;">2) Executive Engineer, Housing Kurla Division.</p>
                    <div style="padding-left: 15px;">
                        <div style="float: left; width: 4%;">i.</div>
                        <div style="float: left; width: 96%;">He is directed to take necessary action as per demarcation & as per prevailing policy of MHADA.</div>
                        <div style="clear: both;"></div>
                        <div style="float: left; width: 4%;">ii.</div>
                        <div style="float: left; width: 96%;">He is directed to recover all the dues from the society concerned to Estate Department  & intimate the same to this office.</div>
                        <div style="clear: both;"></div>
                        <div style="float: left; width: 4%;">iii.</div>
                        <div style="float: left; width: 96%;">He is directed to recover any dues, land revenue, audit remarks concerned to Land Department if any pending with the society & intimate the same to this office.</div>
                        <div style="clear: both;"></div>
                    </div>
                    <p style="margin-bottom: 0; margin-top: -10px;">3) Chief Accounts Office/M.B.
                        <div style="text-indent: 50px; margin-top: 2px;">He is directed to recover the amount of offer letter on time & furnish certified copy to this office. As well as check above calculation of offer letter thoroughly. If any changes / irregularities found in the said offer letter intimate to this office accordingly.</div></p>
                    <p style="margin-bottom: 0; margin-top: -50px;">4) Copy to _______ / Sr. Clerk for MIS record.</p>
                </div>
                <div>
                    <div style="float: left; width: 70%">
                    </div>
                    <div style="margin-bottom: 5px; margin-top: 5px; font-weight: bold; float: left; width: 30%;">
                        <div style="text-align: center;">
                            <span style="display: block;">For Chief Officer,</span>
                            <span style="display: block; font-weight: bold;">M. H. & A. D. Board</span>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>

            <!-- Annexure-I starts here -->

            <div style="margin-top: 30px; line-height: 1.5;">
                <h3 style="text-transform: uppercase; font-weight: bold; text-align: center;">Annexure - I</h3>
                <p style="margin-bottom: 5px; margin-top: 5px; text-indent: 5%;">The work of proposed redevelopment of existing building No. {{($calculationData->eeApplicationSociety->building_no ? $calculationData->eeApplicationSociety->building_no : '')}}, known as  _______________________________________________ under  DCR 33(5), dated 08.10.2013 & it's modification dated 03.07.2017 will be undertaken by the society as per following terms and conditions :-</p>
            </div>

            <div style="margin-top: 30px; line-height: 1.5;">
                <h3 style="text-transform: uppercase; font-weight: bold; text-align: center;">TERMS AND CONDITIONS</h3>
                <div>
                    <div style="width: 4%; float: left;">1.</div>
                    <div style="width: 96%; float: left;">All the terms and conditions mentioned in the lease agreement
                        & conveyance is binding on the society.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">2.</div>
                    <div style="width: 96%; float: left;">The society will rectify lease agreement from concern MHADA department for subdivided area allotted by the MHADA before asking for consent letter for Occupation Certificate of MCGM.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">3.</div>
                    <div style="width: 96%; float: left;">The society will have to obtain separate P. R. card as per the approved sub divided area leased out by the board duly signed by S. L. R. before asking for consent letter for Occupation Certificate of M.C.G.M.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">4.</div>
                    <div style="width: 96%; float: left;">This offer letter will not be misused for taking out any kind
                        of permission from any departments.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">5.</div>
                    <div style="width: 96%; float: left;">The work of the proposed demolition & reconstruction of the
                        new building will be undertaken by the society entirely at the risk and cost of the society and
                        MHADA / MHADB will not be held responsible for any kind of damages or losses.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">6.</div>
                    <div style="width: 96%; float: left;">The society will undertake & entrust responsibility of the
                        planning, designing approval from S.P.A./ MHADA & day to day supervision of the proposed
                        demolition and reconstruction / development of the new building by the Licensed Architect
                        registered with the council of Architecture and licensed Structural Engineer.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">7.</div>
                    <div style="width: 96%; float: left;">The society is responsible for obtaining all necessary
                        permissions & approvals for utilization of additional BUA from the S.P.A./ MHADA & other
                        concerned authorities (such as MOEF, MCZM, forest etc) before starting of the work & MHADA is
                        not responsible for S.P.A./ MHADA / other authorities refuse to give permission for development
                        of society's proposal.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">8.</div>
                    <div style="width: 96%; float: left;">Society will be responsible for any kind of litigation or
                        legal consequence arising an account of the proposed of the building.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">9.</div>
                    <div style="width: 96%; float: left;">All the terms & conditions mentioned in the offer letter No.
                        CO/MB/REE/NOC/F-1008/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/2018
                        is binding on the society.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">10.</div>
                    <div style="width: 96%; float: left;">Any kind of payment or constructed tenement asked by the MHADA will be fulfilled by the society.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">11.</div>
                    <div style="width: 96%; float: left;">No additional FSI will be utilized by the society other than
                        permitted by the MHADA.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">12.</div>
                    <div style="width: 96%; float: left;">The work will be carried out within the land underneath and
                        appurtenant as per approved sub-divisions, demarcation and plot area allotted by the concerned
                        department of MHADA.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">13.</div>
                    <div style="width: 96%; float: left;">Responsibility of any damage or loss of adjoining properties
                        if any will vest entirely with the applicant and MHADB will not be responsible in any manner.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">14.</div>
                    <div style="width: 96%; float: left;">The user of the proposed development / redevelopment will be
                        as permitted by the MHADA.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">15.</div>
                    <div style="width: 96%; float: left;">The society will have to construct and maintain separate underground water tank, pump house and over-head tank to meet requirement of the proposed buildings and obtain separate water meter & water connection as per approvals of M.C.G.M.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">16.</div>
                    <div style="width: 96%; float: left;">The Society will construct compound wall along boundary line of the plot allotted by the Board and as per the demarcation given by the concerned Executive Engineer / M.B. and Asstt. Land Manager / M.B.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">17.</div>
                    <div style="width: 96%; float: left;">Society will hand over the set back area if any free of cost to the MCGM at their own cost.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">18.</div>
                    <div style="width: 96%; float: left;">The society at its cost will undertake up-gradation of all existing infrastructure and also carry-out laying of new infrastructural services at its cost as suggested by MCGM, MHADA and any other concerned Authority.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">19.</div>
                    <div style="width: 96%; float: left;">All the terms and conditions of the layout approval of the MCGM will be binding on the society.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">20.</div>
                    <div style="width: 96%; float: left;">Fungible area shall be used proportionally for MHADA share, rehab share & sale area.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">21.</div>
                    <div style="width: 96%; float: left;">Carpet area for rehab shall be same as per DCR 33(5) dt. 14.11.2013 & it's modification dated 03.07.2017.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">22.</div>
                    <div style="width: 96%; float: left;">The society shall have to construct MHADA share with permissible fungible area & handover  it  to MHADA free of cost.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">23.</div>
                    <div style="width: 96%; float: left;">Appointment of the developer shall be as per 'ÍããÔã¶ã ãä¶ã¥ãÃ¾ã ‰ãŠ.ÔãØãð¾ããñ 207/¹ãÆ.‰ãŠ.554/14-Ôã,ÔãÖ‡ãŠãÀãè ¹ã¥ã¶ã Ìã ÌãÔ¨ããñ²ããñØã ãäÌã¼ããØã ãäª. 03.01.2009' </div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">24.</div>
                    <div style="width: 96%; float: left;">It is responsibility of the developer to construct MHADA share & rehab tenements as per min. specification provided by MHADA & the work should be completed within time limit.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">25.</div>
                    <div style="width: 96%; float: left;">The plans for approval of proposed redevelopment scheme shall be submitted to MCGM through MHADB.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">26.</div>
                    <div style="width: 96%; float: left;">After IOD the society, MHADA & Developer shall have to enter tripartite agreement, for handing over of MHADA share.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">27.</div>
                    <div style="width: 96%; float: left;">It is developer responsibility to get OC for the construction.</div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">28.</div>
                    <div style="width: 96%; float: left;">
                        <div style="font-weight: bold;">Time limit for Project</div>
                        <div>a) The Developer /Architect appointed by society, will have to  obtain approvals from MCGM and other concerned authorities (MOEF, MCGM, forest, Road, Drainage etc.) within 6 months from issue of NOC for IOD purpose & complete the construction within 2.5 years before issue of C.C. by MCGM for the built up area upto 20000 sq.mt.</div>
                    </div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">&nbsp;</div>
                    <div style="width: 96%; float: left;">
                        <div>b) The Developer /Architect appointed by society, will have to obtain approvals from MCGM and other concerned authorities (MOEF, MCGM, forest, Road, Drainage etc.) within 1 year  from issue of NOC for IOD purpose  & complete the construction within 3  years, before issue of C.C. by MCGM for the built up area above 20000 sq.mt.</div>
                    </div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">29.</div>
                    <div style="width: 96%; float: left;">
                        <div>If the rehab area, MHADA share & Developers share are proposed in different buildings, then the percentage of sale area permitted for construction is as per table below :- </div>
                    </div>
                    <div style="clear: both;"></div>
                        <div>
                            <table style="width: 100%; border-collapse: collapse; text-align: center;">
                                <thead>
                                    <tr>
                                        <td style="border: 1px solid #000; padding: 5px 0;">Sr. No</td>
                                        <td style="border: 1px solid #000; padding: 5px 0;">Description</td>
                                        <td style="border: 1px solid #000; padding: 5px 0;">Proportion  of Built up area</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border: 1px solid #000; padding: 5px 0;">1.</td>
                                        <td style="border: 1px solid #000; padding: 5px 0;">Rehab area</td>
                                        <td style="border: 1px solid #000;">
                                            <table style="width: 100%; border-collapse: collapse; padding: 0;">
                                                <tbody>
                                                    <tr>
                                                        <td style="border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 12.5%">25%</td>
                                                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 12.5%">50%</td>
                                                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 12.5%">75%</td>
                                                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 25%;">100% O.C.</td>
                                                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 25%;">W.S. Connect</td>
                                                        <td style="border-left: 1px solid #000; padding: 5px 0; text-align: center; width: 12.5%">BCC</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #000; padding: 5px 0; text-align: center;">2.</td>
                                        <td style="border: 1px solid #000; padding: 5px 0; text-align: center;">MHADA Share</td>
                                        <td style="border: 1px solid #000; text-align: center;">
                                            <table style="width: 100%; border-collapse: collapse; padding: 0;">
                                                <tbody>
                                                    <tr>
                                                        <td style="border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 12.5%">25%</td>
                                                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 12.5%">50%</td>
                                                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 12.5%">75%</td>
                                                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 25%;">100% O.C.</td>
                                                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 25%;">W.S. Connect</td>
                                                        <td style="border-left: 1px solid #000; padding: 5px 0; text-align: center; width: 12.5%">BCC</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #000; padding: 5px 0; text-align: center;">3.</td>
                                        <td style="border: 1px solid #000; padding: 5px 0; text-align: center;">Sale area</td>
                                        <td style="border: 1px solid #000; text-align: center;">
                                            <table style="width: 100%; border-collapse: collapse; padding: 0;">
                                                <tbody>
                                                    <tr>
                                                        <td style="border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 12.5%">15%</td>
                                                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 12.5%">30%</td>
                                                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 12.5%">40%</td>
                                                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 25%;">75%</td>
                                                        <td style="border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px 0; text-align: center; width: 25%;">90%</td>
                                                        <td style="border-left: 1px solid #000; padding: 5px 0; text-align: center; width: 12.5%">100%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">30.</div>
                    <div style="width: 96%; float: left;">
                        <div>The NOC for Occupation Certificate for sale area shall be permitted after handing over of MHADA share & rehab share.</div>
                    </div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">31.</div>
                    <div style="width: 96%; float: left;">
                        <div>The developer will have to construct rehab share at lower side, MHADA share in middle & developer share on upper floors, where only one bldg. is proposed.</div>
                    </div>
                    <div style="clear: both;"></div>
                    <div style="width: 4%; float: left;">32.</div>
                    <div style="width: 96%; float: left;">
                        <div>If more than one society, are proposed joint redevelopment, then 70% consent of  each society shall be necessary,  in prescribed format by MHADA.</div>
                    </div>
                    <div style="clear: both;"></div>
                    <p style="margin-bottom: 5px; margin-top: 5px; font-weight: bold;">(Draft approved by CO/MB)</p>
                    <div>
                        <div style="float: left; width: 70%">
                        </div>
                        <div style="margin-bottom: 5px; margin-top: 5px; font-weight: bold; float: left; width: 30%;">
                            <div style="text-align: center;">
                                <span style="display: block;">Sd/-</span>
                                <span style="display: block;">(Bhushan R. Desai)</span>
                                <span style="display: block; font-weight: bold;">Resident Executive Engineer.</span>
                                <span style="display: block; font-weight: bold;">M. H. & A. D. Board</span>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            </div>

            <!-- Annexure-I ends here -->

        </div>
    </div>

</textarea>
        <input type="submit" value="save" style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;">

    </form>
</body>

</html>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.replace('ckeditorText', {
        height: 700,
        allowedContent: true
    });

</script>
<script>