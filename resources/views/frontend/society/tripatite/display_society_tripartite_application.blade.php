<div id="printdiv">
    <div style="font-size: 18px;">
        <div>
            <div style="text-align: center;">
                <h6 style="font-weight: bold; margin-top: 5px; margin-bottom: 5px; margin-left: 550px">Date: {{ date('d-m-Y', strtotime($ol_applications->created_at)) }}</h6>
            </div>
            <div>
                <p>
                    <p style="display: block; font-weight: bold; line-height: 0; margin-top: 5px; margin-bottom: 5px;">To,</p>
                    <p style="display: block; font-weight: bold; line-height: 0; margin-top: 5px; margin-bottom: 5px;">The Executive Engineer,</p>
                    <p style="display: block; margin-top: 3px; margin-bottom: 3px;">MHADA,</p>
                    <p style="display: block; margin-top: 3px; margin-bottom: 3px;">Gruha Nirman Bhuvan,</p>
                    <p style="display: block; margin-top: 3px; margin-bottom: 3px;">Bandra East,</p>
                    <p style="display: block; margin-top: 3px; margin-bottom: 3px;">Mumbai-400 051.</p>
                </p>
            </div>
        </div>
        <div>
            <div style="line-height: 1.5;">
                <p  style="text-indent: 80px;"><span style="display: block; font-weight: bold;">Subject :- </span> Proposed Redevelopment of Residential building of {{ $society_details->name }}, on plot number {{ $society_details->building_no }}, {{ $society_details->address }}.</p>

                <p style="text-indent: 80px;"><span style="display: block; font-weight: bold;">Ref :- </span>1. Offer Letter No. {{ $ol_applications->request_form->offer_letter_number }} dated {{date('j F Y',strtotime($ol_applications->request_form->offer_letter_number))}}</p>
                <span style="margin-left: 36px"></span>2. NOC for IOD purpose bearing No. {{ $ol_applications->request_form->noc_for_iod_purpose_number }} dated {{date('j F Y',strtotime($ol_applications->request_form->noc_for_iod_purpose_date))}}</p>

                <p style="font-weight: bold;">Dear Sir/ Madam,</p>
                <p>
                    We enclose herewith the TRI-PARTY Agreement between MHADA of the first part, {{ $society_details->name }} second part, {{$ol_applications->request_form->developer_name}} third part for grant of No Objection Certificate for the purpose of redevelopment.
                </p>
                <p>We request your goodselves to please arrange to excute the Tri-Party Agreement and issue us the NOC and CC to proceed further.</p>
                <p>Please do the needful at the earliest and oblige.</p>
            </div>
            <div style="margin-top: 30px;">
                <div style="float: right; text-align: right;">
                    <p style="margin-top: 0; margin-bottom: 60px;">Thanking You,</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Best Regards</p>
                    {{--<p style="display: block; margin-top: 5px; margin-bottom: 5px;">------- स.गृ.नि. संस्था मर्या.</p>--}}
                </div>
            </div>
        </div>
    </div>
</div>