<div id="printdiv">
    <div style="font-size: 18px;">
        <div>
            <div style="text-align: center;">
                <h3 style="font-weight: bold; margin-top: 5px; margin-bottom: 5px;">अर्जाचा नमुना</h3>
            </div>
            <div>
                <p>
                    <p style="display: block; font-weight: bold; line-height: 0; margin-top: 5px; margin-bottom: 5px;">To</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Chief Officer,M.H. & A.D Board,</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Grihaniman Bhavan,Kalanagar,,</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Bandra (East),Mumbai - 400051,</p>
                </p>
            </div>
        </div>
        <div>
            <div style="line-height: 1.5;">
                <p style="text-indent: 20px;"><span style="display: block; font-weight: bold;">Subject :- </span>Proposed Redevelopment of existing building number. <span style="width: 50px; border-bottom: 1px solid #000;">{{ $society_details->building_no }} </span>,known as <span style="width: 200px; border-bottom: 1px solid #000;">{{ $society_details->name }}</span> situated at  <span style="width: 200px; border-bottom: 1px solid #000;">{{ $society_details->address }}</span> under DCR 33(5). </p>

                <p style="text-indent: 20px;"><span style="display: block; font-weight: bold;">Ref :- </span>Offer Letter No. <span style="width: 50px; border-bottom: 1px solid #000;">{{ $noc_application->request_form->offer_letter_number }}</span>,dated <span style="width: 200px; border-bottom: 1px solid #000;">{{ date('j F Y',strtotime($noc_application->request_form->offer_letter_date)) }}</span> . </p>


                <p style="font-weight: bold;">Dear Sir,</p>
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
                        <p>Whereas, vide our letter under ref no .2 we have already submitted the Indemnity bond and Undertakings. Now, we are submitting here with the No Dues Certificate along with the payment receipts. Therefore, we here by request you to issue.</p>
                <p>Hence we request you to grant us the No Objection Certificate at the earliest..</p>
                <p>Thanking you,</p>
                <p>Yours Truly</p>
            </div>
            <div style="margin-top: 30px;">
                <div style="float: left; text-align: left;">
                    <p style="margin-top: 0; margin-bottom: 5px;font-weight:bold;">For {{$society_details->name}}</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Chairman /Secretary / Treasurer</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Encl:- Payment receipt, Undertakings & Indemnity bonds ,No dues certificate</p>
                </div>
            </div>
        </div>
    </div>
</div>