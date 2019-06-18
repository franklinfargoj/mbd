<div id="printdiv">
    <div style="font-size: 18px;">
        <div>
            <div style="text-align: center;">
                <!-- <h3 style="font-weight: bold; margin-top: 5px; margin-bottom: 5px;">अर्जाचा नमुना</h3> -->
            </div>
            <div>
                <p>
                    <p style="display: block;line-height: 0; margin-top: 5px; margin-bottom: 5px;">To</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Resident Executive Engineer,</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">M.H. & A.D Board, Grihaniman Bhavan</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Kalanagar, Bandra (East),Mumbai - 400051,</p>
                </p>
            </div>
        </div>
        
        <div>
            <div style="line-height: 1.5;">
                <p style="text-indent: 20px;"><span style="display: block; ">Subject :- </span>Proposed Redevelopment of existing building number <span style="width: 50px; border-bottom: 1px solid #000;">{{ $society_details->building_no }} </span> known as <span style="width: 200px; border-bottom: 1px solid #000;">{{ $society_details->name }}</span> situated at  <span style="width: 200px; border-bottom: 1px solid #000;">{{ $society_details->address }}</span> under DCR 33(5). </p>

                <p style="text-indent: 20px;"><span style="display: block;">Ref :- </span>Offer Letter No. <span style="width: 50px; border-bottom: 1px solid #000;">{{ $noc_application->request_form->offer_letter_number }}</span>, dated <span style="width: 200px;">{{ date('j F Y',strtotime($noc_application->request_form->offer_letter_date)) }}</span> . </p>


                <p>Dear Sir,</p>
                @if(isset($noc_application->noc_application_master) && $noc_application->noc_application_master->model == 'Sharing')

                    <p>With reference to the offer letter, we have made payment for offsite infrastructure charges of Rs. <span style="width: 50px; border-bottom: 1px solid #000;"> {{ isset($noc_application->request_form) ? $noc_application->request_form->demand_draft_amount : '' }} </span> to CAO mumbai Board, on dated 
                    <span style="width: 50px; border-bottom: 1px solid #000;">{{ date('j F Y',strtotime($noc_application->request_form->demand_draft_date)) }}
                     </span> Also, payment of offsite infrastructure charges to planning authority MHADA of Rs. <span style="width: 50px; border-bottom: 1px solid #000;"> {{ isset($noc_application->request_form) ? $noc_application->request_form->offsite_infra_charges : '' }} </span> has been made on <span style="width: 50px; border-bottom: 1px solid #000;">{{ date('j F Y',strtotime($noc_application->request_form->offsite_infra_charges_receipt_date)) }}
                     </span> The Receipts are enclosed herewith reference. Also have submitted various under taking, Indemnity bonds, and No dues certificate from EM. </p>
                     <p>Hence we request you to grant issue us NOC for IOD / IOA.</p>

                    <!-- <p>Reference is requested to the subject mentioned above vide Reference MHADA issued us the offer letter for additional FSI. Accordingly we have made payment to the Chief Accounts officer vide Demand draft / Pay order of Rs <span style="width: 50px; border-bottom: 1px solid #000;"> {{ isset($noc_application->request_form) ? $noc_application->request_form->demand_draft_amount : '' }} </span> in favour of Chief accounts officer,Mumbai board,MHADA bearing No.  <span style="width: 50px; border-bottom: 1px solid #000;"> {{ isset($noc_application->request_form) ? $noc_application->request_form->demand_draft_number : '' }} </span> Dtd <span style="width: 50px; border-bottom: 1px solid #000;">{{ date('j F Y',strtotime($noc_application->request_form->demand_draft_date)) }}
                     </span> drawn on <span style="width: 50px; border-bottom: 1px solid #000;"> {{ isset($noc_application->request_form) ? $noc_application->request_form->demand_draft_bank : '' }} </span> towards first installment payment of allotment of said FSI. A copy of the receipt is enclosed herewith for your reference. Also we are submitting various Undertakings & Indemnity Bonds and No Dues Certificate as mentioned in the Offer Letter.</p> -->

                @elseif(isset($noc_application->noc_application_master) && $noc_application->noc_application_master->model == 'Premium')
                    <p>
                        As per the differed payment facility granted by MHADA, we have made the payment of  RS. 
                        <span style="width: 50px; border-bottom: 1px solid #000;"> {{ isset($noc_application->request_form) ? $noc_application->request_form->demand_draft_amount : '' }} </span>
                        
                        ({{ $ntw->numToWord((($noc_application->request_form) != '' && ($noc_application->request_form->demand_draft_amount) != '') ? $noc_application->request_form->demand_draft_amount : 0 ) }}) 
                         vide recipt No :  <span style="width: 50px; border-bottom: 1px solid #000;"> {{ isset($noc_application->request_form) ? $noc_application->request_form->demand_draft_number : '' }}</span>
                        &&  <span style="width: 50px; border-bottom: 1px solid #000;"> {{ isset($noc_application->request_form) ? $noc_application->request_form->water_charges_receipt_number : '' }} 
                        </span>. Dtd <span style="width: 50px; border-bottom: 1px solid #000;">{{ isset($noc_application->request_form) ? date('j F Y',strtotime($noc_application->request_form->demand_draft_date)) : '' }}</span>
                         in the office of Chief Accounts Officer, Mumbai Board being 1 st installement as per table -2 of the Offer Letter under ref No 1 And, demand draft for an amount of Rs. 
                         <span style="width: 50px; border-bottom: 1px solid #000;"> {{ isset($noc_application->request_form) ? $noc_application->request_form->offsite_infra_charges : '' }}</span>
                         ({{ $ntw->numToWord((($noc_application->request_form) != '' && ($noc_application->request_form->offsite_infra_charges) != '') ? $noc_application->request_form->offsite_infra_charges : 0 ) }}) being offsite infrastructure charges is deposited with Accounts Officer Building Permission MHADA vide receipt No . 
                         <span style="width: 50px; border-bottom: 1px solid #000;">{{ isset($noc_application->request_form) ? $noc_application->request_form->offsite_infra_receipt : '' }} </span>
                           Dtd <span style="width: 50px; border-bottom: 1px solid #000;">{{ isset($noc_application->request_form) ? date('j F Y',strtotime($noc_application->request_form->offsite_infra_charges_receipt_date)) : '' }}</span>
                    </p>
                    <p>Whereas, vide our letter under ref no .2 we have already submitted the Indemnity bond and Undertakings. Now, we are submitting here with the No Dues Certificate along with the payment receipts. Therefore, we here by request you to issue the NOC for IOD for full BUA i.e <span style="width: 50px; border-bottom: 1px solid #000;">{{$noc_application->request_form->full_bua}}</span> m2 and NOC for CC for Existing BUA <span style="width: 50px; border-bottom: 1px solid #000;">{{$noc_application->request_form->existing_bua}}</span></p>m2  + <span style="width: 50px; border-bottom: 1px solid #000;">{{$noc_application->request_form->selected_bua}}</span> % BUA <span style="width: 50px; border-bottom: 1px solid #000;">({{$noc_application->request_form->percent_bua}})</span> m2 i.e Total <span style="width: 50px; border-bottom: 1px solid #000;">{{$noc_application->request_form->total_bua}}</span>m2, for which we have made the payment to MHADA.</p>
                    <p>Hence we request you to grant us the No Objection Certificate at the earliest.</p>
                @endif

                
                @if(isset($comment))
                    <p>Society Comments : {{ $comment }}</p>
                @endif    
            </div>
            <div style="margin-top: 70px;">
                <div style="float: left; text-align: left;">
                    <p>Thanking you,</p>
                    <p>Yours Truly</p>
                    <p style="margin-top: 0; margin-bottom: 5px;font-weight:bold;">From {{$society_details->name}}</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Chairman /Secretary / Treasurer</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Encl:- Payment receipt, Undertakings & Indemnity bonds ,No dues certificate</p>
                </div>
            </div>
        </div>
    </div>
</div>