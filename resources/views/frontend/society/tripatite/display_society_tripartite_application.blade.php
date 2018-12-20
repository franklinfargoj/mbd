<div id="printdiv">
    <div style="font-size: 18px;">
        <div>
            <div style="text-align: center;">
                <h6 style="font-weight: bold; margin-top: 5px; margin-bottom: 5px; margin-left: 550px">Date: {{ date('d-m-Y', strtotime($ol_applications->created_at)) }}</h6>
            </div>
            <div>
                <p>
                <p style="display: block; font-weight: bold; line-height: 0; margin-top: 5px; margin-bottom: 5px;">To,</p>
                <p style="display: block; font-weight: bold; line-height: 0; margin-top: 5px; margin-bottom: 5px;">The Resident Executive Engineer, (R.E.E),</p>
                <table style="margin-left: -5px; margin-top: 5px; margin-bottom: 5px;">
                    <tbody>
                    <tr>
                        {{--<td style="font-size: 18px;">The Resident Executive Engineer, (R.E.E),</td>--}}
                        {{--<td style="border-bottom: 1px solid #000; font-size: 18px;">MHADA, Mumbai Board</td>--}}
                        {{--<td style="font-size: 18px;">Kalanagar, Bandra - (E),</td>--}}
                    </tr>
                    </tbody>
                </table>
                {{--<p style="display: block; margin-top: 3px; margin-bottom: 3px;">The Resident Executive Engineer, (R.E.E),</p>--}}
                <p style="display: block; margin-top: 3px; margin-bottom: 3px;">MHADA, Mumbai Board,</p>
                <p style="display: block; margin-top: 3px; margin-bottom: 3px;">Kalanagar, Bandra - (E),</p>
                <p style="display: block; margin-top: 3px; margin-bottom: 3px;">Mumbai-400 051.</p>
                </p>
            </div>
        </div>
        <div>
            <div style="line-height: 1.5;">
                <p style="text-indent: 80px;"><span style="display: block; font-weight: bold;">Subject :- </span>Proposed redevelopment of the existing <span style="width: 50px; border-bottom: 1px solid #000;">{{ $society_details->building_no }}</span>, known as <span style="width: 200px; border-bottom: 1px solid #000;">{{ $society_details->name }}</span> along with O.B. No. and adjacent plot No. , bearing CTS No.(pt.) of Village - .</p>
                <p style="font-weight: bold;">Dear Sir,</p>
                <p>Herewith we are submitting draft copy of Tripartite Agreement to be executed as per the Offer Letter No <span><b>{{ $ol_applications->request_form->offer_letter_number }}</b></span>, Dated <b>{{ $ol_applications->request_form->offer_letter_date }}</b> and Revised Offer Letter No. <b>{{ $ol_applications->request_form->revised_offer_letter_number }}</b>, Dated <b>{{ $ol_applications->request_form->revised_offer_letter_date }}</b> and Revised NOC for IOD Purpose <b>{{ $ol_applications->request_form->noc_for_iod_purpose_number }}</b>, Dated <b>{{ $ol_applications->request_form->noc_for_iod_purpose_date }}</b>.</p>
                <p>So please acknowledge the receipt of the same.</p>
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