<div id="printdiv">
    <div style="font-size: 18px;">
        <div>
            <div style="text-align: center;">
                <!-- <h3 style="font-weight: bold; margin-top: 5px; margin-bottom: 5px;">अर्जाचा नमुना</h3> -->
            </div>
            <div>
                <p>
                    <p style="display: block; font-weight: bold; line-height: 0; margin-top: 5px; margin-bottom: 5px;">प्रति,</p>
                    <table style="margin-left: -5px; margin-top: 5px; margin-bottom: 5px;">
                        <tbody>
                            <tr>
                                <td style="font-size: 18px;">कार्यकारी अभियंता,</td>
                                <td style="border-bottom: 1px solid #000; font-size: 18px;">REE</td>
                                <td style="font-size: 18px;">विभाग,</td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">मुंबई गृहनिर्माण व क्षेत्रविकास मंडळ,</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">गृहनिर्माण भवन, वांद्रे (पुर्व),</p>
                    <p style="display: block; margin-top: 5px; margin-bottom: 5px;">मुंबई - ४०००५१.</p>
                </p>
            </div>
        </div>
        <div>
            <div style="line-height: 1.5;">

                <p><span class="font-weight-semi-bold"> Subject - </span>Application for @if($oc_application->request_form->is_full_oc==1) Full OC @else Part OC @endif  for rehab portion and sale component of the Proposed redevelopment of the existing Building No. <input type="hidden" name="application_master_id" value="{{ $id }}" readonly>{{ $society_details->building_no }} (address ) {{ $society_details->address }} For (society name) {{ $society_details->name }}


                <p class="font-weight-semi-bold">Dear sir,</p>
                <p>
                    With reference to the subject mentioned above, as per permissible B.U.A. allotted by MHADA we have completed the construction work.
                </p>

                <p><span class="font-weight-semi-bold">Construction Details: </span>
                    {{ $oc_application->request_form->construction_details }}
                </p>

                <p>
                    As the work is completed we have to obtain  @if($oc_application->request_form->is_full_oc==1) full @else part @endif occupation permission from MCGM to reaccomodate the existing members. As per the condition of the offer letter and NOC issued by MHADA, MHADA shall issue NOC for OC.
                </p>

                <p>
                    We therefore request you to kindly grant us the NOC for  @if($oc_application->request_form->is_full_oc==1) Full OC @else Part OC @endif for rehab unit and sale component as mentioned above at the earliest.
                </p>

                <p>
                    Thanking you,
                </p>
                <p>
                    Yours faithfully,
                </p>



            </div>
            <div style="margin-top: 30px;">
                <div style="float: right; text-align: right;">
                    <p style="margin-top: 0; margin-bottom: 60px;">आपला विश्वासू</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">अध्यक्ष / सचिव / खजिनदार</p>
                        <p style="display: block; margin-top: 5px; margin-bottom: 5px;">------- स.गृ.नि. संस्था मर्या.</p>
                </div>
            </div>
        </div>
    </div>
</div>