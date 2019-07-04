<div id="printdiv">
    <div style="font-size: 18px;">
        <div>
            <div style="text-align: center;">
                <!-- <h3 style="font-weight: bold; margin-top: 5px; margin-bottom: 5px;">अर्जाचा नमुना</h3> -->
            </div>
            <div>
                <p>
                    <p style="display: block; font-weight: bold; line-height: 0; margin-top: 5px; margin-bottom: 5px;">To,</p>
                    <table style="margin-left: -5px; margin-top: 5px; margin-bottom: 5px;">
                        <tbody>
                            <tr>
                                <td style="font-size: 18px;">Executive Engineer</td>
                               <!--  <td style="border-bottom: 1px solid #000; font-size: 18px;">REE</td> -->
                                <!-- <td style="font-size: 18px;">विभाग,</td> -->
                            </tr>
                        </tbody>
                    </table>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Mumbai Housing and Area Development Board, </p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">2nd floor, Griha Nirman Bhavan</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">Bnadra (E) Mumbai - 400051.</p>
                </p>
            </div>
        </div>
        <div>
            <div style="line-height: 1.5;">

                <p><span class="font-weight-semi-bold"> Subject - 
                </span>Request for Occupation Certificate  for the building no {{ $society_details->building_no }} , {{ $society_details->name }} , cts no {{ $oc_application->request_form->cts_no }}, {{ $oc_application->applicationMasterLayout[0]->layout_name }} 
               <!--  </span>Application for @if($oc_application->request_form->is_full_oc==1) Full OC @else Part OC @endif  for rehab portion and sale component of the Proposed redevelopment of the existing Building No. <input type="hidden" name="application_master_id" value="{{ $id }}" readonly>{{ $society_details->building_no }} (address ) {{ $society_details->address }} For (society name) {{ $society_details->name }} -->


                <p class="font-weight-semi-bold">Dear sir,</p>
                <p>
                    With reference to the above subject, we have completed building construction, as per NOC issued by your office.
                </p>
                <p>Photograph of newly constructed building and other documents are attached herewith for your reference.</p>

                @if($oc_application->request_form->is_full_oc)
                    <p>We therfore request you to kindly grant us the Consent for Full OC to the building at the earlist. </p> 
                @else
                    <p>But since supplymentry lease deed of {{ $oc_application->request_form->lease_deed_area }} sq.mt of tit bit land, is not executed, we request you to kindly grant us consent for part occupasion certificate of {{ $oc_application->request_form->floor }}, {{ $oc_application->request_form->floor_no }} floors.</p>
                @endif 
                
                @if(isset($comments))
                <p>Society Comments : {{ $comments->society_documents_comment }}</p>
                @endif 

                <!-- <p><span class="font-weight-semi-bold">Construction Details: </span>
                    {{ $oc_application->request_form->construction_details }}
                </p> -->

                <!-- <p>
                    As the work is completed we have to obtain  @if($oc_application->request_form->is_full_oc==1) full @else part @endif occupation permission from MCGM to reaccomodate the existing members. As per the condition of the offer letter and NOC issued by MHADA, MHADA shall issue NOC for OC.
                </p>

                <p>
                    We therefore request you to kindly grant us the NOC for  @if($oc_application->request_form->is_full_oc==1) Full OC @else Part OC @endif for rehab unit and sale component as mentioned above at the earliest.
                </p> -->

                <p>
                    Thanking you,
                </p>
                <!-- <p>
                    Yours faithfully,
                </p> -->



            </div>
            <div style="margin-top: 30px;">
                <div style="float: right; text-align: right;">
                    <p style="margin-top: 0; margin-bottom: 60px;">Yours faithfully,</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">अध्यक्ष / सचिव / खजिनदार</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">------- स.गृ.नि. संस्था मर्या.</p>
                </div>
            </div>
        </div>
    </div>
</div>