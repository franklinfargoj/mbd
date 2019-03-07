<div id="printdiv">
    <div style="font-size: 18px;">
        <div>
            <div style="text-align: center;">
                <h3 style="font-weight: bold; margin-top: 5px; margin-bottom: 5px;">अर्जाचा नमुना</h3>
            </div>
            <div>
                <p>

                    <p style="display: block; font-weight: bold; line-height: 0; margin-top: 5px; margin-bottom: 5px;">To,</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">The Resident Executive Engineer,</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">MHADA,</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Gruhnirman Bhuvan,</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Bandra (East),Mumbai - 400051.</p>
                </p>
            </div>
        </div>
        <div>
            <div style="line-height: 1.5;">
                <p style="text-indent: 20px;"><span style="display: block; font-weight: bold;">Subject :- </span> Proposed Redevelopment of Residential building of <span style="width: 200px; border-bottom: 1px solid #000;">{{ $society_details->name }}</span>, on plot number <span style="width: 200px; border-bottom: 1px solid #000;">{{ $society_details->building_no }}</span>, <span style="width: 200px; border-bottom: 1px solid #000;">{{ $society_details->address }}</span>.</p><p>Issue of NOC & CC.</p>
                <p style="text-indent: 20px;"><span style="display: block; font-weight: bold;">Ref :- </span>1. Offer Letter No. <span style="width: 200px; border-bottom: 1px solid #000;">{{ $noc_application->request_form->offer_letter_number }}</span> dated <span style="width: 200px; border-bottom: 1px solid #000;">{{date('j F Y',strtotime($noc_application->request_form->offer_letter_date))}}</span></p>
                <span style="margin-left: 36px"></span>2. IOD Hearing No. <span style="width: 200px; border-bottom: 1px solid #000;">{{ $noc_application->request_form->noc_no }}</span> dated <span style="width: 200px; border-bottom: 1px solid #000;">{{date('j F Y',strtotime($noc_application->request_form->noc_date))}}</span></p>
                <span style="margin-left: 36px"></span>3. Tripartite Agreement Dated <span style="width: 200px; border-bottom: 1px solid #000;">{{date('j F Y',strtotime($noc_application->request_form->tripartite_agreement_date))}}</span></p>
                <hr>

                <p style="font-weight: bold;">Dear Sir,</p>
                <p style="text-indent: 80px;">
                    Enclosing herewith the TRI-PARTY Agreement between MHADA first part,   <span style="width: 200px; border-bottom: 1px solid #000;">{{ $society_details->name }}" </span> second part, <span style="width: 200px; border-bottom: 1px solid #000;">{{$noc_application->request_form->developer_name}} </span> third part, being registered on payment of all necessary charges.
                </p>
                <p>We now request your goodselves to proceed further for the issue NOC & CC at the earliest and oblige. </p>
                <p>Kindly do the needful. </p>
                <p>Thanking You,</p>
                <p>Yours faithfully,</p>
            </div>
            <div style="margin-top: 30px;">
                <div style="float: left; text-align: left;">
                    <p style="margin-top: 0; margin-bottom: 5px;font-weight:bold;">For {{$society_details->name}}</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Chairman /Secretary / Treasurer</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Encl:- As above</p>
                </div>
            </div>
        </div>
    </div>
</div>